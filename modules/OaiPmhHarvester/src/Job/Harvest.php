<?php
namespace OaiPmhHarvester\Job;

use Omeka\Job\AbstractJob;
use SimpleXMLElement;

class Harvest extends AbstractJob
{
    /*Xml schema and OAI prefix for the format represented by this class
     * These constants are required for all maps
     */
    /** OAI-PMH metadata prefix */
    const METADATA_PREFIX = 'mets';

    /** XML namespace for output format */
    const METS_NAMESPACE = 'http://www.loc.gov/METS/';

    /** XML schema for output format */
    const METADATA_SCHEMA = 'http://www.loc.gov/standards/mets/mets.xsd';

    /** XML namespace for unqualified Dublin Core */
    const DUBLIN_CORE_NAMESPACE = 'http://purl.org/dc/elements/1.1/';
    const DCTERMS_NAMESPACE = 'http://purl.org/dc/terms/';

    const OAI_DC_NAMESPACE = 'http://www.openarchives.org/OAI/2.0/oai_dc/';
    const OAI_DCTERMS_NAMESPACE = 'http://www.openarchives.org/OAI/2.0/oai_dcterms/';
    const OAI_QDC_NAMESPACE = 'qdc="http://www.bl.uk/namespaces/oai_dcq/';
    const QDC_NAMESPACE = 'http://worldcat.org/xmlschemas/qdc-1.0/';

    const XLINK_NAMESPACE = 'http://www.w3.org/1999/xlink';

    const OAI_DC_SCHEMA = 'http://www.openarchives.org/OAI/2.0/oai_dc/';

    protected $api;

    /**
     * @var \Zend\Log\Logger
     */
    protected $logger;

    protected $hasErr = false;

    protected $resource_type;

    protected $dcProperties;

    public function perform()
    {
        $this->logger = $this->getServiceLocator()->get('Omeka\Logger');
        $this->api = $this->getServiceLocator()->get('Omeka\ApiManager');

        // Set Dc Properties for mapping
        $dcProperties = $this->api->search('properties', ['vocabulary_id' => 1], ['responseContent' => 'resource'])->getContent();
        $elements = [];
        foreach ($dcProperties as $property) {
            $elements[$property->getId()] = $property->getLocalName();
        }
        $this->dcProperties = $elements;

        $filters = $this->getArg('filters', ['whitelist' => [], 'blacklist' => []]);
        $whitelist = &$filters['whitelist'];
        $blacklist = &$filters['blacklist'];

        $args = $this->job->getArgs();

        $comment = null;
        $stats = [
            'records' => null, // @translate
            'harvested' => 0, // @translate
            'whitelisted' => 0, // @translate
            'blacklisted' => 0, // @translate
            'imported' => 0, // @translate
            'updated' => 0,
        ];

        $harvestData = [
            'o:job' => ['o:id' => $this->job->getId()],
            'o:undo_job' => null,
            'o-module-oai-pmh-harvester:comment' => 'Harvesting started', // @translate
            'o-module-oai-pmh-harvester:resource_type' => $args['resource_type'],
            'o-module-oai-pmh-harvester:endpoint' => $args['endpoint'],
            //'o:item_set' => ['o:id' => $args['item_set_id']],
            'resource_template' => $args['resource_template'],
            'o-module-oai-pmh-harvester:metadata_prefix' => $args['metadata_prefix'],
            'o-module-oai-pmh-harvester:set_spec' => $args['set_spec'],
            'o-module-oai-pmh-harvester:set_name' => $args['set_name'],
            'o-module-oai-pmh-harvester:set_description' => @$args['set_description'],
            'o-module-oai-pmh-harvester:has_err' => false,
            'o-module-oai-pmh-harvester:stats' => $stats,
        ];

        $response = $this->api->create('oaipmhharvester_harvests', $harvestData);
        $harvestId = $response->getContent()->id();

        $method = '';
        switch ($args['metadata_prefix']) {
            case 'mets':
                $method = '_dmdSecToJson';
                break;
            case 'oai_dc':
            case 'dc':
                $method = '_oaidcToJson';
                break;
            case 'oai_dcterms':
            case 'oai_adlib':
            case 'oai_dcq':
            case 'oai_qdc':
            case 'dcterms':
            case 'qdc':
            case 'dcq':
                $method = '_anyDctermsToJson';
                break;
            default:
                $this->logger->err(sprintf(
                    'The format "%s" is not managed by the module currently.',
                    $args['metadata_prefix']
                ));
                $this->api->update('oaipmhharvester_harvests', $harvestId, ['o-module-oai-pmh-harvester:has_err' => true]);
                return false;
        }

        $resumptionToken = false;
        do {
            if ($this->shouldStop()) {
                $this->logger->notice(sprintf(
                    'Results: total records = %1$s, harvested = %2$d, whitelisted = %3$d, blacklisted = %4$d, imported = %5$d.', // @translate
                    $stats['records'], $stats['harvested'], $stats['whitelisted'], $stats['blacklisted'], $stats['imported']
                ));
                $this->logger->warn(
                    'The job was stopped.' // @translate
                );
                return false;
            }

            if ($resumptionToken) {
                $url = $args['endpoint'] . "?resumptionToken=$resumptionToken&verb=ListRecords";
            } else {
                $url = $args['endpoint'] . "?metadataPrefix=" . $args['metadata_prefix'] . '&verb=ListRecords';
                if (strlen($args['set_spec'])) {
                    $url .= '&set=' . $args['set_spec'];
                }
            }
            $this->logger->info($args['resource_type']);
            $this->logger->info("start load xml");

            /** @var \SimpleXMLElement $response */
            $response = \simplexml_load_file($url);
            //$this->logger->info($response->asXML());
            if (!$response) {
                $this->hasErr = true;
                $comment = 'Error.'; // @translate
                $this->logger->err(sprintf(
                    'Error: the harvester does not list records with url %s.', // @translate
                    $url
                ));
                break;
            }

            if (!$response->ListRecords) {
                $this->hasErr = true;
                $comment = 'Error.'; // @translate
                $this->logger->err(sprintf(
                    'Error: the harvester does not list records with url %s.', // @translate
                    $url
                ));
                break;
            }

            $records = $response->ListRecords;           

            if (is_null($stats['records'])) {
                $stats['records'] = isset($response->ListRecords->resumptionToken)
                    ? (int) $records->resumptionToken['completeListSize']
                    : count($response->ListRecords->record);
            }

            $toInsert = [];$ids= []; $update_id='';$icount = 0;$ucount = 0;
            /** @var \SimpleXMLElement $record */
            foreach ($records->record as $record) {
                ++$stats['harvested'];
                if ($whitelist || $blacklist) {
                    // Use xml instead of string because some format may use
                    // attributes for data.
                    $recordString = $record->asXML();
                    foreach ($whitelist as $string) {
                        if (mb_stripos($recordString, $string) === false) {
                            ++$stats['whitelisted'];
                            continue 2;
                        }
                    }
                    foreach ($blacklist as $string) {
                        if (mb_stripos($recordString, $string) !== false) {
                            ++$stats['blacklisted'];
                            continue 2;
                        }
                    }
                }
                $pre_record = $this->{$method}($record, $args['item_set_id'],$args);
                if($args['endpoint'] == 'https://adlib.icts.kuleuven.be/webapi/oai.ashx'):
                    $id_exists = $this->itemExists($pre_record, $pre_record['dcterms:identifier'][0]['@value'],$args['resource_type'],'adlib');
                else:   
                    $id_exists = $this->itemExists($pre_record, $pre_record['dcterms:isVersionOf'][0]['@value'],$args['resource_type']);
                endif;

                if(!$id_exists){
                  try{
                      $response_c = $this->api->create($args['resource_type'], $pre_record, [], []);
                      $response_c = null;
                      ++$stats['imported'];
                    }catch(\Throwable $t){
                      $this->logger->info($pre_record['dcterms:isVersionOf'][0]['@value']." error");
                    }
                }else{
                  ++$stats['updated'];
                }
            }

            /*if ($toInsert) {
                $this->createItems($toInsert);
            }*/
            gc_collect_cycles();

            $resumptionToken = isset($response->ListRecords->resumptionToken) && $response->ListRecords->resumptionToken <> ''
                ? $response->ListRecords->resumptionToken
                : false;

            // Update job.
            $harvestData = [
                'o-module-oai-pmh-harvester:comment' => 'Processing', // @translate
                'o-module-oai-pmh-harvester:has_err' => $this->hasErr,
                'o-module-oai-pmh-harvester:stats' => $stats,
            ];
            $this->api->update('oaipmhharvester_harvests', $harvestId, $harvestData);

        } while ($resumptionToken);

        // Update job.
        if (empty($comment)) {
            $comment = 'Harvest ended.'; // @translate
        }
        $harvestData = [
            'o-module-oai-pmh-harvester:comment' => $comment,
            'o-module-oai-pmh-harvester:has_err' => $this->hasErr,
            'o-module-oai-pmh-harvester:stats' => $stats,
        ];
        $this->api->update('oaipmhharvester_harvests', $harvestId, $harvestData);

        $this->logger->notice(sprintf(
            'Results: total records = %1$s, harvested = %2$d, whitelisted = %3$d, blacklisted = %4$d, imported = %5$d.', // @translate
            $stats['records'], $stats['harvested'], $stats['whitelisted'], $stats['blacklisted'], $stats['imported']
        ));
    }

    protected function itemExists($item, $id_version, $resource_type,$endpoint = "CA"){
      
        $query = [];
        if($endpoint == 'adlib'):
            $query['property'][0] = array(
            'property' => 10,
            'text' => $id_version,
            'type' => 'eq',
            'joiner' => 'and'
            );
        else:
            $query['property'][0] = array(
            'property' => 27,
            'text' => $id_version,
            'type' => 'eq',
            'joiner' => 'and'
            );
        endif;

        $results = '';
        $response = $this->api->search($resource_type,$query);
        $results = $response->getContent();

        foreach($results as $result):
          if($result):
            //try{
              //don't update files for to avoid redownload
              if(isset($item['o:media'])):                
                unset($item['o:media']);
              endif;
              $response = $this->api->update($resource_type, $result->id() ,$item, [], ['isPartial' => true, 'flushEntityManager' => true]);
              $response = null;
            /*}catch(\Throwable $t){
              $this->logger->info($item['dcterms:isVersionOf'][0]['@value']." error");
            }*/
            return true;
          endif;
        endforeach;

        return false;
    }

    protected function collectionExists($id){
        //find matching identifier
        $query = [];
        $query['property'][0] = array(
          'property' => 10,
          'text' => $id,
          'type' => 'eq',
          'joiner' => 'and'
        );

        $results = '';
        $response = $this->api->search('item_sets',$query);
        $results = $response->getContent();

        foreach($results as $result):
          if($result):
            return $result->id();
          endif;
        endforeach;

        return false;
    }

    protected function collectionExistsKP($id){
        //find matching identifier
        $query = [];
        $query['property'][0] = array(
          'property' => 1,
          'text' => $id,
          'type' => 'eq',
          'joiner' => 'and'
        );

        $results = '';
        $response = $this->api->search('item_sets',$query);
        $results = $response->getContent();

        foreach($results as $result):
          if($result):
            return $result->id();
          endif;
        endforeach;

        $query = [];
        $query['property'][0] = array(
          'property' => 17,
          'text' => $id,
          'type' => 'eq',
          'joiner' => 'and'
        );

        $results = '';
        $response = $this->api->search('item_sets',$query);
        $results = $response->getContent();

        foreach($results as $result):
          if($result):
            return $result->id();
          endif;
        endforeach;

        return false;
    }

    protected function createRollback($resources)
    {
        if (empty($resources)) {
            return null;
        }

        $importEntities = [];
        foreach ($resources as $resource) {
            $importEntities[] = $this->buildImportEntity($resource);
        }
        $this->api->batchCreate('oaipmhharvester_entities', $importEntities, [], ['continueOnError' => true]);
    }

    /**
     * Convenience function that returns the
     * xmls dmdSec as an Omeka ElementTexts array
     *
     * @param SimpleXMLElement $record
     * @param int $itemSetId
     * @return array|null
     */
    private function _dmdSecToJson(SimpleXMLElement $record, $itemSetId, $args)
    {
        $mets = $record->metadata->mets->children(self::METS_NAMESPACE);
        $meta = null;
        foreach ($mets->dmdSec as $k) {
            $dcMetadata = $k
                ->mdWrap
                ->xmlData
                ->children(self::DUBLIN_CORE_NAMESPACE);

            $elementTexts = [];
            foreach ($this->dcProperties as $propertyId => $localName) {
                if (isset($dcMetadata->$localName)) {
                    $elementTexts["dcterms:$localName"] = $this->extractValues($dcMetadata, $propertyId);
                }
            }
            $meta = $elementTexts;
            $meta['o:item_set'] = ['o:id' => $itemSetId];
        }
        return $meta;
    }

    private function _oaidcToJson(SimpleXMLElement $record, $itemSetId, $args)
    {
        $dcMetadata = $record
            ->metadata
            ->children('oai_dc',true)
            ->children('dcterms',true);

        $elementTexts = [];
        $itemSetIds= [];

        foreach ($this->dcProperties as $propertyId => $localName) {
            //$this->logger->info($dcMetadata->$localName);
            if (isset($dcMetadata->$localName)) {
                $elementTexts["dcterms:$localName"] = $this->extractValues($dcMetadata, $propertyId);

                //looks for matching item set
                if($localName == 'isPartOf' && $args['resource_type'] == 'items'){
                    foreach ($dcMetadata->$localName as $collection_id) {
                      if($setID = $this->collectionExistsKP($collection_id)):
                        $itemSetIds[] = $setID;
                      endif;
                    }
                }    
                //add media if Beeld or Collectie
                if($localName == 'isReferencedBy'){
                    //$this->logger->info('relation');
                    $imgc=0;
                    foreach ($dcMetadata->$localName as $imageUrl) {
                        if (filter_var($imageUrl, FILTER_VALIDATE_URL) === false){
                            continue;
                        }
                        //$this->logger->info($imageUrl);
                        $media[$imgc]= [
                            'o:ingester' => 'url',
                            'o:source' => $imageUrl.'',
                            'ingest_url' => $imageUrl.'',
                            'dcterms:title' => [
                                [
                                    'type' => 'literal',
                                    '@language' => '',
                                    '@value' => 'img - '.$imgc,
                                    'property_id' => 1,
                                ],
                            ],
                        ];
                        $imgc++;
                    }
                }
            }
        }

        $meta = $elementTexts;
        //$meta['o:item_set'] = ['o:id' => $itemSetId];
        //set item set
        foreach($itemSetIds as $collectionId):
            if($collectionId && $args['resource_type'] == 'items'):
                $meta['o:item_set'][] = ['o:id' => $collectionId];
            endif;        
        endforeach;

          //media
          $imgs = array();
          foreach($media as $img):
              $imgs[] = $img;
          endforeach;
          $meta['o:media'] = $imgs;

        //resource template?
        if($args['resource_template']):
            $meta['o:resource_template'] = ["o:id" => $args['resource_template']];
          endif;
        return $meta;
    }

    private function _anyDctermsToJson(SimpleXMLElement $record, $itemSetId, $args)
    {
        $elementTexts = [];
        $media = [];
        

        $metadata = $record->metadata;
        $namespaces = $metadata->getNamespaces(true);

        foreach ($namespaces as $namespace) {
            $dcMetadata = $metadata
                ->children($namespace)
                ->children(self::DCTERMS_NAMESPACE);
            foreach ($this->dcProperties as $propertyId => $localName) {
                if (isset($dcMetadata->$localName)) {

                    $elementTexts["dcterms:$localName"] = $this->extractValues($dcMetadata, $propertyId);

                    //looks for matching item set
                    if($localName == 'isPartOf' && $args['resource_type'] == 'items'){
                      foreach ($dcMetadata->$localName as $collection_id) {
                        if($setID = $this->collectionExists($collection_id)):
                          $itemSetId = $setID;
                        endif;
                      }
                    }

                     //add media if Beeld or Collectie
                    if($localName == 'relation'){
                        $this->logger->info('relation');
                        $imgc=0;
                        foreach ($dcMetadata->$localName as $imageUrl) {
                            if (filter_var($imageUrl, FILTER_VALIDATE_URL) === false){
                                continue;
                            }
                            if (strpos($imageUrl, 'resolver') !== false){
                                continue;
                            }
                            $media[$imgc]= [
                                'o:ingester' => 'url',
                                'o:source' => $imageUrl.'',
                                'ingest_url' => $imageUrl.'',
                                'dcterms:title' => [
                                    [
                                        'type' => 'literal',
                                        '@language' => '',
                                        '@value' => 'img - '.$imgc,
                                        'property_id' => 1,
                                    ],
                                ],
                            ];
                            $imgc++;
                        }
                    }
                }
               
            }
        }

        $meta = $elementTexts;

        //set item set        
        if($itemSetId && $args['resource_type'] == 'items'):
            $meta['o:item_set'][] = ['o:id' => $itemSetId];
        endif;

        //media
        $imgs = array();
        foreach($media as $img):
            $this->logger->info('add image');
            $imgs[] = $img;
        endforeach;
        $meta['o:media'] = $imgs;

        //resource template?
        if($args['resource_template']):
          $meta['o:resource_template'] = ["o:id" => $args['resource_template']];
        endif;

        return $meta;
    }

    protected function extractValues(SimpleXMLElement $metadata, $propertyId)
    {
        $data = [];
        $localName = $this->dcProperties[$propertyId];
        foreach ($metadata->$localName as $value) {
            $texts = trim($value);

            $texts = explode('||',$texts);
            foreach($texts as $text):
              if (!mb_strlen($text)) {
                  continue;
              }

              // Extract xsi type if any.
              $attributes = iterator_to_array($value->attributes('xsi', true));
              $type = empty($attributes['type']) ? null : trim($attributes['type']);
              $type = in_array(strtolower($type), ['dcterms:uri', 'uri']) ? 'uri' : 'literal';

              $val = [
                  'property_id' => $propertyId,
                  'type' => $type,
                  'is_public' => true,
              ];

              switch ($type) {
                  case 'uri':
                      $val['o:label'] = null;
                      $val['@id'] = $text;
                      break;

                  case 'literal':
                  default:
                      // Extract xml language if any.
                      $attributes = iterator_to_array($value->attributes('xml', true));
                      $language = empty($attributes['lang']) ? null : trim($attributes['lang']);

                      $val['@value'] = $text;
                      $val['@language'] = $language;
                      break;
              }

              $data[] = $val;
            endforeach;
        }
        return $data;
    }

    protected function buildImportEntity($resource)
    {
        return [
            'o:job' => ['o:id' => $this->job->getId()],
            'o-module-oai-pmh-harvester:entity_id' => $resource->id(),
            'o-module-oai-pmh-harvester:resource_type' => $this->getArg('entity_type', $args['resource_type']),
        ];
    }
}
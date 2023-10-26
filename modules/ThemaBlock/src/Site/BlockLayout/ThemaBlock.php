<?php
namespace ThemaBlock\Site\BlockLayout;

use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\View\Renderer\PhpRenderer;

class ThemaBlock extends AbstractBlockLayout
{
    public function getLabel()
    {
        return 'Libis - Thema preview'; // @translate
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $defaults = [
            'heading' => '',
        ];

        $data = $block ? $block->data() + $defaults : $defaults;

        $form = new Form();
        $form->add([
            'name' => 'o:block[__blockIndex__][o:data][heading]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Title', // @translate
                'info' => 'Heading above resource list, if any.', // @translate
            ],
        ]);



        $form->setData([
            'o:block[__blockIndex__][o:data][heading]' => $data['heading'],
        ]);

        $html = $view->blockAttachmentsForm($block);
        $html .= $view->formCollection($form);

        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        $resourceType = $block->dataValue('resource_type', 'items');



        $site = $block->page()->site();
        if ($view->siteSetting('browse_attached_items', false)) {
            //$query['site_attachments_only'] = true;
        }

        // Note: Doctrine requires simple label, without quote or double quote:
        // "o:label" is not possible, neither "count".

        // Linked resource title is not easily available, so use the id.
        // Get the lists.
        //$query= parse_str("fulltext_search=&property[0][joiner]=and&property[0][property]=&property[0][type]=eq&property[0][text]=&resource_class_id[]=&resource_template_id[]=4");
        $options = array(
          "heading"=> "Collecties per thema",
          "link_to_single"=> false,
          "custom_url"=> false,
          "skiplinks"=> false,
          "headings"=> false,
          "total"=> false,
          "subject_property"=> "",
          "resource_name"=> "item_sets",
          "order"=> array("alphabetic"=> "ASC"),
          "type"=> "properties",
          "termId"=> 8,
          "sort_order"=> "ASC",
          "sort_by"=> "alphabetic",
          "per_page"=> "",
          "lang" => $site->slug(),
        );
        $values = $view->references()->list('dcterms:type', array('site_id' => '1'),$options);


        return $view->partial('common/block-layout/thema-block', [
            'block' => $block,
            'values' => $values,
            'heading' => $block->dataValue('heading'),
            'attachments' => $block->attachments()
        ]);
    }
}

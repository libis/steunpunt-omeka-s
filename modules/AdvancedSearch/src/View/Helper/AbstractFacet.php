<?php declare(strict_types=1);

namespace AdvancedSearch\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class AbstractFacet extends AbstractHelper
{
    /**
     * @var string
     */
    protected $partial;

    /**
     * @var \Omeka\View\Helper\Api
     */
    protected $api;

    /**
<<<<<<< HEAD
     * @var \Omeka\View\Helper\Url
     */
    protected $urlHelper;

    /**
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
     * @var \Laminas\I18n\View\Helper\Translate
     */
    protected $translate;

    /**
<<<<<<< HEAD
     * @var \Laminas\View\Helper\Partial
     */
    protected $partialHelper;

    /**
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
     * @var int
     */
    protected $siteId;

    /**
<<<<<<< HEAD
     * @var string
     */
    protected $route = '';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $queryBase = [];

    /**
     * Create one facet as link, checkbox, select or button.
     *
     * @param array $facetValues Each facet value has two keys: value and count.
     * May have more for specific facets, like facet range.
     * @return string|array
     */
    public function __invoke(string $facetField, array $facetValues, array $options = [], bool $asData = false)
=======
     * Create one facet as link, checkbox or button.
     *
     * @param array $facetValues Each facet value has two keys: value and count.
     * @return string|array
     */
    public function __invoke(string $name, array $facetValues, array $options = [], bool $asData = false)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        static $facetsData = [];

        $view = $this->getView();
        $plugins = $view->getHelperPluginManager();
<<<<<<< HEAD
        $this->api = $plugins->get('api');
        $this->urlHelper = $plugins->get('url');
        $this->translate = $plugins->get('translate');
        $this->partialHelper = $plugins->get('partial');

        $this->route = $plugins->get('matchedRouteName')();
        $this->params = $view->params()->fromRoute();
        $this->queryBase = $view->params()->fromQuery();

        // Keep browsing inside an item set.
        if (!empty($this->params['item-set-id'])) {
            $this->route = 'site/item-set';
=======
        $urlHelper = $plugins->get('url');
        $partialHelper = $plugins->get('partial');

        $this->api = $plugins->get('api');
        $this->translate = $plugins->get('translate');

        $route = $plugins->get('matchedRouteName')();
        $params = $view->params()->fromRoute();
        $queryBase = $view->params()->fromQuery();

        // Keep browsing inside an item set.
        if (!empty($params['item-set-id'])) {
            $route = 'site/item-set';
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        }

        $isSiteRequest = $plugins->get('status')->isSiteRequest();
        if ($isSiteRequest) {
            $this->siteId = $plugins
                ->get('Laminas\View\Helper\ViewModel')
                ->getRoot()
                ->getVariable('site')
                ->id();
        }

<<<<<<< HEAD
        unset($this->queryBase['page']);
        if (!isset($facetsData[$facetField])) {
            $facetsData[$facetField] = $this->prepareFacetData($facetField, $facetValues, $options);
        }

        if ($asData) {
            return $facetsData[$facetField];
        }

        return $this->partialHelper->__invoke($this->partial, $facetsData[$facetField]);
    }

    /**
     * Prepare facet values with "url" when display is direct, "active", "label".
     *
     * May contain other keys for specific facets, like "from" and "to" for
     * facet ranges.
     */
    protected function prepareFacetData(string $facetField, array $facetValues, array $options): array
    {
        $isFacetModeDirect = ($options['mode'] ?? '') === 'link';
        foreach ($facetValues as /* $facetIndex => */ &$facetValue) {
            $facetValueValue = (string) $facetValue['value'];
            $query = $this->queryBase;

            // The facet value is compared against a string (the query args).
            $facetValueLabel = (string) $this->facetValueLabel($facetField, $facetValueValue);
            if (strlen($facetValueLabel)) {
                if (isset($query['facet'][$facetField]) && array_search($facetValueValue, $query['facet'][$facetField]) !== false) {
                    $values = $query['facet'][$facetField];
                    // TODO Remove this filter to keep all active facet values?
                    $values = array_filter($values, function ($v) use ($facetValueValue) {
                        return $v !== $facetValueValue;
                    });
                    $query['facet'][$facetField] = $values;
                    $active = true;
                } else {
                    $query['facet'][$facetField][] = $facetValueValue;
                    $active = false;
                }
                $url = $isFacetModeDirect ? $this->urlHelper->__invoke($this->route, $this->params, ['query' => $query]) : '';
            } else {
                $active = false;
                $url = '';
            }

            $facetValue['value'] = $facetValueValue;
            $facetValue['label'] = $facetValueLabel;
            $facetValue['active'] = $active;
            $facetValue['url'] = $url;
        }
        unset($facetValue);

        return [
            'name' => $facetField,
            'facetValues' => $facetValues,
            'options' => $options,
        ];
=======
        unset($queryBase['page']);
        // Add url when display is direct, active and label.
        if (!isset($facetsData[$name])) {
            $isFacetModeDirect = ($options['mode'] ?? '') === 'link';
            foreach ($facetValues as /* $facetIndex => */ &$facetValue) {
                $facetValueValue = (string) $facetValue['value'];
                $query = $queryBase;

                // The facet value is compared against a string (the query args).
                $facetValueLabel = (string) $this->facetValueLabel($name, $facetValueValue);
                if (strlen($facetValueLabel)) {
                    if (isset($query['facet'][$name]) && array_search($facetValueValue, $query['facet'][$name]) !== false) {
                        $values = $query['facet'][$name];
                        $values = array_filter($values, function ($v) use ($facetValueValue) {
                            return $v !== $facetValueValue;
                        });
                        $query['facet'][$name] = $values;
                        $active = true;
                    } else {
                        $query['facet'][$name][] = $facetValueValue;
                        $active = false;
                    }
                    $url = $isFacetModeDirect ? $urlHelper($route, $params, ['query' => $query]) : '';
                } else {
                    $active = false;
                    $url = '';
                }

                $facetValue['value'] = $facetValueValue;
                $facetValue['label'] = $facetValueLabel;
                $facetValue['active'] = $active;
                $facetValue['url'] = $url;
            }
            unset($facetValue);
            $facetsData[$name] = [
                'name' => $name,
                'facetValues' => $facetValues,
                'options' => $options,
            ];
        }

        if ($asData) {
            return $facetsData[$name];
        }

        return $partialHelper($this->partial, $facetsData[$name]);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }

    /**
     * The facets may be indexed by the search engine.
     *
     * @todo Remove search of facet labels: use values from the response.
     */
<<<<<<< HEAD
    protected function facetValueLabel(string $facetField, string $value): ?string
=======
    protected function facetValueLabel(string $name, string $value): ?string
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if (!strlen($value)) {
            return null;
        }

<<<<<<< HEAD
        switch ($facetField) {
=======
        switch ($name) {
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            case 'resource_name':
            case 'resource_type':
                return $value;

            case 'is_public':
                return $value
                    ? 'Private'
                    : 'Public';

            case 'id':
                $data = ['id' => $value];
                // The site id is required in public.
                if ($this->siteId) {
                    $data['site_id'] = $this->siteId;
                }
                /** @var \Omeka\Api\Representation\ItemSetRepresentation $resource */
                try {
                    // Resources cannot be searched, only read.
                    $resource = $this->api->read('resources', $data)->getContent();
                } catch (\Exception $e) {
                }
                return $resource
                    ? (string) $resource->displayTitle()
                    // Manage the case where a resource was indexed but removed.
                    // In public side, the item set should belong to a site too.
                    : null;

            case 'owner':
            case 'owner_id':
                /** @var \Omeka\Api\Representation\UserRepresentation $resource */
                // Only allowed users can read and search users.
                if (is_numeric($value)) {
                    try {
                        $resource = $this->api->read('users', ['id' => $value])->getContent();
                    } catch (\Exception $e) {
                        return null;
                    }
                    return $resource->name();
                }
                // No more check: email is not reference, so it always the name.
                return $value;

            case 'site':
            case 'site_id':
                /** @var \Omeka\Api\Representation\SiteRepresentation $resource */
                if (is_numeric($value)) {
                    try {
                        $resource = $this->api->read('sites', ['id' => $value])->getContent();
                    } catch (\Exception $e) {
                        return null;
                    }
                    return $resource->title();
                }
                $resource = $this->api->searchOne('sites', ['slug' => $value])->getContent();
                return $resource
                    ? $resource->title()
                    // Manage the case where a resource was indexed but removed.
                    : null;

            case 'class':
            case 'resource_class_id':
            case 'resource_class':
                if (is_numeric($value)) {
                    try {
                        /** @var \Omeka\Api\Representation\ResourceClassRepresentation $resource */
                        $resource = $this->api->read('resource_classes', ['id' => $value])->getContent();
                    } catch (\Exception $e) {
                        return null;
                    }
                    return $this->translate->__invoke($resource->label());
                }
                $resource = $this->api->searchOne('resource_classes', ['term' => $value])->getContent();
                return $resource
                    ? $this->translate->__invoke($resource->label())
                    // Manage the case where a resource was indexed but removed.
                    : null;

            case 'template':
            case 'resource_template_id':
            case 'resource_template':
                if (is_numeric($value)) {
                    try {
                        /** @var \Omeka\Api\Representation\ResourceTemplateRepresentation $resource */
                        $resource = $this->api->read('resource_templates', ['id' => $value])->getContent();
                    } catch (\Exception $e) {
                        return null;
                    }
                    return $resource->label();
                }
                $resource = $this->api->searchOne('resource_templates', ['label' => $value])->getContent();
                return $resource
                    ? $resource->label()
                    // Manage the case where a resource was indexed but removed.
                    : null;

            case 'item_set':
            case 'item_set_id':
            case 'item_set':
                $data = ['id' => $value];
                // The site id is required in public.
                if ($this->siteId) {
                    $data['site_id'] = $this->siteId;
                }
                /** @var \Omeka\Api\Representation\ItemSetRepresentation $resource */
                $resource = $this->api->searchOne('item_sets', $data)->getContent();
                return $resource
                    ? (string) $resource->displayTitle()
                    // Manage the case where a resource was indexed but removed.
                    // In public side, the item set should belong to a site too.
                    : null;

            case 'property':
            default:
                return $value;
        }
    }
}

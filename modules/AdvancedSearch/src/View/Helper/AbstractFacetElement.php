<?php declare(strict_types=1);

namespace AdvancedSearch\View\Helper;

class AbstractFacetElement extends AbstractFacet
{
    /**
     * Create one facet as link, checkbox or button.
     *
<<<<<<< HEAD
     * @param array $facet A facet has at least two keys: "value" and "count".
     * May contain the key, that may be a numeric key, or string like "from" or "to".
     * @return string|array
     */
    public function __invoke(string $facetField, array $facet, array $options = [], bool $asData = false)
=======
     * @param array $facet A facet has two keys: value and count.
     * @return string|array
     */
    public function __invoke(string $name, array $facet, array $options = [], bool $asData = false)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        // Variables are static to speed up process for all facets.
        // TODO Share the list between active and facet helpers.
        static $urlHelper;
        static $partialHelper;
        static $escapeHtml;
        static $escapeHtmlAttr;
        static $facetLabel;

        static $route;
        static $params;
        static $queryBase;

        static $facetsData = [];

        if (is_null($route)) {
            $view = $this->getView();
            $plugins = $view->getHelperPluginManager();
            $urlHelper = $plugins->get('url');
            $partialHelper = $plugins->get('partial');
            $escapeHtml = $plugins->get('escapeHtml');
            $escapeHtmlAttr = $plugins->get('escapeHtmlAttr');
            $facetLabel = $plugins->get('facetLabel');

            $this->api = $plugins->get('api');
            $this->translate = $plugins->get('translate');

            $route = $plugins->get('matchedRouteName')();
            $params = $view->params()->fromRoute();
            $queryBase = $view->params()->fromQuery();

            // Keep browsing inside an item set.
            if (!empty($params['item-set-id'])) {
                $route = 'site/item-set';
            }

            $isSiteRequest = $plugins->get('status')->isSiteRequest();
            if ($isSiteRequest) {
                $this->siteId = $plugins
                    ->get('Laminas\View\Helper\ViewModel')
                    ->getRoot()
                    ->getVariable('site')
                    ->id();
            }

            unset($queryBase['page']);
        }

        $facetValue = (string) $facet['value'];
<<<<<<< HEAD

        $isReady = isset($facetsData[$facetField][$facetValue]);
        $isFromTo = isset($facet['key'])
            && ($facet['key'] === 'from' || $facet['key'] === 'to');
        if (!$isReady || ($isFromTo && !isset($facetsData[$facetField][$facetValue][$facet['key']]))) {
            $query = $queryBase;

            // The facet value is compared against a string (the query args).
            $facetValueLabel = (string) $this->facetValueLabel($facetField, $facetValue);
            if (strlen($facetValueLabel)) {
                if (isset($query['facet'][$facetField]) && array_search($facetValue, $query['facet'][$facetField]) !== false) {
                    // Facet range is managed differently: the first facet is "from", the second is "to".
                    $isSelectRange = isset($options['facets'][$facetField]['type']) && $options['facets'][$facetField]['type'] === 'SelectRange';
                    // Rewrite the query without the current facet.
                    if ($isSelectRange && $isFromTo) {
                        unset($query['facet'][$facetField][$facet['key']]);
                    } else {
                        $values = $query['facet'][$facetField];
                        $values = array_filter($values, function ($v) use ($facetValue) {
                            return $v !== $facetValue;
                        });
                        $query['facet'][$facetField] = $values;
                    }
                    if (empty($query['facet'][$facetField])) {
                        unset($query['facet'][$facetField]);
                    }
                    $active = true;
                } else {
                    $query['facet'][$facetField][] = $facetValue;
=======
        if (!isset($facetsData[$name][$facetValue])) {
            $query = $queryBase;

            // The facet value is compared against a string (the query args).
            $facetValueLabel = (string) $this->facetValueLabel($name, $facetValue);
            if (strlen($facetValueLabel)) {
                if (isset($query['facet'][$name]) && array_search($facetValue, $query['facet'][$name]) !== false) {
                    $values = $query['facet'][$name];
                    $values = array_filter($values, function ($v) use ($facetValue) {
                        return $v !== $facetValue;
                    });
                    $query['facet'][$name] = $values;
                    $active = true;
                } else {
                    $query['facet'][$name][] = $facetValue;
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
                    $active = false;
                }
                $url = $urlHelper($route, $params, ['query' => $query]);
            } else {
                $active = false;
                $url = '';
            }

<<<<<<< HEAD
            $data = [
                'name' => $facetField,
=======
            $facetsData[$name][$facetValue] = [
                'name' => $name,
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
                'value' => $facetValue,
                'label' => $facetValueLabel,
                'count' => $facet['count'],
                'active' => $active,
<<<<<<< HEAD
                'key' => $facet['key'] ?? null,
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
                'url' => $url,
                'options' => $options,
                // To speed up process.
                'escapeHtml' => $escapeHtml,
                'escapeHtmlAttr' => $escapeHtmlAttr,
                'translate' => $this->translate,
                'facetLabel' => $facetLabel,
            ];
<<<<<<< HEAD
            $facetsData[$facetField][$facetValue] = $isFromTo
                ? [$facet['key'] => $data]
                : $data;
        } elseif (isset($facet['count'])) {
            // When facet selected is used, the count is null, so it should be
            // updated when possible.
            $facetsData[$facetField][$facetValue]['count'] = $facet['count'];
        }

        $facetData = $isFromTo
            ? $facetsData[$facetField][$facetValue][$facet['key']]
            : $facetsData[$facetField][$facetValue];

        if ($asData) {
            return $facetData;
        }

        return strlen($facetData['label'])
            ? $partialHelper($this->partial, $facetData)
=======
        } elseif (isset($facet['count'])) {
            // When facet selected is used, the count is null, so it should be
            // updated when possible.
            $facetsData[$name][$facetValue]['count'] = $facet['count'];
        }

        if ($asData) {
            return $facetsData[$name][$facetValue];
        }

        return strlen($facetsData[$name][$facetValue]['label'])
            ? $partialHelper($this->partial, $facetsData[$name][$facetValue])
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            : '';
    }
}

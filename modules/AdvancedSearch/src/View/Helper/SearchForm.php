<?php declare(strict_types=1);

namespace AdvancedSearch\View\Helper;

<<<<<<< HEAD
use AdvancedSearch\Adapter\AdapterInterface;
use AdvancedSearch\Api\Representation\SearchConfigRepresentation;
use AdvancedSearch\Api\Representation\SearchEngineRepresentation;
=======
use AdvancedSearch\Api\Representation\SearchConfigRepresentation;
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
use Laminas\Form\Form;
use Laminas\View\Helper\AbstractHelper;

/**
 * @todo Remove this view helper and use SearchConfigRepresentation::form() only.
 */
class SearchForm extends AbstractHelper
{
    /**
     * The default partial view script.
     *
     * With the default form, this is search/search-form-main.
     */
    const PARTIAL_NAME = 'search/search-form';

    /**
     * @var SearchConfigRepresentation
     */
    protected $searchConfig;

    /**
     * @var Form
     */
    protected $form;

    /**
     * @var string
     */
    protected $partial = '';

    /**
     * @param SearchConfigRepresentation $searchConfig
     * @param string $partial Specific partial for the search form of the page.
     * @param bool $skipFormAction Don't set form action, so use the current page.
     * @return \AdvancedSearch\View\Helper\SearchForm
     */
<<<<<<< HEAD
    public function __invoke(?SearchConfigRepresentation $searchConfig = null, $partial = null, $skipFormAction = false): self
=======
    public function __invoke(SearchConfigRepresentation $searchConfig = null, $partial = null, $skipFormAction = false): self
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $this->initSearchForm($searchConfig, $partial, $skipFormAction);
        return $this;
    }

    /**
     * Prepare default search page, form and partial.
     *
     * @param SearchConfigRepresentation $searchConfig
     * @param string $partial Specific partial for the search form.
     * @param bool $skipFormAction Don't set form action, so use the current page.
     */
<<<<<<< HEAD
    protected function initSearchForm(?SearchConfigRepresentation $searchConfig = null, $partial = null, $skipFormAction = false): void
=======
    protected function initSearchForm(SearchConfigRepresentation $searchConfig = null, $partial = null, $skipFormAction = false): void
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $plugins = $this->getView()->getHelperPluginManager();
        $isAdmin = $plugins->get('status')->isAdminRequest();
        if (empty($searchConfig)) {
            // If it is on a search page route, use the id, else use the setting.
            $params = $plugins->get('params')->fromRoute();
            $setting = $plugins->get($isAdmin ? 'setting' : 'siteSetting');
            if ($params['controller'] === 'AdvancedSearch\Controller\IndexController') {
                $searchConfigId = $params['id'];
                // Check if this search config is allowed.
                if (!in_array($searchConfigId, $setting('advancedsearch_configs'))) {
                    $searchConfigId = 0;
                }
            }
            if (empty($searchConfigId)) {
                $searchConfigId = $setting('advancedsearch_main_config');
            }
            $this->searchConfig = $plugins->get('api')->searchOne('search_configs', ['id' => (int) $searchConfigId])->getContent();
        } else {
            $this->searchConfig = $searchConfig;
        }

        $this->form = null;
        if ($this->searchConfig) {
            $this->form = $this->searchConfig->form();
            if ($this->form && !$skipFormAction) {
                $url = $isAdmin
                    ? $this->searchConfig->adminSearchUrl()
                    : $this->searchConfig->siteUrl();
                $this->form->setAttribute('action', $url);
            }
        }

        // Reset the partial.
        $this->partial = '';

        if ($this->form) {
            $this->partial = $partial ?? '';
            if (empty($this->partial)) {
                $formAdapter = $this->searchConfig->formAdapter();
                $this->partial = $formAdapter && ($formPartial = $formAdapter->getFormPartial())
                    ? $formPartial
                    : self::PARTIAL_NAME;
            }
        }
    }

    /**
<<<<<<< HEAD
     * Get the specified search config.
=======
     * Get the specified search config or the default one.
     *
     * @return \AdvancedSearch\Api\Representation\SearchConfigRepresentation|null
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
     */
    public function getSearchConfig(): ?SearchConfigRepresentation
    {
        return $this->searchConfig;
    }

    /**
<<<<<<< HEAD
     * Get the specified search engine.
     */
    public function getSearchEngine(): ?SearchEngineRepresentation
    {
        return $this->searchConfig ? $this->searchConfig->engine() : null;
    }

    /**
     * Get the specified search adapter.
     */
    public function getSearchAdapter(): ?AdapterInterface
    {
        $searchEngine = $this->getSearchEngine();
        return $searchEngine ? $searchEngine->adapter() : null;
    }

    /**
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
     * Get the form of the search config.
     *
     * @return \Laminas\Form\Form|null
     */
    public function getForm(): ?Form
    {
        return $this->form;
    }

    /**
     * Get the partial form used for this form of this page.
     *
     * @return string
     */
    public function getPartial(): string
    {
        return $this->partial;
    }

    public function __toString(): string
    {
        return $this->partial
            ? $this->getView()->partial($this->partial, ['form' => $this->form])
            : '';
    }
}

<?php declare(strict_types=1);

namespace AdvancedSearch\Form\Element;

use Laminas\Form\Element\Select;

class SearchConfigSelect extends Select
{
<<<<<<< HEAD
    use TraitOptionalElement;

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    /**
     * @var \Omeka\Api\Manager
     */
    protected $apiManager;

    public function getValueOptions()
    {
        $response = $this->apiManager->search('search_configs');
        $searchConfigs = $response->getContent();

        $options = [];
        foreach ($searchConfigs as $searchConfig) {
            $options[$searchConfig->id()] = $searchConfig->name();
        }

        return $options;
    }

    public function setApiManager($apiManager)
    {
        $this->apiManager = $apiManager;
        return $this;
    }
}

<?php
namespace HeroBlock\Site\BlockLayout;

use Omeka\Site\BlockLayout\AbstractBlockLayout;

use Omeka\Api\Exception as ApiException;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Entity\SitePageBlock;
use Laminas\Form\Element\Select;
use Laminas\Form\Form;
use Omeka\Stdlib\HtmlPurifier;
use Omeka\Stdlib\ErrorStore;
use Laminas\Form\Element\Textarea;
use Laminas\View\Renderer\PhpRenderer;

/**
 * The block layout class encapsulates everything about your custom block.
 *
 * Everything the user sees about your block, both on the admin and public
 * sides, gets defined here.
 */
class HeroBlock extends AbstractBlockLayout
{
    /**
     * getLabel() is where you define the label users will see when selecting
     * your block.
     *
     * @return string
     */
    public function getLabel()
    {
        return 'Libis - Hero'; // @translate
    }

    public function onHydrate(SitePageBlock $block, ErrorStore $errorStore)
    {
        $data = $block->getData();
        $block->setData($data);
        
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $siteId = $site->id();
        $apiUrl = $site->apiUrl();
        $blockData = ($block) ? $block->data() : '';
        //$data = $block ? $block->data() : [];
        return $view->partial('common/block-layout/hero-block-form', [
            'block' => $blockData,
            'blockAll' => $block,
            'apiUrl' => $apiUrl,
            'siteId' => $siteId,
        ]);
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {      
        $blockData = ($block) ? $block->data() : '';
        $site = $view->site;
         
        return $view->partial('common/block-layout/hero-block', [
        'block' => $blockData,
        'blockAll' => $block,
      ]);
    }
}

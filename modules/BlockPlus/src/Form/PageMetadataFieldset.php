<?php declare(strict_types=1);

namespace BlockPlus\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Omeka\Form\Element as OmekaElement;

class PageMetadataFieldset extends Fieldset
{
    public function init(): void
    {
        $this
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][credits]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Credits', // @translate
                ],
                'attributes' => [
                    'id' => 'page-metadata-credits',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][summary]',
                'type' => Element\Textarea::class,
                'options' => [
                    'label' => 'Summary', // @translate
                ],
                'attributes' => [
                    'id' => 'page-metadata-summary',
                    'class' => 'block-html full wysiwyg',
                    'rows' => 5,
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][featured]',
                'type' => Element\Checkbox::class,
                'options' => [
                    'label' => 'Featured', // @translate
                ],
                'attributes' => [
                    'id' => 'page-metadata-featured',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][tags]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Tags', // @translate
                    'info' => 'Comma-separated list of keywords', // @translate
                ],
                'attributes' => [
                    'id' => 'page-metadata-tags',
                    'placeholder' => 'alpha, beta, gamma',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][params]',
                'type' => Element\Textarea::class,
                'options' => [
                    'label' => 'Params', // @translate
                    'info' => 'The params can be fetched as raw text, key/value pairs, or json.', // @translate
                ],
                'attributes' => [
                    'id' => 'page-metadata-params',
                    'rows' => 5,
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][cover]',
                'type' => OmekaElement\Asset::class,
                'options' => [
                    'label' => 'Cover image', // @translate
                ],
                'attributes' => [
                    'id' => 'page-metadata-cover',
                ],
            ])
        ;
    }
}

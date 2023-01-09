<?php declare(strict_types=1);

namespace BlockPlus\Form;

<<<<<<< HEAD
use BlockPlus\Form\Element as BlockPlusElement;
=======
use BlockPlus\Form\Element\OptionalRadio;
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class DivisionFieldset extends Fieldset
{
    public function init(): void
    {
        // TODO Use radio, but they are not automatically populated, except last one.

        $this
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][type]',
<<<<<<< HEAD
                'type' => BlockPlusElement\OptionalRadio::class,
=======
                'type' => OptionalRadio::class,
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
                'options' => [
                    'label' => 'Type', // @translate
                    'value_options' => [
                        'start' => 'New division', // @translate
                        'inter' => 'End previous and start new', // @translate
                        'end' => 'End division', // @translate
                    ],
                ],
                'attributes' => [
                    'id' => 'division-type',
                    'required' => true,
                    'value' => 'start',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][tag]',
<<<<<<< HEAD
                'type' => BlockPlusElement\OptionalRadio::class,
=======
                'type' => OptionalRadio::class,
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
                'options' => [
                    'label' => 'Tag', // @translate
                    'value_options' => [
                        'div' => 'div', // @translate
                        'aside' => 'aside', // @translate
                    ],
                ],
                'attributes' => [
                    'id' => 'division-tag',
                    'value' => 'div',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][class]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'CSS class', // @translate
                    'info' => 'Set the classes according to the css of your theme. Only classes "main" and "column" are managed.', // @translate
                ],
                'attributes' => [
                    'id' => 'division-class',
                    'placeholder' => 'main column align-left',
                ],
            ]);
    }
}

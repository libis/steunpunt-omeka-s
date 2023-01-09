<?php declare(strict_types=1);

namespace AdvancedSearch\Form\View\Helper;

use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\AbstractHelper;

class FormNote extends AbstractHelper
{
    /**
<<<<<<< HEAD
     * @var string|null
     */
    protected $wrap = 'div';

    /**
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
     * Generate a static text for a form.
     *
     * @see \Laminas\Form\View\Helper\FormLabel
     *
     * @param ElementInterface $element
     * @param null|string $labelContent
     * @param string $position
     * @return string|FormNote
     */
    public function __invoke(ElementInterface $element = null, $labelContent = null, $position = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element);
    }

    public function render(ElementInterface $element)
    {
<<<<<<< HEAD
        // For compatibility with other modules, options "html" and "text" are
        // checked. Will be removed in Omeka S v4.
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $content = $element->getOption('html');
        if ($content) {
            return $content;
        }
<<<<<<< HEAD
        $content = $element->getOption('text');
        if (strlen((string) $content)) {
            $isEscaped = false;
            $this->wrap = 'p';
        } else {
            $content = $element->getContent();
            $isEscaped = $element->getIsEscaped();
            $this->wrap = $element->getWrap();
            if (!$this->wrap && !strlen((string) $content)) {
                return '';
            }
        }

        if (!$isEscaped) {
            $plugins = $this->getView()->getHelperPluginManager();
            $escape = $this->escapeHtmlHelper = $plugins->get('escapeHtml');
            $translate = $plugins->get('translate');
            $content = $escape($translate($content));
        }

        if ($this->wrap) {
            return $this->openTag($element)
                . $content
                . $this->closeTag();
        }

        return $content;
=======

        // It may use attributes, even if the text is empty.
        $view = $this->getView();
        return $this->openTag($element)
            . $view->escapeHtml($view->translate($element->getOption('text')))
            . $this->closeTag();
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }

    /**
     * Generate an opening label tag.
     *
     * @param null|array|ElementInterface $attributesOrElement
     * @return string
     */
    public function openTag($attributesOrElement = null)
    {
        if (empty($attributesOrElement)) {
<<<<<<< HEAD
            return '<' . $this->wrap . '>';
=======
            return '<p>';
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        }

        if (is_array($attributesOrElement)) {
            $attributes = $attributesOrElement;
        } else {
            if (!is_object($attributesOrElement)
                || !($attributesOrElement instanceof ElementInterface)
            ) {
<<<<<<< HEAD
                return '<' . $this->wrap . '>';
=======
                return '<p>';
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            }
            $attributes = $attributesOrElement->getAttributes();
            if (is_object($attributes)) {
                $attributes = iterator_to_array($attributes);
            }
        }

        $attributes = $this->createAttributesString($attributes);
<<<<<<< HEAD
        return sprintf('<%s %s>', $this->wrap, $attributes);
=======
        return sprintf('<p %s>', $attributes);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }

    /**
     * Return a closing label tag.
     *
     * @return string
     */
    public function closeTag()
    {
<<<<<<< HEAD
        return '</' . $this->wrap . '>';
=======
        return '</p>';
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }

    /**
     * Determine input type to use
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getType(ElementInterface $element)
    {
        return 'note';
    }
}

<?php declare(strict_types=1);

namespace AdvancedSearch\Form\Element;

use Laminas\Form\Element\Radio;

class OptionalRadio extends Radio
{
<<<<<<< HEAD
    use TraitOptionalElement;
=======
    /**
     * @see https://github.com/zendframework/zendframework/issues/2761#issuecomment-14488216
     *
     * {@inheritDoc}
     * @see \Laminas\Form\Element\Select::getInputSpecification()
     */
    public function getInputSpecification()
    {
        $inputSpecification = parent::getInputSpecification();
        $inputSpecification['required'] = isset($this->attributes['required'])
            && $this->attributes['required'];
        return $inputSpecification;
    }
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}

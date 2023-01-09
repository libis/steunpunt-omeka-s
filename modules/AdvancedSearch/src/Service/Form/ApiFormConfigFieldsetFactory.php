<?php declare(strict_types=1);

namespace AdvancedSearch\Service\Form;

use AdvancedSearch\Form\Admin\ApiFormConfigFieldset;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ApiFormConfigFieldsetFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return (new ApiFormConfigFieldset(null, $options))
<<<<<<< HEAD
            ->setEasyMeta($services->get('ViewHelperManager')->get('easyMeta'));
=======
            ->setConnection($services->get('Omeka\Connection'));
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }
}

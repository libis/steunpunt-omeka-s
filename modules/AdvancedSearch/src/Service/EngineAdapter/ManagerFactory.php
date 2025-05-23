<?php declare(strict_types=1);

namespace AdvancedSearch\Service\EngineAdapter;

use AdvancedSearch\EngineAdapter\Manager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $config = $services->get('Config');
        return new Manager($services, $config['advanced_search_engine_adapters']);
    }
}

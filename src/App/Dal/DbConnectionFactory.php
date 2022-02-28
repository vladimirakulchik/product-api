<?php

declare(strict_types=1);

namespace App\Dal;

use Doctrine\DBAL\DriverManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DbConnectionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');

        return DriverManager::getConnection($config['dbal'][$requestedName]);
    }
}

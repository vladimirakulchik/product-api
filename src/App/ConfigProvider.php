<?php

declare(strict_types=1);

namespace App;

use Fig\Http\Message\RequestMethodInterface;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            ConfigAbstractFactory::class => $this->getAbstractFactoryConfig(),
            'dependencies'               => $this->getDependencies(),
            'routes'                     => $this->getRoutes(),
        ];
    }

    private function getAbstractFactoryConfig(): array
    {
        return [
            Handler\PingHandler::class => [
                'db_product',
            ],
        ];
    }

    private function getDependencies(): array
    {
        return [
            'abstract_factories' => [
                ConfigAbstractFactory::class,
            ],
            'factories'          => [
                'db_product'         => Dal\DbConnectionFactory::class,
                Handler\Index::class => Handler\IndexFactory::class,
            ],
        ];
    }

    private function getRoutes(): array
    {
        return [
            [
                'allowed_routes' => [RequestMethodInterface::METHOD_GET],
                'middleware'     => Handler\Index::class,
                'path'           => '/',
                'name'           => 'index',
            ],
            [
                'allowed_routes' => [RequestMethodInterface::METHOD_GET],
                'middleware'     => Handler\PingHandler::class,
                'path'           => '/products/{productCode: [^/]+}',
                'name'           => 'ping',
                'parameters'     => ['productCode'],
            ],
        ];
    }
}

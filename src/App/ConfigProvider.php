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
            'dependencies' => $this->getDependencies(),
            'routes' => $this->getRoutes(),
        ];
    }

    private function getAbstractFactoryConfig(): array
    {
        return [
            Handler\PingHandler::class => [],
        ];
    }

    private function getDependencies(): array
    {
        return [
            'factories' => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            ],
        ];
    }

    private function getRoutes(): array
    {
        return [
            [
                'allowed_routes' => [RequestMethodInterface::METHOD_GET],
                'middleware' => Handler\PingHandler::class,
                'path' => '/',
                'name' => 'index',
            ],
        ];
    }
}

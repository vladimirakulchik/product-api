<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $config = $container->get('config');

    if (empty($config['routes'])) {
        return;
    }

    foreach ($config['routes'] as $route) {
        $app->route(
            $route['path'],
            $route['middleware'],
            $route['allowed_routes'],
            $route['name']
        );
    }
};

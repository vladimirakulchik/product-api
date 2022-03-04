<?php

declare(strict_types=1);

namespace App\Handler;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mezzio\Helper\UrlHelper;

class IndexFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $urlHelper = $container->get(UrlHelper::class);
        $config    = $container->get('config');

        return new Index($urlHelper, $config['routes']);
    }
}

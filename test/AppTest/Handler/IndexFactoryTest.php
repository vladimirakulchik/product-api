<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\Index;
use App\Handler\IndexFactory;
use Interop\Container\ContainerInterface;
use Mezzio\Helper\UrlHelper;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class IndexFactoryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ObjectProphecy|ContainerInterface
     */
    private $container;

    /**
     * @var ObjectProphecy|UrlHelper
     */
    private $urlHelper;

    private IndexFactory $factory;

    protected function setUp(): void
    {
        $this->urlHelper = $this->prophesize(UrlHelper::class);
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->factory = new IndexFactory();
    }

    public function testInvokeReturnsValidClass(): void
    {
        $this->container->get(UrlHelper::class)->willReturn($this->urlHelper);
        $this->container->get('config')->willReturn([
            'routes' => $this->getRoutes(),
        ]);

        $index = ($this->factory)($this->container->reveal(), Index::class);

        $this->assertInstanceOf(Index::class, $index);
    }

    private function getRoutes(): array
    {
        return [
            [
                'allowed_routes' => ['GET'],
                'middleware'     => Index::class,
                'path'           => '/',
                'name'           => 'index',
            ],
        ];
    }
}

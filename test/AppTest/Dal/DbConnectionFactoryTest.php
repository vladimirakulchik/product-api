<?php

declare(strict_types=1);

namespace AppTest\Dal;

use App\Dal\DbConnectionFactory;
use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;
use PDO;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class DbConnectionFactoryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ObjectProphecy|ContainerInterface
     */
    private $container;

    private DbConnectionFactory $factory;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->factory = new DbConnectionFactory();
    }

    public function testInvokeReturnsValidClass(): void
    {
        $requestedName = 'db_product_test';

        $this->container->get('config')->willReturn([
            'dbal' => [
                $requestedName => $this->getDbalConfig(),
            ],
        ]);

        $connection = ($this->factory)($this->container->reveal(), $requestedName);

        $this->assertInstanceOf(Connection::class, $connection);
    }

    private function getDbalConfig(): array
    {
        return [
            'driver'        => 'pdo_mysql',
            'driverOptions' => [
                PDO::ATTR_TIMEOUT => 1,
            ],
            'host'          => 'db_host',
            'user'          => 'db_user',
            'password'      => 'db_password',
            'dbname'        => 'db_name',
        ];
    }
}

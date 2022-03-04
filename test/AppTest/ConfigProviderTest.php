<?php

declare(strict_types=1);

namespace AppTest;

use App\ConfigProvider;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ConfigProviderTest extends TestCase
{
    use ProphecyTrait;

    private ConfigProvider $provider;

    protected function setUp(): void
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvokeReturnsValidArray(): void
    {
        $config = ($this->provider)();

        $this->assertIsArray($config);
        $this->assertNotEmpty($config);
        $this->assertArrayHasKey(ConfigAbstractFactory::class, $config);
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('routes', $config);
    }
}

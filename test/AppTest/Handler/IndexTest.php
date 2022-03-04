<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\Index;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IndexTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ObjectProphecy|ServerRequestInterface
     */
    private $request;

    /**
     * @var ObjectProphecy|UrlHelper
     */
    private $urlHelper;

    private Index $requestHandler;

    protected function setUp(): void
    {
        $this->request   = $this->prophesize(ServerRequestInterface::class);
        $this->urlHelper = $this->prophesize(UrlHelper::class);

        $this->requestHandler = new Index(
            $this->urlHelper->reveal(),
            $this->getRoutes()
        );
    }

    public function testImplementsRequestHandlerInterface(): void
    {
        $this->assertInstanceOf(RequestHandlerInterface::class, $this->requestHandler);
    }

    public function testHandlerReturnsJsonResponse(): void
    {
        $this->urlHelper->generate(
            Argument::type('string'),
            Argument::type('array')
        )->willReturn('path');

        $response = $this->requestHandler->handle($this->request->reveal());

        $this->assertInstanceOf(JsonResponse::class, $response);
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

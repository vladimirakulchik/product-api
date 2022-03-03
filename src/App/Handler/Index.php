<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function implode;

class Index implements RequestHandlerInterface
{
    private UrlHelper $urlHelper;
    private array $routes;

    public function __construct(UrlHelper $urlHelper, array $routes)
    {
        $this->urlHelper = $urlHelper;
        $this->routes    = $routes;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $links = [];

        /** @var array $route */
        foreach ($this->routes as $route) {
            $routeName = 'index' === $route['name']
                ? 'self'
                : $route['name'];

            $links[$routeName] = $this->getLinkData($route);
        }

        return new JsonResponse([
            '_links' => $links,
        ]);
    }

    private function getLinkData(array $route): array
    {
        $parameters = [];

        if (isset($route['parameters'])) {
            foreach ($route['parameters'] as $parameter) {
                $parameters[$parameter] = '{' . $parameter . '}';
            }
        }

        $linkData = [
            'href'   => $this->urlHelper->generate(
                $route['name'],
                $parameters
            ),
            'method' => implode(', ', $route['allowed_routes']),
        ];

        if (! empty($parameters)) {
            $linkData['templated'] = true;
        }

        return $linkData;
    }
}

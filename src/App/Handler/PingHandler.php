<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\DBAL\Connection;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RuntimeException;

class PingHandler implements RequestHandlerInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $query = '
            SELECT
                id,
                name
            FROM
                product
        ';

        try {
            $products = $this->connection->fetchAllAssociative($query);
        } catch (Exception $exception) {
            throw new RuntimeException(
                'Cannot get products from database',
                0,
                $exception
            );
        }

        return new JsonResponse($products);
    }
}

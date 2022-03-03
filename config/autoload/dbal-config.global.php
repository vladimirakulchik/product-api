<?php

declare(strict_types=1);

return [
    'dbal' => [
        'db_product' => [
            'driver'        => 'pdo_mysql',
            'driverOptions' => [
                PDO::ATTR_TIMEOUT => 1,
            ],
            'host'          => $_ENV['DB_PRODUCT_HOST'],
            'user'          => $_ENV['DB_PRODUCT_USER'],
            'password'      => $_ENV['DB_PRODUCT_PASSWORD'],
            'dbname'        => $_ENV['DB_PRODUCT_DBNAME'],
        ],
    ],
];

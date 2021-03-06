<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;

$config = new ConfigurationArray([
    'migrations_paths' => [
        'Migrations' => 'migrations',
    ],
    'table_storage'    => [
        'table_name'                 => 'doctrine_migration_versions',
        'version_column_name'        => 'version',
        'version_column_length'      => 1024,
        'executed_at_column_name'    => 'executed_at',
        'execution_time_column_name' => 'execution_time',
    ],
]);

$dbalConfig = [
    'driver'   => 'pdo_mysql',
    'host'     => $_ENV['DB_PRODUCT_HOST'],
    'dbname'   => $_ENV['MIGRATION_DBNAME'],
    'user'     => $_ENV['MIGRATION_USER'],
    'password' => $_ENV['MIGRATION_PASSWORD'],
];

$connection = DriverManager::getConnection($dbalConfig);

return DependencyFactory::fromConnection(
    $config,
    new ExistingConnection($connection)
);

<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220301074931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create database';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE DATABASE Product DEFAULT CHAR SET utf8mb4 COLLATE utf8mb4_general_ci;');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP DATABASE Product;');
    }
}

<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20220301100850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE Product.product
            (
                id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(50) NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB COMMENT='Product list';
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE Product.product;');
    }
}

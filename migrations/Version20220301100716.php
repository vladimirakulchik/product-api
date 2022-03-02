<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220301100716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE USER 'product'@'%' IDENTIFIED WITH mysql_native_password BY 'passwd22' PASSWORD EXPIRE NEVER;
            GRANT SELECT, INSERT, UPDATE, DELETE ON Product.*  TO 'product'@'%';
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP USER IF EXISTS 'product'@'%';");
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416201233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP SEQUENCE type_accont_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id SERIAL NOT NULL, label VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_accont
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction ADD account_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction ADD label VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction ADD amount DOUBLE PRECISION NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction ADD operation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction ADD CONSTRAINT FK_723705D19B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_723705D19B6B5FBA ON transaction (account_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE type_accont_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type_accont (id SERIAL NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction DROP CONSTRAINT FK_723705D19B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_723705D19B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction DROP account_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction DROP label
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction DROP amount
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transaction DROP operation_at
        SQL);
    }
}

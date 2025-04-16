<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416201938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE budget_forecast (id SERIAL NOT NULL, account_id INT NOT NULL, month VARCHAR(255) NOT NULL, forecasted_income DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FD5329E09B6B5FBA ON budget_forecast (account_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE goal (id SERIAL NOT NULL, account_id INT NOT NULL, title VARCHAR(255) NOT NULL, target_amount DOUBLE PRECISION NOT NULL, deadline TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCDCEB2E9B6B5FBA ON goal (account_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE budget_forecast ADD CONSTRAINT FK_FD5329E09B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE budget_forecast DROP CONSTRAINT FK_FD5329E09B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE goal DROP CONSTRAINT FK_FCDCEB2E9B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE budget_forecast
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE goal
        SQL);
    }
}

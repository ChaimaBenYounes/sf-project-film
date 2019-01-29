<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125133538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F89B658FE');
        $this->addSql('DROP INDEX IDX_1D5EF26F89B658FE ON movie');
        $this->addSql('ALTER TABLE movie CHANGE producer_id producer_movies_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F57BB0DD1 FOREIGN KEY (producer_movies_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F57BB0DD1 ON movie (producer_movies_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F57BB0DD1');
        $this->addSql('DROP INDEX IDX_1D5EF26F57BB0DD1 ON movie');
        $this->addSql('ALTER TABLE movie CHANGE producer_movies_id producer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F89B658FE FOREIGN KEY (producer_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F89B658FE ON movie (producer_id)');
    }
}

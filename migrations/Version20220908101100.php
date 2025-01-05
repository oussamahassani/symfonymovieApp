<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908101100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie ADD slug VARCHAR(300) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F989D9B62 ON movie (slug)');
        $this->addSql('CREATE INDEX search_idx ON movie (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1D5EF26F989D9B62 ON movie');
        $this->addSql('DROP INDEX search_idx ON movie');
        $this->addSql('ALTER TABLE movie DROP slug');
    }
}

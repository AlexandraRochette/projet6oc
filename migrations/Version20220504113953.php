<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504113953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medias ADD trick_id INT NOT NULL');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF81B281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_12D2AF81B281BE2E ON medias (trick_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBDAFD8C8');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE1D902C1');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF81B281BE2E');
        $this->addSql('DROP INDEX UNIQ_12D2AF81B281BE2E ON medias');
        $this->addSql('ALTER TABLE medias DROP trick_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607151926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD author INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBDAFD8C8 FOREIGN KEY (author) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FBDAFD8C8 ON image (author)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBDAFD8C8');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE1D902C1');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBDAFD8C8');
        $this->addSql('DROP INDEX IDX_C53D045FBDAFD8C8 ON image');
        $this->addSql('ALTER TABLE image DROP author');
    }
}

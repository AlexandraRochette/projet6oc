<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413195412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD trick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9474526CB281BE2E ON comment (trick_id)');
        $this->addSql('ALTER TABLE trick ADD comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8F0A91EF8697D13 ON trick (comment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB281BE2E');
        $this->addSql('DROP INDEX UNIQ_9474526CB281BE2E ON comment');
        $this->addSql('ALTER TABLE comment DROP trick_id');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EF8697D13');
        $this->addSql('DROP INDEX UNIQ_D8F0A91EF8697D13 ON trick');
        $this->addSql('ALTER TABLE trick DROP comment_id');
    }
}

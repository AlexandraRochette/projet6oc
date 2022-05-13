<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501155828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_9474526C3B153154 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment ADD author INT NOT NULL, ADD tricks INT NOT NULL, DROP author_id, DROP tricks_id');
        $this->addSql('CREATE INDEX IDX_9474526CBDAFD8C8 ON comment (author)');
        $this->addSql('CREATE INDEX IDX_9474526CE1D902C1 ON comment (tricks)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CBDAFD8C8');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE1D902C1');
        $this->addSql('DROP INDEX IDX_9474526CBDAFD8C8 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CE1D902C1 ON comment');
        $this->addSql('ALTER TABLE comment ADD author_id INT NOT NULL, ADD tricks_id INT NOT NULL, DROP author, DROP tricks');
        $this->addSql('CREATE INDEX IDX_9474526C3B153154 ON comment (tricks_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
    }
}

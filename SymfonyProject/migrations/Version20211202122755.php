<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211202122755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE event_user ADD PRIMARY KEY (userId, eventId)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE22B2EBB6C FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE22B2EBB6C');
        $this->addSql('ALTER TABLE event_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user DROP roles');
    }
}

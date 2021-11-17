<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111032937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop (shop_id INT AUTO_INCREMENT NOT NULL, donor_id INT NOT NULL, name VARCHAR(255) NOT NULL, qte INT NOT NULL, color VARCHAR(255) NOT NULL, cost INT NOT NULL, PRIMARY KEY(shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments CHANGE postId postId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE don CHANGE donorId donorId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE associationId associationId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE donorId donorId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE userId userId INT DEFAULT NULL, CHANGE eventId eventId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recompense CHANGE donorId donorId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recu CHANGE donationId donationId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE donorId donorId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY RESULTS_FK2');
        $this->addSql('DROP INDEX results_fk2 ON event_user');
        $this->addSql('CREATE INDEX IDX_92589AE22B2EBB6C ON event_user (eventId)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT RESULTS_FK2 FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
        $this->addSql('ALTER TABLE user_connected CHANGE userId userId INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shop');
        $this->addSql('ALTER TABLE comments CHANGE postId postId INT NOT NULL');
        $this->addSql('ALTER TABLE don CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE associationId associationId INT NOT NULL');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE22B2EBB6C');
        $this->addSql('DROP INDEX idx_92589ae22b2ebb6c ON event_user');
        $this->addSql('CREATE INDEX RESULTS_FK2 ON event_user (eventId)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE22B2EBB6C FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
        $this->addSql('ALTER TABLE produit CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE userId userId INT NOT NULL, CHANGE eventId eventId INT NOT NULL');
        $this->addSql('ALTER TABLE recompense CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE recu CHANGE donationId donationId INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE user_connected CHANGE userId userId INT NOT NULL');
    }
}

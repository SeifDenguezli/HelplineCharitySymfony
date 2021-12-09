<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120105418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_likes (post_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_DED1C2924B89032C (post_id), INDEX IDX_DED1C292A76ED395 (user_id), PRIMARY KEY(post_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT FK_DED1C2924B89032C FOREIGN KEY (post_id) REFERENCES posts (postid)');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT FK_DED1C292A76ED395 FOREIGN KEY (user_id) REFERENCES user (userid)');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE user_connected');
        $this->addSql('ALTER TABLE comments CHANGE postId postId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY don_ibfk_2');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY don_ibfk_1');
        $this->addSql('ALTER TABLE evenement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY evenement_ibfk_1');
        $this->addSql('ALTER TABLE evenement ADD cover_image VARCHAR(255) DEFAULT NULL, CHANGE associationId associationId INT DEFAULT NULL, CHANGE Region region VARCHAR(255) NOT NULL, CHANGE eventid event_id INT AUTO_INCREMENT NOT NULL, CHANGE doncategorie don_categorie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (event_id)');
        $this->addSql('DROP INDEX associationid ON evenement');
        $this->addSql('CREATE INDEX IDX_B26681E19B366B ON evenement (associationId)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT evenement_ibfk_1 FOREIGN KEY (associationId) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE produit CHANGE donorId donorId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_2');
        $this->addSql('ALTER TABLE reclamation CHANGE userId userId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recompense CHANGE donorId donorId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recu CHANGE donationId donationId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE donorId donorId INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_user (userId INT NOT NULL, eventId INT NOT NULL, INDEX RESULTS_FK2 (eventId), INDEX IDX_92589AE264B64DCC (userId), PRIMARY KEY(userId, eventId)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_connected (userId INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, gouvernorat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, montant_donne DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(userId)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT RESULTS_FK2 FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT RESULTS_FK1 FOREIGN KEY (userId) REFERENCES user (userId)');
        $this->addSql('DROP TABLE post_likes');
        $this->addSql('ALTER TABLE comments CHANGE postId postId INT NOT NULL');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT don_ibfk_2 FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT don_ibfk_1 FOREIGN KEY (donorId) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE evenement MODIFY event_id INT NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E19B366B');
        $this->addSql('ALTER TABLE evenement DROP cover_image, CHANGE region Region VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, CHANGE associationId associationId INT NOT NULL, CHANGE event_id eventId INT AUTO_INCREMENT NOT NULL, CHANGE don_categorie donCategorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (eventId)');
        $this->addSql('DROP INDEX idx_b26681e19b366b ON evenement');
        $this->addSql('CREATE INDEX associationId ON evenement (associationId)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E19B366B FOREIGN KEY (associationId) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE produit CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE userId userId INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_2 FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
        $this->addSql('ALTER TABLE recompense CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE recu CHANGE donationId donationId INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE donorId donorId INT NOT NULL');
    }
}

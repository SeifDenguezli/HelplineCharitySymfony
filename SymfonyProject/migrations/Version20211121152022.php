<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121152022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT FK_74430F64F8697D13 FOREIGN KEY (comment_id) REFERENCES comments (commentId)');
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT FK_74430F64A76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('DROP INDEX comment_id ON allcomments_likes');
        $this->addSql('CREATE INDEX IDX_74430F64F8697D13 ON allcomments_likes (comment_id)');
        $this->addSql('DROP INDEX user_id ON allcomments_likes');
        $this->addSql('CREATE INDEX IDX_74430F64A76ED395 ON allcomments_likes (user_id)');
        $this->addSql('ALTER TABLE evenement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY evenement_ibfk_1');
        $this->addSql('ALTER TABLE evenement CHANGE associationId associationId INT DEFAULT NULL, CHANGE Region region VARCHAR(255) NOT NULL, CHANGE eventid event_id INT AUTO_INCREMENT NOT NULL, CHANGE doncategorie don_categorie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (event_id)');
        $this->addSql('DROP INDEX associationid ON evenement');
        $this->addSql('CREATE INDEX IDX_B26681E19B366B ON evenement (associationId)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT evenement_ibfk_1 FOREIGN KEY (associationId) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE posts ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('CREATE INDEX IDX_885DBAFAA76ED395 ON posts (user_id)');
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
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY FK_74430F64F8697D13');
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY FK_74430F64A76ED395');
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY FK_74430F64F8697D13');
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY FK_74430F64A76ED395');
        $this->addSql('DROP INDEX idx_74430f64f8697d13 ON allcomments_likes');
        $this->addSql('CREATE INDEX comment_id ON allcomments_likes (comment_id)');
        $this->addSql('DROP INDEX idx_74430f64a76ed395 ON allcomments_likes');
        $this->addSql('CREATE INDEX user_id ON allcomments_likes (user_id)');
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT FK_74430F64F8697D13 FOREIGN KEY (comment_id) REFERENCES comments (commentId)');
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT FK_74430F64A76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE evenement MODIFY event_id INT NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E19B366B');
        $this->addSql('ALTER TABLE evenement CHANGE region Region VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, CHANGE associationId associationId INT NOT NULL, CHANGE event_id eventId INT AUTO_INCREMENT NOT NULL, CHANGE don_categorie donCategorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (eventId)');
        $this->addSql('DROP INDEX idx_b26681e19b366b ON evenement');
        $this->addSql('CREATE INDEX associationId ON evenement (associationId)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E19B366B FOREIGN KEY (associationId) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('DROP INDEX IDX_885DBAFAA76ED395 ON posts');
        $this->addSql('ALTER TABLE posts DROP user_id');
        $this->addSql('ALTER TABLE produit CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE userId userId INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_2 FOREIGN KEY (eventId) REFERENCES evenement (eventId)');
        $this->addSql('ALTER TABLE recompense CHANGE donorId donorId INT NOT NULL');
        $this->addSql('ALTER TABLE recu CHANGE donationId donationId INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE donorId donorId INT NOT NULL');
    }
}

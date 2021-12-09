<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121232206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event_user');
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY allcomments_likes_ibfk_2');
        $this->addSql('DROP INDEX user_id ON allcomments_likes');
        $this->addSql('CREATE INDEX IDX_74430F64A76ED395 ON allcomments_likes (user_id)');
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT allcomments_likes_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('CREATE INDEX eventId ON don (eventId)');
        $this->addSql('CREATE INDEX donorId ON don (donorId)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_ibfk_1');
        $this->addSql('ALTER TABLE posts ADD updated_at DATETIME NOT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX user_id ON posts');
        $this->addSql('CREATE INDEX IDX_885DBAFAA76ED395 ON posts (user_id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE post_likes DROP FOREIGN KEY post_likes_ibfk_2');
        $this->addSql('DROP INDEX user_id ON post_likes');
        $this->addSql('CREATE INDEX IDX_DED1C292A76ED395 ON post_likes (user_id)');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT post_likes_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('CREATE INDEX eventId ON reclamation (eventId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_user (id INT AUTO_INCREMENT NOT NULL, join_date DATE DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, userId INT NOT NULL, eventId INT NOT NULL, INDEX IDX_92589AE22B2EBB6C (eventId), INDEX IDX_92589AE264B64DCC (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE22B2EBB6C FOREIGN KEY (eventId) REFERENCES evenement (event_id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE264B64DCC FOREIGN KEY (userId) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY FK_74430F64A76ED395');
        $this->addSql('DROP INDEX idx_74430f64a76ed395 ON allcomments_likes');
        $this->addSql('CREATE INDEX user_id ON allcomments_likes (user_id)');
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT FK_74430F64A76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('DROP INDEX eventId ON don');
        $this->addSql('DROP INDEX donorId ON don');
        $this->addSql('ALTER TABLE post_likes DROP FOREIGN KEY FK_DED1C292A76ED395');
        $this->addSql('DROP INDEX idx_ded1c292a76ed395 ON post_likes');
        $this->addSql('CREATE INDEX user_id ON post_likes (user_id)');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT FK_DED1C292A76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE posts DROP updated_at, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('DROP INDEX idx_885dbafaa76ed395 ON posts');
        $this->addSql('CREATE INDEX user_id ON posts (user_id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('DROP INDEX eventId ON reclamation');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211211102554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profanities (id INT AUTO_INCREMENT NOT NULL, word VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B8715B4C3F17511 (word), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, userid INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDF132696E (userid), PRIMARY KEY(role_id, userid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDF132696E FOREIGN KEY (userid) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE allcomments_likes DROP FOREIGN KEY allcomments_likes_ibfk_2');
        $this->addSql('DROP INDEX user_id ON allcomments_likes');
        $this->addSql('CREATE INDEX IDX_74430F64A76ED395 ON allcomments_likes (user_id)');
        $this->addSql('ALTER TABLE allcomments_likes ADD CONSTRAINT allcomments_likes_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('CREATE INDEX eventId ON don (eventId)');
        $this->addSql('CREATE INDEX donorId ON don (donorId)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_ibfk_1');
        $this->addSql('ALTER TABLE posts CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX user_id ON posts');
        $this->addSql('CREATE INDEX IDX_885DBAFAA76ED395 ON posts (user_id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE post_likes DROP FOREIGN KEY post_likes_ibfk_2');
        $this->addSql('DROP INDEX user_id ON post_likes');
        $this->addSql('CREATE INDEX IDX_DED1C292A76ED395 ON post_likes (user_id)');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT post_likes_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE recompense DROP FOREIGN KEY recompense_ibfk_1');
        $this->addSql('DROP INDEX donorid ON recompense');
        $this->addSql('CREATE INDEX IDX_1E9BC0DE6261C94D ON recompense (donorId)');
        $this->addSql('ALTER TABLE recompense ADD CONSTRAINT recompense_ibfk_1 FOREIGN KEY (donorId) REFERENCES user (userId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('DROP TABLE profanities');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
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
        $this->addSql('ALTER TABLE posts CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX idx_885dbafaa76ed395 ON posts');
        $this->addSql('CREATE INDEX user_id ON posts (user_id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('ALTER TABLE recompense DROP FOREIGN KEY FK_1E9BC0DE6261C94D');
        $this->addSql('DROP INDEX idx_1e9bc0de6261c94d ON recompense');
        $this->addSql('CREATE INDEX donorId ON recompense (donorId)');
        $this->addSql('ALTER TABLE recompense ADD CONSTRAINT FK_1E9BC0DE6261C94D FOREIGN KEY (donorId) REFERENCES user (userId)');
    }
}

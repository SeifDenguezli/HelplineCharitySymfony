<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121224357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_comment CHANGE evenement event INT NOT NULL');
        $this->addSql('ALTER TABLE event_comment ADD CONSTRAINT FK_1123FBC33BAE0AA7 FOREIGN KEY (event) REFERENCES evenement (event_id)');
        $this->addSql('ALTER TABLE event_comment ADD CONSTRAINT FK_1123FBC38D93D649 FOREIGN KEY (user) REFERENCES user (userId)');
        $this->addSql('CREATE INDEX IDX_1123FBC33BAE0AA7 ON event_comment (event)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY posts_ibfk_1');
        $this->addSql('DROP INDEX user_id ON posts');
        $this->addSql('ALTER TABLE posts DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_comment DROP FOREIGN KEY FK_1123FBC33BAE0AA7');
        $this->addSql('ALTER TABLE event_comment DROP FOREIGN KEY FK_1123FBC38D93D649');
        $this->addSql('DROP INDEX IDX_1123FBC33BAE0AA7 ON event_comment');
        $this->addSql('ALTER TABLE event_comment CHANGE event evenement INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (userId)');
        $this->addSql('CREATE INDEX user_id ON posts (user_id)');
    }
}

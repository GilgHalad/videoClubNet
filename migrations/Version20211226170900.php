<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226170900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE copies_movies CHANGE id_movie id_movie INT DEFAULT NULL, CHANGE id_state id_state INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movies CHANGE id_genre id_genre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rental CHANGE id_copies_movie id_copies_movie INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE copies_movies CHANGE id_state id_state INT NOT NULL, CHANGE id_movie id_movie INT NOT NULL');
        $this->addSql('ALTER TABLE movies CHANGE id_genre id_genre INT NOT NULL');
        $this->addSql('ALTER TABLE rental CHANGE id_copies_movie id_copies_movie INT NOT NULL');
    }
}

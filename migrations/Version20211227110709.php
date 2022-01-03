<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227110709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY rental_FK_1');
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY movies_FK');
        $this->addSql('ALTER TABLE copies_movies DROP FOREIGN KEY copies_movies_FK_1');
        $this->addSql('ALTER TABLE copies_movies DROP FOREIGN KEY copies_movies_FK');
        $this->addSql('DROP TABLE copies_movies');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE provinces');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP TABLE states_movies');
        $this->addSql('DROP TABLE user_types');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE copies_movies (id INT AUTO_INCREMENT NOT NULL, id_movie INT DEFAULT NULL, id_state INT DEFAULT NULL, ref VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, created_at DATE NOT NULL, updated_at DATE NOT NULL, INDEX copies_movies_FK_1 (id_movie), INDEX copies_movies_FK (id_state), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, id_genre INT DEFAULT NULL, name VARCHAR(50) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, INDEX movies_FK (id_genre), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE provinces (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, id_copies_movie INT DEFAULT NULL, updated_at DATE NOT NULL, id_user INT NOT NULL, INDEX rental_FK (id_user), INDEX rental_FK_1 (id_copies_movie), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE states_movies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE copies_movies ADD CONSTRAINT copies_movies_FK FOREIGN KEY (id_state) REFERENCES states_movies (id)');
        $this->addSql('ALTER TABLE copies_movies ADD CONSTRAINT copies_movies_FK_1 FOREIGN KEY (id_movie) REFERENCES movies (id)');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT movies_FK FOREIGN KEY (id_genre) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT rental_FK_1 FOREIGN KEY (id_copies_movie) REFERENCES copies_movies (id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }
}

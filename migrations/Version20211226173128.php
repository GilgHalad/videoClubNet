<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226173128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY user_FK');
        $this->addSql('DROP INDEX user_FK ON user');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, DROP id_province');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD id_province INT NOT NULL, DROP is_verified');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT user_FK FOREIGN KEY (id_province) REFERENCES provinces (id)');
        $this->addSql('CREATE INDEX user_FK ON user (id_province)');
    }
}

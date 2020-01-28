<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128135219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE space (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_date DATETIME NOT NULL, actif TINYINT(1) NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_2972C13A5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_user (space_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E6E5ACC323575340 (space_id), INDEX IDX_E6E5ACC3A76ED395 (user_id), PRIMARY KEY(space_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13A5FB14BA7 FOREIGN KEY (level_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE space_user ADD CONSTRAINT FK_E6E5ACC323575340 FOREIGN KEY (space_id) REFERENCES space (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE space_user ADD CONSTRAINT FK_E6E5ACC3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13A5FB14BA7');
        $this->addSql('ALTER TABLE space_user DROP FOREIGN KEY FK_E6E5ACC323575340');
        $this->addSql('DROP TABLE space');
        $this->addSql('DROP TABLE space_user');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115155918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE forgotten_password (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, INDEX IDX_2EDC8D2479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE forgotten_password ADD CONSTRAINT FK_2EDC8D2479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD created_date DATETIME NOT NULL, ADD updated_date DATETIME DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, ADD isactif TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE forgotten_password');
        $this->addSql('ALTER TABLE user DROP created_date, DROP updated_date, DROP name, DROP avatar, DROP isactif');
    }
}

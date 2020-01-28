<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128150251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, id_space_id INT NOT NULL, id_owner_id INT NOT NULL, categorie_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, level INT NOT NULL, image VARCHAR(255) DEFAULT NULL, isarchiv TINYINT(1) NOT NULL, INDEX IDX_497DD634738CBFD5 (id_space_id), INDEX IDX_497DD6342EE78D6C (id_owner_id), INDEX IDX_497DD634BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634738CBFD5 FOREIGN KEY (id_space_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6342EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634BCF5E72D');
        $this->addSql('DROP TABLE categorie');
    }
}

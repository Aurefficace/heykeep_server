<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128151622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, id_owner_id INT NOT NULL, id_space_id INT NOT NULL, created_date DATETIME NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, isarchiv TINYINT(1) NOT NULL, ispublic TINYINT(1) NOT NULL, INDEX IDX_C778955A2EE78D6C (id_owner_id), INDEX IDX_C778955A738CBFD5 (id_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bloc ADD CONSTRAINT FK_C778955A2EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bloc ADD CONSTRAINT FK_C778955A738CBFD5 FOREIGN KEY (id_space_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE space CHANGE description description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE element');
        $this->addSql('ALTER TABLE space CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

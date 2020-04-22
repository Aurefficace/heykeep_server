<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422064303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE space ADD id_owner_id INT NOT NULL, CHANGE level_id level_id INT NOT NULL');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13A5FB14BA7 FOREIGN KEY (level_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13A2EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2972C13A5FB14BA7 ON space (level_id)');
        $this->addSql('CREATE INDEX IDX_2972C13A2EE78D6C ON space (id_owner_id)');
        $this->addSql('ALTER TABLE forgotten_password CHANGE id_user_id id_user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE forgotten_password CHANGE id_user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13A5FB14BA7');
        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13A2EE78D6C');
        $this->addSql('DROP INDEX IDX_2972C13A5FB14BA7 ON space');
        $this->addSql('DROP INDEX IDX_2972C13A2EE78D6C ON space');
        $this->addSql('ALTER TABLE space DROP id_owner_id, CHANGE level_id level_id INT DEFAULT NULL');
    }
}

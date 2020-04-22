<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422071047 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13A5FB14BA7');
        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13ABC9AFF91');
        $this->addSql('DROP INDEX IDX_2972C13A5FB14BA7 ON space');
        $this->addSql('DROP INDEX IDX_2972C13ABC9AFF91 ON space');
        $this->addSql('ALTER TABLE space ADD level INT NOT NULL, CHANGE level_id parent_space_id INT NOT NULL');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13ABC9AFF91 FOREIGN KEY (parent_space_id) REFERENCES space (id)');
        $this->addSql('CREATE INDEX IDX_2972C13ABC9AFF91 ON space (parent_space_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13ABC9AFF91');
        $this->addSql('DROP INDEX IDX_2972C13ABC9AFF91 ON space');
        $this->addSql('ALTER TABLE space ADD level_id INT NOT NULL, DROP parent_space_id, DROP level');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13A5FB14BA7 FOREIGN KEY (level_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13ABC9AFF91 FOREIGN KEY (level_id) REFERENCES space (id)');
        $this->addSql('CREATE INDEX IDX_2972C13A5FB14BA7 ON space (level_id)');
        $this->addSql('CREATE INDEX IDX_2972C13ABC9AFF91 ON space (level_id)');
    }
}

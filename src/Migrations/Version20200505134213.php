<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505134213 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element ADD bloc_id INT NOT NULL');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E395582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_41405E395582E9C0 ON element (bloc_id)');
        $this->addSql('ALTER TABLE message DROP INDEX FK_B6BD307FE9F4A451, ADD UNIQUE INDEX UNIQ_B6BD307FE9F4A451 (id_message_parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bloc DROP FOREIGN KEY FK_C778955AF6F093FE');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E395582E9C0');
        $this->addSql('DROP INDEX UNIQ_41405E395582E9C0 ON element');
        $this->addSql('ALTER TABLE element DROP bloc_id');
        $this->addSql('ALTER TABLE message DROP INDEX UNIQ_B6BD307FE9F4A451, ADD INDEX FK_B6BD307FE9F4A451 (id_message_parent_id)');
    }
}

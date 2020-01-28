<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128153845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, id_space_id INT NOT NULL, name VARCHAR(255) NOT NULL, ispublic TINYINT(1) NOT NULL, INDEX IDX_C0B9F90F738CBFD5 (id_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discussion_user (discussion_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A8FD7A7F1ADED311 (discussion_id), INDEX IDX_A8FD7A7FA76ED395 (user_id), PRIMARY KEY(discussion_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invitation (id INT AUTO_INCREMENT NOT NULL, id_invitator_id INT NOT NULL, id_space_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, email_dest JSON NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_F11D61A232E699DF (id_invitator_id), UNIQUE INDEX UNIQ_F11D61A2738CBFD5 (id_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_message_parent_id INT NOT NULL, id_discussion_id INT NOT NULL, content LONGTEXT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, INDEX IDX_B6BD307F79F37AE5 (id_user_id), UNIQUE INDEX UNIQ_B6BD307FE9F4A451 (id_message_parent_id), INDEX IDX_B6BD307FA4F60274 (id_discussion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F738CBFD5 FOREIGN KEY (id_space_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE discussion_user ADD CONSTRAINT FK_A8FD7A7F1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discussion_user ADD CONSTRAINT FK_A8FD7A7FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A232E699DF FOREIGN KEY (id_invitator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2738CBFD5 FOREIGN KEY (id_space_id) REFERENCES space (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE9F4A451 FOREIGN KEY (id_message_parent_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F60274 FOREIGN KEY (id_discussion_id) REFERENCES discussion (id)');
        $this->addSql('ALTER TABLE bloc ADD id_element_id INT NOT NULL, ADD id_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bloc ADD CONSTRAINT FK_C778955ABA95AAF3 FOREIGN KEY (id_element_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE bloc ADD CONSTRAINT FK_C778955AF6F093FE FOREIGN KEY (id_message_id) REFERENCES message (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C778955ABA95AAF3 ON bloc (id_element_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C778955AF6F093FE ON bloc (id_message_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE discussion_user DROP FOREIGN KEY FK_A8FD7A7F1ADED311');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F60274');
        $this->addSql('ALTER TABLE bloc DROP FOREIGN KEY FK_C778955AF6F093FE');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE9F4A451');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE discussion_user');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE message');
        $this->addSql('ALTER TABLE bloc DROP FOREIGN KEY FK_C778955ABA95AAF3');
        $this->addSql('DROP INDEX UNIQ_C778955ABA95AAF3 ON bloc');
        $this->addSql('DROP INDEX UNIQ_C778955AF6F093FE ON bloc');
        $this->addSql('ALTER TABLE bloc DROP id_element_id, DROP id_message_id');
    }
}

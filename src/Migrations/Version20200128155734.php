<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128155734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_bloc (categorie_id INT NOT NULL, bloc_id INT NOT NULL, INDEX IDX_B051120DBCF5E72D (categorie_id), INDEX IDX_B051120D5582E9C0 (bloc_id), PRIMARY KEY(categorie_id, bloc_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, id_bloc_id INT NOT NULL, id_user_id INT NOT NULL, id_comment_parent_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME DEFAULT NULL, INDEX IDX_9474526C8B1F40B0 (id_bloc_id), INDEX IDX_9474526C79F37AE5 (id_user_id), INDEX IDX_9474526C6A334331 (id_comment_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_bloc_id INT DEFAULT NULL, id_cat_id INT DEFAULT NULL, INDEX IDX_8933C43279F37AE5 (id_user_id), UNIQUE INDEX UNIQ_8933C4328B1F40B0 (id_bloc_id), UNIQUE INDEX UNIQ_8933C432C09A1CAE (id_cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, id_owner_id INT NOT NULL, id_cat_id INT DEFAULT NULL, id_space_id INT DEFAULT NULL, INDEX IDX_A3C664D32EE78D6C (id_owner_id), INDEX IDX_A3C664D3C09A1CAE (id_cat_id), INDEX IDX_A3C664D3738CBFD5 (id_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_bloc ADD CONSTRAINT FK_B051120DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_bloc ADD CONSTRAINT FK_B051120D5582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C8B1F40B0 FOREIGN KEY (id_bloc_id) REFERENCES bloc (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6A334331 FOREIGN KEY (id_comment_parent_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43279F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4328B1F40B0 FOREIGN KEY (id_bloc_id) REFERENCES bloc (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432C09A1CAE FOREIGN KEY (id_cat_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D32EE78D6C FOREIGN KEY (id_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3C09A1CAE FOREIGN KEY (id_cat_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3738CBFD5 FOREIGN KEY (id_space_id) REFERENCES space (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6A334331');
        $this->addSql('DROP TABLE categorie_bloc');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE subscription');
    }
}

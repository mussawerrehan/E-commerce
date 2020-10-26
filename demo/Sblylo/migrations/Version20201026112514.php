<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026112514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_specs (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FD731674584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historic (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, command_nbr VARCHAR(255) NOT NULL, nbr_product INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_AD52EF56A76ED395 (user_id), INDEX IDX_AD52EF564584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_user (id INT AUTO_INCREMENT NOT NULL, society_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, cellphone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D4F804C7E6389D24 (society_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_16DB4F894584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, sub_categories_product_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_B3BA5A5A30E09E43 (sub_categories_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specs (id INT AUTO_INCREMENT NOT NULL, categorie_specs_id INT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_DAAFDCB7F533587F (categorie_specs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_categories (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_1638D5A5A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_categories_product (id INT AUTO_INCREMENT NOT NULL, sub_categorie_id INT NOT NULL, INDEX IDX_BBDDC738ABA7A01B (sub_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_specs ADD CONSTRAINT FK_2FD731674584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE historic ADD CONSTRAINT FK_AD52EF56A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE historic ADD CONSTRAINT FK_AD52EF564584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7E6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F894584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A30E09E43 FOREIGN KEY (sub_categories_product_id) REFERENCES sub_categories_product (id)');
        $this->addSql('ALTER TABLE specs ADD CONSTRAINT FK_DAAFDCB7F533587F FOREIGN KEY (categorie_specs_id) REFERENCES categorie_specs (id)');
        $this->addSql('ALTER TABLE sub_categories ADD CONSTRAINT FK_1638D5A5A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE sub_categories_product ADD CONSTRAINT FK_BBDDC738ABA7A01B FOREIGN KEY (sub_categorie_id) REFERENCES sub_categories (id)');
        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE user ADD info_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64925ABFA0B FOREIGN KEY (info_user_id) REFERENCES info_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64925ABFA0B ON user (info_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specs DROP FOREIGN KEY FK_DAAFDCB7F533587F');
        $this->addSql('ALTER TABLE sub_categories DROP FOREIGN KEY FK_1638D5A5A21214B7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64925ABFA0B');
        $this->addSql('ALTER TABLE categorie_specs DROP FOREIGN KEY FK_2FD731674584665A');
        $this->addSql('ALTER TABLE historic DROP FOREIGN KEY FK_AD52EF564584665A');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F894584665A');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7E6389D24');
        $this->addSql('ALTER TABLE sub_categories_product DROP FOREIGN KEY FK_BBDDC738ABA7A01B');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A30E09E43');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE categorie_specs');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE historic');
        $this->addSql('DROP TABLE info_user');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE specs');
        $this->addSql('DROP TABLE sub_categories');
        $this->addSql('DROP TABLE sub_categories_product');
        $this->addSql('DROP INDEX UNIQ_8D93D64925ABFA0B ON user');
        $this->addSql('ALTER TABLE user DROP info_user_id');
    }
}

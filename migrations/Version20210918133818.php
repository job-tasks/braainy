<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210918133818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, organization_id VARCHAR(255) NOT NULL, created_time DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, country_id VARCHAR(255) NOT NULL, street VARCHAR(255) DEFAULT NULL, city_id VARCHAR(255) DEFAULT NULL, city_text VARCHAR(255) DEFAULT NULL, state_id VARCHAR(255) DEFAULT NULL, state_text VARCHAR(255) DEFAULT NULL, zipcode_id VARCHAR(255) DEFAULT NULL, zipcode_text VARCHAR(255) DEFAULT NULL, contact_no VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, currency_id VARCHAR(255) DEFAULT NULL, registration_no VARCHAR(255) DEFAULT NULL, eam VARCHAR(255) DEFAULT NULL, locale_id VARCHAR(255) DEFAULT NULL, is_customer TINYINT(1) NOT NULL, is_supplier TINYINT(1) NOT NULL, payment_terms_mode VARCHAR(255) DEFAULT NULL, payment_terms_days INT DEFAULT NULL, access_code VARCHAR(255) DEFAULT NULL, email_attachment_delivery_mode VARCHAR(255) DEFAULT NULL, is_archived TINYINT(1) NOT NULL, is_sales_tax_exempt TINYINT(1) NOT NULL, default_expense_product_description VARCHAR(255) DEFAULT NULL, default_expense_account_id VARCHAR(255) DEFAULT NULL, default_tax_rate_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, billy_id VARCHAR(255) NOT NULL, organization_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, account_id VARCHAR(255) NOT NULL, product_no VARCHAR(255) DEFAULT NULL, suppliers_product_no VARCHAR(255) DEFAULT NULL, sales_tax_ruleset_id VARCHAR(255) NOT NULL, is_archived TINYINT(1) NOT NULL, is_in_inventory TINYINT(1) NOT NULL, image_id VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, external_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE users');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513144714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill_details (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, orderdate VARCHAR(255) DEFAULT NULL, total_amout VARCHAR(255) NOT NULL, INDEX IDX_86E53F959395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bills (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, inventory_id INT DEFAULT NULL, quantity VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, total_price VARCHAR(255) DEFAULT NULL, buy_price VARCHAR(255) DEFAULT NULL, profit VARCHAR(255) DEFAULT NULL, INDEX IDX_22775DD04584665A (product_id), INDEX IDX_22775DD09EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill_details ADD CONSTRAINT FK_86E53F959395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE bills ADD CONSTRAINT FK_22775DD04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE bills ADD CONSTRAINT FK_22775DD09EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517444584665A');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744CFFE9AD6');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE orders');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, orders_id INT DEFAULT NULL, quantity VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, rate VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, amount VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_906517444584665A (product_id), INDEX IDX_90651744CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, orderdate VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, total_amout VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E52FFDEE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517444584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE bill_details DROP FOREIGN KEY FK_86E53F959395C3F3');
        $this->addSql('ALTER TABLE bills DROP FOREIGN KEY FK_22775DD04584665A');
        $this->addSql('ALTER TABLE bills DROP FOREIGN KEY FK_22775DD09EEA759');
        $this->addSql('DROP TABLE bill_details');
        $this->addSql('DROP TABLE bills');
    }
}

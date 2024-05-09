<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508134952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, quantitys_id INT DEFAULT NULL, company_id INT DEFAULT NULL, quantity VARCHAR(255) DEFAULT NULL, buying_price VARCHAR(255) DEFAULT NULL, selin_price VARCHAR(255) DEFAULT NULL, INDEX IDX_B12D4A364584665A (product_id), INDEX IDX_B12D4A3653048858 (quantitys_id), INDEX IDX_B12D4A36979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A364584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3653048858 FOREIGN KEY (quantitys_id) REFERENCES quantity_type (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36979B1AD6 FOREIGN KEY (company_id) REFERENCES refcompany (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A364584665A');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A3653048858');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36979B1AD6');
        $this->addSql('DROP TABLE inventory');
    }
}

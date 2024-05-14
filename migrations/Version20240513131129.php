<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513131129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E097E8B4AFC');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A3653048858');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD7E8B4AFC');
        $this->addSql('ALTER TABLE quantity_type DROP FOREIGN KEY FK_CBB3390B979B1AD6');
        $this->addSql('DROP TABLE quantity_type');
        $this->addSql('DROP INDEX IDX_81398E097E8B4AFC ON customer');
        $this->addSql('ALTER TABLE customer DROP quantity_id');
        $this->addSql('DROP INDEX IDX_B12D4A3653048858 ON inventory');
        $this->addSql('ALTER TABLE inventory DROP quantitys_id');
        $this->addSql('DROP INDEX IDX_D34A04AD7E8B4AFC ON product');
        $this->addSql('ALTER TABLE product ADD quantity VARCHAR(255) DEFAULT NULL, ADD mesarment VARCHAR(255) DEFAULT NULL, ADD units VARCHAR(255) DEFAULT NULL, ADD buying_price VARCHAR(255) DEFAULT NULL, ADD gst VARCHAR(255) DEFAULT NULL, ADD cgst VARCHAR(255) DEFAULT NULL, ADD sgst VARCHAR(255) DEFAULT NULL, DROP quantity_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantity_type (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, quantity_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, meserment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, units VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, price VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CBB3390B979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quantity_type ADD CONSTRAINT FK_CBB3390B979B1AD6 FOREIGN KEY (company_id) REFERENCES refcompany (id)');
        $this->addSql('ALTER TABLE customer ADD quantity_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E097E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_81398E097E8B4AFC ON customer (quantity_id)');
        $this->addSql('ALTER TABLE inventory ADD quantitys_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3653048858 FOREIGN KEY (quantitys_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_B12D4A3653048858 ON inventory (quantitys_id)');
        $this->addSql('ALTER TABLE product ADD quantity_id INT DEFAULT NULL, DROP quantity, DROP mesarment, DROP units, DROP buying_price, DROP gst, DROP cgst, DROP sgst');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD7E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD7E8B4AFC ON product (quantity_id)');
    }
}

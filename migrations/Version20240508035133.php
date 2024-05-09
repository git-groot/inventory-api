<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508035133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantity_type (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, quantity_name VARCHAR(255) DEFAULT NULL, meserment VARCHAR(255) DEFAULT NULL, units VARCHAR(255) DEFAULT NULL, prices VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_CBB3390B979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantity_type ADD CONSTRAINT FK_CBB3390B979B1AD6 FOREIGN KEY (company_id) REFERENCES refcompany (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_type DROP FOREIGN KEY FK_CBB3390B979B1AD6');
        $this->addSql('DROP TABLE quantity_type');
    }
}

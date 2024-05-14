<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514035211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill_details ADD bill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bill_details ADD CONSTRAINT FK_86E53F951A8C12F5 FOREIGN KEY (bill_id) REFERENCES bills (id)');
        $this->addSql('CREATE INDEX IDX_86E53F951A8C12F5 ON bill_details (bill_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill_details DROP FOREIGN KEY FK_86E53F951A8C12F5');
        $this->addSql('DROP INDEX IDX_86E53F951A8C12F5 ON bill_details');
        $this->addSql('ALTER TABLE bill_details DROP bill_id');
    }
}

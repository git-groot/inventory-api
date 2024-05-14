<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240511113315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD31C72602');
        $this->addSql('DROP INDEX IDX_D34A04AD31C72602 ON product');
        $this->addSql('ALTER TABLE product CHANGE quantitytype_id quantity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD7E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD7E8B4AFC ON product (quantity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD7E8B4AFC');
        $this->addSql('DROP INDEX IDX_D34A04AD7E8B4AFC ON product');
        $this->addSql('ALTER TABLE product CHANGE quantity_id quantitytype_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD31C72602 FOREIGN KEY (quantitytype_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD31C72602 ON product (quantitytype_id)');
    }
}

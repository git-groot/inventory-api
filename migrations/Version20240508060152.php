<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508060152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_type ADD product_id INT DEFAULT NULL, CHANGE prices price VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE quantity_type ADD CONSTRAINT FK_CBB3390B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_CBB3390B4584665A ON quantity_type (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_type DROP FOREIGN KEY FK_CBB3390B4584665A');
        $this->addSql('DROP INDEX IDX_CBB3390B4584665A ON quantity_type');
        $this->addSql('ALTER TABLE quantity_type DROP product_id, CHANGE price prices VARCHAR(255) DEFAULT NULL');
    }
}

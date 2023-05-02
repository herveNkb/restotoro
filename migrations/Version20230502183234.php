<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502183234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE openings ADD opening_morning VARCHAR(25) NOT NULL, ADD opening_afternoon VARCHAR(25) NOT NULL, DROP opening_open, DROP opening_close');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE openings ADD opening_open VARCHAR(25) NOT NULL, ADD opening_close VARCHAR(25) NOT NULL, DROP opening_morning, DROP opening_afternoon');
    }
}

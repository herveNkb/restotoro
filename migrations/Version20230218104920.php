<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218104920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_727508CF67B3B43D ON menus (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CF67B3B43D');
        $this->addSql('DROP INDEX IDX_727508CF67B3B43D ON menus');
        $this->addSql('ALTER TABLE menus DROP users_id');
    }
}

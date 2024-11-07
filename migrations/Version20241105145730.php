<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105145730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv_user ADD convs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conv_user ADD CONSTRAINT FK_9A4A93F3E25E2C28 FOREIGN KEY (convs_id) REFERENCES conv (id)');
        $this->addSql('CREATE INDEX IDX_9A4A93F3E25E2C28 ON conv_user (convs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv_user DROP FOREIGN KEY FK_9A4A93F3E25E2C28');
        $this->addSql('DROP INDEX IDX_9A4A93F3E25E2C28 ON conv_user');
        $this->addSql('ALTER TABLE conv_user DROP convs_id');
    }
}

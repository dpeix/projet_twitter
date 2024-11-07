<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105145637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CC1DA67974');
        $this->addSql('DROP INDEX IDX_94499CC1DA67974 ON conv');
        $this->addSql('ALTER TABLE conv DROP conv_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv ADD conv_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CC1DA67974 FOREIGN KEY (conv_user_id) REFERENCES conv_user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_94499CC1DA67974 ON conv (conv_user_id)');
    }
}

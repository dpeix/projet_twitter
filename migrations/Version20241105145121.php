<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105145121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conv_user (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, date_last_check DATETIME DEFAULT NULL, INDEX IDX_9A4A93F367B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conv_user ADD CONSTRAINT FK_9A4A93F367B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conv ADD conv_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CC1DA67974 FOREIGN KEY (conv_user_id) REFERENCES conv_user (id)');
        $this->addSql('CREATE INDEX IDX_94499CC1DA67974 ON conv (conv_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CC1DA67974');
        $this->addSql('ALTER TABLE conv_user DROP FOREIGN KEY FK_9A4A93F367B3B43D');
        $this->addSql('DROP TABLE conv_user');
        $this->addSql('DROP INDEX IDX_94499CC1DA67974 ON conv');
        $this->addSql('ALTER TABLE conv DROP conv_user_id');
    }
}

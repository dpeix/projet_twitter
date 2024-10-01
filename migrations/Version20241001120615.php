<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241001120615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant_conv (id INT AUTO_INCREMENT NOT NULL, date_last_seen DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conv ADD participant_conv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CCB5CBD1CF FOREIGN KEY (participant_conv_id) REFERENCES participant_conv (id)');
        $this->addSql('CREATE INDEX IDX_94499CCB5CBD1CF ON conv (participant_conv_id)');
        $this->addSql('ALTER TABLE participant ADD participant_conv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B5CBD1CF FOREIGN KEY (participant_conv_id) REFERENCES participant_conv (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11B5CBD1CF ON participant (participant_conv_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CCB5CBD1CF');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11B5CBD1CF');
        $this->addSql('DROP TABLE participant_conv');
        $this->addSql('DROP INDEX IDX_D79F6B11B5CBD1CF ON participant');
        $this->addSql('ALTER TABLE participant DROP participant_conv_id');
        $this->addSql('DROP INDEX IDX_94499CCB5CBD1CF ON conv');
        $this->addSql('ALTER TABLE conv DROP participant_conv_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105135424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CCB5CBD1CF');
        $this->addSql('ALTER TABLE participant_conv DROP FOREIGN KEY FK_DDF08BF2838709D5');
        $this->addSql('ALTER TABLE participant_conv DROP FOREIGN KEY FK_DDF08BF2E25E2C28');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11A76ED395');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11B5CBD1CF');
        $this->addSql('DROP TABLE participant_conv');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP INDEX IDX_94499CCB5CBD1CF ON conv');
        $this->addSql('ALTER TABLE conv DROP participant_conv_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant_conv (id INT AUTO_INCREMENT NOT NULL, participants_id INT DEFAULT NULL, convs_id INT DEFAULT NULL, date_last_seen DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DDF08BF2E25E2C28 (convs_id), INDEX IDX_DDF08BF2838709D5 (participants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, participant_conv_id INT DEFAULT NULL, date_last_check DATETIME NOT NULL, INDEX IDX_D79F6B11B5CBD1CF (participant_conv_id), INDEX IDX_D79F6B11A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participant_conv ADD CONSTRAINT FK_DDF08BF2838709D5 FOREIGN KEY (participants_id) REFERENCES participant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE participant_conv ADD CONSTRAINT FK_DDF08BF2E25E2C28 FOREIGN KEY (convs_id) REFERENCES conv (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B5CBD1CF FOREIGN KEY (participant_conv_id) REFERENCES participant_conv (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE conv ADD participant_conv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CCB5CBD1CF FOREIGN KEY (participant_conv_id) REFERENCES participant_conv (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_94499CCB5CBD1CF ON conv (participant_conv_id)');
    }
}

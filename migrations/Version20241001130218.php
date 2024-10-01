<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241001130218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant_conv ADD participants_id INT DEFAULT NULL, ADD convs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant_conv ADD CONSTRAINT FK_DDF08BF2838709D5 FOREIGN KEY (participants_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE participant_conv ADD CONSTRAINT FK_DDF08BF2E25E2C28 FOREIGN KEY (convs_id) REFERENCES conv (id)');
        $this->addSql('CREATE INDEX IDX_DDF08BF2838709D5 ON participant_conv (participants_id)');
        $this->addSql('CREATE INDEX IDX_DDF08BF2E25E2C28 ON participant_conv (convs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant_conv DROP FOREIGN KEY FK_DDF08BF2838709D5');
        $this->addSql('ALTER TABLE participant_conv DROP FOREIGN KEY FK_DDF08BF2E25E2C28');
        $this->addSql('DROP INDEX IDX_DDF08BF2838709D5 ON participant_conv');
        $this->addSql('DROP INDEX IDX_DDF08BF2E25E2C28 ON participant_conv');
        $this->addSql('ALTER TABLE participant_conv DROP participants_id, DROP convs_id');
    }
}

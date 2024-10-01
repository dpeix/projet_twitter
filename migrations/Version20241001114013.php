<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241001114013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant_conv DROP FOREIGN KEY FK_DDF08BF22FC61EC7');
        $this->addSql('ALTER TABLE participant_conv DROP FOREIGN KEY FK_DDF08BF29D1C3019');
        $this->addSql('DROP TABLE participant_conv');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant_conv (participant_id INT NOT NULL, conv_id INT NOT NULL, INDEX IDX_DDF08BF22FC61EC7 (conv_id), INDEX IDX_DDF08BF29D1C3019 (participant_id), PRIMARY KEY(participant_id, conv_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participant_conv ADD CONSTRAINT FK_DDF08BF22FC61EC7 FOREIGN KEY (conv_id) REFERENCES conv (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant_conv ADD CONSTRAINT FK_DDF08BF29D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}

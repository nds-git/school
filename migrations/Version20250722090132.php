<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250722090132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD max_speak_point INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD max_audio_point INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise DROP speak_point');
        $this->addSql('ALTER TABLE exercise DROP audio_point');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD speak_point INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD audio_point INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise DROP max_speak_point');
        $this->addSql('ALTER TABLE exercise DROP max_audio_point');
    }
}

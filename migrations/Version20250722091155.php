<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250722091155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise_user_point (id BIGINT GENERATED BY DEFAULT AS IDENTITY NOT NULL, user_id BIGINT DEFAULT NULL, ex_speak_point INT DEFAULT NULL, ex_audio_point INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX exercise_user_point__user_id__idx ON exercise_user_point (user_id)');
        $this->addSql('ALTER TABLE exercise_user_point ADD CONSTRAINT exercise_user_point__user_id__fk FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_user_point DROP CONSTRAINT exercise_user_point__user_id__fk');
        $this->addSql('DROP TABLE exercise_user_point');
    }
}

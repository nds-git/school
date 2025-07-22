<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250722101018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_user_point ADD exercise_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercise_user_point ADD ex_teacher_comment TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise_user_point ADD is_verified SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_user_point DROP exercise_id');
        $this->addSql('ALTER TABLE exercise_user_point DROP ex_teacher_comment');
        $this->addSql('ALTER TABLE exercise_user_point DROP is_verified');
    }
}

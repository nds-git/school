<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250714121656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_course (user_id BIGINT NOT NULL, course_id BIGINT NOT NULL, PRIMARY KEY(user_id, course_id))');
        $this->addSql('CREATE INDEX user_course__user_id__idx ON user_course (user_id)');
        $this->addSql('CREATE INDEX user_course__course_id__idx ON user_course (course_id)');
        $this->addSql('ALTER TABLE user_course ADD CONSTRAINT user_course__user_id__fk FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_course ADD CONSTRAINT user_course__course_id__fk FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_course DROP CONSTRAINT user_course__user_id__fk');
        $this->addSql('ALTER TABLE user_course DROP CONSTRAINT user_course__course_id__fk');
        $this->addSql('DROP TABLE user_course');
    }
}

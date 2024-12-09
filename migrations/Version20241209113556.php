<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209113556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA754177093');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA770FBD26D');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA754177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA770FBD26D FOREIGN KEY (animator_id) REFERENCES animator (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA754177093');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA770FBD26D');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA754177093 FOREIGN KEY (room_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA770FBD26D FOREIGN KEY (animator_id) REFERENCES animator (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}

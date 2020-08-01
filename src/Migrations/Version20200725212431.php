<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200725212431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association CHANGE association_type association_type enum(\'Association loi de 1901\', \'Association avec agrément\', \'Association d\\\'utilité publique\')');
        $this->addSql('ALTER TABLE task ADD member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB257597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_527EDB257597D3FE ON task (member_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association CHANGE association_type association_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB257597D3FE');
        $this->addSql('DROP INDEX IDX_527EDB257597D3FE ON task');
        $this->addSql('ALTER TABLE task DROP member_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716210243 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEEFCD7BE33');
        $this->addSql('DROP INDEX IDX_C95F6AEEFCD7BE33 ON advertisement');
        $this->addSql('ALTER TABLE advertisement DROP app_web_mobile_id');
        $this->addSql('ALTER TABLE app_web_mobile ADD advertisement_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_web_mobile ADD CONSTRAINT FK_7D1225DBA1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D1225DBA1FBF71B ON app_web_mobile (advertisement_id)');
        $this->addSql('ALTER TABLE association CHANGE association_type association_type enum(\'Association loi de 1901\', \'Association avec agrément\', \'Association d\\\'utilité publique\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisement ADD app_web_mobile_id INT NOT NULL');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEEFCD7BE33 FOREIGN KEY (app_web_mobile_id) REFERENCES app_web_mobile (id)');
        $this->addSql('CREATE INDEX IDX_C95F6AEEFCD7BE33 ON advertisement (app_web_mobile_id)');
        $this->addSql('ALTER TABLE app_web_mobile DROP FOREIGN KEY FK_7D1225DBA1FBF71B');
        $this->addSql('DROP INDEX UNIQ_7D1225DBA1FBF71B ON app_web_mobile');
        $this->addSql('ALTER TABLE app_web_mobile DROP advertisement_id');
        $this->addSql('ALTER TABLE association CHANGE association_type association_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

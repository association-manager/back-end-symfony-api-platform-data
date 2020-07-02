<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200630211455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association CHANGE association_type association_type enum(\'Association loi de 1901\', \'Association avec agrément\', \'Association d\\\'utilité publique\')');
        $this->addSql('ALTER TABLE file_manager DROP FOREIGN KEY FK_A1429C82BAEFB368');
        $this->addSql('DROP INDEX IDX_A1429C82BAEFB368 ON file_manager');
        $this->addSql('ALTER TABLE file_manager DROP product_images_id');
        $this->addSql('ALTER TABLE product_website DROP FOREIGN KEY FK_96B64657D9E36DAD');
        $this->addSql('ALTER TABLE product_website DROP FOREIGN KEY FK_96B64657E4873418');
        $this->addSql('DROP INDEX UNIQ_96B64657D9E36DAD ON product_website');
        $this->addSql('DROP INDEX UNIQ_96B64657E4873418 ON product_website');
        $this->addSql('ALTER TABLE product_website ADD logo VARCHAR(45) NOT NULL, DROP main_image_id, DROP main_image_thumbnail_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association CHANGE association_type association_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE file_manager ADD product_images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_manager ADD CONSTRAINT FK_A1429C82BAEFB368 FOREIGN KEY (product_images_id) REFERENCES product_website (id)');
        $this->addSql('CREATE INDEX IDX_A1429C82BAEFB368 ON file_manager (product_images_id)');
        $this->addSql('ALTER TABLE product_website ADD main_image_id INT NOT NULL, ADD main_image_thumbnail_id INT DEFAULT NULL, DROP logo');
        $this->addSql('ALTER TABLE product_website ADD CONSTRAINT FK_96B64657D9E36DAD FOREIGN KEY (main_image_thumbnail_id) REFERENCES file_manager (id)');
        $this->addSql('ALTER TABLE product_website ADD CONSTRAINT FK_96B64657E4873418 FOREIGN KEY (main_image_id) REFERENCES file_manager (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_96B64657D9E36DAD ON product_website (main_image_thumbnail_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_96B64657E4873418 ON product_website (main_image_id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715141145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ad_management_notification (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(45) NOT NULL, content VARCHAR(255) NOT NULL, is_sender TINYINT(1) DEFAULT NULL, is_reciever TINYINT(1) DEFAULT NULL, send_date DATETIME DEFAULT NULL, INDEX IDX_CC129603A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, app_web_mobile_id INT NOT NULL, title VARCHAR(45) DEFAULT NULL, details VARCHAR(255) DEFAULT NULL, status VARCHAR(45) DEFAULT NULL, INDEX IDX_C95F6AEEA76ED395 (user_id), INDEX IDX_C95F6AEEFCD7BE33 (app_web_mobile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisement_category (advertisement_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_78296C89A1FBF71B (advertisement_id), INDEX IDX_78296C8912469DE2 (category_id), PRIMARY KEY(advertisement_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisement_visitor_service_platform (advertisement_id INT NOT NULL, visitor_service_platform_id INT NOT NULL, INDEX IDX_C6773B59A1FBF71B (advertisement_id), INDEX IDX_C6773B59E66B215C (visitor_service_platform_id), PRIMARY KEY(advertisement_id, visitor_service_platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_web_mobile (id INT AUTO_INCREMENT NOT NULL, web_page_url VARCHAR(255) DEFAULT NULL, web_page_url_title VARCHAR(45) DEFAULT NULL, mobile_screen VARCHAR(255) DEFAULT NULL, mobile_screen_title VARCHAR(45) DEFAULT NULL, date_of_demand DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, status VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitor_service_platform (id INT AUTO_INCREMENT NOT NULL, visited_time DATETIME DEFAULT NULL, visitor_number INT DEFAULT NULL, platform VARCHAR(255) NOT NULL, users_agent_information VARCHAR(255) DEFAULT NULL, ip_address VARCHAR(45) DEFAULT NULL, app_screen VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad_management_notification ADD CONSTRAINT FK_CC129603A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEEFCD7BE33 FOREIGN KEY (app_web_mobile_id) REFERENCES app_web_mobile (id)');
        $this->addSql('ALTER TABLE advertisement_category ADD CONSTRAINT FK_78296C89A1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advertisement_category ADD CONSTRAINT FK_78296C8912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advertisement_visitor_service_platform ADD CONSTRAINT FK_C6773B59A1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advertisement_visitor_service_platform ADD CONSTRAINT FK_C6773B59E66B215C FOREIGN KEY (visitor_service_platform_id) REFERENCES visitor_service_platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association CHANGE association_type association_type enum(\'Association loi de 1901\', \'Association avec agrément\', \'Association d\\\'utilité publique\')');
        $this->addSql('ALTER TABLE category ADD details VARCHAR(255) DEFAULT NULL, ADD sub_type VARCHAR(45) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisement_category DROP FOREIGN KEY FK_78296C89A1FBF71B');
        $this->addSql('ALTER TABLE advertisement_visitor_service_platform DROP FOREIGN KEY FK_C6773B59A1FBF71B');
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEEFCD7BE33');
        $this->addSql('ALTER TABLE advertisement_visitor_service_platform DROP FOREIGN KEY FK_C6773B59E66B215C');
        $this->addSql('DROP TABLE ad_management_notification');
        $this->addSql('DROP TABLE advertisement');
        $this->addSql('DROP TABLE advertisement_category');
        $this->addSql('DROP TABLE advertisement_visitor_service_platform');
        $this->addSql('DROP TABLE app_web_mobile');
        $this->addSql('DROP TABLE visitor_service_platform');
        $this->addSql('ALTER TABLE association CHANGE association_type association_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category DROP details, DROP sub_type');
    }
}

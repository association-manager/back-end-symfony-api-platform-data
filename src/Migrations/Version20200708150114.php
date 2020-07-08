<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200708150114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, association_id INT DEFAULT NULL, invoice_shop_id INT DEFAULT NULL, invoice_donation_id INT DEFAULT NULL, address_line1 VARCHAR(255) DEFAULT NULL, address_line2 VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, city VARCHAR(45) DEFAULT NULL, country VARCHAR(45) DEFAULT NULL, type VARCHAR(45) DEFAULT NULL, INDEX IDX_D4E6F81A76ED395 (user_id), INDEX IDX_D4E6F81EFB9C8A5 (association_id), INDEX IDX_D4E6F81BFCFF20E (invoice_shop_id), INDEX IDX_D4E6F815A8F45AF (invoice_donation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_manager_event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_manager_event_planning (asso_manager_event_id INT NOT NULL, planning_id INT NOT NULL, INDEX IDX_D025175AF203678F (asso_manager_event_id), INDEX IDX_D025175A3D865311 (planning_id), PRIMARY KEY(asso_manager_event_id, planning_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, association_profile_id INT DEFAULT NULL, created_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, data_usage_agreement TINYINT(1) DEFAULT \'0\', association_type enum(\'Association loi de 1901\', \'Association avec agrément\', \'Association d\\\'utilité publique\'), phone_number VARCHAR(15) DEFAULT NULL, mobile VARCHAR(15) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(150) NOT NULL, last_name VARCHAR(150) NOT NULL, assembly_constituve_date DATETIME NOT NULL, founded_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_FD8521CCEC317002 (association_profile_id), INDEX IDX_FD8521CCB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_member (association_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_4390CF0FEFB9C8A5 (association_id), INDEX IDX_4390CF0F7597D3FE (member_id), PRIMARY KEY(association_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_profile (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, description_title VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, type VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donation (id INT AUTO_INCREMENT NOT NULL, member_id INT DEFAULT NULL, amount NUMERIC(10, 4) NOT NULL, mensuality SMALLINT NOT NULL, tax_deduction_percentage NUMERIC(10, 4) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_31E581A07597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_manager (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, association_id INT DEFAULT NULL, type VARCHAR(45) NOT NULL, text VARCHAR(255) NOT NULL, url LONGTEXT DEFAULT NULL, status SMALLINT DEFAULT NULL, created_at DATETIME NOT NULL, name VARCHAR(150) DEFAULT NULL, size VARCHAR(150) NOT NULL, INDEX IDX_A1429C82B03A8386 (created_by_id), INDEX IDX_A1429C82EFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_donation (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, total_amount DOUBLE PRECISION NOT NULL, total_after_deduction DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_shop (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, vat DOUBLE PRECISION NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, profile LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', responsibility VARCHAR(150) DEFAULT NULL, date_of_entry DATETIME DEFAULT NULL, INDEX IDX_70E4FA789D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_staff (member_id INT NOT NULL, staff_id INT NOT NULL, INDEX IDX_204F66617597D3FE (member_id), INDEX IDX_204F6661D4D57CD (staff_id), PRIMARY KEY(member_id, staff_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_task_work_group_relation (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, task_id INT NOT NULL, work_group_id INT NOT NULL, INDEX IDX_15DA80237597D3FE (member_id), INDEX IDX_15DA80238DB60186 (task_id), INDEX IDX_15DA80232BE1531B (work_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE networks_social_link (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, website VARCHAR(255) NOT NULL, name VARCHAR(150) NOT NULL, icon VARCHAR(45) NOT NULL, INDEX IDX_6BB6DD0DEFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, color VARCHAR(255) DEFAULT NULL, INDEX IDX_D499BFF6EFB9C8A5 (association_id), INDEX IDX_D499BFF612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_website (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, planning_id INT DEFAULT NULL, work_group_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, status TINYINT(1) DEFAULT NULL, project_type VARCHAR(45) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2FB3D0EE3D865311 (planning_id), INDEX IDX_2FB3D0EE2BE1531B (work_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_planning (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, start_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, INDEX IDX_E9D7342D166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, data_usage_agreement SMALLINT DEFAULT NULL, association_type VARCHAR(45) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, project_planning_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, start_date DATETIME DEFAULT NULL, end_date DATETIME DEFAULT NULL, type VARCHAR(45) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_527EDB25F549A4EA (project_planning_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, category_id INT NOT NULL, type VARCHAR(45) NOT NULL, date DATETIME NOT NULL, details LONGTEXT NOT NULL, amount NUMERIC(10, 4) NOT NULL, status SMALLINT NOT NULL, INDEX IDX_723705D1EFB9C8A5 (association_id), INDEX IDX_723705D112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, updated_by_id INT DEFAULT NULL, validated_by_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, data_usage_agreement TINYINT(1) DEFAULT \'0\' NOT NULL, mobile VARCHAR(20) DEFAULT NULL, validated_at DATETIME DEFAULT NULL, sex VARCHAR(10) DEFAULT NULL, dob DATE DEFAULT NULL, password_reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649896DBBDE (updated_by_id), INDEX IDX_8D93D649C69DE5E5 (validated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `work_group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_group_association (work_group_id INT NOT NULL, association_id INT NOT NULL, INDEX IDX_BE1EF8E62BE1531B (work_group_id), INDEX IDX_BE1EF8E6EFB9C8A5 (association_id), PRIMARY KEY(work_group_id, association_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81BFCFF20E FOREIGN KEY (invoice_shop_id) REFERENCES invoice_shop (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F815A8F45AF FOREIGN KEY (invoice_donation_id) REFERENCES invoice_donation (id)');
        $this->addSql('ALTER TABLE asso_manager_event_planning ADD CONSTRAINT FK_D025175AF203678F FOREIGN KEY (asso_manager_event_id) REFERENCES asso_manager_event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asso_manager_event_planning ADD CONSTRAINT FK_D025175A3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCEC317002 FOREIGN KEY (association_profile_id) REFERENCES association_profile (id)');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE association_member ADD CONSTRAINT FK_4390CF0FEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_member ADD CONSTRAINT FK_4390CF0F7597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A07597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE file_manager ADD CONSTRAINT FK_A1429C82B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE file_manager ADD CONSTRAINT FK_A1429C82EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA789D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE member_staff ADD CONSTRAINT FK_204F66617597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_staff ADD CONSTRAINT FK_204F6661D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_task_work_group_relation ADD CONSTRAINT FK_15DA80237597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE member_task_work_group_relation ADD CONSTRAINT FK_15DA80238DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE member_task_work_group_relation ADD CONSTRAINT FK_15DA80232BE1531B FOREIGN KEY (work_group_id) REFERENCES `work_group` (id)');
        $this->addSql('ALTER TABLE networks_social_link ADD CONSTRAINT FK_6BB6DD0DEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE2BE1531B FOREIGN KEY (work_group_id) REFERENCES `work_group` (id)');
        $this->addSql('ALTER TABLE project_planning ADD CONSTRAINT FK_E9D7342D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F549A4EA FOREIGN KEY (project_planning_id) REFERENCES project_planning (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C69DE5E5 FOREIGN KEY (validated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE work_group_association ADD CONSTRAINT FK_BE1EF8E62BE1531B FOREIGN KEY (work_group_id) REFERENCES `work_group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_group_association ADD CONSTRAINT FK_BE1EF8E6EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asso_manager_event_planning DROP FOREIGN KEY FK_D025175AF203678F');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81EFB9C8A5');
        $this->addSql('ALTER TABLE association_member DROP FOREIGN KEY FK_4390CF0FEFB9C8A5');
        $this->addSql('ALTER TABLE file_manager DROP FOREIGN KEY FK_A1429C82EFB9C8A5');
        $this->addSql('ALTER TABLE networks_social_link DROP FOREIGN KEY FK_6BB6DD0DEFB9C8A5');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6EFB9C8A5');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1EFB9C8A5');
        $this->addSql('ALTER TABLE work_group_association DROP FOREIGN KEY FK_BE1EF8E6EFB9C8A5');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCEC317002');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF612469DE2');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D112469DE2');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F815A8F45AF');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81BFCFF20E');
        $this->addSql('ALTER TABLE association_member DROP FOREIGN KEY FK_4390CF0F7597D3FE');
        $this->addSql('ALTER TABLE donation DROP FOREIGN KEY FK_31E581A07597D3FE');
        $this->addSql('ALTER TABLE member_staff DROP FOREIGN KEY FK_204F66617597D3FE');
        $this->addSql('ALTER TABLE member_task_work_group_relation DROP FOREIGN KEY FK_15DA80237597D3FE');
        $this->addSql('ALTER TABLE asso_manager_event_planning DROP FOREIGN KEY FK_D025175A3D865311');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE3D865311');
        $this->addSql('ALTER TABLE project_planning DROP FOREIGN KEY FK_E9D7342D166D1F9C');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25F549A4EA');
        $this->addSql('ALTER TABLE member_staff DROP FOREIGN KEY FK_204F6661D4D57CD');
        $this->addSql('ALTER TABLE member_task_work_group_relation DROP FOREIGN KEY FK_15DA80238DB60186');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCB03A8386');
        $this->addSql('ALTER TABLE file_manager DROP FOREIGN KEY FK_A1429C82B03A8386');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA789D86650F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649896DBBDE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C69DE5E5');
        $this->addSql('ALTER TABLE member_task_work_group_relation DROP FOREIGN KEY FK_15DA80232BE1531B');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE2BE1531B');
        $this->addSql('ALTER TABLE work_group_association DROP FOREIGN KEY FK_BE1EF8E62BE1531B');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE asso_manager_event');
        $this->addSql('DROP TABLE asso_manager_event_planning');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE association_member');
        $this->addSql('DROP TABLE association_profile');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE donation');
        $this->addSql('DROP TABLE file_manager');
        $this->addSql('DROP TABLE invoice_donation');
        $this->addSql('DROP TABLE invoice_shop');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE member_staff');
        $this->addSql('DROP TABLE member_task_work_group_relation');
        $this->addSql('DROP TABLE networks_social_link');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE product_website');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_planning');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE tutorial');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE `work_group`');
        $this->addSql('DROP TABLE work_group_association');
    }
}

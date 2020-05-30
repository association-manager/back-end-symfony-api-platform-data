<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200530181913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, association_id INT DEFAULT NULL, invoice_shop_id INT DEFAULT NULL, invoice_donation_id INT DEFAULT NULL, address_line1 VARCHAR(255) DEFAULT NULL, address_line2 VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, city VARCHAR(45) DEFAULT NULL, country VARCHAR(45) DEFAULT NULL, type VARCHAR(45) DEFAULT NULL, INDEX IDX_D4E6F81A76ED395 (user_id), INDEX IDX_D4E6F81EFB9C8A5 (association_id), INDEX IDX_D4E6F81BFCFF20E (invoice_shop_id), INDEX IDX_D4E6F815A8F45AF (invoice_donation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_member (association_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_4390CF0FEFB9C8A5 (association_id), INDEX IDX_4390CF0F7597D3FE (member_id), PRIMARY KEY(association_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_planning (event_id INT NOT NULL, planning_id INT NOT NULL, INDEX IDX_9275562671F7E88B (event_id), INDEX IDX_927556263D865311 (planning_id), PRIMARY KEY(event_id, planning_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_manager (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, association_id INT DEFAULT NULL, type VARCHAR(45) NOT NULL, text VARCHAR(255) NOT NULL, url LONGTEXT DEFAULT NULL, status SMALLINT DEFAULT NULL, s3key VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, name VARCHAR(150) DEFAULT NULL, size VARCHAR(150) NOT NULL, INDEX IDX_A1429C82B03A8386 (created_by_id), INDEX IDX_A1429C82EFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_donation (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, total_amount DOUBLE PRECISION NOT NULL, total_after_deduction DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_shop (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, vat INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, member_task_group_relation_id INT DEFAULT NULL, profile JSON DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_70E4FA789D86650F (user_id_id), INDEX IDX_70E4FA78EFB12C56 (member_task_group_relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_staff (member_id INT NOT NULL, staff_id INT NOT NULL, INDEX IDX_204F66617597D3FE (member_id), INDEX IDX_204F6661D4D57CD (staff_id), PRIMARY KEY(member_id, staff_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_task_group_relation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, data_usage_agreement SMALLINT DEFAULT NULL, association_type VARCHAR(45) NOT NULL, phone_number INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `work_group` (id INT AUTO_INCREMENT NOT NULL, member_task_group_relation_id INT DEFAULT NULL, work_group_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, INDEX IDX_453B3FEAEFB12C56 (member_task_group_relation_id), INDEX IDX_453B3FEA2BE1531B (work_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_group_association (work_group_id INT NOT NULL, association_id INT NOT NULL, INDEX IDX_BE1EF8E62BE1531B (work_group_id), INDEX IDX_BE1EF8E6EFB9C8A5 (association_id), PRIMARY KEY(work_group_id, association_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81BFCFF20E FOREIGN KEY (invoice_shop_id) REFERENCES invoice_shop (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F815A8F45AF FOREIGN KEY (invoice_donation_id) REFERENCES invoice_donation (id)');
        $this->addSql('ALTER TABLE association_member ADD CONSTRAINT FK_4390CF0FEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_member ADD CONSTRAINT FK_4390CF0F7597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_planning ADD CONSTRAINT FK_9275562671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_planning ADD CONSTRAINT FK_927556263D865311 FOREIGN KEY (planning_id) REFERENCES planning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_manager ADD CONSTRAINT FK_A1429C82B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE file_manager ADD CONSTRAINT FK_A1429C82EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA789D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78EFB12C56 FOREIGN KEY (member_task_group_relation_id) REFERENCES member_task_group_relation (id)');
        $this->addSql('ALTER TABLE member_staff ADD CONSTRAINT FK_204F66617597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE member_staff ADD CONSTRAINT FK_204F6661D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `work_group` ADD CONSTRAINT FK_453B3FEAEFB12C56 FOREIGN KEY (member_task_group_relation_id) REFERENCES member_task_group_relation (id)');
        $this->addSql('ALTER TABLE `work_group` ADD CONSTRAINT FK_453B3FEA2BE1531B FOREIGN KEY (work_group_id) REFERENCES `work_group` (id)');
        $this->addSql('ALTER TABLE work_group_association ADD CONSTRAINT FK_BE1EF8E62BE1531B FOREIGN KEY (work_group_id) REFERENCES `work_group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_group_association ADD CONSTRAINT FK_BE1EF8E6EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announce ADD file_manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE announce ADD CONSTRAINT FK_E6D6DD7593CB796C FOREIGN KEY (file_manager_id) REFERENCES file_manager (id)');
        $this->addSql('CREATE INDEX IDX_E6D6DD7593CB796C ON announce (file_manager_id)');
        $this->addSql('ALTER TABLE association ADD association_profile_id INT DEFAULT NULL, ADD created_by_id INT NOT NULL, DROP cgu, CHANGE data_usage_agreement data_usage_agreement TINYINT(1) DEFAULT NULL, CHANGE association_type association_type VARCHAR(45) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(15) DEFAULT NULL, CHANGE mobile mobile VARCHAR(15) DEFAULT NULL, CHANGE website website VARCHAR(255) DEFAULT NULL, CHANGE founded_at founded_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCEC317002 FOREIGN KEY (association_profile_id) REFERENCES association_profile (id)');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CCB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD8521CCEC317002 ON association (association_profile_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD8521CCB03A8386 ON association (created_by_id)');
        $this->addSql('ALTER TABLE donation ADD member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A07597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_31E581A07597D3FE ON donation (member_id)');
        $this->addSql('ALTER TABLE networks_social_link ADD association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE networks_social_link ADD CONSTRAINT FK_6BB6DD0DEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('CREATE INDEX IDX_6BB6DD0DEFB9C8A5 ON networks_social_link (association_id)');
        $this->addSql('ALTER TABLE planning ADD association_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL, CHANGE color color VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D499BFF6EFB9C8A5 ON planning (association_id)');
        $this->addSql('CREATE INDEX IDX_D499BFF612469DE2 ON planning (category_id)');
        $this->addSql('ALTER TABLE project ADD planning_id INT DEFAULT NULL, ADD work_group_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE status status TINYINT(1) DEFAULT NULL, CHANGE project_type project_type VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE2BE1531B FOREIGN KEY (work_group_id) REFERENCES `work_group` (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE3D865311 ON project (planning_id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE2BE1531B ON project (work_group_id)');
        $this->addSql('ALTER TABLE project_planning ADD project_id INT DEFAULT NULL, CHANGE name name VARCHAR(45) DEFAULT NULL, CHANGE start_at start_at DATETIME DEFAULT NULL, CHANGE end_at end_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE project_planning ADD CONSTRAINT FK_E9D7342D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_E9D7342D166D1F9C ON project_planning (project_id)');
        $this->addSql('ALTER TABLE task ADD member_task_group_relation_id INT DEFAULT NULL, ADD project_planning_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL, CHANGE type type VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25EFB12C56 FOREIGN KEY (member_task_group_relation_id) REFERENCES member_task_group_relation (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F549A4EA FOREIGN KEY (project_planning_id) REFERENCES project_planning (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25EFB12C56 ON task (member_task_group_relation_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25F549A4EA ON task (project_planning_id)');
        $this->addSql('ALTER TABLE transaction ADD association_id INT DEFAULT NULL, ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_723705D1EFB9C8A5 ON transaction (association_id)');
        $this->addSql('CREATE INDEX IDX_723705D112469DE2 ON transaction (category_id)');
        $this->addSql('ALTER TABLE user CHANGE updated_by_id updated_by_id INT DEFAULT NULL, CHANGE validated_by_id validated_by_id INT DEFAULT NULL, CHANGE validated_at validated_at DATETIME DEFAULT NULL, CHANGE sex sex VARCHAR(10) DEFAULT NULL, CHANGE dob dob DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE announce DROP FOREIGN KEY FK_E6D6DD7593CB796C');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F815A8F45AF');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81BFCFF20E');
        $this->addSql('ALTER TABLE association_member DROP FOREIGN KEY FK_4390CF0F7597D3FE');
        $this->addSql('ALTER TABLE donation DROP FOREIGN KEY FK_31E581A07597D3FE');
        $this->addSql('ALTER TABLE member_staff DROP FOREIGN KEY FK_204F66617597D3FE');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78EFB12C56');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25EFB12C56');
        $this->addSql('ALTER TABLE `work_group` DROP FOREIGN KEY FK_453B3FEAEFB12C56');
        $this->addSql('ALTER TABLE member_staff DROP FOREIGN KEY FK_204F6661D4D57CD');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE2BE1531B');
        $this->addSql('ALTER TABLE `work_group` DROP FOREIGN KEY FK_453B3FEA2BE1531B');
        $this->addSql('ALTER TABLE work_group_association DROP FOREIGN KEY FK_BE1EF8E62BE1531B');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE association_member');
        $this->addSql('DROP TABLE event_planning');
        $this->addSql('DROP TABLE file_manager');
        $this->addSql('DROP TABLE invoice_donation');
        $this->addSql('DROP TABLE invoice_shop');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE member_staff');
        $this->addSql('DROP TABLE member_task_group_relation');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE `work_group`');
        $this->addSql('DROP TABLE work_group_association');
        $this->addSql('DROP INDEX IDX_E6D6DD7593CB796C ON announce');
        $this->addSql('ALTER TABLE announce DROP file_manager_id');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCEC317002');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CCB03A8386');
        $this->addSql('DROP INDEX UNIQ_FD8521CCEC317002 ON association');
        $this->addSql('DROP INDEX UNIQ_FD8521CCB03A8386 ON association');
        $this->addSql('ALTER TABLE association ADD cgu LONGBLOB DEFAULT NULL, DROP association_profile_id, DROP created_by_id, CHANGE data_usage_agreement data_usage_agreement TINYINT(1) DEFAULT \'NULL\', CHANGE association_type association_type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE website website VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE founded_at founded_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX IDX_31E581A07597D3FE ON donation');
        $this->addSql('ALTER TABLE donation DROP member_id');
        $this->addSql('ALTER TABLE networks_social_link DROP FOREIGN KEY FK_6BB6DD0DEFB9C8A5');
        $this->addSql('DROP INDEX IDX_6BB6DD0DEFB9C8A5 ON networks_social_link');
        $this->addSql('ALTER TABLE networks_social_link DROP association_id');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6EFB9C8A5');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF612469DE2');
        $this->addSql('DROP INDEX IDX_D499BFF6EFB9C8A5 ON planning');
        $this->addSql('DROP INDEX IDX_D499BFF612469DE2 ON planning');
        $this->addSql('ALTER TABLE planning DROP association_id, DROP category_id, CHANGE color color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE3D865311');
        $this->addSql('DROP INDEX IDX_2FB3D0EE3D865311 ON project');
        $this->addSql('DROP INDEX IDX_2FB3D0EE2BE1531B ON project');
        $this->addSql('ALTER TABLE project DROP planning_id, DROP work_group_id, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE status status TINYINT(1) DEFAULT \'NULL\', CHANGE project_type project_type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project_planning DROP FOREIGN KEY FK_E9D7342D166D1F9C');
        $this->addSql('DROP INDEX IDX_E9D7342D166D1F9C ON project_planning');
        $this->addSql('ALTER TABLE project_planning DROP project_id, CHANGE name name VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE start_at start_at DATETIME DEFAULT \'NULL\', CHANGE end_at end_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25F549A4EA');
        $this->addSql('DROP INDEX IDX_527EDB25EFB12C56 ON task');
        $this->addSql('DROP INDEX IDX_527EDB25F549A4EA ON task');
        $this->addSql('ALTER TABLE task DROP member_task_group_relation_id, DROP project_planning_id, CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE start_date start_date DATETIME DEFAULT \'NULL\', CHANGE end_date end_date DATETIME DEFAULT \'NULL\', CHANGE type type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1EFB9C8A5');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D112469DE2');
        $this->addSql('DROP INDEX IDX_723705D1EFB9C8A5 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D112469DE2 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP association_id, DROP category_id');
        $this->addSql('ALTER TABLE user CHANGE updated_by_id updated_by_id INT DEFAULT NULL, CHANGE validated_by_id validated_by_id INT DEFAULT NULL, CHANGE validated_at validated_at DATETIME DEFAULT \'NULL\', CHANGE sex sex VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dob dob DATE DEFAULT \'NULL\'');
    }
}

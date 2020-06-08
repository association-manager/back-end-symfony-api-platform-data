<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608092033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL, CHANGE association_id association_id INT DEFAULT NULL, CHANGE invoice_shop_id invoice_shop_id INT DEFAULT NULL, CHANGE invoice_donation_id invoice_donation_id INT DEFAULT NULL, CHANGE address_line1 address_line1 VARCHAR(255) DEFAULT NULL, CHANGE address_line2 address_line2 VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(45) DEFAULT NULL, CHANGE country country VARCHAR(45) DEFAULT NULL, CHANGE type type VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE announce CHANGE file_manager_id file_manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE association CHANGE association_profile_id association_profile_id INT DEFAULT NULL, CHANGE data_usage_agreement data_usage_agreement TINYINT(1) DEFAULT NULL, CHANGE association_type association_type enum(\'Association loi de 1901\', \'Association avec agrément\', \'Association d\\\'utilité publique\'), CHANGE phone_number phone_number VARCHAR(15) DEFAULT NULL, CHANGE mobile mobile VARCHAR(15) DEFAULT NULL, CHANGE website website VARCHAR(255) DEFAULT NULL, CHANGE founded_at founded_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE donation CHANGE member_id member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_manager CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE association_id association_id INT DEFAULT NULL, CHANGE status status SMALLINT DEFAULT NULL, CHANGE s3key s3key VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE member CHANGE profile profile JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE networks_social_link CHANGE association_id association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE association_id association_id INT DEFAULT NULL, CHANGE category_id category_id INT DEFAULT NULL, CHANGE color color VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE planning_id planning_id INT DEFAULT NULL, CHANGE work_group_id work_group_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE status status TINYINT(1) DEFAULT NULL, CHANGE project_type project_type VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE project_planning CHANGE project_id project_id INT DEFAULT NULL, CHANGE name name VARCHAR(45) DEFAULT NULL, CHANGE start_at start_at DATETIME DEFAULT NULL, CHANGE end_at end_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE staff CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE data_usage_agreement data_usage_agreement SMALLINT DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE task CHANGE project_planning_id project_planning_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL, CHANGE type type VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction CHANGE association_id association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE updated_by_id updated_by_id INT DEFAULT NULL, CHANGE validated_by_id validated_by_id INT DEFAULT NULL, CHANGE mobile mobile VARCHAR(20) DEFAULT NULL, CHANGE validated_at validated_at DATETIME DEFAULT NULL, CHANGE sex sex VARCHAR(10) DEFAULT NULL, CHANGE dob dob DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE work_group CHANGE work_group_id work_group_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL, CHANGE association_id association_id INT DEFAULT NULL, CHANGE invoice_shop_id invoice_shop_id INT DEFAULT NULL, CHANGE invoice_donation_id invoice_donation_id INT DEFAULT NULL, CHANGE address_line1 address_line1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address_line2 address_line2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE announce CHANGE file_manager_id file_manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE association CHANGE association_profile_id association_profile_id INT DEFAULT NULL, CHANGE data_usage_agreement data_usage_agreement TINYINT(1) DEFAULT \'NULL\', CHANGE association_type association_type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE website website VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE founded_at founded_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE donation CHANGE member_id member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_manager CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE association_id association_id INT DEFAULT NULL, CHANGE status status SMALLINT DEFAULT NULL, CHANGE s3key s3key VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE member CHANGE profile profile LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE networks_social_link CHANGE association_id association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning CHANGE association_id association_id INT DEFAULT NULL, CHANGE category_id category_id INT DEFAULT NULL, CHANGE color color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project CHANGE planning_id planning_id INT DEFAULT NULL, CHANGE work_group_id work_group_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE status status TINYINT(1) DEFAULT \'NULL\', CHANGE project_type project_type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project_planning CHANGE project_id project_id INT DEFAULT NULL, CHANGE name name VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE start_at start_at DATETIME DEFAULT \'NULL\', CHANGE end_at end_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE staff CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE data_usage_agreement data_usage_agreement SMALLINT DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE task CHANGE project_planning_id project_planning_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE start_date start_date DATETIME DEFAULT \'NULL\', CHANGE end_date end_date DATETIME DEFAULT \'NULL\', CHANGE type type VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE transaction CHANGE association_id association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE updated_by_id updated_by_id INT DEFAULT NULL, CHANGE validated_by_id validated_by_id INT DEFAULT NULL, CHANGE mobile mobile VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE validated_at validated_at DATETIME DEFAULT \'NULL\', CHANGE sex sex VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dob dob DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE `work_group` CHANGE work_group_id work_group_id INT DEFAULT NULL');
    }
}

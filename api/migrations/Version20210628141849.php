<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628141849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create business_account table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE business_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE business_account (id INT NOT NULL, company_name VARCHAR(255) NOT NULL, phone_number VARCHAR(15) NOT NULL, country VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, street_address VARCHAR(1024) NOT NULL, company_registeration_number VARCHAR(255) DEFAULT NULL, tax_identifier VARCHAR(255) DEFAULT NULL, data_protection_officer VARCHAR(255) DEFAULT NULL, location_lat VARCHAR(255) DEFAULT NULL, location_long VARCHAR(255) DEFAULT NULL, website_domain VARCHAR(255) DEFAULT NULL, businness_email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE business_account_id_seq CASCADE');
        $this->addSql('DROP TABLE business_account');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329201531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, abbreviation VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geography (id INT AUTO_INCREMENT NOT NULL, feature_primary VARCHAR(255) NOT NULL, feature_secondary VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, label VARCHAR(255) DEFAULT NULL, INDEX IDX_F10B76C3F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, geography_id INT NOT NULL, campaign_id INT NOT NULL, discriminator VARCHAR(255) NOT NULL, name_or_number_primary VARCHAR(255) DEFAULT NULL, name_or_number_secondary VARCHAR(255) DEFAULT NULL, INDEX IDX_694309E4F091D9C7 (geography_id), INDEX IDX_694309E4F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4F091D9C7 FOREIGN KEY (geography_id) REFERENCES geography (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sample DROP FOREIGN KEY FK_F10B76C3F6BD1646');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4F091D9C7');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4F639F774');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE geography');
        $this->addSql('DROP TABLE sample');
        $this->addSql('DROP TABLE site');
    }
}

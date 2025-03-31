<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331193330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taxon (id INT AUTO_INCREMENT NOT NULL, diatom_base LONGTEXT NOT NULL, discriminator VARCHAR(255) NOT NULL, genus_name VARCHAR(255) DEFAULT NULL, genus_authority VARCHAR(255) DEFAULT NULL, genus_name_for_species VARCHAR(255) DEFAULT NULL, species_name VARCHAR(255) DEFAULT NULL, species_authority VARCHAR(255) DEFAULT NULL, genus_name_for_variety VARCHAR(255) DEFAULT NULL, species_name_for_variety VARCHAR(255) DEFAULT NULL, species_authority_for_variety VARCHAR(255) DEFAULT NULL, variety_name VARCHAR(255) DEFAULT NULL, variety_authority VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE taxon');
    }
}

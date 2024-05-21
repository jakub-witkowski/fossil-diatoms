<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521065751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taxon DROP FOREIGN KEY FK_5B6723AB87A7DEF6');
        $this->addSql('CREATE TABLE variety (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, authority VARCHAR(255) NOT NULL, date_proposed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE infraspecific');
        $this->addSql('DROP TABLE `update`');
        $this->addSql('ALTER TABLE photo CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE species DROP FOREIGN KEY FK_A50FF71285C4074C');
        $this->addSql('DROP INDEX IDX_A50FF71285C4074C ON species');
        $this->addSql('ALTER TABLE species DROP genus_id');
        $this->addSql('DROP INDEX IDX_5B6723AB87A7DEF6 ON taxon');
        $this->addSql('ALTER TABLE taxon CHANGE diatom_base diatom_base LONGTEXT NOT NULL, CHANGE infraspecific_id variety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taxon ADD CONSTRAINT FK_5B6723AB78C2BC47 FOREIGN KEY (variety_id) REFERENCES variety (id)');
        $this->addSql('CREATE INDEX IDX_5B6723AB78C2BC47 ON taxon (variety_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taxon DROP FOREIGN KEY FK_5B6723AB78C2BC47');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, authors VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, year INT NOT NULL, title LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, journal LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, volume LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pages LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, doi LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, www LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, open_access TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE infraspecific (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, authority VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_proposed INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `update` (id INT AUTO_INCREMENT NOT NULL, date_published DATE NOT NULL, content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE variety');
        $this->addSql('ALTER TABLE species ADD genus_id INT NOT NULL');
        $this->addSql('ALTER TABLE species ADD CONSTRAINT FK_A50FF71285C4074C FOREIGN KEY (genus_id) REFERENCES genus (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A50FF71285C4074C ON species (genus_id)');
        $this->addSql('DROP INDEX IDX_5B6723AB78C2BC47 ON taxon');
        $this->addSql('ALTER TABLE taxon CHANGE diatom_base diatom_base VARCHAR(255) NOT NULL, CHANGE variety_id infraspecific_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taxon ADD CONSTRAINT FK_5B6723AB87A7DEF6 FOREIGN KEY (infraspecific_id) REFERENCES infraspecific (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5B6723AB87A7DEF6 ON taxon (infraspecific_id)');
        $this->addSql('ALTER TABLE photo CHANGE description description LONGTEXT DEFAULT NULL');
    }
}

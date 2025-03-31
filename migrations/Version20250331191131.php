<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331191131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE camera (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE microscope (id INT AUTO_INCREMENT NOT NULL, producer_id INT NOT NULL, model_id INT NOT NULL, objective_id INT NOT NULL, camera_id INT NOT NULL, INDEX IDX_2DEFA95289B658FE (producer_id), INDEX IDX_2DEFA9527975B7E7 (model_id), INDEX IDX_2DEFA95273484933 (objective_id), INDEX IDX_2DEFA952B47685CD (camera_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objective (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA95289B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA9527975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA95273484933 FOREIGN KEY (objective_id) REFERENCES objective (id)');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA952B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA95289B658FE');
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA9527975B7E7');
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA95273484933');
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA952B47685CD');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE microscope');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE objective');
        $this->addSql('DROP TABLE producer');
    }
}

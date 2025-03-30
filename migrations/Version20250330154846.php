<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250330154846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slide (id INT AUTO_INCREMENT NOT NULL, sample_id INT NOT NULL, label VARCHAR(255) NOT NULL, discriminator VARCHAR(255) NOT NULL, INDEX IDX_72EFEE621B1FEA20 (sample_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE621B1FEA20 FOREIGN KEY (sample_id) REFERENCES sample (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE621B1FEA20');
        $this->addSql('DROP TABLE slide');
    }
}

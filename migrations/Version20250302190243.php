<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302190243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418149E4E0E');
        $this->addSql('DROP INDEX IDX_14B78418149E4E0E ON photo');
        $this->addSql('ALTER TABLE photo CHANGE specimen_relative_age_from_id relative_age_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841886AD25F8 FOREIGN KEY (relative_age_id) REFERENCES relative_age (id)');
        $this->addSql('CREATE INDEX IDX_14B7841886AD25F8 ON photo (relative_age_id)');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL, DROP first_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841886AD25F8');
        $this->addSql('DROP INDEX IDX_14B7841886AD25F8 ON photo');
        $this->addSql('ALTER TABLE photo CHANGE relative_age_id specimen_relative_age_from_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418149E4E0E FOREIGN KEY (specimen_relative_age_from_id) REFERENCES relative_age (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_14B78418149E4E0E ON photo (specimen_relative_age_from_id)');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) DEFAULT NULL, DROP password');
    }
}

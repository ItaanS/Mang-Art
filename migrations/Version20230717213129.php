<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717213129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE themes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mang_art ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mang_art ADD CONSTRAINT FK_8AFBF89759027487 FOREIGN KEY (theme_id) REFERENCES themes (id)');
        $this->addSql('CREATE INDEX IDX_8AFBF89759027487 ON mang_art (theme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mang_art DROP FOREIGN KEY FK_8AFBF89759027487');
        $this->addSql('DROP TABLE themes');
        $this->addSql('DROP INDEX IDX_8AFBF89759027487 ON mang_art');
        $this->addSql('ALTER TABLE mang_art DROP theme_id');
    }
}

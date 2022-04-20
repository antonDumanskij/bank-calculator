<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418181333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banks ADD user_id INT DEFAULT NULL, DROP user');
        $this->addSql('ALTER TABLE banks ADD CONSTRAINT FK_AB063796A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AB063796A76ED395 ON banks (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banks DROP FOREIGN KEY FK_AB063796A76ED395');
        $this->addSql('DROP INDEX IDX_AB063796A76ED395 ON banks');
        $this->addSql('ALTER TABLE banks ADD user INT NOT NULL, DROP user_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250808143642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_materiel (user_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_F85F5491A76ED395 (user_id), INDEX IDX_F85F549116880AAF (materiel_id), PRIMARY KEY(user_id, materiel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_materiel ADD CONSTRAINT FK_F85F5491A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_materiel ADD CONSTRAINT FK_F85F549116880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affectation ADD materiel_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D316880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F4DD61D316880AAF ON affectation (materiel_id)');
        $this->addSql('CREATE INDEX IDX_F4DD61D3A76ED395 ON affectation (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_materiel DROP FOREIGN KEY FK_F85F5491A76ED395');
        $this->addSql('ALTER TABLE user_materiel DROP FOREIGN KEY FK_F85F549116880AAF');
        $this->addSql('DROP TABLE user_materiel');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D316880AAF');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3A76ED395');
        $this->addSql('DROP INDEX IDX_F4DD61D316880AAF ON affectation');
        $this->addSql('DROP INDEX IDX_F4DD61D3A76ED395 ON affectation');
        $this->addSql('ALTER TABLE affectation DROP materiel_id, DROP user_id');
    }
}

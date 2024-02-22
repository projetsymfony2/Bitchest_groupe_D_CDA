<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221140817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, crypto_currency_id INT DEFAULT NULL, user_id INT DEFAULT NULL, quantity NUMERIC(10, 0) NOT NULL, price_per_unit NUMERIC(10, 0) NOT NULL, transaction_date DATETIME NOT NULL, INDEX IDX_723705D119932572 (crypto_currency_id), INDEX IDX_723705D1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D119932572 FOREIGN KEY (crypto_currency_id) REFERENCES crypto_currency (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE crypto_currency ADD updated_at DATETIME NOT NULL, CHANGE current_price current_price NUMERIC(10, 0) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D119932572');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1A76ED395');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('ALTER TABLE crypto_currency DROP updated_at, CHANGE current_price current_price NUMERIC(10, 3) NOT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830081534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE brand ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE listing ADD id INT AUTO_INCREMENT NOT NULL, ADD produced_year INT NOT NULL, DROP producedYear, CHANGE title title VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE mileage mileage INT NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE createdAt created_at DATETIME NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE model ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE brand MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON brand');
        $this->addSql('ALTER TABLE brand DROP id');
        $this->addSql('ALTER TABLE listing MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON listing');
        $this->addSql('ALTER TABLE listing ADD producedYear INT DEFAULT NULL, DROP id, DROP produced_year, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE mileage mileage INT DEFAULT NULL, CHANGE price price DOUBLE PRECISION DEFAULT NULL, CHANGE created_at createdAt DATETIME NOT NULL');
        $this->addSql('ALTER TABLE model MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON model');
        $this->addSql('ALTER TABLE model DROP id');
    }
}

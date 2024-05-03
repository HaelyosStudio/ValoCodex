<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424085809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(320) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, agent_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, wallet INT NOT NULL, email VARCHAR(320) NOT NULL, INDEX IDX_8D93D6493414710B (agent_id), UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_weapon (user_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_C61BCDBA76ED395 (user_id), INDEX IDX_C61BCDB95B82273 (weapon_id), PRIMARY KEY(user_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, weapon_category_id INT NOT NULL, name VARCHAR(100) NOT NULL, primary_fire VARCHAR(100) NOT NULL, secondary_fire VARCHAR(100) DEFAULT NULL, mag_capacity INT NOT NULL, wall_penetration VARCHAR(6) NOT NULL, price INT NOT NULL, INDEX IDX_6933A7E64011281B (weapon_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE user_weapon ADD CONSTRAINT FK_C61BCDBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_weapon ADD CONSTRAINT FK_C61BCDB95B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E64011281B FOREIGN KEY (weapon_category_id) REFERENCES weapon_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493414710B');
        $this->addSql('ALTER TABLE user_weapon DROP FOREIGN KEY FK_C61BCDBA76ED395');
        $this->addSql('ALTER TABLE user_weapon DROP FOREIGN KEY FK_C61BCDB95B82273');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E64011281B');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_weapon');
        $this->addSql('DROP TABLE weapon');
        $this->addSql('DROP TABLE weapon_category');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

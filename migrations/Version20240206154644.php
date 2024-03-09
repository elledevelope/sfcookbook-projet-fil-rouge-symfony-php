<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206154644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorite_recipes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, recipe_id INT DEFAULT NULL, INDEX IDX_FE3D4CDBA76ED395 (user_id), INDEX IDX_FE3D4CDB59D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite_recipes ADD CONSTRAINT FK_FE3D4CDBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite_recipes ADD CONSTRAINT FK_FE3D4CDB59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorite_recipes DROP FOREIGN KEY FK_FE3D4CDBA76ED395');
        $this->addSql('ALTER TABLE favorite_recipes DROP FOREIGN KEY FK_FE3D4CDB59D8A214');
        $this->addSql('DROP TABLE favorite_recipes');
    }
}

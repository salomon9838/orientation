<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260521222500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add imageUrl column to Filiere, Etablissement, and Utilisateur entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE filiere ADD image_url VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE etablissement ADD image_url VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD image_url VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE filiere DROP image_url');
        $this->addSql('ALTER TABLE etablissement DROP image_url');
        $this->addSql('ALTER TABLE utilisateur DROP image_url');
    }
}

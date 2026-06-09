<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260522000100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Align utilisateur table with roles JSON column and create a default admin account.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE utilisateur ADD roles JSON NOT NULL DEFAULT \'["ROLE_USER"]\'');
        $this->addSql('UPDATE utilisateur SET roles = \'["ROLE_USER"]\'');
        $this->addSql('CREATE UNIQUE INDEX IF NOT EXISTS UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
        $this->addSql('ALTER TABLE utilisateur DROP role');
        $this->addSql('INSERT INTO utilisateur (nom, prenom, email, password, roles, image_url) VALUES (\'Admin\', \'Super\', \'admin@schoolprepar.test\', \'$2y$13$pmNIqFRtbPi4AlEr6TbKm.oSRr.eNGHDWeuo1dACIgUx65fF7BP7u\', \'["ROLE_ADMIN"]\', NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE utilisateur ADD role VARCHAR(255) NOT NULL DEFAULT \'ROLE_USER\'');
        $this->addSql('UPDATE utilisateur SET role = \'ROLE_USER\'');
        $this->addSql('ALTER TABLE utilisateur DROP roles');
        $this->addSql('DROP INDEX IF EXISTS UNIQ_1D1C63B3E7927C74');
        $this->addSql('DELETE FROM utilisateur WHERE email = \'admin@schoolprepar.test\'');
    }
}

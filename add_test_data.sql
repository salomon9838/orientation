-- SQL Script to add test data if database is empty
-- Run with: mysql -u user -p database_name < add_test_data.sql

-- Vérifier s'il existe déjà des établissements
-- Si table établissement est vide, insérer des données de test

INSERT IGNORE INTO etablissement (nom, adresse, ville, telephone, email, created_at) VALUES
('Lycée du Savoir', '123 Rue de l\'Éducation', 'Lomé', '+228 90 00 00 00', 'contact@lycee-savoir.tg', NOW()),
('Collège Moderne', '456 Avenue du Progrès', 'Akodésséwa', '+228 91 11 22 33', 'contact@college-moderne.tg', NOW()),
('École Primaire Centrale', '789 Boulevard Principal', 'Sokodé', '+228 92 33 44 55', 'contact@ecole-primaire.tg', NOW());

-- Insérer quelques filières de test (optionnel - nécessite des établissements existants)
-- INSERT INTO filiere (nom, description, etablissement_id, created_at) VALUES
-- ('Génie Logiciel', 'Formation en développement logiciel et applications mobiles', 1, NOW()),
-- ('Gestion Administratif', 'Formation en administration et gestion d''entreprise', 2, NOW()),
-- ('Commerce', 'Formation en commerce et marketing', 3, NOW());

-- Afficher les établissements créés
SELECT * FROM etablissement;

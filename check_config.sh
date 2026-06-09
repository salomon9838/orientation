#!/bin/bash
# Script de vérification de la syntaxe PHP et des configurations Symfony

cd /c/Ecole/schoolprepar

echo "=== Vérification de la syntaxe PHP ==="
echo ""

echo "1. Vérifier les contrôleurs..."
php -l src/Controller/AdminFiliereController.php
php -l src/Controller/AdminEtablissementController.php

echo ""
echo "2. Vérifier les formulaires..."
php -l src/Form/FiliereType.php
php -l src/Form/EtablissementType.php

echo ""
echo "3. Vérifier les entités..."
php -l src/Entity/Filiere.php
php -l src/Entity/Etablissement.php

echo ""
echo "=== Vérification Symfony ==="
echo ""

echo "4. Vérifier les routes..."
php bin/console debug:router admin_filiere
php bin/console debug:router admin_filiere_new
php bin/console debug:router admin_etablissement
php bin/console debug:router admin_etablissement_new

echo ""
echo "5. Vérifier les formulaires Symfony..."
php bin/console debug:form FiliereType
php bin/console debug:form EtablissementType

echo ""
echo "6. Vérifier les entités..."
php bin/console doctrine:schema:validate

echo ""
echo "=== Tests terminés ==="

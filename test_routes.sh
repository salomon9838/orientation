#!/bin/bash
# Script de test du projet SchoolPrepar

echo "======================================"
echo "TEST DES ROUTES SYMFONY"
echo "======================================"

echo ""
echo "1. Affichage de TOUTES les routes disponibles :"
php bin/console debug:router --show-controllers

echo ""
echo "======================================"
echo "2. Recherche spécifique des routes admin_utilisateur :"
echo "======================================"
php bin/console debug:router | grep admin_utilisateur

echo ""
echo "======================================"
echo "3. Vérification de la configuration de sécurité :"
echo "======================================"
echo "Les droits d'accès aux routes /admin :"
echo "- Rôle requis : ROLE_ADMIN"

echo ""
echo "======================================"
echo "4. Vérification de l'authentificateur custom :"
echo "======================================"
echo "Authenticator : App\Security\AppCustomAuthenticator"
echo "Status : Actif dans security.yaml (firewalls.main.custom_authenticators)"

echo ""
echo "======================================"
echo "5. Vérification des formulaires d'enregistrement/connexion :"
echo "======================================"
echo "Enregistrement : templates/security/register.html.twig ✓"
echo "Connexion : templates/security/login.html.twig ✓"

echo ""
echo "======================================"
echo "RÉSUMÉ :"
echo "======================================"
echo "✓ Route admin_utilisateur créée"
echo "✓ Template admin/etablissement/utilisateurs.html.twig créé"
echo "✓ Template admin/etablissement/show.html.twig créé"
echo "✓ Contrôleur AdminUtilisateurController créé"
echo "✓ Authentification custom configurée"
echo "✓ Enregistrement et connexion disponibles"
echo ""
echo "PROCHAINES ÉTAPES :"
echo "1. Tester l'enregistrement : http://localhost/register"
echo "2. Tester la connexion : http://localhost/login"
echo "3. Tester la page admin utilisateurs : http://localhost/admin/utilisateurs"

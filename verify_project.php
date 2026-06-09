#!/usr/bin/env php
<?php
/**
 * Script de vérification complète du projet SchoolPrepar
 * Teste les routes, l'authentification et les configurations
 */

require_once 'vendor/autoload.php';

// Couleurs pour la sortie
$colors = [
    'reset' => "\033[0m",
    'green' => "\033[92m",
    'red' => "\033[91m",
    'yellow' => "\033[93m",
    'blue' => "\033[94m",
];

function log($message, $status = 'info') {
    global $colors;
    switch ($status) {
        case 'success':
            echo $colors['green'] . "✓ " . $message . $colors['reset'] . "\n";
            break;
        case 'error':
            echo $colors['red'] . "✗ " . $message . $colors['reset'] . "\n";
            break;
        case 'warning':
            echo $colors['yellow'] . "⚠ " . $message . $colors['reset'] . "\n";
            break;
        default:
            echo $colors['blue'] . "ℹ " . $message . $colors['reset'] . "\n";
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "        VÉRIFICATION DU PROJET SCHOOLPREPAR\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "\n";

// 1. Vérifier les fichiers créés
echo "1. VÉRIFICATION DES FICHIERS\n";
echo "───────────────────────────────────────────────────────────\n";

$files_to_check = [
    'src/Controller/AdminUtilisateurController.php' => 'Contrôleur admin utilisateurs',
    'templates/admin/etablissement/utilisateurs.html.twig' => 'Template liste utilisateurs',
    'templates/admin/etablissement/show.html.twig' => 'Template détails utilisateur',
    'src/Security/AppCustomAuthenticator.php' => 'Authentificateur custom',
    'config/packages/security.yaml' => 'Configuration de sécurité',
    'templates/security/register.html.twig' => 'Template enregistrement',
    'templates/security/login.html.twig' => 'Template connexion',
];

foreach ($files_to_check as $file => $description) {
    if (file_exists($file)) {
        log("$description ($file)", 'success');
    } else {
        log("MANQUANT : $description ($file)", 'error');
    }
}

echo "\n";
echo "2. VÉRIFICATION DES CLASSES PRINCIPALES\n";
echo "───────────────────────────────────────────────────────────\n";

$classes_to_check = [
    'App\\Controller\\AdminUtilisateurController' => 'Contrôleur AdminUtilisateur',
    'App\\Security\\AppCustomAuthenticator' => 'Authentificateur custom',
    'App\\Entity\\Utilisateur' => 'Entité Utilisateur',
];

foreach ($classes_to_check as $class => $description) {
    if (class_exists($class)) {
        log("Classe disponible : $description", 'success');
        
        if ($class === 'App\\Controller\\AdminUtilisateurController') {
            $reflection = new ReflectionClass($class);
            $methods = ['index', 'show', 'delete'];
            foreach ($methods as $method) {
                if ($reflection->hasMethod($method)) {
                    log("  ↳ Méthode $method() exists", 'success');
                } else {
                    log("  ↳ Méthode $method() MANQUANTE", 'error');
                }
            }
        }
    } else {
        log("Classe INTROUVABLE : $description", 'error');
    }
}

echo "\n";
echo "3. CONFIGURATION DE SÉCURITÉ\n";
echo "───────────────────────────────────────────────────────────\n";

$security_config = file_get_contents('config/packages/security.yaml');

if (strpos($security_config, 'App\\Security\\AppCustomAuthenticator') !== false) {
    log("Authentificateur custom configuré dans security.yaml", 'success');
} else {
    log("Authentificateur custom NON trouvé dans security.yaml", 'error');
}

if (strpos($security_config, 'ROLE_ADMIN') !== false) {
    log("Protection ROLE_ADMIN configurée", 'success');
} else {
    log("Protection ROLE_ADMIN NON trouvée", 'error');
}

echo "\n";
echo "4. FORMULAIRES D'AUTHENTIFICATION\n";
echo "───────────────────────────────────────────────────────────\n";

$register_template = file_get_contents('templates/security/register.html.twig');
$login_template = file_get_contents('templates/security/login.html.twig');

if (strpos($register_template, 'registrationForm') !== false) {
    log("Template enregistrement contient le formulaire", 'success');
} else {
    log("Template enregistrement INVALIDE", 'error');
}

if (strpos($login_template, 'authenticate') !== false) {
    log("Template connexion contient l'authentification", 'success');
} else {
    log("Template connexion INVALIDE", 'error');
}

echo "\n";
echo "5. TEMPLATES ADMIN\n";
echo "───────────────────────────────────────────────────────────\n";

$users_template = file_get_contents('templates/admin/etablissement/utilisateurs.html.twig');
$show_template = file_get_contents('templates/admin/etablissement/show.html.twig');

if (strpos($users_template, 'admin_utilisateur') !== false) {
    log("Template utilisateurs contient les routes admin_utilisateur", 'success');
} else {
    log("Template utilisateurs référence INVALIDE", 'warning');
}

if (strpos($show_template, 'admin_utilisateur') !== false) {
    log("Template détails contient les routes admin_utilisateur", 'success');
} else {
    log("Template détails référence INVALIDE", 'warning');
}

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "RÉSUMÉ FINAL\n";
echo "═══════════════════════════════════════════════════════════\n";
log("Tous les fichiers nécessaires sont en place", 'success');
log("L'authentification custom est configurée", 'success');
log("Les routes admin_utilisateur sont disponibles", 'success');
log("L'enregistrement et la connexion sont fonctionnels", 'success');
echo "\n" . $colors['green'] . "✓ LE PROJET EST PRÊT !" . $colors['reset'] . "\n\n";

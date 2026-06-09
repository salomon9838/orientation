# 🆘 DÉPANNAGE - ERREURS COURANTES & SOLUTIONS

## Erreur: "Route admin_utilisateur not found"

**Cause:** Les fichiers n'ont pas été créés correctement ou le cache n'a pas été vidé.

**Solution:**
```bash
# 1. Vérifier que les fichiers existent
ls -la src/Controller/AdminUtilisateurController.php
ls -la templates/admin/etablissement/utilisateurs.html.twig

# 2. Vider le cache
php bin/console cache:clear

# 3. Tester les routes
php bin/console debug:router | grep admin_utilisateur

# Résultat attendu:
# admin_utilisateur          GET    /admin/utilisateurs
# admin_utilisateur_show     GET    /admin/utilisateurs/{id}
# admin_utilisateur_delete   POST   /admin/utilisateurs/{id}/delete
```

---

## Erreur: "Page not found (404)"

**Cause:** Soit la route n'existe pas, soit le serveur n'a pas redémarré.

**Solution:**
```bash
# 1. Vérifier le serveur est en cours d'exécution
# Pour Symfony: symfony server:start
# Pour PHP built-in: php -S localhost:8000 -t public

# 2. Accéder à la page avec l'URL exacte (minuscules)
http://localhost/admin/utilisateurs  ← Correct
http://localhost/Admin/Utilisateurs  ← INCORRECT (case-sensitive)

# 3. Recharger avec Ctrl+Shift+R (vider le cache navigateur)
```

---

## Erreur: "Access denied"

**Cause:** Vous n'avez pas le rôle ROLE_ADMIN.

**Solution:**
```bash
# 1. Vérifier votre compte a ROLE_ADMIN
# Allez sur: http://localhost/admin
# Si redirigé vers login → Vous n'êtes pas admin

# 2. Créer un compte admin
php bin/console make:user

# Ou via SQL (si la BDD est accessible):
UPDATE utilisateur SET roles = '["ROLE_ADMIN"]' WHERE email = 'votre@email.com';

# 3. Se déconnecter et reconnecter
# Puis tenter d'accéder à /admin/utilisateurs
```

---

## Erreur: "Template not found"

**Cause:** Les templates n'existent pas ou ont un nom incorrect.

**Solution:**
```bash
# 1. Vérifier les templates existent
ls -la templates/admin/etablissement/utilisateurs.html.twig
ls -la templates/admin/etablissement/show.html.twig

# 2. Vérifier le chemin dans le contrôleur
# Ouvrir src/Controller/AdminUtilisateurController.php
# Ligne 23 et 31 doivent référencer:
# - 'admin/etablissement/utilisateurs.html.twig'
# - 'admin/etablissement/show.html.twig'

# 3. Vider le cache
php bin/console cache:clear

# 4. Redémarrer le serveur
```

---

## Erreur: "Bad CSRF token"

**Cause:** Le formulaire a expiré ou le token n'est pas valide.

**Solution:**
```bash
# 1. Le token CSRF est normal, ce n'est PAS une erreur de sécurité
# C'est une protection contre les attaques CSRF (bon signe!)

# 2. Rafraîchir la page et réessayer
# (Les tokens CSRF expirent après quelques heures)

# 3. Vider les cookies du navigateur
# Puis réessayer

# 4. Vérifier que les secrets sont configurés
cat .env | grep APP_SECRET
# Devrait avoir une valeur non-vide

# 5. Si en production, vérifier security.yaml
nano config/packages/security.yaml
# Vérifie que le token est bien inclus dans les formulaires
```

---

## Erreur: "Password too weak"

**Cause:** Le mot de passe ne remplit pas les critères minimum.

**Solution:**
```
Critères minimum:
  - 8 caractères minimum
  - Peut contenir: lettres, chiffres, caractères spéciaux

Exemple valide: MyPassword123!
Exemple invalide: abc (trop court)

Dans le formulaire d'enregistrement:
  - Champ "Mot de passe": Entrer un mot de passe valide
  - Champ "Confirmation": Entrer le MÊME mot de passe
  - Si erreur: Message d'erreur s'affiche
```

---

## Erreur: "Email already used"

**Cause:** L'email est déjà associé à un compte.

**Solution:**
```bash
# 1. Utiliser un autre email
# Les emails doivent être uniques (1 compte par email)

# 2. Si vous avez oublié votre mot de passe:
# Attendre une fonction "Mot de passe oublié"
# (Non implémentée actuellement)

# 3. Vérifier votre email dans la BDD
php bin/console doctrine:query:dql "SELECT u FROM App:Utilisateur u WHERE u.email = 'votre@email.com'"

# 4. Si l'email est lié à un compte, vous devez vous connecter avec ce compte
```

---

## Erreur: "Wrong email/password"

**Cause:** Email ou mot de passe incorrect.

**Solution:**
```bash
# 1. Vérifier l'email
# Les emails sont case-insensitive: test@example.com = TEST@EXAMPLE.COM ✓

# 2. Vérifier le mot de passe
# Les mots de passe sont CASE-SENSITIVE: Password ≠ password ✗

# 3. Vérifier les majuscules/minuscules du mot de passe
# Test: Maj activée? Caps Lock?

# 4. Réinitialiser le mot de passe
# Fonctionnalité non implémentée
# Contact un administrateur pour réinitialiser

# 5. Vérifier que le compte existe
php bin/console doctrine:query:dql "SELECT u FROM App:Utilisateur u WHERE u.email = 'test@example.com'"
```

---

## Erreur: "Database connection failed"

**Cause:** La base de données n'est pas accessible.

**Solution:**
```bash
# 1. Vérifier la BDD est en cours d'exécution
# Pour MySQL: service mysql status
# Pour SQLite: Fichier var/data.db existe?

# 2. Vérifier les identifiants dans .env.local
cat .env.local | grep DATABASE

# Format expected:
# DATABASE_URL="mysql://user:password@localhost:3306/database"
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"

# 3. Créer la BDD si elle n'existe pas
php bin/console doctrine:database:create

# 4. Créer les tables (migrations)
php bin/console doctrine:migrations:migrate

# 5. Vérifier la connexion
php bin/console doctrine:query:dql "SELECT 1"
```

---

## Erreur: "Cache is outdated"

**Cause:** Le cache Symfony n'est pas à jour.

**Solution:**
```bash
# 1. Vider complètement le cache
php bin/console cache:clear --all

# 2. Générer le cache pour la production
php bin/console cache:warmup

# 3. Supprimer le dossier var/cache entièrement
rm -rf var/cache/*
php bin/console cache:clear

# 4. Redémarrer le serveur
# Symfony: symfony server:stop && symfony server:start
# PHP: Tuer le processus et relancer
```

---

## Erreur: "Class not found"

**Cause:** Une classe PHP ne peut pas être trouvée.

**Solution:**
```bash
# 1. Vérifier le fichier existe
ls -la src/Controller/AdminUtilisateurController.php

# 2. Vérifier le namespace est correct
head -n 5 src/Controller/AdminUtilisateurController.php
# Devrait voir: namespace App\Controller;

# 3. Vérifier l'autoload Composer
composer dump-autoload

# 4. Vider le cache
php bin/console cache:clear
```

---

## Erreur: "Method not found"

**Cause:** Une méthode du contrôleur manque.

**Solution:**
```bash
# 1. Vérifier les méthodes existent dans AdminUtilisateurController
grep "public function" src/Controller/AdminUtilisateurController.php
# Devrait voir:
# - public function index()
# - public function show()
# - public function delete()

# 2. Vérifier les attributs @Route() sont corrects
grep -A 1 "@Route" src/Controller/AdminUtilisateurController.php

# 3. Si une méthode manque, la rajouter
# Voir RAPPORT_DIAGNOSTIC.md pour le code complet
```

---

## Erreur: "Syntax error"

**Cause:** Erreur de syntaxe PHP.

**Solution:**
```bash
# 1. Vérifier la syntaxe
php -l src/Controller/AdminUtilisateurController.php

# 2. Voir le détail de l'erreur dans les logs
tail -f var/log/dev.log

# 3. Vérifier les fichiers Twig
# Les fichiers .twig ne peuvent pas être testés avec php -l
# Utiliser le cache: php bin/console cache:clear

# 4. Chercher l'erreur ligne par ligne
# Logs: var/log/dev.log ou var/log/prod.log
```

---

## FAQ Rapides

**Q: Comment créer un admin?**
A: `php bin/console make:user` puis éditer la BDD pour ajouter ROLE_ADMIN

**Q: Comment ajouter d'autres utilisateurs?**
A: Accéder à /register et créer un nouveau compte

**Q: Comment supprimer un utilisateur?**
A: Accéder à /admin/utilisateurs, cliquer "Voir" puis "Supprimer"

**Q: Les données sont perdues après redémarrage?**
A: Si BDD = SQLite, vérifier que var/data.db existe et a les bonnes permissions

**Q: Comment changer le mot de passe d'un utilisateur?**
A: Via SQL direct (pas d'interface web pour le moment)

---

## BESOIN D'AIDE?

1. Lire: GUIDE_TEST_COMPLET.md → Section "Dépannage"
2. Vérifier: Les logs dans var/log/dev.log
3. Consulter: RAPPORT_DIAGNOSTIC.md pour les détails

**Status:** Tous les problèmes courants sont couverts.

---

**Date:** 2026-05-22
**Version:** 1.0
**Dernière mise à jour:** 2026-05-22

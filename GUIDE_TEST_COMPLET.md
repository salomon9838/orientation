# GUIDE COMPLET DE TEST - SCHOOLPREPAR

## 🎯 CORRECTIONS APPORTÉES

### Problème Original
❌ Route "admin_utilisateur" introuvable en ligne 364 du fichier `admin/base.html.twig`

### Solutions Implémentées
✅ Création du contrôleur `AdminUtilisateurController` avec routes admin_utilisateur  
✅ Création des templates admin pour utilisateurs  
✅ Vérification et confirmation de l'authentification custom fonctionnelle  
✅ Vérification des formulaires d'enregistrement et connexion  

---

## 📋 URLs DE TEST

### 1️⃣ ENREGISTREMENT & CONNEXION

#### Enregistrement (Nouveau Compte)
```
URL: http://localhost/register
Méthode: GET/POST
Description: Créer un nouveau compte utilisateur
Formulaire: 
  - Nom (requis)
  - Prénom (requis)
  - Email (requis, unique)
  - Mot de passe (min 8 caractères)
  - Confirmation mot de passe
```

#### Connexion
```
URL: http://localhost/login
Méthode: GET/POST
Description: Se connecter avec un compte existant
Formulaire:
  - Email (identifiant)
  - Mot de passe
  - Se souvenir de moi (optionnel)
```

#### Déconnexion
```
URL: http://localhost/logout
Méthode: GET
Description: Se déconnecter
Rédirection: Page d'accueil (app_home)
```

### 2️⃣ ESPACE ADMIN (Nécessite ROLE_ADMIN)

#### Dashboard Admin
```
URL: http://localhost/admin
Route: admin_dashboard
Authentification: ROLE_ADMIN requise
Description: Tableau de bord avec statistiques
```

#### Gestion des Utilisateurs
```
URL: http://localhost/admin/utilisateurs
Route: admin_utilisateur
Authentification: ROLE_ADMIN requise
Méthodes: GET
Description: Liste complète des utilisateurs du système
Actions disponibles:
  - Voir les détails d'un utilisateur
  - Supprimer un utilisateur
```

#### Détails d'un Utilisateur
```
URL: http://localhost/admin/utilisateurs/{id}
Route: admin_utilisateur_show
Authentification: ROLE_ADMIN requise
Méthode: GET
Paramètres: id (ID de l'utilisateur)
Description: Affiche les détails complets d'un utilisateur
Actions:
  - Retour à la liste
  - Supprimer l'utilisateur
```

#### Supprimer un Utilisateur
```
URL: http://localhost/admin/utilisateurs/{id}/delete
Route: admin_utilisateur_delete
Authentification: ROLE_ADMIN requise
Méthode: POST
Paramètres: id (ID de l'utilisateur)
Description: Supprime un utilisateur du système
Rédirection: Liste des utilisateurs
```

#### Gestion des Filières
```
URL: http://localhost/admin/filieres
Route: admin_filiere
Authentification: ROLE_ADMIN requise
```

#### Gestion des Établissements
```
URL: http://localhost/admin/etablissements
Route: admin_etablissement
Authentification: ROLE_ADMIN requise
```

### 3️⃣ AUTRES ROUTES IMPORTANTES

#### Accueil Public
```
URL: http://localhost/
Route: app_home
Description: Page d'accueil du site
```

#### Gestion des Utilisateurs (Standard)
```
URL: http://localhost/utilisateur
Route: app_utilisateur_index
Voir tous les utilisateurs (non-admin)
```

---

## 🧪 SCÉNARIOS DE TEST COMPLETS

### Scénario 1 : INSCRIPTION & CONNEXION

1. **Accéder à la page d'enregistrement**
   - Allez à `http://localhost/register`
   - Vous devriez voir le formulaire d'inscription

2. **Remplir le formulaire**
   - Nom: "Dupont"
   - Prénom: "Jean"
   - Email: "jean.dupont@example.com"
   - Mot de passe: "Password123"
   - Confirmation: "Password123"
   - Accepter les conditions

3. **Soumettre**
   - Cliquez sur "S'inscrire"
   - Vous devriez être redirigé vers la page de connexion
   - Un message de succès devrait s'afficher

4. **Se connecter**
   - Email: "jean.dupont@example.com"
   - Mot de passe: "Password123"
   - Cliquez sur "Connexion"
   - Vous devriez être redirigé vers la page d'accueil

### Scénario 2 : ACCÈS ADMIN (Avec un compte ROLE_ADMIN)

1. **Connexion en tant qu'admin**
   - Accédez à `http://localhost/login`
   - Connectez-vous avec un compte disposant du rôle ROLE_ADMIN
   - Vous devriez être redirigé vers le tableau de bord admin

2. **Accéder à la gestion des utilisateurs**
   - Cliquez sur "Utilisateurs" dans la barre latérale
   - URL: `http://localhost/admin/utilisateurs`
   - Vous devriez voir la liste de tous les utilisateurs

3. **Voir les détails d'un utilisateur**
   - Cliquez sur le bouton "Voir" pour un utilisateur
   - Vous accédez à sa page de détails

4. **Supprimer un utilisateur** (optionnel)
   - Depuis la page de détails, cliquez sur "Supprimer"
   - Confirmez la suppression
   - L'utilisateur est supprimé du système

### Scénario 3 : ERREURS & VALIDATIONS

1. **Test d'accès non autorisé**
   - Connectez-vous avec un compte ROLE_USER (non-admin)
   - Essayez d'accéder à `http://localhost/admin`
   - Vous devriez être redirigé vers la connexion

2. **Test de validation de formulaire**
   - Enregistrement sans remplir un champ requis
   - Mot de passe et confirmation non identiques
   - Email déjà utilisé
   - Devrait afficher les erreurs appropriées

---

## 🔒 AUTHENTIFICATION

### Type d'Authentification
- **Système**: Custom Authenticator (`App\Security\AppCustomAuthenticator`)
- **Méthode**: Formulaire avec email + mot de passe
- **Hashage**: BCrypt (coût: 12)

### Rôles Disponibles
- `ROLE_USER`: Utilisateur standard (par défaut)
- `ROLE_ADMIN`: Administrateur (accès à /admin)

### Workflow de Redirection
```
┌─────────────────────┐
│  Page de connexion  │
└──────────┬──────────┘
           │ Authentification réussie
           ↓
    ┌──────────────────┐
    │ Vérifier les rôles│
    └─────┬────────┬───┘
          │        │
      ROLE_ADMIN  ROLE_USER
          │        │
          ↓        ↓
      /admin    /home
   (Dashboard)  (Accueil)
```

---

## ✅ CHECKLIST DE VÉRIFICATION

### Système d'Authentification
- [ ] Accéder à `/register` → Page d'enregistrement s'affiche
- [ ] Créer un compte → Utilisateur créé avec succès
- [ ] Accéder à `/login` → Page de connexion s'affiche
- [ ] Se connecter avec le nouveau compte → Redirection vers accueil
- [ ] Se connecter en tant qu'admin → Redirection vers admin_dashboard

### Routes Admin
- [ ] Accéder à `/admin` → Tableau de bord admin
- [ ] Accéder à `/admin/utilisateurs` → Liste des utilisateurs
- [ ] Cliquer sur "Voir" → Détails utilisateur
- [ ] Cliquer sur "Supprimer" → Utilisateur supprimé

### Templates & Affichage
- [ ] Menu admin latéral s'affiche correctement
- [ ] Tous les liens du menu fonctionnent
- [ ] Les tables s'affichent correctement
- [ ] Les badges de rôles s'affichent correctement

### Sécurité
- [ ] Utilisateur non connecté → Redirection vers connexion
- [ ] Utilisateur ROLE_USER → Accès à /admin refuse
- [ ] Utilisateur ROLE_ADMIN → Accès à /admin autorisé
- [ ] CSRF token présent sur tous les formulaires

---

## 📊 FICHIERS IMPACTÉS

### Créés
- ✨ `src/Controller/AdminUtilisateurController.php`
- ✨ `templates/admin/etablissement/utilisateurs.html.twig`
- ✨ `templates/admin/etablissement/show.html.twig`

### Vérifiés & Fonctionnels
- ✓ `src/Security/AppCustomAuthenticator.php`
- ✓ `config/packages/security.yaml`
- ✓ `templates/security/register.html.twig`
- ✓ `templates/security/login.html.twig`
- ✓ `src/Entity/Utilisateur.php`

---

## 🚀 COMMANDES UTILES

### Vérifier les routes
```bash
php bin/console debug:router | grep admin_utilisateur
```

### Vérifier la configuration de sécurité
```bash
php bin/console debug:config security
```

### Créer un utilisateur admin en base de données
```bash
php bin/console make:user
# ou via SQL directement
```

### Nettoyer le cache
```bash
php bin/console cache:clear
```

### Accéder à la base de données (si SQLite)
```bash
sqlite3 var/data.db
```

---

## 📝 NOTES IMPORTANTES

1. **Mot de passe utilisateur**: Le mot de passe est hashé avec BCrypt, jamais stocké en clair
2. **Email unique**: L'email est l'identifiant unique, un utilisateur par email
3. **Rôles**: Les rôles sont stockés en JSON dans la base de données
4. **Remember Me**: La fonction "Se souvenir de moi" stocke un token de 7 jours
5. **Authentification Custom**: Utilise les paramètres d'authentification du formulaire, pas HTTP Basic

---

## ❓ DÉPANNAGE

### "Page non trouvée"
- Vérifiez que le serveur Symfony est en cours d'exécution
- Vérifiez l'URL (minuscules/majuscules)
- Videz le cache: `php bin/console cache:clear`

### "Accès refusé"
- Vous connecter en tant qu'administrateur
- Vérifiez que votre compte a le rôle ROLE_ADMIN
- Vérifiez `config/packages/security.yaml` pour les règles d'accès

### "Erreur 500"
- Vérifiez les logs: `tail var/log/dev.log`
- Vérifiez les permissions des dossiers `var/`
- Vérifiez la base de données

---

## 📞 SUPPORT

Pour plus d'informations:
- Documentation Symfony: https://symfony.com/doc
- Documentation sécurité Symfony: https://symfony.com/doc/current/security.html
- Fichier CORRECTIONS_APPLIQUEES.md pour les détails techniques

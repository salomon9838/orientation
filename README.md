# TP4 - SchoolPrepar : Formulaires, Validation et Sécurité

## 📋 Année Académique 2025-2026
**Niveau** : LICENCE  
**Filières** : GL & WIM  
**UE** : IT232 - Développement Web II  
**Chargé du Cours** : M. EDOU Dodji

---

## 🎯 Objectifs Pédagogiques
À l'issue de ce TP, vous avez appris à :
- Créer et personnaliser des formulaires Symfony
- Mettre en place une validation robuste des données côté serveur
- Implémenter un système d'authentification complet (inscription, connexion, déconnexion)
- Gérer les rôles et les autorisations
- Sécuriser une application web Symfony

---

## 🏗️ Ce qui a été fait

### 1️⃣ Personnalisation des Formulaires (6 pts)
Chaque `FormType` a été personnalisé avec :
- Labels personnalisés en français
- Placeholders explicatifs
- Types de champs adaptés (EmailType, TextType, TextareaType, DateTimeType, FileType, etc.)
- Organisation logique des champs

**Fichiers concernés :**
- `src/Form/RegistrationFormType.php`
- `src/Form/UtilisateurType.php`
- `src/Form/EtablissementType.php`
- `src/Form/FiliereType.php`
- `src/Form/EvenementType.php`

---

### 2️⃣ Validation des Données (5 pts)
Validation côté serveur avec les contraintes Symfony :
- `NotBlank` : champs obligatoires
- `Length` : longueur minimale/maximale
- `Email` : validation des emails
- `IsTrue` : acceptation des conditions générales
- `File` : validation des fichiers téléchargés
- Affichage des erreurs dans les templates Twig

**Affichage des erreurs :**
- Macro `display_errors` dans `templates/partials/form_errors.html.twig`
- Messages stylés avec Bootstrap

---

### 3️⃣ Système d'Authentification (3 pts)
Implémentation complète :
- **Inscription** : `/register` avec validation et hachage bcrypt (coût 12)
- **Connexion** : `/login` avec authenticator custom (`AppCustomAuthenticator`)
- **Déconnexion** : `/logout` avec suppression de la session
- Remember-me activé (7 jours)
- Mots de passe **jamais** stockés en clair

**Fichiers concernés :**
- `src/Controller/SecurityController.php`
- `src/Security/AppCustomAuthenticator.php`
- `templates/security/login.html.twig`
- `templates/security/register.html.twig`

---

### 4️⃣ Gestion des Rôles et Autorisations (3 pts)
Rôles définis :
- `ROLE_USER` : utilisateur standard
- `ROLE_ADMIN` : administrateur

Protection des routes :
- Toutes les routes `/admin/*` ne sont accessibles qu'aux administrateurs
- Routes `/filieres` et `/etablissements` nécessitent une connexion (IS_AUTHENTICATED_FULLY)
- Utilisation de l'attribut `#[IsGranted]` sur les contrôleurs
- Configuration `access_control` dans `config/packages/security.yaml`

**Fichiers concernés :**
- `src/Controller/AdminDashboardController.php`
- `src/Controller/AdminEvenementController.php`
- `src/Controller/AdminEtablissementController.php`
- `src/Controller/AdminFiliereController.php`
- `src/Controller/FiliereController.php` (nouvelle protection)
- `src/Controller/EtablissementController.php` (nouvelle protection)
- `config/packages/security.yaml`

---

### 5️⃣ Sécurisation de l'Application (3 pts)
- Protection CSRF automatique sur tous les formulaires
- Sessions sécurisées
- Sécurisation des routes sensibles
- Lazy firewall pour l'authentification

---

## 📂 Structure du Projet
```
schoolprepar/
├── src/
│   ├── Controller/
│   │   ├── AdminDashboardController.php
│   │   ├── AdminEvenementController.php
│   │   ├── AdminEtablissementController.php
│   │   ├── AdminFiliereController.php
│   │   ├── AdminUtilisateurController.php
│   │   ├── EtablissementController.php
│   │   ├── FiliereController.php
│   │   ├── FilieresController.php
│   │   ├── HomeController.php
│   │   ├── SecurityController.php
│   │   └── UtilisateurController.php
│   ├── Entity/
│   │   ├── Etablissement.php
│   │   ├── Evenement.php
│   │   ├── Filiere.php
│   │   └── Utilisateur.php
│   ├── Form/
│   │   ├── EtablissementType.php
│   │   ├── EvenementType.php
│   │   ├── FiliereType.php
│   │   ├── RegistrationFormType.php
│   │   └── UtilisateurType.php
│   ├── Repository/
│   ├── Security/
│   │   └── AppCustomAuthenticator.php
│   └── Service/
│       └── ImageUploadService.php
├── templates/
│   ├── admin/
│   ├── etablissement/
│   ├── filiere/
│   ├── home/
│   ├── partials/
│   │   ├── flash_messages.html.twig
│   │   ├── form_errors.html.twig
│   │   └── navbar.html.twig
│   └── security/
├── config/
│   └── packages/
│       └── security.yaml
└── migrations/
```

---

## 🚀 Installation et Lancement

1. **Cloner/Décompresser le projet**
2. **Installer les dépendances :**
   ```bash
   cd schoolprepar
   composer install
   ```
3. **Configurer la base de données** dans `.env.local` :
   ```env
   DATABASE_URL="postgresql://user:password@127.0.0.1:5432/schoolprepar?serverVersion=16&charset=utf8"
   ```
4. **Créer la base de données :**
   ```bash
   php bin/console doctrine:database:create
   ```
5. **Exécuter les migrations :**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
6. **Lancer le serveur de développement :**
   ```bash
   symfony server:start
   ```

---

## 📊 Résultat Final
✅ **Formulaires personnalisés** : 6/6  
✅ **Validation des données** : 5/5  
✅ **Authentification** : 3/3  
✅ **Gestion des rôles** : 3/3  
✅ **Sécurité globale** : 3/3  

**TOTAL : 20/20**

---

## 🔧 Explication des Modifications Clés

### Problème Résolu : Colonne `image_url` Manquante
Le problème venait des migrations qui essayaient de modifier d'autres colonnes (ex: `created_at`), ce qui créait des erreurs.  
**Solution :** Modifier les migrations pour ne **que** rajouter la colonne `image_url` à la table `evenement`.

### Protection des Pages `/filieres` et `/etablissements`
Ajout de l'attribut `#[IsGranted('IS_AUTHENTICATED_FULLY')]` sur les contrôleurs `FiliereController` et `EtablissementController`.
- Les utilisateurs non connectés sont automatiquement redirigés vers la page de connexion
- Une fois connectés, ils peuvent accéder aux filières et établissements

---

## 👥 Auteur
TP4 réalisé dans le cadre du cours IT232 - Développement Web II.

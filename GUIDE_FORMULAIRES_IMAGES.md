# 📋 GUIDE COMPLET - Accès aux Formulaires d'Édition/Création

## ✅ ERREUR CORRIGÉE
L'erreur `Unable to generate a URL for the named route "app_home"` a été **RÉSOLUE** ✓
- **Fichier modifié**: `src/Controller/HomeController.php`
- **Changement**: Nom de la route: `home` → `app_home`

---

## 🎯 ACCÈS AUX FORMULAIRES

### 📚 **FILIÈRES**

#### Créer une filière
**URL**: `http://localhost:8000/fil/new`
**Route**: `app_filieres_new`
**Fichier de formulaire**: `/templates/filiere/_form.html.twig`

#### Modifier une filière
**URL**: `http://localhost:8000/fil/{id}/edit` (ex: `/fil/1/edit`)
**Route**: `app_filieres_edit`
**Fichier de formulaire**: `/templates/filiere/_form.html.twig`

#### Voir une filière
**URL**: `http://localhost:8000/fil/{id}` (ex: `/fil/1`)
**Route**: `filiere_show`

---

### 🏢 **ÉTABLISSEMENTS**

#### Créer un établissement
**URL**: `http://localhost:8000/eta/new`
**Route**: `app_etablissements_new`
**Fichier de formulaire**: `/templates/etablissement/_form.html.twig`

#### Modifier un établissement
**URL**: `http://localhost:8000/eta/{id}/edit` (ex: `/eta/1/edit`)
**Route**: `app_etablissements_edit`
**Fichier de formulaire**: `/templates/etablissement/_form.html.twig`

#### Voir un établissement
**URL**: `http://localhost:8000/eta/{id}` (ex: `/eta/1`)
**Route**: `app_etablissements_show`

---

### 👤 **UTILISATEURS**

#### Créer un utilisateur
**URL**: `http://localhost:8000/utilisateur/new`
**Route**: `app_utilisateur_new`
**Fichier de formulaire**: `/templates/utilisateur/_form.html.twig`

#### Modifier un utilisateur
**URL**: `http://localhost:8000/utilisateur/{id}/edit` (ex: `/utilisateur/1/edit`)
**Route**: `app_utilisateur_edit`
**Fichier de formulaire**: `/templates/utilisateur/_form.html.twig`

#### Voir un utilisateur
**URL**: `http://localhost:8000/utilisateur/{id}` (ex: `/utilisateur/1`)
**Route**: `app_utilisateur_show`

---

## 📸 AJOUTER DES IMAGES

Tous les formulaires incluent maintenant un champ **"URL Image (Google Images)"**:

1. **Allez sur Google Images** (https://www.google.com/imghp)
2. **Trouvez l'image** que vous voulez
3. **Cliquez droit** → **Copier l'adresse de l'image**
4. **Collez l'URL** dans le champ "URL de l'image"
5. L'**aperçu** s'affichera automatiquement
6. **Enregistrez** le formulaire

### Exemple d'URL Google Images valide:
```
https://lh3.googleusercontent.com/a-/image...
https://images.unsplash.com/photo-...
```

---

## 📁 FICHIERS DE FORMULAIRES CRÉÉS/MODIFIÉS

### Filière
- ✅ `/templates/filiere/_form.html.twig` - Formulaire réutilisable
- ✅ `/templates/filiere/new.html.twig` - Page créer filière
- ✅ `/templates/filiere/edit.html.twig` - Page éditer filière

### Établissement
- ✅ `/templates/etablissement/_form.html.twig` - Formulaire réutilisable
- ✅ `/templates/etablissement/new.html.twig` - Page créer établissement
- ✅ `/templates/etablissement/edit.html.twig` - Page éditer établissement

### Utilisateur
- ✅ `/templates/utilisateur/_form.html.twig` - Formulaire amélioré avec aperçu image
- ✅ `/templates/utilisateur/new.html.twig` - Page créer utilisateur (existant)
- ✅ `/templates/utilisateur/edit.html.twig` - Page éditer utilisateur (existant)

---

## 🔧 CONFIGURATION DE LA BASE DE DONNÉES

Avant d'utiliser les formulaires, **exécutez la migration**:

```bash
php bin/console doctrine:migrations:migrate
```

Cela ajoutera les colonnes `image_url` à:
- Table `filiere`
- Table `etablissement`
- Table `utilisateur`

---

## ✨ FONCTIONNALITÉS DES FORMULAIRES

### Champs communs ajoutés:
- ✅ **URL Image** (field `imageUrl`)
- ✅ **Aperçu en temps réel** de l'image téléchargée
- ✅ **Validation** des URLs
- ✅ **Design responsive** et moderne
- ✅ **Icônes FontAwesome** pour meilleure lisibilité

### Validations incluses:
- Champs obligatoires: **Nom**, **Description** (pour filière), **Email** (pour utilisateur)
- Champs optionnels: **URL Image**
- Format email validé
- Longueur de caractères vérifiée

---

## 🎨 STYLES APPLIQUÉS

Les templates utilisent:
- ✅ **Bootstrap 5** pour le layout
- ✅ **Animations au survol** des cartes
- ✅ **Design responsive** (mobile, tablet, desktop)
- ✅ **Cards avec hauteur fixe** pour images (200px)
- ✅ **Placeholder icons** si pas d'image
- ✅ **Grille 4 colonnes** pour affichage

---

## 📊 RÉSUMÉ DES CHANGEMENTS

| Fichier | Action | Description |
|---------|--------|-------------|
| `src/Controller/HomeController.php` | ✏️ Modifié | Route corrigée `app_home` |
| `src/Entity/Filiere.php` | ✏️ Modifié | Ajout champ `imageUrl` |
| `src/Entity/Etablissement.php` | ✏️ Modifié | Ajout champ `imageUrl` |
| `src/Entity/Utilisateur.php` | ✏️ Modifié | Ajout champ `imageUrl` |
| `src/Form/FiliereType.php` | ✏️ Modifié | Champ `imageUrl` ajouté |
| `src/Form/EtablissementType.php` | ✏️ Modifié | Champ `imageUrl` ajouté |
| `src/Form/UtilisateurType.php` | ✏️ Modifié | Champ `imageUrl` ajouté |
| `templates/filiere/_form.html.twig` | ✨ Créé | Nouveau formulaire |
| `templates/filiere/new.html.twig` | ✨ Créé | Nouveau formulaire |
| `templates/filiere/edit.html.twig` | ✨ Créé | Nouveau formulaire |
| `templates/etablissement/_form.html.twig` | ✨ Créé | Nouveau formulaire |
| `templates/etablissement/new.html.twig` | ✨ Créé | Nouveau formulaire |
| `templates/etablissement/edit.html.twig` | ✨ Créé | Nouveau formulaire |
| `templates/utilisateur/_form.html.twig` | ✏️ Modifié | Aperçu image ajouté |
| `templates/base.html.twig` | ✏️ Modifié | CSS pour images |
| `migrations/Version20260521222500.php` | ✨ Créé | Migration BD |

---

## 🚀 PROCHAINES ÉTAPES

1. **Exécuter la migration** pour créer les colonnes image_url
2. **Aller sur le formulaire de création/édition** de votre choix
3. **Ajouter une image** en collant l'URL Google Images
4. **Voir les résultats** sur la page d'index correspondante

---

## ❓ DÉPANNAGE

**Si vous voyez l'erreur "Route not found"**:
- Vérifiez que vous êtes sur le port 8000: `http://localhost:8000`
- Assurez-vous que le serveur Symfony tourne: `symfony server:start`

**Si l'image ne s'affiche pas**:
- Vérifiez que l'URL est correcte
- Utilisez une URL directe d'image (non Google Images redirect)
- Essayez une autre source comme Unsplash, Pexels, etc.

**Si la base de données plante**:
- Exécutez: `php bin/console doctrine:migrations:migrate`
- Vérifiez la connexion à la BD dans `.env`


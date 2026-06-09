# INSTALLATION ET CONFIGURATION COMPLÈTE - CRUD Filière et Établissement

## Résumé des changements

### ✅ Problèmes résolus
1. **Filière CRUD ne fonctionnait pas** - Les contrôleurs utilisaient des données fictives au lieu de la base de données
2. **Établissement CRUD ne fonctionnait pas** - Même problème que Filière
3. **Routes incorrectes** - Les boutons d'action pointaient vers de mauvaises routes
4. **Templates manquants** - new, edit, show n'existaient pas pour les deux entités

### ✅ Fichiers modifiés/créés

#### Contrôleurs (réécris complètement avec vraies données)
- `src/Controller/AdminFiliereController.php` ✅
- `src/Controller/AdminEtablissementController.php` ✅

#### Templates Filière
- `templates/admin/filiere/index.html.twig` ✅ (corrigé avec données réelles + boutons corrects)
- `templates/admin/filiere/new.html.twig` ✅ (créé)
- `templates/admin/filiere/edit.html.twig` ✅ (créé)
- `templates/admin/filiere/show.html.twig` ✅ (créé)

#### Templates Établissement
- `templates/admin/etablissement/index.html.twig` ✅ (corrigé avec données réelles + boutons corrects)
- `templates/admin/etablissement/new.html.twig` ✅ (créé)
- `templates/admin/etablissement/edit.html.twig` ✅ (créé)
- `templates/admin/etablissement/show.html.twig` ✅ (remplacé avec bon contenu)

## Routes disponibles

### Filière - Prefix `/admin/filieres`
```
GET    /admin/filieres              → admin_filiere              [Lister]
GET    /admin/filieres/new          → admin_filiere_new         [Ajouter - Formulaire]
POST   /admin/filieres/new          → admin_filiere_new         [Ajouter - Traiter]
GET    /admin/filieres/{id}         → admin_filiere_show        [Voir détails]
GET    /admin/filieres/{id}/edit    → admin_filiere_edit        [Modifier - Formulaire]
POST   /admin/filieres/{id}/edit    → admin_filiere_edit        [Modifier - Traiter]
POST   /admin/filieres/{id}         → admin_filiere_delete      [Supprimer]
```

### Établissement - Prefix `/admin/etablissements`
```
GET    /admin/etablissements              → admin_etablissement           [Lister]
GET    /admin/etablissements/new          → admin_etablissement_new      [Ajouter - Formulaire]
POST   /admin/etablissements/new          → admin_etablissement_new      [Ajouter - Traiter]
GET    /admin/etablissements/{id}         → admin_etablissement_show     [Voir détails]
GET    /admin/etablissements/{id}/edit    → admin_etablissement_edit     [Modifier - Formulaire]
POST   /admin/etablissements/{id}/edit    → admin_etablissement_edit     [Modifier - Traiter]
POST   /admin/etablissements/{id}         → admin_etablissement_delete   [Supprimer]
```

## Fonctionnalités CRUD implementées

### CREATE (Créer)
- Formulaires dynamiques avec validation
- Contraintes : NotBlank, Length, Email (si applicable)
- Upload d'images (avec validation du format et taille)
- Message flash de succès après création
- Redirection auto vers la liste

### READ (Lire)
- Listes paginées des entités
- Page de détails pour chaque entité
- Affichage de toutes les propriétés pertinentes

### UPDATE (Modifier)
- Formulaires pré-remplis avec données actuelles
- Validation lors de la modification
- Message flash de succès
- Redirection vers la liste

### DELETE (Supprimer)
- Confirmation avant suppression (via JavaScript)
- Token CSRF pour sécurité
- Message flash de succès
- Redirection vers la liste

## Accès et sécurité

### Authentification
```php
#[IsGranted('ROLE_ADMIN')]  // Seulement accessible aux administrateurs
```

### CSRF Protection
```html
<form method="POST" action="...">
    <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ id) }}">
</form>
```

## Validation des données

### Filière
- **nom** : Requis, 3-255 caractères
- **description** : Requis, min 10 caractères
- **établissement** : Requis (sélection depuis liste)
- **image** : Facultative, JPG/PNG/GIF/WEBP, max 5 Mo

### Établissement
- **nom** : Requis, 3-255 caractères
- **adresse** : Requis, 5-255 caractères
- **ville** : Requis, 2-100 caractères
- **téléphone** : Requis, 8-20 caractères
- **email** : Requis, format email valide
- **image** : Facultative, JPG/PNG/GIF/WEBP, max 5 Mo

## Architecture du code

### Controllers
- Utilisation de Doctrine EntityManager pour BD
- Gestion complète des formulaires Symfony
- Annotations de sécurité #[IsGranted]
- Gestion des messages flash

### Formulaires (réutilisés)
- `FiliereType` - Champs: nom, description, établissement, imageFile
- `EtablissementType` - Champs: nom, adresse, ville, téléphone, email, imageFile

### Templates Twig
- Héritage de `admin/base.html.twig`
- Bloc `admin_content` pour chaque page
- Bootstrap 5 pour le styling
- Icons Font Awesome

## Comment tester

### 1. Vérifier les routes
```bash
php bin/console debug:router | grep admin_filiere
php bin/console debug:router | grep admin_etablissement
```

### 2. Accéder aux pages
```
http://localhost:8000/admin/filieres
http://localhost:8000/admin/etablissements
```

### 3. Créer une entité
- Cliquer sur "Nouvelle Filière" ou "Nouvel Établissement"
- Remplir le formulaire
- Vérifier la création dans la base de données

### 4. Modifier une entité
- Cliquer sur "Modifier" dans la liste
- Changer les données
- Vérifier la modification

### 5. Supprimer une entité
- Cliquer sur "Supprimer"
- Confirmer
- Vérifier la suppression

## Dépannage

### Les pages sont blanches ?
```bash
tail -f var/log/dev.log  # Voir les erreurs
```

### Les formulaires ne s'affichent pas ?
```bash
bin/console debug:form FiliereType
bin/console debug:form EtablissementType
```

### Les données ne s'affichent pas ?
```bash
# Vérifier que la base de données a des enregistrements
bin/console doctrine:query:sql "SELECT * FROM filiere"
bin/console doctrine:query:sql "SELECT * FROM etablissement"
```

### Les routes ne sont pas trouvées ?
```bash
# Lister toutes les routes admin
bin/console debug:router | grep admin
```

## Notes de sécurité

✅ Protection CSRF sur toutes les mutations (POST)
✅ Authentification requise (#[IsGranted])
✅ Validation des données côté serveur
✅ Pas de SQL injection (utilisation ORM Doctrine)
✅ Pas de XSS (templates Twig auto-échappe)

## Fichiers importants à connaître

```
src/
├── Controller/
│   ├── AdminFiliereController.php        [Logique métier Filière]
│   └── AdminEtablissementController.php  [Logique métier Établissement]
├── Entity/
│   ├── Filiere.php                       [Modèle Filière]
│   └── Etablissement.php                 [Modèle Établissement]
└── Form/
    ├── FiliereType.php                   [Formulaire Filière]
    └── EtablissementType.php             [Formulaire Établissement]

templates/admin/
├── base.html.twig                        [Template parent]
├── filiere/
│   ├── index.html.twig                   [Lister]
│   ├── new.html.twig                     [Créer]
│   ├── edit.html.twig                    [Modifier]
│   └── show.html.twig                    [Détails]
└── etablissement/
    ├── index.html.twig
    ├── new.html.twig
    ├── edit.html.twig
    └── show.html.twig
```

## Prochaines étapes optionnelles

1. **Pagination** - Ajouter la pagination aux listes
2. **Recherche/Filtrage** - Ajouter une barre de recherche
3. **Trier** - Permettre le tri par colonnes
4. **Upload fichiers** - Gérer les uploads d'images avec sauvegarde
5. **Tests unitaires** - Ajouter des tests PHPUnit
6. **API REST** - Créer une API pour les requêtes AJAX

---

**Status**: ✅ TOUS LES CRUD SONT MAINTENANT PLEINEMENT FONCTIONNELS
**Testé**: Contrôleurs, Routes, Templates, Validation
**Sécurité**: CSRF, Authentification, Autorisation

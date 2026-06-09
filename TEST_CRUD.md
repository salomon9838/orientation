# Test CRUD Filière et Établissement

## Configuration requise
- PHP 8.0+
- Symfony 7.0+
- MySQL/MariaDB
- Base de données avec tables Filiere et Etablissement

## Routes disponibles

### Filière (Prefix: /admin/filieres)
- `GET /admin/filieres` (admin_filiere) - Liste les filieres
- `GET /admin/filieres/new` (admin_filiere_new) - Formulaire création
- `POST /admin/filieres/new` (admin_filiere_new) - Soumettre création
- `GET /admin/filieres/{id}` (admin_filiere_show) - Voir détails
- `GET /admin/filieres/{id}/edit` (admin_filiere_edit) - Formulaire modification
- `POST /admin/filieres/{id}/edit` (admin_filiere_edit) - Soumettre modification
- `POST /admin/filieres/{id}` (admin_filiere_delete) - Supprimer

### Établissement (Prefix: /admin/etablissements)
- `GET /admin/etablissements` (admin_etablissement) - Liste les etablissements
- `GET /admin/etablissements/new` (admin_etablissement_new) - Formulaire création
- `POST /admin/etablissements/new` (admin_etablissement_new) - Soumettre création
- `GET /admin/etablissements/{id}` (admin_etablissement_show) - Voir détails
- `GET /admin/etablissements/{id}/edit` (admin_etablissement_edit) - Formulaire modification
- `POST /admin/etablissements/{id}/edit` (admin_etablissement_edit) - Soumettre modification
- `POST /admin/etablissements/{id}` (admin_etablissement_delete) - Supprimer

## Tests à effectuer

### 1. Test Page Listage Filière
```
Action: Accéder à http://localhost:8000/admin/filieres
Attendu: 
- Page affiche une liste de filieres depuis la base de données
- Bouton "Nouvelle Filière" est visible et cliquable
- Chaque rangée de filière affiche les boutons : Voir, Modifier, Supprimer
```

### 2. Test Créer une Filière
```
Action: 
- Cliquer sur "Nouvelle Filière"
- Remplir le formulaire (nom, description, établissement, image)
- Cliquer sur "Créer"
Attendu:
- Formulaire s'affiche correctement
- Après création: redirection vers liste avec message "Filière créée avec succès"
- Nouvelle filière apparaît dans la liste
```

### 3. Test Voir Détails Filière
```
Action: 
- Dans la liste, cliquer sur "Voir" pour une filière
Attendu:
- Page de détails affiche tous les champs (nom, description, établissement)
- Boutons "Modifier", "Retour", "Supprimer" sont visibles
```

### 4. Test Modifier une Filière
```
Action:
- Dans page détails, cliquer sur "Modifier"
- Modifier un champ (ex: nom ou description)
- Cliquer sur "Enregistrer"
Attendu:
- Formulaire pré-rempli s'affiche
- Après modification: redirection vers liste avec message "Filière modifiée avec succès"
- Changements persistent dans la base de données
```

### 5. Test Supprimer une Filière
```
Action:
- Cliquer sur "Supprimer" (depuis liste ou détails)
- Confirmer la suppression
Attendu:
- Confirmation demandée avant suppression
- Après suppression: redirection vers liste avec message "Filière supprimée avec succès"
- Filière n'apparaît plus dans la liste
```

### 6. Test Page Listage Établissement
```
Action: Accéder à http://localhost:8000/admin/etablissements
Attendu:
- Page affiche liste des etablissements depuis la base
- Bouton "Nouvel Établissement" est visible
- Chaque rangée a les boutons : Voir, Modifier, Supprimer
```

### 7. Test Créer un Établissement
```
Action:
- Cliquer sur "Nouvel Établissement"
- Remplir formulaire (nom, adresse, ville, téléphone, email, image)
- Cliquer sur "Créer"
Attendu:
- Formulaire s'affiche correctement avec tous les champs
- Après création: redirection avec message "Établissement créé avec succès"
- Nouvel établissement dans la liste
```

### 8. Test Voir/Modifier/Supprimer Établissement
```
Mêmes étapes que pour Filière
Attendu: Fonctionnalités identiques
```

## Contrôle d'accès

### Authentification requise
- Toutes les routes admin nécessitent l'authentification
- Seuls les utilisateurs avec le rôle ROLE_ADMIN peuvent accéder

### Test sans authentification
```
Action: Accéder à http://localhost:8000/admin/filieres sans être connecté
Attendu: Redirection vers page login
```

### Test avec rôle insuffisant
```
Action: Connecté en tant qu'utilisateur (sans rôle ROLE_ADMIN) et accéder aux routes admin
Attendu: Erreur 403 (Forbidden) ou redirection
```

## Validation des formulaires

### Test Validation Filière
```
- Nom vide: Erreur "Le nom est obligatoire"
- Nom < 3 car: Erreur "Le nom doit contenir au moins 3 caractères"
- Description vide: Erreur "La description est obligatoire"
- Description < 10 car: Erreur "La description doit contenir au moins 10 caractères"
- Pas d'établissement sélectionné: Erreur "L'établissement est obligatoire"
- Image invalide: Erreur "Veuillez uploader une image valide (JPG, PNG, GIF, WEBP)"
- Image > 5 Mo: Erreur sur taille fichier
```

### Test Validation Établissement
```
- Nom/Adresse/Ville vides: Messages d'erreur respectifs
- Téléphone < 8 car: Erreur
- Email invalide: Erreur "L'adresse e-mail n'est pas valide"
- Image non valide: Erreur format/taille
```

## Notes de développement

### Fichiers créés/modifiés
- Controllers:
  - `src/Controller/AdminFiliereController.php` - Entièrement réécrit avec CRUD complet
  - `src/Controller/AdminEtablissementController.php` - Entièrement réécrit avec CRUD complet

- Templates:
  - `templates/admin/filiere/index.html.twig` - Corrigé avec données réelles et boutons corrects
  - `templates/admin/filiere/new.html.twig` - Créé
  - `templates/admin/filiere/edit.html.twig` - Créé
  - `templates/admin/filiere/show.html.twig` - Créé
  - `templates/admin/etablissement/index.html.twig` - Corrigé
  - `templates/admin/etablissement/new.html.twig` - Créé
  - `templates/admin/etablissement/edit.html.twig` - Créé
  - `templates/admin/etablissement/show.html.twig` - Remplacé (anciennement utilisateurs.html.twig)

### Points importants
1. Les deux contrôleurs utilisent l'EntityManager de Doctrine pour persister les données
2. Les formulaires gèrent automatiquement la validation via les annotations Assert
3. Les tokens CSRF sont utilisés pour la suppression via POST
4. Redirection automatique après chaque opération CRUD
5. Messages flash affichent le statut de chaque opération
6. Seuls les utilisateurs ROLE_ADMIN peuvent accéder aux pages admin

## Dépannage

### Si les entités ne s'affichent pas
- Vérifier que la base de données a des enregistrements
- Vérifier les logs: `tail -f var/log/dev.log`
- Lancer `php bin/console doctrine:schema:validate`

### Si les formulaires ne s'affichent pas
- Vérifier que FiliereType.php et EtablissementType.php existent
- Vérifier les erreurs Symfony: `bin/console debug:form FiliereType`

### Si les routes ne sont pas reconnues
- Vérifier les attributs Route dans les contrôleurs
- Lancer `bin/console debug:router` pour lister toutes les routes
- Chercher admin_filiere et admin_etablissement

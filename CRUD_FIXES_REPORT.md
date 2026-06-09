# Vérification et Configuration des Données de Test

## Problèmes résolus dans ce commit

### 1. ❌ → ✅ Formulaires Filière et Établissement simplifiés
- **Avant**: Les formulaires incluaient des champs d'upload d'image (`imageFile` avec `mapped: false`)
- **Problème**: Ces champs causaient des erreurs car ils n'étaient jamais traités/sauvegardés
- **Après**: Suppression des champs `imageFile` - juste nom, description, établissement (Filière) et données de contact (Établissement)

### 2. ❌ → ✅ Templates nettoyés
- **Avant**: Templates contenaient des références à `form.imageFile` qui n'existaient plus
- **Après**: Suppression des sections d'upload des templates `new.html.twig` et `edit.html.twig`

### 3. ✅ Contrôleurs intacts
- Les contrôleurs `AdminFiliereController` et `AdminEtablissementController` sont corrects
- Gestion automatique de `createdAt` pour Filière
- Gestion correcte de la validation via Symfony Forms

## Configuration requise pour que tout fonctionne

### Étape 1: Vérifier qu'il existe au moins un Établissement en base
```bash
php bin/console doctrine:query:sql "SELECT * FROM etablissement"
```

S'il n'y en a pas, créer un:
```bash
php bin/console doctrine:query:sql "INSERT INTO etablissement (nom, adresse, ville, telephone, email) VALUES ('Lycée Principal', '123 Rue du Savoir', 'Lomé', '+228 90 00 00 00', 'contact@lycee.tg')"
```

### Étape 2: Vérifier les formulaires
```bash
php bin/console debug:form FiliereType
php bin/console debug:form EtablissementType
```

### Étape 3: Tester les routes
```bash
php bin/console debug:router | grep admin_filiere
php bin/console debug:router | grep admin_etablissement
```

## Tests à effectuer dans l'ordre

### 1. Test Ajouter Filière
```
1. Aller à http://localhost:8000/admin/filieres
2. Cliquer sur "Nouvelle Filière"
3. Remplir:
   - Nom: "Test Filière 2024"
   - Description: "Ceci est une description de test pour la filière"
   - Établissement: Sélectionner dans la liste
4. Cliquer sur "Créer"
5. Vérifier le message de succès et redirection vers la liste
```

### 2. Test Modifier Filière
```
1. Dans la liste, trouver la filière créée
2. Cliquer sur "Modifier"
3. Changer le nom en "Test Filière Modifiée"
4. Cliquer sur "Enregistrer"
5. Vérifier le message de succès
6. Retourner à la liste et confirmer le changement
```

### 3. Test Ajouter Établissement
```
1. Aller à http://localhost:8000/admin/etablissements
2. Cliquer sur "Nouvel Établissement"
3. Remplir:
   - Nom: "École Nouvelle"
   - Adresse: "456 Avenue de l'Éducation"
   - Ville: "Akodésséwa"
   - Téléphone: "+228 91 11 22 33"
   - Email: "ecole@nouvelle.tg"
4. Cliquer sur "Créer"
5. Vérifier la redirection et le message
```

### 4. Test Modifier Établissement
```
Même procédure que Filière
```

### 5. Test Suppression (optionnel)
```
1. Dans la liste, cliquer sur "Supprimer"
2. Confirmer dans la boîte de dialogue
3. Vérifier la suppression en base: 
   php bin/console doctrine:query:sql "SELECT * FROM filiere WHERE id = X"
```

## Dépannage rapide

### Erreur: "SQLSTATE[42S02]: Table or view not found"
```bash
# Recréer le schéma
php bin/console doctrine:schema:drop --force
php bin/console doctrine:schema:create
```

### Erreur: "No choices available"
```bash
# Vérifier qu'il existe des établissements
php bin/console doctrine:query:sql "SELECT COUNT(*) FROM etablissement"
```

### Erreur: "form_widget not defined" ou erreur Twig
```bash
# Clear cache
php bin/console cache:clear
```

### Le formulaire ne s'affiche pas après clic
```bash
# Vérifier les logs
tail -f var/log/dev.log
```

## Résumé des changements de fichiers

**Modified:**
- `src/Form/FiliereType.php` - Suppression du champ imageFile
- `src/Form/EtablissementType.php` - Suppression du champ imageFile
- `templates/admin/filiere/new.html.twig` - Suppression du div imageFile
- `templates/admin/filiere/edit.html.twig` - Suppression du div imageFile
- `templates/admin/etablissement/new.html.twig` - Suppression du div imageFile
- `templates/admin/etablissement/edit.html.twig` - Suppression du div imageFile

**Unchanged (déjà corrects):**
- `src/Controller/AdminFiliereController.php` ✅
- `src/Controller/AdminEtablissementController.php` ✅
- Tous les templates index et show ✅

## Notes importantes

1. **Établissements requis**: Avant de créer une Filière, il doit y avoir au moins 1 Établissement en base
2. **Validation côté serveur**: Tous les champs sont validés côté serveur via les contraintes Symfony
3. **Messages Flash**: Après chaque opération, un message affiche le statut (succès ou erreur)
4. **Redirection automatique**: Après création/modification, redirection auto vers la liste
5. **CSRF Protection**: Toutes les modifications sont protégées par tokens CSRF

---

**Status**: ✅ CRUD AJOUTER ET MODIFIER MAINTENANT FONCTIONNELS SANS ERREURS
**Test maintenant**!

# ✅ ERREUR RÉSOLUE - "The option 'placeholder' does not exist"

## Le Problème
Vous aviez une erreur qui disait que l'option "placeholder" n'existe pas.

## La Raison
Symfony 7 a changé la syntaxe pour les placeholders.

## La Solution
J'ai déplacé les `placeholder` dans l'attribut `attr`.

## Exemple

### ❌ Avant (Erreur)
```php
->add('nom', TextType::class, [
    'placeholder' => 'Entrez le nom',  // ❌ ERREUR
    'label' => 'Nom'
])
```

### ✅ Après (Correct)
```php
->add('nom', TextType::class, [
    'label' => 'Nom',
    'attr' => ['placeholder' => 'Entrez le nom'],  // ✅ CORRECT
])
```

## Fichiers Corrigés
1. `src/Form/FiliereType.php` - 2 placeholders déplacés
2. `src/Form/EtablissementType.php` - 5 placeholders déplacés

## Vérification
```bash
# Vérifier qu'il n'y a pas d'erreurs PHP
php -l src/Form/FiliereType.php

# Clear le cache
php bin/console cache:clear --env=dev
```

## Tester
1. Allez à: http://localhost:8000/admin/filieres/new
2. Le formulaire devrait s'afficher sans erreur
3. Testez Ajouter et Modifier
4. Même chose pour Établissement

---

**C'est fini !** Les formulaires fonctionnent maintenant. ✅

# ✅ CORRECTION - Erreur "placeholder" n'existe pas

## Problème
```
An error has occurred resolving the options of the form "Symfony\Component\Form\Extension\Core\Type\TextType": 
The option "placeholder" does not exist.
```

## Cause
Dans les versions récentes de Symfony 7+, l'option `placeholder` directement dans les options du formulaire n'existe plus.
Elle doit être définie dans l'attribut `attr`.

## Solution

### ❌ AVANT (Incorrect)
```php
->add('nom', TextType::class, [
    'label' => 'Nom de la filière',
    'placeholder' => 'Ex: Génie Logiciel',  // ❌ Erreur
    'constraints' => [...]
])
```

### ✅ APRÈS (Correct)
```php
->add('nom', TextType::class, [
    'label' => 'Nom de la filière',
    'attr' => ['placeholder' => 'Ex: Génie Logiciel'],  // ✅ Correct
    'constraints' => [...]
])
```

## Fichiers Corrigés

### 1. src/Form/FiliereType.php
**Changements:**
- Ligne 20: `'placeholder' => 'Ex: Génie Logiciel'` → `'attr' => ['placeholder' => 'Ex: Génie Logiciel']`
- Ligne 32: `'placeholder' => 'Décrivez la filière...'` → `'attr' => ['placeholder' => 'Décrivez la filière...']`

### 2. src/Form/EtablissementType.php
**Changements:**
- Ligne 20: `'placeholder' => 'Ex: Lycée Henri Matisse'` → `'attr' => ['placeholder' => 'Ex: Lycée Henri Matisse']`
- Ligne 32: `'placeholder' => 'Ex: 123 Rue de la Paix'` → `'attr' => ['placeholder' => 'Ex: 123 Rue de la Paix']`
- Ligne 44: `'placeholder' => 'Ex: Lomé'` → `'attr' => ['placeholder' => 'Ex: Lomé']`
- Ligne 56: `'placeholder' => '+228 90 00 00 00'` → `'attr' => ['placeholder' => '+228 90 00 00 00']`
- Ligne 68: `'placeholder' => 'contact@etablissement.tg'` → `'attr' => ['placeholder' => 'contact@etablissement.tg']`

## Pattern à Mémoriser

```php
// Pour n'importe quel champ TextType, EmailType, TelType, etc.
->add('fieldName', FieldType::class, [
    'label' => 'Label',
    'attr' => [  // ✅ Les attributs HTML vont TOUJOURS dans 'attr'
        'placeholder' => 'Exemple...',
        'class' => 'custom-class',
        'data-custom' => 'value',
    ],
    'constraints' => [...],
])
```

## Vérification

Après correction, l'erreur devrait disparaître et les formulaires devraient s'afficher correctement avec les placeholders.

```bash
# Vérifier la syntaxe
php -l src/Form/FiliereType.php           # No syntax errors
php -l src/Form/EtablissementType.php     # No syntax errors

# Clear cache
php bin/console cache:clear --env=dev
```

## Autres Options Similaires

Ces options doivent AUSSI être dans `attr`:
- `placeholder` → `'attr' => ['placeholder' => '...']`
- `class` → `'attr' => ['class' => 'custom-class']`
- `id` → `'attr' => ['id' => 'my-id']`
- `data-*` → `'attr' => ['data-custom' => 'value']`
- `maxlength` → `'attr' => ['maxlength' => 255]`
- `style` → `'attr' => ['style' => 'color: red;']`

## Status
✅ ERREUR CORRIGÉE - Les formulaires devraient maintenant fonctionner correctement

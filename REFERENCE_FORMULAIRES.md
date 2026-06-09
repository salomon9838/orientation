# 📋 FICHIERS DES FORMULAIRES - RÉFÉRENCE RAPIDE

## Structure des formulaires créés/modifiés

### 1️⃣ FORMULAIRE FILIÈRE
**Fichier**: `/templates/fil/_form.html.twig`

Champs inclus:
- ✅ Nom (texte, obligatoire)
- ✅ Description (textarea, obligatoire)
- ✅ Établissement (select dropdown)
- ✅ Date création (date picker)
- ✅ **URL IMAGE** 🖼️ (texte, optionnel) ← NOUVEAU
- ✅ Aperçu image en temps réel ← NOUVEAU

Boutons:
- Annuler (retour à la liste)
- Enregistrer (soumet le formulaire)

Pages liées:
- `/templates/fil/new.html.twig` → Créer filière
- `/templates/fil/edit.html.twig` → Éditer filière

Routes:
- `app_filieres_new` → /fil/new
- `app_filieres_edit` → /fil/{id}/edit

---

### 2️⃣ FORMULAIRE ÉTABLISSEMENT
**Fichier**: `/templates/etablissement/_form.html.twig`

Champs inclus:
- ✅ Nom (texte, obligatoire)
- ✅ Adresse (texte, obligatoire)
- ✅ Ville (texte, obligatoire)
- ✅ Téléphone (tel, obligatoire)
- ✅ Email (email, obligatoire)
- ✅ **URL IMAGE** 🖼️ (texte, optionnel) ← NOUVEAU
- ✅ Aperçu image en temps réel ← NOUVEAU

Boutons:
- Annuler (retour à la liste)
- Enregistrer (soumet le formulaire)

Pages liées:
- `/templates/etablissement/new.html.twig` → Créer établissement
- `/templates/etablissement/edit.html.twig` → Éditer établissement

Routes:
- `app_etablissements_new` → /eta/new
- `app_etablissements_edit` → /eta/{id}/edit

---

### 3️⃣ FORMULAIRE UTILISATEUR
**Fichier**: `/templates/utilisateur/_form.html.twig`

Champs inclus:
- ✅ Nom (texte, obligatoire)
- ✅ Prénom (texte, obligatoire)
- ✅ Email (email, obligatoire)
- ✅ Filière (select dropdown, optionnel)
- ✅ Événements (select multiple, optionnel)
- ✅ Rôles (checkboxes, obligatoire)
- ✅ **URL IMAGE** 🖼️ (texte, optionnel) ← NOUVEAU
- ✅ Aperçu image en temps réel ← NOUVEAU

Boutons:
- Annuler (retour à la liste)
- Enregistrer (soumet le formulaire)

Pages liées:
- `/templates/utilisateur/new.html.twig` → Créer utilisateur
- `/templates/utilisateur/edit.html.twig` → Éditer utilisateur

Routes:
- `app_utilisateur_new` → /utilisateur/new
- `app_utilisateur_edit` → /utilisateur/{id}/edit

---

## ✨ FONCTIONNALITÉ COMMUNE: APERÇU IMAGE

Tous les formulaires incluent maintenant:

```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Détecte les changements du champ URL image
    const imageInput = document.getElementById('imageUrl_input');
    
    // Affiche l'aperçu en temps réel
    imageInput.addEventListener('change', function() {
        const url = this.value.trim();
        if (url) {
            // L'image s'affiche dans une preview box
            previewImg.src = url;
            imagePreview.style.display = 'block';
        }
    });
});
</script>
```

### Comportement:
1. L'utilisateur colle l'URL de l'image
2. Le JavaScript détecte le changement
3. L'image s'affiche en aperçu
4. L'utilisateur peut valider avant de soumettre

---

## 🎨 STYLE DES FORMULAIRES

Tous les formulaires utilisent:
- ✅ Bootstrap 5 (layout responsive)
- ✅ Cards avec ombre et border-radius
- ✅ Inputs avec validation visuelle
- ✅ Labels avec emoji pour lisibilité
- ✅ Help text explicatif
- ✅ Boutons avec icones FontAwesome
- ✅ Spacing cohérent (py-5, p-4, gap-2, etc.)

Exemple:
```html
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <!-- Contenu du formulaire -->
    </div>
</div>
```

---

## 📝 EXEMPLE DE SAISIE

### Créer un utilisateur avec image

1. Allez à: `/utilisateur/new`
2. Remplissez:
   - Nom: "Dupont"
   - Prénom: "Jean"
   - Email: "jean.dupont@email.com"
   - Filière: (sélectionnez une)
   - Rôle: ROLE_USER (cochez)
3. **NOUVEAU** - URL Image: 
   - Collez: `https://images.unsplash.com/photo-1611692035589-00d0d6b14024?w=400`
   - L'image s'affiche ✓
4. Cliquez "Enregistrer"
5. Allez à `/utilisateur` → Vous verrez Jean avec sa photo!

---

## 🔄 WORKFLOW COMPLET

```
┌─────────────────────────────────────────┐
│  Utilisateur visite: /utilisateur/new   │
└──────────────┬──────────────────────────┘
               │
               ↓
    ┌──────────────────────┐
    │ Formulaire s'affiche │
    │ Tous les champs vides│
    └──────────┬───────────┘
               │
               ↓
    ┌──────────────────────┐
    │ Utilisateur remplit: │
    │ - Nom, Prénom        │
    │ - Email              │
    │ - URL Image ← NOUVEAU│
    └──────────┬───────────┘
               │
               ↓
    ┌──────────────────────┐
    │ Aperçu image change │
    │ (JavaScript en temps │
    │  réel)               │
    └──────────┬───────────┘
               │
               ↓
    ┌──────────────────────┐
    │ Clique "Enregistrer" │
    └──────────┬───────────┘
               │
               ↓
    ┌──────────────────────┐
    │ Formulaire validé &  │
    │ BD mise à jour       │
    └──────────┬───────────┘
               │
               ↓
    ┌──────────────────────┐
    │ Redirection vers:    │
    │ /utilisateur (liste) │
    └──────────┬───────────┘
               │
               ↓
    ┌──────────────────────┐
    │ 4 utilisateurs par   │
    │ ligne avec leurs     │
    │ photos! ✓            │
    └──────────────────────┘
```

---

## 📊 TABLEAU RÉCAPITULATIF DES CHAMPS

| Formulaire | Champ | Type | Requis | NOUVEAU |
|-----------|-------|------|--------|---------|
| Filière | Nom | TextType | ✅ | ❌ |
| Filière | Description | TextareaType | ✅ | ❌ |
| Filière | Établissement | EntityType | ✅ | ❌ |
| Filière | Date création | DateType | ✅ | ❌ |
| Filière | **URL Image** | **TextType** | ❌ | ✅ |
| Établissement | Nom | TextType | ✅ | ❌ |
| Établissement | Adresse | TextType | ✅ | ❌ |
| Établissement | Ville | TextType | ✅ | ❌ |
| Établissement | Téléphone | TelType | ✅ | ❌ |
| Établissement | Email | EmailType | ✅ | ❌ |
| Établissement | **URL Image** | **TextType** | ❌ | ✅ |
| Utilisateur | Nom | TextType | ✅ | ❌ |
| Utilisateur | Prénom | TextType | ✅ | ❌ |
| Utilisateur | Email | EmailType | ✅ | ❌ |
| Utilisateur | Filière | EntityType | ❌ | ❌ |
| Utilisateur | Événements | EntityType | ❌ | ❌ |
| Utilisateur | Rôles | ChoiceType | ✅ | ❌ |
| Utilisateur | **URL Image** | **TextType** | ❌ | ✅ |

---

## 🔗 LIEN ENTRE CONTRÔLEUR ET FORMULAIRE

```
FiliereController::new()
    ↓
    Creates: new FiliereType()
    ↓
    Renders: fil/new.html.twig
    ↓
    Includes: fil/_form.html.twig
    ↓
    Form displays with all fields including imageUrl
```

---

## ✅ VALIDATION

Tous les champs sont validés:
- ✅ Champs obligatoires vérifiés
- ✅ Longueur de texte vérifiée
- ✅ Format email validé
- ✅ Format URL image validé (optionnel mais si rempli, doit être valide)
- ✅ Erreurs affichées sous chaque champ

---

## 🎯 RÉSULTAT FINAL

Après avoir créé 4 utilisateurs avec images:
- ✓ Page `/utilisateur` affiche **4 users par ligne**
- ✓ Chacun avec sa **photo de profil**
- ✓ Design **responsive** (adapté mobile/tablet/desktop)
- ✓ Effets **hover** (zoom + ombre)
- ✓ **Placeholder** si pas d'image

Same pour filières et établissements! 🎉

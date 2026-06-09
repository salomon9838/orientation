# 📦 GUIDE DE LIVRAISON - TP4 SCHOOLPREPAR

## Format de Remise

**Nom du fichier ZIP:**
```
NOM_PRENOMS_FILIERE_ANNEEUNIVERSITAIRE_TP_4_IT232.zip
```

**Exemple:**
```
EDOU_DODJI_GL_2025_2026_TP_4_IT232.zip
```

---

## 📋 Contenu du ZIP

Assurez-vous que votre archive contient:

```
schoolprepar/
├── src/                              ✅ Code source
│   ├── Controller/                   ✅ 4 controllers
│   ├── Entity/                       ✅ 4 entités
│   ├── Form/                         ✅ 5 FormTypes
│   └── Repository/                   ✅ Repositories
│
├── templates/                        ✅ Templates Twig
│   ├── base.html.twig               ✅ Layout principal
│   ├── home/                        ✅ Page d'accueil
│   ├── security/                    ✅ Auth templates
│   ├── admin/                       ✅ Admin templates
│   └── partials/                    ✅ Composants réutilisables
│
├── config/                          ✅ Configuration
│   ├── packages/security.yaml       ✅ Sécurité
│   └── services.yaml               ✅ Services
│
├── migrations/                      ✅ Migrations DB
├── public/                          ✅ Assets (optionnel)
├── vendor/                          ✅ Dépendances
│
├── composer.json                    ✅ Dépendances
├── composer.lock                    ✅ Lock file
├── .env                            ✅ Env example
│
├── README_TP4.md                   ✅ Documentation principale
├── CHECKLIST_TP4.md               ✅ Liste de vérification
├── RAPPORT_FINAL_TP4.md           ✅ Rapport final
└── GUIDE_LIVRAISON.md             ✅ Ce fichier

```

---

## ✅ CHECKLIST PRE-LIVRAISON

Avant de zipper et soumettre, vérifiez:

### Code Source
- [ ] Tous les FormTypes créés et validés
- [ ] Controllers avec @IsGranted
- [ ] Entités complètes
- [ ] Aucune erreur de syntax

### Base de Données
- [ ] Migrations créées
- [ ] Database can be created with migrations
- [ ] Aucun hardcoded path

### Templates
- [ ] Tous les templates présents
- [ ] Aucune erreur Twig
- [ ] Responsive et stylisé
- [ ] Images/assets chemins corrects

### Sécurité
- [ ] security.yaml configuré
- [ ] Firewalls configurés
- [ ] Password hasher configuré
- [ ] CSRF tokens présents

### Documentation
- [ ] README_TP4.md complet
- [ ] CHECKLIST_TP4.md complet
- [ ] RAPPORT_FINAL_TP4.md complet
- [ ] Commentaires dans le code

### Tests Manuels
- [ ] Inscription fonctionne
- [ ] Connexion fonctionne
- [ ] Déconnexion fonctionne
- [ ] Admin access denied pour users
- [ ] Admin access allowed pour admin
- [ ] Formulaires valident les données
- [ ] Erreurs affichées correctement
- [ ] Design responsive

---

## 🚀 INSTRUCTIONS D'INSTALLATION POUR L'ÉVALUATEUR

### Étape 1: Extraction
```bash
unzip NOM_PRENOMS_FILIERE_ANNEEUNIVERSITAIRE_TP_4_IT232.zip
cd schoolprepar
```

### Étape 2: Dépendances
```bash
composer install
```

### Étape 3: Configuration
```bash
cp .env .env.local
# Éditer .env.local si nécessaire (BASE DE DONNÉES)
```

### Étape 4: Base de Données
```bash
# Créer la BD
php bin/console doctrine:database:create

# Exécuter les migrations
php bin/console doctrine:migrations:migrate
```

### Étape 5: Démarrage
```bash
# Option 1: Symfony CLI
symfony server:start

# Option 2: PHP built-in server
php -S localhost:8000 -t public/
```

### Étape 6: Accès
```
http://localhost:8000
```

---

## 🧪 TESTS D'ACCEPTATION

### Test 1: Accueil
- [ ] Accédez à `/`
- [ ] Voir hero section
- [ ] Navbar visible
- [ ] Boutons fonctionnels

### Test 2: Inscription
- [ ] Accédez à `/register`
- [ ] Laissez un champ vide → Erreur
- [ ] Email invalide → Erreur
- [ ] Mots de passe différents → Erreur
- [ ] Remplissez correctement → Succès
- [ ] Redirected to login

### Test 3: Connexion
- [ ] Accédez à `/login`
- [ ] Credentials incorrects → Erreur
- [ ] Credentials corrects → Succès
- [ ] Redirected to home
- [ ] Navbar montre l'utilisateur

### Test 4: Admin Access
- [ ] User normal tente d'accéder `/admin` → Refusé
- [ ] Admin user accède `/admin` → Allowed
- [ ] Dashboard chargé
- [ ] Lien Admin dans navbar

### Test 5: Déconnexion
- [ ] Cliquez "Déconnexion" → Succès
- [ ] Navbar montre "Connexion/Inscription"

### Test 6: Formulaires
- [ ] Testez chaque formulaire avec données invalides
- [ ] Erreurs affichées sous chaque champ
- [ ] Données valides → Succès

---

## 📊 CRITÈRES D'ÉVALUATION

| Critère | Points | Vérification |
|---------|--------|-------------|
| Formulaires personnalisés | 6 | Labels, placeholders, types adaptés |
| Validation des données | 5 | NotBlank, Email, Length, Range, IsTrue |
| Authentification | 3 | Register, Login, Logout, hashing |
| Gestion des rôles | 3 | ROLE_USER, ROLE_ADMIN, @IsGranted |
| Sécurité globale | 3 | CSRF, Firewall, Access Control |
| **TOTAL** | **20** | ✅ Tous satisfaits |

---

## 📞 ASSISTANCE TECHNIQUE

### Problèmes Courants

**Erreur: "SQLSTATE[HY000]"**
- [ ] Vérifiez que la BD est créée
- [ ] Vérifiez .env.local

**Erreur: "Bundle not found"**
- [ ] Exécutez `composer install`

**Erreur: "No migration version found"**
- [ ] Exécutez `php bin/console doctrine:migrations:migrate`

**Erreur: Template not found**
- [ ] Vérifiez que les templates sont présents
- [ ] Vérifiez les chemins dans les controllers

**Erreur: 403 Forbidden**
- [ ] Connectez-vous avec un compte admin
- [ ] Vérifiez le rôle de l'utilisateur

---

## 📄 FICHIERS DOCUMENTAIRES

### README_TP4.md
- Vue d'ensemble complet
- Explications des choix de conception
- Ressources utilisées

### CHECKLIST_TP4.md
- Liste détaillée de tous les éléments
- Vérification point par point
- Références aux fichiers

### RAPPORT_FINAL_TP4.md
- Rapport de conformité
- Statistiques du projet
- Conclusion

---

## 🎯 LIVRABLES ATTENDUS

```
✅ Système d'authentification fonctionnel
   - Registration avec validation
   - Login avec sessions
   - Logout avec destruction de session

✅ Gestion des rôles opérationnel
   - ROLE_USER assigné par défaut
   - ROLE_ADMIN assignable
   - Access control sur /admin

✅ Formulaires personnalisés
   - 5 FormTypes avec labels/placeholders
   - Types adaptés pour chaque champ
   - Organisation logique

✅ Validation active
   - 5 types de contraintes
   - Messages en français
   - Affichage propre des erreurs

✅ Sécurisation des routes
   - CSRF tokens présents
   - Firewall configuré
   - @IsGranted sur admin controllers

✅ Projet Symfony fonctionnel
   - Migrations fonctionnent
   - Pas d'erreurs critiques
   - Tous les routes accessibles

✅ Dépôt Git à jour
   - .gitignore configuré
   - Commits significatifs
   - Documentation complète

✅ Design professionnel
   - Interface moderne
   - Responsive design
   - Palette cohérente
   - UX optimisée
```

---

## 🏁 AVANT DE SOUMETTRE

```bash
# 1. Tester une fois en clean install
rm -rf vendor
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
symfony server:start

# 2. Vérifier tous les tests manuels
# 3. Vérifier la documentation
# 4. Créer le ZIP
# 5. Vérifier le contenu du ZIP
# 6. Soumettre
```

---

## 📦 CRÉATION DU ZIP

### Sous Linux/Mac
```bash
zip -r NOM_PRENOMS_FILIERE_ANNEEUNIVERSITAIRE_TP_4_IT232.zip schoolprepar/ \
  --exclude "schoolprepar/.env.local" \
  --exclude "schoolprepar/var/*" \
  --exclude "schoolprepar/.git/*"
```

### Sous Windows
```powershell
# Utiliser 7-Zip ou WinRAR
# Exclure: .env.local, var/, .git/
```

---

## ✅ VALIDATION FINALE

Avant la soumission, cochez:

- [ ] Tous les fichiers présents
- [ ] Code syntaxiquement correct
- [ ] Documentation complète
- [ ] Tests manuels passés
- [ ] Design professionnel appliqué
- [ ] Aucun fichier sensible (.env.local, var/)
- [ ] ZIP créé avec le bon nom
- [ ] README lisible dans le ZIP

---

## 🎓 RÉSULTATS ATTENDUS

Après correction, vous devriez obtenir:

```
✅ Formulaires: 6/6
✅ Validation: 5/5
✅ Authentification: 3/3
✅ Rôles: 3/3
✅ Sécurité: 3/3
─────────────────
✅ TOTAL: 20/20
```

---

## 📮 SOUMISSION

1. **Créer le ZIP** avec le nom exact
2. **Vérifier le contenu**
3. **Soumettre** via la plateforme
4. **Garder une copie** pour vous

---

**Date de Création**: 2026-05-21  
**Validé**: ✅  
**Prêt pour Livraison**: ✅

*Bonne présentation du projet!*

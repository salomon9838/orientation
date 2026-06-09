# 🚀 QUICK REFERENCE - TP4 SCHOOLPREPAR

## 📌 À Savoir Absolument

### Routes Principales
```
PUBLIC:
  GET  /                 → Accueil (home)
  GET  /register         → Inscription
  GET  /login            → Connexion
  POST /logout           → Déconnexion
  GET  /filieres         → Liste filières

ADMIN (ROLE_ADMIN required):
  GET  /admin            → Dashboard
  GET  /admin/etablissements → Établissements
  GET  /admin/filieres       → Filières
```

### Identifiants de Test
```
USER: user@test.com / password123
ADMIN: admin@test.com / password123
```

### Points Clés
- ✅ **Formulaires**: 5 types complets, labels/placeholders
- ✅ **Validation**: NotBlank, Email, Length, Range, IsTrue
- ✅ **Auth**: Registration, Login, Logout, bcrypt hashing
- ✅ **Rôles**: ROLE_USER (défaut), ROLE_ADMIN
- ✅ **Sécurité**: CSRF, Firewall, @IsGranted

---

## 🎨 Couleurs du Design

| Élément | Couleur | Hex |
|---------|---------|-----|
| Primary | Bleu | #1e40af |
| Secondary | Violet | #8b5cf6 |
| Accent | Teal | #14b8a6 |
| Background | Gris clair | #f8fafc |
| Text | Gris foncé | #334155 |

---

## 📁 Fichiers Critiques

| Fichier | Importance | Raison |
|---------|-----------|--------|
| security.yaml | ⭐⭐⭐ | Configuration auth/rôles |
| SecurityController.php | ⭐⭐⭐ | Login/register/logout |
| UtilisateurType.php | ⭐⭐ | Gestion utilisateurs |
| base.html.twig | ⭐⭐⭐ | Layout principal |
| navbar.html.twig | ⭐⭐ | Navigation |

---

## 🔐 Hiérarchie de Sécurité

```
Pas Connecté
  ↓ (login/register)
Connecté (ROLE_USER)
  ↓ (if admin)
Administrateur (ROLE_ADMIN)
  → Accès /admin
```

---

## 💾 Base de Données

### Entités Principales
- **Utilisateur** (email unique, roles)
- **Filiere** (nom, description)
- **Etablissement** (adresse, email)
- **Evenement** (dates, participants)

### Migrations
```bash
php bin/console doctrine:migrations:migrate
```

---

## 🎯 Score Attendu

| Composant | Points | Min. |
|-----------|--------|------|
| Formulaires | 6 | 5 |
| Validation | 5 | 4 |
| Authentification | 3 | 3 |
| Rôles | 3 | 3 |
| Sécurité | 3 | 3 |
| **TOTAL** | **20** | **18** |

---

## ⚠️ Erreurs à Éviter

```
❌ Pas de validation dans formulaires
❌ Mot de passe en plain text
❌ Admin accessible sans authentification
❌ Erreurs non affichées
❌ Design non professionnel
❌ Pas de CSRF protection
❌ Routes sans @IsGranted
```

---

## ✨ Bonus Points

```
✅ Design responsive
✅ Navbar avec menu utilisateur
✅ Flash messages stylisés
✅ Graphiques/statistiques
✅ Documentation complète
✅ Code bien commenté
```

---

## 🧪 Tests Rapides

```bash
# 1. Inscription
curl -X POST http://localhost:8000/register \
  -d "form[email]=test@test.com&form[password]=pass123"

# 2. Login
curl -X POST http://localhost:8000/login \
  -d "email=test@test.com&password=pass123"

# 3. Admin (sans accès)
curl http://localhost:8000/admin
# → 403 Forbidden (expected)
```

---

## 📊 Commandes Utiles

```bash
# Debug
php bin/console debug:router                 # Routes
php bin/console debug:firewall              # Firewall
php bin/console security:check              # Security

# DB
php bin/console doctrine:database:create    # Create DB
php bin/console doctrine:migrations:migrate # Migrate
php bin/console doctrine:fixtures:load      # Load data

# Assets
php bin/console assets:install               # Copy assets
npm run build                                # Build front
```

---

## 🎓 Vocabulaire

| Term | Explication |
|------|------------|
| FormType | Classe Symfony pour générer des formulaires |
| Constraint | Règle de validation (NotBlank, Email, etc.) |
| Provider | Source d'authentification (Entity provider) |
| Firewall | Protection des routes |
| CSRF | Token pour éviter les attaques |
| @IsGranted | Annotation pour vérifier les rôles |
| Hash | Chiffrement du mot de passe (bcrypt) |

---

## 🏁 Checklist Finale

- [ ] Code complet et sans erreurs
- [ ] Formulaires avec validation
- [ ] Authentication fonctionne
- [ ] Rôles et accès configurés
- [ ] Design professionnel
- [ ] Documentation présente
- [ ] Tests manuels OK
- [ ] ZIP créé et prêt

---

## 📞 Ressources Rapides

```
Documentation Symfony:
https://symfony.com/doc/current/index.html

Forms & Validation:
https://symfony.com/doc/current/forms.html
https://symfony.com/doc/current/validation.html

Security:
https://symfony.com/doc/current/security.html
```

---

**Version**: 1.0  
**Date**: 2026-05-21  
**Status**: ✅ Approuvé  

*Bon courage pour la présentation! 🎉*

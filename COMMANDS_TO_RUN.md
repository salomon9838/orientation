# 🚀 COMMANDES À EXÉCUTER DANS LE TERMINAL

## ÉTAPE 1: Appliquer la migration (ajouter colonnes image_url à la BD)
```bash
cd c:\Ecole\schoolprepar
php bin/console doctrine:migrations:migrate
```
Répondez `yes` si demandé.

## ÉTAPE 2: Démarrer le serveur Symfony
```bash
symfony server:start
```
Vous verrez: `[OK] Server listening on http://127.0.0.1:8000`

## ÉTAPE 3: Tester les formulaires

### Option A: Via navigateur (cliquez les liens)
- Créer utilisateur: http://localhost:8000/utilisateur/new
- Créer filière: http://localhost:8000/fil/new  
- Créer établissement: http://localhost:8000/eta/new

### Option B: Via terminal (curl)
```bash
curl http://localhost:8000/utilisateur
```

## 📸 POUR TESTER AVEC DES IMAGES

### Images de test disponibles:
```
https://images.unsplash.com/photo-1611692035589-00d0d6b14024?w=400
https://images.pexels.com/photos/1370322/pexels-photo-1370322.jpeg
https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_640.jpg
```

### Copier/coller dans le formulaire:
1. Ouvrez le lien ci-dessus dans un nouvel onglet
2. Cliquez droit sur l'image
3. "Copier l'adresse de l'image"
4. Collez dans le champ "URL Image" du formulaire
5. L'aperçu s'affiche automatiquement ✓

## ⚠️ SI UNE ERREUR SURVIENT

### Erreur: "Unknown token SECURITY"
→ Sautez cette erreur, cela vient du formulaire CSRF

### Erreur: "Column image_url does not exist"
→ Assurez-vous que la migration s'est bien exécutée:
```bash
php bin/console doctrine:migrations:status
```
Vous devriez voir: `Version20260521222500` dans la liste

### Erreur: "Table utilisateur does not exist"
→ Exécutez toutes les migrations:
```bash
php bin/console doctrine:migrations:migrate
```

### Erreur de port (port 8000 déjà utilisé)
```bash
symfony server:stop
symfony server:start --port=8001
```

## 🔍 VÉRIFIER L'INSTALLATION

### Vérifier les migrations appliquées:
```bash
php bin/console doctrine:migrations:status
```

### Vérifier les tables BD:
```bash
php bin/console doctrine:query:sql "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE();"
```

### Vérifier les colonnes image_url:
```bash
php bin/console doctrine:query:sql "DESCRIBE utilisateur;"
```
Vous devez voir: `image_url | varchar(500) | YES`

## 📞 SUPPORT

Si problème persiste:
1. Vérifiez que MySQL/PostgreSQL est running
2. Vérifiez .env: DATABASE_URL est correct
3. Essayez: `php bin/console cache:clear`
4. Redémarrez le serveur Symfony

## ✅ CHECKLIST FINALE

- [ ] Migration exécutée: `doctrine:migrations:migrate`
- [ ] Serveur démarré: `symfony server:start`
- [ ] Accès à http://localhost:8000 (pas d'erreur)
- [ ] Route app_home fonctionne
- [ ] Créer utilisateur fonctionne
- [ ] Formulaire affiche le champ "URL Image"
- [ ] Aperçu image fonctionne au survol
- [ ] Utilisateur créé avec image
- [ ] Image s'affiche sur http://localhost:8000/utilisateur

## 🎉 C'EST TOUT!

Une fois ces étapes complétées, vos pages affichent:
✓ 4 images par ligne
✓ Images responsive
✓ Effets hover
✓ Design professionnel
✓ Fonctionnalité complète

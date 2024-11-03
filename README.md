# Projet API E-Commerce avec Laravel

Ce projet est une API E-Commerce développée avec Laravel. Elle permet de gérer les fonctionnalités essentielles de gestion de produits, panier d'achat, notifications, et formulaire de contact. Le frontend utilise Vue.js et Inertia.js pour créer une expérience utilisateur de type SPA (Single Page Application).

## Fonctionnalités

- **Gestion des produits** : Opérations CRUD pour les produits, incluant filtrage et catégorisation.
- **Panier d'achat** : Ajouter, supprimer, et gérer les produits dans le panier avec une gestion basée sur la session.
- **Notifications** : Affichage de notifications de succès, d'erreur, d'information et d'avertissement aux utilisateurs.
- **Formulaire de contact** : Formulaire de soumission de message avec validation côté serveur.
- **Documentation API** : Documentation Swagger (en cours).

## Table des matières

1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Utilisation](#utilisation)
4. [Points de terminaison API](#points-de-terminaison-api)
5. [Tests](#tests)
6. [Contribution](#contribution)

Voici la section "Installation" mise à jour dans le `README.md`, prenant en compte les scripts définis dans votre `package.json` pour simplifier le processus d'installation et de configuration.

## Installation

Pour installer et configurer ce projet localement, suivez les étapes ci-dessous :

1. **Clonez le dépôt** :
    ```bash
    git clone https://github.com/abdelhafidaabid0/alten_test.git
    cd alten_test
    ```

2. **Configuration initiale avec les scripts de setup** :
   Utilisez le script `setup` ou `setup:vite` pour automatiser l'installation des dépendances, la configuration de l'environnement, et la migration de la base de données. Ces scripts vont :

   - Copier le fichier `.env.example` en `.env`
   - Installer les dépendances Node.js et Composer
   - Exécuter les migrations et peupler la base de données avec des données initiales
   - Lancer le serveur de développement

   - Pour une configuration standard :
     ```bash
     npm run setup
     ```

   - Pour une configuration avec Vite spécifiquement :
     ```bash
     npm run setup:valet
     ```

3. **Variables d’environnement** :
   Vérifiez et ajustez les variables d’environnement dans le fichier `.env` selon votre configuration locale. Assurez-vous de bien configurer les informations de base de données et d’application.

4. **Démarrer l'application** :
   Si vous avez déjà exécuté `npm run setup` ou `npm run setup:vite`, votre application devrait être accessible à `http://localhost:8000`. Si vous souhaitez démarrer manuellement, vous pouvez utiliser les commandes suivantes :
   
   - Pour lancer le serveur Laravel :
     ```bash
     npm run dev:composer
     ```
   
   - Pour compiler les assets en mode développement avec Vite :
     ```bash
     npm run dev
     ```

5. **Build de production** (optionnel) :
   Pour générer un build de production, exécutez :
   ```bash
   npm run build
   ```

Cette section d'installation simplifie le processus de configuration et de lancement de l'application en utilisant des scripts définis dans `package.json`, permettant une mise en place rapide et efficace.

### Documentation API
Pour consulter la documentation de l'API, ouvrez le fichier `swagger.json` dans [Swagger Editor](https://editor-next.swagger.io/) ou utilisez un autre outil compatible.

### Variables d'environnement
Assurez-vous que les variables d'environnement suivantes sont configurées correctement :

```env
APP_NAME=LaravelECommerce
APP_ENV=local
APP_KEY=your-app-key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

## Utilisation

Lancez le serveur de développement :

```bash
npm run dev:composer
```

L'application sera accessible à l'adresse `http://localhost:8000`.

## Points de terminaison API

### Endpoints Produits

- `GET /api/products` : Lister tous les produits.
- `POST /api/products` : Créer un nouveau produit.
- `GET /api/products/{id}` : Récupérer un produit spécifique par son ID.
- `PATCH /api/products/{id}` : Mettre à jour un produit par son ID.
- `DELETE /api/products/{id}` : Supprimer un produit par son ID.

### Endpoints Panier

- `GET /cart` : Voir le contenu du panier.
- `POST /add_to_cart/{product_id}/{quantity}` : Ajouter un produit au panier.
- `POST /remove_from_cart/{product_id}` : Retirer un produit du panier.

### Endpoint Contact

- `POST /contact` : Soumettre un message via le formulaire de contact.

## Tests

Ce projet inclut une suite de tests utilisant **Pest** pour PHP. Les tests couvrent les services de gestion des produits et du panier, les contrôleurs API, les notifications, et la validation des formulaires.

### Lancer les Tests

Pour exécuter les tests :

```bash
php artisan test
```

Cela exécutera tous les tests unitaires et de fonctionnalité pour s'assurer que l'application fonctionne correctement.

### Couverture des Tests

- **ProductService** : Couvre le filtrage, la gestion des catégories, le statut d'inventaire, et les prix.
- **CartService** : Gère l'ajout, la suppression, et la mise à jour des articles du panier, ainsi que le calcul des prix et des quantités.
- **NotificationService** : Assure le bon fonctionnement des notifications.
- **ProductApiController** : Valide les réponses pour les opérations CRUD et les cas limites.
- **ProductController** : Tests de rendu de page et de persistance des filtres.
- **ContactController** : Vérifie la validation du formulaire de contact et la soumission de message.
- **Form Requests** : Tests de validation des champs dans `StoreProductRequest` et `UpdateProductRequest`.

## Déploiement

Pour déployer le projet en production :

1. **Configurer l'environnement de production** :
    - Assurez-vous d'avoir un serveur avec PHP, Composer et un serveur web comme Nginx ou Apache.
    - Configurez les variables d'environnement en production dans le fichier `.env`, avec `APP_ENV=production` et `APP_DEBUG=false`.

2. **Optimiser l'application** :
    - Exécutez les optimisations pour de meilleures performances :
      ```bash
      php artisan config:cache
      php artisan route:cache
      php artisan view:cache
      php artisan optimize
      ```

3. **Permissions** :
    - Assurez-vous que les dossiers `storage` et `bootstrap/cache` sont accessibles en écriture :
      ```bash
      sudo chmod -R 775 storage bootstrap/cache
      ```

4. **Migrer la base de données** :
    - Exécutez les migrations en production :
      ```bash
      php artisan migrate --force
      ```

5. **Compilations des assets** :
    - Compilez les assets frontend pour la production :
      ```bash
      npm run build
      ```

6. **Configurer le worker de file d'attente** (optionnel) :
    - Si votre application utilise des files d'attente, configurez un worker :
      ```bash
      php artisan queue:work --daemon
      ```

## Gestion des erreurs et logs

1. **Rapport d'erreurs** :
    - En production, définissez `APP_DEBUG=false` dans le fichier `.env` pour éviter d'afficher les détails d'erreurs aux utilisateurs.

2. **Logging** :
    - Utilisez le canal de log `daily` pour conserver les logs journaliers :
      ```env
      LOG_CHANNEL=daily
      ```

3. **Exceptions personnalisées** :
    - Définissez des exceptions personnalisées dans `app/Exceptions` et gérez-les dans `Handler.php` pour des réponses d'erreurs personnalisées.

## Considérations de sécurité

1. **Variables d'environnement** :
    - Ne jamais exposer les variables sensibles. Le fichier `.env` doit être sécurisé et ne pas être versionné.

2. **Validation des entrées** :
    - Validez toutes les entrées utilisateur avec les Form Requests Laravel pour éviter les attaques par injection SQL.

3. **Protection CSRF** :
    - Laravel active par défaut la protection CSRF pour les routes web. Utilisez `@csrf` dans vos formulaires.

4. **Limitation des requêtes** :
    - Utilisez le middleware de limitation de requêtes pour limiter le nombre de requêtes des utilisateurs.

5. **Sanitisation des entrées** :
    - Utilisez des bibliothèques comme `Laravel Purifier` pour nettoyer les entrées HTML.

## Contribution

Pour contribuer au projet :

1. **Forkez** le dépôt.
2. **Créez une branche** pour votre fonctionnalité ou correctif.
3. **Écrivez des tests** pour les nouvelles fonctionnalités ou modifications.
4. **Soumettez une Pull Request**.

### Standards de code

Veuillez respecter les conventions de code Laravel. Utilisez `phpcs` ou un outil similaire pour vérifier que votre code suit les standards du projet.

## Licence

Ce projet est open-source sous licence [MIT](https://opensource.org/licenses/MIT).

## Contact

Pour toute question ou suggestion, veuillez nous contacter par email à `abdelhafid.aabid@gmail.com` ou ouvrez une issue sur GitHub.


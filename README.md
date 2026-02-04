# Burger API 🍔

Une API REST légère pour la gestion du site tp_burger, sécurisée par JWT (JSON Web Tokens) et conteneurisée avec Docker.

## 📖 Description

Ce projet fournit une API backend PHP permettant l'authentification via JWT. Il inclut un environnement de développement complet prêt à l'emploi avec une base de données MariaDB, une interface d'administration PhpMyAdmin et un serveur de mail de test Mailpit.

## 🛠 Prérequis

Assurez-vous d'avoir les outils suivants installés sur votre machine :

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/downloads)

## 🚀 Installation et Démarrage

1. **Cloner le dépôt**

   Récupérez le code source depuis GitHub :

   ```bash
   git clone git@github.com:Astrophaze/burger_api.git
   cd burger_api
   ```

2. **Lancer l'environnement Docker**

   Construisez et démarrez les conteneurs en arrière-plan :

   ```bash
   docker-compose up -d --build
   ```

   *La première exécution peut prendre quelques minutes le temps de télécharger les images et d'installer les dépendances.*

L'API est sécurisée par un système de token Bearer.

### 1. Accéder aux routes protégées

Pour appeler les endpoints de l'API qui incluent la sécurité, vous devez inclure ce token dans les Headers de vos requêtes HTTP.

- **Header** : `Authorization`
- **Valeur** : `Bearer <votre_token>`

Si le token est absent, expiré ou invalide, l'API retournera une erreur `401 Unauthorized`.

### 2. Endpoints de l'API

Voici la documentation détaillée des endpoints disponibles.

URL de base : `http://localhost:8080`

#### 🔐 Authentification

**`GET /jwt-login.php`**

Génère un token JWT valide pour accéder aux routes protégées.
*   **Authentification** : Publique.
*   **Paramètres** : Aucun.
*   **Réponse (200 OK)** :
    ```json
    {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
    }
    ```

#### 🍔 Burgers

**`GET /burgers.php`**

Récupère la liste des informations sur les burgers du menu.
*   **Authentification** : Requise (Bearer Token).

#### 🍟 Catégories

**`GET /categories.php`**

Récupère la liste des catégories de produits.
*   **Authentification** : Requise (Bearer Token).


#### ✅ Reviews

**`GET /reviews.php`**

Récupère la liste des avis clients.
*   **Authentification** : Requise (Bearer Token).


#### 📝 Articles

**`GET /article.php?id_article={id}`**

Récupère un article en particulier.
*   **Authentification** : Requise (Bearer Token).
*   **Paramètres** : id_article

#### 📧 Newsletter

**`POST /newsletter.php`**

Inscrit un email à la newsletter et l'insert en DB.
*   **Authentification** : Requise (Bearer Token).
*   **Paramètres (POST)** : `email`

#### 📬 Contact

**`POST /contact.php`**

Envoie un message via le formulaire de contact et l'insert en DB.
*   **Authentification** : Requise (Bearer Token).
*   **Paramètres (POST)** : `nom`, `email`, `message`


## 📦 Services et Ports

L'environnement Docker expose les services suivants :

| Service | URL / Port | Description | Identifiants (User/Pass) |
|---------|------------|-------------|--------------------------|
| **API PHP** | `http://localhost:8080` | Serveur Web Apache/PHP | - |
| **MariaDB** | `localhost:3306` | Serveur de base de données | `burger_api_user` / `root` |
| **PhpMyAdmin** | `http://localhost:8081` | Interface de gestion BDD | `root` / `root` (Serveur: `db`) |
| **Mailpit** | `http://localhost:8025` | Interface Web des emails | - |

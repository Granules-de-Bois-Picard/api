# API Granulés de Bois Picard

## À propos

Cette API est le backend de l'application Granulés de Bois Picard. Elle est construite avec le framework Laravel et fournit les fonctionnalités nécessaires pour gérer les produits, articles, FAQ et autres ressources du site web et du backoffice.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL ou MariaDB
- Serveur web (Apache, Nginx, etc.)

## Installation

1. Cloner le dépôt
2. Installer les dépendances :
   ```
   composer install
   ```
3. Copier le fichier d'environnement :
   ```
   cp .env.example .env
   ```
4. Configurer les variables d'environnement dans le fichier `.env` :
   - Configurer la connexion à la base de données
   - Définir les URLs de l'application, du backoffice et du site web
   - Configurer les paramètres de mail si nécessaire

5. Générer la clé d'application :
   ```
   php artisan key:generate
   ```

6. Exécuter les migrations :
   ```
   php artisan migrate
   ```

7. Lancer le serveur de développement :
   ```
   php artisan serve
   ```

## Fonctionnalités principales

- **Authentification** : Système d'authentification sécurisé avec Laravel Sanctum
- **Gestion des utilisateurs** : Création, modification et suppression des utilisateurs
- **Gestion des rôles et permissions** : Contrôle d'accès basé sur les rôles avec Spatie Permission
- **Gestion des produits** : CRUD pour les produits de chauffage (poêles, granulés, etc.)
- **Gestion des articles** : Publication et gestion d'articles pour le blog
- **Gestion des FAQ** : Questions fréquemment posées
- **Gestion des fichiers** : Upload et gestion des fichiers (images, documents, etc.)
- **Gestion des slides** : Contenu pour les carrousels du site web
- **API Email** : Envoi d'emails depuis le formulaire de contact

## Structure du projet

Le projet suit l'architecture standard de Laravel avec quelques particularités :

- **Repositories** : Utilisation du pattern Repository pour l'accès aux données
- **Transformers** : Transformation des données pour l'API avec Fractal
- **Services** : Services pour la gestion des fichiers et autres fonctionnalités

## Endpoints API

Les principaux endpoints de l'API sont :

- `/api/auth` : Authentification (login, register, logout)
- `/api/users` : Gestion des utilisateurs
- `/api/products` : Gestion des produits
- `/api/articles` : Gestion des articles
- `/api/faqs` : Gestion des FAQ
- `/api/files` : Gestion des fichiers
- `/api/slides` : Gestion des slides
- `/api/email` : Envoi d'emails
- `/api/status` : Vérification du statut des services

## Licence

Ce projet est sous licence propriétaire. Tous droits réservés.

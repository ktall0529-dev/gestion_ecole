# API REST Gestion Étudiants & Cours
## Installation
```bash
git clone <repo>
cd gestion-ecole
composer install
cp .env.example .env
php artisan key:generate
# Configurer DB_DATABASE, DB_USERNAME, DB_PASSWORD dans .env
php artisan migrate
```
## Lancer l'API
```bash
php artisan serve
```
## Endpoints principaux
| Méthode | URI | Description |
|---------|-----|-------------|
| POST | /api/v1/auth/register | Inscription |
| POST | /api/v1/auth/login | Connexion |
| GET | /api/v1/etudiants | Lister |
| POST | /api/v1/etudiants | Créer |
## Références
- https://laravel.com/docs/12.x/eloquent-resources
- https://laravel.com/docs/12.x/testing
- https://laravel.com/docs/12.x/authentication
- https://laravel.com/docs/12.x/middleware
- https://laravel.com/docs/12.x/routing
- https://laravel.com/docs/11.x/sanctum

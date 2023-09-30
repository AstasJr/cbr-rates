# Docker-laravel

## Get started

1. Create .env file
```
cp .env.example .env
```
2. Build and run project
```
docker-compose up -d
```
3. Install dependencies from app container
```
composer install
```
4. Generate application key from app container
```
php artisan key:generate
```
5. Use migrations
```
php artisan migrate
```

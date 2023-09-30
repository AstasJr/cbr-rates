# Exchange-rates

## Get started

1. Создайте файл окружения
```
cp .env.example .env
```
2. Запустите проект
```
docker-compose up -d
```
3. Установите зависимости из app контейнера
```
composer install
```
4. Сгенерируйте ключ приложения
```
php artisan key:generate
```
5. Установите миграции
```
php artisan migrate
```
6. Запустите команду получения списка валют
```
php artisan fetch:currencies
```
7. Запустите redis
```
php artisan queue:work redis > /dev/null 2>&1 &
```

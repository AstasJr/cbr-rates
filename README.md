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
3. Установите проект
```
docker-compose exec app php artisan setup:project
```

## Fetch currencies

1. Зайдите в app контейнер
```
docker-compose exec app bash
```
2. Запустите redis
```
php artisan queue:work redis > /dev/null 2>&1 &
```
3. Запустите команду получения списка валют
```
php artisan fetch:currencies
```
4. Запустить команду получения курсов валют (5 - необязательный параметр, количество дней)
```
php artisan fetch:currency-rate 5
```
По умолчанию команда заполняет курсы валют за 180 дней

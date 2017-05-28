# CrossUp
格ゲーを本気でやる人たちです。

## development init

```
cd laravel
npm install

composer dump-autoload
```

## migration
```
docker exec -it crossup_web_1 bash
php artisan migrate:refresh --seed

# error occurs
composer dump-autoload
```

## development build

```
cd laravel
npm run dev
```

### bulid watch

```
cd laravel
npm run watch
```
## production build

```
cd laravel
npm run prod
```
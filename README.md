# CrossUp
格ゲーを本気でやる人たちです。

## development init

```
cd laravel
npm install

docker exec -it crossup_web_1 bash
composer dump-autoload
php artisan migrate:refresh --seed
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
# CrossUp
格ゲーを本気でやる人たちです。


## development init

```
git clone [url]
cd CrossUp

cp .env.exsample .env
docker-compose build
docker-compose up -d

composer install
yarn
```

## migration
```
docker exec -it crossup_web_1 php artisan migrate --seed

# rebuild
migrate →　migrate:refresh

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

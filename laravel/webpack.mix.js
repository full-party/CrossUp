const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/top/index.js', 'public/js/top')
  .js('resources/assets/js/combo/index.js', 'public/js/combo')
  .js('resources/assets/js/combo/show.js', 'public/js/combo')
  .js('resources/assets/js/combo/create.js', 'public/js/combo')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .sass('resources/assets/sass/top/index.scss', 'public/css/top')
  .sass('resources/assets/sass/combo/index.scss', 'public/css/combo')
  .sass('resources/assets/sass/combo/show.scss', 'public/css/combo')
  .sass('resources/assets/sass/combo/create.scss', 'public/css/combo');

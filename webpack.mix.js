const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js/app.min.js')
   .sass('resources/sass/app.scss', 'public/css');
// Dashboard

mix.js([
   'resources/js/dashboard.min.js',
], 'public/js/dashboard.min.js')
.sass('resources/sass/dashboard.scss','public/css/dashboard.min.css');


// Restaurant
mix.js([
   'resources/js/detail.min.js',
], 'public/js/detail.min.js');



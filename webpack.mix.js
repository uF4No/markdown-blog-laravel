const mix = require('laravel-mix');

// for Tailwind: https://github.com/JeffreyWay/laravel-mix-tailwind
require('laravel-mix-tailwind');

// for PurgeCSS
require('laravel-mix-purgecss');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // .less('resources/less/app.less', 'public/css')
    .tailwind()
    .purgeCss({
        enabled: mix.inProduction(),
        folders: ['src', 'templates'],
        extensions: ['twig', 'html', 'js', 'php', 'vue'],
    })
    .setPublicPath('public');

const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .js('resources/js/pages/auction-items/show.js', 'public/js/pages/auction-items')
    .js('resources/js/pages/users/login/index.js', 'public/js/pages/users/login')
    .js('resources/js/pages/index.js', 'public/js/pages')
    .copyDirectory('resources/images/icons', 'public/images/icons')
    .copyDirectory('resources/images/logos', 'public/images/logos')
    .copyDirectory('resources/images/demo', 'public/images/demo')

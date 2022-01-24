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

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    .js('resources/js/pages/auction-items/index.js', 'public/js/pages/auction-items')
    .js('resources/js/pages/auction-items/show.js', 'public/js/pages/auction-items')
    .js('resources/js/pages/users/login/index.js', 'public/js/pages/users/login')
    .js('resources/js/pages/index.js', 'public/js/pages')

    // admin section
    .js('resources/js/pages/auctions/index.js', 'public/js/pages/auctions/index.js')
    .js('resources/js/pages/auctions/show.js', 'public/js/pages/auctions/show.js')
    .js('resources/js/pages/auctions/edit.js', 'public/js/pages/auctions/edit.js')
    .js('resources/js/pages/attendances/index.js', 'public/js/pages/attendances/index.js')
    .js('resources/js/pages/users/index.js', 'public/js/pages/users/index.js')
    .js('resources/js/pages/dashboard/index.js', 'public/js/pages/dashboard/index.js')
    .js('resources/js/pages/events/create.js', 'public/js/pages/events/create.js')
    .js('resources/js/pages/events/index.js', 'public/js/pages/events/index.js')

    .copyDirectory('resources/images/icons', 'public/images/icons')
    .copyDirectory('resources/images/logos', 'public/images/logos')
    .copyDirectory('resources/images/demo', 'public/images/demo')
    .copyDirectory('resources/images/favicons', 'public/images/favicons')

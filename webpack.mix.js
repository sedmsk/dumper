let mix = require('laravel-mix');


mix
    .setPublicPath('./dist/')
    .js('resources/js/app.js', 'js')
    .stylus('resources/styles/app.styl', 'css')

    .sourceMaps();


const mix = require('laravel-mix');

mix.disableNotifications();

mix.js('js/app.js', 'public/js/app.js')
    .sass('sass/webart-styles.scss', 'style.css')
    .options({
        processCssUrls: false,
    });

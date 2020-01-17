const mix = require('laravel-mix');

mix.disableNotifications();

mix.js('js/app.js', 'public/js/app.js')
    .copyDirectory('js/tinymce_buttons', 'public/js/tinymce_buttons')
    .sass('sass/webart-styles.scss', 'style.css')
    .sass('sass/webart-editor-style.scss', 'editor-style.css')
    .options({
        processCssUrls: false,
    });


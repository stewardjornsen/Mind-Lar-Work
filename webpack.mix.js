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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.js('node_modules/bs-custom-file-input/dist/bs-custom-file-input.min.js', 'public/js');
mix.js('node_modules/jquery/dist/jquery.min.js', 'public/js');
mix.copy('node_modules/@ckeditor/ckeditor5-build-classic', 'public/js/ckeditor', false);
mix.js('resources/js/custom.js', 'public/js');

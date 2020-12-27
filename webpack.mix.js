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

//  JS
mix.js('resources/js/app.js', 'public/js');
mix.copy('resources/js/theme.js', 'public/js/theme.js');

// SCSS
mix.sass('resources/sass/theme.scss', 'public/css');
mix.sass('resources/sass/theme-dark.scss', 'public/css');
mix.sass('resources/sass/custom.scss', 'public/css');
mix.sass('resources/sass/custom-dark.scss', 'public/css');

// RESOURCES
mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/vendor', 'public/vendor');


// DEMO ONLY
// mix.copyDirectory('resources/js/pages', 'public/js/pages');
mix.js('resources/js/calendar.js', 'public/js');
mix.copyDirectory('resources/data', 'public/data');
mix.copyDirectory('resources/js/json', 'public/js/json');
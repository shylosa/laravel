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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/@fortawesome/fontawesome-free/css/all.css',
    'node_modules/swiper/swiper-bundle.min.css',
    'resources/assets/front/css/style.css',
],'public/css/front.css');

mix.sass('resources/assets/front/scss/preloader.scss', 'public/css/front-partial.css')

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    'node_modules/@fortawesome/fontawesome-free/js/all.js',
    'node_modules/swiper/swiper-bundle.min.js',
    'resources/assets/front/js/swiper-config.js',
    'resources/assets/front/js/main.js',
], 'public/js/front.js');

mix.copy('resources/assets/front/fonts', 'public/fonts');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
mix.copy('resources/assets/front/images', 'public/images');

/* Admin dashboard resources */
mix.styles([
    'resources/assets/admin/css/project-photos.css',
],'public/css/admin.css');

mix.scripts([
    'resources/assets/admin/js/project-photos.js',
], 'public/js/admin.js');

mix.copy('vendor/almasaeed2010/adminlte/plugins', 'public/plugins');
mix.copy('vendor/almasaeed2010/adminlte/dist', 'public/dist');
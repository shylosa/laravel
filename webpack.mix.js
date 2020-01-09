const mix = require('laravel-mix');

mix.setPublicPath('public')

// This part is Bootstrap 4-friendly
// The Bootstrap 4-example will also autoload and extract Popper.js
mix.js('resources/js/app.js', 'js/')
  .sass('resources/sass/app.scss', 'css/')
  .autoload({
    jquery: ['$', 'jQuery', 'jquery', 'window.jQuery'],
    'node_modules/popper.js/dist/umd/popper.min.js': ['Popper']
  })
  .extract(['jquery', 'popper.js', 'bootstrap'])
  .options({
    processCssUrls: false
  });

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

mix.styles([
  'resources/assets/front/css/bootstrap.min.css',
  'resources/assets/front/css/all.min.css',
  'resources/assets/front/css/animate.min.css',
  'resources/assets/front/css/owl.carousel.css',
  'resources/assets/front/css/owl.theme.css',
  'resources/assets/front/css/owl.transitions.css',
  'resources/assets/front/css/nivo-lightbox.min.css',
  'resources/assets/front/css/style.css',
  'resources/assets/front/css/responsive.css'
],'public/css/front.css');

mix.scripts([
  'resources/assets/front/js/jquery-1.11.3.min.js',
  'resources/assets/front/js/bootstrap.min.js',
  'resources/assets/front/js/all.min.js',
  'resources/assets/front/js/owl.carousel.min.js',
  'resources/assets/front/js/jquery.stickit.min.js',
  'resources/assets/front/js/isotope.pkgd.min.js',
  'resources/assets/front/js/nivo-lightbox.min.js',
  'resources/assets/front/js/menu.js',
  'resources/assets/front/js/main.js',
  'resources/assets/front/js/scripts.js',
], 'public/js/front.js');

mix.copy('resources/assets/front/fonts', 'public/fonts');
mix.copy('resources/assets/front/webfonts', 'public/webfonts');
mix.copy('resources/assets/front/images', 'public/images');

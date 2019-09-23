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
  'resources/assets/admin/bootstrap/css/bootstrap.min.css',
  'resources/assets/admin/font-awesome/4.5.0/css/font-awesome.min.css',
  'resources/assets/admin/ionicons/2.0.1/css/ionicons.min.css',
  'resources/assets/admin/plugins/iCheck/minimal/_all.css',
  'resources/assets/admin/plugins/datepicker/bootstrap-datepicker.css',
  'resources/assets/admin/plugins/select2/select2.min.css',
  'resources/assets/admin/plugins/datatables/dataTables.bootstrap.css',
  'resources/assets/admin/dist/css/AdminLTE.min.css',
  'resources/assets/admin/dist/css/skins/_all-skins.min.css',
  'resources/assets/admin/plugins/tempus-dominus/tempusdominus-bootstrap-4.min.css'
], 'public/css/admin.css');

mix.scripts([
  'resources/assets/admin/plugins/jQuery/jquery-3.4.1.min.js',
  'resources/assets/admin/plugins/jquery-migrate/jquery-migrate-3.1.0.min.js',
  'node_modules/popper.js/dist/umd/popper.min.js',
  'resources/assets/admin/bootstrap/js/bootstrap.min.js',
  'resources/assets/admin/plugins/moment/moment-with-locales.js',
  'resources/assets/admin/plugins/select2/select2.full.min.js',
  'resources/assets/admin/plugins/datepicker/bootstrap-datepicker.js',
  'resources/assets/admin/plugins/datatables/jquery.dataTables.min.js',
  'resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js',
  'resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js',
  'resources/assets/admin/plugins/fastclick/fastclick.js',
  'resources/assets/admin/plugins/iCheck/icheck.min.js',
  'resources/assets/admin/dist/js/app.min.js',
  'resources/assets/admin/dist/js/demo.js',
  'resources/assets/admin/plugins/tempus-dominus/tempusdominus-bootstrap-4.min.js',
  'resources/assets/admin/plugins/ckeditor/ckeditor.js',
  'resources/assets/admin/plugins/ckfinder/ckfinder.js',
  'resources/assets/admin/dist/js/scripts.js'
], 'public/js/admin.js');

mix.copy('resources/assets/admin/bootstrap/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/img', 'public/img');
mix.copy('resources/assets/admin/plugins/iCheck/minimal/blue.png', 'public/css');

mix.styles([
  'resources/assets/front/css/bootstrap.min.css',
  'resources/assets/front/css/font-awesome.min.css',
  'resources/assets/front/css/animate.min.css',
  'resources/assets/front/css/owl.carousel.css',
  'resources/assets/front/css/owl.theme.css',
  'resources/assets/front/css/owl.transitions.css',
  'resources/assets/front/css/style.css',
  'resources/assets/front/css/responsive.css'
],'public/css/front.css');

mix.scripts([
  'resources/assets/front/js/jquery-1.11.3.min.js',
  'resources/assets/front/js/bootstrap.min.js',
  'resources/assets/front/js/owl.carousel.min.js',
  'resources/assets/front/js/jquery.stickit.min.js',
  'resources/assets/front/js/menu.js',
  'resources/assets/front/js/scripts.js'
], 'public/js/front.js');

mix.copy('resources/assets/front/fonts', 'public/fonts');
mix.copy('resources/assets/front/images', 'public/images');

var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // mix.sass('app.scss');
  mix.styles([
    "./public/assets/admin/css/reset.css",
    "./public/assets/admin/css/layout.css",
    "./public/assets/admin/css/components.css",
    "./public/assets/admin/css/plugins.css",
    "./public/assets/admin/css/themes/default.theme.css",
    "./public/assets/admin/css/custom.css",
  ], 'public/styles/dist/vendor.min.css');

  // mix.scripts([
  //   './public/bower/vue/dist/vue.min.js',
  //   'vendor/vue-resource.min.js'
  // ], 'public/scripts/dist/vendor.min.js');
});

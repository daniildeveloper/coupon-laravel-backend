const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */
// compile css
elixir((mix) => { 
    mix.sass('app.scss', 'public/css/app.css');
    mix.webpack('./node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', './public/js');

    mix.webpack('./node_modules/jquery/dist/jquery.min.js');
    mix.webpack('./node_modules/jquery.countdown/jquery.countdown.js');

    // bootstrap glyphicons
    mix.copy('./node_modules/bootstrap-sass/assets/fonts/bootstrap/', './public/fonts');

    // fontawesome
    mix.copy('./node_modules/font-awesome/fonts','./public/fonts');

    mix.styles([
      './node_modules/font-awesome/css/font-awesome.min.css'
      ], 'public/css/font-awesome.min.css');

    mix.webpack('./node_modules/chart.js/dist/Chart.bundle.min.js');

    /**
     * tinymce
     */
    mix.copy('./node_modules/tinymce/', './public/tinymce');
    mix.copy('./node_modules/tinymce-i18n/langs', './public/langs');

    /**
     * Material date time picker
     */
    mix.copy('./node_modules/bootstrap-material-datetimepicker', './public/bootstrap-material-date-timepicker');
    // moment
    mix.copy('./node_modules/moment/min/moment-with-locales.min.js', './public/js');
    mix.copy('./node_modules/moment/locale/', './public/locale');
});
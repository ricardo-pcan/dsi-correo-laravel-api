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
    mix.sass( 'app.scss', 'public/vendor/css/app.css' )
        .scripts([ 'jquery-1.11.3.js',
                    'angular.min.js' ], 'public/vendor/js/app.js' )
        .scripts([
            '/angular_core/app.js'
                    ], 'public/assets/js/core.js')
        .copy('resources/assets/images', 'public/vendor/images');
});

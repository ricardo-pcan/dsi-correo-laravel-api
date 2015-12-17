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
        .scripts([
            'jquery-1.11.3.js',
            'bootstrap.min.js',
            'vendor/jquery_datatables.js',
            'vendor/angular.min.js',
            'vendor/angular-datatables.js',
            'vendor/angular-datatables.util.js',
            'vendor/angular-datatables.options.js',
            'vendor/angular-datatables.instances.js',
            'vendor/angular-datatables.factory.js',
            'vendor/angular-datatables.renderer.js',
            'vendor/angular-datatables.directive.js',
        ], 'public/vendor/js/app.js' )

        // angular controllers

        .scripts([
            'angular/app.js',
            'angular/controllers/main_controller.js',
            'angular/controllers/dashboard_controller.js',
        ], 'public/assets/js/angular.js')
        // Images
        .copy('resources/assets/images', 'public/vendor/images')

        // Angular modules
        .copy( 'node_modules/angular/angular.min.js', 'public/vendor/js' )
        .copy( 'node_modules/angular-oauth2/dist/angular-oauth2.min.js', 'public/vendor/js' )
        .copy( 'node_modules/angular-cookies/angular-cookies.min.js', 'public/vendor/js' )
        .copy( 'node_modules/query-string/index.js', 'public/vendor/js/query-string.js');
});

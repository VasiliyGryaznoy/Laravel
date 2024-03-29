const elixir = require('laravel-elixir');

require('laravel-elixir-angular');

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
    mix.angular('resources/admin-app/', 'public/admin-app/', 'app.js');
    mix.scripts(['*.js'], 'public/admin-app/libs.js', 'resources/admin-js-libs');
});

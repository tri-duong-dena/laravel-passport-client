var elixir = require('laravel-elixir');
elixir.config.js.browserify.transformers[0].options.stage = 0

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

elixir.config.css.outputFolder = 'static/user/css/app.css';
elixir(function(mix) {
    mix.sass('app.scss');
    mix.browserify('app.js');
});

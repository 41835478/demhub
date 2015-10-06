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

// Configure the paths
var bower_path = "./vendor/bower_components";
var paths = {
    'jquery'      : bower_path + '/jquery/dist',
    'jqueryui'    : bower_path + '/jquery-ui',
    'bootstrap'   : bower_path + '/bootstrap-sass/assets/',
    'fontawesome' : bower_path + '/font-awesome'
};

elixir(function (mix) {
  // Merge the SASS stylesheets into the core.css file
  mix.sass("core.scss", "public/assets/css", {
    includePaths: [
      paths.bootstrap   + '/stylesheets',
      paths.fontawesome + '/scss'
    ]
  });

  // Merge JavaScripts into core.js and dependencies.js
  mix.scripts("core.js", "public/assets/js/core.js", "resources/assets/js");
  mix.scripts([
    paths.jquery    + '/jquery.min.js',
    paths.jqueryui  + '/jquery-ui.min.js',
    paths.bootstrap + '/javascripts/bootstrap.min.js'
  ], 'public/assets/js/dependencies.js', '.');

  // Copy the bootstrap fonts and font awesome assets
  mix.copy([
    paths.fontawesome + '/fonts',
    paths.bootstrap   + '/fonts/bootstrap'
  ], 'public/assets/fonts');
});

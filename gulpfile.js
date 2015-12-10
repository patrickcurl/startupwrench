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

var paths = {
	'bower_path': 'resources/assets/bower/',
	'bootstrap': 'resources/assets/bower/bootstrap-sass/assets'
}
elixir(function(mix) {
    mix.sass('app.scss')
    .copy('resources/assets/bower/bootstrap-sass/assets/stylesheets/', 'resources/assets/sass')
    .copy(paths.bootstrap + 'fonts/bootstrap', 'public/fonts')
    .copy(paths.bower_path + 'jquery/dist/jquery.min.js', 'public/js/vendor/jquery.js')
    .copy(paths.bower_path + 'font-awesome/css/font-awesome.min.css', 'resources/assets/sass')
    .copy(paths.bower_path + 'font-awesome/fonts', 'public/fonts')
    .copy(paths.bower_path + 'tinymce', 'public/js/tinymce');
    // .copy(paths.bower_path + 'algoliasearch/dist/algoliasearch.jquery.min.js', 'public/js/vendor/algoliasearch.jquery.min.js');

    mix.scripts([
    	'./resources/assets/bower/jquery/dist/jquery.min.js',
        './resources/assets/bower/jquery-validation/dist/jquery.validate.min.js',
        './resources/assets/bower/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js',
        './resources/assets/bower/moment/min/moment-with-locales.min.js',
        
    	'./resources/assets/bower/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        './resources/assets/bower/bootstrap-filestyle/src/bootstrap-filestyle.min.js',
        './resources/assets/bower/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        './resources/assets/bower/bootstrap-daterangepicker/daterangepicker.js',
       // './resources/assets/bower/',
    	'./resources/assets/bower/modernizer/modernizr.js',
    	'./resources/assets/bower/easing/easing-min.js',
        './resources/assets/bower/bootstrap-paginator/build/bootstrap-paginator.min.js',
        './resources/assets/bower/algoliasearch/dist/algoliasearch.min.js',
    ], 'public/js/vendor.js');	
});

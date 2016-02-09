var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix
        // Copy webfont files from /vendor directories to /public directory.
        .copy('vendor/fortawesome/font-awesome/fonts',                          'public/build/fonts/font-awesome')
        .copy('vendor/twbs/bootstrap-sass/assets/fonts/bootstrap',              'public/build/fonts/bootstrap')
        .copy('vendor/twbs/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/vendor')
        .copy('vendor/twbs/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/js/vendor')
        .copy('resources/assets/js/frontend/plugins/ZeroClipboard.swf',         'public/js')
        .copy('resources/assets/js/frontend/userhome/feed.js',                  'public/js/frontend/userhome')


        .sass([ // Process front-end stylesheets
            'frontend/main.scss'
        ],  'resources/assets/css/frontend/main.css')
        .styles([  // Combine pre-processed CSS files
            'frontend/main.css'
        ],  'public/css/frontend.css')


        .sass([ // Process individual front-end stylesheets
            'frontend/fullscreen.scss'
        ],  'resources/assets/css/frontend/fullscreen.css')
        .styles([  // Combine pre-processed CSS files
            'frontend/fullscreen.css'
        ],  'public/css/fullscreen.css')

        .scripts([ // Combine front-end scripts
            'plugins.js',
            'frontend/main.js',
            'frontend/plugins/jquery.backstretch.min.js',
            'frontend/fullscreen/init.js',
            'frontend/forms/register.js',
            'frontend/resource_filter/map.js',
            'frontend/plugins/modernizr-2.8.3.min.js',
            'frontend/plugins/jquery.zclip.js',
            'frontend/plugins/jquery.maphilight.js',
            'frontend/plugins/moment.js',
            'frontend/plugins/bootstrap-datetimepicker.js',
            'frontend/publications/index.js',
            'frontend/Page-animate/page-specific-animation.js', //some animations for multiple pages
            'frontend/divisions/feeds.js',
            'frontend/card/bookmark.js',
            'frontend/card/follow.js',
            'frontend/includes/feedback.js',
            'frontend/includes/invites.js'
        ],  'public/js/frontend.js')


        .sass([ // Process back-end stylesheets
            'backend/main.scss',
            'backend/skin.scss',
            'backend/plugin/toastr/toastr.scss'
        ],  'resources/assets/css/backend/main.css')
        .styles([ // Combine pre-processed CSS files
            'backend/main.css'
        ],  'public/css/backend.css')

        .scripts([ // Combine back-end scripts
            'plugins.js',
            'backend/main.js',
            'backend/plugin/toastr/toastr.min.js',
            'backend/custom.js'
        ],  'public/js/backend.js')


        .sass([ // Process core stylesheets
            'core/core.scss',
        ],  'resources/assets/css/core/core.css')
        .styles([ // Combine pre-processed CSS files
            'core/core.css'
        ],  'public/css/core.css')


        // Apply version control
        .version([
            'public/css/frontend.css',
            'public/js/frontend.js',
            'public/css/backend.css',
            'public/js/backend.js',
            'public/css/core.css'
        ]);
});

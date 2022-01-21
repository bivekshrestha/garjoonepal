const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css', {
        sassOptions: {
            includePaths: ['node_modules'],
        },
    })
    .autoload({
        jquery: ['$', 'jQuery', 'window.jQuery']
    })
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}

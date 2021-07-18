const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/appBackend.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
             'vue$': 'vue/dist/vue.esm.js',
            '@': __dirname + '/resources/js',
            '@comp': __dirname + '/resources/js/components',
        },
    },
});
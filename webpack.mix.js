const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    purifyCss: false,
    //purifyCss: {},
    postCss: [require('autoprefixer')],
    clearConsole: false,
    cssNano: {
        // discardComments: {removeAll: true},
    }
});
mix.extract(['jquery', 'anchorme', 'bootstrap', 'axios', 'compressorjs']);
mix.extract();

mix.copy('resources/js/client.js', 'public/js/client.js').minify('public/js/client.js');
mix.copy('resources/js/worker.js', 'public/js/worker.js').minify('public/js/worker.js');
mix.copy('resources/js/admin.js', 'public/js/admin.js').minify('public/js/admin.js');
mix.copy('resources/js/blog.js', 'public/js/blog.js').minify('public/js/blog.js');
mix.copy('resources/js/forum.js', 'public/js/forum.js').minify('public/js/forum.js');

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/user.js', 'public/js')
    .sass('resources/sass/mobile.scss', 'public/css')
    .sass('resources/sass/large.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')

mix.minify('public/js/app.js');
mix.minify('public/js/user.js');

mix.copy('resources/js/lib', 'public/js/');

mix.version();
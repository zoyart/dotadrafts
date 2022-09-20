const mix = require('laravel-mix');

mix.js('resources/js/script.js', 'public/js').postCss('resources/css/style.css', 'public/css', [
        //
]);
mix.copy('resources/images/heroes', 'public/images/heroes');

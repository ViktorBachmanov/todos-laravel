const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/todo-card.js", "public/js")
    .js("resources/js/edit-todo-modal.js", "public/js")
    .js("resources/js/tags-filter.js", "public/js")
    .js("resources/js/app-bar.js", "public/js")
    .js("resources/js/todos.js", "public/js")
    .sourceMaps()
    // .postCss("resources/css/app.css", "public/css", [
    //     //
    // ])
    .sass("resources/sass/app.scss", "public/css")
    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
}

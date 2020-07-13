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

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/supplier.js','public/js')
   .js('resources/js/equipment.js','public/js')
   .js('resources/js/project.js','public/js')
   .js('resources/js/expense.js','public/js')
   .js('resources/js/bill.js','public/js')
   .js('resources/js/equipment_sales.js','public/js')
   .js('resources/js/mobilization.js','public/js')
   .js('resources/js/role.js','public/js')
   .js('resources/js/operator.js','public/js')
    .sass('resources/sass/app.scss', 'public/css');

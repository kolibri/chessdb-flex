var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('app', './assets/js/app.js')
    .enableSassLoader()
    .cleanupOutputBeforeBuild()
;

module.exports = Encore.getWebpackConfig();

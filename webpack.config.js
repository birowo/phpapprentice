var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('docs')
    .setPublicPath('/')
    .addEntry('js/site', './assets/js/site.js')
    .addStyleEntry('css/site', './assets/css/site.css')
    .enablePostCssLoader()
    .configureBabel(function (babel) {
        babel.plugins.push(['prismjs', {
            "languages": ["php"],
            "css": false,
        }]);
    });
;

module.exports = Encore.getWebpackConfig();

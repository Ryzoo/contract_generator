var path = require('path');
var webpack = require('webpack');

module.exports = {
  entry: [
    path.resolve(__dirname, '../../src/application.js') // arguments can be seen as being passed to `cd` and chained from left to right; see https://nodejs.org/api/path.html#path_path_resolve_from_to
  ],
  module: {
    loaders: [{
        test: /\.js$/,
        exclude: /node_modules/,
        loader: [path.resolve(__dirname, '../node_modules/babel-loader')],
        query: {
          cacheDirectory: true,
          presets: [path.resolve(__dirname, '../node_modules/babel-preset-es2015')]
        }
      },
      {
        test: /\.css$/,
        loaders: [path.resolve(__dirname, '../node_modules/style-loader'),path.resolve(__dirname, '../node_modules/css-loader')]
      }
    ]
  },
  output: {
    path: path.resolve(__dirname, '../../'),
    publicPath: '/',
    filename: 'init.js',
    devtoolModuleFilenameTemplate: '[resource-path]' // copied from Mathias, see: https://webpack.github.io/docs/configuration.html#output-devtoolmodulefilenametemplate
  },
  resolve: {
    // had problems importing react in src/components with the following option, so I disabled it again.
    //root: 'src', // allows us to specify import paths as if they were from the root of the src directory. This makes it very easy to navigate to files regardless of how deeply nested your current file is. https://webpack.github.io/docs/configuration.html#resolve-root
    extensions: ['', '.js'] // '' is required for Webpack to work!?!
  },
  stats: {
    colors: true
  }
};

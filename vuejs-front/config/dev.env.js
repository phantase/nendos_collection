var merge = require('webpack-merge')
var prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  API_URL: '"http://docker:3000"',
  IMG_URL: '"http://docker:3000"',
  DEFAULT_USERNAME: '"phantase@phantase.com"',
  DEFAULT_PASSWORD: '"phantase"'
})

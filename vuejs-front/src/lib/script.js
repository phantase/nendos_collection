import 'bootstrap'

import 'admin-lte'

import 'filedrop'

import 'trumbowyg'
// Warning, have to move icons.svg from trumbowyg folder in node_modules to static to have this working...
// Have to find a better way to do that automatically
$.trumbowyg.svgPath = 'static/trumbowyg/ui/icons.svg'
// Warning, have perform a change in the dist retrieve by npm.
// Change: define(['jquery'], factory); to define(['jQuery'], factory); [line:11]
// Change: factory(require('jQuery')); to factory(require('jQuery')); [line:14]
// Have to check if it will work in production (because in that case, this is the min that maybe has to be changed)
import 'select2'

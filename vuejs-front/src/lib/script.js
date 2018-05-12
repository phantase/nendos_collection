import 'bootstrap'

import 'admin-lte'

import 'filedrop'

import 'trumbowyg'
// Warning, have to move icons.svg from trumbowyg folder in node_modules to static to have this working...
// Have to find a better way to do that automatically
$.trumbowyg.svgPath = 'static/trumbowyg/ui/icons.svg'

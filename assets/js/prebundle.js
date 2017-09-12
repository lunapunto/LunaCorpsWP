/*- Node Modules -*/
window.$ = window.jQuery = require("jquery");
require("./scripts/velocity");
require("jquery-confirm");
require("jquery-lazy");

var jQueryBridget = require('jquery-bridget');
var Flickity = require('flickity');
jQueryBridget( 'flickity', Flickity, $ );

var fonts = require("google-fonts");
fonts.add({
  'Open Sans': ['100', '300', '400', '400italic', '500', '600', '700'],
  'Roboto': ['100', '300', '400', '400italic', '500', '600', '700']
})

/*- Custom Scripts -*/
require("./scripts/global.js");
if(isset('body.main')){
  require("./scripts/main.js");
}
if(isset('body.admin')){
  require("./scripts/main.js");
}


/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

Neatline.module('Map', function(
  Map, Neatline, Backbone, Marionette, $, _) {


  Map.ID = 'MAP';


  Map.addInitializer(function() {
    Map.__collection = new Neatline.Shared.Record.Collection();
    Map.__view = new Neatline.Map.View();
    Map.__view.requestRecords();
  });


});

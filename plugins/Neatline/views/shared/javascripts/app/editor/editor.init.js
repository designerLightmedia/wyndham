
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

Neatline.module('Editor', { startWithParent: false,
  define: function(Editor, Neatline, Backbone, Marionette, $, _) {


  Editor.ID = 'EDITOR';


  /**
   * Start the editor before Neatline.
   */
  Neatline.on('initialize:before', function() {
    Editor.start();
  });


  /**
   * Start the map editor after Neatline.
   */
  Neatline.on('initialize:after', function() {
    Editor.Map.start();
    Backbone.history.start();
  });


  /**
   * Initialize the layout view.
   */
  Editor.addInitializer(function() {
    Editor.__view = new Editor.View({ el: 'body' });
  });


}});


/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

Neatline.module('Presenter.None', function(
  None, Neatline, Backbone, Marionette, $, _) {


  None.ID = 'PRESENTER:None';


  var none = function() {};
  Neatline.commands.setHandler(None.ID+':highlight',    none);
  Neatline.commands.setHandler(None.ID+':unhighlight',  none);
  Neatline.commands.setHandler(None.ID+':select',       none);
  Neatline.commands.setHandler(None.ID+':unselect',     none);
  Neatline.vent.on('PRESENTER:activate',                none);
  Neatline.vent.on('PRESENTER:deactivate',              none);


});

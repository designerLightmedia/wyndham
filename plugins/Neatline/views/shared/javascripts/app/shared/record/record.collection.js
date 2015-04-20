
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

Neatline.module('Shared.Record', function(
  Record, Neatline, Backbone, Marionette, $, _) {


  Record.Collection = Backbone.Neatline.Collection.extend({


    model: Neatline.Shared.Record.Model,


    /**
     * Fetch a subset of the collection from the server.
     *
     * @param {Object} params: Query parameters.
     * @param {Function} cb: Called when `fetch` completes.
     */
    update: function(params, cb) {

      // Add the exhibit id to the request.
      params = _.extend(params, {
        exhibit_id: Neatline.g.neatline.exhibit.id
      });

      this.fetch({ reset: true, data: $.param(params), success: cb });

    },


    /**
     * Construct the API url.
     *
     * @return {String}: The url.
     */
    url: function() {
      return Neatline.g.neatline.records_api;
    },


    /**
     * Cache the total count and offset, return records array.
     *
     * @return {Array}: The records collection.
     */
    parse: function(response) {
      this.offset = Number(response.offset);
      this.count  = Number(response.count);
      return response.records;
    }


  });


});

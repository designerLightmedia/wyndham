<?php

/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<script>
  STRINGS = {
    record: {
      save: {
        success:  '<?php echo __('The record was saved successfully!'); ?>',
        error:    '<?php echo __('There was an error; the record was not saved.'); ?>'
      },
      remove: {
        success:  '<?php echo __('The record was deleted successfully!'); ?>',
        error:    '<?php echo __('There was an error; the record was not deleted.'); ?>'
      },
      add: {
        success:  '<?php echo __('New record created successfully!'); ?>',
        error:    '<?php echo __('There was an error; a new record was not created.'); ?>'
      },
      placeholders: {
        title:    '<?php echo __('[Untitled]'); ?>'
      }
    },
    exhibit: {
      save: {
        success:  '<?php echo __('The exhibit was saved successfully!'); ?>',
        error:    '<?php echo __('There was an error; the exhibit was not saved.'); ?>'
      }
    },
    styles: {
      save: {
        success:  '<?php echo __('The styles were saved successfully!'); ?>',
        error:    '<?php echo __('There was an error; the styles were not saved.'); ?>'
      }
    },
    svg: {
      parse: {
        success:  '<?php echo __('SVG parsed successfully!'); ?>',
        error:    '<?php echo __('There was an error; SVG could not be parsed.'); ?>'
      }
    }
  };
</script>

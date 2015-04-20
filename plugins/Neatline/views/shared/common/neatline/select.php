<?php

/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<div class="form-group">

  <label><?php echo __($label); ?></label>

    <select
      class="form-control <?php if (isset($class)) echo $class; ?>"
      <?php if (isset($name)) echo "name='$name'"; ?>
      <?php if (isset($multi) && $multi) echo "multiple='multiple'"; ?>
      <?php if (isset($bind)) echo "data-rv-value='$bind'"; ?>
    >

      <?php foreach ($options as $label => $val): ?>
        <option value="<?php echo $val; ?>">
          <?php echo $label; ?>
        </option>
      <?php endforeach; ?>

    </select>

</div>

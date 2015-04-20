<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Then
 */

define('THEN_NOW_IMAGE_PLUGIN_DIR', dirname(__FILE__));

require_once THEN_NOW_IMAGE_PLUGIN_DIR . DIRECTORY_SEPARATOR
           . 'ThenNowImagePlugin.php';

new ThenNowImagePlugin;

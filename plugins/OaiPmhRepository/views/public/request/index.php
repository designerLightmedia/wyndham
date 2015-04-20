<?php
/**
 * Request view
 *
 * The view for the outward-facing request page.  Simply outputs the XML
 * passed in by the controller.
 *
 * @package OaiPmhRepository
 * @subpackage Views
 * @author John Flatness, Yu-Hsun Lin
 * @copyright Copyright 2009 John Flatness, Yu-Hsun Lin
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
header('Content-Type: text/xml');

echo $response;
<?php
/**
 * @package Swat
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright silverorange 2004
 */
require_once('Swat/SwatCellRenderer.php');

/**
 * A renderer for a boolean value.
 */
class SwatCellRendererCheck extends SwatCellRenderer {

	public $value;

	public function render() {
		if ((boolean)$this->value) {
			$image_tag = new SwatHtmlTag('img');
			$image_tag->src = 'swat/images/check.png';
			$image_tag->display();
		} else {
			echo '&nbsp;';
		}
	}
}

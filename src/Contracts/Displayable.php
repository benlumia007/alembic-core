<?php
/**
 * Displayable contract.
 *
 * Displayable classes should implement a `display()` method. The intent of this
 * method is to output an HTML string to the screen. This data should already be
 * escaped prior to being output.
 *
 * @package   Alembic Core
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright 2021. Benjamin Lu
 * @link      https://github.com/benlumia007/benjlu
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Alembic\Contracts;

/**
 * Displayable interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Displayable {
	/**
	 * Prints the HTML string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function display();
}
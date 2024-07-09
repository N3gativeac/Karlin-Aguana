<?php
/**
 * Customizer custom control: Horizontal Line
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OneStore_Customize_Control_HR' ) ) :
/**
 * Horizontal line control class
 */
class OneStore_Customize_Control_HR extends OneStore_Customize_Control {
	/**
	 * @var string
	 */
	public $type = 'onestore-hr';

	/**
	 * Render control's content
	 */
	protected function render_content() {
		?><hr><?php
	}
}
endif;
<?php
/**
 * Customizer base control for OneStore's custom controls.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OneStore_Customize_Control' ) ) :
/**
 * Horizontal line control class
 */
class OneStore_Customize_Control extends WP_Customize_Control {
	/**
	 * @var string
	 */
	public $type = 'onestore-base';

	/**
	 * Render control's content
	 */
	protected function render_content() {}

	/**
	 * Render Underscore JS template for this control's content.
	 */
	protected function content_template() {}

}
endif;
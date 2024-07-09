<?php
/**
 * Customizer custom section: Spacer
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'OneStore_Customize_Section_Spacer' ) ) :
/**
 * Spacer section class.
 */
class OneStore_Customize_Section_Spacer extends WP_Customize_Section {
	/**
	 * @var string
	 */
	public $type = 'main-section-spacer';

	/**
	 * Render Underscore JS template for this section.
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}"></li>
		<?php
	}
}

// Register section type.
$wp_customize->register_section_type( 'OneStore_Customize_Section_Spacer' );
endif;
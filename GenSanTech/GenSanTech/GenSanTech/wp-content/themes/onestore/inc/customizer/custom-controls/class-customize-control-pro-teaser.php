<?php
/**
 * Customizer custom control: Pro Teaser
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OneStore_Customize_Control_Pro_Teaser' ) ) :
/**
 * Pro Teaser control class
 */
class OneStore_Customize_Control_Pro_Teaser extends OneStore_Customize_Control {
	/**
	 * @var string
	 */
	public $type = 'onestore-pro-teaser';

	/**
	 * @var string
	 */
	public $url = '#';

	/**
	 * @var array
	 */
	public $features = array();

	/**
	 * Render control's content
	 */
	protected function render_content() {
		if ( ! empty( $this->label ) ) : ?>
			<div class="onestore-pro-teaser">
				<div class="wp-clearfix">
					<h3><?php echo $this->label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-small button-secondary alignright" target="_blank" rel="noopener"><?php echo esc_html_x( 'Learn More', 'OneStore Plus upsell', 'onestore' ); ?></a>
				</div>
				<?php if ( ! empty( $this->features ) ) : ?>
					<ul>
						<?php foreach ( $this->features as $feature ) : ?>
							<li><?php echo $feature; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif;
	}
}
endif;
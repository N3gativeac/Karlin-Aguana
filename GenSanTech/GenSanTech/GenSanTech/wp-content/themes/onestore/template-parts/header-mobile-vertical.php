<?php
/**
 * Mobile header vertical template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elements = onestore_get_theme_mod( 'header_mobile_elements_vertical_top', array() );
$count = count( $elements );

if ( 1 > $count ) {
	return;
}

$display = onestore_get_theme_mod( 'header_mobile_vertical_bar_display' );
?>
<div id="mobile-vertical-header" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/header_mobile_vertical_classes', array( 'header-mobile-vertical', 'onestore-header', 'popup' ) ) ) ); ?>" itemtype="https://schema.org/WPHeader" itemscope>
	<?php if ( 'drawer' === $display ) : ?>
	<div class="popup-background popup-close">
		<button class="popup-close-icon popup-close action-toggle"><?php onestore_icon( 'x' ); ?></button>
	</div>
	<?php endif; ?>

	<div class="header-mobile-vertical-bar header-section-vertical popup-content">
		<div class="header-mobile-vertical-bar-inner header-section-vertical-inner">
			<div class="header-section-vertical-column">
				<div class="popup-heading">
					<div class="inner">
						<?php $class = has_custom_logo() ? 'logo-img' : 'logo-text';
							$class .= ' header-logo';
						?>
						<div class="<?php echo esc_attr( $class ); ?> site-branding menu">
							<div class="site-title menu-item h1">
								<a href="<?php echo esc_url( apply_filters( 'onestore/frontend/logo_url', home_url( '/' ) ) ); ?>" rel="home" class="onestore-menu-item-link">
									<?php
										/**
										 * Hook: onestore/frontend/logo
										 *
										 * @hooked onestore_default_logo - 10
										 */
										do_action( 'onestore/frontend/logo' );
									?>
								</a>
							</div>
						</div>
					</div>

					<button class="popup-close action-toggle"><?php onestore_icon( 'x' ); ?></button>
				</div>

				<div class="header-mobile-vertical-bar-top header-section-vertical-row">
					<?php foreach ( $elements as $index => $element ) {
						onestore_header_element( $element, 'item-' . $index . ' header-vertical-item' );
} ?>
				</div>
			</div>

			<?php if ( 'full-screen' === $display ) : ?>
			<button class="popup-close-icon popup-close action-toggle"><?php onestore_icon( 'x' ); ?></button>
			<?php endif; ?>
		</div>
	</div>
</div>
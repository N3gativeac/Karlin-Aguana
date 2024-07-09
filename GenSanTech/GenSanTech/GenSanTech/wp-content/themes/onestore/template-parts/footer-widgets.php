<?php
/**
 * Footer widgets section template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$columns = intval( onestore_get_theme_mod( 'footer_widgets_bar' ) );

if ( 1 > $columns ) {
	return;
}

$print_row = 0;
for ( $i = 1; $i <= $columns; $i++ ) {
	if ( is_active_sidebar( 'footer-widgets-' . $i ) ) {
		$print_row = true;
		break;
	}
}
?>
<div id="onestore-footer-widgets-bar" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/footer_widgets_bar_classes', array( 'onestore-footer-widgets-bar', 'onestore-footer-section', 'onestore-section' ) ) ) ); ?>">
	<div class="onestore-footer-widgets-bar-inner section-inner">
		<div class="wrapper">
			<?php if ( $print_row ) : ?>
				<div class="onestore-footer-widgets-bar-row <?php echo esc_attr( 'onestore-footer-widgets-bar-columns-' . onestore_get_theme_mod( 'footer_widgets_bar' ) ); ?>">
					<?php for ( $i = 1; $i <= $columns; $i++ ) : ?>
						<div class="onestore-footer-widgets-bar-column-<?php echo esc_attr( $i ); ?> onestore-footer-widgets-bar-column">
							<?php if ( is_active_sidebar( 'footer-widgets-' . $i ) ) {
								dynamic_sidebar( 'footer-widgets-' . $i );
							} ?>
						</div>
					<?php endfor; ?>
				</div>
			<?php endif; ?>

			<?php
			// Bottom Bar (if merged)
			if ( intval( onestore_get_theme_mod( 'footer_bottom_bar_merged' ) ) ) {
				onestore_footer_bottom();
			}
			?>

		</div>
	</div>
</div>
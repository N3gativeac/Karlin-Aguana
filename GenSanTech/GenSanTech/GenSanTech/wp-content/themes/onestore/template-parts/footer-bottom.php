<?php
/**
 * Footer bottom section template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$cols = array( 'left', 'center', 'right' );

$elements = array();
$count = 0;

foreach ( $cols as $col ) {
	$elements[ $col ] = onestore_get_theme_mod( 'footer_elements_bottom_' . $col, array() );
	$count += empty( $elements[ $col ] ) ? 0 : count( $elements[ $col ] );
}

if ( 1 > $count ) {
	return;
}

?>
<div id="onestore-footer-bottom-bar" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/footer_bottom_bar_classes', array( 'onestore-footer-bottom-bar', 'site-info', 'onestore-footer-section', 'onestore-section' ) ) ) ); ?>">
	<div class="onestore-footer-bottom-bar-inner section-inner">
		<div class="wrapper">
			<div class="onestore-footer-bottom-bar-row onestore-footer-row <?php echo esc_attr( ( 0 < count( $elements['center'] ) ) ? 'onestore-footer-row-with-center' : '' ); ?>">
				<?php foreach ( $cols as $col ) : ?>
					<?php
					// Skip center column if it's empty
					if ( 'center' === $col && 0 === count( $elements[ $col ] ) ) {
						continue;
					}
					?>
					<div class="onestore-footer-bottom-bar-<?php echo esc_attr( $col ); ?> onestore-footer-bottom-bar-column">
						<?php
						// Print all elements inside the column.
						foreach ( $elements[ $col ] as $element ) {
							onestore_footer_element( $element );
						}
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
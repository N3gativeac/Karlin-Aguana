<?php

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elements = array();
$count = 0;
$cols = array( 'left', 'center', 'right' );

foreach ( $cols as $col ) {
	$elements[ $col ] = onestore_get_theme_mod( 'page_header_elements_' . $col );
	$count += count( $elements[ $col ] );
}

if ( 1 > $count ) {
	return;
}
?>
<section id="page-header" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/page_header_classes', array( 'onestore-page-header' ) ) ) ); ?>" role="region" aria-label="<?php esc_attr_e( 'Page Header', 'onestore' ); ?>">
	<div class="section-inner">
		<div class="wrapper">
			<div class="page-header-inner page-header-row <?php echo esc_attr( ( 0 < count( $elements['center'] ) ) ? 'page-header-row-with-center' : '' ); ?>">
				<?php foreach ( $cols as $col ) : ?>
					<?php
					// Skip center column if it's empty.
					if ( 'center' === $col && 0 === count( $elements[ $col ] ) ) {
						continue;
					}
					?>
					<div class="page-header-<?php echo esc_attr( $col ); ?> page-header-column <?php echo esc_attr( 0 === count( $elements[ $col ] ) ? 'page-header-column-empty' : '' ); ?>">
						<?php
						// Print all elements inside the column.
						foreach ( $elements[ $col ] as $element ) {
							onestore_page_header_element( $element );
						}
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

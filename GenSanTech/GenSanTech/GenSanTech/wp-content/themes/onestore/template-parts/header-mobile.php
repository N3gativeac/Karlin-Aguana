<?php
/**
 * Mobile header sections template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="mobile-header" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/header_mobile_classes', array( 'header-mobile', 'onestore-header' ) ) ) ); ?>">
	<?php
	$elements = array();
	$count = 0;
	$cols = array( 'left', 'center', 'right' );

	foreach ( $cols as $col ) {
		$elements[ $col ] = onestore_get_theme_mod( 'header_mobile_elements_main_' . $col, array() );
		$count += count( $elements[ $col ] );
	}

	if ( 1 > $count ) {
		return;
	}

	$attrs_array = apply_filters(
		'onestore/frontend/header_mobile_main_bar_attrs',
		array(
			'data-height' => intval( onestore_get_theme_mod( 'header_mobile_main_bar_height' ) ),
		)
	);
	$attrs = '';
	foreach ( $attrs_array as $key => $value ) {
		$attrs .= ' ' . $key . '="' . esc_attr( $value ) . '"';
	}

	$is_sticky = intval( onestore_get_theme_mod( 'header_mobile_main_bar_sticky' ) );
	$classes = array( 'header-mobile-main-bar', 'header-section', 'onestore-section', 'main-section-default' );
	if ( $is_sticky ) {
		$classes[] = 'is-sticky';
	}
	$class = implode( ' ', apply_filters( 'onestore/frontend/header_mobile_main_bar_classes', $classes ) );

	?>
	<div id="header-mobile-main-bar" class="<?php echo esc_attr( $class ); ?>" <?php echo $attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="header-mobile-main-bar-inner section-inner">
			<div class="wrapper">
				<div class="header-mobile-main-bar-row header-row <?php echo esc_attr( ( 0 < count( $elements['center'] ) ) ? 'header-row-with-center' : '' ); ?>">
					<?php foreach ( $cols as $col ) : ?>
						<?php
						// Skip center column if it's empty
						if ( 'center' === $col && 0 === count( $elements[ $col ] ) ) {
							continue;
						}
						?>
						<div class="<?php echo esc_attr( 'header-mobile-main-bar-' . $col ); ?> header-column">
							<?php
							// Print all elements inside the column.
							foreach ( $elements[ $col ] as $element ) {
								onestore_header_element( $element );
							}
							?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

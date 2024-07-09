<?php
/**
 * Main header bottom bar template.
 *
 * Passed variables:
 *
 * @type boolean $merged whether it's a merged header bar.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elements = array();
$count = 0;
$cols = array( 'left', 'center', 'right' );

foreach ( $cols as $col ) {
	$elements[ $col ] = onestore_get_theme_mod( 'header_elements_bottom_' . $col, array() );
	$count += count( $elements[ $col ] );
}

if ( 1 > $count ) {
	return;
}

$attrs_array = apply_filters(
	'onestore/frontend/header_bottom_bar_attrs',
	array(
		'data-height' => intval( onestore_get_theme_mod( 'header_bottom_bar_height' ) ),
	)
);
$attrs = '';
foreach ( $attrs_array as $key => $value ) {
	$attrs .= ' ' . $key . '="' . esc_attr( $value ) . '"';
}

?>
<div id="header-bottom-bar" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/header_bottom_bar_classes', array( 'header-bottom-bar', 'header-section', 'onestore-section' ) ) ) ); ?>" <?php echo $attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

	<?php if ( $merged ) : ?>
		<div class="wrapper">
			<div class="header-bottom-bar-inner section-inner">
	<?php else : ?>
		<div class="header-bottom-bar-inner section-inner">
			<div class="wrapper">
	<?php endif; ?>

			<div class="header-bottom-bar-row header-row <?php echo esc_attr( ( 0 < count( $elements['center'] ) ) ? 'header-row-with-center' : '' ); ?>">
			<?php
				onestore_header_columns( $cols, $elements, 'header-bottom-bar-', 'header-column' );
			?>	
			</div>

		</div>
	</div>
</div>

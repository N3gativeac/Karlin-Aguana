<?php
/**
 * Main header main bar template.
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
	$elements[ $col ] = onestore_get_theme_mod( 'header_elements_main_' . $col, array() );
	$count += count( $elements[ $col ] );
}

if ( 1 > $count ) {
	return;
}

$attrs_array = apply_filters(
	'onestore/frontend/header_main_bar_attrs',
	array(
		'data-height' => intval( onestore_get_theme_mod( 'header_main_bar_height' ) ),
	)
);
$attrs = '';
foreach ( $attrs_array as $key => $value ) {
	$attrs .= ' ' . $key . '="' . esc_attr( $value ) . '"';
}

$is_sticky = intval( onestore_get_theme_mod( 'header_main_bar_sticky' ) );
$classes = array( 'header-main-bar', 'header-section', 'onestore-section' );
if ( $is_sticky ) {
	$classes[] = 'is-sticky';
}
$class = implode( ' ', apply_filters( 'onestore/frontend/header_main_bar_classes', $classes ) );
?>
<div id="header-main-bar" class="<?php echo esc_attr( $class ); ?>" <?php echo $attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="header-main-bar-inner section-inner">

		<?php
		// Top Bar (if merged).
		if ( intval( onestore_get_theme_mod( 'header_top_bar_merged' ) ) ) {
			onestore_main_header__top_bar( true );
		}
		?>

		<div class="wrapper">
			<div class="header-main-bar-row header-row <?php echo esc_attr( ( 0 < count( $elements['center'] ) ) ? 'header-row-with-center' : '' ); ?>">
				<?php
				onestore_header_columns( $cols, $elements, 'header-main-bar-', 'header-column' );
				?>
			</div>
		</div>

		<?php
		// Bottom Bar (if merged).
		if ( intval( onestore_get_theme_mod( 'header_bottom_bar_merged' ) ) ) {
			onestore_main_header__bottom_bar( true );
		}
		?>

	</div>
</div>

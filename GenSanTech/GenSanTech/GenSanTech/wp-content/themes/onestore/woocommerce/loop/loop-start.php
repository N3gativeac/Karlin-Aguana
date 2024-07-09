<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$name = wc_get_loop_prop( 'name' );
$values = '4-3-2';
switch ( $name ) {
	case 'related':
	case 'recent-viewed':
	case 'up-sells':
		$values = onestore_get_theme_mod( 'woocommerce_single_more_grid_columns' );
		break;
	case 'cross-sells':
		$values = onestore_get_theme_mod( 'woocommerce_cart_cross_sells_grid_columns' );
		break;
	case 'builder_widget':
		$values = wc_get_loop_prop( 'builder_widget_columns' );
		break;
	default:
		$values = onestore_get_theme_mod( 'woocommerce_index_grid_columns' );
}


if ( ! $name ) {
	$classes = 'main-products-list';
} else {
	$classes = $name . '-products-list';
}

$classes .= ' device-columns products';
$settings = onestore_string_to_devices( $values );

?>
<ul <?php onestore_array_to_html_attributes( $settings ); ?> class="<?php echo esc_attr( $classes ); ?>">

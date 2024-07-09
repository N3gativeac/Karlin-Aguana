<?php
/**
 * Header free text (button) template.
 *
 * Passed variables:
 *
 * @type string $slug Header element slug.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$class = $class . ' header-' . $slug . ' menu';
$el_id = str_replace( '-', '_', $slug );

$text = onestore_get_theme_mod( 'header_' . $el_id . '_text' );
$icon = trim( onestore_get_theme_mod( 'header_' . $el_id . '_icon' ) );
$button_class = onestore_get_theme_mod( 'header_' . $el_id . '_class' );
$url = onestore_get_theme_mod( 'header_' . $el_id . '_url' );
$link_only = false;
if ( strpos( $button_class, 'link-only' ) !== false ) {
	$link_only = true;
} else {
	$button_class = $button_class . ' button';
}
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<div class="button-inner">
	<a class="<?php echo esc_attr( $button_class ); ?>" href='<?php echo esc_url( $url ); ?>'><?php
	if ( $icon ) {
		if ( substr( $icon, 0, 1 ) == ':' ) {
			onestore_icon( substr( $icon, 1 ) );
		} else {
			echo '<span class="onestore-icon onestore-menu-icon">';
			echo do_shortcode( $icon );
			echo '</span>';
		}
	}
		echo do_shortcode( $text );
	?></a>
	</div>
</div>

<?php
/**
 * Header free text (HTML) template.
 *
 * Passed variables:
 *
 * @type string $slug Header element slug.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;
$class = $class . ' header-' . $slug . ' menu';
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<div><?php echo do_shortcode( onestore_get_theme_mod( 'header_' . str_replace( '-', '_', $slug ) . '_content' ) ); ?></div>
</div>
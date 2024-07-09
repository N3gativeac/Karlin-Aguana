<?php
/**
 * Mobile header logo template.
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

$class = has_custom_logo() ? 'logo-img' : 'logo-text';
$class .= ' header-' . $slug;
?>
<div class="<?php echo esc_attr( $class ); ?> site-branding menu">
	<div class="site-title menu-item h1">
		<a href="<?php echo esc_url( apply_filters( 'onestore/frontend/logo_url', home_url( '/' ) ) ); ?>" rel="home" class="onestore-menu-item-link">
			<?php
			/**
			 * Hook: onestore/frontend/mobile_logo
			 *
			 * @hooked onestore_default_mobile_logo - 10
			 */
			do_action( 'onestore/frontend/mobile_logo' );
			?>
		</a>
	</div>
</div>

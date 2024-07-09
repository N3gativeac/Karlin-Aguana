<?php
/**
 * Header logo template.
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

$class .= has_custom_logo() ? 'logo-img' : 'logo-text';
$class .= ' header-' . $slug;
?>
<div class="<?php echo esc_attr( $class ); ?> site-branding menu">
	<<?php echo is_front_page() && is_home() ? 'h1' : 'div'; ?> class="site-title menu-item h1">
		<a href="<?php echo esc_url( apply_filters( 'onestore/frontend/logo_url', home_url( '/' ) ) ); ?>" rel="home" class="onestore-menu-item-link">
			<?php
			/**
			 * Hook: onestore/frontend/logo
			 *
			 * @hooked onestore_default_logo - 10
			 */
			do_action( 'onestore/frontend/logo' );
			?>
		</a>
	</<?php echo is_front_page() && is_home() ? 'h1' : 'div'; ?>>
</div>

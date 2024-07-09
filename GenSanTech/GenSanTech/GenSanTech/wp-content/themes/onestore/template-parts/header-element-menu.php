<?php
/**
 * Header menu template.
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


$class = $class . ' header-' . $slug . '  header-menu site-navigation';
?>
<nav class="<?php echo esc_attr( $class ); ?>" itemtype="https://schema.org/SiteNavigationElement" itemscope role="navigation" aria-label="<?php /* translators: %s: menu number. */ echo esc_attr( sprintf( esc_html__( 'Header Menu %s', 'onestore' ), str_replace( 'menu-', '', $slug ) ) ); ?>">
	<?php wp_nav_menu(
		array(
			'theme_location' => 'header-' . $slug,
			'menu_class'     => 'menu onestore-hover-menu',
			'container'      => false,
			'fallback_cb'    => 'onestore_unassigned_menu',
		)
	); ?>
</nav>

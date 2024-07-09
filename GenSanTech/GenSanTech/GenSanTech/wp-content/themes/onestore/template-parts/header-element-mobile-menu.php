<?php
/**
 * Mobile header menu template.
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
<nav class="<?php echo esc_attr( $class ); ?> " itemtype="https://schema.org/SiteNavigationElement" itemscope role="navigation" aria-label="<?php esc_attr_e( 'Mobile Header Menu', 'onestore' ); ?>">
	<?php wp_nav_menu(
		array(
			'theme_location' => 'header-' . $slug,
			'menu_class'     => 'menu action-toggle-menu',
			'menu_id'     => 'menu-mobile-menu',
			'container'      => false,
			'fallback_cb'    => 'onestore_unassigned_menu',
		)
	); ?>
</nav>

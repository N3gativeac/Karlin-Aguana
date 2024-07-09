<?php
/**
 * Footer menu template.
 *
 * Passed variables:
 *
 * @type string $slug Footer element slug.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<nav class="<?php echo esc_attr( 'onestore-footer-' . $slug ); ?> onestore-footer-menu site-navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope role="navigation" aria-label="<?php /* translators: %s: menu number. */ echo esc_attr( sprintf( esc_html__( 'Footer Menu %s', 'onestore' ), str_replace( 'menu-', '', $slug ) ) ); ?>">
	<?php wp_nav_menu( array(
		'theme_location' => 'footer-' . $slug,
		'menu_class'     => 'menu',
		'container'      => false,
		'depth'          => -1,
		'fallback_cb'    => 'onestore_unassigned_menu',
	) ); ?>
</nav>
<?php
/**
 * Displays Header Top Navigation
 *
 * @package Signify
 */
?>

<?php if ( has_nav_menu( 'menu-top' ) ) : ?>
	<nav id="site-top-navigation" class="top-navigation site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'signify-ecommerce' ); ?>">
		<?php wp_nav_menu( array(
			'theme_location'  => 'menu-top',
			'container_class' => 'top-menu-container',
			'menu_class'      => 'top-menu',
		) ); ?>
	</nav><!-- #site-top-navigation -->
<?php endif;

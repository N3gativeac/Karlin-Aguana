<?php
/**
 * The sidebar containing Shop (WooCommerce) widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Get current page content layout, skip sidebar if not needed in the layout.
if ( ! in_array( onestore_get_current_page_setting( 'content_layout' ), array( 'left-sidebar', 'right-sidebar' ) ) ) return;
?>
<aside id="secondary" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/sidebar_classes', array( 'widget-area', 'sidebar' ) ) ) ); ?>" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope>
	<?php
	/**
	 * Hook: onestore/frontend/before_sidebar
	 */
	do_action( 'onestore/frontend/before_sidebar' );
	
	if ( is_active_sidebar( 'sidebar-shop' ) ) :
	?>
		<div class="sidebar-inner">
			<?php dynamic_sidebar( 'sidebar-shop' ); ?>
		</div>
	<?php
	endif;

	/**
	 * Hook: onestore/frontend/after_sidebar
	 */
	do_action( 'onestore/frontend/after_sidebar' );
	?>
</aside>

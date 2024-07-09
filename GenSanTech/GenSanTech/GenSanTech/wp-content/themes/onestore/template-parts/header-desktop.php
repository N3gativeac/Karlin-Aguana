<?php
/**
 * Main header sections template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div id="header" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/header_classes', array( 'header-main', 'onestore-header' ) ) ) ); ?>">
	<?php
	// Top Bar (if not merged).
	if ( ! intval( onestore_get_theme_mod( 'header_top_bar_merged' ) ) ) {
		onestore_main_header__top_bar();
	}

	// Main Bar.
	onestore_main_header__main_bar();

	// Bottom Bar (if not merged).
	if ( ! intval( onestore_get_theme_mod( 'header_bottom_bar_merged' ) ) ) {
		onestore_main_header__bottom_bar();
	}
	?>
</div> 
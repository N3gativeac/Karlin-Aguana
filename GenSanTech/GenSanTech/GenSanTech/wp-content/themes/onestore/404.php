<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Header
 */
get_header();

/**
 * Primary - opening tag
 */
onestore_primary_open();

/**
 * Hook: onestore/frontend/before_main
 */
do_action( 'onestore/frontend/before_main' );

?>
<section class="error-404 not-found">
	<div class="page-content">
		<h1><?php esc_html_e( 'Page Not Found', 'onestore' ); ?></h1>
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching?', 'onestore' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section>
<?php

/**
 * Hook: onestore/frontend/after_main
 */
do_action( 'onestore/frontend/after_main' );

/**
 * Primary - closing tag
 */
onestore_primary_close();

/**
 * Sidebar
 */
get_sidebar();

/**
 * Footer
 */
get_footer();
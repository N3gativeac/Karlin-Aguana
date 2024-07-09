<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

while ( have_posts() ) : the_post();

	// Render post content using "content-page" layout.
	onestore_get_template_part( 'entry', 'page' );

endwhile;

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
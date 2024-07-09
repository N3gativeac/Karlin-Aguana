<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

	// Render post content using "content" layout.
	onestore_get_template_part( 'entry' );

endwhile;

/**
 * Hook: onestore/frontend/after_main
 * 
 * @hooked onestore_single_post_author_bio - 10
 * @hooked onestore_single_post_navigation - 15
 * @hooked onestore_entry_comments - 20
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
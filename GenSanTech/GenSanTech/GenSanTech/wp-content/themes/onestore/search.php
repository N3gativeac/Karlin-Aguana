<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
 *
 * @hooked onestore_search_header - 10
 */
do_action( 'onestore/frontend/before_main' );

if ( have_posts() ) :
	
	?>
	<div id="loop" class="onestore-loop onestore-loop-search">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Render post content using "content-search" layout on Customizer.
			onestore_get_template_part( 'entry', 'search' );

		endwhile;
		?>
	</div>
	<?php

else :

	// Render no content notice.
	onestore_get_template_part( 'entry', 'none' );

endif;

/**
 * Hook: onestore/frontend/after_main
 * 
 * @hooked onestore_loop_navigation - 10
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
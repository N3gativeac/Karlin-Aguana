<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_footer = apply_filters( 'onestore/frontend/show_footer_all', true );

			if ( $show_footer ) {
				/**
				 * Content - closing tag
				 */
				if ( apply_filters( 'onestore/frontend/show_content_wrapper', true ) ) {
					onestore_content_close();
				}

				/**
				 * Hook: onestore/frontend/before_footer
				 */
				do_action( 'onestore/frontend/before_footer' );

				/**
				 * Footer
				 */
				onestore_footer();

				/**
				 * Hook: onestore/frontend/after_footer
				 */
				do_action( 'onestore/frontend/after_footer' );
			}
			?>
			</div>
		</div>

		<?php
		if ( $show_footer ) {
			/**
			 * Hook: onestore/frontend/after_canvas
			 */
			do_action( 'onestore/frontend/after_canvas' );
		}

		/**
		 * Hook: wp_footer
		 */
		wp_footer();
		?>
	</body>
</html>

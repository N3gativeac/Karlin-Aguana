<?php
/**
 * Grid post entry template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'onestore/frontend/entry_grid/post_classes', array( 'entry', 'entry-layout-grid', 'entry-small' ) ) ); ?> role="article">
	<div class="entry-wrapper">
		<?php
		/**
		 * Hook: onestore/frontend/entry_grid/before_header
		 *
		 * @hooked onestore_entry_grid_featured_media - 10
		 */
		do_action( 'onestore/frontend/entry_grid/before_header' );
		
		if ( has_action( 'onestore/frontend/entry_grid/header' ) ) :
		?>
			<header class="entry-header <?php echo esc_attr( 'text-' . onestore_get_theme_mod( 'entry_grid_header_alignment' ) ); ?>">
				<?php
				/**
				 * Hook: onestore/frontend/entry_grid/header
				 *
				 * @hooked onestore_entry_grid_header_meta - 10
				 * @hooked onestore_entry_grid_title - 20
				 */
				do_action( 'onestore/frontend/entry_grid/header' );
				?>
			</header>
		<?php
		endif;

		/**
		 * Hook: onestore/frontend/entry_grid/after_header
		 */
		do_action( 'onestore/frontend/entry_grid/after_header' );
		?>

		<div class="entry-content entry-excerpt">
			<?php
			/**
			 * Hook: onestore/frontend/entry_grid/before_content
			 */
			do_action( 'onestore/frontend/entry_grid/before_content' );

			/**
			 * Excerpt
			 */
			if ( 0 < intval( onestore_get_theme_mod( 'entry_grid_excerpt_length' ) ) ) {
				// Excerpt
				the_excerpt();

				// Read more
				if ( '' !== onestore_get_theme_mod( 'entry_grid_read_more_display' ) ) {
					?>
					<p>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="<?php echo esc_attr( onestore_get_theme_mod( 'entry_grid_read_more_display' ) ); ?>">
							<?php
							$text = onestore_get_theme_mod( 'entry_grid_read_more_text' );
							if ( empty( $text ) ) {
								$text = esc_html__( 'Read more', 'onestore' );
							}

							echo esc_html( $text );
							?>
						</a>
					</p>
					<?php
				}
			}

			/**
			 * Hook: onestore/frontend/entry_grid/after_content
			 */
			do_action( 'onestore/frontend/entry_grid/after_content' );
			?>
		</div>

		<?php
		/**
		 * Hook: onestore/frontend/entry_grid/before_footer
		 */
		do_action( 'onestore/frontend/entry_grid/before_footer' );

		if ( has_action( 'onestore/frontend/entry_grid/footer' ) ) :
		?>
			<footer class="entry-footer <?php echo esc_attr( 'text-' . onestore_get_theme_mod( 'entry_grid_footer_alignment' ) ); ?>">
				<?php
				/**
				 * Hook: onestore/frontend/entry_grid/footer
				 * 
				 * @hooked onestore_entry_grid_footer_meta - 10
				 */
				do_action( 'onestore/frontend/entry_grid/footer' );
				?>
			</footer>
		<?php
		endif;

		/**
		 * Hook: onestore/frontend/entry_grid/after_footer
		 */
		do_action( 'onestore/frontend/entry_grid/after_footer' );
		?>
	</div>
</article>

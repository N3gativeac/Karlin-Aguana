<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	/**
	 * Hook: onestore/frontend/before_comments
	 */
	do_action( 'onestore/frontend/before_comments' );

	// You can start editing here -- including this comment!
	if ( have_comments() ) :

		/**
		 * Hook: onestore/frontend/before_comments_list
		 *
		 * @hooked onestore_comments_title - 10
		 * @hooked onestore_comments_navigation - 20
		 */
		do_action( 'onestore/frontend/before_comments_list' );
		?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 50,
				) );
			?>
		</ol>

		<?php
		/**
		 * Hook: onestore/frontend/after_comments_list
		 *
		 * @hooked onestore_comments_navigation - 10
		 * @hooked onestore_comments_closed - 20
		 */
		do_action( 'onestore/frontend/after_comments_list' );

	endif; // Check for have_comments().

	// Print comment form.
	comment_form( apply_filters( 'onestore/frontend/comment_form_args', array() ) );

	/**
	 * Hook: onestore/frontend/after_comments
	 */
	do_action( 'onestore/frontend/after_comments' );
	?>
</div>

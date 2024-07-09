<?php
/**
 * Content section closing tag template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
			</div>

			<?php
			/**
			 * Hook: onestore/frontend/after_primary_and_sidebar
			 */
			do_action( 'onestore/frontend/after_primary_and_sidebar' );
			?>

		</div>
	</div>
</div>
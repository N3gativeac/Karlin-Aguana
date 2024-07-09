<?php
/**
 * Scoll to top button template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<a href="#page" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/scroll_to_top_classes', array( 'onestore-scroll-to-top' ) ) ) ); ?>">
	<?php onestore_icon( 'chevron-up' ); ?>
	<span class="screen-reader-text"><?php esc_html_e( 'Back to Top', 'onestore' ); ?></span>
</a>
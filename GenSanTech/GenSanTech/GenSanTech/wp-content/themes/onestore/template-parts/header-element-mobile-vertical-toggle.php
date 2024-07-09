<?php
/**
 * Mobile header vertical toggle template.
 *
 * Passed variables:
 *
 * @type string $slug Header element slug.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$class = $class . ' header-' . $slug;

?>
<div class="<?php echo esc_attr( $class ); ?>">
	<button class="popup-toggle action-toggle" data-target="mobile-vertical-header" aria-expanded="false">
		<?php onestore_icon( 'menu', array( 'class' => 'onestore-menu-icon' ) ); ?>
		<span class="screen-reader-text"><?php esc_html_e( 'Mobile Menu', 'onestore' ); ?></span>
	</button>
</div>

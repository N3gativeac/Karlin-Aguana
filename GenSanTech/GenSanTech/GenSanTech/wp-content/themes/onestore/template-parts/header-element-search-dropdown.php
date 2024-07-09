<?php
/**
 * Header search dropdown template.
 *
 * Passed variables:
 *
 * @type string $slug Header element slug.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="<?php echo esc_attr( 'header-' . $slug ); ?> header-search menu action-toggle-menu">
	<div class="menu-item">
		<button class="sub-menu-toggle action-toggle" aria-expanded="false">
			<?php onestore_icon( 'search', array( 'class' => 'onestore-menu-icon' ) ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'onestore' ); ?></span>
		</button>
		<div class="sub-menu"><?php get_search_form(); ?></div>
	</div>
</div>
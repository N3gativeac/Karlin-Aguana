<?php
/**
 * Header search bar template.
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



$class = $class . ' header-' . $slug . '  header-search';
?>
<div class="<?php echo esc_attr( trim( $class ) ); ?>">
	<div class="inner">
		<?php get_search_form(); ?>
	</div>
</div>

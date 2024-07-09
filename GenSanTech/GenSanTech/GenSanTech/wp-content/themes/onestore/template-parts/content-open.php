<?php
/**
 * Content section opening tag template.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div id="content" class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/content_classes', array( 'site-content', 'onestore-section' ) ) ) ); ?>">
	<div class="content-inner section-inner">
		<div class="wrapper">

			<?php
			/**
			 * Hook: onestore/frontend/before_primary_and_sidebar
			 */
			do_action( 'onestore/frontend/before_primary_and_sidebar' );
			?> 

			<div class="content-row">
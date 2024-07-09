<?php
$ajax = onestore_get_theme_mod( 'heading_header_search_ajax' );
$product_only = false;
if ( function_exists( 'WC' ) ) {
	$product_only = onestore_get_theme_mod( 'heading_header_search_product_only' );
	$product_cat  = onestore_get_theme_mod( 'heading_header_search_product_cat' );
}

$form_classes = 'search-form';
if ( $ajax ) {
	$form_classes .= ' ajax-form';
}

?>
<form role="search" method="get" class="<?php echo esc_attr( $form_classes ); ?>" action="<?php home_url( '/' ); ?>">
	<?php if ( function_exists( 'WC' ) ) : ?>
		<?php if ( $product_only ) : ?>
		<input type="hidden" name="post_type" value="product" />
		<?php endif ?>
		<?php
		if ( $product_cat ) {
			wc_product_dropdown_categories(
				array(
					'show_option_none' => __( 'All', 'onestore' ),
					'show_count' => false,
				)
			);
		}
		?>
	<?php endif; ?>
	<label>
		<input type="search" <?php if ( $ajax ) {
			?> autocomplete="off" <?php } ?> class="search-field" placeholder="<?php esc_attr_e( 'Search…', 'onestore' ); ?>" value="<?php the_search_query(); ?>"  name="s">
	</label>
	<button type="submit" class="search-submit action-toggle" value="<?php esc_attr_e( 'Search', 'onestore' ); ?>">
		<?php onestore_icon( 'search', array( 'class' => 'onestore-search-icon' ) ); ?>
	</button>
</form>

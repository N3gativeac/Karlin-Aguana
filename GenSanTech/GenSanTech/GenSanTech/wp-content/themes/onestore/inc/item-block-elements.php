<?php
function onestore_item_block_thumb() {

	$size = 'post-thumbnail';
	$link = get_the_permalink();
	global $product;
	if ( defined( 'SAVP__PATH' ) ) {
		$class = 'savp-thumbnail loading';
		if ( $product->is_type( 'variable' ) ) {
			$class .= ' savp-variable';
		} else {
			$class .= ' savp-default';
		}
		echo '<div class="' . $class . '" data-id="' . esc_attr( $product->get_id() ) . '">';
		the_post_thumbnail( $size );
		echo '</div>';
	} else {
		echo '<a href="' . esc_url( $link ) . '" class="item-link">';
		the_post_thumbnail( $size );
		echo '</a>';
	}

}

function onestore_item_block_wc_swatches() {
	if ( function_exists( 'savp' ) ) {
		savp()->frontend()->loop_variations();
	}

}

function onestore_item_block_wc_title() {
	woocommerce_template_loop_product_link_open();
	woocommerce_template_loop_product_title();
	woocommerce_template_loop_product_link_close();
}

function onestore_item_block_wc_thumb() {
	woocommerce_template_loop_product_link_open();
	woocommerce_template_loop_product_thumbnail();
	woocommerce_template_loop_product_link_close();
}

function onestore_item_block_wc_price() {
	woocommerce_template_loop_price();
}

function onestore_item_block_wc_wishlist_icon() {
	if ( ! defined( 'YITH_WCWL' ) ) {
		return false;
	}
	echo do_shortcode( '[yith_wcwl_add_to_wishlist link_classes="wishlist-button" label="" product_added_text="" already_in_wishslist_text="" browse_wishlist_text=""]' ); // WPCS: XSS ok.
}
function onestore_item_block_wc_quick_view_icon() {
	global $product;
	if ( ! $product ) {
		return;
	}

	?>
	<a href="<?php the_permalink(); ?>" data-product-id="<?php echo $product->get_id(); ?>" class="quick_view ajax-quick-view builder-item-icon button quickview-icon icon-only">
	<?php
	onestore_icon( 'eye' );
	?>
	</a>
	<?php
}

function onestore_item_block_wc_price_less() {
	global $product;
	$price_html = false;
	if ( $product->is_type( 'variable' ) ) {
		$prices = $product->get_variation_prices( true );

		if ( empty( $prices['price'] ) ) {
			$price = apply_filters( 'woocommerce_variable_empty_price_html', '', $product );
		} else {
			$min_price     = current( $prices['price'] );
			$max_price     = end( $prices['price'] );
			$min_reg_price = current( $prices['regular_price'] );
			$max_reg_price = end( $prices['regular_price'] );
			$price = wc_price( $min_price );
			$price = apply_filters( 'woocommerce_variable_price_html', $price . $product->get_price_suffix(), $product );
		}
		$price_html = apply_filters( 'woocommerce_get_price_html', $price, $product );
	} else {
		if ( '' === $product->get_price() ) {
			$price = apply_filters( 'woocommerce_empty_price_html', '', $product );
		} else {
			$price = wc_price( wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
		}
		$price_html = apply_filters( 'woocommerce_get_price_html', $price, $product );
	}

	if ( $price_html ) {
		echo '<span class="price">' . $price_html . '</span>'; // WPCS: XSS ok.
	}

}
function onestore_item_block_wc_rating() {
	woocommerce_template_loop_rating();
}

function onestore_item_block_wc_sale() {
	woocommerce_show_product_loop_sale_flash();
}

function onestore_item_block_wc_add_to_cart() {
	woocommerce_template_loop_add_to_cart();
}

function onestore_item_block_wc_add_to_cart_icon() {

	global $product;

	if ( $product ) {
		$defaults = array(
			'quantity'   => 1,
			'class'      => implode(
				' ',
				array_filter(
					array(
						'button',
						'product_type_' . $product->get_type(),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
					)
				)
			),
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);

		$args = apply_filters( 'woocommerce_loop_add_to_cart_args', $defaults, $product );

		if ( isset( $args['attributes']['aria-label'] ) ) {
			$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
		}

		echo apply_filters(
			'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
			sprintf(
				'<a href="%s" data-quantity="%s" class="item-cart-icon icon-only %s" %s>%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
				esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
				isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
				onestore_icon( 'shopping-bag', array(), false )
			),
			$product,
			$args
		);
	}

}

function onestore_item_block_wc_category() {
	global $product;
	$html = wc_get_product_category_list( $product->get_id() );
	if ( $html ) {
		echo '<div class="cat-item text-nowrap">' . $html . '</div>'; // WPCS: XSS ok.
	}
}

function onestore_item_block_wc_sale_percent() {
	global $product;
	$percent = false;
	if ( $product->is_type( 'variable' ) ) {
		$percentages = array();

		// Get all variation prices.
		$prices = $product->get_variation_prices();

		// Loop through variation prices.
		foreach ( $prices['price'] as $key => $price ) {
			$regular_price = $prices['regular_price'][ $key ];
			$sale_price = $prices['sale_price'][ $key ];
			// Only on sale variations.
			if ( $sale_price > 0 && $regular_price !== $sale_price ) {
				// Calculate and set in the array the percentage for each variation on sale.
				$percentages[] = round( 100 - ( $sale_price / $regular_price * 100 ) );
			}
		}
		if ( ! empty( $percentages ) ) {
			$percent = max( $percentages ) . '%';
		}
	} else {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();
		if ( $sale_price > 0 && $regular_price != $sale_price ) {
			$percent   = round( 100 - ( $sale_price / $regular_price * 100 ) ) . '%';
		}
	}

	if ( $percent ) {
		echo '<span class="onsale onsale-percent button">-' . $percent . '</span>';
	}

}






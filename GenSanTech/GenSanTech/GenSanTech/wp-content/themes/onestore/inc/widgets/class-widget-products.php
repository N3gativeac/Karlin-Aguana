<?php

// Work only for WooCommerce Enabled;
if ( ! function_exists( 'wc' ) ) {
	return;
}

/**
 * Widget products.
 */
class OneStore_Widget_Products extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'onestore widget_products';
		$this->widget_description = __( 'Display products, recommended for front page.', 'onestore' );
		$this->widget_id          = 'onestore_products';
		$this->widget_name        = __( 'OneSotre: Products', 'onestore' );
		$this->settings           = array(
			'title'       => array(
				'type'  => 'text',
				'std'   => __( 'Products', 'onestore' ),
				'label' => __( 'Title', 'onestore' ),
			),
			'columns'      => array(
				'type'  => 'text',
				'max'   => '',
				'std'   => '4-3-2',
				'label' => __( 'Columns', 'onestore' ),
			),
			'number'      => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 4,
				'label' => __( 'Number of products to show', 'onestore' ),
			),
			'show'        => array(
				'type'    => 'select',
				'std'     => '',
				'label'   => __( 'Show', 'onestore' ),
				'options' => array(
					''         => __( 'All products', 'onestore' ),
					'featured' => __( 'Featured products', 'onestore' ),
					'onsale'   => __( 'On-sale products', 'onestore' ),
				),
			),
			'include' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Include ids(separated by commas)', 'onestore' ),
			),
			'exclude' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Exclude ids(separated by commas)', 'onestore' ),
			),
			'orderby'     => array(
				'type'    => 'select',
				'std'     => 'date',
				'label'   => __( 'Order by', 'onestore' ),
				'options' => array(
					'date'  => __( 'Date', 'onestore' ),
					'price' => __( 'Price', 'onestore' ),
					'rand'  => __( 'Random', 'onestore' ),
					'sales' => __( 'Sales', 'onestore' ),
					'post__in' => __( 'Include ids', 'onestore' ),
				),
			),
			'order'       => array(
				'type'    => 'select',
				'std'     => 'desc',
				'label'   => _x( 'Order', 'Sorting order', 'onestore' ),
				'options' => array(
					'asc'  => __( 'ASC', 'onestore' ),
					'desc' => __( 'DESC', 'onestore' ),
				),
			),
			'hide_free'   => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide free products', 'onestore' ),
			),
			'show_hidden' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show hidden products', 'onestore' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Query the products and return them.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 *
	 * @return WP_Query
	 */
	public function get_products( $args, $instance ) {
		$number                      = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$show                        = ! empty( $instance['show'] ) ? sanitize_title( $instance['show'] ) : $this->settings['show']['std'];
		$orderby                     = ! empty( $instance['orderby'] ) ? sanitize_title( $instance['orderby'] ) : $this->settings['orderby']['std'];
		$order                       = ! empty( $instance['order'] ) ? sanitize_title( $instance['order'] ) : $this->settings['order']['std'];
		$include                       = ! empty( $instance['include'] ) ? sanitize_text_field( $instance['include'] ) : $this->settings['include']['std'];
		$exclude                       = ! empty( $instance['exclude'] ) ? sanitize_text_field( $instance['exclude'] ) : $this->settings['exclude']['std'];
		$product_visibility_term_ids = wc_get_product_visibility_term_ids();

		$query_args = array(
			'posts_per_page' => $number,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'no_found_rows'  => 1,
			'order'          => $order,
			'meta_query'     => array(),
			'tax_query'      => array(
				'relation' => 'AND',
			),
		); // WPCS: slow query ok.

		$include_ids     = array_filter( array_map( 'trim', explode( ',', $include ) ) );
		$exclude_ids        = array_filter( array_map( 'trim', explode( ',', $exclude ) ) );
		if ( ! empty( $include_ids ) ) {
			$query_args['post__in'] = $include_ids;
		}
		if ( ! empty( $exclude_ids ) ) {
			$query_args['post__not_in'] = $exclude_ids;
		}

		if ( empty( $instance['show_hidden'] ) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
				'operator' => 'NOT IN',
			);
			$query_args['post_parent'] = 0;
		}

		if ( ! empty( $instance['hide_free'] ) ) {
			$query_args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}

		if ( 'yes' === get_option( 'onestore_hide_out_of_stock_items' ) ) {
			$query_args['tax_query'][] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_term_ids['outofstock'],
					'operator' => 'NOT IN',
				),
			); // WPCS: slow query ok.
		}

		switch ( $show ) {
			case 'featured':
				$query_args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_term_ids['featured'],
				);
				break;
			case 'onsale':
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query_args['post__in'] = $product_ids_on_sale;
				break;
		}

		switch ( $orderby ) {
			case 'price':
				$query_args['meta_key'] = '_price'; // WPCS: slow query ok.
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand':
				$query_args['orderby'] = 'rand';
				break;
			case 'sales':
				$query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
				$query_args['orderby']  = 'meta_value_num';
				break;
			default:
				$query_args['orderby'] = 'date';
		}

		return new WP_Query( apply_filters( 'onestore_products_widget_query_args', $query_args ) );
	}

	/**
	 * Output widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 *
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$query = $this->get_products( $args, $instance );

		$columns = isset( $instance['columns'] ) ? $instance['columns'] : '4-3-2';

		wc_set_loop_prop( 'name', 'builder_widget' );
		wc_set_loop_prop( 'builder_widget_columns', $columns );

		if ( $query && $query->have_posts() ) {

			$this->widget_start( $args, $instance );
			echo wp_kses_post( apply_filters( 'woocommerce_before_widget_product_list', '<div class="woocommerce">' ) );

			woocommerce_product_loop_start();

			while ( $query->have_posts() ) :
				$query->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
			woocommerce_product_loop_end();

			echo wp_kses_post( apply_filters( 'woocommerce_after_widget_product_list', '</div>' ) );

			$this->widget_end( $args );
		}

		wp_reset_postdata();

		echo $this->cache_widget( $args, ob_get_clean() ); // WPCS: XSS ok.
	}
}






register_widget( 'OneStore_Widget_Products' );

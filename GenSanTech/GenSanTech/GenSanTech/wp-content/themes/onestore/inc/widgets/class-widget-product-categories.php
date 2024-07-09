<?php

if ( ! function_exists( 'wc' ) ) {
	return;
}
/**
 * Product categories widget class.
 *
 * @extends WC_Widget
 */
class OneStore_Widget_Product_Categories extends WC_Widget {
	/**
	 * Category ancestors.
	 *
	 * @var array
	 */
	public $cat_ancestors;

	/**
	 * Current Category.
	 *
	 * @var bool
	 */
	public $current_cat;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'onestore widget_product_categories';
		$this->widget_description = __( 'Display product categories, recommended for front page.', 'onestore' );
		$this->widget_id          = 'onestore_product_categories';
		$this->widget_name        = __( 'OneStore: Product Categories', 'onestore' );
		$this->settings           = array(
			'title'              => array(
				'type'  => 'text',
				'std'   => __( 'Product categories', 'onestore' ),
				'label' => __( 'Title', 'onestore' ),
			),
			'number'      => array(
				'type'  => 'number',
				'max'   => '',
				'step'   => 1,
				'min'   => 2,
				'std'   => 8,
				'label' => __( 'Limit', 'onestore' ),
			),
			'columns'      => array(
				'type'  => 'text',
				'max'   => '',
				'std'   => '4-3-2',
				'label' => __( 'Columns', 'onestore' ),
			),
			'orderby'            => array(
				'type'    => 'select',
				'std'     => 'name',
				'label'   => __( 'Order by', 'onestore' ),
				'options' => array(
					'order' => __( 'Category order', 'onestore' ),
					'name'  => __( 'Name', 'onestore' ),
					'count'  => __( 'Count', 'onestore' ),
					'include'  => __( 'Include', 'onestore' ),
					'term_id'  => __( 'Term id', 'onestore' ),
				),
			),
			'order'            => array(
				'type'    => 'select',
				'std'     => 'asc',
				'label'   => __( 'Order', 'onestore' ),
				'options' => array(
					'asc' => __( 'ASC', 'onestore' ),
					'desc'  => __( 'DESC', 'onestore' ),
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
			'hide_empty'         => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide empty categories', 'onestore' ),
			),

		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 * @param array $args     Widget arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		global $wp_query, $post;

		$include      = isset( $instance['include'] ) ? $instance['include'] : $this->settings['include']['std'];
		$exclude     = isset( $instance['exclude'] ) ? $instance['exclude'] : $this->settings['exclude']['std'];
		$orderby      = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
		$order        = isset( $instance['order'] ) ? $instance['order'] : $this->settings['order']['std'];
		$hide_empty   = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
		$columns      = isset( $instance['columns'] ) ? $instance['columns'] : $this->settings['columns']['std'];
		$number      = isset( $instance['number'] ) ? intval( $instance['number'] ) : $this->settings['number']['std'];

		$ids        = array_filter( array_map( 'trim', explode( ',', $include ) ) );
		$exclude_ids        = array_filter( array_map( 'trim', explode( ',', $exclude ) ) );
		if ( ! $number ) {
			$number  = '-1';
		}

		// Get terms and workaround WP bug with parents/pad counts.
		$query_args = array(
			'number'    => $number,
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'include'    => ! empty( $ids ) ? $ids : false,
			'exclude'    => ! empty( $exclude_ids ) ? $exclude_ids : false,
			'pad_counts' => true,
		);

		$product_categories = apply_filters(
			'onestore/widget/product_categories',
			get_terms( 'product_cat', $query_args )
		);
		wc_set_loop_prop( 'is_widget', true );
		wc_set_loop_prop( 'name', 'builder_widget' );
		wc_set_loop_prop( 'builder_widget_columns', $columns );

		$this->widget_start( $args, $instance );

		if ( $product_categories ) {
			echo '<div class="woocommerce">';
			woocommerce_product_loop_start();
			foreach ( $product_categories as $category ) {
				wc_get_template(
					'content-product_cat.php',
					array(
						'category' => $category,
					)
				);
			}
			woocommerce_product_loop_end();
			echo '</div>';
		}
		wc_set_loop_prop( 'is_widget', false );
		wc_set_loop_prop( 'name', '' );
		wc_reset_loop();

		$this->widget_end( $args );

		echo $this->cache_widget( $args, ob_get_clean() ); // WPCS: XSS ok.
	}
}


register_widget( 'OneStore_Widget_Product_Categories' );

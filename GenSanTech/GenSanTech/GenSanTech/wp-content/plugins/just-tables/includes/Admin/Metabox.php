<?php
/**
 * JustTables Metabox.
 *
 * @since 1.0.0
 */

namespace JustTables\Admin;

/**
 * Metabox class.
 */
class Metabox {

	/**
	 * Metabox constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->shortcode_metabox();
		$this->advertising_metabox();
		$this->call_to_rating_metabox();
		$this->options_metabox();
		$this->popup_metabox();
	}

	/**
	 * Table shortcode string.
	 *
	 * Get current post id and generate shortcode string.
	 *
	 * @since 1.0.0
	 *
	 * @return string Shortcode string.
	 */
	public function shortcode_string() {
		// Post id.
		if ( isset( $_GET ) && is_array( $_GET ) && isset( $_GET['post'] ) && ! empty( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		} else {
			$post_id = 0;
		}

		// Shortcode string.
		if ( ! empty( $post_id ) && 'jt-product-table' === get_post_type( $post_id ) ) {
			$shortcode = '[JT_Product_Table id="' . esc_html( $post_id ) . '"]';
		} else {
			$shortcode = esc_html__( 'Please save or publish this product table to get shortcode here.', 'just-tables' );
		}

		return $shortcode;
	}

	/**
	 * Shortcode Metabox.
	 *
	 * Create metabox for shortcode.
	 *
	 * @since 1.0.0
	 */
	public function shortcode_metabox() {
		// Shortcode string.
		$shortcode = $this->shortcode_string();

		// Metabox slug.
		$metabox_slug = '_jt_product_table_shortcode';

		// Create metabox.
		\CSF::createMetabox( $metabox_slug, array(
			'title'        => esc_html__( 'Table Shortcode', 'just-tables' ),
			'post_type'    => 'jt-product-table',
			'context'      => 'side',
			'priority'     => 'high',
			'show_restore' => false,
			'theme'        => 'light',
			'class'        => 'jt-product-table-shortcode',
		) );

		// Content section.
		\CSF::createSection( $metabox_slug, array(
			'fields' => array(

				array(
					'type'    => 'content',
					'content' => esc_html__( 'Please copy the shortcode below and use anywhere you want.', 'just-tables' ),
				),

				array(
					'type'    => 'subheading',
					'content' => $shortcode,
				),

			)
		) );
	}

	/**
	 * Advertising Metabox.
	 *
	 * Create metabox for advertising.
	 *
	 * @since 1.0.2
	 */
	public function advertising_metabox() {
		// Content.
		$content = '<div class="jt-product-table-advertising-wrapper">';
		$content .= '<div class="jt-product-table-advertising-logo"><img src="' . JUST_TABLES_ASSETS . '/images/advertising/logo.png" alt="JustTables"></div>';
		$content .= '<div class="jt-product-table-advertising-intro">' . esc_html__( 'JustTables is a fantastic WordPress plugin that allows you to display the products in a table layout so that, your customers can make buying decisions effectively through easy navigation.', 'just-tables' ) . '</div>';
		$content .= '<div class="jt-product-table-advertising-features"><ul>';
		$content .= '<li>' . esc_html__( 'Include and exclude specific products by product IDs, authors/vendors, minimum price, maximum price, product type, availability/stock status, taxonomies and terms.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Order products by all required options.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Specify the product thumbnail size.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Set behavior of title on click and thumbnail on click.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Set view product target.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Add unlimited taxonomy and attribute filters for the end-users to filter products instantly.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Enable/disable table header sorting option.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Enable/disable multiple products add to cart button.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Display export buttons.', 'just-tables' ) . '</li>';
		$content .= '<li>' . esc_html__( 'Design table with rich design options.', 'just-tables' ) . '</li>';
		$content .= '</ul></div>';
		$content .= '<div class="jt-product-table-advertising-action"><a target="_blank" href="https://hasthemes.com/plugins/justtables-woocommerce-product-table/#pricing" class="jt-product-table-advertising-button">Get Pro Now <span class="jt-product-table-advertising-button-icon"></span></a></div>';
		$content .= '</div>';

		// Metabox slug.
		$metabox_slug = '_jt_product_table_advertising';

		// Create metabox.
		\CSF::createMetabox( $metabox_slug, array(
			'title'        => esc_html__( 'Advertising', 'just-tables' ),
			'post_type'    => 'jt-product-table',
			'context'      => 'side',
			'priority'     => 'high',
			'show_restore' => false,
			'theme'        => 'light',
			'class'        => 'jt-product-table-advertising',
		) );

		// Content section.
		\CSF::createSection( $metabox_slug, array(
			'fields' => array(

				array(
					'type'    => 'content',
					'content' => $content,
				),

			)
		) );
	}

	/**
	 * Call to rating Metabox.
	 *
	 * Create metabox for call to rating.
	 *
	 * @since 1.0.2
	 */
	public function call_to_rating_metabox() {
		// Content.
		$content = '<div class="jt-product-table-call-to-rating-wrapper">';
		$content .= '<div class="jt-product-table-call-to-rating-icon"><img src="' . JUST_TABLES_ASSETS . '/images/advertising/rating.png" alt="RatingIcon"></div>';
		$content .= '<div class="jt-product-table-call-to-rating-content">If you’re loving how our product has helped your business, please let the WordPress community know by <a target="_blank" href="https://wordpress.org/support/plugin/just-tables/reviews/?filter=5#new-post">leaving us a review on our WP repository</a>. Which will motivate us a lot.</div>';
		$content .= '</div>';

		// Metabox slug.
		$metabox_slug = '_jt_product_table_call_to_rating';

		// Create metabox.
		\CSF::createMetabox( $metabox_slug, array(
			'title'        => esc_html__( 'Call to rating', 'just-tables' ),
			'post_type'    => 'jt-product-table',
			'context'      => 'side',
			'priority'     => 'high',
			'show_restore' => false,
			'theme'        => 'light',
			'class'        => 'jt-product-table-call-to-rating',
		) );

		// Content section.
		\CSF::createSection( $metabox_slug, array(
			'fields' => array(

				array(
					'type'    => 'content',
					'content' => $content,
				),

			)
		) );
	}

	/**
	 * Options Metabox.
	 *
	 * Create metabox for Product Table options.
	 *
	 * @since 1.0.0
	 */
	public function options_metabox() {
		// WooCommerce currency symbol.
		$woocommerce_currency_symbol = get_woocommerce_currency_symbol();

		// Metabox slug.
		$metabox_slug = '_jt_product_table_options';

		// Create metabox.
		\CSF::createMetabox( $metabox_slug, array(
			'title'        => esc_html__( 'Table Configuration', 'just-tables' ),
			'post_type'    => 'jt-product-table',
			'context'      => 'normal',
			'priority'     => 'high',
			'show_restore' => true,
			'theme'        => 'light',
			'class'        => 'jt-product-table-options',
		) );

		// Columns section.
		\CSF::createSection( $metabox_slug, array(
			'title'  => esc_html__( 'Columns', 'just-tables' ),
			'icon'   => 'fa fa-columns',
			'fields' => array(

				// Columns.
				array(
					'id'                     => 'columns',
					'type'                   => 'group',
					'class'                  => 'jt-product-table-columns',
					'button_title'           => esc_html__( 'Add New Column', 'just-tables' ),
					'accordion_title_number' => true,
					'fields'                 => array(

						array(
							'id'      => 'default-heading',
							'type'    => 'text',
							'title'   => esc_html__( 'Default heading', 'just-tables' ),
							'class'   => 'default-heading hidden',
							'default' => esc_html__( 'Custom Column', 'just-tables' ),
						),

						array(
							'id'      => 'fixed-heading',
							'type'    => 'text',
							'title'   => esc_html__( 'Fixed heading', 'just-tables' ),
							'class'   => 'fixed-heading hidden',
							'default' => esc_html__( 'Custom Column', 'just-tables' ),
						),

						array(
							'id'    => 'deletable',
							'type'  => 'text',
							'title' => esc_html__( 'Deletable?', 'just-tables' ),
							'class' => 'deletable hidden',
						),

						array(
							'id'    => 'column-id',
							'type'  => 'text',
							'title' => esc_html__( 'Column ID', 'just-tables' ),
							'class' => 'column-id hidden',
						),

						array(
							'id'      => 'priority',
							'type'    => 'number',
							'title'   => esc_html__( 'Priority', 'just-tables' ),
							'class'   => 'priority hidden',
							'default' => 1000,
						),

						array(
							'id'    => 'sort',
							'type'  => 'text',
							'title' => esc_html__( 'Sort', 'just-tables' ),
							'class' => 'sort hidden',
						),

						array(
							'id'       => 'active',
							'type'     => 'switcher',
							'title'    => esc_html__( 'Active', 'just-tables' ),
							'text_on'  => esc_html__( 'Yes', 'just-tables' ),
							'text_off' => esc_html__( 'No', 'just-tables' ),
							'class'    => 'active',
							'default'  => true,
						),

						array(
							'id'          => 'heading',
							'type'        => 'text',
							'title'       => esc_html__( 'Heading', 'just-tables' ),
							'desc'        => esc_html__( 'Column heading.', 'just-tables' ),
							'placeholder' => esc_html__( 'Column heading', 'just-tables' ),
							'class'       => 'heading',
						),

						array(
							'id'       => 'title-add-elements',
							'type'     => 'checkbox',
							'title'    => esc_html__( 'Additional elements', 'just-tables' ),
							'options'  => array(
								'rating'            => esc_html__( 'Rating', 'just-tables' ),
								'short-description' => esc_html__( 'Short description', 'just-tables' ),
								'description'       => esc_html__( 'Description', 'just-tables' ),
							),
							'class'   => 'title-add-elements',
						),

						array(
							'id'      => 'action-add-elements',
							'type'    => 'checkbox',
							'title'   => esc_html__( 'Additional elements', 'just-tables' ),
							'options' => array(
								'wishlist' => esc_html__( 'Wishlist', 'just-tables' ),
							),
							'class'   => 'action-add-elements',
						),

						array(
							'id'      => 'custom-type',
							'type'    => 'select',
							'title'   => esc_html__( 'Type', 'just-tables' ),
							'desc'    => esc_html__( 'Column data type.', 'just-tables' ),
							'options' => array(
								'field'    => esc_html__( 'Custom field', 'just-tables' ),
								'taxonomy' => esc_html__( 'Custom taxonomy', 'just-tables' ),
							),
							'class'   => 'custom-type',
							'default' => 'field',
						),

						array(
							'id'          => 'custom-keyword',
							'type'        => 'text',
							'title'       => esc_html__( 'Keyword', 'just-tables' ),
							'desc'        => esc_html__( 'Column data keyword of custom field or custom taxonomy.', 'just-tables' ),
							'placeholder' => esc_html__( 'Column data keyword', 'just-tables' ),
							'class'       => 'custom-keyword',
						),

						array(
							'id'         => 'column-width',
							'type'       => 'dimensions',
							'units'      => array( 'px', '%', 'em', 'rem' ),
							'title'      => esc_html__( 'Width', 'just-tables' ),
							'desc'       => esc_html__( 'Column width.', 'just-tables' ),
							'height'     => false,
							'width_icon' => '',
							'class'      => 'custom-width',
						),

					),

					'default'   => array(

						array(
							'default-heading' => esc_html__( 'Check Mark', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Check Mark', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'check',
							'priority'        => '1',
							'sort'            => 'just-tables-no-sort',
							'active'          => false,
							'heading'         => '',
						),

						array(
							'default-heading' => esc_html__( 'Serial', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Serial', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'serial',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Serial', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'ID', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'ID', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'id',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'ID', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Thumbnail', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Thumbnail', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'thumbnail',
							'priority'        => '2',
							'sort'            => 'jtpt-no-sort',
							'active'          => true,
							'heading'         => esc_html__( 'Thumbnail', 'just-tables' ),
						),

						array(
							'default-heading'    => esc_html__( 'Product Title', 'just-tables' ),
							'fixed-heading'      => esc_html__( 'Product Title', 'just-tables' ),
							'deletable'          => 'false',
							'column-id'          => 'title',
							'priority'           => '3',
							'sort'               => 'jtpt-sort',
							'active'             => true,
							'heading'            => esc_html__( 'Product Title', 'just-tables' ),
							'title-add-elements' => array( 'rating', 'short-description' ),
						),

						array(
							'default-heading' => esc_html__( 'Short Description', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Short Description', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'short-description',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Short Description', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Description', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Description', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'description',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Description', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Categories', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Categories', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'categories',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => true,
							'heading'         => esc_html__( 'Categories', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Tags', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Tags', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'tags',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Tags', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'SKU', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'SKU', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'sku',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'SKU', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Weight', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Weight', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'weight',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Weight', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Dimensions', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Dimensions', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'dimensions',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Dimensions', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Length', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Length', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'length',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Length', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Width', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Width', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'width',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Width', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Height', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Height', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'height',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Height', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Rating', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Rating', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'rating',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Rating', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Stock', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Stock', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'stock',
							'priority'        => '9',
							'sort'            => 'jtpt-sort',
							'active'          => true,
							'heading'         => esc_html__( 'Stock', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Price', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Price', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'price',
							'priority'        => '8',
							'sort'            => 'jtpt-sort',
							'active'          => true,
							'heading'         => esc_html__( 'Price', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Wishlist', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Wishlist', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'wishlist',
							'priority'        => '6',
							'sort'            => 'jtpt-no-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Wishlist', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Quantity', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Quantity', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'quantity',
							'priority'        => '7',
							'sort'            => 'jtpt-no-sort',
							'active'          => true,
							'heading'         => esc_html__( 'Quantity', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Compare', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Compare', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'compare',
							'priority'        => '1000',
							'sort'            => 'jtpt-no-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Compare', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Quick View', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Quick View', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'quick-view',
							'priority'        => '1000',
							'sort'            => 'jtpt-no-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Quick View', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Created Date', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Created Date', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'created-date',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Created Date', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Modified Date', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Modified Date', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'modified-date',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Modified Date', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Attributes', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Attributes', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'attributes',
							'priority'        => '1000',
							'sort'            => 'jtpt-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Attributes', 'just-tables' ),
						),

						array(
							'default-heading' => esc_html__( 'Variations', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'Variations', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'variations',
							'priority'        => '5',
							'sort'            => 'jtpt-no-sort',
							'active'          => false,
							'heading'         => esc_html__( 'Variations', 'just-tables' ),
						),

						array(
							'default-heading'     => esc_html__( 'Action', 'just-tables' ),
							'fixed-heading'       => esc_html__( 'Action', 'just-tables' ),
							'deletable'           => 'false',
							'column-id'           => 'action',
							'priority'            => '4',
							'sort'                => 'jtpt-no-sort',
							'active'              => true,
							'heading'             => esc_html__( 'Action', 'just-tables' ),
							'action-add-elements' => array( 'wishlist' ),
						),

						array(
							'default-heading' => esc_html__( 'View Product', 'just-tables' ),
							'fixed-heading'   => esc_html__( 'View Product', 'just-tables' ),
							'deletable'       => 'false',
							'column-id'       => 'view-product',
							'priority'        => '1000',
							'sort'            => 'jtpt-no-sort',
							'active'          => false,
							'heading'         => esc_html__( 'View Product', 'just-tables' ),
						),

					),
				),

				// Column elements notice.
				array(
					'type'    => 'content',
					'content' => sprintf(
						/*
						 * translators:
						 * 1: Wishlist column name.
						 * 2: WishSuite – Wishlist for WooCommerce plugin name and URL of WordPress.org Repository.
						 * 3: Compare column name.
						 * 4: Ever Compare – Products Compare for WooCommerce plugin name and URL of WordPress.org Repository.
						 * 5: Quick View column name.
						 * 6: YITH WooCommerce Quick View plugin name and URL of WordPress.org Repository.
						 * 7: Custom Field column name.
						 * 8: Advanced Custom Fields (ACF) plugin name and URL of WordPress.org Repository.
						 * 9: Custom Taxonomy column name.
						 * 10: YITH WooCommerce Quick View plugin name and URL of WordPress.org Repository.
						 */
						esc_html__( '%1$s column requires the %2$s plugin, %3$s column requires the %4$s plugin and %5$s column requires the %6$s plugin to be installed and activated in order to work.' ) . '<br>' . esc_html__( 'For %7$s column you may use %8$s plugin and for %9$s column you may use %10$s plugin. Besides there are lot of plugin available.', 'just-tables' ),
						'<strong>' . esc_html__( 'Wishlist', 'just-tables' ) . '</strong>',
						'<strong><a href="' . esc_url( 'https://wordpress.org/plugins/wishsuite/' ) . '" target="_blank">' . esc_html__( 'WishSuite – Wishlist for WooCommerce', 'just-tables' ) . '</a></strong>',
						'<strong>' . esc_html__( 'Compare', 'just-tables' ) . '</strong>',
						'<strong><a href="' . esc_url( 'https://wordpress.org/plugins/ever-compare/' ) . '" target="_blank">' . esc_html__( 'Ever Compare – Products Compare for WooCommerce', 'just-tables' ) . '</a></strong>',
						'<strong>' . esc_html__( 'Quick View', 'just-tables' ) . '</strong>',
						'<strong><a href="' . esc_url( 'https://wordpress.org/plugins/yith-woocommerce-quick-view/' ) . '" target="_blank">' . esc_html__( 'YITH WooCommerce Quick View', 'just-tables' ) . '</a></strong>',
						'<strong>' . esc_html__( 'Custom Field', 'just-tables' ) . '</strong>',
						'<strong><a href="' . esc_url( 'https://wordpress.org/plugins/advanced-custom-fields/' ) . '" target="_blank">' . esc_html__( 'Advanced Custom Fields (ACF)', 'just-tables' ) . '</a></strong>',
						'<strong>' . esc_html__( 'Custom Taxonomy', 'just-tables' ) . '</strong>',
						'<strong><a href="' . esc_url( 'https://wordpress.org/plugins/wck-custom-fields-and-custom-post-types-creator/' ) . '" target="_blank">' . esc_html__( 'Custom Post Types and Custom Fields creator – WCK', 'just-tables' ) . '</a></strong>'
					),
				),

			),
		) );

		// Conditions section.
		\CSF::createSection( $metabox_slug, array(
			'title'  => esc_html__( 'Conditions', 'just-tables' ),
			'icon'   => 'fa fa-sliders',
			'fields' => array(

				// Taxonomy include.
				array(
					'id'           => 'taxonomy-include',
					'type'         => 'group',
					'title'        => esc_html__( 'Taxonomy include', 'just-tables' ),
					'subtitle'     => esc_html__( 'Taxonomy terms include.', 'just-tables' ),
					'button_title' => esc_html__( 'Add New', 'just-tables' ),
					'fields'       => array(

						array(
							'id'      => 'keyword',
							'type'    => 'select',
							'before'  => esc_html__( 'Taxonomy', 'just-tables' ),
							'options' => 'product_taxonomies',
						),

						array(
							'id'     => 'term-ids',
							'type'   => 'text',
							'before' => esc_html__( 'Term IDs', 'just-tables' ),
							'desc'   => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
						),

						array(
							'id'       => 'children',
							'type'     => 'checkbox',
							'title'    => '',
							'label'    => esc_html__( 'Include children.', 'just-tables' ),
							'default'  => true,
						),

					),
				),

				// Order.
				array(
					'id'       => 'order',
					'type'     => 'select',
					'title'    => esc_html__( 'Order', 'just-tables' ),
					'subtitle' => esc_html__( 'Select products order.', 'just-tables' ),
					'options'  => array(
						'asc'  => esc_html__( 'Ascending', 'just-tables' ),
						'desc' => esc_html__( 'Descending', 'just-tables' ),
					),
					'default'  => 'desc',
				),

				// Products per page.
				array(
					'id'       => 'products-per-page',
					'type'     => 'number',
					'title'    => esc_html__( 'Products per page', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide products per page.', 'just-tables' ),
					'desc'     => esc_html__( 'Provide -1 (minus one) for show all products in a page. Example: 10 or -1.', 'just-tables' ),
					'default'  => 10,
				),

				// Taxonomy exclude.
				array(
					'id'           => 'taxonomy-exclude',
					'type'         => 'group',
					'title'        => esc_html__( 'Taxonomy exclude', 'just-tables' ),
					'subtitle'     => esc_html__( 'Taxonomy terms exclude.', 'just-tables' ),
					'button_title' => esc_html__( 'Add New', 'just-tables' ),
					'fields'       => array(

						array(
							'id'      => 'keyword',
							'type'    => 'select',
							'before'  => esc_html__( 'Taxonomy', 'just-tables' ),
							'options' => 'product_taxonomies',
						),

						array(
							'id'     => 'term-ids',
							'type'   => 'text',
							'before' => esc_html__( 'Term IDs', 'just-tables' ),
							'desc'   => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
						),

						array(
							'id'       => 'children',
							'type'     => 'checkbox',
							'title'    => '',
							'label'    => esc_html__( 'Exclude children.', 'just-tables' ),
							'default'  => true,
						),

					),
					'class'        => 'pro-field',
				),

				// Product include IDs.
				array(
					'id'       => 'product-include-ids',
					'type'     => 'text',
					'title'    => esc_html__( 'Product include IDs', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide IDs of products.', 'just-tables' ),
					'desc'     => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Product exclude IDs.
				array(
					'id'       => 'product-exclude-ids',
					'type'     => 'text',
					'title'    => esc_html__( 'Product exclude IDs', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide IDs of products.', 'just-tables' ),
					'desc'     => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Author include IDs.
				array(
					'id'       => 'author-include-ids',
					'type'     => 'text',
					'title'    => esc_html__( 'Author/Vendor include IDs', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide IDs of authors/vendors.', 'just-tables' ),
					'desc'     => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Author exclude IDs.
				array(
					'id'       => 'author-exclude-ids',
					'type'     => 'text',
					'title'    => esc_html__( 'Author/Vendor exclude IDs', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide IDs of authors/vendors.', 'just-tables' ),
					'desc'     => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Minimum price.
				array(
					'id'       => 'minimum-price',
					'type'     => 'number',
					'unit'     => $woocommerce_currency_symbol,
					'title'    => esc_html__( 'Minimum price', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide products minimum price.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: 50.', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Maximum price.
				array(
					'id'       => 'maximum-price',
					'type'     => 'number',
					'unit'     => $woocommerce_currency_symbol,
					'title'    => esc_html__( 'Maximum price', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide products maximum price.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: 100.', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Product type.
				array(
					'id'       => 'product-type',
					'type'     => 'checkbox',
					'title'    => esc_html__( 'Product type', 'just-tables' ),
					'subtitle' => esc_html__( 'Select product type.', 'just-tables' ),
					'options'  => array(
						'simple'   => esc_html__( 'Simple', 'just-tables' ),
						'variable' => esc_html__( 'Variable', 'just-tables' ),
						'grouped'  => esc_html__( 'Grouped', 'just-tables' ),
						'external' => esc_html__( 'External', 'just-tables' ),
					),
					'class'    => 'pro-field',
					'default'  => array( 'simple', 'variable', 'grouped', 'external' ),
				),

				// Availability.
				array(
					'id'       => 'availability',
					'type'     => 'checkbox',
					'title'    => esc_html__( 'Availability', 'just-tables' ),
					'subtitle' => esc_html__( 'Select products availability.', 'just-tables' ),
					'options'  => array(
						'instock'     => esc_html__( 'Products in stock', 'just-tables' ),
						'outofstock'  => esc_html__( 'Products out of stock', 'just-tables' ),
						'onbackorder' => esc_html__( 'Products available on backorder', 'just-tables' ),
					),
					'class'    => 'pro-field',
					'default'  => array( 'instock', 'outofstock', 'onbackorder' ),
				),

				// Ignore sticky product.
				array(
					'id'       => 'ignore-sticky-product',
					'type'     => 'switcher',
					'title'    => esc_html__( 'Ignore sticky product', 'just-tables' ),
					'subtitle' => esc_html__( 'Ignore sticky product in query.', 'just-tables' ),
					'text_on'  => esc_html__( 'Yes', 'just-tables' ),
					'text_off' => esc_html__( 'No', 'just-tables' ),
					'default'  => false,
					'class'    => 'pro-field',
				),

				// Orderby.
				array(
					'id'       => 'orderby',
					'type'     => 'select',
					'title'    => esc_html__( 'Orderby', 'just-tables' ),
					'subtitle' => esc_html__( 'Select products orderby.', 'just-tables' ),
					'options'  => array(
						'none'           => esc_html__( 'None', 'just-tables' ),
						'id'             => esc_html__( 'ID', 'just-tables' ),
						'author'         => esc_html__( 'Author', 'just-tables' ),
						'title'          => esc_html__( 'Product Title', 'just-tables' ),
						'name'           => esc_html__( 'Name/Slug', 'just-tables' ),
						'type'           => esc_html__( 'Type', 'just-tables' ),
						'date'           => esc_html__( 'Date', 'just-tables' ),
						'modified'       => esc_html__( 'Modified', 'just-tables' ),
						'parent'         => esc_html__( 'Parent', 'just-tables' ),
						'rand'           => esc_html__( 'Random/Rand', 'just-tables' ),
						'comment_count'  => esc_html__( 'Comment Count', 'just-tables' ),
						'relevance'      => esc_html__( 'Relevance', 'just-tables' ),
						'menu_order'     => esc_html__( 'Menu Order', 'just-tables' ),
						'meta_value'     => esc_html__( 'Meta Value', 'just-tables' ),
						'meta_value_num' => esc_html__( 'Meta Value Number', 'just-tables' ),
					),
					'class'    => 'pro-field',
					'default'  => 'date',
				),

				// Orderby meta keyword.
				array(
					'id'         => 'orderby-meta-keyword',
					'type'       => 'text',
					'title'      => esc_html__( 'Orderby meta keyword', 'just-tables' ),
					'subtitle'   => esc_html__( 'Provide orderby meta keyword.', 'just-tables' ),
					'dependency' => array( 'orderby', 'any', 'meta_value,meta_value_num' ),
					'class'      => 'pro-field',
				),

			)
		) );

		// Utilities section.
		\CSF::createSection( $metabox_slug, array(
			'title'  => esc_html__( 'Utilities', 'just-tables' ),
			'icon'   => 'fa fa-wrench',
			'fields' => array(

				// Table header.
				array(
					'id'       => 'table-header',
					'type'     => 'switcher',
					'title'    => esc_html__( 'Table header', 'just-tables' ),
					'subtitle' => esc_html__( 'Show or hide table header.', 'just-tables' ),
					'default'  => true,
				),

				// View product button text.
				array(
					'id'       => 'view-product-button-text',
					'type'     => 'text',
					'title'    => esc_html__( 'View product button text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide view product button text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: View Product.', 'just-tables' ),
					'default'  => esc_html__( 'View Product', 'just-tables' ),
				),

				// Search box.
				array(
					'id'       => 'search-box',
					'type'     => 'switcher',
					'title'    => esc_html__( 'Search box', 'just-tables' ),
					'subtitle' => esc_html__( 'Enable or disable search box.', 'just-tables' ),
					'text_on'  => esc_html__( 'Yes', 'just-tables' ),
					'text_off' => esc_html__( 'No', 'just-tables' ),
					'default'  => true,
				),

				// Search box placeholder text.
				array(
					'id'         => 'search-box-placeholder-text',
					'type'       => 'text',
					'title'      => esc_html__( 'Search box placeholder text', 'just-tables' ),
					'subtitle'   => esc_html__( 'Provide product search box placeholder text.', 'just-tables' ),
					'desc'       => esc_html__( 'Example: Search...', 'just-tables' ),
					'default'    => esc_html__( 'Search...', 'just-tables' ),
					'dependency' => array( 'search-box', '==', true ),
				),

				// In stock status text.
				array(
					'id'       => 'in-stock-status-text',
					'type'     => 'text',
					'title'    => esc_html__( 'In stock status text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide in stock status text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: In stock', 'just-tables' ),
					'default'  => esc_html__( 'In stock', 'just-tables' ),
				),

				// Out of stock status text.
				array(
					'id'       => 'out-of-stock-status-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Out of stock status text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide out of stock status text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Out of stock', 'just-tables' ),
					'default'  => esc_html__( 'Out of stock', 'just-tables' ),
				),

				// Select variation text.
				array(
					'id'       => 'select-variation-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Select variation text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide select variation text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Please select a variation!', 'just-tables' ),
					'default'  => esc_html__( 'Please select a variation!', 'just-tables' ),
				),

				// Select variation all options text.
				array(
					'id'       => 'select-variation-all-options-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Select variation all options text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide select variation all options text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Please select all options!', 'just-tables' ),
					'default'  => esc_html__( 'Please select all options!', 'just-tables' ),
				),

				// Variation not available text.
				array(
					'id'       => 'variation-not-available-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Variation not available text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide variation not available text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Not available!', 'just-tables' ),
					'default'  => esc_html__( 'Not available!', 'just-tables' ),
				),

				// Products not found text.
				array(
					'id'       => 'products-not-found-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Products not found text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide product not found text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Nothing found - sorry!', 'just-tables' ),
					'default'  => esc_html__( 'Nothing found - sorry!', 'just-tables' ),
				),

				// Paginate info text.
				array(
					'id'       => 'paginate-info-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Paginate info text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide paginate info text.', 'just-tables' ),
					'desc'     => sprintf( esc_html__( 'Example: Showing %1$s to %2$s of %3$s entries', 'just-tables' ), '_START_', '_END_', '_TOTAL_' ),
					'default'  => sprintf( esc_html__( 'Showing %1$s to %2$s of %3$s entries', 'just-tables' ), '_START_', '_END_', '_TOTAL_' ),
				),

				// Table extra class name.
				array(
					'id'       => 'table-extra-class-name',
					'type'     => 'text',
					'title'    => esc_html__( 'Table extra class name', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide extra class name of table.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: extra-class another-class', 'just-tables' ),
				),

				// Wrapper extra class name.
				array(
					'id'       => 'wrapper-extra-class-name',
					'type'     => 'text',
					'title'    => esc_html__( 'Table wrapper extra class name', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide extra class name of table wrapper.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: extra-class another-class', 'just-tables' ),
				),

				// Table header sorting.
				array(
					'id'         => 'table-header-sorting',
					'type'       => 'switcher',
					'title'      => esc_html__( 'Header sorting', 'just-tables' ),
					'subtitle'   => esc_html__( 'Enable or disable header sorting.', 'just-tables' ),
					'text_on'    => esc_html__( 'Yes', 'just-tables' ),
					'text_off'   => esc_html__( 'No', 'just-tables' ),
					'class'      => 'pro-field',
					'default'    => false,
					'dependency' => array( 'table-header', '==', true ),
				),

				// Title on click.
				array(
					'id'       => 'title-on-click',
					'type'     => 'select',
					'title'    => esc_html__( 'Title on click', 'just-tables' ),
					'subtitle' => esc_html__( 'Select behavior of title on click.', 'just-tables' ),
					'options'  => array(
						'nothing' => esc_html__( 'Nothing', 'just-tables' ),
						'view'    => esc_html__( 'View product', 'just-tables' ),
					),
					'class'    => 'pro-field',
					'default'  => 'view',
				),

				// Thumbnail size.
				array(
					'id'       => 'thumbnail-size',
					'type'     => 'fieldset',
					'title'    => esc_html__( 'Thumbnail size', 'just-tables' ),
					'subtitle' => esc_html__( 'Select thumbnail size.', 'just-tables' ),
					'class'    => 'pro-field',
					'fields'   => array(

						array(
							'id'      => 'size',
							'type'    => 'select',
							'title'   => '',
							'options' => array(
								'thumbnail'    => esc_html__( 'Thumbnail', 'just-tables' ),
								'medium'       => esc_html__( 'Medium', 'just-tables' ),
								'medium_large' => esc_html__( 'Medium large', 'just-tables' ),
								'large'        => esc_html__( 'Large', 'just-tables' ),
								'full'         => esc_html__( 'Full', 'just-tables' ),
								'custom'       => esc_html__( 'Custom', 'just-tables' ),
							),
							'default' => 'thumbnail',
						),

						array(
							'id'         => 'width',
							'type'       => 'number',
							'unit'       => 'px',
							'title'      => '',
							'before'     => esc_html__( 'Width', 'just-tables' ),
							'desc'       => esc_html__( 'Example: 100.', 'just-tables' ),
							'dependency' => array( 'size', '==', 'custom' ),
						),

						array(
							'id'         => 'height',
							'type'       => 'number',
							'unit'       => 'px',
							'title'      => '',
							'before'     => esc_html__( 'Height', 'just-tables' ),
							'desc'       => esc_html__( 'Example: 100.', 'just-tables' ),
							'dependency' => array( 'size', '==', 'custom' ),
						),

					),
				),

				// Thumnail on click.
				array(
					'id'       => 'thumbnail-on-click',
					'type'     => 'select',
					'title'    => esc_html__( 'Thumbnail on click', 'just-tables' ),
					'subtitle' => esc_html__( 'Select behavior of thumbnail on click.', 'just-tables' ),
					'options'  => array(
						'nothing' => esc_html__( 'Nothing', 'just-tables' ),
						'popup'   => esc_html__( 'Popup', 'just-tables' ),
						'view'    => esc_html__( 'View product', 'just-tables' ),
					),
					'class'    => 'pro-field',
					'default'  => 'view',
				),

				// View product target.
				array(
					'id'       => 'view-product-target',
					'type'     => 'select',
					'title'    => esc_html__( 'View product target', 'just-tables' ),
					'subtitle' => esc_html__( 'Select view product target.', 'just-tables' ),
					'options'  => array(
						'self'  => esc_html__( 'Same tab', 'just-tables' ),
						'blank' => esc_html__( 'New tab', 'just-tables' ),
					),
					'class'    => 'pro-field',
					'default'  => 'self',
				),

				// Taxonomy filter.
				array(
					'id'           => 'taxonomy-filter',
					'type'         => 'group',
					'title'        => esc_html__( 'Taxonomy filter', 'just-tables' ),
					'subtitle'     => esc_html__( 'Add taxonomy filter.', 'just-tables' ),
					'button_title' => esc_html__( 'Add New', 'just-tables' ),
					'class'        => 'pro-field',
					'fields'       => array(

						array(
							'id'      => 'keyword',
							'type'    => 'select',
							'before'  => esc_html__( 'Taxonomy', 'just-tables' ),
							'options' => 'product_taxonomies',
						),

						array(
							'id'     => 'include-term-ids',
							'type'   => 'text',
							'before' => esc_html__( 'Include term IDs', 'just-tables' ),
							'desc'   => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
						),

						array(
							'id'     => 'exclude-term-ids',
							'type'   => 'text',
							'before' => esc_html__( 'Exclude term IDs', 'just-tables' ),
							'desc'   => esc_html__( 'Separate with comma. Example: 1, 2, 3, 4.', 'just-tables' ),
						),

						array(
							'id'       => 'hide-empty',
							'type'     => 'checkbox',
							'title'    => '',
							'label'    => esc_html__( 'Hide empty terms.', 'just-tables' ),
							'default'  => true,
						),

					),
				),

				// Taxonomy filter display by default.
				array(
					'id'         => 'taxonomy-filter-display-default',
					'type'       => 'switcher',
					'title'      => esc_html__( 'Taxonomy filter display by default', 'just-tables' ),
					'subtitle'   => esc_html__( 'Show or hide taxonomy filter by default.', 'just-tables' ),
					'text_on'    => esc_html__( 'Show', 'just-tables' ),
					'text_off'   => esc_html__( 'Hide', 'just-tables' ),
					'text_width' => 75,
					'default'    => false,
					'class'      => 'pro-field',
				),

				// Export buttons.
				array(
					'id'         => 'export-buttons',
					'type'       => 'checkbox',
					'title'      => esc_html__( 'Export buttons', 'just-tables' ),
					'subtitle'   => esc_html__( 'Select export buttons to display.', 'just-tables' ),
					'options'    => array(
						'copy'  => esc_html__( 'Copy', 'just-tables' ),
						'csv'   => esc_html__( 'CSV', 'just-tables' ),
						'excel' => esc_html__( 'Excel', 'just-tables' ),
						'pdf'   => esc_html__( 'PDF', 'just-tables' ),
						'print' => esc_html__( 'Print', 'just-tables' ),
					),
					'class'      => 'pro-field',
				),

				// Select all checkbox label.
				array(
					'id'       => 'select-all-checkbox-label',
					'type'     => 'text',
					'title'    => esc_html__( 'Select all checkbox label', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide select all checkbox label.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Select All', 'just-tables' ),
					'default'  => esc_html__( 'Select All', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Multiple add to cart button text.
				array(
					'id'       => 'matc-button-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Multiple add to cart button text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide multiple add to cart button text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Add products to cart', 'just-tables' ),
					'default'  => esc_html__( 'Add products to cart', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Filter options label.
				array(
					'id'       => 'filter-options-label',
					'type'     => 'text',
					'title'    => esc_html__( 'Filter options label', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide filter options label.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Filter', 'just-tables' ),
					'default'  => esc_html__( 'Filter', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Filter options reset button text.
				array(
					'id'       => 'filter-options-reset-button-text',
					'type'     => 'text',
					'title'    => esc_html__( 'Filter options reset button text', 'just-tables' ),
					'subtitle' => esc_html__( 'Provide filter options reset button text.', 'just-tables' ),
					'desc'     => esc_html__( 'Example: Reset Filter', 'just-tables' ),
					'default'  => esc_html__( 'Reset Filter', 'just-tables' ),
					'class'    => 'pro-field',
				),

				// Paginate info.
				array(
					'id'       => 'paginate-info',
					'type'     => 'switcher',
					'title'    => esc_html__( 'Paginate info', 'just-tables' ),
					'subtitle' => esc_html__( 'Show or hide paginate info.', 'just-tables' ),
					'default'  => true,
					'class'    => 'pro-field',
				),

			),
		) );

		// Design section.
		\CSF::createSection( $metabox_slug, array(
			'title'  => esc_html__( 'Design', 'just-tables' ),
			'icon'   => 'fa fa-palette',
			'fields' => array(

				array(
					'id'         => 'design-options',
					'type'       => 'accordion',
					'title'      => '',
					'class'      => 'jt-product-table-design',
					'accordions' => array(

						// General.
						array(
							'title'  => 'General',
							'fields' => array(

								// General font family.
								array(
									'id'         => 'general-font-family',
									'type'       => 'select',
									'title'      => esc_html__( 'Font family', 'just-tables' ),
									'subtitle'   => esc_html__( 'General font family.', 'just-tables' ),
									'options'    => array(
										'default' => esc_html__( 'Default (Titillium Web)', 'just-tables' ),
										'inherit' => esc_html__( 'Inherit from theme', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

							),
						),

						// Wrapper.
						array(
							'title'  => 'Wrapper',
							'fields' => array(

								// Wrapper background color.
								array(
									'id'       => 'wrapper-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Wrapper background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Wrapper border width.
								array(
									'id'       => 'wrapper-border-width',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border width', 'just-tables' ),
									'subtitle' => esc_html__( 'Wrapper border width.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Wrapper border style.
								array(
									'id'         => 'wrapper-border-style',
									'type'       => 'select',
									'title'      => esc_html__( 'Border style', 'just-tables' ),
									'subtitle'   => esc_html__( 'Wrapper border style.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'solid'   => esc_html__( 'Solid', 'just-tables' ),
										'dashed'  => esc_html__( 'Dashed', 'just-tables' ),
										'dotted'  => esc_html__( 'Dotted', 'just-tables' ),
										'double'  => esc_html__( 'Double', 'just-tables' ),
										'inset'   => esc_html__( 'Inset', 'just-tables' ),
										'outset'  => esc_html__( 'Outset', 'just-tables' ),
										'groove'  => esc_html__( 'Groove', 'just-tables' ),
										'ridge'   => esc_html__( 'Ridge', 'just-tables' ),
										'none'    => esc_html__( 'None', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

								// Wrapper border color.
								array(
									'id'       => 'wrapper-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Wrapper border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Wrapper border radius.
								array(
									'id'       => 'wrapper-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Wrapper border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Wrapper padding.
								array(
									'id'       => 'wrapper-padding',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Padding', 'just-tables' ),
									'subtitle' => esc_html__( 'Wrapper padding.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Wrapper margin.
								array(
									'id'       => 'wrapper-margin',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Margin', 'just-tables' ),
									'subtitle' => esc_html__( 'Wrapper margin.', 'just-tables' ),
									'class'    => 'pro-field',
								),

							),
						),

						// Filter.
						array(
							'title'  => 'Filter',
							'fields' => array(

								// Filter background color.
								array(
									'id'       => 'filter-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter border width.
								array(
									'id'       => 'filter-border-width',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border width', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter border width.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter border style.
								array(
									'id'         => 'filter-border-style',
									'type'       => 'select',
									'title'      => esc_html__( 'Border style', 'just-tables' ),
									'subtitle'   => esc_html__( 'Filter border style.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'solid'   => esc_html__( 'Solid', 'just-tables' ),
										'dashed'  => esc_html__( 'Dashed', 'just-tables' ),
										'dotted'  => esc_html__( 'Dotted', 'just-tables' ),
										'double'  => esc_html__( 'Double', 'just-tables' ),
										'inset'   => esc_html__( 'Inset', 'just-tables' ),
										'outset'  => esc_html__( 'Outset', 'just-tables' ),
										'groove'  => esc_html__( 'Groove', 'just-tables' ),
										'ridge'   => esc_html__( 'Ridge', 'just-tables' ),
										'none'    => esc_html__( 'None', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

								// Filter border color.
								array(
									'id'       => 'filter-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter border radius.
								array(
									'id'       => 'filter-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Filter devider color.
								array(
									'id'       => 'filter-devider-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Devider color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter devider color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter padding.
								array(
									'id'       => 'filter-padding',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Padding', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter padding.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter margin.
								array(
									'id'       => 'filter-margin',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Margin', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter margin.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Select all.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Select all checkbox', 'just-tables' ),
								),

								// Select all text color.
								array(
									'id'       => 'select-all-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Select all text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Select all checkbox color.
								array(
									'id'       => 'select-all-checkbox-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Checkbox color', 'just-tables' ),
									'subtitle' => esc_html__( 'Select all checkbox color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Multiple add to cart button.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Multiple add to cart button', 'just-tables' ),
								),

								// Multiple add to cart button background color.
								array(
									'id'       => 'matc-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Multiple add to cart button text color.
								array(
									'id'       => 'matc-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'color', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Multiple add to cart button border color.
								array(
									'id'       => 'matc-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Multiple add to cart button border radius.
								array(
									'id'       => 'matc-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Multiple add to cart button hover background color.
								array(
									'id'       => 'matc-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Multiple add to cart button hover text color.
								array(
									'id'       => 'matc-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover color', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button hover color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Multiple add to cart button hover border color.
								array(
									'id'       => 'matc-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Multiple add to cart button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Search input field', 'just-tables' ),
								),

								// Search input field background color.
								array(
									'id'       => 'search-input-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field text color.
								array(
									'id'       => 'search-input-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field icon color.
								array(
									'id'       => 'search-input-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Icon color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field border color.
								array(
									'id'       => 'search-input-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field border radius.
								array(
									'id'       => 'search-input-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Search input field focus background color.
								array(
									'id'       => 'search-input-focus-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Focus background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field focus background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field focus text color.
								array(
									'id'       => 'search-input-focus-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Focus text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field focus text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field focus icon color.
								array(
									'id'       => 'search-input-focus-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Focus icon color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field focus icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Search input field focus border color.
								array(
									'id'       => 'search-input-focus-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Focus border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Search input field focus border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter trigger button.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Filter trigger button', 'just-tables' ),
								),

								// Filter trigger button background color.
								array(
									'id'       => 'ftrigger-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter trigger button icon color.
								array(
									'id'       => 'ftrigger-button-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter trigger button border color.
								array(
									'id'       => 'ftrigger-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter trigger button border radius.
								array(
									'id'       => 'ftrigger-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Filter trigger button hover background color.
								array(
									'id'       => 'ftrigger-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter trigger button hover text color.
								array(
									'id'       => 'ftrigger-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Filter trigger button hover border color.
								array(
									'id'       => 'ftrigger-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Filter trigger button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options label.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Options label', 'just-tables' ),
								),

								// Select all text color.
								array(
									'id'       => 'options-label-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options label color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Options select', 'just-tables' ),
								),

								// Options select background color.
								array(
									'id'       => 'options-select-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select text color.
								array(
									'id'       => 'options-select-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select border color.
								array(
									'id'       => 'options-select-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select border radius.
								array(
									'id'       => 'options-select-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Options select dropdown.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Options select dropdown', 'just-tables' ),
								),

								// Options select dropdown background color.
								array(
									'id'       => 'options-select-dropdown-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select dropdown background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select dropdown highlited item background color.
								array(
									'id'       => 'options-select-dropdown-highlighted-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Highlited item background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select dropdown highlited item background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select dropdown text color.
								array(
									'id'       => 'options-select-dropdown-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select dropdown text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select dropdown text color.
								array(
									'id'       => 'options-select-dropdown-checkbox-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Checkbox color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select dropdown checkbox color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select dropdown border color.
								array(
									'id'       => 'options-select-dropdown-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select dropdown border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options select dropdown border radius.
								array(
									'id'       => 'options-select-dropdown-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Options select dropdown border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Options reset.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Options reset', 'just-tables' ),
								),

								// Options reset text color.
								array(
									'id'       => 'options-reset-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options reset color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Options reset hover text color.
								array(
									'id'       => 'options-reset-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover color', 'just-tables' ),
									'subtitle' => esc_html__( 'Options reset hover color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

							),
						),

						// Table.
						array(
							'title'  => 'Table',
							'fields' => array(

								// Table background color.
								array(
									'id'       => 'table-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Table border width.
								array(
									'id'       => 'table-border-width',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border width', 'just-tables' ),
									'subtitle' => esc_html__( 'Table border width.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Table border style.
								array(
									'id'         => 'table-border-style',
									'type'       => 'select',
									'title'      => esc_html__( 'Border style', 'just-tables' ),
									'subtitle'   => esc_html__( 'Table border style.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'solid'   => esc_html__( 'Solid', 'just-tables' ),
										'dashed'  => esc_html__( 'Dashed', 'just-tables' ),
										'dotted'  => esc_html__( 'Dotted', 'just-tables' ),
										'double'  => esc_html__( 'Double', 'just-tables' ),
										'inset'   => esc_html__( 'Inset', 'just-tables' ),
										'outset'  => esc_html__( 'Outset', 'just-tables' ),
										'groove'  => esc_html__( 'Groove', 'just-tables' ),
										'ridge'   => esc_html__( 'Ridge', 'just-tables' ),
										'none'    => esc_html__( 'None', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

								// Table border color.
								array(
									'id'       => 'table-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Table border radius.
								array(
									'id'       => 'table-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Table border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Table padding.
								array(
									'id'       => 'table-padding',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Padding', 'just-tables' ),
									'subtitle' => esc_html__( 'Table padding.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Table margin.
								array(
									'id'       => 'table-margin',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Margin', 'just-tables' ),
									'subtitle' => esc_html__( 'Table margin.', 'just-tables' ),
									'class'    => 'pro-field',
								),

							),
						),

						// Header.
						array(
							'title'  => 'Header',
							'fields' => array(

								// Header background color.
								array(
									'id'       => 'header-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table header background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Header text color.
								array(
									'id'       => 'header-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table header text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Header border width.
								array(
									'id'       => 'header-border-width',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border width', 'just-tables' ),
									'subtitle' => esc_html__( 'Table header border width.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Table header border style.
								array(
									'id'         => 'header-border-style',
									'type'       => 'select',
									'title'      => esc_html__( 'Border style', 'just-tables' ),
									'subtitle'   => esc_html__( 'Table header border style.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'solid'   => esc_html__( 'Solid', 'just-tables' ),
										'dashed'  => esc_html__( 'Dashed', 'just-tables' ),
										'dotted'  => esc_html__( 'Dotted', 'just-tables' ),
										'double'  => esc_html__( 'Double', 'just-tables' ),
										'inset'   => esc_html__( 'Inset', 'just-tables' ),
										'outset'  => esc_html__( 'Outset', 'just-tables' ),
										'groove'  => esc_html__( 'Groove', 'just-tables' ),
										'ridge'   => esc_html__( 'Ridge', 'just-tables' ),
										'none'    => esc_html__( 'None', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

								// Header border color.
								array(
									'id'       => 'header-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table header border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Header first column border radius.
								array(
									'id'       => 'header-fc-border-radius',
									'type'     => 'spacing',
									'right'    => false,
									'bottom'   => false,
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'First column border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Header first column border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Header last column border radius.
								array(
									'id'       => 'header-lc-border-radius',
									'type'     => 'spacing',
									'top'      => false,
									'left'     => false,
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Last column border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Header last column border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Header padding.
								array(
									'id'       => 'header-padding',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Padding', 'just-tables' ),
									'subtitle' => esc_html__( 'Table header padding.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Header text align.
								array(
									'id'         => 'header-text-align',
									'type'       => 'select',
									'title'      => esc_html__( 'Text align', 'just-tables' ),
									'subtitle'   => esc_html__( 'Table header text align.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'left'    => esc_html__( 'Left', 'just-tables' ),
										'center'  => esc_html__( 'Center', 'just-tables' ),
										'right'   => esc_html__( 'Right', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

							),
						),

						// Body.
						array(
							'title'  => 'Body',
							'fields' => array(

								// Body background color.
								array(
									'id'       => 'body-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body text color.
								array(
									'id'       => 'body-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body accent color.
								array(
									'id'       => 'body-accent-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Accent color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body accent color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body accent hover color.
								array(
									'id'       => 'body-accent-hover-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Accent hover color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body accent hover color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body border width.
								array(
									'id'       => 'body-border-width',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border width', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body border width.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Table body border style.
								array(
									'id'         => 'body-border-style',
									'type'       => 'select',
									'title'      => esc_html__( 'Border style', 'just-tables' ),
									'subtitle'   => esc_html__( 'Table body border style.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'solid'   => esc_html__( 'Solid', 'just-tables' ),
										'dashed'  => esc_html__( 'Dashed', 'just-tables' ),
										'dotted'  => esc_html__( 'Dotted', 'just-tables' ),
										'double'  => esc_html__( 'Double', 'just-tables' ),
										'inset'   => esc_html__( 'Inset', 'just-tables' ),
										'outset'  => esc_html__( 'Outset', 'just-tables' ),
										'groove'  => esc_html__( 'Groove', 'just-tables' ),
										'ridge'   => esc_html__( 'Ridge', 'just-tables' ),
										'none'    => esc_html__( 'None', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

								// Body border color.
								array(
									'id'       => 'body-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body responsive columns devider color.
								array(
									'id'       => 'responsive-columns-devider-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Responsive columns devider color', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body responsive columns devider color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body padding.
								array(
									'id'       => 'body-padding',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Padding', 'just-tables' ),
									'subtitle' => esc_html__( 'Table body padding.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Body text align.
								array(
									'id'         => 'body-text-align',
									'type'       => 'select',
									'title'      => esc_html__( 'Text align', 'just-tables' ),
									'subtitle'   => esc_html__( 'Table body text align.', 'just-tables' ),
									'options'    => array(
										'inherit' => esc_html__( 'Inherit', 'just-tables' ),
										'left'    => esc_html__( 'Left', 'just-tables' ),
										'center'  => esc_html__( 'Center', 'just-tables' ),
										'right'   => esc_html__( 'Right', 'just-tables' ),
									),
									'class'      => 'pro-field',
								),

								// Check.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Check', 'just-tables' ),
								),

								// Check checkbox color.
								array(
									'id'       => 'check-checkbox-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Color', 'just-tables' ),
									'subtitle' => esc_html__( 'Check checkbox color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Rating.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Rating', 'just-tables' ),
								),

								// Rating star icon color.
								array(
									'id'       => 'rating-star-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Star icon color', 'just-tables' ),
									'subtitle' => esc_html__( 'Rating star icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Rating text color.
								array(
									'id'       => 'rating-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Rating text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quantity.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Quantity', 'just-tables' ),
								),

								// Quantity input field background color.
								array(
									'id'       => 'quantity-input-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quantity input field background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quantity input field text color.
								array(
									'id'       => 'quantity-input-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quantity input field text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quantity input field icon color.
								array(
									'id'       => 'quantity-input-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Icon color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quantity input field icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quantity input field border color.
								array(
									'id'       => 'quantity-input-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quantity input field border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quantity input field border radius.
								array(
									'id'       => 'quantity-input-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Quantity input field border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Variations.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Variations', 'just-tables' ),
								),

								// Variations icon color.
								array(
									'id'       => 'variation-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variations icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variations icon hover color.
								array(
									'id'       => 'variation-icon-hover-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variations icon hover color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variations popup.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Variations popup', 'just-tables' ),
								),

								// Variation popup background color.
								array(
									'id'       => 'variation-popup-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation popup background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variation popup text color.
								array(
									'id'       => 'variation-popup-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation popup text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variation popup border color.
								array(
									'id'       => 'variation-popup-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation popup border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variation popup border radius.
								array(
									'id'       => 'variation-popup-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation popup border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Variations select.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Variations select', 'just-tables' ),
								),

								// Variation select background color.
								array(
									'id'       => 'variation-select-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation select background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variation select text color.
								array(
									'id'       => 'variation-select-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation select text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variation select border color.
								array(
									'id'       => 'variation-select-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation select border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Variation select border radius.
								array(
									'id'       => 'variation-select-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Variation select border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Wishlist.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Wishlist', 'just-tables' ),
								),

								// Wishlist icon color.
								array(
									'id'       => 'wishlist-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Color', 'just-tables' ),
									'subtitle' => esc_html__( 'Wishlist icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Wishlist icon hover color.
								array(
									'id'       => 'wishlist-icon-hover-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover color', 'just-tables' ),
									'subtitle' => esc_html__( 'Wishlist icon hover color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Add to cart.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Add to cart', 'just-tables' ),
								),

								// Add to cart icon color.
								array(
									'id'       => 'atc-icon-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Color', 'just-tables' ),
									'subtitle' => esc_html__( 'Add to cart icon color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Add to cart icon hover color.
								array(
									'id'       => 'atc-icon-hover-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover color', 'just-tables' ),
									'subtitle' => esc_html__( 'Add to cart icon hover color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Compare button.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Compare', 'just-tables' ),
								),

								// Compare button background color.
								array(
									'id'       => 'compare-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Compare button text color.
								array(
									'id'       => 'compare-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Compare button border color.
								array(
									'id'       => 'compare-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Compare button border radius.
								array(
									'id'       => 'compare-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Compare button hover background color.
								array(
									'id'       => 'compare-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Compare button hover text color.
								array(
									'id'       => 'compare-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Compare button hover border color.
								array(
									'id'       => 'compare-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Compare button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quick view button.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Quick view', 'just-tables' ),
								),

								// Quick view button background color.
								array(
									'id'       => 'quick-view-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quick view button text color.
								array(
									'id'       => 'quick-view-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quick view button border color.
								array(
									'id'       => 'quick-view-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quick view button border radius.
								array(
									'id'       => 'quick-view-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Quick view button hover background color.
								array(
									'id'       => 'quick-view-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quick view button hover text color.
								array(
									'id'       => 'quick-view-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Quick view button hover border color.
								array(
									'id'       => 'quick-view-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Quick view button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// View product button.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'View product', 'just-tables' ),
								),

								// View product button background color.
								array(
									'id'       => 'view-product-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// View product button text color.
								array(
									'id'       => 'view-product-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// View product button border color.
								array(
									'id'       => 'view-product-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// View product button border radius.
								array(
									'id'       => 'view-product-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// View product button hover background color.
								array(
									'id'       => 'view-product-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// View product button hover text color.
								array(
									'id'       => 'view-product-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// View product button hover border color.
								array(
									'id'       => 'view-product-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'View product button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

							),
						),

						// Pagination.
						array(
							'title'  => 'Pagination',
							'fields' => array(

								// Pagination button background color.
								array(
									'id'       => 'pagination-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button text color.
								array(
									'id'       => 'pagination-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button border color.
								array(
									'id'       => 'pagination-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button border radius.
								array(
									'id'       => 'pagination-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Pagination button hover background color.
								array(
									'id'       => 'pagination-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button hover text color.
								array(
									'id'       => 'pagination-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button hover border color.
								array(
									'id'       => 'pagination-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button active background color.
								array(
									'id'       => 'pagination-button-active-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Active background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button active background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button active text color.
								array(
									'id'       => 'pagination-button-active-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Active text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button active text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination button active border color.
								array(
									'id'       => 'pagination-button-active-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Active border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination button active border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination arrow button.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Pagination arrow button', 'just-tables' ),
								),

								// Pagination arrow button text color.
								array(
									'id'       => 'pagination-arrow-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination arrow button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination arrow button hover text color.
								array(
									'id'       => 'pagination-arrow-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination arrow button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Pagination info.
								array(
									'type'    => 'submessage',
									'style'   => 'success',
									'content' => esc_html__( 'Pagination info', 'just-tables' ),
								),

								// Pagination info text color.
								array(
									'id'       => 'pagination-info-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Pagination info text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

							),
						),

						// Export & Print.
						array(
							'title'  => 'Export & Print',
							'fields' => array(

								// Export button background color.
								array(
									'id'       => 'export-button-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Export button text color.
								array(
									'id'       => 'export-button-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Export button border color.
								array(
									'id'       => 'export-button-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Export button border radius.
								array(
									'id'       => 'export-button-border-radius',
									'type'     => 'spacing',
									'units'    => array( 'px', '%', 'em', 'rem' ),
									'title'    => esc_html__( 'Border radius', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button border radius.', 'just-tables' ),
									'class'    => 'jt-product-table-border-radius pro-field',
								),

								// Export button hover background color.
								array(
									'id'       => 'export-button-hover-bg-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover background color', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button hover background color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Export button hover text color.
								array(
									'id'       => 'export-button-hover-text-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover text color', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button hover text color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

								// Export button hover border color.
								array(
									'id'       => 'export-button-hover-border-color',
									'type'     => 'color',
									'title'    => esc_html__( 'Hover border color', 'just-tables' ),
									'subtitle' => esc_html__( 'Export button hover border color.', 'just-tables' ),
									'class'    => 'pro-field',
								),

							),
						),

					),
				),

			),
		) );
	}

	/**
	 * Popup metabox.
	 *
	 * @since 1.0.0
	 */
	public function popup_metabox() {
		// Metabox slug.
		$metabox_slug = '_jt_product_table_popup';

		// Create metabox.
		\CSF::createMetabox( $metabox_slug, array(
			'title'        => esc_html__( 'Table Popup', 'just-tables' ),
			'post_type'    => 'jt-product-table',
			'context'      => 'normal',
			'priority'     => 'high',
			'show_restore' => false,
			'theme'        => 'light',
			'class'        => 'jt-product-table-popup',
		) );

		// Content section.
		\CSF::createSection( $metabox_slug, array(
			'fields' => array(

				array(
					'type'    => 'content',
					'content' => $this->popup_metabox_markup(),
				),

			)
		) );
	}

	/**
	 * Popup metabox markup.
	 *
	 * @since 1.0.0
	 */
	public function popup_metabox_markup() {
		ob_start(); ?>
        <div id="jtpt-pro-notice-dialog" title="<?php esc_html_e( 'Go Premium', 'just-tables' ); ?>" style="display: none;">
            <div class="jtpt-pro-notice-dialog-content">
                <span><i class="dashicons dashicons-warning"></i></span>
                <p><?php echo esc_html__( 'Purchase our', 'just-tables' ) . ' <strong><a href="' . esc_url( 'https://hasthemes.com/plugins/justtables-woocommerce-product-table/#pricing' ) . '" target="_blank" rel="nofollow">' . esc_html__( 'premium version', 'just-tables' ) . '</a></strong> ' . esc_html__( 'to unlock these pro features!', 'just-tables' ); ?></p>
            </div>
        </div>
        <?php return ob_get_clean();
	}

}
<?php
/**
 * JustTables Post Types.
 *
 * Registers post types.
 *
 * @since 1.0.0
 */

namespace JustTables\Admin;

/**
 * Post types class.
 */
class Post_Types {

	/**
	 * Post types constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types' ), 0 );
	}

	/**
	 * Register core post types.
	 *
	 * @since 1.0.0
	 */
	public function register_post_types() {
		$labels = array(
			'name'                  => esc_html_x( 'Product Tables', 'Post Type General Name', 'just-tables' ),
			'singular_name'         => esc_html_x( 'Product Table', 'Post Type Singular Name', 'just-tables' ),
			'menu_name'             => esc_html_x( 'Product Tables', 'Admin Menu text', 'just-tables' ),
			'name_admin_bar'        => esc_html_x( 'Product Table', 'Add New on Toolbar', 'just-tables' ),
			'archives'              => esc_html__( 'Product Table Archives', 'just-tables' ),
			'attributes'            => esc_html__( 'Product Table Attributes', 'just-tables' ),
			'parent_item_colon'     => esc_html__( 'Parent Product Table:', 'just-tables' ),
			'all_items'             => esc_html__( 'All Product Tables', 'just-tables' ),
			'add_new_item'          => esc_html__( 'Add New Product Table', 'just-tables' ),
			'add_new'               => esc_html__( 'Add New', 'just-tables' ),
			'new_item'              => esc_html__( 'New Product Table', 'just-tables' ),
			'edit_item'             => esc_html__( 'Edit Product Table', 'just-tables' ),
			'update_item'           => esc_html__( 'Update Product Table', 'just-tables' ),
			'view_item'             => esc_html__( 'View Product Table', 'just-tables' ),
			'view_items'            => esc_html__( 'View Product Tables', 'just-tables' ),
			'search_items'          => esc_html__( 'Search Product Table', 'just-tables' ),
			'not_found'             => esc_html__( 'Not found', 'just-tables' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'just-tables' ),
			'featured_image'        => esc_html__( 'Featured Image', 'just-tables' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'just-tables' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'just-tables' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'just-tables' ),
			'insert_into_item'      => esc_html__( 'Insert into Product Table', 'just-tables' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Product Table', 'just-tables' ),
			'items_list'            => esc_html__( 'Product Tables list', 'just-tables' ),
			'items_list_navigation' => esc_html__( 'Product Tables list navigation', 'just-tables' ),
			'filter_items_list'     => esc_html__( 'Filter Product Tables list', 'just-tables' ),
		);

		$args = array(
			'label'               => esc_html__( 'Product Table', 'just-tables' ),
			'description'         => esc_html__( 'Create Product Table with JustTables.', 'just-tables' ),
			'labels'              => $labels,
			'menu_icon'           => 'dashicons-editor-table',
			'supports'            => array( 'title' ),
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'show_in_rest'        => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
		);

		register_post_type( 'jt-product-table', $args );
	}

}
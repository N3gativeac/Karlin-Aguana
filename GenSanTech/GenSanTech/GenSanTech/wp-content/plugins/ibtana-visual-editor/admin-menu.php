<?php
class Ibtana_Visual_Editor_Menu_Class {

	public $active_plugins;
	public $ibtana_visual_editor_gtwoosave_values;
	public $ibtana_visual_editor_gtwoosettings;
	public $can_edit;
	public $post_type;
	public $has_read_write_perms;
	public $allow_file_generation;

	public $config_steps = array();
	protected $theme_title = '';

	/* Constructor method for the class. */
	function __construct() {
		// ---------- Ibtana Plugin Activation End -------
		add_action('admin_init', array($this,'ibtana_visual_editor_add_settings'));

		$this->active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );

		$this->ibtana_visual_editor_gtwoosave_values = get_option( 'ibtana_visual_editor_gtwoosave' );
		$this->ibtana_visual_editor_gtwoosettings = (isset($this->ibtana_visual_editor_gtwoosave_values["ibtana_visual_editor_gonoff_woopro"])) ? $this->ibtana_visual_editor_gtwoosave_values["ibtana_visual_editor_gonoff_woopro"] :'Inactive' ;

		/** condition to check gutunberg is off for woo product page **/
		if($this->ibtana_visual_editor_gtwoosettings ==  'Active') {
			if ( in_array( 'woocommerce/woocommerce.php', $this->active_plugins ) ) {
		   	add_filter( 'gutenberg_can_edit_post_type', array($this,'intech_activate_gutenberg_products'), 11, 2 );
		    add_filter( 'use_block_editor_for_post_type', array($this,'intech_activate_gutenberg_products'), 11, 2 );
		  }
		}

		add_action( 'admin_enqueue_scripts', array($this,'ibtana_visual_editor_load_custom_wp_admin_style') );

		// -------- Get Current Theme Name ----------
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );

		// ---------- Setup Free Template --------
		add_action( 'wp_ajax_ibtana_visual_editor_setup_free_demo', array( $this, 'ibtana_visual_editor_setup_free_demo' ) );
		require_once dirname( __FILE__ ) . '/activation/activation.php';

		// --------- Activate And Deactivate Plugin---------

		add_action( 'wp_ajax_ibtana_visual_editor_activate_plugin', array( $this, 'ibtana_visual_editor_activate_plugin' ) );
		add_action( 'wp_ajax_ibtana_visual_editor_deactivate_plugin', array( $this, 'ibtana_visual_editor_deactivate_plugin' ) );
	}

	public function ibtana_visual_editor_get_recommended_actions() {

		$act_count           = 0;
		$actions_todo = get_option( 'recommending_actions', array());

		$plugins = $this->ibtana_visual_editor_get_recommended_plugins();


		if ($plugins) {
			foreach ($plugins as $key => $plugin) {
				$action = array();
				if (!isset($plugin['slug'])) {
					continue;
				}

				$action['id']   = 'install_' . $plugin['slug'];
				$action['desc'] = '';
				if (isset($plugin['desc'])) {
					$action['desc'] = $plugin['desc'];
				}

				$action['name'] = '';
				if (isset($plugin['name'])) {
					$action['title'] = $plugin['name'];
				}

				$action['slug'] = '';
				if (isset($plugin['slug'])) {
					$action['slug'] = $plugin['slug'];
				}

				$action['main_file'] = '';
				if (isset($plugin['function'])) {
					$action['main_file'] = $plugin['function'];
				}


				$link_and_is_done  = $this->ibtana_visual_editor_get_plugin_buttion($plugin['slug'], $plugin['name'], $plugin['function']);
				$action['link']    = $link_and_is_done['button'];
				$action['is_done'] = $link_and_is_done['done'];
				if (!$action['is_done'] && (!isset($actions_todo[$action['id']]) || !$actions_todo[$action['id']])) {
					$act_count++;
				}
				$recommended_actions[] = $action;
				$actions_todo[]        = array('id' => $action['id'], 'watch' => true);
			}
			return array('count' => $act_count, 'actions' => $recommended_actions);
		}
	}

	public function ibtana_visual_editor_get_recommended_plugins() {

		$plugins = apply_filters('ive_recommended_plugins', array());
		return $plugins;
	}

	public function ibtana_visual_editor_get_plugin_buttion($slug, $name, $function) {
			$is_done      = false;
			$button_html  = '';
			$is_installed = $this->ibtana_visual_editor_is_plugin_installed($slug);
			$plugin_path  = $this->ibtana_visual_editor_get_plugin_basename_from_slug($slug);
			$is_activeted = (function_exists($function)) ? true : false;
			if (!$is_installed) {
				$plugin_install_url = add_query_arg(
					array(
						'action' => 'install-plugin',
						'plugin' => $slug,
					),
					self_admin_url('update.php')
				);
				$plugin_install_url = wp_nonce_url($plugin_install_url, 'install-plugin_' . esc_attr($slug));
				$button_html        = sprintf('<a class="ive-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
					esc_attr($slug),
					esc_url($plugin_install_url),
					sprintf(esc_html__('Install %s Now', 'ibtana-visual-editor'), esc_html($name)),
					esc_html($name),
					esc_html__('Install & Activate', 'ibtana-visual-editor')
				);
			} elseif ($is_installed && !$is_activeted) {

				$plugin_activate_link = add_query_arg(
					array(
						'action'        => 'activate',
						'plugin'        => rawurlencode($plugin_path),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce('activate-plugin_' . $plugin_path),
					), self_admin_url('plugins.php')
				);

				$button_html = sprintf('<a class="ive-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
					esc_attr($slug),
					esc_url($plugin_activate_link),
					sprintf(esc_html__('Activate %s Now', 'ibtana-visual-editor'), esc_html($name)),
					esc_html($name),
					esc_html__('Activate', 'ibtana-visual-editor')
				);
			} elseif ($is_activeted) {
				$button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'ibtana-visual-editor'));
				$is_done     = true;
			}

			return array('done' => $is_done, 'button' => $button_html);
		}
	public function ibtana_visual_editor_is_plugin_installed($slug) {
		$installed_plugins = $this->ibtana_visual_editor_get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
		$file_path         = $this->ibtana_visual_editor_get_plugin_basename_from_slug($slug);
		return (!empty($installed_plugins[$file_path]));
	}
	public function ibtana_visual_editor_get_plugin_basename_from_slug($slug) {
		$keys = array_keys($this->ibtana_visual_editor_get_installed_plugins());
		foreach ($keys as $key) {
			if (preg_match('|^' . $slug . '/|', $key)) {
				return $key;
			}
		}
		return $slug;
	}

	public function ibtana_visual_editor_get_installed_plugins() {

		if (!function_exists('get_plugins')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return get_plugins();
	}
	/* ---------- Ibtana Plugin Activation End -------*/

  /**
   * create main menu page of ibtana plugin
   */

  	/* ---------- Ibtana Wizard Steps ------ */
  	public function ibtana_visual_editor_admin_main_tab_step() {
			$dev_steps = $this->config_steps;
			$steps = array(
				'ive-wizard-first-step' => array(
					'id'				=> 'ive-wizard-first-step',
					'title'			=> __( 'Welcome to Ibtana Visual Editor', 'ibtana-visual-editor' ) . $this->theme_title,
					'view'			=> 'ibtana_visual_editor_wizard_init', // Callback for content
					'callback'	=> 'do_next_step', // Callback for JS
					'can_skip'	=> false
				),
				'ive-wizard-second-step' => array(
					'id'				=> 'ive-wizard-second-step',
					'title'			=> __( 'Click on the import button to import template demo', 'ibtana-visual-editor' ),
					'icon'			=> 'dashicons-screenoptions',
					'view'			=> 'ibtana_visual_editor_free_templates',
					'can_skip'	=> true
				),
				'ive-wizard-three-step' => array(
					'id'				=> 'ive-wizard-three-step',
					'icon'			=> 'dashicons-welcome-widgets-menus',
					'view'			=> 'ibtana_visual_editor_import_template',
					'callback'	=> 'install_widgets',
					'can_skip'	=> true
				),
				'ive-wizard-four-step' => array(
					'id'				=> 'ive-wizard-four-step',
					'icon'			=> 'dashicons-welcome-widgets-menus',
					'view'			=> 'ibtana_visual_editor_inner_template_grid',
					'callback'	=> 'ive_inner_template_grid',
					'can_skip'	=> true
				),
				'ive-wizard-five-step' => array(
					'id'				=> 'ive-wizard-five-step',
					'icon'			=> 'dashicons-welcome-widgets-menus',
					'view'			=> 'ibtana_visual_editor_woocommerce_templates',
					'callback'	=> 'ive_woocommerce_templates',
					'can_skip'	=> true
				)
			);

			// Iterate through each step and replace with dev config values
			if( $dev_steps ) {
				// Configurable elements - these are the only ones the dev can update from config.php
				$can_config = array( 'title', 'icon', 'button_text', 'can_skip','button_text_two' );
				foreach( $dev_steps as $dev_step ) {
					// We can only proceed if an ID exists and matches one of our IDs
					if( isset( $dev_step['id'] ) ) {
						$id = $dev_step['id'];
						if( isset( $steps[$id] ) ) {
							foreach( $can_config as $element ) {
								if( isset( $dev_step[$element] ) ) {
									$steps[$id][$element] = $dev_step[$element];
								}
							}
						}
					}
				}
			}
			return $steps;
  	}

  	// -------- First Step ------
  	public function ibtana_visual_editor_wizard_init() { ?>
		<div class="ibtana-wizard-first-step-content ibtana-free-templates">
			<div class="ive-social-theme-search">
					<input class="themesearchinput ive-admin-wizard-search" type="text" placeholder="Search Template Here">
			</div>
			<div class="ive-ibtana-cards-box">
				<div class="ive-wz-spinner-wrap" style="display: none;">
					<div class="ive-lds-dual-ring"></div>
				</div>

				<div class="ive-o-product-main-row">
					<div class="ive-o-product-col-1">
						<ul class="ive-ibtaba-wizard-inner-sub-cats"></ul>
					</div>
					<div class="ive-o-product-col-2">
						<div class="ive-ibtaba-wizard-product-row">
							<div class="ibtana-wizard-no-result">
								<?php esc_html_e('No Result Found','ibtana-visual-editor'); ?>
							</div>
							<h3 class="ive-coming-soon"><?php esc_html_e( 'Coming Soon...', 'ibtana-visual-editor' ); ?></h3>
						</div>
						<div class="ive-template-load-more">
							<a href="javascript:void(0)" class="button button-primary"><?php esc_html_e('Load More...','ibtana-visual-editor'); ?></a>
						</div>
					</div>
				</div>

			</div>

		</div>
	<?php }

	// -------- Second Step ------
  	public function ibtana_visual_editor_free_templates() { ?>
		<div class="ibtana-wizard-templates">
			<div id="ibtana-free-templates" class="ibtana-free-templates">
				<div class="ive-wz-spinner-wrap">
					<div class="ive-lds-dual-ring"></div>
				</div>
				<div class="ive-o-product-main-row">
					<h3 class="ive-coming-soon"><?php esc_html_e( 'Coming Soon...', 'ibtana-visual-editor' ); ?></h3>
					<div class="ive-ibtana-wiazard-product-col-2">
						<div class="ive-social-theme-search">
                <input class="themesearchinput ive-admin-wizard-search" type="text" placeholder="Search Template Here">
            </div>
						<div class="ive-ibtaba-wizard-product-row" style="clear: both;">
							<div class="ibtana-wizard-no-result">
								<?php esc_html_e('No Result Found','ibtana-visual-editor'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }

	public function ibtana_visual_editor_import_template() {

	?>
		<div class="ibtana-template-import-steps">
			<div class="ive-o-product-main-row">
				<span class="dashicons dashicons-admin-collapse"></span>
				<div class="ive-wizard-spinner ive-wz-spinner-wrap">
					<div class="ive-lds-dual-ring"></div>
				</div>
				<div class="ive-template-import-sidebar">
					<div class="ive-preview-close-btn">
						<span class="ive-close-preview dashicons dashicons-no-alt"></span>
						<span class="prev dashicons dashicons-arrow-left-alt2"></span>
						<span class="next dashicons dashicons-arrow-right-alt2"></span>
					</div>
					<div class="ive-sidebar-import-button">
						<a href="javascript:void(0);" data-callback="import_free_template" class="ive-plugin-btn ive-import-demo-btn ive-do-it">
							<?php esc_html_e('Free Import','ibtana-visual-editor'); ?>
						</a>
						<!-- <div class="ive-base-theme-notice">
							<p>Notice that you dont have the base theme installed/activated. Click the below button to install/activate the base theme.</p>
							<button class="" data-slug="">Install/Activate</button>
						</div> -->
					</div>
					<div class="ive-sidebar-content">
						<a href="" class="ive-plugin-btn" target="_blank"><?php esc_html_e('Buy Now','ibtana-visual-editor'); ?></a>
						<h4></h4>
						<div class="ive-template-img">
							<img src="<?php echo esc_url(IBTANA_THEME_URL.'wp-content/uploads/2020/09/bakery-wordpress-theme-icon.webp'); ?>">
						</div>
						<div class="ive-template-text">
							<p>
							</p>
						</div>
					</div>
					<div class="ive-sidebar-view-icons">
						<ul>
							<!-- <li><span class="dashicons dashicons-admin-collapse"></span></li> -->
							<li><span class="dashicons dashicons-desktop"></span></li>
							<li><span class="dashicons dashicons-tablet"></span></li>
							<li><span class="dashicons dashicons-smartphone"></span></li>
						</ul>
					</div>
				</div>
				<div class="ive-template-demo-sidebar">
					<iframe src="" width="100%" height="100%"></iframe>
				</div>
			</div>
		</div>
	<?php }

	function isAssoc( array $arr ) {
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}


	function insert_product_variations ( $post_id, $variations ) {
		foreach ( $variations as $index => $variation ) {

			// get the product object linked to the post
    	$wp_product = wc_get_product( $post_id );

			$variation_post = array( // Setup the post data for the variation
				'post_title'  => 'Variation #'.$index.' of '.count($variations).' for product#'. $post_id,
				'post_name'   => 'product-'.$post_id.'-variation-'.$index,
				'post_status' => 'publish',
				'post_parent' => $post_id,
				'post_type'   => 'product_variation',
				'guid'        => $wp_product->get_permalink()
			);

			$variation_post_id = wp_insert_post( $variation_post ); // Insert the variation

			// Get an instance of the WC_Product_Variation object
			$WC_Product_Variation = new WC_Product_Variation( $variation_post_id );

			// Prices
			update_post_meta( $variation_post_id, '_regular_price', "2" );
			update_post_meta( $variation_post_id, '_sale_price', "1" );
			update_post_meta( $variation_post_id, '_price', "1" );

			foreach ( $variation['attributes'] as $attribute => $value ) {
				// Loop through the variations attributes
				$attribute_term = get_term_by( 'name', $value, 'pa_'.$attribute ); // We need to insert the slug not the name into the variation post meta
				update_post_meta( $variation_post_id, 'attribute_pa_'.$attribute, $attribute_term->slug );
			}

			// Stock
			$WC_Product_Variation->set_stock_quantity( 1 );
			$WC_Product_Variation->set_manage_stock(true);
			$WC_Product_Variation->set_stock_status('');

		}
	}

	public function ibtana_visual_editor_setup_woocommerce_page() {


		if ( isset( $_POST['is_variable_product'] ) ) {
			// Attribute Creation Code
			$attribute_data = array(
				array(
					'name'					=>	'Color',
					'type'					=>	'color',
					'taxonomy'			=>	'pa_color',
					'data'					=>	array(
						'Red'			=>	'#dd3333',
						'Yellow'	=>	'#eeee22'
					)
				),
				array(
					'name'					=>	'Size',
					'type'					=>	'button',
					'taxonomy'			=>	'pa_size',
					'data'					=>	array(
						'L', 'M', 'S'
					)
				)
			);
			$new_attribute_data = array();
			$old_attribute_taxonomies = wc_get_attribute_taxonomies();
			foreach ( $attribute_data as $attribute_data_single ) {
				$is_attribute_found	=	false;
				foreach ( $old_attribute_taxonomies as $old_attribute_taxonomy ) {
					if ( $attribute_data_single['type'] === $old_attribute_taxonomy->attribute_type ) {
						$is_attribute_found = true;
						break;
					}
				}
				if ( !$is_attribute_found ) {
					array_push( $new_attribute_data, $attribute_data_single );
				}
			}
			foreach ( $new_attribute_data as $attribute_single_args ) {
				$args = array(
					// 'slug'					=> 'my_color',
					'name'					=>	__( $attribute_single_args['name'], 'ibtana-visual-editor' ),
					'type'					=>	$attribute_single_args['type'],
					'orderby'				=>	'menu_order',
					'has_archives'	=>	false,
				);
				$wc_create_attribute	=	wc_create_attribute( $args );
				register_taxonomy( $attribute_single_args['taxonomy'], array( 'product' ), array() );

				if ( !is_wp_error( $wc_create_attribute ) ) {

					if ( $this->isAssoc( $attribute_single_args['data'] ) ) {
						foreach ( $attribute_single_args['data'] as $single_data_key => $single_data ) {
							$wp_insert_term	=	 wp_insert_term( $single_data_key, $attribute_single_args['taxonomy'] );
							if ( !is_wp_error( $wp_insert_term ) ) {
								update_term_meta( $wp_insert_term['term_id'], 'product_attribute_' . $attribute_single_args['type'], $single_data );
							}
						}
					} else {
						foreach ( $attribute_single_args['data'] as $single_data_key => $single_data ) {
							wp_insert_term( $single_data, $attribute_single_args['taxonomy'] );
						}
					}
				}
			}
			// Attribute Creation Code ENDs
		}





		// Fetch the template
		$buildercontent = '';

		$post_slug						=	$_POST['slug'];
		$post_temp_type				=	$_POST['temp_type'];
		$post_page_title			=	$_POST['page_title'];
		$post_is_pro_or_free	=	$_POST['is_pro_or_free'];

		$json_theme = array(
			'template_slug' 			=>	$post_slug,
			'page_template_type'	=>	isset($_POST['page_type']) ? $_POST['page_type'] : 'template'
		);

		if ( $post_is_pro_or_free == 1 ) {
			$ibtana_ecommerce_product_addons_license_key	=	get_option( 'ibtana_ecommerce_product_addons_license_key' );
			if ( $ibtana_ecommerce_product_addons_license_key ) {
				if ( isset( $ibtana_ecommerce_product_addons_license_key['license_key'] ) && isset( $ibtana_ecommerce_product_addons_license_key['license_status'] ) ) {
					if ( ( $ibtana_ecommerce_product_addons_license_key['license_key'] != '' ) && ( $ibtana_ecommerce_product_addons_license_key['license_status'] == 1 ) ) {
						$json_theme['domain']	=	get_home_url();
						$json_theme['key']		=	$ibtana_ecommerce_product_addons_license_key['license_key'];
					}
				}
			}
		}

		$json_args = array(
			'method' => 'POST',
			'headers'     => array(
				'Content-Type'  => 'application/json'
			),
			'body' => json_encode($json_theme),
		);

		$request_data		= wp_remote_post( IBTANA_LICENSE_API_ENDPOINT . 'get_template', $json_args );
		$response_json	= json_decode( wp_remote_retrieve_body( $request_data ) );
		$buildercontent	= $response_json->data;


		// Product Category Creation
		$categories = get_terms( array(
			'taxonomy'		=>	'product_cat',
			'hide_empty'	=>	false
		) );
		$category_count = count( $categories );

		$cat_ids = array();

		if ( $category_count > 2 ) {
			// Check if our categories exists

			foreach ( $categories as $key => $category_single_obj ) {
				if ( ( 'Ibtana Ecommerce' == $category_single_obj->name ) || ( 'Ecommerce Product' == $category_single_obj->name ) || ( 'Product Addons' == $category_single_obj->name ) ) {
					array_push( $cat_ids, $category_single_obj->term_id );
				}
			}

		} else {
			$new_cats = array(
				array( 'name' => 'Ibtana Ecommerce', 'description' => 'Ibtana Ecommerce Product Addons Category' ),
				array( 'name' => 'Ecommerce Product', 'description' => 'Ibtana Ecommerce Product Addons Category' ),
				array( 'name' => 'Product Addons', 'description' => 'Ibtana Ecommerce Product Addons Category' )
			);
			foreach ( $new_cats as $new_cat ) {
				$cid = wp_insert_term(
					$new_cat['name'], // the term
					'product_cat', // the taxonomy
					array(
						'description'	=>	$new_cat['description']
					)
				);
			}
			if( !is_wp_error( $cid ) ) {
				if ( isset( $cid['term_id'] ) ) {
					array_push( $cat_ids, $cid['term_id'] );
				}
			}

		}

		if ( !empty( $cat_ids ) ) {
			$cat_ids = array_map( 'intval', $cat_ids );
			$cat_ids = array_unique( $cat_ids );
		}
		// Product Category Creation END

		// Product Creation
		if ( isset( $_POST['is_variable_product'] ) ) {
			$post_id		=	'';
			$ive_post = array(
				'post_type'			=> 'product',
				'post_title'		=> $post_page_title,
				'post_content'	=> $buildercontent,
				'post_author'		=> 1
			);
			$post_id = wp_insert_post( wp_slash( $ive_post ) );
			wp_set_object_terms( $post_id, 'variable', 'product_type' );



			if ( class_exists( 'WC_Meta_Box_Product_Data' ) && class_exists( 'WC_Product_Factory' ) ) {

				// Attribute Creation in new pattern
				$attribute_taxonomies = wc_get_attribute_taxonomies();
				$attributes_data_to_insert	=	array();
				$index = 0;
				foreach ( $attribute_taxonomies as $key => $attribute_taxonomy ) {

					if ( 'color' != $attribute_taxonomy->attribute_name ) {
						continue;
					}

					$taxonomy_name	=	'pa_' . $attribute_taxonomy->attribute_name;
					$terms_by_taxonomy_name = get_terms( array(
						'taxonomy' 		=> 	$taxonomy_name,
						'hide_empty'	=> false
					) );
					if ( empty( $terms_by_taxonomy_name ) ) {
						continue;
					}

					$attributes_data_to_insert['attribute_names'][]				=	$taxonomy_name;
					$attributes_data_to_insert['attribute_position'][]		=	$index;
					foreach ( $terms_by_taxonomy_name as $term_by_taxonomy_name ) {
						$attributes_data_to_insert['attribute_values'][$index][]			=	$term_by_taxonomy_name->term_id;
					}
					$attributes_data_to_insert['attribute_visibility'][]	=	1;
					$attributes_data_to_insert['attribute_variation'][]		=	1;
					++$index;
					break;
				}

				$attributes   = WC_Meta_Box_Product_Data::prepare_attributes( $attributes_data_to_insert );
				$product_id 	= $post_id;
				$product_type	=	'variable';
				$classname    = WC_Product_Factory::get_product_classname( $product_id, $product_type );
				$product      = new $classname( $product_id );
				$product->set_attributes( $attributes );
				$product->save();
				// Attribute Creation in new pattern ends here



				// Product Variation Creation
				$variation_data	=	array();
				foreach ( $attribute_taxonomies as $key => $attribute_taxonomy ) {
					if ( 'color' != $attribute_taxonomy->attribute_type ) {
						continue;
					} else {
						$terms_by_taxonomy_name = get_terms( array(
							'taxonomy' 		=> 	$taxonomy_name,
							'hide_empty'	=> false
						) );
						if ( empty( $terms_by_taxonomy_name ) ) {
							continue;
						}

						foreach ( $terms_by_taxonomy_name as $term_by_taxonomy_name ) {
							$single_variant_data	=	array();
							$single_variant_data['attributes'][$attribute_taxonomy->attribute_name]	=	$term_by_taxonomy_name->name;
							$single_variant_data['sku']						=	'';
							$single_variant_data['regular_price'] = '22.00';
							$single_variant_data['sale_price']    = '11.00';
							$single_variant_data['stock_qty']     = 10;
							array_push( $variation_data, $single_variant_data );
						}
						break;
					}
				}

				// The function to be run
				$this->insert_product_variations( $post_id, $variation_data );


				// Update the prices for all the variations
				// Only for variable products
				if( $product->is_type('variable') ) {
					foreach( $product->get_available_variations() as $variation_values ) {
						$variation_id = $variation_values['variation_id']; // variation id
						// Updating active price and regular price
						update_post_meta( $variation_id, '_regular_price', '2' );
						update_post_meta( $variation_id, '_sale_price', "1" );
						update_post_meta( $variation_id, '_price', '1' );
						wc_delete_product_transients( $variation_id ); // Clear/refresh the variation cache
					}
					// Clear/refresh the variable product cache
					wc_delete_product_transients( $post_id );
				}
				// Update the prices for all the variations ends here
			}




		} else {

			// If it is a simple product
			$post_id		=	'';
			$ive_post = array(
				'post_type'			=> 'product',
				'post_title'		=> $post_page_title,
				'post_content'	=> $buildercontent,
				'post_author'		=> 1
			);
			$post_id = wp_insert_post( wp_slash( $ive_post ) );
			update_post_meta( $post_id, '_regular_price', "2" );
			update_post_meta( $post_id, '_sale_price', "1" );
			update_post_meta( $post_id, '_price', "1" );
		}

		// Assign this product in categories
		if ( !empty( $cat_ids ) ) {
			wp_set_object_terms( $post_id, $cat_ids, 'product_cat' );
		} else {
			wp_set_object_terms( $post_id, 0, 'product_cat' );
		}
		// Assign this product in categories ends here

		if( isset( $post_id ) ) {
			wp_send_json([
				'home_page_id'	=> $post_id,
				'home_page_url'	=> get_edit_post_link( $post_id, '' )
			]);
		}
		exit;
	}

	public function ibtana_visual_editor_setup_free_demo() {

		$post_temp_type	=	$_POST['temp_type'];

		if ( $post_temp_type	==	'woocommerce' ) {

			$this->ibtana_visual_editor_setup_woocommerce_page();

		} else {
			$buildercontent = '';

			$is_pro_or_free = $_POST['is_pro_or_free'];
			$json_theme = array(
				'template_slug' 			=> $_POST['slug'],
				'page_template_type'	=> isset($_POST['page_type']) ? $_POST['page_type'] : 'template'
			);

			if ($is_pro_or_free == 1) {
				$json_theme['domain']	=	get_home_url();
				$json_theme['key']		=	get_option('vw_pro_theme_key');
			}

			$json_args = array(
				'method' => 'POST',
				'headers'     => array(
					'Content-Type'  => 'application/json'
				),
				'body' => json_encode($json_theme),
			);

			$request_data		= wp_remote_post( IBTANA_LICENSE_API_ENDPOINT . 'get_template', $json_args );
			$response_json	= json_decode( wp_remote_retrieve_body( $request_data ) );

			$buildercontent	= $response_json->data;

			$home_id		=	'';
			$page_title	=	'';
			$page_slug	=	'';

			$page_title = isset($_POST['page_title']) ? $_POST['page_title'] : 'Home Page';
			$page_slug = 'home-page';

			$ive_page = array(
				'post_type'			=> 'page',
				'post_title'		=> $page_title,
				'post_content'	=> $buildercontent,
				'post_status'		=> 'publish',
				'post_author'		=> 1
			);
			$home_id = wp_insert_post( wp_slash( $ive_page ) );
			if( isset($home_id) ) {
				wp_send_json([
					'home_page_id'	=> $home_id,
					'home_page_url'	=> get_edit_post_link( $home_id, '' )
				]);
			}
			exit;
		}
	}

	function ibtana_visual_editor_inner_template_grid() { ?>
		<div class="ibtana-wizard-four-step-content ibtana-free-templates">
			<div class="ive-social-theme-search">
				<input class="themesearchinput ive-admin-wizard-search" type="text" placeholder="Search Template Here">
			</div>
			<div class="ive-ibtana-cards-box">
				<div class="ive-wz-spinner-wrap" style="display: none;">
					<div class="ive-lds-dual-ring"></div>
				</div>
				<div class="ive-social-theme-back">
					<button class="button ive-go-back-special">&#8592; back</button>
				</div>
				<div class="ive-o-product-main-row">
					<div class="ive-o-product-col-1">
						<ul class="ive-ibtaba-wizard-inner-sub-cats"></ul>
					</div>
					<div class="ive-o-product-col-2">
						<div class="ive-ibtaba-wizard-product-row">

						</div>
					</div>
				</div>

			</div>
			<div class="ive-template-load-more">
				<a href="javascript:void(0)" class="button button-primary"><?php esc_html_e('Load More...','ibtana-visual-editor'); ?></a>
			</div>
		</div>
	<?php }

 	function ibtana_visual_editor_settings_page($hook) {
		if($hook=="same_admin_page"){
			return;
		}
		wp_enqueue_script( 'ibtana-admin-wizard-script' );
		$this->has_read_write_perms = IVE_Helper::has_read_write_permissions();
		$this->allow_file_generation = IVE_Helper::allow_file_generation();
 	?>
		<div id="ive-get-started-page">
			<div class="ive-get-started-head">
				<div class="ive-get-started-container">
					<div class="ive-get-started-row">
						<div class="ive-get-started-col-6">
							<img src="<?php echo esc_url(plugin_dir_url(__FILE__).'dist/images/admin-wizard/adminIcon.png'); ?>" class="ive-theme-icon">
							<span class="ivera-theme-version">
								<?php
									esc_html_e(IVE_VER,'ibtana-visual-editor');
								?>
							</span>
						</div>
						<div class="ive-get-started-col-6 ive-get-started-head-text">
							<span><?php esc_html_e('Take Gutenberg to The Next Level! -','ibtana-visual-editor'); ?></span>
							<a href="<?php echo esc_url(admin_url().'admin.php?page=ibtana-visual-editor-templates') ?>">View Demos</a>
						</div>
					</div>
				</div>
			</div>
			<div class="ive-get-started-container ive-get-started-main-container">
				<div class="">
					<div class="ive-get-started-sidebar-theme">
						<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('WP Theme Bundle','ibtana-visual-editor'); ?></h4>
						<img src="<?php echo esc_url(plugin_dir_url(__FILE__).'dist/images/welcome-screen.jpg'); ?>">
						<p>
							<?php esc_html_e('WordPress Theme bundle is our best offer wherein we offer all our premium themes in a single package at a very good price. We at VWThemes, strongly believe in serving our customers.','ibtana-visual-editor'); ?>
						</p>
						<a href="https://www.vwthemes.com/premium/theme-bundle/" target="_blank" class="ive-get-started-btn"><?php esc_html_e('Buy Now','ibtana-visual-editor'); ?></a>
					</div>
					<div class="ive-get-started-about">
						<h3><span class="dashicons dashicons-megaphone"></span><?php esc_html_e('Welcome to the Ibtana WordPress Website Builder','ibtana-visual-editor'); ?></h3>
						<p>
							<?php esc_html_e('Thank you for choosing Ibtana WordPress Website Builder - the most advanced kit of gutenberg blocks to build a stunning landing page and internal page attractive than ever before!','ibtana-visual-editor'); ?>
						</p>
						<p>
							<strong><?php esc_html_e('Ready-to-use Full Demo Websites - ','ibtana-visual-editor'); ?></strong><?php esc_html_e('Get 3+ of  professionally designed pre-built FREE starter templates built using Gutenberg, Ibtana WordPress Website Builder and the VW Themes. These can be imported in just a few clicks. Tweak them easily and build awesome websites in minutes!','ibtana-visual-editor'); ?>
						</p>
						<a href="<?php echo esc_url(admin_url().'admin.php?page=ibtana-visual-editor-templates') ?>">
							<?php esc_html_e('Know More »','ibtana-visual-editor'); ?>
						</a>
					</div>
					<div class="ive-get-started-about-blocks">
						<h3><span class="dashicons dashicons-smiley"></span><?php esc_html_e('How to use Ibtana WordPress Website Builder','ibtana-visual-editor'); ?></h3>
						<p>
							<?php esc_html_e('Ibtana WordPress Website Builder comes with 15+ blocks through which you can easily create your templates using HTML and WordPress knowledge. If you want you can also try our themes package with pre-build landing and internal pages. We have different category light weight themes targeted with category wise landing and internal pages, installed through setup wizard.','ibtana-visual-editor'); ?>
						</p>
						<p>
							<?php esc_html_e('Wish to see some real design implementations with these blocks?','ibtana-visual-editor'); ?>
						</p>
						<a href="<?php echo esc_url(admin_url().'admin.php?page=ibtana-visual-editor-templates') ?>">
							<?php esc_html_e('See Demos »','ibtana-visual-editor'); ?>
						</a>
					</div>
					<div class="ive-get-started-sidebar-css-gen">
						<h4><span class="dashicons dashicons-admin-page"></span><?php esc_html_e('CSS File Generation','ibtana-visual-editor'); ?></h4>
						<p>
							<?php esc_html_e('Enabling this option will generate CSS files for Ibtana WordPress Website Builder styling instead of loading the CSS inline on page.','ibtana-visual-editor'); ?>
						</p>
						<?php
						$button_disabled = '';
						if ( 'disabled' === $this->allow_file_generation && true === $this->has_read_write_perms ) {
							$val                    = 'enabled';
							$file_generation_string = __( 'Enable File Generation', 'ibtana-visual-editor' );
						} elseif ( 'disabled' === $this->allow_file_generation && false === $this->has_read_write_perms ) {

							$val                    = 'disabled';
							$file_generation_string = __( 'Inadequate File Permission', 'ibtana-visual-editor' );
							$button_disabled        = 'disabled';

						} else {
							$val                    = 'disabled';
							$file_generation_string = __( 'Disable File Generation', 'ibtana-visual-editor' );
						}
						?>
						<button class="ive-get-started-btn ive-file-generation" id="ive_file_generation" data-value="<?php echo esc_attr( $val ); ?>" <?php echo esc_attr( $button_disabled ); ?> >
							<?php echo esc_html( $file_generation_string ); ?>
						</button>
					</div>
					<div class="ive-get-started-blocks-settings">
						<div class="ive-get-started-row ive-get-started-block-buttons">
							<div class="ive-get-started-col-5">
								<h3><?php esc_html_e('Blocks','ibtana-visual-editor'); ?></h3>
							</div>
							<div class="ive-get-started-col-7">
								<a href="<?php echo esc_url(admin_url().'edit.php?post_type=wp_block') ?>" target="_blank" class="ive-get-started-btn">
									<?php esc_html_e('Reusable Blocks','ibtana-visual-editor'); ?>
									<span class="dashicons-controls-repeat dashicons"></span>
								</a>
							</div>
						</div>
						<div class="ive-get-started-block-activation">
						<?php
							$ive_block_json = file_get_contents(plugin_dir_url(__FILE__).'ive-blocks.json');
							$ive_blocks = json_decode($ive_block_json, true);
							foreach ($ive_blocks['ive_blocks'] as $key => $ive_bock){

							?>
								<div class="ive-get-started-row">
									<div class="ive-get-started-col-7 ive-get-started-block-title">
										<?php esc_html_e($ive_bock['ive_block_title'],'ibtana-visual-editor'); ?>
										<p>
											<?php echo esc_html($ive_bock['ive_block_text'],'ibtana-visual-editor'); ?>
										</p>
									</div>

								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }

	public function ibtana_visual_editor_woocommerce_templates() {
	?>
		<div class="ive-wizard-five-step-content">
			<h3 class="ive-coming-soon"> <?php esc_html_e( 'Coming Soon', 'ibtana-visual-editor' ); ?></h3>
		</div>
	<?php
	}

	public function ibtana_visual_editor_activate_plugin() {
		$plugin = $_POST['ive-addon-slug'];

		$current = get_option( 'active_plugins' );
		$plugin = plugin_basename( trim( $plugin ) );
		if( !in_array($plugin, $current) ) {
			$current[] = $plugin;
			sort($current);
			do_action('activate_plugin', trim($plugin));
			update_option('active_plugins', $current);
			do_action('activate_'.trim($plugin));
			do_action('activated_plugin', trim($plugin));
		}

		$activate_plugin = activate_plugin( $plugin );
		sleep( 5 );
    return;
	}

	public function ibtana_visual_editor_deactivate_plugin(){

		$plugin=$_POST['ive-addon-slug'];
		if( is_plugin_active( $plugin ) ) {
	        deactivate_plugins( $plugin );
	    }
	    return;
	}

	/**
	 * create sub main menu page editor  of ibtana plugin
	 */

	 /**
	 * Template submenu
	 */
		function intech_activate_gutenberg_products($can_edit, $post_type) {
			 if($post_type == 'product'){
					$can_edit = true;
			 }
			 return $can_edit;
		}

		public function ibtana_visual_editor_templates_page() { ?>
				<div class="wrap ive-ibtana-template-page">
					<h1><?php esc_html_e('Ibtana Visual Editor','ibtana-visual-editor'); ?></h1>

					<div class="ive-il-tab">
					  <button class="il-tablinks active"><?php esc_html_e('Premium Themes','ibtana-visual-editor'); ?></button>
					</div>


					<div class="il-tabcontents">

				    <!-- Premium Themes -->
						<div class="ive-il-tabcontent">
						<div class="ive-il-title-search">
				      		<h3><?php esc_html_e('Themes','ibtana-visual-editor'); ?></h3>
				      		<div class="ive_alignright">
					          <span id="ive-reload--modal--contents--admin" class="dashicons dashicons-update-alt"></span>
					          <input type="text" class="search-text" placeholder="Search for names.." >
					        </div>
					        <hr />
					    </div>
				      <div id="premium-templates">

				        <div class="ive-o-product-main-row">
				          <div class="ive-o-product-col-1">
				            <ul class="sub-category-wrapper">

				            </ul>
				          </div>
				          <div class="ive-o-product-col-2">
				            <div class="ive-o-product-row">

				            </div>
				          </div>
				        </div>
				      </div>

						</div>
				    <!-- Premium Themes END -->
					</div>

				  <div class="ive-ibtana--modal--loader--admin">
				    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
				    <circle cx="50" cy="50" fill="none" stroke="#44a745" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
				      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"/>
				    </circle>
				    </svg>
				  </div>
				</div>
				<script type="text/javascript">
					window.addEventListener('load', function() {

				    // On click tab
				    jQuery('.il-tablinks').on('click', function() {
						  jQuery('.il-tablinks').removeClass('active');
						  jQuery(this).addClass('active');
						  jQuery('.ive-il-tabcontent').hide();
						  jQuery('.ive-il-tabcontent').eq(jQuery(this).index()).show();
						});
				    // On click tab END


				    // On click subcategory
				    jQuery('#premium-templates').on('click', '.sub-cat-button', function() {
				      jQuery('.sub-category-wrapper .sub-cat-button').removeClass('active');
				      jQuery(this).addClass("active");
				        var data_ids = jQuery(this).attr('data-ids');
				        var id_arr = data_ids.split(',');
				        jQuery('#premium-templates .ive-o-product-row .ive-o-products-col[data-id]').hide();
				        for (var i = 0; i < id_arr.length; i++) {
				          var single_id = id_arr[i];
				          jQuery('#premium-templates .ive-o-product-row .ive-o-products-col[data-id="'+single_id+'"]').show();
				        }
				    });
				    // On click subcategory END
				    // Search text
				    jQuery('.search-text').on('input', function() {
				      var search_keyword = jQuery(this).val().toLowerCase();
				      var active_sub_cat = jQuery('#premium-templates .sub-cat-button.active');
				      var visible_wrapper = jQuery('#premium-templates .ive-o-product-row');
				      if (active_sub_cat.length != 0) {
				        var sub_cat_pro_ids = active_sub_cat.attr('data-ids');
				        var sub_cat_arr_ids = sub_cat_pro_ids.split(',');
				        jQuery('#premium-templates [data-id]').hide();
				        for (var i = 0; i < sub_cat_arr_ids.length; i++) {
				          var sub_cat_pro_id = sub_cat_arr_ids[i];
				          var pro_card = jQuery('#premium-templates [data-id='+sub_cat_pro_id+']');
				          var pro_card_text = pro_card.find('h3').text().toLowerCase();
				          if (pro_card_text.indexOf(search_keyword) !== -1) {
				            pro_card.show();
				          }
				        }
				      } else {
				        visible_wrapper.find('.ive-o-products-col').hide();
				        var pro_cards = visible_wrapper.find('.ive-o-products-col');
				        jQuery.each(pro_cards, function(key, pro_card) {
				          pro_card_text = jQuery(pro_card).find('h3').text().toLowerCase();
				          if (pro_card_text.indexOf(search_keyword) !== -1) {
				            jQuery(pro_card).show();
				          }
				        });
				      }
				    });
				    // Search text END

				    ibtana_visual_editor_get_premium_themes();
				    jQuery('#ive-reload--modal--contents--admin').on('click', function() {
						jQuery( ".search-text" ).val('');
				      	ibtana_visual_editor_get_premium_themes();
				    });
				    function ibtana_visual_editor_get_premium_themes() {
				      var ibtana_license_api_endpoint = '<?php echo IBTANA_LICENSE_API_ENDPOINT; ?>';
				      jQuery('.ive-ibtana--modal--loader--admin').show()
				      jQuery.ajax({
				        method: "POST",
				        url: ibtana_license_api_endpoint + "get_modal_contents",
				        data: JSON.stringify({
									"admin_user_ibtana_license_key": 	'<?php echo get_option('vw_pro_theme_key') ?>',
									"domain": 												'<?php echo site_url(); ?>'
								}),
				        dataType: 'json',
				        contentType: 'application/json',
				      }).done(function( data ) {
								console.log('data.data', data.data);
				        jQuery('.ive-ibtana--modal--loader--admin').hide()
				        var premium_data = data.data.products;
				        var premium_card_content = ``;
				        for (var i = 0; i < premium_data.length; i++) {
				          var premium_product = premium_data[i];
				          premium_card_content += `<div class="ive-o-products-col" data-id="`+premium_product.id+`">
				            <div class="ive-o-products-image">
				              <img src="`+premium_product.image+`">
				            </div>
				            <h3>`+premium_product.title+`</h3>
				            <a href="`+premium_product.permalink+`" target="_blank">Buy Now</a>
				            <a href="`+premium_product.demo_url+`" target="_blank">View Demo</a>
				          </div>`;
				        }
				        jQuery('#premium-templates .ive-o-product-row').empty();
				        jQuery('#premium-templates .ive-o-product-row').append(premium_card_content);


				        var sub_category_array = data.data.sub;
				        var sub_cat_html = ``;
				        for (var i = 0; i < sub_category_array.length; i++) {
				          var sub_category = sub_category_array[i];
				          sub_cat_html += `<li data-ids="`+sub_category.product_ids+`" class="sub-cat-button">
				                `+sub_category.name+`<span class="badge badge-info">`+sub_category.product_ids.length+`</span>
				              </li>`;
				        }
				        jQuery('.ive-o-product-col-1 ul').empty();
				        jQuery('.ive-o-product-col-1 ul').append(sub_cat_html);


				        // jQuery('#premium-templates .sub-cat-button:first').trigger('click');
				      });
				    }

					}, false);
				</script>
		<?php
		}

		/**
		 * Editor setting submenu
		 */
		public function ibtana_visual_editor_save_page() {
		  ?>
		    <form action="options.php" method="post">
		      <?php
		        settings_errors();
		        settings_fields('ibtana_visual_editor_gtwoosave');
		        do_settings_sections('ibtana_visual_editor_gtwoosave');
		        submit_button();
		      ?>
		    </form>
		   <?php
		}

		function ibtana_visual_editor_add_field_callback() {
		  $ibtana_visual_editor_gtwoosave_values = get_option( 'ibtana_visual_editor_gtwoosave' );
		  $ibtana_visual_editor_gtwoosettings = ($ibtana_visual_editor_gtwoosave_values["ibtana_visual_editor_gonoff_woopro"]) ? $ibtana_visual_editor_gtwoosave_values["ibtana_visual_editor_gonoff_woopro"] :'Inacti' ;
		  ?>
		    <input type="radio" id="ibtana_visual_editor_gonoff_woopro" name="ibtana_visual_editor_gtwoosave[ibtana_visual_editor_gonoff_woopro]" value="Active" <?php checked('Active', $ibtana_visual_editor_gtwoosettings, true); ?>>Active
		    <input type="radio" id="ibtana_visual_editor_gonoff_woopro" name="ibtana_visual_editor_gtwoosave[ibtana_visual_editor_gonoff_woopro]" value="Inactive" <?php checked('Inactive', $ibtana_visual_editor_gtwoosettings, true); ?>>Inactive
		  <?php
		}

		function ibtana_visual_editor_output_section_desc() {
		  echo esc_html('It will allow Gutenberg Editor in the WooCommerce product pages.','ibtana-visual-editor');
		}

		function ibtana_visual_editor_add_settings() {
  		add_settings_section(
    		'section_1',
    		'Ibtana WooCommerce Editor',
    		array($this,'ibtana_visual_editor_output_section_desc'),
    		'ibtana_visual_editor_gtwoosave'
			);

	  	add_settings_field(
	    	'ibtana_visual_editor_gonoff_woopro',
	    	'Gutenberg Editor',
	    	array($this,'ibtana_visual_editor_add_field_callback'),
	    	'ibtana_visual_editor_gtwoosave',
	    	'section_1'
	  	);
	  	register_setting('ibtana_visual_editor_gtwoosave', 'ibtana_visual_editor_gtwoosave');
		}
	/**
	 * End : create sub main menu page editor  of ibtana plugin
	 */


	 /**
    * Register admin css for menu
    */
	function ibtana_visual_editor_load_custom_wp_admin_style() {

		// ------------ Plugin Activation ---------

		$ibtana_key= '';
		$ibtana_get_key=get_option('vw_pro_theme_key');
		if($ibtana_get_key==NULL) {
			$ibtana_key="";
		} else {
			$ibtana_key=get_option('vw_pro_theme_key');
		}

		wp_enqueue_script('updates');
		//wp_register_script( 'ibtana-plugin-activation-script', plugin_dir_url(__FILE__).'dist/plugin-install.js', array( 'jquery' ), time() );
		/*wp_localize_script('ibtana-plugin-activation-script', 'ibtana_plugin_activation_script',
		array(
		'installing' 									=> esc_html__('Installing', 'ibtana-visual-editor'),
		'activating' 									=> esc_html__('Activating', 'ibtana-visual-editor'),
		'error' 		 									=> esc_html__('Error', 'ibtana-visual-editor'),
		'ajax_url' 	 									=> esc_url(admin_url('admin-ajax.php')),
		'site_url' 										=> site_url(),
		'IBTANA_LICENSE_API_ENDPOINT' => IBTANA_LICENSE_API_ENDPOINT,
		'ibtana_license_key'					=> get_option('vw_pro_theme_key'),
		)
		);
		wp_enqueue_script( 'ibtana-plugin-activation-script' );*/
		// --------- wizard Script --------

		wp_register_script( 'ibtana-admin-wizard-script', plugin_dir_url( __FILE__ ) . 'dist/ibtana-wizard-script.js', array( 'jquery' ) );
		$ive_add_on_license_info = apply_filters( 'ive_add_on_license_info', [] );

		wp_localize_script(
			'ibtana-admin-wizard-script',
			'ive_whizzie_params',
			array(
				'ajaxurl' 										=>	admin_url( 'admin-ajax.php' ),
				'adminUrl'										=>	admin_url(),
				'wpnonce' 										=>	wp_create_nonce( 'ive_whizzie_nonce' ),
				'verify_text'									=>	esc_html( 'verifying', 'ibtana-visual-editor' ),
				'IBTANA_LICENSE_API_ENDPOINT' =>	IBTANA_LICENSE_API_ENDPOINT,
				'ive_license_key' 						=>	get_option( 'vw_pro_theme_key' ),
				'ive_add_on_keys'							=>	$ive_add_on_license_info,
				'ive_domain_name' 						=>	get_home_url(),
				'theme_text_domain' 					=>	wp_get_theme()->get( 'TextDomain' ),
				'custom_text_domain' 					=>	defined( 'CUSTOM_TEXT_DOMAIN' ) ? CUSTOM_TEXT_DOMAIN : '',
				'is_woocommerce_available'		=>	class_exists( 'woocommerce' ) ? true : false
			)
		);
		// ------------ Plugin Activation End ---------

		// Admin Menu style
		wp_register_style( 'ive-admin-menu', plugin_dir_url(__FILE__).'dist/css/ibtana-menu-css/ive-admin-menu.css', false, time() );
		wp_enqueue_style( 'ive-admin-menu' );
	}
}
new Ibtana_Visual_Editor_Menu_Class;



class Ibtana_Visual_Editor_Menu_Creator extends Ibtana_Visual_Editor_Menu_Class {

	public $defaults = array(
		'page_type' => 'menu_page',
		'page_title' => '',
		'menu_title' => '',
		'capability' => '',
		'menu_slug' => '',
		'icon_url' => '',
		'position' => '',
		'parent_slug' => '',
		'priority' => 10,
		'network_page' => false,
		'page_functions' => false
	);
	public $args;
	public $ivehook;


	/* Constructor method for the class. */
	function __construct( $args ) {

		/* Global that will hold all the arguments for all the menu pages */
		global $ibtana_visual_editor_pages;


		/* Merge the input arguments and the defaults. */
		$this->args = wp_parse_args( $args, $this->defaults );

		/* Add the settings for this page to the global object */
		$ibtana_visual_editor_pages[$this->args['page_title']] = $this->args;

		if( !$this->args['network_page'] ) {
			/* Hook the page function to 'admin_menu'. */
			if($this->args['page_functions']) {
				add_action( 'admin_menu', array( &$this, 'ibtana_visual_editor_page_init' ), $this->args['priority'] );
			}
		} else {
			/* Hook the page function to 'admin_menu'. */
			add_action( 'network_admin_menu', array( &$this, 'ibtana_visual_editor_page_init' ), $this->args['priority'] );
		}
	}



	/**
	 * Function that creates the admin page
	 */
	function ibtana_visual_editor_page_init(){
		global $ibtana_visual_editor_pages_ivehooks;

        /* don't add the page at all if the user doesn't meet the capabilities */
        if( !empty( $this->args['capability'] ) ){
            if( !current_user_can( $this->args['capability'] ) )
                return;
        }

		/* Create the page using either add_menu_page or add_submenu_page functions depending on the 'page_type' parameter. */
		if( $this->args['page_type'] == 'menu_page' ){
			$this->ivehook = add_menu_page( $this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], array($this,$this->args['page_functions']), $this->args['icon_url'], $this->args['position'] );

			$ibtana_visual_editor_pages_ivehooks[$this->args['menu_slug']] = $this->ivehook;
		}
		else if( $this->args['page_type'] == 'submenu_page' ){
			$this->ivehook = add_submenu_page( $this->args['parent_slug'], $this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], array($this,$this->args['page_functions']) );

			$ibtana_visual_editor_pages_ivehooks[$this->args['menu_slug']] = $this->ivehook;
		}else if($this->args['page_type'] == 'same_admin_page'){
			$this->ivehook = add_submenu_page( $this->args['parent_slug'], $this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], $this->ibtana_visual_editor_settings_page("same_admin_page"));

			$ibtana_visual_editor_pages_ivehooks[$this->args['menu_slug']] = $this->ivehook;
		}

		do_action( 'ibtana_visual_editor_page_creator_after_init', $this->ivehook );

		/* Create a hook for adding meta boxes. */
		add_action( "load-{$this->ivehook}", array( &$this, 'ibtana_visual_editor_settings_page_add_meta_boxes' ) );
		/* Load the JavaScript needed for the screen. */
		add_action( 'admin_enqueue_scripts', array( &$this, 'ibtana_visual_editor_page_enqueue_scripts' ) );
		add_action( "admin_head-{$this->ivehook}", array( &$this, 'ibtana_visual_editor_page_load_scripts' ) );
	}

	/**
	 * Do action 'add_meta_boxes'. This hook isn't executed by default on a admin page so we have to add it.
	 */
	function ibtana_visual_editor_settings_page_add_meta_boxes() {
	    do_action( 'ibtana_visual_editor_page_creator_before_meta_boxes', $this->ivehook );
			do_action( 'add_meta_boxes', $this->ivehook, 0 );
	    do_action( 'ibtana_visual_editor_page_creator_after_meta_boxes', $this->ivehook );
	}

	/**
	 * Loads the JavaScript files required for managing the meta boxes on the theme settings
	 * page, which allows users to arrange the boxes to their liking.
	 *
	 * @global string $bareskin_settings_page. The global setting page (returned by add_theme_page in function
	 * bareskin_settings_page_init ).
	 * @since 1.0.0
	 * @param string $hook The current page being viewed.
	 */
	function ibtana_visual_editor_page_enqueue_scripts( $hook ) {
		if ( $hook == $this->ivehook ) {
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
		}

		if($hook == 'post.php' || $hook == 'post-new.php') {
			wp_enqueue_style(
				'ibtana-bootstrap-backend',
				'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'
			);
		}
	}

	/**
	 * Loads the JavaScript required for toggling the meta boxes on the theme settings page.
	 *
	 * @global string $bareskin_settings_page. The global setting page (returned by add_theme_page in function
	 * bareskin_settings_page_init ).
	 * @since 1.0.0
	 */
	function ibtana_visual_editor_page_load_scripts() {
		?>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				postboxes.add_postbox_toggles( '<?php echo $this->ivehook; ?>' );
			});
			//]]>
		</script><?php
	}

	public function ibtana_visual_editor_go_pro() {
		$actions = $this->ibtana_visual_editor_recommended_plugins_array();

		$actions_data = '';
		$is_key_valid = 0;
		if($actions != NULL && $actions['plugins']) {
			$actions_data = $actions['plugins'];
			$is_key_valid = isset($actions['is_key_valid']) ? $actions['is_key_valid'] : 0;
		}
	?>
		<!-- Go Pro Content -->
		<div class="ive-theme-page-header">
			<div class="ive-container ive-flex">
				<div class="ive-theme-title">
					<img src="<?php echo esc_url(plugin_dir_url(__FILE__).'dist/images/admin-wizard/adminIcon.png'); ?>" class="ive-theme-icon">
					<span class="ivera-theme-version">
						<?php
							esc_html_e(IVE_VER, 'ibtana-visual-editor');
						?>
					</span>
				</div>
				<div class="ive-top-links">
					<ul>
						<li><span><img src="<?php echo esc_url(plugin_dir_url(__FILE__).'dist/images/admin-wizard/lightning.svg'); ?>" class="ivera-lightning-icon"><?php esc_html_e('Lightning Fast &amp; Fully Customizable WordPress theme!','ibtana-visual-editor'); ?></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="ive-tab-content-box ive-admin-main-tab-content2">
			<div class="wrap ive-verify-key-wrap">
				<h3><?php esc_html_e('Verify Your License Key','ibtana-visual-editor'); ?></h3>
				<form id="ibtana_license_key_form">
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><?php esc_html_e('Enter License Key','ibtana-visual-editor'); ?></th>
							<td>
								<input type="text" name="ibtana_license_key" value="<?php echo esc_attr( get_option('vw_pro_theme_key') ); ?>" placeholder="License Key" />
							</td>
							<td>
								<button type="submit" name="button"><?php esc_html_e('Save Changes','ibtana-visual-editor'); ?></button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<?php if($actions_data != NULL) {
			?>
				<div class="ive-free-plugin-wrap">
					<div class="ive-container">
						<h3><?php esc_html_e('Extend Ibtana Visual Editor with following addons','ibtana-visual-editor'); ?></h3>
						<ul>
							<?php
							foreach ($actions_data as $key => $premium_add_on) {
							$premium_add_on_title 		= $premium_add_on['name'];
							$premium_add_on_slug 			= $premium_add_on['slug'];
							$premium_add_on_desc 			= $premium_add_on['desc'];
							$premium_add_on_file		 	= $premium_add_on['slug'] . '/' .$premium_add_on['main_file'];
							$is_current_add_on_active	= is_plugin_active($premium_add_on_file);
							?>
								<li>
									<span class="ive-plugin-title">
										<?php echo esc_html($premium_add_on_title); ?>
									</span>
									<p>
										<?php esc_html_e($premium_add_on_desc,'ibtana-visual-editor'); ?>
									</p>
									<?php
									if ($is_key_valid == 0) {
										?>
										<a href="#" class="ive-plugin-btn ive-plugin-go-pro-btn">
										<?php esc_html_e('Go Pro','ibtana-visual-editor'); ?>
										</a>
										<?php
									} elseif ($is_current_add_on_active && ($is_key_valid == 1)) {
										?>
										<button href="JavaScript:void(0);" class="ive-plugin-btn ive-plugin-go-pro-btn" data-slug="<?php echo esc_html($premium_add_on_slug); ?>" <?php if($is_current_add_on_active){echo "disabled";} ?>>
										<?php esc_html_e('Activated','ibtana-visual-editor'); ?>
										</button>
										<?php
									} else {
										?>
										<button href="JavaScript:void(0);" class="ive-plugin-btn ive-plugin-go-pro-btn" data-slug="<?php echo esc_html($premium_add_on_slug); ?>" <?php if($is_current_add_on_active){echo "disabled";} ?>>
										<?php esc_html_e('Activate','ibtana-visual-editor'); ?>
										</button>
										<?php
									}
									?>


								</li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php }

	public function ibtana_visual_editor_is_pro_theme_activated() {
		if ( defined( 'CUSTOM_TEXT_DOMAIN' ) ) {
			$ive_current_theme		=	wp_get_theme();
			$ive_theme_title			=	$ive_current_theme->get( 'Name' );
			$ive_theme_name				=	strtolower( preg_replace( '#[^a-zA-Z]#', '', $ive_theme_title ) );
			$page_slug						=	$ive_theme_name . '-wizard';
			$ive_theme_wizard_url	=	esc_url( admin_url( 'admin.php?page=' . $page_slug ) );
			return array(
				'ive_theme_title'				=>	$ive_theme_title,
				'ive_theme_wizard_url'	=>	$ive_theme_wizard_url
			);
		}
		return NULL;
	}

	public function ibtana_visual_editor_ive_templates_page() {
		wp_enqueue_script( 'ibtana-admin-wizard-script' );
		// check if the vw premium theme is activated.
		$ive_is_pro_theme_activated	=	$this->ibtana_visual_editor_is_pro_theme_activated();

		$ive_plugin_data= '';
 		$ive_plugin_version= '';
		?>
		<div class="ive-plugin-admin-page">

			<div class="ive-theme-page-header">
				<div class="ive-container ive-flex">
					<div class="ive-theme-title">
						<img src="<?php echo esc_url(plugin_dir_url(__FILE__).'dist/images/admin-wizard/adminIcon.png'); ?>" class="ive-theme-icon">
						<span class="ivera-theme-version">
							<?php
								esc_html_e(IVE_VER,'ibtana-visual-editor');
							?>
						</span>
					</div>
					<div class="ive-top-links">
						<ul>
							<li>
								<span>
									<img src="<?php echo esc_url(plugin_dir_url(__FILE__).'dist/images/admin-wizard/lightning.svg'); ?>" class="ivera-lightning-icon"> <?php esc_html_e('Lightning Fast &amp; Fully Customizable WordPress theme!','ibtana-visual-editor'); ?>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<?php if ( $ive_is_pro_theme_activated ): ?>
			<div class="notice ive-wizard-notice is-dismissible">
				<div class="ive-theme_box">
					<h4>
					<?php esc_html_e( 'Look\'s like you\'ve installed our ' . $ive_is_pro_theme_activated['ive_theme_title'] . ' theme. Click Get Started to run the setup wizard.', 'ibtana-visual-editor' ); ?>
					</h4>
				</div>
				<div class="ive-notice_button">
					<a class="button button-primary button-hero" target="_blank" href="<?php echo esc_url($ive_is_pro_theme_activated['ive_theme_wizard_url']); ?>">
						<?php esc_html_e( 'Get Started', 'ibtana-visual-editor' ); ?>
					</a>
				</div>
			</div>
			<?php endif; ?>

			<!-- Main Tabs START -->
	 		<div class="ive-ibtana-wizard-button-wrapper">
				<div class="button-wrap">
					<a href="#" class="ibtana-free-template-button button button-primary active" data-callback="do_next_step" data-step="ive-wizard-first-step" data-template-type="wordpress">
						<span class="dashicons dashicons-format-image"></span>
						<?php esc_html_e('Templates','ibtana-visual-editor'); ?>
					</a>
				</div>
			</div>
			<!-- Main Tabs END -->


	 		<div id="ive-admin-main-tab-content-wrap">
	 			<!-- Wizard Content -->
	 			<div class="ive-tab-content-box active ive-admin-main-tab-content1">
	 				<div class="wrap">
						<?php echo '<div class="ive-whizzie-wrap">';
							// The wizard is a list with only one item visible at a time
							$steps = $this->ibtana_visual_editor_admin_main_tab_step();
							echo '<ul class="ive-wizard-content-menu">';
							foreach( $steps as $step ) {
								$class = 'step step-' . esc_attr( $step['id'] );
								echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '" >';
									if( isset( $content['title'] ) ) {
										printf( '<h3 class="ive-wizard-main-title">%s</h3>',
											esc_html( $step['title'] )
											);
									}
									// $content is split into summary and detail
									$content = call_user_func( array( $this, $step['view'] ) );
									if( isset( $content['summary'] ) ) {
										printf(
											'<div class="summary">%s</div>',
											wp_kses_post( $content['summary'] )
										);
									}
									if( isset( $content['detail'] ) ) {
										// Add a link to see more detail
										printf( '<div class="wz-require-plugins">');
										printf(
											'<div class="detail">%s</div>',
											$content['detail'] // Need to escape this
										);
										printf('</div>');
									}
								echo '</li>';
							}
							echo '</ul>';
							?>
						<?php echo '</div>'; ?>

					</div>
	 			</div>
	 		</div>


			<div class="ive-plugin-popup">
				<div class="ive-admin-modal">
					<button class="ive-close-button">×</button>
					<div class="ive-demo-step-container">
						<div class="ive-current-step">

							<div class="ive-demo-child ive-demo-step ive-demo-step-0 active">
								<h2>Install Base Theme</h2>
								<p>We strongly recommend to install the base theme.</p>
								<div class="ive-checkbox-container">
									Install Base Theme
									<span class="ive-checkbox active">
										<svg width="10" height="8" viewBox="0 0 11.2 9.1">
											<polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
										</svg>
									</span>
								</div>
							</div>

							<div class="ive-demo-plugins ive-demo-step ive-demo-step-1">
								<h2>Install & Activate Plugins</h2>
								<p>The following plugins are required for this template in order to work properly. Ignore if already installed.</p>
								<div class="ive-checkbox-container activated">
									Elementor
									<span class="ive-checkbox active">
										<svg width="10" height="8" viewBox="0 0 11.2 9.1">
											<polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
										</svg>
									</span>
								</div>
								<div class="ive-checkbox-container">
									Gutenberg
									<span class="ive-checkbox active">
										<svg width="10" height="8" viewBox="0 0 11.2 9.1">
											<polyline class="check" points="1.2,4.8 4.4,7.9 9.9,1.2 "></polyline>
										</svg>
									</span>
								</div>
							</div>

							<div class="ive-demo-template ive-demo-step ive-demo-step-2">
								<h2>Import Content</h2>
								<p>This will import the template.</p>
							</div>

							<div class="ive-demo-install ive-demo-step ive-demo-step-3">
								<h2>Installing...</h2>
								<p>Please be patient and don't refresh this page, the import process may take a while, this also depends on your server.</p>
								<div class="ive-progress-info">Required plugins<span>10%</span></div>
								<div class="ive-installer-progress"><div></div></div>
							</div>

						</div>
						<div class="ive-demo-step-controls">
							<button class="ive-demo-btn ive-demo-back-btn">Back</button>
							<ul class="ive-steps-pills">
								<li class="active">1</li>
								<li class="">2</li>
								<li class="">3</li>
							</ul>
							<button class="ive-demo-btn ive-demo-main-btn">Next</button>
						</div>
					</div>
				</div>
			</div>


		</div>
		<?php
	}

	public function ibtana_visual_editor_ive_license_page() {
		wp_enqueue_script( 'ibtana-admin-wizard-script' );
		$is_addons	= apply_filters( 'ive_is_add_on_installed', false );
		$license_messege	=	'';

		// If no addons installed.
		if ( !$is_addons ) {
			$base_url	= IBTANA_LICENSE_API_ENDPOINT . 'ibtana_license_get_language_strings';
			$args 		= array(
				"msg_key"	=>	'no_add_ons_installed_message'
			);
			$body			= wp_json_encode( $args );
			$options	= [
				'timeout'     => 0,
				'body'        => $body,
				'headers'     => [
					'Content-Type' => 'application/json',
				],
			];
			$response = wp_remote_post( $base_url, $options );

			if ( is_wp_error( $response ) ) {
				$license_messege = '<h4>'.sprintf(__('No add-ons installed. See available add-ons - %1$s.','ibtana-visual-editor'),'<a href="https://vwthemes.net/add-ons/" target="_blank">https://vwthemes.net/add-ons/</a>').'</h4>';
			}

			if ( ( $response['response']['code'] === 200 ) && ( $response['response']['message'] === 'OK' ) ) {
				$response					= json_decode( $response['body'] );
				$response_status	=	$response->status;
				if ( $response_status == true ) {
					$response_msg			=	$response->msg;
					$license_messege	=	$response_msg;
				} else {
					$license_messege = '<h4>'.sprintf(__('No add-ons installed. See available add-ons - %1$s.','ibtana-visual-editor'),'<a href="https://vwthemes.net/add-ons/" target="_blank">https://vwthemes.net/add-ons/</a>').'</h4>';
				}
			}
		} else {
			$license_messege = __(
				'Enter your add-ons license keys here to receive updates for purchased add-ons. If your license key has expired, please renew your license.',
				'ibtana-visual-editor'
			);
		}
	?>
		<div class="">
			<h3><?php esc_html_e( 'License', 'ibtana-visual-editor' );?></h3>
			<div class="row" style="margin-bottom:20px;"><?php echo html_entity_decode($license_messege)?></div>
			<div class="row">
				<?php do_action( 'ive_addon_license_area' ); ?>
			</div>
		</div>
	<?php
	}

	public function ibtana_visual_editor_recommended_plugins_array() {
		$plugins = [];
		$base_url = IBTANA_LICENSE_API_ENDPOINT . 'get_client_add_on_list';
		$admin_user_ibtana_license_key = get_option('vw_pro_theme_key');
		$args = array(
			"admin_user_ibtana_license_key" => $admin_user_ibtana_license_key,
			"site_url"											=> site_url()
		);
		$body = wp_json_encode( $args );
		$options = [
			'timeout'     => 0,
				'body'        => $body,
				'headers'     => [
						'Content-Type' => 'application/json',
				],
		];
		$response = wp_remote_post( $base_url, $options );

		if ( is_wp_error( $response ) ) {
			return $plugins;
		}

		if ($response['response']['code'] === 200 && $response['response']['message'] === 'OK') {
			$response = json_decode($response['body']);
			$response_data = $response->data;
			$ibtana_free_add_ons = $response_data->free;
			$ibtana_premium_add_ons = $response_data->premium;
			foreach ($ibtana_premium_add_ons as $key => $ibtana_premium_add_on) {
				array_push($plugins, [
					'name' 			=> $ibtana_premium_add_on->name,
					'slug' 			=> $ibtana_premium_add_on->domain,
					'desc'			=> $ibtana_premium_add_on->description,
					'main_file'	=> $ibtana_premium_add_on->class,
				]);
			}
		}

		$return_array = [
			'plugins'				=> $plugins,
			'is_key_valid'	=> isset($response_data->is_key_valid) ? $response_data->is_key_valid : 0
		];
		return $return_array;
	}

	public function ibtana_visual_editor_ive_addons_page() {
		$plugins	=	array();
		$base_url =	IBTANA_LICENSE_API_ENDPOINT . 'get_client_add_on_list';
		$args 		= array(
			"site_url"	=> site_url()
		);
		$body			= wp_json_encode( $args );
		$options	= [
			'timeout'     => 0,
			'body'        => $body,
			'headers'     => [
					'Content-Type' => 'application/json',
			]
		];
		$response = wp_remote_post( $base_url, $options );

		if ( is_wp_error( $response ) ) {
			$plugins	= array();
		} elseif ($response['response']['code'] === 200 && $response['response']['message'] === 'OK') {
			$response				= json_decode($response['body']);
			$response_data	= $response->data;
			$plugins				= $response_data->premium;
		}

		?>
		<div class="">
			<h3><?php esc_html_e( 'Addons', 'ibtana-visual-editor' ); ?></h3>
			<div class="ive_padding_space"></div>
			<div class="row">
				<?php if ( empty( $plugins ) ): ?>
					<?php esc_html_e( 'Coming Soon...', 'ibtana-visual-editor' ); ?>
				<?php else: ?>
					<?php foreach ( $plugins as $plugin ): ?>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="row">
								<div class="pheader">
									<h4 class="title"><?php echo $plugin->name; ?></h4>
									<!-- <h5 class="subtitle">$0.00 <small class="payment_freq">/ year</small></h5> -->
								</div>
								<div class="pbody">
									<?php echo $plugin->description; ?>
								</div>
								<div class="pfooter">
									<a target="_blank" href="<?php echo esc_url($plugin->permalink); ?>" type="button" class="btn btn-info">
										<?php esc_html_e( 'Get it now!', 'ibtana-visual-editor' ); ?>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

}

//main menu of ibtana settings
$ibtana_visual_editor_settings = array(
	'page_type' => 'menu_page',
	'page_title' => 'Ibtana Settings',
	'menu_title' => 'Ibtana Settings',
	'capability' => 'edit_theme_options',
	'menu_slug' => 'ibtana-visual-editor',
	'icon_url' => apply_filters(
				'ive:dashboard:icon-url',
				IBTANA_PLUGIN_URI . 'dist/images/ibtana-setting-icon.svg'
			),
	'page_functions' => 'ibtana_visual_editor_settings_page',
	'position' => '30,27',
	'priority' => 7,
);
new Ibtana_Visual_Editor_Menu_Creator( $ibtana_visual_editor_settings );

//main menu of ibtana settings
$ibtana_visual_editor_settings = array(
	'page_type' => 'same_admin_page',
	'page_title' => 'Getting Started',
	'menu_title' => 'Getting Started',
	'capability' => 'edit_theme_options',
	'menu_slug' => 'ibtana-visual-editor',
	'icon_url' => '',
	'parent_slug' => 'ibtana-visual-editor',
	'page_functions' => 'ibtana_visual_editor_settings_page'
);
new Ibtana_Visual_Editor_Menu_Creator( $ibtana_visual_editor_settings );

/*$ibtana_visual_editor_settings = array(
	'page_type' => 'submenu_page',
	'page_title' => 'Templates',
	'menu_title' => 'Templates',
	'capability' => 'edit_theme_options',
	'menu_slug' => 'ibtana-visual-editor-templates',
	'icon_url' => '',
	'parent_slug' => 'ibtana-visual-editor',
	'page_functions' => 'ibtana_visual_editor_templates_page'
);
new Ibtana_Visual_Editor_Menu_Creator($ibtana_visual_editor_settings);*/

$ibtana_visual_editor_settings = array(
	'page_type' => 'submenu_page',
	'page_title' => 'Templates',
	'menu_title' => 'Templates',
	'capability' => 'edit_theme_options',
	'menu_slug' => 'ibtana-visual-editor-templates',
	'icon_url' => '',
	'parent_slug' => 'ibtana-visual-editor',
	'page_functions' => 'ibtana_visual_editor_ive_templates_page'
);
new Ibtana_Visual_Editor_Menu_Creator( $ibtana_visual_editor_settings );

add_action( 'wp_loaded', function() {
	$ive_is_add_on_installed	= apply_filters( 'ive_is_add_on_installed', false );
	if ( $ive_is_add_on_installed ) {
		$ibtana_visual_editor_settings = array(
			'page_type'				=> 'submenu_page',
			'page_title'			=> 'License',
			'menu_title'			=> 'License',
			'capability'			=> 'edit_theme_options',
			'menu_slug'				=> 'ibtana-visual-editor-license',
			'icon_url'				=> '',
			'parent_slug'			=> 'ibtana-visual-editor',
			'page_functions'	=> 'ibtana_visual_editor_ive_license_page',
			'priority'				=>	99
		);
		new Ibtana_Visual_Editor_Menu_Creator( $ibtana_visual_editor_settings );
		$ibtana_visual_editor_settings = array(
			'page_type'				=> 'submenu_page',
			'page_title'			=> 'Addons',
			'menu_title'			=> 'Addons',
			'capability'			=> 'edit_theme_options',
			'menu_slug'				=> 'ibtana-visual-editor-addons',
			'icon_url'				=> '',
			'parent_slug'			=> 'ibtana-visual-editor',
			'page_functions'	=> 'ibtana_visual_editor_ive_addons_page',
			'priority'				=>	100
		);
		new Ibtana_Visual_Editor_Menu_Creator( $ibtana_visual_editor_settings );
	}
});



// $ibtana_visual_editor_settings = array(
// 	'page_type' => 'submenu_page',
// 	'page_title' => 'Go Pro',
// 	'menu_title' => 'Go Pro',
// 	'capability' => 'edit_theme_options',
// 	'menu_slug' => 'ibtana-visual-editor-go-pro',
// 	'icon_url' => '',
// 	'parent_slug' => 'ibtana-visual-editor',
// 	'page_functions' => 'ibtana_visual_editor_go_pro'
// );
// new Ibtana_Visual_Editor_Menu_Creator($ibtana_visual_editor_settings);

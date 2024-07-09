<?php
/**
 * OneStore Page Settings metabox
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

class OneStore_Admin_Metabox_Page_Settings {
	/**
	 * Singleton instance
	 *
	 * @var OneStore_Admin_Metabox_Page_Settings
	 */
	private static $instance;

	/**
	 * ====================================================
	 * Singleton & constructor functions
	 * ====================================================
	 */

	/**
	 * Get singleton instance.
	 *
	 * @return OneStore_Admin_Metabox_Page_Settings
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class constructor
	 */
	protected function __construct() {
		// Post meta box
		add_action( 'add_meta_boxes', array( $this, 'add_post_meta_box' ), 10, 2 );
		add_action( 'save_post', array( $this, 'save_post_meta_box' ) );

		// Term meta box
		add_action( 'admin_init', array( $this, 'init_term_meta_boxes' ) );

		// Render actions
		add_action( 'onestore/admin/metabox/page_settings/fields', array( $this, 'render_meta_box_fields__standard' ), 10, 2 );
	}

	/**
	 * ====================================================
	 * Private functions
	 * ====================================================
	 */

	/**
	 * Return the key and label of available tabs.
	 *
	 * @return array
	 */
	private function get_tabs() {
		return apply_filters( 'onestore/admin/metabox/page_settings/tabs', array(
			'content'          => esc_html__( 'Content & Sidebar', 'onestore' ),
			'header'           => esc_html__( 'Header', 'onestore' ),
			'page-header'      => esc_html__( 'Page Header', 'onestore' ),
			'footer'           => esc_html__( 'Footer', 'onestore' ),
			'custom-blocks'    => esc_html__( 'Custom Blocks (Hooks)', 'onestore' ),
			'preloader-screen' => esc_html__( 'Preloader Screen', 'onestore' ),
		) );
	}

	/**
	 * ====================================================
	 * Hook functions
	 * ====================================================
	 */

	/**
	 * Add page settings meta box to post edit page.
	 *
	 * @param string $post_type
	 * @param WP_Post $post
	 */
	public function add_post_meta_box( $post_type, $post ) {
		$post_types = array_merge(
			array( 'post', 'page' ),
			get_post_types( array(
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite'            => true,
				'_builtin'           => false,
			), 'names' )
		);

		$ignored_post_types = apply_filters( 'onestore/admin/metabox/page_settings/ignored_post_types', array() );

		$post_types = array_diff( $post_types, $ignored_post_types );

		add_meta_box(
			'onestore_page_settings',
			/* translators: %s: theme name. */
			sprintf( esc_html__( 'Page Settings (%s)', 'onestore' ), esc_html( onestore_get_theme_info( 'name' ) ) ),
			array( $this, 'render_meta_box__post' ),
			$post_types,
			'normal',
			'high'
		);
	}

	/**
	 * Handle save action for page settings meta box on post edit page.
	 *
	 * @param integer $post_id
	 */
	public function save_post_meta_box( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['onestore_post_page_settings_nonce'] ) ) return;
		
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( sanitize_key( $_POST['onestore_post_page_settings_nonce'] ), 'onestore_post_page_settings' ) ) return;

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;

		// Sanitize values.
		$sanitized = array();

		if ( isset( $_POST['onestore_page_settings'] ) && is_array( $_POST['onestore_page_settings'] ) ) {
			$page_settings = array_map( 'sanitize_key', wp_unslash( $_POST['onestore_page_settings'] ) );

			foreach ( $page_settings as $key => $value ) {
				if ( '' === $value ) continue;

				// If value is 0 or 1, cast to integer.
				if ( '0' === $value || '1' === $value ) {
					$value = intval( $value );
				}

				$sanitized[ $key ] = $value;
			}
		}

		// Update the meta field in the database.
		update_post_meta( $post_id, '_onestore_page_settings', $sanitized );
	}

	/**
	 * Initialize meta box on all public taxonomies.
	 */
	public function init_term_meta_boxes() {
		$taxonomies = array_merge(
			array( 'category', 'post_tag' ),
			get_taxonomies( array(
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite'            => true,
				'_builtin'           => false,
			), 'names' )
		);
		foreach ( $taxonomies as $taxonomy ) {
			add_action( $taxonomy . '_add_form_fields', array( $this, 'render_meta_box__term_add' ) );
			add_action( $taxonomy . '_edit_form_fields', array( $this, 'render_meta_box__term_edit' ) );

			add_action( 'create_' . $taxonomy, array( $this, 'save_term_meta_box' ), 10, 2 );
			add_action( 'edit_' . $taxonomy, array( $this, 'save_term_meta_box' ), 10, 2 );
		}
	}

	/**
	 * Handle save action for page settings meta box on edit term page.
	 *
	 * @param integer $term_id
	 * @param integer $tt_id
	 */
	public function save_term_meta_box( $term_id, $tt_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['onestore_term_page_settings_nonce'] ) ) return;

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( sanitize_key( $_POST['onestore_term_page_settings_nonce'] ), 'onestore_term_page_settings' ) ) return;

		// Sanitize values.
		$sanitized = array();
		if ( isset( $_POST['onestore_page_settings'] ) && is_array( $_POST['onestore_page_settings'] ) ) {
			$page_settings = array_map( 'sanitize_key', wp_unslash( $_POST['onestore_page_settings'] ) );
			
			foreach ( $page_settings as $key => $value ) {
				if ( '' === $value ) continue;

				// If value is 0 or 1, cast to integer.
				if ( '0' === $value || '1' === $value ) {
					$value = intval( $value );
				}
				
				$sanitized[ $key ] = $value;
			}
		}
		
		// Update the meta field in the database.
		update_term_meta( $term_id, 'onestore_page_settings', $sanitized );
	}

	/**
	 * ====================================================
	 * Render functions
	 * ====================================================
	 */

	/**
	 * Render page settings meta box on post / page edit page.
	 *
	 * @param WP_Post $post
	 */
	public function render_meta_box__post( $post ) {
		// Define an array of post IDs that will disable Page Settings meta box.
		// The Page Settings fields would not be displayed on those disabled IDs meta box.
		// Instead, The meta box would show the defined string specified on the disabled array.
		$disabled_ids = array();

		// Add posts page to disabled IDs.
		if ( 'page' === get_option( 'show_on_front' ) && $posts_page_id = get_option( 'page_for_posts' ) ) {
			$disabled_ids[ $posts_page_id ] = '<p><a href="' . esc_url( add_query_arg( array( 'autofocus[section]' => 'onestore_section_page_settings_post_archive', 'url' => esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) ), admin_url( 'customize.php' ) ) ) . '">' .  esc_html__( 'Edit Page settings here', 'onestore' ) . '</a></p>';
		}

		// Filter to modify disabled IDs.
		$disabled_ids = apply_filters( 'onestore/admin/metabox/page_settings/disabled_posts', $disabled_ids, $post );

		// Check if current post ID is one of the disabled IDs
		if ( array_key_exists( $post->ID, $disabled_ids ) ) {
			// Print the notice here.
			echo $disabled_ids[ $post->ID ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			// There is no other content should be rendered.
			return;
		}

		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'onestore_post_page_settings', 'onestore_post_page_settings_nonce' );

		// Render meta box.
		$this->render_meta_box_content( $post );
	}

	/**
	 * Render page settings meta box on add term page.
	 */
	public function render_meta_box__term_add() {
		?>
		<div class="form-field onestore-add-term-page-settings" style="margin: 2em 0;">
			<h2>
				<?php
				/* translators: %s: theme name. */
				printf( esc_html__( 'Page Settings (%s)', 'onestore' ), esc_html( onestore_get_theme_info( 'name' ) ) );
				?>
			</h2>
			<?php
			// Add a nonce field so we can check for it later.
			wp_nonce_field( 'onestore_term_page_settings', 'onestore_term_page_settings_nonce' );

			// Render meta box
			echo '<div class="onestore-term-metabox-container">';
			$this->render_meta_box_content();
			echo '</div>';
			?>
		</div>
		<?php
	}

	/**
	 * Render page settings meta box on edit term page.
	 *
	 * @param string $taxonomy
	 */
	public function render_meta_box__term_edit( $term ) {
		?>
		<tr class="form-field onestore-edit-term-page-settings">
			<td colspan="2" style="padding: 0;">
				<h3>
					<?php
					/* translators: %s: tdeme name. */
					printf( esc_html__( 'Page Settings (%s)', 'onestore' ), esc_html( onestore_get_theme_info( 'name' ) ) );
					?>
				</h3>
				<?php
				// Add a nonce field so we can check for it later.
				wp_nonce_field( 'onestore_term_page_settings', 'onestore_term_page_settings_nonce' );
				
				// Render meta box
				echo '<div class="onestore-term-metabox-container">';
				$this->render_meta_box_content( $term );
				echo '</div>';
				?>
			</th>
		</tr>
		<?php
	}

	/**
	 * Render meta box wrapper.
	 *
	 * @param WP_Post|WP_Term $obj
	 */
	public function render_meta_box_content( $obj = null ) {
		$tabs = $this->get_tabs();
		$first_tab = key( $tabs );
		?>
		<div id="onestore-metabox-page-settings" class="onestore-admin-metabox-page-settings onestore-admin-metabox onestore-admin-form">
			<ul class="onestore-admin-metabox-nav">
				<?php foreach ( $tabs as $key => $label ) : ?>
					<li class="onestore-admin-metabox-nav-item <?php echo esc_attr( $key == $first_tab ? 'active' : '' ); ?>">
						<a href="<?php echo esc_attr( '#onestore-metabox-page-settings--' . $key ); ?>"><?php echo $label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="onestore-admin-metabox-panels">
				<?php foreach ( $tabs as $key => $label ) : ?>
					<div id="<?php echo esc_attr( 'onestore-metabox-page-settings--' . $key ); ?>" class="onestore-admin-metabox-panel <?php echo esc_attr( $key == $first_tab ? 'active' : '' ); ?>">
						<?php
						/**
						 * Hook: onestore/admin/metabox/page_settings/fields
						 */
						do_action( 'onestore/admin/metabox/page_settings/fields', $obj, $key );
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render standard page settings meta box fields.
	 *
	 * @param WP_Post|WP_Term $obj
	 * @param string $tab
	 */
	public function render_meta_box_fields__standard( $obj, $tab ) {
		$option_key = 'onestore_page_settings';

		if ( is_a( $obj, 'WP_Post' ) ) {
			$values = get_post_meta( $obj->ID, '_' . $option_key, true );
		} elseif ( is_a( $obj, 'WP_Term' ) ) {
			$values = get_term_meta( $obj->term_id, $option_key, true );
		} else {
			$values = array();
		}

		switch ( $tab ) {
			case 'header':
				?>
				<div class="onestore-admin-form-row">
					<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Disable desktop header', 'onestore' ); ?></label></div>
					<div class="onestore-admin-form-field">
						<?php
						$key = 'disable_header';
						OneStore_Admin_Fields::render_field( array(
							'name'        => $option_key . '[' . $key . ']',
							'type'        => 'select',
							'choices'     => array(
								''  => esc_html__( '(Customizer)', 'onestore' ),
								'0' => esc_html__( '&#x2718; No', 'onestore' ),
								'1' => esc_html__( '&#x2714; Yes', 'onestore' ),
							),
							'value'       => onestore_array_value( $values, $key ),
						) );
						?>
					</div>
				</div>

				<div class="onestore-admin-form-row">
					<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Disable mobile header', 'onestore' ); ?></label></div>
					<div class="onestore-admin-form-field">
						<?php
						$key = 'disable_mobile_header';
						OneStore_Admin_Fields::render_field( array(
							'name'        => $option_key . '[' . $key . ']',
							'type'        => 'select',
							'choices'     => array(
								''  => esc_html__( '(Customizer)', 'onestore' ),
								'0' => esc_html__( '&#x2718; No', 'onestore' ),
								'1' => esc_html__( '&#x2714; Yes', 'onestore' ),
							),
							'value'       => onestore_array_value( $values, $key ),
						) );
						?>
					</div>
				</div>

				<?php 
				break;

			case 'page-header':
				?>
				<div class="onestore-admin-form-row">
					<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Page header', 'onestore' ); ?></label></div>
					<div class="onestore-admin-form-field">
						<?php
						$key = 'page_header';
						OneStore_Admin_Fields::render_field( array(
							'name'        => $option_key . '[' . $key . ']',
							'type'        => 'select',
							'choices'     => array(
								''  => esc_html__( '(Customizer)', 'onestore' ),
								'0' => esc_html__( '&#x2718; Disabled', 'onestore' ),
								'1' => esc_html__( '&#x2714; Enabled', 'onestore' ),
							),
							'value'       => onestore_array_value( $values, $key ),
						) );
						?>
					</div>
				</div>
			
				<?php if ( is_a( $obj, 'WP_Post' ) ) : ?>
					<div class="onestore-admin-form-row">
						<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Page header background image', 'onestore' ); ?></label></div>
						<div class="onestore-admin-form-field">
							<?php
							$post_type_obj = get_post_type_object( get_post_type( $obj ) );

							$choices = array(
								'' => esc_html__( 'Use global default background image as configured at Customize > Page Header.', 'onestore' ),
								'thumbnail' => esc_html__( 'Use Featured Image as background image (replace the global default background image).', 'onestore' ),
								'archive' => sprintf(
									/* translators: %s: post type plural name. */
									esc_html__( 'Use same background image as archive page (configured at Customize > Page Settings > %s Archive Page).', 'onestore' ),
									esc_html( $post_type_obj->labels->name )
								),
							);
							?>
							<div style="padding: 0.5em 0;">
								<?php
								if ( 'page' === get_post_type( $obj ) ) {
									echo esc_html( $choices['thumbnail'] );
								} else {
									$page_settings = onestore_get_theme_mod( 'page_settings_' . $post_type_obj->name . '_singular' );
									$value = onestore_array_value( $page_settings, 'page_header_bg' );

									echo esc_html( $choices[ $value ] );

									?>
									<div class="notice notice-info notice-alt inline">
										<p><?php printf(
											/* translators: %s: post type singular name. */
											esc_html__( 'TIPS: You can switch between "Use global default", "Use Featured Image", or "Use same background image as archive page" at Customize > Page Settings > Single %s Page.', 'onestore' ),
											esc_html( $post_type_obj->labels->singular_name )
										); ?></p>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				<?php endif;
				break;

			case 'content':
				?>

				<div class="onestore-admin-form-row">
					<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Content & sidebar layout', 'onestore' ); ?></label></div>
					<div class="onestore-admin-form-field">
						<?php
						$key = 'content_layout';
						OneStore_Admin_Fields::render_field( array(
							'name'        => $option_key . '[' . $key . ']',
							'type'        => 'radioimage',
							'choices'     => array(
								''              => array(
									'label' => esc_html__( '(Customizer)', 'onestore' ),
									'image' => ONESTORE_IMAGES_URL . '/customizer/customizer.svg',
								),
								'wide'          => array(
									'label' => esc_html__( 'Wide', 'onestore' ),
									'image' => ONESTORE_IMAGES_URL . '/customizer/content-sidebar-layout--wide.svg',
								),
								'left-sidebar'  => array(
									'label' => is_rtl() ? esc_html__( 'Right sidebar', 'onestore' ) : esc_html__( 'Left sidebar', 'onestore' ),
									'image' => ONESTORE_IMAGES_URL . '/customizer/content-sidebar-layout--left-sidebar.svg',
								),
								'right-sidebar' => array(
									'label' => is_rtl() ? esc_html__( 'Left sidebar', 'onestore' ) : esc_html__( 'Right sidebar', 'onestore' ),
									'image' => ONESTORE_IMAGES_URL . '/customizer/content-sidebar-layout--right-sidebar.svg',
								),
							),
							'value'       => onestore_array_value( $values, $key ),
						) );
						?>
					</div>
					<?php if ( is_a( $obj, 'WP_Post' ) ) : ?>
						<script type="text/javascript">
						(function( $ ) {
							'use strict';

							$( 'body.post-php' ).on( 'change', '#onestore_page_settings__content_layout', function( e ) {
								var $tinymce = $( '#content_ifr' ).contents().find( 'body' ),
								    inheritValue = '<?php echo esc_js( onestore_get_page_setting_by_post_id( 'content_layout', $obj->ID ) ); ?>',
								    value = '' === this.value ? inheritValue : this.value;

								$tinymce.removeClass( 'onestore-editor-wide onestore-editor-narrow onestore-editor-right-sidebar onestore-editor-left-sidebar' );
								$tinymce.addClass( 'onestore-editor-' + value );
							});
						})( jQuery );
						</script>
					<?php endif; ?>
				</div>

				<hr>

				<?php if ( is_a( $obj, 'WP_Post' ) ) : ?>
					<div class="onestore-admin-form-row">
						<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Hide post title', 'onestore' ); ?></label></div>
						<div class="onestore-admin-form-field">
							<?php
							$key = 'content_hide_title';
							OneStore_Admin_Fields::render_field( array(
								'name'        => $option_key . '[' . $key . ']',
								'type'        => 'select',
								'choices'     => array(
									''  => esc_html__( '(Customizer)', 'onestore' ),
									'0' => esc_html__( '&#x2718; No', 'onestore' ),
									'1' => esc_html__( '&#x2714; Yes', 'onestore' ),
								),
								'value'       => onestore_array_value( $values, $key ),
							) );
							?>
						</div>
					</div>

					<div class="onestore-admin-form-row">
						<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Hide featured image', 'onestore' ); ?></label></div>
						<div class="onestore-admin-form-field">
							<?php
							$key = 'content_hide_thumbnail';
							OneStore_Admin_Fields::render_field( array(
								'name'        => $option_key . '[' . $key . ']',
								'type'        => 'select',
								'choices'     => array(
									''  => esc_html__( '(Customizer)', 'onestore' ),
									'0' => esc_html__( '&#x2718; No', 'onestore' ),
									'1' => esc_html__( '&#x2714; Yes', 'onestore' ),
								),
								'value'       => onestore_array_value( $values, $key ),
							) );
							?>
						</div>
					</div>
				<?php endif; ?>

				<?php
				break;

			case 'footer':
				?>
				<div class="onestore-admin-form-row">
					<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Disable footer widgets', 'onestore' ); ?></label></div>
					<div class="onestore-admin-form-field">
						<?php
						$key = 'disable_footer_widgets';
						OneStore_Admin_Fields::render_field( array(
							'name'        => $option_key . '[' . $key . ']',
							'type'        => 'select',
							'choices'     => array(
								''  => esc_html__( '(Customizer)', 'onestore' ),
								'0' => esc_html__( '&#x2718; No', 'onestore' ),
								'1' => esc_html__( '&#x2714; Yes', 'onestore' ),
							),
							'value'       => onestore_array_value( $values, $key ),
						) );
						?>
					</div>
				</div>

				<div class="onestore-admin-form-row">
					<div class="onestore-admin-form-label"><label><?php esc_html_e( 'Disable footer bottom', 'onestore' ); ?></label></div>
					<div class="onestore-admin-form-field">
						<?php
						$key = 'disable_footer_bottom';
						OneStore_Admin_Fields::render_field( array(
							'name'        => $option_key . '[' . $key . ']',
							'type'        => 'select',
							'choices'     => array(
								''  => esc_html__( '(Customizer)', 'onestore' ),
								'0' => esc_html__( '&#x2718; No', 'onestore' ),
								'1' => esc_html__( '&#x2714; Yes', 'onestore' ),
							),
							'value'       => onestore_array_value( $values, $key ),
						) );
						?>
					</div>
				</div>
				<?php
				break;

			case 'preloader-screen':
				
				break;

			case 'custom-blocks':
				
				break;
		}
	}
}

OneStore_Admin_Metabox_Page_Settings::instance();
<?php
/**
 * Customizer custom control: Shadow
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OneStore_Customize_Control_Shadow' ) ) :
	/**
	 * Shadow control class
	 */
	class OneStore_Customize_Control_Shadow extends OneStore_Customize_Control {
		/**
		 * @var string
		 */
		public $type = 'onestore-shadow';

		/**
		 * @var boolean
		 */
		public $has_palette = true;

		/**
		 * @var array
		 */
		public $exclude = array();

		/**
		 * Setup parameters for content rendering by Underscore JS template.
		 */
		public function to_json() {
			parent::to_json();

			$this->json['name'] = $this->id;

			$value = $this->value();
			if ( false === $value || '' === trim( $value ) ) {
				$value = '0 0 0 0 rgba(0,0,0,0)'; // 4 empty space for default value
			}

			$chunks = explode( ' ', $value );
			$this->json['value'] = array(
				'h_offset' => intval( $chunks[0] ),
				'v_offset' => intval( $chunks[1] ),
				'blur' => intval( $chunks[2] ),
				'spread' => intval( $chunks[3] ),
				'color' => $chunks[4],
			);
			$this->json['raw_value'] = $value;

			$this->json['has_palette'] = $this->has_palette;

			$this->json['exclude'] = $this->exclude;

			$this->json['__link'] = $this->get_link();
		}

		/**
		 * Enqueue additional control's CSS or JS scripts.
		 */
		public function enqueue() {
			wp_enqueue_script( 'alpha-color-picker' );
			wp_enqueue_style( 'alpha-color-picker' );
		}

		/**
		 * Render Underscore JS template for this control's content.
		 */
		protected function content_template() {
			$labels = array(
				'h_offset' => esc_html__( 'H-Offset', 'onestore' ),
				'v_offset' => esc_html__( 'V-Offset', 'onestore' ),
				'blur' => esc_html__( 'Blur', 'onestore' ),
				'spread' => esc_html__( 'Spread', 'onestore' ),
			);

			/**
			 * Get color palette/
			 */

			$palette = array();

			for ( $i = 1; $i <= 8; $i++ ) {
				$palette[] = onestore_get_theme_mod( 'color_palette_' . $i, '' );
			}

			$palette = implode( '|', $palette );
			?>
		<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<div class="onestore-row onestore-shadow-row">
				<# var labels = <?php echo json_encode( $labels ); ?>; #>
				<# _.each( labels, function( label, prop ) { #>
					<# var isExcluded = -1 < data.exclude.indexOf( prop ) ? 'style="display: none;"' : ''; #>
					<label class="onestore-row-item onestore-shadow-{{ prop }}" {{{ isExcluded }}}>
						<span class="onestore-small-label">{{{ label }}}</span>
						<input type="number" value="{{ '' !== isExcluded ? '' : data.value[ prop ] }}" class="onestore-shadow-input" step="1">
					</label>
				<# }); #>
				<label class="onestore-row-item" style="width: 30px; vertical-align: top; padding-left: 10px;">
					<span class="onestore-small-label"><?php esc_html_e( 'Color', 'onestore' ); ?></span>
				</label>
			</div>
			<div class="onestore-shadow-color">
				<input value="{{ data.value.color }}" type="text" maxlength="30" class="onestore-shadow-input color-picker" data-palette="{{ data.has_palette ? '<?php echo esc_attr( $palette ); ?>' : 'false' }}" placeholder="<?php esc_attr_e( 'Hex / RGBA', 'onestore' ); ?>" data-default-color="rgba(0,0,0,0)" data-show-opacity="true">
			</div>

			<input type="hidden" {{{ data.__link }}} value="{{ data.raw_value }}" class="onestore-shadow-value">
		</div>
			<?php
		}
	}

	// Register control type.
	$wp_customize->register_control_type( 'OneStore_Customize_Control_Shadow' );
endif;

<?php
/**
 * Customizer custom control: Slider
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OneStore_Customize_Control_Slider' ) ) :
	/**
	 * Slider control class
	 */
	class OneStore_Customize_Control_Slider extends OneStore_Customize_Control {
		/**
		 * @var string
		 */
		public $type = 'onestore-slider';

		/**
		 * Available choices: px, em, %.
		 *
		 * @var array
		 */
		public $units = array( '' );

		/**
		 * @var boolean
		 */
		public $hide_units = false;

		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			// Make sure there is at least 1 unit type.
			if ( empty( $this->units ) ) {
				$this->units = array( '' );
			}

			// Sanitize unit attributes.
			foreach ( $this->units as $key => $unit ) {
				$this->units[ $key ] = wp_parse_args(
					$unit,
					array(
						'min' => 0,
						'max' => '',
						'step' => 1,
						'label' => $key,
					)
				);
			}
		}

		/**
		 * Setup parameters for content rendering by Underscore JS template.
		 */
		public function to_json() {
			parent::to_json();

			$this->json['name'] = $this->id;
			$this->json['units'] = $this->units;

			$this->json['inputs'] = array();
			$this->json['structures'] = array();

			foreach ( $this->settings as $setting_key => $setting ) {
				$value = $this->value( $setting_key );
				if ( false === $value ) {
					$value = '';
				}

				// Convert raw value string into number and unit.
				$number = '' === $value ? '' : floatval( $value );
				$unit = str_replace( $number, '', $value );
				if ( ! array_key_exists( $unit, $this->units ) ) {
					$units = array_keys( $this->units );
					$unit = reset( $units );
				}

				// Add to inputs array.
				$this->json['inputs'][ $setting_key ] = array(
					'__link' => $this->get_link( $setting_key ),
					'value' => $value,
					'number' => $number,
					'unit' => $unit,
				);

				// Add to structures array.
				$device = 'desktop';
				if ( false !== strpos( $setting->id, '__' ) ) {
					$chunks = explode( '__', $setting->id );
					if ( in_array( $chunks[1], array( 'desktop', 'tablet', 'mobile' ) ) ) {
						$device = $chunks[1];
					}
				}
				$this->json['structures'][ $device ] = $setting_key;
			}

			$this->json['responsive'] = 1 < count( $this->json['structures'] ) ? true : false;

			$this->json['hide_units'] = 1 == $this->hide_units ? true : false;
		}

		/**
		 * Enqueue additional control's CSS or JS scripts.
		 */
		public function enqueue() {
			wp_enqueue_style( 'jquery-ui-slider' );
		}

		/**
		 * Render Underscore JS template for this control's content.
		 */
		protected function content_template() {
			?>
		<# if ( data.label ) { #>
			<span class="customize-control-title {{ data.responsive ? 'onestore-responsive-title' : '' }}">
				{{{ data.label }}}
				<# if ( data.responsive ) { #>
					<span class="onestore-responsive-switcher">
						<# _.each( data.structures, function( setting_key, device ) { #>
							<span class="onestore-responsive-switcher-button preview-{{ device }}" data-device="{{ device }}"><span class="dashicons dashicons-{{ 'mobile' === device ? 'smartphone' : device }}"></span></span>
						<# }); #>
					</span>
				<# } #>
			</span>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<# _.each( data.structures, function( setting_key, device ) { #>
				<div class="onestore-slider-fieldset onestore-row {{ data.responsive ? 'onestore-responsive-fieldset' : '' }} {{ 'desktop' == device ? 'active' : '' }} {{ 'preview-' + device }}">
					<div class="onestore-row-item" style="width: 100%;">
						<div class="onestore-slider-ui"></div>
					</div>
					<div class="onestore-row-item" style="width: 50px;">
						<input class="onestore-slider-input {{ data.hide_units ? '' : 'onestore-input-with-unit' }}" type="number" value="{{ data.inputs[ setting_key ].number }}" min="{{ data.units[ data.inputs[ setting_key ].unit ].min }}" max="{{ data.units[ data.inputs[ setting_key ].unit ].max }}" step="{{ data.units[ data.inputs[ setting_key ].unit ].step }}">
					</div>
					<div class="onestore-row-item" style="width: 30px; {{ data.hide_units ? 'display: none;' : '' }}">
						<select class="onestore-slider-unit onestore-unit">
							<# _.each( data.units, function( unit_data, unit ) { #>
								<option value="{{ unit }}" {{ unit == data.inputs[ setting_key ].unit ? 'selected' : '' }} data-min="{{ unit_data.min }}" data-max="{{ unit_data.max }}" data-step="{{ unit_data.step }}">{{{ unit_data.label }}}</option>
							<# }); #>
						</select>
					</div>

					<input type="hidden" class="onestore-slider-value" value="{{ data.inputs[ setting_key ].value }}" {{{ data.inputs[ setting_key ].__link }}}>
				</div>
			<# }); #>
		</div>
			<?php
		}
	}

	// Register control type.
	$wp_customize->register_control_type( 'OneStore_Customize_Control_Slider' );
endif;

<?php
/**
 * Customizer custom control: Typography
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'OneStore_Customize_Control_Typography' ) ) :
	/**
	 * Typography control class
	 */
	class OneStore_Customize_Control_Typography extends OneStore_Customize_Control {
		/**
		 * @var string
		 */
		public $type = 'onestore-typography';

		/**
		 * @var array
		 */
		public $units = array();

		/**
		 * @var array
		 */
		public $choices = array();

		/**
		 * Setup parameters for content rendering by Underscore JS template.
		 */
		public function to_json() {
			parent::to_json();

			$this->json['name'] = $this->id;

			$this->json['inputs'] = array();
			$this->json['structures'] = array();

			foreach ( $this->settings as $setting_key => $setting ) {
				// Extract setting type.
				// Skip if no valid type found in the setting id.
				if ( ! preg_match( '/(font_family|font_weight|font_style|text_transform|font_size|line_height|letter_spacing)/', $setting->id, $matches ) ) {
					continue;
				}
				$type = $matches[1];

				$value = $this->value( $setting_key );

				// Add to inputs array.
				$this->json['inputs'][ $setting_key ] = array(
					'__link' => $this->get_link( $setting_key ),
					'value'  => $value,
				);

				// Add number and unit to font_size, line_height, letter_spacing setting type.
				if ( in_array( $type, array( 'font_size', 'line_height', 'letter_spacing' ) ) ) {
					$units = $this->get_units( $type );

					// Convert raw value string into number and unit.
					$number = '' === $value ? '' : floatval( $value );
					$unit = str_replace( $number, '', $value );
					if ( ! array_key_exists( $unit, $units ) ) {
						$unit = key( $units );
					}

					$this->json['inputs'][ $setting_key ]['number'] = $number;
					$this->json['inputs'][ $setting_key ]['unit'] = $unit;
				}

				// Add to structures array.
				$device = 'desktop';
				if ( false !== strpos( $setting->id, '__' ) ) {
					$chunks = explode( '__', $setting->id );
					if ( in_array( $chunks[1], array( 'desktop', 'tablet', 'mobile' ) ) ) {
						$device = $chunks[1];
					}
				}

				if ( in_array( $type, array( 'font_size', 'line_height', 'letter_spacing' ) ) ) {
					$this->json['structures'][ $device ][ $type ] = $setting_key;
				}
			}

			$this->json['responsive'] = 1 < count( $this->json['structures'] ) ? true : false;
		}

		/**
		 * Render Underscore JS template for this control's content.
		 */
		protected function content_template() {
			?>
		<# var labels = {
			font_family: '<?php esc_html_e( 'Font', 'onestore' ); ?>',
			font_weight: '<?php esc_html_e( 'Weight', 'onestore' ); ?>',
			font_style: '<?php esc_html_e( 'Style', 'onestore' ); ?>',
			text_transform: '<?php esc_html_e( 'Transform', 'onestore' ); ?>',
			font_size: '<?php esc_html_e( 'Size', 'onestore' ); ?>',
			line_height: '<?php esc_html_e( 'Line Height', 'onestore' ); ?>',
			letter_spacing: '<?php esc_html_e( 'Spacing', 'onestore' ); ?>',
		} #>
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
		<div class="customize-control-content {{ data.responsive ? 'onestore-responsive' : '' }}">
			<#
			var choices = <?php echo json_encode( $this->get_choices() ); ?>,
				units = <?php echo json_encode( $this->get_units() ); ?>;
			#>

			<# if ( data.inputs.font_family ) { #>
			<p class="onestore-typography-fieldset onestore-row">
				<label class="onestore-row-item">
					<span class="onestore-small-label">{{ labels.font_family }}</span>
					<select class="onestore-typography-input" {{{ data.inputs.font_family.__link }}}>
						<option value=""><?php esc_html_e( 'Default', 'onestore' ); ?></option>
						<# _.each( choices.font_family, function( provider_data, provider ) { #>
							<# if ( 0 == provider_data.fonts.length ) return; #>
							<optgroup label="{{ provider_data.label }}">
								<# _.each( provider_data.fonts, function( label, value ) { #>
									<option value="{{ value }}">{{{ label }}}</option>
								<# }); #>
							</optgroup>
						<# }); #>
					</select>
				</label>
			</p>
			<# } #>
			<p class="onestore-typography-fieldset onestore-row">
				<# _.each( [ 'font_weight', 'font_style', 'text_transform' ], function( type ) { #>
					<# if ( data.inputs[ type ] ) { #>
						<label class="onestore-row-item">
							<span class="onestore-small-label">{{ labels[ type ] }}</span>
							<select class="onestore-typography-input" {{{ data.inputs[ type ].__link }}}>
								<option value=""><?php esc_html_e( 'Default', 'onestore' ); ?></option>
								<# _.each( choices[ type ], function( label, value ) { #>
									<option value="{{ value }}">{{{ label }}}</option>
								<# }); #>
							</select>
						</label>
					<# } #>
				<# }); #>
			</p>
			<# _.each( data.structures, function( setting_keys, device ) { #>
				<div class="onestore-typography-fieldset onestore-row {{ data.responsive ? 'onestore-responsive-fieldset' : '' }} {{ 'desktop' == device ? 'active' : '' }} {{ 'preview-' + device }}">
					<# _.each( setting_keys, function( setting_key, setting_type ) { #>
						<# if ( data.inputs[ setting_key ] ) { #>
							<label class="onestore-row-item">
								<span class="onestore-small-label">{{ labels[ setting_type ] }}</span>
								<span class="onestore-typography-size onestore-row">
									<span class="onestore-row-item">
										<input class="onestore-typography-size-input onestore-input-with-unit" type="number" value="{{ data.inputs[ setting_key ].number }}" min="" max="" step="" placeholder="<?php esc_attr_e( 'Default', 'onestore' ); ?>">
									</span>
									<span class="onestore-row-item" style="width: 30px;">
										<select class="onestore-typography-size-unit onestore-unit">
											<# _.each( units[ setting_type ], function( unit_data, unit ) { #>
												<option value="{{ unit }}" {{ unit == data.inputs[ setting_key ].unit ? 'selected' : '' }} data-min="{{ unit_data.min }}" data-max="{{ unit_data.max }}" data-step="{{ unit_data.step }}">{{{ unit_data.label }}}</option>
											<# }); #>
										</select>
									</span>
									<input type="hidden" class="onestore-typography-size-value" value="{{data.inputs[ setting_key ].value }}" {{{ data.inputs[ setting_key ].__link }}}>
								</span>
							</label>
						<# } #>
					<# }); #>
				</div>
			<# }) #>
		</div>
			<?php
		}

		/**
		 * Return available choices for this control inputs.
		 *
		 * @param string $key
		 * @return array
		 */
		public function get_choices( $key = null ) {
			$font_families = array();

			foreach ( onestore_get_all_fonts() as $provider => $fonts ) {
				$font_families[ $provider ]['label'] = ucwords( str_replace( '_', ' ', $provider ) );
				$font_families[ $provider ]['fonts'] = array();

				foreach ( $fonts as $name => $stack ) {
					$font_families[ $provider ]['fonts'][ esc_attr( $provider . '|' . $name ) ] = esc_attr( $name );
				}
			}

			$choices = array(
				'font_family' => $font_families,
				'font_weight' => array(
					'100' => esc_html__( 'Thin', 'onestore' ),
					'200' => esc_html__( 'Extra Light', 'onestore' ),
					'300' => esc_html__( 'Light', 'onestore' ),
					'400' => esc_html__( 'Regular', 'onestore' ),
					'500' => esc_html__( 'Medium', 'onestore' ),
					'600' => esc_html__( 'Semi Bold', 'onestore' ),
					'700' => esc_html__( 'Bold', 'onestore' ),
					'800' => esc_html__( 'Extra Bold', 'onestore' ),
					'900' => esc_html__( 'Black', 'onestore' ),
				),
				'font_style' => array(
					'normal' => esc_html__( 'Normal', 'onestore' ),
					'italic' => esc_html__( 'Italic', 'onestore' ),
				),
				'text_transform' => array(
					'none'       => esc_html__( 'None', 'onestore' ),
					'uppercase'  => esc_html__( 'Uppercase', 'onestore' ),
					'lowercase'  => esc_html__( 'Lowercase', 'onestore' ),
					'capitalize' => esc_html__( 'Capitalize', 'onestore' ),
				),
			);

			if ( ! empty( $key ) ) {
				return onestore_array_value( $choices, $key, array() );
			} else {
				return $choices;
			}
		}

		/**
		 * Return available units for this control inputs.
		 *
		 * @param string $key
		 * @return array
		 */
		public function get_units( $key = null ) {
			$units = array(
				'font_size' => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
						'step' => 1,
						'label' => 'px',
					),
					'em' => array(
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
						'label' => 'em',
					),
					'rem' => array(
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
						'label' => 'rem',
					),
				),
				'line_height' => array(
					'' => array(
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
						'label' => 'em',
					),
				),
				'letter_spacing' => array(
					'px' => array(
						'min' => -20,
						'max' => 20,
						'step' => 0.1,
						'label' => 'px',
					),
					'em' => array(
						'min' => -2,
						'max' => 2,
						'step' => 0.1,
						'label' => 'em',
					),
				),
			);

			if ( ! empty( $key ) ) {
				return onestore_array_value( $units, $key, array() );
			} else {
				return $units;
			}
		}
	}

	// Register control type.
	$wp_customize->register_control_type( 'OneStore_Customize_Control_Typography' );
endif;

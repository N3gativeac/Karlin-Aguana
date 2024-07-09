<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class Physiotherapy_Lite_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'physiotherapy-lite' ),
				'family'      => esc_html__( 'Font Family', 'physiotherapy-lite' ),
				'size'        => esc_html__( 'Font Size',   'physiotherapy-lite' ),
				'weight'      => esc_html__( 'Font Weight', 'physiotherapy-lite' ),
				'style'       => esc_html__( 'Font Style',  'physiotherapy-lite' ),
				'line_height' => esc_html__( 'Line Height', 'physiotherapy-lite' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'physiotherapy-lite' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'physiotherapy-lite-ctypo-customize-controls' );
		wp_enqueue_style(  'physiotherapy-lite-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'physiotherapy-lite' ),
        'Abril Fatface' => __( 'Abril Fatface', 'physiotherapy-lite' ),
        'Acme' => __( 'Acme', 'physiotherapy-lite' ),
        'Anton' => __( 'Anton', 'physiotherapy-lite' ),
        'Architects Daughter' => __( 'Architects Daughter', 'physiotherapy-lite' ),
        'Arimo' => __( 'Arimo', 'physiotherapy-lite' ),
        'Arsenal' => __( 'Arsenal', 'physiotherapy-lite' ),
        'Arvo' => __( 'Arvo', 'physiotherapy-lite' ),
        'Alegreya' => __( 'Alegreya', 'physiotherapy-lite' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'physiotherapy-lite' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'physiotherapy-lite' ),
        'Bangers' => __( 'Bangers', 'physiotherapy-lite' ),
        'Boogaloo' => __( 'Boogaloo', 'physiotherapy-lite' ),
        'Bad Script' => __( 'Bad Script', 'physiotherapy-lite' ),
        'Bitter' => __( 'Bitter', 'physiotherapy-lite' ),
        'Bree Serif' => __( 'Bree Serif', 'physiotherapy-lite' ),
        'BenchNine' => __( 'BenchNine', 'physiotherapy-lite' ),
        'Cabin' => __( 'Cabin', 'physiotherapy-lite' ),
        'Cardo' => __( 'Cardo', 'physiotherapy-lite' ),
        'Courgette' => __( 'Courgette', 'physiotherapy-lite' ),
        'Cherry Swash' => __( 'Cherry Swash', 'physiotherapy-lite' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'physiotherapy-lite' ),
        'Crimson Text' => __( 'Crimson Text', 'physiotherapy-lite' ),
        'Cuprum' => __( 'Cuprum', 'physiotherapy-lite' ),
        'Cookie' => __( 'Cookie', 'physiotherapy-lite' ),
        'Chewy' => __( 'Chewy', 'physiotherapy-lite' ),
        'Days One' => __( 'Days One', 'physiotherapy-lite' ),
        'Dosis' => __( 'Dosis', 'physiotherapy-lite' ),
        'Droid Sans' => __( 'Droid Sans', 'physiotherapy-lite' ),
        'Economica' => __( 'Economica', 'physiotherapy-lite' ),
        'Fredoka One' => __( 'Fredoka One', 'physiotherapy-lite' ),
        'Fjalla One' => __( 'Fjalla One', 'physiotherapy-lite' ),
        'Francois One' => __( 'Francois One', 'physiotherapy-lite' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'physiotherapy-lite' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'physiotherapy-lite' ),
        'Great Vibes' => __( 'Great Vibes', 'physiotherapy-lite' ),
        'Handlee' => __( 'Handlee', 'physiotherapy-lite' ),
        'Hammersmith One' => __( 'Hammersmith One', 'physiotherapy-lite' ),
        'Inconsolata' => __( 'Inconsolata', 'physiotherapy-lite' ),
        'Indie Flower' => __( 'Indie Flower', 'physiotherapy-lite' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'physiotherapy-lite' ),
        'Julius Sans One' => __( 'Julius Sans One', 'physiotherapy-lite' ),
        'Josefin Slab' => __( 'Josefin Slab', 'physiotherapy-lite' ),
        'Josefin Sans' => __( 'Josefin Sans', 'physiotherapy-lite' ),
        'Kanit' => __( 'Kanit', 'physiotherapy-lite' ),
        'Lobster' => __( 'Lobster', 'physiotherapy-lite' ),
        'Lato' => __( 'Lato', 'physiotherapy-lite' ),
        'Lora' => __( 'Lora', 'physiotherapy-lite' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'physiotherapy-lite' ),
        'Lobster Two' => __( 'Lobster Two', 'physiotherapy-lite' ),
        'Merriweather' => __( 'Merriweather', 'physiotherapy-lite' ),
        'Monda' => __( 'Monda', 'physiotherapy-lite' ),
        'Montserrat' => __( 'Montserrat', 'physiotherapy-lite' ),
        'Muli' => __( 'Muli', 'physiotherapy-lite' ),
        'Marck Script' => __( 'Marck Script', 'physiotherapy-lite' ),
        'Noto Serif' => __( 'Noto Serif', 'physiotherapy-lite' ),
        'Open Sans' => __( 'Open Sans', 'physiotherapy-lite' ),
        'Overpass' => __( 'Overpass', 'physiotherapy-lite' ),
        'Overpass Mono' => __( 'Overpass Mono', 'physiotherapy-lite' ),
        'Oxygen' => __( 'Oxygen', 'physiotherapy-lite' ),
        'Orbitron' => __( 'Orbitron', 'physiotherapy-lite' ),
        'Patua One' => __( 'Patua One', 'physiotherapy-lite' ),
        'Pacifico' => __( 'Pacifico', 'physiotherapy-lite' ),
        'Padauk' => __( 'Padauk', 'physiotherapy-lite' ),
        'Playball' => __( 'Playball', 'physiotherapy-lite' ),
        'Playfair Display' => __( 'Playfair Display', 'physiotherapy-lite' ),
        'PT Sans' => __( 'PT Sans', 'physiotherapy-lite' ),
        'Philosopher' => __( 'Philosopher', 'physiotherapy-lite' ),
        'Permanent Marker' => __( 'Permanent Marker', 'physiotherapy-lite' ),
        'Poiret One' => __( 'Poiret One', 'physiotherapy-lite' ),
        'Quicksand' => __( 'Quicksand', 'physiotherapy-lite' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'physiotherapy-lite' ),
        'Raleway' => __( 'Raleway', 'physiotherapy-lite' ),
        'Rubik' => __( 'Rubik', 'physiotherapy-lite' ),
        'Rokkitt' => __( 'Rokkitt', 'physiotherapy-lite' ),
        'Russo One' => __( 'Russo One', 'physiotherapy-lite' ),
        'Righteous' => __( 'Righteous', 'physiotherapy-lite' ),
        'Slabo' => __( 'Slabo', 'physiotherapy-lite' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'physiotherapy-lite' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'physiotherapy-lite'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'physiotherapy-lite' ),
        'Sacramento' => __( 'Sacramento', 'physiotherapy-lite' ),
        'Shrikhand' => __( 'Shrikhand', 'physiotherapy-lite' ),
        'Tangerine' => __( 'Tangerine', 'physiotherapy-lite' ),
        'Ubuntu' => __( 'Ubuntu', 'physiotherapy-lite' ),
        'VT323' => __( 'VT323', 'physiotherapy-lite' ),
        'Varela Round' => __( 'Varela Round', 'physiotherapy-lite' ),
        'Vampiro One' => __( 'Vampiro One', 'physiotherapy-lite' ),
        'Vollkorn' => __( 'Vollkorn', 'physiotherapy-lite' ),
        'Volkhov' => __( 'Volkhov', 'physiotherapy-lite' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'physiotherapy-lite' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'physiotherapy-lite' ),
			'100' => esc_html__( 'Thin',       'physiotherapy-lite' ),
			'300' => esc_html__( 'Light',      'physiotherapy-lite' ),
			'400' => esc_html__( 'Normal',     'physiotherapy-lite' ),
			'500' => esc_html__( 'Medium',     'physiotherapy-lite' ),
			'700' => esc_html__( 'Bold',       'physiotherapy-lite' ),
			'900' => esc_html__( 'Ultra Bold', 'physiotherapy-lite' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'physiotherapy-lite' ),
			'normal'  => esc_html__( 'Normal', 'physiotherapy-lite' ),
			'italic'  => esc_html__( 'Italic', 'physiotherapy-lite' ),
			'oblique' => esc_html__( 'Oblique', 'physiotherapy-lite' )
		);
	}
}

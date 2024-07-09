<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Ecommerce_Shop_Control_Typography extends WP_Customize_Control {

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
				'color'       => esc_html__( 'Font Color', 'vw-ecommerce-shop' ),
				'family'      => esc_html__( 'Font Family', 'vw-ecommerce-shop' ),
				'size'        => esc_html__( 'Font Size',   'vw-ecommerce-shop' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-ecommerce-shop' ),
				'style'       => esc_html__( 'Font Style',  'vw-ecommerce-shop' ),
				'line_height' => esc_html__( 'Line Height', 'vw-ecommerce-shop' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-ecommerce-shop' ),
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
		wp_enqueue_script( 'vw-ecommerce-shop-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-ecommerce-shop-ctypo-customize-controls' );
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
			'' => __( 'No Fonts', 'vw-ecommerce-shop' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-ecommerce-shop' ),
        'Acme' => __( 'Acme', 'vw-ecommerce-shop' ),
        'Anton' => __( 'Anton', 'vw-ecommerce-shop' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-ecommerce-shop' ),
        'Arimo' => __( 'Arimo', 'vw-ecommerce-shop' ),
        'Arsenal' => __( 'Arsenal', 'vw-ecommerce-shop' ),
        'Arvo' => __( 'Arvo', 'vw-ecommerce-shop' ),
        'Alegreya' => __( 'Alegreya', 'vw-ecommerce-shop' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-ecommerce-shop' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-ecommerce-shop' ),
        'Bangers' => __( 'Bangers', 'vw-ecommerce-shop' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-ecommerce-shop' ),
        'Bad Script' => __( 'Bad Script', 'vw-ecommerce-shop' ),
        'Bitter' => __( 'Bitter', 'vw-ecommerce-shop' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-ecommerce-shop' ),
        'BenchNine' => __( 'BenchNine', 'vw-ecommerce-shop' ),
        'Cabin' => __( 'Cabin', 'vw-ecommerce-shop' ),
        'Cardo' => __( 'Cardo', 'vw-ecommerce-shop' ),
        'Courgette' => __( 'Courgette', 'vw-ecommerce-shop' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-ecommerce-shop' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-ecommerce-shop' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-ecommerce-shop' ),
        'Cuprum' => __( 'Cuprum', 'vw-ecommerce-shop' ),
        'Cookie' => __( 'Cookie', 'vw-ecommerce-shop' ),
        'Chewy' => __( 'Chewy', 'vw-ecommerce-shop' ),
        'Days One' => __( 'Days One', 'vw-ecommerce-shop' ),
        'Dosis' => __( 'Dosis', 'vw-ecommerce-shop' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-ecommerce-shop' ),
        'Economica' => __( 'Economica', 'vw-ecommerce-shop' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-ecommerce-shop' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-ecommerce-shop' ),
        'Francois One' => __( 'Francois One', 'vw-ecommerce-shop' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-ecommerce-shop' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-ecommerce-shop' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-ecommerce-shop' ),
        'Handlee' => __( 'Handlee', 'vw-ecommerce-shop' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-ecommerce-shop' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-ecommerce-shop' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-ecommerce-shop' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-ecommerce-shop' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-ecommerce-shop' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-ecommerce-shop' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-ecommerce-shop' ),
        'Kanit' => __( 'Kanit', 'vw-ecommerce-shop' ),
        'Lobster' => __( 'Lobster', 'vw-ecommerce-shop' ),
        'Lato' => __( 'Lato', 'vw-ecommerce-shop' ),
        'Lora' => __( 'Lora', 'vw-ecommerce-shop' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-ecommerce-shop' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-ecommerce-shop' ),
        'Merriweather' => __( 'Merriweather', 'vw-ecommerce-shop' ),
        'Monda' => __( 'Monda', 'vw-ecommerce-shop' ),
        'Montserrat' => __( 'Montserrat', 'vw-ecommerce-shop' ),
        'Muli' => __( 'Muli', 'vw-ecommerce-shop' ),
        'Marck Script' => __( 'Marck Script', 'vw-ecommerce-shop' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-ecommerce-shop' ),
        'Open Sans' => __( 'Open Sans', 'vw-ecommerce-shop' ),
        'Overpass' => __( 'Overpass', 'vw-ecommerce-shop' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-ecommerce-shop' ),
        'Oxygen' => __( 'Oxygen', 'vw-ecommerce-shop' ),
        'Orbitron' => __( 'Orbitron', 'vw-ecommerce-shop' ),
        'Patua One' => __( 'Patua One', 'vw-ecommerce-shop' ),
        'Pacifico' => __( 'Pacifico', 'vw-ecommerce-shop' ),
        'Padauk' => __( 'Padauk', 'vw-ecommerce-shop' ),
        'Playball' => __( 'Playball', 'vw-ecommerce-shop' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-ecommerce-shop' ),
        'PT Sans' => __( 'PT Sans', 'vw-ecommerce-shop' ),
        'Philosopher' => __( 'Philosopher', 'vw-ecommerce-shop' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-ecommerce-shop' ),
        'Poiret One' => __( 'Poiret One', 'vw-ecommerce-shop' ),
        'Quicksand' => __( 'Quicksand', 'vw-ecommerce-shop' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-ecommerce-shop' ),
        'Raleway' => __( 'Raleway', 'vw-ecommerce-shop' ),
        'Rubik' => __( 'Rubik', 'vw-ecommerce-shop' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-ecommerce-shop' ),
        'Russo One' => __( 'Russo One', 'vw-ecommerce-shop' ),
        'Righteous' => __( 'Righteous', 'vw-ecommerce-shop' ),
        'Slabo' => __( 'Slabo', 'vw-ecommerce-shop' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-ecommerce-shop' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-ecommerce-shop'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-ecommerce-shop' ),
        'Sacramento' => __( 'Sacramento', 'vw-ecommerce-shop' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-ecommerce-shop' ),
        'Tangerine' => __( 'Tangerine', 'vw-ecommerce-shop' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-ecommerce-shop' ),
        'VT323' => __( 'VT323', 'vw-ecommerce-shop' ),
        'Varela Round' => __( 'Varela Round', 'vw-ecommerce-shop' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-ecommerce-shop' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-ecommerce-shop' ),
        'Volkhov' => __( 'Volkhov', 'vw-ecommerce-shop' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-ecommerce-shop' )
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
			'' => esc_html__( 'No Fonts weight', 'vw-ecommerce-shop' ),
			'100' => esc_html__( 'Thin',       'vw-ecommerce-shop' ),
			'300' => esc_html__( 'Light',      'vw-ecommerce-shop' ),
			'400' => esc_html__( 'Normal',     'vw-ecommerce-shop' ),
			'500' => esc_html__( 'Medium',     'vw-ecommerce-shop' ),
			'700' => esc_html__( 'Bold',       'vw-ecommerce-shop' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-ecommerce-shop' ),
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
			'normal'  => esc_html__( 'Normal', 'vw-ecommerce-shop' ),
			'italic'  => esc_html__( 'Italic', 'vw-ecommerce-shop' ),
			'oblique' => esc_html__( 'Oblique', 'vw-ecommerce-shop' )
		);
	}
}
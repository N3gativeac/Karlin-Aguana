<?php
/**
 * VW Ecommerce Shop Theme Customizer
 *
 * @package VW Ecommerce Shop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_ecommerce_shop_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_ecommerce_shop_custom_controls' );

function vw_ecommerce_shop_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial( 'blogname', array( 
        'selector' => '.logo .site-title a', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_blogname', 
    )); 

    $wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
        'selector' => 'p.site-description', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_blogdescription', 
    ));

	//add home page setting pannel
	$VWEcommerceShopParentPanel = new VW_Ecommerce_Shop_WP_Customize_Panel( $wp_customize, 'vw_ecommerce_shop_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'VW Settings',
		'priority' => 10,
	));

	$wp_customize->add_section( 'vw_ecommerce_shop_left_right', array(
    	'title'      => __( 'General Settings', 'vw-ecommerce-shop' ),
		'priority'   => 30,
		'panel' => 'vw_ecommerce_shop_panel_id'
	) );

	$wp_customize->add_setting('vw_ecommerce_shop_width_option',array(
        'default' => __('Full Width','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-ecommerce-shop'),
        'description' => __('Here you can change the width layout of Website.','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_ecommerce_shop_theme_options',array(
        'default' => __('Right Sidebar','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_ecommerce_shop_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-ecommerce-shop'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-ecommerce-shop'),
            'Right Sidebar' => __('Right Sidebar','vw-ecommerce-shop'),
            'One Column' => __('One Column','vw-ecommerce-shop'),
            'Three Columns' => __('Three Columns','vw-ecommerce-shop'),
            'Four Columns' => __('Four Columns','vw-ecommerce-shop'),
            'Grid Layout' => __('Grid Layout','vw-ecommerce-shop')
        ),
	));

	$wp_customize->add_setting('vw_ecommerce_shop_page_layout',array(
        'default' => __('One Column','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control('vw_ecommerce_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-ecommerce-shop'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-ecommerce-shop'),
            'Right Sidebar' => __('Right Sidebar','vw-ecommerce-shop'),
            'One Column' => __('One Column','vw-ecommerce-shop')
        ),
	) );

    //Pre-Loader
	$wp_customize->add_setting( 'vw_ecommerce_shop_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-ecommerce-shop' ),
        'section' => 'vw_ecommerce_shop_left_right'
    )));

    $wp_customize->add_setting('vw_ecommerce_shop_loader_icon',array(
        'default' => __('Two Way','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control('vw_ecommerce_shop_loader_icon',array(
        'type' => 'select',
        'label' => __('Pre-Loader Type','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_left_right',
        'choices' => array(
            'Two Way' => __('Two Way','vw-ecommerce-shop'),
            'Dots' => __('Dots','vw-ecommerce-shop'),
            'Rotate' => __('Rotate','vw-ecommerce-shop')
        ),
	) );
    
	//Topbar section
	$wp_customize->add_section('vw_ecommerce_shop_topbar',array(
		'title'	=> __('Topbar Section','vw-ecommerce-shop'),
		'description'	=> __('Add Header Content here','vw-ecommerce-shop'),
		'priority'	=> null,
		'panel' => 'vw_ecommerce_shop_panel_id',
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_topbar_hide_show',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_topbar_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Topbar','vw-ecommerce-shop' ),
      	'section' => 'vw_ecommerce_shop_topbar'
    )));

    $wp_customize->add_setting('vw_ecommerce_shop_topbar_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_topbar_padding_top_bottom',array(
		'label'	=> __('Topbar Padding Top Bottom','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_topbar',
		'type'=> 'text'
	));

    //Sticky Header
	$wp_customize->add_setting( 'vw_ecommerce_shop_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-ecommerce-shop' ),
        'section' => 'vw_ecommerce_shop_topbar'
    )));

     $wp_customize->add_setting('vw_ecommerce_shop_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_topbar',
		'type'=> 'text'
	));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_shipping', array( 
        'selector' => '.top-contact span.free', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_shipping', 
    ));

    $wp_customize->add_setting('vw_ecommerce_shop_shipping_icon',array(
		'default'	=> 'fa fa-car',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_shipping_icon',array(
		'label'	=> __('Add Shipping Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_shipping_icon',
		'type'		=> 'icon'
	)));
	
	$wp_customize->add_setting('vw_ecommerce_shop_shipping',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_shipping',array(
		'label'	=> __('Add Shipping Text','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_shipping',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_return_icon',array(
		'default'	=> 'fas fa-sync-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_return_icon',array(
		'label'	=> __('Add Return Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_return_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_ecommerce_shop_return',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_return',array(
		'label'	=> __('Add Return Text','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_return',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_payment_icon',array(
		'default'	=> 'fas fa-dollar-sign',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_payment_icon',array(
		'label'	=> __('Add Payment Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_payment_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_ecommerce_shop_cash',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_cash',array(
		'label'	=> __('Add Payment Text','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_cash',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_phone_no_icon',array(
		'default'	=> 'fa fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_phone_no_icon',array(
		'label'	=> __('Add Phone Number Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_phone_no_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_ecommerce_shop_contact',array(
		'default'	=> '',
		'sanitize_callback'	=> 'vw_ecommerce_shop_sanitize_phone_number'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_contact',array(
		'label'	=> __('Add Phone Number','vw-ecommerce-shop'),
		'section'	=> 'vw_ecommerce_shop_topbar',
		'setting'	=> 'vw_ecommerce_shop_contact',
		'type'		=> 'text'
	));
	
	//home page slider
    $wp_customize->add_section( 'vw_ecommerce_shop_slidersettings' , array(
      'title'      => __( 'Slider Settings', 'vw-ecommerce-shop' ),
      'priority'   => null,
      'panel' => 'vw_ecommerce_shop_panel_id'
    ) );

    $wp_customize->add_setting( 'vw_ecommerce_shop_slider_hide_show',
       array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_slidersettings'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_slider_hide_show',array(
        'selector'        => '.slider .inner_carousel h1',
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_slider_hide_show',
    ));

    for ( $count = 1; $count <= 4; $count++ ) {
	    // Add color scheme setting and control.
	    $wp_customize->add_setting( 'vw_ecommerce_shop_slider_page' . $count, array(
	      'default'           => '',
	      'sanitize_callback' => 'vw_ecommerce_shop_sanitize_dropdown_pages'
	    ) );
	    $wp_customize->add_control( 'vw_ecommerce_shop_slider_page' . $count, array(
	      'label'    => __( 'Select Slide Image Page', 'vw-ecommerce-shop' ),
	      'description' => __( 'Size of image should be (900 x 367)', 'vw-ecommerce-shop' ),
	      'section'  => 'vw_ecommerce_shop_slidersettings',
	      'type'     => 'dropdown-pages'
	    ) );
    }

    $wp_customize->add_setting('vw_ecommerce_shop_slider_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_slidersettings',
		'type'=> 'text'
	));

    //content layout
	$wp_customize->add_setting('vw_ecommerce_shop_slider_content_option',array(
        'default' => __('Left','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_ecommerce_shop_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt Length','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_ecommerce_shop_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('vw_ecommerce_shop_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_ecommerce_shop_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_slidersettings',
		'type'        => 'select',
		'settings'    => 'vw_ecommerce_shop_slider_opacity_color',
		'choices' => array(
	      '0' =>  esc_attr('0','vw-ecommerce-shop'),
	      '0.1' =>  esc_attr('0.1','vw-ecommerce-shop'),
	      '0.2' =>  esc_attr('0.2','vw-ecommerce-shop'),
	      '0.3' =>  esc_attr('0.3','vw-ecommerce-shop'),
	      '0.4' =>  esc_attr('0.4','vw-ecommerce-shop'),
	      '0.5' =>  esc_attr('0.5','vw-ecommerce-shop'),
	      '0.6' =>  esc_attr('0.6','vw-ecommerce-shop'),
	      '0.7' =>  esc_attr('0.7','vw-ecommerce-shop'),
	      '0.8' =>  esc_attr('0.8','vw-ecommerce-shop'),
	      '0.9' =>  esc_attr('0.9','vw-ecommerce-shop')
		),
	));

	//Slider height
	$wp_customize->add_setting('vw_ecommerce_shop_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_slider_height',array(
		'label'	=> __('Slider Height','vw-ecommerce-shop'),
		'description'	=> __('Specify the slider height (px).','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_slidersettings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'vw_ecommerce_shop_sanitize_float'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-ecommerce-shop'),
		'section' => 'vw_ecommerce_shop_slidersettings',
		'type'  => 'number',
	) );

	//Trending Product
	$wp_customize->add_section('vw_ecommerce_shop_products',array(
		'title'	=> __('Trending Products','vw-ecommerce-shop'),
		'description'=> __('This section will appear below the slider.','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial( 'vw_ecommerce_shop_maintitle', array( 
        'selector' => '.our-products h2', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_maintitle',
    ));
	
	$wp_customize->add_setting('vw_ecommerce_shop_maintitle',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_ecommerce_shop_maintitle',array(
		'label'	=> __('Section Title','vw-ecommerce-shop'),
		'section'=> 'vw_ecommerce_shop_products',
		'setting'=> 'vw_ecommerce_shop_maintitle',
		'type'=> 'text'
	));	

	for ( $count = 0; $count <= 0; $count++ ) {
		$wp_customize->add_setting( 'vw_ecommerce_shop_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_ecommerce_shop_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'vw_ecommerce_shop_page' . $count, array(
			'label'    => __( 'Select Page', 'vw-ecommerce-shop' ),
			'section'  => 'vw_ecommerce_shop_products',
			'type'     => 'dropdown-pages'
		));
	}

	//Blog Post
	$wp_customize->add_panel( $VWEcommerceShopParentPanel );

	$BlogPostParentPanel = new VW_Ecommerce_Shop_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-ecommerce-shop' ),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_ecommerce_shop_post_settings', array(
		'title' => __( 'Post Settings', 'vw-ecommerce-shop' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_toggle_postdate', array( 
        'selector' => '.post-main-box h2 a', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_toggle_postdate', 
    ));

	$wp_customize->add_setting( 'vw_ecommerce_shop_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-ecommerce-shop' ),
        'section' => 'vw_ecommerce_shop_post_settings'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_toggle_author',array(
		'label' => esc_html__( 'Author','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_post_settings'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_post_settings'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_post_settings'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_ecommerce_shop_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('vw_ecommerce_shop_blog_layout_option',array(
        'default' => __('Default','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('vw_ecommerce_shop_excerpt_settings',array(
        'default' => __('Excerpt','vw-ecommerce-shop'),
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
    ));
    $wp_customize->add_control('vw_ecommerce_shop_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_post_settings',
        'choices' => array(
            'Content' => __('Content','vw-ecommerce-shop'),
            'Excerpt' => __('Excerpt','vw-ecommerce-shop'),
            'No Content' => __('No Content','vw-ecommerce-shop')
        ),
    ) );

    $wp_customize->add_setting('vw_ecommerce_shop_excerpt_suffix',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_ecommerce_shop_excerpt_suffix',array(
        'label' => __('Add Excerpt Suffix','vw-ecommerce-shop'),
        'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-ecommerce-shop' ),
        ),
        'section'=> 'vw_ecommerce_shop_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting( 'vw_ecommerce_shop_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_post_settings'
    )));

	$wp_customize->add_setting( 'vw_ecommerce_shop_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_ecommerce_shop_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_ecommerce_shop_blog_pagination_type', array(
        'section' => 'vw_ecommerce_shop_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-ecommerce-shop' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-ecommerce-shop' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-ecommerce-shop' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'vw_ecommerce_shop_button_settings', array(
		'title' => __( 'Button Settings', 'vw-ecommerce-shop' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting('vw_ecommerce_shop_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_button_text', array( 
        'selector' => '.post-main-box .content-bttn a', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_button_text', 
    ));

	$wp_customize->add_setting('vw_ecommerce_shop_button_text',array(
		'default'=> 'Read More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_button_text',array(
		'label'	=> __('Add Button Text','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_ecommerce_shop_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-ecommerce-shop' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_related_post_title', array( 
        'selector' => '.related-post h3', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_related_post_title', 
    ));

    $wp_customize->add_setting( 'vw_ecommerce_shop_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_related_post',array(
		'label' => esc_html__( 'Related Post','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_ecommerce_shop_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_ecommerce_shop_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_ecommerce_shop_sanitize_float'
	));
	$wp_customize->add_control('vw_ecommerce_shop_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_related_posts_settings',
		'type'=> 'number'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'vw_ecommerce_shop_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-ecommerce-shop' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Post Navigation','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('vw_ecommerce_shop_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_single_blog_settings',
		'type'=> 'text'
	));

    //404 Page Setting
	$wp_customize->add_section('vw_ecommerce_shop_404_page',array(
		'title'	=> __('404 Page Settings','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	

	$wp_customize->add_setting('vw_ecommerce_shop_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_ecommerce_shop_404_page_title',array(
		'label'	=> __('Add Title','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_ecommerce_shop_404_page_content',array(
		'label'	=> __('Add Text','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_404_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_ecommerce_shop_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	

	$wp_customize->add_setting('vw_ecommerce_shop_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_social_icon_width',array(
		'label'	=> __('Icon Width','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_social_icon_height',array(
		'label'	=> __('Icon Height','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_ecommerce_shop_responsive_media',array(
		'title'	=> __('Responsive Media','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_resp_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_resp_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_responsive_media'
    )));

	$wp_customize->add_setting( 'vw_ecommerce_shop_metabox_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_metabox_hide_show',array(
      'label' => esc_html__( 'Show / Hide Metabox','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_ecommerce_shop_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-ecommerce-shop' ),
      'section' => 'vw_ecommerce_shop_responsive_media'
    )));

    $wp_customize->add_setting('vw_ecommerce_shop_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_responsive_media',
		'setting'	=> 'vw_ecommerce_shop_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_ecommerce_shop_res_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_res_close_menu_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_responsive_media',
		'setting'	=> 'vw_ecommerce_shop_res_close_menu_icon',
		'type'		=> 'icon'
	)));

	//Footer Text
	$wp_customize->add_section('vw_ecommerce_shop_footer',array(
		'title'	=> __('Footer','vw-ecommerce-shop'),
		'description'=> __('This section will appear in the footer','vw-ecommerce-shop'),
		'panel' => 'vw_ecommerce_shop_panel_id',
	));	

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_footer_text', array( 
        'selector' => '.footer-2 .copyright p', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_footer_text', 
    ));
	
	$wp_customize->add_setting('vw_ecommerce_shop_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_ecommerce_shop_footer_text',array(
		'label'	=> __('Copyright Text','vw-ecommerce-shop'),
		'section'=> 'vw_ecommerce_shop_footer',
		'setting'=> 'vw_ecommerce_shop_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_ecommerce_shop_copyright_alingment',array(
        'default' => __('center','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_footer',
        'settings' => 'vw_ecommerce_shop_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_ecommerce_shop_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-ecommerce-shop' ),
      	'section' => 'vw_ecommerce_shop_footer'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_ecommerce_shop_scroll_top_icon', array( 
        'selector' => '.scrollup i', 
        'render_callback' => 'vw_ecommerce_shop_customize_partial_vw_ecommerce_shop_scroll_top_icon', 
    ));

    $wp_customize->add_setting('vw_ecommerce_shop_scroll_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Ecommerce_Shop_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_ecommerce_shop_scroll_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-ecommerce-shop'),
		'transport' => 'refresh',
		'section'	=> 'vw_ecommerce_shop_footer',
		'setting'	=> 'vw_ecommerce_shop_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_ecommerce_shop_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_ecommerce_shop_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_ecommerce_shop_scroll_top_alignment',array(
        'default' => __('Right','vw-ecommerce-shop'),
        'sanitize_callback' => 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Ecommerce_Shop_Image_Radio_Control($wp_customize, 'vw_ecommerce_shop_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-ecommerce-shop'),
        'section' => 'vw_ecommerce_shop_footer',
        'settings' => 'vw_ecommerce_shop_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/layout3.png'
    ))));

   //Woocommerce settings
	$wp_customize->add_section('vw_ecommerce_shop_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-ecommerce-shop'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	//Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_ecommerce_shop_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_woocommerce_section'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_ecommerce_shop_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_ecommerce_shop_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Ecommerce_Shop_Toggle_Switch_Custom_Control( $wp_customize, 'vw_ecommerce_shop_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-ecommerce-shop' ),
		'section' => 'vw_ecommerce_shop_woocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('vw_ecommerce_shop_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'vw_ecommerce_shop_sanitize_float'
	));
	$wp_customize->add_control('vw_ecommerce_shop_products_per_page',array(
		'label'	=> __('Products Per Page','vw-ecommerce-shop'),
		'description' => __('Display on shop page','vw-ecommerce-shop'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_ecommerce_shop_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_ecommerce_shop_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_ecommerce_shop_sanitize_choices'
	));
	$wp_customize->add_control('vw_ecommerce_shop_products_per_row',array(
		'label'	=> __('Products Per Row','vw-ecommerce-shop'),
		'description' => __('Display on shop page','vw-ecommerce-shop'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'vw_ecommerce_shop_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_ecommerce_shop_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_ecommerce_shop_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_ecommerce_shop_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-ecommerce-shop'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-ecommerce-shop'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-ecommerce-shop' ),
        ),
		'section'=> 'vw_ecommerce_shop_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_ecommerce_shop_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_ecommerce_shop_products_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_ecommerce_shop_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_ecommerce_shop_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-ecommerce-shop' ),
		'section'     => 'vw_ecommerce_shop_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Ecommerce_Shop_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Ecommerce_Shop_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_ecommerce_shop_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Ecommerce_Shop_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_ecommerce_shop_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Ecommerce_Shop_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_ecommerce_shop_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_ecommerce_shop_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_ecommerce_shop_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Ecommerce_Shop_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Ecommerce_Shop_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Ecommerce_Shop_Customize_Section_Pro($manager,'vw_ecommerce_shop_upgrade_pro_link', array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Ecommerce Pro', 'vw-ecommerce-shop' ),
			'pro_text' => esc_html__( 'Upgrade Pro','vw-ecommerce-shop' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/ecommerce-wordpress-theme/')
		)));

		// Register sections.
		$manager->add_section(new VW_Ecommerce_Shop_Customize_Section_Pro($manager,'vw_ecommerce_shop_get_started_link',array(
			'priority'   =>1,
			'title'    => esc_html__( 'Documentation', 'vw-ecommerce-shop' ),
			'pro_text' => esc_html__( 'Docs', 'vw-ecommerce-shop' ),
			'pro_url'  => esc_url( 'themes.php?page=vw_ecommerce_shop_guide')
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-ecommerce-shop-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-ecommerce-shop-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Ecommerce_Shop_Customize::get_instance();
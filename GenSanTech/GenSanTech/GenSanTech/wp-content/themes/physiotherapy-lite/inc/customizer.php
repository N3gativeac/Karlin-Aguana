<?php
/**
 * Physiotherapy Lite Theme Customizer
 *
 * @package Physiotherapy Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function physiotherapy_lite_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'physiotherapy_lite_custom_controls' );

function physiotherapy_lite_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'physiotherapy_lite_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'physiotherapy_lite_customize_partial_blogdescription', 
	));

	//add home page setting pannel
	$PhysiotherapyLiteParentPanel = new Physiotherapy_Lite_WP_Customize_Panel( $wp_customize, 'physiotherapy_lite_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'physiotherapy-lite' ),
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'physiotherapy_lite_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'physiotherapy-lite' ),
		'panel' => 'physiotherapy_lite_panel_id'
	) );

	$wp_customize->add_setting('physiotherapy_lite_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Physiotherapy_Lite_Image_Radio_Control($wp_customize, 'physiotherapy_lite_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','physiotherapy-lite'),
        'description' => __('Here you can change the width layout of Website.','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('physiotherapy_lite_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control('physiotherapy_lite_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','physiotherapy-lite'),
        'description' => __('Here you can change the sidebar layout for posts. ','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','physiotherapy-lite'),
            'Right Sidebar' => __('Right Sidebar','physiotherapy-lite'),
            'One Column' => __('One Column','physiotherapy-lite'),
            'Three Columns' => __('Three Columns','physiotherapy-lite'),
            'Four Columns' => __('Four Columns','physiotherapy-lite'),
            'Grid Layout' => __('Grid Layout','physiotherapy-lite')
        ),
	) );

	$wp_customize->add_setting('physiotherapy_lite_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control('physiotherapy_lite_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','physiotherapy-lite'),
        'description' => __('Here you can change the sidebar layout for pages. ','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','physiotherapy-lite'),
            'Right Sidebar' => __('Right Sidebar','physiotherapy-lite'),
            'One Column' => __('One Column','physiotherapy-lite')
        ),
	) );

	//Pre-Loader
	$wp_customize->add_setting( 'physiotherapy_lite_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','physiotherapy-lite' ),
        'section' => 'physiotherapy_lite_left_right'
    )));

	$wp_customize->add_setting('physiotherapy_lite_loader_icon',array(
        'default' => 'Two Way',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control('physiotherapy_lite_loader_icon',array(
        'type' => 'select',
        'label' => __('Pre-Loader Type','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_left_right',
        'choices' => array(
            'Two Way' => __('Two Way','physiotherapy-lite'),
            'Dots' => __('Dots','physiotherapy-lite'),
            'Rotate' => __('Rotate','physiotherapy-lite')
        ),
	) );

	//Top Bar
	$wp_customize->add_section( 'physiotherapy_lite_topbar', array(
    	'title'      => __( 'Top Bar Settings', 'physiotherapy-lite' ),
		'panel' => 'physiotherapy_lite_panel_id'
	) );

	$wp_customize->add_setting( 'physiotherapy_lite_topbar_hide_show',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_topbar_hide_show',array(
		'label' => esc_html__( 'Show / Hide Topbar','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_topbar'
    )));

    //Sticky Header
	$wp_customize->add_setting( 'physiotherapy_lite_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','physiotherapy-lite' ),
        'section' => 'physiotherapy_lite_topbar'
    )));

    $wp_customize->add_setting('physiotherapy_lite_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_header_cart',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_header_cart',array(
      	'label' => esc_html__( 'Show / Hide Cart','physiotherapy-lite' ),
      	'section' => 'physiotherapy_lite_topbar'
    )));
	
	$wp_customize->add_setting( 'physiotherapy_lite_header_search',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_header_search',array(
      	'label' => esc_html__( 'Show / Hide Search','physiotherapy-lite' ),
      	'section' => 'physiotherapy_lite_topbar'
    )));

    $wp_customize->add_setting('physiotherapy_lite_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_search_icon',array(
		'label'	=> __('Add Search Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_topbar',
		'setting'	=> 'physiotherapy_lite_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('physiotherapy_lite_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_topbar',
		'setting'	=> 'physiotherapy_lite_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('physiotherapy_lite_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_search_font_size',array(
		'label'	=> __('Search Font Size','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_search_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_search_padding_top_bottom',array(
		'label'	=> __('Search Padding Top Bottom','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_search_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_search_padding_left_right',array(
		'label'	=> __('Search Padding Left Right','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_search_border_radius', array(
		'default'              => "",
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_search_border_radius', array(
		'label'       => esc_html__( 'Search Border Radius','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_topbar',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('physiotherapy_lite_call', array( 
		'selector' => '.top-bar p', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_call', 
	));

    $wp_customize->add_setting('physiotherapy_lite_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_phone_icon',array(
		'label'	=> __('Add Phone Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_topbar',
		'setting'	=> 'physiotherapy_lite_phone_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('physiotherapy_lite_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'physiotherapy_lite_sanitize_phone_number'
	));
	$wp_customize->add_control('physiotherapy_lite_call',array(
		'label'	=> __('Add Phone Number','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '+00 1234 567 890', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_header_cart_icon',array(
		'default'	=> 'fas fa-shopping-basket',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_header_cart_icon',array(
		'label'	=> __('Add Cart Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_topbar',
		'setting'	=> 'physiotherapy_lite_header_cart_icon',
		'type'		=> 'icon'
	)));
    
	//Slider
	$wp_customize->add_section( 'physiotherapy_lite_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'physiotherapy-lite' ),
		'panel' => 'physiotherapy_lite_panel_id'
	) );

	$wp_customize->add_setting( 'physiotherapy_lite_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','physiotherapy-lite' ),
      	'section' => 'physiotherapy_lite_slidersettings'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('physiotherapy_lite_slider_arrows',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_slider_arrows',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'physiotherapy_lite_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'physiotherapy_lite_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'physiotherapy_lite_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'physiotherapy-lite' ),
			'description' => __('Slider image size (1600 x 600)','physiotherapy-lite'),
			'section'  => 'physiotherapy_lite_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('physiotherapy_lite_slider_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_slidersettings',
		'type'=> 'text'
	));

	//content layout
	$wp_customize->add_setting('physiotherapy_lite_slider_content_option',array(
        'default' => 'Center',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Physiotherapy_Lite_Image_Radio_Control($wp_customize, 'physiotherapy_lite_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'physiotherapy_lite_slider_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_slidersettings',
		'type'        => 'range',
		'settings'    => 'physiotherapy_lite_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('physiotherapy_lite_slider_opacity_color',array(
      'default'              => 0.3,
      'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));

	$wp_customize->add_control( 'physiotherapy_lite_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','physiotherapy-lite' ),
	'section'     => 'physiotherapy_lite_slidersettings',
	'type'        => 'select',
	'settings'    => 'physiotherapy_lite_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','physiotherapy-lite'),
      '0.1' =>  esc_attr('0.1','physiotherapy-lite'),
      '0.2' =>  esc_attr('0.2','physiotherapy-lite'),
      '0.3' =>  esc_attr('0.3','physiotherapy-lite'),
      '0.4' =>  esc_attr('0.4','physiotherapy-lite'),
      '0.5' =>  esc_attr('0.5','physiotherapy-lite'),
      '0.6' =>  esc_attr('0.6','physiotherapy-lite'),
      '0.7' =>  esc_attr('0.7','physiotherapy-lite'),
      '0.8' =>  esc_attr('0.8','physiotherapy-lite'),
      '0.9' =>  esc_attr('0.9','physiotherapy-lite')
	),
	));

	//Slider height
	$wp_customize->add_setting('physiotherapy_lite_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_slider_height',array(
		'label'	=> __('Slider Height','physiotherapy-lite'),
		'description'	=> __('Specify the slider height (px).','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_slidersettings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'physiotherapy_lite_sanitize_float'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','physiotherapy-lite'),
		'section' => 'physiotherapy_lite_slidersettings',
		'type'  => 'number',
	) );
 
	//Services
	$wp_customize->add_section('physiotherapy_lite_services',array(
		'title'	=> __('Services Section','physiotherapy-lite'),
		'panel' => 'physiotherapy_lite_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'physiotherapy_lite_section_text', array( 
		'selector' => '#physio-services h2', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_section_text',
	));

	$wp_customize->add_setting('physiotherapy_lite_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('physiotherapy_lite_section_text',array(
		'label'	=> __('Section Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Our Services', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_services',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('physiotherapy_lite_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('physiotherapy_lite_section_title',array(
		'label'	=> __('Section Title','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'OUR PHYSIOTHERAPY', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_services',
		'type'=> 'text'
	));	

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('physiotherapy_lite_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('physiotherapy_lite_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Latest Post','physiotherapy-lite'),
		'section' => 'physiotherapy_lite_services',
	));

	//Blog Post
	$wp_customize->add_panel( $PhysiotherapyLiteParentPanel );

	$BlogPostParentPanel = new Physiotherapy_Lite_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'physiotherapy-lite' ),
		'panel' => 'physiotherapy_lite_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'physiotherapy_lite_post_settings', array(
		'title' => __( 'Post Settings', 'physiotherapy-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('physiotherapy_lite_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_toggle_postdate', 
	));

	$wp_customize->add_setting( 'physiotherapy_lite_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','physiotherapy-lite' ),
        'section' => 'physiotherapy_lite_post_settings'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_toggle_author',array(
		'label' => esc_html__( 'Author','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_post_settings'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_toggle_comments',array(
		'label' => esc_html__( 'Comments','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_post_settings'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
	));
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_toggle_tags', array(
		'label' => esc_html__( 'Tags','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_post_settings'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_post_settings',
		'type'        => 'range',
		'settings'    => 'physiotherapy_lite_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('physiotherapy_lite_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
    ));
    $wp_customize->add_control(new Physiotherapy_Lite_Image_Radio_Control($wp_customize, 'physiotherapy_lite_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('physiotherapy_lite_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control('physiotherapy_lite_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_post_settings',
        'choices' => array(
        	'Content' => __('Content','physiotherapy-lite'),
            'Excerpt' => __('Excerpt','physiotherapy-lite'),
            'No Content' => __('No Content','physiotherapy-lite')
        ),
	) );

	$wp_customize->add_setting('physiotherapy_lite_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','physiotherapy-lite' ),
      'section' => 'physiotherapy_lite_post_settings'
    )));

	$wp_customize->add_setting( 'physiotherapy_lite_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'physiotherapy_lite_sanitize_choices'
    ));
    $wp_customize->add_control( 'physiotherapy_lite_blog_pagination_type', array(
        'section' => 'physiotherapy_lite_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'physiotherapy-lite' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'physiotherapy-lite' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'physiotherapy-lite' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'physiotherapy_lite_button_settings', array(
		'title' => __( 'Button Settings', 'physiotherapy-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting('physiotherapy_lite_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('physiotherapy_lite_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_button_text', 
	));

	$wp_customize->add_setting('physiotherapy_lite_button_text',array(
		'default'=> esc_html__( 'READ MORE', 'physiotherapy-lite' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_button_text',array(
		'label'	=> __('Add Button Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'physiotherapy_lite_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'physiotherapy-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('physiotherapy_lite_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_related_post_title', 
	));

    $wp_customize->add_setting( 'physiotherapy_lite_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_related_post',array(
		'label' => esc_html__( 'Related Post','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_related_posts_settings'
    )));

    $wp_customize->add_setting('physiotherapy_lite_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_related_post_title',array(
		'label'	=> __('Add Related Post Title','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('physiotherapy_lite_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'physiotherapy_lite_sanitize_float'
	));
	$wp_customize->add_control('physiotherapy_lite_related_posts_count',array(
		'label'	=> __('Add Related Post Count','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_related_posts_settings',
		'type'=> 'number'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'physiotherapy_lite_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'physiotherapy-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'physiotherapy_lite_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
	));
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Post Navigation','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('physiotherapy_lite_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_single_blog_settings',
		'type'=> 'text'
	));

    //404 Page Setting
	$wp_customize->add_section('physiotherapy_lite_404_page',array(
		'title'	=> __('404 Page Settings','physiotherapy-lite'),
		'panel' => 'physiotherapy_lite_panel_id',
	));	

	$wp_customize->add_setting('physiotherapy_lite_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('physiotherapy_lite_404_page_title',array(
		'label'	=> __('Add Title','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('physiotherapy_lite_404_page_content',array(
		'label'	=> __('Add Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_404_page_button_text',array(
		'label'	=> __('Add Button Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'GO BACK', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_404_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('physiotherapy_lite_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','physiotherapy-lite'),
		'panel' => 'physiotherapy_lite_panel_id',
	));	

	$wp_customize->add_setting('physiotherapy_lite_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_social_icon_padding',array(
		'label'	=> __('Icon Padding','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_social_icon_width',array(
		'label'	=> __('Icon Width','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_social_icon_height',array(
		'label'	=> __('Icon Height','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('physiotherapy_lite_responsive_media',array(
		'title'	=> __('Responsive Media','physiotherapy-lite'),
		'panel' => 'physiotherapy_lite_panel_id',
	));

	$wp_customize->add_setting( 'physiotherapy_lite_resp_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','physiotherapy-lite' ),
      'section' => 'physiotherapy_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','physiotherapy-lite' ),
      'section' => 'physiotherapy_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_resp_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','physiotherapy-lite' ),
      'section' => 'physiotherapy_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','physiotherapy-lite' ),
      'section' => 'physiotherapy_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'physiotherapy_lite_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','physiotherapy-lite' ),
      'section' => 'physiotherapy_lite_responsive_media'
    )));

    $wp_customize->add_setting('physiotherapy_lite_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_responsive_media',
		'setting'	=> 'physiotherapy_lite_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('physiotherapy_lite_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_responsive_media',
		'setting'	=> 'physiotherapy_lite_res_close_menus_icon',
		'type'		=> 'icon'
	)));

	//Footer Text
	$wp_customize->add_section('physiotherapy_lite_footer',array(
		'title'	=> __('Footer Settings','physiotherapy-lite'),
		'panel' => 'physiotherapy_lite_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('physiotherapy_lite_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_footer_text', 
	));
	
	$wp_customize->add_setting('physiotherapy_lite_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('physiotherapy_lite_footer_text',array(
		'label'	=> __('Copyright Text','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Physiotherapy_Lite_Image_Radio_Control($wp_customize, 'physiotherapy_lite_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_footer',
        'settings' => 'physiotherapy_lite_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting('physiotherapy_lite_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','physiotherapy-lite' ),
      	'section' => 'physiotherapy_lite_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('physiotherapy_lite_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'physiotherapy_lite_customize_partial_physiotherapy_lite_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('physiotherapy_lite_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Physiotherapy_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'physiotherapy_lite_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','physiotherapy-lite'),
		'transport' => 'refresh',
		'section'	=> 'physiotherapy_lite_footer',
		'setting'	=> 'physiotherapy_lite_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('physiotherapy_lite_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_scroll_to_top_width',array(
		'label'	=> __('Icon Width','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_scroll_to_top_height',array(
		'label'	=> __('Icon Height','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'physiotherapy_lite_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('physiotherapy_lite_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Physiotherapy_Lite_Image_Radio_Control($wp_customize, 'physiotherapy_lite_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','physiotherapy-lite'),
        'section' => 'physiotherapy_lite_footer',
        'settings' => 'physiotherapy_lite_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    //Woocommerce settings
	$wp_customize->add_section('physiotherapy_lite_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'physiotherapy-lite'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'physiotherapy_lite_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_woocommerce_section'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'physiotherapy_lite_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'physiotherapy_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Physiotherapy_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'physiotherapy_lite_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','physiotherapy-lite' ),
		'section' => 'physiotherapy_lite_woocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('physiotherapy_lite_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'physiotherapy_lite_sanitize_float'
	));
	$wp_customize->add_control('physiotherapy_lite_products_per_page',array(
		'label'	=> __('Products Per Page','physiotherapy-lite'),
		'description' => __('Display on shop page','physiotherapy-lite'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'physiotherapy_lite_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('physiotherapy_lite_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'physiotherapy_lite_sanitize_choices'
	));
	$wp_customize->add_control('physiotherapy_lite_products_per_row',array(
		'label'	=> __('Products Per Row','physiotherapy-lite'),
		'description' => __('Display on shop page','physiotherapy-lite'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'physiotherapy_lite_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('physiotherapy_lite_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('physiotherapy_lite_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('physiotherapy_lite_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','physiotherapy-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','physiotherapy-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'physiotherapy-lite' ),
        ),
		'section'=> 'physiotherapy_lite_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'physiotherapy_lite_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'physiotherapy_lite_products_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'physiotherapy_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'physiotherapy_lite_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','physiotherapy-lite' ),
		'section'     => 'physiotherapy_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    // Has to be at the top
	$wp_customize->register_panel_type( 'Physiotherapy_Lite_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Physiotherapy_Lite_WP_Customize_Section' );
}

add_action( 'customize_register', 'physiotherapy_lite_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Physiotherapy_Lite_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'physiotherapy_lite_panel';
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
  	class Physiotherapy_Lite_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'physiotherapy_lite_section';
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
function physiotherapy_lite_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'physiotherapy_lite_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Physiotherapy_Lite_Customize {

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
		$manager->register_section_type( 'Physiotherapy_Lite_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Physiotherapy_Lite_Customize_Section_Pro( $manager,'physiotherapy_lite_upgrade_pro_link', array(
			'priority'   => 1,
			'title'    => esc_html__( 'PHYSIOTHERAPY PRO', 'physiotherapy-lite' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'physiotherapy-lite' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/physiotherapy-wordpress-theme/'),
		) )	);

		$manager->add_section(new Physiotherapy_Lite_Customize_Section_Pro($manager,'physiotherapy_lite_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'physiotherapy-lite' ),
			'pro_text' => esc_html__( 'DOCS', 'physiotherapy-lite' ),
			'pro_url'  => admin_url('themes.php?page=physiotherapy_lite_guide'),
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

		wp_enqueue_script( 'physiotherapy-lite-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'physiotherapy-lite-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Physiotherapy_Lite_Customize::get_instance();
<?php
/**
 * Appointment Booking Theme Customizer
 *
 * @package Appointment Booking
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function appointment_booking_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'appointment_booking_custom_controls' );

function appointment_booking_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'appointment_booking_customize_partial_blogname',
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'appointment_booking_customize_partial_blogdescription',
	));

	//add home page setting pannel
	$appointment_booking_parent_panel = new Appointment_Booking_WP_Customize_Panel( $wp_customize, 'appointment_booking_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'appointment-booking' ),
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'appointment_booking_left_right', array(
    	'title' => esc_html__( 'General Settings', 'appointment-booking' ),
		'panel' => 'appointment_booking_panel_id'
	) );

	$wp_customize->add_setting('appointment_booking_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control(new Appointment_Booking_Image_Radio_Control($wp_customize, 'appointment_booking_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','appointment-booking'),
        'description' => esc_html__('Here you can change the width layout of Website.','appointment-booking'),
        'section' => 'appointment_booking_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('appointment_booking_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control('appointment_booking_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','appointment-booking'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','appointment-booking'),
        'section' => 'appointment_booking_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','appointment-booking'),
            'Right Sidebar' => esc_html__('Right Sidebar','appointment-booking'),
            'One Column' => esc_html__('One Column','appointment-booking'),
            'Three Columns' => esc_html__('Three Columns','appointment-booking'),
            'Four Columns' => esc_html__('Four Columns','appointment-booking'),
            'Grid Layout' => esc_html__('Grid Layout','appointment-booking')
        ),
	) );

	$wp_customize->add_setting('appointment_booking_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control('appointment_booking_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','appointment-booking'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','appointment-booking'),
        'section' => 'appointment_booking_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','appointment-booking'),
            'Right Sidebar' => esc_html__('Right Sidebar','appointment-booking'),
            'One Column' => esc_html__('One Column','appointment-booking')
        ),
	) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'appointment_booking_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','appointment-booking' ),
		'section' => 'appointment_booking_left_right'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'appointment_booking_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','appointment-booking' ),
		'section' => 'appointment_booking_left_right'
    )));

    //Pre-Loader
	$wp_customize->add_setting( 'appointment_booking_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','appointment-booking' ),
        'section' => 'appointment_booking_left_right'
    )));

	$wp_customize->add_setting('appointment_booking_loader_icon',array(
        'default' => 'Two Way',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control('appointment_booking_loader_icon',array(
        'type' => 'select',
        'label' => esc_html__('Pre-Loader Type','appointment-booking'),
        'section' => 'appointment_booking_left_right',
        'choices' => array(
            'Two Way' => esc_html__('Two Way','appointment-booking'),
            'Dots' => esc_html__('Dots','appointment-booking'),
            'Rotate' => esc_html__('Rotate','appointment-booking')
        ),
	) );

	//Top Header
	$wp_customize->add_section( 'appointment_booking_top_header' , array(
    	'title' => esc_html__( 'Top Header', 'appointment-booking' ),
		'panel' => 'appointment_booking_panel_id'
	) );

	$wp_customize->add_setting( 'appointment_booking_search_hide_show',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ));  
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_search_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Search','appointment-booking' ),
      	'section' => 'appointment_booking_top_header'
    )));

	$wp_customize->add_setting('appointment_booking_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'appointment_booking_sanitize_phone_number'
	));	
	$wp_customize->add_control('appointment_booking_phone_number',array(
		'label'	=> esc_html__('Phone Number','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '+00 123 456 7890', 'appointment-booking' ),
        ),
		'section'=> 'appointment_booking_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('appointment_booking_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('appointment_booking_email_address',array(
		'label'	=> esc_html__('Email Address','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'support@email.com', 'appointment-booking' ),
        ),
		'section'=> 'appointment_booking_top_header',
		'type'=> 'text'
	));
    
	//Slider
	$wp_customize->add_section( 'appointment_booking_slidersettings' , array(
    	'title' => esc_html__( 'Slider Settings', 'appointment-booking' ),
		'panel' => 'appointment_booking_panel_id'
	) );

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('appointment_booking_slider_arrows',array(
		'selector'        => '#slider .carousel-caption h1',
		'render_callback' => 'appointment_booking_customize_partial_appointment_booking_slider_arrows',
	));

	$wp_customize->add_setting( 'appointment_booking_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ));  
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','appointment-booking' ),
      	'section' => 'appointment_booking_slidersettings'
    )));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'appointment_booking_slider_page' . $count, array(
			'default'  => '',
			'sanitize_callback' => 'appointment_booking_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'appointment_booking_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'appointment-booking' ),
			'description' => esc_html__('Slider image size (500 x 500)','appointment-booking'),
			'section'  => 'appointment_booking_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//content layout
	$wp_customize->add_setting('appointment_booking_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control(new Appointment_Booking_Image_Radio_Control($wp_customize, 'appointment_booking_slider_content_option', array(
        'type' => 'select',
        'label' => esc_html__('Slider Content Layouts','appointment-booking'),
        'section' => 'appointment_booking_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'appointment_booking_slider_excerpt_number', array(
		'default'              => 25,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'appointment_booking_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'appointment_booking_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','appointment-booking' ),
		'section'     => 'appointment_booking_slidersettings',
		'type'        => 'range',
		'settings'    => 'appointment_booking_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );
 
	//Services
	$wp_customize->add_section('appointment_booking_services',array(
		'title'	=> __('Services Section','appointment-booking'),
		'panel' => 'appointment_booking_panel_id',
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

	$wp_customize->add_setting('appointment_booking_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'appointment_booking_sanitize_choices',
	));
	$wp_customize->add_control('appointment_booking_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Latest Post','appointment-booking'),		
		'section' => 'appointment_booking_services',
	));

	//About us
	$wp_customize->add_section('appointment_booking_about',array(
		'title'	=> __('About Section','appointment-booking'),
		'panel' => 'appointment_booking_panel_id',
	));

	$wp_customize->add_setting('appointment_booking_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('appointment_booking_section_text',array(
		'label'	=> __('Section Text','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => __( 'SERVICES','appointment-booking' ),
        ),
		'section'=> 'appointment_booking_about',
		'type'=> 'text'
	));

	$wp_customize->add_setting('appointment_booking_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('appointment_booking_section_title',array(
		'label'	=> __('Section Title','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => __( 'Lorem ipsum dolor sit amet,','appointment-booking' ),
        ),
		'section'=> 'appointment_booking_about',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'appointment_booking_about_section', array(
		'default'  => '',
		'sanitize_callback' => 'appointment_booking_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'appointment_booking_about_section', array(
		'label'    => esc_html__( 'Select About Page', 'appointment-booking' ),
		'section'  => 'appointment_booking_about',
		'type'     => 'dropdown-pages'
	) );

 	//About excerpt
	$wp_customize->add_setting( 'appointment_booking_about_excerpt_number', array(
		'default'              => 40,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'appointment_booking_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'appointment_booking_about_excerpt_number', array(
		'label'       => esc_html__( 'About Excerpt Length','appointment-booking' ),
		'section'     => 'appointment_booking_about',
		'type'        => 'range',
		'settings'    => 'appointment_booking_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog Post
	$wp_customize->add_panel( $appointment_booking_parent_panel );

	$BlogPostParentPanel = new Appointment_Booking_WP_Customize_Panel( $wp_customize, 'appointment_booking_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'appointment-booking' ),
		'panel' => 'appointment_booking_panel_id',
		'priority' => 20,
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'appointment_booking_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'appointment-booking' ),
		'panel' => 'appointment_booking_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('appointment_booking_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'appointment_booking_customize_partial_appointment_booking_toggle_postdate', 
	));

	$wp_customize->add_setting( 'appointment_booking_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','appointment-booking' ),
        'section' => 'appointment_booking_post_settings'
    )));

    $wp_customize->add_setting( 'appointment_booking_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_toggle_author',array(
		'label' => esc_html__( 'Author','appointment-booking' ),
		'section' => 'appointment_booking_post_settings'
    )));

    $wp_customize->add_setting( 'appointment_booking_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_toggle_comments',array(
		'label' => esc_html__( 'Comments','appointment-booking' ),
		'section' => 'appointment_booking_post_settings'
    )));

    $wp_customize->add_setting( 'appointment_booking_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_toggle_time',array(
		'label' => esc_html__( 'Time','appointment-booking' ),
		'section' => 'appointment_booking_post_settings'
    )));

    $wp_customize->add_setting( 'appointment_booking_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
	));
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_toggle_tags', array(
		'label' => esc_html__( 'Tags','appointment-booking' ),
		'section' => 'appointment_booking_post_settings'
    )));

    $wp_customize->add_setting( 'appointment_booking_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'appointment_booking_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'appointment_booking_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','appointment-booking' ),
		'section'     => 'appointment_booking_post_settings',
		'type'        => 'range',
		'settings'    => 'appointment_booking_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('appointment_booking_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
    ));
    $wp_customize->add_control(new Appointment_Booking_Image_Radio_Control($wp_customize, 'appointment_booking_blog_layout_option', array(
        'type' => 'select',
        'label' => esc_html__('Blog Layouts','appointment-booking'),
        'section' => 'appointment_booking_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('appointment_booking_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control('appointment_booking_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Post Content','appointment-booking'),
        'section' => 'appointment_booking_post_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','appointment-booking'),
            'Excerpt' => esc_html__('Excerpt','appointment-booking'),
            'No Content' => esc_html__('No Content','appointment-booking')
        ),
	) );

    // Button Settings
	$wp_customize->add_section( 'appointment_booking_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'appointment-booking' ),
		'panel' => 'appointment_booking_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'appointment_booking_button_border_radius', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'appointment_booking_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'appointment_booking_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','appointment-booking' ),
		'section'     => 'appointment_booking_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('appointment_booking_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'appointment_booking_customize_partial_appointment_booking_button_text', 
	));

    $wp_customize->add_setting('appointment_booking_button_text',array(
		'default'=> esc_html__('READ MORE','appointment-booking'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('appointment_booking_button_text',array(
		'label'	=> esc_html__('Add Button Text','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'READ MORE', 'appointment-booking' ),
        ),
		'section'=> 'appointment_booking_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'appointment_booking_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'appointment-booking' ),
		'panel' => 'appointment_booking_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('appointment_booking_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'appointment_booking_customize_partial_appointment_booking_related_post_title', 
	));

    $wp_customize->add_setting( 'appointment_booking_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ) );
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_related_post',array(
		'label' => esc_html__( 'Related Post','appointment-booking' ),
		'section' => 'appointment_booking_related_posts_settings'
    )));

    $wp_customize->add_setting('appointment_booking_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('appointment_booking_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'appointment-booking' ),
        ),
		'section'=> 'appointment_booking_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('appointment_booking_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('appointment_booking_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'appointment-booking' ),
        ),
		'section'=> 'appointment_booking_related_posts_settings',
		'type'=> 'number'
	));

	//Responsive Media Settings
	$wp_customize->add_section('appointment_booking_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','appointment-booking'),
		'panel' => 'appointment_booking_panel_id',
	));

    $wp_customize->add_setting( 'appointment_booking_resp_slider_hide_show',array(
      	'default' => 0,
     	'transport' => 'refresh',
      	'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ));  
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_resp_slider_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Slider','appointment-booking' ),
      	'section' => 'appointment_booking_responsive_media'
    )));

    $wp_customize->add_setting( 'appointment_booking_sidebar_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ));  
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_sidebar_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Sidebar','appointment-booking' ),
      	'section' => 'appointment_booking_responsive_media'
    )));

    $wp_customize->add_setting( 'appointment_booking_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ));  
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','appointment-booking' ),
      	'section' => 'appointment_booking_responsive_media'
    )));

	//Footer Text
	$wp_customize->add_section('appointment_booking_footer',array(
		'title'	=> esc_html__('Footer Settings','appointment-booking'),
		'panel' => 'appointment_booking_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('appointment_booking_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'appointment_booking_customize_partial_appointment_booking_footer_text', 
	));
	
	$wp_customize->add_setting('appointment_booking_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('appointment_booking_footer_text',array(
		'label'	=> esc_html__('Copyright Text','appointment-booking'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2020, .....', 'appointment-booking' ),
        ),
		'section'=> 'appointment_booking_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('appointment_booking_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control(new Appointment_Booking_Image_Radio_Control($wp_customize, 'appointment_booking_copyright_alingment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','appointment-booking'),
        'section' => 'appointment_booking_footer',
        'settings' => 'appointment_booking_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

	$wp_customize->add_setting( 'appointment_booking_footer_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'appointment_booking_switch_sanitization'
    ));  
    $wp_customize->add_control( new Appointment_Booking_Toggle_Switch_Custom_Control( $wp_customize, 'appointment_booking_footer_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','appointment-booking' ),
      	'section' => 'appointment_booking_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('appointment_booking_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'appointment_booking_customize_partial_appointment_booking_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('appointment_booking_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'appointment_booking_sanitize_choices'
	));
	$wp_customize->add_control(new Appointment_Booking_Image_Radio_Control($wp_customize, 'appointment_booking_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','appointment-booking'),
        'section' => 'appointment_booking_footer',
        'settings' => 'appointment_booking_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    // Has to be at the top
	$wp_customize->register_panel_type( 'Appointment_Booking_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Appointment_Booking_WP_Customize_Section' );
}

add_action( 'customize_register', 'appointment_booking_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Appointment_Booking_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'appointment_booking_panel';
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
  	class Appointment_Booking_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'appointment_booking_section';
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
function appointment_booking_customize_controls_scripts() {
	wp_enqueue_script( 'appointment-booking-customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'appointment_booking_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Appointment_Booking_Customize {

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
		$manager->register_section_type( 'Appointment_Booking_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Appointment_Booking_Customize_Section_Pro( $manager,'appointment_booking_upgrade_pro_link', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Appointment Booking', 'appointment-booking' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'appointment-booking' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/appointment-wordpress-theme/'),
		) )	);

		// Register sections.
		$manager->add_section(new Appointment_Booking_Customize_Section_Pro($manager,'appointment_booking_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'appointment-booking' ),
			'pro_text' => esc_html__( 'DOCS', 'appointment-booking' ),
			'pro_url'  => admin_url('themes.php?page=appointment_booking_guide'),
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

		wp_enqueue_script( 'appointment-booking-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'appointment-booking-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Appointment_Booking_Customize::get_instance();
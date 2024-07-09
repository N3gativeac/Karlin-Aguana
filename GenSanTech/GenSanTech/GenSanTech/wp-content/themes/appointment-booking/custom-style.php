<?php

	/*---------------------------First highlight color-------------------*/

	$appointment_booking_first_color = get_theme_mod('appointment_booking_first_color');

	$appointment_booking_custom_css= "";

	if($appointment_booking_first_color != false){
		$appointment_booking_custom_css .='.home-page-header, #footer-2, .scrollup i, #sidebar h3, #sidebar .tagcloud a:hover, .pagination span, .pagination a, .widget_product_search button, nav.woocommerce-MyAccount-navigation ul li, .toggle-nav i{';
			$appointment_booking_custom_css .='background-color: '.esc_html($appointment_booking_first_color).';';
		$appointment_booking_custom_css .='}';
	}

	if($appointment_booking_first_color != false){
		$appointment_booking_custom_css .='a, .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation a:hover, .main-navigation ul.sub-menu a:hover, .main-navigation ul.sub-menu>li>a:before, #footer .textwidget a,#footer li a:hover,.post-main-box:hover h3 a,#sidebar ul li a:hover,.post-navigation a:hover .post-title, .post-navigation a:focus .post-title,.post-navigation a:hover,.post-navigation a:focus, .woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price, .post-main-box:hover h2 a, .post-main-box:hover .post-info span a, .post-info:hover span a{';
			$appointment_booking_custom_css .='color: '.esc_html($appointment_booking_first_color).';';
		$appointment_booking_custom_css .='}';
	}

	if($appointment_booking_first_color != false){
		$appointment_booking_custom_css .='@media screen and (max-width: 1000px){
			.main-navigation a:hover{';
				$appointment_booking_custom_css .='color: '.esc_html($appointment_booking_first_color).'!important;';
		$appointment_booking_custom_css .='} }';
	}

	if($appointment_booking_first_color != false){
		$appointment_booking_custom_css .='#slider .carousel-caption h1,.heading-text hr{';
			$appointment_booking_custom_css .='border-color: '.esc_html($appointment_booking_first_color).';';
		$appointment_booking_custom_css .='}';
	}

	/*---------------- Second highlight color-------------------*/

	$appointment_booking_second_color = get_theme_mod('appointment_booking_second_color');

	if($appointment_booking_second_color != false){
		$appointment_booking_custom_css .='input[type="submit"], #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .more-btn a, #comments input[type="submit"], #comments a.comment-reply-link, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .wp-block-button__link{';
			$appointment_booking_custom_css .='background-color: '.esc_html($appointment_booking_second_color).';';
		$appointment_booking_custom_css .='}';
	}

	if($appointment_booking_second_color != false){
		$appointment_booking_custom_css .='.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .wp-block-button .wp-block-button__link:hover, .logo .site-title a:hover{
			color: '.esc_html($appointment_booking_second_color).';
		}';
	}


	/*---------------------------Width Layout -------------------*/

	$appointment_booking_theme_lay = get_theme_mod( 'appointment_booking_width_option','Full Width');
    if($appointment_booking_theme_lay == 'Boxed'){
		$appointment_booking_custom_css .='body{';
			$appointment_booking_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$appointment_booking_custom_css .='}';
		$appointment_booking_custom_css .='#slider .carousel-control-prev-icon{';
			$appointment_booking_custom_css .='border-width: 25px 163px 25px 0; top: 42px;';
		$appointment_booking_custom_css .='}';
		$appointment_booking_custom_css .='#slider .carousel-control-next-icon{';
			$appointment_booking_custom_css .='border-width: 25px 0 25px 170px; top: 42px;';
		$appointment_booking_custom_css .='}';
	}else if($appointment_booking_theme_lay == 'Wide Width'){
		$appointment_booking_custom_css .='body{';
			$appointment_booking_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$appointment_booking_custom_css .='}';
	}else if($appointment_booking_theme_lay == 'Full Width'){
		$appointment_booking_custom_css .='body{';
			$appointment_booking_custom_css .='max-width: 100%;';
		$appointment_booking_custom_css .='}';
	}

	/*--------------------------- Slider Content Layout -------------------*/

	$appointment_booking_slider_image = get_theme_mod('appointment_booking_slider_image');
	if($appointment_booking_slider_image != false){
		$appointment_booking_custom_css .='#slider{';
			$appointment_booking_custom_css .='background: url('.esc_url($appointment_booking_slider_image).');';
		$appointment_booking_custom_css .='}';
	}

	$appointment_booking_theme_lay = get_theme_mod( 'appointment_booking_slider_content_option','Left');
    if($appointment_booking_theme_lay == 'Left'){
		$appointment_booking_custom_css .='#slider .carousel-caption{';
			$appointment_booking_custom_css .='text-align:left; right: 40%;';
		$appointment_booking_custom_css .='}';
	}else if($appointment_booking_theme_lay == 'Center'){
		$appointment_booking_custom_css .='#slider .carousel-caption{';
			$appointment_booking_custom_css .='text-align:center; right: 25%; left: 25%;';
		$appointment_booking_custom_css .='}';
	}else if($appointment_booking_theme_lay == 'Right'){
		$appointment_booking_custom_css .='#slider .carousel-caption{';
			$appointment_booking_custom_css .='text-align:right; right: 10%; left: 40%;';
		$appointment_booking_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$appointment_booking_theme_lay = get_theme_mod( 'appointment_booking_blog_layout_option','Default');
    if($appointment_booking_theme_lay == 'Default'){
		$appointment_booking_custom_css .='.post-main-box{';
			$appointment_booking_custom_css .='';
		$appointment_booking_custom_css .='}';
	}else if($appointment_booking_theme_lay == 'Center'){
		$appointment_booking_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p{';
			$appointment_booking_custom_css .='text-align:center;';
		$appointment_booking_custom_css .='}';
		$appointment_booking_custom_css .='.post-info{';
			$appointment_booking_custom_css .='margin-top:10px;';
		$appointment_booking_custom_css .='}';
	}else if($appointment_booking_theme_lay == 'Left'){
		$appointment_booking_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, #our-services p{';
			$appointment_booking_custom_css .='text-align:Left;';
		$appointment_booking_custom_css .='}';
		$appointment_booking_custom_css .='.post-main-box h2{';
			$appointment_booking_custom_css .='margin-top:10px;';
		$appointment_booking_custom_css .='}';
	}

	/*----------------Responsive Media -----------------------*/

	$appointment_booking_resp_slider = get_theme_mod( 'appointment_booking_resp_slider_hide_show',false);
	if($appointment_booking_resp_slider == true && get_theme_mod( 'appointment_booking_slider_arrows', false) == false){
    	$appointment_booking_custom_css .='#slider{';
			$appointment_booking_custom_css .='display:none;';
		$appointment_booking_custom_css .='} ';
	}
    if($appointment_booking_resp_slider == true){
    	$appointment_booking_custom_css .='@media screen and (max-width:575px) {';
		$appointment_booking_custom_css .='#slider{';
			$appointment_booking_custom_css .='display:block;';
		$appointment_booking_custom_css .='} }';
	}else if($appointment_booking_resp_slider == false){
		$appointment_booking_custom_css .='@media screen and (max-width:575px) {';
		$appointment_booking_custom_css .='#slider{';
			$appointment_booking_custom_css .='display:none;';
		$appointment_booking_custom_css .='} }';
	}

	$appointment_booking_resp_sidebar = get_theme_mod( 'appointment_booking_sidebar_hide_show',true);
    if($appointment_booking_resp_sidebar == true){
    	$appointment_booking_custom_css .='@media screen and (max-width:575px) {';
		$appointment_booking_custom_css .='#sidebar{';
			$appointment_booking_custom_css .='display:block;';
		$appointment_booking_custom_css .='} }';
	}else if($appointment_booking_resp_sidebar == false){
		$appointment_booking_custom_css .='@media screen and (max-width:575px) {';
		$appointment_booking_custom_css .='#sidebar{';
			$appointment_booking_custom_css .='display:none;';
		$appointment_booking_custom_css .='} }';
	}

	$appointment_booking_resp_scroll_top = get_theme_mod( 'appointment_booking_resp_scroll_top_hide_show',true);
	if($appointment_booking_resp_scroll_top == true && get_theme_mod( 'appointment_booking_footer_scroll',true) != true){
    	$appointment_booking_custom_css .='.scrollup i{';
			$appointment_booking_custom_css .='visibility:hidden !important;';
		$appointment_booking_custom_css .='} ';
	}
    if($appointment_booking_resp_scroll_top == true){
    	$appointment_booking_custom_css .='@media screen and (max-width:575px) {';
		$appointment_booking_custom_css .='.scrollup i{';
			$appointment_booking_custom_css .='visibility:visible !important;';
		$appointment_booking_custom_css .='} }';
	}else if($appointment_booking_resp_scroll_top == false){
		$appointment_booking_custom_css .='@media screen and (max-width:575px){';
		$appointment_booking_custom_css .='.scrollup i{';
			$appointment_booking_custom_css .='visibility:hidden !important;';
		$appointment_booking_custom_css .='} }';
	}

	/*---------------- Button Settings ------------------*/

	$appointment_booking_button_border_radius = get_theme_mod('appointment_booking_button_border_radius');
	if($appointment_booking_button_border_radius != false){
		$appointment_booking_custom_css .='.post-main-box .more-btn a{';
			$appointment_booking_custom_css .='border-radius: '.esc_attr($appointment_booking_button_border_radius).'px;';
		$appointment_booking_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$appointment_booking_copyright_alingment = get_theme_mod('appointment_booking_copyright_alingment');
	if($appointment_booking_copyright_alingment != false){
		$appointment_booking_custom_css .='.copyright p{';
			$appointment_booking_custom_css .='text-align: '.esc_attr($appointment_booking_copyright_alingment).';';
		$appointment_booking_custom_css .='}';
	}
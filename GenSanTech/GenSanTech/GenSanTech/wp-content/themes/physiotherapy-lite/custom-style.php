<?php

	$physiotherapy_lite_first_color = get_theme_mod('physiotherapy_lite_first_color');

	$physiotherapy_lite_custom_css= "";

	/*------------------------------ Global First Color -----------*/
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='.more-btn a, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, p.sec-text::before, p.sec-text::after, input[type="submit"], #footer .tagcloud a:hover, #footer-2, .scrollup i, #sidebar h3, .pagination span, .pagination a, #sidebar .tagcloud a:hover, #comments input[type="submit"], nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.widget_product_search button, .toggle-nav i, #comments a.comment-reply-link, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer a.custom_read_more, #sidebar a.custom_read_more, #footer .custom-social-icons i:hover, #sidebar .custom-social-icons i:hover, .woocommerce nav.woocommerce-pagination ul li a, .nav-previous a, .nav-next a, .wp-block-button__link{';
			$physiotherapy_lite_custom_css .='background-color: '.esc_attr($physiotherapy_lite_first_color).';';
		$physiotherapy_lite_custom_css .='}';
	}
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='a, .middle-header .custom-social-icons i:hover, #physio-services h3 a:hover, #footer li a:hover, .post-main-box:hover h2 a, #sidebar ul li a:hover, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .main-navigation a:hover, .main-navigation ul.sub-menu a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, #footer .custom-social-icons i, #sidebar .custom-social-icons i, .post-main-box:hover h2 a, .post-main-box:hover .post-info a, .single-post .post-info:hover a, .top-bar p a:hover{';
			$physiotherapy_lite_custom_css .='color: '.esc_attr($physiotherapy_lite_first_color).';';
		$physiotherapy_lite_custom_css .='}';
	}	
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='#slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, #footer .tagcloud a:hover, .scrollup i, #sidebar .tagcloud a:hover, #footer .custom-social-icons i, #sidebar .custom-social-icons i, #footer .custom-social-icons i:hover, #sidebar .custom-social-icons i:hover{';
			$physiotherapy_lite_custom_css .='border-color: '.esc_attr($physiotherapy_lite_first_color).';';
		$physiotherapy_lite_custom_css .='}';
	}
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='.main-navigation ul ul{';
			$physiotherapy_lite_custom_css .='border-top-color: '.esc_attr($physiotherapy_lite_first_color).';';
		$physiotherapy_lite_custom_css .='}';
	}
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='.main-navigation ul ul, .header-fixed{';
			$physiotherapy_lite_custom_css .='border-bottom-color: '.esc_attr($physiotherapy_lite_first_color).';';
		$physiotherapy_lite_custom_css .='}';
	}
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .middle-header{
		background: linear-gradient(to right, '.esc_attr($physiotherapy_lite_first_color).' 0%, '.esc_attr($physiotherapy_lite_first_color).' 25%, transparent 21%, transparent 73%, '.esc_attr($physiotherapy_lite_first_color).' 65%, '.esc_attr($physiotherapy_lite_first_color).' 100%);
		}';
	}
	if($physiotherapy_lite_first_color != false){
		$physiotherapy_lite_custom_css .='.middle-header{
		background: linear-gradient(to right, '.esc_attr($physiotherapy_lite_first_color).' 0%, '.esc_attr($physiotherapy_lite_first_color).' 25%, #252f3b 21%, #252f3b 73%, '.esc_attr($physiotherapy_lite_first_color).' 65%, '.esc_attr($physiotherapy_lite_first_color).' 100%);
		}';
	}

	$physiotherapy_lite_custom_css .='@media screen and (max-width:1000px) {';
		if($physiotherapy_lite_first_color != false){
			$physiotherapy_lite_custom_css .='.page-template-custom-home-page .middle-header{';
				$physiotherapy_lite_custom_css .='background-color: '.esc_attr($physiotherapy_lite_first_color).';';
			$physiotherapy_lite_custom_css .='}';
		}
	$physiotherapy_lite_custom_css .='}';

	/*---------------------------Width Layout -------------------*/

	$physiotherapy_lite_theme_lay = get_theme_mod( 'physiotherapy_lite_width_option','Full Width');
    if($physiotherapy_lite_theme_lay == 'Boxed'){
		$physiotherapy_lite_custom_css .='body{';
			$physiotherapy_lite_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .middle-header{';
			$physiotherapy_lite_custom_css .='width: 97.3%';
		$physiotherapy_lite_custom_css .='}';
	}else if($physiotherapy_lite_theme_lay == 'Wide Width'){
		$physiotherapy_lite_custom_css .='body{';
			$physiotherapy_lite_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .middle-header{';
			$physiotherapy_lite_custom_css .='width: 97.7%';
		$physiotherapy_lite_custom_css .='}';
	}else if($physiotherapy_lite_theme_lay == 'Full Width'){
		$physiotherapy_lite_custom_css .='body{';
			$physiotherapy_lite_custom_css .='max-width: 100%;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$physiotherapy_lite_theme_lay = get_theme_mod( 'physiotherapy_lite_slider_opacity_color','0.3');
	if($physiotherapy_lite_theme_lay == '0'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.1'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.1';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.2'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.2';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.3'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.3';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.4'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.4';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.5'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.5';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.6'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.6';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.7'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.7';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.8'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.8';
		$physiotherapy_lite_custom_css .='}';
		}else if($physiotherapy_lite_theme_lay == '0.9'){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='opacity:0.9';
		$physiotherapy_lite_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$physiotherapy_lite_theme_lay = get_theme_mod( 'physiotherapy_lite_slider_content_option','Center');
    if($physiotherapy_lite_theme_lay == 'Left'){
		$physiotherapy_lite_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$physiotherapy_lite_custom_css .='text-align:left; left:15%; right:45%;';
		$physiotherapy_lite_custom_css .='}';
	}else if($physiotherapy_lite_theme_lay == 'Center'){
		$physiotherapy_lite_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$physiotherapy_lite_custom_css .='text-align:center; left:20%; right:20%;';
		$physiotherapy_lite_custom_css .='}';
	}else if($physiotherapy_lite_theme_lay == 'Right'){
		$physiotherapy_lite_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$physiotherapy_lite_custom_css .='text-align:right; left:45%; right:15%;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$physiotherapy_lite_slider_height = get_theme_mod('physiotherapy_lite_slider_height');
	if($physiotherapy_lite_slider_height != false){
		$physiotherapy_lite_custom_css .='#slider img{';
			$physiotherapy_lite_custom_css .='height: '.esc_attr($physiotherapy_lite_slider_height).';';
		$physiotherapy_lite_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$physiotherapy_lite_slider = get_theme_mod('physiotherapy_lite_slider_arrows');
	if($physiotherapy_lite_slider == false){
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .middle-header{';
			$physiotherapy_lite_custom_css .='position: static;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .middle-header{';
			$physiotherapy_lite_custom_css .='background: linear-gradient(to right, #4167f6 0%, #4167f6 25%, #252f3b 21%, #252f3b 73%, #4167f6 65%, #4167f6 100%);';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .home-page-header{';
			$physiotherapy_lite_custom_css .='margin-bottom: 10px;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.page-template-custom-home-page .menu-box{';
			$physiotherapy_lite_custom_css .='top: 70px;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$physiotherapy_lite_theme_lay = get_theme_mod( 'physiotherapy_lite_blog_layout_option','Default');
    if($physiotherapy_lite_theme_lay == 'Default'){
		$physiotherapy_lite_custom_css .='.post-main-box{';
			$physiotherapy_lite_custom_css .='';
		$physiotherapy_lite_custom_css .='}';
	}else if($physiotherapy_lite_theme_lay == 'Center'){
		$physiotherapy_lite_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .post-main-box .more-btn{';
			$physiotherapy_lite_custom_css .='text-align:center;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.post-info{';
			$physiotherapy_lite_custom_css .='margin-top:10px;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.post-info hr{';
			$physiotherapy_lite_custom_css .='margin:15px auto;';
		$physiotherapy_lite_custom_css .='}';
	}else if($physiotherapy_lite_theme_lay == 'Left'){
		$physiotherapy_lite_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .post-main-box .more-btn, #our-services p{';
			$physiotherapy_lite_custom_css .='text-align:Left;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.post-info hr{';
			$physiotherapy_lite_custom_css .='margin-bottom:10px;';
		$physiotherapy_lite_custom_css .='}';
		$physiotherapy_lite_custom_css .='.post-main-box h2{';
			$physiotherapy_lite_custom_css .='margin-top:10px;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$physiotherapy_lite_resp_topbar = get_theme_mod( 'physiotherapy_lite_resp_topbar_hide_show',false);
	if($physiotherapy_lite_resp_topbar == true && get_theme_mod( 'physiotherapy_lite_topbar_hide_show', false) == false){
    	$physiotherapy_lite_custom_css .='.top-bar{';
			$physiotherapy_lite_custom_css .='display:none;';
		$physiotherapy_lite_custom_css .='} ';
	}
    if($physiotherapy_lite_resp_topbar == true){
    	$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='.top-bar{';
			$physiotherapy_lite_custom_css .='display:block;';
		$physiotherapy_lite_custom_css .='} }';
	}else if($physiotherapy_lite_resp_topbar == false){
		$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='.top-bar{';
			$physiotherapy_lite_custom_css .='display:none;';
		$physiotherapy_lite_custom_css .='} }';
	}

	$physiotherapy_lite_resp_stickyheader = get_theme_mod( 'physiotherapy_lite_stickyheader_hide_show',false);
	if($physiotherapy_lite_resp_stickyheader == true && get_theme_mod( 'physiotherapy_lite_sticky_header',false) != true){
    	$physiotherapy_lite_custom_css .='.header-fixed{';
			$physiotherapy_lite_custom_css .='position:static;';
		$physiotherapy_lite_custom_css .='} ';
	}
    if($physiotherapy_lite_resp_stickyheader == true){
    	$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='.header-fixed{';
			$physiotherapy_lite_custom_css .='position:fixed;';
		$physiotherapy_lite_custom_css .='} }';
	}else if($physiotherapy_lite_resp_stickyheader == false){
		$physiotherapy_lite_custom_css .='@media screen and (max-width:575px){';
		$physiotherapy_lite_custom_css .='.header-fixed{';
			$physiotherapy_lite_custom_css .='position:static;';
		$physiotherapy_lite_custom_css .='} }';
	}

	$physiotherapy_lite_resp_slider = get_theme_mod( 'physiotherapy_lite_resp_slider_hide_show',false);
	if($physiotherapy_lite_resp_slider == true && get_theme_mod( 'physiotherapy_lite_slider_arrows', false) == false){
    	$physiotherapy_lite_custom_css .='#slider{';
			$physiotherapy_lite_custom_css .='display:none;';
		$physiotherapy_lite_custom_css .='} ';
	}
    if($physiotherapy_lite_resp_slider == true){
    	$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='#slider{';
			$physiotherapy_lite_custom_css .='display:block;';
		$physiotherapy_lite_custom_css .='} }';
	}else if($physiotherapy_lite_resp_slider == false){
		$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='#slider{';
			$physiotherapy_lite_custom_css .='display:none;';
		$physiotherapy_lite_custom_css .='} }';
	}

	$physiotherapy_lite_resp_sidebar = get_theme_mod( 'physiotherapy_lite_sidebar_hide_show',true);
    if($physiotherapy_lite_resp_sidebar == true){
    	$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='#sidebar{';
			$physiotherapy_lite_custom_css .='display:block;';
		$physiotherapy_lite_custom_css .='} }';
	}else if($physiotherapy_lite_resp_sidebar == false){
		$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='#sidebar{';
			$physiotherapy_lite_custom_css .='display:none;';
		$physiotherapy_lite_custom_css .='} }';
	}

	$physiotherapy_lite_resp_scroll_top = get_theme_mod( 'physiotherapy_lite_resp_scroll_top_hide_show',true);
	if($physiotherapy_lite_resp_scroll_top == true && get_theme_mod( 'physiotherapy_lite_hide_show_scroll',true) != true){
    	$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='visibility:hidden !important;';
		$physiotherapy_lite_custom_css .='} ';
	}
    if($physiotherapy_lite_resp_scroll_top == true){
    	$physiotherapy_lite_custom_css .='@media screen and (max-width:575px) {';
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='visibility:visible !important;';
		$physiotherapy_lite_custom_css .='} }';
	}else if($physiotherapy_lite_resp_scroll_top == false){
		$physiotherapy_lite_custom_css .='@media screen and (max-width:575px){';
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='visibility:hidden !important;';
		$physiotherapy_lite_custom_css .='} }';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$physiotherapy_lite_sticky_header_padding = get_theme_mod('physiotherapy_lite_sticky_header_padding');
	if($physiotherapy_lite_sticky_header_padding != false){
		$physiotherapy_lite_custom_css .='.header-fixed{';
			$physiotherapy_lite_custom_css .='padding: '.esc_attr($physiotherapy_lite_sticky_header_padding).';';
		$physiotherapy_lite_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$physiotherapy_lite_search_padding_top_bottom = get_theme_mod('physiotherapy_lite_search_padding_top_bottom');
	$physiotherapy_lite_search_padding_left_right = get_theme_mod('physiotherapy_lite_search_padding_left_right');
	$physiotherapy_lite_search_font_size = get_theme_mod('physiotherapy_lite_search_font_size');
	$physiotherapy_lite_search_border_radius = get_theme_mod('physiotherapy_lite_search_border_radius');
	if($physiotherapy_lite_search_padding_top_bottom != false || $physiotherapy_lite_search_padding_left_right != false || $physiotherapy_lite_search_font_size != false || $physiotherapy_lite_search_border_radius != false){
		$physiotherapy_lite_custom_css .='.search-box i{';
			$physiotherapy_lite_custom_css .='padding-top: '.esc_attr($physiotherapy_lite_search_padding_top_bottom).'; padding-bottom: '.esc_attr($physiotherapy_lite_search_padding_top_bottom).';padding-left: '.esc_attr($physiotherapy_lite_search_padding_left_right).';padding-right: '.esc_attr($physiotherapy_lite_search_padding_left_right).';font-size: '.esc_attr($physiotherapy_lite_search_font_size).';border-radius: '.esc_attr($physiotherapy_lite_search_border_radius).'px;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$physiotherapy_lite_button_padding_top_bottom = get_theme_mod('physiotherapy_lite_button_padding_top_bottom');
	$physiotherapy_lite_button_padding_left_right = get_theme_mod('physiotherapy_lite_button_padding_left_right');
	if($physiotherapy_lite_button_padding_top_bottom != false || $physiotherapy_lite_button_padding_left_right != false){
		$physiotherapy_lite_custom_css .='.post-main-box .more-btn a{';
			$physiotherapy_lite_custom_css .='padding-top: '.esc_attr($physiotherapy_lite_button_padding_top_bottom).'; padding-bottom: '.esc_attr($physiotherapy_lite_button_padding_top_bottom).';padding-left: '.esc_attr($physiotherapy_lite_button_padding_left_right).';padding-right: '.esc_attr($physiotherapy_lite_button_padding_left_right).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_button_border_radius = get_theme_mod('physiotherapy_lite_button_border_radius');
	if($physiotherapy_lite_button_border_radius != false){
		$physiotherapy_lite_custom_css .='.post-main-box .more-btn a{';
			$physiotherapy_lite_custom_css .='border-radius: '.esc_attr($physiotherapy_lite_button_border_radius).'px;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$physiotherapy_lite_single_blog_post_navigation_show_hide = get_theme_mod('physiotherapy_lite_single_blog_post_navigation_show_hide',true);
	if($physiotherapy_lite_single_blog_post_navigation_show_hide != true){
		$physiotherapy_lite_custom_css .='.post-navigation{';
			$physiotherapy_lite_custom_css .='display: none;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$physiotherapy_lite_copyright_alingment = get_theme_mod('physiotherapy_lite_copyright_alingment');
	if($physiotherapy_lite_copyright_alingment != false){
		$physiotherapy_lite_custom_css .='.copyright p{';
			$physiotherapy_lite_custom_css .='text-align: '.esc_attr($physiotherapy_lite_copyright_alingment).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_copyright_padding_top_bottom = get_theme_mod('physiotherapy_lite_copyright_padding_top_bottom');
	if($physiotherapy_lite_copyright_padding_top_bottom != false){
		$physiotherapy_lite_custom_css .='#footer-2{';
			$physiotherapy_lite_custom_css .='padding-top: '.esc_attr($physiotherapy_lite_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($physiotherapy_lite_copyright_padding_top_bottom).';';
		$physiotherapy_lite_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$physiotherapy_lite_scroll_to_top_font_size = get_theme_mod('physiotherapy_lite_scroll_to_top_font_size');
	if($physiotherapy_lite_scroll_to_top_font_size != false){
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='font-size: '.esc_attr($physiotherapy_lite_scroll_to_top_font_size).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_scroll_to_top_padding = get_theme_mod('physiotherapy_lite_scroll_to_top_padding');
	$physiotherapy_lite_scroll_to_top_padding = get_theme_mod('physiotherapy_lite_scroll_to_top_padding');
	if($physiotherapy_lite_scroll_to_top_padding != false){
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='padding-top: '.esc_attr($physiotherapy_lite_scroll_to_top_padding).';padding-bottom: '.esc_attr($physiotherapy_lite_scroll_to_top_padding).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_scroll_to_top_width = get_theme_mod('physiotherapy_lite_scroll_to_top_width');
	if($physiotherapy_lite_scroll_to_top_width != false){
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='width: '.esc_attr($physiotherapy_lite_scroll_to_top_width).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_scroll_to_top_height = get_theme_mod('physiotherapy_lite_scroll_to_top_height');
	if($physiotherapy_lite_scroll_to_top_height != false){
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='height: '.esc_attr($physiotherapy_lite_scroll_to_top_height).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_scroll_to_top_border_radius = get_theme_mod('physiotherapy_lite_scroll_to_top_border_radius');
	if($physiotherapy_lite_scroll_to_top_border_radius != false){
		$physiotherapy_lite_custom_css .='.scrollup i{';
			$physiotherapy_lite_custom_css .='border-radius: '.esc_attr($physiotherapy_lite_scroll_to_top_border_radius).'px;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$physiotherapy_lite_social_icon_font_size = get_theme_mod('physiotherapy_lite_social_icon_font_size');
	if($physiotherapy_lite_social_icon_font_size != false){
		$physiotherapy_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$physiotherapy_lite_custom_css .='font-size: '.esc_attr($physiotherapy_lite_social_icon_font_size).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_social_icon_padding = get_theme_mod('physiotherapy_lite_social_icon_padding');
	if($physiotherapy_lite_social_icon_padding != false){
		$physiotherapy_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$physiotherapy_lite_custom_css .='padding: '.esc_attr($physiotherapy_lite_social_icon_padding).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_social_icon_width = get_theme_mod('physiotherapy_lite_social_icon_width');
	if($physiotherapy_lite_social_icon_width != false){
		$physiotherapy_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$physiotherapy_lite_custom_css .='width: '.esc_attr($physiotherapy_lite_social_icon_width).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_social_icon_height = get_theme_mod('physiotherapy_lite_social_icon_height');
	if($physiotherapy_lite_social_icon_height != false){
		$physiotherapy_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$physiotherapy_lite_custom_css .='height: '.esc_attr($physiotherapy_lite_social_icon_height).';';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_social_icon_border_radius = get_theme_mod('physiotherapy_lite_social_icon_border_radius');
	if($physiotherapy_lite_social_icon_border_radius != false){
		$physiotherapy_lite_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$physiotherapy_lite_custom_css .='border-radius: '.esc_attr($physiotherapy_lite_social_icon_border_radius).'px;';
		$physiotherapy_lite_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$physiotherapy_lite_products_padding_top_bottom = get_theme_mod('physiotherapy_lite_products_padding_top_bottom');
	if($physiotherapy_lite_products_padding_top_bottom != false){
		$physiotherapy_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$physiotherapy_lite_custom_css .='padding-top: '.esc_attr($physiotherapy_lite_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($physiotherapy_lite_products_padding_top_bottom).'!important;';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_products_padding_left_right = get_theme_mod('physiotherapy_lite_products_padding_left_right');
	if($physiotherapy_lite_products_padding_left_right != false){
		$physiotherapy_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$physiotherapy_lite_custom_css .='padding-left: '.esc_attr($physiotherapy_lite_products_padding_left_right).'!important; padding-right: '.esc_attr($physiotherapy_lite_products_padding_left_right).'!important;';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_products_box_shadow = get_theme_mod('physiotherapy_lite_products_box_shadow');
	if($physiotherapy_lite_products_box_shadow != false){
		$physiotherapy_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$physiotherapy_lite_custom_css .='box-shadow: '.esc_attr($physiotherapy_lite_products_box_shadow).'px '.esc_attr($physiotherapy_lite_products_box_shadow).'px '.esc_attr($physiotherapy_lite_products_box_shadow).'px #ddd;';
		$physiotherapy_lite_custom_css .='}';
	}

	$physiotherapy_lite_products_border_radius = get_theme_mod('physiotherapy_lite_products_border_radius');
	if($physiotherapy_lite_products_border_radius != false){
		$physiotherapy_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$physiotherapy_lite_custom_css .='border-radius: '.esc_attr($physiotherapy_lite_products_border_radius).'px;';
		$physiotherapy_lite_custom_css .='}';
	}
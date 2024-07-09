<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_ecommerce_shop_first_color = get_theme_mod('vw_ecommerce_shop_first_color');

	$vw_ecommerce_shop_custom_css = '';

	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='.yearwrap,.side_search input[type="submit"], input[type="submit"], .scrollup i, .footer .custom-social-icons i:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce div.product form.cart .button:hover, .woocommerce #review_form #respond .form-submit input, .sidebar ul li::before, .sidebar .custom-social-icons i:hover, .date-monthwrap, .hvr-sweep-to-right:before, li.woocommerce-MyAccount-navigation-link.woocommerce-MyAccount-navigation-link, .woocommerce .cart .button, .woocommerce .cart input.button:hover, a.checkout-button.button.alt.wc-forward:hover, .woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button, .woocommerce-page .woocommerce-error .button, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button:hover, .pagination .current, .pagination a:hover, .sidebar input[type="submit"], .sidebar .tagcloud a:hover, .footer .tagcloud a:hover, #comments a.comment-reply-link, .toggle-nav i, .sidebar ul.cart_list li::before, .sidebar ul.product_list_widget li::before, .sidebar .widget_shopping_cart .buttons a, .sidebar.widget_shopping_cart .buttons a, .sidebar .widget_price_filter .price_slider_amount .button, .sidebar .widget_price_filter .ui-slider .ui-slider-range, .sidebar .widget_price_filter .ui-slider .ui-slider-handle, .sidebar .woocommerce-product-search button, .footer .widget_shopping_cart .buttons a, .footer.widget_shopping_cart .buttons a, .footer .widget_price_filter .price_slider_amount .button, .footer .woocommerce-product-search button, .sidebar a.custom_read_more:hover, .footer a.custom_read_more:hover, .nav-previous a:hover, .nav-next a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{';
			$vw_ecommerce_shop_custom_css .='background-color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$vw_ecommerce_shop_custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='.sidebar ul li::before, #comments input[type="submit"].submit, .sidebar ul.cart_list li::before, .sidebar ul.product_list_widget li::before{';
			$vw_ecommerce_shop_custom_css .='background-color: '.esc_html($vw_ecommerce_shop_first_color).'!important;';
		$vw_ecommerce_shop_custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='a, .header .logo h1 a, .top-contact i, .topbar .custom-social-icons i:hover, .header .main-navigation ul li a:hover, li.drp_dwn_menu a:hover, .slider .more-btn a, .footer h3, .sidebar h3, .sidebar .custom-social-icons i, .post-main-box h3, .blogbutton-small, h1.single-post-title, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .metabox i, .footer li a:hover, .sidebar li a:hover, a.button, .footer .textwidget p a, .entry-content a, .sidebar a.custom_read_more, .header .logo h1 a, .header .logo p.site-title a, .post-main-box .metabox:hover a, .single-post .metabox:hover a, .top-contact a:hover{';
			$vw_ecommerce_shop_custom_css .='color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$vw_ecommerce_shop_custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='.woocommerce a.remove{';
			$vw_ecommerce_shop_custom_css .='color: '.esc_html($vw_ecommerce_shop_first_color).'!important;';
		$vw_ecommerce_shop_custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='.blogbutton-small, .pagination span, .pagination a, .pagination .current, a.button, .sidebar a.custom_read_more, .sidebar a.custom_read_more:hover, .footer a.custom_read_more:hover, .footer .custom-social-icons i:hover, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span.current{';
			$vw_ecommerce_shop_custom_css .='border-color: '.esc_html($vw_ecommerce_shop_first_color).'!important;';
		$vw_ecommerce_shop_custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='.footer-2, .main-navigation ul ul{';
			$vw_ecommerce_shop_custom_css .='border-top-color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$vw_ecommerce_shop_custom_css .='}';
	}
	if($vw_ecommerce_shop_first_color != false){
		$vw_ecommerce_shop_custom_css .='.main-navigation ul ul{';
			$vw_ecommerce_shop_custom_css .='border-bottom-color: '.esc_html($vw_ecommerce_shop_first_color).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_ecommerce_shop_theme_lay = get_theme_mod( 'vw_ecommerce_shop_width_option','Full Width');
    if($vw_ecommerce_shop_theme_lay == 'Boxed'){
		$vw_ecommerce_shop_custom_css .='body{';
			$vw_ecommerce_shop_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_ecommerce_shop_custom_css .='}';
	}else if($vw_ecommerce_shop_theme_lay == 'Wide Width'){
		$vw_ecommerce_shop_custom_css .='body{';
			$vw_ecommerce_shop_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_ecommerce_shop_custom_css .='}';
	}else if($vw_ecommerce_shop_theme_lay == 'Full Width'){
		$vw_ecommerce_shop_custom_css .='body{';
			$vw_ecommerce_shop_custom_css .='max-width: 100%;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_ecommerce_shop_theme_lay = get_theme_mod( 'vw_ecommerce_shop_slider_opacity_color','0.5');
	if($vw_ecommerce_shop_theme_lay == '0'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.1'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.1';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.2'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.2';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.3'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.3';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.4'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.4';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.5'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.5';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.6'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.6';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.7'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.7';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.8'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.8';
		$vw_ecommerce_shop_custom_css .='}';
		}else if($vw_ecommerce_shop_theme_lay == '0.9'){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='opacity:0.9';
		$vw_ecommerce_shop_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_ecommerce_shop_theme_lay = get_theme_mod( 'vw_ecommerce_shop_slider_content_option','Left');
    if($vw_ecommerce_shop_theme_lay == 'Left'){
		$vw_ecommerce_shop_custom_css .='.slider .carousel-caption, .slider .inner_carousel, .slider .inner_carousel h1{';
			$vw_ecommerce_shop_custom_css .='text-align:left; left:18%; right:45%;';
		$vw_ecommerce_shop_custom_css .='}';
	}else if($vw_ecommerce_shop_theme_lay == 'Center'){
		$vw_ecommerce_shop_custom_css .='.slider .carousel-caption, .slider .inner_carousel, .slider .inner_carousel h1{';
			$vw_ecommerce_shop_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_ecommerce_shop_custom_css .='}';
	}else if($vw_ecommerce_shop_theme_lay == 'Right'){
		$vw_ecommerce_shop_custom_css .='.slider .carousel-caption, .slider .inner_carousel, .slider .inner_carousel h1{';
			$vw_ecommerce_shop_custom_css .='text-align:right; left:45%; right:18%;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_ecommerce_shop_slider_height = get_theme_mod('vw_ecommerce_shop_slider_height');
	if($vw_ecommerce_shop_slider_height != false){
		$vw_ecommerce_shop_custom_css .='.slider img{';
			$vw_ecommerce_shop_custom_css .='height: '.esc_html($vw_ecommerce_shop_slider_height).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$vw_ecommerce_shop_slider = get_theme_mod('vw_ecommerce_shop_slider_hide_show');
	if($vw_ecommerce_shop_slider == false){
		$vw_ecommerce_shop_custom_css .='.header{';
			$vw_ecommerce_shop_custom_css .='margin-top: 25px;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_ecommerce_shop_theme_lay = get_theme_mod( 'vw_ecommerce_shop_blog_layout_option','Default');
    if($vw_ecommerce_shop_theme_lay == 'Default'){
		$vw_ecommerce_shop_custom_css .='.post-main-box{';
			$vw_ecommerce_shop_custom_css .='';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.post-main-box h2{';
			$vw_ecommerce_shop_custom_css .='padding:0;';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.new-text p{';
			$vw_ecommerce_shop_custom_css .='margin-top:10px;';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.blogbutton-small{';
			$vw_ecommerce_shop_custom_css .='margin: 0; display: inline-block;';
		$vw_ecommerce_shop_custom_css .='}';
	}else if($vw_ecommerce_shop_theme_lay == 'Center'){
		$vw_ecommerce_shop_custom_css .='.post-main-box, .post-main-box h2, .new-text p, .metabox, .content-bttn{';
			$vw_ecommerce_shop_custom_css .='text-align:center;';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.new-text p{';
			$vw_ecommerce_shop_custom_css .='margin-top:0;';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.metabox{';
			$vw_ecommerce_shop_custom_css .='background: #eeeeee; padding: 10px; margin-bottom: 15px;';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.blogbutton-small{';
			$vw_ecommerce_shop_custom_css .='margin: 0; display: inline-block;';
		$vw_ecommerce_shop_custom_css .='}';
	}else if($vw_ecommerce_shop_theme_lay == 'Left'){
		$vw_ecommerce_shop_custom_css .='.post-main-box, .post-main-box h2, .new-text p, .content-bttn{';
			$vw_ecommerce_shop_custom_css .='text-align:Left;';
		$vw_ecommerce_shop_custom_css .='}';
		$vw_ecommerce_shop_custom_css .='.metabox{';
			$vw_ecommerce_shop_custom_css .='background: #eeeeee; padding: 10px; margin-bottom: 15px;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_ecommerce_shop_resp_topbar = get_theme_mod( 'vw_ecommerce_shop_resp_topbar_hide_show',false);
	if($vw_ecommerce_shop_resp_topbar == true && get_theme_mod( 'vw_ecommerce_shop_topbar_hide_show', false) == false){
    	$vw_ecommerce_shop_custom_css .='.topbar{';
			$vw_ecommerce_shop_custom_css .='display:none;';
		$vw_ecommerce_shop_custom_css .='} ';
	}
    if($vw_ecommerce_shop_resp_topbar == true){
    	$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.topbar{';
			$vw_ecommerce_shop_custom_css .='display:block;';
		$vw_ecommerce_shop_custom_css .='} }';
	}else if($vw_ecommerce_shop_resp_topbar == false){
		$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.topbar{';
			$vw_ecommerce_shop_custom_css .='display:none;';
		$vw_ecommerce_shop_custom_css .='} }';
	}

	$vw_ecommerce_shop_resp_stickyheader = get_theme_mod( 'vw_ecommerce_shop_stickyheader_hide_show',false);
	if($vw_ecommerce_shop_resp_stickyheader == true && get_theme_mod( 'vw_ecommerce_shop_sticky_header',false) != true){
    	$vw_ecommerce_shop_custom_css .='.header-fixed{';
			$vw_ecommerce_shop_custom_css .='position:static;';
		$vw_ecommerce_shop_custom_css .='} ';
	}
    if($vw_ecommerce_shop_resp_stickyheader == true){
    	$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.header-fixed{';
			$vw_ecommerce_shop_custom_css .='position:fixed;';
		$vw_ecommerce_shop_custom_css .='} }';
	}else if($vw_ecommerce_shop_resp_stickyheader == false){
		$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px){';
		$vw_ecommerce_shop_custom_css .='.header-fixed{';
			$vw_ecommerce_shop_custom_css .='position:static;';
		$vw_ecommerce_shop_custom_css .='} }';
	}

	$vw_ecommerce_shop_resp_slider = get_theme_mod( 'vw_ecommerce_shop_resp_slider_hide_show',false);
	if($vw_ecommerce_shop_resp_slider == true && get_theme_mod( 'vw_ecommerce_shop_slider_hide_show', false) == false){
    	$vw_ecommerce_shop_custom_css .='.slider{';
			$vw_ecommerce_shop_custom_css .='display:none;';
		$vw_ecommerce_shop_custom_css .='} ';
	}
    if($vw_ecommerce_shop_resp_slider == true){
    	$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.slider{';
			$vw_ecommerce_shop_custom_css .='display:block;';
		$vw_ecommerce_shop_custom_css .='} }';
	}else if($vw_ecommerce_shop_resp_slider == false){
		$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.slider{';
			$vw_ecommerce_shop_custom_css .='display:none;';
		$vw_ecommerce_shop_custom_css .='} }';
	}

	$vw_ecommerce_shop_resp_metabox = get_theme_mod( 'vw_ecommerce_shop_metabox_hide_show',true);
    if($vw_ecommerce_shop_resp_metabox == true){
    	$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.single-post .metabox, .datebox{';
			$vw_ecommerce_shop_custom_css .='display:block;';
		$vw_ecommerce_shop_custom_css .='} }';
	}else if($vw_ecommerce_shop_resp_metabox == false){
		$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.single-post .metabox, .datebox{';
			$vw_ecommerce_shop_custom_css .='display:none;';
		$vw_ecommerce_shop_custom_css .='} }';
	}

	$vw_ecommerce_shop_resp_sidebar = get_theme_mod( 'vw_ecommerce_shop_sidebar_hide_show',true);
    if($vw_ecommerce_shop_resp_sidebar == true){
    	$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.sidebar{';
			$vw_ecommerce_shop_custom_css .='display:block;';
		$vw_ecommerce_shop_custom_css .='} }';
	}else if($vw_ecommerce_shop_resp_sidebar == false){
		$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.sidebar{';
			$vw_ecommerce_shop_custom_css .='display:none;';
		$vw_ecommerce_shop_custom_css .='} }';
	}

	$vw_ecommerce_shop_resp_scroll_top = get_theme_mod( 'vw_ecommerce_shop_resp_scroll_top_hide_show',true);
	if($vw_ecommerce_shop_resp_scroll_top == true && get_theme_mod( 'vw_ecommerce_shop_hide_show_scroll',true) != true){
    	$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='visibility:hidden !important;';
		$vw_ecommerce_shop_custom_css .='} ';
	}
    if($vw_ecommerce_shop_resp_scroll_top == true){
    	$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px) {';
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='visibility:visible !important;';
		$vw_ecommerce_shop_custom_css .='} }';
	}else if($vw_ecommerce_shop_resp_scroll_top == false){
		$vw_ecommerce_shop_custom_css .='@media screen and (max-width:575px){';
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='visibility:hidden !important;';
		$vw_ecommerce_shop_custom_css .='} }';
	}

	/*------------- Top Bar Settings ------------------*/

	$vw_ecommerce_shop_topbar = get_theme_mod('vw_ecommerce_shop_topbar_hide_show');
	if($vw_ecommerce_shop_topbar == false){
		$vw_ecommerce_shop_custom_css .='.header{';
			$vw_ecommerce_shop_custom_css .='margin-top: 30px;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_topbar_padding_top_bottom = get_theme_mod('vw_ecommerce_shop_topbar_padding_top_bottom');
	if($vw_ecommerce_shop_topbar_padding_top_bottom != false){
		$vw_ecommerce_shop_custom_css .='.topbar{';
			$vw_ecommerce_shop_custom_css .='padding-top: '.esc_html($vw_ecommerce_shop_topbar_padding_top_bottom).'; padding-bottom: '.esc_html($vw_ecommerce_shop_topbar_padding_top_bottom).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_ecommerce_shop_sticky_header_padding = get_theme_mod('vw_ecommerce_shop_sticky_header_padding');
	if($vw_ecommerce_shop_sticky_header_padding != false){
		$vw_ecommerce_shop_custom_css .='.header-fixed{';
			$vw_ecommerce_shop_custom_css .='padding: '.esc_html($vw_ecommerce_shop_sticky_header_padding).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_ecommerce_shop_button_padding_top_bottom = get_theme_mod('vw_ecommerce_shop_button_padding_top_bottom');
	$vw_ecommerce_shop_button_padding_left_right = get_theme_mod('vw_ecommerce_shop_button_padding_left_right');
	if($vw_ecommerce_shop_button_padding_top_bottom != false || $vw_ecommerce_shop_button_padding_left_right != false){
		$vw_ecommerce_shop_custom_css .='.blogbutton-small{';
			$vw_ecommerce_shop_custom_css .='padding-top: '.esc_html($vw_ecommerce_shop_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_ecommerce_shop_button_padding_top_bottom).';padding-left: '.esc_html($vw_ecommerce_shop_button_padding_left_right).';padding-right: '.esc_html($vw_ecommerce_shop_button_padding_left_right).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_button_border_radius = get_theme_mod('vw_ecommerce_shop_button_border_radius');
	if($vw_ecommerce_shop_button_border_radius != false){
		$vw_ecommerce_shop_custom_css .='.blogbutton-small{';
			$vw_ecommerce_shop_custom_css .='border-radius: '.esc_html($vw_ecommerce_shop_button_border_radius).'px;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$vw_ecommerce_shop_single_blog_post_navigation_show_hide = get_theme_mod('vw_ecommerce_shop_single_blog_post_navigation_show_hide',true);
	if($vw_ecommerce_shop_single_blog_post_navigation_show_hide != true){
		$vw_ecommerce_shop_custom_css .='.post-navigation{';
			$vw_ecommerce_shop_custom_css .='display: none;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_ecommerce_shop_copyright_alingment = get_theme_mod('vw_ecommerce_shop_copyright_alingment');
	if($vw_ecommerce_shop_copyright_alingment != false){
		$vw_ecommerce_shop_custom_css .='.copyright p{';
			$vw_ecommerce_shop_custom_css .='text-align: '.esc_html($vw_ecommerce_shop_copyright_alingment).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_copyright_padding_top_bottom = get_theme_mod('vw_ecommerce_shop_copyright_padding_top_bottom');
	if($vw_ecommerce_shop_copyright_padding_top_bottom != false){
		$vw_ecommerce_shop_custom_css .='.footer-2{';
			$vw_ecommerce_shop_custom_css .='padding-top: '.esc_html($vw_ecommerce_shop_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_ecommerce_shop_copyright_padding_top_bottom).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_ecommerce_shop_scroll_to_top_font_size = get_theme_mod('vw_ecommerce_shop_scroll_to_top_font_size');
	if($vw_ecommerce_shop_scroll_to_top_font_size != false){
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='font-size: '.esc_html($vw_ecommerce_shop_scroll_to_top_font_size).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_scroll_to_top_padding = get_theme_mod('vw_ecommerce_shop_scroll_to_top_padding');
	$vw_ecommerce_shop_scroll_to_top_padding = get_theme_mod('vw_ecommerce_shop_scroll_to_top_padding');
	if($vw_ecommerce_shop_scroll_to_top_padding != false){
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='padding-top: '.esc_html($vw_ecommerce_shop_scroll_to_top_padding).';padding-bottom: '.esc_html($vw_ecommerce_shop_scroll_to_top_padding).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_scroll_to_top_width = get_theme_mod('vw_ecommerce_shop_scroll_to_top_width');
	if($vw_ecommerce_shop_scroll_to_top_width != false){
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='width: '.esc_html($vw_ecommerce_shop_scroll_to_top_width).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_scroll_to_top_height = get_theme_mod('vw_ecommerce_shop_scroll_to_top_height');
	if($vw_ecommerce_shop_scroll_to_top_height != false){
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='height: '.esc_html($vw_ecommerce_shop_scroll_to_top_height).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_scroll_to_top_border_radius = get_theme_mod('vw_ecommerce_shop_scroll_to_top_border_radius');
	if($vw_ecommerce_shop_scroll_to_top_border_radius != false){
		$vw_ecommerce_shop_custom_css .='.scrollup i{';
			$vw_ecommerce_shop_custom_css .='border-radius: '.esc_html($vw_ecommerce_shop_scroll_to_top_border_radius).'px;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_ecommerce_shop_social_icon_font_size = get_theme_mod('vw_ecommerce_shop_social_icon_font_size');
	if($vw_ecommerce_shop_social_icon_font_size != false){
		$vw_ecommerce_shop_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i, .topbar .custom-social-icons i{';
			$vw_ecommerce_shop_custom_css .='font-size: '.esc_html($vw_ecommerce_shop_social_icon_font_size).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_social_icon_padding = get_theme_mod('vw_ecommerce_shop_social_icon_padding');
	if($vw_ecommerce_shop_social_icon_padding != false){
		$vw_ecommerce_shop_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_ecommerce_shop_custom_css .='padding: '.esc_html($vw_ecommerce_shop_social_icon_padding).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_social_icon_width = get_theme_mod('vw_ecommerce_shop_social_icon_width');
	if($vw_ecommerce_shop_social_icon_width != false){
		$vw_ecommerce_shop_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_ecommerce_shop_custom_css .='width: '.esc_html($vw_ecommerce_shop_social_icon_width).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_social_icon_height = get_theme_mod('vw_ecommerce_shop_social_icon_height');
	if($vw_ecommerce_shop_social_icon_height != false){
		$vw_ecommerce_shop_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_ecommerce_shop_custom_css .='height: '.esc_html($vw_ecommerce_shop_social_icon_height).';';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_social_icon_border_radius = get_theme_mod('vw_ecommerce_shop_social_icon_border_radius');
	if($vw_ecommerce_shop_social_icon_border_radius != false){
		$vw_ecommerce_shop_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_ecommerce_shop_custom_css .='border-radius: '.esc_html($vw_ecommerce_shop_social_icon_border_radius).'px;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_ecommerce_shop_products_padding_top_bottom = get_theme_mod('vw_ecommerce_shop_products_padding_top_bottom');
	if($vw_ecommerce_shop_products_padding_top_bottom != false){
		$vw_ecommerce_shop_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_ecommerce_shop_custom_css .='padding-top: '.esc_html($vw_ecommerce_shop_products_padding_top_bottom).'!important; padding-bottom: '.esc_html($vw_ecommerce_shop_products_padding_top_bottom).'!important;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_products_padding_left_right = get_theme_mod('vw_ecommerce_shop_products_padding_left_right');
	if($vw_ecommerce_shop_products_padding_left_right != false){
		$vw_ecommerce_shop_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_ecommerce_shop_custom_css .='padding-left: '.esc_html($vw_ecommerce_shop_products_padding_left_right).'!important; padding-right: '.esc_html($vw_ecommerce_shop_products_padding_left_right).'!important;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_products_box_shadow = get_theme_mod('vw_ecommerce_shop_products_box_shadow');
	if($vw_ecommerce_shop_products_box_shadow != false){
		$vw_ecommerce_shop_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_ecommerce_shop_custom_css .='box-shadow: '.esc_html($vw_ecommerce_shop_products_box_shadow).'px '.esc_html($vw_ecommerce_shop_products_box_shadow).'px '.esc_html($vw_ecommerce_shop_products_box_shadow).'px #ddd;';
		$vw_ecommerce_shop_custom_css .='}';
	}

	$vw_ecommerce_shop_products_border_radius = get_theme_mod('vw_ecommerce_shop_products_border_radius');
	if($vw_ecommerce_shop_products_border_radius != false){
		$vw_ecommerce_shop_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_ecommerce_shop_custom_css .='border-radius: '.esc_html($vw_ecommerce_shop_products_border_radius).'px;';
		$vw_ecommerce_shop_custom_css .='}';
	}
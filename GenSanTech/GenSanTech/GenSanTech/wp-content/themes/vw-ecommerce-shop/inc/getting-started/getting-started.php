<?php
//about theme info
add_action( 'admin_menu', 'vw_ecommerce_shop_gettingstarted' );
function vw_ecommerce_shop_gettingstarted() {    	
	add_theme_page( esc_html__('About VW Ecommerce Theme', 'vw-ecommerce-shop'), esc_html__('About VW Ecommerce Theme', 'vw-ecommerce-shop'), 'edit_theme_options', 'vw_ecommerce_shop_guide', 'vw_ecommerce_shop_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function vw_ecommerce_shop_admin_theme_style() {
   wp_enqueue_style('vw-ecommerce-shop-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getting-started/getting-started.css');
   wp_enqueue_script('vw-ecommerce-shop-tabs', esc_url(get_template_directory_uri()) . '/inc/getting-started/js/tab.js');
   wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'vw_ecommerce_shop_admin_theme_style');

//guidline for about theme
function vw_ecommerce_shop_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'vw-ecommerce-shop' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to VW Ecommerce Theme', 'vw-ecommerce-shop' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','vw-ecommerce-shop'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy VW Eccomerce Shop at 20% Discount','vw-ecommerce-shop'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','vw-ecommerce-shop'); ?> ( <span><?php esc_html_e('vwpro20','vw-ecommerce-shop'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'vw-ecommerce-shop' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">
			<button class="tablinks" onclick="vw_ecommerce_shop_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'vw-ecommerce-shop' ); ?></button>
		  	<button class="tablinks" onclick="vw_ecommerce_shop_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'vw-ecommerce-shop' ); ?></button>
			<button class="tablinks" onclick="vw_ecommerce_shop_open_tab(event, 'pro_theme')"><?php esc_html_e( 'Get Premium', 'vw-ecommerce-shop' ); ?></button>
			<button class="tablinks" onclick="vw_ecommerce_shop_open_tab(event, 'free_pro')"><?php esc_html_e( 'Support', 'vw-ecommerce-shop' ); ?></button>
		</div>

		<div id="block_pattern" class="tabcontent open">
			<div class="block-pattern-img">
				<h3><?php esc_html_e( 'Block Patterns', 'vw-ecommerce-shop' ); ?></h3>
				<hr class="h3hr">
				<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','vw-ecommerce-shop'); ?></p>
	          	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','vw-ecommerce-shop'); ?></span></b></p>
	          	<div class="vw-ecommerce-shop-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>" target="_blank" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','vw-ecommerce-shop'); ?></a>
			    </div>
	          	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/block-pattern.png" alt="" />
	        </div>

	        <div class="block-pattern-link-customizer">
              	<div class="link-customizer-with-block-pattern">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-ecommerce-shop' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-ecommerce-shop'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','vw-ecommerce-shop'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-ecommerce-shop'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-ecommerce-shop'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-ecommerce-shop'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-ecommerce-shop'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-ecommerce-shop'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-ecommerce-shop'); ?></a>
								</div> 
							</div>
						</div>
				</div>	
			</div>	

		</div>
		
		<div id="lite_theme" class="tabcontent">
			<h3><?php esc_html_e( 'Lite Theme Information', 'vw-ecommerce-shop' ); ?></h3>
			<hr class="h3hr">
		  	<p><?php esc_html_e('VW E-commerce Shop theme is the one that can check all the boxes relating to every need of your store. Our multipurpose E-commerce WordPress theme is social media integrated & highly responsive. It is built on bootstrap 4 with using clean coding standards. It is cross-browser & woo commerce compatible, has Call to action button, its SEO & user-friendly and works at its optimal best across all platforms.  You may be a business owner, informative firm, travel agency, designing firm, artist, restaurant owner, construction agency, healthcare firm, digital marketing agency, blogger, corporate business, freelancers, online bookstore, mobile & tablet store, apparel store, fashion store, sport store, handbags store, cosmetics shop, jewellery store and etc. You can set all kinds of stores up with much ease using our theme, as it is made for people like you.  You could be a freelancer or a corporate entity or a sole proprietor. Our theme will boost your business and improve your revenue with the aid of seamless features and exclusive functionalities. Running an online E-commerce store along with your physical store is a hectic task. Your trouble is doubled, when you are not only supposed to take care of the physical presence of the store but you are also required to bring the online store up to speed. That is much like running two branches of a single business. You cannot possibly put your faith into sub-standard things and expect results. E-commerce store should have a theme that is both impressive and lucrative. This medium attracts customers from so many platforms that it becomes important for the theme and the webpage to perform at its 100% at all times.','vw-ecommerce-shop'); ?></p>
		  	<div class="col-left-inner">
		  		<h4><?php esc_html_e( 'Theme Documentation', 'vw-ecommerce-shop' ); ?></h4>
				<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-ecommerce-shop' ); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'vw-ecommerce-shop' ); ?></a>
				</div>
				<hr>
				<h4><?php esc_html_e('Theme Customizer', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'vw-ecommerce-shop'); ?></a>
				</div>
				<hr>				
				<h4><?php esc_html_e('Having Trouble, Need Support?', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'vw-ecommerce-shop'); ?></a>
				</div>
				<hr>
				<h4><?php esc_html_e('Reviews & Testimonials', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-ecommerce-shop'); ?>  </p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'vw-ecommerce-shop'); ?></a>
				</div>

			  	<div class="link-customizer">
					<h3><?php esc_html_e( 'Link to customizer', 'vw-ecommerce-shop' ); ?></h3>
					<hr class="h3hr">
					<div class="first-row">
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-ecommerce-shop'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-admin-customizer"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=vw_ecommerce_shop_typography') ); ?>" target="_blank"><?php esc_html_e('Typography','vw-ecommerce-shop'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Settings','vw-ecommerce-shop'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-products"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_products') ); ?>" target="_blank"><?php esc_html_e('Trending Products','vw-ecommerce-shop'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-ecommerce-shop'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-ecommerce-shop'); ?></a>
							</div>
						</div>

						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-ecommerce-shop'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-ecommerce-shop'); ?></a>
							</div> 
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-ecommerce-shop'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_ecommerce_shop_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-ecommerce-shop'); ?></a>
							</div>
						</div>
					</div>
				</div>
		  	</div>
			<div class="col-right-inner">
				<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','vw-ecommerce-shop'); ?></h3>
			  	<hr class="h3hr">
				<p><?php esc_html_e('Follow these instructions to setup Home page.','vw-ecommerce-shop'); ?></p>
                <ul>
                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','vw-ecommerce-shop'); ?></span><?php esc_html_e(' Go to ','vw-ecommerce-shop'); ?>
				  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','vw-ecommerce-shop'); ?></b></p>

                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','vw-ecommerce-shop'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/home-page-template.png" alt="" />
                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','vw-ecommerce-shop'); ?></span><?php esc_html_e(' Go to ','vw-ecommerce-shop'); ?>
				  	<b><?php esc_html_e(' Settings >> Reading ','vw-ecommerce-shop'); ?></b></p>
				  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','vw-ecommerce-shop'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/set-front-page.png" alt="" />
                  	<p><?php esc_html_e(' Once you are done with this, then follow the','vw-ecommerce-shop'); ?> <a class="doc-links" href="https://www.vwthemesdemo.com/docs/free-vw-ecommerce-lite/" target="_blank"><?php esc_html_e('Documentation','vw-ecommerce-shop'); ?></a></p>
                </ul>
		  	</div>
		</div>	

		<div id="pro_theme" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'vw-ecommerce-shop' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e(' E-commerce WordPress theme is for the people of the business world. Setting up a store is a tricky task and an online store requires suitable E-commerce WordPress theme. Not any theme is going to do the job, in the online world. You are needed to have not only a stunning website but you are also required to have a webpage that user-friendly & functional.Our Best woommerce theme is here to save you all from the miserable themes. We only provide you with the best product possible and we have never settled for anything lesser than that.','vw-ecommerce-shop'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-ecommerce-shop'); ?></a>
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'vw-ecommerce-shop'); ?></a>
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-ecommerce-shop'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/Ecommerce-Theme.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'vw-ecommerce-shop' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'vw-ecommerce-shop'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'vw-ecommerce-shop'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('12', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'vw-ecommerce-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'vw-ecommerce-shop'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'vw-ecommerce-shop'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'vw-ecommerce-shop'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'vw-ecommerce-shop'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'vw-ecommerce-shop'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','vw-ecommerce-shop'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'vw-ecommerce-shop'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'vw-ecommerce-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_ECOMMERCE_SHOP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'vw-ecommerce-shop'); ?></a>
				</div>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>
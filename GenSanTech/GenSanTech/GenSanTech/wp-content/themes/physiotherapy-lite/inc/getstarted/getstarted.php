<?php
//about theme info
add_action( 'admin_menu', 'physiotherapy_lite_gettingstarted' );
function physiotherapy_lite_gettingstarted() {    	
	add_theme_page( esc_html__('About Physiotherapy Lite', 'physiotherapy-lite'), esc_html__('About Physiotherapy Lite', 'physiotherapy-lite'), 'edit_theme_options', 'physiotherapy_lite_guide', 'physiotherapy_lite_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function physiotherapy_lite_admin_theme_style() {
   wp_enqueue_style('physiotherapy-lite-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstarted/getstarted.css');
   wp_enqueue_script('physiotherapy-lite-tabs', esc_url(get_template_directory_uri()) . '/inc/getstarted/js/tab.js');
   wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'physiotherapy_lite_admin_theme_style');

//guidline for about theme
function physiotherapy_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'physiotherapy-lite' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to Physiotherapy Theme', 'physiotherapy-lite' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','physiotherapy-lite'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy Physiotherapy Lite at 20% Discount','physiotherapy-lite'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','physiotherapy-lite'); ?> ( <span><?php esc_html_e('vwpro20','physiotherapy-lite'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'physiotherapy-lite' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">
			<button class="tablinks" onclick="physiotherapy_lite_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'physiotherapy-lite' ); ?></button>	
			<button class="tablinks" onclick="physiotherapy_lite_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'physiotherapy-lite' ); ?></button>
		  	<button class="tablinks" onclick="physiotherapy_lite_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'physiotherapy-lite' ); ?></button>
		  	<button class="tablinks" onclick="physiotherapy_lite_open_tab(event, 'pro_theme')"><?php esc_html_e( 'Get Premium', 'physiotherapy-lite' ); ?></button>
		  	<button class="tablinks" onclick="physiotherapy_lite_open_tab(event, 'lite_pro')"><?php esc_html_e( 'Support', 'physiotherapy-lite' ); ?></button>
		</div>

		<!-- Tab content -->
		<?php
			$physiotherapy_lite_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$physiotherapy_lite_plugin_custom_css ='display: block';
			}
		?>
		<div id="gutenberg_editor" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Physiotherapy_Lite_Plugin_Activation_Settings::get_instance();
			$physiotherapy_lite_actions = $plugin_ins->recommended_actions;
			?>
				<div class="physiotherapy-lite-recommended-plugins">
				    <div class="physiotherapy-lite-action-list">
				        <?php if ($physiotherapy_lite_actions): foreach ($physiotherapy_lite_actions as $key => $physiotherapy_lite_actionValue): ?>
				                <div class="physiotherapy-lite-action" id="<?php echo esc_attr($physiotherapy_lite_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($physiotherapy_lite_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($physiotherapy_lite_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($physiotherapy_lite_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'physiotherapy-lite' ); ?></h3>
				<hr class="h3hr">
				<div class="physiotherapy-lite-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','physiotherapy-lite'); ?></a>
			    </div>

			    <div class="link-customizer-with-guternberg-ibtana">
					<h3><?php esc_html_e( 'Link to customizer', 'physiotherapy-lite' ); ?></h3>
					<hr class="h3hr">
					<div class="first-row">
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','physiotherapy-lite'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','physiotherapy-lite'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','physiotherapy-lite'); ?></a>
							</div>
							
							<div class="row-box2">
								<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','physiotherapy-lite'); ?></a>
							</div>
						</div>

						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','physiotherapy-lite'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','physiotherapy-lite'); ?></a>
							</div> 
						</div>
						
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','physiotherapy-lite'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','physiotherapy-lite'); ?></a>
							</div> 
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div id="block_pattern" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Physiotherapy_Lite_Plugin_Activation_Settings::get_instance();
			$physiotherapy_lite_actions = $plugin_ins->recommended_actions;
			?>
				<div class="physiotherapy-lite-recommended-plugins">
				    <div class="physiotherapy-lite-action-list">
				        <?php if ($physiotherapy_lite_actions): foreach ($physiotherapy_lite_actions as $key => $physiotherapy_lite_actionValue): ?>
				                <div class="physiotherapy-lite-action" id="<?php echo esc_attr($physiotherapy_lite_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($physiotherapy_lite_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($physiotherapy_lite_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($physiotherapy_lite_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" href="javascript:void(0);" get-start-tab-id="gutenberg-editor-tab"><?php esc_html_e('Skip','physiotherapy-lite'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="gutenberg-editor-tab" style="<?php echo esc_attr($physiotherapy_lite_plugin_custom_css); ?>">
				<div class="block-pattern-img">
				  	<h3><?php esc_html_e( 'Block Patterns', 'physiotherapy-lite' ); ?></h3>
					<hr class="h3hr">
					<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','physiotherapy-lite'); ?></p>
	              	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','physiotherapy-lite'); ?></span></b></p>
	              	<div class="physiotherapy-lite-pattern-page">
				    	<a href="javascript:void(0)" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','physiotherapy-lite'); ?></a>
				    </div>
	              	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/block-pattern.png" alt="" />	
	            </div>

	            <div class="block-pattern-link-customizer">
	              	<div class="link-customizer-with-block-pattern">
							<h3><?php esc_html_e( 'Link to customizer', 'physiotherapy-lite' ); ?></h3>
							<hr class="h3hr">
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','physiotherapy-lite'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','physiotherapy-lite'); ?></a>
									</div>
								</div>
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','physiotherapy-lite'); ?></a>
									</div>
									
									<div class="row-box2">
										<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','physiotherapy-lite'); ?></a>
									</div>
								</div>

								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','physiotherapy-lite'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','physiotherapy-lite'); ?></a>
									</div> 
								</div>
								
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','physiotherapy-lite'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','physiotherapy-lite'); ?></a>
									</div> 
								</div>
							</div>
					</div>	
				</div>

	        </div>
		</div>

		<div id="lite_theme" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = Physiotherapy_Lite_Plugin_Activation_Settings::get_instance();
				$physiotherapy_lite_actions = $plugin_ins->recommended_actions;
				?>
				<div class="physiotherapy-lite-recommended-plugins">
				    <div class="physiotherapy-lite-action-list">
				        <?php if ($physiotherapy_lite_actions): foreach ($physiotherapy_lite_actions as $key => $physiotherapy_lite_actionValue): ?>
				                <div class="physiotherapy-lite-action" id="<?php echo esc_attr($physiotherapy_lite_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($physiotherapy_lite_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($physiotherapy_lite_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($physiotherapy_lite_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','physiotherapy-lite'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($physiotherapy_lite_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'physiotherapy-lite' ); ?></h3>
				<hr class="h3hr">
			  	<p><?php esc_html_e('Physiotherapy Lite is among the free WordPress themes available and is applicable for many areas like rehabilitation, chiropractor as well as the physical therapy because it is not only multipurpose but also minimal, elegant as well as sophisticated being both retina ready and user friendly. All these features make it good one for the therapy related services. Physiotherapy Lite has certain features at par with premium one in this category. Some important features with this free theme are complete responsiveness, page layouts and theme options apart being compatible with WooCommerce. This theme is well suited for making a website related to the private hospital or any sports therapy clinic or any kind of therapy related services. Some other features associated with this free WordPress theme for physiotherapy are doctors work schedule,  services [departments] and various other standard features. Being minimal and SEO friendly free theme, Physiotherapy Lite is well suited for the promotion of services and is good for the startup clinics operated by chiropractors and physiotherapists. Other features accompanied with Physiotherapy Lite WP theme are complete documentation, WordPress compatibility, third party plugin support as well as secure ad optimised code. It is good for making a website about physical therapy.','physiotherapy-lite'); ?></p>
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'physiotherapy-lite' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'physiotherapy-lite' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'physiotherapy-lite' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'physiotherapy-lite'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'physiotherapy-lite'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'physiotherapy-lite'); ?></a>
					</div>
					<hr>				
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'physiotherapy-lite'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'physiotherapy-lite'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'physiotherapy-lite'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'physiotherapy-lite'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'physiotherapy-lite'); ?>  </p>
					<div class="info-link">
						<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'physiotherapy-lite'); ?></a>
					</div>
			  		<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'physiotherapy-lite' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','physiotherapy-lite'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Settings','physiotherapy-lite'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-customizer"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_global_typography') ); ?>" target="_blank"><?php esc_html_e('Typography','physiotherapy-lite'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-editor-table"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_services') ); ?>" target="_blank"><?php esc_html_e('Services Section','physiotherapy-lite'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','physiotherapy-lite'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','physiotherapy-lite'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','physiotherapy-lite'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','physiotherapy-lite'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','physiotherapy-lite'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=physiotherapy_lite_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','physiotherapy-lite'); ?></a>
								</div>
							</div>
						</div>
					</div>
			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','physiotherapy-lite'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','physiotherapy-lite'); ?></p>
	                <ul>
	                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','physiotherapy-lite'); ?></span><?php esc_html_e(' Go to ','physiotherapy-lite'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','physiotherapy-lite'); ?></b></p>

	                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','physiotherapy-lite'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/home-page-template.png" alt="" />
	                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','physiotherapy-lite'); ?></span><?php esc_html_e(' Go to ','physiotherapy-lite'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','physiotherapy-lite'); ?></b></p>
					  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','physiotherapy-lite'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/set-front-page.png" alt="" />
	                  	<p><?php esc_html_e(' Once you are done with this, then follow the','physiotherapy-lite'); ?> <a class="doc-links" href="https://www.vwthemesdemo.com/docs/free-physiotherapy/" target="_blank"><?php esc_html_e('Documentation','physiotherapy-lite'); ?></a></p>
	                </ul>
			  	</div>
			</div>
		</div>	

		<div id="pro_theme" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'physiotherapy-lite' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('Physiotherapy WordPress theme is a premium category theme and is well suited for the physiotherapists as well as any other medical professional associated with wellness business. It is a much demandable theme for the medical clinic or the massage therapist or many other services related to therapy. Being minimal, elegant, sophisticated as well as retina ready, it is righty used for private clinic or any clinic used or the sports therapy. Premium physiotherapy WordPress theme has certain added features like work schedule of physiotherapist, appointments and testimonials and is globally in demand for the chiropractic practitioners. This premium level WP theme is accompanied with the testimonial section and is not only flexible but each layout can be installed with the help of custom support panel. WP physiotherapy premium theme is accompanied with the mobile friendly design and it also has the advanced custom fields feature.','physiotherapy-lite'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'physiotherapy-lite'); ?></a>
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'physiotherapy-lite'); ?></a>
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'physiotherapy-lite'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstarted/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'physiotherapy-lite' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'physiotherapy-lite'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'physiotherapy-lite'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><?php esc_html_e('15', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'physiotherapy-lite'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'physiotherapy-lite'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'physiotherapy-lite'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'physiotherapy-lite'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'physiotherapy-lite'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'physiotherapy-lite'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="lite_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'physiotherapy-lite'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'physiotherapy-lite'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'physiotherapy-lite'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'physiotherapy-lite'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'physiotherapy-lite'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'physiotherapy-lite'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'physiotherapy-lite'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'physiotherapy-lite'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'physiotherapy-lite'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'physiotherapy-lite'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'physiotherapy-lite'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','physiotherapy-lite'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'physiotherapy-lite'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'physiotherapy-lite'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( PHYSIOTHERAPY_LITE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'physiotherapy-lite'); ?></a>
				</div>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>
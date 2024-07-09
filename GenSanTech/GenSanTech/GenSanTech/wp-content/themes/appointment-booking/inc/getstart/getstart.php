<?php
//about theme info
add_action( 'admin_menu', 'appointment_booking_gettingstarted' );
function appointment_booking_gettingstarted() {    	
	add_theme_page( esc_html__('About Appointment Booking', 'appointment-booking'), esc_html__('About Appointment Booking', 'appointment-booking'), 'edit_theme_options', 'appointment_booking_guide', 'appointment_booking_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function appointment_booking_admin_theme_style() {
   wp_enqueue_style('appointment-booking-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
   wp_enqueue_script('appointment-booking-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
   wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'appointment_booking_admin_theme_style');


//guidline for about theme
function appointment_booking_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'appointment-booking' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to Appointment Booking Theme', 'appointment-booking' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','appointment-booking'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy Appointment Booking at 20% Discount','appointment-booking'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','appointment-booking'); ?> ( <span><?php esc_html_e('vwpro20','appointment-booking'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( APPOINTMENT_BOOKING_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'appointment-booking' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">
			<button class="tablinks" onclick="appointment_booking_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'appointment-booking' ); ?></button>
			<button class="tablinks" onclick="appointment_booking_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'appointment-booking' ); ?></button>
		  	<button class="tablinks" onclick="appointment_booking_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'appointment-booking' ); ?></button> 
		  	<button class="tablinks" onclick="appointment_booking_open_tab(event, 'theme_pro')"><?php esc_html_e( 'Get Premium', 'appointment-booking' ); ?></button>
		 	<button class="tablinks" onclick="appointment_booking_open_tab(event, 'free_pro')"><?php esc_html_e( 'Support', 'appointment-booking' ); ?></button>
		</div>

		<!-- Tab content -->
		<?php
			$appointment_booking_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$appointment_booking_plugin_custom_css ='display: block';
			}
		?>
		<div id="gutenberg_editor" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Appointment_Booking_Plugin_Activation_Settings::get_instance();
			$appointment_booking_actions = $plugin_ins->recommended_actions;
			?>
				<div class="appointment-booking-recommended-plugins">
				    <div class="appointment-booking-action-list">
				        <?php if ($appointment_booking_actions): foreach ($appointment_booking_actions as $key => $appointment_booking_actionValue): ?>
				                <div class="appointment-booking-action" id="<?php echo esc_attr($appointment_booking_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($appointment_booking_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($appointment_booking_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($appointment_booking_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'appointment-booking' ); ?></h3>
				<hr class="h3hr">
				<div class="appointment-booking-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','appointment-booking'); ?></a>
			    </div>

			    <div class="link-customizer-with-guternberg-ibtana">
						<h3><?php esc_html_e( 'Link to customizer', 'appointment-booking' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','appointment-booking'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','appointment-booking'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','appointment-booking'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','appointment-booking'); ?></a>
								</div>
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','appointment-booking'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','appointment-booking'); ?></a>
								</div> 
							</div>
						</div>
				</div>
			<?php } ?>
		</div>

		<div id="block_pattern" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Appointment_Booking_Plugin_Activation_Settings::get_instance();
			$appointment_booking_actions = $plugin_ins->recommended_actions;
			?>
				<div class="appointment-booking-recommended-plugins">
				    <div class="appointment-booking-action-list">
				        <?php if ($appointment_booking_actions): foreach ($appointment_booking_actions as $key => $appointment_booking_actionValue): ?>
				                <div class="appointment-booking-action" id="<?php echo esc_attr($appointment_booking_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($appointment_booking_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($appointment_booking_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($appointment_booking_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" href="javascript:void(0);" get-start-tab-id="gutenberg-editor-tab"><?php esc_html_e('Skip','appointment-booking'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="gutenberg-editor-tab" style="<?php echo esc_attr($appointment_booking_plugin_custom_css); ?>">
				<div class="block-pattern-img">
				  	<h3><?php esc_html_e( 'Block Patterns', 'appointment-booking' ); ?></h3>
					<hr class="h3hr">
					<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','appointment-booking'); ?></p>
	              	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','appointment-booking'); ?></span></b></p>
	              	<div class="appointment-booking-pattern-page">
				    	<a href="javascript:void(0)" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','appointment-booking'); ?></a>
				    </div>
	              	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/block-pattern.png" alt="" />
	            </div>	

              	<div class="block-pattern-link-customizer">
	              	<div class="link-customizer-with-block-pattern">
							<h3><?php esc_html_e( 'Link to customizer', 'appointment-booking' ); ?></h3>
							<hr class="h3hr">
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','appointment-booking'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','appointment-booking'); ?></a>
									</div>
								</div>
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','appointment-booking'); ?></a>
									</div>
									
									<div class="row-box2">
										<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','appointment-booking'); ?></a>
									</div>
								</div>
								
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','appointment-booking'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','appointment-booking'); ?></a>
									</div> 
								</div>
							</div>
					</div>
				</div>			
	        </div>
		</div>

		<div id="lite_theme" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = Appointment_Booking_Plugin_Activation_Settings::get_instance();
				$appointment_booking_actions = $plugin_ins->recommended_actions;
				?>
				<div class="appointment-booking-recommended-plugins">
				    <div class="appointment-booking-action-list">
				        <?php if ($appointment_booking_actions): foreach ($appointment_booking_actions as $key => $appointment_booking_actionValue): ?>
				                <div class="appointment-booking-action" id="<?php echo esc_attr($appointment_booking_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($appointment_booking_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($appointment_booking_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($appointment_booking_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','appointment-booking'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($appointment_booking_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'appointment-booking' ); ?></h3>
				<hr class="h3hr">
			  	<p><?php esc_html_e('Free Appointment WordPress Theme is a lightweight theme based on a bootstrap framework that facilitates you setting you an online appointment booking system for your hospitals, dental clinics, healthcare centers and any healthcare-related organization. The layout is simple yet elegant and will catch the attention of your target audience. With a retina-ready design, this theme is designed to scale perfectly on any screen no matter how small or big it is. This is possible due to the themes responsive design. It is user-friendly as it comes with a theme customizer with many useful customization options available. As a theme user, you can use these options for uploading the customized logo, changing the color scheme and font styles. As the developers of this theme have included clean and optimized codes in its core, it gives your website a great loading speed and improves its performance for delivering a splendid user experience.','appointment-booking'); ?></p>
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'appointment-booking' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'appointment-booking' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( APPOINTMENT_BOOKING_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'appointment-booking' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'appointment-booking'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'appointment-booking'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'appointment-booking'); ?></a>
					</div>
					<hr>				
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'appointment-booking'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'appointment-booking'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( APPOINTMENT_BOOKING_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'appointment-booking'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'appointment-booking'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'appointment-booking'); ?>  </p>
					<div class="info-link">
						<a href="<?php echo esc_url( APPOINTMENT_BOOKING_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'appointment-booking'); ?></a>
					</div>
			  		<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'appointment-booking' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','appointment-booking'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_top_header') ); ?>" target="_blank"><?php esc_html_e('Top Header','appointment-booking'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Section','appointment-booking'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','appointment-booking'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','appointment-booking'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-admin-customizer"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=appointment_booking_typography') ); ?>" target="_blank"><?php esc_html_e('Typography','appointment-booking'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=appointment_booking_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','appointment-booking'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','appointment-booking'); ?></a>
								</div> 
							</div>
						</div>
					</div>
			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','appointment-booking'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','appointment-booking'); ?></p>
	                <ul>
	                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','appointment-booking'); ?></span><?php esc_html_e(' Go to ','appointment-booking'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','appointment-booking'); ?></b></p>

	                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','appointment-booking'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
	                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','appointment-booking'); ?></span><?php esc_html_e(' Go to ','appointment-booking'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','appointment-booking'); ?></b></p>
					  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','appointment-booking'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
	                  	<p><?php esc_html_e(' Once you are done with this, then follow the','appointment-booking'); ?> <a class="doc-links" href="https://vwthemesdemo.com/docs/free-appointment-booking/" target="_blank"><?php esc_html_e('Documentation','appointment-booking'); ?></a></p>
	                </ul>
			  	</div>
			</div>
		</div>	

		<div id="theme_pro" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'appointment-booking' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('Appointment Booking WordPress Theme is designed by keeping the online appointment booking features to the core of it. You can easily create a website that allows you to build an online appointment booking site for your clinic, hospital, medical laboratory, pet and veterinary clinic and more. It is aesthetically designed with elegant colors and pictures truly depicting the purpose of your website. With a professionally crafted theme slider, you can attract the audience by showcasing the pictures of your health care center. There are slider settings provided for adjusting the slider timing, changing the pictures, and much more. WP Appointment WordPress Theme includes Call To Action (CTA) buttons that will not only guide the visitors but also help to improve the conversion rates of your website. Everything is well organized so that your visitors will be able to view all the details at a glance. With different sections included, it keeps your website sorted.','appointment-booking'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( APPOINTMENT_BOOKING_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'appointment-booking'); ?></a>
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'appointment-booking'); ?></a>
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'appointment-booking'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'appointment-booking' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'appointment-booking'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'appointment-booking'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'appointment-booking'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'appointment-booking'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'appointment-booking'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'appointment-booking'); ?></td>
								<td class="table-img"><?php esc_html_e('12', 'appointment-booking'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'appointment-booking'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'appointment-booking'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'appointment-booking'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'appointment-booking'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'appointment-booking'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'appointment-booking'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'appointment-booking'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( APPOINTMENT_BOOKING_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'appointment-booking'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'appointment-booking'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'appointment-booking'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'appointment-booking'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'appointment-booking'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'appointment-booking'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'appointment-booking'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'appointment-booking'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'appointment-booking'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'appointment-booking'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'appointment-booking'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'appointment-booking'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','appointment-booking'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'appointment-booking'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'appointment-booking'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( APPOINTMENT_BOOKING_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'appointment-booking'); ?></a>
				</div>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>
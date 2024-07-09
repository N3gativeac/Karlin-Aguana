<?php
/**
 * Displays header top bar
 *
 * @package Signify
 */

if ( ! get_theme_mod( 'signify_display_header_top' ) ) {
		// Bail if Header top is disabled.
	return;
}
?>

<div id="header-top" class="header-top-bar">
	<div class="wrapper">
		<div id="top-menu-wrapper" class="menu-wrapper">
			<button id="menu-toggle-top" class="menu-top-toggle menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<?php
				if ( $label = get_theme_mod( 'signify_header_top_menu_label', esc_html__( 'Top Bar', 'signify-ecommerce' ) ) ) : ?>
					<span class="header-top-label menu-label"><?php echo esc_html( $label ); ?></span>
				<?php endif; ?>
			</button>
			
			<div class="menu-inside-wrapper">
				<div id="site-header-top-menu" class="site-header-top-main">
					<div class="top-main-wrapper">
						<div class="header-top-left">
							<?php get_template_part( 'template-parts/header/contact-details', 'top' ); ?>
							
							<?php get_template_part( 'template-parts/navigation/navigation-header', 'top' ); ?>
						</div><!-- .header-top-left -->

						<div class="header-top-right">
							<?php get_template_part( 'template-parts/header/social', 'top' ); ?>

							<?php if ( get_theme_mod( 'signify_display_header_search' ) ) : ?>
							<div id="search-top-container" class="search-social-container">
					        	<div class="search-container">
					            	<?php get_search_form(); ?>
					            </div><!-- #search-container -->
							</div><!-- #search-top-container -->

							<div id="header-top-search-wrapper" class="menu-wrapper">
								<div class="menu-toggle-wrapper">
									<button id="header-top-social-search-toggle" class="menu-toggle search-toggle">
										<span class="menu-label screen-reader-text"><?php echo esc_html_e( 'Search', 'signify-ecommerce' ); ?></span>
									</button>
								</div><!-- .menu-toggle-wrapper -->

								<div class="menu-inside-wrapper">
									<div class="search-container">
										<?php get_Search_form(); ?>
									</div>
								</div><!-- .menu-inside-wrapper -->
							</div><!-- #social-search-wrapper.menu-wrapper -->
							<?php endif; ?>

							<?php
							if ( get_theme_mod( 'signify_header_top_display_cart_link' ) && function_exists( 'signify_cart_link' ) ) {
								signify_cart_link();
							}
							?>
						</div><!-- .header-top-right -->
					</div><!-- .top-main-wrapper -->

					
				</div><!-- .site-header-top-main -->
			</div><!-- .menu-inside-wrapper -->
		</div><!-- #top-menu-wrapper -->
		<div class="open-bar-wrapper">
				<?php if ( get_theme_mod( 'signify_display_header_search' ) ) : ?>
					<div id="header-top-open-bar-search-wrapper" class="menu-wrapper">
						<div class="menu-toggle-wrapper">
							<button id="header-top-open-bar-social-search-toggle" class="menu-toggle search-toggle">
								<span class="menu-label screen-reader-text"><?php echo esc_html_e( 'Search', 'signify-ecommerce' ); ?></span>
							</button>
						</div><!-- .menu-toggle-wrapper -->

						<div class="menu-inside-wrapper">
							<div class="search-container">
								<?php get_Search_form(); ?>
							</div>
						</div><!-- .menu-inside-wrapper -->
					</div><!-- #social-search-wrapper.menu-wrapper -->
					<?php endif; ?>

					<?php
					if ( get_theme_mod( 'signify_header_top_display_cart_link' ) && function_exists( 'signify_cart_link' ) ) {
						signify_cart_link();
					}
				?>
			</div><!-- .open-bar-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #header-top -->

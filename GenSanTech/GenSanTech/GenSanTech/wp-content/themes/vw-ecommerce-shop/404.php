<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Ecommerce Shop
 */

get_header(); ?>

<main id="maincontent" role="main" class="content-vw">
	<div class="container">
        <div class="page-content">
			<h1><?php echo esc_html(get_theme_mod('vw_ecommerce_shop_404_page_title',__('404 Not Found','vw-ecommerce-shop')));?></h1>
			<p class="text-404"><?php echo esc_html(get_theme_mod('vw_ecommerce_shop_404_page_content',__('Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.','vw-ecommerce-shop')));?></p>
			<?php if( get_theme_mod('vw_ecommerce_shop_404_page_button_text','Return to the home page') != ''){ ?>
				<div class="read-moresec">
	        		<a href="<?php echo esc_url(home_url()); ?>" class="button hvr-sweep-to-right"><?php echo esc_html(get_theme_mod('vw_ecommerce_shop_404_page_button_text',__('Return to the home page','vw-ecommerce-shop')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_ecommerce_shop_404_page_button_text',__('Return to the home page','vw-ecommerce-shop')));?></span></a>
				</div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</main>

<?php get_footer(); ?>
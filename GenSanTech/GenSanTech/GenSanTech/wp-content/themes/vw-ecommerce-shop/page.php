<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VW Ecommerce Shop
 */

get_header(); ?>

<?php do_action( 'vw_ecommerce_shop_page_top' ); ?>

<main id="maincontent" role="main" class="content-vw">
    <div class="middle-align container">       
		<?php $vw_ecommerce_shop_theme_lay = get_theme_mod( 'vw_ecommerce_shop_page_layout','One Column');
            if($vw_ecommerce_shop_theme_lay == 'One Column'){ ?>
                <?php while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content-page'); 
                endwhile; ?>
        <?php }else if($vw_ecommerce_shop_theme_lay == 'Right Sidebar'){ ?>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </div>
                </div>
            </div>
        <?php }else if($vw_ecommerce_shop_theme_lay == 'Left Sidebar'){ ?>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page');
                    endwhile; ?>
                </div>
            </div>
        <?php }else {?>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clear"></div>    
    </div>
</main>

<?php do_action( 'vw_ecommerce_shop_page_bottom' ); ?>

<?php get_footer(); ?>
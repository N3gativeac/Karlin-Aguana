<?php
/**
 * The template part for top header
 *
 * @package Physiotherapy Lite 
 * @subpackage physiotherapy-lite
 * @since physiotherapy-lite 1.0
 */
?>

<div class="middle-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <div class="logo">
          <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php endif; ?>
          <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( is_front_page() && is_home() ) : ?>
                <?php if( get_theme_mod('physiotherapy_lite_logo_title_hide_show',true) != ''){ ?>
                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php } ?>
              <?php else : ?>
                <?php if( get_theme_mod('physiotherapy_lite_logo_title_hide_show',true) != ''){ ?>
                  <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php } ?>
              <?php endif; ?>
            <?php endif; ?>
            <?php
              $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) :
            ?>
            <?php if( get_theme_mod('physiotherapy_lite_tagline_hide_show',true) != ''){ ?>
              <p class="site-description">
                <?php echo $description; ?>
              </p>
            <?php } ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <?php get_template_part('template-parts/header/top-header'); ?>        
      </div>
      <div class="col-lg-2 col-md-2 col-6">
        <?php if( get_theme_mod( 'physiotherapy_lite_header_cart',true) != '') { ?>
          <?php if(class_exists('woocommerce')){ ?>
            <div class="cart_no">
              <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','physiotherapy-lite' ); ?>"><i class="<?php echo esc_attr(get_theme_mod('physiotherapy_lite_header_cart_icon','fas fa-shopping-basket')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'shopping cart','physiotherapy-lite' );?></span></a>
              <span class="cart-value"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
            </div>
          <?php } ?>
        <?php }?>
      </div>
      <div class="col-lg-1 col-md-1 col-6">
        <?php if( get_theme_mod( 'physiotherapy_lite_header_search',true) != '') { ?>
          <div class="search-box">
            <span><a href="#"><i class="<?php echo esc_attr(get_theme_mod('physiotherapy_lite_search_icon','fas fa-search')); ?>"></i></a></span>
          </div>
        <?php }?>
        <div class="serach_outer">
          <div class="closepop"><a href="#maincontent"><i class="<?php echo esc_attr(get_theme_mod('physiotherapy_lite_search_close_icon','fa fa-window-close')); ?>"></i></a></div>
          <div class="serach_inner">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
      <div class="menu-box">
        <?php get_template_part('template-parts/header/navigation'); ?>
      </div>
    </div>
  </div>
</div>
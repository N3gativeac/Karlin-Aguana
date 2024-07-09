<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-vw">
 *
 * @package VW Ecommerce Shop
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) 
  {
    wp_body_open();
  }else{
    do_action('wp_body_open');
  } 
?>

<header role="banner">
  <a class="screen-reader-text skip-link" href="#maincontent"><?php esc_html_e( 'Skip to content', 'vw-ecommerce-shop' ); ?></a> 

  <?php if( get_theme_mod( 'vw_ecommerce_shop_topbar_hide_show', false) != '' || get_theme_mod( 'vw_ecommerce_shop_resp_topbar_hide_show', false) != '') { ?>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-12 ">
            <div class="row">
              <div class="top-contact col-lg-3 col-md-3">
                <?php if( get_theme_mod('vw_ecommerce_shop_shipping','') != ''){ ?>
                  <span class="free"><i class="<?php echo esc_attr(get_theme_mod('vw_ecommerce_shop_shipping_icon','fa fa-car')); ?>"></i><?php echo esc_html( get_theme_mod('vw_ecommerce_shop_shipping','') ); ?></span>
                <?php } ?>
              </div>
              <div class="top-contact col-lg-3 col-md-3">
                <?php if( get_theme_mod('vw_ecommerce_shop_return','') != ''){ ?>
                  <span class="return"><i class="<?php echo esc_attr(get_theme_mod('vw_ecommerce_shop_return_icon','fas fa-sync-alt')); ?>"></i><?php echo esc_html( get_theme_mod('vw_ecommerce_shop_return','') ); ?></span>
                <?php } ?>
              </div>
              <div class="top-contact col-lg-3 col-md-3">
                <?php if( get_theme_mod('vw_ecommerce_shop_cash','') != ''){ ?>
                  <span class="cash"><i class="<?php echo esc_attr(get_theme_mod('vw_ecommerce_shop_payment_icon','fas fa-dollar-sign')); ?>"></i><?php echo esc_html( get_theme_mod('vw_ecommerce_shop_cash','') ); ?></span>
                <?php } ?>
              </div>
              <div class="top-contact col-lg-3 col-md-3">
                <?php if( get_theme_mod( 'vw_ecommerce_shop_contact','' ) != '') { ?>
                  <span class="call"><i class="<?php echo esc_attr(get_theme_mod('vw_ecommerce_shop_phone_no_icon','fa fa-phone')); ?>"></i><a href="tel:<?php echo esc_url( get_theme_mod('vw_ecommerce_shop_contact','') ); ?>"><?php echo esc_html(get_theme_mod('vw_ecommerce_shop_contact',''));?></a></span>
                 <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <?php dynamic_sidebar( 'social-icon' ); ?>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  <?php }?>
  <div class="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="logo">
            <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <?php if( get_theme_mod('vw_ecommerce_shop_logo_title_hide_show',true) != ''){ ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php } ?>
                <?php else : ?>
                  <?php if( get_theme_mod('vw_ecommerce_shop_logo_title_hide_show',true) != ''){ ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                  <?php } ?>
                <?php endif; ?>
              <?php endif; ?>
              <?php
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) :
              ?>
              <?php if( get_theme_mod('vw_ecommerce_shop_tagline_hide_show',true) != ''){ ?>
                <p class="site-description">
                  <?php echo esc_html($description); ?>
                </p>
              <?php } ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="side_search col-lg-6 col-md-6">      
          <div class="search_form">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
    </div>    

    <div class="menubox <?php if( get_theme_mod( 'vw_ecommerce_shop_sticky_header', false) != '' || get_theme_mod( 'vw_ecommerce_shop_stickyheader_hide_show', false) != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
      <div class="container">
        <div class="row m-0">
            <div class="col-lg-3 col-md-3 cat-color">
            </div>
            <div class="col-lg-9 col-md-9">
              <?php if(has_nav_menu('primary')){ ?>
                <div class="toggle-nav mobile-menu">
                  <button onclick="vw_ecommerce_shop_menu_open_nav()" class="responsivetoggle"><i class="<?php echo esc_attr(get_theme_mod('vw_ecommerce_shop_res_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-ecommerce-shop'); ?></span></button>
                </div>
              <?php } ?>
              <div id="mySidenav" class="nav sidenav">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-ecommerce-shop' ); ?>">
                  <?php 
                    if(has_nav_menu('primary')){
                      wp_nav_menu( array( 
                        'theme_location' => 'primary',
                        'container_class' => 'main-menu clearfix' ,
                        'menu_class' => 'clearfix',
                        'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                        'fallback_cb' => 'wp_page_menu',
                      ) ); 
                    } 
                  ?>
                  <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_ecommerce_shop_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_ecommerce_shop_res_close_menu_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-ecommerce-shop'); ?></span></a>
                </nav>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <?php if ( is_singular() && has_post_thumbnail() ) : ?>
    <?php
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'vw-ecommerce-shop-post-image-cover' );
      $post_image = $thumb['0'];
    ?>
    <div class="header-image bg-image" style="background-image: url(<?php echo esc_url( $post_image ); ?>)">
      <?php the_post_thumbnail( 'vw-ecommerce-shop-post-image' ); ?>
    </div>

  <?php elseif ( get_header_image() ) : ?>
  <div class="header-image bg-image" style="background-image: url(<?php header_image(); ?>)">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
      <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" >
    </a>
  </div>
  <?php endif; // End header image check. ?>
</header>

<?php if(get_theme_mod('vw_ecommerce_shop_loader_enable',true)==1){ ?>
  <div id="preloader">
    <div id="status">
      <?php $vw_ecommerce_shop_theme_lay = get_theme_mod( 'vw_ecommerce_shop_loader_icon','Two Way');
        if($vw_ecommerce_shop_theme_lay == 'Two Way'){ ?>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/two-way.gif" alt="" role="img"/>
      <?php }else if($vw_ecommerce_shop_theme_lay == 'Dots'){ ?>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/dots.gif" alt="" role="img"/>
      <?php }else if($vw_ecommerce_shop_theme_lay == 'Rotate'){ ?>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/rotate.gif" alt="" role="img"/>          
      <?php } ?>
    </div>
  </div>
<?php } ?>
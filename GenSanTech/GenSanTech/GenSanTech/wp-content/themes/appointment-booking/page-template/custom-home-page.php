<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'appointment_booking_before_slider' ); ?>

  <?php if( get_theme_mod( 'appointment_booking_slider_arrows', false) != '' || get_theme_mod( 'appointment_booking_resp_slider_hide_show', false) != '') { ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <?php $appointment_booking_pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'appointment_booking_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $appointment_booking_pages[] = $mod;
            }
          }
          if( !empty($appointment_booking_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $appointment_booking_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php the_post_thumbnail(); ?>
              <div class="carousel-caption pt-0">
                <div class="inner_carousel">
                  <h1 class="mb-0 py-0 pl-3"><?php the_title(); ?></h1>
                  <p class="my-3"><?php $excerpt = get_the_excerpt(); echo esc_html( appointment_booking_string_limit_words( $excerpt, esc_attr(get_theme_mod('appointment_booking_slider_excerpt_number','25')))); ?></p>
                  <div class="more-btn mt-3 mb-3 mt-lg-5 mb-lg-5 mt-md-5 mb-md-5">
                    <a class="px-3 py-2 px-lg-4 py-lg-3 px-md-4 py-md-3" href="<?php the_permalink(); ?>"><?php esc_html_e('VIEW DETAILS','appointment-booking');?><span class="screen-reader-text"><?php esc_html_e('VIEW DETAILS','appointment-booking'); ?></span></a>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon px-2 py-1 px-lg-3 py-lg-2 px-md-3 py-md-2 rounded-circle" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e('Previous','appointment-booking'); ?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon px-2 py-1 px-lg-3 py-lg-2 px-md-3 py-md-2 rounded-circle" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e('Next','appointment-booking'); ?></span>
        </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php do_action( 'appointment_booking_after_slider' ); ?>

  <section id="services-sec" class="py-5">
    <div class="container">
      <div class="row">
        <div class="<?php if( get_theme_mod( 'appointment_booking_about_section',false) != ''){?> col-lg-6 col-md-6 <?php  } else{?> col-lg-12 col-md-12 <?php } ?>">
          <div class="row">
            <?php
            $appointment_booking_catData = get_theme_mod('appointment_booking_services_category');
            if($appointment_booking_catData){
              $page_query = new WP_Query(array( 'category_name' => esc_html( $appointment_booking_catData ,'appointment-booking')));
              $bgcolor = 1; ?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="col-lg-4 col-md-4">
                  <div class="inner-box p-3 mb-3 p-lg-3 mb-lg-3 p-md-2 mb-md-2 <?php echo('inner-box').$bgcolor ?>">
                    <?php the_post_thumbnail(); ?>
                    <h4 class="text-center"><a href="<?php the_permalink();?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h4>
                  </div>
                </div>
              <?php if($bgcolor >= 6){ $bgcolor = 0; } $bgcolor++; endwhile;
              wp_reset_postdata();
            } ?>
          </div>
        </div>
        <div class="<?php if( get_theme_mod( 'appointment_booking_services_category',false) != ''){?> col-lg-6 col-md-6 <?php  } else{?> col-lg-12 col-md-12 <?php } ?>">
          <div class="heading-text mb-4">
            <?php if( get_theme_mod( 'appointment_booking_section_text') != '') { ?>
              <strong><?php echo esc_html(get_theme_mod('appointment_booking_section_text',''));?></strong>
            <?php } ?>
            <?php if( get_theme_mod( 'appointment_booking_section_title') != '') { ?>
              <h2 ><?php echo esc_html(get_theme_mod('appointment_booking_section_title',''));?></h2>
              <hr class="m-0">
            <?php } ?>
          </div>
          <?php $appointment_booking_section = array();
            $mod = intval( get_theme_mod( 'appointment_booking_about_section'));
            if ( 'page-none-selected' != $mod ) {
              $appointment_booking_section[] = $mod;
            }
            if( !empty($appointment_booking_section) ) :
              $args = array(
                'post_type' => 'page',
                'post__in' => $appointment_booking_section,
                'orderby' => 'post__in'
              );
              $query = new WP_Query( $args );
              if ( $query->have_posts() ) :
          ?>
          <div class="about-inner">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="inner-section">
                <h3 class="mb-0"><?php the_title(); ?></h3>
                <p class="my-3"><?php $excerpt = get_the_excerpt(); echo esc_html( appointment_booking_string_limit_words( $excerpt, esc_attr(get_theme_mod('appointment_booking_about_excerpt_number','40')))); ?></p>
                <div class="more-btn mt-5 mb-5">
                  <a class="px-4 py-3 px-lg-4 py-lg-3 px-md-4 py-md-3" href="<?php the_permalink(); ?>"><?php esc_html_e('APPOINTMENT NOW','appointment-booking');?><span class="screen-reader-text"><?php esc_html_e('APPOINTMENT NOW','appointment-booking'); ?></span></a>
                </div>
              </div>
            <?php endwhile; 
            wp_reset_postdata();?>
          </div>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
          endif;?>
        </div>
      </div>
    </div>
  </section>

  <?php do_action( 'appointment_booking_after_service' ); ?>

  <div id="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
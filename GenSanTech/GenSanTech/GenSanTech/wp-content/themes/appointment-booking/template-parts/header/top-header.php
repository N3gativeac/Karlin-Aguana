<?php
/**
 * The template part for top header
 *
 * @package Appointment Booking
 * @subpackage appointment-booking
 * @since appointment-booking 1.0
 */
?>

<div class="top-bar text-center text-lg-left text-md-left">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4">
        <?php if( get_theme_mod('appointment_booking_email_address') != ''){ ?>
          <p class="py-2 py-lg-3 py-md-3 mb-0"><i class="fas fa-envelope-open mr-2"></i><a href="mailto:<?php echo esc_html(get_theme_mod('appointment_booking_email_address',''));?>"><?php echo esc_html(get_theme_mod('appointment_booking_email_address',''));?></a></p>
        <?php } ?>
      </div>
      <div class="col-lg-3 col-md-3">
        <?php if( get_theme_mod('appointment_booking_phone_number') != ''){ ?>
          <p class="py-2 py-lg-3 py-md-3 mb-0"><i class="fas fa-phone mr-2"></i><a href="tel:<?php echo esc_url( get_theme_mod('appointment_booking_phone_number','') ); ?>"><?php echo esc_html(get_theme_mod('appointment_booking_phone_number',''));?></a></p>
        <?php } ?>
      </div>
      <div class="col-lg-6 col-md-5">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-10 text-lg-right text-center py-0 py-lg-0">
            <?php dynamic_sidebar('social-links'); ?>
          </div>
          <div class="col-lg-2 col-md-2 col-2">
            <?php if( get_theme_mod( 'appointment_booking_search_hide_show',true) != '') { ?>
              <div class="search-box">
                <span><a href="#"><i class="fas fa-search"></i></a></span>
              </div>
            <?php }?>
          </div>
          <div class="serach_outer">
            <div class="closepop mr-5"><a href="#topbar"><i class="fa fa-window-close"></i></a></div>
            <div class="serach_inner">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
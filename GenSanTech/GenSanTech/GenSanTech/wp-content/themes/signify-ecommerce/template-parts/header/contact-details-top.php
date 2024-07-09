<?php
/**
 * Displays Contact Details on header top
 *
 * @package Signify
 */
?>

<?php
$date    = get_theme_mod( 'signify_display_date' );
$email   = get_theme_mod( 'signify_email' );
$address = get_theme_mod( 'signify_address' );
$phone   = get_theme_mod( 'signify_phone' );
$email_label = get_theme_mod( 'signify_email_label' );
$phone_label = get_theme_mod( 'signify_phone_label' );
$address_label = get_theme_mod( 'signify_address_label' );


if ( $date || $email  || $address || $phone ): ?>

	<ul class="contact-details">
		<?php if ( $date ) : ?>
		<li class="date"><i class="fa fa-calendar" aria-hidden="true"></i>
		<?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></li>
		<?php endif; ?>

		<?php if ( $email ) : ?>
		<li class="contact-email"><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><i class="fa fa-envelope" aria-hidden="true"></i>
		<?php if ( $email_label) : ?>
			<?php echo esc_html( $email_label ); ?>
		<?php endif; ?>	
		<?php echo esc_html( antispambot( $email ) ); ?></a></li>
		<?php endif; ?>

		<?php if ( $phone ) : ?>
		<li class="contact-phone"><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i>
		<?php if ( $phone_label) : ?>
			<?php echo esc_html( $phone_label ); ?>
		<?php endif; ?>	
		<?php echo esc_html( preg_replace( '/\s+/', '', $phone ) ); ?></a></li>
		<?php endif; ?>

		<?php if ( $address ) : ?>
		<li class="contact-address"><i class="fa fa-map-marker" aria-hidden="true"></i>
		<?php if ( $address_label) : ?>
			<?php echo esc_html( $address_label ); ?>
		<?php endif; ?>	
		<?php echo wp_kses_post( $address ); ?></li>
		<?php endif; ?>
	</ul><!-- .contact-details -->

<?php endif; ?>

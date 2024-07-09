<?php
/**
 * The template part for header
 *
 * @package Physiotherapy Lite 
 * @subpackage physiotherapy-lite
 * @since physiotherapy-lite 1.0
 */
?>
<?php if( get_theme_mod( 'physiotherapy_lite_topbar_hide_show', false) != '' || get_theme_mod( 'physiotherapy_lite_resp_topbar_hide_show', false) != '') { ?>
	<div class="top-bar">
		<div class="row">
			<div class="col-lg-6 col-md-12">
			    <?php if( get_theme_mod( 'physiotherapy_lite_call') != '') { ?>
	      			<p><i class="<?php echo esc_attr(get_theme_mod('physiotherapy_lite_phone_icon','fas fa-phone')); ?>"></i><a href="tel:<?php echo esc_url( get_theme_mod('physiotherapy_lite_call','') ); ?>"><?php echo esc_html(get_theme_mod('physiotherapy_lite_call',''));?></a></p>
				<?php } ?>
		    </div>
		    <div class="col-lg-6 col-md-12">
				<?php dynamic_sidebar('social-links'); ?>
		    </div>
		</div>
	</div>
<?php }?>
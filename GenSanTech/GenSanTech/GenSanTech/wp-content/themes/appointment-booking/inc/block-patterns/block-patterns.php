<?php
/**
 * Appointment Booking: Block Patterns
 *
 * @package Appointment Booking
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'appointment-booking',
		array( 'label' => __( 'Appointment Booking', 'appointment-booking' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'appointment-booking/banner-section',
		array(
			'title'      => __( 'Banner Section', 'appointment-booking' ),
			'categories' => array( 'appointment-booking' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":5336,\"dimRatio\":90,\"customGradient\":\"linear-gradient(90deg,rgb(238,238,238) 36%,rgba(0,114,163,0) 55%,rgba(228,234,236,0) 71%,rgba(0,114,163,0) 87%,rgba(168,183,194,0) 100%)\",\"align\":\"full\",\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover alignfull has-background-dim-90 has-background-dim has-background-gradient banner-section\" style=\"background-image:url(" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png)\"><span aria-hidden=\"true\" class=\"wp-block-cover__gradient-background\" style=\"background:linear-gradient(90deg,rgb(238,238,238) 36%,rgba(0,114,163,0) 55%,rgba(228,234,236,0) 71%,rgba(0,114,163,0) 87%,rgba(168,183,194,0) 100%)\"></span><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"full\"} -->\n<div class=\"wp-block-columns alignfull\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":1,\"style\":{\"color\":{\"text\":\"#252525\"}}} -->\n<h1 class=\"has-text-align-left has-text-color\" style=\"color:#252525\">LOREM IPSUM DOLOR SIT AMET</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"color\":{\"text\":\"#252525\"}}} -->\n<p class=\"has-text-align-left has-text-color\" style=\"color:#252525\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"style\":{\"color\":{\"background\":\"#ff5e6b\"}},\"className\":\"btn\"} -->\n<div class=\"wp-block-button btn\"><a class=\"wp-block-button__link has-background\" style=\"background-color:#ff5e6b\" rel=\"\">VIEW DETAILS</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'appointment-booking/services-section',
		array(
			'title'      => __( 'Services & About Section', 'appointment-booking' ),
			'categories' => array( 'appointment-booking' ),
			'content'    => "<!-- wp:cover {\"overlayColor\":\"white\",\"align\":\"wide\",\"className\":\"article-outer-box\"} -->\n<div class=\"wp-block-cover alignwide has-white-background-color has-background-dim article-outer-box\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"wide\"} -->\n<div class=\"wp-block-columns alignwide\"><!-- wp:column -->\n<div class=\"wp-block-column\"></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":5,\"style\":{\"color\":{\"text\":\"#a3a3a3\"}}} -->\n<h5 class=\"has-text-align-left has-text-color\" style=\"color:#a3a3a3\">SERVICES</h5>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"style\":{\"color\":{\"text\":\"#252525\"}}} -->\n<h2 class=\"has-text-align-left has-text-color\" style=\"color:#252525\">OUR WORKING AREA</h2>\n<!-- /wp:heading --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:columns {\"align\":\"wide\",\"className\":\"article-container\"} -->\n<div class=\"wp-block-columns alignwide article-container\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"customOverlayColor\":\"#71c1d3\",\"className\":\"article-section\"} -->\n<div class=\"wp-block-cover has-background-dim article-section\" style=\"background-color:#71c1d3\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5370,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services1.png\" alt=\"\" class=\"wp-image-5370\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\">SERVICE 1</h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"customOverlayColor\":\"#fa885c\",\"className\":\"article-section\"} -->\n<div class=\"wp-block-cover has-background-dim article-section\" style=\"background-color:#fa885c\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5372,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services2.png\" alt=\"\" class=\"wp-image-5372\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\">SERVICE 2</h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"customOverlayColor\":\"#1cc7a4\",\"className\":\"article-section\"} -->\n<div class=\"wp-block-cover has-background-dim article-section\" style=\"background-color:#1cc7a4\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5374,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services3.png\" alt=\"\" class=\"wp-image-5374\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\">SERVICE 3</h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"customOverlayColor\":\"#ff6c78\",\"className\":\"article-section\"} -->\n<div class=\"wp-block-cover has-background-dim article-section\" style=\"background-color:#ff6c78\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5386,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services4.png\" alt=\"\" class=\"wp-image-5386\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\">SERVICE 4</h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"customOverlayColor\":\"#ba83e0\",\"className\":\"article-section\"} -->\n<div class=\"wp-block-cover has-background-dim article-section\" style=\"background-color:#ba83e0\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5387,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services5.png\" alt=\"\" class=\"wp-image-5387\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\">SERVICE 5</h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"customOverlayColor\":\"#7c89eb\",\"className\":\"article-section\"} -->\n<div class=\"wp-block-cover has-background-dim article-section\" style=\"background-color:#7c89eb\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5388,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services6.png\" alt=\"\" class=\"wp-image-5388\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\">SERVICE 6</h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":3,\"style\":{\"color\":{\"text\":\"#252525\"}}} -->\n<h3 class=\"has-text-align-left has-text-color\" style=\"color:#252525\">LOREM IPSUM DONOR</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#a3a3a3\"}}} -->\n<p class=\"has-text-color\" style=\"color:#a3a3a3\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industry standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#a3a3a3\"}}} -->\n<p class=\"has-text-color\" style=\"color:#a3a3a3\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industry standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"style\":{\"color\":{\"background\":\"#ff5e6b\"}},\"className\":\"service-btn\"} -->\n<div class=\"wp-block-button service-btn\"><a class=\"wp-block-button__link has-background\" style=\"background-color:#ff5e6b\">APPOINTMENT NOW</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"placeholder\":\"Write title\",\"fontSize\":\"large\"} -->\n<p class=\"has-text-align-center has-large-font-size\"></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover -->",
		)
	);
}
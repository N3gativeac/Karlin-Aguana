<?php
/**
 * VW Ecommerce Shop: Block Patterns
 *
 * @package VW Ecommerce Shop
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'vw-ecommerce-shop',
		array( 'label' => __( 'VW Ecommerce Shop', 'vw-ecommerce-shop' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'vw-ecommerce-shop/banner-section',
		array(
			'title'      => __( 'Banner Section', 'vw-ecommerce-shop' ),
			'categories' => array( 'vw-ecommerce-shop' ),
			'content'    => "<!-- wp:columns {\"align\":\"wide\",\"className\":\"category-banner m-0\"} -->\n<div class=\"wp-block-columns alignwide category-banner m-0\"><!-- wp:column {\"width\":\"25%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"><!-- wp:woocommerce/product-categories {\"hasCount\":false,\"hasImage\":true,\"hasEmpty\":true,\"className\":\"wooproducts-categories\"} /--></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"75%\",\"className\":\"ml-0\"} -->\n<div class=\"wp-block-column ml-0\" style=\"flex-basis:75%\"><!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":637,\"dimRatio\":30,\"minHeight\":370,\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover has-background-dim-30 has-background-dim banner-section\" style=\"background-image:url(" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png);min-height:370px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"className\":\"ml-5 mb-0\"} -->\n<div class=\"wp-block-columns ml-5 mb-0\"><!-- wp:column {\"width\":\"66.66%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:heading {\"level\":1,\"textColor\":\"white\",\"style\":{\"typography\":{\"fontSize\":30}}} -->\n<h1 class=\"has-white-color has-text-color\" style=\"font-size:30px\"><strong>LOREM IPSUM IS SIMPLY</strong></h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":5,\"style\":{\"color\":{\"text\":\"#e1261c\"}},\"backgroundColor\":\"white\",\"className\":\"is-style-fill\"} -->\n<div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-white-background-color has-text-color has-background\" style=\"border-radius:5px;color:#e1261c\">READ MORE</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"10%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:10%\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
		)
	);

	register_block_pattern(
		'vw-ecommerce-shop/products-section',
		array(
			'title'      => __( 'Products Section', 'vw-ecommerce-shop' ),
			'categories' => array( 'vw-ecommerce-shop' ),
			'content'    => "<!-- wp:group {\"align\":\"wide\",\"className\":\"trending-products py-5 mx-0\"} -->\n<div class=\"wp-block-group alignwide trending-products py-5 mx-0\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"textAlign\":\"center\",\"align\":\"wide\",\"className\":\"mx-0\",\"style\":{\"typography\":{\"fontSize\":25}}} -->\n<h2 class=\"alignwide has-text-align-center mx-0\" style=\"font-size:25px\"><strong>Trending Products</strong></h2>\n<!-- /wp:heading -->\n\n<!-- wp:woocommerce/product-category {\"columns\":4,\"rows\":1,\"categories\":[17],\"contentVisibility\":{\"title\":true,\"price\":true,\"rating\":false,\"button\":true},\"align\":\"wide\",\"className\":\"mx-0\"} /--></div></div>\n<!-- /wp:group -->",
		)
	);
}
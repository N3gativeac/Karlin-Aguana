<?php
/**
 * Custom functions to modify frontend templates via hooks.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ====================================================
 * HTML Head filters
 * ====================================================
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function onestore_pingback_header() {
	if ( is_singular() && pings_open() ) {
		/* translators: %s: pingback url. */
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'onestore_pingback_header' );

/**
 * Add preconnect for Google Fonts embed fonts.
 *
 * @param array  $urls
 * @param string $relation_type
 * @return array $urls
 */
function onestore_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'onestore-google-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'onestore_resource_hints', 10, 2 );

/**
 * ====================================================
 * Template hooks
 * ====================================================
 */

/**
 * Attach template functions into the proper template hooks.
 * All template functions can be found on 'inc/template-tags.php' file.
 */
function onestore_template_hooks() {
	$is_title_in_page_header = false;

	if ( intval( onestore_get_current_page_setting( 'page_header' ) ) ) {
		foreach ( array( 'left', 'center', 'right' ) as $pos ) {
			if ( in_array( 'title', onestore_get_theme_mod( 'page_header_elements_' . $pos, array() ) ) ) {
				$is_title_in_page_header = true;
				break;
			}
		}
	}

	/**
	 * ====================================================
	 * Global hooks
	 * ====================================================
	 */

	// Add "skip to content" link before canvas.
	add_action( 'onestore/frontend/before_canvas', 'onestore_skip_to_content_link', 1 );

	// Add mobile vertical header link before canvas.
	add_action( 'onestore/frontend/before_canvas', 'onestore_mobile_vertical_header', 10 );

	// Add main header.
	add_action( 'onestore/frontend/header', 'onestore_main_header', 10 );

	// Add mobile header.
	add_action( 'onestore/frontend/header', 'onestore_mobile_header', 10 );

	// Add default logo.
	add_action( 'onestore/frontend/logo', 'onestore_default_logo', 10 );

	// Add default mobile logo.
	add_action( 'onestore/frontend/mobile_logo', 'onestore_default_mobile_logo', 10 );

	// Add page header after header section.
	add_action( 'onestore/frontend/after_header', 'onestore_page_header', 10 );
	add_action( 'onestore/frontend/after_header', 'onestore_more_offcanvas_items', 80 );

	// Add main footer.
	add_action( 'onestore/frontend/footer', 'onestore_main_footer', 10 );

	// Add scroll to top button.
	add_action( 'onestore/frontend/after_canvas', 'onestore_scroll_to_top', 10 );

	// Add do_shortcode to all kind of archive description.
	add_filter( 'term_description', 'do_shortcode' );
	add_filter( 'get_the_post_type_description', 'do_shortcode' );
	add_filter( 'get_the_author_description', 'do_shortcode' );

	/**
	 * ====================================================
	 * Content default (post / page) hooks
	 * ====================================================
	 */

	// Add featured media.
	add_action( 'onestore/frontend/entry/' . str_replace( '-entry-', '_', onestore_get_theme_mod( 'entry_featured_media_position' ) ), 'onestore_entry_featured_media', 10 );

	// Add entry header elements.
	if ( ! is_singular() || ! $is_title_in_page_header ) {
		if ( ! intval( onestore_get_current_page_setting( 'content_hide_title' ) ) ) {

			if ( is_page() ) {
				add_action( 'onestore/frontend/entry/header', 'onestore_entry_title', 10 );
			} else {
				$priority = 10;
				foreach ( (array) onestore_get_theme_mod( 'entry_header', array() ) as $element ) {
					$function = 'onestore_entry_' . str_replace( '-', '_', $element );

					// If function exists, attach to hook.
					if ( function_exists( $function ) ) {
						add_action( 'onestore/frontend/entry/header', $function, $priority );
					}

					// Increment priority number.
					$priority = $priority + 10;
				}
			}
		}
	}

	// Add entry footer elements.
	if ( ! is_page() ) {
		$priority = 10;
		foreach ( (array) onestore_get_theme_mod( 'entry_footer', array() ) as $element ) {
			$function = 'onestore_entry_' . str_replace( '-', '_', $element );

			// If function exists, attach to hook.
			if ( function_exists( $function ) ) {
				add_action( 'onestore/frontend/entry/footer', $function, $priority );
			}

			// Increment priority number.
			$priority = $priority + 10;
		}
	}

	/**
	 * ====================================================
	 * Content search hooks
	 * ====================================================
	 */

	// Add title to search result entry header.
	add_action( 'onestore/frontend/entry_search/header', 'onestore_entry_small_title', 10 );

	/**
	 * ====================================================
	 * Content grid hooks
	 * ====================================================
	 */

	// Add featured media.
	add_action( 'onestore/frontend/entry_grid/' . str_replace( '-entry-', '_', onestore_get_theme_mod( 'entry_grid_featured_media_position' ) ), 'onestore_entry_grid_featured_media', 10 );

	// Add grid entry header elements.
	$priority = 10;
	foreach ( (array) onestore_get_theme_mod( 'entry_grid_header', array() ) as $element ) {
		$function = 'onestore_entry_grid_' . str_replace( '-', '_', $element );

		// If function exists, attach to hook.
		if ( function_exists( $function ) ) {
			add_action( 'onestore/frontend/entry_grid/header', $function, $priority );
		}

		// Increment priority number.
		$priority = $priority + 10;
	}

	// Add grid entry footer elements.
	$priority = 10;
	foreach ( (array) onestore_get_theme_mod( 'entry_grid_footer', array() ) as $element ) {
		$function = 'onestore_entry_grid_' . str_replace( '-', '_', $element );

		// If function exists, attach to hook.
		if ( function_exists( $function ) ) {
			add_action( 'onestore/frontend/entry_grid/footer', $function, $priority );
		}

		// Increment priority number.
		$priority = $priority + 10;
	}

	/**
	 * ====================================================
	 * Comments area hooks
	 * ====================================================
	 */

	// Add comments title.
	add_action( 'onestore/frontend/before_comments_list', 'onestore_comments_title', 10 );

	// Add comments navigation.
	add_action( 'onestore/frontend/before_comments_list', 'onestore_comments_navigation', 20 );
	add_action( 'onestore/frontend/after_comments_list', 'onestore_comments_navigation', 10 );

	// Add "comments closed" notice.
	add_action( 'onestore/frontend/after_comments_list', 'onestore_comments_closed', 20 );

	/**
	 * ====================================================
	 * All index pages hooks
	 * ====================================================
	 */

	if ( is_archive() || is_home() || is_search() ) {

		if ( is_archive() ) {
			// Add archive header.
			add_action( 'onestore/frontend/before_main', 'onestore_archive_header', 10 );

			// Add archive title into archive header.
			if ( ! $is_title_in_page_header ) {
				add_action( 'onestore/frontend/archive_header', 'onestore_archive_title', 10 );
			}

			if ( '' !== trim( get_the_archive_description() ) ) {
				// Add archive description into archive header.
				add_action( 'onestore/frontend/archive_header', 'onestore_archive_description', 20 );
			}
		}

		if ( is_search() ) {
			// Add search results header.
			add_action( 'onestore/frontend/before_main', 'onestore_search_header', 10 );

			// Add archive title into search results header.
			if ( ! $is_title_in_page_header ) {
				add_action( 'onestore/frontend/search_header', 'onestore_search_title', 10 );
			}

			// Add search form into archive header.
			add_action( 'onestore/frontend/search_header', 'onestore_search_form', 20 );
		}

		// Add navigation after the loop.
		add_action( 'onestore/frontend/after_main', 'onestore_loop_navigation', 10 );
	}

	/**
	 * ====================================================
	 * All singular post hooks
	 * ====================================================
	 */

	if ( is_singular() ) {
		// Add tags.
		add_action( 'onestore/frontend/entry/before_footer', 'onestore_entry_tags', 10 );

		// Add author bio.
		add_action( 'onestore/frontend/after_main', 'onestore_single_post_author_bio', 10 );

		// Add post navigation.
		add_action( 'onestore/frontend/after_main', 'onestore_single_post_navigation', 15 );

		// Add comments.
		add_action( 'onestore/frontend/after_main', 'onestore_entry_comments', 20 );
	}
}
add_action( 'wp', 'onestore_template_hooks', 20 );

/**
 * ====================================================
 * Template rendering filters
 * ====================================================
 */

/**
 * Modify oembed HTML ouput.
 *
 * @param string  $html
 * @param string  $url
 * @param array   $attr
 * @param integer $post_id
 * @return string
 */
function onestore_oembed_wrapper( $html, $url, $attr, $post_id ) {
	// Default attributes
	$atts = array( 'class' => 'onestore-oembed' );

	// Check if the oembed HTML is a video.
	if ( preg_match( '/^<(?:iframe|embed|object)([^>]+)>/', $html, $video_match ) ) {
		$atts['class'] .= ' onestore-oembed-video';

		// Extract all attributes (if any).
		if ( preg_match_all( '/(\w+)=[\'\"]?([^\'\"]*)[\'\"]?/', $video_match[1], $atts_matches ) ) {
			// Format all attributes into associative array.
			$video_atts = array();
			for ( $i = 0; $i < count( $atts_matches[1] ); $i++ ) {
				$video_atts[ $atts_matches[1][ $i ] ] = $atts_matches[2][ $i ];
			}

			// Check if there is width & height attributes found, use those values for responsive ratio.
			if ( isset( $video_atts['width'] ) && isset( $video_atts['height'] ) ) {
				$w = intval( $video_atts['width'] );
				$h = intval( $video_atts['height'] );

				$atts['style'] = 'padding-top: ' . round( ( $h / $w * 100 ), 3 ) . '%;';
			}
			// If not found, use default 16:9 ratio.
			else {
				$atts['style'] = 'padding-top: 56.25%;';
			}
		}
	}

	// Filter to modify oembed HTML attributes.
	$atts = apply_filters( 'onestore/frontend/oembed_attributes', $atts );

	// Build the attributes HTML.
	$atts_html = '';
	foreach ( $atts as $key => $value ) {
		$atts_html .= ' ' . $key . '="' . esc_attr( $value ) . '"';
	}

	return '<div' . $atts_html . '>' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'onestore_oembed_wrapper', 10, 4 );

/**
 * Modify "read more" HTML output.
 *
 * @param integer $length
 * @return integer
 */
function onestore_read_more( $link ) {
	return '<p class="read-more">' . $link . '</p>';
}
add_filter( 'the_content_more_link', 'onestore_read_more' );

/**
 * Modify blog post's excerpt character limit.
 *
 * @param integer $length
 * @return integer
 */
function onestore_excerpt_length( $length ) {
	// Search page
	if ( is_search() ) {
		return 30;
	}

	// Posts page
	elseif ( ( is_home() || is_archive() ) && 'post' === get_post_type() ) {
		$layout = onestore_get_theme_mod( 'blog_index_loop_mode' );

		if ( 'default' === $layout ) {
			$key = 'entry_excerpt_length';
		} else {
			$key = 'entry_' . $layout . '_excerpt_length';
		}

		return intval( onestore_get_theme_mod( $key, $length ) );
	}

	// Else
	return $length;
}
add_filter( 'excerpt_length', 'onestore_excerpt_length' );

/**
 * Modify blog post's excerpt end string.
 *
 * @param string $more
 * @return string
 */
function onestore_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'onestore_excerpt_more' );

/**
 * Add dropdown caret to accordion menu item.
 *
 * @param string   $item_output
 * @param WP_Post  $item
 * @param integer  $depth
 * @param stdClass $args
 * @return string
 */
function onestore_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
	// Only add to menu item that has sub menu.
	if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
		// Only add to toggle menu.
		if ( is_integer( strpos( $args->menu_class, 'action-toggle-menu' ) ) ) {
			$sign = '<button class="sub-menu-toggle action-toggle">' . onestore_icon( 'chevron-down', array( 'class' => 'onestore-dropdown-sign' ), false ) . '<span class="screen-reader-text">' . esc_html__( 'Expand / Collapse', 'onestore' ) . '</span></button>';

			$item_output .= trim( $sign );
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'onestore_walker_nav_menu_start_el', 99, 4 );

/**
 * Add <span> wrapping tag and dropdown caret to menu item title.
 *
 * @param string   $title
 * @param WP_Post  $item
 * @param stdClass $args
 * @param integer  $depth
 * @return string
 */
function onestore_nav_menu_item_title( $title, $item, $args, $depth ) {
	$sign = '';

	// Only add to menu item that has sub menu.
	if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
		// Only add to hover menu.
		if ( is_integer( strpos( $args->menu_class, 'onestore-hover-menu' ) ) ) {
			$sign = onestore_icon( 0 < $depth ? 'chevron-right' : 'chevron-down', array( 'class' => 'onestore-dropdown-sign' ), false );
		}
	}

	return '<span class="menu-item-title">' . $title . '</span>' . trim( $sign );
}
add_filter( 'nav_menu_item_title', 'onestore_nav_menu_item_title', 99, 4 );

/**
 * Add 'onestore-menu-item-link' class to menu item's anchor tag.
 *
 * @param array    $atts
 * @param WP_Post  $item
 * @param stdClass $args
 * @param int      $depth
 */
function onestore_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( ! isset( $atts['class'] ) ) {
		$atts['class'] = '';
	}

	$atts['class'] = 'menu-item-link ' . $atts['class'];

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'onestore_nav_menu_link_attributes', 10, 4 );


/**
 * ====================================================
 * Blog elements
 * ====================================================
 */

/**
 * Modify tagcloud arguments.
 *
 * @param array $args
 * @return array
 */
function onestore_widget_tag_cloud_args( $args ) {
	$args['smallest'] = 0.75;
	$args['default']  = 1;
	$args['largest']  = 1.75;
	$args['unit']     = 'em';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'onestore_widget_tag_cloud_args' );

/**
 * ====================================================
 * Element classes filters
 * ====================================================
 */

/**
 * Add LTR class to the array of body classes.
 *
 * @param array $classes.
 * @return array
 */
function onestore_body_ltr_class( $classes ) {
	if ( ! is_rtl() ) {
		$classes[] = 'ltr';
	}

	// RTL class is automatically added by default when RTL mode is active.
	return $classes;
}
add_filter( 'body_class', 'onestore_body_ltr_class', -1 );

/**
 * Add custom classes to the array of body classes.
 *
 * @param array $classes.
 * @return array
 */
function onestore_body_classes( $classes ) {
	// Add a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add page layout class.
	$classes['page_layout'] = esc_attr( 'page-layout-' . onestore_get_theme_mod( 'page_layout' ) );

	// Add theme version.
	$classes['theme_version'] = esc_attr( 'onestore-ver-' . str_replace( '.', '-', ONESTORE_VERSION ) );

	// Add font smoothing class.
	if ( intval( onestore_get_theme_mod( 'font_smoothing' ) ) ) {
		$classes['font_smoothing'] = esc_attr( 'onestore-font-smoothing-1' );
	}

	return $classes;
}
add_filter( 'body_class', 'onestore_body_classes' );

/**
 * Add custom classes to the array of mobile vertical header classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_header_mobile_vertical_classes( $classes ) {
	$classes['display'] = esc_attr( 'header-mobile-vertical-display-' . onestore_get_theme_mod( 'header_mobile_vertical_bar_display' ) );

	$classes['position'] = esc_attr( 'popup-position-' . onestore_get_theme_mod( 'header_mobile_vertical_bar_position' ) );

	$classes['alignment'] = esc_attr( 'text-' . onestore_get_theme_mod( 'header_mobile_vertical_bar_alignment' ) );

	return $classes;
}
add_filter( 'onestore/frontend/header_mobile_vertical_classes', 'onestore_header_mobile_vertical_classes' );

/**
 * Add custom classes to the array of header top bar section classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_header_top_bar_classes( $classes ) {
	$classes['container'] = esc_attr( 'main-section-' . onestore_get_theme_mod( 'header_top_bar_container' ) );
	$classes['menu_highlight'] = esc_attr( 'header-menu-highlight-' . onestore_get_theme_mod( 'header_top_bar_menu_highlight' ) );

	if ( intval( onestore_get_theme_mod( 'header_top_bar_merged' ) ) ) {
		$classes['merged'] = 'main-section-merged';
	}

	return $classes;
}
add_filter( 'onestore/frontend/header_top_bar_classes', 'onestore_header_top_bar_classes' );

/**
 * Add custom classes to the array of header main bar section classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_header_main_bar_classes( $classes ) {
	$classes['container'] = esc_attr( 'main-section-' . onestore_get_theme_mod( 'header_main_bar_container' ) );
	$classes['menu_highlight'] = esc_attr( 'header-menu-highlight-' . onestore_get_theme_mod( 'header_main_bar_menu_highlight' ) );

	if ( intval( onestore_get_theme_mod( 'header_top_bar_merged' ) ) ) {
		$classes['top_bar_merged'] = 'header-main-bar-with-top-bar';
	}

	if ( intval( onestore_get_theme_mod( 'header_bottom_bar_merged' ) ) ) {
		$classes['bottom_bar_merged'] = 'header-main-bar-with-bottom-bar';
	}

	return $classes;
}
add_filter( 'onestore/frontend/header_main_bar_classes', 'onestore_header_main_bar_classes' );

/**
 * Add custom classes to the array of header bottom bar section classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_header_bottom_bar_classes( $classes ) {
	$classes['container'] = esc_attr( 'main-section-' . onestore_get_theme_mod( 'header_bottom_bar_container' ) );
	$classes['menu_highlight'] = esc_attr( 'header-menu-highlight-' . onestore_get_theme_mod( 'header_bottom_bar_menu_highlight' ) );

	if ( intval( onestore_get_theme_mod( 'header_bottom_bar_merged' ) ) ) {
		$classes['merged'] = 'main-section-merged';
	}

	return $classes;
}
add_filter( 'onestore/frontend/header_bottom_bar_classes', 'onestore_header_bottom_bar_classes' );


/**
 * Add custom classes to the array of content section classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_content_classes( $classes ) {
	$classes['content_layout'] = esc_attr( 'content-layout-' . onestore_get_current_page_setting( 'content_layout' ) );
	return $classes;
}
add_filter( 'onestore/frontend/content_classes', 'onestore_content_classes' );

/**
 * Add custom classes to the array of posts loop classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_loop_classes( $classes ) {
	$classes['mode'] = esc_attr( 'onestore-loop-' . onestore_get_theme_mod( 'blog_index_loop_mode' ) );

	// Grid
	if ( 'grid' == onestore_get_theme_mod( 'blog_index_loop_mode' ) ) {
		$classes['blog_index_grid_columns'] = esc_attr( 'onestore-loop-grid-' . onestore_get_theme_mod( 'blog_index_grid_columns' ) . '-columns' );

		if ( intval( onestore_get_theme_mod( 'entry_grid_same_height' ) ) ) {
			$classes['entry_grid_same_height'] = 'onestore-loop-grid-same-height';
		}
	}

	return $classes;
}
add_filter( 'onestore/frontend/loop_classes', 'onestore_loop_classes' );

/**
 * Add custom classes to entry thumbnail.
 *
 * @param array $classes
 * @return array
 */
function onestore_entry_thumbnail_classes( $classes ) {
	if ( intval( onestore_get_theme_mod( 'entry_featured_media_ignore_padding' ) ) ) {
		$classes['entry_featured_media_ignore_padding'] = 'onestore-entry-thumbnail-ignore-padding';
	}

	return $classes;
}
add_filter( 'onestore/frontend/entry/thumbnail_classes', 'onestore_entry_thumbnail_classes' );

/**
 * Add custom classes to entry grid thumbnail.
 *
 * @param array $classes
 * @return array
 */
function onestore_entry_grid_thumbnail_classes( $classes ) {
	if ( intval( onestore_get_theme_mod( 'entry_grid_featured_media_ignore_padding' ) ) ) {
		$classes['entry_grid_featured_media_ignore_padding'] = 'onestore-entry-thumbnail-ignore-padding';
	}

	return $classes;
}
add_filter( 'onestore/frontend/entry_grid/thumbnail_classes', 'onestore_entry_grid_thumbnail_classes' );

/**
 * Add custom classes to the array of sidebar classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_sidebar_classes( $classes ) {
	$classes['widgets_mode'] = esc_attr( 'sidebar-widgets-mode-' . onestore_get_theme_mod( 'sidebar_widgets_mode' ) );
	$classes['widget_title_alignment'] = esc_attr( 'onestore-widget-title-alignment-' . onestore_get_theme_mod( 'sidebar_widget_title_alignment' ) );
	$classes['widget_title_decoration'] = esc_attr( 'onestore-widget-title-decoration-' . onestore_get_theme_mod( 'sidebar_widget_title_decoration' ) );

	return $classes;
}
add_filter( 'onestore/frontend/sidebar_classes', 'onestore_sidebar_classes' );

/**
 * Add custom classes to the array of footer widgets classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_footer_widgets_classes( $classes ) {
	$classes['container'] = esc_attr( 'main-section-' . onestore_get_theme_mod( 'footer_widgets_bar_container' ) );
	$classes['widget_title_alignment'] = esc_attr( 'onestore-widget-title-alignment-' . onestore_get_theme_mod( 'footer_widgets_bar_widget_title_alignment' ) );
	$classes['widget_title_decoration'] = esc_attr( 'onestore-widget-title-decoration-' . onestore_get_theme_mod( 'footer_widgets_bar_widget_title_decoration' ) );

	if ( intval( onestore_get_theme_mod( 'footer_bottom_bar_merged' ) ) ) {
		$classes['bottom_bar_merged'] = 'onestore-footer-widgets-bar-with-bottom-bar';
	}

	return $classes;
}
add_filter( 'onestore/frontend/footer_widgets_bar_classes', 'onestore_footer_widgets_classes' );

/**
 * Add custom classes to the array of footer bottom bar classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_footer_bottom_classes( $classes ) {
	$classes['container'] = esc_attr( 'main-section-' . onestore_get_theme_mod( 'footer_bottom_bar_container' ) );

	if ( intval( onestore_get_theme_mod( 'footer_bottom_bar_merged' ) ) ) {
		$classes['merged'] = 'main-section-merged';
	}

	return $classes;
}
add_filter( 'onestore/frontend/footer_bottom_bar_classes', 'onestore_footer_bottom_classes' );

/**
 * Add custom classes to the array of footer bottom bar classes.
 *
 * @param array $classes
 * @return array
 */
function onestore_scroll_to_top_classes( $classes ) {
	$classes['position'] = esc_attr( 'onestore-scroll-to-top-position-' . onestore_get_theme_mod( 'scroll_to_top_position' ) );
	$classes['display'] = esc_attr( 'onestore-scroll-to-top-display-' . onestore_get_theme_mod( 'scroll_to_top_display' ) );

	$hide_devices = array_diff( array( 'desktop', 'tablet', 'mobile' ), (array) onestore_get_theme_mod( 'scroll_to_top_visibility' ) );

	foreach ( $hide_devices as $device ) {
		$classes[ 'hide_on_' . $device ] = esc_attr( 'onestore-hide-on-' . $device );
	}

	return $classes;
}
add_filter( 'onestore/frontend/scroll_to_top_classes', 'onestore_scroll_to_top_classes' );


function onestore_popup( $id, $heading, $content, $position = 'right' ) {
	onestore_get_template_part(
		'popup',
		null,
		array(
			'popup_id' => $id,
			'popup_heading' => $heading,
			'popup_content' => $content,
			'popup_position' => $position,
		)
	);
}

function onestore_is_ajax_load() {
	return OneStore::instance()->is_ajax_more;
}

function onestore_woocommerce_before_main_content() {
	if ( onestore_is_ajax_load() ) {
		ob_start();
	}
}

function onestore_woocommerce_after_main_content() {
	if ( onestore_is_ajax_load() ) {
		$content = ob_get_clean();
		$data = array(
			'content'  => '<div id="ajax-content">' . $content . '</div>',
		);
		if ( function_exists( 'savp' ) ) {
			$data['savp'] = array(
				'savp_swatches' => savp()->frontend()->all_product_swatches,
				'variation_settings' => savp()->frontend()->variation_settings,
				'savp_product_variations' => savp()->frontend()->product_variations,
				'savp_product_gallies' => savp()->frontend()->product_gallies,
				'savp_gallery_settings' => array(
					'single' => savp()->frontend()->get_gallery_single_settings(),
					'loop' => savp()->frontend()->get_gallery_loop_settings(),
				),
			);
		}
		wp_send_json( $data );
		die();
	}
}
add_action( 'onestore_wc_list_start', 'onestore_woocommerce_before_main_content', 1 );
add_action( 'onestore_wc_list_end', 'onestore_woocommerce_after_main_content', 999 );

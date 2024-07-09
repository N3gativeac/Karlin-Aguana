<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'onestore_device_detect' ) ) :
	/**
	 * Fallback HTML if there is no nav menu assigned to a navigation location.
	 */
	function onestore_device_detect() {
		$device = 'desktop';
		if ( OneStore::instance()->device->isMobile() ) {
			$device = 'mobile';
		}

		if ( OneStore::instance()->device->isTablet() ) {
			$device = 'tablet';
		}

		echo ' data-device="' . $device . '" ';

	}
endif;

/**
 * ====================================================
 * Global template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_unassigned_menu' ) ) :
	/**
	 * Fallback HTML if there is no nav menu assigned to a navigation location.
	 */
	function onestore_unassigned_menu() {
		$labels = get_registered_nav_menus();

		if ( ! is_user_logged_in() || ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}
		?>
	<ul class="menu">
		<li class="menu-item">
			<a href="<?php echo esc_attr( add_query_arg( 'action', 'locations', admin_url( 'nav-menus.php' ) ) ); ?>" class="onestore-menu-item-link">
				<?php esc_html_e( 'Assign menu to this location', 'onestore' ); ?>
			</a>
		</li>
	</ul>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_inline_svg' ) ) :
	/**
	 * Print / return inline SVG HTML tags.
	 */
	function onestore_inline_svg( $svg_file, $echo = true ) {
		// Return empty if no SVG file path is provided.
		if ( empty( $svg_file ) ) {
			return;
		}

		// Get SVG markup.
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$html = $wp_filesystem->get_contents( $svg_file );

		// Remove XML encoding tag.
		// This should not be printed on inline SVG.
		$html = preg_replace( '/<\?xml(?:.*?)\?>/', '', $html );

		// Add width attribute if not found in the SVG markup.
		// Width value is extracted from viewBox attribute.
		if ( ! preg_match( '/<svg.*?width.*?>/', $html ) ) {
			if ( preg_match( '/<svg.*?viewBox="0 0 ([0-9.]+) ([0-9.]+)".*?>/', $html, $matches ) ) {
				$html = preg_replace( '/<svg (.*?)>/', '<svg $1 width="' . $matches[1] . '" height="' . $matches[2] . '">', $html );
			}
		}

		// Remove <title> from SVG markup.
		// Site name would be added as a screen reader text to represent the logo.
		$html = preg_replace( '/<title>.*?<\/title>/', '', $html );

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $html;
		}
	}
endif;

if ( ! function_exists( 'onestore_logo' ) ) :
	/**
	 * Print HTML markup for specified site logo.
	 *
	 * @param integer $logo_image_id
	 */
	function onestore_logo( $logo_image_id = null ) {
		// Default to site name.
		$html = get_bloginfo( 'name', 'display' );

		// Try to get logo image.
		if ( ! empty( $logo_image_id ) ) {
			$mime = get_post_mime_type( $logo_image_id );

			switch ( $mime ) {
				case 'image/svg+xml':
					$svg_file = get_attached_file( $logo_image_id );

					$logo_image = onestore_inline_svg( $svg_file, false );
					break;

				default:
					$logo_image = wp_get_attachment_image( $logo_image_id, 'full', 0, array() );
					break;
			}

			// Replace logo HTML if logo image is found.
			if ( ! empty( $logo_image ) ) {
				$html = '<span class="onestore-logo-image">' . $logo_image . '</span><span class="screen-reader-text">' . get_bloginfo( 'name', 'display' ) . '</span>';
			}
		}

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'onestore_default_logo' ) ) :
	/**
	 * Print / return HTML markup for default logo.
	 */
	function onestore_default_logo() {
		?>
	<span class="onestore-default-logo onestore-logo"><?php onestore_logo( onestore_get_theme_mod( 'custom_logo' ) ); ?></span>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_default_mobile_logo' ) ) :
	/**
	 * Print / return HTML markup for default mobile logo.
	 */
	function onestore_default_mobile_logo() {
		?>
	<span class="onestore-default-logo onestore-logo"><?php onestore_logo( onestore_get_theme_mod( 'custom_logo_mobile' ) ); ?></span>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_icon' ) ) :
	/**
	 * Print / return HTML markup for specified icon type in SVG format.
	 *
	 * @param string  $key
	 * @param array   $args
	 * @param boolean $echo
	 */
	function onestore_icon( $key, $args = array(), $echo = true ) {
		$args = wp_parse_args(
			$args,
			array(
				'title' => '',
				'class' => '',
			)
		);

		$classes = implode( ' ', array( 'onestore-icon', 'icon', 'icon oic-' . $key, $args['class'] ) );

		// Wrap the icon with "onestore-icon" span tag.
		$html = '<span class="' . esc_attr( $classes ) . '" title="' . esc_attr( $args['title'] ) . '" aria-hidden="true"></span>';

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $html;
		}
	}
endif;

if ( ! function_exists( 'onestore_social_links' ) ) :
	/**
	 * Print / return HTML markup for specified set of social media links.
	 *
	 * @param array   $links
	 * @param array   $args
	 * @param boolean $echo
	 */
	function onestore_social_links( $links = array(), $args = array(), $echo = true ) {
		$labels = onestore_get_social_media_types();

		$args = wp_parse_args(
			$args,
			array(
				'before_link' => '',
				'after_link'  => '',
				'link_class'  => '',
			)
		);

		ob_start();
		foreach ( $links as $link ) :
			echo $args['before_link']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			if ( 'google-plus' == $link['type'] ) {
				$icon_key = 'social-google';
			} else {
				$icon_key = 'social-' . $link['type'];
			}

			?><a href="<?php echo esc_url( $link['url'] ); ?>" class="onestore-social-link <?php echo esc_attr( 'onestore-social-link--' . $link['type'] ); ?>" <?php echo '_blank' === onestore_array_value( $link, 'target', '_self' ) ? ' target="_blank" rel="noopener"' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php onestore_icon(
					$icon_key,
					array(
						'title' => $labels[ $link['type'] ],
						'class' => $args['link_class'],
					)
				); ?>
		</a><?php

		echo $args['after_link']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endforeach;
		$html = ob_get_clean();

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $html;
		}
	}
endif;

if ( ! function_exists( 'onestore_title__search' ) ) :
	/**
	 * Print / return HTML markup for title text for search page.
	 *
	 * @param boolean $echo
	 */
	function onestore_title__search( $echo = true ) {
		$html = sprintf(
			/* translators: %s: search query. */
			esc_html__( 'Search Results for: %s', 'onestore' ),
			'<span>' . get_search_query() . '</span>'
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $html;
		}
	}
endif;

if ( ! function_exists( 'onestore_title__404' ) ) :
	/**
	 * Print / return HTML markup for title text for 404 page.
	 *
	 * @param boolean $echo
	 */
	function onestore_title__404( $echo = true ) {
		$html = esc_html__( 'Oops! That page can not be found.', 'onestore' );

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $html;
		}
	}
endif;

/**
 * ====================================================
 * Header template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_skip_to_content_link' ) ) :
	/**
	 * Render skip to content link.
	 */
	function onestore_skip_to_content_link() {
		?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'onestore' ); ?></a>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_header' ) ) :
	/**
	 * Render header wrapper.
	 */
	function onestore_header() {
		?>
	<header id="masthead" class="site-header" role="banner" itemtype="https://schema.org/WPHeader" itemscope>
		<?php
		/**
		 * Hook: onestore/frontend/header
		 *
		 * @hooked onestore_main_header - 10
		 * @hooked onestore_mobile_header - 10
		 */
		do_action( 'onestore/frontend/header' );
		?>
	</header>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_mobile_vertical_header' ) ) :
	/**
	 * Render mobile vertical header.
	 */
	function onestore_mobile_vertical_header() {
		if ( intval( onestore_get_current_page_setting( 'disable_mobile_header' ) ) ) {
			return;
		}

		onestore_get_template_part( 'header-mobile-vertical' );
	}
endif;


if ( ! function_exists( 'onestore_more_offcanvas_items' ) ) :
	function onestore_more_offcanvas_items() {

		foreach ( OneStore::instance()->more_canvas as $k => $v ) {
			if ( $v ) {
				onestore_get_template_part( $v );
			}
		}

	}
endif;




if ( ! function_exists( 'onestore_main_header' ) ) :
	/**
	 * Render main header.
	 */
	function onestore_main_header() {
		if ( intval( onestore_get_current_page_setting( 'disable_header' ) ) ) {
			return;
		}

		onestore_get_template_part( 'header-desktop' );
	}
endif;

if ( ! function_exists( 'onestore_main_header__top_bar' ) ) :
	/**
	 * Render main header bar.
	 *
	 * @param boolean $merged
	 */
	function onestore_main_header__top_bar( $merged = false ) {
		onestore_get_template_part( 'header-desktop-top-bar', null, array( 'merged' => $merged ) );
	}
endif;

if ( ! function_exists( 'onestore_main_header__main_bar' ) ) :
	/**
	 * Render main header bar.
	 */
	function onestore_main_header__main_bar() {
		onestore_get_template_part( 'header-desktop-main-bar' );
	}
endif;

if ( ! function_exists( 'onestore_main_header__bottom_bar' ) ) :
	/**
	 * Render main header bar.
	 *
	 * @param boolean $merged
	 */
	function onestore_main_header__bottom_bar( $merged = false ) {
		onestore_get_template_part( 'header-desktop-bottom-bar', null, array( 'merged' => $merged ) );
	}
endif;

if ( ! function_exists( 'onestore_mobile_header' ) ) :
	/**
	 * Render mobile header.
	 */
	function onestore_mobile_header() {
		if ( intval( onestore_get_current_page_setting( 'disable_mobile_header' ) ) ) {
			return;
		}

		onestore_get_template_part( 'header-mobile' );
	}
endif;

if ( ! function_exists( 'onestore_page_header' ) ) :
	/**
	 * Render page header section.
	 */
	function onestore_page_header() {
		if ( ! intval( onestore_get_current_page_setting( 'page_header' ) ) ) {
			return;
		}
		onestore_get_template_part( 'page-header' );
	}
endif;



if ( ! function_exists( 'onestore_page_header_element' ) ) :
	/**
	 * Render page header element.
	 */
	function onestore_page_header_element( $element ) {
		if ( empty( $element ) ) {
			return;
		}

		ob_start();
		switch ( $element ) {
			case 'title':
				$title = '';

				// If no custom title defined, use default title.
				if ( is_home() && is_front_page() ) {
					$title = get_bloginfo( 'description' );
				} elseif ( is_home() ) {
					$title = get_the_title( get_option( 'page_for_posts' ) );
				} elseif ( is_search() ) {
					$title = onestore_get_current_page_setting( 'page_header_title_text__search' );

					if ( ! empty( $title ) ) {
						$title = str_replace( '{{keyword}}', get_search_query(), $title );
					} else {
						$title = onestore_title__search( false );
					}
				} elseif ( is_post_type_archive() ) {
					$post_type_obj = get_queried_object();
					$title = onestore_get_current_page_setting( 'page_header_title_text__post_type_archive' );

					if ( ! empty( $title ) ) {
						$title = str_replace( '{{post_type}}', $post_type_obj->labels->name, $title );
					} else {
						$title = post_type_archive_title( '', false );

						if ( empty( $title ) ) {
							$title = $post_type_obj->labels->name;
						}
					}
				} elseif ( is_date() || is_author() ) {
					$title = get_the_archive_title();
				} elseif ( is_archive() ) {
					$term_obj = get_queried_object();
					$taxonomy_obj = get_taxonomy( $term_obj->taxonomy );

					$title = onestore_get_current_page_setting( 'page_header_title_text__taxonomy_archive' );

					if ( ! empty( $title ) ) {
						$title = str_replace( '{{taxonomy}}', $taxonomy_obj->labels->singular_name, $title );
						$title = str_replace( '{{term}}', $term_obj->name, $title );
					} else {
						$title = get_the_archive_title();
					}
				} elseif ( is_404() ) {
					$title = onestore_get_current_page_setting( 'page_header_title_text__404' );

					if ( empty( $title ) ) {
						$title = onestore_title__404( false );
					}
				} elseif ( is_singular() ) {
					$title = get_the_title();
				}

				$sub = '';

				if ( ! empty( $title ) ) {
					echo '<div class="header-title-wrapper"><h1 class="page-header-title">' . $title . '</h1>' . $sub . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				break;

			case 'breadcrumb':
				$breadcrumb = '';
				switch ( onestore_get_theme_mod( 'breadcrumb_plugin', '' ) ) {
					case 'breadcrumb-trail':
						if ( function_exists( 'breadcrumb_trail' ) ) {
							$breadcrumb = breadcrumb_trail(
								array(
									'show_browse' => false,
									'echo' => false,
								)
							);
						}
						break;

					case 'breadcrumb-navxt':
						if ( function_exists( 'bcn_display' ) ) {
							$breadcrumb = bcn_display( true );
						}
						break;

					case 'yoast-seo':
						if ( function_exists( 'yoast_breadcrumb' ) ) {
							$breadcrumb = yoast_breadcrumb( '', '', false );
						}
						break;

					case 'rank-math':
						if ( function_exists( 'rank_math_get_breadcrumbs' ) ) {
							$breadcrumb = rank_math_get_breadcrumbs();
						}
						break;

					case 'seopress':
						if ( function_exists( 'seopress_display_breadcrumbs' ) ) {
							$breadcrumb = seopress_display_breadcrumbs( false );
						}
						break;
					default:
				}

				if ( ! empty( $breadcrumb ) ) {
					echo '<div class="page-header-breadcrumb onestore-breadcrumb">' . $breadcrumb . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					if ( function_exists( 'woocommerce_breadcrumb' ) ) {
						echo '<div class="page-header-breadcrumb onestore-breadcrumb">';
						woocommerce_breadcrumb();
						echo '</div>';
					}
				}
				break;
		}
		$html = ob_get_clean();

		// Filters to modify the final HTML tag.
		$html = apply_filters( 'onestore/frontend/page_header_element', $html, $element );
		$html = apply_filters( 'onestore/frontend/page_header_element/' . $element, $html );

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	endif;



if ( ! function_exists( 'onestore_header_columns' ) ) :

	function onestore_header_columns( $cols, $elements, $prefix = 'header-main-bar-', $class = 'header-column' ) {

		foreach ( $cols as $col ) {
			$ne = count( $elements[ $col ] );
			// Skip center column if it's empty.
			if ( 'center' === $col && 0 === $ne ) {
				continue;
			}
			if ( 'center' === $col && 1 === $ne ) {
				foreach ( $elements[ $col ] as $element ) {
					onestore_header_element( $element, $prefix . $col . ' only-1 ' . $class );
				}
			} else { ?>
			<div class="<?php echo esc_attr( $prefix . $col . ' ' . $class ); ?>">
				<?php
				// Print all elements inside the column.
				foreach ( $elements[ $col ] as $element ) {
					onestore_header_element( $element );
				}
				?>
			</div>
				<?php
			}
		}
	}

endif;


if ( ! function_exists( 'onestore_header_element' ) ) :
	/**
	 * Wrapper function to print HTML markup for all header element.
	 *
	 * @param string $slug
	 */
	function onestore_header_element( $slug, $class = '' ) {
		if ( empty( $slug ) ) {
			return;
		}

		// Classify element into its type.
		$type = preg_replace( '/-\d$/', '', $slug );

		// Add passing variables.
		$variables = array(
			'slug' => $slug,
			'class' => $class,
		);

		// Get header element template.
		$html = onestore_get_template_part( 'header-element-' . $type, null, $variables, false );

		// Filters to modify the final HTML tag.
		$html = apply_filters( 'onestore/frontend/header_element', $html, $slug );
		$html = apply_filters( 'onestore/frontend/header_element/' . $slug, $html );

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;


/**
 * ====================================================
 * Content section template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_content_open' ) ) :
	/**
	 * Render content section opening tags.
	 */
	function onestore_content_open() {
		onestore_get_template_part( 'content-open' );
	}
endif;

if ( ! function_exists( 'onestore_content_close' ) ) :
	/**
	 * Render content section closing tags.
	 */
	function onestore_content_close() {
		onestore_get_template_part( 'content-close' );
	}
endif;

if ( ! function_exists( 'onestore_primary_open' ) ) :
	/**
	 * Render main content opening tags.
	 */
	function onestore_primary_open() {
		onestore_get_template_part( 'content-primary-open' );
	}
endif;

if ( ! function_exists( 'onestore_primary_close' ) ) :
	/**
	 * Render main content closing tags.
	 */
	function onestore_primary_close() {
		onestore_get_template_part( 'content-primary-close' );
	}
endif;

/**
 * ====================================================
 * Footer template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_footer' ) ) :
	/**
	 * Render footer wrapper.
	 */
	function onestore_footer() {
		?>
	<footer id="colophon" class="site-footer onestore-footer" role="contentinfo" itemtype="https://schema.org/WPFooter" itemscope>
		<?php
		/**
		 * Hook: onestore/frontend/footer
		 *
		 * @hooked onestore_main_footer - 10
		 */
		do_action( 'onestore/frontend/footer' );
		?>
	</footer>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_main_footer' ) ) :
	/**
	 * Render footer sections.
	 */
	function onestore_main_footer() {
		// Widgets Bar
		onestore_footer_widgets();

		// Bottom Bar (if not merged)
		if ( ! intval( onestore_get_theme_mod( 'footer_bottom_bar_merged' ) ) ) {
			onestore_footer_bottom();
		}
	}
endif;

if ( ! function_exists( 'onestore_footer_widgets' ) ) :
	/**
	 * Render footer widgets area.
	 */
	function onestore_footer_widgets() {
		if ( intval( onestore_get_current_page_setting( 'disable_footer_widgets' ) ) ) {
			return;
		}

		onestore_get_template_part( 'footer-widgets' );
	}
endif;

if ( ! function_exists( 'onestore_footer_bottom' ) ) :
	/**
	 * Render footer bottom bar.
	 */
	function onestore_footer_bottom() {
		if ( intval( onestore_get_current_page_setting( 'disable_footer_bottom' ) ) ) {
			return;
		}

		onestore_get_template_part( 'footer-bottom' );
	}
endif;

if ( ! function_exists( 'onestore_footer_element' ) ) :
	/**
	 * Render each footer element.
	 *
	 * @param string $slug
	 */
	function onestore_footer_element( $slug ) {
		if ( empty( $slug ) ) {
			return;
		}

		// Classify element into its type.
		$type = preg_replace( '/-\d$/', '', $slug );

		// Add passing variables.
		$variables = array( 'slug' => $slug );

		// Get footer element template.
		$html = onestore_get_template_part( 'footer-element-' . $type, null, $variables, false );

		// Filters to modify the final HTML tag.
		$html = apply_filters( 'onestore/frontend/footer_element', $html, $slug );
		$html = apply_filters( 'onestore/frontend/footer_element/' . $slug, $html );

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'onestore_scroll_to_top' ) ) :
	/**
	 * Print scroll to top button.
	 */
	function onestore_scroll_to_top() {
		if ( ! intval( onestore_get_theme_mod( 'scroll_to_top' ) ) ) {
			return;
		}

		onestore_get_template_part( 'scroll-to-top' );
	}
endif;

/**
 * ====================================================
 * Entry template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_entry_meta_element' ) ) :
	/**
	 * Print entry meta element.
	 */
	function onestore_entry_meta_element( $element ) {
		switch ( $element ) {
			case 'date':
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
				}
				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);

				echo '<span class="entry-meta-date"><a href="' . esc_url( get_permalink() ) . '" class="posted-on">' . $time_string . '</a></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;

			case 'author':
				echo '<span class="entry-meta-author author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;

			case 'avatar':
				echo '<span class="entry-meta-author-avatar">' . get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'onestore/frontend/meta_avatar_size', 24 ) ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;

			case 'categories':
				echo '<span class="entry-meta-categories cat-links">' . get_the_category_list( esc_html_x( ', ', 'terms list separator', 'onestore' ) ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;

			case 'tags':
				echo ( '<span class="entry-meta-tags tags-links">' . get_the_tag_list( '', esc_html_x( ', ', 'terms list separator', 'onestore' ) ) . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;

			case 'comments':
				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="entry-meta-comments comments-link">';
					comments_popup_link();
					echo '</span>';
				}
				break;
		}
	}
endif;

if ( ! function_exists( 'onestore_entry_tags' ) ) :
	/**
	 * Print tags links.
	 */
	function onestore_entry_tags() {
		$tags_list = get_the_tag_list( '', '' );

		if ( $tags_list ) {
			echo '<div class="entry-tags tagcloud onestore-float-container">' . $tags_list . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'onestore_entry_comments' ) ) :
	/**
	 * Print comments block in single post page.
	 */
	function onestore_entry_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
endif;

if ( ! function_exists( 'onestore_entry_title' ) ) :
	/**
	 * Print entry title on each post.
	 *
	 * @param boolean $size
	 */
	function onestore_entry_title( $size = '' ) {
		$class = 'small' === $size ? 'entry-small-title' : 'entry-title';

		if ( is_singular() ) {
			the_title( '<h1 class="' . $class . '">', '</h1>' );
		} else {
			the_title( sprintf( '<h2 class="' . $class . '"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
	}
endif;

if ( ! function_exists( 'onestore_entry_featured_media' ) ) :
	/**
	 * Print post's featured media based on the specified post format.
	 */
	function onestore_entry_featured_media() {
		if ( intval( onestore_get_current_page_setting( 'content_hide_thumbnail' ) ) ) {
			return;
		}

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		printf(
			'<%s class="%s">%s</%s>',
			is_singular() ? 'div' : 'a href="' . esc_url( get_the_permalink() ) . '"',
			esc_attr( implode( ' ', apply_filters( 'onestore/frontend/entry/thumbnail_classes', array( 'entry-thumbnail' ) ) ) ),
			get_the_post_thumbnail(
				get_the_ID(),
				apply_filters( 'onestore/frontend/entry/thumbnail_size', 'full' )
			),
			is_singular() ? 'div' : 'a' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if ( ! function_exists( 'onestore_entry_header_meta' ) ) :
	/**
	 * Print entry meta.
	 *
	 * @param string $format
	 */
	function onestore_entry_meta( $format ) {
		if ( 'post' !== get_post_type() ) {
			return;
		}

		$format = trim( $format );
		$html = $format;

		if ( ! empty( $format ) ) {
			preg_match_all( '/{{(.*?)}}/', $format, $matches, PREG_SET_ORDER );

			foreach ( $matches as $match ) {
				ob_start();
				onestore_entry_meta_element( $match[1] );
				$meta = ob_get_clean();

				$html = str_replace( $match[0], $meta, $html );
			}

			if ( '' !== trim( $html ) ) {
				echo '<div class="entry-meta">' . $html . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'onestore_entry_header_meta' ) ) :
	/**
	 * Print entry header meta.
	 */
	function onestore_entry_header_meta() {
		onestore_entry_meta( onestore_get_theme_mod( 'entry_header_meta' ) );
	}
endif;

if ( ! function_exists( 'onestore_entry_footer_meta' ) ) :
	/**
	 * Print entry footer meta.
	 */
	function onestore_entry_footer_meta() {
		onestore_entry_meta( onestore_get_theme_mod( 'entry_footer_meta' ) );
	}
endif;

if ( ! function_exists( 'onestore_entry_grid_title' ) ) :
	/**
	 * Print entry grid title.
	 */
	function onestore_entry_grid_title() {
		onestore_entry_title( 'small' );
	}
endif;

if ( ! function_exists( 'onestore_entry_grid_featured_media' ) ) :
	/**
	 * Print entry grid featured media.
	 */
	function onestore_entry_grid_featured_media() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		printf(
			'<%s class="%s">%s</%s>',
			is_singular() ? 'div' : 'a href="' . esc_url( get_the_permalink() ) . '"',
			esc_attr( implode( ' ', apply_filters( 'onestore/frontend/entry_grid/thumbnail_classes', array( 'entry-thumbnail', 'entry-grid-thumbnail' ) ) ) ),
			get_the_post_thumbnail(
				get_the_ID(),
				apply_filters( 'onestore/frontend/entry_grid/thumbnail_size', 'medium_large' )
			),
			is_singular() ? 'div' : 'a' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if ( ! function_exists( 'onestore_entry_grid_header_meta' ) ) :
	/**
	 * Print entry grid header meta.
	 */
	function onestore_entry_grid_header_meta() {
		onestore_entry_meta( onestore_get_theme_mod( 'entry_grid_header_meta' ) );
	}
endif;

if ( ! function_exists( 'onestore_entry_grid_footer_meta' ) ) :
	/**
	 * Print entry grid footer meta.
	 */
	function onestore_entry_grid_footer_meta() {
		onestore_entry_meta( onestore_get_theme_mod( 'entry_grid_footer_meta' ) );
	}
endif;

if ( ! function_exists( 'onestore_entry_small_title' ) ) :
	/**
	 * Print entry small title.
	 */
	function onestore_entry_small_title() {
		onestore_entry_title( 'small' );
	}
endif;

/**
 * ====================================================
 * All index pages template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_archive_header' ) ) :
	/**
	 * Render archive header.
	 */
	function onestore_archive_header() {
		if ( has_action( 'onestore/frontend/archive_header' ) ) : ?>
		<header class="page-header">
				<?php
				/**
				 * Hook: onestore/frontend/archive_header
				 *
				 * @hooked onestore_archive_title - 10
				 * @hooked onestore_archive_description - 20
				 */
				do_action( 'onestore/frontend/archive_header' );
				?>
		</header>
		<?php endif;
	}
endif;

if ( ! function_exists( 'onestore_archive_title' ) ) :
	/**
	 * Render archive title.
	 */
	function onestore_archive_title() {
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	}
endif;

if ( ! function_exists( 'onestore_archive_description' ) ) :
	/**
	 * Render archive description.
	 */
	function onestore_archive_description() {
		the_archive_description( '<div class="archive-description">', '</div>' );
	}
endif;

if ( ! function_exists( 'onestore_search_header' ) ) :
	/**
	 * Render search header.
	 */
	function onestore_search_header() {
		?>
	<header class="page-header">
		<?php
		/**
		 * Hook: onestore/frontend/search_header
		 *
		 * @hooked onestore_search_title - 10
		 * @hooked onestore_search_form - 20
		 */
		do_action( 'onestore/frontend/search_header' );
		?>
	</header>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_search_title' ) ) :
	/**
	 * Render search title.
	 */
	function onestore_search_title() {
		?>
	<h1 class="page-title"><?php onestore_title__search(); ?></h1>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_search_form' ) ) :
	/**
	 * Render search form.
	 */
	function onestore_search_form() {
		get_search_form();
	}
endif;

if ( ! function_exists( 'onestore_loop_navigation' ) ) :
	/**
	 * Render posts loop navigation.
	 */
	function onestore_loop_navigation() {
		if ( ! is_archive() && ! is_home() && ! is_search() ) {
			return;
		}

		// Render posts navigation.
		switch ( onestore_get_theme_mod( 'blog_index_navigation_mode' ) ) {
			case 'pagination':
				the_posts_pagination(
					array(
						'mid_size'  => 3,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					)
				);
				break;

			default:
				the_posts_navigation(
					array(
						'prev_text' => esc_html__( 'Older Posts', 'onestore' ) . ' &raquo;',
						'next_text' => '&laquo; ' . esc_html__( 'Newer Posts', 'onestore' ),
					)
				);
				break;
		}
	}
endif;

/**
 * ====================================================
 * Single post template functions
 * ====================================================
 */

if ( ! function_exists( 'onestore_single_post_author_bio' ) ) :
	/**
	 * Render author bio block in single post page.
	 */
	function onestore_single_post_author_bio() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		if ( ! intval( onestore_get_theme_mod( 'blog_single_author_bio' ) ) ) {
			return;
		}

		onestore_get_template_part( 'blog-author-bio' );
	}
endif;

if ( ! function_exists( 'onestore_single_post_navigation' ) ) :
	/**
	 * Render prev / next post navigation in single post page.
	 */
	function onestore_single_post_navigation() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		if ( ! intval( onestore_get_theme_mod( 'blog_single_navigation' ) ) ) {
			return;
		}

		the_post_navigation(
			array(
				/* translators: %s: title syntax. */
				'prev_text' => sprintf( esc_html__( '%s &raquo;', 'onestore' ), '%title' ),
				/* translators: %s: title syntax. */
				'next_text' => sprintf( esc_html__( '&laquo; %s', 'onestore' ), '%title' ),
			)
		);
	}
endif;

if ( ! function_exists( 'onestore_comments_title' ) ) :
	/**
	 * Render comments title.
	 */
	function onestore_comments_title() {
		?>
	<h2 class="comments-title">
		<?php
			$comments_count = get_comments_number();
		if ( '1' === $comments_count ) {
			printf(
				/* translators: %1$s: title. */
				esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'onestore' ),
				'<span>' . get_the_title() . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		} else {
			printf(
				/* translators: %1$s: comment count number, %2$s: title. */
				esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comments_count, 'comments title', 'onestore' ) ),
				number_format_i18n( $comments_count ),
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'<span>' . get_the_title() . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
		?>
	</h2>
		<?php
	}
endif;

if ( ! function_exists( 'onestore_comments_navigation' ) ) :
	/**
	 * Render comments navigation.
	 */
	function onestore_comments_navigation() {
		the_comments_navigation();
	}
endif;

if ( ! function_exists( 'onestore_comments_closed' ) ) :
	/**
	 * Render comments closed message.
	 */
	function onestore_comments_closed() {
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'onestore' ); ?></p>
		<?php endif;
	}
endif;

/**
 * ====================================================
 * Customizer's partial refresh callback aliases
 * ====================================================
 */

function onestore_header_element__html_1() {
	onestore_header_element( 'html-1' );
}
function onestore_header_element__html_2() {
	onestore_header_element( 'html-2' );
}
function onestore_header_element__html_3() {
	onestore_header_element( 'html-3' );
}
function onestore_header_element__html_4() {
	onestore_header_element( 'html-4' );
}
function onestore_header_element__html_5() {
	onestore_header_element( 'html-5' );
}

function onestore_header_element__button_1() {
	onestore_header_element( 'button-1' );
}
function onestore_header_element__button_2() {
	onestore_header_element( 'button-2' );
}
function onestore_header_element__button_3() {
	onestore_header_element( 'button-3' );
}
function onestore_header_element__button_4() {
	onestore_header_element( 'button-4' );
}
function onestore_header_element__button_5() {
	onestore_header_element( 'button-5' );
}


function onestore_header_element__social() {
	onestore_header_element( 'social' );
}

function onestore_footer_element__logo() {
	onestore_footer_element( 'logo' );
}
function onestore_footer_element__copyright() {
	onestore_footer_element( 'copyright' );
}
function onestore_footer_element__social() {
	onestore_footer_element( 'social' );
}

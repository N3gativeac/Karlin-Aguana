=== VW Ecommerce Shop ===
Contributors: VWthemes
Tags: left-sidebar, right-sidebar, one-column, two-columns, three-columns, four-columns, grid-layout, wide-blocks, block-styles, block-patterns, custom-background, custom-logo, custom-menu, custom-header, custom-colors, editor-style, featured-images, footer-widgets, full-width-template, sticky-post, post-formats, flexible-header, featured-image-header, theme-options, translation-ready, threaded-comments, rtl-language-support, blog, e-commerce, portfolio
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 7.2.14
Stable tag: 0.6.2
License: GPLv3.0 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

 VW E-commerce Shop theme is the one that can check all the boxes relating to every need of your store. Our multipurpose E-commerce WordPress theme is social media integrated & highly responsive. It is built on bootstrap 4 with using clean coding standards.

== Description ==

VW E-commerce Shop theme is the one that can check all the boxes relating to every need of your store. Our multipurpose E-commerce WordPress theme is social media integrated & highly responsive. It is built on bootstrap 4 with using clean coding standards. It is cross-browser & woo commerce compatible, It has unique post formats, custom menu, typography features, Theme Options, product catalog, shopping cart, multiple customization options, has Call to action button, its SEO & user-friendly and works at its optimal best across all platforms. You may be a business owner, informative firm, Home Exercise Equipment, Natural Feminine Care Products, organic pet food, hand sanitizers, artist, restaurant owner, construction agency, healthcare firm, digital marketing agency, blogger, corporate business, freelancers, shopkeeper, retail Store, book depot, E bazar, jewelry shop, eCommerce Market, online food delivering website, Technology store, gadgets store, online apparel, fashion accessories store, sports equipment shop, digital Storefront, online bookstore, mobile & tablet store, apparel store, fashion store, shoes store, watch, sport equipment, furniture shop, supermarket, grocery store, sport store, handbags store, cosmetics shop, electronics, minimal, online store, woothemes, jewellery store and etc. You can set all kinds of stores up with much ease using our theme, as it is made for people like you. You could be a freelancer or a corporate entity or a sole proprietor. Our theme will boost your business and improve your revenue with the aid of seamless features and exclusive functionalities. Running an online E-commerce store along with your physical store is a hectic task. Your trouble is doubled, when you are not only supposed to take care of the physical presence of the store but you are also required to bring the online store up to speed. That is much like running two branches of a single business. This theme is compatible with YITH WooCommerce Wishlist, WooCommerce Variation Swatches and many more popular plugins. You cannot possibly put your faith into sub-standard things and expect results. E-commerce store should have a theme that is both impressive and lucrative. This medium attracts customers from so many platforms that it becomes important for the theme and the webpage to perform at its 100% at all times.

== Changelog ==

= 0.1 =
    -- Intial version Release

= 0.2 =
  -- Console Error Removed
  -- Screenshot Change
  -- Styling done

= 0.2.1 =
  --  Improper use of esc_url function, url parameter should not be empty
    echo '<a href="';
      echo esc_url();
    echo '">';
  --  No need to escape url when using on if conditionLicense Missing for header image( headphone ) of screenshot
  --  License Missing for header image( headphone ) of screenshot
  --  Use esc_url to escape url instead of esc_html
  --  Could you please tell me the reason to add this css on all admin pages. Add on specific admin pages only.
  --  use wp_reset_postdata() to reset global $post variable. custom-home-page.php
  --  post id will never be negative integer, so please use absint to esape postID.
    $mod = intval( get_theme_mod( 'vw_ecommerce_shop_page' . $count ));
  --  There is no use of wp_reset_postdata() here
    $vw_ecommerce_shop_k = 0;
  --  always follow late escaping. here you are escaping twice, just escpae in the point where you want to display the data
  --  get_posts() does not modify query post, so no need to use wp_reset_postdata()

= 0.2.2  =
  -- Removed the default data represent content creation.
  -- Changed the content creation to dynamic product category.

= 0.2.3 =
  -- Added the woocommerce theme support.
  -- Remove the unwanted code.
  -- Did some customization.

= 0.2.4 =
  -- Did the css changes in shop page.

= 0.2.5 =
  -- Set the logo title and description properly.
  -- Removed the email code.
  -- Removed the template_part called to does not exist i.e. get_template_part( 'no-results', 'archive' );

= 0.2.6 =
  -- Update font url code in function.php file.
  -- Update fontawesome file.
  -- Done the customization in footer.
  -- Change "text" to "url" in customizer.php file.

= 0.3.0 =
  -- Added Typography.
  -- Updated Woocommerce.
  -- Added post formats tag.
  -- Fixed theme bugs.
  -- Done responsive media styling.

= 0.3.1 =
  -- Update: Bootstrap version 4.0.0
  -- Update: language folder pot file.
  -- Update: rtl file.
  -- Added:  Post format, custom header, featured image header tags.
  -- Fixed:  Theme Minor issues.

= 0.3.2 =
  -- Update: Ecommerce in theme.
  -- Update: language folder pot file.
  -- Fixed:  Theme Error.

= 0.3.3 =
  -- Changed the woocommerce checkout page css.

= 0.3.4 =
  -- Removed: Translation from fonts.
  -- Fixed: Theme Error

= 0.3.5 =
  -- Updated: Woocommerce.
  -- Added:   function for product columns.
  -- Fixed:   Theme Error.

= 0.3.6 =
  -- Readme file is changed.
  -- Updated Language Folder.
  -- Fixed: Theme Error.
  -- Changed Slider.

= 0.3.7 =
  -- Updated language folder.
  -- Add footer layout option in customizer
  -- Add width layout option in customizer
  -- Add Show / hide Author, comment and post date option in customizer
  -- Add top to scroll with alignment option in customizer
  -- Add Global color option in customizer
  -- Add slider content layout option in customizer
  -- Add slider excerpt length option in customizer
  -- Add slider image opacity option in customizer
  -- Add logo resizer option in customizer

= 0.3.8 =
  -- Add show / hide scroll to top option in customizer
  -- Upadte language folder
  -- Done the css customization of page sidebar

= 0.3.9 =
  -- Added skip to content part in the theme.

= 0.4 =
  -- Changed navigation code.
  -- Done the css customization.
  -- Updated language folder.

= 0.4.1 =
  -- Add Show / hide topbar option in customizer
  -- Changed responsive menu layout.
  -- Added sticky header option in customizer.
  -- Changed single post and blog page layout.
  -- Updated language folder.

= 0.4.2 =
  -- Added blog layout option in customizer.
  -- Resolved the css customization.
  -- Updated language folder.

= 0.4.3 =
  -- Added Show / hide woocommerce sidebar option in customizer.
  -- Added preloader option in the customizer.
  -- Resolved the css customization.
  -- Updated language folder.

= 0.4.4 =
  -- Done woocommerce css customization.

= 0.4.5 =
  -- Added new settings in customizer.
  -- Updated language folder.

= 0.4.6 =
  -- Added settings for responsive media in customizer.
  -- Updated language folder.

= 0.4.7 =
  -- Added button text option in customizer.
  -- Updated language folder.

= 0.4.8 =
  -- Added fontawesome icon option for the icons in customizer.
  -- Resolved theme sniffer errors.
  -- Updated language folder.

= 0.4.9 =
  -- Customizable theme button option.
  -- Added Copyright alignment and padding option in customizer.
  -- Added topbar padding option in customizer.

= 0.5 =
  -- Added related post option in customizer.
  -- Added show/hide option for logo title and tagline.
  -- Added show/hide option for tags in customizer.

= 0.5.1 =
  -- Added post content options in customizer.
  -- Added post content excerpt suffix option in customizer. 
  -- Added about us widgets in widgets options.
  -- Added contact us widgets in widgets options.
  -- Added selective refresh. 
  -- Resolved errors.

= 0.5.2 =
  -- Tested upto WP v5.4
  -- Resolved errors.
  -- Done the css customization.
  -- Updated language folder.

= 0.5.3 =
  -- Added scroll to top font size, padding & border radius option in customizer.
  -- Added scroll to top Icons width & height option in customizer.
  -- Added show/ hide scroll to top option for responsive media in customizer.
  -- Added slider height option in customizer.
  -- Updated language folder.
  -- Resolved Responsive menu tab focus error.
  -- Resolved primary menu focus error.

= 0.5.4 =
  -- Added social Icons font size, padding & border radius option in customizer.
  -- Added social Icons width & height option in customizer.
  -- Added sticky header padding option in customizer.
  -- Added slider button text option in customizer.
  -- Resolved Widgets errors.
  -- Updated language folder.
  -- Changed admin bar code.

= 0.5.5 =
  -- Added slider speed option in customizer.
  -- Added show / hide blog posts pagination option in customizer.
  -- Added blog posts pagination types option in customizer.
  -- Added products per page option for shop page in customizer.
  -- Added products per row option for shop page in customizer.
  -- Added sanitize callback for numbers & range.
  -- Updated language folder.

= 0.5.6 =
  -- Added wocommerce products padding option in customizer.
  -- Added wocommerce products box shadow option in customizer.
  -- Added wocommerce products border option in customizer.
  -- Added show/hide single blog page navigation option in customizer.
  -- Added navigation text option for single blog page in customizer.
  -- Resolved navigation menu and widget error.
  -- Updated language folder.

= 0.5.7 =
  -- Done some changes and css customization in get started.
  -- Added block style , wide align blocks & flexible header.
  -- Updated language folder.

= 0.5.8 =
  -- Done the css of block style button.
  -- Resolved errors.
  -- Updated language folder.

= 0.5.9 =
  -- Added block pattern tag.
  -- Done escaping.
  -- Remove h3 from activation notice.
  -- Changed anchor tag focus.

= 0.6 =
  -- Added get started tab.
  -- Done escaping of get_template_directory_uri.
  -- Reduced folder image size - compressing images.
  -- Remove font-family from get started css.
  -- Added get started page tab css.
  -- Remove font url from get started.

= 0.6.1 =
  -- Resolved mobile menu close button & admin bar sticky header error.
  -- Added suffix for fontawesome in function.php.
  -- Added css for getstarted tab box.
  -- Added new dashicons in getstarted.php
  -- Removed get started images (wrong & right) and add fontawesome icons instead of it.
  -- Resolved error of sticky header, slider, topbar & scroll to top show/ hide does not work in responsive media settings.
  -- Resolved error of scroll appears on the top of the page & scroll appears first after refreshing page.

= 0.6.2 =
  -- Done product sec css of block pattern in mobile media.
  -- Done css of slider button in mobile media.
  -- Added sidebar a tag hover in blog page.
  -- Added hover on a tag in metabox in single & blog page.
  -- Resolved error slider height in responsive.
  -- Escaped $description function.
  -- Done css of coupan code.
  -- Done css of cart button.
  -- Done css of my account page.
  -- Done css of login page.
  -- Done css of product title on Shop page & single product page.
  -- Resolved error of header search in responsive media.
  -- Resolved error of On loading screen product section, logo & sticky header are showing.
  -- Added global color of a tag hover of metabox.
  -- Resolved error of phone no. is not clickable.
  -- Done css of 404 page.
  -- Resolved error of header search on the shop page.
  -- Remove aligncenter class - border & padding from style.css
  -- Remove content-vw p: text-align:justify class from style.css
  -- Added link to customizer links in block pattern.
  -- Done the css of link to customizer links in block pattern.

== Resources ==

VW Ecommerce Shop WordPress Theme, Copyright 2017 VW Themes
VW Ecommerce Shop is distributed under the terms of the GNU GPL.

VW Ecommerce Shop WordPress Theme bundles the following third-party resources:

= Bootstrap =
* Mark Otto
* copyright 2011-2020, Mark Otto
* https://github.com/twbs/bootstrap/releases/download/v4.0.0/bootstrap-4.0.0-dist.zip
* License: Code released under the MIT License. v4.4.1
* https://github.com/twbs/bootstrap/blob/master/LICENSE

= Font-Awesome =
* Davegandy
* copyright July 12, 2018, Davegandy
* https://github.com/FortAwesome/Font-Awesome.git
* License: http://fontawesome.com/license - Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License.
* https://github.com/FortAwesome/Font-Awesome/blob/master/LICENSE.txt

= Customizer Pro =
* Justin Tadlock
* Copyright 2016, Justin Tadlock
* https://github.com/justintadlock/trt-customizer-pro.git
* License: GNU General Public License v2.0
* http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

= Superfish =
* Joeldbirch
* Copyright 2013, Justin Tadlock
* https://github.com/joeldbirch/superfish.git
* License: Free to use and abuse under the MIT license. v1.7.9
* https://github.com/joeldbirch/superfish/blob/master/MIT-LICENSE.txt

= Typography =
* Justin Tadlock
* Copyright 2015, Justin Tadlock
* https://github.com/justintadlock/customizer-typography.git
* License: GNU General Public License v2.0
* https://github.com/justintadlock/customizer-typography/blob/master/license.md

* Open Sans font - https://www.google.com/fonts/specimen/Open+Sans
  PT Sans font - https://fonts.google.com/specimen/PT+Sans
  Roboto font - https://fonts.google.com/specimen/Roboto
  License: Distributed under the terms of the Apache License, version 2.0 http://www.apache.org/licenses/LICENSE-2.0.html

* Stocksnap Images
  License: CC0 1.0 Universal (CC0 1.0) 
  Source: https://stocksnap.io/license
  
  Slider image, Copyright Burst
  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://stocksnap.io/photo/EXCBJA3FFQ

  Product image, Copyright Nordwood Themes
  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://stocksnap.io/photo/Y6SDOYW0KA

  Product image, Copyright Freestocks.org
  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://stocksnap.io/photo/EC1PNPT1N1

  Product image, Copyright Ylanite Koppens
  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://stocksnap.io/photo/JMGEUCEUJY

  Product image, Copyright Matthew Henry
  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://stocksnap.io/photo/674UH7HXHE

== Theme Documentation ==
Documentation : https://www.vwthemesdemo.com/docs/free-vw-ecommerce-lite/
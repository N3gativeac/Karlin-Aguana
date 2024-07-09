=== Category Editor ===
Contributors: ypraise
Donate link: https://ypraise.com/shop/wordpress-plugins/category-editor/
Tags: category description, wp_editor, tag description
Requires at least: 3.3
Tested up to: 5.6
Stable tag: 3.8.3
Version: 3.8.3

Provides the ability to add a fully functional tinymce editor and html plus shortcodes to the category description and tag description to style up the introductory information for category archives.

== Description ==

<center>
<iframe src="https://www.youtube.com/embed/XjyabLCwfcs" width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe></center><strong>Are you bored of plain old lists for your category and tag archive pages?</strong>

This plugin gives you the ability to pimp up your archives with a fully customisable top description area. You can use html or shortcodes to give a better uder interface and boost the search engine optimisation of archive pages. This means you can turn your category archive page or tag page into a fully developed landing page. No longer just a plain list of posts or products but a customised page packed full of features that will excite your visitors and the search engines.

<strong>Category Editor </strong> works with any theme that is written to Wordpress standards and includes the category description call.

The plugin adds a Wordpress editor to the category description area in the admin and the editor allows you the full options to format and design your top description area before the lists of posts.

It's ideal for blogs and is fully compatible with Woocommerce and other ecommerce plugins. Provided the theme calls the Wordpress category, tag or terms description then you have the ability to format and design the area.

Add media, use shortcodes and turbo charge the category archive page with images and anything else you can think of.

With the <a href="https://ypraise.com/shop/wordpress-plugins/category-editor/">PRO version (now renamed Category Editor Pro)</a> you also get the option to have an additional area of description at the end of the lists of posts or products. This is really useful for many situations when you want to add lots of extra content to the archive page but don't want visitors to have to scroll down to get to the list of products or posts.

<strong>Category Image Menu Grid.</strong>

You can assign an image to a category and then use a shortcode to display a list of the categories. This gives you the opportunity to make a graphical menu or highlight certain categories on blog posts or pages. This works with WordPress blog categories.

In the category edit page assign an image to the category with the upload image link. Either upload and image or use one from your media library. Once uploaded or chosen you need to click on the file url button to get the full url. Copy that and paste it into the text area to assign to category.

You can use the shortcode [ catimmg ] (without spaces) to call all your categories. There are 2 attributes you can use:
<ul>
 	<li>number - this limits the total number of categories to call.</li>
 	<li>categories - this allows you to chose which category to display using the category id number.</li>
</ul>
A full shortcode could look like : [ catimmg categories="123,2356,675,9876" ] this will display the images and link to the named categories using a comma separated list of category ids.

Another could be [ catimmg number="5"] this would limit the number of categories displayed to 5.

<strong>Styling of category graphic menu</strong>

There has been no styling applied to this list. The css available is:
<ul>
 	<li>.catimgmain - this is the main container</li>
 	<li>.catimmgeach - this is the individual category containers</li>
 	<li>.cattitle - this is the title of the category</li>
</ul>
I've intentionally left the css styling empty so you can choose how to display the menu yourself. There's lots of ways to produce grids now in css and everyone has their personal favourite. As a start here is an example css style you can add to your customise &gt; additional css option.

.catimgmain{display:block;}
.catimmgeach{display:inline-block;width:20%;vertical-align:bottom;margin:10px;}
.cattitle{font-weight:600;}

<strong> Og:image support</stong>
Version 3.8 has introduced og:image option for Wordpress categories and Woocommerce product categories. The og:image meta property is used by social platforms to display your prefered image when someone shares your page to a social platform.


<h3>Pro Version:</h3>
The pro version of CategoryTinyMce offers:

og:image option also available for wordpress tags and Woocommerce product tag archives.

A second description areas below the list of blog or products to help you build out SEO on category and tag pages.

The graphical menu shortcode also works for tags. There are also additional shortcodes to help make life easier such as only displaying parent categories or only displaying child categories of current category.

<strong>Support:</strong>

The free version of the plugin gets limited support. I check the support forum every week or two to see if there is any issues that need addressing. I do not provide email or one to one support for the free version.

If you want quick support (Monday - Friday, 9.00am - 5.00pm UK time) then you will need to use the PRO version.



== Installation ==

1. Upload Category Editor folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your category edit pages and start to style them up.


== Frequently Asked Questions ==

= What exactly does this plugin do to my Wordpress installation =

1. The plugin removes the default category description field.
2. It then adds in a new field that is fully tinymce enabled. I did try and just add an editor to the default field but I could not get it to function correctly. The new field saves to the same database section as the default field so no new database tables or fields are added.
3. The plugin runs a filter on the category edit admin pages to remove the default description field as this broke up the admin table and made it unweildly.


= The plugin does not work =

The plugin in was tested on a clean install of wordpress 3.3 and a child theme of 2010. If the plugin does not work then raise a topic for this plugin and tell me: what version of wordpress you are using, what theme are you using, do you have problems with any other tinymce call in your theme.

Does your theme make a call to the the_archive_description function? If you theme does not display a category description by default then you will need to edit the theme to include the call. 



== Screenshots ==

1. A new tinymce enabled category description box is added to the category edit screen.
2. The category description box and column are removed form the admin page to keep it looking nice.


== Changelog ==

= 3.8.3 =
* code tidy up and check with latest version of Wordpress 5.6

= 3.8.2 =
* first stage of plugin rename following request from Tiny who own the term TinyMCE

= 3.8.1 = 
* Bug Fix - fixed bug that caused issues for sites without woocommerce installed.

= 3.8 = 
* New feature - og:image support for Wordpress categories and Woocommerce product categories.

= 3.7.3 =
* fixed bug. Opening div placed outside php buffer causing conflicts with styling and incorrectly closed div section.

= 3.7.2 =
* Fixed a couple of bugs on tag edit options. (seo options and image save option.)

= 3.7.1 =
* Removed some development code from shortcode that printed out category id's below image grid.

= 3.7 = 
* New feature - shortcode to display graphical menu using category thumbnails.

= 3.6.5 =
* Updated to deal with changes to div id's in latest versiuon of Wordpress to hide the old description box and also to deal with new get screen calls.

= 3.6.4 =
* added support for Wordpress translate function

= 3.6.3 =
* added css fix provided by hafman to prevent unwanted hiding of editor boxes.

= 3.6.2 =
* security enhancement
* notification of CategoryTinymce 5.0 at http://wp.ypraise.com/2014/boost-your-categories-with-categorytinymce-4-0/

=3.6.1=
* the css for removing the old description field was removing all fields in edit screens called description (eg user profile edit) I've added a page check to ensure the css is only called for category edit pages.

= 3.6 =
* Removed bottom description from plugin as these do not work with Wordpress 4.0 and later. The default Wordpress categroy and tag descriptions still work though. 
* Remvoed filter that hide the description in category and tag listing pages - use your own screen display options on the page.
* Hide the old description boxes with css from jquery.

= 3.5.1 =
* Notification of CategoryTinymce 4.0 at http://wp.ypraise.com/

= 3.5 = 
* Notification of ending of support for this plugin due to latest update of Wordpress to 3.9

= 3.4 =
* Change readme file to up date FAQ for woocommerce - I'd been calling the wrong id.

= 3.3 =
* Change read me to show how to add bottom description to a woocommerce product category.

= 3.2 = 
* Added settings page so people who do not want SEO can switch it off.

= 3.1 =
* Combined tag and category hooks to stop conflict on title re-writes

= 3.0 =
* Tags now have bottom description, taq image and SEO meta abilities.

= 2.4 =
* Fixed issue of losing titles on single pages

= 2.3 =
* added seo meta options for categories

= 2.2 =
* added wp stripslashes_deep function call to deal with some reports of auto escaping slashes causing problems with shortcode use

= 2.1 =
* Removed BOM from php file
* Removed some rogue code I forget to take out after testing
* Set wpautop to false to try and stop paragraphs and linebreaks being removed
* Adapted call to second description code to allow for shortcodes

= 2.0 =
* add ability to add a description to the bottom of the category listing. Evidently this is useful in ecommerce sites but I guess it can also help to add extra category specific information or advertising.
* add ability to set a category image
* to use both of the above you will need to add code to your template to display the output

= 1.8 =
* Better fix for loss of data which also allows for the saving of multiple paragraphs. I'd miss typed a fix provided by BugTracker earlier.

= 1.7 =
* Added fix to stop description from deleting when saving with multiple empty paragraphs. Multiple empty paragraphs will be deleted on saving still but all the data will not be lost. If you want to increase spacing between paragraphs use css not empty paragraphs. 


= 1.6 =
* added shortcode abilities - thanks to nikosnikos for suggested and code.
* fixed issue with quote marks causing problems with rendering saved descriptions in some cases - thanks to BugTracker for fix.

= 1.5 =
* tackled the parent category option bug and cleaned up some css code - thanks to Brightweb for fixes.

= 1.4 =
* support for custom taxonomies - thanks to Jaime Martinez for adapting the taxonomy call line.

= 1.3 =
* forced a button style css width to correct the one button per row bug in html quicktags.

= 1.2 =
* dealt with the issue that prevented setting parent categories..

= 1.1 =
* extened the plugin to include tags as there's been no issues raised with the basic category description plugin.

= 1.0 =
* The first flavour launched.


== Upgrade Notice ==

= 3.8.2 =
* code tidy up and checked with latest version of Wordpress 5.6

= 3.8.2 =
* first stage of plugin rename following request from Tiny who own the term TinyMCE

= 3.8.1 = 
* Bug Fix - fixed bug that caused issues for sites without woocommerce installed.

= 3.8 = 
* New feature - og:image support for Wordpress categories and Woocommerce product categories.

= 3.7.3 =
* fixed bug. Opening div placed outside php buffer causing conflicts with styling and incorrectly closed div section.

= 3.7.2 =
* Fixed a couple of bugs on tag edit options. (seo options and image save option.)

= 3.7.1 =
* Removed some development code from shortcode that printed out category id's below image grid.

= 3.7 = 
* New feature - shortcode to display graphical menu using category thumbnails.

= 3.6.4 =
* added support for Wordpress translate function

= 3.6.3
* added css fix provided by hafman to prevent unwanted hiding of editor boxes.

= 3.6.2 =
* security enhancement
* notification of CategoryTinymce 5.0 at http://wp.ypraise.com/2014/boost-your-categories-with-categorytinymce-4-0/

=3.6.1=
* the css for removing the old description field was removing all fields in edit screens called description (eg user profile edit) I've added a page check to ensure the css is only called for category edit pages.

= 3.6 =
* Removed bottom description and SEO as these are not working in Wordpress 4.0 with the free version of CategoryTinymce.

= 3.5.1 =
* Notification of CategoryTinymce 4.0 at http://wp.ypraise.com/

= 3.5 = 
* Notification of ending of support for this plugin due to latest update of Wordpress to 3.9

= 3.4 =
* Change readme file to up date FAQ for woocommerce - I'd been calling the wrong id.

= 3.3 =
* Change read me to show how to add bottom description to a woocommerce product category.

= 3.2 =
* Added settings page so people who do ot want SEO can switch it off.

= 3.1 =
* Combined tag and category hooks to stop conflict on title re-writes

= 3.0 =
* Tags now have bottom description, taq image and SEO meta abilities.

= 2.4 =
* Fixed issue of losing titles on single pages

= 2.3 =
* added seo meta options for categories

= 2.2 =
* added wp stripslashes_deep function call to deal with some reports of auto escaping slashes causing problems with shortcode use

= 2.1 =
* Removed BOM from php file
* Removed some rogue code I forget to take out after testing
* Set wpautop to false to try and stop paragraphs and linebreaks being removed
* Adapted call to second description code to allow for shortcodes

= 2.0 =
* add ability to add a description to the bottom of the category listing. Evidently this is useful in ecommerce sites but I guess it can also help to add extra category specific information or advertising.
* add ability to set a category image
* to use both of the above you will need to add code to your template to display the output

= 1.8 =
* Better fix for loss of data which also allows for the saving of multiple paragraphs. I'd miss typed a fix provided by BugTracker earlier.

= 1.7 =
* Added fix to stop description from deleting when saving with multiple empty paragraphs. Multiple empty paragraphs will be deleted on saving still but all the data will not be lost. If you want to increase spacing between paragraphs use css not empty paragraphs. 

= 1.6 =
* added shortcode abilities - thanks to nikosnikos for suggested and code.
* fixed issue with quote marks causing problems with rendering saved descriptions in some cases - thanks to BugTracker for fix.

= 1.5 =
tackled the parent category option bug and cleaned up some css code - thanks to Brightweb for fixes.

= 1.4 =
Support for custom taxonomies.

= 1.3 = 
Corrected a missing css stlye for buttons in html quicktags.

= 1.2 =
Upgrade if you need to be able to set parent categories on the category admin pages.

= 1.1 =
Upgrade if you want to use the plugin on tag descriptions and pages.

= 1.0 =
None
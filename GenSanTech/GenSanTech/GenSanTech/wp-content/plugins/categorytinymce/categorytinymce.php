<?php
/*
Plugin Name: Category Editor
Plugin URI: https://ypraise.com/shop/wordpress-plugins/category-editor/
Description: Adds a tinymce enable box to the category descriptions and taxonomy page.
Version: 3.8.3
Text Domain: categorytinymce
Author: Kevin Heath
Author URI: https://ypraise.com/category/blog/
License: GPL
*/
/*  Copyright 2013  Kevin Heath  (email : kevin@ypraise.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if( !is_admin() ) {
        return;
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// lets set up the settings page

add_action( 'admin_menu', 'catMCE_menu' );


function CatMCE_menu() {
	add_options_page( 'CatMCE settings', 'CategoryTinyMCE', 'manage_options', 'catMCE', 'catMCE_options' );
}

add_action ('admin_init', 'catMCE_register');

function catMCE_register(){
register_setting('catMCE_options', 'catMCE_seo');
}


function catMCE_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __e( 'You do not have sufficient permissions to access this page.', 'categorytinymce' ) );
	}
	?>
	<div class="wrap">
	<h2>
	<?php
	_e('CategoryTinyMCE SEO Settings', 'categorytinymce');
	?>
	</h2>
	<div id="donate_container">
	<?php
	
    _e('The latest fully maintained version (Categorytinymce 4.x) which includes the bottom listing description box can be found at http://wp.ypraise.com/. Adding a bottom description for your categories and tags can help you with your user experience and SEO.','categorytinymce');
  
?>
  </div>
	
	<p><form method="post" action="options.php">	</p>
	<p>
	<?php
	_e('SEO Settings for CategoryTinyMCE:', 'categorytinymce');
	?>
	</p>
	
	<?php
	
	settings_fields( 'catMCE_options' );
	
?>
<p>
<?php
_e('Choose SEO: ','categorytinymce');
?> 

<input type="checkbox" name="catMCE_seo" value="1" <?php checked( '1', get_option( 'catMCE_seo' ) ); ?> />
							</p>

 <?php


	
 submit_button();
echo '</form>';

	
	echo '</div>';
}


// lets remove the html filtering
   
	remove_filter( 'pre_term_description', 'wp_filter_kses' );
	remove_filter( 'term_description', 'wp_kses_data' );

	
// add extra css to display quicktags correctly
add_action( 'admin_print_styles', 'categorytinymce_admin_head' );


function categorytinymce_admin_head() { 
      global $current_screen;
if ( $current_screen->id == 'edit-category' OR 'edit-tag' ) { 

?>
<style type="text/css">
  .quicktags-toolbar input{float:left !important; width:auto !important;}
  </style>
  
<?php	} }

	
// lets add our new cat description box	
   
define('description1', 'Category_Description_option');
add_filter('edit_category_form_fields', 'description1');


function description1($tag) {
    $tag_extra_fields = get_option(description1);
    ?>

<table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="description"><?php _e('Description', 'categorytinymce'); ?></label></th>
			<td>
	<?php  
	$settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );	
		wp_editor(html_entity_decode($tag->description , ENT_QUOTES, 'UTF-8'), 'description1', $settings); ?>	
	<br />
	<span class="description"><?php _e('The description is not prominent by default, however some themes may show it.', 'categorytinymce'); ?></span>
	</td>	
        </tr>
     
</table>
    <?php

}

//add extra fields to category edit form hook
add_action ( 'edit_category_form_fields', 'extra_category_fields');
//add extra fields to category edit form callback function
function extra_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id");
?>
<table class="form-table">
<tr></tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="cat_Image_url"><?php _e('Category Image Url', 'categorytinymce'); ?></label></th>
<td>
<input type="textarea" name="Cat_meta[img]" id="Cat_meta[img]" size="3" style="width:60%;" value="<?php echo $cat_meta['img'] ? $cat_meta['img'] : ''; ?>"><br />
            <span class="description"><?php _e('Image for category: use full url with https:// or http://. Use the image upload option to upload an image or search your media library. Once you have found your image, select the size and click file url to get the url to paste into above field. ', 'categorytinymce'); ?></span>
			
			<a onclick="return false;" title="Upload image" class="thickbox" id="add_image" href="media-upload.php?type=image&amp;TB_iframe=true&amp;width=640&amp;height=105">Upload Image</a>
        </td>
</tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="cat_ogImage_url"><?php _e('Category OG:Image Url', 'categorytinymce'); ?></label></th>
<td>
<input type="textarea" name="Cat_meta[ogimg]" id="Cat_meta[ogimg]" size="3" style="width:60%;" value="<?php echo $cat_meta['ogimg'] ? $cat_meta['ogimg'] : ''; ?>"><br />
            <span class="description"><?php _e('Image for category: use full url with https:// or http://. Use the image upload option to upload an image or search your media library. Once you have found your image, select the size and click file url to get the url to paste into above field. ', 'categorytinymce'); ?></span>
			
			<a onclick="return false;" title="Upload image" class="thickbox" id="add_image" href="media-upload.php?type=image&amp;TB_iframe=true&amp;width=640&amp;height=105">Upload Image</a>
        </td>
</tr>





<tr></tr>
<?php $catseo = get_option('catMCE_seo');
if ($catseo == "1") { ?>
<tr class="form-field">
<th scope="row" valign="top"><label for="seo_met_title"><?php _e('SEO Meta Title', 'categorytinymce'); ?></label></th>
<td>
<input type="text" name="Cat_meta[seo_met_title]" id="Cat_meta[seo_met_title]" size="3" style="width:60%;" value="<?php echo $cat_meta['seo_met_title'] ? $cat_meta['seo_met_title'] : ''; ?>"><br />
            <span class="description"><?php _e('Add title for head section. recommended 60 characters max', 'categorytinymce'); ?></span>
        </td>
</tr>

<tr></tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="seo_met_keywords"><?php _e('SEO Meta Keywords', 'categorytinymce'); ?></label></th>
<td>
<input type="text" name="Cat_meta[seo_met_keywords]" id="Cat_meta[seo_met_keywords]" size="3" style="width:60%;" value="<?php echo $cat_meta['seo_met_keywords'] ? $cat_meta['seo_met_keywords'] : ''; ?>"><br />
            <span class="description"><?php _e('Add keywords for head section. separate with commas', 'categorytinymce'); ?></span>
        </td>
</tr>

<tr></tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="seo_met_description"><?php _e('SEO Meta Description', 'categorytinymce'); ?></label></th>
<td>
<textarea rows="4" name="Cat_meta[seo_met_description]" id="Cat_meta[seo_met_description]" size="3" style="width:60%;" ><?php echo $cat_meta['seo_met_description'] ? $cat_meta['seo_met_description'] : ''; ?></textarea><br />
            <span class="description"><?php _e('Add description for head section. recommended 140 characters max', 'categorytinymce'); ?></span>
        </td>
</tr>
	<?php } ?>

</table>
<?php
}



// save extra category extra fields hook
add_action ( 'edited_category', 'save_extra_category_fileds');
   // save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys ($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] =stripslashes_deep($_POST['Cat_meta'][$key]);
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}






// lets add our new tag description box	
   
define('description2', 'Tag_Description_option');
add_filter('edit_tag_form_fields', 'description2');

function description2($tag) {
    $tag_extra_fields = get_option(description1);
    ?>

<table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'categorytinymce'); ?></label></th>
			<td>
	<?php  
	$settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );	
	wp_editor(html_entity_decode($tag->description , ENT_QUOTES, 'UTF-8'), 'description2', $settings ); ?>	
	<br />
	<span class="description"><?php _e('The description is not prominent by default, however some themes may show it.', 'categorytinymce'); ?></span>
	</td>	
        </tr>
     
</table>


   <?php

}

//add extra fields to tag edit form hook
add_action ( 'edit_tag_form_fields', 'extra_tag_fields');
//add extra fields to category edit form callback function
function extra_tag_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $tag_meta = get_option( "tag_$t_id");
?>
<table class="form-table">
<tr class="form-field">
<th scope="row" valign="top"><label for="tag_Image_url"><?php _e('Tag Image Url', 'categorytinymce'); ?></label></th>
<td>
<input type="text" name="tag_meta[tag_img]" id="tag_meta[tag_img]" size="3" style="width:60%;" value="<?php echo $tag_meta['tag_img'] ? $tag_meta['tag_img'] : ''; ?>"><br />
            <span class="description"><?php _e('Image for tag: use full url with https:// or http://. Use the image upload option to upload an image or search your media library. Once you have found your image, select the size and click file url to get the url to paste into above field. ', 'categorytinymce'); ?></span>
			
			<a onclick="return false;" title="Upload image" class="thickbox" id="add_image" href="media-upload.php?type=image&amp;TB_iframe=true&amp;width=640&amp;height=105">Upload Image</a>
        </td>

</tr>
<table class="form-table">
<tr class="form-field">
<th scope="row" valign="top"><label for="tag_ogImage_url"><?php _e('Tag og:Image Url', 'categorytinymce'); ?></label></th>
<td>
<input type="text" name="tag_meta[tag_ogimg]" id="tag_meta[tag_ogimg]" size="3" style="width:60%;" value="<?php echo $tag_meta['tag_ogimg'] ? $tag_meta['tag_ogimg'] : ''; ?>"><br />
            <span class="description"><?php _e('og:Image for tag sharing: use full url with https:// or http://. Use the image upload option to upload an image or search your media library. Once you have found your image, select the size and click file url to get the url to paste into above field. og:image meta prperty tags are only set for wordpress categories and woocommerce product categories in free version of Category Tinymce. ', 'categorytinymce'); ?></span>
			
			<a onclick="return false;" title="Upload image" class="thickbox" id="add_image" href="media-upload.php?type=image&amp;TB_iframe=true&amp;width=640&amp;height=105">Upload Image</a>
        </td>

</tr>

<tr></tr>
<?php $catseo = get_option('catMCE_seo');
if ($catseo == "1") { ?>


<tr></tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="seo_met_keywords"><?php _e('SEO Meta Keywords', 'categorytinymce'); ?></label></th>
<td>
<input type="text" name="tag_meta[seo_met_keywords]" id="tag_meta[seo_met_keywords]" size="3" style="width:60%;" value="<?php echo $tag_meta['seo_met_keywords'] ? $tag_meta['seo_met_keywords'] : ''; ?>"><br />
            <span class="description"><?php _e('Add keywords for head section. separate with commas', 'categorytinymce'); ?></span>
        </td>
</tr>

<tr></tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="seo_met_description"><?php _e('SEO Meta Description', 'categorytinymce'); ?></label></th>
<td>
<textarea rows="4" name="tag_meta[seo_met_description]" id="tag_meta[seo_met_description]" size="3" style="width:60%;" ><?php echo $tag_meta['seo_met_description'] ? $tag_meta['seo_met_description'] : ''; ?></textarea><br />
            <span class="description"><?php _e('Add description for head section. recommended 140 characters max', 'categorytinymce'); ?></span>
        </td>
</tr>
	<?php } ?>


<?php
}



// save extra tag extra fields hook
add_action ( 'edited_terms', 'save_extra_tag_fileds');
   // save extra tag extra fields callback function
function save_extra_tag_fileds( $term_id ) {
    if ( isset( $_POST['tag_meta'] ) ) {
        $t_id = $term_id;
        $tag_meta = get_option( "tag_$t_id");
        $tag_keys = array_keys ($_POST['tag_meta']);
            foreach ($tag_keys as $key){
            if (isset($_POST['tag_meta'][$key])){
                $tag_meta[$key] =stripslashes_deep($_POST['tag_meta'][$key]);
            }
        }
        //save the option array
        update_option( "tag_$t_id", $tag_meta );
    }
}


// lets add the tag meta to category head

$catseo = get_option('catMCE_seo');
if ($catseo == "1") {
function add_tagseo_meta()
 {  
  if ( is_category() ) {
 
$cat_id = get_query_var('cat');
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
$cat_data = get_option("category_$term_id");
if (isset($cat_data['seo_met_description'])){           
 
 ?>
          <meta name="description" content="<?php echo $cat_data['seo_met_description']; ?>">
       
<?php
	  }  


if (isset($cat_data['seo_met_keywords'])){           
 
 ?>
          <meta name="keywords" content="<?php echo $cat_data['seo_met_keywords']; ?>">
       
<?php
	  }  





	  }
 elseif ( is_tag() ) {
 
$tag_id = get_query_var('tag');

$queried_object = get_queried_object();
$term_id = $queried_object->term_id;

$tag_data = get_option("tag_$term_id");

    if (isset($tag_data['seo_met_description'])){     
 
 ?>
          <meta name="description" content="<?php echo $tag_data['seo_met_description'] ?>">
       
<?php
 
}
if (isset($tag_data['seo_met_keywords'])){           
 
 ?>
          <meta name="keywords" content="<?php echo $tag_data['seo_met_keywords']; ?>">
       
<?php
	  }  





	  }   }
	
add_action('wp_head', 'add_tagseo_meta');


function add_tag_title()
 {  
  if (is_category()){
 $cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id");
 
 if (isset($cat_data['seo_met_title'])){  

 $title = $cat_data['seo_met_title']; 
 
return $title;

	  }
	  else{
	  $current_category = single_cat_title("", false); 
	$title = $current_category .' | ' . get_bloginfo( "name", "display" ); 

	  return $title;
	  }
}
 elseif (is_tag()){
$tag_id = get_query_var('tag');

$queried_object = get_queried_object();
$term_id = $queried_object->term_id;

$tag_data = get_option("tag_$term_id");
 
 if (isset($tag_data['seo_met_title'])){  

 $title = $tag_data['seo_met_title']; 
 
return $title;

	  }
	  else{
	  $current_tag = single_tag_title("", false); 
	$title = $current_tag .' | ' . get_bloginfo( "name", "display" ); 

	  return $title;
	  }
}
elseif (is_home() || is_front_page() )
{
$title = get_bloginfo( "name", "display" ) .' | ' . get_bloginfo( "description", "display" ); 

	  return $title;

}

else {
$title =  get_the_title() . ' | ' . get_bloginfo( "name", "display" );
 return $title;
}
 
 }

 add_filter( 'wp_title', 'add_tag_title', 1000 );
}
 
	  



add_filter('term_description', 'do_shortcode');
// when a category is removed delete the new box

add_filter('deleted_term_taxonomy', 'remove_Category_Extras');
function remove_Category_Extras($term_id) {
  if($_POST['taxonomy'] == 'category'):
    $tag_extra_fields = get_option(Category_Extras);
    unset($tag_extra_fields[$term_id]);
    update_option(Category_Extras, $tag_extra_fields);
  endif;
}

// quick jquery to hide the default cat description box

function hide_category_description() {
      $screen = get_current_screen();
if ( $screen->id == 'edit-category' ) { 
?>
<script type="text/javascript">
jQuery(function($) {
 $('#wp-description-wrap').hide();
 }); 
 </script> <?php
 } 
	  } 
	  
	  // quick jquery to hide the default tag description box

function hide_tag_description() {
           $screen = get_current_screen();
if ( $screen->base == 'term' ) {
?>
<script type="text/javascript">
jQuery(function($) {
 $('.term-description-wrap').hide();
 }); 
 </script> <?php
 } 
	  } 
	  
// lets hide the cat description from the category admin page

add_action('admin_head', 'hide_category_description'); 
add_action('admin_head', 'hide_tag_description'); 


// Shortcodes for cat and tag image menu
if (!is_admin()){
	
	
function catimmg($atts) {
	ob_start();
	
	$catvalue = shortcode_atts( array(
        'number' => -1,
        'categories' => '',
    ), $atts );

 ?>
<div class="catimmgmain">
<?php
$categories = get_categories();


$catopts = $catvalue['categories'];
$catcount = $catvalue['number'];
if($catopts =='' ) {


$cvd= 0;
foreach($categories as $category) {
if($cvd==$catcount) break;	
	

$cat_id = $category->term_id;
$cat_data = get_option("category_$cat_id");

	
	?>
	<div class="catimmgeach" id="catimmgchild" align="center">
<a href="<?php echo get_category_link($category->term_id); ?>">	<?php 
	
	if (isset($cat_data['img'])){ 
	

echo '<img src="'.$cat_data['img'].'" alt="'.$category->cat_name.'">';
}
	?>
	
	<?php echo $category->name; ?></a>

	
	</div>

 <?php  
$cvd++;
  }
   
   
?>
</div>
<?php
}
else { 
$args = array(  
   
    'include'                  =>$catvalue['categories'] // desire id
); 

$categories = get_categories($args );

$cvd= 0;

foreach($categories as $category) {
	

	
if($cvd==$catcount) break;	
	

$cat_id = $category->term_id;
$cat_data = get_option("category_$cat_id");

	
	?>
	<div class="catimmgeach" id="catimmgchild" align="center">
<a href="<?php echo get_category_link($category->term_id); ?>">	<?php 
	
	if (isset($cat_data['img'])){ 
	

echo '<img src="'.$cat_data['img'].'" alt="'.$category->cat_name.'">';
}
	?>
	
	<?php echo $category->name; ?></a>

	
	</div>

 <?php 


 
$cvd++;
  }
   
   
?>
</div>

<?php

}
	


return ob_get_clean();
}

add_shortcode( 'catimmg', 'catimmg' );
}

/////////////////// og meta
function add_ogmeta_tags() {
		


	  if ( is_category()) {
		  
				$cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id");  

if (isset($cat_data['ogimg'])){ 
 ?>
           <meta property="og:image" content="<?php echo $cat_data['ogimg']; ?>">
       
<?php
	  }  
	  }
	  
	 $all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (stripos(implode($all_plugins), 'woocommerce.php')) {


	  if ( is_product_category()) {
		  
		$tag_id = get_queried_object()->term_id;
$tag_data = get_option("tag_$tag_id");   

if (isset($tag_data['tag_ogimg'])){ 
 ?>
           <meta property="og:image" content="<?php echo $tag_data['tag_ogimg']; ?>">
       
<?php
	  }  
	  }
} 

}

add_action('wp_head', 'add_ogmeta_tags');
?>
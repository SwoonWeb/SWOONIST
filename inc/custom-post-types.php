<?php

/**
 * Register Post Types
*/
function atg_register_cpt() {
  // Custom Post Type Code
  $args = array(
    "labels" => array(
	    "name" => "Sample",
	    "singular_name" => "Sample",
	  ),
    "description" => "",
    "public" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "has_archive" => true,
    "show_in_nav_menus" => true,
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => array( "slug" => "sample", "with_front" => true ),
    "query_var" => true,  
    "menu_position" => 5,
    "menu_icon" => "dashicons-sos", // https://developer.wordpress.org/resource/dashicons/#dashboard
    "supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),        
  );
  register_post_type( "sample", $args );
  // End Custom Post Type

  // ... Add More Post Types  
}
add_action( 'init', 'atg_register_cpt' );
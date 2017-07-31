<?php

/**
 * Register Taxonomies
*/
function atg_register_tax() {
  // Custom Taxonomy Code
  $args = array(
    "labels" => array(
      "name" => "Artists",
      "label" => "Artists",
      'name'              => _x( 'Artists', 'taxonomy general name', 'atg' ),
      'singular_name'     => _x( 'Artist', 'taxonomy singular name', 'atg' ),
      'search_items'      => __( 'Search Artists', 'atg' ),
      'all_items'         => __( 'All Artists', 'atg' ),
      'parent_item'       => __( 'Parent Artist', 'atg' ),
      'parent_item_colon' => __( 'Parent Artist:', 'atg' ),
      'edit_item'         => __( 'Edit Artist', 'atg' ),
      'update_item'       => __( 'Update Artist', 'atg' ),
      'add_new_item'      => __( 'Add New Artist', 'atg' ),
      'new_item_name'     => __( 'New Artist Name', 'atg' ),
      'menu_name'         => __( 'Artist', 'atg' ),
      ),
    "hierarchical" => 1,
    "show_ui" => true,
    "query_var" => true,
    "rewrite" => array( 'slug' => 'artists', 'with_front' => false ),
    "show_admin_column" => true
  );
  register_taxonomy( "artists", array("sample"), $args );
  // End Custom Taxonomies  

  // ... Add More Taxonomies  
}
add_action( 'init', 'atg_register_tax' );
<?php

/**
 * Update Wordpress Automatically
 */
add_filter( 'auto_update_core', '__return_true' );
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
if(!function_exists('atg_setup')) :
	function atg_setup() {
		add_theme_support( 'automatic-feed-links' );
	  add_theme_support( 'title-tag' );
	  add_theme_support( 'post-thumbnails' );

		register_nav_menus(
	    array(
	      'primary' => __( 'Primary Menu' ),
      	'footer-1' => __( 'Footer Menu 1' ),
      	'footer-2' => __( 'Footer Menu 2' )
	    )
	  );

	  add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		));

    /**
     * Add Image Sizes
     */
    add_image_size( 'featured_banner', '1440', '480', array( "center", "center") );
    add_image_size( 'featured_rectangle_horizontal', '430', '200', array( "center", "center") );
    add_image_size( 'featured_rectangle_vertical', '254', '430', array( "center", "center") );
    add_image_size( 'featured_square_large', '540', '430', array( "center", "center") );
    add_image_size( 'featured_square', '254', '200', array( "center", "center") );

	}
endif;
add_action( 'after_setup_theme', 'atg_setup' );

/**
 * Register Widget Area
 */
function atg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', '_s' ),
    'id'            => 'sidebar-2',
    'description'   => '',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="widget-title">',
    'after_title'   => '</h5>',
  ) );
}
add_action( 'widgets_init', 'atg_widgets_init' );

/**
 * Translate Localized Text
 */
function atg_translate_text( $translated_text, $text, $domain ) {
  if($domain == 'jetpack'){
	  switch ( $translated_text ) {
	    case 'Older posts' :
	      $translated_text = __( 'Load More', 'atg' );
	      break;
	  }
	}
  return $translated_text;
}
add_filter( 'gettext', 'atg_translate_text', 20, 3 );

/**
 * Dynamically Add Classes To Menu's
 */
function atg_menu_classes($classes, $item, $args) {
  if($args->theme_location == 'secondary') {
    $classes[] = 'list-inline-item';
  }
  return $classes;
}
add_filter('nav_menu_css_class','atg_menu_classes',1,3);

/**
 * Front-end Functions
 */
if (!is_admin()){
	require( get_template_directory() . '/inc/enqueue-scripts.php' );
	require( get_template_directory() . '/inc/wp-bootstrap-navwalker.php' );
	require( get_template_directory() . '/inc/wp-bootstrap-comment.php' );
	// require( get_template_directory() . '/inc/custom-login-form.php' );
}

/**
 * Global Functions
 */
// require( get_template_directory() . '/inc/custom-post-types.php' );
// require( get_template_directory() . '/inc/custom-taxonomies.php' );
require( get_template_directory() . '/inc/popular-posts.php' );
require( get_template_directory() . '/inc/custom-widgets.php' );
require( get_template_directory() . '/inc/theme-functions.php' );
require( get_template_directory() . '/inc/acf-functions.php' );
require( get_template_directory() . '/inc/plugin-functions.php' );
require( get_template_directory() . '/inc/jetpack.php' );
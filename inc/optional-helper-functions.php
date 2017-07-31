<?php

/**
 * Unregister Default Widgets
 */
function atg_unregister_default_widgets() { 
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Text');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'atg_unregister_default_widgets', 11);

/**
 * Filter the excerpt "read more" string.
 *
 */
function atg_excerpt_more( $more ) {
  return sprintf( '&hellip; <a class="read-more" href="%1$s">%2$s</a>',
      get_permalink( get_the_ID() ),
      __( 'Read More', 'atg' )
  );
}
add_filter( 'excerpt_more', 'atg_excerpt_more' );

/**
 * Add Query Vars
 */
function atg_custom_query_vars($vars) {
  $vars[] = 'custom-var';
  return $vars;
}
add_filter('query_vars','atg_custom_query_vars');


/**
 * Add Image Sizes
 */
add_image_size( 'event_poster', '280', '280', array( "center", "center") );

/**
 * truncate letters
 */
function wp_trim_letters($text, $chars = 25, $more = '&hellip;') {
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text.$more;
    return $text;
}

/**
 * Force User Login
 */
function force_login() {
  if ( !is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) ); 
    exit;
  }
}

/**
 * Return simple/clean url
 */
function simple_url($str){
  $str = preg_replace('~^(?:https?://)?(?:www\.)?~i', '', $str);
  return $str;
}

/**
 * Set Basic Cookie usage: if (isset($_COOKIE['sitename_newvisitor']))
 */
function set_newuser_cookie() {
  if ( !is_admin() && !isset($_COOKIE['sitename_newvisitor'])) {
    // expires in 2 weeks two weeks
    setcookie('sitename_newvisitor', 1, time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);
  }
}
add_action( 'init', 'set_newuser_cookie');

/** 
 * Use production Images
 */
if(getenv('APPLICATION_ENVIRONMENT') == 'development_local') {
  $LIVE_SITEURL='http://live_website_url_goes_here';
  $WP_SITEURL=get_home_url();  
  function my_replace_image_urls() {
    if ( $GLOBALS["WP_SITEURL"] && $GLOBALS["LIVE_SITEURL"] ) {
      if ( $GLOBALS["WP_SITEURL"] != $GLOBALS["LIVE_SITEURL"] ){
        add_filter('wp_get_attachment_url', 'my_wp_get_attachment_url', 10, 2 );
      }
    }
  }
  add_action('init', 'my_replace_image_urls' );
  function my_wp_get_attachment_url( $url, $post_id) {
    if ( $file = get_post_meta( $post_id, '_wp_attached_file', true) ) {
      if ( ($uploads = wp_upload_dir()) && false === $uploads['error'] ) {
        if ( file_exists( $uploads['basedir'] .'/'. $file ) ) {
          return $url;
        }
      }
    }
    return str_replace( $GLOBALS["WP_SITEURL"], $GLOBALS["LIVE_SITEURL"], $url );
  }
}

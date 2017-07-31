<?php

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function atg_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'      => 'scroll', // scroll or click
		'container' => 'posts-loop',
		'footer_widgets' => false,
		'wrapper'        => false,
    'posts_per_page' => 17,
		'render'    => 'atg_infinite_scroll_render',
		'footer'    => false,
	) );
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos');
}
add_action( 'after_setup_theme', 'atg_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function atg_infinite_scroll_render($type, $first='') {
  echo '<div class="row">';
	$grid_item = 0;
  $cat_type = (is_category() ? "is_child_cat" : "is_parent_cat");
  $firstPage = ($first !== '' ? true : false);
	while ( have_posts() ):  $grid_item++;
		the_post();
    global $post;
    if($type == 'complex'){
      $grid_layout = atg_grid_layout($grid_item);
      echo $grid_layout->html;
      include(locate_template('template-parts/content.php'));
      echo '</div>';

      if($grid_item == 6){
        echo '</div><div class="row">';
        if($firstPage){
          include(locate_template('template-parts/content-newSwoon.php'));
        }      
      }
      if($grid_item == 11) {
        include(locate_template('template-parts/square-ad.php'));
        echo '</div><div class="row">';
        if($firstPage){
          include(locate_template('template-parts/content-popSwoon.php'));
        }      
      } 
      if($grid_item == 17) {
        echo '</div><div class="row">';
        include(locate_template('template-parts/horizontal-ad.php'));
        echo '</div><div class="row">';
      }
    } elseif($type == 'basic') {
      include(locate_template('template-parts/content-basic.php'));
      if($grid_item % 4 == 0) {
        echo '</div><div class="row">';
        include(locate_template('template-parts/horizontal-ad.php'));
        echo '</div><div class="row">';
      }
    }
	endwhile;
  echo '</div>';
}

/**
 * Controll what areas use the infinte-scroll
 */
function atg_infinite_scroll_supported() {
	return current_theme_supports( 'infinite-scroll' ) && (is_front_page() || is_home() || is_archive() || is_search());
}
add_filter( 'infinite_scroll_archive_supported', 'atg_infinite_scroll_supported' );
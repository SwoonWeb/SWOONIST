<?php if(is_category()):
  $cat = get_queried_object(); ?>
  <?php $bg_image = get_field('category_background','category_'.$cat->term_id); ?>
  <article class="post-preview cat-banner" style="background-image: url(<?php echo $bg_image['sizes']['featured_banner'];?>);">
    <div class="display-table">
      <div class="display-table-cell">
        <!-- <h1><?php echo $cat->name; ?></h1> -->
      </div>
    </div>
  </article>
  <?php /*
  <div class="category-menu text-center">
    <?php
      $term_id = ($cat->category_parent > 0 ? $cat->category_parent : $cat->term_id);
      $taxonomy_name = $cat->taxonomy;
      $term_children = get_term_children( $term_id, $taxonomy_name );
      echo '<ul class="list-inline">';
      foreach ( $term_children as $child ) {
        $term = get_term_by( 'id', $child, $taxonomy_name );
        echo '<li class="list-inline-item '.($cat->term_id == $term->term_id ? "active" : "").'"><a href="'.get_term_link($child,$taxonomy_name).'">'.$term->name.'</a></li>';
      }
      echo '</ul>';
    ?> 
  </div>
  */ ?>
<?php endif; ?>
<?php
  if(is_home() || is_front_page()):
    $args = array(
      'posts_per_page' => 1,
      // 'cat'=> $cat->term_id,
      'post__in'  => get_option( 'sticky_posts' ),
      'ignore_sticky_posts' => 1
    );
    $banner = new WP_Query( $args );
    if($banner->have_posts()):
      while($banner->have_posts()): $banner->the_post(); ?>
        <article class="post-preview featured-banner">
          <a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo get_the_post_thumbnail_url($post, 'featured_banner');?>);">
            <div class="display-table">
              <div class="display-table-cell">
                <div class="container">
                  <div class="row">
                    <div class="col-md-10 offset-md-1">
                      <h2><?php the_title(); ?></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </article>
      <?php endwhile;
    endif; wp_reset_query();
  endif;
?>
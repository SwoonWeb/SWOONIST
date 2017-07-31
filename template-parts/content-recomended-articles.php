<hr/>
<h5 class="mb-3 text-uppercase"><?php _e('Recommended Stories', 'atg'); ?></h5>
<?php
  $recomended_posts = new WP_QUERY(
    array(
      'post__not_in' => array($post->ID),
      'ignore_sticky_posts' => 1,
      'posts_per_page'=> 6,
      'meta_key'=>'atg_popular_posts',
      'orderby'=>'meta_value_num',
      'order'=>'DESC'
    )
  );
  if ($recomended_posts->have_posts()): ?>
    <div class="row">
      <?php while ($recomended_posts->have_posts() ) : $recomended_posts->the_post();
        $cat_type = (is_category() ? "is_child_cat" : "is_parent_cat");
        $grid_layout = (object) [
          'html' => '<div class="col-md-4">',
          'class' => '',
          'image_size' => 'featured_square'
        ];
        echo $grid_layout->html;
        include(locate_template('template-parts/content.php'));
        echo '</div>';
        ?>
      <?php endwhile; ?>
    </div>
<?php
  endif; wp_reset_postdata();
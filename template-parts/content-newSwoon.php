<div class="col-md-12">
  <hr class="mt-0" />
  <h2 class="custom-section-title mb-4"><?php the_field('new_swoon','options'); ?></h2>
  <?php
    $recomended_posts = new WP_QUERY(
      array(
        // 'post__not_in' => array($post->ID),
        'ignore_sticky_posts' => 1,
        'posts_per_page'=> 3
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
  <?php endif; wp_reset_postdata(); ?>
  <hr class="mb-4 pb-1 mt-0" />
</div>
<article class="post-preview">
  <a href="<?php the_permalink(); ?>" class="<?php echo $grid_layout->class; ?>" style="background-image: url(<?php echo get_the_post_thumbnail_url($post,  $grid_layout->image_size);?>);">
    <div class="display-table" >
      <div class="display-table-cell">
        <h3><?php the_title(); ?></h3>
        <?php
          $cats = get_the_category();
          if(count($cats) > 1) $cats = array_filter($cats, $cat_type);
          $cat = array_pop($cats);
        ?>
        <p class="text-uppercase"><?php echo $cat->name; ?></p>
      </div>
    </div>
  </a>
</article>
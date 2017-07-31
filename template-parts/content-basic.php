<div class="col-md-6 mb-5">
  <?php $img = get_the_post_thumbnail_url($post->ID, 'featured_square_large'); ?>
  <a href="<?php the_permalink(); ?>" class="post-preview-img" style="background-image: url(<?php echo $img; ?>)"></a>
</div>
<div class="col-md-6 mb-5">
  <article>
    <div class="entry-content">
      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <h6 class="text-muted"><?php echo the_time('F j, Y'); ?> by <?php the_author_link(); ?></h6>
      <?php
        $cats = get_the_category();
        if(count($cats) > 1) $cats = array_filter($cats, $cat_type);
        $cat = array_pop($cats);
      ?>
      <p><?php the_excerpt(); ?></p>
    </div>
  </article>
</div>
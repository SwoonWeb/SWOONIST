<article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
	<div class="entry-content">    
    <?php if(has_post_thumbnail()){ ?>
      <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>
      <figure class="wp-caption aligncenter">
        <?php the_post_thumbnail('large'); ?>
        <?php if(!empty($caption)){ ?>
          <figcaption class="wp-caption-text"><?php echo $caption; ?></figcaption>
        <?php } ?>
      </figure>
    <?php } ?>
		<?php the_content(); ?>
	</div>
</article>
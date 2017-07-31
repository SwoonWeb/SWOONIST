<?php get_header(); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <?php 
            while (have_posts()) : the_post();
              get_template_part( 'template-parts/content', 'singular' );

              // If comments are open or we have at least one comment
              if ( comments_open() || get_comments_number() ) :
                comments_template();
              endif;
            endwhile;
            ?>
          </div>
          <?php get_sidebar(); ?>
        </div>
      </div>
    </main>
  </div>
<?php get_footer(); ?>
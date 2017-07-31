<?php
	/*
	 * Template Name: Custom Page Template
	 */
	get_header(); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <?php 
            while (have_posts()) : the_post();
              get_template_part( 'template-parts/content', 'page' );
            endwhile;
            ?>
          </div>
          <?php get_sidebar(); ?>
        </div>
      </div>
    </main>
  </div>
<?php get_footer(); ?>
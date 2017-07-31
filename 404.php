<?php get_header(); ?>
  <div id="primary" class="container content-area">
    <main id="main" class="row site-main" role="main">
      <div class="col-md-9">
      	<section class="error-404 not-found">
      	  <header class="page-header">
						<h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.','atg'); ?></h1>
					</header>
	        <div class="page-content">
						<p><?php _e('It looks like nothing was found at this location. Perhaps searching can help.', 'atg'); ?></p>
						<?php get_search_form(); ?>
					</div>
	      </section>
      </div>
      <?php get_sidebar(); ?>
    </main>
  </div>
<?php get_footer(); ?>
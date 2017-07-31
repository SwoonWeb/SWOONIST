<?php get_header(); ?>
  <?php get_template_part( 'template-parts/content', 'featured-banner' ); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">      
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div id="posts-loop">
              <?php $paged = get_query_var( 'paged', 1 ); ?>
              <?php if (have_posts()): ?>
                <?php atg_infinite_scroll_render('basic', $paged); ?>
                <?php atg_posts_navigation('infinite-scroll', 'archive'); ?>
              <?php else: ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
              <?php endif; ?>
            </div>
          </div>          
        </div>
      </div>
    </main>
  </div>
<?php get_footer(); ?>
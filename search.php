<?php get_header(); ?>
  <?php get_template_part( 'template-parts/content', 'search-form' ); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php if(!empty($search_query)): ?>
              <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php else: ?>
              <div id="posts-loop" class="row">
                <?php $paged = get_query_var( 'paged', 1 ); ?>
                <?php if (have_posts()): ?>
                  <?php atg_infinite_scroll_render('basic', $paged); ?>
                  <?php atg_posts_navigation('infinite-scroll', 'archive'); ?>
                <?php else: ?>
                  <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>          
        </div>
      </div>
    </main>
  </div>
<?php get_footer(); ?>
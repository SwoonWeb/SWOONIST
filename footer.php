      <div id="footer-newsletter">
        <div class="container text-center text-md-left">
          <div class="footer-spacer">
            <div class="row align-items-center">
              <div class="col-12 col-md-6">
                <h4><?php _e('Stay Up To Date & Sign Up For Newsletter.', 'atg'); ?></h4>
              </div>
              <div class="col-12 col-md-6">
                <?php gravity_form( 1, false, false, false,null, true, '-1', true ); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-logo">
        <div class="container">
          <div class="row">
            <?php $footer = true; ?>
            <?php include(locate_template('template-parts/horizontal-ad.php')); ?>
          </div>
        </div>
      </div>
      <footer id="footer">
        <div class="container">
        	<div class="row text-center">
          	<div class="col">              
              <?php if ( has_nav_menu('footer-1') ) { ?>
                <ul class="list-unstyled footer-menu">
                  <?php wp_nav_menu(array(
                    'theme_location' => 'footer-1',
                    'depth' => 1,
                    'container' => false,
                    'items_wrap' => '%3$s')
                  ); ?>
                </ul>
              <?php }; ?>
            </div>
          </div>
          <div class="row text-center">
            <div class="col">
              <?php atg_social_menu(); ?>     		
          	</div>
          </div>
          <div class="row text-center">
            <div class="col">
              <?php if ( has_nav_menu('footer-2') ) { ?>
                <ul class="list-unstyled footer-menu footer-menu-2">
                  <?php wp_nav_menu(array(
                    'theme_location' => 'footer-2',
                    'depth' => 1,
                    'container' => false,
                    'items_wrap' => '%3$s')
                  ); ?>
                </ul>
              <?php }; ?>
              <p class="text-muted copyright"><?php echo '&copy; Swoonist' ?> <?php echo date('Y.'); ?> <?php _e('All Rights Reserved.'); ?></p>     
            </div>
          </div>
        </div>
      </footer>
      <div id="page-overlay"></div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
<?php $logo = file_get_contents(get_template_directory_uri().'/images/logo.svg'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head();?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-9832059817111406",
        enable_page_level_ads: true
      });
    </script>
  </head>
  <body <?php body_class(); ?>>
    <div id="sidenav" class="sidenav">
      <div id="sidenav-content">
        <div id="sidenav-header">
          <?php echo $logo; ?>
          <a href="javascript:void(0)" id="close-btn">&#x2573;</a>
        </div>
        <hr/>
        <ul class="list-unstyled">
          <?php
            if ( has_nav_menu('primary') ) {
              wp_nav_menu( array(
                'theme_location' => 'primary',
                'depth' => 1,
                'container' => false,
                'menu_class' => 'navbar-nav mr-auto ml-auto',
                'items_wrap' => '%3$s')
              );
            };
          ?>
        </ul>
      </div>
    </div>
    <div id="main-content">
      <div class="navbar-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-2 hidden-lg-up">
              <a class="mobile-btn open-btn" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
            </div>
            <div class="col-8 col-md-6 offset-md-1 col-lg-6 offset-lg-3">
              <a <?php if(!is_home()) echo 'class="mini-logo"'; ?> href="<?php echo home_url(); ?>"><?php echo $logo; ?></a>
            </div>
            <div class="col-2 col-md-3 hidden-lg-up text-right">
              <a class="mobile-btn" href="<?php echo home_url().'?s='; ?>"><i class="fa fa-search"></i></a>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-toggleable-md navbar-light hidden-sm-down" data-toggle="affix">
        <div class="container">
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link open-btn" href="javascript:void(0)"><i class="fa fa-bars"></i></a></li>
            </ul>
            <?php
              if ( has_nav_menu('primary') ) {
                wp_nav_menu( array(
                  'theme_location' => 'primary',
                  'depth' => 1,
                  'container' => false,
                  'menu_class' => 'navbar-nav mr-auto ml-auto',
                  'walker' => new wp_bootstrap_navwalker())
                );
              };
            ?>
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link" href="<?php echo home_url().'?s='; ?>"><i class="fa fa-search"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
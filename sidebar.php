<aside id="sidebar" class="col-sm-3 hidden-sm-down widget-area <?php if(is_singular()) echo 'sticky-sidebar'; ?>" role="complementary">
	<?php if(is_singular()) dynamic_sidebar( 'sidebar-2' );  else dynamic_sidebar( 'sidebar-1' );  ?>
</aside>
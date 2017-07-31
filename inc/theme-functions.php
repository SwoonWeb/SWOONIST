<?php

/**
 * Breadcrumbs
 */
function atg_bread_crumbs() {
  $categories = get_the_terms($post, 'category');
  if($categories){
    echo '<div class="mb-4 text-uppercase">';
      $crumbs = [];
      foreach ($categories as $term){
        if ( $term && ! is_wp_error( $term ) ) {
          $crumbs[] = sprintf( '<a class="text-muted" href="%s">%s</a>', esc_url( get_term_link( $term ) ), esc_html( $term->name ) );
        }
      }
      echo implode( '<small class="text-muted"> > </small>', $crumbs);
    echo '</div>';
  }
}

/**
 * Exlcude Sticky Post
 */
function atg_exclude_sticky( $query ) {
  if ( $query->is_main_query() && ($query->is_home() || $query->is_front_page() )) {
    $query->set( 'post__not_in', get_option( 'sticky_posts' ) );
    // $query->set( 'offset', 3);
  }
  elseif ( $query->is_main_query() && $query->is_search() ) {
    $query->set( 'post_type', 'post' );
  }
  return $query;
}
add_action( 'pre_get_posts', 'atg_exclude_sticky' );

/**
 * Customize Grid Layout
 */
function atg_grid_layout($index) {
  if($index == 3 || $index == 4):
    $grid_layout = (object) [
      'html' => '<div class="col-md-6">',
      'class' => '',
      'image_size' => 'featured_rectangle_horizontal'
    ];
  elseif ($index == 11):
    $grid_layout = (object) [
      'html' => '<div class="col-md-6 offset-md-3 negative-offset-top">',
      'class' => 'featured-rectangle-horizontal',
      'image_size' => 'featured_rectangle_horizontal'
    ];
  elseif ($index == 7 || $index == 15):
    $grid_layout = (object) [
      'html' => '<div class="col-md-3">',
      'class' => 'featured-rectangle-vertical',
      'image_size' => 'featured_rectangle_vertical'
    ];
  elseif ($index == 16):
    $grid_layout = (object) [
      'html' => '<div class="col-md-6 negative-offset-top">',
      'class' => 'featured-rectangle-horizontal',
      'image_size' => 'featured_rectangle_horizontal'
    ];
  elseif ($index == 17):
    $grid_layout = (object) [
      'html' => '<div class="col-md-3 offset-md-6 negative-offset-top">',
      'class' => '',
      'image_size' => 'featured_square'
    ];
  else:
    $grid_layout = (object) [
      'html' => '<div class="col-md-3">',
      'class' => '',
      'image_size' => 'featured_square'
    ];
  endif;
  return $grid_layout;
}

/**
 * Category Filters
 */
function is_parent_cat($cat){
  return($cat->category_parent == 0);
}
function is_child_cat($cat){
  return($cat->category_parent > 0);
}


/**
 * Social Media Menu
 */
function atg_social_menu(){ ?>
  <ul id="social-media" class="list-inline">
    <?php  while(have_rows('social_media', 'options')): the_row();
      echo '<li class="list-inline-item"><a href="'.get_sub_field('url').'" class="sm-link"><i class="fa '.get_sub_field('icon_class').'"></i></a></li>';
    endwhile;  ?>      
  </ul>
  <?php
}

/**
 * Navigation Selector
 */
function atg_posts_navigation($display, $type){
	$is_infinite = class_exists( 'Jetpack') && Jetpack::is_module_active( 'infinite-scroll' );
	if($type == 'single'){
		/* https://developer.wordpress.org/reference/functions/get_the_post_navigation */
    the_post_navigation(
      array(
        'prev_text' => '&laquo; %title',
        'next_text' => '&laquo; %title',
        'in_same_term' => false,
        'taxonomy' => 'category',
        'screen_reader_text' => ''
      )
    );
    return;
	}
	if($display == 'pagination'){
		/* https://codex.wordpress.org/Function_Reference/the_posts_pagination */
    the_posts_pagination(
      array(
        'mid_size' => 2,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'screen_reader_text' => ''
      )
    );
    return;
  } elseif($display == 'infinite-scroll' && $is_infinite) {
  	return;
	} else{
		/* https://developer.wordpress.org/reference/functions/get_the_posts_navigation */
    the_posts_navigation(
      array(
        'prev_text' => '&laquo; Previous Posts',
        'next_text' => 'Newer Posts &raquo;',
        'screen_reader_text' => ''
      )
    );
    return;
	}
}


/**
 * Add Magnific Popup Link Class
 */
function atg_link_class($html, $attachment_id, $attachment) {
  $linkptrn = "/<a[^>]*>/";
  $found = preg_match($linkptrn, $html, $a_elem);

  // If no link, do nothing
  if($found <= 0) return $html;

  $a_elem = $a_elem[0];

  // Check to see if the link is to an uploaded image
  $is_attachment_link = strstr($a_elem, "wp-content/uploads/");

  // If link is to external resource, do nothing
  if($is_attachment_link === FALSE) return $html;

  if(strstr($a_elem, "class=\"") !== FALSE){ // If link already has class defined inject it to attribute
      $a_elem_new = str_replace("class=\"", "class=\"atg-magnific-popup ", $a_elem);
      $html = str_replace($a_elem, $a_elem_new, $html);
  }else{ // If no class defined, just add class attribute
      $html = str_replace("<a ", "<a class=\"atg-magnific-popup\" title=\"".$attachment."\"  ", $html);
  }

  return $html;
}
add_filter('image_send_to_editor', 'atg_link_class', 10, 3);


/**
 * Add Fancy Comments Style
 */
function atg_comments_form($post_id, $req, $aria_req, $commenter, $user_identity, $size, $label_submit = "Post Comment", $style = "basic", $loginModal = true){
  if($style == 'fancy'){

    $fields =  array(

      'author' =>
        '<div id="authorFields" class="collapse">'.
          '<div class="media media-form">'.
            get_avatar( esc_attr($commenter['comment_author_email']), $size, '', '', array('class' => 'd-flex mr-3') ).
            '<div class="media-body">'.
              '<fieldset class="form-group comment-form-author">'.
                '<input id="author" name="author" type="text" class="form-control" placeholder="'.( $req ? 'Name* ( Address never made public )' : 'Name' ).'" value="'.esc_attr($commenter['comment_author']).'" size="30" '.$aria_req.' />'.
              '</fieldset>',

            'email' =>
              '<fieldset class="form-group comment-form-email">'.
                '<input id="email" name="email" type="text" class="form-control" placeholder="'.( $req ? 'Email*' : 'Email' ).'" value="'.esc_attr($commenter['comment_author_email']).'" size="30" '.$aria_req.'/>'.
              '</fieldset>',

            'url' =>
                '<fieldset class="form-group comment-form-url">' .
                  '<input id="url" name="url" type="text" class="form-control" placeholder="Website" value="'.esc_attr( $commenter['comment_author_url']).'" size="30" />'.
                '</fieldset>'.
              '</div>'.
            '</div>'.
            '<div class="row">'.
              '<div class="col-md-6 text-md-left">'.
                ($loginModal ? 
                  '<p class="login-message">Please fill in your details above or <a href="#" data-toggle="modal" data-target="#loginModal">Login</a></p>'
                  :
                  '<p class="login-message">Please fill in your details above or <a href="'.wp_login_url().'" title="Login">Login</a></p>'
                ).
              '</div>'.
              '<div class="col-md-6 text-md-right">'.
                '<button type="submit" class="btn btn-primary btn-xs-block btn-sm-block" name="submit">'.$label_submit.'</button>'.
              '</div>'.
            '</div>'.
          '</div>',
    );


    $args = array(
      'id_form'           => 'commentform',
      'class_form'        => 'comment-form fancy-comment-form',
      'id_submit'         => 'submit',
      'class_submit'      => 'btn btn-primary',
      'name_submit'       => 'submit',
      'title_reply'       => __( 'Leave a Reply' ),
      'title_reply_to'    => __( 'Leave a Reply to %s' ),
      'cancel_reply_link' => __( 'Cancel' ),
      'label_submit'      => __( $label_submit ),
      'format'            => 'xhtml',

      'comment_field' =>  '<fieldset class="form-group comment-form-comment"><textarea id="comment" name="comment" placeholder="Enter your comment here..." class="form-control" cols="45" rows="8" aria-required="true">' .
        '</textarea></fieldset>',

      'must_log_in' => '<p class="must-log-in">' .
        sprintf(
          __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
          wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

      'logged_in_as' => '',

      'comment_notes_before' => '', //<p class="comment-notes"></p>

      'comment_notes_after' => 
        (is_user_logged_in () ?
          '<div id="authorFields" class="collapse">'.
            '<div class="row">'.
              '<div class="col-md-6 text-md-left">'.
                '<div class="media">'.
                  get_avatar( get_current_user_id(), $size, '', '', array('class' => 'd-flex mr-3') ).
                  '<div class="media-body">'.
                    '<p class="logged-in-as">'.
                      sprintf( __( 'Logged in as <strong>%1$s</strong>. <a href="%2$s" title="Log out of this account">Log out?</a>' ),
                        $user_identity,
                        wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                      ).
                    '</p>'.                
                  '</div>'.
                '</div>'.
              '</div>'.
              '<div class="col-md-6 text-md-right">'.
                '<button type="submit" class="btn btn-primary btn-xs-block btn-sm-block" name="submit">'.$label_submit.'</button>'.
              '</div>'.
            '</div>'.
          '</div>' : ''),

      'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    );
  } else {

    $fields =  array(

      'author' =>
        '<fieldset class="form-group comment-form-author"><label for="author">Name</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></fieldset>',

      'email' =>
        '<fieldset class="form-group comment-form-email"><label for="email">Email</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' /></fieldset>',

      'url' =>
        '<fieldset class="form-group comment-form-url"><label for="url">Website</label>' .
        '<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" /></fieldset>',
    );


    $args = array(
      'id_form'           => 'commentform',
      'class_form'      => 'comment-form',
      'id_submit'         => 'submit',
      'class_submit'      => 'btn btn-primary',
      'name_submit'       => 'submit',
      'title_reply'       => __( 'Leave a Reply' ),
      'title_reply_to'    => __( 'Leave a Reply to %s' ),
      'cancel_reply_link' => __( 'Cancel Reply' ),
      'label_submit'      => __( $label_submit ),
      'format'            => 'xhtml',

      'comment_field' =>  '<fieldset class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
        '</label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true">' .
        '</textarea></fieldset>',

      'must_log_in' => '<p class="must-log-in">' .
        sprintf(
          __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
          wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

      'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
        __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
          admin_url( 'profile.php' ),
          $user_identity,
          wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

      'comment_notes_before' => '<p class="comment-notes">' .
        __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
        '</p>',

      'comment_notes_after' => '<p class="form-allowed-tags"><small>' .
        sprintf(
          __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
          ' <code>' . allowed_tags() . '</code>'
        ) . '</small></p>',

      'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    );
  }

  comment_form($args, $post_id);
  return;
}

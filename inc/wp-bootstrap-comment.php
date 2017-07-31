<?php
 class Bootstrap_Comment extends Walker_Comment {
  protected function html5_comment( $comment, $depth, $args ) { ?>
    <li <?php comment_class( empty( $args['has_children'] ) ? 'media' : 'media parent' ) ?> id="comment-<?php comment_ID() ?>">
      <?php if ( $args['avatar_size'] != 0 ):
        echo get_avatar( $comment, $args['avatar_size'], '', '', array('class' => 'd-flex mr-3'));
      endif; ?>
      <div class="media-body" id="div-comment-<?php comment_ID() ?>">
        <h5 class="media-heading">
          <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
        </h5>
        <small class="comment-meta commentmetadata">
          <?php if($comment->comment_approved == 0) : ?>
            <em class="comment-awaiting-moderation text-muted"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <?php endif; ?>
          <a class="text-muted" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
            /* translators: 1: date, 2: time */
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
            ?>
        </small>
        <?php comment_text(); ?>
      </div>
      <div class="media-right media-bottom">
        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
      </div>
    </li>
  <?php
  }
}
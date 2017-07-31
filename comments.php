<?php
// TODO: Update To Use Bootstrap Media
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text">Comment navigation</h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link('Older Comments'); ?></div>
				<div class="nav-next"><?php next_comments_link('Newer Comments'); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="list-unstyled">
	    <?php
        wp_list_comments( array(
          'style'         => 'ol',
          'short_ping'    => true,
          'avatar_size'   => 38,
          'type'					=> 'comment',
          'walker'        => new Bootstrap_Comment()
        ));
	    ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text">Comment navigation</h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link('Older Comments'); ?></div>
				<div class="nav-next"><?php next_comments_link('Newer Comments'); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments">Comments are closed.</p>
	<?php
	endif;

	atg_comments_form($post_id, $req, $aria_req, $commenter, $user_identity, 38, 'Post Comment', 'fancy');
	?>

</div><!-- #comments -->
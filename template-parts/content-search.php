<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<span class="posted-on">
						<?php the_time('F j, Y'); ?>
					</span> |
					<span class="byline">
						Posted by: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<?php the_author(); ?>
						</a>
					</span>
				</div>
			<?php
		endif; ?>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<footer class="entry-footer">
		<hr />
	</footer>
</article>
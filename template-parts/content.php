<div class="blog-post">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the single post content template.
		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		if ( is_singular( 'attachment' ) ) {
			// Parent post navigation.
			the_post_navigation( array(
				'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
			) );
		} elseif ( is_singular( 'post' ) ) {

           }

		// End of the loop.
	endwhile;
	?>
<!-- the rest of the content -->

</div><!-- /.blog-post -->
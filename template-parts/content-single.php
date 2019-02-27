<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php $postid = get_the_ID(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row content-wrapper">

		<div class="col-12 post-content">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_content();
				?>
			</div>

		</div>
	</div>

</article><!-- #post-## -->
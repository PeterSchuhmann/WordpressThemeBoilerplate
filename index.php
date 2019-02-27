<?php get_template_part('template-parts/header'); ?>

	<div class="row">

		<div class="col-12 content-main">

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

		</div> <!-- /.blog-main -->

	</div> <!-- /.row -->

<?php get_template_part('template-parts/footer'); ?>

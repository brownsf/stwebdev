<?php
/**
 * The main template file
 */

get_header(); ?>

	<div id="main-content" class="main-content">
		<div id="primary" class="container">
			<div id="content" class="row" role="main">

				<?php

				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

				?>

			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar( 'content' ); ?>
	</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();

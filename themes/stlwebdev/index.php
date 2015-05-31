<?php
/**
 * The main template file
 */

get_header(); ?>

    <div id="main-content" class="main-content container">

        <?php
        if ( is_front_page() ) {
            // Include the featured content template.
            get_template_part( 'featured-content' );
        }
        ?>

        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

                <?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        ?> <h3><a href="<?php echo get_the_permalink()?>"><?php echo get_the_title()?></a> </h3>
                        <?php
                    the_content();


                    endwhile;


                else :
                    // If no content, include the "No posts found" template.
                    ?>No Posts found<?php

                endif;
                ?>

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar( 'content' ); ?>
    </div><!-- #main-content -->

<?php
get_sidebar();
get_footer();

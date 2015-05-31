<?php
/**
 * The main template file
 */

get_header(); ?>

    <div id="main-content" class="main-content container ">
        <div class="row">

            <div id="primary" class="content-area col-md-9">
                <div id="content" class="site-content" data-max="<?php echo $wp_query->max_num_pages; ?>" role="main">
                    <h1>Blog</h1>
                    <?php

                    if (have_posts()) :
                        // Start the Loop.
                        while (have_posts()) : the_post();
                            ?> <h3><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
                            <?php
                            the_excerpt();


                        endwhile;


                    else :
                        // If no content, include the "No posts found" template.
                        ?>No Posts found<?php

                    endif;
                    ?>

                </div>

                <!-- #content -->
            </div>
            <!-- #primary -->
            <?php get_sidebar('content'); ?>
        </div>
    </div><!-- #main-content -->
    <div id="loader" class="container">
        <div class="row">
            <div class="col-md-3 offset-3">
                <div class="loader">Loading...</div>
            </div>
        </div>
    </div>
<?php
get_sidebar();
get_footer();

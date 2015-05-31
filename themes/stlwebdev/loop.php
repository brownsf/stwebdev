<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 5/31/2015
 * Time: 3:36 PM
 */

if (have_posts()) :
    // Start the Loop.
    while (have_posts()) : the_post();
        ?> <h3><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
        <?php
        the_excerpt();


    endwhile;


else :
    // If no content, include the "No posts found" template.
    ?><p>No Posts found</p><?php

endif;
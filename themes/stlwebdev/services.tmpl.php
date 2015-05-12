<?php
/**
 * Template Name: Services List
 */


get_header();

?>

    <div id="main-content" class="main-content container">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

                <div class="row">
                    <div class="col-md-12">

                        <?php echo the_title('<h2>','</h2>');?>
                        <?php the_content();?>
                    </div>

                </div>

                <div class="row">
                    <div class="span9">
                        <div class="row">
                            <div class="col-md-5">

                                <ul class="nav nav-tabs" role="tablist" id="myTab">

                                    <?php
                                    $args = array('posts_per_page' => -1, 'post_type' => 'my_services', 'orderby' => 'menu_order');
                                    $firstTitles = 'active';
                                    $myposts = get_posts($args);
                                    foreach ($myposts as $post) : setup_postdata($post); ?>
                                        <li role="presentation" class="<?php echo $firstTitles ?>">
                                            <a aria-controls="home" role="tab" data-toggle="tab"
                                               data-id="<?php echo $post->ID ?>"
                                               href="#service-<?php echo $post->ID ?>"><?php the_title(); ?></a>
                                        </li>

                                        <?php
                                        $firstTitles = '';
                                    endforeach;
                                    wp_reset_postdata();
                                    ?>

                                </ul>


                                <div class="tab-content" id="service-content">
                                    <?php
                                    $first = 'active';
                                    $args = array('post_type' => 'my_services', 'posts_per_page' => 10, 'orderby' => 'menu_order');
                                    $loop = new WP_Query($args);
                                    while ($loop->have_posts()) : $loop->the_post();
                                        echo '<div role="tabpanel" class="tab-pane ' . $first . '" id="service-' . $post->ID . '" class="row">';
                                        the_title('<h3>', '</h3>');
                                        echo '<div class="entry-content">';
                                        the_content();
                                        echo '</div>';
                                        echo '</div>';
                                        $first = '';
                                    endwhile;

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- #content -->
        </div>
        <!-- #primary -->
        <?php get_sidebar('content'); ?>
    </div><!-- #main-content -->
    <script>

        $.ready(function ($) {

            $('#myTab a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            });
        });

    </script>
<?php
get_sidebar();
get_footer();
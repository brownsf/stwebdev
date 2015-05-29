<?php
/**
 * The main template file
 */

get_header(); ?>
    <section id="intro" data-speed="3" data-type="background">
        <div class="bs-docs-header">
            <div class="container">
                <div class="page-header">
                    <h1>Stl Web Developer
                        <small>Freelance web development based in St. Louis, Mo</small>
                    </h1>
                    <div id="content" class="site-content container" role="main">
                        <div class="row">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('mid-col-10'); ?>>
                                <?php
                                $content = $post->post_content;
                                $content = apply_filters('the_content', $content);
                                echo $content;
                                ?>

                        </div>
                        <!-- #content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="home" data-speed="6" data-type="background">
        <div class="container-fluid">
            <h2 class="oreo">Areas of Expertise</h2>
                <!-- #main-content -->
                <div id="expertise" class="row-fluid">


                    <?php
                    $front_query = new WP_Query('post_type=my_services&posts_per_page=3');
                    if ($front_query->have_posts()) {
                        while ($front_query->have_posts()) {
                            $front_query->the_post();
                            echo '<div class="col-md-4"><div class="well"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a><p>' . get_the_excerpt() . '</p></div></div>';
                        }
                    } else {
                        echo '<p class="glyphicon-warning-sign">Oops no content yet. </p>';
                    }

                    ?>
                </div>
    </section>
    <script>

        $(document).ready(function () {
            // cache the window object
            $window = $(window);

            $('section[data-type="background"]').each(function () {
                // declare the variable to affect the defined data-type
                var $scroll = $(this);

                $(window).scroll(function () {
                    // HTML5 proves useful for helping with creating JS functions!
                    // also, negative value because we're scrolling upwards
                    var yPos = -($window.scrollTop() / $scroll.data('speed'));

                    // background position
                    var coords = '50% ' + yPos + 'px';

                    // move the background
                    $scroll.css({backgroundPosition: coords});
                }); // end window scroll
            });  // end section function
        }); // close out script
    </script>

<?php
get_sidebar();
get_footer();

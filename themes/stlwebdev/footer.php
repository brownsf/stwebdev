<?php wp_footer(); ?>
<section id="about" data-speed="2" data-type="background">
    <div class="container">
        <h3 class="oreo">Contact</h3>
        <div class="row">
            <div class="col-md-4">

               <p> <?php echo get_option('stlweb_footer_content'); ?></p>
            </div>
            <div class="col-md-4 col-md-offset-4">

                <?php echo do_shortcode('[contact_form lang=en]'); ?>
            </div>

        </div>
    </div>
</section>


</body>
<script src="<?php echo get_template_directory_uri(); ?>/bootstrap-3.2.0/dist/js/bootstrap.min.js"></script>

</html>
<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 10/11/2014
 * Time: 9:26 PM
 */

function new_excerpt_length() {
    return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Changing excerpt more
function new_excerpt_more($more) {
    global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


function register_my_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');

/**
 * Proper way to enqueue scripts and styles
 */
function stlweb_scripts()
{
    wp_enqueue_style('style-name', get_template_directory_uri() . '/css/app.css');

}

add_action('wp_enqueue_scripts', 'stlweb_scripts');

add_action('init', 'create_service_post_type');
function create_service_post_type()
{
    register_post_type('my_services',
        array(
            'labels' => array(
                'name' => __('Services'),
                'singular_name' => __('Service')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('page-attributes', 'editor', 'title')
        )
    );
}

function setup_theme_admin_menus()
{
    add_submenu_page('themes.php',
        'Page Elements', 'Edit Page', 'manage_options',
        'page-elements', 'theme_page_settings');
}

// This tells WordPress to call the function named "setup_theme_admin_menus"
// when it's time to create the menu pages.
add_action("admin_menu", "setup_theme_admin_menus");

function theme_page_settings()
{ ?>

    <div class="wrap">
        <h2><?php _e('Theme Settings', 'stlweb'); ?></h2>

        <form method="post" action="options.php">

            <?php if (isset($_GET['settings-updated'])) { ?>
                <div class="updated">
                    <p><?php _e('Settings updated successfully'); ?></p>
                </div>
            <?php } ?>

            <table class="form-table">
                <tr>
                    <td colspan="2"><h3><?php _e('Google Analytics Code', 'stlweb'); ?></h3></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Local City', 'stlweb'); ?></th>
                    <td>
                        <textarea
                            name="stlweb_weather_address"><?php echo get_option('stlweb_weather_address'); ?></textarea>

                        <p class="description"><?php _e('Your location for homepage weather. (City, 2 Letter State)', 'stlweb'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Footer Content', 'stlweb'); ?></th>
                    <td>
                        <textarea name="stlweb_footer_content"><?php echo get_option('stlweb_footer_content'); ?></textarea>

                        <p class="description"><?php _e('The content for the contact us area.', 'stlweb'); ?></p>
                    </td>
                </tr>

                <?php settings_fields('stlweb-settings-general'); ?>
                <?php do_settings_sections('stlweb-settings-general'); ?>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
<?php }


/**
 * Step 2: Create settings fields.
 */
add_action('admin_init', 'register_ewsettings');
function register_ewsettings()
{
    register_setting('stlweb-settings-general', 'stlweb_weather_address');
    register_setting('stlweb-settings-general', 'stlweb_footer_content');
}

function get_weather()
{
    if (false === ($value = get_transient('stlweb_weather_data'))) {
        $cityState = get_option('stlweb_weather_address');
        $loc = explode(',', $cityState);
        $state = trim($loc[1]);
        $city = str_replace(' ', '_', trim($loc[0]));
        $url = "http://api.wunderground.com/api/0aa2d3ef365a9b92/forecast/q/$state/$city.json";
        $value = wp_remote_get($url);
        set_transient('stlweb_weather', $value, 60 * 60 * 6);
    }

    return json_decode($value['body'])->forecast;
}

add_action('post_submitbox_misc_actions', 'stlweb_publish_in_frontpage');
function stlweb_publish_in_frontpage()
{
    global $post;
    $value = get_post_meta($post->ID, '_publish_in_frontpage', true);
?>
<div class="misc-pub-section misc-pub-section-last">
         <span id="timestamp">'
        <label>
            <input type="checkbox"<?php echo(!empty($value) ? ' checked="checked" ' : null) ?> value="1"
                   name="publish_in_frontpage"/> Publish to frontpage
        </label>
        </span>
</div>;
<?php
}

add_action( 'save_post', 'stlweb_save_postdata');
function stlweb_save_postdata($postid)
{
    /* check if this is an autosave */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

    /* check if the user can edit this page */
    if ( !current_user_can( 'edit_page', $postid ) ) return false;

    /* check if there's a post id and check if this is a post */
    /* make sure this is the same post type as above */
    if(empty($postid) || $_POST['post_type'] != 'post' ) return false;

    /* if you are going to use text fields, then you should change the part below */
    /* use add_post_meta, update_post_meta and delete_post_meta, to control the stored value */

    /* check if the custom field is submitted (checkboxes that aren't marked, aren't submitted) */
    if(isset($_POST['my_featured_post_field'])){
        /* store the value in the database */
        add_post_meta($postid, 'my_featured_post_field', 1, true );
    }
    else{
        /* not marked? delete the value in the database */
        delete_post_meta($postid, 'my_featured_post_field');
    }
}
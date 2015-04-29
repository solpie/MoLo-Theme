<?php
/**
 * Mulo functions and definitions
 *
 * @package Mulo
 */


// MuLo functions and definitions
if (!function_exists('mulo_setup')) :
    function mulo_setup()
    {
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support('site-logo', array(
            'header-text' => array(
                'sitetitle',
                'tagline',
            ),
            'size' => 'MuLo-logo',
        ));
        // Post Thumbnails
        if (function_exists('add_image_size')) {
            add_theme_support('post-thumbnails');
            add_image_size('post-page', 1200);
            add_image_size('post-thumb', 400);
        }
    }
endif;
add_action('after_setup_theme', 'mulo_setup');


/**
 * Content Width
 */
if (!isset($content_width)) $content_width = 900;

// Style the Tag Cloud
function mulo_custom_tag_cloud_widget($args)
{
    $args['largest'] = 14; //largest tag
    $args['smallest'] = 14; //smallest tag
    $args['unit'] = 'px'; //tag font unit
    $args['number'] = '8'; //number of tags
    return $args;
}

add_filter('widget_tag_cloud_args', 'mulo_custom_tag_cloud_widget');


/**
 * Enqueue scripts and styles.
 */
function mulo_scripts()
{
    wp_enqueue_style('mulo-style', get_stylesheet_uri());
    wp_enqueue_script('jqmin', get_template_directory_uri() . '/inc/js/jquery.min.js');
    wp_enqueue_script('mulo', get_template_directory_uri() . '/inc/js/mulo.js');
    wp_enqueue_script('mushache', get_template_directory_uri() . '/inc/js/mustache.min.js');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/inc/font-awesome-4.3.0/css/font-awesome.min.css', 'style');
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('themefurnace-keyboard-image-navigation', get_template_directory_uri() . 'inc/js/keyboard-image-navigation.js', array('jquery'), '20120202');
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'mulo_scripts');


function mulo_get_page()
{
    $idx = $_REQUEST["idx"]-1;
    $arr = get_posts('category_name=mulo&numberposts=10&offset='.$idx*10);
    $count = count($arr);
    $mulos = array();
    for ($i = 0; $i < $count; $i++) {
        $post = $arr[$i];
        array_push($mulos, array(
            'title' => $post->post_title,
            'content' => $post->post_content,
            'date' => "jj",
            'id' => $post->ID));
    }
    echo json_encode($mulos);
    exit();
}

add_action("wp_ajax_mulo_page", "mulo_get_page");
add_action("wp_ajax_nopriv_mulo_page", "mulo_get_page");//
// Numbered Pagination
function mulo_pagination()
{
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

if (!function_exists('_wp_render_title_tag')) {
    function themefurnace_render_title()
    {
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
    }

    add_action('wp_head', 'themefurnace_render_title');
}

<?php

add_action('after_setup_theme', 'webart_setup');
if (!function_exists('webartisan_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function webart_setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 9999);

        // This theme uses wp_nav_menu() in several locations.
        register_nav_menus(
            array(
                'menu-1' => __('Primary', 'webartisan'),
                'logged-in-menu' => __('Logged in Menu', 'webartisan'),
                'logged-out-menu' => __('Logged out Menu', 'webartisan'),
                'footer' => __('Footer Menu', 'webartisan'),
                'social' => __('Social Links Menu', 'webartisan'),
                'small-menu' => __('Small Links Menu', 'webartisan'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 48,
                'width' => 128,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
endif;

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'webart_scripts');
function webart_scripts()
{
    wp_enqueue_style('webart-style', get_stylesheet_uri());
    wp_enqueue_script('script', get_template_directory_uri() . '/public/js/app.js');
}

/**
 * Creates custom nav walker
 */
include(__DIR__ . '/core/Nav/Webart_Menu_Walker.php');
include(__DIR__ . '/core/Nav/nav_add_icons.php');

/**
 * Custom taxonomies
 */
include(__DIR__ . '/core/Taxonomies/alphabetical.php');
include(__DIR__ . '/core/Taxonomies/city.php');
include(__DIR__ . '/core/Taxonomies/company_type.php');
include(__DIR__ . '/core/Taxonomies/language-doc.php');
include(__DIR__ . '/core/Taxonomies/language-snippet.php');
include(__DIR__ . '/core/Taxonomies/language-tutorial.php');
include(__DIR__ . '/core/Taxonomies/profession-interview.php');
include(__DIR__ . '/core/Taxonomies/skill.php');

/**
 * Custom widgets
 */
include(__DIR__ . '/core/Widgets/footer_area.php');

/**
 * Custom post types
 */
include(__DIR__ . '/core/Post_types/doc.php');
include(__DIR__ . '/core/Post_types/interview.php');
include(__DIR__ . '/core/Post_types/job.php');
include(__DIR__ . '/core/Post_types/news.php');
include(__DIR__ . '/core/Post_types/snippet.php');
include(__DIR__ . '/core/Post_types/topic.php');
include(__DIR__ . '/core/Post_types/tutorial.php');

/**
 * Remove undesirable post types and editors
 */
include(__DIR__ . '/core/Post_types/remove_undesirable_post_types.php');
include(__DIR__ . '/core/remove_editor_for_templates.php');

/**
 * Comments
 */
include(__DIR__ . '/core/Comments/comment_template.php');

/**
 * View counts
 */
include(__DIR__ . '/core/view_counts.php');

/**
 * WYSIWYG
 */
// include(__DIR__ . '/core/webart_wysiwyg.php');

/**
 * Create image sizes
 */
add_action('after_setup_theme', 'webart_register_image_sizes');
function webart_register_image_sizes()
{
    add_image_size('webart-large', 1200);
    add_image_size('webart-promoted', 720, 405, true);
    add_image_size('webart-thumbnail', 368, 207, true);
}

/**
 * Filter the except length to 30 words.
 */
function webart_custom_excerpt_length($length)
{
    return 30;
}

add_filter('excerpt_length', 'webart_custom_excerpt_length', 999);

/**
 * Escape some common fields
 */
add_filter('comment_text', 'webart_escape_comment');
function webart_escape_comment($comment)
{
    return esc_html($comment);
}

add_filter('the_title', 'webart_escape_title');
function webart_escape_title($title)
{
    return esc_html($title);
}

// Deleting the previous filter for the nav
add_filter('pre_wp_nav_menu', 'webart_remove_title_filter_nav_menu');
function webart_remove_title_filter_nav_menu($nav_menu)
{
    // we are working with menu, so remove the title filter
    remove_filter('the_title', 'webart_escape_title');
    return $nav_menu;
}

add_filter('wp_nav_menu_items', 'webart_add_title_filter_non_menu');
function webart_add_title_filter_non_menu($items)
{
    // we are done working with menu, so add the title filter back
    add_filter('the_title', 'webart_escape_title');
    return $items;
}

function webart_get_all_terms($postId, $withTaxonomy = false)
{
    $post = get_post($postId);
    $taxonomies = get_object_taxonomies($post->post_type);
    $terms = [];
    foreach ($taxonomies as $taxonomy) {
        $taxonomyTerms = get_the_terms($post->ID, $taxonomy);
        if (!empty($taxonomyTerms)) {
            if ($withTaxonomy) {
                $terms[$taxonomy] = [];
                foreach ($taxonomyTerms as $term) {
                    $terms[$taxonomy][] = $term->name;
                }
            } else {
                foreach ($taxonomyTerms as $term) {
                    $terms[] = $term->name;
                }
            }
        }
    }
    return $terms;
}

/**
 * Wip search navigation
 */
if (!function_exists('webart_the_posts_navigation')) :
    /**
     * Documentation for function.
     */
    function webart_the_posts_navigation()
    {
        the_posts_pagination([
            'mid_size' => 2,
            'prev_text' => '&lt;&nbsp;<span class="nav-prev-text">Plus récent</span>',
            'next_text' => '<span class="nav-next-text">Plus ancien</span>&nbsp;&gt;',
        ]);
    }
endif;


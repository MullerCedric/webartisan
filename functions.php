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
include(__DIR__ . '/core/Taxonomies/city.php');
include(__DIR__ . '/core/Taxonomies/company_type.php');
include(__DIR__ . '/core/Taxonomies/language.php');
include(__DIR__ . '/core/Taxonomies/profession.php');
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
include (__DIR__ . '/core/remove_editor_for_templates.php');

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


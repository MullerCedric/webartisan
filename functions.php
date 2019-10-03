<?php

if ( ! function_exists( 'webartisan_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function webart_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in several locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'webartisan' ),
				'footer' => __( 'Footer Menu', 'webartisan' ),
				'social' => __( 'Social Links Menu', 'webartisan' ),
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
	}
endif;
add_action( 'after_setup_theme', 'webart_setup' );

/*
 * Custom taxonomies
 */
include( __DIR__ . '/core/Taxonomies/language.php' );
include( __DIR__ . '/core/Taxonomies/profession.php' );

/*
 * Custom post types
 */
include( __DIR__ . '/core/Post_types/doc.php' );
include( __DIR__ . '/core/Post_types/interview.php' );
include( __DIR__ . '/core/Post_types/job.php' );
include( __DIR__ . '/core/Post_types/news.php' );
include( __DIR__ . '/core/Post_types/snippet.php' );
include( __DIR__ . '/core/Post_types/topic.php' );
include( __DIR__ . '/core/Post_types/tutorial.php' );

/*
 * Remove undesirable post types
 */
include( __DIR__ . '/core/Post_types/remove_undesirable_post_types.php' );

<?php
add_action('init', 'webart_register_news');
function webart_register_news() {
    register_post_type( 'news', [
            'labels' => [
                'name' => __( 'Actualités' ),
                'singular_name' => __( 'Actualité' ),
                'add_new_item' => 'Créer une nouvelle actualité',
                'edit_item' => 'Mettre à jour l\'actualité',
                'all_items' => 'Toutes les actualités'
            ],
            'description' => 'Toutes les actualités',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'supports' => ['title', 'editor', 'comments', 'author', 'thumbnail', 'excerpt'],
            'taxonomies'  => ['category', 'post_tag'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'actus'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'news_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=news',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'news_options',
]);

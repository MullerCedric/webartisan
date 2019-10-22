<?php
add_action('init', 'webart_register_topic');
function webart_register_topic() {
    register_post_type( 'topic', [
            'labels' => [
                'name' => __( 'Discussions' ),
                'singular_name' => __( 'Discussion' ),
                'add_new_item' => 'Créer une nouvelle discussion',
                'edit_item' => 'Mettre à jour la discussion',
                'all_items' => 'Toutes les discussions'
            ],
            'description' => 'Toutes les discussions',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-format-chat',
            'supports' => ['title', 'editor', 'comments', 'author'],
            'taxonomies'  => ['category', 'language'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'discussions'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'topic_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=topic',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'topic_options',
]);

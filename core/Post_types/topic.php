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

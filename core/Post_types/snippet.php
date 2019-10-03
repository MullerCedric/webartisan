<?php
add_action('init', 'webart_register_snippet');
function webart_register_snippet() {
    register_post_type( 'snippet', [
            'labels' => [
                'name' => __( 'Snippets' ),
                'singular_name' => __( 'Snippet' ),
                'add_new_item' => 'Ajouter un nouveau snippet',
                'edit_item' => 'Mettre à jour le snippet',
                'all_items' => 'Tous les snippets'
            ],
            'description' => 'Tous les snippets',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-editor-code',
            'supports' => ['title', 'author'],
            'taxonomies'  => ['post_tag', 'language'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'snippets'],
        ]
    );
}
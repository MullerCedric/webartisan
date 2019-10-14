<?php
add_action('init', 'webart_register_doc');
function webart_register_doc() {
    register_post_type( 'doc', [
            'labels' => [
                'name' => __( 'Docs' ),
                'singular_name' => __( 'Doc' ),
                'add_new_item' => 'Ajouter une nouvelle doc',
                'edit_item' => 'Mettre à jour la doc',
                'all_items' => 'Toutes les docs'
            ],
            'description' => 'Toutes les docs',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor'],
            'taxonomies'  => ['language'],
            'has_archive' => false,
            'rewrite' => ['slug' => 'documentation'],
        ]
    );
}

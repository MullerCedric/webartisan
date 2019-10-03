<?php
add_action('init', 'webart_register_tutorial');
function webart_register_tutorial() {
    register_post_type( 'tutorial', [
            'labels' => [
                'name' => __( 'Tutoriels' ),
                'singular_name' => __( 'Tutoriel' ),
                'add_new_item' => 'Créer un nouveau tutoriel',
                'edit_item' => 'Mettre à jour le tutoriel',
                'all_items' => 'Tous les tutoriels'
            ],
            'description' => 'Tous les tutoriels',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-awards',
            'supports' => ['title', 'comments', 'author', 'excerpt'],
            'taxonomies'  => ['category', 'post_tag', 'language'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'tutos'],
        ]
    );
}

<?php
add_action('init', 'webart_register_interview');
function webart_register_interview() {
    register_post_type( 'interview', [
            'labels' => [
                'name' => __( 'Interviews' ),
                'singular_name' => __( 'Interview' ),
                'add_new_item' => 'Ajouter une nouvelle interview',
                'edit_item' => 'Mettre à jour l\'interview',
                'all_items' => 'Toutes les interviews'
            ],
            'description' => 'Toutes les interviews',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businessman',
            'supports' => ['title'],
            'taxonomies'  => ['profession'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'interviews'],
        ]
    );
}

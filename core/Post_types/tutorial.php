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
            'supports' => ['title', 'editor', 'comments', 'author', 'excerpt'],
            'taxonomies'  => ['category', 'post_tag', 'language'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'tutos'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'tutorial_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=tutorial',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'tutorial_options',
]);

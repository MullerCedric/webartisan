<?php
add_action('init', 'webart_register_interview');
function webart_register_interview() {
    register_post_type( 'interview', [
            'labels' => [
                'name' => __('Interviews', 'webartisan'),
                'singular_name' => __('Interview', 'webartisan'),
                'add_new_item' => 'Ajouter une nouvelle interview',
                'edit_item' => 'Mettre à jour l\'interview',
                'all_items' => 'Toutes les interviews'
            ],
            'description' => 'Toutes les interviews',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businessman',
            'supports' => ['title', 'editor'],
            'taxonomies'  => ['profession-interview'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'interviews'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'interview_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=interview',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'interview_options',
]);

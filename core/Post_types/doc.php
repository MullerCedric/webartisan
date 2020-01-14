<?php
add_action('init', 'webart_register_doc');
function webart_register_doc() {
    register_post_type( 'doc', [
            'labels' => [
                'name' => __('Docs', 'webartisan'),
                'singular_name' => __('Doc', 'webartisan'),
                'add_new_item' => 'Ajouter une nouvelle doc',
                'edit_item' => 'Mettre à jour la doc',
                'all_items' => 'Toutes les docs'
            ],
            'description' => 'Toutes les docs',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor'],
            'taxonomies'  => ['language-doc', 'alphabetical'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'documentation'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'doc_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=doc',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'doc_options',
]);

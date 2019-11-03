<?php
add_action('init', 'webart_register_snippet');
function webart_register_snippet() {
    register_post_type( 'snippet', [
            'labels' => [
                'name' => __('Snippets', 'webartisan'),
                'singular_name' => __('Snippet', 'webartisan'),
                'add_new_item' => 'Ajouter un nouveau snippet',
                'edit_item' => 'Mettre à jour le snippet',
                'all_items' => 'Tous les snippets'
            ],
            'description' => 'Tous les snippets',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-editor-code',
            'supports' => ['title', 'editor', 'author'],
            'taxonomies'  => ['post_tag', 'language'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'snippets'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'snippet_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=snippet',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'snippet_options',
]);

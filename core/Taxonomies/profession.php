<?php
add_action('init', 'webart_register_profession', 0);
function webart_register_profession()
{
    register_taxonomy('profession', ['post'], [
        'hierarchical' => true,
        'labels' => [
            'name' => __('Métiers', 'webartisan'),
            'singular_name' => __('Métier', 'webartisan'),
            'search_items' => __('Chercher un métier', 'webartisan'),
            'all_items' => __('Tous les métiers', 'webartisan'),
            'parent_item' => __('Métier parent', 'webartisan'),
            'parent_item_colon' => __('Métier parent :'),
            'edit_item' => __('Modifier le métier', 'webartisan'),
            'update_item' => __('Mettre à jour le métier', 'webartisan'),
            'add_new_item' => __('Ajouter un nouveau métier', 'webartisan'),
            'new_item_name' => __('Nouvel intitulé du métier', 'webartisan'),
            'menu_name' => __('Métiers', 'webartisan'),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'metiers'),
    ]);
}

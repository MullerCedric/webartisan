<?php
add_action('init', 'webart_register_city', 0);
function webart_register_city()
{
    register_taxonomy('city', ['post'], [
        'hierarchical' => false,
        'labels' => [
            'name' => __('Villes', 'webartisan'),
            'singular_name' => __('Ville', 'webartisan'),
            'search_items' => __('Chercher une ville', 'webartisan'),
            'all_items' => __('Toutes les villes', 'webartisan'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Modifier le nom de la ville', 'webartisan'),
            'update_item' => __('Mettre à jour le nom de la ville', 'webartisan'),
            'add_new_item' => __('Ajouter une ville', 'webartisan'),
            'new_item_name' => __('Nouveau nom de ville', 'webartisan'),
            'menu_name' => __('Villes', 'webartisan'),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'villes'),
    ]);
}

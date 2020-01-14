<?php
add_action('init', 'webart_register_language_doc', 0);
function webart_register_language_doc()
{
    register_taxonomy('language-doc', ['post'], [
        'hierarchical' => false,
        'labels' => [
            'name' => __('Langages', 'webartisan'),
            'singular_name' => __('Langage', 'webartisan'),
            'search_items' => __('Chercher un langage', 'webartisan'),
            'all_items' => __('Tous les langages', 'webartisan'),
            'parent_item' => __('Langage parent', 'webartisan'),
            'parent_item_colon' => __('Langage parent :'),
            'edit_item' => __('Modifier le langage', 'webartisan'),
            'update_item' => __('Mettre à jour le langage', 'webartisan'),
            'add_new_item' => __('Ajouter un nouveau language', 'webartisan'),
            'new_item_name' => __('Nouvel intitulé du langage', 'webartisan'),
            'menu_name' => __('Langages', 'webartisan'),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'langages-doc'),
    ]);
}

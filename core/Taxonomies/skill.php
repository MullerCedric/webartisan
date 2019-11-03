<?php
add_action('init', 'webart_register_skill', 0);
function webart_register_skill()
{
    register_taxonomy('skill', ['post'], [
        'hierarchical' => true,
        'labels' => [
            'name' => __('Compétences', 'webartisan'),
            'singular_name' => __('Compétence', 'webartisan'),
            'search_items' => __('Chercher une compétence', 'webartisan'),
            'all_items' => __('Toutes les compétences', 'webartisan'),
            'parent_item' => __('Compétence parent', 'webartisan'),
            'parent_item_colon' => __('Compétence parent :'),
            'edit_item' => __('Modifier la compétence', 'webartisan'),
            'update_item' => __('Mettre à jour la compétence', 'webartisan'),
            'add_new_item' => __('Ajouter une nouvelle compétence', 'webartisan'),
            'new_item_name' => __('Nouvel intitulé de la compétence', 'webartisan'),
            'menu_name' => __('Compétences', 'webartisan'),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'competences'),
    ]);
}

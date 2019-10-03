<?php
add_action( 'init', 'webart_register_profession', 0 );
function webart_register_profession() {
    register_taxonomy('profession', ['post'], [
        'hierarchical' => true,
        'labels' => [
            'name' => __( 'Métiers' ),
            'singular_name' => __( 'Métier' ),
            'search_items' =>  __( 'Chercher un métier' ),
            'all_items' => __( 'Tous les métiers' ),
            'parent_item' => __( 'Métier parent' ),
            'parent_item_colon' => __( 'Métier parent :' ),
            'edit_item' => __( 'Modifier le métier' ),
            'update_item' => __( 'Mettre à jour le métier' ),
            'add_new_item' => __( 'Ajouter un nouveau métier' ),
            'new_item_name' => __( 'Nouvel intitulé du métier' ),
            'menu_name' => __( 'Métiers' ),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'metiers' ),
    ]);
}

<?php
add_action( 'init', 'webart_register_company_type', 0 );
function webart_register_company_type() {
    register_taxonomy('company_type', ['post'], [
        'hierarchical' => false,
        'labels' => [
            'name' => __( 'Types de société' ),
            'singular_name' => __( 'Type de société' ),
            'search_items' =>  __( 'Chercher un type de société' ),
            'all_items' => __( 'Tous les types de société' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Modifier le type de société' ),
            'update_item' => __( 'Mettre à jour le type de société' ),
            'add_new_item' => __( 'Ajouter un nouveau type de société' ),
            'new_item_name' => __( 'Nouvel intitulé du type de société' ),
            'menu_name' => __( 'Types de société' ),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'type-de-société' ),
    ]);
}

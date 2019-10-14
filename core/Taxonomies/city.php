<?php
add_action( 'init', 'webart_register_city', 0 );
function webart_register_city() {
    register_taxonomy('city', ['post'], [
        'hierarchical' => false,
        'labels' => [
            'name' => __( 'Villes' ),
            'singular_name' => __( 'Ville' ),
            'search_items' =>  __( 'Chercher une ville' ),
            'all_items' => __( 'Toutes les villes' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Modifier le nom de la ville' ),
            'update_item' => __( 'Mettre à jour le nom de la ville' ),
            'add_new_item' => __( 'Ajouter une ville' ),
            'new_item_name' => __( 'Nouveau nom de ville' ),
            'menu_name' => __( 'Villes' ),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'villes' ),
    ]);
}

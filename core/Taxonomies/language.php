<?php
add_action( 'init', 'webart_register_language', 0 );
function webart_register_language() {
    register_taxonomy('language', ['post'], [
        'hierarchical' => false,
        'labels' => [
            'name' => __( 'Langages' ),
            'singular_name' => __( 'Langage' ),
            'search_items' =>  __( 'Chercher un langage' ),
            'all_items' => __( 'Tous les langages' ),
            'parent_item' => __( 'Langage parent' ),
            'parent_item_colon' => __( 'Langage parent :' ),
            'edit_item' => __( 'Modifier le langage' ),
            'update_item' => __( 'Mettre à jour le langage' ),
            'add_new_item' => __( 'Ajouter un nouveau language' ),
            'new_item_name' => __( 'Nouvel intitulé du langage' ),
            'menu_name' => __( 'Langages' ),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'langage' ),
    ]);
}

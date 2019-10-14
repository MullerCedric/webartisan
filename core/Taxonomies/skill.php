<?php
add_action( 'init', 'webart_register_skill', 0 );
function webart_register_skill() {
    register_taxonomy('skill', ['post'], [
        'hierarchical' => true,
        'labels' => [
            'name' => __( 'Compétences' ),
            'singular_name' => __( 'Compétence' ),
            'search_items' =>  __( 'Chercher une compétence' ),
            'all_items' => __( 'Toutes les compétences' ),
            'parent_item' => __( 'Compétence parent' ),
            'parent_item_colon' => __( 'Compétence parent :' ),
            'edit_item' => __( 'Modifier la compétence' ),
            'update_item' => __( 'Mettre à jour la compétence' ),
            'add_new_item' => __( 'Ajouter une nouvelle compétence' ),
            'new_item_name' => __( 'Nouvel intitulé de la compétence' ),
            'menu_name' => __( 'Compétences' ),
        ],
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'competences' ),
    ]);
}

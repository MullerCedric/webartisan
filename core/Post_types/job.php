<?php
add_action('init', 'webart_register_job');
function webart_register_job() {
    register_post_type( 'job', [
            'labels' => [
                'name' => __( 'Offres d\'emploi' ),
                'singular_name' => __( 'Offre d\'emploi' ),
                'add_new_item' => 'Créer une nouvelle offre d\'emploi',
                'edit_item' => 'Mettre à jour l\'offre d\'emploi',
                'all_items' => 'Toutes les offres d\'emploi'
            ],
            'description' => 'Toutes les offres d\'emploi',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-megaphone',
            'supports' => ['title', 'author', 'excerpt'],
            'taxonomies'  => ['post_tag', 'profession'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'emplois'],
        ]
    );
}

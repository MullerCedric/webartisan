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
            'taxonomies'  => ['post_tag', 'profession', 'skill', 'company_type', 'city'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'emplois'],
        ]
    );
}

acf_add_options_sub_page([
    'page_title' => 'Options de la liste',
    'menu_title' => 'Options de la liste',
    'menu_slug' => 'job_options',
    'capability' => 'manage_options',
    'parent_slug' => 'edit.php?post_type=job',
    'position' => false,
    'icon_url' => false,
    'post_id' => 'job_options',
]);

<?php
// Removes unwanted tabs in the admin panel
add_action( 'admin_menu', 'mmp_remove_menu_pages' );
function mmp_remove_menu_pages() {
    remove_menu_page( 'upload.php' );                 //Media
}

// Removes unwanted post_types (aka media) in the post_type selector
add_filter( 'post_type_selector_post_types', function( $post_types, $field ) {
    unset( $post_types['attachment'] );
    return $post_types;
}, 10, 2 );

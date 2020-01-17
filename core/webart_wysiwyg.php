<?php
// Add style to admin WYSIWYG editor
add_action('admin_init', 'webart_custom_editor_styles');
function webart_custom_editor_styles()
{
    add_editor_style('editor-style.css');
}

// Add TinyMCE buttons
add_filter('mce_buttons_2', 'webart_add_mce_buttons');
function webart_add_mce_buttons($buttons)
{
    array_unshift($buttons, 'subscript');
    array_unshift($buttons, 'superscript');
    return $buttons;
}

// Add custom buttons
/*add_action( 'init', 'webart_add_custom_buttons' );
if ( ! function_exists( 'webart_buttons_filters' ) ) {
    function webart_buttons_filters() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
        add_filter( 'mce_external_plugins', 'webart_add_buttons' );
        add_filter( 'mce_buttons', 'webart_register_buttons' );
    }
}
if ( ! function_exists( 'webart_add_buttons' ) ) {
    function webart_add_buttons( $plugin_array ) {
        $plugin_array['code'] = get_stylesheet_directory_uri().'/public/js/tinymce_buttons.js';
        return $plugin_array;
    }
}
if ( ! function_exists( 'webart_register_buttons' ) ) {
    function webart_register_buttons($buttons)
    {
        array_push($buttons, 'swpbtn');
        return $buttons;
    }
}*/

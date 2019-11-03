<?php
add_action('init', 'webart_remove_editor');
function webart_remove_editor()
{
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        switch ($template) {
            case 'templates/landing.php':
                remove_post_type_support('page', 'editor');
                break;
            default :
                break;
        }
    }
}

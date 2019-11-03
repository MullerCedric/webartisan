<?php
add_action('widgets_init', 'webart_register_footer_area_widget');
function webart_register_footer_area_widget()
{
    register_sidebar(array(
        'name' => __('Widget du footer', 'webartisan'),
        'id' => 'footer-widget',
        'before_widget' => '<div class="c-footer__widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="c-footer__heading">',
        'after_title' => '</div>',
    ));
}

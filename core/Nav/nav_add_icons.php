<?php
add_filter('wp_nav_menu_objects', 'webart_nav_add_icons', 10, 2);
function webart_nav_add_icons( $items, $args ) {
    foreach( $items as &$item ) {
        $menu_icon_wb = get_field('menu_icon_wb', $item);
        $menu_icon_el = get_field('menu_icon_el', $item);

        if ( $menu_icon_wb ) {
            $wb_icon_pos = get_field('wb_icon_pos', $item);
            $wb_hide_title = get_field('wb_hide_title', $item);
            $title = $wb_hide_title ? '<span class="sr-only">' . $item->title . '</span>' : $item->title;
            if ( $wb_icon_pos === 'before' ) {
                $item->title = '<span class="c-icon c-icon--'
                    . $menu_icon_wb
                    .'"></span>'
                    . $title;
            } else {
                $item->title = $title
                . '<span class="c-icon c-icon--'
                . $menu_icon_wb
                .'"></span>';
            }
        }

        if ( $menu_icon_el ) {
            $el_icon_pos = get_field('el_icon_pos', $item);
            $el_hide_title = get_field('el_hide_title', $item);
            $title = $el_hide_title ? '<span class="sr-only">' . $item->title . '</span>' : $item->title;
            if ( $el_icon_pos === 'before' ) {
                $item->title = '<span class="icon icon--'
                    . $menu_icon_el
                    .'"></span>'
                    . $title;
            } else {
                $item->title = $title
                    . '<span class="c-icon c-icon--'
                    . $menu_icon_el
                    .'"></span>';
            }
        }
    }
    return $items;
}

<?php

class Webart_Menu_Walker extends Walker_Nav_Menu
{
    private function to_array($var)
    {
        if (is_array($var)) return $var;
        return is_string($var) ? explode(" ", $var) : [];
    }

    private function each_menu_name($names = [], $appends = [])
    {
        $return = [];
        $names = $this->to_array($names);
        $appends = $this->to_array($appends);
        foreach ($names as $name) {
            if ($name && $name !== '') {
                foreach ($appends as $append) {
                    if ($append && $append !== '') {
                        $return[] = $name . '' . $append;
                    }
                }
            }
        }
        return $return;
    }

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
        $display_depth = ($depth + 1); // because it counts the first submenu as 0
        $classes = $this->each_menu_name($args->menu_names, ['__sub', '__sub--depth' . $display_depth]);
        $class_names = implode(' ', $classes);

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul aria-label="submenu" class="' . $class_names . '">' . "\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
        $display_depth = ($depth + 1); // because it counts the first submenu as 0

        // Aria has pop up
        $hasChildren = (bool)$args->walker->has_children;
        $ariaHasPopUp = $hasChildren ? ' aria-haspopup="true"' : '';

        // Check if active
        $isActive = false;
        if (is_array($item->classes)) {
            $isActive = (
                in_array("current_page_item", $item->classes) || in_array("current-menu-item", $item->classes)
            );
        }

        // Passed classes
        $baseClass = $this->each_menu_name($args->menu_names, ['__item']);
        $depth_classes = $this->each_menu_name($args->menu_names, ['__item--depth' . $display_depth]);
        $currentClass = $isActive ? $this->each_menu_name($args->menu_names, ['__item--active']) : [];
        $filteredClasses = array_filter((array)$item->classes, function ($value) {
            return (str_replace(['menu-', 'page_', 'page-'], '', $value) != $value) ? false : true;
        }); // Removes all the default Wordpress classes but keeps custom classes

        $classes = array_merge($baseClass, $depth_classes, $currentClass, $filteredClasses);
        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));


        // Build HTML
        $output .= $indent;
        $output .= '<li' . $ariaHasPopUp . ' class="' . $class_names . '">';

        $linkTag = ($item->url && $item->url != '#') ? 'a' : 'div';
        $linkName = ($item->url && $item->url != '#') ? 'link' : 'nolink';

        // Link classes
        $linkClasses = $this->each_menu_name(
            $args->menu_names,
            [
                '__' . $linkName,
                '__' . $linkName . '--depth' . $display_depth,
                $isActive ? '__' . $linkName . '--active' : false,
                $hasChildren ? '__' . $linkName . '--has-children' : false
            ]
        );

        // Link attributes
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ($item->url && $item->url !== '#') ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="' . implode(' ', $linkClasses) . '"';

        // Link text replacement
        $current_user = wp_get_current_user();
        $linkText = apply_filters('the_title', $item->title, $item->ID);
        $linkText = str_replace('{avatar}', '<div class="c-avatar__wrapper">' . get_avatar(
                $current_user->ID,
                32,
                '',
                $alt = '',
                ['class' => ['c-dropdown__avatar', 'c-avatar']]
            ) . '</div>', $linkText);
        $linkText = str_replace('{username}', $current_user->user_login, $linkText);

        // Description
        $linkDesc = '<small class="c-dropdown__desc">' . $item->description . '</small>';

        // Build HTML output and pass through the proper filter.
        $item_output = sprintf('%1$s<%2$s%3$s>%4$s%5$s%6$s%7$s</%8$s>%9$s',
            $args->before,
            $linkTag,
            $attributes,
            $args->link_before,
            $linkText,
            $args->link_after,
            $linkDesc,
            $linkTag,
            $args->after
        );

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

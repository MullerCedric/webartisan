<div class="c-toolbar--inner o-wrapper o-wrapper--larger">
    <?php if (has_custom_logo()) : ?>
      <div class="c-logo c-logo--main"><?php the_custom_logo(); ?></div>
    <?php endif; ?>

    <?php
    wp_nav_menu([
        'menu' => '',
        'container' => '',
        'container_class' => '',
        'container_id' => '',
        'menu_class' => '',
        'menu_id' => '',
        'menu_names' => ['o-dropdown', 'c-dropdown'],
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul class="o-dropdown c-main-nav">%3$s</ul>',
        'item_spacing' => 'discard',
        'depth' => 0,
        'walker' => new Webart_Menu_Walker(),
        'theme_location' => 'menu-1'
    ]);
    ?>

    <?php
    $loggedInMenu = "logged-in-menu";
    $loggedOutMenu = "logged-out-menu";

    if (has_nav_menu($loggedInMenu) AND has_nav_menu($loggedOutMenu)):
        wp_nav_menu([
            'menu' => '',
            'container' => '',
            'container_class' => '',
            'container_id' => '',
            'menu_class' => '',
            'menu_id' => '',
            'menu_names' => ['o-dropdown', 'c-dropdown'],
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul class="o-dropdown c-user-nav">%3$s</ul>',
            'item_spacing' => 'discard',
            'depth' => 0,
            'walker' => new Webart_Menu_Walker(),
            'theme_location' => is_user_logged_in() ? $loggedInMenu : $loggedOutMenu
        ]);
    endif;
    ?>
</div>

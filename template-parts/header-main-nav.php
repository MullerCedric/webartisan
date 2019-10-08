<?php if ( has_custom_logo() ) : ?>
    <div class="site-logo"><?php the_custom_logo(); ?></div>
<?php endif; ?>

<?php
wp_nav_menu([
    'menu'            => '',
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => '',
    'menu_id'         => '',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul class="main-nav">%3$s</ul>',
    'item_spacing'    => 'discard',
    'depth'           => 0,
    'walker'          => '',
    'theme_location'  => 'menu-1'
]);
?>

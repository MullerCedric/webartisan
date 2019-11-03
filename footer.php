<footer class="c-footer">
  <section class="c-footer__newsletter">
    <div class="o-wrapper o-wrapper--larger">
      <h2 class="c-footer__heading c-footer__heading--centered">Tu ne veux rien louper ?</h2>
      <p class="c-tagline c-tagline--center c-footer__tagline">Abonne-toi à la newsletter !</p>
      <form action="#" method="post" class="c-newsletter o-wrapper o-wrapper--smaller">
        <label class="c-newsletter__label">
          <span class="sr-only">E-mail</span><span class="icon icon--message"></span>
          <input type="email" name="newsletter-email" placeholder="jon@snow.com" class="c-newsletter__email"/>
        </label>
        <button class="c-newsletter__button">S'abonner</button>
      </form>
    </div>
  </section>
  <div class="o-wrapper o-wrapper--larger c-footer__main"><?php
      wp_nav_menu([
          'menu' => '',
          'container' => '',
          'container_class' => '',
          'container_id' => '',
          'menu_class' => '',
          'menu_id' => '',
          'menu_names' => 'c-footer-menu',
          'before' => '',
          'after' => '',
          'link_before' => '',
          'link_after' => '',
          'items_wrap' => '<ul class="c-footer-menu">%3$s</ul>',
          'item_spacing' => 'discard',
          'depth' => 0,
          'walker' => new Webart_Menu_Walker(),
          'theme_location' => 'footer'
      ]); ?>
    <div>
        <?php if (is_active_sidebar('footer-widget')) : ?>
          <div class="c-footer__widget-container">
              <?php dynamic_sidebar('footer-widget'); ?>
          </div>
        <?php endif;

        wp_nav_menu([
            'menu' => '',
            'container' => '',
            'container_class' => '',
            'container_id' => '',
            'menu_class' => '',
            'menu_id' => '',
            'menu_names' => 'c-socials',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul class="c-socials">%3$s</ul>',
            'item_spacing' => 'discard',
            'depth' => 0,
            'walker' => new Webart_Menu_Walker(),
            'theme_location' => 'social'
        ]);

        wp_nav_menu([
            'menu' => '',
            'container' => '',
            'container_class' => '',
            'container_id' => '',
            'menu_class' => '',
            'menu_id' => '',
            'menu_names' => 'c-small-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul class="c-small-menu">%3$s</ul>',
            'item_spacing' => 'discard',
            'depth' => 0,
            'walker' => new Webart_Menu_Walker(),
            'theme_location' => 'small-menu'
        ]); ?>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

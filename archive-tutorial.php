<?php
get_template_part('template-parts/header', 'common');
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$headerVars = get_field('header', 'tutorial_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'tutorial_options') ?? 'Tutoriels'; ?>
        </h1>
        <div class="c-tagline"><?= $headerVars['page_desc']; ?></div>
        </div><?php
          if ($hasIllu): ?>
            <div class="c-page-illu">
              <?php include $illuPath; ?>
            </div><?php
          endif;
      else: ?>
        <h1 id="content">
          <?= get_field('title', 'tutorial_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>

      <?php
      $tutos = new WP_Query([
          'post_type' => 'tutorial',
          'posts_per_page' => intval(get_field('items_per_page', 'tutorial_options')),
          'paged' => $paged,
      ]);
      if ($tutos->have_posts()): $i = 0; ?>
        <ol class="o-wrapper c-tuto-list c-tuto-list--large">
          <?php while ($tutos->have_posts()): $tutos->the_post();
              $terms = get_the_terms($tutos->ID, 'category'); ?>
          <li class="c-tuto-list__item">
            <a href="<?= get_the_permalink(); ?>" class="c-link">
                        <span class="icon icon--<?= get_field('tuto_type')['value']; ?>"
                              title="<?= get_field('tuto_type')['label']; ?>"></span><?php the_title(); ?>
            </a>
              <?php if ($terms && !is_wp_error($terms)): foreach ($terms as $term): ?>
                <span class="c-tag c-tag--small"><?= $term->name; ?></span>
              <?php endforeach; endif; ?>
          </li>
          <?php endwhile; ?>
        </ol><?php
          $total_pages = $tutos->max_num_pages; ?>
        </div><?php
          if ($total_pages > 1) {
              $current_page = max(1, get_query_var('paged'));
              echo '<div class="o-wrapper page-numbers__container">';

              echo paginate_links(array(
                  'current' => $current_page,
                  'format' => '?paged=%#%',
                  'total' => $total_pages,
                  'prev_text' => '<span class="c-pagination__lt" title="' . __('Vers la page précédente', 'webartisan') . '">&lt;</span>',
                  'next_text' => '<span class="c-pagination__gt" title="' . __('Vers la page suivante', 'webartisan') . '">&gt;</span>',
              ));

              echo '</div>';
          }
      endif;
      wp_reset_postdata(); ?>
  </main>

<?php get_footer();

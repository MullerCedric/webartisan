<?php
get_template_part('template-parts/header', 'common');
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$headerVars = get_field('header', 'interview_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'interview_options') ?? 'Métiers du web'; ?>
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
          <?= get_field('title', 'interview_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>

      <?php
      $interviews = new WP_Query([
          'post_type' => 'interview',
          'posts_per_page' => intval(get_field('items_per_page', 'news_options')),
          'paged' => $paged,
      ]);
      if ($interviews->have_posts()): $i = 0; ?>
        <div class="o-grid o-grid__small o-grid__container o-wrapper"><?php
          while ($interviews->have_posts()): $i++;
              $interviews->the_post();
              $professions = get_the_terms($interviews->ID, 'profession-interview'); ?>
            <article class="o-card c-card">
            <a href="<?= get_the_permalink(); ?>" title="Vers l'interview de <?= get_the_title(); ?>"
               class="c-link">
                <?php the_post_thumbnail('full', ['class' => 'c-card__pic']); ?>
            </a>
            <h2 class="c-card__text">
              <a href="<?= get_the_permalink(); ?>" title="Vers l'interview de <?= get_the_title(); ?>"
                 class="c-link c-card__title">
                  <?php the_title(); ?>
              </a>
                <?php if ($professions && !is_wp_error($professions)): foreach ($professions as $profession): ?>
                  <span class="c-tag c-card__job"><?= $profession->name; ?></span>
                <?php endforeach; endif; ?>
            </h2>
            </article><?php
          endwhile;
          $total_pages = $interviews->max_num_pages; ?>
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

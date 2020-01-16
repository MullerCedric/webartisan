<?php
get_template_part('template-parts/header', 'common');
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$headerVars = get_field('header', 'snippet_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'snippet_options') ?? 'Snippets'; ?>
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
          <?= get_field('title', 'snippet_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>

      <?php
      $snippets = new WP_Query([
          'post_type' => 'snippet',
          'posts_per_page' => intval(get_field('items_per_page', 'snippet_options')),
          'paged' => $paged,
      ]);
      if ($snippets->have_posts()): $i = 0; ?>
        <div class="o-wrapper o-wrapper--smaller c-table-list"><?php
          while ($snippets->have_posts()): $i++;
              $snippets->the_post();
              $languages = get_the_terms($snippets->ID, 'language-snippet'); ?>
            <div>
              <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>" class="c-link">
                <?php the_title(); ?>
              </a>
                <?php if ($languages && !is_wp_error($languages)): foreach ($languages as $language): ?>
                  <span class="c-tag c-tag--small"><?= $language->name; ?></span>
                <?php endforeach; endif; ?>
            </div>
            <div>
              <?php the_author(); ?>
            </div>
            <div>
              <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                <?= 'Publié le ' . get_the_date(); ?>
              </time>
            </div><?php
          endwhile;
          $total_pages = $snippets->max_num_pages; ?>
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

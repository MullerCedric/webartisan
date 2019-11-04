<?php
get_template_part('template-parts/header', 'common');
$langFilter = get_query_var('language') ? rtrim(get_query_var('language'), '#') : '';

$headerVars = get_field('header', 'doc_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'doc_options') ?? 'Dernières news'; ?>
        </h1>
        <div><?= $headerVars['page_desc']; ?></div>
        </div><?php
          if ($hasIllu): ?>
            <div class="c-page-illu">
              <?php include $illuPath; ?>
            </div><?php
          endif;
      else: ?>
        <h1 id="content">
          <?= get_field('title', 'doc_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>
    <div class="o-wrapper"><?php
        get_template_part('template-parts/doc', 'langfilter');
        get_template_part('template-parts/doc', 'alphafilter');

        $letters = get_terms([
            'taxonomy' => 'alphabetical',
            'hide_empty' => true,
        ]);
        foreach ($letters as $letter):
            wp_reset_query();
            $args = [
                'post_type' => 'doc',
                'alphabetical' => $letter->slug,
                'orderby' => 'title',
                'order' => 'ASC',
                'posts_per_page' => -1,
            ];
            if ($langFilter AND !empty($langFilter)) {
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'language',
                        'field' => 'slug',
                        'terms' => $langFilter
                    ]
                ];
            }
            $docs = new WP_Query($args);

            if ($docs->have_posts()):
                $i = 0; ?>
            <section id="<?= $letter->name; ?>" class="o-wrapper o-wrapper--smaller o-doc-list">
              <h2 class="o-doc-list__heading">
                  <?= strtoupper($letter->name); ?>
              </h2>
              <dl class="o-doc-list__dl">
                  <?php while ($docs->have_posts()): $docs->the_post(); ?>
                    <dt>
                      <a href="<?= get_the_permalink(); ?>" class="c-link">
                          <?php the_title(); ?>
                      </a>
                    </dt>
                    <dd>
                        <?php $num_words = 40;
                        $more_text = __('<span title="Texte incomplet">[...]</span>', 'webartisan');
                        echo wp_trim_words(get_the_content(), $num_words, $more_text); ?>
                    </dd>
                  <?php endwhile; ?>
              </dl>
              </section><?php
            endif;
            wp_reset_postdata();
        endforeach; ?>
    </div>
  </main>

<?php get_footer();

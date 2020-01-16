<?php
get_template_part('template-parts/header', 'common');
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$headerVars = get_field('header', 'job_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'job_options') ?? 'Offres d\'emploi'; ?>
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
          <?= get_field('title', 'job_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>
    <div class="o-grid o-grid__holy o-grid__container o-wrapper">
      <aside>
        <h2 class="sr-only">Filtres</h2>
          <?php get_template_part('template-parts/job', 'filters'); ?>
      </aside>

        <?php
        $jobs = new WP_Query([
            'post_type' => 'job',
            'posts_per_page' => intval(get_field('items_per_page', 'job_options')),
            'paged' => $paged,
        ]);
        if ($jobs->have_posts()): $i = 0; ?>
          <div class="o-grid o-grid__one-col o-grid__container"><?php
            while ($jobs->have_posts()): $i++;
                $jobs->the_post();
                $skills = get_the_terms($jobs->ID, 'skill');
                $company_types = get_the_terms($jobs->ID, 'company_type');
                $cities = get_the_terms($jobs->ID, 'city'); ?>
              <article class="o-media c-job">
              <div class="o-media__img">
                <div class="c-avatar__wrapper c-avatar__wrapper--42">
                    <?= get_avatar(get_the_author_email(), 42, '', '', ['class' => 'c-avatar__img']); ?>
                </div>
              </div>
              <div class="o-media__text c-job__text">
                <div class="c-job__title">
                  <h2>
                    <a href="<?= get_the_permalink(); ?>" title="Vers l'annonce <?= get_the_title(); ?>"
                       class="c-link">
                        <?php the_title(); ?>
                    </a>
                  </h2>
                  <span><?php
                      echo get_field('job_type');
                      if (get_field('hourly_rate')) {
                          echo ' | <span title="' . get_field('hourly_rate') . 'h/semaine">' . get_field('hourly_rate') . 'h</span>';
                      } else {
                          if (get_field('term')) {
                              echo ' | ' . get_field('term');
                          }
                      }
                      ?>
                  </span>
                </div>
                <div>
                    <?php the_author(); ?> &bull;
                    <?php if ($company_types && !is_wp_error($company_types)): foreach ($company_types as $company_type): ?>
                      <span><?= $company_type->name; ?></span>
                    <?php endforeach; endif; ?> &bull;
                    <?php if ($cities && !is_wp_error($cities)): foreach ($cities as $city): ?>
                      <span><?= $city->name; ?></span>
                    <?php endforeach; endif; ?>
                  <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"
                        title="date de publication de l'annonce"><?php
                      echo 'le ' . get_the_date(); ?>
                  </time>
                </div>
                <div>
                    <?php if ($skills && !is_wp_error($skills)): foreach ($skills as $skill): ?>
                      <span class="c-tag"><?= $skill->name; ?></span>
                    <?php endforeach; endif; ?>
                </div>
                <div>
                  <a href="<?= trim(get_field('offer_link')) ? trim(get_field('offer_link')) : get_the_permalink(); ?>"
                     title="Vers l'annonce <?= get_the_title(); ?>"
                     class="c-link c-link__cta">
                    Voir l'annonce <span class="sr-only"> <?= get_the_title(); ?></span>
                  </a>
                </div>
              </div>
              </article><?php
            endwhile;
            $total_pages = $jobs->max_num_pages; ?>
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
    </div>
  </main>

<?php get_footer();

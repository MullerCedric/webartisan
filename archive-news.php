<?php
get_template_part('template-parts/header', 'common');
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$headerVars = get_field('header', 'news_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'news_options') ?? 'Dernières news'; ?>
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
          <?= get_field('title', 'news_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>

      <?php
      $news = new WP_Query([
          'post_type' => 'news',
          'posts_per_page' => intval(get_field('items_per_page', 'news_options')),
          'paged' => $paged,
      ]);
      if ($news->have_posts()): $i = 0; ?>
        <div class="o-grid o-grid__3 o-grid__container o-wrapper"><?php
          while ($news->have_posts()): $i++;
              $news->the_post();
              if ($i === 1): ?>
                <article class="o-media o-grid__3--full">
                  <div class="o-media__img">
                    <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                       class="c-link">
                        <?php the_post_thumbnail('webart-promoted', ['class' => 'c-thumbnail c-thumbnail--promoted']); ?>
                    </a>
                  </div>
                  <div class="o-media__text">
                    <h2>
                      <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                         class="c-link">
                          <?php the_title(); ?>
                      </a>
                    </h2>
                    <p><?php the_author(); ?> - Le
                      <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php
                          echo get_the_date(); ?>
                      </time>
                    </p>
                      <?php the_excerpt(); ?>
                    <p>
                      <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                         class="c-link c-link__cta">
                        Lire l'article<span class="sr-only"> <?= get_the_title(); ?> en entier</span>
                      </a>
                    </p>
                  </div>
                </article>
              <?php else: ?>
                <article class="o-card">
                <div>
                  <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                     class="c-link">
                      <?php the_post_thumbnail('webart-thumbnail', ['class' => 'c-thumbnail']); ?>
                  </a>
                </div>
                <div>
                  <h2>
                    <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                       class="c-link">
                        <?php the_title(); ?>
                    </a>
                  </h2>
                  <p><?php the_author(); ?> - Le
                    <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php
                        echo get_the_date(); ?>
                    </time>
                  </p>
                    <?php the_excerpt(); ?>
                  <p>
                    <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                       class="c-link c-link__cta">
                      Lire l'article<span class="sr-only"> <?= get_the_title(); ?> en entier</span>
                    </a>
                  </p>
                </div>
                </article><?php
              endif;
          endwhile;
          $total_pages = $news->max_num_pages; ?>
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

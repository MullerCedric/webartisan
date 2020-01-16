<?php
get_template_part('template-parts/header', 'common');
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$headerVars = get_field('header', 'topic_options');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
  <div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
      if ($headerVars): ?>
        <div class="c-page-desc">
        <h1 id="content">
            <?= get_field('title', 'topic_options') ?? 'Discussions'; ?>
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
          <?= get_field('title', 'topic_options'); ?>
        </h1><?php
      endif; ?>
  </div>
  </header>

  <main>

    <form action="#" method="get" class="o-wrapper o-wrapper--smaller c-forum-list__search">
      <input type="search" name="search-topic" id="search-topic" placeholder="Rechercher une discussion">
      <label class="sr-only" for="search-topic">Sujet à rechercher</label>
      <button type="submit">
        <span class="sr-only">Rechercher sur le forum</span><span class="c-icon c-icon--search"></span>
      </button>
    </form>

    <div class="o-grid o-grid__holy o-grid__container o-wrapper">
      <aside>
        <h2 class="sr-only">Filtres</h2>
          <?php get_template_part('template-parts/topic', 'filters'); ?>
      </aside>

        <?php
        $topics = new WP_Query([
            'post_type' => 'topic',
            'posts_per_page' => intval(get_field('items_per_page', 'topic_options')),
            'paged' => $paged,
        ]);
        if ($topics->have_posts()):
        $i = 0; ?>
      <ol class="c-forum-list c-forum-list--borderless">
          <?php while ($topics->have_posts()): $topics->the_post();
              $categories = get_the_terms($topics->ID, 'category'); ?>
            <li class="c-forum-list__item">
                <?php
                switch (get_field('status')) {
                    case 'resolved':
                        echo '<div class="c-avatar__wrapper c-avatar__wrapper--42 c-avatar__wrapper--resolved" title="Sujet résolu">';
                        break;
                    default:
                        echo '<div class="c-avatar__wrapper c-avatar__wrapper--42">';
                }
                echo get_avatar(get_the_author_email(), 42, '', '', ['class' => 'c-avatar__img']) . '</div>'; ?>
              <div class="c-forum-list__desc">
                <a href="<?= get_the_permalink(); ?>"><?php the_title(); ?></a>
                <p>
                  Posté par <?php the_author(); ?> le
                  <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                      <?php echo get_the_date(); ?>
                  </time>
                </p>
              </div>
              <div class="c-forum-list__meta">
                  <?php if ($categories && !is_wp_error($categories)): foreach ($categories as $cat): ?>
                    <span class="c-tag c-tag--small"><?= $cat->name; ?></span>
                  <?php endforeach; endif; ?>
                <span class="c-icon c-icon--eye"
                      title="<?php webart_the_post_view('Aucune vue', 'Une vue', '% vues'); ?>"><?=
                    webart_get_the_post_view(); ?>
                    </span>
                <span class="c-icon c-icon--bubble"
                      title="<?php comments_number('Aucune réponse', 'Une réponse', '% réponses'); ?>"><?=
                    get_comments_number() ?>
                    </span>
              </div>
            </li>
          <?php endwhile; ?>
      </ol><?php
        $total_pages = $topics->max_num_pages; ?>
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

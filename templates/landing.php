<?php /* Template Name: Landing */
get_header(); ?>

  <main>

      <?php
      $news = new WP_Query([
          'post_type' => 'news',
          'nopaging ' => true,
          'no_found_rows' => true,
          'posts_per_page' => 4,
      ]);
      if ($news->have_posts()): $i = 0; ?>
        <section>
          <div class="o-wrapper">
            <h2>Actualités du web</h2>
            <div class="o-grid o-grid__medium o-grid__container"><?php
                while ($news->have_posts()): $i++;
                    $news->the_post();
                    if ($i === 1): ?>
                      <article class="o-media o-grid--full">
                        <div class="o-media__img">
                          <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                             class="c-link">
                              <?php the_post_thumbnail('webart-promoted', ['class' => 'c-thumbnail c-thumbnail--promoted']); ?>
                          </a>
                        </div>
                        <div class="o-media__text">
                          <h3>
                            <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                               class="c-link">
                                <?php the_title(); ?>
                            </a>
                          </h3>
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
                      <article>
                      <div>
                        <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                           class="c-link">
                            <?php the_post_thumbnail('webart-thumbnail', ['class' => 'c-thumbnail']); ?>
                        </a>
                      </div>
                      <div>
                        <h3>
                          <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>"
                             class="c-link">
                              <?php the_title(); ?>
                          </a>
                        </h3>
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
                endwhile; ?>
            </div>
            <div class="c-link__wrapper">
              <a href="<?= get_post_type_archive_link('news'); ?>"
                 title="Vers la liste complète des actus" class="c-link c-link__cta-big">
                Découvrir d'autres actus
              </a>
            </div>
          </div>
        </section>
      <?php endif;
      wp_reset_postdata();

      $tutosOptions = get_field('header', 'tutorial_options');
      if ($tutosOptions && $tutosOptions['page_illu']) {
          $tutoIlluPath = get_template_directory() . '/inc/' . $tutosOptions['page_illu'] . '.svg';
          $tutoHasIllu = file_exists($tutoIlluPath);
      }
      $tutos = new WP_Query([
          'post_type' => 'tutorial',
          'nopaging ' => true,
          'no_found_rows' => true,
          'posts_per_page' => 8,
      ]);
      if ($tutos->have_posts()): ?>
        <section>
          <div class="o-wrapper o-wrapper--larger">
            <h2>Tutos du moment</h2>
            <div class="o-media o-media--center">
              <div class="o-media__img c-tuto-list__illu-container">
                  <?php if ($tutoHasIllu): ?>
                    <div class="c-tuto-list__illu">
                      <?php include $tutoIlluPath; ?>
                    </div><?php
                  endif; ?>
              </div>
              <ol class="o-media__text c-tuto-list">
                  <?php while ($tutos->have_posts()): $tutos->the_post();
                      $terms = get_the_terms($tutos->ID, 'language-tutorial'); ?>
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
              </ol>
            </div>
            <div class="c-link__wrapper">
              <a href="<?= get_post_type_archive_link('tutorial'); ?>"
                 title="Vers la liste complète des tutos" class="c-link c-link__cta-big">
                Voir l'ensemble des tutos
              </a>
            </div>
          </div>
        </section>
      <?php endif;
      wp_reset_postdata();

      $topics = new WP_Query([
          'post_type' => 'topic',
          'nopaging ' => true,
          'no_found_rows' => true,
          'posts_per_page' => 5,
      ]);
      if ($topics->have_posts()): ?>
        <section>
        <div class="o-wrapper">
          <h2>Dernières discussions</h2>
          <ol class="c-forum-list">
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
          </ol>
          <div class="c-link__wrapper">
            <a href="<?= get_post_type_archive_link('topic'); ?>"
               title="Vers la liste des sujets de discussion" class="c-link c-link__cta-big">
              Parcourir le forum
            </a>
          </div>
        </div>
        </section><?php
      endif;
      wp_reset_postdata(); ?>

  </main>
<?php get_footer();

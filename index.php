<?php
get_header(); ?>
  <main>
    <div class="o-wrapper o-wrapper--smaller">
        <?php if (have_posts()): while (have_posts()):
            the_post();

            $excerpt = get_the_excerpt();
            echo '<p>' . $excerpt . '</p>';

            $tags = webart_get_all_terms(get_the_ID());
            if ($tags) {
                echo 'Tags&nbsp;: ' . implode(', ', $tags);
            }

            if ($excerpt || $tags) {
                echo '<hr>';
            }

            the_content();

            if (have_rows('sources')): ?>
              <div style="line-height: 1.5; margin-top: 1em;">
                <strong>Sources&nbsp;: </strong><?php
                while (have_rows('sources')) : the_row(); ?>
                  <div><?php
                    if (get_row_layout() == 'source_link'): ?>
                      <a href="<?= get_sub_field('source_link_content')['url'] ?>" title="Vers la source (externe)">
                        <?= get_sub_field('source_link_content')['title'] ?>
                      </a><?php
                    elseif (get_row_layout() == 'source_text'):
                        the_sub_field('source_text_content');
                    endif; ?>
                  </div><?php
                endwhile; ?>
              </div><?php
            endif;
            wp_reset_postdata();

            comments_template('', true);

        endwhile;
        endif;
        // else
        // get_template_part('template-parts/content/content', 'none');
        ?>
    </div>
  </main>

<?php
get_footer();

<?php
get_template_part('template-parts/header', 'common'); ?>
  <div class="o-wrapper o-wrapper--larger c-page-intro c-page-intro--text-only">
    <h1 id="content">Recherche</h1>
  </div>
  </header>

  <main>

    <form action="#" method="get" class="o-wrapper o-wrapper--smaller c-forum-list__search">
      <input type="search" name="s" id="search-site" value="<?php echo get_search_query(); ?>"
             placeholder="Rechercher sur le site">
      <label class="sr-only" for="search-site">Sujet à rechercher</label>
      <button type="submit">
        <span>Rechercher</span><span class="c-icon c-icon--search"></span>
      </button>
    </form>

    <div class="o-wrapper o-wrapper--smaller">
        <?php if (have_posts()) : echo '<ul>';
            while (have_posts()) : the_post(); ?>
              <li>
              <a href="<?= get_the_permalink(); ?>" title="Vers l'article <?= get_the_title(); ?>" class="c-link">
                  <?php the_title(); ?>
              </a>
              </li><?php
            endwhile;
            echo '</ul>';

            webart_the_posts_navigation();

        // If no content, include the "No posts found" template.
        else :
            // get_template_part( 'template-parts/content/content', 'none' );
            echo '<p>Aucun résultat ne correspond à votre recherche</p>';
        endif;
        ?>
    </div>
  </main>

<?php
get_footer();

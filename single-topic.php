<?php get_header();
webart_set_post_view(); ?>

  <main>
    <div class="o-wrapper o-wrapper--smaller">
        <?php if (have_posts()): while (have_posts()): the_post();
            the_content();

        endwhile; endif;
        // else
        // get_template_part('template-parts/content/content', 'none');
        ?>
    </div>
  </main>

<?php
get_footer();

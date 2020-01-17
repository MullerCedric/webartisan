<?php

if (!function_exists('comment_template')):
    function comment_template($comment, $args, $depth)
    {
        ?>
    <li <?php comment_class(['o-media', 'c-comment']); ?> id="comment-<?php comment_ID() ?>">
      <div class="o-media__img">
          <div class="c-avatar__wrapper c-avatar__wrapper--42">
              <?= get_avatar($comment, 42, '', '', ['class' => 'c-avatar__img']); ?>
          </div>
      </div>
      <div class="o-media__text">
          <div class="c-comment__meta">
              Posté par <?= get_comment_author(); ?> le <?= get_comment_date(); ?> à <?= get_comment_time(); ?>
          </div>
          <?php if (!$comment->comment_approved) : ?>
            <p>
                <em>Votre commentaire est en attente de modération</em>
            </p>
          <?php endif; ?>

        <div class="c-comment__text">
            <?php comment_text() ?>
        </div>
      </div>
        <?php
    }

endif;

<hr>
<section class="c-comment__section">
  <h2>Commentaires</h2>
    <?php
    if (have_comments()) : ?>
      <ol class="c-comment__list">
          <?php
          wp_list_comments(array(
              'style' => 'ol',
              'callback' => 'comment_template',
              'short_ping' => true,
          )); ?>
      </ol>
    <?php endif; ?>

  <section><?php
      $args = array(
          'action' => site_url('/wp-comments-post.php/#respond'),
          'id_form' => 'commentform',
          'class_form' => 'c-comment__form',
          'class_submit' => 'c-comment__submit',
          'name_submit' => 'submit',
          'title_reply' => 'Ajouter un commentaire',
          'title_reply_before' => '<h3 id="reply-title" class="c-comment__reply-title">',
          'title_reply_to' => 'Répondre à %s',
          'cancel_reply_link' => 'Annuler la réponse',
          'label_submit' => 'Commenter',
          'comment_field' => '<label for="comment">Commentaire</label><textarea id="comment" name="comment" class="c-comment__input" aria-required="true"></textarea>',
          'must_log_in' => '<p>' . sprintf('Vous devez être <a href="%s">connecté</a> pour poster un commentaire', wp_login_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
          'logged_in_as' => '',
          'comment_notes_before' => '',
          'comment_notes_after' => '',
      );

      comment_form($args); ?>
  </section>
</section><?php

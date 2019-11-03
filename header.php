<?php
get_template_part('template-parts/header', 'common');

$headerVars = get_field('header');
if ($headerVars && $headerVars['page_illu']) {
    $illuPath = get_template_directory() . '/inc/' . $headerVars['page_illu'] . '.svg';
    $hasIllu = file_exists($illuPath);
}
?>
<div class="o-wrapper o-wrapper--larger c-page-intro <?= !$hasIllu ? 'c-page-intro--text-only' : '' ?>"><?php
    if ($headerVars): ?>
      <div class="c-page-desc">
      <h1 id="content"><?php the_title(); ?></h1>
      <div class="c-tagline"><?= $headerVars['page_desc']; ?></div>
      </div><?php
        if ($hasIllu): ?>
          <div class="c-page-illu">
            <?php include $illuPath; ?>
          </div><?php
        endif;
    else: ?>
      <h1 id="content"><?php the_title(); ?></h1><?php
    endif; ?>
</div>
</header>

<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and the header section
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>"/>
  <meta name="author" content="Cédric Müller">
  <meta name="description" content="<?= get_bloginfo('description'); ?>">
  <meta name="keywords"
        content="web, design, qualité, code, codage, tutos, tutoriel, front-end, back-end, web developer, sites, internet, Liège">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="" href="#content">Passer au contenu</a>

<header>
  <div>
      <?php get_template_part('template-parts/header', 'main-nav'); ?>
  </div>
  <div><?php
      $headerVars = get_field('header');
      if ($headerVars): ?>
        <div>
          <h1 id="content"><?php the_title(); ?></h1>
          <div><?= $headerVars['page_desc']; ?></div>
        </div>
        <div>
            <?= $headerVars['page_illu']; ?>
        </div>
      <?php else: ?>
        <h1 id="content"><?php the_title(); ?></h1>
      <?php endif; ?>
  </div>
</header>

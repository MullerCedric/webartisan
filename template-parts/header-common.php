<!doctype html>
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
<a class="sr-only-focusable" href="#content">Passer au contenu</a>

<header>
  <div class="c-toolbar">
      <?php get_template_part('template-parts/header', 'toolbar'); ?>
  </div>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
    <header>
        <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php else : ?>
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <?php endif; ?>
    </header>
    <main>

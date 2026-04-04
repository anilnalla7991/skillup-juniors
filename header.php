<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?><?php wp_title(' | '); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="sj-header">
    <div class="sj-header__inner">

        <!-- Logo -->
        <div class="sj-header__logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/skill up junior's Capital.png"
                    alt="<?php bloginfo('name'); ?>"
                >
            </a>
        </div>

        <!-- Primary Navigation Pill -->
        <nav class="sj-header__nav" aria-label="Primary Navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'sj-nav__list',
                'fallback_cb'    => false,
            ]);
            ?>
        </nav>

        <!-- CTA Buttons -->
        <div class="sj-header__cta">
            <?php
            $login_text = get_field('header_login_text', 'option') ?: 'LOGIN';
            $login_url  = get_field('header_login_url',  'option') ?: '#';
            $app_text   = get_field('header_app_text',   'option') ?: 'App Download';
            $app_url    = get_field('header_app_url',    'option') ?: '#';
            ?>
            <a href="<?php echo esc_url($login_url); ?>" class="sj-btn sj-btn--login">
                <?php echo esc_html($login_text); ?>
            </a>
            <a href="<?php echo esc_url($app_url); ?>" class="sj-btn sj-btn--app">
                <?php echo esc_html($app_text); ?>
            </a>
        </div>

        <!-- Mobile Hamburger -->
        <button class="sj-header__toggle" aria-label="Toggle Menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header>

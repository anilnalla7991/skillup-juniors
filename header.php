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

<!-- Drawer Overlay -->
<div class="sj-drawer-overlay" id="sj-drawer-overlay" aria-hidden="true"></div>

<!-- Side Drawer (Mobile) -->
<aside class="sj-drawer" id="sj-drawer" aria-label="Mobile Navigation" aria-hidden="true">
    <div class="sj-drawer__header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="sj-drawer__logo">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/skill up junior's Capital.png"
                alt="<?php bloginfo('name'); ?>"
            >
        </a>
        <button class="sj-drawer__close" id="sj-drawer-close" aria-label="Close Menu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </button>
    </div>

    <nav class="sj-drawer__nav">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'sj-drawer__list',
            'fallback_cb'    => 'sj_drawer_fallback_menu',
        ]);
        ?>
    </nav>

    <div class="sj-drawer__cta">
        <?php
        $login_text = get_option('sj_header_login_text', 'LOGIN');
        $login_url  = get_option('sj_header_login_url',  '#');
        $app_text   = get_option('sj_header_app_text',   'App Download');
        $app_url    = get_option('sj_header_app_url',    '#');
        ?>
        <a href="<?php echo esc_url($login_url); ?>" class="sj-btn sj-btn--login sj-btn--full">
            <?php echo esc_html($login_text); ?>
        </a>
        <a href="<?php echo esc_url($app_url); ?>" class="sj-btn sj-btn--app sj-btn--full">
            <?php echo esc_html($app_text); ?>
        </a>
    </div>
</aside>

<!-- Main Header -->
<header class="sj-header" id="sj-header">
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
                'fallback_cb'    => 'sj_header_fallback_menu',
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
        <button class="sj-header__toggle" id="sj-hamburger" aria-label="Open Menu" aria-expanded="false" aria-controls="sj-drawer">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header>

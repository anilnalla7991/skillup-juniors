<?php

// ─── Enqueue Assets ────────────────────────────────────────────────────────────
function sj_enqueue_assets() {
    wp_enqueue_style(
        'sj-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap',
        [],
        null
    );
    wp_enqueue_style('sj-style', get_stylesheet_uri(), [], '1.0');
    wp_enqueue_style(
        'sj-assets',
        get_template_directory_uri() . '/assets/css/style.css',
        ['sj-style'],
        '1.0'
    );
    wp_enqueue_script(
        'sj-script',
        get_template_directory_uri() . '/assets/js/script.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'sj_enqueue_assets');

// ─── Register Nav Menus ────────────────────────────────────────────────────────
function sj_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Navigation', 'skillup-juniors'),
    ]);
}
add_action('init', 'sj_register_menus');

// ─── ACF Options Page ──────────────────────────────────────────────────────────
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ]);
}

// ─── ACF: Header Field Group ───────────────────────────────────────────────────
function sj_acf_header_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'    => 'group_header',
        'title'  => 'Header Settings',
        'fields' => [
            [
                'key'           => 'field_header_login_text',
                'label'         => 'Login Button Text',
                'name'          => 'header_login_text',
                'type'          => 'text',
                'default_value' => 'LOGIN',
                'instructions'  => 'Text shown on the Login button.',
            ],
            [
                'key'          => 'field_header_login_url',
                'label'        => 'Login Button URL',
                'name'         => 'header_login_url',
                'type'         => 'url',
                'instructions' => 'Link for the Login button.',
            ],
            [
                'key'           => 'field_header_app_text',
                'label'         => 'App Download Button Text',
                'name'          => 'header_app_text',
                'type'          => 'text',
                'default_value' => 'App Download',
                'instructions'  => 'Text shown on the App Download button.',
            ],
            [
                'key'          => 'field_header_app_url',
                'label'        => 'App Download URL',
                'name'         => 'header_app_url',
                'type'         => 'url',
                'instructions' => 'Link for the App Download button (Play Store / App Store).',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-settings',
                ],
            ],
        ],
    ]);
}
add_action('acf/init', 'sj_acf_header_fields');

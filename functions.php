<?php

// ─── Theme Support ─────────────────────────────────────────────────────────────
function sj_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
}
add_action('after_setup_theme', 'sj_theme_setup');

// ─── Enqueue Assets ────────────────────────────────────────────────────────────
function sj_enqueue_assets() {
    wp_enqueue_style(
        'sj-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
        [],
        null
    );
    wp_enqueue_style('sj-style', get_stylesheet_uri(), [], '1.0');
    wp_enqueue_style(
        'sj-assets',
        get_template_directory_uri() . '/assets/css/style.css',
        ['sj-style'],
        '2.0'
    );
    wp_enqueue_script(
        'sj-script',
        get_template_directory_uri() . '/assets/js/script.js',
        [],
        '2.0',
        true
    );
    wp_localize_script('sj-script', 'sj_ajax', [
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sj_lead_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'sj_enqueue_assets');

// ─── Register Nav Menus ────────────────────────────────────────────────────────
function sj_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Navigation', 'skillup-juniors'),
        'footer'  => __('Footer Navigation', 'skillup-juniors'),
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

// ─── ACF Field Groups ──────────────────────────────────────────────────────────
add_action('acf/init', 'sj_register_acf_fields');

function sj_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    $front_page_location = [[[
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
    ]]];

    // ── Header Settings ────────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_header',
        'title'  => 'Header Settings',
        'fields' => [
            ['key' => 'field_header_login_text', 'label' => 'Login Button Text',     'name' => 'header_login_text', 'type' => 'text',  'default_value' => 'LOGIN'],
            ['key' => 'field_header_login_url',  'label' => 'Login Button URL',      'name' => 'header_login_url',  'type' => 'url'],
            ['key' => 'field_header_app_text',   'label' => 'App Download Text',     'name' => 'header_app_text',   'type' => 'text',  'default_value' => 'App Download'],
            ['key' => 'field_header_app_url',    'label' => 'App Download URL',      'name' => 'header_app_url',    'type' => 'url'],
        ],
        'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'theme-settings']]],
    ]);

    // ── Home: Hero ─────────────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_hero',
        'title'  => 'Home — Hero Banner',
        'fields' => [
            ['key' => 'field_home_hero_badge',      'label' => 'Badge Text',          'name' => 'home_hero_badge',      'type' => 'text',    'default_value' => 'Trusted by 10,000+ Families Across India'],
            ['key' => 'field_home_hero_heading',    'label' => 'Heading (HTML ok)',   'name' => 'home_hero_heading',    'type' => 'text',    'default_value' => 'Unlock Your Child\'s <span>True Potential</span>'],
            ['key' => 'field_home_hero_subheading', 'label' => 'Sub-heading',         'name' => 'home_hero_subheading', 'type' => 'textarea','rows' => 2],
            ['key' => 'field_home_hero_cta1_text',  'label' => 'Primary CTA Text',    'name' => 'home_hero_cta1_text',  'type' => 'text',    'default_value' => 'Book Free Demo'],
            ['key' => 'field_home_hero_cta1_url',   'label' => 'Primary CTA URL',     'name' => 'home_hero_cta1_url',   'type' => 'url'],
            ['key' => 'field_home_hero_cta2_text',  'label' => 'Secondary CTA Text',  'name' => 'home_hero_cta2_text',  'type' => 'text',    'default_value' => 'Explore Programs'],
            ['key' => 'field_home_hero_cta2_url',   'label' => 'Secondary CTA URL',   'name' => 'home_hero_cta2_url',   'type' => 'url'],
            ['key' => 'field_home_hero_image',      'label' => 'Hero Image',          'name' => 'home_hero_image',      'type' => 'image',   'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_home_hero_stat1_num',  'label' => 'Stat 1 — Number',     'name' => 'home_hero_stat1_num',  'type' => 'text',    'default_value' => '10K+'],
            ['key' => 'field_home_hero_stat1_lbl',  'label' => 'Stat 1 — Label',      'name' => 'home_hero_stat1_label','type' => 'text',    'default_value' => 'Students Enrolled'],
            ['key' => 'field_home_hero_stat2_num',  'label' => 'Stat 2 — Number',     'name' => 'home_hero_stat2_num',  'type' => 'text',    'default_value' => '50+'],
            ['key' => 'field_home_hero_stat2_lbl',  'label' => 'Stat 2 — Label',      'name' => 'home_hero_stat2_label','type' => 'text',    'default_value' => 'Expert Trainers'],
            ['key' => 'field_home_hero_stat3_num',  'label' => 'Stat 3 — Number',     'name' => 'home_hero_stat3_num',  'type' => 'text',    'default_value' => '15+'],
            ['key' => 'field_home_hero_stat3_lbl',  'label' => 'Stat 3 — Label',      'name' => 'home_hero_stat3_label','type' => 'text',    'default_value' => 'Cities Covered'],
        ],
        'location' => $front_page_location,
        'menu_order' => 10,
    ]);

    // ── Home: Lead Form ────────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_form',
        'title'  => 'Home — Lead Form Section',
        'fields' => [
            ['key' => 'field_home_form_heading',    'label' => 'Heading (HTML ok)', 'name' => 'home_form_heading',    'type' => 'text',    'default_value' => 'Book a <span>Free Demo Class</span> Today!'],
            ['key' => 'field_home_form_subheading', 'label' => 'Sub-heading',       'name' => 'home_form_subheading', 'type' => 'textarea','rows' => 2],
            ['key' => 'field_home_form_perk1',      'label' => 'Perk 1',            'name' => 'home_form_perk1',      'type' => 'text',    'default_value' => '100% Free — No Commitment'],
            ['key' => 'field_home_form_perk2',      'label' => 'Perk 2',            'name' => 'home_form_perk2',      'type' => 'text',    'default_value' => 'Live Online or In-Person'],
            ['key' => 'field_home_form_perk3',      'label' => 'Perk 3',            'name' => 'home_form_perk3',      'type' => 'text',    'default_value' => 'Certified Expert Trainers'],
        ],
        'location' => $front_page_location,
        'menu_order' => 20,
    ]);

    // ── Home: Mission / About ──────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_mission',
        'title'  => 'Home — Mission & About Section',
        'fields' => [
            ['key' => 'field_home_mission_heading', 'label' => 'Mission Heading',      'name' => 'home_mission_heading',       'type' => 'text',    'default_value' => 'Our Mission & Vision'],
            ['key' => 'field_home_mission_content', 'label' => 'Mission Content',      'name' => 'home_mission_content',       'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
            ['key' => 'field_home_mission_icon',    'label' => 'Mission Icon (opt.)',  'name' => 'home_mission_icon',          'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_home_about_heading',   'label' => 'Director\'s Msg Heading','name' => 'home_about_heading',       'type' => 'text',    'default_value' => "Director's Message"],
            ['key' => 'field_home_about_content',   'label' => 'Director\'s Message',  'name' => 'home_about_content',        'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
            ['key' => 'field_home_about_dir_name',  'label' => 'Director Name',        'name' => 'home_about_director_name',  'type' => 'text'],
            ['key' => 'field_home_about_dir_role',  'label' => 'Director Role/Title',  'name' => 'home_about_director_role',  'type' => 'text',    'default_value' => 'Founder & Director, SkillUp Juniors'],
            ['key' => 'field_home_about_dir_img',   'label' => 'Director Photo',       'name' => 'home_about_director_image', 'type' => 'image',   'return_format' => 'array'],
        ],
        'location' => $front_page_location,
        'menu_order' => 30,
    ]);

    // ── Home: Courses ──────────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_courses',
        'title'  => 'Home — Courses Section',
        'fields' => [
            ['key' => 'field_home_courses_heading', 'label' => 'Section Heading',  'name' => 'home_courses_heading',    'type' => 'text',    'default_value' => 'Our Programs'],
            ['key' => 'field_home_courses_sub',     'label' => 'Section Sub-text', 'name' => 'home_courses_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'        => 'field_home_courses_list',
                'label'      => 'Courses',
                'name'       => 'home_courses_list',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'block',
                'button_label' => 'Add Course',
                'sub_fields' => [
                    ['key' => 'field_home_course_title', 'label' => 'Course Title',       'name' => 'course_title',       'type' => 'text'],
                    ['key' => 'field_home_course_desc',  'label' => 'Short Description',  'name' => 'course_description', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_home_course_icon',  'label' => 'Course Icon',        'name' => 'course_icon',        'type' => 'image',    'return_format' => 'array'],
                    ['key' => 'field_home_course_link',  'label' => 'Course Page URL',    'name' => 'course_link',        'type' => 'url'],
                    [
                        'key'           => 'field_home_course_color',
                        'label'         => 'Card Colour',
                        'name'          => 'course_color',
                        'type'          => 'select',
                        'choices'       => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal'],
                        'default_value' => 'blue',
                    ],
                ],
            ],
        ],
        'location' => $front_page_location,
        'menu_order' => 40,
    ]);

    // ── Home: Learning Approach ────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_approach',
        'title'  => 'Home — Learning Approach Section',
        'fields' => [
            ['key' => 'field_home_approach_heading', 'label' => 'Section Heading',  'name' => 'home_approach_heading',    'type' => 'text',    'default_value' => 'Our Learning Approach'],
            ['key' => 'field_home_approach_sub',     'label' => 'Section Sub-text', 'name' => 'home_approach_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'        => 'field_home_approach_steps',
                'label'      => 'Steps',
                'name'       => 'home_approach_steps',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'table',
                'button_label' => 'Add Step',
                'sub_fields' => [
                    ['key' => 'field_home_step_title', 'label' => 'Step Title',       'name' => 'step_title',       'type' => 'text'],
                    ['key' => 'field_home_step_desc',  'label' => 'Step Description', 'name' => 'step_description', 'type' => 'textarea', 'rows' => 2],
                    ['key' => 'field_home_step_icon',  'label' => 'Step Icon (opt.)', 'name' => 'step_icon',        'type' => 'image',    'return_format' => 'array'],
                ],
            ],
        ],
        'location' => $front_page_location,
        'menu_order' => 50,
    ]);

    // ── Home: Testimonials ─────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_testimonials',
        'title'  => 'Home — Testimonials Section',
        'fields' => [
            ['key' => 'field_home_testi_heading', 'label' => 'Section Heading',  'name' => 'home_testimonials_heading',    'type' => 'text',    'default_value' => 'What Parents Say'],
            ['key' => 'field_home_testi_sub',     'label' => 'Section Sub-text', 'name' => 'home_testimonials_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'        => 'field_home_testi_list',
                'label'      => 'Testimonials',
                'name'       => 'home_testimonials_list',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'block',
                'button_label' => 'Add Testimonial',
                'sub_fields' => [
                    ['key' => 'field_home_testi_name',    'label' => 'Parent Name',  'name' => 'testimonial_name',    'type' => 'text'],
                    ['key' => 'field_home_testi_role',    'label' => 'Role / Child', 'name' => 'testimonial_role',    'type' => 'text'],
                    ['key' => 'field_home_testi_content', 'label' => 'Message',      'name' => 'testimonial_content', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_home_testi_image',   'label' => 'Photo (opt.)', 'name' => 'testimonial_image',   'type' => 'image',    'return_format' => 'array'],
                    ['key' => 'field_home_testi_rating',  'label' => 'Rating (1-5)', 'name' => 'testimonial_rating',  'type' => 'number',   'min' => 1, 'max' => 5, 'default_value' => 5],
                ],
            ],
        ],
        'location' => $front_page_location,
        'menu_order' => 60,
    ]);

    // ── Footer Settings ────────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_footer',
        'title'  => 'Footer Settings',
        'fields' => [
            ['key' => 'field_footer_tagline',   'label' => 'Brand Tagline',  'name' => 'footer_tagline',   'type' => 'text',     'default_value' => 'Transforming young minds through expert education.'],
            ['key' => 'field_footer_address',   'label' => 'Address',        'name' => 'footer_address',   'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_footer_phone',     'label' => 'Phone',          'name' => 'footer_phone',     'type' => 'text',     'default_value' => '+91 00000 00000'],
            ['key' => 'field_footer_email',     'label' => 'Email',          'name' => 'footer_email',     'type' => 'email',    'default_value' => 'hello@skillupjuniors.com'],
            ['key' => 'field_footer_copyright', 'label' => 'Copyright Text', 'name' => 'footer_copyright', 'type' => 'text'],
            [
                'key'        => 'field_footer_social_links',
                'label'      => 'Social Links',
                'name'       => 'footer_social_links',
                'type'       => 'repeater',
                'layout'     => 'table',
                'button_label' => 'Add Social Link',
                'sub_fields' => [
                    ['key' => 'field_footer_social_platform', 'label' => 'Platform', 'name' => 'social_platform', 'type' => 'text'],
                    ['key' => 'field_footer_social_url',      'label' => 'URL',      'name' => 'social_url',      'type' => 'url'],
                ],
            ],
        ],
        'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'theme-settings']]],
        'menu_order' => 100,
    ]);
}

// ─── Lead Form AJAX Handler ────────────────────────────────────────────────────
add_action('wp_ajax_sj_submit_lead',        'sj_handle_lead_form');
add_action('wp_ajax_nopriv_sj_submit_lead', 'sj_handle_lead_form');

function sj_handle_lead_form() {
    check_ajax_referer('sj_lead_nonce', 'nonce');

    $parent_name = sanitize_text_field($_POST['parent_name'] ?? '');
    $phone       = sanitize_text_field($_POST['phone']       ?? '');
    $email       = sanitize_email($_POST['email']            ?? '');
    $child_age   = sanitize_text_field($_POST['child_age']   ?? '');
    $program     = sanitize_text_field($_POST['program']     ?? '');

    if (empty($parent_name) || empty($phone) || empty($email)) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Please enter a valid email address.']);
    }

    $admin_email = get_option('admin_email');
    $subject     = 'New Demo Booking — SkillUp Juniors';
    $body        = sprintf(
        "New Lead Enquiry\n\nName: %s\nPhone: %s\nEmail: %s\nChild Age: %s\nProgram: %s",
        $parent_name, $phone, $email, $child_age, $program
    );

    wp_mail($admin_email, $subject, $body);

    wp_send_json_success(['message' => 'Thank you! We will contact you within 24 hours.']);
}

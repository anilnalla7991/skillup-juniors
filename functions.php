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

// ─── Fallback Nav (shown when no menu assigned in WP Admin) ────────────────────
function sj_header_fallback_menu() {
    $pages = [
        home_url('/')                   => 'Home',
        home_url('/about')              => 'About Us',
        home_url('/vedic-maths')        => 'Vedic Maths Program',
        home_url('/phonics')            => 'Phonics Program',
        home_url('/skill-development')  => 'Skill Development',
        home_url('/contact')            => 'Contact Us',
    ];
    echo '<ul class="sj-nav__list">';
    foreach ($pages as $url => $label) {
        echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}

function sj_drawer_fallback_menu() {
    $pages = [
        home_url('/')                   => 'Home',
        home_url('/about')              => 'About Us',
        home_url('/vedic-maths')        => 'Vedic Maths Program',
        home_url('/phonics')            => 'Phonics Program',
        home_url('/skill-development')  => 'Skill Development',
        home_url('/contact')            => 'Contact Us',
    ];
    echo '<ul class="sj-drawer__list">';
    foreach ($pages as $url => $label) {
        echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}

// ─── Theme Settings Page (Native WP — no ACF PRO needed) ──────────────────────
add_action('admin_menu', 'sj_add_settings_page');

function sj_add_settings_page() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'sj-theme-settings',
        'sj_settings_page_html',
        'dashicons-admin-customizer',
        60
    );
}

function sj_settings_page_html() {
    if (!current_user_can('manage_options')) return;

    // Save
    if (isset($_POST['sj_settings_nonce']) && wp_verify_nonce($_POST['sj_settings_nonce'], 'sj_save_settings')) {
        $fields = [
            'sj_header_login_text', 'sj_header_login_url',
            'sj_header_app_text',   'sj_header_app_url',
            'sj_footer_tagline',    'sj_footer_address',
            'sj_footer_phone',      'sj_footer_email',
            'sj_footer_copyright',
        ];
        foreach ($fields as $key) {
            $val = $_POST[$key] ?? '';
            if (in_array($key, ['sj_header_login_url', 'sj_header_app_url'])) {
                update_option($key, esc_url_raw($val));
            } elseif ($key === 'sj_footer_email') {
                update_option($key, sanitize_email($val));
            } elseif ($key === 'sj_footer_address') {
                update_option($key, sanitize_textarea_field($val));
            } else {
                update_option($key, sanitize_text_field($val));
            }
        }
        echo '<div class="notice notice-success is-dismissible"><p><strong>Settings saved successfully!</strong></p></div>';
    }

    // Read current values
    $v = [
        'login_text'  => get_option('sj_header_login_text', 'LOGIN'),
        'login_url'   => get_option('sj_header_login_url',  ''),
        'app_text'    => get_option('sj_header_app_text',   'App Download'),
        'app_url'     => get_option('sj_header_app_url',    ''),
        'tagline'     => get_option('sj_footer_tagline',    'Transforming young minds through expert education.'),
        'address'     => get_option('sj_footer_address',    ''),
        'phone'       => get_option('sj_footer_phone',      ''),
        'email'       => get_option('sj_footer_email',      ''),
        'copyright'   => get_option('sj_footer_copyright',  '&copy; ' . date('Y') . ' SkillUp Juniors. All Rights Reserved.'),
    ];
    ?>
    <div class="wrap">
        <h1 style="margin-bottom:20px;">&#9881; Theme Settings</h1>
        <form method="post">
            <?php wp_nonce_field('sj_save_settings', 'sj_settings_nonce'); ?>

            <h2 style="border-bottom:1px solid #ddd;padding-bottom:8px;">&#128279; Header Buttons</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="sj_header_login_text">Login / Portal Button Text</label></th>
                    <td><input type="text" id="sj_header_login_text" name="sj_header_login_text" value="<?php echo esc_attr($v['login_text']); ?>" class="regular-text" placeholder="e.g. Web Portal"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_header_login_url">Login / Portal Button URL</label></th>
                    <td><input type="url" id="sj_header_login_url" name="sj_header_login_url" value="<?php echo esc_attr($v['login_url']); ?>" class="regular-text" placeholder="https://"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_header_app_text">App Download Button Text</label></th>
                    <td><input type="text" id="sj_header_app_text" name="sj_header_app_text" value="<?php echo esc_attr($v['app_text']); ?>" class="regular-text" placeholder="e.g. App Download"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_header_app_url">App Download URL</label></th>
                    <td><input type="url" id="sj_header_app_url" name="sj_header_app_url" value="<?php echo esc_attr($v['app_url']); ?>" class="regular-text" placeholder="https://play.google.com/..."></td>
                </tr>
            </table>

            <h2 style="border-bottom:1px solid #ddd;padding-bottom:8px;margin-top:30px;">&#128196; Footer</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="sj_footer_tagline">Brand Tagline</label></th>
                    <td><input type="text" id="sj_footer_tagline" name="sj_footer_tagline" value="<?php echo esc_attr($v['tagline']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_footer_address">Address</label></th>
                    <td><textarea id="sj_footer_address" name="sj_footer_address" rows="3" class="regular-text"><?php echo esc_textarea($v['address']); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_footer_phone">Phone Number</label></th>
                    <td><input type="text" id="sj_footer_phone" name="sj_footer_phone" value="<?php echo esc_attr($v['phone']); ?>" class="regular-text" placeholder="+91 00000 00000"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_footer_email">Email Address</label></th>
                    <td><input type="email" id="sj_footer_email" name="sj_footer_email" value="<?php echo esc_attr($v['email']); ?>" class="regular-text" placeholder="hello@skillupjuniors.com"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sj_footer_copyright">Copyright Text</label></th>
                    <td><input type="text" id="sj_footer_copyright" name="sj_footer_copyright" value="<?php echo esc_attr($v['copyright']); ?>" class="regular-text"></td>
                </tr>
            </table>

            <?php submit_button('Save Settings', 'primary large'); ?>
        </form>
    </div>
    <?php
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

    // Header & Footer settings are now managed via the native Theme Settings page
    // (WP Admin → Theme Settings) using get_option() / update_option().

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

    // ── Vedic Maths Page ───────────────────────────────────────────────────────
    $vm_page_location = [[[
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-vedic-maths.php',
    ]]];

    // VM: Hero
    acf_add_local_field_group([
        'key'    => 'group_vm_hero',
        'title'  => 'Vedic Maths — Hero Banner',
        'fields' => [
            ['key' => 'field_vm_hero_badge',     'label' => 'Badge Text',         'name' => 'vm_hero_badge',      'type' => 'text',    'default_value' => "India's #1 Vedic Maths Program for Kids"],
            ['key' => 'field_vm_hero_heading',   'label' => 'Heading (HTML ok)',  'name' => 'vm_hero_heading',    'type' => 'text',    'default_value' => 'Faster Calculations.<br><span>Sharper Mind.</span><br>Confident Child.'],
            ['key' => 'field_vm_hero_sub',       'label' => 'Sub-heading',        'name' => 'vm_hero_subheading', 'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_hero_cta1_text', 'label' => 'Primary CTA Text',  'name' => 'vm_hero_cta1_text',  'type' => 'text',    'default_value' => 'Book Free Demo'],
            ['key' => 'field_vm_hero_cta1_url',  'label' => 'Primary CTA URL',   'name' => 'vm_hero_cta1_url',   'type' => 'url'],
            ['key' => 'field_vm_hero_cta2_text', 'label' => 'Secondary CTA Text','name' => 'vm_hero_cta2_text',  'type' => 'text',    'default_value' => 'View Curriculum'],
            ['key' => 'field_vm_hero_cta2_url',  'label' => 'Secondary CTA URL', 'name' => 'vm_hero_cta2_url',   'type' => 'url'],
            ['key' => 'field_vm_hero_image',     'label' => 'Hero Image',         'name' => 'vm_hero_image',      'type' => 'image',   'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_vm_stat1_num',      'label' => 'Stat 1 — Number',   'name' => 'vm_stat1_num',       'type' => 'text',    'default_value' => '10K+'],
            ['key' => 'field_vm_stat1_lbl',      'label' => 'Stat 1 — Label',    'name' => 'vm_stat1_label',     'type' => 'text',    'default_value' => 'Students Trained'],
            ['key' => 'field_vm_stat2_num',      'label' => 'Stat 2 — Number',   'name' => 'vm_stat2_num',       'type' => 'text',    'default_value' => '98%'],
            ['key' => 'field_vm_stat2_lbl',      'label' => 'Stat 2 — Label',    'name' => 'vm_stat2_label',     'type' => 'text',    'default_value' => 'Score Improvement'],
            ['key' => 'field_vm_stat3_num',      'label' => 'Stat 3 — Number',   'name' => 'vm_stat3_num',       'type' => 'text',    'default_value' => '3x'],
            ['key' => 'field_vm_stat3_lbl',      'label' => 'Stat 3 — Label',    'name' => 'vm_stat3_label',     'type' => 'text',    'default_value' => 'Faster Calculation'],
            [
                'key'          => 'field_vm_hero_steps',
                'label'        => 'Join Steps',
                'name'         => 'vm_hero_steps',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 5,
                'layout'       => 'table',
                'button_label' => 'Add Step',
                'sub_fields'   => [
                    ['key' => 'field_vm_step_text', 'label' => 'Step Text', 'name' => 'step_text', 'type' => 'text'],
                ],
            ],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 10,
    ]);

    // VM: Curriculum
    acf_add_local_field_group([
        'key'    => 'group_vm_curriculum',
        'title'  => 'Vedic Maths — Curriculum',
        'fields' => [
            ['key' => 'field_vm_curr_heading', 'label' => 'Section Heading',  'name' => 'vm_curriculum_heading',    'type' => 'text',    'default_value' => 'Our Curriculum'],
            ['key' => 'field_vm_curr_sub',     'label' => 'Section Sub-text', 'name' => 'vm_curriculum_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'          => 'field_vm_curr_items',
                'label'        => 'Curriculum Cards',
                'name'         => 'vm_curriculum_items',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 6,
                'layout'       => 'block',
                'button_label' => 'Add Grade',
                'sub_fields'   => [
                    ['key' => 'field_vm_curr_grade',    'label' => 'Grade / Class',      'name' => 'curr_grade',    'type' => 'text'],
                    ['key' => 'field_vm_curr_subtitle', 'label' => 'Card Sub-title',     'name' => 'curr_subtitle', 'type' => 'text'],
                    ['key' => 'field_vm_curr_topics',   'label' => 'Topics (one per line)','name' => 'curr_topics', 'type' => 'textarea', 'rows' => 6],
                    ['key' => 'field_vm_curr_pdf',      'label' => 'Curriculum PDF',     'name' => 'curr_pdf',      'type' => 'file',    'return_format' => 'array', 'library' => 'all'],
                    [
                        'key'           => 'field_vm_curr_color',
                        'label'         => 'Card Accent Colour',
                        'name'          => 'curr_color',
                        'type'          => 'select',
                        'choices'       => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal'],
                        'default_value' => 'blue',
                    ],
                ],
            ],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 20,
    ]);

    // VM: Learning Approach
    acf_add_local_field_group([
        'key'    => 'group_vm_approach',
        'title'  => 'Vedic Maths — Learning Approach',
        'fields' => [
            ['key' => 'field_vm_approach_heading', 'label' => 'Section Heading',  'name' => 'vm_approach_heading',    'type' => 'text',    'default_value' => 'Learning Approach'],
            ['key' => 'field_vm_approach_sub',     'label' => 'Section Sub-text', 'name' => 'vm_approach_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'          => 'field_vm_approach_items',
                'label'        => 'Approach Cards',
                'name'         => 'vm_approach_items',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 9,
                'layout'       => 'table',
                'button_label' => 'Add Card',
                'sub_fields'   => [
                    ['key' => 'field_vm_approach_title', 'label' => 'Card Title',        'name' => 'approach_title',       'type' => 'text'],
                    ['key' => 'field_vm_approach_desc',  'label' => 'Card Description',  'name' => 'approach_description', 'type' => 'textarea', 'rows' => 2],
                    ['key' => 'field_vm_approach_icon',  'label' => 'Custom Icon (opt.)', 'name' => 'approach_icon',        'type' => 'image',    'return_format' => 'array'],
                    [
                        'key'           => 'field_vm_approach_color',
                        'label'         => 'Icon Color',
                        'name'          => 'approach_color',
                        'type'          => 'select',
                        'choices'       => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy'],
                        'default_value' => 'blue',
                    ],
                ],
            ],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 30,
    ]);

    // VM: Foundation
    acf_add_local_field_group([
        'key'    => 'group_vm_foundation',
        'title'  => 'Vedic Maths — Foundation Section',
        'fields' => [
            ['key' => 'field_vm_found_heading', 'label' => 'Heading (HTML ok)', 'name' => 'vm_foundation_heading', 'type' => 'text',     'default_value' => 'We Fix the Root Problem — Foundation'],
            ['key' => 'field_vm_found_text',    'label' => 'Body Text',         'name' => 'vm_foundation_text',    'type' => 'textarea', 'rows' => 5],
            [
                'key'          => 'field_vm_found_highlights',
                'label'        => 'Highlight Pills',
                'name'         => 'vm_foundation_highlights',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 6,
                'layout'       => 'table',
                'button_label' => 'Add Highlight',
                'sub_fields'   => [
                    ['key' => 'field_vm_highlight_text', 'label' => 'Text', 'name' => 'highlight_text', 'type' => 'text'],
                ],
            ],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 40,
    ]);

    // VM: Videos
    acf_add_local_field_group([
        'key'    => 'group_vm_videos',
        'title'  => 'Vedic Maths — Demo Videos',
        'fields' => [
            ['key' => 'field_vm_video_heading', 'label' => 'Section Heading',  'name' => 'vm_video_heading',    'type' => 'text',    'default_value' => 'Demo Videos / Student Videos'],
            ['key' => 'field_vm_video_sub',     'label' => 'Section Sub-text', 'name' => 'vm_video_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'          => 'field_vm_video_items',
                'label'        => 'Videos',
                'name'         => 'vm_video_items',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 6,
                'layout'       => 'block',
                'button_label' => 'Add Video',
                'sub_fields'   => [
                    ['key' => 'field_vm_video_title', 'label' => 'Video Title',          'name' => 'video_title', 'type' => 'text'],
                    ['key' => 'field_vm_video_url',   'label' => 'YouTube URL',          'name' => 'video_url',   'type' => 'url'],
                    ['key' => 'field_vm_video_thumb', 'label' => 'Thumbnail (fallback)', 'name' => 'video_thumb', 'type' => 'image', 'return_format' => 'array'],
                ],
            ],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 50,
    ]);

    // VM: CTA
    acf_add_local_field_group([
        'key'    => 'group_vm_cta',
        'title'  => 'Vedic Maths — CTA Banner',
        'fields' => [
            ['key' => 'field_vm_cta_heading',   'label' => 'CTA Heading',          'name' => 'vm_cta_heading',   'type' => 'text',    'default_value' => 'Give Your Child a Strong Maths Foundation Today'],
            ['key' => 'field_vm_cta_sub',       'label' => 'CTA Sub-text',         'name' => 'vm_cta_subtext',   'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_cta_btn_text',  'label' => 'Primary Button Text',  'name' => 'vm_cta_btn_text',  'type' => 'text',    'default_value' => 'Book Free Demo Class'],
            ['key' => 'field_vm_cta_btn_url',   'label' => 'Primary Button URL',   'name' => 'vm_cta_btn_url',   'type' => 'url'],
            ['key' => 'field_vm_cta_btn2_text', 'label' => 'Secondary Button Text','name' => 'vm_cta_btn2_text', 'type' => 'text',    'default_value' => 'Call Us Now'],
            ['key' => 'field_vm_cta_btn2_url',  'label' => 'Secondary Button URL', 'name' => 'vm_cta_btn2_url',  'type' => 'url'],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 60,
    ]);

    // VM: App Download
    acf_add_local_field_group([
        'key'    => 'group_vm_app',
        'title'  => 'Vedic Maths — App Download Section',
        'fields' => [
            ['key' => 'field_vm_app_heading',      'label' => 'Heading',              'name' => 'vm_app_heading',       'type' => 'text',    'default_value' => 'Learn Vedic Maths Anywhere, Anytime'],
            ['key' => 'field_vm_app_sub',          'label' => 'Sub-text',             'name' => 'vm_app_subtext',       'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_app_android_url',  'label' => 'Android / Play URL',   'name' => 'vm_app_android_url',   'type' => 'url'],
            ['key' => 'field_vm_app_android_lbl',  'label' => 'Android Button Label', 'name' => 'vm_app_android_label', 'type' => 'text',    'default_value' => 'Google Play'],
            ['key' => 'field_vm_app_ios_url',      'label' => 'iOS / Web Portal URL', 'name' => 'vm_app_ios_url',       'type' => 'url'],
            ['key' => 'field_vm_app_ios_lbl',      'label' => 'iOS Button Label',     'name' => 'vm_app_ios_label',     'type' => 'text',    'default_value' => 'Web Portal'],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 70,
    ]);

    // Footer settings are managed via WP Admin → Theme Settings (native page).

    // ── About Us Page ──────────────────────────────────────────────────────────
    $about_page_location = [[[
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-about.php',
    ]]];

    // About: Hero Banner
    acf_add_local_field_group([
        'key'    => 'group_about_hero',
        'title'  => 'About Us — Hero Banner',
        'fields' => [
            ['key' => 'field_about_hero_badge',      'label' => 'Badge Text',          'name' => 'about_hero_badge',       'type' => 'text',    'default_value' => 'About SkillUp Juniors'],
            ['key' => 'field_about_hero_heading',    'label' => 'Heading (HTML ok)',   'name' => 'about_hero_heading',     'type' => 'text',    'default_value' => 'Because Every Child Deserves <span>the Right Start</span>'],
            ['key' => 'field_about_hero_subheading', 'label' => 'Sub-heading',         'name' => 'about_hero_subheading',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_about_hero_cta1_text',  'label' => 'Primary CTA Text',    'name' => 'about_hero_cta1_text',   'type' => 'text',    'default_value' => 'Book Free Demo'],
            ['key' => 'field_about_hero_cta1_url',   'label' => 'Primary CTA URL',     'name' => 'about_hero_cta1_url',    'type' => 'url'],
            ['key' => 'field_about_hero_cta2_text',  'label' => 'Secondary CTA Text',  'name' => 'about_hero_cta2_text',   'type' => 'text',    'default_value' => 'Our Approach'],
            ['key' => 'field_about_hero_cta2_url',   'label' => 'Secondary CTA URL',   'name' => 'about_hero_cta2_url',    'type' => 'url'],
            ['key' => 'field_about_hero_image',      'label' => 'Hero Image',          'name' => 'about_hero_image',       'type' => 'image',   'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_about_hero_stat1_num',  'label' => 'Float Badge 1 — Number', 'name' => 'about_hero_stat1_num',  'type' => 'text',  'default_value' => '10,000+'],
            ['key' => 'field_about_hero_stat1_lbl',  'label' => 'Float Badge 1 — Label',  'name' => 'about_hero_stat1_label','type' => 'text',  'default_value' => 'Students'],
            ['key' => 'field_about_hero_stat2_num',  'label' => 'Float Badge 2 — Number', 'name' => 'about_hero_stat2_num',  'type' => 'text',  'default_value' => '4.9'],
            ['key' => 'field_about_hero_stat2_lbl',  'label' => 'Float Badge 2 — Label',  'name' => 'about_hero_stat2_label','type' => 'text',  'default_value' => 'Rating'],
        ],
        'location'   => $about_page_location,
        'menu_order' => 10,
    ]);

    // About: Vision & Mission
    acf_add_local_field_group([
        'key'    => 'group_about_vm',
        'title'  => 'About Us — Vision & Mission',
        'fields' => [
            ['key' => 'field_about_vision_title', 'label' => 'Vision Card Title', 'name' => 'about_vision_title', 'type' => 'text',     'default_value' => 'Vision'],
            ['key' => 'field_about_vision_text',  'label' => 'Vision Text',       'name' => 'about_vision_text',  'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_about_mission_title','label' => 'Mission Card Title', 'name' => 'about_mission_title','type' => 'text',     'default_value' => 'Mission'],
            ['key' => 'field_about_mission_text', 'label' => 'Mission Text',      'name' => 'about_mission_text', 'type' => 'textarea', 'rows' => 4],
        ],
        'location'   => $about_page_location,
        'menu_order' => 20,
    ]);

    // About: Founder Quote
    acf_add_local_field_group([
        'key'    => 'group_about_founder',
        'title'  => 'About Us — Founder Quote & Bio',
        'fields' => [
            ['key' => 'field_about_founder_quote', 'label' => 'Quote',        'name' => 'about_founder_quote', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_about_founder_name',  'label' => 'Founder Name', 'name' => 'about_founder_name',  'type' => 'text',     'default_value' => 'Dr. Prakash Bhaliya'],
            ['key' => 'field_about_founder_role',  'label' => 'Founder Role', 'name' => 'about_founder_role',  'type' => 'text',     'default_value' => 'Founder of SkillUp Juniors'],
            ['key' => 'field_about_founder_bio',   'label' => 'Bio / About',  'name' => 'about_founder_bio',   'type' => 'textarea', 'rows' => 6],
            ['key' => 'field_about_founder_image', 'label' => 'Founder Photo','name' => 'about_founder_image', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ],
        'location'   => $about_page_location,
        'menu_order' => 30,
    ]);

    // About: Teaching Approach
    acf_add_local_field_group([
        'key'    => 'group_about_approach',
        'title'  => 'About Us — Teaching Approach',
        'fields' => [
            ['key' => 'field_about_approach_heading', 'label' => 'Section Heading',  'name' => 'about_approach_heading',    'type' => 'text',    'default_value' => 'Teaching Approach'],
            ['key' => 'field_about_approach_sub',     'label' => 'Section Sub-text', 'name' => 'about_approach_subheading', 'type' => 'textarea','rows' => 2],
            [
                'key'          => 'field_about_approach_items',
                'label'        => 'Approach Cards',
                'name'         => 'about_approach_items',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 8,
                'layout'       => 'block',
                'button_label' => 'Add Card',
                'sub_fields'   => [
                    ['key' => 'field_about_approach_title', 'label' => 'Card Title',       'name' => 'approach_title',       'type' => 'text'],
                    ['key' => 'field_about_approach_desc',  'label' => 'Card Description', 'name' => 'approach_description', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_about_approach_icon',  'label' => 'Custom Icon (opt.)','name' => 'approach_icon',       'type' => 'image',    'return_format' => 'array'],
                    [
                        'key'           => 'field_about_approach_color',
                        'label'         => 'Icon Color',
                        'name'          => 'approach_color',
                        'type'          => 'select',
                        'choices'       => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal'],
                        'default_value' => 'blue',
                    ],
                ],
            ],
        ],
        'location'   => $about_page_location,
        'menu_order' => 40,
    ]);

    // About: App Download
    acf_add_local_field_group([
        'key'    => 'group_about_app',
        'title'  => 'About Us — App Download Section',
        'fields' => [
            ['key' => 'field_about_app_heading',      'label' => 'Heading',              'name' => 'about_app_heading',       'type' => 'text',    'default_value' => 'Start Learning Anywhere, Anytime'],
            ['key' => 'field_about_app_subtext',      'label' => 'Sub-text',             'name' => 'about_app_subtext',       'type' => 'textarea','rows' => 2],
            ['key' => 'field_about_app_android_url',  'label' => 'Android / Play URL',   'name' => 'about_app_android_url',   'type' => 'url'],
            ['key' => 'field_about_app_android_label','label' => 'Android Button Label', 'name' => 'about_app_android_label', 'type' => 'text',    'default_value' => 'Google Play'],
            ['key' => 'field_about_app_ios_url',      'label' => 'iOS / Web Portal URL', 'name' => 'about_app_ios_url',       'type' => 'url'],
            ['key' => 'field_about_app_ios_label',    'label' => 'iOS Button Label',     'name' => 'about_app_ios_label',     'type' => 'text',    'default_value' => 'Web Portal'],
        ],
        'location'   => $about_page_location,
        'menu_order' => 50,
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

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

    // VM: Hero Banner
    acf_add_local_field_group([
        'key'    => 'group_vm_hero',
        'title'  => 'Vedic Maths — Hero Banner',
        'fields' => [
            ['key' => 'field_vm_hero_badge',     'label' => 'Badge Text',          'name' => 'vm_hero_badge',      'type' => 'text',    'default_value' => "India's #1 Vedic Maths Program for Kids"],
            ['key' => 'field_vm_hero_heading',   'label' => 'Heading (HTML ok)',   'name' => 'vm_hero_heading',    'type' => 'text',    'default_value' => 'Faster Calculations.<br><span>Sharper Mind.</span><br>Confident Child.'],
            ['key' => 'field_vm_hero_sub',       'label' => 'Sub-heading',         'name' => 'vm_hero_subheading', 'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_hero_cta1_text', 'label' => 'Primary CTA Text',   'name' => 'vm_hero_cta1_text',  'type' => 'text',    'default_value' => 'Book Free Demo'],
            ['key' => 'field_vm_hero_cta1_url',  'label' => 'Primary CTA URL',    'name' => 'vm_hero_cta1_url',   'type' => 'url'],
            ['key' => 'field_vm_hero_cta2_text', 'label' => 'Secondary CTA Text', 'name' => 'vm_hero_cta2_text',  'type' => 'text',    'default_value' => 'View Curriculum'],
            ['key' => 'field_vm_hero_cta2_url',  'label' => 'Secondary CTA URL',  'name' => 'vm_hero_cta2_url',   'type' => 'url'],
            ['key' => 'field_vm_hero_image',     'label' => 'Hero Image',          'name' => 'vm_hero_image',      'type' => 'image',   'return_format' => 'array', 'preview_size' => 'medium'],
            // Stats
            ['key' => 'field_vm_stat1_num',  'label' => 'Stat 1 — Number', 'name' => 'vm_stat1_num',   'type' => 'text', 'default_value' => '10K+'],
            ['key' => 'field_vm_stat1_lbl',  'label' => 'Stat 1 — Label',  'name' => 'vm_stat1_label', 'type' => 'text', 'default_value' => 'Students Trained'],
            ['key' => 'field_vm_stat2_num',  'label' => 'Stat 2 — Number', 'name' => 'vm_stat2_num',   'type' => 'text', 'default_value' => '98%'],
            ['key' => 'field_vm_stat2_lbl',  'label' => 'Stat 2 — Label',  'name' => 'vm_stat2_label', 'type' => 'text', 'default_value' => 'Score Improvement'],
            ['key' => 'field_vm_stat3_num',  'label' => 'Stat 3 — Number', 'name' => 'vm_stat3_num',   'type' => 'text', 'default_value' => '3x'],
            ['key' => 'field_vm_stat3_lbl',  'label' => 'Stat 3 — Label',  'name' => 'vm_stat3_label', 'type' => 'text', 'default_value' => 'Faster Calculation'],
            // Join Steps (3 individual fields — no repeater)
            ['key' => 'field_vm_step1', 'label' => 'Join Step 1', 'name' => 'vm_step1_text', 'type' => 'text', 'default_value' => "Choose your child's grade & batch"],
            ['key' => 'field_vm_step2', 'label' => 'Join Step 2', 'name' => 'vm_step2_text', 'type' => 'text', 'default_value' => 'Attend a Free Trial Class'],
            ['key' => 'field_vm_step3', 'label' => 'Join Step 3', 'name' => 'vm_step3_text', 'type' => 'text', 'default_value' => 'Enroll & start learning!'],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 10,
    ]);

    // VM: Curriculum (3 fixed cards — no repeater)
    acf_add_local_field_group([
        'key'    => 'group_vm_curriculum',
        'title'  => 'Vedic Maths — Curriculum',
        'fields' => [
            ['key' => 'field_vm_curr_heading', 'label' => 'Section Heading',  'name' => 'vm_curriculum_heading',    'type' => 'text',    'default_value' => 'Our Curriculum'],
            ['key' => 'field_vm_curr_sub',     'label' => 'Section Sub-text', 'name' => 'vm_curriculum_subheading', 'type' => 'textarea','rows' => 2],
            // Card 1
            ['key' => 'field_vm_curr1_grade',    'label' => 'Card 1 — Grade',              'name' => 'vm_curr1_grade',    'type' => 'text',    'default_value' => 'Class 3 – 4'],
            ['key' => 'field_vm_curr1_subtitle', 'label' => 'Card 1 — Sub-title',          'name' => 'vm_curr1_subtitle', 'type' => 'text',    'default_value' => 'Building the Foundation'],
            ['key' => 'field_vm_curr1_topics',   'label' => 'Card 1 — Topics (one/line)',  'name' => 'vm_curr1_topics',   'type' => 'textarea','rows' => 6, 'default_value' => "Addition & Subtraction tricks\nMultiplication basics (tables 1–20)\nNumber sense & place value\nMental maths warm-ups\nFun pattern recognition"],
            ['key' => 'field_vm_curr1_pdf',      'label' => 'Card 1 — Curriculum PDF',     'name' => 'vm_curr1_pdf',      'type' => 'file',    'return_format' => 'array'],
            ['key' => 'field_vm_curr1_color',    'label' => 'Card 1 — Accent Colour',      'name' => 'vm_curr1_color',    'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'blue'],
            // Card 2
            ['key' => 'field_vm_curr2_grade',    'label' => 'Card 2 — Grade',              'name' => 'vm_curr2_grade',    'type' => 'text',    'default_value' => 'Class 5 – 6'],
            ['key' => 'field_vm_curr2_subtitle', 'label' => 'Card 2 — Sub-title',          'name' => 'vm_curr2_subtitle', 'type' => 'text',    'default_value' => 'Speed & Accuracy'],
            ['key' => 'field_vm_curr2_topics',   'label' => 'Card 2 — Topics (one/line)',  'name' => 'vm_curr2_topics',   'type' => 'textarea','rows' => 6, 'default_value' => "Duplex method for squares\nVertical & crosswise multiplication\nDivision by flag method\nFractions & decimals shortcuts\nWord problem strategies"],
            ['key' => 'field_vm_curr2_pdf',      'label' => 'Card 2 — Curriculum PDF',     'name' => 'vm_curr2_pdf',      'type' => 'file',    'return_format' => 'array'],
            ['key' => 'field_vm_curr2_color',    'label' => 'Card 2 — Accent Colour',      'name' => 'vm_curr2_color',    'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'green'],
            // Card 3
            ['key' => 'field_vm_curr3_grade',    'label' => 'Card 3 — Grade',              'name' => 'vm_curr3_grade',    'type' => 'text',    'default_value' => 'Class 7 – 8'],
            ['key' => 'field_vm_curr3_subtitle', 'label' => 'Card 3 — Sub-title',          'name' => 'vm_curr3_subtitle', 'type' => 'text',    'default_value' => 'Advanced Techniques'],
            ['key' => 'field_vm_curr3_topics',   'label' => 'Card 3 — Topics (one/line)',  'name' => 'vm_curr3_topics',   'type' => 'textarea','rows' => 6, 'default_value' => "Algebraic operations (Vedic way)\nCube roots & square roots\nHigh-speed division\nCompetitive exam tricks\nSelf-checking techniques"],
            ['key' => 'field_vm_curr3_pdf',      'label' => 'Card 3 — Curriculum PDF',     'name' => 'vm_curr3_pdf',      'type' => 'file',    'return_format' => 'array'],
            ['key' => 'field_vm_curr3_color',    'label' => 'Card 3 — Accent Colour',      'name' => 'vm_curr3_color',    'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'yellow'],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 20,
    ]);

    // VM: Learning Approach (6 fixed cards — no repeater)
    acf_add_local_field_group([
        'key'    => 'group_vm_approach',
        'title'  => 'Vedic Maths — Learning Approach',
        'fields' => [
            ['key' => 'field_vm_approach_heading', 'label' => 'Section Heading',  'name' => 'vm_approach_heading',    'type' => 'text',    'default_value' => 'Learning Approach'],
            ['key' => 'field_vm_approach_sub',     'label' => 'Section Sub-text', 'name' => 'vm_approach_subheading', 'type' => 'textarea','rows' => 2],
            // Card 1
            ['key' => 'field_vm_ap1_title', 'label' => 'Card 1 — Title',       'name' => 'vm_approach1_title', 'type' => 'text',   'default_value' => 'Fun & Engaging Learning'],
            ['key' => 'field_vm_ap1_desc',  'label' => 'Card 1 — Description', 'name' => 'vm_approach1_desc',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_ap1_icon',  'label' => 'Card 1 — Icon Image',  'name' => 'vm_approach1_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_vm_ap1_color', 'label' => 'Card 1 — Icon Color',  'name' => 'vm_approach1_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal','navy'=>'Navy'], 'default_value' => 'blue'],
            // Card 2
            ['key' => 'field_vm_ap2_title', 'label' => 'Card 2 — Title',       'name' => 'vm_approach2_title', 'type' => 'text',   'default_value' => 'Interactive Live Sessions'],
            ['key' => 'field_vm_ap2_desc',  'label' => 'Card 2 — Description', 'name' => 'vm_approach2_desc',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_ap2_icon',  'label' => 'Card 2 — Icon Image',  'name' => 'vm_approach2_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_vm_ap2_color', 'label' => 'Card 2 — Icon Color',  'name' => 'vm_approach2_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal','navy'=>'Navy'], 'default_value' => 'green'],
            // Card 3
            ['key' => 'field_vm_ap3_title', 'label' => 'Card 3 — Title',       'name' => 'vm_approach3_title', 'type' => 'text',   'default_value' => 'Regular Work Sheets'],
            ['key' => 'field_vm_ap3_desc',  'label' => 'Card 3 — Description', 'name' => 'vm_approach3_desc',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_ap3_icon',  'label' => 'Card 3 — Icon Image',  'name' => 'vm_approach3_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_vm_ap3_color', 'label' => 'Card 3 — Icon Color',  'name' => 'vm_approach3_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal','navy'=>'Navy'], 'default_value' => 'yellow'],
            // Card 4
            ['key' => 'field_vm_ap4_title', 'label' => 'Card 4 — Title',       'name' => 'vm_approach4_title', 'type' => 'text',   'default_value' => 'Personal Attention'],
            ['key' => 'field_vm_ap4_desc',  'label' => 'Card 4 — Description', 'name' => 'vm_approach4_desc',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_ap4_icon',  'label' => 'Card 4 — Icon Image',  'name' => 'vm_approach4_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_vm_ap4_color', 'label' => 'Card 4 — Icon Color',  'name' => 'vm_approach4_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal','navy'=>'Navy'], 'default_value' => 'teal'],
            // Card 5
            ['key' => 'field_vm_ap5_title', 'label' => 'Card 5 — Title',       'name' => 'vm_approach5_title', 'type' => 'text',   'default_value' => 'Practice with Fun Challenges'],
            ['key' => 'field_vm_ap5_desc',  'label' => 'Card 5 — Description', 'name' => 'vm_approach5_desc',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_ap5_icon',  'label' => 'Card 5 — Icon Image',  'name' => 'vm_approach5_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_vm_ap5_color', 'label' => 'Card 5 — Icon Color',  'name' => 'vm_approach5_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal','navy'=>'Navy'], 'default_value' => 'navy'],
            // Card 6
            ['key' => 'field_vm_ap6_title', 'label' => 'Card 6 — Title',       'name' => 'vm_approach6_title', 'type' => 'text',   'default_value' => 'Step-by-Step Concept Clarity'],
            ['key' => 'field_vm_ap6_desc',  'label' => 'Card 6 — Description', 'name' => 'vm_approach6_desc',  'type' => 'textarea','rows' => 2],
            ['key' => 'field_vm_ap6_icon',  'label' => 'Card 6 — Icon Image',  'name' => 'vm_approach6_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_vm_ap6_color', 'label' => 'Card 6 — Icon Color',  'name' => 'vm_approach6_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal','navy'=>'Navy'], 'default_value' => 'blue'],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 30,
    ]);

    // VM: Foundation (3 highlight pills — no repeater)
    acf_add_local_field_group([
        'key'    => 'group_vm_foundation',
        'title'  => 'Vedic Maths — Foundation Section',
        'fields' => [
            ['key' => 'field_vm_found_heading',  'label' => 'Heading (HTML ok)', 'name' => 'vm_foundation_heading',  'type' => 'text',     'default_value' => 'We Fix the Root Problem — Foundation'],
            ['key' => 'field_vm_found_text',     'label' => 'Body Text',         'name' => 'vm_foundation_text',     'type' => 'textarea', 'rows' => 5],
            ['key' => 'field_vm_highlight1',     'label' => 'Highlight Pill 1',  'name' => 'vm_highlight1_text',     'type' => 'text',     'default_value' => 'Think Fast'],
            ['key' => 'field_vm_highlight2',     'label' => 'Highlight Pill 2',  'name' => 'vm_highlight2_text',     'type' => 'text',     'default_value' => 'Calculate Smart'],
            ['key' => 'field_vm_highlight3',     'label' => 'Highlight Pill 3',  'name' => 'vm_highlight3_text',     'type' => 'text',     'default_value' => 'Feel Confident'],
        ],
        'location'   => $vm_page_location,
        'menu_order' => 40,
    ]);

    // VM: Demo Videos (4 fixed video slots — no repeater)
    acf_add_local_field_group([
        'key'    => 'group_vm_videos',
        'title'  => 'Vedic Maths — Demo Videos',
        'fields' => [
            ['key' => 'field_vm_video_heading', 'label' => 'Section Heading',  'name' => 'vm_video_heading',    'type' => 'text',    'default_value' => 'Demo Videos / Student Videos'],
            ['key' => 'field_vm_video_sub',     'label' => 'Section Sub-text', 'name' => 'vm_video_subheading', 'type' => 'textarea','rows' => 2],
            // Video 1
            ['key' => 'field_vm_vid1_title', 'label' => 'Video 1 — Title',              'name' => 'vm_video1_title', 'type' => 'text'],
            ['key' => 'field_vm_vid1_url',   'label' => 'Video 1 — YouTube URL',        'name' => 'vm_video1_url',   'type' => 'url'],
            ['key' => 'field_vm_vid1_thumb', 'label' => 'Video 1 — Thumbnail (opt.)',   'name' => 'vm_video1_thumb', 'type' => 'image', 'return_format' => 'array'],
            // Video 2
            ['key' => 'field_vm_vid2_title', 'label' => 'Video 2 — Title',              'name' => 'vm_video2_title', 'type' => 'text'],
            ['key' => 'field_vm_vid2_url',   'label' => 'Video 2 — YouTube URL',        'name' => 'vm_video2_url',   'type' => 'url'],
            ['key' => 'field_vm_vid2_thumb', 'label' => 'Video 2 — Thumbnail (opt.)',   'name' => 'vm_video2_thumb', 'type' => 'image', 'return_format' => 'array'],
            // Video 3
            ['key' => 'field_vm_vid3_title', 'label' => 'Video 3 — Title',              'name' => 'vm_video3_title', 'type' => 'text'],
            ['key' => 'field_vm_vid3_url',   'label' => 'Video 3 — YouTube URL',        'name' => 'vm_video3_url',   'type' => 'url'],
            ['key' => 'field_vm_vid3_thumb', 'label' => 'Video 3 — Thumbnail (opt.)',   'name' => 'vm_video3_thumb', 'type' => 'image', 'return_format' => 'array'],
            // Video 4
            ['key' => 'field_vm_vid4_title', 'label' => 'Video 4 — Title',              'name' => 'vm_video4_title', 'type' => 'text'],
            ['key' => 'field_vm_vid4_url',   'label' => 'Video 4 — YouTube URL',        'name' => 'vm_video4_url',   'type' => 'url'],
            ['key' => 'field_vm_vid4_thumb', 'label' => 'Video 4 — Thumbnail (opt.)',   'name' => 'vm_video4_thumb', 'type' => 'image', 'return_format' => 'array'],
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

    // ── Contact Us Page ────────────────────────────────────────────────────────
    $ct_page_location = [[[
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-contact.php',
    ]]];

    // Contact: Hero
    acf_add_local_field_group([
        'key'    => 'group_ct_hero',
        'title'  => 'Contact — Hero',
        'fields' => [
            ['key' => 'field_ct_hero_heading', 'label' => 'Page Heading (HTML ok)', 'name' => 'contact_hero_heading', 'type' => 'text',    'default_value' => 'Get in Touch <span>With Us</span>'],
            ['key' => 'field_ct_hero_sub',     'label' => 'Sub-text',               'name' => 'contact_hero_sub',     'type' => 'textarea','rows' => 2],
        ],
        'location'   => $ct_page_location,
        'menu_order' => 10,
    ]);

    // Contact: Form Labels
    acf_add_local_field_group([
        'key'    => 'group_ct_form',
        'title'  => 'Contact — Form Heading',
        'fields' => [
            ['key' => 'field_ct_form_heading', 'label' => 'Form Heading (HTML ok)', 'name' => 'contact_form_heading', 'type' => 'text',    'default_value' => 'Book a <span>Free Demo Class</span> Today!'],
            ['key' => 'field_ct_form_sub',     'label' => 'Form Sub-text',          'name' => 'contact_form_sub',     'type' => 'textarea','rows' => 2],
        ],
        'location'   => $ct_page_location,
        'menu_order' => 20,
    ]);

    // Contact: Map & Details
    acf_add_local_field_group([
        'key'    => 'group_ct_details',
        'title'  => 'Contact — Map & Details',
        'fields' => [
            ['key' => 'field_ct_phone',    'label' => 'Phone Number',           'name' => 'contact_phone',    'type' => 'text', 'default_value' => '+91 00000 00000'],
            ['key' => 'field_ct_whatsapp', 'label' => 'WhatsApp Number',        'name' => 'contact_whatsapp', 'type' => 'text', 'default_value' => '+91 00000 00000'],
            ['key' => 'field_ct_email',    'label' => 'Email Address',          'name' => 'contact_email',    'type' => 'text', 'default_value' => 'hello@skillupjuniors.com'],
            ['key' => 'field_ct_address',  'label' => 'Office Address',         'name' => 'contact_address',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ct_hours',    'label' => 'Working Hours',          'name' => 'contact_hours',    'type' => 'text', 'default_value' => 'Mon – Sat: 9:00 AM – 7:00 PM'],
            ['key' => 'field_ct_map_url',  'label' => 'Google Maps Embed URL', 'name' => 'contact_map_url',  'type' => 'url'],
        ],
        'location'   => $ct_page_location,
        'menu_order' => 30,
    ]);

    // Contact: Social Links
    acf_add_local_field_group([
        'key'    => 'group_ct_social',
        'title'  => 'Contact — Social Media Links',
        'fields' => [
            ['key' => 'field_ct_facebook',  'label' => 'Facebook URL',  'name' => 'contact_facebook_url',  'type' => 'url'],
            ['key' => 'field_ct_instagram', 'label' => 'Instagram URL', 'name' => 'contact_instagram_url', 'type' => 'url'],
            ['key' => 'field_ct_youtube',   'label' => 'YouTube URL',   'name' => 'contact_youtube_url',   'type' => 'url'],
            ['key' => 'field_ct_twitter',   'label' => 'Twitter/X URL', 'name' => 'contact_twitter_url',   'type' => 'url'],
        ],
        'location'   => $ct_page_location,
        'menu_order' => 40,
    ]);

    // Contact: Why Reasons (3 fixed)
    acf_add_local_field_group([
        'key'    => 'group_ct_reasons',
        'title'  => 'Contact — Why Contact Us (3 Points)',
        'fields' => [
            ['key' => 'field_ct_reason1', 'label' => 'Reason 1', 'name' => 'contact_reason1_text', 'type' => 'text', 'default_value' => 'Free demo — no commitment needed'],
            ['key' => 'field_ct_reason2', 'label' => 'Reason 2', 'name' => 'contact_reason2_text', 'type' => 'text', 'default_value' => 'Response within 24 hours guaranteed'],
            ['key' => 'field_ct_reason3', 'label' => 'Reason 3', 'name' => 'contact_reason3_text', 'type' => 'text', 'default_value' => "Expert guidance for your child's learning"],
        ],
        'location'   => $ct_page_location,
        'menu_order' => 50,
    ]);

    // Contact: FAQ (4 fixed Q&A pairs)
    acf_add_local_field_group([
        'key'    => 'group_ct_faq',
        'title'  => 'Contact — FAQ (4 Questions)',
        'fields' => [
            ['key' => 'field_ct_faq1_q', 'label' => 'FAQ 1 — Question', 'name' => 'contact_faq1_q', 'type' => 'text',     'default_value' => 'Is the demo class really free?'],
            ['key' => 'field_ct_faq1_a', 'label' => 'FAQ 1 — Answer',   'name' => 'contact_faq1_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Yes! Our demo class is 100% free with zero commitment. You can decide after experiencing the class.'],
            ['key' => 'field_ct_faq2_q', 'label' => 'FAQ 2 — Question', 'name' => 'contact_faq2_q', 'type' => 'text',     'default_value' => 'Which age group is eligible?'],
            ['key' => 'field_ct_faq2_a', 'label' => 'FAQ 2 — Answer',   'name' => 'contact_faq2_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our programs are designed for children from Class 1 to Class 10 across all our courses.'],
            ['key' => 'field_ct_faq3_q', 'label' => 'FAQ 3 — Question', 'name' => 'contact_faq3_q', 'type' => 'text',     'default_value' => 'Are classes online or offline?'],
            ['key' => 'field_ct_faq3_a', 'label' => 'FAQ 3 — Answer',   'name' => 'contact_faq3_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'We offer both live online sessions and in-person classes depending on your location and preference.'],
            ['key' => 'field_ct_faq4_q', 'label' => 'FAQ 4 — Question', 'name' => 'contact_faq4_q', 'type' => 'text',     'default_value' => 'How soon will I hear back after filling the form?'],
            ['key' => 'field_ct_faq4_a', 'label' => 'FAQ 4 — Answer',   'name' => 'contact_faq4_a', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our team will contact you within 24 hours on your phone or email to schedule the demo.'],
        ],
        'location'   => $ct_page_location,
        'menu_order' => 60,
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

    // About: Teaching Approach (4 fixed cards — no repeater)
    acf_add_local_field_group([
        'key'    => 'group_about_approach',
        'title'  => 'About Us — Teaching Approach',
        'fields' => [
            ['key' => 'field_about_approach_heading', 'label' => 'Section Heading',  'name' => 'about_approach_heading',    'type' => 'text',    'default_value' => 'Teaching Approach'],
            ['key' => 'field_about_approach_sub',     'label' => 'Section Sub-text', 'name' => 'about_approach_subheading', 'type' => 'textarea','rows' => 2],
            // Card 1
            ['key' => 'field_ab_ap1_title', 'label' => 'Card 1 — Title',       'name' => 'about_approach1_title', 'type' => 'text',    'default_value' => 'Activity-Based Learning'],
            ['key' => 'field_ab_ap1_desc',  'label' => 'Card 1 — Description', 'name' => 'about_approach1_desc',  'type' => 'textarea','rows' => 2, 'default_value' => 'Hands-on activities that make concepts memorable and fun, turning learning into an adventure children love.'],
            ['key' => 'field_ab_ap1_icon',  'label' => 'Card 1 — Icon Image',  'name' => 'about_approach1_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_ab_ap1_color', 'label' => 'Card 1 — Icon Color',  'name' => 'about_approach1_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'blue'],
            // Card 2
            ['key' => 'field_ab_ap2_title', 'label' => 'Card 2 — Title',       'name' => 'about_approach2_title', 'type' => 'text',    'default_value' => 'Interactive Live Sessions'],
            ['key' => 'field_ab_ap2_desc',  'label' => 'Card 2 — Description', 'name' => 'about_approach2_desc',  'type' => 'textarea','rows' => 2, 'default_value' => 'Real-time engagement with expert trainers to ensure every child stays curious, focused, and motivated.'],
            ['key' => 'field_ab_ap2_icon',  'label' => 'Card 2 — Icon Image',  'name' => 'about_approach2_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_ab_ap2_color', 'label' => 'Card 2 — Icon Color',  'name' => 'about_approach2_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'green'],
            // Card 3
            ['key' => 'field_ab_ap3_title', 'label' => 'Card 3 — Title',       'name' => 'about_approach3_title', 'type' => 'text',    'default_value' => 'Personal Attention'],
            ['key' => 'field_ab_ap3_desc',  'label' => 'Card 3 — Description', 'name' => 'about_approach3_desc',  'type' => 'textarea','rows' => 2, 'default_value' => 'Small batch sizes and one-on-one support ensure every child gets the attention they deserve to thrive.'],
            ['key' => 'field_ab_ap3_icon',  'label' => 'Card 3 — Icon Image',  'name' => 'about_approach3_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_ab_ap3_color', 'label' => 'Card 3 — Icon Color',  'name' => 'about_approach3_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'yellow'],
            // Card 4
            ['key' => 'field_ab_ap4_title', 'label' => 'Card 4 — Title',       'name' => 'about_approach4_title', 'type' => 'text',    'default_value' => 'Result-Oriented Approach'],
            ['key' => 'field_ab_ap4_desc',  'label' => 'Card 4 — Description', 'name' => 'about_approach4_desc',  'type' => 'textarea','rows' => 2, 'default_value' => 'Structured curriculum with regular assessments and progress tracking for measurable growth every step of the way.'],
            ['key' => 'field_ab_ap4_icon',  'label' => 'Card 4 — Icon Image',  'name' => 'about_approach4_icon',  'type' => 'image',   'return_format' => 'array'],
            ['key' => 'field_ab_ap4_color', 'label' => 'Card 4 — Icon Color',  'name' => 'about_approach4_color', 'type' => 'select',  'choices' => ['blue'=>'Blue','green'=>'Green','yellow'=>'Yellow','teal'=>'Teal'], 'default_value' => 'teal'],
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

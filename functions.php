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
        home_url('/junior-news-express') => 'Junior News Express',
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
        home_url('/junior-news-express') => 'Junior News Express',
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

    // ── Home: Courses (4 fixed cards — no repeater) ───────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_courses',
        'title'  => 'Home — Courses Section',
        'fields' => [
            ['key' => 'field_home_courses_heading', 'label' => 'Section Heading',  'name' => 'home_courses_heading',    'type' => 'text',    'default_value' => 'Our Programs'],
            ['key' => 'field_home_courses_sub',     'label' => 'Section Sub-text', 'name' => 'home_courses_subheading', 'type' => 'textarea','rows' => 2],
            // Course 1
            ['key' => 'field_home_c1_title', 'label' => 'Course 1 — Title',       'name' => 'home_c1_title', 'type' => 'text',    'default_value' => 'Skill Development Program'],
            ['key' => 'field_home_c1_desc',  'label' => 'Course 1 — Description', 'name' => 'home_c1_desc',  'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_c1_link',  'label' => 'Course 1 — Page URL',    'name' => 'home_c1_link',  'type' => 'url'],
            ['key' => 'field_home_c1_color', 'label' => 'Course 1 — Colour',      'name' => 'home_c1_color', 'type' => 'select',  'choices' => ['green' => 'Green', 'blue' => 'Blue', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'green'],
            ['key' => 'field_home_c1_icon',  'label' => 'Course 1 — Icon',        'name' => 'home_c1_icon',  'type' => 'image',   'return_format' => 'array'],
            // Course 2
            ['key' => 'field_home_c2_title', 'label' => 'Course 2 — Title',       'name' => 'home_c2_title', 'type' => 'text',    'default_value' => 'Vedic Maths Program'],
            ['key' => 'field_home_c2_desc',  'label' => 'Course 2 — Description', 'name' => 'home_c2_desc',  'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_c2_link',  'label' => 'Course 2 — Page URL',    'name' => 'home_c2_link',  'type' => 'url'],
            ['key' => 'field_home_c2_color', 'label' => 'Course 2 — Colour',      'name' => 'home_c2_color', 'type' => 'select',  'choices' => ['green' => 'Green', 'blue' => 'Blue', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'blue'],
            ['key' => 'field_home_c2_icon',  'label' => 'Course 2 — Icon',        'name' => 'home_c2_icon',  'type' => 'image',   'return_format' => 'array'],
            // Course 3
            ['key' => 'field_home_c3_title', 'label' => 'Course 3 — Title',       'name' => 'home_c3_title', 'type' => 'text',    'default_value' => 'Phonics + Maths Program'],
            ['key' => 'field_home_c3_desc',  'label' => 'Course 3 — Description', 'name' => 'home_c3_desc',  'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_c3_link',  'label' => 'Course 3 — Page URL',    'name' => 'home_c3_link',  'type' => 'url'],
            ['key' => 'field_home_c3_color', 'label' => 'Course 3 — Colour',      'name' => 'home_c3_color', 'type' => 'select',  'choices' => ['green' => 'Green', 'blue' => 'Blue', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'yellow'],
            ['key' => 'field_home_c3_icon',  'label' => 'Course 3 — Icon',        'name' => 'home_c3_icon',  'type' => 'image',   'return_format' => 'array'],
            // Course 4
            ['key' => 'field_home_c4_title', 'label' => 'Course 4 — Title',       'name' => 'home_c4_title', 'type' => 'text',    'default_value' => 'Junior News Express'],
            ['key' => 'field_home_c4_desc',  'label' => 'Course 4 — Description', 'name' => 'home_c4_desc',  'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_c4_link',  'label' => 'Course 4 — Page URL',    'name' => 'home_c4_link',  'type' => 'url'],
            ['key' => 'field_home_c4_color', 'label' => 'Course 4 — Colour',      'name' => 'home_c4_color', 'type' => 'select',  'choices' => ['green' => 'Green', 'blue' => 'Blue', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'teal'],
            ['key' => 'field_home_c4_icon',  'label' => 'Course 4 — Icon',        'name' => 'home_c4_icon',  'type' => 'image',   'return_format' => 'array'],
        ],
        'location' => $front_page_location,
        'menu_order' => 40,
    ]);

    // ── Home: Learning Approach (6 fixed items — no repeater) ────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_approach',
        'title'  => 'Home — Learning Approach Section',
        'fields' => [
            ['key' => 'field_home_approach_heading', 'label' => 'Section Heading',  'name' => 'home_approach_heading',    'type' => 'text',    'default_value' => 'Our Learning Approach'],
            ['key' => 'field_home_approach_sub',     'label' => 'Section Sub-text', 'name' => 'home_approach_subheading', 'type' => 'textarea','rows' => 2],
            // Item 1
            ['key' => 'field_home_ap1_title', 'label' => 'Item 1 — Title', 'name' => 'home_ap1_title', 'type' => 'text',  'default_value' => 'Fun & Engaging Learning'],
            ['key' => 'field_home_ap1_icon',  'label' => 'Item 1 — Icon',  'name' => 'home_ap1_icon',  'type' => 'image', 'return_format' => 'array'],
            // Item 2
            ['key' => 'field_home_ap2_title', 'label' => 'Item 2 — Title', 'name' => 'home_ap2_title', 'type' => 'text',  'default_value' => 'Interactive Live Sessions'],
            ['key' => 'field_home_ap2_icon',  'label' => 'Item 2 — Icon',  'name' => 'home_ap2_icon',  'type' => 'image', 'return_format' => 'array'],
            // Item 3
            ['key' => 'field_home_ap3_title', 'label' => 'Item 3 — Title', 'name' => 'home_ap3_title', 'type' => 'text',  'default_value' => 'Regular Work Sheets'],
            ['key' => 'field_home_ap3_icon',  'label' => 'Item 3 — Icon',  'name' => 'home_ap3_icon',  'type' => 'image', 'return_format' => 'array'],
            // Item 4
            ['key' => 'field_home_ap4_title', 'label' => 'Item 4 — Title', 'name' => 'home_ap4_title', 'type' => 'text',  'default_value' => 'Personal Attention'],
            ['key' => 'field_home_ap4_icon',  'label' => 'Item 4 — Icon',  'name' => 'home_ap4_icon',  'type' => 'image', 'return_format' => 'array'],
            // Item 5
            ['key' => 'field_home_ap5_title', 'label' => 'Item 5 — Title', 'name' => 'home_ap5_title', 'type' => 'text',  'default_value' => 'Practice with Fun Challenges'],
            ['key' => 'field_home_ap5_icon',  'label' => 'Item 5 — Icon',  'name' => 'home_ap5_icon',  'type' => 'image', 'return_format' => 'array'],
            // Item 6
            ['key' => 'field_home_ap6_title', 'label' => 'Item 6 — Title', 'name' => 'home_ap6_title', 'type' => 'text',  'default_value' => 'Step-by-Step Concept Clarity'],
            ['key' => 'field_home_ap6_icon',  'label' => 'Item 6 — Icon',  'name' => 'home_ap6_icon',  'type' => 'image', 'return_format' => 'array'],
        ],
        'location' => $front_page_location,
        'menu_order' => 50,
    ]);

    // ── Home: Testimonials (3 fixed — no repeater) ────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_home_testimonials',
        'title'  => 'Home — Testimonials (What Parents Say)',
        'fields' => [
            ['key' => 'field_home_testi_heading', 'label' => 'Section Heading',  'name' => 'home_testimonials_heading',    'type' => 'text',    'default_value' => 'What Parents Say'],
            ['key' => 'field_home_testi_sub',     'label' => 'Section Sub-text', 'name' => 'home_testimonials_subheading', 'type' => 'textarea','rows' => 2],
            // Testimonial 1
            ['key' => 'field_home_t1_name',    'label' => 'Testimonial 1 — Parent Name',  'name' => 'home_t1_name',    'type' => 'text',    'default_value' => 'Priya Sharma'],
            ['key' => 'field_home_t1_role',    'label' => 'Testimonial 1 — Role / Child', 'name' => 'home_t1_role',    'type' => 'text',    'default_value' => 'Parent of Arjun, Age 9'],
            ['key' => 'field_home_t1_content', 'label' => 'Testimonial 1 — Message',      'name' => 'home_t1_content', 'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_t1_rating',  'label' => 'Testimonial 1 — Rating (1-5)', 'name' => 'home_t1_rating',  'type' => 'number',  'min' => 1, 'max' => 5, 'default_value' => 5],
            ['key' => 'field_home_t1_image',   'label' => 'Testimonial 1 — Photo (opt.)', 'name' => 'home_t1_image',   'type' => 'image',   'return_format' => 'array'],
            // Testimonial 2
            ['key' => 'field_home_t2_name',    'label' => 'Testimonial 2 — Parent Name',  'name' => 'home_t2_name',    'type' => 'text',    'default_value' => 'Rahul Mehta'],
            ['key' => 'field_home_t2_role',    'label' => 'Testimonial 2 — Role / Child', 'name' => 'home_t2_role',    'type' => 'text',    'default_value' => 'Parent of Ananya, Age 7'],
            ['key' => 'field_home_t2_content', 'label' => 'Testimonial 2 — Message',      'name' => 'home_t2_content', 'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_t2_rating',  'label' => 'Testimonial 2 — Rating (1-5)', 'name' => 'home_t2_rating',  'type' => 'number',  'min' => 1, 'max' => 5, 'default_value' => 5],
            ['key' => 'field_home_t2_image',   'label' => 'Testimonial 2 — Photo (opt.)', 'name' => 'home_t2_image',   'type' => 'image',   'return_format' => 'array'],
            // Testimonial 3
            ['key' => 'field_home_t3_name',    'label' => 'Testimonial 3 — Parent Name',  'name' => 'home_t3_name',    'type' => 'text',    'default_value' => 'Sunita Reddy'],
            ['key' => 'field_home_t3_role',    'label' => 'Testimonial 3 — Role / Child', 'name' => 'home_t3_role',    'type' => 'text',    'default_value' => 'Parent of Karthik, Age 11'],
            ['key' => 'field_home_t3_content', 'label' => 'Testimonial 3 — Message',      'name' => 'home_t3_content', 'type' => 'textarea','rows' => 3],
            ['key' => 'field_home_t3_rating',  'label' => 'Testimonial 3 — Rating (1-5)', 'name' => 'home_t3_rating',  'type' => 'number',  'min' => 1, 'max' => 5, 'default_value' => 5],
            ['key' => 'field_home_t3_image',   'label' => 'Testimonial 3 — Photo (opt.)', 'name' => 'home_t3_image',   'type' => 'image',   'return_format' => 'array'],
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

    // ── Junior News Express Page ──────────────────────────────────────────────
    $jne_page_location = [[[
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-junior-news-express.php',
    ]]];

    // JNE: Hero
    acf_add_local_field_group([
        'key'    => 'group_jne_hero',
        'title'  => 'JNE — Hero',
        'fields' => [
            ['key' => 'field_jne_hero_badge',      'label' => 'Badge Text',          'name' => 'jne_hero_badge',      'type' => 'text',     'default_value' => 'Junior News Express'],
            ['key' => 'field_jne_hero_heading',    'label' => 'Heading (HTML ok)',   'name' => 'jne_hero_heading',    'type' => 'text',     'default_value' => 'Understanding Daily <span>Newspaper for Kids</span>'],
            ['key' => 'field_jne_hero_tagline',    'label' => 'Tagline',             'name' => 'jne_hero_tagline',    'type' => 'text',     'default_value' => 'Try Daily News, Also Daily Learning'],
            ['key' => 'field_jne_hero_sub',        'label' => 'Sub-heading',         'name' => 'jne_hero_subheading', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_jne_hero_detail1',    'label' => 'Detail 1 (class/age)','name' => 'jne_hero_detail1',   'type' => 'text',     'default_value' => 'Class 1–10 | Boys & Girls'],
            ['key' => 'field_jne_hero_detail2',    'label' => 'Detail 2 (frequency)','name' => 'jne_hero_detail2',   'type' => 'text',     'default_value' => '5 Days a Week'],
            ['key' => 'field_jne_hero_image',      'label' => 'Hero Image',          'name' => 'jne_hero_image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_jne_hero_cta1_text',  'label' => 'CTA 1 — Text',        'name' => 'jne_hero_cta1_text',  'type' => 'text',     'default_value' => 'Book Free Demo'],
            ['key' => 'field_jne_hero_cta1_url',   'label' => 'CTA 1 — URL',         'name' => 'jne_hero_cta1_url',   'type' => 'text',     'default_value' => '#jne-lead-form'],
            ['key' => 'field_jne_hero_cta2_text',  'label' => 'CTA 2 — Text',        'name' => 'jne_hero_cta2_text',  'type' => 'text',     'default_value' => 'Learn More'],
            ['key' => 'field_jne_hero_cta2_url',   'label' => 'CTA 2 — URL',         'name' => 'jne_hero_cta2_url',   'type' => 'text',     'default_value' => '#jne-intro'],
            ['key' => 'field_jne_step1_text',      'label' => 'Step 1 — Text',       'name' => 'jne_step1_text',      'type' => 'text',     'default_value' => 'Choose your child\'s grade'],
            ['key' => 'field_jne_step2_text',      'label' => 'Step 2 — Text',       'name' => 'jne_step2_text',      'type' => 'text',     'default_value' => 'Attend a Free Trial Session'],
            ['key' => 'field_jne_step3_text',      'label' => 'Step 3 — Text',       'name' => 'jne_step3_text',      'type' => 'text',     'default_value' => 'Enroll & start learning!'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 10,
    ]);

    // JNE: Lead Form
    acf_add_local_field_group([
        'key'    => 'group_jne_form',
        'title'  => 'JNE — Lead Form',
        'fields' => [
            ['key' => 'field_jne_form_heading', 'label' => 'Form Heading (HTML ok)', 'name' => 'jne_form_heading',    'type' => 'text',     'default_value' => 'Book a <span>Free Demo Session</span> Today!'],
            ['key' => 'field_jne_form_sub',     'label' => 'Form Sub-text',          'name' => 'jne_form_subheading', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_jne_form_perk1',   'label' => 'Perk 1',                 'name' => 'jne_form_perk1',      'type' => 'text',     'default_value' => '100% Free — No Commitment'],
            ['key' => 'field_jne_form_perk2',   'label' => 'Perk 2',                 'name' => 'jne_form_perk2',      'type' => 'text',     'default_value' => 'Live Online or In-Person'],
            ['key' => 'field_jne_form_perk3',   'label' => 'Perk 3',                 'name' => 'jne_form_perk3',      'type' => 'text',     'default_value' => 'Certified Expert Trainers'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 20,
    ]);

    // JNE: Introducing Section (4 benefit cards)
    acf_add_local_field_group([
        'key'    => 'group_jne_intro',
        'title'  => 'JNE — Introducing (4 Benefit Cards)',
        'fields' => [
            ['key' => 'field_jne_intro_heading', 'label' => 'Section Heading', 'name' => 'jne_intro_heading', 'type' => 'text',     'default_value' => 'Introducing Juniors News Express'],
            ['key' => 'field_jne_intro_sub',     'label' => 'Section Sub',     'name' => 'jne_intro_sub',     'type' => 'text',     'default_value' => 'A unique program where children learn to:'],
            ['key' => 'field_jne_intro_card1',   'label' => 'Card 1 — Text',   'name' => 'jne_intro_card1',   'type' => 'text',     'default_value' => 'Understand daily news in a simple way'],
            ['key' => 'field_jne_intro_card2',   'label' => 'Card 2 — Text',   'name' => 'jne_intro_card2',   'type' => 'text',     'default_value' => 'Express their thoughts confidently'],
            ['key' => 'field_jne_intro_card3',   'label' => 'Card 3 — Text',   'name' => 'jne_intro_card3',   'type' => 'text',     'default_value' => 'Stay aware of national & international events'],
            ['key' => 'field_jne_intro_card4',   'label' => 'Card 4 — Text',   'name' => 'jne_intro_card4',   'type' => 'text',     'default_value' => 'Improve vocabulary & communication'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 30,
    ]);

    // JNE: How We Teach / What We Cover
    acf_add_local_field_group([
        'key'    => 'group_jne_teach_cover',
        'title'  => 'JNE — How We Teach / What We Cover',
        'fields' => [
            ['key' => 'field_jne_teach_heading', 'label' => 'Teach Card — Heading', 'name' => 'jne_teach_heading', 'type' => 'text', 'default_value' => 'HOW WE TEACH'],
            ['key' => 'field_jne_teach_item1',   'label' => 'Teach Item 1',         'name' => 'jne_teach_item1',   'type' => 'text', 'default_value' => 'Story Format'],
            ['key' => 'field_jne_teach_item2',   'label' => 'Teach Item 2',         'name' => 'jne_teach_item2',   'type' => 'text', 'default_value' => 'Real-life Examples'],
            ['key' => 'field_jne_teach_item3',   'label' => 'Teach Item 3 (opt.)',  'name' => 'jne_teach_item3',   'type' => 'text'],
            ['key' => 'field_jne_cover_heading', 'label' => 'Cover Card — Heading', 'name' => 'jne_cover_heading', 'type' => 'text', 'default_value' => 'WHAT WE COVER'],
            ['key' => 'field_jne_cover_item1',   'label' => 'Cover Item 1',         'name' => 'jne_cover_item1',   'type' => 'text', 'default_value' => 'The Hindu'],
            ['key' => 'field_jne_cover_item2',   'label' => 'Cover Item 2',         'name' => 'jne_cover_item2',   'type' => 'text', 'default_value' => 'The Indian Express'],
            ['key' => 'field_jne_cover_item3',   'label' => 'Cover Item 3 (opt.)',  'name' => 'jne_cover_item3',   'type' => 'text'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 40,
    ]);

    // JNE: Daily Learning Structure (5 fixed items)
    acf_add_local_field_group([
        'key'    => 'group_jne_structure',
        'title'  => 'JNE — Daily Learning Structure (5 Items)',
        'fields' => [
            ['key' => 'field_jne_structure_heading', 'label' => 'Section Heading',  'name' => 'jne_structure_heading', 'type' => 'text', 'default_value' => 'Daily Learning Structure'],
            ['key' => 'field_jne_structure_sub',     'label' => 'Section Sub',      'name' => 'jne_structure_sub',     'type' => 'text', 'default_value' => 'Every Session Includes:'],
            ['key' => 'field_jne_structure_item1',   'label' => 'Item 1 — Text',    'name' => 'jne_structure_item1',   'type' => 'text', 'default_value' => '5 National & International Topics'],
            ['key' => 'field_jne_structure_item2',   'label' => 'Item 2 — Text',    'name' => 'jne_structure_item2',   'type' => 'text', 'default_value' => '3 Editorial Discussion'],
            ['key' => 'field_jne_structure_item3',   'label' => 'Item 3 — Text',    'name' => 'jne_structure_item3',   'type' => 'text', 'default_value' => '5 New Terminologies'],
            ['key' => 'field_jne_structure_item4',   'label' => 'Item 4 — Text',    'name' => 'jne_structure_item4',   'type' => 'text', 'default_value' => 'Quizzes (Daily / Weekly / Monthly)'],
            ['key' => 'field_jne_structure_item5',   'label' => 'Item 5 — Text',    'name' => 'jne_structure_item5',   'type' => 'text', 'default_value' => 'Daily Notes PDF for Revision'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 50,
    ]);

    // JNE: Learning Method (6 fixed cards)
    acf_add_local_field_group([
        'key'    => 'group_jne_method',
        'title'  => 'JNE — Our Learning Method (6 Cards)',
        'fields' => [
            ['key' => 'field_jne_method_heading', 'label' => 'Section Heading',  'name' => 'jne_method_heading',  'type' => 'text',     'default_value' => 'Our Learning Method'],
            ['key' => 'field_jne_method_sub',     'label' => 'Section Sub-text', 'name' => 'jne_method_sub',      'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_jne_method1_title',  'label' => 'Card 1 — Title',   'name' => 'jne_method1_title',   'type' => 'text',     'default_value' => 'Fun & Engaging Learning'],
            ['key' => 'field_jne_method2_title',  'label' => 'Card 2 — Title',   'name' => 'jne_method2_title',   'type' => 'text',     'default_value' => 'Interactive Live Sessions'],
            ['key' => 'field_jne_method3_title',  'label' => 'Card 3 — Title',   'name' => 'jne_method3_title',   'type' => 'text',     'default_value' => 'Mentor Guidance'],
            ['key' => 'field_jne_method4_title',  'label' => 'Card 4 — Title',   'name' => 'jne_method4_title',   'type' => 'text',     'default_value' => 'Personal Attention'],
            ['key' => 'field_jne_method5_title',  'label' => 'Card 5 — Title',   'name' => 'jne_method5_title',   'type' => 'text',     'default_value' => 'Story-based Teaching'],
            ['key' => 'field_jne_method6_title',  'label' => 'Card 6 — Title',   'name' => 'jne_method6_title',   'type' => 'text',     'default_value' => 'Games & Challenges'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 60,
    ]);

    // JNE: App Download
    acf_add_local_field_group([
        'key'    => 'group_jne_app',
        'title'  => 'JNE — App Download',
        'fields' => [
            ['key' => 'field_jne_app_heading',       'label' => 'Heading',              'name' => 'jne_app_heading',       'type' => 'text',    'default_value' => 'Read, Learn & Grow — Anytime, Anywhere'],
            ['key' => 'field_jne_app_sub',           'label' => 'Sub-text',             'name' => 'jne_app_subtext',       'type' => 'textarea','rows' => 2],
            ['key' => 'field_jne_app_android_url',   'label' => 'Android / Play URL',   'name' => 'jne_app_android_url',   'type' => 'url'],
            ['key' => 'field_jne_app_android_label', 'label' => 'Android Button Label', 'name' => 'jne_app_android_label', 'type' => 'text',    'default_value' => 'Google Play'],
            ['key' => 'field_jne_app_ios_url',       'label' => 'iOS / Web Portal URL', 'name' => 'jne_app_ios_url',       'type' => 'url'],
            ['key' => 'field_jne_app_ios_label',     'label' => 'iOS Button Label',     'name' => 'jne_app_ios_label',     'type' => 'text',    'default_value' => 'Web Portal'],
        ],
        'location'   => $jne_page_location,
        'menu_order' => 70,
    ]);

    // ── Skill Development Page ────────────────────────────────────────────────
    $sd_page_location = [[[
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-skill-development.php',
    ]]];

    // SD: Hero
    acf_add_local_field_group([
        'key'    => 'group_sd_hero',
        'title'  => 'Skill Dev — Hero',
        'fields' => [
            ['key' => 'field_sd_hero_badge',      'label' => 'Badge Text',          'name' => 'sd_hero_badge',      'type' => 'text',     'default_value' => 'Junior Skill Development Program'],
            ['key' => 'field_sd_hero_heading',    'label' => 'Heading (HTML ok)',   'name' => 'sd_hero_heading',    'type' => 'text',     'default_value' => 'Build Confident <span>Personalities</span>'],
            ['key' => 'field_sd_hero_tagline',    'label' => 'Tagline / Quote',     'name' => 'sd_hero_tagline',    'type' => 'text',     'default_value' => '"We don\'t just teach skills. We build confident personalities."'],
            ['key' => 'field_sd_hero_sub',        'label' => 'Sub-heading',         'name' => 'sd_hero_subheading', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_sd_stat_number',     'label' => 'Stat — Number',       'name' => 'sd_stat_number',     'type' => 'text',     'default_value' => '5,000+'],
            ['key' => 'field_sd_stat_label',      'label' => 'Stat — Label',        'name' => 'sd_stat_label',      'type' => 'text',     'default_value' => 'Students'],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 10,
    ]);

    // SD: Lead Form
    acf_add_local_field_group([
        'key'    => 'group_sd_form',
        'title'  => 'Skill Dev — Lead Form',
        'fields' => [
            ['key' => 'field_sd_form_heading', 'label' => 'Form Heading (HTML ok)', 'name' => 'sd_form_heading',    'type' => 'text',     'default_value' => 'Book a <span>Free Demo Class</span> Today!'],
            ['key' => 'field_sd_form_sub',     'label' => 'Form Sub-text',          'name' => 'sd_form_subheading', 'type' => 'textarea', 'rows' => 2],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 15,
    ]);

    // SD: Program Focus
    acf_add_local_field_group([
        'key'    => 'group_sd_focus',
        'title'  => 'Skill Dev — Program Focus',
        'fields' => [
            ['key' => 'field_sd_focus_heading',    'label' => 'Focus Section Heading', 'name' => 'sd_focus_heading',    'type' => 'text', 'default_value' => 'A structured program focused on:'],
            ['key' => 'field_sd_focus_point1',     'label' => 'Focus Point 1',         'name' => 'sd_focus_point1',     'type' => 'text', 'default_value' => 'Speaking'],
            ['key' => 'field_sd_focus_point2',     'label' => 'Focus Point 2',         'name' => 'sd_focus_point2',     'type' => 'text', 'default_value' => 'Reading'],
            ['key' => 'field_sd_focus_point3',     'label' => 'Focus Point 3',         'name' => 'sd_focus_point3',     'type' => 'text', 'default_value' => 'Listening'],
            ['key' => 'field_sd_focus_point4',     'label' => 'Focus Point 4',         'name' => 'sd_focus_point4',     'type' => 'text', 'default_value' => 'Writing'],
            ['key' => 'field_sd_holistic_heading', 'label' => 'Holistic Section Heading','name' => 'sd_holistic_heading','type' => 'text', 'default_value' => 'Holistic Development'],
            ['key' => 'field_sd_holistic_item1',   'label' => 'Holistic Item 1',        'name' => 'sd_holistic_item1',  'type' => 'text', 'default_value' => 'Communication Skills'],
            ['key' => 'field_sd_holistic_item2',   'label' => 'Holistic Item 2',        'name' => 'sd_holistic_item2',  'type' => 'text', 'default_value' => 'Personality Development'],
            ['key' => 'field_sd_holistic_item3',   'label' => 'Holistic Item 3',        'name' => 'sd_holistic_item3',  'type' => 'text', 'default_value' => 'Thinking Skills'],
            ['key' => 'field_sd_holistic_item4',   'label' => 'Holistic Item 4',        'name' => 'sd_holistic_item4',  'type' => 'text', 'default_value' => 'Leadership Skills'],
            ['key' => 'field_sd_holistic_item5',   'label' => 'Holistic Item 5',        'name' => 'sd_holistic_item5',  'type' => 'text', 'default_value' => 'Social Awareness'],
            ['key' => 'field_sd_holistic_item6',   'label' => 'Holistic Item 6',        'name' => 'sd_holistic_item6',  'type' => 'text', 'default_value' => 'Life Skills'],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 20,
    ]);

    // SD: Course Structure
    acf_add_local_field_group([
        'key'    => 'group_sd_structure',
        'title'  => 'Skill Dev — Course Structure',
        'fields' => [
            ['key' => 'field_sd_structure_heading', 'label' => 'Section Heading',    'name' => 'sd_structure_heading', 'type' => 'text', 'default_value' => 'Course Structure'],
            ['key' => 'field_sd_phase1_label',      'label' => 'Phase 1 — Label',    'name' => 'sd_phase1_label',      'type' => 'text', 'default_value' => 'Startup'],
            ['key' => 'field_sd_phase1_duration',   'label' => 'Phase 1 — Duration', 'name' => 'sd_phase1_duration',   'type' => 'text', 'default_value' => '1 Month'],
            ['key' => 'field_sd_phase2_label',      'label' => 'Phase 2 — Label',    'name' => 'sd_phase2_label',      'type' => 'text', 'default_value' => 'Foundation'],
            ['key' => 'field_sd_phase2_duration',   'label' => 'Phase 2 — Duration', 'name' => 'sd_phase2_duration',   'type' => 'text', 'default_value' => '5 Months'],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 30,
    ]);

    // SD: Curriculum (5 fixed cards)
    acf_add_local_field_group([
        'key'    => 'group_sd_curriculum',
        'title'  => 'Skill Dev — Curriculum (5 Class Cards)',
        'fields' => [
            ['key' => 'field_sd_curr_heading',     'label' => 'Section Heading',       'name' => 'sd_curriculum_heading', 'type' => 'text', 'default_value' => 'Curriculum'],
            ['key' => 'field_sd_curr_card1_label', 'label' => 'Card 1 — Label',        'name' => 'sd_curr_card1_label',   'type' => 'text', 'default_value' => 'Class 1-2'],
            ['key' => 'field_sd_curr_card1_desc',  'label' => 'Card 1 — Description',  'name' => 'sd_curr_card1_desc',    'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_curr_card2_label', 'label' => 'Card 2 — Label',        'name' => 'sd_curr_card2_label',   'type' => 'text', 'default_value' => 'Class 3-4'],
            ['key' => 'field_sd_curr_card2_desc',  'label' => 'Card 2 — Description',  'name' => 'sd_curr_card2_desc',    'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_curr_card3_label', 'label' => 'Card 3 — Label',        'name' => 'sd_curr_card3_label',   'type' => 'text', 'default_value' => 'Class 5-6'],
            ['key' => 'field_sd_curr_card3_desc',  'label' => 'Card 3 — Description',  'name' => 'sd_curr_card3_desc',    'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_curr_card4_label', 'label' => 'Card 4 — Label',        'name' => 'sd_curr_card4_label',   'type' => 'text', 'default_value' => 'Class 7-8'],
            ['key' => 'field_sd_curr_card4_desc',  'label' => 'Card 4 — Description',  'name' => 'sd_curr_card4_desc',    'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_curr_card5_label', 'label' => 'Card 5 — Label',        'name' => 'sd_curr_card5_label',   'type' => 'text', 'default_value' => 'Class 9-10'],
            ['key' => 'field_sd_curr_card5_desc',  'label' => 'Card 5 — Description',  'name' => 'sd_curr_card5_desc',    'type' => 'textarea', 'rows' => 3],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 40,
    ]);

    // SD: Learning Approach (6 fixed)
    acf_add_local_field_group([
        'key'    => 'group_sd_approach',
        'title'  => 'Skill Dev — Learning Approach (6 Items)',
        'fields' => [
            ['key' => 'field_sd_approach_heading',  'label' => 'Section Heading',   'name' => 'sd_approach_heading',  'type' => 'text', 'default_value' => 'Our Learning Approach'],
            ['key' => 'field_sd_approach1_title',   'label' => 'Item 1 — Title',    'name' => 'sd_approach1_title',   'type' => 'text', 'default_value' => 'Debates'],
            ['key' => 'field_sd_approach2_title',   'label' => 'Item 2 — Title',    'name' => 'sd_approach2_title',   'type' => 'text', 'default_value' => 'Group Discussions'],
            ['key' => 'field_sd_approach3_title',   'label' => 'Item 3 — Title',    'name' => 'sd_approach3_title',   'type' => 'text', 'default_value' => 'Real-life Examples'],
            ['key' => 'field_sd_approach4_title',   'label' => 'Item 4 — Title',    'name' => 'sd_approach4_title',   'type' => 'text', 'default_value' => 'Innovative Activities'],
            ['key' => 'field_sd_approach5_title',   'label' => 'Item 5 — Title',    'name' => 'sd_approach5_title',   'type' => 'text', 'default_value' => 'Story-based Teaching'],
            ['key' => 'field_sd_approach6_title',   'label' => 'Item 6 — Title',    'name' => 'sd_approach6_title',   'type' => 'text', 'default_value' => 'Games & Challenges'],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 50,
    ]);

    // SD: Real-World Exposure (4 fixed cards)
    acf_add_local_field_group([
        'key'    => 'group_sd_exposure',
        'title'  => 'Skill Dev — Real-World Exposure (4 Cards)',
        'fields' => [
            ['key' => 'field_sd_exposure_heading',  'label' => 'Section Heading',    'name' => 'sd_exposure_heading',  'type' => 'text', 'default_value' => 'Builds Real-World Exposure'],
            ['key' => 'field_sd_exp_card1_title',   'label' => 'Card 1 — Title',     'name' => 'sd_exp_card1_title',   'type' => 'text', 'default_value' => 'Junior Spotlight'],
            ['key' => 'field_sd_exp_card1_desc',    'label' => 'Card 1 — Desc',      'name' => 'sd_exp_card1_desc',    'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_sd_exp_card2_title',   'label' => 'Card 2 — Title',     'name' => 'sd_exp_card2_title',   'type' => 'text', 'default_value' => 'Junior Parliament'],
            ['key' => 'field_sd_exp_card2_desc',    'label' => 'Card 2 — Desc',      'name' => 'sd_exp_card2_desc',    'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_sd_exp_card3_title',   'label' => 'Card 3 — Title',     'name' => 'sd_exp_card3_title',   'type' => 'text', 'default_value' => 'Junior Entrepreneur'],
            ['key' => 'field_sd_exp_card3_desc',    'label' => 'Card 3 — Desc',      'name' => 'sd_exp_card3_desc',    'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_sd_exp_card4_title',   'label' => 'Card 4 — Title',     'name' => 'sd_exp_card4_title',   'type' => 'text', 'default_value' => 'Junior Storytelling'],
            ['key' => 'field_sd_exp_card4_desc',    'label' => 'Card 4 — Desc',      'name' => 'sd_exp_card4_desc',    'type' => 'textarea', 'rows' => 2],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 60,
    ]);

    // SD: Videos (3 fixed)
    acf_add_local_field_group([
        'key'    => 'group_sd_videos',
        'title'  => 'Skill Dev — Demos / Kids Videos (3)',
        'fields' => [
            ['key' => 'field_sd_video_heading', 'label' => 'Section Heading',  'name' => 'sd_video_heading', 'type' => 'text', 'default_value' => 'Demos & Kids Videos'],
            ['key' => 'field_sd_video1_url',    'label' => 'Video 1 — URL',    'name' => 'sd_video1_url',    'type' => 'url'],
            ['key' => 'field_sd_video1_title',  'label' => 'Video 1 — Title',  'name' => 'sd_video1_title',  'type' => 'text', 'default_value' => 'Student Demo 1'],
            ['key' => 'field_sd_video2_url',    'label' => 'Video 2 — URL',    'name' => 'sd_video2_url',    'type' => 'url'],
            ['key' => 'field_sd_video2_title',  'label' => 'Video 2 — Title',  'name' => 'sd_video2_title',  'type' => 'text', 'default_value' => 'Student Demo 2'],
            ['key' => 'field_sd_video3_url',    'label' => 'Video 3 — URL',    'name' => 'sd_video3_url',    'type' => 'url'],
            ['key' => 'field_sd_video3_title',  'label' => 'Video 3 — Title',  'name' => 'sd_video3_title',  'type' => 'text', 'default_value' => 'Student Demo 3'],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 70,
    ]);

    // SD: Testimonials (3 fixed)
    acf_add_local_field_group([
        'key'    => 'group_sd_testimonials',
        'title'  => 'Skill Dev — Testimonials (3)',
        'fields' => [
            ['key' => 'field_sd_testi_heading',  'label' => 'Section Heading',    'name' => 'sd_testi_heading',  'type' => 'text', 'default_value' => 'What Parents Say'],
            ['key' => 'field_sd_testi1_name',    'label' => 'Testimonial 1 — Name',   'name' => 'sd_testi1_name',   'type' => 'text',     'default_value' => 'Priya Sharma'],
            ['key' => 'field_sd_testi1_text',    'label' => 'Testimonial 1 — Quote',  'name' => 'sd_testi1_text',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_testi1_rating',  'label' => 'Testimonial 1 — Rating (1-5)', 'name' => 'sd_testi1_rating', 'type' => 'number', 'default_value' => 5, 'min' => 1, 'max' => 5],
            ['key' => 'field_sd_testi2_name',    'label' => 'Testimonial 2 — Name',   'name' => 'sd_testi2_name',   'type' => 'text',     'default_value' => 'Ravi Kumar'],
            ['key' => 'field_sd_testi2_text',    'label' => 'Testimonial 2 — Quote',  'name' => 'sd_testi2_text',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_testi2_rating',  'label' => 'Testimonial 2 — Rating (1-5)', 'name' => 'sd_testi2_rating', 'type' => 'number', 'default_value' => 5, 'min' => 1, 'max' => 5],
            ['key' => 'field_sd_testi3_name',    'label' => 'Testimonial 3 — Name',   'name' => 'sd_testi3_name',   'type' => 'text',     'default_value' => 'Anitha Reddy'],
            ['key' => 'field_sd_testi3_text',    'label' => 'Testimonial 3 — Quote',  'name' => 'sd_testi3_text',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_sd_testi3_rating',  'label' => 'Testimonial 3 — Rating (1-5)', 'name' => 'sd_testi3_rating', 'type' => 'number', 'default_value' => 5, 'min' => 1, 'max' => 5],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 80,
    ]);

    // SD: App Download
    acf_add_local_field_group([
        'key'    => 'group_sd_app',
        'title'  => 'Skill Dev — App Download',
        'fields' => [
            ['key' => 'field_sd_app_heading',       'label' => 'Heading',              'name' => 'sd_app_heading',       'type' => 'text',    'default_value' => 'Learn Anytime, Anywhere'],
            ['key' => 'field_sd_app_sub',           'label' => 'Sub-text',             'name' => 'sd_app_subtext',       'type' => 'textarea','rows' => 2],
            ['key' => 'field_sd_app_android_url',   'label' => 'Android / Play URL',   'name' => 'sd_app_android_url',   'type' => 'url'],
            ['key' => 'field_sd_app_android_label', 'label' => 'Android Button Label', 'name' => 'sd_app_android_label', 'type' => 'text',    'default_value' => 'Google Play'],
            ['key' => 'field_sd_app_ios_url',       'label' => 'iOS / Web Portal URL', 'name' => 'sd_app_ios_url',       'type' => 'url'],
            ['key' => 'field_sd_app_ios_label',     'label' => 'iOS Button Label',     'name' => 'sd_app_ios_label',     'type' => 'text',    'default_value' => 'Web Portal'],
        ],
        'location'   => $sd_page_location,
        'menu_order' => 90,
    ]);

    // ── Phonics Program Page ───────────────────────────────────────────────────
    $ph_page_location = [[[
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-phonics.php',
    ]]];

    // Phonics: Hero Banner
    acf_add_local_field_group([
        'key'   => 'group_ph_hero',
        'title' => 'Phonics — Hero Banner',
        'fields' => [
            ['key' => 'field_ph_hero_badge',      'label' => 'Badge Text',          'name' => 'ph_hero_badge',      'type' => 'text',  'default_value' => 'Phonics + Maths Foundation Program'],
            ['key' => 'field_ph_hero_heading',    'label' => 'Heading (HTML ok)',   'name' => 'ph_hero_heading',    'type' => 'text',  'default_value' => 'Learning Should Not Be Memorised — <span>It Should Be Understood</span>'],
            ['key' => 'field_ph_hero_subheading', 'label' => 'Sub-heading',         'name' => 'ph_hero_subheading', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_hero_image',      'label' => 'Hero Image',          'name' => 'ph_hero_image',      'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_ph_hero_cta1_text',  'label' => 'CTA 1 — Text',        'name' => 'ph_hero_cta1_text',  'type' => 'text',  'default_value' => 'Book Free Demo'],
            ['key' => 'field_ph_hero_cta1_url',   'label' => 'CTA 1 — URL',         'name' => 'ph_hero_cta1_url',   'type' => 'text',  'default_value' => '#ph-lead-form'],
            ['key' => 'field_ph_hero_cta2_text',  'label' => 'CTA 2 — Text',        'name' => 'ph_hero_cta2_text',  'type' => 'text',  'default_value' => 'View Curriculum'],
            ['key' => 'field_ph_hero_cta2_url',   'label' => 'CTA 2 — URL',         'name' => 'ph_hero_cta2_url',   'type' => 'text',  'default_value' => '#ph-curriculum'],
            ['key' => 'field_ph_stat1_num',       'label' => 'Stat 1 — Number',     'name' => 'ph_stat1_num',       'type' => 'text',  'default_value' => '8K+'],
            ['key' => 'field_ph_stat1_label',     'label' => 'Stat 1 — Label',      'name' => 'ph_stat1_label',     'type' => 'text',  'default_value' => 'Children Enrolled'],
            ['key' => 'field_ph_stat2_num',       'label' => 'Stat 2 — Number',     'name' => 'ph_stat2_num',       'type' => 'text',  'default_value' => '95%'],
            ['key' => 'field_ph_stat2_label',     'label' => 'Stat 2 — Label',      'name' => 'ph_stat2_label',     'type' => 'text',  'default_value' => 'Reading Improvement'],
            ['key' => 'field_ph_stat3_num',       'label' => 'Stat 3 — Number',     'name' => 'ph_stat3_num',       'type' => 'text',  'default_value' => '2x'],
            ['key' => 'field_ph_stat3_label',     'label' => 'Stat 3 — Label',      'name' => 'ph_stat3_label',     'type' => 'text',  'default_value' => 'Faster Learning'],
            ['key' => 'field_ph_step1_text',      'label' => 'Step 1 — Text',       'name' => 'ph_step1_text',      'type' => 'text',  'default_value' => "Choose your child's level"],
            ['key' => 'field_ph_step2_text',      'label' => 'Step 2 — Text',       'name' => 'ph_step2_text',      'type' => 'text',  'default_value' => 'Attend a Free Trial Class'],
            ['key' => 'field_ph_step3_text',      'label' => 'Step 3 — Text',       'name' => 'ph_step3_text',      'type' => 'text',  'default_value' => 'Enroll & start learning!'],
        ],
        'location'   => $ph_page_location,
        'menu_order' => 10,
    ]);

    // Phonics: Curriculum (3 fixed cards)
    acf_add_local_field_group([
        'key'   => 'group_ph_curriculum',
        'title' => 'Phonics — Curriculum',
        'fields' => [
            ['key' => 'field_ph_curriculum_heading',    'label' => 'Section Heading', 'name' => 'ph_curriculum_heading',    'type' => 'text', 'default_value' => 'Our Curriculum'],
            ['key' => 'field_ph_curriculum_subheading', 'label' => 'Section Sub',     'name' => 'ph_curriculum_subheading', 'type' => 'textarea', 'rows' => 2],
            // Card 1
            ['key' => 'field_ph_curr1_grade',    'label' => 'Card 1 — Level Name',  'name' => 'ph_curr1_grade',    'type' => 'text',     'default_value' => 'Phonics Basic'],
            ['key' => 'field_ph_curr1_subtitle', 'label' => 'Card 1 — Sub Label',   'name' => 'ph_curr1_subtitle', 'type' => 'text',     'default_value' => 'Beginner Level'],
            ['key' => 'field_ph_curr1_topics',   'label' => 'Card 1 — Topics (one per line)', 'name' => 'ph_curr1_topics', 'type' => 'textarea', 'rows' => 5, 'default_value' => "Letter sounds (A–Z)\nBlending 2–3 letter words\nSight words introduction\nBasic phonemic awareness\nFun reading activities"],
            ['key' => 'field_ph_curr1_pdf',      'label' => 'Card 1 — PDF Download','name' => 'ph_curr1_pdf',      'type' => 'file',     'return_format' => 'array', 'mime_types' => 'pdf'],
            ['key' => 'field_ph_curr1_color',    'label' => 'Card 1 — Accent Color','name' => 'ph_curr1_color',    'type' => 'select',   'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'blue'],
            // Card 2
            ['key' => 'field_ph_curr2_grade',    'label' => 'Card 2 — Level Name',  'name' => 'ph_curr2_grade',    'type' => 'text',     'default_value' => 'Phonics Intermediate'],
            ['key' => 'field_ph_curr2_subtitle', 'label' => 'Card 2 — Sub Label',   'name' => 'ph_curr2_subtitle', 'type' => 'text',     'default_value' => 'Building Fluency'],
            ['key' => 'field_ph_curr2_topics',   'label' => 'Card 2 — Topics (one per line)', 'name' => 'ph_curr2_topics', 'type' => 'textarea', 'rows' => 5, 'default_value' => "Digraphs & blends\nLong & short vowel sounds\nSyllable division\nReading simple sentences\nSpelling patterns"],
            ['key' => 'field_ph_curr2_pdf',      'label' => 'Card 2 — PDF Download','name' => 'ph_curr2_pdf',      'type' => 'file',     'return_format' => 'array', 'mime_types' => 'pdf'],
            ['key' => 'field_ph_curr2_color',    'label' => 'Card 2 — Accent Color','name' => 'ph_curr2_color',    'type' => 'select',   'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'green'],
            // Card 3
            ['key' => 'field_ph_curr3_grade',    'label' => 'Card 3 — Level Name',  'name' => 'ph_curr3_grade',    'type' => 'text',     'default_value' => 'Phonics Advanced'],
            ['key' => 'field_ph_curr3_subtitle', 'label' => 'Card 3 — Sub Label',   'name' => 'ph_curr3_subtitle', 'type' => 'text',     'default_value' => 'Reading Confidence'],
            ['key' => 'field_ph_curr3_topics',   'label' => 'Card 3 — Topics (one per line)', 'name' => 'ph_curr3_topics', 'type' => 'textarea', 'rows' => 5, 'default_value' => "Complex phonics rules\nMulti-syllabic words\nFluent paragraph reading\nComprehension skills\nCreative writing basics"],
            ['key' => 'field_ph_curr3_pdf',      'label' => 'Card 3 — PDF Download','name' => 'ph_curr3_pdf',      'type' => 'file',     'return_format' => 'array', 'mime_types' => 'pdf'],
            ['key' => 'field_ph_curr3_color',    'label' => 'Card 3 — Accent Color','name' => 'ph_curr3_color',    'type' => 'select',   'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal'], 'default_value' => 'yellow'],
        ],
        'location'   => $ph_page_location,
        'menu_order' => 20,
    ]);

    // Phonics: Foundation Split
    acf_add_local_field_group([
        'key'   => 'group_ph_foundation',
        'title' => 'Phonics — Foundation Split',
        'fields' => [
            ['key' => 'field_ph_phonics_found_title',  'label' => 'Phonics Card — Title',                'name' => 'ph_phonics_found_title',  'type' => 'text',     'default_value' => 'Phonics Foundation'],
            ['key' => 'field_ph_phonics_found_points', 'label' => 'Phonics Card — Points (one per line)','name' => 'ph_phonics_found_points', 'type' => 'textarea', 'rows' => 5, 'default_value' => "Letter sounds & blending\nWord formation\nReading fluency\nClear pronunciation\nChild starts reading confidently"],
            ['key' => 'field_ph_phonics_found_label',  'label' => 'Phonics Card — Bottom Label',         'name' => 'ph_phonics_found_label',  'type' => 'text',     'default_value' => 'Child starts reading confidently'],
            ['key' => 'field_ph_maths_found_title',    'label' => 'Maths Card — Title',                  'name' => 'ph_maths_found_title',    'type' => 'text',     'default_value' => 'Maths Foundation'],
            ['key' => 'field_ph_maths_found_points',   'label' => 'Maths Card — Points (one per line)',  'name' => 'ph_maths_found_points',   'type' => 'textarea', 'rows' => 5, 'default_value' => "Number recognition\nCounting & patterns\nBasic operations\nLogical thinking\nChild understands numbers, not just memorizes"],
            ['key' => 'field_ph_maths_found_label',    'label' => 'Maths Card — Bottom Label',           'name' => 'ph_maths_found_label',    'type' => 'text',     'default_value' => 'Child understands numbers, not just memorizes'],
        ],
        'location'   => $ph_page_location,
        'menu_order' => 30,
    ]);

    // Phonics: Learning Method (6 fixed cards)
    acf_add_local_field_group([
        'key'   => 'group_ph_method',
        'title' => 'Phonics — Learning Method',
        'fields' => [
            ['key' => 'field_ph_method_heading',    'label' => 'Section Heading', 'name' => 'ph_method_heading',    'type' => 'text', 'default_value' => 'Our Learning Method'],
            ['key' => 'field_ph_method_subheading', 'label' => 'Section Sub',     'name' => 'ph_method_subheading', 'type' => 'textarea', 'rows' => 2],
            // Card 1
            ['key' => 'field_ph_method1_title', 'label' => 'Card 1 — Title', 'name' => 'ph_method1_title', 'type' => 'text',   'default_value' => 'Fun & Engaging Learning'],
            ['key' => 'field_ph_method1_desc',  'label' => 'Card 1 — Desc',  'name' => 'ph_method1_desc',  'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_method1_icon',  'label' => 'Card 1 — Icon',  'name' => 'ph_method1_icon',  'type' => 'image',  'return_format' => 'array'],
            ['key' => 'field_ph_method1_color', 'label' => 'Card 1 — Color', 'name' => 'ph_method1_color', 'type' => 'select', 'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy', 'pink' => 'Pink'], 'default_value' => 'blue'],
            // Card 2
            ['key' => 'field_ph_method2_title', 'label' => 'Card 2 — Title', 'name' => 'ph_method2_title', 'type' => 'text',   'default_value' => 'Interactive Live Sessions'],
            ['key' => 'field_ph_method2_desc',  'label' => 'Card 2 — Desc',  'name' => 'ph_method2_desc',  'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_method2_icon',  'label' => 'Card 2 — Icon',  'name' => 'ph_method2_icon',  'type' => 'image',  'return_format' => 'array'],
            ['key' => 'field_ph_method2_color', 'label' => 'Card 2 — Color', 'name' => 'ph_method2_color', 'type' => 'select', 'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy', 'pink' => 'Pink'], 'default_value' => 'green'],
            // Card 3
            ['key' => 'field_ph_method3_title', 'label' => 'Card 3 — Title', 'name' => 'ph_method3_title', 'type' => 'text',   'default_value' => 'Regular Work Sheets'],
            ['key' => 'field_ph_method3_desc',  'label' => 'Card 3 — Desc',  'name' => 'ph_method3_desc',  'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_method3_icon',  'label' => 'Card 3 — Icon',  'name' => 'ph_method3_icon',  'type' => 'image',  'return_format' => 'array'],
            ['key' => 'field_ph_method3_color', 'label' => 'Card 3 — Color', 'name' => 'ph_method3_color', 'type' => 'select', 'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy', 'pink' => 'Pink'], 'default_value' => 'yellow'],
            // Card 4
            ['key' => 'field_ph_method4_title', 'label' => 'Card 4 — Title', 'name' => 'ph_method4_title', 'type' => 'text',   'default_value' => 'Personal Attention'],
            ['key' => 'field_ph_method4_desc',  'label' => 'Card 4 — Desc',  'name' => 'ph_method4_desc',  'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_method4_icon',  'label' => 'Card 4 — Icon',  'name' => 'ph_method4_icon',  'type' => 'image',  'return_format' => 'array'],
            ['key' => 'field_ph_method4_color', 'label' => 'Card 4 — Color', 'name' => 'ph_method4_color', 'type' => 'select', 'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy', 'pink' => 'Pink'], 'default_value' => 'teal'],
            // Card 5
            ['key' => 'field_ph_method5_title', 'label' => 'Card 5 — Title', 'name' => 'ph_method5_title', 'type' => 'text',   'default_value' => 'Story-Based Teaching'],
            ['key' => 'field_ph_method5_desc',  'label' => 'Card 5 — Desc',  'name' => 'ph_method5_desc',  'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_method5_icon',  'label' => 'Card 5 — Icon',  'name' => 'ph_method5_icon',  'type' => 'image',  'return_format' => 'array'],
            ['key' => 'field_ph_method5_color', 'label' => 'Card 5 — Color', 'name' => 'ph_method5_color', 'type' => 'select', 'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy', 'pink' => 'Pink'], 'default_value' => 'navy'],
            // Card 6
            ['key' => 'field_ph_method6_title', 'label' => 'Card 6 — Title', 'name' => 'ph_method6_title', 'type' => 'text',   'default_value' => 'Games & Challenges'],
            ['key' => 'field_ph_method6_desc',  'label' => 'Card 6 — Desc',  'name' => 'ph_method6_desc',  'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_method6_icon',  'label' => 'Card 6 — Icon',  'name' => 'ph_method6_icon',  'type' => 'image',  'return_format' => 'array'],
            ['key' => 'field_ph_method6_color', 'label' => 'Card 6 — Color', 'name' => 'ph_method6_color', 'type' => 'select', 'choices' => ['blue' => 'Blue', 'green' => 'Green', 'yellow' => 'Yellow', 'teal' => 'Teal', 'navy' => 'Navy', 'pink' => 'Pink'], 'default_value' => 'pink'],
        ],
        'location'   => $ph_page_location,
        'menu_order' => 40,
    ]);

    // Phonics: Demo Videos (4 fixed slots)
    acf_add_local_field_group([
        'key'   => 'group_ph_videos',
        'title' => 'Phonics — Demo Videos',
        'fields' => [
            ['key' => 'field_ph_video_heading',    'label' => 'Section Heading', 'name' => 'ph_video_heading',    'type' => 'text', 'default_value' => 'Demo Videos / Student Videos'],
            ['key' => 'field_ph_video_subheading', 'label' => 'Section Sub',     'name' => 'ph_video_subheading', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_video1_title', 'label' => 'Video 1 — Title',     'name' => 'ph_video1_title', 'type' => 'text'],
            ['key' => 'field_ph_video1_url',   'label' => 'Video 1 — YouTube URL','name' => 'ph_video1_url',   'type' => 'url'],
            ['key' => 'field_ph_video1_thumb', 'label' => 'Video 1 — Thumbnail', 'name' => 'ph_video1_thumb', 'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_ph_video2_title', 'label' => 'Video 2 — Title',     'name' => 'ph_video2_title', 'type' => 'text'],
            ['key' => 'field_ph_video2_url',   'label' => 'Video 2 — YouTube URL','name' => 'ph_video2_url',   'type' => 'url'],
            ['key' => 'field_ph_video2_thumb', 'label' => 'Video 2 — Thumbnail', 'name' => 'ph_video2_thumb', 'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_ph_video3_title', 'label' => 'Video 3 — Title',     'name' => 'ph_video3_title', 'type' => 'text'],
            ['key' => 'field_ph_video3_url',   'label' => 'Video 3 — YouTube URL','name' => 'ph_video3_url',   'type' => 'url'],
            ['key' => 'field_ph_video3_thumb', 'label' => 'Video 3 — Thumbnail', 'name' => 'ph_video3_thumb', 'type' => 'image', 'return_format' => 'array'],
            ['key' => 'field_ph_video4_title', 'label' => 'Video 4 — Title',     'name' => 'ph_video4_title', 'type' => 'text'],
            ['key' => 'field_ph_video4_url',   'label' => 'Video 4 — YouTube URL','name' => 'ph_video4_url',   'type' => 'url'],
            ['key' => 'field_ph_video4_thumb', 'label' => 'Video 4 — Thumbnail', 'name' => 'ph_video4_thumb', 'type' => 'image', 'return_format' => 'array'],
        ],
        'location'   => $ph_page_location,
        'menu_order' => 50,
    ]);

    // Phonics: CTA Banner
    acf_add_local_field_group([
        'key'   => 'group_ph_cta',
        'title' => 'Phonics — CTA Banner',
        'fields' => [
            ['key' => 'field_ph_cta_heading',   'label' => 'Heading',      'name' => 'ph_cta_heading',   'type' => 'text',     'default_value' => 'Give Your Child the Gift of Confident Reading & Maths'],
            ['key' => 'field_ph_cta_subtext',   'label' => 'Sub Text',     'name' => 'ph_cta_subtext',   'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_cta_btn_text',  'label' => 'Button 1 — Text', 'name' => 'ph_cta_btn_text',  'type' => 'text', 'default_value' => 'Book Free Demo Class'],
            ['key' => 'field_ph_cta_btn_url',   'label' => 'Button 1 — URL',  'name' => 'ph_cta_btn_url',   'type' => 'text', 'default_value' => '#ph-lead-form'],
            ['key' => 'field_ph_cta_btn2_text', 'label' => 'Button 2 — Text', 'name' => 'ph_cta_btn2_text', 'type' => 'text', 'default_value' => 'Call Us Now'],
            ['key' => 'field_ph_cta_btn2_url',  'label' => 'Button 2 — URL',  'name' => 'ph_cta_btn2_url',  'type' => 'text', 'default_value' => 'tel:+910000000000'],
        ],
        'location'   => $ph_page_location,
        'menu_order' => 60,
    ]);

    // Phonics: App Download
    acf_add_local_field_group([
        'key'   => 'group_ph_app',
        'title' => 'Phonics — App Download',
        'fields' => [
            ['key' => 'field_ph_app_heading',       'label' => 'Heading',              'name' => 'ph_app_heading',       'type' => 'text',     'default_value' => 'Learn Phonics & Maths Anywhere, Anytime'],
            ['key' => 'field_ph_app_subtext',        'label' => 'Sub Text',             'name' => 'ph_app_subtext',       'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_ph_app_android_url',   'label' => 'Google Play Store URL', 'name' => 'ph_app_android_url',   'type' => 'url'],
            ['key' => 'field_ph_app_android_label', 'label' => 'Android Button Label',  'name' => 'ph_app_android_label', 'type' => 'text', 'default_value' => 'Google Play'],
            ['key' => 'field_ph_app_ios_url',       'label' => 'Web Portal / App URL',  'name' => 'ph_app_ios_url',       'type' => 'url'],
            ['key' => 'field_ph_app_ios_label',     'label' => 'iOS/Web Button Label',  'name' => 'ph_app_ios_label',     'type' => 'text', 'default_value' => 'Web Portal'],
        ],
        'location'   => $ph_page_location,
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

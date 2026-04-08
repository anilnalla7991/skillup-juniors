<?php
/**
 * Template Name: Phonics Program
 * Page: Phonics Program
 */

// ── Hero ───────────────────────────────────────────────────────────────────
$ph_hero_badge     = get_field('ph_hero_badge')       ?: 'Phonics + Maths Foundation Program';
$ph_hero_heading   = get_field('ph_hero_heading')     ?: 'Learning Should Not Be Memorised — <span>It Should Be Understood</span>';
$ph_hero_sub       = get_field('ph_hero_subheading')  ?: 'A research-backed program that builds real reading skills and number sense — so your child learns with confidence, not fear.';
$ph_hero_image     = get_field('ph_hero_image');
$ph_hero_cta1_text = get_field('ph_hero_cta1_text')   ?: 'Book Free Demo';
$ph_hero_cta1_url  = get_field('ph_hero_cta1_url')    ?: '#ph-lead-form';
$ph_hero_cta2_text = get_field('ph_hero_cta2_text')   ?: 'View Curriculum';
$ph_hero_cta2_url  = get_field('ph_hero_cta2_url')    ?: '#ph-curriculum';

$ph_stat1_num = get_field('ph_stat1_num')   ?: '8K+';
$ph_stat1_lbl = get_field('ph_stat1_label') ?: 'Children Enrolled';
$ph_stat2_num = get_field('ph_stat2_num')   ?: '95%';
$ph_stat2_lbl = get_field('ph_stat2_label') ?: 'Reading Improvement';
$ph_stat3_num = get_field('ph_stat3_num')   ?: '2x';
$ph_stat3_lbl = get_field('ph_stat3_label') ?: 'Faster Learning';

$ph_step1 = get_field('ph_step1_text') ?: "Choose your child's level";
$ph_step2 = get_field('ph_step2_text') ?: 'Attend a Free Trial Class';
$ph_step3 = get_field('ph_step3_text') ?: 'Enroll & start learning!';
$ph_steps  = array_filter([$ph_step1, $ph_step2, $ph_step3]);

// ── Curriculum (3 fixed cards) ─────────────────────────────────────────────
$ph_curr_heading = get_field('ph_curriculum_heading')    ?: 'Our Curriculum';
$ph_curr_sub     = get_field('ph_curriculum_subheading') ?: 'Structured level-wise syllabus from beginner to advanced — building real reading fluency and number sense at every stage.';

$ph_curr_list = [
    [
        'curr_grade'    => get_field('ph_curr1_grade')    ?: 'Phonics Basic',
        'curr_subtitle' => get_field('ph_curr1_subtitle') ?: 'Beginner Level',
        'curr_topics'   => get_field('ph_curr1_topics')   ?: "Letter sounds (A–Z)\nBlending 2–3 letter words\nSight words introduction\nBasic phonemic awareness\nFun reading activities",
        'curr_pdf'      => get_field('ph_curr1_pdf'),
        'curr_color'    => get_field('ph_curr1_color')    ?: 'blue',
    ],
    [
        'curr_grade'    => get_field('ph_curr2_grade')    ?: 'Phonics Intermediate',
        'curr_subtitle' => get_field('ph_curr2_subtitle') ?: 'Building Fluency',
        'curr_topics'   => get_field('ph_curr2_topics')   ?: "Digraphs & blends\nLong & short vowel sounds\nSyllable division\nReading simple sentences\nSpelling patterns",
        'curr_pdf'      => get_field('ph_curr2_pdf'),
        'curr_color'    => get_field('ph_curr2_color')    ?: 'green',
    ],
    [
        'curr_grade'    => get_field('ph_curr3_grade')    ?: 'Phonics Advanced',
        'curr_subtitle' => get_field('ph_curr3_subtitle') ?: 'Reading Confidence',
        'curr_topics'   => get_field('ph_curr3_topics')   ?: "Complex phonics rules\nMulti-syllabic words\nFluent paragraph reading\nComprehension skills\nCreative writing basics",
        'curr_pdf'      => get_field('ph_curr3_pdf'),
        'curr_color'    => get_field('ph_curr3_color')    ?: 'yellow',
    ],
];

// ── Foundation (2 columns) ─────────────────────────────────────────────────
$ph_phonics_title  = get_field('ph_phonics_found_title') ?: 'Phonics Foundation';
$ph_phonics_points = get_field('ph_phonics_found_points') ?: "Letter sounds & blending\nWord formation\nReading fluency\nClear pronunciation\nChild starts reading confidently";
$ph_phonics_label  = get_field('ph_phonics_found_label') ?: 'Child starts reading confidently';

$ph_maths_title    = get_field('ph_maths_found_title')  ?: 'Maths Foundation';
$ph_maths_points   = get_field('ph_maths_found_points') ?: "Number recognition\nCounting & patterns\nBasic operations\nLogical thinking\nChild understands numbers, not just memorizes";
$ph_maths_label    = get_field('ph_maths_found_label')  ?: 'Child understands numbers, not just memorizes';

// ── Learning Method (6 fixed cards) ───────────────────────────────────────
$ph_method_heading = get_field('ph_method_heading')    ?: 'Our Learning Method';
$ph_method_sub     = get_field('ph_method_subheading') ?: 'Every session is crafted to make language and maths feel natural, joyful and easy to understand.';

$ph_method_icons = [
    'blue'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
    'green'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.87V15.13a1 1 0 01-1.447.9L15 14M3 8h12a2 2 0 012 2v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2z"/></svg>',
    'yellow' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>',
    'teal'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',
    'navy'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>',
    'pink'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
];

$ph_method_list = [
    ['method_title' => get_field('ph_method1_title') ?: 'Fun & Engaging Learning',    'method_desc' => get_field('ph_method1_desc') ?: '', 'method_icon' => get_field('ph_method1_icon'), 'method_color' => get_field('ph_method1_color') ?: 'blue'],
    ['method_title' => get_field('ph_method2_title') ?: 'Interactive Live Sessions',  'method_desc' => get_field('ph_method2_desc') ?: '', 'method_icon' => get_field('ph_method2_icon'), 'method_color' => get_field('ph_method2_color') ?: 'green'],
    ['method_title' => get_field('ph_method3_title') ?: 'Regular Work Sheets',        'method_desc' => get_field('ph_method3_desc') ?: '', 'method_icon' => get_field('ph_method3_icon'), 'method_color' => get_field('ph_method3_color') ?: 'yellow'],
    ['method_title' => get_field('ph_method4_title') ?: 'Personal Attention',         'method_desc' => get_field('ph_method4_desc') ?: '', 'method_icon' => get_field('ph_method4_icon'), 'method_color' => get_field('ph_method4_color') ?: 'teal'],
    ['method_title' => get_field('ph_method5_title') ?: 'Story-Based Teaching',       'method_desc' => get_field('ph_method5_desc') ?: '', 'method_icon' => get_field('ph_method5_icon'), 'method_color' => get_field('ph_method5_color') ?: 'navy'],
    ['method_title' => get_field('ph_method6_title') ?: 'Games & Challenges',         'method_desc' => get_field('ph_method6_desc') ?: '', 'method_icon' => get_field('ph_method6_icon'), 'method_color' => get_field('ph_method6_color') ?: 'pink'],
];

// ── Videos (4 fixed slots) ─────────────────────────────────────────────────
$ph_video_heading = get_field('ph_video_heading')    ?: 'Demo Videos / Student Videos';
$ph_video_sub     = get_field('ph_video_subheading') ?: 'Watch our students read fluently and solve problems with confidence — the SkillUp Juniors way!';

$ph_video_list = [];
for ($i = 1; $i <= 4; $i++) {
    $ph_video_list[] = [
        'video_title' => get_field("ph_video{$i}_title") ?: "Video {$i}",
        'video_url'   => get_field("ph_video{$i}_url")   ?: '',
        'video_thumb' => get_field("ph_video{$i}_thumb"),
    ];
}

// ── CTA ────────────────────────────────────────────────────────────────────
$ph_cta_heading   = get_field('ph_cta_heading')   ?: 'Give Your Child the Gift of Confident Reading & Maths';
$ph_cta_sub       = get_field('ph_cta_subtext')   ?: 'Join thousands of families building strong language and number foundations with SkillUp Juniors.';
$ph_cta_btn_text  = get_field('ph_cta_btn_text')  ?: 'Book Free Demo Class';
$ph_cta_btn_url   = get_field('ph_cta_btn_url')   ?: '#ph-lead-form';
$ph_cta_btn2_text = get_field('ph_cta_btn2_text') ?: 'Call Us Now';
$ph_cta_btn2_url  = get_field('ph_cta_btn2_url')  ?: 'tel:+910000000000';

// ── App Download ───────────────────────────────────────────────────────────
$ph_app_heading     = get_field('ph_app_heading')       ?: 'Learn Phonics & Maths Anywhere, Anytime';
$ph_app_sub         = get_field('ph_app_subtext')       ?: 'Download the app or access our web portal and start your child\'s reading journey today.';
$ph_app_android_url = get_field('ph_app_android_url')   ?: '#';
$ph_app_android_lbl = get_field('ph_app_android_label') ?: 'Google Play';
$ph_app_ios_url     = get_field('ph_app_ios_url')       ?: '#';
$ph_app_ios_lbl     = get_field('ph_app_ios_label')     ?: 'Web Portal';

$curr_colors = ['blue' => '#29ABE2', 'green' => '#2BB673', 'yellow' => '#F7A800', 'teal' => '#00BCD4'];

get_header();
?>

<main class="sj-page sj-page--phonics">

    <!-- ══════════════════════════════════════
         SECTION 1 — HERO
    ══════════════════════════════════════ -->
    <section class="ph-hero">
        <div class="ph-hero__shapes" aria-hidden="true">
            <span class="ph-hero__shape ph-hero__shape--1"></span>
            <span class="ph-hero__shape ph-hero__shape--2"></span>
            <span class="ph-hero__shape ph-hero__shape--3"></span>
        </div>
        <div class="sj-container">
            <div class="ph-hero__inner">

                <div class="ph-hero__content">
                    <?php if ($ph_hero_badge) : ?>
                        <div class="ph-hero__badge">
                            <span class="ph-hero__badge-dot"></span>
                            <?php echo esc_html($ph_hero_badge); ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="ph-hero__heading">
                        <?php echo wp_kses($ph_hero_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                    </h1>
                    <p class="ph-hero__sub"><?php echo esc_html($ph_hero_sub); ?></p>

                    <div class="ph-hero__stats">
                        <div class="ph-hero__stat"><strong><?php echo esc_html($ph_stat1_num); ?></strong><span><?php echo esc_html($ph_stat1_lbl); ?></span></div>
                        <div class="ph-hero__stat-divider" aria-hidden="true"></div>
                        <div class="ph-hero__stat"><strong><?php echo esc_html($ph_stat2_num); ?></strong><span><?php echo esc_html($ph_stat2_lbl); ?></span></div>
                        <div class="ph-hero__stat-divider" aria-hidden="true"></div>
                        <div class="ph-hero__stat"><strong><?php echo esc_html($ph_stat3_num); ?></strong><span><?php echo esc_html($ph_stat3_lbl); ?></span></div>
                    </div>

                    <div class="ph-hero__steps">
                        <p class="ph-hero__steps-label">Join SkillUp Juniors in <?php echo count($ph_steps); ?> Simple Steps</p>
                        <ol class="ph-hero__steps-list">
                            <?php foreach ($ph_steps as $step) : ?>
                                <li><?php echo esc_html($step); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>

                    <div class="ph-hero__actions">
                        <a href="<?php echo esc_url($ph_hero_cta1_url); ?>" class="sj-btn sj-btn--yellow"><?php echo esc_html($ph_hero_cta1_text); ?></a>
                        <a href="<?php echo esc_url($ph_hero_cta2_url); ?>" class="sj-btn sj-btn--outline-white"><?php echo esc_html($ph_hero_cta2_text); ?></a>
                    </div>
                </div>

                <div class="ph-hero__visual">
                    <?php if ($ph_hero_image) : ?>
                        <img src="<?php echo esc_url($ph_hero_image['url']); ?>"
                             alt="<?php echo esc_attr($ph_hero_image['alt']); ?>"
                             class="ph-hero__img" loading="eager">
                    <?php else : ?>
                        <div class="ph-hero__img-placeholder">
                            <div class="ph-hero__abc" aria-hidden="true">
                                <span class="ph-abc ph-abc--a">A</span>
                                <span class="ph-abc ph-abc--b">B</span>
                                <span class="ph-abc ph-abc--c">C</span>
                                <span class="ph-abc ph-abc--1">1</span>
                                <span class="ph-abc ph-abc--2">2</span>
                                <span class="ph-abc ph-abc--3">3</span>
                            </div>
                            <p>Upload Hero Image via ACF</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 2 — LEAD FORM
    ══════════════════════════════════════ -->
    <section class="ph-lead-wrap" id="ph-lead-form">
        <div class="sj-container">
            <div class="ph-lead-wrap__inner">
                <div class="ph-lead-wrap__text">
                    <h2 class="ph-lead-wrap__heading">Book a <span>Free Demo Class</span> Today!</h2>
                    <p class="ph-lead-wrap__sub">Fill in your details and our expert Phonics trainer will contact you within 24 hours.</p>
                    <ul class="ph-lead-wrap__perks">
                        <li><span class="ph-perk-icon" aria-hidden="true">&#10003;</span> 100% Free — No Commitment</li>
                        <li><span class="ph-perk-icon" aria-hidden="true">&#10003;</span> Live Online or In-Person</li>
                        <li><span class="ph-perk-icon" aria-hidden="true">&#10003;</span> Certified Expert Trainers</li>
                    </ul>
                </div>
                <form class="sj-form ph-form" id="ph-lead-form-el" novalidate>
                    <?php wp_nonce_field('sj_lead_nonce', 'sj_nonce'); ?>
                    <div class="sj-form__row">
                        <div class="sj-form__group">
                            <input type="text"  name="parent_name" placeholder="Parent's Full Name *"  required class="sj-form__input">
                        </div>
                        <div class="sj-form__group">
                            <input type="tel"   name="phone"       placeholder="Phone Number *"        required class="sj-form__input">
                        </div>
                    </div>
                    <div class="sj-form__row">
                        <div class="sj-form__group">
                            <input type="email" name="email"       placeholder="Email Address *"       required class="sj-form__input">
                        </div>
                        <div class="sj-form__group">
                            <input type="text"  name="child_age"   placeholder="Child's Age / Grade *" required class="sj-form__input">
                        </div>
                    </div>
                    <div class="sj-form__actions">
                        <button type="submit" class="sj-btn sj-btn--navy sj-form__submit" style="width:100%">
                            <span class="sj-btn-text">Book My Free Demo</span>
                            <span class="sj-btn-spinner" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="sj-form__msg" role="alert" aria-live="polite"></div>
                </form>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 3 — CURRICULUM
    ══════════════════════════════════════ -->
    <section class="ph-curriculum" id="ph-curriculum">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($ph_curr_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($ph_curr_sub); ?></p>
            </div>
            <div class="ph-curriculum__grid">
                <?php foreach ($ph_curr_list as $curr) :
                    $grade    = $curr['curr_grade']    ?? '';
                    $subtitle = $curr['curr_subtitle'] ?? '';
                    $topics   = $curr['curr_topics']   ?? '';
                    $pdf      = $curr['curr_pdf']      ?? null;
                    $color    = $curr['curr_color']    ?? 'blue';
                    $accent   = $curr_colors[$color]   ?? $curr_colors['blue'];
                    $topics_arr = array_filter(array_map('trim', explode("\n", $topics)));
                ?>
                    <div class="ph-curr-card" style="--card-accent:<?php echo esc_attr($accent); ?>">
                        <div class="ph-curr-card__top">
                            <div class="ph-curr-card__icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                            </div>
                            <div>
                                <h3 class="ph-curr-card__grade"><?php echo esc_html($grade); ?></h3>
                                <?php if ($subtitle) : ?>
                                    <span class="ph-curr-card__subtitle"><?php echo esc_html($subtitle); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($topics_arr) : ?>
                            <ul class="ph-curr-card__topics">
                                <?php foreach ($topics_arr as $topic) : ?>
                                    <li>
                                        <span class="ph-curr-card__check" aria-hidden="true">&#10003;</span>
                                        <?php echo esc_html($topic); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ($pdf) : ?>
                            <a href="<?php echo esc_url($pdf['url']); ?>" class="ph-curr-card__pdf" target="_blank" rel="noopener noreferrer" download>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download Curriculum PDF
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 4 — FOUNDATION SPLIT
    ══════════════════════════════════════ -->
    <section class="ph-foundation" id="ph-foundation">
        <div class="sj-container">
            <div class="ph-foundation__grid">

                <!-- Phonics Foundation -->
                <div class="ph-found-card ph-found-card--phonics">
                    <div class="ph-found-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                    </div>
                    <h2 class="ph-found-card__title"><?php echo esc_html($ph_phonics_title); ?></h2>
                    <ul class="ph-found-card__list">
                        <?php foreach (array_filter(array_map('trim', explode("\n", $ph_phonics_points))) as $point) : ?>
                            <li>
                                <span class="ph-found-card__bullet" aria-hidden="true">&#10003;</span>
                                <?php echo esc_html($point); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($ph_phonics_label) : ?>
                        <div class="ph-found-card__label">
                            <span aria-hidden="true">&#127775;</span>
                            <?php echo esc_html($ph_phonics_label); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Maths Foundation -->
                <div class="ph-found-card ph-found-card--maths">
                    <div class="ph-found-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </div>
                    <h2 class="ph-found-card__title"><?php echo esc_html($ph_maths_title); ?></h2>
                    <ul class="ph-found-card__list">
                        <?php foreach (array_filter(array_map('trim', explode("\n", $ph_maths_points))) as $point) : ?>
                            <li>
                                <span class="ph-found-card__bullet" aria-hidden="true">&#10003;</span>
                                <?php echo esc_html($point); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($ph_maths_label) : ?>
                        <div class="ph-found-card__label">
                            <span aria-hidden="true">&#127775;</span>
                            <?php echo esc_html($ph_maths_label); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 5 — LEARNING METHOD
    ══════════════════════════════════════ -->
    <section class="ph-method" id="ph-method">
        <div class="sj-container">
            <div class="sj-section-header sj-section-header--light">
                <h2 class="sj-section-title"><?php echo esc_html($ph_method_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($ph_method_sub); ?></p>
            </div>
            <div class="ph-method__grid">
                <?php foreach ($ph_method_list as $item) :
                    $title = $item['method_title'] ?? '';
                    $desc  = $item['method_desc']  ?? '';
                    $color = $item['method_color'] ?? 'blue';
                    $icon  = $item['method_icon']  ?? null;
                    $svg   = $ph_method_icons[$color] ?? $ph_method_icons['blue'];
                ?>
                    <div class="ph-method__card">
                        <div class="ph-method__icon" aria-hidden="true">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" width="28" height="28">
                            <?php else : ?>
                                <?php echo $svg; ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="ph-method__title"><?php echo esc_html($title); ?></h3>
                        <?php if ($desc) : ?>
                            <p class="ph-method__desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 6 — DEMO VIDEOS (horizontal scroll)
    ══════════════════════════════════════ -->
    <section class="ph-videos" id="ph-videos">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($ph_video_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($ph_video_sub); ?></p>
            </div>
            <div class="vm-videos__scroll">
                <?php foreach ($ph_video_list as $vid) :
                    $vtitle    = $vid['video_title'] ?? '';
                    $vurl      = $vid['video_url']   ?? '';
                    $vthumb    = $vid['video_thumb']  ?? null;
                    $embed_url = '';
                    if ($vurl) {
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $vurl, $m);
                        $embed_url = isset($m[1]) ? 'https://www.youtube.com/embed/' . $m[1] : $vurl;
                    }
                ?>
                    <div class="vm-video-card">
                        <?php if ($embed_url) : ?>
                            <div class="vm-video-card__embed">
                                <iframe src="<?php echo esc_url($embed_url); ?>"
                                    title="<?php echo esc_attr($vtitle); ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen loading="lazy"></iframe>
                            </div>
                        <?php elseif ($vthumb) : ?>
                            <div class="vm-video-card__thumb">
                                <img src="<?php echo esc_url($vthumb['url']); ?>" alt="<?php echo esc_attr($vthumb['alt'] ?? $vtitle); ?>" loading="lazy">
                                <div class="vm-video-card__play" aria-hidden="true">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="vm-video-card__placeholder">
                                <div class="vm-video-card__play-icon" aria-hidden="true">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                                <span>Add Video URL via ACF</span>
                            </div>
                        <?php endif; ?>
                        <?php if ($vtitle && $vtitle !== "Video {$vtitle}") : ?>
                            <p class="vm-video-card__title"><?php echo esc_html($vtitle); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 7 — CTA BANNER
    ══════════════════════════════════════ -->
    <section class="ph-cta">
        <div class="ph-cta__shapes" aria-hidden="true">
            <span class="ph-cta__shape ph-cta__shape--1"></span>
            <span class="ph-cta__shape ph-cta__shape--2"></span>
        </div>
        <div class="sj-container">
            <div class="ph-cta__inner">
                <div class="ph-cta__emoji" aria-hidden="true">&#128218;</div>
                <h2 class="ph-cta__heading"><?php echo esc_html($ph_cta_heading); ?></h2>
                <p class="ph-cta__sub"><?php echo esc_html($ph_cta_sub); ?></p>
                <div class="ph-cta__actions">
                    <a href="<?php echo esc_url($ph_cta_btn_url); ?>"  class="sj-btn sj-btn--yellow"><?php echo esc_html($ph_cta_btn_text); ?></a>
                    <a href="<?php echo esc_url($ph_cta_btn2_url); ?>" class="sj-btn sj-btn--outline-white"><?php echo esc_html($ph_cta_btn2_text); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 8 — APP DOWNLOAD
    ══════════════════════════════════════ -->
    <section class="ph-app">
        <div class="sj-container">
            <div class="ph-app__inner">
                <div class="ph-app__content">
                    <div class="ph-app__emoji" aria-hidden="true">&#128242;</div>
                    <h2 class="ph-app__heading"><?php echo esc_html($ph_app_heading); ?></h2>
                    <p class="ph-app__sub"><?php echo esc_html($ph_app_sub); ?></p>
                    <div class="ph-app__buttons">
                        <a href="<?php echo esc_url($ph_app_android_url); ?>" class="ab-app__btn ab-app__btn--android" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M6.18 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M17.82 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M5.24 7.73h13.52A1 1 0 0120 8.87v8.67a2.37 2.37 0 01-2.36 2.37h-.5v2.18a2.18 2.18 0 01-4.36 0v-2.18h-1.56v2.18a2.18 2.18 0 01-4.36 0v-2.18h-.5A2.37 2.37 0 012 17.54V8.87a1 1 0 011.24-1.14M14.5 5.25l1.39-2.41a.28.28 0 00-.49-.27l-1.41 2.44a8.7 8.7 0 00-3.98 0L8.6 2.57a.28.28 0 00-.49.27l1.39 2.41a8.21 8.21 0 00-4.68 6.21h13.36a8.21 8.21 0 00-3.68-6.21z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Get it on</small>
                                <strong><?php echo esc_html($ph_app_android_lbl); ?></strong>
                            </span>
                        </a>
                        <a href="<?php echo esc_url($ph_app_ios_url); ?>" class="ab-app__btn ab-app__btn--ios" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Access on</small>
                                <strong><?php echo esc_html($ph_app_ios_lbl); ?></strong>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

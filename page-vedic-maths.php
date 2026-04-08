<?php
/**
 * Template Name: Vedic Maths Program
 * Page: Vedic Maths Program
 */

// ── Section 1: Hero ────────────────────────────────────────────────────────
$vm_hero_badge       = get_field('vm_hero_badge')        ?: 'India\'s #1 Vedic Maths Program for Kids';
$vm_hero_heading     = get_field('vm_hero_heading')      ?: 'Faster Calculations.<br><span>Sharper Mind.</span><br>Confident Child.';
$vm_hero_sub         = get_field('vm_hero_subheading')   ?: 'Expert-led Vedic Maths training that makes your child lightning-fast at numbers — building real confidence in academics and beyond.';
$vm_hero_image       = get_field('vm_hero_image');
$vm_hero_cta1_text   = get_field('vm_hero_cta1_text')    ?: 'Book Free Demo';
$vm_hero_cta1_url    = get_field('vm_hero_cta1_url')     ?: '#vm-lead-form';
$vm_hero_cta2_text   = get_field('vm_hero_cta2_text')    ?: 'View Curriculum';
$vm_hero_cta2_url    = get_field('vm_hero_cta2_url')     ?: '#vm-curriculum';

$vm_steps            = get_field('vm_hero_steps');
$vm_steps_default    = [
    ['step_text' => 'Choose your child\'s grade & batch'],
    ['step_text' => 'Attend a Free Trial Class'],
    ['step_text' => 'Enroll & start learning!'],
];
$vm_steps_items      = ($vm_steps && count($vm_steps)) ? $vm_steps : $vm_steps_default;

$vm_stat1_num        = get_field('vm_stat1_num')   ?: '10K+';
$vm_stat1_lbl        = get_field('vm_stat1_label') ?: 'Students Trained';
$vm_stat2_num        = get_field('vm_stat2_num')   ?: '98%';
$vm_stat2_lbl        = get_field('vm_stat2_label') ?: 'Score Improvement';
$vm_stat3_num        = get_field('vm_stat3_num')   ?: '3x';
$vm_stat3_lbl        = get_field('vm_stat3_label') ?: 'Faster Calculation';

// ── Section 2: Curriculum ──────────────────────────────────────────────────
$vm_curr_heading     = get_field('vm_curriculum_heading')    ?: 'Our Curriculum';
$vm_curr_sub         = get_field('vm_curriculum_subheading') ?: 'Structured, grade-wise syllabus covering all Vedic Maths techniques — from basics to advanced speed tricks.';
$vm_curr_items       = get_field('vm_curriculum_items');
$vm_curr_default     = [
    [
        'curr_grade'       => 'Class 3 – 4',
        'curr_subtitle'    => 'Building the Foundation',
        'curr_topics'      => "Addition & Subtraction tricks\nMultiplication basics (tables 1–20)\nNumber sense & place value\nMental maths warm-ups\nFun pattern recognition",
        'curr_pdf'         => null,
        'curr_color'       => 'blue',
    ],
    [
        'curr_grade'       => 'Class 5 – 6',
        'curr_subtitle'    => 'Speed & Accuracy',
        'curr_topics'      => "Duplex method for squares\nVertical & crosswise multiplication\nDivision by flag method\nFractions & decimals shortcuts\nWord problem strategies",
        'curr_pdf'         => null,
        'curr_color'       => 'green',
    ],
    [
        'curr_grade'       => 'Class 7 – 8',
        'curr_subtitle'    => 'Advanced Techniques',
        'curr_topics'      => "Algebraic operations (Vedic way)\nCube roots & square roots\nHigh-speed division\nCompetitive exam tricks\nSelf-checking techniques",
        'curr_pdf'         => null,
        'curr_color'       => 'yellow',
    ],
];
$vm_curr_list        = ($vm_curr_items && count($vm_curr_items)) ? $vm_curr_items : $vm_curr_default;

// ── Section 3: Learning Approach ───────────────────────────────────────────
$vm_approach_heading = get_field('vm_approach_heading')    ?: 'Learning Approach';
$vm_approach_sub     = get_field('vm_approach_subheading') ?: 'Every session is designed to make Maths feel less like a subject and more like a superpower.';
$vm_approach_items   = get_field('vm_approach_items');
$vm_approach_default = [
    ['approach_title' => 'Fun & Engaging Learning',        'approach_color' => 'blue'],
    ['approach_title' => 'Interactive Live Sessions',      'approach_color' => 'green'],
    ['approach_title' => 'Regular Work Sheets',            'approach_color' => 'yellow'],
    ['approach_title' => 'Personal Attention',             'approach_color' => 'teal'],
    ['approach_title' => 'Practice with Fun Challenges',   'approach_color' => 'navy'],
    ['approach_title' => 'Step-by-Step Concept Clarity',   'approach_color' => 'blue'],
];
$vm_approach_list    = ($vm_approach_items && count($vm_approach_items)) ? $vm_approach_items : $vm_approach_default;

$vm_approach_icons = [
    'blue'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
    'green'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.87V15.13a1 1 0 01-1.447.9L15 14M3 8h12a2 2 0 012 2v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2z"/></svg>',
    'yellow' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>',
    'teal'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',
    'navy'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>',
];

// ── Section 4: Foundation / Root Problem ──────────────────────────────────
$vm_found_heading    = get_field('vm_foundation_heading') ?: 'We Fix the Root Problem — Foundation';
$vm_found_text       = get_field('vm_foundation_text')    ?: 'At SkillUp Juniors, we don\'t just teach Maths... we train children to think fast, calculate smart, and feel confident. Our Vedic Maths program addresses the root cause of Maths fear — lack of foundational understanding and speed — and replaces it with genuine confidence.';
$vm_found_highlights = get_field('vm_foundation_highlights');
$vm_found_hi_default = [
    ['highlight_text' => 'Think Fast'],
    ['highlight_text' => 'Calculate Smart'],
    ['highlight_text' => 'Feel Confident'],
];
$vm_found_hi_list    = ($vm_found_highlights && count($vm_found_highlights)) ? $vm_found_highlights : $vm_found_hi_default;

// ── Section 5: Demo Videos ─────────────────────────────────────────────────
$vm_video_heading    = get_field('vm_video_heading')    ?: 'Demo Videos / Student Videos';
$vm_video_sub        = get_field('vm_video_subheading') ?: 'Watch our students solve complex calculations in seconds — the Vedic Maths way!';
$vm_videos           = get_field('vm_video_items');
$vm_videos_default   = [
    ['video_title' => 'Student Demo — Class 5', 'video_url' => '', 'video_thumb' => null],
    ['video_title' => 'Speed Maths Challenge',  'video_url' => '', 'video_thumb' => null],
    ['video_title' => 'Parent Testimonial',     'video_url' => '', 'video_thumb' => null],
];
$vm_video_list       = ($vm_videos && count($vm_videos)) ? $vm_videos : $vm_videos_default;

// ── Section 6: CTA ────────────────────────────────────────────────────────
$vm_cta_heading      = get_field('vm_cta_heading')   ?: 'Give Your Child a Strong Maths Foundation Today';
$vm_cta_sub          = get_field('vm_cta_subtext')   ?: 'Join thousands of families who trust SkillUp Juniors to build unshakeable Maths confidence in their children.';
$vm_cta_btn_text     = get_field('vm_cta_btn_text')  ?: 'Book Free Demo Class';
$vm_cta_btn_url      = get_field('vm_cta_btn_url')   ?: '#vm-lead-form';
$vm_cta_btn2_text    = get_field('vm_cta_btn2_text') ?: 'Call Us Now';
$vm_cta_btn2_url     = get_field('vm_cta_btn2_url')  ?: 'tel:+910000000000';

// ── Section 7: App Download ────────────────────────────────────────────────
$vm_app_heading      = get_field('vm_app_heading')       ?: 'Learn Vedic Maths Anywhere, Anytime';
$vm_app_sub          = get_field('vm_app_subtext')       ?: 'Download the app or access our web portal and start your child\'s Maths transformation today.';
$vm_app_android_url  = get_field('vm_app_android_url')  ?: '#';
$vm_app_android_lbl  = get_field('vm_app_android_label')?: 'Google Play';
$vm_app_ios_url      = get_field('vm_app_ios_url')      ?: '#';
$vm_app_ios_lbl      = get_field('vm_app_ios_label')    ?: 'Web Portal';

get_header();
?>

<main class="sj-page sj-page--vedic-maths">

    <!-- ══════════════════════════════════════
         SECTION 1 — HERO BANNER
    ══════════════════════════════════════ -->
    <section class="vm-hero">
        <div class="vm-hero__shapes" aria-hidden="true">
            <span class="vm-hero__shape vm-hero__shape--1"></span>
            <span class="vm-hero__shape vm-hero__shape--2"></span>
            <span class="vm-hero__shape vm-hero__shape--3"></span>
        </div>
        <div class="sj-container">
            <div class="vm-hero__inner">

                <!-- Left Content -->
                <div class="vm-hero__content">
                    <?php if ($vm_hero_badge) : ?>
                        <div class="vm-hero__badge">
                            <span class="vm-hero__badge-dot"></span>
                            <?php echo esc_html($vm_hero_badge); ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="vm-hero__heading">
                        <?php echo wp_kses($vm_hero_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                    </h1>

                    <p class="vm-hero__sub"><?php echo esc_html($vm_hero_sub); ?></p>

                    <!-- Stats Strip -->
                    <div class="vm-hero__stats">
                        <div class="vm-hero__stat">
                            <strong><?php echo esc_html($vm_stat1_num); ?></strong>
                            <span><?php echo esc_html($vm_stat1_lbl); ?></span>
                        </div>
                        <div class="vm-hero__stat-divider" aria-hidden="true"></div>
                        <div class="vm-hero__stat">
                            <strong><?php echo esc_html($vm_stat2_num); ?></strong>
                            <span><?php echo esc_html($vm_stat2_lbl); ?></span>
                        </div>
                        <div class="vm-hero__stat-divider" aria-hidden="true"></div>
                        <div class="vm-hero__stat">
                            <strong><?php echo esc_html($vm_stat3_num); ?></strong>
                            <span><?php echo esc_html($vm_stat3_lbl); ?></span>
                        </div>
                    </div>

                    <!-- Steps -->
                    <div class="vm-hero__steps">
                        <p class="vm-hero__steps-label">Join SkillUp Juniors in <?php echo count($vm_steps_items); ?> Simple Steps</p>
                        <ol class="vm-hero__steps-list">
                            <?php foreach ($vm_steps_items as $step) : ?>
                                <li><?php echo esc_html($step['step_text'] ?? ''); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>

                    <div class="vm-hero__actions">
                        <a href="<?php echo esc_url($vm_hero_cta1_url); ?>" class="sj-btn sj-btn--yellow">
                            <?php echo esc_html($vm_hero_cta1_text); ?>
                        </a>
                        <a href="<?php echo esc_url($vm_hero_cta2_url); ?>" class="sj-btn sj-btn--outline-white">
                            <?php echo esc_html($vm_hero_cta2_text); ?>
                        </a>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="vm-hero__visual">
                    <?php if ($vm_hero_image) : ?>
                        <img
                            src="<?php echo esc_url($vm_hero_image['url']); ?>"
                            alt="<?php echo esc_attr($vm_hero_image['alt']); ?>"
                            class="vm-hero__img"
                            loading="eager"
                        >
                    <?php else : ?>
                        <div class="vm-hero__img-placeholder">
                            <div class="vm-hero__math-grid" aria-hidden="true">
                                <span>16×</span><span>25</span><span>=</span><span class="vm-answer">400</span>
                                <span>√</span><span>144</span><span>=</span><span class="vm-answer">12</span>
                                <span>99×</span><span>99</span><span>=</span><span class="vm-answer">9801</span>
                            </div>
                            <p>Upload Hero Image via ACF</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 2 — LEAD FORM (inline)
    ══════════════════════════════════════ -->
    <section class="vm-lead-wrap" id="vm-lead-form">
        <div class="sj-container">
            <div class="vm-lead-wrap__inner">
                <div class="vm-lead-wrap__text">
                    <h2 class="vm-lead-wrap__heading">Book a <span>Free Demo Class</span> Today!</h2>
                    <p class="vm-lead-wrap__sub">Fill in your details and our expert Vedic Maths trainer will contact you within 24 hours.</p>
                    <ul class="vm-lead-wrap__perks">
                        <li><span class="vm-perk-icon" aria-hidden="true">&#10003;</span> 100% Free — No Commitment</li>
                        <li><span class="vm-perk-icon" aria-hidden="true">&#10003;</span> Live Online or In-Person</li>
                        <li><span class="vm-perk-icon" aria-hidden="true">&#10003;</span> Certified Expert Trainers</li>
                    </ul>
                </div>
                <form class="sj-form vm-form" id="vm-lead-form-el" novalidate>
                    <?php wp_nonce_field('sj_lead_nonce', 'sj_nonce'); ?>
                    <div class="sj-form__row">
                        <div class="sj-form__group">
                            <input type="text"  name="parent_name" placeholder="Parent's Full Name *" required class="sj-form__input">
                        </div>
                        <div class="sj-form__group">
                            <input type="tel"   name="phone"       placeholder="Phone Number *"       required class="sj-form__input">
                        </div>
                    </div>
                    <div class="sj-form__row">
                        <div class="sj-form__group">
                            <input type="email" name="email"       placeholder="Email Address *"      required class="sj-form__input">
                        </div>
                        <div class="sj-form__group">
                            <input type="text"  name="child_age"   placeholder="Child's Age / Grade *"required class="sj-form__input">
                        </div>
                    </div>
                    <div class="sj-form__actions">
                        <button type="submit" class="sj-btn sj-btn--navy sj-form__submit" style="width:100%;">
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
         SECTION 3 — OUR CURRICULUM
    ══════════════════════════════════════ -->
    <section class="vm-curriculum" id="vm-curriculum">
        <div class="sj-container">

            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($vm_curr_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($vm_curr_sub); ?></p>
            </div>

            <div class="vm-curriculum__grid">
                <?php
                $curr_colors = ['blue' => '#29ABE2', 'green' => '#2BB673', 'yellow' => '#F7A800', 'teal' => '#00BCD4'];
                foreach ($vm_curr_list as $curr) :
                    $grade    = $curr['curr_grade']    ?? '';
                    $subtitle = $curr['curr_subtitle'] ?? '';
                    $topics   = $curr['curr_topics']   ?? '';
                    $pdf      = $curr['curr_pdf']      ?? null;
                    $color    = $curr['curr_color']    ?? 'blue';
                    $accent   = $curr_colors[$color]   ?? $curr_colors['blue'];
                    $topics_arr = array_filter(array_map('trim', explode("\n", $topics)));
                ?>
                    <div class="vm-curr-card" style="--card-accent: <?php echo esc_attr($accent); ?>">
                        <div class="vm-curr-card__header">
                            <div class="vm-curr-card__icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                            </div>
                            <div>
                                <h3 class="vm-curr-card__grade"><?php echo esc_html($grade); ?></h3>
                                <?php if ($subtitle) : ?>
                                    <span class="vm-curr-card__subtitle"><?php echo esc_html($subtitle); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($topics_arr) : ?>
                            <ul class="vm-curr-card__topics">
                                <?php foreach ($topics_arr as $topic) : ?>
                                    <li>
                                        <span class="vm-curr-card__check" aria-hidden="true">&#10003;</span>
                                        <?php echo esc_html($topic); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($pdf) : ?>
                            <a href="<?php echo esc_url($pdf['url']); ?>" class="vm-curr-card__pdf" target="_blank" rel="noopener noreferrer" download>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download Curriculum PDF
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 4 — LEARNING APPROACH
    ══════════════════════════════════════ -->
    <section class="vm-approach" id="vm-approach">
        <div class="sj-container">

            <div class="sj-section-header sj-section-header--light">
                <h2 class="sj-section-title"><?php echo esc_html($vm_approach_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($vm_approach_sub); ?></p>
            </div>

            <div class="vm-approach__grid">
                <?php foreach ($vm_approach_list as $item) :
                    $title  = $item['approach_title']       ?? '';
                    $desc   = $item['approach_description'] ?? '';
                    $color  = $item['approach_color']       ?? 'blue';
                    $icon   = $item['approach_icon']        ?? null;
                    $svg    = $vm_approach_icons[$color] ?? $vm_approach_icons['blue'];
                ?>
                    <div class="vm-approach__card">
                        <div class="vm-approach__icon" aria-hidden="true">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" width="28" height="28">
                            <?php else : ?>
                                <?php echo $svg; ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="vm-approach__title"><?php echo esc_html($title); ?></h3>
                        <?php if ($desc) : ?>
                            <p class="vm-approach__desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 5 — FOUNDATION / ROOT PROBLEM
    ══════════════════════════════════════ -->
    <section class="vm-foundation" id="vm-foundation">
        <div class="sj-container">
            <div class="vm-foundation__inner">

                <div class="vm-foundation__label" aria-hidden="true">&#128218;</div>
                <h2 class="vm-foundation__heading">
                    <?php echo wp_kses($vm_found_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                </h2>
                <p class="vm-foundation__text"><?php echo esc_html($vm_found_text); ?></p>

                <?php if ($vm_found_hi_list) : ?>
                    <div class="vm-foundation__highlights">
                        <?php foreach ($vm_found_hi_list as $hi) : ?>
                            <span class="vm-foundation__pill">
                                <span aria-hidden="true">&#9989;</span>
                                <?php echo esc_html($hi['highlight_text'] ?? ''); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 6 — DEMO / STUDENT VIDEOS
    ══════════════════════════════════════ -->
    <section class="vm-videos" id="vm-videos">
        <div class="sj-container">

            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($vm_video_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($vm_video_sub); ?></p>
            </div>

            <div class="vm-videos__grid">
                <?php foreach ($vm_video_list as $vid) :
                    $vtitle = $vid['video_title'] ?? '';
                    $vurl   = $vid['video_url']   ?? '';
                    $vthumb = $vid['video_thumb']  ?? null;
                    // Convert YouTube share/watch URL to embed URL
                    $embed_url = '';
                    if ($vurl) {
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $vurl, $m);
                        $embed_url = isset($m[1]) ? 'https://www.youtube.com/embed/' . $m[1] : $vurl;
                    }
                ?>
                    <div class="vm-video-card">
                        <?php if ($embed_url) : ?>
                            <div class="vm-video-card__embed">
                                <iframe
                                    src="<?php echo esc_url($embed_url); ?>"
                                    title="<?php echo esc_attr($vtitle); ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy"
                                ></iframe>
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
                        <?php if ($vtitle) : ?>
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
    <section class="vm-cta" id="vm-cta">
        <div class="vm-cta__shapes" aria-hidden="true">
            <span class="vm-cta__shape vm-cta__shape--1"></span>
            <span class="vm-cta__shape vm-cta__shape--2"></span>
        </div>
        <div class="sj-container">
            <div class="vm-cta__inner">
                <div class="vm-cta__emoji" aria-hidden="true">&#127919;</div>
                <h2 class="vm-cta__heading"><?php echo esc_html($vm_cta_heading); ?></h2>
                <p class="vm-cta__sub"><?php echo esc_html($vm_cta_sub); ?></p>
                <div class="vm-cta__actions">
                    <a href="<?php echo esc_url($vm_cta_btn_url); ?>" class="sj-btn sj-btn--yellow">
                        <?php echo esc_html($vm_cta_btn_text); ?>
                    </a>
                    <a href="<?php echo esc_url($vm_cta_btn2_url); ?>" class="sj-btn sj-btn--outline-white">
                        <?php echo esc_html($vm_cta_btn2_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 8 — APP DOWNLOAD
    ══════════════════════════════════════ -->
    <section class="vm-app" id="vm-app">
        <div class="sj-container">
            <div class="vm-app__inner">

                <div class="vm-app__content">
                    <div class="vm-app__emoji" aria-hidden="true">&#128242;</div>
                    <h2 class="vm-app__heading"><?php echo esc_html($vm_app_heading); ?></h2>
                    <p class="vm-app__sub"><?php echo esc_html($vm_app_sub); ?></p>
                    <div class="vm-app__buttons">
                        <a href="<?php echo esc_url($vm_app_android_url); ?>" class="ab-app__btn ab-app__btn--android" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M6.18 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M17.82 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M5.24 7.73h13.52A1 1 0 0120 8.87v8.67a2.37 2.37 0 01-2.36 2.37h-.5v2.18a2.18 2.18 0 01-4.36 0v-2.18h-1.56v2.18a2.18 2.18 0 01-4.36 0v-2.18h-.5A2.37 2.37 0 012 17.54V8.87a1 1 0 011.24-1.14M14.5 5.25l1.39-2.41a.28.28 0 00-.49-.27l-1.41 2.44a8.7 8.7 0 00-3.98 0L8.6 2.57a.28.28 0 00-.49.27l1.39 2.41a8.21 8.21 0 00-4.68 6.21h13.36a8.21 8.21 0 00-3.68-6.21z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Get it on</small>
                                <strong><?php echo esc_html($vm_app_android_lbl); ?></strong>
                            </span>
                        </a>
                        <a href="<?php echo esc_url($vm_app_ios_url); ?>" class="ab-app__btn ab-app__btn--ios" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Access on</small>
                                <strong><?php echo esc_html($vm_app_ios_lbl); ?></strong>
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

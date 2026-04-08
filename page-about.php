<?php
/**
 * Template Name: About Us
 * Page: About Us
 */

// ── Section 1: Hero ────────────────────────────────────────────────────────
$ab_hero_badge     = get_field('about_hero_badge')       ?: 'About SkillUp Juniors';
$ab_hero_heading   = get_field('about_hero_heading')     ?: 'Because Every Child Deserves <span>the Right Start</span>';
$ab_hero_sub       = get_field('about_hero_subheading')  ?: 'We help children grow with confidence, skills, and joy in learning — through expert-led, activity-based programs designed for every young mind.';
$ab_hero_cta1_text = get_field('about_hero_cta1_text')   ?: 'Book Free Demo';
$ab_hero_cta1_url  = get_field('about_hero_cta1_url')    ?: '#lead-form';
$ab_hero_cta2_text = get_field('about_hero_cta2_text')   ?: 'Our Approach';
$ab_hero_cta2_url  = get_field('about_hero_cta2_url')    ?: '#ab-approach';
$ab_hero_image     = get_field('about_hero_image');
$ab_hero_stat1_num = get_field('about_hero_stat1_num')   ?: '10,000+';
$ab_hero_stat1_lbl = get_field('about_hero_stat1_label') ?: 'Students';
$ab_hero_stat2_num = get_field('about_hero_stat2_num')   ?: '4.9';
$ab_hero_stat2_lbl = get_field('about_hero_stat2_label') ?: 'Rating';

// ── Section 2: Vision & Mission ────────────────────────────────────────────
$ab_vision_title = get_field('about_vision_title') ?: 'Vision';
$ab_vision_text  = get_field('about_vision_text')  ?: 'At SkillUp Juniors, our vision is to nurture a generation of confident, skilled, and independent learners by creating a joyful and engaging learning environment where every child can unlock their true potential.';
$ab_mission_title = get_field('about_mission_title') ?: 'Mission';
$ab_mission_text  = get_field('about_mission_text')  ?: 'Our mission is to provide fun, interactive, and result-oriented learning through personalized attention, activity-based teaching, and strong foundational development in Maths, English, and life skills — helping children grow with confidence and real-world abilities.';

// ── Section 3: Founder Quote ───────────────────────────────────────────────
$ab_founder_quote  = get_field('about_founder_quote') ?: 'Education should not just be about marks, but about building a child\'s confidence and personality.';
$ab_founder_name   = get_field('about_founder_name')  ?: 'Dr. Prakash Bhaliya';
$ab_founder_role   = get_field('about_founder_role')  ?: 'Founder of SkillUp Juniors';
$ab_founder_bio    = get_field('about_founder_bio')   ?: 'Dr. Prakash Bhaliya is a highly accomplished academician and educator with a strong passion for transforming children\'s learning experiences. He holds an impressive academic portfolio including degrees in B.Tech, M.Tech (Mining), PGDV (Planning), Ph.D, and is currently pursuing LLB. With deep expertise in education research and structured learning methodologies, he identified a critical gap in traditional education — lack of confidence, practical knowledge, and attention among children. Driven by this vision, he founded SkillUp Juniors to create a platform focused on fun, interactive, and result-oriented learning that builds confidence, communication, and strong foundational skills. His mission is to empower children to become confident, independent, and future-ready individuals.';
$ab_founder_image  = get_field('about_founder_image');

// ── Section 4: Teaching Approach ──────────────────────────────────────────
$ab_approach_heading = get_field('about_approach_heading')    ?: 'Teaching Approach';
$ab_approach_sub     = get_field('about_approach_subheading') ?: 'A proven, child-centric methodology that makes learning fun, effective, and long-lasting.';
$ab_approach_items   = get_field('about_approach_items');

$ab_approach_defaults = [
    [
        'approach_title'       => 'Activity-Based Learning',
        'approach_description' => 'Hands-on activities that make concepts memorable and fun, turning learning into an adventure children love.',
        'approach_color'       => 'blue',
    ],
    [
        'approach_title'       => 'Interactive Live Sessions',
        'approach_description' => 'Real-time engagement with expert trainers to ensure every child stays curious, focused, and motivated.',
        'approach_color'       => 'green',
    ],
    [
        'approach_title'       => 'Personal Attention',
        'approach_description' => 'Small batch sizes and one-on-one support ensure every child gets the attention they deserve to thrive.',
        'approach_color'       => 'yellow',
    ],
    [
        'approach_title'       => 'Result-Oriented Approach',
        'approach_description' => 'Structured curriculum with regular assessments and progress tracking for measurable growth every step of the way.',
        'approach_color'       => 'teal',
    ],
];

$ab_approach_svg = [
    'blue'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
    'green'  => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.87V15.13a1 1 0 01-1.447.9L15 14M3 8h12a2 2 0 012 2v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2z"/></svg>',
    'yellow' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',
    'teal'   => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
];

$ab_items = ($ab_approach_items && count($ab_approach_items)) ? $ab_approach_items : $ab_approach_defaults;

// ── Section 5: App Download ────────────────────────────────────────────────
$ab_app_heading      = get_field('about_app_heading')       ?: 'Start Learning Anywhere, Anytime';
$ab_app_sub          = get_field('about_app_subtext')       ?: 'Download our app or access the web portal — your child\'s journey to confidence begins right here.';
$ab_app_android_url  = get_field('about_app_android_url')   ?: '#';
$ab_app_android_lbl  = get_field('about_app_android_label') ?: 'Google Play';
$ab_app_ios_url      = get_field('about_app_ios_url')       ?: '#';
$ab_app_ios_lbl      = get_field('about_app_ios_label')     ?: 'Web Portal';

get_header();
?>

<main class="sj-page sj-page--about">

    <!-- ══════════════════════════════════════
         SECTION 1 — HERO BANNER
    ══════════════════════════════════════ -->
    <section class="ab-hero">
        <div class="ab-hero__shapes" aria-hidden="true">
            <span class="ab-hero__shape ab-hero__shape--1"></span>
            <span class="ab-hero__shape ab-hero__shape--2"></span>
        </div>
        <div class="sj-container">
            <div class="ab-hero__inner">

                <div class="ab-hero__content">
                    <?php if ($ab_hero_badge) : ?>
                        <div class="ab-hero__badge">
                            <span class="ab-hero__badge-dot"></span>
                            <?php echo esc_html($ab_hero_badge); ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="ab-hero__heading">
                        <?php echo wp_kses($ab_hero_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                    </h1>

                    <?php if ($ab_hero_sub) : ?>
                        <p class="ab-hero__sub"><?php echo esc_html($ab_hero_sub); ?></p>
                    <?php endif; ?>

                    <div class="ab-hero__actions">
                        <a href="<?php echo esc_url($ab_hero_cta1_url); ?>" class="sj-btn sj-btn--yellow">
                            <?php echo esc_html($ab_hero_cta1_text); ?>
                        </a>
                        <a href="<?php echo esc_url($ab_hero_cta2_url); ?>" class="sj-btn sj-btn--outline-white">
                            <?php echo esc_html($ab_hero_cta2_text); ?>
                        </a>
                    </div>
                </div>

                <div class="ab-hero__visual">
                    <?php if ($ab_hero_image) : ?>
                        <img
                            src="<?php echo esc_url($ab_hero_image['url']); ?>"
                            alt="<?php echo esc_attr($ab_hero_image['alt']); ?>"
                            class="ab-hero__img"
                            loading="eager"
                        >
                    <?php else : ?>
                        <div class="ab-hero__img-placeholder">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <span>Upload Hero Image via ACF</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($ab_hero_stat1_num) : ?>
                        <div class="ab-hero__badge-float ab-hero__badge-float--1">
                            <span class="ab-badge-icon" aria-hidden="true">&#127891;</span>
                            <span><?php echo esc_html($ab_hero_stat1_num . ' ' . $ab_hero_stat1_lbl); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($ab_hero_stat2_num) : ?>
                        <div class="ab-hero__badge-float ab-hero__badge-float--2">
                            <span class="ab-badge-icon" aria-hidden="true">&#11088;</span>
                            <span><?php echo esc_html($ab_hero_stat2_num . ' ' . $ab_hero_stat2_lbl); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 2 — VISION & MISSION
    ══════════════════════════════════════ -->
    <section class="ab-vm" id="ab-vision-mission">
        <div class="sj-container">
            <div class="ab-vm__grid">

                <!-- Vision Card -->
                <div class="ab-vm__card ab-vm__card--vision">
                    <div class="ab-vm__card-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                    </div>
                    <h2 class="ab-vm__card-title"><?php echo esc_html($ab_vision_title); ?></h2>
                    <p class="ab-vm__card-text"><?php echo esc_html($ab_vision_text); ?></p>
                </div>

                <!-- Mission Card -->
                <div class="ab-vm__card ab-vm__card--mission">
                    <div class="ab-vm__card-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h2 class="ab-vm__card-title"><?php echo esc_html($ab_mission_title); ?></h2>
                    <p class="ab-vm__card-text"><?php echo esc_html($ab_mission_text); ?></p>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 3 — FOUNDER QUOTE
    ══════════════════════════════════════ -->
    <section class="ab-founder" id="ab-founder">
        <div class="sj-container">
            <div class="ab-founder__inner">

                <div class="ab-founder__content">
                    <div class="ab-founder__quote-mark" aria-hidden="true">&#8220;</div>

                    <blockquote class="ab-founder__quote">
                        <?php echo esc_html($ab_founder_quote); ?>
                    </blockquote>

                    <div class="ab-founder__divider"></div>

                    <div class="ab-founder__bio">
                        <strong class="ab-founder__name"><?php echo esc_html($ab_founder_name); ?></strong>
                        <span class="ab-founder__role"><?php echo esc_html($ab_founder_role); ?></span>
                        <?php if ($ab_founder_bio) : ?>
                            <p class="ab-founder__bio-text"><?php echo esc_html($ab_founder_bio); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="ab-founder__photo-wrap">
                    <?php if ($ab_founder_image) : ?>
                        <img
                            src="<?php echo esc_url($ab_founder_image['url']); ?>"
                            alt="<?php echo esc_attr($ab_founder_image['alt']); ?>"
                            class="ab-founder__photo"
                            loading="lazy"
                        >
                    <?php else : ?>
                        <div class="ab-founder__photo-placeholder">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <span>Founder Photo via ACF</span>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 4 — TEACHING APPROACH
    ══════════════════════════════════════ -->
    <section class="ab-approach" id="ab-approach">
        <div class="sj-container">

            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($ab_approach_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($ab_approach_sub); ?></p>
            </div>

            <div class="ab-approach__grid">
                <?php foreach ($ab_items as $item) :
                    $title  = $item['approach_title']       ?? '';
                    $desc   = $item['approach_description'] ?? '';
                    $color  = $item['approach_color']       ?? 'blue';
                    $icon   = $item['approach_icon']        ?? null;
                    $svg    = $ab_approach_svg[$color] ?? $ab_approach_svg['blue'];
                ?>
                    <div class="ab-approach__card">
                        <div class="ab-approach__icon ab-approach__icon--<?php echo esc_attr($color); ?>" aria-hidden="true">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" width="32" height="32">
                            <?php else : ?>
                                <?php echo $svg; ?>
                            <?php endif; ?>
                        </div>
                        <h3 class="ab-approach__title"><?php echo esc_html($title); ?></h3>
                        <p class="ab-approach__desc"><?php echo esc_html($desc); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 5 — APP DOWNLOAD
    ══════════════════════════════════════ -->
    <section class="ab-app" id="ab-app">
        <div class="ab-app__bg-shape" aria-hidden="true"></div>
        <div class="sj-container">
            <div class="ab-app__inner">

                <div class="ab-app__content">
                    <div class="ab-app__emoji" aria-hidden="true">&#127760;</div>
                    <h2 class="ab-app__heading"><?php echo esc_html($ab_app_heading); ?></h2>
                    <p class="ab-app__sub"><?php echo esc_html($ab_app_sub); ?></p>
                    <div class="ab-app__buttons">
                        <a href="<?php echo esc_url($ab_app_android_url); ?>" class="ab-app__btn ab-app__btn--android" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M6.18 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M17.82 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M5.24 7.73h13.52A1 1 0 0120 8.87v8.67a2.37 2.37 0 01-2.36 2.37h-.5v2.18a2.18 2.18 0 01-4.36 0v-2.18h-1.56v2.18a2.18 2.18 0 01-4.36 0v-2.18h-.5A2.37 2.37 0 012 17.54V8.87a1 1 0 011.24-1.14M14.5 5.25l1.39-2.41a.28.28 0 00-.49-.27l-1.41 2.44a8.7 8.7 0 00-3.98 0L8.6 2.57a.28.28 0 00-.49.27l1.39 2.41a8.21 8.21 0 00-4.68 6.21h13.36a8.21 8.21 0 00-3.68-6.21z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Get it on</small>
                                <strong><?php echo esc_html($ab_app_android_lbl); ?></strong>
                            </span>
                        </a>
                        <a href="<?php echo esc_url($ab_app_ios_url); ?>" class="ab-app__btn ab-app__btn--ios" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Access on</small>
                                <strong><?php echo esc_html($ab_app_ios_lbl); ?></strong>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="ab-app__visual" aria-hidden="true">
                    <div class="ab-app__phone">
                        <div class="ab-app__phone-screen">
                            <div class="ab-app__phone-content">
                                <div class="ab-app__phone-logo">SJ</div>
                                <div class="ab-app__phone-line"></div>
                                <div class="ab-app__phone-line ab-app__phone-line--short"></div>
                                <div class="ab-app__phone-cards">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

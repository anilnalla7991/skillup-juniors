

<?php
/**
 * Template Name: Junior News Express
 * Page: Junior News Express
 */

// ── Hero ─────────────────────────────────────────────────────────────────────
$jne_hero_badge    = get_field('jne_hero_badge')      ?: 'Junior News Express';
$jne_hero_heading  = get_field('jne_hero_heading')    ?: 'Understanding Daily <span>Newspaper for Kids</span>';
$jne_hero_tagline  = get_field('jne_hero_tagline')    ?: 'Try Daily News, Also Daily Learning';
$jne_hero_sub      = get_field('jne_hero_subheading') ?: 'A unique program that turns newspaper reading into a daily learning habit — building vocabulary, awareness, and confidence.';
$jne_hero_detail1  = get_field('jne_hero_detail1')    ?: 'Class 1–10 | Boys & Girls';
$jne_hero_detail2  = get_field('jne_hero_detail2')    ?: '5 Days a Week';
$jne_hero_image    = get_field('jne_hero_image');
$jne_hero_cta1_txt = get_field('jne_hero_cta1_text')  ?: 'Book Free Demo';
$jne_hero_cta1_url = get_field('jne_hero_cta1_url')   ?: '#jne-lead-form';
$jne_hero_cta2_txt = get_field('jne_hero_cta2_text')  ?: 'Learn More';
$jne_hero_cta2_url = get_field('jne_hero_cta2_url')   ?: '#jne-intro';

$jne_step1 = get_field('jne_step1_text') ?: 'Choose your child\'s grade';
$jne_step2 = get_field('jne_step2_text') ?: 'Attend a Free Trial Session';
$jne_step3 = get_field('jne_step3_text') ?: 'Enroll & start learning!';
$jne_steps = array_filter([$jne_step1, $jne_step2, $jne_step3]);

// ── Lead Form ─────────────────────────────────────────────────────────────────
$jne_form_heading = get_field('jne_form_heading')    ?: 'Book a <span>Free Demo Session</span> Today!';
$jne_form_sub     = get_field('jne_form_subheading') ?: 'Fill in your details and our expert trainer will contact you within 24 hours.';
$jne_perk1        = get_field('jne_form_perk1')      ?: '100% Free — No Commitment';
$jne_perk2        = get_field('jne_form_perk2')      ?: 'Live Online or In-Person';
$jne_perk3        = get_field('jne_form_perk3')      ?: 'Certified Expert Trainers';

// ── Introducing JNE ───────────────────────────────────────────────────────────
$jne_intro_heading = get_field('jne_intro_heading')  ?: 'Introducing Juniors News Express';
$jne_intro_sub     = get_field('jne_intro_sub')      ?: 'A unique program where children learn to:';
$jne_intro_cards   = [
    get_field('jne_intro_card1') ?: 'Understand daily news in a simple way',
    get_field('jne_intro_card2') ?: 'Express their thoughts confidently',
    get_field('jne_intro_card3') ?: 'Stay aware of national & international events',
    get_field('jne_intro_card4') ?: 'Improve vocabulary & communication',
];

// ── How We Teach / What We Cover ─────────────────────────────────────────────
$jne_teach_heading = get_field('jne_teach_heading') ?: 'HOW WE TEACH';
$jne_teach_item1   = get_field('jne_teach_item1')   ?: 'Story Format';
$jne_teach_item2   = get_field('jne_teach_item2')   ?: 'Real-life Examples';
$jne_teach_item3   = get_field('jne_teach_item3')   ?: '';

$jne_cover_heading = get_field('jne_cover_heading') ?: 'WHAT WE COVER';
$jne_cover_item1   = get_field('jne_cover_item1')   ?: 'The Hindu';
$jne_cover_item2   = get_field('jne_cover_item2')   ?: 'The Indian Express';
$jne_cover_item3   = get_field('jne_cover_item3')   ?: '';

// ── Daily Learning Structure ──────────────────────────────────────────────────
$jne_structure_heading = get_field('jne_structure_heading') ?: 'Daily Learning Structure';
$jne_structure_sub     = get_field('jne_structure_sub')     ?: 'Every Session Includes:';
$jne_structure_items   = [
    get_field('jne_structure_item1') ?: '5 National & International Topics',
    get_field('jne_structure_item2') ?: '3 Editorial Discussion',
    get_field('jne_structure_item3') ?: '5 New Terminologies',
    get_field('jne_structure_item4') ?: 'Quizzes (Daily / Weekly / Monthly)',
    get_field('jne_structure_item5') ?: 'Daily Notes PDF for Revision',
];

// ── Our Learning Method ───────────────────────────────────────────────────────
$jne_method_heading = get_field('jne_method_heading') ?: 'Our Learning Method';
$jne_method_sub     = get_field('jne_method_sub')     ?: 'Every session is crafted to make newspaper reading engaging, informative and fun for children.';
$jne_method_list    = [
    ['title' => get_field('jne_method1_title') ?: 'Fun & Engaging Learning',  'icon' => 'star'],
    ['title' => get_field('jne_method2_title') ?: 'Interactive Live Sessions','icon' => 'video'],
    ['title' => get_field('jne_method3_title') ?: 'Mentor Guidance',          'icon' => 'mentor'],
    ['title' => get_field('jne_method4_title') ?: 'Personal Attention',       'icon' => 'person'],
    ['title' => get_field('jne_method5_title') ?: 'Story-based Teaching',     'icon' => 'book'],
    ['title' => get_field('jne_method6_title') ?: 'Games & Challenges',       'icon' => 'game'],
];

// ── App Download ──────────────────────────────────────────────────────────────
$jne_app_heading       = get_field('jne_app_heading')       ?: 'Read, Learn & Grow — Anytime, Anywhere';
$jne_app_sub           = get_field('jne_app_subtext')       ?: 'Download our app or access the web portal to continue your child\'s news learning journey on any device.';
$jne_app_android_url   = get_field('jne_app_android_url')   ?: '#';
$jne_app_android_label = get_field('jne_app_android_label') ?: 'Google Play';
$jne_app_ios_url       = get_field('jne_app_ios_url')       ?: '#';
$jne_app_ios_label     = get_field('jne_app_ios_label')     ?: 'Web Portal';

// ── SVG icon map for method cards ─────────────────────────────────────────────
$jne_method_icons = [
    'star'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
    'video'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.87V15.13a1 1 0 01-1.447.9L15 14M3 8h12a2 2 0 012 2v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 012-2z"/></svg>',
    'mentor' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',
    'person' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    'book'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>',
    'game'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="4"/><path d="M6 12h4M8 10v4M15 12h.01M18 12h.01"/></svg>',
];

get_header();
?>

<main class="sj-page sj-page--jne">

    <!-- ══ HERO ══════════════════════════════════════════════════════════ -->
    <section class="jne-hero">
        <div class="jne-hero__shapes" aria-hidden="true">
            <span class="jne-hero__shape jne-hero__shape--1"></span>
            <span class="jne-hero__shape jne-hero__shape--2"></span>
        </div>
        <div class="sj-container">
            <div class="jne-hero__inner">

                <div class="jne-hero__content">
                    <div class="jne-hero__badge">
                        <span class="jne-hero__badge-dot"></span>
                        <?php echo esc_html($jne_hero_badge); ?>
                    </div>

                    <h1 class="jne-hero__heading">
                        <?php echo wp_kses($jne_hero_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                    </h1>
                    <p class="jne-hero__tagline"><?php echo esc_html($jne_hero_tagline); ?></p>
                    <p class="jne-hero__sub"><?php echo esc_html($jne_hero_sub); ?></p>

                    <div class="jne-hero__details">
                        <?php if ($jne_hero_detail1) : ?>
                            <span class="jne-hero__detail">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                                <?php echo esc_html($jne_hero_detail1); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($jne_hero_detail2) : ?>
                            <span class="jne-hero__detail">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                <?php echo esc_html($jne_hero_detail2); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if ($jne_steps) : ?>
                        <div class="jne-hero__steps">
                            <p class="jne-hero__steps-label">Join SkillUp Juniors in <?php echo count($jne_steps); ?> Simple Steps</p>
                            <ol class="jne-hero__steps-list">
                                <?php foreach ($jne_steps as $step) : ?>
                                    <li><?php echo esc_html($step); ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    <?php endif; ?>

                    <div class="jne-hero__actions">
                        <a href="<?php echo esc_url($jne_hero_cta1_url); ?>" class="sj-btn sj-btn--yellow"><?php echo esc_html($jne_hero_cta1_txt); ?></a>
                        <a href="<?php echo esc_url($jne_hero_cta2_url); ?>" class="sj-btn sj-btn--outline-white"><?php echo esc_html($jne_hero_cta2_txt); ?></a>
                    </div>
                </div>

                <div class="jne-hero__visual">
                    <?php if ($jne_hero_image) : ?>
                        <img src="<?php echo esc_url($jne_hero_image['url']); ?>"
                             alt="<?php echo esc_attr($jne_hero_image['alt'] ?? 'Junior News Express'); ?>"
                             class="jne-hero__img" loading="eager">
                    <?php else : ?>
                        <div class="jne-hero__img-placeholder">
                            <div class="jne-hero__newspaper" aria-hidden="true">
                                <span class="jne-np jne-np--1">NEWS</span>
                                <span class="jne-np jne-np--2">TODAY</span>
                                <span class="jne-np jne-np--3">&#128240;</span>
                            </div>
                            <p>Upload Hero Image via ACF</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ LEAD FORM ══════════════════════════════════════════════════════ -->
    <section class="jne-lead-wrap" id="jne-lead-form">
        <div class="sj-container">
            <div class="jne-lead-wrap__inner">

                <div class="jne-lead-wrap__text">
                    <h2 class="jne-lead-wrap__heading">
                        <?php echo wp_kses($jne_form_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                    </h2>
                    <p class="jne-lead-wrap__sub"><?php echo esc_html($jne_form_sub); ?></p>
                    <ul class="jne-lead-wrap__perks">
                        <?php foreach (array_filter([$jne_perk1, $jne_perk2, $jne_perk3]) as $perk) : ?>
                            <li>
                                <span class="jne-perk-icon" aria-hidden="true">&#10003;</span>
                                <?php echo esc_html($perk); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <form class="sj-form jne-form" id="jne-lead-form-el" novalidate>
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
                    <div class="sj-form__row">
                        <div class="sj-form__group sj-form__group--full">
                            <select name="program" class="sj-form__input sj-form__select">
                                <option value="">— Select Program of Interest —</option>
                                <option value="junior-news-express" selected>Junior News Express</option>
                                <option value="skill-development">Skill Development Program</option>
                                <option value="vedic-maths">Vedic Maths Program</option>
                                <option value="phonics">Phonics Program</option>
                            </select>
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

    <!-- ══ INTRODUCING JUNIORS NEWS EXPRESS ══════════════════════════════ -->
    <section class="jne-intro" id="jne-intro">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($jne_intro_heading); ?></h2>
                <p class="sj-section-sub"><?php echo esc_html($jne_intro_sub); ?></p>
            </div>
            <div class="jne-intro__grid">
                <?php foreach ($jne_intro_cards as $card) : if (!$card) continue; ?>
                    <div class="jne-intro__card">
                        <div class="jne-intro__card-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <p class="jne-intro__card-text"><?php echo esc_html($card); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ HOW WE TEACH / WHAT WE COVER ══════════════════════════════════ -->
    <section class="jne-teach-cover">
        <div class="sj-container">
            <div class="jne-teach-cover__grid">

                <div class="jne-tc-card jne-tc-card--teach">
                    <div class="jne-tc-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <h2 class="jne-tc-card__title"><?php echo esc_html($jne_teach_heading); ?></h2>
                    <ul class="jne-tc-card__list">
                        <?php foreach (array_filter([$jne_teach_item1, $jne_teach_item2, $jne_teach_item3]) as $item) : ?>
                            <li>
                                <span class="jne-tc-card__bullet" aria-hidden="true">&#10003;</span>
                                <?php echo esc_html($item); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="jne-tc-card jne-tc-card--cover">
                    <div class="jne-tc-card__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <h2 class="jne-tc-card__title"><?php echo esc_html($jne_cover_heading); ?></h2>
                    <ul class="jne-tc-card__list">
                        <?php foreach (array_filter([$jne_cover_item1, $jne_cover_item2, $jne_cover_item3]) as $item) : ?>
                            <li>
                                <span class="jne-tc-card__bullet" aria-hidden="true">&#10003;</span>
                                <?php echo esc_html($item); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ DAILY LEARNING STRUCTURE ═══════════════════════════════════════ -->
    <section class="jne-structure">
        <div class="sj-container">
            <div class="sj-section-header sj-section-header--light">
                <h2 class="sj-section-title"><?php echo esc_html($jne_structure_heading); ?></h2>
                <?php if ($jne_structure_sub) : ?>
                    <p class="sj-section-sub"><?php echo esc_html($jne_structure_sub); ?></p>
                <?php endif; ?>
            </div>
            <div class="jne-structure__grid">
                <?php foreach ($jne_structure_items as $item) : if (!$item) continue; ?>
                    <div class="jne-structure__card">
                        <div class="jne-structure__card-icon" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                        </div>
                        <p class="jne-structure__card-text"><?php echo esc_html($item); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ OUR LEARNING METHOD ════════════════════════════════════════════ -->
    <section class="jne-method">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($jne_method_heading); ?></h2>
                <?php if ($jne_method_sub) : ?>
                    <p class="sj-section-sub"><?php echo esc_html($jne_method_sub); ?></p>
                <?php endif; ?>
            </div>
            <div class="jne-method__grid">
                <?php foreach ($jne_method_list as $item) :
                    $svg = $jne_method_icons[$item['icon']] ?? $jne_method_icons['star'];
                ?>
                    <div class="jne-method__card">
                        <div class="jne-method__icon" aria-hidden="true"><?php echo $svg; ?></div>
                        <h3 class="jne-method__title"><?php echo esc_html($item['title']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ APP DOWNLOAD ══════════════════════════════════════════════════ -->
    <section class="ph-app jne-app">
        <div class="sj-container">
            <div class="ph-app__inner">
                <div class="ph-app__content">
                    <div class="ph-app__emoji" aria-hidden="true">&#128240;</div>
                    <h2 class="ph-app__heading"><?php echo esc_html($jne_app_heading); ?></h2>
                    <p class="ph-app__sub"><?php echo esc_html($jne_app_sub); ?></p>
                    <div class="ph-app__buttons">
                        <a href="<?php echo esc_url($jne_app_android_url); ?>" class="ab-app__btn ab-app__btn--android" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M6.18 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M17.82 15.64a2.18 2.18 0 01-2.18-2.18V9.72a2.18 2.18 0 014.36 0v3.74a2.18 2.18 0 01-2.18 2.18M5.24 7.73h13.52A1 1 0 0120 8.87v8.67a2.37 2.37 0 01-2.36 2.37h-.5v2.18a2.18 2.18 0 01-4.36 0v-2.18h-1.56v2.18a2.18 2.18 0 01-4.36 0v-2.18h-.5A2.37 2.37 0 012 17.54V8.87a1 1 0 011.24-1.14M14.5 5.25l1.39-2.41a.28.28 0 00-.49-.27l-1.41 2.44a8.7 8.7 0 00-3.98 0L8.6 2.57a.28.28 0 00-.49.27l1.39 2.41a8.21 8.21 0 00-4.68 6.21h13.36a8.21 8.21 0 00-3.68-6.21z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Get it on</small>
                                <strong><?php echo esc_html($jne_app_android_label); ?></strong>
                            </span>
                        </a>
                        <a href="<?php echo esc_url($jne_app_ios_url); ?>" class="ab-app__btn ab-app__btn--ios" target="_blank" rel="noopener noreferrer">
                            <span class="ab-app__btn-icon" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                            </span>
                            <span class="ab-app__btn-text">
                                <small>Access on</small>
                                <strong><?php echo esc_html($jne_app_ios_label); ?></strong>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

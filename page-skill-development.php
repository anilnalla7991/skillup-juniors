<?php
/**
 * Template Name: Skill Development
 * Page: Skill Development
 */

// ── Hero ─────────────────────────────────────────────────────────────────────
$sd_hero_badge      = get_field('sd_hero_badge')      ?: 'Junior Skill Development Program';
$sd_hero_heading    = get_field('sd_hero_heading')     ?: 'Build Confident <span>Personalities</span>';
$sd_hero_tagline    = get_field('sd_hero_tagline')     ?: '"We don\'t just teach skills. We build confident personalities."';
$sd_hero_sub        = get_field('sd_hero_subheading')  ?: 'A holistic program designed to develop communication, leadership, and life skills in children.';
$sd_stat_num        = get_field('sd_stat_number')      ?: '5,000+';
$sd_stat_label      = get_field('sd_stat_label')       ?: 'Students';

// ── Lead Form ─────────────────────────────────────────────────────────────────
$sd_form_heading    = get_field('sd_form_heading')     ?: 'Book a <span>Free Demo Class</span> Today!';
$sd_form_sub        = get_field('sd_form_subheading')  ?: 'Fill in your details and our expert trainer will contact you within 24 hours.';
$sd_form_btn_text   = get_field('sd_form_btn_text')    ?: 'Book My Free Trial Class';

// ── Program Focus ─────────────────────────────────────────────────────────────
$sd_focus_heading    = get_field('sd_focus_heading')    ?: 'A structured program focused on:';
$sd_focus_p1         = get_field('sd_focus_point1')     ?: 'Speaking';
$sd_focus_p2         = get_field('sd_focus_point2')     ?: 'Reading';
$sd_focus_p3         = get_field('sd_focus_point3')     ?: 'Listening';
$sd_focus_p4         = get_field('sd_focus_point4')     ?: 'Writing';

$sd_holistic_heading = get_field('sd_holistic_heading') ?: 'Holistic Development';
$sd_holistic_i1      = get_field('sd_holistic_item1')   ?: 'Communication Skills';
$sd_holistic_i2      = get_field('sd_holistic_item2')   ?: 'Personality Development';
$sd_holistic_i3      = get_field('sd_holistic_item3')   ?: 'Thinking Skills';
$sd_holistic_i4      = get_field('sd_holistic_item4')   ?: 'Leadership Skills';
$sd_holistic_i5      = get_field('sd_holistic_item5')   ?: 'Social Awareness';
$sd_holistic_i6      = get_field('sd_holistic_item6')   ?: 'Life Skills';

// ── Course Structure ──────────────────────────────────────────────────────────
$sd_structure_heading = get_field('sd_structure_heading') ?: 'Course Structure';
$sd_phase1_label      = get_field('sd_phase1_label')      ?: 'Startup';
$sd_phase1_duration   = get_field('sd_phase1_duration')   ?: '1 Month';
$sd_phase2_label      = get_field('sd_phase2_label')      ?: 'Foundation';
$sd_phase2_duration   = get_field('sd_phase2_duration')   ?: '5 Months';

// ── Curriculum ────────────────────────────────────────────────────────────────
$sd_curr_heading = get_field('sd_curriculum_heading') ?: 'Curriculum';
$sd_curr_cards   = [
    ['label' => get_field('sd_curr_card1_label') ?: 'Class 1-2',  'desc' => get_field('sd_curr_card1_desc') ?: 'Foundation level: basic communication, listening, and expressive speaking skills.', 'pdf' => get_field('sd_curr_card1_pdf') ?: ''],
    ['label' => get_field('sd_curr_card2_label') ?: 'Class 3-4',  'desc' => get_field('sd_curr_card2_desc') ?: 'Intermediate: reading comprehension, confidence building, and group activities.',   'pdf' => get_field('sd_curr_card2_pdf') ?: ''],
    ['label' => get_field('sd_curr_card3_label') ?: 'Class 5-6',  'desc' => get_field('sd_curr_card3_desc') ?: 'Advanced: debates, presentations, leadership exercises, and creative writing.',    'pdf' => get_field('sd_curr_card3_pdf') ?: ''],
    ['label' => get_field('sd_curr_card4_label') ?: 'Class 7-8',  'desc' => get_field('sd_curr_card4_desc') ?: 'Expert: public speaking, entrepreneurship basics, and social awareness projects.', 'pdf' => get_field('sd_curr_card4_pdf') ?: ''],
    ['label' => get_field('sd_curr_card5_label') ?: 'Class 9-10', 'desc' => get_field('sd_curr_card5_desc') ?: 'Master: life skills, personality development, and real-world skill challenges.',   'pdf' => get_field('sd_curr_card5_pdf') ?: ''],
];

// ── Learning Approach ─────────────────────────────────────────────────────────
$sd_approach_heading = get_field('sd_approach_heading') ?: 'Our Learning Approach';
$sd_approach_cards   = [
    ['title' => get_field('sd_approach1_title') ?: 'Debates',               'icon' => 'debate'],
    ['title' => get_field('sd_approach2_title') ?: 'Group Discussions',     'icon' => 'group'],
    ['title' => get_field('sd_approach3_title') ?: 'Real-life Examples',    'icon' => 'reallife'],
    ['title' => get_field('sd_approach4_title') ?: 'Innovative Activities', 'icon' => 'innovative'],
    ['title' => get_field('sd_approach5_title') ?: 'Story-based Teaching',  'icon' => 'story'],
    ['title' => get_field('sd_approach6_title') ?: 'Games & Challenges',    'icon' => 'games'],
];

// ── Real-World Exposure ───────────────────────────────────────────────────────
$sd_exposure_heading = get_field('sd_exposure_heading') ?: 'Builds Real-World Exposure';
$sd_exposure_cards   = [
    ['title' => get_field('sd_exp_card1_title') ?: 'Junior Spotlight',    'desc' => get_field('sd_exp_card1_desc') ?: 'Showcase your child\'s skills on stage and build self-confidence.'],
    ['title' => get_field('sd_exp_card2_title') ?: 'Junior Parliament',   'desc' => get_field('sd_exp_card2_desc') ?: 'Learn leadership and governance through fun role-play activities.'],
    ['title' => get_field('sd_exp_card3_title') ?: 'Junior Entrepreneur', 'desc' => get_field('sd_exp_card3_desc') ?: 'Develop business thinking and creative problem-solving skills.'],
    ['title' => get_field('sd_exp_card4_title') ?: 'Junior Storytelling', 'desc' => get_field('sd_exp_card4_desc') ?: 'Craft and present stories to build narrative and expressive abilities.'],
];

// ── Videos ───────────────────────────────────────────────────────────────────
$sd_video_heading = get_field('sd_video_heading') ?: 'Demos & Kids Videos';
$sd_videos = [
    ['url' => get_field('sd_video1_url'), 'title' => get_field('sd_video1_title') ?: 'Student Demo 1'],
    ['url' => get_field('sd_video2_url'), 'title' => get_field('sd_video2_title') ?: 'Student Demo 2'],
    ['url' => get_field('sd_video3_url'), 'title' => get_field('sd_video3_title') ?: 'Student Demo 3'],
];

// ── Testimonials ──────────────────────────────────────────────────────────────
$sd_testi_heading = get_field('sd_testi_heading') ?: 'What Parents Say';
$sd_testi_list    = [
    ['name' => get_field('sd_testi1_name') ?: 'Priya Sharma',  'text' => get_field('sd_testi1_text') ?: 'My daughter has become so confident in speaking. She participates in every school event now!',            'rating' => (int)(get_field('sd_testi1_rating') ?: 5)],
    ['name' => get_field('sd_testi2_name') ?: 'Ravi Kumar',    'text' => get_field('sd_testi2_text') ?: 'The program is wonderful. My son\'s communication and leadership skills have improved greatly.',          'rating' => (int)(get_field('sd_testi2_rating') ?: 5)],
    ['name' => get_field('sd_testi3_name') ?: 'Anitha Reddy',  'text' => get_field('sd_testi3_text') ?: 'Highly recommend! The structured curriculum and caring teachers make all the difference.',                 'rating' => (int)(get_field('sd_testi3_rating') ?: 5)],
];

// ── App Download ──────────────────────────────────────────────────────────────
$sd_app_heading       = get_field('sd_app_heading')       ?: 'Learn Anytime, Anywhere';
$sd_app_sub           = get_field('sd_app_subtext')       ?: 'Download our app or access the web portal to continue your child\'s skill journey on any device.';
$sd_app_android_url   = get_field('sd_app_android_url');
$sd_app_android_label = get_field('sd_app_android_label') ?: 'Google Play';
$sd_app_ios_url       = get_field('sd_app_ios_url');
$sd_app_ios_label     = get_field('sd_app_ios_label')     ?: 'Web Portal';

get_header();
?>

<main class="sj-page sj-page--skill-development">

    <!-- ══ HERO ══════════════════════════════════════════════════════════ -->
    <section class="sd-hero">
        <div class="sj-container">
            <div class="sd-hero__inner">

                <div class="sd-hero__text">
                    <span class="sd-hero__badge"><?php echo esc_html($sd_hero_badge); ?></span>
                    <h1 class="sd-hero__heading">
                        <?php echo wp_kses($sd_hero_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                    </h1>
                    <?php if ($sd_hero_tagline) : ?>
                        <p class="sd-hero__tagline"><?php echo esc_html($sd_hero_tagline); ?></p>
                    <?php endif; ?>
                    <p class="sd-hero__sub"><?php echo esc_html($sd_hero_sub); ?></p>
                    <div class="sd-hero__stat">
                        <span class="sd-hero__stat-num"><?php echo esc_html($sd_stat_num); ?></span>
                        <span class="sd-hero__stat-lbl"><?php echo esc_html($sd_stat_label); ?></span>
                    </div>
                </div>

                <div class="sd-hero__form-wrap" id="sd-lead-form">
                    <div class="sd-form-card">
                        <h2 class="sd-form-card__heading">
                            <?php echo wp_kses($sd_form_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                        </h2>
                        <?php if ($sd_form_sub) : ?>
                            <p class="sd-form-card__sub"><?php echo esc_html($sd_form_sub); ?></p>
                        <?php endif; ?>
                        <form class="sj-form" id="sj-lead-form-sd" novalidate>
                            <?php wp_nonce_field('sj_lead_nonce', 'sj_nonce'); ?>
                            <div class="sj-form__row">
                                <div class="sj-form__group">
                                    <input type="text" name="parent_name" placeholder="Parent's Full Name *" required class="sj-form__input">
                                </div>
                                <div class="sj-form__group">
                                    <input type="tel" name="phone" placeholder="Phone Number *" required class="sj-form__input">
                                </div>
                            </div>
                            <div class="sj-form__row">
                                <div class="sj-form__group">
                                    <input type="email" name="email" placeholder="Email Address *" required class="sj-form__input">
                                </div>
                                <div class="sj-form__group">
                                    <input type="text" name="child_age" placeholder="Child's Age / Grade *" required class="sj-form__input">
                                </div>
                            </div>
                            <div class="sj-form__row">
                                <div class="sj-form__group sj-form__group--full">
                                    <select name="program" class="sj-form__input sj-form__select">
                                        <option value="">— Select Program of Interest —</option>
                                        <option value="skill-development" selected>Skill Development Program</option>
                                        <option value="vedic-maths">Vedic Maths Program</option>
                                        <option value="phonics">Phonics Program</option>
                                        <option value="phonics-maths">Phonics + Maths Combo</option>
                                        <option value="junior-news-express">Junior News Express Program</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sj-form__actions">
                                <button type="submit" class="sj-btn sj-btn--yellow sj-form__submit" style="width:100%;">
                                    <span class="sj-btn-text"><?php echo esc_html($sd_form_btn_text); ?></span>
                                    <span class="sj-btn-spinner" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="sj-form__msg" role="alert" aria-live="polite"></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ PROGRAM FOCUS ══════════════════════════════════════════════════ -->
    <section class="sd-focus">
        <div class="sj-container">
            <div class="sd-focus__grid">

                <div class="sd-focus__col sd-focus__col--program">
                    <h2 class="sd-focus__heading"><?php echo esc_html($sd_focus_heading); ?></h2>
                    <ul class="sd-focus__list">
                        <?php foreach ([$sd_focus_p1, $sd_focus_p2, $sd_focus_p3, $sd_focus_p4] as $pt) :
                            if (!$pt) continue; ?>
                            <li><?php echo esc_html($pt); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="sd-focus__col sd-focus__col--holistic">
                    <h2 class="sd-focus__heading"><?php echo esc_html($sd_holistic_heading); ?></h2>
                    <ul class="sd-focus__list">
                        <?php foreach ([$sd_holistic_i1, $sd_holistic_i2, $sd_holistic_i3, $sd_holistic_i4, $sd_holistic_i5, $sd_holistic_i6] as $item) :
                            if (!$item) continue; ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ COURSE STRUCTURE ═══════════════════════════════════════════════ -->
    <section class="sd-structure">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($sd_structure_heading); ?></h2>
            </div>
            <div class="sd-structure__track">
                <div class="sd-structure__phase-box sd-structure__phase-box--startup">
                    <span class="sd-structure__phase-label"><?php echo esc_html($sd_phase1_label); ?></span>
                    <span class="sd-structure__phase-duration">(<?php echo esc_html($sd_phase1_duration); ?>)</span>
                </div>
                <div class="sd-structure__arrow" aria-hidden="true">
                    <svg width="48" height="20" viewBox="0 0 48 20" fill="none">
                        <path d="M0 10h42M36 3l10 7-10 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="sd-structure__phase-box sd-structure__phase-box--foundation">
                    <span class="sd-structure__phase-label"><?php echo esc_html($sd_phase2_label); ?></span>
                    <span class="sd-structure__phase-duration">(<?php echo esc_html($sd_phase2_duration); ?>)</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ CURRICULUM ════════════════════════════════════════════════════ -->
    <section class="sd-curriculum">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($sd_curr_heading); ?></h2>
            </div>
            <div class="sd-curriculum__scroll">
                <?php foreach ($sd_curr_cards as $card) : ?>
                    <div class="sd-curriculum__card">
                        <span class="sd-curriculum__label"><?php echo esc_html($card['label']); ?></span>
                        <p class="sd-curriculum__desc"><?php echo esc_html($card['desc']); ?></p>
                        <?php if (!empty($card['pdf'])) : ?>
                            <a href="<?php echo esc_url($card['pdf']); ?>" class="sd-curriculum__card-btn" download>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download Curriculum
                            </a>
                        <?php else : ?>
                            <span class="sd-curriculum__card-btn sd-curriculum__card-btn--disabled">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download Curriculum
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ LEARNING APPROACH ══════════════════════════════════════════════ -->
    <section class="sd-approach">
        <div class="sj-container">
            <div class="sj-section-header sj-section-header--light">
                <h2 class="sj-section-title"><?php echo esc_html($sd_approach_heading); ?></h2>
            </div>
            <?php
            $approach_icons = [
                'debate'     => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>',
                'group'      => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',
                'reallife'   => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>',
                'innovative' => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a7 7 0 017 7c0 3-1.8 5.6-4.4 6.8V18H9.4v-2.2C6.8 14.6 5 12 5 9a7 7 0 017-7z"/><path d="M9 22h6"/></svg>',
                'story'      => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>',
                'games'      => '<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="4"/><path d="M6 12h4M8 10v4M15 12h.01M18 12h.01"/></svg>',
            ];
            ?>
            <div class="sd-approach__grid">
                <?php foreach ($sd_approach_cards as $card) :
                    $svg = $approach_icons[$card['icon']] ?? $approach_icons['debate'];
                ?>
                    <div class="sd-approach__item">
                        <div class="sd-approach__icon"><?php echo $svg; ?></div>
                        <span class="sd-approach__label"><?php echo esc_html($card['title']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ REAL-WORLD EXPOSURE ════════════════════════════════════════════ -->
    <section class="sd-exposure">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($sd_exposure_heading); ?></h2>
            </div>
            <div class="sd-exposure__scroll">
                <?php foreach ($sd_exposure_cards as $card) : ?>
                    <div class="sd-exposure__card">
                        <h3 class="sd-exposure__card-title"><?php echo esc_html($card['title']); ?></h3>
                        <?php if ($card['desc']) : ?>
                            <p class="sd-exposure__card-desc"><?php echo esc_html($card['desc']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ DEMOS / KIDS VIDEOS ════════════════════════════════════════════ -->
    <section class="sd-videos">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($sd_video_heading); ?></h2>
            </div>
            <div class="sd-videos__grid">
                <?php foreach ($sd_videos as $v) :
                    if (!$v['url']) continue;
                    $embed_url = $v['url'];
                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $v['url'], $m)) {
                        $embed_url = 'https://www.youtube.com/embed/' . $m[1];
                    }
                ?>
                    <div class="sd-videos__item">
                        <div class="sd-videos__frame-wrap">
                            <iframe src="<?php echo esc_url($embed_url); ?>"
                                    title="<?php echo esc_attr($v['title']); ?>"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                        <p class="sd-videos__caption"><?php echo esc_html($v['title']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ TESTIMONIALS ══════════════════════════════════════════════════ -->
    <section class="sd-testimonials">
        <div class="sj-container">
            <div class="sj-section-header">
                <h2 class="sj-section-title"><?php echo esc_html($sd_testi_heading); ?></h2>
            </div>
            <div class="sd-testimonials__grid">
                <?php foreach ($sd_testi_list as $t) : ?>
                    <div class="sd-testi-card">
                        <div class="sd-testi-card__stars">
                            <?php for ($i = 0; $i < min($t['rating'], 5); $i++) : ?>
                                <span>&#9733;</span>
                            <?php endfor; ?>
                        </div>
                        <p class="sd-testi-card__text">"<?php echo esc_html($t['text']); ?>"</p>
                        <span class="sd-testi-card__name">&#8212; <?php echo esc_html($t['name']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ APP DOWNLOAD ══════════════════════════════════════════════════ -->
    <section class="sd-app">
        <div class="sj-container">
            <div class="sd-app__inner">
                <h2 class="sd-app__heading"><?php echo esc_html($sd_app_heading); ?></h2>
                <?php if ($sd_app_sub) : ?>
                    <p class="sd-app__sub"><?php echo esc_html($sd_app_sub); ?></p>
                <?php endif; ?>
                <div class="sd-app__btns">
                    <?php if ($sd_app_android_url) : ?>
                        <a href="<?php echo esc_url($sd_app_android_url); ?>" class="sd-app__btn" target="_blank" rel="noopener noreferrer">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M17.523 15.341l1.094 1.894a.228.228 0 01-.403.223l-1.107-1.916c-.89.416-1.895.65-2.957.65s-2.067-.234-2.957-.65l-1.107 1.916a.228.228 0 01-.403-.223l1.094-1.894C8.75 14.434 7.5 12.813 7.5 11h9c0 1.813-1.25 3.434-2.977 4.341zM6 11V8a6 6 0 0112 0v3H6zm10.5-4.5a.5.5 0 100-1 .5.5 0 000 1zm-9 0a.5.5 0 100-1 .5.5 0 000 1z"/>
                            </svg>
                            <?php echo esc_html($sd_app_android_label); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($sd_app_ios_url) : ?>
                        <a href="<?php echo esc_url($sd_app_ios_url); ?>" class="sd-app__btn sd-app__btn--secondary" target="_blank" rel="noopener noreferrer">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5"/>
                                <path d="M8 12h8M12 8v8"/>
                            </svg>
                            <?php echo esc_html($sd_app_ios_label); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

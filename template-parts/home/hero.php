<?php
$badge       = get_field('home_hero_badge')      ?: 'Trusted by 10,000+ Families Across India';
$heading     = get_field('home_hero_heading')    ?: 'Unlock Your Child\'s <span>True Potential</span>';
$subheading  = get_field('home_hero_subheading') ?: 'Expert-led programs in Vedic Maths, Phonics & Skill Development — designed to make every child a confident learner.';
$cta1_text   = get_field('home_hero_cta1_text')  ?: 'Book Free Demo';
$cta1_url    = get_field('home_hero_cta1_url')   ?: '#lead-form';
$cta2_text   = get_field('home_hero_cta2_text')  ?: 'Explore Programs';
$cta2_url    = get_field('home_hero_cta2_url')   ?: '#courses';
$hero_image  = get_field('home_hero_image');

$stat1_num   = get_field('home_hero_stat1_num')   ?: '10K+';
$stat1_label = get_field('home_hero_stat1_label') ?: 'Students Enrolled';
$stat2_num   = get_field('home_hero_stat2_num')   ?: '50+';
$stat2_label = get_field('home_hero_stat2_label') ?: 'Expert Trainers';
$stat3_num   = get_field('home_hero_stat3_num')   ?: '15+';
$stat3_label = get_field('home_hero_stat3_label') ?: 'Cities Covered';
?>

<section class="sj-hero" id="hero">
    <div class="sj-hero__shapes" aria-hidden="true">
        <span class="sj-hero__shape sj-hero__shape--1"></span>
        <span class="sj-hero__shape sj-hero__shape--2"></span>
        <span class="sj-hero__shape sj-hero__shape--3"></span>
    </div>

    <div class="sj-container">
        <div class="sj-hero__inner">

            <div class="sj-hero__content">
                <?php if ($badge) : ?>
                    <div class="sj-hero__badge">
                        <span class="sj-hero__badge-dot"></span>
                        <?php echo esc_html($badge); ?>
                    </div>
                <?php endif; ?>

                <h1 class="sj-hero__heading">
                    <?php echo wp_kses($heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                </h1>

                <p class="sj-hero__sub"><?php echo esc_html($subheading); ?></p>

                <div class="sj-hero__actions">
                    <a href="<?php echo esc_url($cta1_url); ?>" class="sj-btn sj-btn--yellow">
                        <?php echo esc_html($cta1_text); ?>
                    </a>
                    <a href="<?php echo esc_url($cta2_url); ?>" class="sj-btn sj-btn--outline-white">
                        <?php echo esc_html($cta2_text); ?>
                    </a>
                </div>

                <div class="sj-hero__stats">
                    <div class="sj-hero__stat">
                        <strong><?php echo esc_html($stat1_num); ?></strong>
                        <span><?php echo esc_html($stat1_label); ?></span>
                    </div>
                    <div class="sj-hero__stat-divider" aria-hidden="true"></div>
                    <div class="sj-hero__stat">
                        <strong><?php echo esc_html($stat2_num); ?></strong>
                        <span><?php echo esc_html($stat2_label); ?></span>
                    </div>
                    <div class="sj-hero__stat-divider" aria-hidden="true"></div>
                    <div class="sj-hero__stat">
                        <strong><?php echo esc_html($stat3_num); ?></strong>
                        <span><?php echo esc_html($stat3_label); ?></span>
                    </div>
                </div>
            </div>

            <div class="sj-hero__visual">
                <?php if ($hero_image) : ?>
                    <img
                        src="<?php echo esc_url($hero_image['url']); ?>"
                        alt="<?php echo esc_attr($hero_image['alt']); ?>"
                        class="sj-hero__img"
                        loading="eager"
                    >
                <?php else : ?>
                    <div class="sj-hero__img-placeholder">
                        <span>Upload Hero Image<br>via ACF</span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

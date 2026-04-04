<?php
$mission_heading = get_field('home_mission_heading') ?: 'Our Mission & Vision';
$mission_content = get_field('home_mission_content') ?: 'To empower every child with life-transforming skills — bridging the gap between traditional knowledge and modern learning for a brighter, more confident generation.';
$mission_icon    = get_field('home_mission_icon');

$about_heading       = get_field('home_about_heading')         ?: "Director's Message";
$about_content       = get_field('home_about_content')         ?: 'At SkillUp Juniors, we believe that every child is born with extraordinary potential. Our mission is to unlock that potential through our uniquely crafted programs that blend ancient wisdom with modern pedagogy.';
$director_name       = get_field('home_about_director_name')   ?: 'Founder & Director';
$director_role       = get_field('home_about_director_role')   ?: 'SkillUp Juniors';
$director_image      = get_field('home_about_director_image');
?>

<section class="sj-mission-about" id="mission-about">
    <div class="sj-container">

        <div class="sj-mission-about__grid">

            <!-- Mission / Vision Card -->
            <div class="sj-card sj-card--mission">
                <div class="sj-card__accent sj-card__accent--blue"></div>
                <div class="sj-card__body">
                    <?php if ($mission_icon) : ?>
                        <div class="sj-card__icon">
                            <img src="<?php echo esc_url($mission_icon['url']); ?>" alt="<?php echo esc_attr($mission_icon['alt']); ?>">
                        </div>
                    <?php else : ?>
                        <div class="sj-card__icon sj-card__icon--default" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="22" stroke="currentColor" stroke-width="2.5"/>
                                <path d="M24 12v12l8 4" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <h2 class="sj-card__heading"><?php echo esc_html($mission_heading); ?></h2>
                    <div class="sj-card__content">
                        <?php echo wp_kses_post($mission_content); ?>
                    </div>
                    <div class="sj-mission__pillars">
                        <span class="sj-pillar">Innovation</span>
                        <span class="sj-pillar">Excellence</span>
                        <span class="sj-pillar">Empowerment</span>
                    </div>
                </div>
            </div>

            <!-- About / Director's Message Card -->
            <div class="sj-card sj-card--about">
                <div class="sj-card__accent sj-card__accent--green"></div>
                <div class="sj-card__body">
                    <h2 class="sj-card__heading"><?php echo esc_html($about_heading); ?></h2>
                    <div class="sj-card__content sj-card__content--quote">
                        <span class="sj-quote-mark" aria-hidden="true">&ldquo;</span>
                        <?php echo wp_kses_post($about_content); ?>
                    </div>
                    <div class="sj-director">
                        <?php if ($director_image) : ?>
                            <img
                                src="<?php echo esc_url($director_image['url']); ?>"
                                alt="<?php echo esc_attr($director_image['alt']); ?>"
                                class="sj-director__img"
                            >
                        <?php else : ?>
                            <div class="sj-director__img sj-director__img--placeholder" aria-label="Director Photo"></div>
                        <?php endif; ?>
                        <div class="sj-director__info">
                            <strong><?php echo esc_html($director_name); ?></strong>
                            <span><?php echo esc_html($director_role); ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

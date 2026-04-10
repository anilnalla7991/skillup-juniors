<?php
$heading    = get_field('home_courses_heading')    ?: 'Our Programs';
$subheading = get_field('home_courses_subheading') ?: 'Expertly designed programs that build real skills, boost confidence, and prepare your child for the future.';

$color_map = [
    'blue'   => ['bg' => '#E8F6FD', 'accent' => '#29ABE2'],
    'green'  => ['bg' => '#E8F7F0', 'accent' => '#2BB673'],
    'yellow' => ['bg' => '#FEF6E4', 'accent' => '#F7A800'],
    'teal'   => ['bg' => '#E4F8FB', 'accent' => '#00BCD4'],
    'navy'   => ['bg' => '#E8EBFF', 'accent' => '#1B2B6B'],
];

$courses = [
    [
        'title' => get_field('home_c1_title') ?: 'Skill Development Program',
        'desc'  => get_field('home_c1_desc')  ?: 'Build essential 21st-century skills including leadership, communication, and creative thinking for holistic growth.',
        'link'  => get_field('home_c1_link')  ?: home_url('/skill-development'),
        'color' => get_field('home_c1_color') ?: 'green',
        'icon'  => get_field('home_c1_icon'),
    ],
    [
        'title' => get_field('home_c2_title') ?: 'Vedic Maths Program',
        'desc'  => get_field('home_c2_desc')  ?: 'Master lightning-fast mental maths using ancient Vedic techniques. Solve complex calculations in seconds.',
        'link'  => get_field('home_c2_link')  ?: home_url('/vedic-maths'),
        'color' => get_field('home_c2_color') ?: 'blue',
        'icon'  => get_field('home_c2_icon'),
    ],
    [
        'title' => get_field('home_c3_title') ?: 'Phonics + Maths Program',
        'desc'  => get_field('home_c3_desc')  ?: 'A powerful combination of phonics-based reading and maths skills for complete academic excellence.',
        'link'  => get_field('home_c3_link')  ?: home_url('/phonics'),
        'color' => get_field('home_c3_color') ?: 'yellow',
        'icon'  => get_field('home_c3_icon'),
    ],
    [
        'title' => get_field('home_c4_title') ?: 'Junior News Express',
        'desc'  => get_field('home_c4_desc')  ?: 'A fun, engaging newspaper program that builds reading comprehension, vocabulary, and current affairs awareness in young learners.',
        'link'  => get_field('home_c4_link')  ?: home_url('/junior-news-express'),
        'color' => get_field('home_c4_color') ?: 'teal',
        'icon'  => get_field('home_c4_icon'),
    ],
];
?>

<section class="sj-courses" id="courses">
    <div class="sj-container">

        <div class="sj-section-header">
            <h2 class="sj-section-title"><?php echo esc_html($heading); ?></h2>
            <p class="sj-section-sub"><?php echo esc_html($subheading); ?></p>
        </div>

        <div class="sj-courses__grid">
            <?php foreach ($courses as $index => $course) :
                $clr = $color_map[$course['color']] ?? $color_map['blue'];
            ?>
                <div class="sj-course-card" style="--card-accent: <?php echo esc_attr($clr['accent']); ?>; --card-bg: <?php echo esc_attr($clr['bg']); ?>">
                    <div class="sj-course-card__top">
                        <div class="sj-course-card__icon-wrap">
                            <?php if ($course['icon']) : ?>
                                <img src="<?php echo esc_url($course['icon']['url']); ?>" alt="<?php echo esc_attr($course['icon']['alt']); ?>">
                            <?php else : ?>
                                <span class="sj-course-card__icon-num"><?php echo sprintf('%02d', $index + 1); ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="sj-course-card__badge"><?php echo esc_html(ucfirst($course['color'])); ?> Track</span>
                    </div>
                    <h3 class="sj-course-card__title"><?php echo esc_html($course['title']); ?></h3>
                    <p class="sj-course-card__desc"><?php echo esc_html($course['desc']); ?></p>
                    <a href="<?php echo esc_url($course['link']); ?>" class="sj-course-card__cta">
                        Explore Program
                        <span aria-hidden="true">&#8594;</span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

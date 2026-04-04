<?php
$heading    = get_field('home_courses_heading')    ?: 'Our Programs';
$subheading = get_field('home_courses_subheading') ?: 'Expertly designed programs that build real skills, boost confidence, and prepare your child for the future.';
$courses    = get_field('home_courses_list');

$color_map = [
    'blue'   => ['bg' => '#E8F6FD', 'accent' => '#29ABE2'],
    'green'  => ['bg' => '#E8F7F0', 'accent' => '#2BB673'],
    'yellow' => ['bg' => '#FEF6E4', 'accent' => '#F7A800'],
    'teal'   => ['bg' => '#E4F8FB', 'accent' => '#00BCD4'],
    'navy'   => ['bg' => '#E8EBFF', 'accent' => '#1B2B6B'],
];

$default_courses = [
    ['title' => 'Skill Development Program', 'description' => 'Build essential 21st-century skills including leadership, communication, and creative thinking for holistic growth.', 'color' => 'green',  'link' => '#'],
    ['title' => 'Vedic Maths Program',        'description' => 'Master lightning-fast mental maths using ancient Vedic techniques. Solve complex calculations in seconds.',           'color' => 'blue',   'link' => '#'],
    ['title' => 'Phonics + Maths Program',    'description' => 'A powerful combination of phonics-based reading and maths skills for complete academic excellence.',                'color' => 'yellow', 'link' => '#'],
];
?>

<section class="sj-courses" id="courses">
    <div class="sj-container">

        <div class="sj-section-header">
            <h2 class="sj-section-title"><?php echo esc_html($heading); ?></h2>
            <p class="sj-section-sub"><?php echo esc_html($subheading); ?></p>
        </div>

        <div class="sj-courses__grid">
            <?php
            $items = ($courses && count($courses)) ? $courses : $default_courses;
            foreach ($items as $index => $course) :
                $title = isset($course['course_title']) ? $course['course_title'] : ($course['title'] ?? '');
                $desc  = isset($course['course_description']) ? $course['course_description'] : ($course['description'] ?? '');
                $link  = isset($course['course_link']) ? $course['course_link'] : ($course['link'] ?? '#');
                $color = isset($course['course_color']) ? $course['course_color'] : ($course['color'] ?? 'blue');
                $icon  = isset($course['course_icon']) ? $course['course_icon'] : null;
                $clr   = $color_map[$color] ?? $color_map['blue'];
            ?>
                <div class="sj-course-card" style="--card-accent: <?php echo esc_attr($clr['accent']); ?>; --card-bg: <?php echo esc_attr($clr['bg']); ?>">
                    <div class="sj-course-card__top">
                        <div class="sj-course-card__icon-wrap">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                            <?php else : ?>
                                <span class="sj-course-card__icon-num"><?php echo sprintf('%02d', $index + 1); ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="sj-course-card__badge"><?php echo esc_html(ucfirst($color)); ?> Track</span>
                    </div>
                    <h3 class="sj-course-card__title"><?php echo esc_html($title); ?></h3>
                    <p class="sj-course-card__desc"><?php echo esc_html($desc); ?></p>
                    <a href="<?php echo esc_url($link); ?>" class="sj-course-card__cta">
                        Explore Program
                        <span aria-hidden="true">&#8594;</span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

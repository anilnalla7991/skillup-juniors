<?php
$heading    = get_field('home_approach_heading')    ?: 'Our Learning Approach';
$subheading = get_field('home_approach_subheading') ?: 'A proven, child-centric methodology that makes learning fun, effective, and long-lasting.';
$steps      = get_field('home_approach_steps');

$default_steps = [
    ['step_title' => 'Assess',      'step_description' => 'We evaluate each child\'s current level, learning style, and strengths to create a personalised path.'],
    ['step_title' => 'Design',      'step_description' => 'Tailor-made curriculum crafted by experts, aligned to the child\'s needs and learning goals.'],
    ['step_title' => 'Engage',      'step_description' => 'Interactive, activity-based sessions that make concepts stick through real-life application.'],
    ['step_title' => 'Track',       'step_description' => 'Regular assessments and progress reports keep parents updated at every milestone.'],
    ['step_title' => 'Transform',   'step_description' => 'Children graduate with enhanced confidence, skills, and academic performance.'],
];

$items = ($steps && count($steps)) ? $steps : $default_steps;
?>

<section class="sj-approach" id="approach">
    <div class="sj-container">

        <div class="sj-section-header sj-section-header--light">
            <h2 class="sj-section-title"><?php echo esc_html($heading); ?></h2>
            <p class="sj-section-sub"><?php echo esc_html($subheading); ?></p>
        </div>

        <div class="sj-approach__steps">
            <?php foreach ($items as $i => $step) :
                $num   = $i + 1;
                $title = $step['step_title']       ?? '';
                $desc  = $step['step_description'] ?? '';
                $icon  = $step['step_icon']        ?? null;
            ?>
                <div class="sj-approach__step">
                    <div class="sj-approach__step-num">
                        <?php if ($icon) : ?>
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>">
                        <?php else : ?>
                            <span><?php echo sprintf('%02d', $num); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($i < count($items) - 1) : ?>
                        <div class="sj-approach__connector" aria-hidden="true"></div>
                    <?php endif; ?>
                    <h3 class="sj-approach__step-title"><?php echo esc_html($title); ?></h3>
                    <p class="sj-approach__step-desc"><?php echo esc_html($desc); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

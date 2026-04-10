<?php
$heading    = get_field('home_approach_heading')    ?: 'Our Learning Approach';
$subheading = get_field('home_approach_subheading') ?: '';
$steps      = get_field('home_approach_steps');

$default_steps = [
    [
        'step_title'       => 'Fun &amp; Engaging Learning',
        'step_description' => '',
        'step_icon'        => null,
        '_default_icon'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
    ],
    [
        'step_title'       => 'Interactive Live Sessions',
        'step_description' => '',
        'step_icon'        => null,
        '_default_icon'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><polyline points="8 21 12 17 16 21"/><line x1="2" y1="17" x2="22" y2="17"/></svg>',
    ],
    [
        'step_title'       => 'Regular Work Sheets',
        'step_description' => '',
        'step_icon'        => null,
        '_default_icon'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
    ],
    [
        'step_title'       => 'Personal Attention',
        'step_description' => '',
        'step_icon'        => null,
        '_default_icon'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    ],
    [
        'step_title'       => 'Practice with Fun Challenges',
        'step_description' => '',
        'step_icon'        => null,
        '_default_icon'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"/><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"/><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"/><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"/><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"/><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"/><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"/></svg>',
    ],
    [
        'step_title'       => 'Step-by-Step Concept Clarity',
        'step_description' => '',
        'step_icon'        => null,
        '_default_icon'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg>',
    ],
];

$items = ($steps && count($steps)) ? $steps : $default_steps;
?>

<section class="sj-approach" id="approach">
    <div class="sj-container">

        <div class="sj-section-header sj-section-header--light">
            <h2 class="sj-section-title"><?php echo esc_html($heading); ?></h2>
            <?php if ($subheading) : ?>
                <p class="sj-section-sub"><?php echo esc_html($subheading); ?></p>
            <?php endif; ?>
        </div>

        <div class="sj-approach__grid">
            <?php foreach ($items as $step) :
                $title        = $step['step_title']       ?? '';
                $desc         = $step['step_description'] ?? '';
                $icon         = $step['step_icon']        ?? null;
                $default_icon = $step['_default_icon']    ?? null;
            ?>
                <div class="sj-approach__card">
                    <div class="sj-approach__card-icon">
                        <?php if ($icon) : ?>
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>">
                        <?php elseif ($default_icon) : ?>
                            <?php echo $default_icon; ?>
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="sj-approach__card-title"><?php echo esc_html($title); ?></h3>
                    <?php if ($desc) : ?>
                        <p class="sj-approach__card-desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

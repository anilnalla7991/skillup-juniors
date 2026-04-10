<?php
$heading    = get_field('home_approach_heading')    ?: 'Our Learning Approach';
$subheading = get_field('home_approach_subheading') ?: '';

$default_icons = [
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><polyline points="8 21 12 17 16 21"/><line x1="2" y1="17" x2="22" y2="17"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
];

$items = [
    ['title' => get_field('home_ap1_title') ?: 'Fun &amp; Engaging Learning',      'icon' => get_field('home_ap1_icon')],
    ['title' => get_field('home_ap2_title') ?: 'Interactive Live Sessions',        'icon' => get_field('home_ap2_icon')],
    ['title' => get_field('home_ap3_title') ?: 'Regular Work Sheets',              'icon' => get_field('home_ap3_icon')],
    ['title' => get_field('home_ap4_title') ?: 'Personal Attention',               'icon' => get_field('home_ap4_icon')],
    ['title' => get_field('home_ap5_title') ?: 'Practice with Fun Challenges',     'icon' => get_field('home_ap5_icon')],
    ['title' => get_field('home_ap6_title') ?: 'Step-by-Step Concept Clarity',     'icon' => get_field('home_ap6_icon')],
];
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
            <?php foreach ($items as $i => $item) :
                $icon = $item['icon'];
            ?>
                <div class="sj-approach__card">
                    <div class="sj-approach__card-icon">
                        <?php if ($icon) : ?>
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>">
                        <?php else : ?>
                            <?php echo $default_icons[$i] ?? $default_icons[0]; ?>
                        <?php endif; ?>
                    </div>
                    <h3 class="sj-approach__card-title"><?php echo esc_html($item['title']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

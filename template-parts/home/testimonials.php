<?php
$heading    = get_field('home_testimonials_heading')    ?: 'What Parents Say';
$subheading = get_field('home_testimonials_subheading') ?: 'Real stories from families who have seen the SkillUp Juniors difference.';
$items      = get_field('home_testimonials_list');

$default_items = [
    ['testimonial_name' => 'Priya Sharma',   'testimonial_role' => 'Parent of Arjun, Age 9',   'testimonial_rating' => 5, 'testimonial_content' => 'My son was struggling with maths but after just 3 months of Vedic Maths, he is solving problems mentally in seconds. Highly recommend SkillUp Juniors!'],
    ['testimonial_name' => 'Rahul Mehta',    'testimonial_role' => 'Parent of Ananya, Age 7',  'testimonial_rating' => 5, 'testimonial_content' => 'The phonics program has made such a huge difference to my daughter\'s reading. She now reads confidently and even helps her friends. Amazing trainers!'],
    ['testimonial_name' => 'Sunita Reddy',   'testimonial_role' => 'Parent of Karthik, Age 11','testimonial_rating' => 5, 'testimonial_content' => 'The skill development program gave my child the confidence to speak in public and lead his school team. The curriculum is simply outstanding.'],
];

$testimonials = ($items && count($items)) ? $items : $default_items;
?>

<section class="sj-testimonials" id="testimonials">
    <div class="sj-container">

        <div class="sj-section-header">
            <h2 class="sj-section-title"><?php echo esc_html($heading); ?></h2>
            <p class="sj-section-sub"><?php echo esc_html($subheading); ?></p>
        </div>

        <div class="sj-testimonials__grid">
            <?php foreach ($testimonials as $t) :
                $name    = $t['testimonial_name']    ?? '';
                $role    = $t['testimonial_role']    ?? '';
                $rating  = (int)($t['testimonial_rating'] ?? 5);
                $content = $t['testimonial_content'] ?? '';
                $image   = $t['testimonial_image']   ?? null;
            ?>
                <div class="sj-testimonial-card">
                    <div class="sj-testimonial-card__stars" aria-label="Rating: <?php echo esc_attr($rating); ?> out of 5">
                        <?php for ($s = 1; $s <= 5; $s++) : ?>
                            <span class="sj-star<?php echo $s <= $rating ? ' sj-star--filled' : ''; ?>" aria-hidden="true">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p class="sj-testimonial-card__content">&ldquo;<?php echo esc_html($content); ?>&rdquo;</p>
                    <div class="sj-testimonial-card__author">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="sj-testimonial-card__avatar">
                        <?php else : ?>
                            <div class="sj-testimonial-card__avatar sj-testimonial-card__avatar--placeholder">
                                <span><?php echo esc_html(mb_substr($name, 0, 1)); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="sj-testimonial-card__meta">
                            <strong><?php echo esc_html($name); ?></strong>
                            <span><?php echo esc_html($role); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

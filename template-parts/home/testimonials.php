<?php
$heading    = get_field('home_testimonials_heading')    ?: 'What Parents Say';
$subheading = get_field('home_testimonials_subheading') ?: 'Real stories from families who have seen the SkillUp Juniors difference.';

$testimonials = [
    [
        'name'    => get_field('home_t1_name')    ?: 'Priya Sharma',
        'role'    => get_field('home_t1_role')    ?: 'Parent of Arjun, Age 9',
        'content' => get_field('home_t1_content') ?: 'My son was struggling with maths but after just 3 months of Vedic Maths, he is solving problems mentally in seconds. Highly recommend SkillUp Juniors!',
        'rating'  => (int)(get_field('home_t1_rating') ?: 5),
        'image'   => get_field('home_t1_image'),
    ],
    [
        'name'    => get_field('home_t2_name')    ?: 'Rahul Mehta',
        'role'    => get_field('home_t2_role')    ?: 'Parent of Ananya, Age 7',
        'content' => get_field('home_t2_content') ?: "The phonics program has made such a huge difference to my daughter's reading. She now reads confidently and even helps her friends. Amazing trainers!",
        'rating'  => (int)(get_field('home_t2_rating') ?: 5),
        'image'   => get_field('home_t2_image'),
    ],
    [
        'name'    => get_field('home_t3_name')    ?: 'Sunita Reddy',
        'role'    => get_field('home_t3_role')    ?: 'Parent of Karthik, Age 11',
        'content' => get_field('home_t3_content') ?: 'The skill development program gave my child the confidence to speak in public and lead his school team. The curriculum is simply outstanding.',
        'rating'  => (int)(get_field('home_t3_rating') ?: 5),
        'image'   => get_field('home_t3_image'),
    ],
];
?>

<section class="sj-testimonials" id="testimonials">
    <div class="sj-container">

        <div class="sj-section-header">
            <h2 class="sj-section-title"><?php echo esc_html($heading); ?></h2>
            <p class="sj-section-sub"><?php echo esc_html($subheading); ?></p>
        </div>

        <div class="sj-testimonials__grid">
            <?php foreach ($testimonials as $t) : ?>
                <div class="sj-testimonial-card">
                    <div class="sj-testimonial-card__stars" aria-label="Rating: <?php echo esc_attr($t['rating']); ?> out of 5">
                        <?php for ($s = 1; $s <= 5; $s++) : ?>
                            <span class="sj-star<?php echo $s <= $t['rating'] ? ' sj-star--filled' : ''; ?>" aria-hidden="true">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p class="sj-testimonial-card__content">&ldquo;<?php echo esc_html($t['content']); ?>&rdquo;</p>
                    <div class="sj-testimonial-card__author">
                        <?php if ($t['image']) : ?>
                            <img src="<?php echo esc_url($t['image']['url']); ?>" alt="<?php echo esc_attr($t['image']['alt']); ?>" class="sj-testimonial-card__avatar">
                        <?php else : ?>
                            <div class="sj-testimonial-card__avatar sj-testimonial-card__avatar--placeholder">
                                <span><?php echo esc_html(mb_substr($t['name'], 0, 1)); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="sj-testimonial-card__meta">
                            <strong><?php echo esc_html($t['name']); ?></strong>
                            <span><?php echo esc_html($t['role']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

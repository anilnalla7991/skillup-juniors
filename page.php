<?php
/**
 * Default Page Template
 */
get_header();
?>

<main class="sj-page">
    <div class="sj-container">
        <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>

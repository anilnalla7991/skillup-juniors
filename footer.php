<?php
$tagline   = get_option('sj_footer_tagline',   'Transforming young minds through expert education.');
$address   = get_option('sj_footer_address',   'India');
$phone     = get_option('sj_footer_phone',     '+91 00000 00000');
$email     = get_option('sj_footer_email',     'hello@skillupjuniors.com');
$copyright = get_option('sj_footer_copyright', '&copy; ' . date('Y') . ' SkillUp Juniors. All Rights Reserved.');
$socials   = null; // Add social links via Theme Settings when needed
?>

<footer class="sj-footer" aria-label="Site Footer">
    <div class="sj-container">
        <div class="sj-footer__grid">

            <!-- Col 1: Brand -->
            <div class="sj-footer__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="sj-footer__logo">
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/skill up junior's Small.png"
                        alt="<?php bloginfo('name'); ?>"
                    >
                </a>
                <p class="sj-footer__tagline"><?php echo esc_html($tagline); ?></p>
                <?php if ($socials) : ?>
                    <div class="sj-footer__socials">
                        <?php foreach ($socials as $s) : ?>
                            <a href="<?php echo esc_url($s['social_url']); ?>" class="sj-footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($s['social_platform']); ?>">
                                <?php echo esc_html($s['social_platform']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="sj-footer__col">
                <h3 class="sj-footer__col-title">Quick Links</h3>
                <ul class="sj-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
                    <li><a href="#lead-form">Book Free Demo</a></li>
                </ul>
            </div>

            <!-- Col 3: Programs -->
            <div class="sj-footer__col">
                <h3 class="sj-footer__col-title">Programs</h3>
                <ul class="sj-footer__links">
                    <li><a href="<?php echo esc_url(home_url('/vedic-maths')); ?>">Vedic Maths</a></li>
                    <li><a href="<?php echo esc_url(home_url('/phonics')); ?>">Phonics Program</a></li>
                    <li><a href="<?php echo esc_url(home_url('/skill-development')); ?>">Skill Development</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact -->
            <div class="sj-footer__col">
                <h3 class="sj-footer__col-title">Get In Touch</h3>
                <ul class="sj-footer__contact">
                    <?php if ($address) : ?>
                        <li>
                            <span class="sj-footer__contact-icon" aria-hidden="true">&#128205;</span>
                            <?php echo nl2br(esc_html($address)); ?>
                        </li>
                    <?php endif; ?>
                    <?php if ($phone) : ?>
                        <li>
                            <span class="sj-footer__contact-icon" aria-hidden="true">&#128222;</span>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                        <li>
                            <span class="sj-footer__contact-icon" aria-hidden="true">&#9993;</span>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div><!-- /.sj-footer__grid -->
    </div><!-- /.sj-container -->

    <div class="sj-footer__bar">
        <div class="sj-container">
            <p><?php echo wp_kses_post($copyright); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

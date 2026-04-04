<?php
$tagline   = get_option('sj_footer_tagline',   'Transforming young minds through expert education.');
$address   = get_option('sj_footer_address',   'India');
$phone     = get_option('sj_footer_phone',     '+91 00000 00000');
$email     = get_option('sj_footer_email',     'hello@skillupjuniors.com');
$copyright = get_option('sj_footer_copyright', '&copy; ' . date('Y') . ' SkillUp Juniors. All Rights Reserved.');
?>

<footer class="sj-footer" aria-label="Site Footer">

    <div class="sj-footer__top">
        <div class="sj-container">
            <div class="sj-footer__grid">

                <!-- Col 1: Brand + Powered By -->
                <div class="sj-footer__brand">

                    <a href="<?php echo esc_url(home_url('/')); ?>" class="sj-footer__logo-link">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/skill up junior's Small.png"
                            alt="<?php bloginfo('name'); ?>"
                            class="sj-footer__logo"
                        >
                    </a>

                    <p class="sj-footer__tagline"><?php echo esc_html($tagline); ?></p>

                    <!-- Social Icons -->
                    <div class="sj-footer__socials">
                        <a href="#" class="sj-footer__social" aria-label="Facebook" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                        <a href="#" class="sj-footer__social" aria-label="Instagram" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                        </a>
                        <a href="#" class="sj-footer__social" aria-label="YouTube" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
                        </a>
                        <a href="#" class="sj-footer__social" aria-label="WhatsApp" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                    </div>

                    <!-- Powered By ThinkBuild -->
                    <div class="sj-footer__powered">
                        <span class="sj-footer__powered-label">Powered by</span>
                        <div class="sj-footer__powered-logo">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/THINK BUILD logo (1).png"
                                alt="ThinkBuild Education Private Limited"
                            >
                        </div>
                        <span class="sj-footer__powered-text">ThinkBuild Education Private Limited</span>
                    </div>

                </div>

                <!-- Col 2: Quick Links -->
                <div class="sj-footer__col">
                    <h3 class="sj-footer__col-title">
                        <span>Quick Links</span>
                    </h3>
                    <ul class="sj-footer__links">
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        </li>
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a>
                        </li>
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a>
                        </li>
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="#lead-form">Book Free Demo</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Programs -->
                <div class="sj-footer__col">
                    <h3 class="sj-footer__col-title">
                        <span>Our Programs</span>
                    </h3>
                    <ul class="sj-footer__links">
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="<?php echo esc_url(home_url('/vedic-maths')); ?>">Vedic Maths Program</a>
                        </li>
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="<?php echo esc_url(home_url('/phonics')); ?>">Phonics Program</a>
                        </li>
                        <li>
                            <svg viewBox="0 0 6 10" fill="none"><path d="M1 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <a href="<?php echo esc_url(home_url('/skill-development')); ?>">Skill Development</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div class="sj-footer__col">
                    <h3 class="sj-footer__col-title">
                        <span>Get In Touch</span>
                    </h3>
                    <ul class="sj-footer__contact">
                        <?php if ($address) : ?>
                        <li>
                            <span class="sj-contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <span><?php echo nl2br(esc_html($address)); ?></span>
                        </li>
                        <?php endif; ?>
                        <?php if ($phone) : ?>
                        <li>
                            <span class="sj-contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.95 13a19.79 19.79 0 01-3.07-8.67A2 2 0 012.88 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                            </span>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if ($email) : ?>
                        <li>
                            <span class="sj-contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div><!-- /.sj-footer__grid -->
        </div>
    </div><!-- /.sj-footer__top -->

    <!-- Bottom Bar -->
    <div class="sj-footer__bar">
        <div class="sj-container">
            <div class="sj-footer__bar-inner">
                <p><?php echo wp_kses_post($copyright); ?></p>
                <p class="sj-footer__bar-right">
                    Designed &amp; Developed with <span class="sj-heart">&#10084;</span> for SkillUp Juniors
                </p>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>

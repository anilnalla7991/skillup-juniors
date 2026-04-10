<?php
/**
 * Template Name: Contact Us
 * Page: Contact Us
 */

// ── Hero ───────────────────────────────────────────────────────────────────
$ct_hero_heading = get_field('contact_hero_heading') ?: 'Get in Touch <span>With Us</span>';
$ct_hero_sub     = get_field('contact_hero_sub')     ?: 'Have a question or want to book a free demo? We\'d love to hear from you. Fill in the form and our team will reach out within 24 hours.';

// ── Form ───────────────────────────────────────────────────────────────────
$ct_form_heading = get_field('contact_form_heading') ?: 'Book a <span>Free Demo Class</span> Today!';
$ct_form_sub     = get_field('contact_form_sub')     ?: 'Fill in your details and our expert trainer will contact you within 24 hours.';

// ── Contact Details ────────────────────────────────────────────────────────
$ct_phone     = get_field('contact_phone')     ?: '+91 00000 00000';
$ct_whatsapp  = get_field('contact_whatsapp')  ?: '+91 00000 00000';
$ct_email     = get_field('contact_email')     ?: 'hello@skillupjuniors.com';
$ct_address   = get_field('contact_address')   ?: 'SkillUp Juniors, India';
$ct_hours     = get_field('contact_hours')     ?: 'Mon – Sat: 9:00 AM – 7:00 PM';
$ct_map_url   = get_field('contact_map_url')   ?: '';

// ── Social Links ───────────────────────────────────────────────────────────
$ct_facebook  = get_field('contact_facebook_url')  ?: '#';
$ct_instagram = get_field('contact_instagram_url') ?: '#';
$ct_youtube   = get_field('contact_youtube_url')   ?: '#';
$ct_twitter   = get_field('contact_twitter_url')   ?: '#';

// ── Why Contact Reasons (3 fixed) ─────────────────────────────────────────
$ct_reason1 = get_field('contact_reason1_text') ?: 'Free demo — no commitment needed';
$ct_reason2 = get_field('contact_reason2_text') ?: 'Response within 24 hours guaranteed';
$ct_reason3 = get_field('contact_reason3_text') ?: 'Expert guidance for your child\'s learning';

// ── FAQ (3 fixed Q&A pairs) ───────────────────────────────────────────────
$ct_faq1_q = get_field('contact_faq1_q') ?: 'Is the demo class really free?';
$ct_faq1_a = get_field('contact_faq1_a') ?: 'Yes! Our demo class is 100% free with zero commitment. You can decide after experiencing the class.';
$ct_faq2_q = get_field('contact_faq2_q') ?: 'Which age group is eligible?';
$ct_faq2_a = get_field('contact_faq2_a') ?: 'Our programs are designed for children from Class 1 to Class 10 across all our courses.';
$ct_faq3_q = get_field('contact_faq3_q') ?: 'Are classes online or offline?';
$ct_faq3_a = get_field('contact_faq3_a') ?: 'We offer both live online sessions and in-person classes depending on your location and preference.';
$ct_faq4_q = get_field('contact_faq4_q') ?: 'How soon will I hear back after filling the form?';
$ct_faq4_a = get_field('contact_faq4_a') ?: 'Our team will contact you within 24 hours on your phone or email to schedule the demo.';

get_header();
?>

<main class="sj-page sj-page--contact">

    <!-- ══════════════════════════════════════
         SECTION 1 — PAGE HERO (compact)
    ══════════════════════════════════════ -->
    <section class="ct-hero">
        <div class="ct-hero__shapes" aria-hidden="true">
            <span class="ct-hero__shape ct-hero__shape--1"></span>
            <span class="ct-hero__shape ct-hero__shape--2"></span>
        </div>
        <div class="sj-container">
            <div class="ct-hero__inner">
                <div class="ct-hero__badge">
                    <span class="ct-hero__badge-dot"></span>
                    We respond within 24 hours
                </div>
                <h1 class="ct-hero__heading">
                    <?php echo wp_kses($ct_hero_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                </h1>
                <p class="ct-hero__sub"><?php echo esc_html($ct_hero_sub); ?></p>

                <!-- Quick info pills -->
                <div class="ct-hero__pills">
                    <span class="ct-hero__pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.69a16 16 0 006.35 6.35l1.06-1.35a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                        <?php echo esc_html($ct_phone); ?>
                    </span>
                    <span class="ct-hero__pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <?php echo esc_html($ct_email); ?>
                    </span>
                    <span class="ct-hero__pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <?php echo esc_html($ct_hours); ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 2 — MAIN: FORM + CONTACT INFO
    ══════════════════════════════════════ -->
    <section class="ct-main" id="ct-form">
        <div class="sj-container">
            <div class="ct-main__grid">

                <!-- LEFT: Contact Info -->
                <aside class="ct-info">

                    <h2 class="ct-info__heading">Contact Information</h2>
                    <p class="ct-info__sub">Reach us through any of the channels below — we're happy to help!</p>

                    <ul class="ct-info__list">
                        <li class="ct-info__item">
                            <div class="ct-info__icon ct-info__icon--blue" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.69a16 16 0 006.35 6.35l1.06-1.35a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                            </div>
                            <div class="ct-info__text">
                                <span class="ct-info__label">Phone</span>
                                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $ct_phone)); ?>" class="ct-info__value"><?php echo esc_html($ct_phone); ?></a>
                            </div>
                        </li>

                        <li class="ct-info__item">
                            <div class="ct-info__icon ct-info__icon--green" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div class="ct-info__text">
                                <span class="ct-info__label">WhatsApp</span>
                                <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $ct_whatsapp)); ?>" target="_blank" rel="noopener noreferrer" class="ct-info__value"><?php echo esc_html($ct_whatsapp); ?></a>
                            </div>
                        </li>

                        <li class="ct-info__item">
                            <div class="ct-info__icon ct-info__icon--yellow" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div class="ct-info__text">
                                <span class="ct-info__label">Email</span>
                                <a href="mailto:<?php echo esc_attr($ct_email); ?>" class="ct-info__value"><?php echo esc_html($ct_email); ?></a>
                            </div>
                        </li>

                        <li class="ct-info__item">
                            <div class="ct-info__icon ct-info__icon--teal" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="ct-info__text">
                                <span class="ct-info__label">Address</span>
                                <span class="ct-info__value"><?php echo nl2br(esc_html($ct_address)); ?></span>
                            </div>
                        </li>

                        <li class="ct-info__item">
                            <div class="ct-info__icon ct-info__icon--navy" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div class="ct-info__text">
                                <span class="ct-info__label">Working Hours</span>
                                <span class="ct-info__value"><?php echo esc_html($ct_hours); ?></span>
                            </div>
                        </li>
                    </ul>

                    <!-- Social Links -->
                    <div class="ct-social">
                        <p class="ct-social__label">Follow Us</p>
                        <div class="ct-social__links">
                            <?php if ($ct_facebook && $ct_facebook !== '#') : ?>
                                <a href="<?php echo esc_url($ct_facebook); ?>" class="ct-social__link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ($ct_instagram && $ct_instagram !== '#') : ?>
                                <a href="<?php echo esc_url($ct_instagram); ?>" class="ct-social__link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ($ct_youtube && $ct_youtube !== '#') : ?>
                                <a href="<?php echo esc_url($ct_youtube); ?>" class="ct-social__link" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.54C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon fill="white" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ($ct_twitter && $ct_twitter !== '#') : ?>
                                <a href="<?php echo esc_url($ct_twitter); ?>" class="ct-social__link" target="_blank" rel="noopener noreferrer" aria-label="Twitter / X">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Why reasons -->
                    <div class="ct-reasons">
                        <?php foreach ([$ct_reason1, $ct_reason2, $ct_reason3] as $reason) : if (!$reason) continue; ?>
                            <div class="ct-reason">
                                <span class="ct-reason__check" aria-hidden="true">&#10003;</span>
                                <span><?php echo esc_html($reason); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </aside>

                <!-- RIGHT: Lead Form (MAIN focus) -->
                <div class="ct-form-wrap" id="contact-form">
                    <div class="ct-form-wrap__header">
                        <h2 class="ct-form-wrap__heading">
                            <?php echo wp_kses($ct_form_heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                        </h2>
                        <p class="ct-form-wrap__sub"><?php echo esc_html($ct_form_sub); ?></p>
                    </div>

                    <form class="sj-form ct-form" id="ct-lead-form" novalidate>
                        <?php wp_nonce_field('sj_lead_nonce', 'sj_nonce'); ?>

                        <div class="sj-form__row">
                            <div class="sj-form__group">
                                <label class="ct-form__label" for="ct-parent-name">Parent's Full Name <span aria-hidden="true">*</span></label>
                                <input type="text" id="ct-parent-name" name="parent_name" placeholder="e.g. Rahul Sharma" required class="sj-form__input">
                            </div>
                            <div class="sj-form__group">
                                <label class="ct-form__label" for="ct-phone">Phone Number <span aria-hidden="true">*</span></label>
                                <input type="tel" id="ct-phone" name="phone" placeholder="e.g. +91 98765 43210" required class="sj-form__input">
                            </div>
                        </div>

                        <div class="sj-form__row">
                            <div class="sj-form__group">
                                <label class="ct-form__label" for="ct-email">Email Address <span aria-hidden="true">*</span></label>
                                <input type="email" id="ct-email" name="email" placeholder="e.g. rahul@email.com" required class="sj-form__input">
                            </div>
                            <div class="sj-form__group">
                                <label class="ct-form__label" for="ct-child-age">Child's Age / Grade <span aria-hidden="true">*</span></label>
                                <input type="text" id="ct-child-age" name="child_age" placeholder="e.g. 10 years / Class 5" required class="sj-form__input">
                            </div>
                        </div>

                        <div class="sj-form__row">
                            <div class="sj-form__group sj-form__group--full">
                                <label class="ct-form__label" for="ct-program">Program of Interest</label>
                                <select id="ct-program" name="program" class="sj-form__input sj-form__select">
                                    <option value="">— Select Program —</option>
                                    <option value="vedic-maths">Vedic Maths Program</option>
                                    <option value="phonics">Phonics Program</option>
                                    <option value="phonics-maths">Phonics + Maths Combo</option>
                                    <option value="skill-development">Skill Development Program</option>
                                    <option value="junior-news-express">Junior News Express Program</option>
                                </select>
                            </div>
                        </div>

                        <div class="sj-form__row">
                            <div class="sj-form__group sj-form__group--full">
                                <label class="ct-form__label" for="ct-message">Message / Any Specific Query</label>
                                <textarea id="ct-message" name="message" placeholder="Tell us anything specific about your child's learning needs..." rows="3" class="sj-form__input ct-form__textarea"></textarea>
                            </div>
                        </div>

                        <div class="sj-form__actions">
                            <button type="submit" class="sj-btn sj-btn--navy sj-form__submit ct-form__submit">
                                <span class="sj-btn-text">Send My Enquiry &amp; Book Demo</span>
                                <span class="sj-btn-spinner" aria-hidden="true"></span>
                            </button>
                        </div>

                        <p class="ct-form__note">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Your information is secure and will never be shared.
                        </p>

                        <div class="sj-form__msg" role="alert" aria-live="polite"></div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
         SECTION 3 — MAP
    ══════════════════════════════════════ -->
    <?php if ($ct_map_url) : ?>
    <section class="ct-map">
        <iframe
            src="<?php echo esc_url($ct_map_url); ?>"
            width="100%"
            height="400"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="SkillUp Juniors Location"
        ></iframe>
    </section>
    <?php else : ?>
    <div class="ct-map-placeholder">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <p>Add Google Maps Embed URL via ACF → <strong>Contact — Map & Details</strong></p>
    </div>
    <?php endif; ?>

    <!-- ══════════════════════════════════════
         SECTION 4 — FAQ
    ══════════════════════════════════════ -->
    <section class="ct-faq" id="ct-faq">
        <div class="sj-container">

            <div class="sj-section-header">
                <h2 class="sj-section-title">Frequently Asked Questions</h2>
                <p class="sj-section-sub">Quick answers to questions parents ask us most often.</p>
            </div>

            <div class="ct-faq__grid">
                <?php
                $faqs = [
                    [$ct_faq1_q, $ct_faq1_a],
                    [$ct_faq2_q, $ct_faq2_a],
                    [$ct_faq3_q, $ct_faq3_a],
                    [$ct_faq4_q, $ct_faq4_a],
                ];
                foreach ($faqs as $i => [$q, $a]) :
                    if (!$q) continue;
                ?>
                    <div class="ct-faq__item" data-faq="<?php echo $i; ?>">
                        <button class="ct-faq__question" aria-expanded="false" aria-controls="faq-ans-<?php echo $i; ?>">
                            <span><?php echo esc_html($q); ?></span>
                            <svg class="ct-faq__chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="ct-faq__answer" id="faq-ans-<?php echo $i; ?>" hidden>
                            <p><?php echo esc_html($a); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</main>

<script>
/* FAQ accordion */
document.querySelectorAll('.ct-faq__question').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var expanded = this.getAttribute('aria-expanded') === 'true';
        document.querySelectorAll('.ct-faq__question').forEach(function(b) {
            b.setAttribute('aria-expanded', 'false');
            var ans = document.getElementById(b.getAttribute('aria-controls'));
            if (ans) ans.hidden = true;
            b.closest('.ct-faq__item').classList.remove('is-open');
        });
        if (!expanded) {
            this.setAttribute('aria-expanded', 'true');
            var ans = document.getElementById(this.getAttribute('aria-controls'));
            if (ans) ans.hidden = false;
            this.closest('.ct-faq__item').classList.add('is-open');
        }
    });
});
</script>

<?php get_footer(); ?>

<?php
$heading    = get_field('home_form_heading')    ?: 'Book a <span>Free Demo Class</span> Today!';
$subheading = get_field('home_form_subheading') ?: 'Fill in your details and our expert trainer will contact you within 24 hours.';
$perk1      = get_field('home_form_perk1')      ?: '100% Free — No Commitment';
$perk2      = get_field('home_form_perk2')      ?: 'Live Online or In-Person';
$perk3      = get_field('home_form_perk3')      ?: 'Certified Expert Trainers';
?>

<section class="sj-lead-form" id="lead-form">
    <div class="sj-container">
        <div class="sj-lead-form__inner">

            <div class="sj-lead-form__text">
                <h2 class="sj-lead-form__heading">
                    <?php echo wp_kses($heading, ['span' => [], 'br' => [], 'strong' => []]); ?>
                </h2>
                <p class="sj-lead-form__sub"><?php echo esc_html($subheading); ?></p>
                <ul class="sj-lead-form__perks">
                    <?php foreach ([$perk1, $perk2, $perk3] as $perk) : if (!$perk) continue; ?>
                        <li>
                            <span class="sj-perk-icon" aria-hidden="true">&#10003;</span>
                            <?php echo esc_html($perk); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <form class="sj-form" id="sj-lead-form" novalidate>
                <?php wp_nonce_field('sj_lead_nonce', 'sj_nonce'); ?>
                <div class="sj-form__row">
                    <div class="sj-form__group">
                        <input type="text" name="parent_name" placeholder="Parent's Full Name *" required class="sj-form__input">
                    </div>
                    <div class="sj-form__group">
                        <input type="tel" name="phone" placeholder="Phone Number *" required class="sj-form__input">
                    </div>
                </div>
                <div class="sj-form__row">
                    <div class="sj-form__group">
                        <input type="email" name="email" placeholder="Email Address *" required class="sj-form__input">
                    </div>
                    <div class="sj-form__group">
                        <input type="text" name="child_age" placeholder="Child's Age / Grade *" required class="sj-form__input">
                    </div>
                </div>
                <div class="sj-form__row">
                    <div class="sj-form__group sj-form__group--full">
                        <select name="program" class="sj-form__input sj-form__select">
                            <option value="">— Select Program of Interest —</option>
                            <option value="vedic-maths">Vedic Maths Program</option>
                            <option value="phonics">Phonics Program</option>
                            <option value="phonics-maths">Phonics + Maths Combo</option>
                            <option value="skill-development">Skill Development Program</option>
                            <option value="junior-news-express">Junior News Express Program</option>
                        </select>
                    </div>
                </div>
                <div class="sj-form__actions">
                    <button type="submit" class="sj-btn sj-btn--navy sj-form__submit">
                        <span class="sj-btn-text">Book My Free Demo</span>
                        <span class="sj-btn-spinner" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="sj-form__msg" role="alert" aria-live="polite"></div>
            </form>

        </div>
    </div>
</section>

document.addEventListener('DOMContentLoaded', function () {

    // ── Mobile Nav Toggle ──────────────────────────────────
    const toggle = document.querySelector('.sj-header__toggle');
    const nav    = document.querySelector('.sj-header__nav');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            const isOpen = nav.classList.toggle('is-open');
            toggle.classList.toggle('is-active', isOpen);
            toggle.setAttribute('aria-expanded', isOpen);
        });
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('is-open');
                toggle.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── Lead Form AJAX Submit ──────────────────────────────
    const form = document.getElementById('sj-lead-form');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const btn    = form.querySelector('.sj-form__submit');
            const msgEl  = form.querySelector('.sj-form__msg');
            const data   = new FormData(form);

            data.append('action', 'sj_submit_lead');
            data.append('nonce',  sj_ajax.nonce);

            // Validate required fields client-side
            let valid = true;
            form.querySelectorAll('[required]').forEach(function (field) {
                if (!field.value.trim()) {
                    field.style.borderColor = '#e53e3e';
                    valid = false;
                } else {
                    field.style.borderColor = '';
                }
            });

            if (!valid) {
                showMsg(msgEl, 'Please fill in all required fields.', 'error');
                return;
            }

            btn.classList.add('is-loading');
            btn.disabled = true;
            msgEl.className = 'sj-form__msg';
            msgEl.textContent = '';

            fetch(sj_ajax.url, { method: 'POST', body: data })
                .then(function (res) { return res.json(); })
                .then(function (res) {
                    if (res.success) {
                        showMsg(msgEl, res.data.message, 'success');
                        form.reset();
                    } else {
                        showMsg(msgEl, res.data.message || 'Something went wrong. Please try again.', 'error');
                    }
                })
                .catch(function () {
                    showMsg(msgEl, 'Network error. Please try again.', 'error');
                })
                .finally(function () {
                    btn.classList.remove('is-loading');
                    btn.disabled = false;
                });
        });

        // Clear red border on input
        form.querySelectorAll('.sj-form__input').forEach(function (field) {
            field.addEventListener('input', function () {
                field.style.borderColor = '';
            });
        });
    }

    function showMsg(el, text, type) {
        el.textContent = text;
        el.className = 'sj-form__msg sj-form__msg--' + type;
    }

    // ── Smooth scroll for anchor links ────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-h')) || 76;
                const top    = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
                // close mobile nav if open
                if (nav) {
                    nav.classList.remove('is-open');
                    if (toggle) { toggle.classList.remove('is-active'); toggle.setAttribute('aria-expanded', 'false'); }
                }
            }
        });
    });

    // ── Scroll reveal animation ────────────────────────────
    if ('IntersectionObserver' in window) {
        const revealEls = document.querySelectorAll(
            '.sj-course-card, .sj-card, .sj-testimonial-card, .sj-approach__step'
        );
        revealEls.forEach(function (el) {
            el.style.opacity  = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry, i) {
                if (entry.isIntersecting) {
                    setTimeout(function () {
                        entry.target.style.opacity  = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealEls.forEach(function (el) { observer.observe(el); });
    }

});

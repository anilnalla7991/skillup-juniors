document.addEventListener('DOMContentLoaded', function () {

    // ── Side Drawer ────────────────────────────────────────
    const hamburger = document.getElementById('sj-hamburger');
    const drawer    = document.getElementById('sj-drawer');
    const overlay   = document.getElementById('sj-drawer-overlay');
    const closeBtn  = document.getElementById('sj-drawer-close');

    function openDrawer() {
        overlay.classList.add('is-visible');
        // Force reflow so transition fires
        overlay.getBoundingClientRect();
        overlay.classList.add('is-open');
        drawer.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.classList.add('sj-drawer-open');
    }

    function closeDrawer() {
        overlay.classList.remove('is-open');
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('sj-drawer-open');
        // Hide overlay after transition
        setTimeout(function () { overlay.classList.remove('is-visible'); }, 300);
    }

    if (hamburger) hamburger.addEventListener('click', openDrawer);
    if (closeBtn)  closeBtn.addEventListener('click', closeDrawer);
    if (overlay)   overlay.addEventListener('click', closeDrawer);

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && drawer && drawer.classList.contains('is-open')) {
            closeDrawer();
        }
    });

    // Close drawer when a nav link is clicked
    if (drawer) {
        drawer.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                closeDrawer();
            });
        });
    }

    // ── Lead Form AJAX Submit (all pages) ─────────────────
    function showMsg(el, text, type) {
        el.textContent = text;
        el.className   = 'sj-form__msg sj-form__msg--' + type;
        el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    document.querySelectorAll('.sj-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const btn   = form.querySelector('.sj-form__submit');
            const msgEl = form.querySelector('.sj-form__msg');
            const data  = new FormData(form);

            data.append('action', 'sj_submit_lead');
            data.append('nonce',  sj_ajax.nonce);

            // Client-side validation
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
                    showMsg(msgEl, 'Network error. Please check your connection and try again.', 'error');
                })
                .finally(function () {
                    btn.classList.remove('is-loading');
                    btn.disabled = false;
                });
        });

        form.querySelectorAll('.sj-form__input').forEach(function (field) {
            field.addEventListener('input', function () { field.style.borderColor = ''; });
        });
    });

    // ── Smooth Scroll for Anchor Links ────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const id = this.getAttribute('href');
            if (id === '#') return;
            const target = document.querySelector(id);
            if (target) {
                e.preventDefault();
                const offset = 76;
                const top    = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // ── Scroll Reveal Animation ────────────────────────────
    if ('IntersectionObserver' in window) {
        const revealEls = document.querySelectorAll(
            '.sj-course-card, .sj-card, .sj-testimonial-card, .sj-approach__step'
        );
        revealEls.forEach(function (el) {
            el.style.opacity   = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setTimeout(function () {
                        entry.target.style.opacity   = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealEls.forEach(function (el) { observer.observe(el); });
    }

});

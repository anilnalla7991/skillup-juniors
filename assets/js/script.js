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

        // Close nav when clicking outside
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('is-open');
                toggle.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

});

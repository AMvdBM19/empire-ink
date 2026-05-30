/**
 * Empire INK — Main JS
 *
 * Vanilla JS: mobile menu, sticky nav, smooth scroll,
 * portfolio filter, artist carousel, review carousel.
 */

(function () {
    'use strict';

    /* ── Mobile drawer ── */
    var hamburger = document.querySelector('.hamburger');
    var drawer = document.querySelector('.mobile-drawer');
    var overlay = document.querySelector('.mobile-drawer__overlay');
    var drawerClose = document.querySelector('.mobile-drawer__close');

    function openDrawer() {
        if (!drawer) return;
        drawer.classList.add('is-open');
        overlay.classList.add('is-visible');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if (!drawer) return;
        drawer.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', function () {
        drawer.classList.contains('is-open') ? closeDrawer() : openDrawer();
    });
    if (overlay) overlay.addEventListener('click', closeDrawer);
    if (drawerClose) drawerClose.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && drawer && drawer.classList.contains('is-open')) closeDrawer();
    });

    if (drawer) {
        var drawerLinks = drawer.querySelectorAll('a');
        for (var i = 0; i < drawerLinks.length; i++) {
            drawerLinks[i].addEventListener('click', closeDrawer);
        }
    }

    /* ── Sticky nav — transparent → opaque on scroll ── */
    var header = document.getElementById('site-header');
    if (header) {
        var wasScrolled = false;
        window.addEventListener('scroll', function () {
            var isScrolled = window.scrollY > 30;
            if (isScrolled !== wasScrolled) {
                header.classList.toggle('is-scrolled', isScrolled);
                wasScrolled = isScrolled;
            }
        }, { passive: true });
        if (window.scrollY > 30) header.classList.add('is-scrolled');
    }

    /* ── Smooth scroll for anchor links ── */
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href^="#"]');
        if (!link) return;
        var id = link.getAttribute('href');
        if (id === '#') return;
        var target = document.querySelector(id);
        if (target) {
            e.preventDefault();
            var headerH = header ? header.offsetHeight : 0;
            var top = target.getBoundingClientRect().top + window.pageYOffset - headerH;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    });

    /* ── Portfolio filter chips ── */
    var portGrid = document.getElementById('portfolio-grid');
    if (portGrid) {
        var chips = document.querySelectorAll('.port-tabs .chip');
        var cells = portGrid.querySelectorAll('.port-cell');

        for (var c = 0; c < chips.length; c++) {
            chips[c].addEventListener('click', function () {
                var filter = this.getAttribute('data-filter');

                for (var j = 0; j < chips.length; j++) chips[j].classList.remove('active');
                this.classList.add('active');

                for (var k = 0; k < cells.length; k++) {
                    var style = cells[k].getAttribute('data-style');
                    if (filter === 'all' || style === filter) {
                        cells[k].hidden = false;
                    } else {
                        cells[k].hidden = true;
                    }
                }
            });
        }
    }

    /* ── Artist carousel scroll buttons ── */
    var scrollBtns = document.querySelectorAll('[data-scroll-dir]');
    for (var s = 0; s < scrollBtns.length; s++) {
        scrollBtns[s].addEventListener('click', function () {
            var dir = parseInt(this.getAttribute('data-scroll-dir'), 10);
            var target = document.querySelector(this.getAttribute('data-scroll-target'));
            if (target) {
                target.scrollBy({ left: dir * 360, behavior: 'smooth' });
            }
        });
    }

    /* ── Review carousel — auto-rotate + dot navigation ── */
    var reviewSlides = document.querySelectorAll('.review-slide');
    var reviewDots = document.querySelectorAll('.review-dot');

    if (reviewSlides.length > 1) {
        var currentReview = 0;
        var reviewInterval;

        function showReview(idx) {
            currentReview = idx;
            for (var r = 0; r < reviewSlides.length; r++) {
                reviewSlides[r].classList.toggle('is-active', r === idx);
            }
            for (var d = 0; d < reviewDots.length; d++) {
                reviewDots[d].classList.toggle('active', d === idx);
            }
        }

        function nextReview() {
            showReview((currentReview + 1) % reviewSlides.length);
        }

        reviewInterval = setInterval(nextReview, 7000);

        for (var d = 0; d < reviewDots.length; d++) {
            reviewDots[d].addEventListener('click', function () {
                clearInterval(reviewInterval);
                showReview(parseInt(this.getAttribute('data-review'), 10));
                reviewInterval = setInterval(nextReview, 7000);
            });
        }
    }
})();

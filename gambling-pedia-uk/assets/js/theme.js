/**
 * Theme JavaScript
 *
 * @package Gambling_Pedia_UK
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // Sticky header shadow on scroll
        var header = document.querySelector('.site-header');
        if (header) {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }

        // Breaking news ticker - pause on hover
        var ticker = document.querySelector('.ticker-wrap');
        if (ticker) {
            ticker.addEventListener('mouseenter', function () {
                this.style.animationPlayState = 'paused';
            });
            ticker.addEventListener('mouseleave', function () {
                this.style.animationPlayState = 'running';
            });
        }

        // Back to top button
        var backToTop = document.createElement('button');
        backToTop.className = 'back-to-top';
        backToTop.innerHTML = '&#8679;';
        backToTop.setAttribute('aria-label', 'Back to top');
        backToTop.style.cssText = 'position:fixed;bottom:30px;right:30px;width:45px;height:45px;background:var(--accent);color:#fff;border:none;border-radius:50%;font-size:1.2rem;cursor:pointer;opacity:0;visibility:hidden;transition:all 0.3s ease;z-index:999;box-shadow:0 2px 10px rgba(0,0,0,0.2);';
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', function () {
            if (window.scrollY > 500) {
                backToTop.style.opacity = '1';
                backToTop.style.visibility = 'visible';
            } else {
                backToTop.style.opacity = '0';
                backToTop.style.visibility = 'hidden';
            }
        });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                var target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    });
})();

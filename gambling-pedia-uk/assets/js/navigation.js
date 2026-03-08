/**
 * Navigation - Mobile menu toggle
 *
 * @package Gambling_Pedia_UK
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.querySelector('.menu-toggle');
        var menu = document.querySelector('.nav-menu');

        if (!toggle || !menu) {
            return;
        }

        toggle.addEventListener('click', function () {
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.remove('active');
            }
        });

        // Handle dropdown on touch devices
        var menuItems = menu.querySelectorAll('.menu-item-has-children > a');
        menuItems.forEach(function (item) {
            item.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    var subMenu = this.nextElementSibling;
                    if (subMenu && subMenu.classList.contains('sub-menu')) {
                        e.preventDefault();
                        subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';
                    }
                }
            });
        });

        // Keyboard navigation for dropdowns
        menu.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                var openMenus = menu.querySelectorAll('.sub-menu[style*="display: block"]');
                openMenus.forEach(function (sub) {
                    sub.style.display = '';
                });
                toggle.focus();
            }
        });
    });
})();

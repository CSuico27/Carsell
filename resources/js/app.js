import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (menuToggle && closeMenu && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        });
        
        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = ''; // Re-enable scrolling
        });
    }

    // Desktop profile dropdown toggle
    const userMenuBtn = document.getElementById('user-menu-button');
    const desktopProfileMenu = document.getElementById('desktop-profile-menu');

    if (userMenuBtn && desktopProfileMenu) {
        userMenuBtn.addEventListener('click', () => {
            desktopProfileMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuBtn.contains(e.target) && !desktopProfileMenu.contains(e.target)) {
                desktopProfileMenu.classList.add('hidden');
            }
        });
    }

    // Tablet profile dropdown toggle
    const tabletToggle = document.getElementById('tablet-profile-toggle');
    const tabletMenu = document.getElementById('tablet-profile-menu');

    if (tabletToggle && tabletMenu) {
        tabletToggle.addEventListener('click', () => {
            tabletMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!tabletToggle.contains(e.target) && !tabletMenu.contains(e.target)) {
                tabletMenu.classList.add('hidden');
            }
        });
    }
    
    // Close mobile menu on window resize if it would switch to desktop view
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768 && mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = ''; // Re-enable scrolling
        }
    });
});

/**
 * Main JavaScript for OnePage Minimal Theme
 *
 * @package OnePage_Minimal
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        initScrollAnimations();
        initContactForm();
        initLazyLoading();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const toggle = document.querySelector('.menu-toggle');
        const nav = document.querySelector('.main-nav');
        const body = document.body;

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function() {
            nav.classList.toggle('active');
            toggle.setAttribute(
                'aria-expanded',
                nav.classList.contains('active')
            );
            
            if (nav.classList.contains('active')) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }
        });

        // Close menu when clicking on a link
        const navLinks = nav.querySelectorAll('a');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                nav.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
            });
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && nav.classList.contains('active')) {
                nav.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
                toggle.focus();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                nav.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Skip if it's just "#"
                if (href === '#') return;

                const target = document.querySelector(href);

                if (target) {
                    e.preventDefault();

                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without jumping
                    history.pushState(null, null, href);
                }
            });
        });
    }

    /**
     * Header Scroll Effect
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');

        if (!header) return;

        let lastScrollY = window.pageYOffset;

        window.addEventListener('scroll', function() {
            const currentScrollY = window.pageYOffset;

            if (currentScrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScrollY = currentScrollY;
        }, { passive: true });
    }

    /**
     * Scroll Animations (Intersection Observer)
     */
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll('.fade-in-up, .feature-card, .post-item');

        if (!('IntersectionObserver' in window)) {
            // Fallback for old browsers
            animatedElements.forEach(function(el) {
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
            return;
        }

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        animatedElements.forEach(function(el, index) {
            el.style.animationDelay = `${index * 0.1}s`;
            observer.observe(el);
        });
    }

    /**
     * Contact Form Handler (AJAX)
     */
    function initContactForm() {
        const form = document.getElementById('contact-form');
        const responseContainer = document.getElementById('form-response');

        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append('action', 'contact_form');
            formData.append('nonce', window.onePageData?.nonce || '');

            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Enviando...';
            submitBtn.disabled = true;

            fetch(window.onePageData?.ajaxUrl || '', {
                method: 'POST',
                body: formData,
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (responseContainer) {
                    responseContainer.style.display = 'block';
                    
                    if (data.success) {
                        responseContainer.className = 'success';
                        responseContainer.innerHTML = data.data?.message || '¡Mensaje enviado exitosamente!';
                        form.reset();
                    } else {
                        responseContainer.className = 'error';
                        responseContainer.innerHTML = data.data?.message || 'Hubo un error al enviar el mensaje.';
                    }

                    // Scroll to response
                    responseContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    // Hide response after 5 seconds
                    setTimeout(function() {
                        responseContainer.style.display = 'none';
                    }, 5000);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                if (responseContainer) {
                    responseContainer.style.display = 'block';
                    responseContainer.className = 'error';
                    responseContainer.innerHTML = 'Hubo un error de conexión. Por favor intenta más tarde.';
                }
            })
            .finally(function() {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    /**
     * Lazy Loading for Images
     */
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading supported
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(function(img) {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        } else {
            // Fallback for browsers without native support
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                            }
                            imageObserver.unobserve(img);
                        }
                    });
                });

                lazyImages.forEach(function(img) {
                    imageObserver.observe(img);
                });
            }
        }
    }

    /**
     * Preload Critical Resources
     */
    function preloadCriticalResources() {
        // Preload Google Fonts
        const fonts = [
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap'
        ];

        fonts.forEach(function(font) {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'style';
            link.href = font;
            link.onload = function() {
                this.rel = 'stylesheet';
            };
            document.head.appendChild(link);
        });
    }

    // Run preloading
    preloadCriticalResources();

})();
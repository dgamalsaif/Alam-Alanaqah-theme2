/**
 * Main JavaScript for Alam Alanaqah Theme
 * Handles interactive features and user experience enhancements
 */

(function($) {
    'use strict';

    // Wait for DOM to be ready
    $(document).ready(function() {
        initializeTheme();
    });

    /**
     * Initialize all theme functionality
     */
    function initializeTheme() {
        initMobileMenu();
        initSearchToggle();
        initSmoothScrolling();
        initAnimationsOnScroll();
        initProductQuickView();
        initWishlist();
        initLazyLoading();
        initHeaderScroll();
        initBackToTop();
        initFormValidation();
        initNewsletterForm();
        initTabsAndToggles();
        initImageGallery();
        initTooltips();
        initCounters();
        initParallaxEffects();
    }

    /**
     * Mobile Menu Functionality
     */
    function initMobileMenu() {
        const menuToggle = $('.menu-toggle');
        const mobileMenu = $('.mobile-menu');
        const mobileMenuOverlay = $('.mobile-menu-overlay');
        const mobileMenuClose = $('.mobile-menu-close');

        menuToggle.on('click', function() {
            mobileMenu.addClass('active');
            mobileMenuOverlay.addClass('active');
            $('body').addClass('menu-open');
        });

        mobileMenuClose.add(mobileMenuOverlay).on('click', function() {
            mobileMenu.removeClass('active');
            mobileMenuOverlay.removeClass('active');
            $('body').removeClass('menu-open');
        });

        // Close menu on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.hasClass('active')) {
                mobileMenu.removeClass('active');
                mobileMenuOverlay.removeClass('active');
                $('body').removeClass('menu-open');
            }
        });
    }

    /**
     * Search Toggle Functionality
     */
    function initSearchToggle() {
        const searchToggle = $('.search-toggle');
        const searchFormWrapper = $('.search-form-wrapper');

        searchToggle.on('click', function(e) {
            e.preventDefault();
            searchFormWrapper.toggleClass('active');
            
            if (searchFormWrapper.hasClass('active')) {
                searchFormWrapper.find('input[type="search"]').focus();
            }
        });

        // Close search on click outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-wrapper').length) {
                searchFormWrapper.removeClass('active');
            }
        });

        // AJAX search functionality
        let searchTimeout;
        $('.search-form input[type="search"]').on('input', function() {
            const searchTerm = $(this).val().trim();
            
            clearTimeout(searchTimeout);
            
            if (searchTerm.length > 2) {
                searchTimeout = setTimeout(function() {
                    performAjaxSearch(searchTerm);
                }, 300);
            }
        });
    }

    /**
     * AJAX Search
     */
    function performAjaxSearch(searchTerm) {
        $.ajax({
            url: alamAlanaqah.ajaxurl,
            type: 'POST',
            data: {
                action: 'alam_alanaqah_search',
                search_term: searchTerm,
                nonce: alamAlanaqah.nonce
            },
            success: function(response) {
                if (response.success) {
                    displaySearchResults(response.data);
                }
            },
            error: function() {
                console.log('Search request failed');
            }
        });
    }

    /**
     * Display Search Results
     */
    function displaySearchResults(results) {
        let resultsHtml = '<div class="search-results">';
        
        if (results.length > 0) {
            results.forEach(function(result) {
                resultsHtml += `
                    <div class="search-result-item">
                        <a href="${result.url}">
                            <span class="result-title">${result.title}</span>
                            <span class="result-type">${result.type}</span>
                        </a>
                    </div>
                `;
            });
        } else {
            resultsHtml += '<div class="no-results">No results found</div>';
        }
        
        resultsHtml += '</div>';
        
        $('.search-form-wrapper').append(resultsHtml);
    }

    /**
     * Smooth Scrolling
     */
    function initSmoothScrolling() {
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
                location.hostname === this.hostname) {
                
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                    return false;
                }
            }
        });
    }

    /**
     * Animations on Scroll
     */
    function initAnimationsOnScroll() {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, {
            threshold: 0.1
        });

        // Observe elements for animation
        $('.post-card, .product-card, .category-card, .feature-item').each(function() {
            observer.observe(this);
        });
    }

    /**
     * Product Quick View
     */
    function initProductQuickView() {
        $('.quick-view').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            
            // Create and show modal
            const modal = createQuickViewModal();
            $('body').append(modal);
            
            // Load product data
            loadProductQuickView(productId);
        });
    }

    /**
     * Create Quick View Modal
     */
    function createQuickViewModal() {
        return `
            <div class="quick-view-modal">
                <div class="modal-overlay"></div>
                <div class="modal-content">
                    <button class="modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="modal-body">
                        <div class="loading-spinner"></div>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Wishlist Functionality
     */
    function initWishlist() {
        $('.add-to-wishlist').on('click', function(e) {
            e.preventDefault();
            const button = $(this);
            const productId = button.data('product-id');
            
            button.toggleClass('active');
            
            // Add visual feedback
            if (button.hasClass('active')) {
                button.find('i').addClass('fas').removeClass('far');
                showNotification('Added to wishlist', 'success');
            } else {
                button.find('i').addClass('far').removeClass('fas');
                showNotification('Removed from wishlist', 'info');
            }
            
            // Save to localStorage
            updateWishlistStorage(productId, button.hasClass('active'));
        });
    }

    /**
     * Update Wishlist Storage
     */
    function updateWishlistStorage(productId, isActive) {
        let wishlist = JSON.parse(localStorage.getItem('alam_wishlist') || '[]');
        
        if (isActive) {
            if (!wishlist.includes(productId)) {
                wishlist.push(productId);
            }
        } else {
            wishlist = wishlist.filter(id => id !== productId);
        }
        
        localStorage.setItem('alam_wishlist', JSON.stringify(wishlist));
    }

    /**
     * Lazy Loading for Images
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            $('.lazy').each(function() {
                imageObserver.observe(this);
            });
        } else {
            // Fallback for browsers without IntersectionObserver
            $('.lazy').each(function() {
                this.src = this.dataset.src;
                $(this).removeClass('lazy');
            });
        }
    }

    /**
     * Header Scroll Effects
     */
    function initHeaderScroll() {
        let lastScrollTop = 0;
        const header = $('.site-header');
        
        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            
            if (scrollTop > 100) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
            
            // Hide/show header on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.addClass('header-hidden');
            } else {
                header.removeClass('header-hidden');
            }
            
            lastScrollTop = scrollTop;
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        // Create back to top button
        $('body').append('<button class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>');
        
        const backToTopBtn = $('.back-to-top');
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                backToTopBtn.addClass('show');
            } else {
                backToTopBtn.removeClass('show');
            }
        });
        
        backToTopBtn.on('click', function() {
            $('html, body').animate({scrollTop: 0}, 600);
        });
    }

    /**
     * Form Validation
     */
    function initFormValidation() {
        $('form').on('submit', function(e) {
            const form = $(this);
            let isValid = true;
            
            // Clear previous errors
            form.find('.error-message').remove();
            form.find('.field-error').removeClass('field-error');
            
            // Validate required fields
            form.find('[required]').each(function() {
                const field = $(this);
                const value = field.val().trim();
                
                if (!value) {
                    showFieldError(field, 'This field is required');
                    isValid = false;
                }
            });
            
            // Validate email fields
            form.find('input[type="email"]').each(function() {
                const field = $(this);
                const email = field.val().trim();
                
                if (email && !isValidEmail(email)) {
                    showFieldError(field, 'Please enter a valid email address');
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                form.find('.field-error').first().focus();
            }
        });
    }

    /**
     * Show Field Error
     */
    function showFieldError(field, message) {
        field.addClass('field-error');
        field.after(`<div class="error-message">${message}</div>`);
    }

    /**
     * Validate Email
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /**
     * Newsletter Form
     */
    function initNewsletterForm() {
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const email = form.find('input[type="email"]').val();
            const button = form.find('button[type="submit"]');
            const originalText = button.text();
            
            // Show loading state
            button.html('<i class="fas fa-spinner fa-spin"></i> Subscribing...');
            button.prop('disabled', true);
            
            // Simulate API call
            setTimeout(function() {
                button.html('<i class="fas fa-check"></i> Subscribed!');
                showNotification('Thank you for subscribing!', 'success');
                form[0].reset();
                
                setTimeout(function() {
                    button.text(originalText);
                    button.prop('disabled', false);
                }, 2000);
            }, 1500);
        });
    }

    /**
     * Tabs and Toggles
     */
    function initTabsAndToggles() {
        // Tab functionality
        $('.tab-nav').on('click', '.tab-link', function(e) {
            e.preventDefault();
            const tabContainer = $(this).closest('.tabs-container');
            const targetTab = $(this).attr('href');
            
            // Update active states
            tabContainer.find('.tab-link').removeClass('active');
            tabContainer.find('.tab-pane').removeClass('active');
            
            $(this).addClass('active');
            $(targetTab).addClass('active');
        });
        
        // Accordion functionality
        $('.accordion-header').on('click', function() {
            const accordion = $(this).closest('.accordion-item');
            const content = accordion.find('.accordion-content');
            
            accordion.toggleClass('active');
            content.slideToggle(300);
        });
    }

    /**
     * Image Gallery
     */
    function initImageGallery() {
        $('.gallery-item').on('click', function(e) {
            e.preventDefault();
            const images = $('.gallery-item img').map(function() {
                return $(this).attr('src');
            }).get();
            const currentIndex = $('.gallery-item').index(this);
            
            openLightbox(images, currentIndex);
        });
    }

    /**
     * Open Lightbox
     */
    function openLightbox(images, startIndex) {
        let currentIndex = startIndex;
        
        const lightbox = $(`
            <div class="lightbox">
                <div class="lightbox-overlay"></div>
                <div class="lightbox-content">
                    <button class="lightbox-close">&times;</button>
                    <button class="lightbox-prev">&lt;</button>
                    <button class="lightbox-next">&gt;</button>
                    <img src="${images[currentIndex]}" alt="Gallery image">
                    <div class="lightbox-counter">${currentIndex + 1} / ${images.length}</div>
                </div>
            </div>
        `);
        
        $('body').append(lightbox);
        
        // Navigation
        lightbox.find('.lightbox-next').on('click', function() {
            currentIndex = (currentIndex + 1) % images.length;
            updateLightboxImage();
        });
        
        lightbox.find('.lightbox-prev').on('click', function() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateLightboxImage();
        });
        
        // Close lightbox
        lightbox.find('.lightbox-close, .lightbox-overlay').on('click', function() {
            lightbox.remove();
        });
        
        function updateLightboxImage() {
            lightbox.find('img').attr('src', images[currentIndex]);
            lightbox.find('.lightbox-counter').text(`${currentIndex + 1} / ${images.length}`);
        }
    }

    /**
     * Tooltips
     */
    function initTooltips() {
        $('[data-tooltip]').on('mouseenter', function() {
            const tooltip = $(this).data('tooltip');
            const tooltipElement = $(`<div class="tooltip">${tooltip}</div>`);
            
            $('body').append(tooltipElement);
            
            const rect = this.getBoundingClientRect();
            tooltipElement.css({
                top: rect.top - tooltipElement.outerHeight() - 10,
                left: rect.left + (rect.width / 2) - (tooltipElement.outerWidth() / 2)
            });
        });
        
        $('[data-tooltip]').on('mouseleave', function() {
            $('.tooltip').remove();
        });
    }

    /**
     * Counter Animation
     */
    function initCounters() {
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        });

        $('.counter').each(function() {
            counterObserver.observe(this);
        });
    }

    /**
     * Animate Counter
     */
    function animateCounter(element) {
        const target = parseInt($(element).data('count'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            $(element).text(Math.floor(current));
        }, 16);
    }

    /**
     * Parallax Effects
     */
    function initParallaxEffects() {
        if (window.innerWidth > 768) {
            $(window).on('scroll', function() {
                const scrolled = $(window).scrollTop();
                
                $('.parallax').each(function() {
                    const rate = scrolled * -0.5;
                    $(this).css('transform', `translateY(${rate}px)`);
                });
            });
        }
    }

    /**
     * Show Notification
     */
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="notification notification-${type}">
                <div class="notification-content">
                    <span class="notification-message">${message}</span>
                    <button class="notification-close">&times;</button>
                </div>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(function() {
            notification.addClass('show');
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(function() {
            removeNotification(notification);
        }, 5000);
        
        // Manual close
        notification.find('.notification-close').on('click', function() {
            removeNotification(notification);
        });
    }

    /**
     * Remove Notification
     */
    function removeNotification(notification) {
        notification.removeClass('show');
        setTimeout(function() {
            notification.remove();
        }, 300);
    }

    /**
     * Window Resize Handler
     */
    $(window).on('resize', function() {
        // Recalculate layout on resize
        clearTimeout(window.resizeTimeout);
        window.resizeTimeout = setTimeout(function() {
            // Re-initialize components that need resize handling
            initParallaxEffects();
        }, 250);
    });

})(jQuery);

// Additional CSS for JavaScript functionality
const additionalCSS = `
<style>
/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: var(--primary-teal);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    background: var(--primary-gold);
    transform: translateY(-3px);
}

/* Header Scroll Effects */
.site-header.scrolled {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.site-header.header-hidden {
    transform: translateY(-100%);
}

/* Field Errors */
.field-error {
    border-color: #e74c3c !important;
}

.error-message {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 5px;
}

/* Notifications */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    padding: 15px 20px;
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.3s ease;
    z-index: 10000;
    max-width: 300px;
}

.notification.show {
    opacity: 1;
    transform: translateX(0);
}

.notification-success {
    border-left: 4px solid #27ae60;
}

.notification-error {
    border-left: 4px solid #e74c3c;
}

.notification-info {
    border-left: 4px solid var(--primary-teal);
}

.notification-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notification-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin-left: 10px;
}

/* Quick View Modal */
.quick-view-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 12px;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    margin: 20px;
}

.modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    z-index: 1;
}

/* Lightbox */
.lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
}

.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.lightbox-close,
.lightbox-prev,
.lightbox-next {
    position: absolute;
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    font-size: 24px;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
}

.lightbox-close {
    top: 20px;
    right: 20px;
}

.lightbox-prev {
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
}

.lightbox-next {
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
}

.lightbox-counter {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    background: rgba(0,0,0,0.5);
    padding: 5px 10px;
    border-radius: 4px;
}

/* Tooltip */
.tooltip {
    position: absolute;
    background: var(--neutral-charcoal);
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 14px;
    white-space: nowrap;
    z-index: 1000;
    pointer-events: none;
}

.tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: var(--neutral-charcoal);
}
</style>
`;

// Inject additional CSS
document.head.insertAdjacentHTML('beforeend', additionalCSS);

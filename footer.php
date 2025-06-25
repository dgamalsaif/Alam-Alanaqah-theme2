    <footer id="colophon" class="site-footer">
        <div class="footer-main">
            <div class="container">
                <div class="footer-content">
                    <!-- About Section -->
                    <div class="footer-section footer-about">
                        <h3><?php esc_html_e('Alam Alanaqah', 'alam-alanaqah'); ?></h3>
                        <p><?php esc_html_e('World of Elegance - Your premier destination for luxury fashion, exquisite accessories, fine jewelry, and premium perfumes. Experience sophistication and style like never before.', 'alam-alanaqah'); ?></p>
                        <div class="footer-social">
                            <?php alam_alanaqah_social_links(); ?>
                        </div>
                        <div class="footer-logo">
                            <?php if (file_exists(ALAM_ALANAQAH_THEME_DIR . '/logo.png')) : ?>
                                <img src="<?php echo esc_url(ALAM_ALANAQAH_THEME_URI . '/logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="footer-logo-img">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-section footer-links">
                        <h3><?php esc_html_e('Quick Links', 'alam-alanaqah'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'alam-alanaqah'); ?></a></li>
                            <?php if (class_exists('WooCommerce')) : ?>
                                <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('Shop', 'alam-alanaqah'); ?></a></li>
                                <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>"><?php esc_html_e('My Account', 'alam-alanaqah'); ?></a></li>
                                <li><a href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php esc_html_e('Cart', 'alam-alanaqah'); ?></a></li>
                                <li><a href="<?php echo esc_url(wc_get_checkout_url()); ?>"><?php esc_html_e('Checkout', 'alam-alanaqah'); ?></a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Us', 'alam-alanaqah'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact', 'alam-alanaqah'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="footer-section footer-categories">
                        <h3><?php esc_html_e('Categories', 'alam-alanaqah'); ?></h3>
                        <ul>
                            <?php if (class_exists('WooCommerce')) : ?>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'number' => 6,
                                ));
                                
                                if (!empty($categories)) :
                                    foreach ($categories as $category) :
                                ?>
                                    <li><a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a></li>
                                <?php 
                                    endforeach;
                                else :
                                ?>
                                    <li><a href="#"><?php esc_html_e('Clothes', 'alam-alanaqah'); ?></a></li>
                                    <li><a href="#"><?php esc_html_e('Accessories', 'alam-alanaqah'); ?></a></li>
                                    <li><a href="#"><?php esc_html_e('Jewelry', 'alam-alanaqah'); ?></a></li>
                                    <li><a href="#"><?php esc_html_e('Perfumes', 'alam-alanaqah'); ?></a></li>
                                    <li><a href="#"><?php esc_html_e('New Arrivals', 'alam-alanaqah'); ?></a></li>
                                    <li><a href="#"><?php esc_html_e('Sale', 'alam-alanaqah'); ?></a></li>
                                <?php endif; ?>
                            <?php else : ?>
                                <li><a href="#"><?php esc_html_e('Clothes', 'alam-alanaqah'); ?></a></li>
                                <li><a href="#"><?php esc_html_e('Accessories', 'alam-alanaqah'); ?></a></li>
                                <li><a href="#"><?php esc_html_e('Jewelry', 'alam-alanaqah'); ?></a></li>
                                <li><a href="#"><?php esc_html_e('Perfumes', 'alam-alanaqah'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Customer Service -->
                    <div class="footer-section footer-service">
                        <h3><?php esc_html_e('Customer Service', 'alam-alanaqah'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/shipping-info')); ?>"><?php esc_html_e('Shipping Information', 'alam-alanaqah'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/returns')); ?>"><?php esc_html_e('Returns & Exchanges', 'alam-alanaqah'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/size-guide')); ?>"><?php esc_html_e('Size Guide', 'alam-alanaqah'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/faq')); ?>"><?php esc_html_e('FAQ', 'alam-alanaqah'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"><?php esc_html_e('Privacy Policy', 'alam-alanaqah'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/terms-conditions')); ?>"><?php esc_html_e('Terms & Conditions', 'alam-alanaqah'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="footer-section footer-contact">
                        <h3><?php esc_html_e('Contact Information', 'alam-alanaqah'); ?></h3>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php esc_html_e('123 Elegance Street, Fashion District, City 12345', 'alam-alanaqah'); ?></span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+1 (555) 123-4567</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>info@alamalanaqah.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <span><?php esc_html_e('Mon - Sat: 9:00 AM - 8:00 PM', 'alam-alanaqah'); ?></span>
                            </div>
                        </div>
                        
                        <!-- Newsletter Signup -->
                        <div class="newsletter-signup">
                            <h4><?php esc_html_e('Stay Updated', 'alam-alanaqah'); ?></h4>
                            <p><?php esc_html_e('Subscribe to our newsletter for exclusive offers and new arrivals.', 'alam-alanaqah'); ?></p>
                            <form class="newsletter-form" action="#" method="post">
                                <div class="newsletter-input">
                                    <input type="email" name="newsletter_email" placeholder="<?php esc_attr_e('Enter your email', 'alam-alanaqah'); ?>" required>
                                    <button type="submit" class="newsletter-submit">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods & Trust Badges -->
                <div class="footer-payment">
                    <div class="payment-methods">
                        <h4><?php esc_html_e('We Accept', 'alam-alanaqah'); ?></h4>
                        <div class="payment-icons">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-amex"></i>
                            <i class="fab fa-cc-paypal"></i>
                            <i class="fab fa-apple-pay"></i>
                            <i class="fab fa-google-pay"></i>
                        </div>
                    </div>
                    <div class="trust-badges">
                        <div class="trust-item">
                            <i class="fas fa-shield-alt"></i>
                            <span><?php esc_html_e('Secure Payments', 'alam-alanaqah'); ?></span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-truck"></i>
                            <span><?php esc_html_e('Free Shipping', 'alam-alanaqah'); ?></span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-undo"></i>
                            <span><?php esc_html_e('Easy Returns', 'alam-alanaqah'); ?></span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-headset"></i>
                            <span><?php esc_html_e('24/7 Support', 'alam-alanaqah'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'alam-alanaqah'); ?></p>
                        <p><?php esc_html_e('World of Elegance - Premium Fashion Store', 'alam-alanaqah'); ?></p>
                    </div>
                    <div class="footer-bottom-links">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<style>
/* Footer Styles */
.site-footer {
    background: linear-gradient(135deg, var(--primary-teal) 0%, #1a3d3e 100%);
    color: white;
    margin-top: auto;
}

.footer-main {
    padding: 60px 0 30px;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1.5fr;
    gap: 40px;
    margin-bottom: 40px;
}

.footer-section h3 {
    color: var(--primary-gold);
    font-family: var(--font-primary);
    font-size: 18px;
    margin-bottom: 20px;
    border-bottom: 2px solid var(--primary-gold);
    padding-bottom: 10px;
    display: inline-block;
}

.footer-section ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-section li {
    margin-bottom: 10px;
}

.footer-section a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.3s ease;
    font-size: 14px;
}

.footer-section a:hover {
    color: var(--primary-gold);
}

.footer-about p {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
    color: rgba(255, 255, 255, 0.8);
}

.footer-social {
    margin-bottom: 20px;
}

.footer-social a {
    display: inline-block;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    text-align: center;
    line-height: 40px;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.footer-social a:hover {
    background: var(--primary-gold);
    color: white;
    transform: translateY(-3px);
}

.footer-logo-img {
    height: 60px;
    width: auto;
    opacity: 0.8;
}

.contact-info {
    margin-bottom: 30px;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    font-size: 14px;
}

.contact-item i {
    width: 20px;
    color: var(--primary-gold);
    margin-right: 10px;
}

.newsletter-signup h4 {
    color: var(--primary-gold);
    font-size: 16px;
    margin-bottom: 10px;
}

.newsletter-signup p {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 15px;
}

.newsletter-form {
    position: relative;
}

.newsletter-input {
    display: flex;
    border-radius: 25px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.1);
}

.newsletter-input input {
    flex: 1;
    padding: 12px 15px;
    border: none;
    background: transparent;
    color: white;
    font-size: 14px;
}

.newsletter-input input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.newsletter-submit {
    background: var(--primary-gold);
    border: none;
    color: white;
    padding: 12px 15px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.newsletter-submit:hover {
    background: #b8941f;
}

.footer-payment {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding-top: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}

.payment-methods h4 {
    color: var(--primary-gold);
    font-size: 16px;
    margin-bottom: 10px;
}

.payment-icons {
    display: flex;
    gap: 15px;
}

.payment-icons i {
    font-size: 24px;
    color: rgba(255, 255, 255, 0.6);
    transition: color 0.3s ease;
}

.payment-icons i:hover {
    color: var(--primary-gold);
}

.trust-badges {
    display: flex;
    gap: 30px;
}

.trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.trust-item i {
    font-size: 24px;
    color: var(--primary-gold);
    margin-bottom: 5px;
}

.trust-item span {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.8);
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.3);
    padding: 20px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.copyright p {
    margin: 0;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
}

.footer-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 20px;
}

.footer-menu a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.footer-menu a:hover {
    color: var(--primary-gold);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 30px;
    }
    
    .trust-badges {
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .footer-payment {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .trust-badges {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        width: 100%;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .footer-main {
        padding: 40px 0 20px;
    }
    
    .trust-badges {
        grid-template-columns: 1fr;
    }
    
    .payment-icons {
        flex-wrap: wrap;
        justify-content: center;
    }
}

/* RTL Support */
[dir="rtl"] .contact-item i {
    margin-right: 0;
    margin-left: 10px;
}

[dir="rtl"] .footer-social a {
    margin-right: 0;
    margin-left: 10px;
}

[dir="rtl"] .footer-menu {
    direction: rtl;
}
</style>

<script>
// Newsletter form handling
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[name="newsletter_email"]').value;
            
            if (email) {
                // Here you would typically send the email to your server
                alert('<?php esc_html_e("Thank you for subscribing to our newsletter!", "alam-alanaqah"); ?>');
                this.querySelector('input[name="newsletter_email"]').value = '';
            }
        });
    }
});
</script>

</body>
</html>

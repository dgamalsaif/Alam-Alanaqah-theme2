<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main error-404">
    <div class="container">
        
        <section class="error-404-content">
            <!-- Error Illustration -->
            <div class="error-illustration">
                <div class="error-number">
                    <span class="four">4</span>
                    <span class="zero">0</span>
                    <span class="four">4</span>
                </div>
                <div class="error-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <!-- Error Message -->
            <div class="error-message">
                <h1 class="error-title">
                    <?php esc_html_e('Oops! Page Not Found', 'alam-alanaqah'); ?>
                </h1>
                <p class="error-description">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'alam-alanaqah'); ?>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    <?php esc_html_e('Go Home', 'alam-alanaqah'); ?>
                </a>
                <button onclick="history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <?php esc_html_e('Go Back', 'alam-alanaqah'); ?>
                </button>
            </div>

            <!-- Search Form -->
            <div class="error-search">
                <h3><?php esc_html_e('Try searching for what you need:', 'alam-alanaqah'); ?></h3>
                <?php get_search_form(); ?>
            </div>

            <!-- Helpful Links -->
            <div class="helpful-links">
                <h3><?php esc_html_e('Maybe these links will help:', 'alam-alanaqah'); ?></h3>
                <div class="links-grid">
                    
                    <!-- Shop Link -->
                    <?php if (class_exists('WooCommerce')) : ?>
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="link-content">
                            <h4><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('Shop', 'alam-alanaqah'); ?></a></h4>
                            <p><?php esc_html_e('Explore our luxury collection', 'alam-alanaqah'); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Categories -->
                    <?php if (class_exists('WooCommerce')) : ?>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'number' => 3,
                        ));
                        
                        if (!empty($categories)) :
                            foreach ($categories as $category) :
                        ?>
                            <div class="link-item">
                                <div class="link-icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <div class="link-content">
                                    <h4><a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a></h4>
                                    <p><?php echo sprintf(_n('%d item', '%d items', $category->count, 'alam-alanaqah'), $category->count); ?></p>
                                </div>
                            </div>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                    <?php endif; ?>

                    <!-- About Link -->
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="link-content">
                            <h4><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Us', 'alam-alanaqah'); ?></a></h4>
                            <p><?php esc_html_e('Learn about our story', 'alam-alanaqah'); ?></p>
                        </div>
                    </div>

                    <!-- Contact Link -->
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="link-content">
                            <h4><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact', 'alam-alanaqah'); ?></a></h4>
                            <p><?php esc_html_e('Get in touch with us', 'alam-alanaqah'); ?></p>
                        </div>
                    </div>

                    <!-- Blog Link -->
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <div class="link-content">
                            <h4><a href="<?php echo esc_url(home_url('/blog')); ?>"><?php esc_html_e('Blog', 'alam-alanaqah'); ?></a></h4>
                            <p><?php esc_html_e('Latest news and updates', 'alam-alanaqah'); ?></p>
                        </div>
                    </div>

                    <!-- Account Link -->
                    <?php if (class_exists('WooCommerce')) : ?>
                    <div class="link-item">
                        <div class="link-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="link-content">
                            <h4><a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>"><?php esc_html_e('My Account', 'alam-alanaqah'); ?></a></h4>
                            <p><?php esc_html_e('Access your account', 'alam-alanaqah'); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Popular Posts/Products -->
            <?php
            // Get popular posts or products
            $popular_posts = get_posts(array(
                'numberposts' => 3,
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            ));
            
            if (empty($popular_posts)) {
                $popular_posts = get_posts(array(
                    'numberposts' => 3,
                    'orderby' => 'comment_count',
                    'order' => 'DESC',
                ));
            }
            
            if (!empty($popular_posts)) :
            ?>
            <div class="popular-content">
                <h3><?php esc_html_e('Popular Content', 'alam-alanaqah'); ?></h3>
                <div class="popular-grid">
                    <?php foreach ($popular_posts as $post) : setup_postdata($post); ?>
                        <article class="popular-item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="popular-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('alam-alanaqah-thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="popular-content-text">
                                <h4 class="popular-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="popular-meta">
                                    <span class="popular-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Contact Information -->
            <div class="error-contact">
                <h3><?php esc_html_e('Need Help?', 'alam-alanaqah'); ?></h3>
                <p><?php esc_html_e('If you believe this is an error, please contact us and we\'ll help you find what you\'re looking for.', 'alam-alanaqah'); ?></p>
                <div class="contact-options">
                    <a href="mailto:info@alamalanaqah.com" class="contact-option">
                        <i class="fas fa-envelope"></i>
                        <span>info@alamalanaqah.com</span>
                    </a>
                    <a href="tel:+15551234567" class="contact-option">
                        <i class="fas fa-phone"></i>
                        <span>+1 (555) 123-4567</span>
                    </a>
                </div>
            </div>

        </section>
        
    </div>
</main>

<?php get_footer(); ?>

<style>
/* 404 Error Page Styles */
.error-404 {
    padding: 60px 0;
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.error-404-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

/* Error Illustration */
.error-illustration {
    margin-bottom: 40px;
    position: relative;
}

.error-number {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}

.error-number span {
    font-family: var(--font-primary);
    font-size: 8rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 4px 8px rgba(0,0,0,0.1);
    position: relative;
}

.error-number .zero {
    position: relative;
    animation: pulse 2s ease-in-out infinite;
}

.error-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    color: var(--primary-gold);
    animation: float 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

@keyframes float {
    0%, 100% { transform: translate(-50%, -50%) translateY(0px); }
    50% { transform: translate(-50%, -50%) translateY(-10px); }
}

/* Error Message */
.error-message {
    margin-bottom: 40px;
}

.error-title {
    font-family: var(--font-primary);
    font-size: 2.5rem;
    color: var(--primary-teal);
    margin-bottom: 20px;
}

.error-description {
    font-size: 1.2rem;
    color: var(--neutral-dark-gray);
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

/* Action Buttons */
.error-actions {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 50px;
    flex-wrap: wrap;
}

.error-actions .btn {
    padding: 15px 30px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all var(--transition-medium);
}

.error-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* Search Form */
.error-search {
    background: var(--neutral-light-gray);
    padding: 40px;
    border-radius: var(--border-radius-lg);
    margin-bottom: 50px;
}

.error-search h3 {
    color: var(--primary-teal);
    margin-bottom: 20px;
    font-size: 1.3rem;
}

.error-search .search-form {
    max-width: 400px;
    margin: 0 auto;
    display: flex;
    border-radius: var(--border-radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
}

.error-search .search-form input[type="search"] {
    flex: 1;
    padding: 15px 20px;
    border: none;
    font-size: 16px;
    outline: none;
}

.error-search .search-form button {
    background: var(--primary-teal);
    color: white;
    border: none;
    padding: 15px 25px;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.error-search .search-form button:hover {
    background: var(--primary-gold);
}

/* Helpful Links */
.helpful-links {
    margin-bottom: 50px;
}

.helpful-links h3 {
    color: var(--primary-teal);
    margin-bottom: 30px;
    font-size: 1.5rem;
}

.links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.link-item {
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
    padding: 20px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-subtle);
    transition: all var(--transition-medium);
    text-align: left;
}

.link-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-medium);
}

.link-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.link-content h4 {
    margin: 0 0 5px 0;
    font-size: 1.1rem;
}

.link-content h4 a {
    color: var(--primary-teal);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.link-content h4 a:hover {
    color: var(--primary-gold);
}

.link-content p {
    margin: 0;
    font-size: 0.9rem;
    color: var(--neutral-medium-gray);
}

/* Popular Content */
.popular-content {
    margin-bottom: 50px;
}

.popular-content h3 {
    color: var(--primary-teal);
    margin-bottom: 30px;
    font-size: 1.5rem;
}

.popular-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.popular-item {
    background: white;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
    transition: transform var(--transition-medium);
}

.popular-item:hover {
    transform: translateY(-3px);
}

.popular-thumbnail {
    aspect-ratio: 16/10;
    overflow: hidden;
}

.popular-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.popular-item:hover .popular-thumbnail img {
    transform: scale(1.05);
}

.popular-content-text {
    padding: 15px;
}

.popular-title {
    font-size: 1rem;
    margin-bottom: 8px;
}

.popular-title a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.popular-title a:hover {
    color: var(--primary-teal);
}

.popular-meta {
    font-size: 0.9rem;
    color: var(--neutral-medium-gray);
}

/* Contact Information */
.error-contact {
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    color: white;
    padding: 40px;
    border-radius: var(--border-radius-lg);
    margin-bottom: 30px;
}

.error-contact h3 {
    color: white;
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.error-contact p {
    margin-bottom: 25px;
    opacity: 0.9;
    line-height: 1.6;
}

.contact-options {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.contact-option {
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: transform var(--transition-fast);
}

.contact-option:hover {
    transform: translateY(-2px);
    color: white;
}

.contact-option i {
    width: 20px;
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .error-number span {
        font-size: 5rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .error-description {
        font-size: 1.1rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .links-grid {
        grid-template-columns: 1fr;
    }
    
    .popular-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-options {
        flex-direction: column;
        align-items: center;
    }
    
    .link-item {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .error-404 {
        padding: 40px 0;
    }
    
    .error-number span {
        font-size: 4rem;
    }
    
    .error-title {
        font-size: 1.8rem;
    }
    
    .error-search,
    .error-contact {
        padding: 30px 20px;
    }
    
    .links-grid {
        gap: 15px;
    }
    
    .link-item {
        padding: 15px;
    }
}

/* RTL Support */
[dir="rtl"] .link-item {
    direction: rtl;
}

[dir="rtl"] .contact-options {
    direction: rtl;
}

[dir="rtl"] .popular-content-text {
    text-align: right;
}

/* Animation on load */
.error-404-content {
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
// Add some interactive effects
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect to error number
    const errorNumbers = document.querySelectorAll('.error-number span');
    errorNumbers.forEach((span, index) => {
        span.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        span.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });
    
    // Random floating animation for the search icon
    const errorIcon = document.querySelector('.error-icon');
    if (errorIcon) {
        setInterval(() => {
            const randomX = (Math.random() - 0.5) * 20;
            const randomY = (Math.random() - 0.5) * 20;
            errorIcon.style.transform = `translate(calc(-50% + ${randomX}px), calc(-50% + ${randomY}px))`;
        }, 3000);
    }
});
</script>

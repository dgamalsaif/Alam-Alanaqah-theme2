<?php
/**
 * Front Page Template
 * 
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main homepage">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-pattern"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">
                        <?php echo esc_html(get_theme_mod('hero_title', __('Welcome to Alam Alanaqah', 'alam-alanaqah'))); ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', __('World of Elegance - Premium Fashion, Accessories, Jewelry & Perfumes', 'alam-alanaqah'))); ?>
                    </p>
                    <div class="hero-actions">
                        <a href="<?php echo esc_url(get_theme_mod('hero_cta_url', wc_get_page_permalink('shop'))); ?>" class="hero-cta btn btn-primary">
                            <?php echo esc_html(get_theme_mod('hero_cta_text', __('Shop Now', 'alam-alanaqah'))); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/about')); ?>" class="hero-secondary btn btn-secondary">
                            <?php esc_html_e('Our Story', 'alam-alanaqah'); ?>
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="hero-product-showcase">
                        <div class="showcase-item showcase-1">
                            <div class="showcase-circle"></div>
                        </div>
                        <div class="showcase-item showcase-2">
                            <div class="showcase-circle"></div>
                        </div>
                        <div class="showcase-item showcase-3">
                            <div class="showcase-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e('Explore Our Collections', 'alam-alanaqah'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Discover luxury in every category', 'alam-alanaqah'); ?></p>
            </div>
            
            <div class="categories-grid">
                <?php
                // Get product categories or create default ones
                if (class_exists('WooCommerce')) {
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'number' => 4,
                    ));
                    
                    if (!empty($categories)) {
                        foreach ($categories as $category) :
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
                ?>
                            <div class="category-card">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                    <?php if ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" class="category-image">
                                    <?php else : ?>
                                        <div class="category-placeholder">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="category-info">
                                        <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                                        <p class="category-count"><?php echo sprintf(_n('%d item', '%d items', $category->count, 'alam-alanaqah'), $category->count); ?></p>
                                    </div>
                                </a>
                            </div>
                <?php 
                        endforeach;
                    } else {
                        // Default categories if no WooCommerce categories exist
                        $default_categories = array(
                            array('name' => __('Clothes', 'alam-alanaqah'), 'icon' => 'fas fa-tshirt', 'count' => '150'),
                            array('name' => __('Accessories', 'alam-alanaqah'), 'icon' => 'fas fa-watch', 'count' => '89'),
                            array('name' => __('Jewelry', 'alam-alanaqah'), 'icon' => 'fas fa-gem', 'count' => '67'),
                            array('name' => __('Perfumes', 'alam-alanaqah'), 'icon' => 'fas fa-spray-can', 'count' => '45'),
                        );
                        
                        foreach ($default_categories as $category) :
                ?>
                            <div class="category-card">
                                <a href="#">
                                    <div class="category-placeholder">
                                        <i class="<?php echo esc_attr($category['icon']); ?>"></i>
                                    </div>
                                    <div class="category-info">
                                        <h3 class="category-title"><?php echo esc_html($category['name']); ?></h3>
                                        <p class="category-count"><?php echo sprintf(__('%s items', 'alam-alanaqah'), $category['count']); ?></p>
                                    </div>
                                </a>
                            </div>
                <?php 
                        endforeach;
                    }
                } else {
                    // Default categories if WooCommerce is not installed
                    $default_categories = array(
                        array('name' => __('Clothes', 'alam-alanaqah'), 'icon' => 'fas fa-tshirt'),
                        array('name' => __('Accessories', 'alam-alanaqah'), 'icon' => 'fas fa-watch'),
                        array('name' => __('Jewelry', 'alam-alanaqah'), 'icon' => 'fas fa-gem'),
                        array('name' => __('Perfumes', 'alam-alanaqah'), 'icon' => 'fas fa-spray-can'),
                    );
                    
                    foreach ($default_categories as $category) :
                ?>
                        <div class="category-card">
                            <a href="#">
                                <div class="category-placeholder">
                                    <i class="<?php echo esc_attr($category['icon']); ?>"></i>
                                </div>
                                <div class="category-info">
                                    <h3 class="category-title"><?php echo esc_html($category['name']); ?></h3>
                                    <p class="category-count"><?php esc_html_e('Coming Soon', 'alam-alanaqah'); ?></p>
                                </div>
                            </a>
                        </div>
                <?php 
                    endforeach;
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <?php if (class_exists('WooCommerce')) : ?>
    <section class="featured-products-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php esc_html_e('Featured Products', 'alam-alanaqah'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Handpicked items from our luxury collection', 'alam-alanaqah'); ?></p>
            </div>
            
            <div class="products-grid">
                <?php
                $featured_products = wc_get_featured_product_ids();
                
                if (empty($featured_products)) {
                    // Get recent products if no featured products
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 8,
                        'meta_query' => array(
                            array(
                                'key' => '_visibility',
                                'value' => array('catalog', 'visible'),
                                'compare' => 'IN'
                            )
                        )
                    );
                } else {
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 8,
                        'post__in' => $featured_products,
                    );
                }
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        global $product;
                ?>
                        <div class="product-card">
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('alam-alanaqah-product-medium'); ?>
                                    <?php else : ?>
                                        <div class="product-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </a>
                                <div class="product-actions">
                                    <button class="quick-view" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="add-to-wishlist" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                                <?php if ($product->is_on_sale()) : ?>
                                    <span class="sale-badge"><?php esc_html_e('Sale', 'alam-alanaqah'); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="product-price">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                                <div class="product-rating">
                                    <?php woocommerce_template_loop_rating(); ?>
                                </div>
                                <button class="add-to-cart-btn" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">
                                    <?php esc_html_e('Add to Cart', 'alam-alanaqah'); ?>
                                </button>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            
            <div class="section-footer">
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-secondary">
                    <?php esc_html_e('View All Products', 'alam-alanaqah'); ?>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="feature-content">
                        <h3><?php esc_html_e('Free Shipping', 'alam-alanaqah'); ?></h3>
                        <p><?php esc_html_e('Free shipping on orders over $100', 'alam-alanaqah'); ?></p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3><?php esc_html_e('Easy Returns', 'alam-alanaqah'); ?></h3>
                        <p><?php esc_html_e('30-day return policy', 'alam-alanaqah'); ?></p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3><?php esc_html_e('Secure Payment', 'alam-alanaqah'); ?></h3>
                        <p><?php esc_html_e('100% secure transactions', 'alam-alanaqah'); ?></p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h3><?php esc_html_e('24/7 Support', 'alam-alanaqah'); ?></h3>
                        <p><?php esc_html_e('Always here to help', 'alam-alanaqah'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2><?php esc_html_e('Stay in Style', 'alam-alanaqah'); ?></h2>
                    <p><?php esc_html_e('Subscribe to our newsletter and be the first to know about new arrivals, exclusive offers, and fashion trends.', 'alam-alanaqah'); ?></p>
                </div>
                <div class="newsletter-form-wrapper">
                    <form class="newsletter-form" action="#" method="post">
                        <input type="email" name="newsletter_email" placeholder="<?php esc_attr_e('Enter your email address', 'alam-alanaqah'); ?>" required>
                        <button type="submit" class="btn btn-gold">
                            <?php esc_html_e('Subscribe', 'alam-alanaqah'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* Homepage Specific Styles */
.homepage {
    overflow-x: hidden;
}

/* Hero Section */
.hero-section {
    position: relative;
    min-height: 80vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--neutral-cream) 0%, var(--neutral-white) 100%);
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.1;
}

.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, var(--primary-gold) 2px, transparent 2px),
        radial-gradient(circle at 75% 75%, var(--primary-teal) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.hero-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    position: relative;
    z-index: 2;
}

.hero-text {
    max-width: 500px;
}

.hero-title {
    font-family: var(--font-primary);
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 20px;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: var(--neutral-dark-gray);
    line-height: 1.6;
    margin-bottom: 30px;
}

.hero-actions {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.hero-cta,
.hero-secondary {
    padding: 15px 30px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all var(--transition-medium);
}

.hero-image {
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-product-showcase {
    position: relative;
    width: 300px;
    height: 300px;
}

.showcase-item {
    position: absolute;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    display: flex;
    align-items: center;
    justify-content: center;
    animation: orbit 10s linear infinite;
}

.showcase-1 {
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    animation-delay: 0s;
}

.showcase-2 {
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    animation-delay: -3.33s;
}

.showcase-3 {
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    animation-delay: -6.67s;
}

.showcase-circle {
    width: 80px;
    height: 80px;
    background: white;
    border-radius: 50%;
    opacity: 0.9;
}

@keyframes orbit {
    0% {
        transform: rotate(0deg) translateX(100px) rotate(0deg);
    }
    100% {
        transform: rotate(360deg) translateX(100px) rotate(-360deg);
    }
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-title {
    font-family: var(--font-primary);
    font-size: 2.5rem;
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--neutral-medium-gray);
    max-width: 500px;
    margin: 0 auto;
}

/* Categories Section */
.categories-section {
    padding: 80px 0;
    background-color: var(--neutral-light-gray);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.category-card {
    position: relative;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    transition: all var(--transition-medium);
    aspect-ratio: 1;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-strong);
}

.category-card a {
    display: block;
    height: 100%;
    text-decoration: none;
    position: relative;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.category-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

.category-card:hover .category-image {
    transform: scale(1.1);
}

.category-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 30px 20px 20px;
}

.category-title {
    font-family: var(--font-primary);
    font-size: 1.5rem;
    margin-bottom: 5px;
}

.category-count {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Featured Products Section */
.featured-products-section {
    padding: 80px 0;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.product-card {
    background: white;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
    transition: all var(--transition-medium);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

.product-image {
    position: relative;
    aspect-ratio: 1;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.product-placeholder {
    width: 100%;
    height: 100%;
    background: var(--neutral-light-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--neutral-medium-gray);
    font-size: 2rem;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-actions {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    opacity: 0;
    transition: opacity var(--transition-medium);
}

.product-card:hover .product-actions {
    opacity: 1;
}

.quick-view,
.add-to-wishlist {
    width: 40px;
    height: 40px;
    background: white;
    border: none;
    border-radius: 50%;
    color: var(--neutral-charcoal);
    cursor: pointer;
    transition: all var(--transition-fast);
    box-shadow: var(--shadow-subtle);
}

.quick-view:hover,
.add-to-wishlist:hover {
    background: var(--primary-gold);
    color: white;
    transform: scale(1.1);
}

.sale-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: var(--primary-gold);
    color: white;
    padding: 5px 10px;
    border-radius: var(--border-radius-sm);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.product-info {
    padding: 20px;
}

.product-title {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.product-title a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.product-title a:hover {
    color: var(--primary-teal);
}

.product-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-gold);
    margin-bottom: 10px;
}

.product-rating {
    margin-bottom: 15px;
}

.add-to-cart-btn {
    width: 100%;
    padding: 10px;
    background: var(--primary-teal);
    color: white;
    border: none;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.add-to-cart-btn:hover {
    background: var(--primary-gold);
}

.section-footer {
    text-align: center;
}

/* Features Section */
.features-section {
    padding: 60px 0;
    background-color: var(--neutral-light-gray);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 20px;
    text-align: left;
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.feature-content h3 {
    font-family: var(--font-secondary);
    font-size: 1.1rem;
    color: var(--neutral-charcoal);
    margin-bottom: 5px;
}

.feature-content p {
    color: var(--neutral-medium-gray);
    font-size: 0.9rem;
    margin: 0;
}

/* Newsletter Section */
.newsletter-section {
    padding: 80px 0;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    color: white;
}

.newsletter-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.newsletter-text h2 {
    font-family: var(--font-primary);
    font-size: 2.5rem;
    color: white;
    margin-bottom: 20px;
}

.newsletter-text p {
    font-size: 1.1rem;
    opacity: 0.9;
    line-height: 1.6;
}

.newsletter-form {
    display: flex;
    gap: 15px;
    max-width: 400px;
}

.newsletter-form input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: var(--border-radius-md);
    font-size: 16px;
    outline: none;
}

.newsletter-form button {
    padding: 15px 25px;
    border: none;
    border-radius: var(--border-radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-medium);
    white-space: nowrap;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-content {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
    }
    
    .newsletter-content {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .categories-grid,
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .feature-item {
        flex-direction: column;
        text-align: center;
    }
    
    .newsletter-form {
        flex-direction: column;
        gap: 15px;
    }
    
    .hero-actions {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .newsletter-text h2 {
        font-size: 2rem;
    }
    
    .categories-grid,
    .products-grid {
        grid-template-columns: 1fr;
    }
    
    .showcase-item {
        width: 80px;
        height: 80px;
    }
    
    .showcase-circle {
        width: 60px;
        height: 60px;
    }
}
</style>

<script>
// Homepage interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            // Add AJAX call to add product to cart
            this.innerHTML = '<i class="fas fa-check"></i> Added!';
            setTimeout(() => {
                this.innerHTML = 'Add to Cart';
            }, 2000);
        });
    });
    
    // Wishlist functionality
    const wishlistButtons = document.querySelectorAll('.add-to-wishlist');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            if (this.classList.contains('active')) {
                icon.style.color = '#e74c3c';
            } else {
                icon.style.color = '';
            }
        });
    });
    
    // Newsletter form
    const newsletterForm = document.querySelector('.newsletter-section .newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[name="newsletter_email"]').value;
            
            if (email) {
                const button = this.querySelector('button');
                button.innerHTML = '<i class="fas fa-check"></i> Subscribed!';
                this.querySelector('input[name="newsletter_email"]').value = '';
                
                setTimeout(() => {
                    button.innerHTML = 'Subscribe';
                }, 3000);
            }
        });
    }
});
</script>

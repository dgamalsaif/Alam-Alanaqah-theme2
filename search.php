<?php
/**
 * The template for displaying search results pages
 *
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main search-results">
    <div class="container">
        
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'alam-alanaqah'),
                    '<span class="search-term">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            
            <?php if (have_posts()) : ?>
                <p class="search-results-count">
                    <?php
                    global $wp_query;
                    printf(
                        _n(
                            'Found %d result',
                            'Found %d results',
                            $wp_query->found_posts,
                            'alam-alanaqah'
                        ),
                        $wp_query->found_posts
                    );
                    ?>
                </p>
            <?php endif; ?>
            
            <!-- Search Form -->
            <div class="search-form-container">
                <?php get_search_form(); ?>
            </div>
        </header>

        <?php if (have_posts()) : ?>
            
            <!-- Search Filters -->
            <div class="search-filters">
                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">
                        <?php esc_html_e('All Results', 'alam-alanaqah'); ?>
                        <span class="count">(<?php echo $wp_query->found_posts; ?>)</span>
                    </button>
                    
                    <?php
                    // Count results by post type
                    $post_types = array();
                    while (have_posts()) : the_post();
                        $post_type = get_post_type();
                        if (!isset($post_types[$post_type])) {
                            $post_types[$post_type] = 0;
                        }
                        $post_types[$post_type]++;
                    endwhile;
                    wp_reset_postdata();
                    
                    foreach ($post_types as $post_type => $count) :
                        $post_type_obj = get_post_type_object($post_type);
                        if ($post_type_obj) :
                    ?>
                        <button class="filter-tab" data-filter="<?php echo esc_attr($post_type); ?>">
                            <?php echo esc_html($post_type_obj->labels->name); ?>
                            <span class="count">(<?php echo $count; ?>)</span>
                        </button>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
            </div>

            <!-- Search Results -->
            <div class="search-results-container">
                <div class="results-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?> data-post-type="<?php echo esc_attr(get_post_type()); ?>">
                            
                            <!-- Result Image -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="result-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('alam-alanaqah-thumbnail', array('class' => 'result-image')); ?>
                                    </a>
                                    <div class="post-type-badge">
                                        <?php
                                        $post_type_obj = get_post_type_object(get_post_type());
                                        echo esc_html($post_type_obj->labels->singular_name);
                                        ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="result-thumbnail no-image">
                                    <div class="placeholder-icon">
                                        <?php if (get_post_type() === 'product') : ?>
                                            <i class="fas fa-shopping-bag"></i>
                                        <?php else : ?>
                                            <i class="fas fa-file-alt"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="post-type-badge">
                                        <?php
                                        $post_type_obj = get_post_type_object(get_post_type());
                                        echo esc_html($post_type_obj->labels->singular_name);
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Result Content -->
                            <div class="result-content">
                                <div class="result-meta">
                                    <span class="result-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    
                                    <?php if (get_post_type() === 'post') : ?>
                                        <span class="result-category">
                                            <i class="fas fa-folder"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php elseif (get_post_type() === 'product' && function_exists('wc_get_product')) : ?>
                                        <?php
                                        $product = wc_get_product(get_the_ID());
                                        if ($product) :
                                        ?>
                                            <span class="result-price">
                                                <i class="fas fa-tag"></i>
                                                <?php echo $product->get_price_html(); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <h3 class="result-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $title = get_the_title();
                                        $search_query = get_search_query();
                                        
                                        // Highlight search terms in title
                                        if ($search_query) {
                                            $title = str_ireplace($search_query, '<mark>' . $search_query . '</mark>', $title);
                                        }
                                        
                                        echo $title;
                                        ?>
                                    </a>
                                </h3>

                                <div class="result-excerpt">
                                    <?php
                                    $excerpt = get_the_excerpt();
                                    $search_query = get_search_query();
                                    
                                    // Highlight search terms in excerpt
                                    if ($search_query) {
                                        $excerpt = str_ireplace($search_query, '<mark>' . $search_query . '</mark>', $excerpt);
                                    }
                                    
                                    echo wp_trim_words($excerpt, 20);
                                    ?>
                                </div>

                                <div class="result-footer">
                                    <a href="<?php the_permalink(); ?>" class="result-link">
                                        <?php esc_html_e('Read More', 'alam-alanaqah'); ?>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    
                                    <?php if (get_post_type() === 'product' && function_exists('wc_get_product')) : ?>
                                        <?php
                                        $product = wc_get_product(get_the_ID());
                                        if ($product && $product->is_purchasable()) :
                                        ?>
                                            <button class="add-to-cart-quick" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">
                                                <i class="fas fa-shopping-cart"></i>
                                                <?php esc_html_e('Add to Cart', 'alam-alanaqah'); ?>
                                            </button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__('Previous', 'alam-alanaqah'),
                    'next_text' => esc_html__('Next', 'alam-alanaqah'),
                ));
                ?>
            </div>

        <?php else : ?>
            
            <!-- No Results -->
            <section class="no-results">
                <div class="no-results-content">
                    <div class="no-results-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2><?php esc_html_e('Nothing Found', 'alam-alanaqah'); ?></h2>
                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'alam-alanaqah'); ?></p>
                    
                    <!-- Alternative Search Form -->
                    <div class="alternative-search">
                        <?php get_search_form(); ?>
                    </div>
                    
                    <!-- Search Suggestions -->
                    <div class="search-suggestions">
                        <h3><?php esc_html_e('Search Suggestions:', 'alam-alanaqah'); ?></h3>
                        <ul>
                            <li><?php esc_html_e('Check your spelling', 'alam-alanaqah'); ?></li>
                            <li><?php esc_html_e('Try more general keywords', 'alam-alanaqah'); ?></li>
                            <li><?php esc_html_e('Try different keywords', 'alam-alanaqah'); ?></li>
                            <li><?php esc_html_e('Try fewer keywords', 'alam-alanaqah'); ?></li>
                        </ul>
                    </div>
                    
                    <!-- Popular Categories/Products -->
                    <?php if (class_exists('WooCommerce')) : ?>
                        <div class="popular-categories">
                            <h3><?php esc_html_e('Popular Categories', 'alam-alanaqah'); ?></h3>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                'number' => 6,
                            ));
                            
                            if (!empty($categories)) :
                            ?>
                                <ul class="category-links">
                                    <?php foreach ($categories as $category) : ?>
                                        <li>
                                            <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>

<style>
/* Search Results Styles */
.search-results {
    padding: 40px 0;
    min-height: 60vh;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #eee;
}

.page-title {
    font-family: var(--font-primary);
    font-size: 2.5rem;
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.search-term {
    color: var(--primary-gold);
    font-style: italic;
}

.search-results-count {
    color: var(--neutral-medium-gray);
    font-size: 1.1rem;
    margin-bottom: 20px;
}

.search-form-container {
    max-width: 500px;
    margin: 0 auto;
}

/* Search Filters */
.search-filters {
    margin-bottom: 30px;
    text-align: center;
}

.filter-tabs {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
}

.filter-tab {
    background: transparent;
    border: 1px solid #ddd;
    padding: 10px 20px;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    font-weight: 500;
    transition: all var(--transition-fast);
    color: var(--neutral-charcoal);
}

.filter-tab:hover,
.filter-tab.active {
    background: var(--primary-teal);
    color: white;
    border-color: var(--primary-teal);
}

.filter-tab .count {
    font-size: 0.9em;
    opacity: 0.8;
}

/* Results Grid */
.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.search-result-item {
    background: white;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
    transition: all var(--transition-medium);
    border: 1px solid #f0f0f0;
}

.search-result-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-medium);
}

.result-thumbnail {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
}

.result-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.search-result-item:hover .result-image {
    transform: scale(1.05);
}

.result-thumbnail.no-image {
    background: var(--neutral-light-gray);
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-icon {
    font-size: 3rem;
    color: var(--neutral-medium-gray);
}

.post-type-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: var(--primary-teal);
    color: white;
    padding: 4px 8px;
    border-radius: var(--border-radius-sm);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.result-content {
    padding: 20px;
}

.result-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 10px;
    font-size: 14px;
    color: var(--neutral-medium-gray);
}

.result-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.result-meta i {
    color: var(--primary-gold);
}

.result-meta a {
    color: inherit;
    text-decoration: none;
    transition: color var(--transition-fast);
}

.result-meta a:hover {
    color: var(--primary-teal);
}

.result-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.4;
}

.result-title a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.result-title a:hover {
    color: var(--primary-teal);
}

.result-title mark {
    background: var(--primary-gold);
    color: white;
    padding: 2px 4px;
    border-radius: 2px;
}

.result-excerpt {
    color: var(--neutral-dark-gray);
    line-height: 1.6;
    margin-bottom: 15px;
}

.result-excerpt mark {
    background: rgba(212, 175, 55, 0.2);
    color: var(--primary-teal);
    padding: 2px 4px;
    border-radius: 2px;
}

.result-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f0f0f0;
    padding-top: 15px;
}

.result-link {
    color: var(--primary-teal);
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: color var(--transition-fast);
}

.result-link:hover {
    color: var(--primary-gold);
}

.add-to-cart-quick {
    background: var(--primary-gold);
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: var(--border-radius-sm);
    font-size: 14px;
    cursor: pointer;
    transition: background var(--transition-fast);
    display: flex;
    align-items: center;
    gap: 5px;
}

.add-to-cart-quick:hover {
    background: var(--primary-teal);
}

/* No Results */
.no-results {
    text-align: center;
    padding: 60px 20px;
}

.no-results-content {
    max-width: 600px;
    margin: 0 auto;
}

.no-results-icon {
    font-size: 4rem;
    color: var(--neutral-medium-gray);
    margin-bottom: 20px;
}

.no-results h2 {
    color: var(--primary-teal);
    margin-bottom: 15px;
    font-size: 2rem;
}

.no-results p {
    color: var(--neutral-dark-gray);
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.alternative-search {
    margin-bottom: 40px;
}

.search-suggestions {
    background: var(--neutral-light-gray);
    padding: 30px;
    border-radius: var(--border-radius-lg);
    margin-bottom: 30px;
}

.search-suggestions h3 {
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.search-suggestions ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.search-suggestions li {
    padding: 5px 0;
    color: var(--neutral-dark-gray);
}

.search-suggestions li::before {
    content: '•';
    color: var(--primary-gold);
    margin-right: 10px;
}

.popular-categories h3 {
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.category-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.category-links a {
    background: var(--primary-teal);
    color: white;
    padding: 8px 16px;
    border-radius: var(--border-radius-sm);
    text-decoration: none;
    transition: background var(--transition-fast);
}

.category-links a:hover {
    background: var(--primary-gold);
}

/* Filter functionality */
.search-result-item.hidden {
    display: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .results-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .filter-tabs {
        flex-direction: column;
        align-items: center;
    }
    
    .result-footer {
        flex-direction: column;
        gap: 10px;
        align-items: stretch;
    }
    
    .result-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .category-links {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 480px) {
    .search-results {
        padding: 20px 0;
    }
    
    .result-content {
        padding: 15px;
    }
    
    .search-suggestions {
        padding: 20px;
    }
}

/* RTL Support */
[dir="rtl"] .result-meta {
    direction: rtl;
}

[dir="rtl"] .result-footer {
    direction: rtl;
}

[dir="rtl"] .search-suggestions li::before {
    margin-right: 0;
    margin-left: 10px;
}
</style>

<script>
// Search filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const resultItems = document.querySelectorAll('.search-result-item');
    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active tab
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Filter results
            resultItems.forEach(item => {
                const postType = item.getAttribute('data-post-type');
                
                if (filter === 'all' || postType === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
    
    // Quick add to cart
    const addToCartButtons = document.querySelectorAll('.add-to-cart-quick');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const originalText = this.innerHTML;
            
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            this.disabled = true;
            
            // Simulate add to cart
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-check"></i> Added!';
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 2000);
            }, 1000);
        });
    });
});
</script>

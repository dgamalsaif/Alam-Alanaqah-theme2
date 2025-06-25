<?php
/**
 * The main template file
 *
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <?php if (have_posts()) : ?>
            
            <header class="page-header">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                <?php elseif (is_search()) : ?>
                    <h1 class="page-title">
                        <?php
                        printf(
                            esc_html__('Search Results for: %s', 'alam-alanaqah'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                <?php elseif (is_archive()) : ?>
                    <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
                    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                <?php endif; ?>
            </header>

            <div class="posts-container">
                <div class="posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('alam-alanaqah-featured', array('class' => 'post-image')); ?>
                                    </a>
                                    <div class="post-overlay">
                                        <a href="<?php the_permalink(); ?>" class="read-more-link">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="post-category">
                                        <i class="fas fa-folder"></i>
                                        <?php the_category(', '); ?>
                                    </span>
                                </div>

                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="post-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
                                        <?php esc_html_e('Read More', 'alam-alanaqah'); ?>
                                    </a>
                                    <div class="post-author">
                                        <i class="fas fa-user"></i>
                                        <?php the_author(); ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__('Previous', 'alam-alanaqah'),
                    'next_text' => esc_html__('Next', 'alam-alanaqah'),
                ));
                ?>
            </div>

        <?php else : ?>
            
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Nothing here', 'alam-alanaqah'); ?></h1>
                </header>

                <div class="page-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'alam-alanaqah'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url(admin_url('post-new.php'))
                            );
                            ?>
                        </p>
                    <?php elseif (is_search()) : ?>
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'alam-alanaqah'); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'alam-alanaqah'); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </section>

        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>

<style>
/* Blog & Archive Styles */
.page-header {
    text-align: center;
    padding: 40px 0;
    margin-bottom: 40px;
    border-bottom: 1px solid #eee;
}

.page-title {
    font-family: var(--font-primary);
    font-size: 2.5rem;
    color: var(--primary-teal);
    margin-bottom: 15px;
}

.page-title span {
    color: var(--primary-gold);
    font-style: italic;
}

.archive-description {
    font-size: 1.1rem;
    color: var(--neutral-medium-gray);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.posts-container {
    margin-bottom: 60px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.post-card {
    background: white;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
    transition: all var(--transition-medium);
    border: 1px solid #f0f0f0;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

.post-thumbnail {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
}

.post-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.post-card:hover .post-image {
    transform: scale(1.05);
}

.post-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(27, 75, 76, 0.8), rgba(212, 175, 55, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-medium);
}

.post-card:hover .post-overlay {
    opacity: 1;
}

.read-more-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    color: var(--primary-teal);
    font-size: 18px;
    text-decoration: none;
    transition: all var(--transition-medium);
}

.read-more-link:hover {
    background: var(--primary-gold);
    color: white;
    transform: scale(1.1);
}

.post-content {
    padding: 25px;
}

.post-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
    font-size: 14px;
    color: var(--neutral-medium-gray);
}

.post-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.post-meta i {
    color: var(--primary-gold);
}

.post-meta a {
    color: inherit;
    text-decoration: none;
    transition: color var(--transition-fast);
}

.post-meta a:hover {
    color: var(--primary-teal);
}

.post-title {
    font-family: var(--font-primary);
    font-size: 1.25rem;
    margin-bottom: 15px;
    line-height: 1.4;
}

.post-title a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.post-title a:hover {
    color: var(--primary-teal);
}

.post-excerpt {
    color: var(--neutral-dark-gray);
    line-height: 1.6;
    margin-bottom: 20px;
}

.post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f0f0f0;
    padding-top: 20px;
}

.btn-sm {
    padding: 8px 16px;
    font-size: 14px;
}

.post-author {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    color: var(--neutral-medium-gray);
}

.post-author i {
    color: var(--primary-gold);
}

/* Pagination */
.navigation.pagination {
    text-align: center;
    margin-top: 40px;
}

.nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.page-numbers {
    display: inline-block;
    padding: 10px 15px;
    background: white;
    color: var(--neutral-charcoal);
    text-decoration: none;
    border: 1px solid #ddd;
    border-radius: var(--border-radius-sm);
    transition: all var(--transition-fast);
    font-weight: 500;
}

.page-numbers:hover,
.page-numbers.current {
    background: var(--primary-teal);
    color: white;
    border-color: var(--primary-teal);
}

.page-numbers.dots {
    background: transparent;
    border: none;
    cursor: default;
}

.page-numbers.dots:hover {
    background: transparent;
    color: var(--neutral-charcoal);
}

/* No Results */
.no-results {
    text-align: center;
    padding: 60px 20px;
}

.no-results .page-title {
    margin-bottom: 20px;
}

.no-results .page-content {
    max-width: 500px;
    margin: 0 auto;
}

.no-results .page-content p {
    font-size: 1.1rem;
    color: var(--neutral-dark-gray);
    margin-bottom: 20px;
}

/* Search Form */
.search-form {
    display: flex;
    max-width: 400px;
    margin: 20px auto;
    border-radius: var(--border-radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
}

.search-form label {
    flex: 1;
    margin: 0;
}

.search-form input[type="search"] {
    width: 100%;
    padding: 12px 15px;
    border: none;
    font-size: 16px;
    outline: none;
}

.search-form button {
    background: var(--primary-teal);
    color: white;
    border: none;
    padding: 12px 20px;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.search-form button:hover {
    background: var(--primary-gold);
}

/* Responsive Design */
@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .post-footer {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .post-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .nav-links {
        gap: 5px;
    }
    
    .page-numbers {
        padding: 8px 12px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .page-header {
        padding: 20px 0;
    }
    
    .post-content {
        padding: 20px;
    }
    
    .posts-grid {
        grid-template-columns: 1fr;
    }
}

/* RTL Support */
[dir="rtl"] .post-meta {
    direction: rtl;
}

[dir="rtl"] .post-footer {
    direction: rtl;
}

[dir="rtl"] .nav-links {
    direction: rtl;
}
</style>

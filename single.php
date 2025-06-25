<?php
/**
 * The template for displaying all single posts
 *
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main single-post">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?>>
                
                <!-- Post Header -->
                <header class="post-header">
                    <div class="post-meta">
                        <span class="post-date">
                            <i class="fas fa-calendar-alt"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="post-category">
                            <i class="fas fa-folder"></i>
                            <?php the_category(', '); ?>
                        </span>
                        <span class="post-author">
                            <i class="fas fa-user"></i>
                            <?php the_author(); ?>
                        </span>
                        <?php if (comments_open()) : ?>
                        <span class="post-comments">
                            <i class="fas fa-comments"></i>
                            <a href="#comments"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('alam-alanaqah-hero', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Post Content -->
                <div class="post-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'alam-alanaqah'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Post Footer -->
                <footer class="post-footer">
                    <div class="post-tags">
                        <?php the_tags('<span class="tags-label"><i class="fas fa-tags"></i> ' . esc_html__('Tags:', 'alam-alanaqah') . '</span> ', ', ', ''); ?>
                    </div>
                    
                    <div class="post-share">
                        <h4><?php esc_html_e('Share this post:', 'alam-alanaqah'); ?></h4>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url(get_post_thumbnail_id())); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-pinterest">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-email">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>

            <!-- Author Bio -->
            <?php if (get_the_author_meta('description')) : ?>
            <div class="author-bio">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('user_email'), 80); ?>
                </div>
                <div class="author-info">
                    <h3 class="author-name"><?php the_author(); ?></h3>
                    <p class="author-description"><?php the_author_meta('description'); ?></p>
                    <div class="author-links">
                        <?php if (get_the_author_meta('url')) : ?>
                            <a href="<?php the_author_meta('url'); ?>" target="_blank" rel="noopener">
                                <i class="fas fa-globe"></i> <?php esc_html_e('Website', 'alam-alanaqah'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Related Posts -->
            <?php
            $related_posts = get_posts(array(
                'category__in' => wp_get_post_categories(get_the_ID()),
                'numberposts'  => 3,
                'post__not_in' => array(get_the_ID()),
            ));
            
            if ($related_posts) :
            ?>
            <section class="related-posts">
                <h3 class="related-posts-title"><?php esc_html_e('Related Posts', 'alam-alanaqah'); ?></h3>
                <div class="related-posts-grid">
                    <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                        <article class="related-post">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="related-post-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('alam-alanaqah-thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="related-post-content">
                                <h4 class="related-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="related-post-meta">
                                    <span class="related-post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- Post Navigation -->
            <nav class="post-navigation">
                <div class="nav-previous">
                    <?php
                    $prev_post = get_previous_post();
                    if ($prev_post) :
                    ?>
                        <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link">
                            <span class="nav-direction">
                                <i class="fas fa-arrow-left"></i>
                                <?php esc_html_e('Previous Post', 'alam-alanaqah'); ?>
                            </span>
                            <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="nav-next">
                    <?php
                    $next_post = get_next_post();
                    if ($next_post) :
                    ?>
                        <a href="<?php echo get_permalink($next_post); ?>" class="nav-link">
                            <span class="nav-direction">
                                <?php esc_html_e('Next Post', 'alam-alanaqah'); ?>
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-wrapper">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
        
    </div>
</main>

<?php get_footer(); ?>

<style>
/* Single Post Styles */
.single-post {
    padding: 40px 0;
}

.single-post-article {
    max-width: 800px;
    margin: 0 auto 60px;
}

/* Post Header */
.post-header {
    margin-bottom: 40px;
}

.post-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
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
    font-size: 2.5rem;
    line-height: 1.2;
    color: var(--primary-teal);
    margin-bottom: 30px;
}

.post-featured-image {
    margin-bottom: 30px;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-medium);
}

.featured-image {
    width: 100%;
    height: auto;
    display: block;
}

/* Post Content */
.post-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--neutral-charcoal);
    margin-bottom: 40px;
}

.post-content h1,
.post-content h2,
.post-content h3,
.post-content h4,
.post-content h5,
.post-content h6 {
    margin-top: 2em;
    margin-bottom: 1em;
    color: var(--primary-teal);
}

.post-content h2 {
    font-size: 1.8rem;
    border-bottom: 2px solid var(--primary-gold);
    padding-bottom: 10px;
}

.post-content h3 {
    font-size: 1.5rem;
}

.post-content p {
    margin-bottom: 1.5em;
}

.post-content blockquote {
    background: var(--neutral-light-gray);
    border-left: 4px solid var(--primary-gold);
    padding: 20px 30px;
    margin: 2em 0;
    font-style: italic;
    position: relative;
}

.post-content blockquote::before {
    content: '"';
    font-size: 4rem;
    color: var(--primary-gold);
    position: absolute;
    top: 10px;
    left: 10px;
    font-family: serif;
}

.post-content ul,
.post-content ol {
    margin-bottom: 1.5em;
    padding-left: 2em;
}

.post-content li {
    margin-bottom: 0.5em;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-subtle);
}

.post-content a {
    color: var(--primary-teal);
    text-decoration: underline;
    transition: color var(--transition-fast);
}

.post-content a:hover {
    color: var(--primary-gold);
}

.page-links {
    margin-top: 2em;
    padding-top: 1em;
    border-top: 1px solid #eee;
    text-align: center;
}

.page-links a {
    display: inline-block;
    padding: 8px 12px;
    margin: 0 5px;
    background: var(--neutral-light-gray);
    color: var(--neutral-charcoal);
    text-decoration: none;
    border-radius: var(--border-radius-sm);
    transition: all var(--transition-fast);
}

.page-links a:hover {
    background: var(--primary-teal);
    color: white;
}

/* Post Footer */
.post-footer {
    border-top: 1px solid #eee;
    padding-top: 30px;
    margin-bottom: 40px;
}

.post-tags {
    margin-bottom: 30px;
}

.tags-label {
    color: var(--neutral-medium-gray);
    font-weight: 600;
    margin-right: 10px;
}

.post-tags a {
    display: inline-block;
    background: var(--neutral-light-gray);
    color: var(--neutral-charcoal);
    padding: 5px 12px;
    margin: 0 5px 5px 0;
    border-radius: var(--border-radius-sm);
    text-decoration: none;
    font-size: 14px;
    transition: all var(--transition-fast);
}

.post-tags a:hover {
    background: var(--primary-teal);
    color: white;
}

.post-share h4 {
    color: var(--primary-teal);
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.share-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.share-buttons a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all var(--transition-fast);
}

.share-facebook { background: #3b5998; }
.share-twitter { background: #1da1f2; }
.share-linkedin { background: #0077b5; }
.share-pinterest { background: #bd081c; }
.share-email { background: var(--neutral-charcoal); }

.share-buttons a:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* Author Bio */
.author-bio {
    display: flex;
    gap: 20px;
    background: var(--neutral-light-gray);
    padding: 30px;
    border-radius: var(--border-radius-lg);
    margin-bottom: 40px;
}

.author-avatar img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
}

.author-info {
    flex: 1;
}

.author-name {
    color: var(--primary-teal);
    margin-bottom: 10px;
    font-size: 1.3rem;
}

.author-description {
    color: var(--neutral-dark-gray);
    line-height: 1.6;
    margin-bottom: 15px;
}

.author-links a {
    color: var(--primary-teal);
    text-decoration: none;
    font-size: 14px;
    transition: color var(--transition-fast);
}

.author-links a:hover {
    color: var(--primary-gold);
}

/* Related Posts */
.related-posts {
    margin-bottom: 40px;
}

.related-posts-title {
    text-align: center;
    color: var(--primary-teal);
    margin-bottom: 30px;
    font-size: 2rem;
    font-family: var(--font-primary);
}

.related-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.related-post {
    background: white;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
    transition: all var(--transition-medium);
}

.related-post:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

.related-post-image {
    aspect-ratio: 16/10;
    overflow: hidden;
}

.related-post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.related-post:hover .related-post-image img {
    transform: scale(1.05);
}

.related-post-content {
    padding: 20px;
}

.related-post-title {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.related-post-title a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.related-post-title a:hover {
    color: var(--primary-teal);
}

.related-post-meta {
    font-size: 14px;
    color: var(--neutral-medium-gray);
}

/* Post Navigation */
.post-navigation {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 40px;
}

.nav-previous {
    text-align: left;
}

.nav-next {
    text-align: right;
}

.nav-link {
    display: block;
    padding: 20px;
    background: var(--neutral-light-gray);
    border-radius: var(--border-radius-lg);
    text-decoration: none;
    transition: all var(--transition-medium);
}

.nav-link:hover {
    background: var(--primary-teal);
    color: white;
    transform: translateY(-2px);
}

.nav-direction {
    display: block;
    font-size: 14px;
    color: var(--neutral-medium-gray);
    margin-bottom: 5px;
    font-weight: 600;
}

.nav-link:hover .nav-direction {
    color: rgba(255, 255, 255, 0.8);
}

.nav-title {
    display: block;
    font-weight: 600;
    color: var(--neutral-charcoal);
}

.nav-link:hover .nav-title {
    color: white;
}

/* Comments */
.comments-wrapper {
    background: var(--neutral-light-gray);
    padding: 40px;
    border-radius: var(--border-radius-lg);
}

/* Responsive Design */
@media (max-width: 768px) {
    .post-title {
        font-size: 2rem;
    }
    
    .post-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .author-bio {
        flex-direction: column;
        text-align: center;
    }
    
    .related-posts-grid {
        grid-template-columns: 1fr;
    }
    
    .post-navigation {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .nav-next {
        text-align: left;
    }
    
    .share-buttons {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .single-post {
        padding: 20px 0;
    }
    
    .post-title {
        font-size: 1.8rem;
    }
    
    .post-content {
        font-size: 1rem;
    }
    
    .author-bio,
    .comments-wrapper {
        padding: 20px;
    }
}

/* RTL Support */
[dir="rtl"] .post-meta {
    direction: rtl;
}

[dir="rtl"] .share-buttons {
    direction: rtl;
}

[dir="rtl"] .author-bio {
    direction: rtl;
}

[dir="rtl"] .nav-previous {
    text-align: right;
}

[dir="rtl"] .nav-next {
    text-align: left;
}
</style>

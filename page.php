<?php
/**
 * The template for displaying all pages
 *
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main page-template">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="page-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                
                <!-- Page Header -->
                <header class="page-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-featured-image">
                            <?php the_post_thumbnail('alam-alanaqah-hero', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="page-title-wrapper">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        
                        <?php if (has_excerpt()) : ?>
                            <div class="page-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="page-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'alam-alanaqah'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Page Footer -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <footer class="page-footer">
                        <div class="comments-wrapper">
                            <?php comments_template(); ?>
                        </div>
                    </footer>
                <?php endif; ?>
                
            </article>

        <?php endwhile; ?>
        
    </div>
</main>

<?php get_footer(); ?>

<style>
/* Page Template Styles */
.page-template {
    padding: 40px 0;
    min-height: 60vh;
}

.page-article {
    max-width: 1000px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    margin-bottom: 40px;
    text-align: center;
}

.page-featured-image {
    margin-bottom: 30px;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-medium);
    max-height: 400px;
}

.page-featured-image .featured-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.page-title {
    font-family: var(--font-primary);
    font-size: 3rem;
    line-height: 1.2;
    color: var(--primary-teal);
    margin-bottom: 20px;
}

.page-excerpt {
    font-size: 1.2rem;
    color: var(--neutral-dark-gray);
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

/* Page Content */
.page-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--neutral-charcoal);
    margin-bottom: 40px;
}

.page-content h1,
.page-content h2,
.page-content h3,
.page-content h4,
.page-content h5,
.page-content h6 {
    font-family: var(--font-primary);
    color: var(--primary-teal);
    margin-top: 2em;
    margin-bottom: 1em;
}

.page-content h2 {
    font-size: 2rem;
    border-bottom: 2px solid var(--primary-gold);
    padding-bottom: 10px;
    margin-bottom: 1.5em;
}

.page-content h3 {
    font-size: 1.6rem;
}

.page-content h4 {
    font-size: 1.3rem;
}

.page-content p {
    margin-bottom: 1.5em;
}

.page-content blockquote {
    background: var(--neutral-light-gray);
    border-left: 4px solid var(--primary-gold);
    padding: 20px 30px;
    margin: 2em 0;
    font-style: italic;
    position: relative;
    border-radius: var(--border-radius-sm);
}

.page-content blockquote::before {
    content: '"';
    font-size: 4rem;
    color: var(--primary-gold);
    position: absolute;
    top: 10px;
    left: 10px;
    font-family: serif;
    opacity: 0.3;
}

.page-content ul,
.page-content ol {
    margin-bottom: 1.5em;
    padding-left: 2em;
}

.page-content li {
    margin-bottom: 0.5em;
}

.page-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-subtle);
    margin: 1em 0;
}

.page-content a {
    color: var(--primary-teal);
    text-decoration: underline;
    transition: color var(--transition-fast);
}

.page-content a:hover {
    color: var(--primary-gold);
}

.page-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2em 0;
    background: white;
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
}

.page-content th,
.page-content td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.page-content th {
    background: var(--primary-teal);
    color: white;
    font-weight: 600;
}

.page-content tr:hover {
    background: var(--neutral-light-gray);
}

.page-content code {
    background: var(--neutral-light-gray);
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
    font-size: 0.9em;
}

.page-content pre {
    background: var(--neutral-charcoal);
    color: white;
    padding: 20px;
    border-radius: var(--border-radius-sm);
    overflow-x: auto;
    margin: 1.5em 0;
}

.page-content pre code {
    background: none;
    padding: 0;
    color: inherit;
}

/* Form Styles */
.page-content .wp-block-contact-form-7,
.page-content form {
    background: var(--neutral-light-gray);
    padding: 30px;
    border-radius: var(--border-radius-lg);
    margin: 2em 0;
}

.page-content input[type="text"],
.page-content input[type="email"],
.page-content input[type="tel"],
.page-content input[type="url"],
.page-content textarea,
.page-content select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: var(--border-radius-sm);
    font-size: 16px;
    margin-bottom: 15px;
    transition: border-color var(--transition-fast);
}

.page-content input:focus,
.page-content textarea:focus,
.page-content select:focus {
    outline: none;
    border-color: var(--primary-teal);
    box-shadow: 0 0 0 2px rgba(27, 75, 76, 0.1);
}

.page-content input[type="submit"],
.page-content button[type="submit"] {
    background: var(--primary-teal);
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    font-weight: 600;
    transition: all var(--transition-medium);
}

.page-content input[type="submit"]:hover,
.page-content button[type="submit"]:hover {
    background: var(--primary-gold);
    transform: translateY(-2px);
}

/* Page Links */
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

/* Page Footer */
.page-footer {
    border-top: 1px solid #eee;
    padding-top: 40px;
}

.comments-wrapper {
    background: var(--neutral-light-gray);
    padding: 40px;
    border-radius: var(--border-radius-lg);
}

/* Special Page Layouts */

/* Contact Page */
.page-template-contact .page-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

.contact-info {
    background: var(--primary-teal);
    color: white;
    padding: 40px;
    border-radius: var(--border-radius-lg);
}

.contact-info h3 {
    color: var(--primary-gold);
    margin-bottom: 20px;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.contact-item i {
    width: 30px;
    color: var(--primary-gold);
    margin-right: 15px;
    font-size: 1.2rem;
}

/* About Page */
.page-template-about .page-content {
    text-align: center;
}

.about-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin: 40px 0;
}

.about-feature {
    background: white;
    padding: 30px 20px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-subtle);
    transition: transform var(--transition-medium);
}

.about-feature:hover {
    transform: translateY(-5px);
}

.about-feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-teal), var(--primary-gold));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 20px;
}

.about-feature h4 {
    color: var(--primary-teal);
    margin-bottom: 15px;
}

/* Team Section */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin: 40px 0;
}

.team-member {
    text-align: center;
    background: white;
    padding: 30px 20px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-subtle);
    transition: transform var(--transition-medium);
}

.team-member:hover {
    transform: translateY(-5px);
}

.team-member img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-bottom: 20px;
    object-fit: cover;
}

.team-member h4 {
    color: var(--primary-teal);
    margin-bottom: 10px;
}

.team-member .position {
    color: var(--primary-gold);
    font-weight: 600;
    margin-bottom: 15px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2.2rem;
    }
    
    .page-content {
        font-size: 1rem;
    }
    
    .page-template-contact .page-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .about-features,
    .team-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .page-content .wp-block-contact-form-7,
    .page-content form {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .page-template {
        padding: 20px 0;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .page-featured-image {
        margin-bottom: 20px;
    }
    
    .contact-info {
        padding: 30px 20px;
    }
    
    .about-feature,
    .team-member {
        padding: 20px 15px;
    }
}

/* RTL Support */
[dir="rtl"] .page-content ul,
[dir="rtl"] .page-content ol {
    padding-left: 0;
    padding-right: 2em;
}

[dir="rtl"] .contact-item i {
    margin-right: 0;
    margin-left: 15px;
}

[dir="rtl"] .page-content th,
[dir="rtl"] .page-content td {
    text-align: right;
}

/* Print Styles */
@media print {
    .page-header,
    .page-footer,
    .comments-wrapper {
        break-inside: avoid;
    }
    
    .page-content a {
        text-decoration: none;
        color: inherit;
    }
    
    .page-content a::after {
        content: " (" attr(href) ")";
        font-size: 0.8em;
        color: #666;
    }
}
</style>

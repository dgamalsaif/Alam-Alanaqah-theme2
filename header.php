<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'alam-alanaqah'); ?></a>

    <header id="masthead" class="site-header">
        <!-- Header Top Bar -->
        <div class="header-top">
            <div class="container">
                <div class="header-top-content">
                    <div class="header-top-left">
                        <span><i class="fas fa-phone"></i> +1 (555) 123-4567</span>
                        <span><i class="fas fa-envelope"></i> info@alamalanaqah.com</span>
                    </div>
                    <div class="header-top-right">
                        <div class="language-switcher">
                            <?php if (function_exists('icl_get_languages')) : ?>
                                <?php
                                $languages = icl_get_languages('skip_missing=0&orderby=code');
                                if (!empty($languages)) :
                                    foreach ($languages as $lang) :
                                        if ($lang['active']) :
                                ?>
                                    <span class="current-lang"><?php echo esc_html($lang['native_name']); ?></span>
                                <?php 
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            <?php else : ?>
                                <span>EN | AR</span>
                            <?php endif; ?>
                        </div>
                        <div class="header-social">
                            <?php alam_alanaqah_social_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <!-- Logo -->
                    <div class="site-branding">
                        <div class="site-logo">
                            <?php
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } else {
                                if (file_exists(ALAM_ALANAQAH_THEME_DIR . '/logo.png')) {
                                    echo '<img src="' . esc_url(ALAM_ALANAQAH_THEME_URI . '/logo.png') . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                                }
                            }
                            ?>
                            <div class="site-title-wrapper">
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h1>
                                <?php
                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()) :
                                ?>
                                    <p class="site-description"><?php echo $description; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Main Navigation -->
                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'nav-menu',
                            'fallback_cb'    => 'alam_alanaqah_fallback_menu',
                        ));
                        ?>
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <span class="menu-toggle-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                            <span class="screen-reader-text"><?php esc_html_e('Menu', 'alam-alanaqah'); ?></span>
                        </button>
                    </nav>

                    <!-- Header Actions -->
                    <div class="header-actions">
                        <!-- Search -->
                        <div class="search-wrapper">
                            <button class="search-toggle" aria-expanded="false">
                                <i class="fas fa-search"></i>
                                <span class="screen-reader-text"><?php esc_html_e('Search', 'alam-alanaqah'); ?></span>
                            </button>
                            <div class="search-form-wrapper">
                                <?php get_search_form(); ?>
                            </div>
                        </div>

                        <!-- Account -->
                        <div class="account-wrapper">
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>" class="account-toggle">
                                <i class="fas fa-user"></i>
                                <span class="screen-reader-text"><?php esc_html_e('Account', 'alam-alanaqah'); ?></span>
                            </a>
                        </div>

                        <!-- Cart -->
                        <?php if (class_exists('WooCommerce')) : ?>
                        <div class="cart-wrapper">
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-toggle">
                                <i class="fas fa-shopping-bag"></i>
                                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                <span class="screen-reader-text"><?php esc_html_e('Cart', 'alam-alanaqah'); ?></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu-overlay"></div>
        <div class="mobile-menu">
            <div class="mobile-menu-header">
                <h3><?php esc_html_e('Menu', 'alam-alanaqah'); ?></h3>
                <button class="mobile-menu-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mobile-menu-content">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'mobile',
                    'menu_class'     => 'mobile-nav-menu',
                    'fallback_cb'    => 'alam_alanaqah_fallback_menu',
                ));
                ?>
            </div>
        </div>
    </header>

    <?php
    // Breadcrumb
    if (!is_front_page()) {
        echo '<div class="breadcrumb-wrapper">';
        echo '<div class="container">';
        alam_alanaqah_breadcrumb();
        echo '</div>';
        echo '</div>';
    }
    ?>

<?php
/**
 * Fallback menu function
 */
function alam_alanaqah_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'alam-alanaqah') . '</a></li>';
    
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '">' . esc_html__('Shop', 'alam-alanaqah') . '</a></li>';
        
        // Product categories
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
            'number' => 4,
        ));
        
        if (!empty($categories)) {
            foreach ($categories as $category) {
                echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
            }
        }
    }
    
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'alam-alanaqah') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'alam-alanaqah') . '</a></li>';
    echo '</ul>';
}

// Add CSS for header styling
?>
<style>
.header-top {
    background-color: var(--primary-teal);
    color: white;
    padding: 8px 0;
    font-size: 14px;
}

.header-top-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-top-left span {
    margin-right: 20px;
}

.header-top-left i {
    margin-right: 5px;
}

.header-top-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.language-switcher {
    font-size: 14px;
}

.header-social a {
    color: white;
    margin: 0 5px;
    font-size: 14px;
    transition: color 0.3s ease;
}

.header-social a:hover {
    color: var(--primary-gold);
}

.header-main {
    background-color: white;
    padding: 15px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.site-logo {
    display: flex;
    align-items: center;
}

.site-logo img {
    height: 50px;
    width: auto;
    margin-right: 15px;
}

.site-title {
    font-family: var(--font-primary);
    font-size: 24px;
    margin: 0;
    color: var(--primary-teal);
}

.site-title a {
    color: inherit;
    text-decoration: none;
}

.site-description {
    font-size: 12px;
    color: var(--neutral-medium-gray);
    margin: 0;
}

.main-navigation ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.main-navigation li {
    margin: 0 15px;
}

.main-navigation a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    font-weight: 500;
    padding: 10px 0;
    transition: color 0.3s ease;
}

.main-navigation a:hover {
    color: var(--primary-gold);
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.search-toggle,
.account-toggle,
.cart-toggle {
    background: none;
    border: none;
    font-size: 18px;
    color: var(--neutral-charcoal);
    cursor: pointer;
    transition: color 0.3s ease;
    text-decoration: none;
}

.search-toggle:hover,
.account-toggle:hover,
.cart-toggle:hover {
    color: var(--primary-gold);
}

.cart-wrapper {
    position: relative;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: var(--primary-gold);
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
}

.menu-toggle-icon {
    display: flex;
    flex-direction: column;
    width: 25px;
    height: 20px;
    justify-content: space-between;
}

.menu-toggle-icon span {
    height: 3px;
    background-color: var(--neutral-charcoal);
    transition: all 0.3s ease;
}

.search-form-wrapper {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #eee;
    border-radius: 5px;
    padding: 15px;
    width: 300px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    z-index: 1000;
}

.search-form-wrapper.active {
    display: block;
}

.mobile-menu {
    display: none;
    position: fixed;
    top: 0;
    right: -300px;
    width: 300px;
    height: 100vh;
    background: white;
    z-index: 9999;
    transition: right 0.3s ease;
    box-shadow: -5px 0 15px rgba(0,0,0,0.1);
}

.mobile-menu.active {
    right: 0;
}

.mobile-menu-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9998;
}

.mobile-menu-overlay.active {
    display: block;
}

.mobile-menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.mobile-menu-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

.mobile-menu-content {
    padding: 20px;
}

.mobile-nav-menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.mobile-nav-menu li {
    margin-bottom: 15px;
}

.mobile-nav-menu a {
    color: var(--neutral-charcoal);
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.breadcrumb-wrapper {
    background-color: var(--neutral-light-gray);
    padding: 15px 0;
    font-size: 14px;
}

.breadcrumb a {
    color: var(--neutral-medium-gray);
    text-decoration: none;
}

.breadcrumb a:hover {
    color: var(--primary-gold);
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-top-content {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .header-content {
        flex-wrap: wrap;
    }
    
    .main-navigation {
        display: none;
    }
    
    .menu-toggle {
        display: block;
    }
    
    .site-logo img {
        height: 40px;
    }
    
    .site-title {
        font-size: 20px;
    }
    
    .header-actions {
        gap: 15px;
    }
}

@media (max-width: 480px) {
    .header-top-left span {
        display: block;
        margin: 5px 0;
    }
    
    .search-form-wrapper {
        width: 250px;
    }
}
</style>

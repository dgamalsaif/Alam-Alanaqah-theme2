<?php
/**
 * Alam Alanaqah Theme Functions
 *
 * @package Alam_Alanaqah
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme constants
define('ALAM_ALANAQAH_VERSION', '1.0.0');
define('ALAM_ALANAQAH_THEME_DIR', get_template_directory());
define('ALAM_ALANAQAH_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function alam_alanaqah_setup() {
    // Add theme support for various features
    add_theme_support('automatic-feeds');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio'
    ));

    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add custom background support
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ));

    // Add WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'alam-alanaqah'),
        'footer'  => esc_html__('Footer Menu', 'alam-alanaqah'),
        'mobile'  => esc_html__('Mobile Menu', 'alam-alanaqah'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }

    // Load text domain for translations
    load_theme_textdomain('alam-alanaqah', ALAM_ALANAQAH_THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'alam_alanaqah_setup');

/**
 * Enqueue Scripts and Styles
 */
function alam_alanaqah_scripts() {
    // Google Fonts
    wp_enqueue_style('alam-alanaqah-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Main stylesheet
    wp_enqueue_style('alam-alanaqah-style', get_stylesheet_uri(), array(), ALAM_ALANAQAH_VERSION);
    
    // Custom CSS
    wp_enqueue_style('alam-alanaqah-custom', ALAM_ALANAQAH_THEME_URI . '/assets/css/custom.css', array('alam-alanaqah-style'), ALAM_ALANAQAH_VERSION);
    
    // WooCommerce styles
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('alam-alanaqah-woocommerce', ALAM_ALANAQAH_THEME_URI . '/assets/css/woocommerce.css', array(), ALAM_ALANAQAH_VERSION);
    }

    // JavaScript files
    wp_enqueue_script('alam-alanaqah-main', ALAM_ALANAQAH_THEME_URI . '/assets/js/main.js', array('jquery'), ALAM_ALANAQAH_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('alam-alanaqah-main', 'alamAlanaqah', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('alam_alanaqah_nonce'),
        'strings' => array(
            'loading' => esc_html__('Loading...', 'alam-alanaqah'),
            'error'   => esc_html__('Something went wrong. Please try again.', 'alam-alanaqah'),
        )
    ));

    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'alam_alanaqah_scripts');

/**
 * Register Widget Areas
 */
function alam_alanaqah_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'alam-alanaqah'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'alam-alanaqah'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 1', 'alam-alanaqah'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'alam-alanaqah'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 2', 'alam-alanaqah'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'alam-alanaqah'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 3', 'alam-alanaqah'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'alam-alanaqah'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Area 4', 'alam-alanaqah'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here.', 'alam-alanaqah'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'alam-alanaqah'),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__('Add widgets for shop pages.', 'alam-alanaqah'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'alam_alanaqah_widgets_init');

/**
 * Custom Image Sizes
 */
function alam_alanaqah_image_sizes() {
    add_image_size('alam-alanaqah-featured', 800, 600, true);
    add_image_size('alam-alanaqah-thumbnail', 400, 300, true);
    add_image_size('alam-alanaqah-hero', 1920, 1080, true);
    add_image_size('alam-alanaqah-product-large', 600, 600, true);
    add_image_size('alam-alanaqah-product-medium', 400, 400, true);
    add_image_size('alam-alanaqah-product-small', 200, 200, true);
}
add_action('after_setup_theme', 'alam_alanaqah_image_sizes');

/**
 * WooCommerce Customizations
 */
if (class_exists('WooCommerce')) {
    
    // Remove default WooCommerce wrappers
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    // Add custom WooCommerce wrappers
    add_action('woocommerce_before_main_content', 'alam_alanaqah_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'alam_alanaqah_wrapper_end', 10);
    
    function alam_alanaqah_wrapper_start() {
        echo '<div class="container"><main id="main" class="site-main">';
    }
    
    function alam_alanaqah_wrapper_end() {
        echo '</main></div>';
    }
    
    // Customize WooCommerce product loop
    add_filter('loop_shop_columns', 'alam_alanaqah_loop_columns');
    function alam_alanaqah_loop_columns() {
        return 3; // 3 products per row
    }
    
    // Customize products per page
    add_filter('loop_shop_per_page', 'alam_alanaqah_products_per_page');
    function alam_alanaqah_products_per_page() {
        return 12;
    }
    
    // Add cart icon to header
    add_action('wp_footer', 'alam_alanaqah_cart_link_fragment');
    function alam_alanaqah_cart_link_fragment() {
        if (is_admin() || !function_exists('WC')) return;
        ?>
        <script type="text/javascript">
            jQuery(function($) {
                $(document.body).on('added_to_cart', function() {
                    $('.cart-count').fadeOut().fadeIn();
                });
            });
        </script>
        <?php
    }
}

/**
 * Custom Post Types
 */
function alam_alanaqah_custom_post_types() {
    
    // Testimonials
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => esc_html__('Testimonials', 'alam-alanaqah'),
            'singular_name' => esc_html__('Testimonial', 'alam-alanaqah'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));
    
    // Team Members
    register_post_type('team', array(
        'labels' => array(
            'name' => esc_html__('Team', 'alam-alanaqah'),
            'singular_name' => esc_html__('Team Member', 'alam-alanaqah'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => true,
    ));
}
add_action('init', 'alam_alanaqah_custom_post_types');

/**
 * Custom Excerpt Length
 */
function alam_alanaqah_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'alam_alanaqah_excerpt_length');

/**
 * Custom Excerpt More
 */
function alam_alanaqah_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'alam_alanaqah_excerpt_more');

/**
 * Breadcrumb Function
 */
function alam_alanaqah_breadcrumb() {
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumb">', '</nav>');
    } elseif (function_exists('bcn_display')) {
        echo '<nav class="breadcrumb">';
        bcn_display();
        echo '</nav>';
    }
}

/**
 * Social Media Links
 */
function alam_alanaqah_social_links() {
    $facebook = get_theme_mod('facebook_url', '');
    $twitter = get_theme_mod('twitter_url', '');
    $instagram = get_theme_mod('instagram_url', '');
    $linkedin = get_theme_mod('linkedin_url', '');
    $youtube = get_theme_mod('youtube_url', '');
    
    if ($facebook || $twitter || $instagram || $linkedin || $youtube) {
        echo '<div class="social-links">';
        
        if ($facebook) {
            echo '<a href="' . esc_url($facebook) . '" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>';
        }
        if ($twitter) {
            echo '<a href="' . esc_url($twitter) . '" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>';
        }
        if ($instagram) {
            echo '<a href="' . esc_url($instagram) . '" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>';
        }
        if ($linkedin) {
            echo '<a href="' . esc_url($linkedin) . '" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>';
        }
        if ($youtube) {
            echo '<a href="' . esc_url($youtube) . '" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>';
        }
        
        echo '</div>';
    }
}

/**
 * Theme Customizer
 */
function alam_alanaqah_customize_register($wp_customize) {
    
    // Colors Section
    $wp_customize->add_section('colors', array(
        'title' => esc_html__('Colors', 'alam-alanaqah'),
        'priority' => 40,
    ));
    
    // Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#1B4B4C',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => esc_html__('Primary Color', 'alam-alanaqah'),
        'section' => 'colors',
    )));
    
    // Accent Color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#D4AF37',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => esc_html__('Accent Color', 'alam-alanaqah'),
        'section' => 'colors',
    )));
    
    // Social Media Section
    $wp_customize->add_section('social_media', array(
        'title' => esc_html__('Social Media', 'alam-alanaqah'),
        'priority' => 120,
    ));
    
    // Social Media Settings
    $social_networks = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'linkedin' => 'LinkedIn',
        'youtube' => 'YouTube',
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting($network . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control($network . '_url', array(
            'label' => $label . ' ' . esc_html__('URL', 'alam-alanaqah'),
            'section' => 'social_media',
            'type' => 'url',
        ));
    }
    
    // Homepage Settings
    $wp_customize->add_section('homepage', array(
        'title' => esc_html__('Homepage Settings', 'alam-alanaqah'),
        'priority' => 130,
    ));
    
    // Hero Section Title
    $wp_customize->add_setting('hero_title', array(
        'default' => esc_html__('Welcome to Alam Alanaqah', 'alam-alanaqah'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => esc_html__('Hero Title', 'alam-alanaqah'),
        'section' => 'homepage',
        'type' => 'text',
    ));
    
    // Hero Section Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => esc_html__('World of Elegance - Premium Fashion, Accessories, Jewelry & Perfumes', 'alam-alanaqah'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => esc_html__('Hero Subtitle', 'alam-alanaqah'),
        'section' => 'homepage',
        'type' => 'textarea',
    ));
    
    // Hero CTA Text
    $wp_customize->add_setting('hero_cta_text', array(
        'default' => esc_html__('Shop Now', 'alam-alanaqah'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_cta_text', array(
        'label' => esc_html__('Hero CTA Text', 'alam-alanaqah'),
        'section' => 'homepage',
        'type' => 'text',
    ));
    
    // Hero CTA URL
    $wp_customize->add_setting('hero_cta_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_cta_url', array(
        'label' => esc_html__('Hero CTA URL', 'alam-alanaqah'),
        'section' => 'homepage',
        'type' => 'url',
    ));
}
add_action('customize_register', 'alam_alanaqah_customize_register');

/**
 * Output Customizer CSS
 */
function alam_alanaqah_customizer_css() {
    $primary_color = get_theme_mod('primary_color', '#1B4B4C');
    $accent_color = get_theme_mod('accent_color', '#D4AF37');
    
    ?>
    <style type="text/css">
        :root {
            --primary-teal: <?php echo esc_attr($primary_color); ?>;
            --primary-gold: <?php echo esc_attr($accent_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'alam_alanaqah_customizer_css');

/**
 * Add Elementor Support
 */
function alam_alanaqah_elementor_support() {
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'alam_alanaqah_elementor_support');

/**
 * Security enhancements
 */
function alam_alanaqah_security() {
    // Remove version info
    remove_action('wp_head', 'wp_generator');
    
    // Hide admin bar for non-admins
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('init', 'alam_alanaqah_security');

/**
 * Performance optimizations
 */
function alam_alanaqah_performance() {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // Remove unnecessary features
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'alam_alanaqah_performance');

/**
 * Search function for AJAX
 */
function alam_alanaqah_ajax_search() {
    check_ajax_referer('alam_alanaqah_nonce', 'nonce');
    
    $search_term = sanitize_text_field($_POST['search_term']);
    
    $args = array(
        'post_type' => array('post', 'page', 'product'),
        'posts_per_page' => 5,
        's' => $search_term,
    );
    
    $query = new WP_Query($args);
    
    $results = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'type' => get_post_type(),
            );
        }
    }
    
    wp_reset_postdata();
    
    wp_send_json_success($results);
}
add_action('wp_ajax_alam_alanaqah_search', 'alam_alanaqah_ajax_search');
add_action('wp_ajax_nopriv_alam_alanaqah_search', 'alam_alanaqah_ajax_search');

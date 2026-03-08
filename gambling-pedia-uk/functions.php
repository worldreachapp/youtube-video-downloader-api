<?php
/**
 * Gambling Pedia UK Theme Functions
 *
 * @package Gambling_Pedia_UK
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'GPUK_VERSION', '1.0.0' );
define( 'GPUK_DIR', get_template_directory() );
define( 'GPUK_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function gpuk_setup() {
    // Multi-language support
    load_theme_textdomain( 'gambling-pedia-uk', GPUK_DIR . '/languages' );

    // Theme support
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'custom-header', array(
        'default-image' => '',
        'width'         => 1920,
        'height'        => 400,
        'flex-width'    => true,
        'flex-height'   => true,
    ) );
    add_theme_support( 'custom-background', array(
        'default-color' => 'f4f5f7',
    ) );

    // Image sizes
    add_image_size( 'gpuk-featured-large', 900, 550, true );
    add_image_size( 'gpuk-featured-medium', 600, 400, true );
    add_image_size( 'gpuk-card', 450, 280, true );
    add_image_size( 'gpuk-thumbnail', 150, 110, true );

    // Navigation menus
    register_nav_menus( array(
        'primary'   => esc_html__( 'Primary Menu', 'gambling-pedia-uk' ),
        'footer'    => esc_html__( 'Footer Menu', 'gambling-pedia-uk' ),
        'top-bar'   => esc_html__( 'Top Bar Menu', 'gambling-pedia-uk' ),
    ) );
}
add_action( 'after_setup_theme', 'gpuk_setup' );

/**
 * Enqueue Scripts and Styles
 */
function gpuk_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'gpuk-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style( 'gpuk-style', get_stylesheet_uri(), array(), GPUK_VERSION );

    // Theme JavaScript
    wp_enqueue_script(
        'gpuk-navigation',
        GPUK_URI . '/assets/js/navigation.js',
        array(),
        GPUK_VERSION,
        true
    );

    wp_enqueue_script(
        'gpuk-theme',
        GPUK_URI . '/assets/js/theme.js',
        array(),
        GPUK_VERSION,
        true
    );

    // Localize script for AJAX and translations
    wp_localize_script( 'gpuk-theme', 'gpukData', array(
        'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
        'nonce'      => wp_create_nonce( 'gpuk_nonce' ),
        'searchText' => esc_html__( 'Search...', 'gambling-pedia-uk' ),
        'menuOpen'   => esc_html__( 'Open Menu', 'gambling-pedia-uk' ),
        'menuClose'  => esc_html__( 'Close Menu', 'gambling-pedia-uk' ),
    ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'gpuk_scripts' );

/**
 * Register Widget Areas
 */
function gpuk_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Main Sidebar', 'gambling-pedia-uk' ),
        'id'            => 'sidebar-main',
        'description'   => esc_html__( 'Main sidebar widget area.', 'gambling-pedia-uk' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'gambling-pedia-uk' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Footer widget area column 1.', 'gambling-pedia-uk' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'gambling-pedia-uk' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Footer widget area column 2.', 'gambling-pedia-uk' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'gambling-pedia-uk' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Footer widget area column 3.', 'gambling-pedia-uk' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 4', 'gambling-pedia-uk' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Footer widget area column 4.', 'gambling-pedia-uk' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'gpuk_widgets_init' );

/**
 * Custom Excerpt Length
 */
function gpuk_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'gpuk_excerpt_length' );

function gpuk_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'gpuk_excerpt_more' );

/**
 * Breadcrumbs
 */
function gpuk_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'gambling-pedia-uk' ) . '">';
    echo '<div class="container">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'gambling-pedia-uk' ) . '</a>';

    if ( is_category() || is_single() ) {
        $categories = get_the_category();
        if ( $categories ) {
            echo '<span class="separator">&raquo;</span>';
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
        }
        if ( is_single() ) {
            echo '<span class="separator">&raquo;</span>';
            echo '<span>' . esc_html( get_the_title() ) . '</span>';
        }
    } elseif ( is_page() ) {
        echo '<span class="separator">&raquo;</span>';
        echo '<span>' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_search() ) {
        echo '<span class="separator">&raquo;</span>';
        /* translators: %s: search query */
        echo '<span>' . sprintf( esc_html__( 'Search: %s', 'gambling-pedia-uk' ), get_search_query() ) . '</span>';
    } elseif ( is_tag() ) {
        echo '<span class="separator">&raquo;</span>';
        echo '<span>' . esc_html( single_tag_title( '', false ) ) . '</span>';
    } elseif ( is_archive() ) {
        echo '<span class="separator">&raquo;</span>';
        echo '<span>' . esc_html( get_the_archive_title() ) . '</span>';
    }

    echo '</div>';
    echo '</nav>';
}

/**
 * Multi-Language Helper - available languages
 */
function gpuk_get_available_languages() {
    return array(
        'en_GB' => __( 'English (UK)', 'gambling-pedia-uk' ),
        'es_ES' => __( 'Spanish', 'gambling-pedia-uk' ),
        'fr_FR' => __( 'French', 'gambling-pedia-uk' ),
        'de_DE' => __( 'German', 'gambling-pedia-uk' ),
        'it_IT' => __( 'Italian', 'gambling-pedia-uk' ),
        'pt_PT' => __( 'Portuguese', 'gambling-pedia-uk' ),
        'ar'    => __( 'Arabic', 'gambling-pedia-uk' ),
    );
}

/**
 * Language Switcher Output
 */
function gpuk_language_switcher() {
    $languages = gpuk_get_available_languages();
    $current   = get_locale();

    echo '<div class="language-switcher">';
    echo '<label for="gpuk-lang-select" class="sr-only">' . esc_html__( 'Select Language', 'gambling-pedia-uk' ) . '</label>';
    echo '<select id="gpuk-lang-select" onchange="if(this.value) window.location.href=this.value;">';

    foreach ( $languages as $code => $name ) {
        $selected = ( $code === $current ) ? ' selected' : '';
        $url = add_query_arg( 'lang', $code, home_url( $_SERVER['REQUEST_URI'] ) );
        echo '<option value="' . esc_url( $url ) . '"' . $selected . '>' . esc_html( $name ) . '</option>';
    }

    echo '</select>';
    echo '</div>';
}

/**
 * Handle language switching via query parameter
 */
function gpuk_switch_language() {
    if ( isset( $_GET['lang'] ) && ! empty( $_GET['lang'] ) ) {
        $lang      = sanitize_text_field( wp_unslash( $_GET['lang'] ) );
        $available = gpuk_get_available_languages();
        if ( array_key_exists( $lang, $available ) ) {
            switch_to_locale( $lang );
        }
    }
}
add_action( 'init', 'gpuk_switch_language' );

/**
 * Post Reading Time Estimate
 */
function gpuk_reading_time() {
    $content    = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    $minutes    = max( 1, ceil( $word_count / 200 ) );
    /* translators: %d: number of minutes */
    return sprintf( _n( '%d min read', '%d min read', $minutes, 'gambling-pedia-uk' ), $minutes );
}

/**
 * Post View Counter (simple, cookie-based)
 */
function gpuk_set_post_views( $post_id ) {
    $count     = (int) get_post_meta( $post_id, 'gpuk_post_views', true );
    $cookie_id = 'gpuk_viewed_' . $post_id;

    if ( ! isset( $_COOKIE[ $cookie_id ] ) ) {
        $count++;
        update_post_meta( $post_id, 'gpuk_post_views', $count );
        setcookie( $cookie_id, '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true );
    }
}

function gpuk_get_post_views( $post_id ) {
    return (int) get_post_meta( $post_id, 'gpuk_post_views', true );
}

function gpuk_track_views() {
    if ( is_singular( 'post' ) && ! is_admin() ) {
        gpuk_set_post_views( get_the_ID() );
    }
}
add_action( 'wp', 'gpuk_track_views' );

/**
 * Custom Post Meta Output
 */
function gpuk_post_meta() {
    $time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );

    echo '<span class="posted-on">' . $time_string . '</span>';
    echo '<span class="byline"> ' . esc_html__( 'by', 'gambling-pedia-uk' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    echo '<span class="reading-time">' . esc_html( gpuk_reading_time() ) . '</span>';
}

/**
 * Social Share Buttons
 */
function gpuk_share_buttons() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    $url   = urlencode( get_permalink() );
    $title = urlencode( get_the_title() );

    echo '<div class="post-share">';
    echo '<span class="share-label">' . esc_html__( 'Share:', 'gambling-pedia-uk' ) . '</span>';
    echo '<a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title . '" class="share-btn twitter" target="_blank" rel="noopener noreferrer">Twitter</a>';
    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" class="share-btn facebook" target="_blank" rel="noopener noreferrer">Facebook</a>';
    echo '<a href="https://api.whatsapp.com/send?text=' . $title . '%20' . $url . '" class="share-btn whatsapp" target="_blank" rel="noopener noreferrer">WhatsApp</a>';
    echo '<a href="https://t.me/share/url?url=' . $url . '&text=' . $title . '" class="share-btn telegram" target="_blank" rel="noopener noreferrer">Telegram</a>';
    echo '</div>';
}

/**
 * Customizer Settings
 */
function gpuk_customize_register( $wp_customize ) {
    // Social Media Section
    $wp_customize->add_section( 'gpuk_social', array(
        'title'    => esc_html__( 'Social Media Links', 'gambling-pedia-uk' ),
        'priority' => 90,
    ) );

    $social_platforms = array(
        'twitter'   => 'Twitter / X',
        'facebook'  => 'Facebook',
        'youtube'   => 'YouTube',
        'telegram'  => 'Telegram',
        'instagram' => 'Instagram',
    );

    foreach ( $social_platforms as $platform => $label ) {
        $wp_customize->add_setting( "gpuk_social_{$platform}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( "gpuk_social_{$platform}", array(
            'label'   => $label . ' URL',
            'section' => 'gpuk_social',
            'type'    => 'url',
        ) );
    }

    // Breaking News Section
    $wp_customize->add_section( 'gpuk_breaking_news', array(
        'title'    => esc_html__( 'Breaking News Ticker', 'gambling-pedia-uk' ),
        'priority' => 85,
    ) );

    $wp_customize->add_setting( 'gpuk_show_breaking_news', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );

    $wp_customize->add_control( 'gpuk_show_breaking_news', array(
        'label'   => esc_html__( 'Show Breaking News Ticker', 'gambling-pedia-uk' ),
        'section' => 'gpuk_breaking_news',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'gpuk_breaking_category', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'gpuk_breaking_category', array(
        'label'   => esc_html__( 'Breaking News Category', 'gambling-pedia-uk' ),
        'section' => 'gpuk_breaking_news',
        'type'    => 'select',
        'choices' => gpuk_get_categories_choices(),
    ) );

    // Footer Section
    $wp_customize->add_section( 'gpuk_footer', array(
        'title'    => esc_html__( 'Footer Settings', 'gambling-pedia-uk' ),
        'priority' => 95,
    ) );

    $wp_customize->add_setting( 'gpuk_footer_about', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'gpuk_footer_about', array(
        'label'   => esc_html__( 'Footer About Text', 'gambling-pedia-uk' ),
        'section' => 'gpuk_footer',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'gpuk_responsible_gambling_text', array(
        'default'           => esc_html__( 'Gambling can be addictive. Please play responsibly. 18+ only. If you need help, visit BeGambleAware.org.', 'gambling-pedia-uk' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'gpuk_responsible_gambling_text', array(
        'label'   => esc_html__( 'Responsible Gambling Notice', 'gambling-pedia-uk' ),
        'section' => 'gpuk_footer',
        'type'    => 'textarea',
    ) );
}
add_action( 'customize_register', 'gpuk_customize_register' );

/**
 * Get categories as choices for customizer
 */
function gpuk_get_categories_choices() {
    $choices    = array( '' => esc_html__( '-- Select Category --', 'gambling-pedia-uk' ) );
    $categories = get_categories( array( 'hide_empty' => false ) );

    foreach ( $categories as $category ) {
        $choices[ $category->term_id ] = $category->name;
    }

    return $choices;
}

/**
 * Get Breaking News Posts
 */
function gpuk_get_breaking_news() {
    $show     = get_theme_mod( 'gpuk_show_breaking_news', true );
    $category = get_theme_mod( 'gpuk_breaking_category', '' );

    if ( ! $show ) {
        return array();
    }

    $args = array(
        'posts_per_page' => 8,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if ( $category ) {
        $args['cat'] = $category;
    }

    return get_posts( $args );
}

/**
 * Include template part files
 */
require_once GPUK_DIR . '/inc/template-tags.php';

/**
 * Add Schema.org structured data for news articles
 */
function gpuk_schema_markup() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    $schema = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'NewsArticle',
        'headline'         => get_the_title(),
        'datePublished'    => get_the_date( 'c' ),
        'dateModified'     => get_the_modified_date( 'c' ),
        'author'           => array(
            '@type' => 'Person',
            'name'  => get_the_author(),
        ),
        'publisher'        => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo( 'name' ),
        ),
        'description'      => wp_strip_all_tags( get_the_excerpt() ),
        'mainEntityOfPage' => get_permalink(),
    );

    if ( has_post_thumbnail() ) {
        $schema['image'] = get_the_post_thumbnail_url( null, 'full' );
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'gpuk_schema_markup' );

/**
 * Content width
 */
function gpuk_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'gpuk_content_width', 840 );
}
add_action( 'after_setup_theme', 'gpuk_content_width', 0 );

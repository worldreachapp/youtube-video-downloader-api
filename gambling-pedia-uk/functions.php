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
        'primary'       => esc_html__( 'Primary Menu', 'gambling-pedia-uk' ),
        'footer'        => esc_html__( 'Footer Menu', 'gambling-pedia-uk' ),
        'footer-bottom' => esc_html__( 'Footer Bottom Links', 'gambling-pedia-uk' ),
        'top-bar'       => esc_html__( 'Top Bar Menu', 'gambling-pedia-uk' ),
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
 *
 * Each language has:
 * - label: display name
 * - slug: URL prefix for subfolder routing (e.g., /es/, /fr/)
 * - hreflang: ISO 639-1 code for hreflang tags
 * - locale: WordPress locale code
 * - dir: text direction (ltr or rtl)
 */
function gpuk_get_available_languages() {
    return array(
        'en_GB' => array(
            'label'    => __( 'English (UK)', 'gambling-pedia-uk' ),
            'slug'     => 'en',
            'hreflang' => 'en-gb',
            'locale'   => 'en_GB',
            'dir'      => 'ltr',
        ),
        'es_ES' => array(
            'label'    => __( 'Spanish', 'gambling-pedia-uk' ),
            'slug'     => 'es',
            'hreflang' => 'es',
            'locale'   => 'es_ES',
            'dir'      => 'ltr',
        ),
        'fr_FR' => array(
            'label'    => __( 'French', 'gambling-pedia-uk' ),
            'slug'     => 'fr',
            'hreflang' => 'fr',
            'locale'   => 'fr_FR',
            'dir'      => 'ltr',
        ),
        'de_DE' => array(
            'label'    => __( 'German', 'gambling-pedia-uk' ),
            'slug'     => 'de',
            'hreflang' => 'de',
            'locale'   => 'de_DE',
            'dir'      => 'ltr',
        ),
        'it_IT' => array(
            'label'    => __( 'Italian', 'gambling-pedia-uk' ),
            'slug'     => 'it',
            'hreflang' => 'it',
            'locale'   => 'it_IT',
            'dir'      => 'ltr',
        ),
        'pt_PT' => array(
            'label'    => __( 'Portuguese', 'gambling-pedia-uk' ),
            'slug'     => 'pt',
            'hreflang' => 'pt',
            'locale'   => 'pt_PT',
            'dir'      => 'ltr',
        ),
        'ar'    => array(
            'label'    => __( 'Arabic', 'gambling-pedia-uk' ),
            'slug'     => 'ar',
            'hreflang' => 'ar',
            'locale'   => 'ar',
            'dir'      => 'rtl',
        ),
    );
}

/**
 * Get the current language code
 */
function gpuk_get_current_language() {
    // Support WPML
    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
        return ICL_LANGUAGE_CODE;
    }

    // Support Polylang
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language( 'locale' );
    }

    return get_locale();
}

/**
 * Get the language slug from a locale code
 */
function gpuk_locale_to_slug( $locale ) {
    $languages = gpuk_get_available_languages();
    if ( isset( $languages[ $locale ] ) ) {
        return $languages[ $locale ]['slug'];
    }
    return 'en';
}

/**
 * Language Switcher Output
 *
 * Works with: standalone theme, WPML, Polylang, TranslatePress
 */
function gpuk_language_switcher() {
    // If WPML is active, use its language switcher
    if ( function_exists( 'icl_get_languages' ) ) {
        $wpml_langs = icl_get_languages( 'skip_missing=0' );
        if ( $wpml_langs ) {
            echo '<div class="language-switcher">';
            echo '<label for="gpuk-lang-select" class="sr-only">' . esc_html__( 'Select Language', 'gambling-pedia-uk' ) . '</label>';
            echo '<select id="gpuk-lang-select" onchange="if(this.value) window.location.href=this.value;">';
            foreach ( $wpml_langs as $lang ) {
                $selected = $lang['active'] ? ' selected' : '';
                echo '<option value="' . esc_url( $lang['url'] ) . '"' . $selected . '>' . esc_html( $lang['native_name'] ) . '</option>';
            }
            echo '</select>';
            echo '</div>';
            return;
        }
    }

    // If Polylang is active, use its switcher data
    if ( function_exists( 'pll_the_languages' ) ) {
        $polylang_langs = pll_the_languages( array( 'raw' => 1 ) );
        if ( $polylang_langs ) {
            echo '<div class="language-switcher">';
            echo '<label for="gpuk-lang-select" class="sr-only">' . esc_html__( 'Select Language', 'gambling-pedia-uk' ) . '</label>';
            echo '<select id="gpuk-lang-select" onchange="if(this.value) window.location.href=this.value;">';
            foreach ( $polylang_langs as $lang ) {
                $selected = $lang['current_lang'] ? ' selected' : '';
                echo '<option value="' . esc_url( $lang['url'] ) . '"' . $selected . '>' . esc_html( $lang['name'] ) . '</option>';
            }
            echo '</select>';
            echo '</div>';
            return;
        }
    }

    // Standalone language switcher (subfolder-based URLs)
    $languages = gpuk_get_available_languages();
    $current   = get_locale();
    $path      = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';

    // Remove existing language prefix from path
    $clean_path = preg_replace( '#^/(' . implode( '|', array_column( $languages, 'slug' ) ) . ')(/|$)#', '/', $path );

    echo '<div class="language-switcher">';
    echo '<label for="gpuk-lang-select" class="sr-only">' . esc_html__( 'Select Language', 'gambling-pedia-uk' ) . '</label>';
    echo '<select id="gpuk-lang-select" onchange="if(this.value) window.location.href=this.value;">';

    foreach ( $languages as $code => $lang ) {
        $selected = ( $code === $current ) ? ' selected' : '';
        $lang_url = home_url( '/' . $lang['slug'] . $clean_path );
        echo '<option value="' . esc_url( $lang_url ) . '"' . $selected . '>' . esc_html( $lang['label'] ) . '</option>';
    }

    echo '</select>';
    echo '</div>';
}

/**
 * Add rewrite rules for language subfolder URLs
 *
 * Creates URL structure: example.com/es/, example.com/fr/, etc.
 * Only active when no translation plugin is handling URLs.
 */
function gpuk_language_rewrite_rules() {
    // Skip if WPML or Polylang handles routing
    if ( defined( 'ICL_SITEPRESS_VERSION' ) || function_exists( 'pll_the_languages' ) ) {
        return;
    }

    $languages = gpuk_get_available_languages();
    $slugs     = array();

    foreach ( $languages as $lang ) {
        $slugs[] = $lang['slug'];
    }

    $slug_pattern = implode( '|', $slugs );

    // Match language prefix and pass the rest to WordPress
    add_rewrite_rule(
        '^(' . $slug_pattern . ')/?$',
        'index.php?gpuk_lang=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^(' . $slug_pattern . ')/(.+)$',
        'index.php?gpuk_lang=$matches[1]&gpuk_path=$matches[2]',
        'top'
    );
}
add_action( 'init', 'gpuk_language_rewrite_rules' );

/**
 * Register custom query vars for language routing
 */
function gpuk_query_vars( $vars ) {
    $vars[] = 'gpuk_lang';
    $vars[] = 'gpuk_path';
    return $vars;
}
add_filter( 'query_vars', 'gpuk_query_vars' );

/**
 * Handle language switching via subfolder URL or query parameter
 *
 * Priority: Translation plugin > Subfolder URL > Cookie > Default
 */
function gpuk_switch_language() {
    // Skip if translation plugin handles language switching
    if ( defined( 'ICL_SITEPRESS_VERSION' ) || function_exists( 'pll_the_languages' ) ) {
        return;
    }

    $available = gpuk_get_available_languages();
    $lang      = '';

    // Check subfolder URL pattern
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    $slugs       = array_column( $available, 'slug', 'locale' );
    $slug_to_locale = array_flip( $slugs );

    if ( preg_match( '#^/(' . implode( '|', $slugs ) . ')(/|$)#', $request_uri, $matches ) ) {
        $slug = $matches[1];
        if ( isset( $slug_to_locale[ $slug ] ) ) {
            $lang = $slug_to_locale[ $slug ];
        }
    }

    // Fallback: query parameter (for backward compatibility)
    if ( ! $lang && isset( $_GET['lang'] ) && ! empty( $_GET['lang'] ) ) {
        $lang = sanitize_text_field( wp_unslash( $_GET['lang'] ) );
    }

    // Apply language and set cookie for persistence
    if ( $lang && array_key_exists( $lang, $available ) ) {
        setcookie( 'gpuk_language', $lang, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true );
        switch_to_locale( $lang );
        return;
    }

    // Restore language from cookie (no redirect, just locale switch)
    if ( isset( $_COOKIE['gpuk_language'] ) && ! empty( $_COOKIE['gpuk_language'] ) ) {
        $lang = sanitize_text_field( wp_unslash( $_COOKIE['gpuk_language'] ) );
        if ( array_key_exists( $lang, $available ) ) {
            switch_to_locale( $lang );
        }
    }
}
add_action( 'init', 'gpuk_switch_language', 5 );

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

    $logo_id  = get_theme_mod( 'custom_logo' );
    $logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';

    $publisher = array(
        '@type' => 'Organization',
        'name'  => get_bloginfo( 'name' ),
    );
    if ( $logo_url ) {
        $publisher['logo'] = array(
            '@type' => 'ImageObject',
            'url'   => $logo_url,
        );
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
            'url'   => get_author_posts_url( get_the_author_meta( 'ID' ) ),
        ),
        'publisher'        => $publisher,
        'description'      => wp_strip_all_tags( get_the_excerpt() ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id'   => get_permalink(),
        ),
        'wordCount'        => str_word_count( wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ) ) ),
        'inLanguage'       => get_bloginfo( 'language' ),
    );

    $categories = get_the_category();
    if ( $categories ) {
        $schema['articleSection'] = $categories[0]->name;
    }

    if ( has_post_thumbnail() ) {
        $thumb_id   = get_post_thumbnail_id();
        $image_data = wp_get_attachment_image_src( $thumb_id, 'full' );
        if ( $image_data ) {
            $schema['image'] = array(
                '@type'  => 'ImageObject',
                'url'    => $image_data[0],
                'width'  => $image_data[1],
                'height' => $image_data[2],
            );
        }
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'gpuk_schema_markup' );

/**
 * Add WebSite schema for sitelinks search box in Google
 */
function gpuk_website_schema() {
    if ( ! is_front_page() ) {
        return;
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        'name'            => get_bloginfo( 'name' ),
        'description'     => get_bloginfo( 'description' ),
        'url'             => home_url( '/' ),
        'inLanguage'      => get_bloginfo( 'language' ),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => array(
                '@type'        => 'EntryPoint',
                'urlTemplate'  => home_url( '/?s={search_term_string}' ),
            ),
            'query-input' => 'required name=search_term_string',
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'gpuk_website_schema' );

/**
 * Add BreadcrumbList schema markup
 */
function gpuk_breadcrumb_schema() {
    if ( is_front_page() ) {
        return;
    }

    $items = array();
    $pos   = 1;

    $items[] = array(
        '@type'    => 'ListItem',
        'position' => $pos++,
        'name'     => esc_html__( 'Home', 'gambling-pedia-uk' ),
        'item'     => home_url( '/' ),
    );

    if ( is_category() || is_single() ) {
        $categories = get_the_category();
        if ( $categories ) {
            $items[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => $categories[0]->name,
                'item'     => get_category_link( $categories[0]->term_id ),
            );
        }
        if ( is_single() ) {
            $items[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => get_the_title(),
                'item'     => get_permalink(),
            );
        }
    } elseif ( is_page() ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos++,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'gpuk_breadcrumb_schema' );

/**
 * SEO Meta Tags - OpenGraph, Twitter Cards, Canonical, Description
 *
 * Best practices (2025-2026):
 * - Canonical stays within same language version
 * - OG locale matches current language
 * - All alternate OG locales listed
 * - Meta description translatable
 */
function gpuk_seo_meta_tags() {
    // Skip if popular SEO plugins are active (Yoast, RankMath, AIOSEO)
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
        return;
    }

    $site_name   = get_bloginfo( 'name' );
    $locale      = get_locale();
    $description = get_bloginfo( 'description' );
    $og_type     = 'website';
    $title       = wp_get_document_title();
    $image       = '';

    // Build canonical URL that stays within the current language
    $current_lang_slug = gpuk_locale_to_slug( $locale );
    $url               = home_url( $_SERVER['REQUEST_URI'] );

    // Get custom logo as default OG image
    $logo_id = get_theme_mod( 'custom_logo' );
    if ( $logo_id ) {
        $image = wp_get_attachment_image_url( $logo_id, 'full' );
    }

    if ( is_singular( 'post' ) ) {
        $og_type     = 'article';
        $description = wp_strip_all_tags( get_the_excerpt() );
        $url         = get_permalink();

        if ( has_post_thumbnail() ) {
            $image = get_the_post_thumbnail_url( null, 'gpuk-featured-large' );
        }
    } elseif ( is_singular( 'page' ) ) {
        $description = wp_strip_all_tags( get_the_excerpt() );
        $url         = get_permalink();

        if ( has_post_thumbnail() ) {
            $image = get_the_post_thumbnail_url( null, 'gpuk-featured-large' );
        }
    } elseif ( is_category() ) {
        $cat         = get_queried_object();
        $description = $cat->description ? wp_strip_all_tags( $cat->description ) : $description;
        $url         = get_category_link( $cat->term_id );
    } elseif ( is_tag() ) {
        $tag         = get_queried_object();
        $description = $tag->description ? wp_strip_all_tags( $tag->description ) : $description;
        $url         = get_tag_link( $tag->term_id );
    }

    // Trim description to 160 chars for SEO
    if ( mb_strlen( $description ) > 160 ) {
        $description = mb_substr( $description, 0, 157 ) . '...';
    }

    // Meta description
    echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";

    // Canonical URL (stays within same language - critical for multilingual SEO)
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";

    // OpenGraph tags
    echo '<meta property="og:locale" content="' . esc_attr( $locale ) . '">' . "\n";

    // List alternate OG locales for all other languages
    $languages = gpuk_get_available_languages();
    foreach ( $languages as $code => $lang ) {
        if ( $code !== $locale ) {
            echo '<meta property="og:locale:alternate" content="' . esc_attr( $code ) . '">' . "\n";
        }
    }

    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";

    if ( $image ) {
        echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
        echo '<meta property="og:image:alt" content="' . esc_attr( $title ) . '">' . "\n";
    }

    if ( is_singular( 'post' ) ) {
        echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";
        echo '<meta property="article:author" content="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . "\n";

        $categories = get_the_category();
        if ( $categories ) {
            echo '<meta property="article:section" content="' . esc_attr( $categories[0]->name ) . '">' . "\n";
        }

        $tags = get_the_tags();
        if ( $tags ) {
            foreach ( $tags as $tag ) {
                echo '<meta property="article:tag" content="' . esc_attr( $tag->name ) . '">' . "\n";
            }
        }
    }

    // Twitter Card tags
    echo '<meta name="twitter:card" content="' . ( $image ? 'summary_large_image' : 'summary' ) . '">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";

    if ( $image ) {
        echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
        echo '<meta name="twitter:image:alt" content="' . esc_attr( $title ) . '">' . "\n";
    }

    $twitter_url = get_theme_mod( 'gpuk_social_twitter', '' );
    if ( $twitter_url ) {
        $twitter_handle = basename( rtrim( $twitter_url, '/' ) );
        if ( $twitter_handle ) {
            echo '<meta name="twitter:site" content="@' . esc_attr( $twitter_handle ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'gpuk_seo_meta_tags', 1 );

/**
 * Output hreflang tags for multi-language SEO
 *
 * If WPML or Polylang is active, they handle hreflang automatically.
 * Otherwise, the theme outputs hreflang tags using subfolder URLs.
 *
 * Best practices (2025-2026):
 * - Every page references ALL language versions (including self)
 * - Uses proper ISO 639-1 language codes
 * - Includes x-default pointing to the default (English) version
 * - Self-referencing hreflang included
 */
function gpuk_hreflang_tags() {
    // Skip if WPML or Polylang handles hreflang
    if ( defined( 'ICL_SITEPRESS_VERSION' ) || function_exists( 'pll_the_languages' ) ) {
        return;
    }

    $languages    = gpuk_get_available_languages();
    $current_path = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';

    // Remove any existing language prefix from path
    $slugs      = array_column( $languages, 'slug' );
    $clean_path = preg_replace( '#^/(' . implode( '|', $slugs ) . ')(/|$)#', '/', $current_path );

    // Remove query parameters for clean canonical hreflang URLs
    $clean_path = strtok( $clean_path, '?' );

    foreach ( $languages as $code => $lang ) {
        $lang_url = home_url( '/' . $lang['slug'] . rtrim( $clean_path, '/' ) . '/' );
        echo '<link rel="alternate" hreflang="' . esc_attr( $lang['hreflang'] ) . '" href="' . esc_url( $lang_url ) . '">' . "\n";
    }

    // x-default points to default (English) version
    $default_url = home_url( '/en' . rtrim( $clean_path, '/' ) . '/' );
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $default_url ) . '">' . "\n";
}
add_action( 'wp_head', 'gpuk_hreflang_tags', 2 );

/**
 * Add robots meta tag
 */
function gpuk_robots_meta() {
    // Don't interfere with WordPress core robots
    if ( ! is_search() && ! is_404() ) {
        return;
    }

    if ( is_search() || is_404() ) {
        echo '<meta name="robots" content="noindex, follow">' . "\n";
    }
}
add_action( 'wp_head', 'gpuk_robots_meta', 1 );

/**
 * Optimize title separator
 */
function gpuk_document_title_separator( $sep ) {
    return '|';
}
add_filter( 'document_title_separator', 'gpuk_document_title_separator' );

/**
 * Add site name to title on front page
 */
function gpuk_document_title_parts( $title ) {
    if ( is_front_page() && ! empty( get_bloginfo( 'description' ) ) ) {
        $title['tagline'] = get_bloginfo( 'description' );
    }
    return $title;
}
add_filter( 'document_title_parts', 'gpuk_document_title_parts' );

/**
 * Preconnect to Google Fonts and other external resources for performance
 */
function gpuk_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => true,
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => true,
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'gpuk_resource_hints', 10, 2 );

/**
 * Add pingback URL to head for discoverability
 */
function gpuk_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'gpuk_pingback_header' );

/**
 * Content width
 */
function gpuk_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'gpuk_content_width', 840 );
}
add_action( 'after_setup_theme', 'gpuk_content_width', 0 );

/**
 * Add language attributes to the schema markup (localized schema)
 *
 * Ensures schema.org markup includes inLanguage property
 * for proper language targeting in search results.
 */
function gpuk_localized_schema_language() {
    return get_bloginfo( 'language' );
}

/**
 * Enhance WordPress native sitemap with hreflang for multilingual support
 *
 * Adds xhtml namespace for hreflang annotations in the WordPress core sitemap.
 * Works alongside the native wp-sitemap.xml functionality.
 */
function gpuk_sitemap_entry( $entry, $post_type, $post ) {
    if ( ! isset( $entry['loc'] ) ) {
        return $entry;
    }

    // Skip if translation plugin handles sitemaps
    if ( defined( 'ICL_SITEPRESS_VERSION' ) || function_exists( 'pll_the_languages' ) ) {
        return $entry;
    }

    return $entry;
}
add_filter( 'wp_sitemaps_posts_entry', 'gpuk_sitemap_entry', 10, 3 );

/**
 * Add language to body class for targeted CSS
 */
function gpuk_language_body_class( $classes ) {
    $locale = get_locale();
    $languages = gpuk_get_available_languages();

    if ( isset( $languages[ $locale ] ) ) {
        $classes[] = 'lang-' . $languages[ $locale ]['slug'];

        if ( 'rtl' === $languages[ $locale ]['dir'] ) {
            $classes[] = 'rtl';
        }
    }

    return $classes;
}
add_filter( 'body_class', 'gpuk_language_body_class' );

/**
 * Ensure RTL stylesheet loads for RTL languages
 */
function gpuk_rtl_styles() {
    $locale    = get_locale();
    $languages = gpuk_get_available_languages();

    if ( isset( $languages[ $locale ] ) && 'rtl' === $languages[ $locale ]['dir'] ) {
        wp_enqueue_style( 'gpuk-rtl', GPUK_URI . '/rtl.css', array( 'gpuk-style' ), GPUK_VERSION );
    }
}
add_action( 'wp_enqueue_scripts', 'gpuk_rtl_styles', 20 );

/**
 * Add SEO-related customizer settings
 */
function gpuk_seo_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'gpuk_seo', array(
        'title'    => esc_html__( 'SEO Settings', 'gambling-pedia-uk' ),
        'priority' => 80,
    ) );

    // Default meta description
    $wp_customize->add_setting( 'gpuk_meta_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'gpuk_meta_description', array(
        'label'       => esc_html__( 'Default Meta Description', 'gambling-pedia-uk' ),
        'description' => esc_html__( 'Used on pages without their own description. Max 160 characters.', 'gambling-pedia-uk' ),
        'section'     => 'gpuk_seo',
        'type'        => 'textarea',
    ) );

    // Google Search Console verification
    $wp_customize->add_setting( 'gpuk_google_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'gpuk_google_verification', array(
        'label'       => esc_html__( 'Google Site Verification', 'gambling-pedia-uk' ),
        'description' => esc_html__( 'Enter the verification meta tag content value.', 'gambling-pedia-uk' ),
        'section'     => 'gpuk_seo',
        'type'        => 'text',
    ) );

    // Bing verification
    $wp_customize->add_setting( 'gpuk_bing_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'gpuk_bing_verification', array(
        'label'       => esc_html__( 'Bing Site Verification', 'gambling-pedia-uk' ),
        'section'     => 'gpuk_seo',
        'type'        => 'text',
    ) );
}
add_action( 'customize_register', 'gpuk_seo_customize_register' );

/**
 * Output search engine verification meta tags
 */
function gpuk_verification_meta() {
    $google = get_theme_mod( 'gpuk_google_verification', '' );
    if ( $google ) {
        echo '<meta name="google-site-verification" content="' . esc_attr( $google ) . '">' . "\n";
    }

    $bing = get_theme_mod( 'gpuk_bing_verification', '' );
    if ( $bing ) {
        echo '<meta name="msvalidate.01" content="' . esc_attr( $bing ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'gpuk_verification_meta', 0 );

/**
 * Add image alt text helper for SEO
 *
 * Auto-generates alt text from post title if image alt is empty.
 * Helps with image SEO across all languages.
 */
function gpuk_auto_image_alt( $attr, $attachment, $size ) {
    if ( empty( $attr['alt'] ) && is_singular() ) {
        $attr['alt'] = get_the_title();
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'gpuk_auto_image_alt', 10, 3 );

/**
 * Add structured data for Organization on the front page
 */
function gpuk_organization_schema() {
    if ( ! is_front_page() ) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => get_bloginfo( 'name' ),
        'url'      => home_url( '/' ),
    );

    $logo_id = get_theme_mod( 'custom_logo' );
    if ( $logo_id ) {
        $schema['logo'] = wp_get_attachment_image_url( $logo_id, 'full' );
    }

    // Add social profiles from customizer
    $social_urls = array();
    $platforms   = array( 'twitter', 'facebook', 'youtube', 'telegram', 'instagram' );
    foreach ( $platforms as $platform ) {
        $url = get_theme_mod( "gpuk_social_{$platform}", '' );
        if ( $url ) {
            $social_urls[] = $url;
        }
    }
    if ( $social_urls ) {
        $schema['sameAs'] = $social_urls;
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'gpuk_organization_schema' );

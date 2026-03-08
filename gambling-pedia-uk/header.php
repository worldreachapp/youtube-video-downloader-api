<?php
/**
 * Header Template
 *
 * @package Gambling_Pedia_UK
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'gambling-pedia-uk' ); ?></a>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-left">
            <span class="top-bar-date"><?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?></span>
            <?php if ( has_nav_menu( 'top-bar' ) ) : ?>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'top-bar',
                    'container'      => false,
                    'menu_class'     => 'top-bar-menu',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ) );
                ?>
            <?php endif; ?>
        </div>
        <div class="top-bar-right">
            <?php gpuk_language_switcher(); ?>
            <span class="age-badge">18+</span>
        </div>
    </div>
</div>

<!-- Site Header -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="header-main">
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php esc_html_e( 'Gambling', 'gambling-pedia-uk' ); ?>
                            <span class="title-accent"><?php esc_html_e( 'Pedia', 'gambling-pedia-uk' ); ?></span>
                            <?php esc_html_e( 'UK', 'gambling-pedia-uk' ); ?>
                        </a>
                    </h1>
                    <p class="site-description"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
                </div>
            </div>

            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'gambling-pedia-uk' ); ?>">
        <div class="container">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="sr-only"><?php esc_html_e( 'Menu', 'gambling-pedia-uk' ); ?></span>
                &#9776;
            </button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => 'gpuk_fallback_menu',
            ) );
            ?>
        </div>
    </nav>
</header>

<?php
// Breaking News Ticker
$breaking_posts = gpuk_get_breaking_news();
if ( ! empty( $breaking_posts ) ) :
?>
<div class="breaking-news">
    <div class="container">
        <span class="breaking-label"><?php esc_html_e( 'Breaking', 'gambling-pedia-uk' ); ?></span>
        <div class="breaking-news-ticker">
            <div class="ticker-wrap">
                <?php foreach ( $breaking_posts as $bp ) : ?>
                    <span class="ticker-item">
                        <a href="<?php echo esc_url( get_permalink( $bp ) ); ?>">
                            <?php echo esc_html( $bp->post_title ); ?>
                        </a>
                    </span>
                <?php endforeach; ?>
                <?php foreach ( $breaking_posts as $bp ) : ?>
                    <span class="ticker-item">
                        <a href="<?php echo esc_url( get_permalink( $bp ) ); ?>">
                            <?php echo esc_html( $bp->post_title ); ?>
                        </a>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php gpuk_breadcrumbs(); ?>

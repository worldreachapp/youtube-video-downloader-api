<?php
/**
 * 404 Template
 *
 * @package Gambling_Pedia_UK
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <main id="primary" class="site-main" role="main">
            <div class="error-404">
                <div class="error-code">404</div>
                <h1 class="error-message"><?php esc_html_e( 'Page Not Found', 'gambling-pedia-uk' ); ?></h1>
                <p class="error-description">
                    <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'gambling-pedia-uk' ); ?>
                </p>
                <div style="margin-bottom: 40px;">
                    <?php get_search_form(); ?>
                </div>
                <h3 style="margin-bottom: 20px;"><?php esc_html_e( 'Latest Articles', 'gambling-pedia-uk' ); ?></h3>
                <div class="posts-grid">
                    <?php
                    $recent = new WP_Query( array(
                        'posts_per_page' => 4,
                        'post_status'    => 'publish',
                    ) );
                    while ( $recent->have_posts() ) :
                        $recent->the_post();
                        get_template_part( 'template-parts/content', 'card' );
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
get_footer();

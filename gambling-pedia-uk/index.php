<?php
/**
 * Main Template - News Homepage
 *
 * @package Gambling_Pedia_UK
 */

get_header();
?>

<?php if ( is_front_page() && ! is_paged() ) : ?>
    <!-- Featured Section -->
    <?php get_template_part( 'template-parts/featured', 'posts' ); ?>
<?php endif; ?>

<div class="site-content">
    <div class="container">
        <div class="content-wrapper">

            <!-- Main Content -->
            <main id="primary" class="site-main" role="main">

                <div class="section-header">
                    <h2 class="section-title">
                        <?php
                        if ( is_front_page() ) {
                            esc_html_e( 'Latest News', 'gambling-pedia-uk' );
                        } elseif ( is_search() ) {
                            /* translators: %s: search query */
                            printf( esc_html__( 'Search Results for: %s', 'gambling-pedia-uk' ), '<span>' . get_search_query() . '</span>' );
                        } else {
                            esc_html_e( 'Articles', 'gambling-pedia-uk' );
                        }
                        ?>
                    </h2>
                </div>

                <?php if ( have_posts() ) : ?>
                    <div class="posts-grid">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', 'card' );
                        endwhile;
                        ?>
                    </div>

                    <?php the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo; ' . esc_html__( 'Previous', 'gambling-pedia-uk' ),
                        'next_text' => esc_html__( 'Next', 'gambling-pedia-uk' ) . ' &raquo;',
                    ) ); ?>

                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>

            </main>

            <!-- Sidebar -->
            <aside class="sidebar" role="complementary">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </div>
</div>

<?php
get_footer();

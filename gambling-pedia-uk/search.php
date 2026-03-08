<?php
/**
 * Search Results Template
 *
 * @package Gambling_Pedia_UK
 */

get_header();
?>

<div class="archive-header">
    <div class="container">
        <h1 class="archive-title">
            <?php
            /* translators: %s: search query */
            printf( esc_html__( 'Search Results for: %s', 'gambling-pedia-uk' ), '<span>' . get_search_query() . '</span>' );
            ?>
        </h1>
    </div>
</div>

<div class="site-content">
    <div class="container">
        <div class="content-wrapper">

            <main id="primary" class="site-main" role="main">

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

            <aside class="sidebar" role="complementary">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </div>
</div>

<?php
get_footer();

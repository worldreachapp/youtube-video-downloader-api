<?php
/**
 * Page Template
 *
 * @package Gambling_Pedia_UK
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <div class="content-wrapper">

            <main id="primary" class="site-main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="single-post-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-featured-image" style="margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
                                <?php the_post_thumbnail( 'gpuk-featured-large' ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gambling-pedia-uk' ),
                                'after'  => '</div>',
                            ) );
                            ?>
                        </div>
                    </article>

                    <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; ?>

            </main>

            <aside class="sidebar" role="complementary">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </div>
</div>

<?php
get_footer();

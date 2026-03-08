<?php
/**
 * Single Post Template
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

                        <div class="single-post-header">
                            <?php
                            $categories = get_the_category();
                            if ( $categories ) :
                            ?>
                                <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="category-badge">
                                    <?php echo esc_html( $categories[0]->name ); ?>
                                </a>
                            <?php endif; ?>

                            <h1 class="entry-title"><?php the_title(); ?></h1>

                            <div class="single-post-meta">
                                <div class="author-info">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 40, '', '', array( 'class' => 'author-avatar' ) ); ?>
                                    <div>
                                        <span class="author-name">
                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <span class="posted-on">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                </span>
                                <span class="reading-time"><?php echo esc_html( gpuk_reading_time() ); ?></span>
                                <span class="post-views"><?php
                                    $views = gpuk_get_post_views( get_the_ID() );
                                    /* translators: %s: number of views */
                                    printf( esc_html__( '%s views', 'gambling-pedia-uk' ), number_format_i18n( $views ) );
                                ?></span>
                            </div>
                        </div>

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

                        <?php
                        $tags = get_the_tags();
                        if ( $tags ) :
                        ?>
                        <div class="post-tags">
                            <span class="tag-label"><?php esc_html_e( 'Tags:', 'gambling-pedia-uk' ); ?></span>
                            <?php foreach ( $tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tagcloud">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php gpuk_share_buttons(); ?>

                        <!-- Author Box -->
                        <div class="author-box">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'author-avatar' ) ); ?>
                            <div>
                                <h4 class="author-name">
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                        <?php the_author(); ?>
                                    </a>
                                </h4>
                                <p class="author-bio"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
                            </div>
                        </div>

                    </article>

                    <!-- Related Posts -->
                    <?php get_template_part( 'template-parts/related', 'posts' ); ?>

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

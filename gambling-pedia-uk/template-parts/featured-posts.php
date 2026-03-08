<?php
/**
 * Featured Posts Section (Homepage Hero)
 *
 * @package Gambling_Pedia_UK
 */

$featured = new WP_Query( array(
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'meta_key'       => '_thumbnail_id',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

if ( ! $featured->have_posts() ) {
    $featured = new WP_Query( array(
        'posts_per_page' => 3,
        'post_status'    => 'publish',
    ) );
}

if ( $featured->have_posts() ) :
    $posts_array = $featured->posts;
?>

<section class="featured-section">
    <div class="container">
        <div class="featured-grid">

            <!-- Main Featured Post -->
            <?php if ( isset( $posts_array[0] ) ) :
                $post = $posts_array[0];
                setup_postdata( $post );
            ?>
            <article class="featured-main">
                <div class="post-thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'gpuk-featured-large' ); ?>
                    <?php else : ?>
                        <div style="width:100%;height:100%;background:linear-gradient(135deg, var(--primary), var(--primary-light));"></div>
                    <?php endif; ?>
                </div>
                <div class="featured-overlay">
                    <?php
                    $categories = get_the_category();
                    if ( $categories ) :
                    ?>
                        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="category-badge">
                            <?php echo esc_html( $categories[0]->name ); ?>
                        </a>
                    <?php endif; ?>
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="entry-meta">
                        <?php gpuk_post_meta(); ?>
                    </div>
                </div>
            </article>
            <?php endif; ?>

            <!-- Sidebar Featured Posts -->
            <div class="featured-sidebar">
                <?php
                for ( $i = 1; $i <= 2; $i++ ) :
                    if ( isset( $posts_array[ $i ] ) ) :
                        $post = $posts_array[ $i ];
                        setup_postdata( $post );
                ?>
                <article class="featured-sidebar-item">
                    <div class="post-thumbnail">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'gpuk-featured-medium' ); ?>
                        <?php else : ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg, var(--primary-light), var(--primary));"></div>
                        <?php endif; ?>
                    </div>
                    <div class="featured-overlay">
                        <?php
                        $categories = get_the_category();
                        if ( $categories ) :
                        ?>
                            <span class="category-badge"><?php echo esc_html( $categories[0]->name ); ?></span>
                        <?php endif; ?>
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </article>
                <?php
                    endif;
                endfor;
                ?>
            </div>

        </div>
    </div>
</section>

<?php
    wp_reset_postdata();
endif;

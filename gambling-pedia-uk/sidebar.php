<?php
/**
 * Sidebar Template
 *
 * @package Gambling_Pedia_UK
 */

if ( is_active_sidebar( 'sidebar-main' ) ) :
    dynamic_sidebar( 'sidebar-main' );
else :
?>

    <!-- Trending Posts Widget -->
    <div class="widget trending-posts">
        <h3 class="widget-title"><?php esc_html_e( 'Trending Now', 'gambling-pedia-uk' ); ?></h3>
        <?php
        $trending = new WP_Query( array(
            'posts_per_page' => 5,
            'meta_key'       => 'gpuk_post_views',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ) );

        if ( ! $trending->have_posts() ) {
            $trending = new WP_Query( array(
                'posts_per_page' => 5,
                'post_status'    => 'publish',
            ) );
        }

        $count = 1;
        while ( $trending->have_posts() ) :
            $trending->the_post();
        ?>
            <div class="trending-item">
                <span class="trending-number"><?php echo esc_html( str_pad( $count, 2, '0', STR_PAD_LEFT ) ); ?></span>
                <div class="trending-content">
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <span class="entry-meta"><?php echo esc_html( get_the_date() ); ?></span>
                </div>
            </div>
        <?php
            $count++;
        endwhile;
        wp_reset_postdata();
        ?>
    </div>

    <!-- Newsletter Widget -->
    <div class="widget newsletter-widget">
        <h3 class="widget-title"><?php esc_html_e( 'Newsletter', 'gambling-pedia-uk' ); ?></h3>
        <p><?php esc_html_e( 'Get the latest UK gambling news delivered to your inbox. No spam, unsubscribe anytime.', 'gambling-pedia-uk' ); ?></p>
        <form class="newsletter-form" action="#" method="post">
            <input type="email" name="email" placeholder="<?php esc_attr_e( 'Your email address', 'gambling-pedia-uk' ); ?>" required>
            <button type="submit"><?php esc_html_e( 'Subscribe Now', 'gambling-pedia-uk' ); ?></button>
        </form>
    </div>

    <!-- Social Links Widget -->
    <div class="widget">
        <h3 class="widget-title"><?php esc_html_e( 'Follow Us', 'gambling-pedia-uk' ); ?></h3>
        <div class="social-links">
            <?php
            $social_platforms = array(
                'twitter'   => 'Twitter / X',
                'facebook'  => 'Facebook',
                'youtube'   => 'YouTube',
                'telegram'  => 'Telegram',
                'instagram' => 'Instagram',
                'rss'       => 'RSS Feed',
            );
            foreach ( $social_platforms as $platform => $label ) :
                if ( 'rss' === $platform ) {
                    $url = get_bloginfo( 'rss2_url' );
                } else {
                    $url = get_theme_mod( "gpuk_social_{$platform}", '' );
                }
                if ( $url ) :
            ?>
                <a href="<?php echo esc_url( $url ); ?>" class="social-link <?php echo esc_attr( $platform ); ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo esc_html( $label ); ?>
                </a>
            <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="widget">
        <h3 class="widget-title"><?php esc_html_e( 'Categories', 'gambling-pedia-uk' ); ?></h3>
        <ul>
            <?php
            wp_list_categories( array(
                'title_li' => '',
                'number'   => 10,
                'orderby'  => 'count',
                'order'    => 'DESC',
            ) );
            ?>
        </ul>
    </div>

    <!-- Tags Widget -->
    <div class="widget">
        <h3 class="widget-title"><?php esc_html_e( 'Popular Tags', 'gambling-pedia-uk' ); ?></h3>
        <div class="tagcloud">
            <?php
            wp_tag_cloud( array(
                'smallest' => 13,
                'largest'  => 13,
                'unit'     => 'px',
                'number'   => 20,
                'orderby'  => 'count',
                'order'    => 'DESC',
            ) );
            ?>
        </div>
    </div>

<?php endif; ?>

<?php
/**
 * Footer Template
 *
 * @package Gambling_Pedia_UK
 */
?>

    <!-- Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-col">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4 class="widget-title"><?php /* translators: %s: site name */ printf( esc_html__( 'About %s', 'gambling-pedia-uk' ), get_bloginfo( 'name' ) ); ?></h4>
                            <p>
                                <?php
                                $about_text = get_theme_mod( 'gpuk_footer_about', '' );
                                if ( $about_text ) {
                                    echo esc_html( $about_text );
                                } else {
                                    esc_html_e( 'Your trusted source for UK gambling news, casino reviews, sports betting insights, and regulatory updates. Stay informed with the latest from the British gambling industry.', 'gambling-pedia-uk' );
                                }
                                ?>
                            </p>
                            <div class="responsible-gambling">
                                <h4><?php esc_html_e( 'Responsible Gambling', 'gambling-pedia-uk' ); ?></h4>
                                <p><?php echo esc_html( get_theme_mod( 'gpuk_responsible_gambling_text', __( 'Gambling can be addictive. Please play responsibly. 18+ only. If you need help, visit BeGambleAware.org.', 'gambling-pedia-uk' ) ) ); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-col">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4 class="widget-title"><?php esc_html_e( 'Quick Links', 'gambling-pedia-uk' ); ?></h4>
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'footer',
                                'container'      => false,
                                'depth'          => 1,
                                'fallback_cb'    => false,
                            ) );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-col">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4 class="widget-title"><?php esc_html_e( 'Categories', 'gambling-pedia-uk' ); ?></h4>
                            <ul>
                                <?php
                                wp_list_categories( array(
                                    'title_li' => '',
                                    'number'   => 8,
                                    'orderby'  => 'count',
                                    'order'    => 'DESC',
                                ) );
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-col">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4 class="widget-title"><?php esc_html_e( 'Follow Us', 'gambling-pedia-uk' ); ?></h4>
                            <div class="social-links social-links--vertical">
                                <?php
                                $social_platforms = array(
                                    'twitter'   => 'Twitter / X',
                                    'facebook'  => 'Facebook',
                                    'youtube'   => 'YouTube',
                                    'telegram'  => 'Telegram',
                                    'instagram' => 'Instagram',
                                );
                                foreach ( $social_platforms as $platform => $label ) :
                                    $url = get_theme_mod( "gpuk_social_{$platform}", '' );
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>
                    &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
                    <?php esc_html_e( 'All rights reserved.', 'gambling-pedia-uk' ); ?>
                </p>
                <div class="footer-bottom-links">
                    <?php
                    if ( has_nav_menu( 'footer-bottom' ) ) :
                        wp_nav_menu( array(
                            'theme_location' => 'footer-bottom',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                            'items_wrap'     => '%3$s',
                        ) );
                    else :
                        // Fallback: link to pages by slug when no menu is assigned
                        $privacy_url = get_privacy_policy_url();
                        if ( $privacy_url ) :
                    ?>
                        <a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'gambling-pedia-uk' ); ?></a>
                    <?php
                        endif;

                        $legal_slugs = array(
                            'terms-of-use'  => __( 'Terms of Use', 'gambling-pedia-uk' ),
                            'cookie-policy' => __( 'Cookie Policy', 'gambling-pedia-uk' ),
                            'contact-us'    => __( 'Contact Us', 'gambling-pedia-uk' ),
                            'contact'       => __( 'Contact', 'gambling-pedia-uk' ),
                        );
                        $shown = array();
                        foreach ( $legal_slugs as $slug => $label ) :
                            if ( in_array( $slug, $shown, true ) ) {
                                continue;
                            }
                            $page = get_page_by_path( $slug );
                            if ( $page ) :
                                $shown[] = $slug;
                    ?>
                        <a href="<?php echo esc_url( get_permalink( $page ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </div>
                <?php gpuk_language_switcher(); ?>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>

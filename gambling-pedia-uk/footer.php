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
                            <h4 class="widget-title"><?php esc_html_e( 'About Gambling Pedia UK', 'gambling-pedia-uk' ); ?></h4>
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
                            <div class="social-links" style="display: flex; flex-direction: column; gap: 8px;">
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
                    <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacy Policy', 'gambling-pedia-uk' ); ?></a>
                    <a href="#"><?php esc_html_e( 'Terms of Use', 'gambling-pedia-uk' ); ?></a>
                    <a href="#"><?php esc_html_e( 'Cookie Policy', 'gambling-pedia-uk' ); ?></a>
                    <a href="#"><?php esc_html_e( 'Contact Us', 'gambling-pedia-uk' ); ?></a>
                </div>
                <?php gpuk_language_switcher(); ?>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>

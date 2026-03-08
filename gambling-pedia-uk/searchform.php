<?php
/**
 * Search Form Template
 *
 * @package Gambling_Pedia_UK
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-field" class="sr-only"><?php esc_html_e( 'Search for:', 'gambling-pedia-uk' ); ?></label>
    <input type="search" id="search-field" class="search-field" placeholder="<?php esc_attr_e( 'Search news, reviews...', 'gambling-pedia-uk' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'gambling-pedia-uk' ); ?></button>
</form>

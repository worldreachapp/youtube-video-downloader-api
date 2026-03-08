<?php
/**
 * No Results Template Part
 *
 * @package Gambling_Pedia_UK
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="section-title"><?php esc_html_e( 'Nothing Found', 'gambling-pedia-uk' ); ?></h1>
    </header>

    <div class="page-content" style="padding: 30px 0;">
        <?php if ( is_search() ) : ?>
            <p><?php esc_html_e( 'Sorry, no results were found for your search. Please try again with different keywords.', 'gambling-pedia-uk' ); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps a search would help.', 'gambling-pedia-uk' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>

<?php
/**
 * Related Posts Template Part
 *
 * @package Gambling_Pedia_UK
 */

$categories = get_the_category( get_the_ID() );
if ( ! $categories ) {
    return;
}

$cat_ids = wp_list_pluck( $categories, 'term_id' );

$related = new WP_Query( array(
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'category__in'   => $cat_ids,
    'post__not_in'   => array( get_the_ID() ),
    'orderby'        => 'rand',
) );

if ( $related->have_posts() ) :
?>
<div class="related-posts">
    <div class="section-header">
        <h3 class="section-title"><?php esc_html_e( 'Related Articles', 'gambling-pedia-uk' ); ?></h3>
    </div>

    <div class="related-posts-grid">
        <?php
        while ( $related->have_posts() ) :
            $related->the_post();
            get_template_part( 'template-parts/content', 'card' );
        endwhile;
        ?>
    </div>
</div>
<?php
    wp_reset_postdata();
endif;

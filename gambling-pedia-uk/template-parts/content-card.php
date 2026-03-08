<?php
/**
 * Post Card Template Part
 *
 * @package Gambling_Pedia_UK
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
    <div class="post-thumbnail">
        <?php
        $categories = get_the_category();
        if ( $categories ) :
        ?>
            <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="category-badge">
                <?php echo esc_html( $categories[0]->name ); ?>
            </a>
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'gpuk-card' ); ?>
            <?php else : ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a1a2e, #16213e); min-height: 180px;"></div>
            <?php endif; ?>
        </a>
    </div>

    <div class="post-content">
        <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="entry-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>

        <div class="entry-meta">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 28, '', '', array( 'class' => 'author-avatar' ) ); ?>
            <span class="byline"><?php the_author(); ?></span>
            <span class="posted-on"><?php echo esc_html( get_the_date() ); ?></span>
            <span class="reading-time"><?php echo esc_html( gpuk_reading_time() ); ?></span>
        </div>
    </div>
</article>

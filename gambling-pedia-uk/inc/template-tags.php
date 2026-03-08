<?php
/**
 * Custom Template Tags
 *
 * @package Gambling_Pedia_UK
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Fallback menu when no menu is assigned
 */
function gpuk_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'gambling-pedia-uk' ) . '</a></li>';

    $categories = get_categories( array(
        'number'  => 6,
        'orderby' => 'count',
        'order'   => 'DESC',
    ) );

    foreach ( $categories as $category ) {
        echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
    }

    echo '</ul>';
}

/**
 * Displays the posted on date
 */
function gpuk_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
    }

    echo sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );
}

/**
 * Displays the post author
 */
function gpuk_posted_by() {
    echo '<span class="byline"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
}

/**
 * Display post categories
 */
function gpuk_entry_categories() {
    if ( 'post' !== get_post_type() ) {
        return;
    }

    $categories_list = get_the_category_list( esc_html__( ', ', 'gambling-pedia-uk' ) );
    if ( $categories_list ) {
        echo '<span class="cat-links">' . $categories_list . '</span>';
    }
}

/**
 * Display post tags
 */
function gpuk_entry_tags() {
    if ( 'post' !== get_post_type() ) {
        return;
    }

    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gambling-pedia-uk' ) );
    if ( $tags_list ) {
        echo '<span class="tags-links">' . $tags_list . '</span>';
    }
}

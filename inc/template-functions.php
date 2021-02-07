<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package blemmie
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blemmie_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if (is_single() ) {
        global $post;
        foreach((get_the_category($post->ID)) as $category) {
            $classes[] = 'sgl-cat-'.$category->category_nicename;
        }
    }
	
	return $classes;
}
add_filter( 'body_class', 'blemmie_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blemmie_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blemmie_pingback_header' );

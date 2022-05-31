<?php
/**
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.0.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
add_filter( 'body_class', 'skywp_body_classes' );
function skywp_body_classes( $classes ) {
	// Adding a site color scheme class
	if ( 'scheme-light' == get_theme_mod( 'skywp_color_scheme', 'scheme-light' ) ) {
		$classes[] = 'scheme-light';
	}
	elseif ( 'scheme-dark' == get_theme_mod( 'skywp_color_scheme', 'scheme-light' ) ) {
		$classes[] = 'scheme-dark';
	}

	return $classes;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
add_action( 'wp_head', 'skywp_pingback_header' );
function skywp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

/**
 * Get all pages
 * 
 * @since  1.2.3
 */
function skywp_get_pages_for_pages_setup() {
	$output = [];
	$pages = get_pages();
	$output['default'] = esc_html__('Default', 'skywp');

	foreach ( $pages as $page ) {
		$output[ $page->ID ] = $page->post_title;
	}
	return $output;
}

/**
 * Redirect on the selected page
 *
 * @since  1.2.3
 */
add_action( 'template_redirect', 'skywp_custom_page_404' );
function skywp_custom_page_404() {

	if ( get_theme_mod( 'skywp_template_404', 'default' ) !== 'default' ) {
		
		$page = get_theme_mod( 'skywp_template_404', 'default' );
	
		if ( is_404() ) {
			wp_safe_redirect( get_the_permalink( $page ) );
			exit;
		}
	}
}
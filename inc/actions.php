<?php
/**
 * Actions
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*** Main ***/
// Add default SkyWP wrapper - before
add_action( 'skywp_outer_content_wrapper_before', 'skywp_output_content_wrapper_start', 10 );

// Add default SkyWP wrapper - after
add_action( 'skywp_outer_content_wrapper_after', 'skywp_output_content_wrapper_end', 10 );



/*** TopBar ***/

// Topbar column layout
add_action( 'skywp_topbar_layout', 'skywp_topbar_column_layout', 10 );



/*** Header ***/

// Header layout
add_action( 'skywp_header', 'skywp_header_template', 10 );



// If header layout = banner, that adding the wrapper for logo and banner - start
add_action( 'skywp_header_logo', 'skywp_header_wrapper_banner_start', 5 );

// Header layout logo
add_action( 'skywp_header_logo', 'skywp_header_template_logo', 10 );



// Header banner
add_action( 'skywp_header_banner', 'skywp_header_template_banner', 10 );

// If header layout = banner, that adding the wrapper for logo and banner - end
add_action( 'skywp_header_banner', 'skywp_header_wrapper_banner_end', 20 );



// Custom Header
add_action( 'skywp_custom_header', 'skywp_custom_header_template', 10 );



// If header layout = banner, that adding the wrapper for menu and right item - start
add_action( 'skywp_header_navigation', 'skywp_header_banner_wrapper_menu_start', 5 );

// Header layout template menu navigation
add_action( 'skywp_header_navigation', 'skywp_header_template_navigation', 10 );



// Connect search to the header
add_action( 'skywp_header_search', 'skywp_header_search_template', 10 );



// Adding wrapper on a right header item - start
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_wrapper_start', 10 );

// Right header item - Search
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_search', 20 );

// Right header item - Button
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_button', 30 );

// Right header item - Text / HTML
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_text_html', 40 );

// Right header item - Widget
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_widget', 50 );

// Right header item - WooCommerce
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_woocommerce', 60 );

// Adding wrapper on a right header item - end
add_action( 'skywp_right_header_item_template', 'skywp_right_header_item_wrapper_end', 100 );

// If header layout = banner, that adding the wrapper for menu and right item - end
add_action( 'skywp_right_header_item_template', 'skywp_header_banner_wrapper_menu_end', 110 );






/*** Breadcrumb ***/

// After header breadcrumb
add_action( 'skywp_breadcrumb_header', 'skywp_breadcrumb_after_header_layout', 10 );

// Breadcrumb before title
add_action( 'skywp_breadcrumb_before_title', 'skywp_breadcrumb_before_title_layout', 10 );

// Add wrapper breadcrumbs start
add_action( 'skywp_breadcrumb_wrapper_start', 'skywp_breadcrumb_wrapper_layout_start', 10 );

// Add wrapper breadcrumbs end
add_action( 'skywp_breadcrumb_wrapper_end', 'skywp_breadcrumb_wrapper_layout_end', 10 );
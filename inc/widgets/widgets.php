<?php
/**
 * This file register area the widgets.
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'widgets_init', 'skywp_widgets_init' );
function skywp_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'skywp' ),
		'id'            => 'main-sidebar',
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( get_theme_mod( 'skywp_topbar', false ) == true ) {
		register_sidebar( array(
			'name'          => esc_html__( 'TopBar (Left)', 'skywp' ),
			'id'            => 'topbar-left',
			'description'   => esc_html__( 'Widgets in this area will be displayed in the TopBar left.', 'skywp' ),
			'before_widget' => '<div id="%1$s" class="site_widget widget-topbar-left %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'TopBar (Centered)', 'skywp' ),
			'id'            => 'topbar-centered',
			'description'   => esc_html__( 'Widgets in this area will be displayed in the TopBar centered.', 'skywp' ),
			'before_widget' => '<div id="%1$s" class="site_widget widget-topbar-centered %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'TopBar (Right)', 'skywp' ),
			'id'            => 'topbar-right',
			'description'   => esc_html__( 'Widgets in this area will be displayed in the TopBar right.', 'skywp' ),
			'before_widget' => '<div id="%1$s" class="site_widget widget-topbar-right %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if ( get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'widget' ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Header', 'skywp' ),
			'id'            => 'widget-right-header-item',
			'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if ( get_theme_mod( 'skywp_header_layout', 'standard' ) == 'banner' ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Header Banner', 'skywp' ),
			'id'            => 'header-banner',
			'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'skywp' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Widgets in this area are used in the first footer region.', 'skywp' ),
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'skywp' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Widgets in this area are used in the second footer region.', 'skywp' ),
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'skywp' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Widgets in this area are used in the third footer region.', 'skywp' ),
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'skywp' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Widgets in this area are used in the fourth footer region.', 'skywp' ),
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Copyright', 'skywp' ),
		'id'            => 'copyright-1',
		'description'   => esc_html__( 'Widgets in this area are used in the copyright region.', 'skywp' ),
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( '404', 'skywp' ),
		'id'            => 'page-404',
		'description'   => esc_html__( 'Widgets in this area are used in the page 404.', 'skywp' ),
		'before_widget' => '<div id="%1$s" class="site_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce Sidebar', 'skywp' ),
			'id'            => 'woocommerce-sidebar',
			'description'   => esc_html__( 'This sidebar will be used on Product archive, Cart, Checkout and My Account pages.', 'skywp' ),
			'before_widget' => '<div id="%1$s" class="site_widget widget-topbar-left %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Product Sidebar', 'skywp' ),
			'id'            => 'product-sidebar',
			'description'   => esc_html__( 'This sidebar will be used on Single Product page.', 'skywp' ),
			'before_widget' => '<div id="%1$s" class="site_widget widget-topbar-centered %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}

<?php
/**
* Sidebar Customizer Options
*
* @package Urchenko
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.2.3
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'skywp_customizer_sidebar_settings' );
function skywp_customizer_sidebar_settings( $wp_customize ) {

	/**
	 * Sidebar section
	 */
	$wp_customize->add_section( 'skywp_sidebar_section', array(
		'title'				=> esc_html__( 'Sidebar', 'skywp' ),
		'panel'				=> 'skywp_general_settings_panel',
		'priority'			=> 10,
	) );

	/**
	 * Default Layout
	 */
	$wp_customize->add_setting( 'skywp_default_sidebar', array(
		'default'				=> 'sidebar-right',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_default_sidebar', array(
		'label'					=> esc_html__('Default Layout', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_default_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	/**
	 * Pages
	 */
	$wp_customize->add_setting( 'skywp_pages_sidebar', array(
		'default'				=> 'sidebar-right',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_pages_sidebar', array(
		'label'					=> esc_html__('Pages', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_pages_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	/**
	 * Articles
	 */
	$wp_customize->add_setting( 'skywp_articles_sidebar', array(
		'default'				=> 'sidebar-right',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_articles_sidebar', array(
		'label'					=> esc_html__('Articles', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_articles_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	/**
	 * Archives
	 */
	$wp_customize->add_setting( 'skywp_archives_sidebar', array(
		'default'				=> 'sidebar-right',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_archives_sidebar', array(
		'label'					=> esc_html__('Archives', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_archives_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	/**
	 * Blog page
	 */
	$wp_customize->add_setting( 'skywp_blog_page_sidebar', array(
		'default'				=> 'sidebar-right',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_blog_page_sidebar', array(
		'label'					=> esc_html__('Blog Page', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_blog_page_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	/**
	 * Search
	 */
	$wp_customize->add_setting( 'skywp_search_page_sidebar', array(
		'default'				=> 'sidebar-right',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_search_page_sidebar', array(
		'label'					=> esc_html__('Search', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_search_page_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	if ( class_exists( 'WooCommerce' ) ) :

	/**
	 * WooCommerce
	 */
	$wp_customize->add_setting( 'skywp_woocommerce_sidebar', array(
		'default'				=> 'no-sidebar',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_woocommerce_sidebar', array(
		'label'					=> esc_html__('WooCommerce', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_woocommerce_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );

	/**
	 * Single Product
	 */
	$wp_customize->add_setting( 'skywp_woo_single_product_sidebar', array(
		'default'				=> 'no-sidebar',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_woo_single_product_sidebar', array(
		'label'					=> esc_html__('Single Product', 'skywp'),
		'section'				=> 'skywp_sidebar_section',
		'settings'				=> 'skywp_woo_single_product_sidebar',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'sidebar-right'   => __( 'Sidebar Right', 'skywp' ),
            'sidebar-left'  => __( 'Sidebar Left', 'skywp' ),
            'no-sidebar'  => __( 'No Sidebar', 'skywp' ),
        )
	) ) );
	
	endif;




	






}
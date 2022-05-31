<?php
/**
* Content Customizer Options
*
* @package Urchenko
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.2.3
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'skywp_customizer_content_settings' );
function skywp_customizer_content_settings( $wp_customize ) {

	/**
	 * Panel Content Settings
	 */
	$wp_customize->add_panel( 'skywp_content_panel', array(
		'title' 			=> esc_html__( 'Content', 'skywp' ),
		'priority' 			=> 28,
	) );




	/**
	 * Post Page
	 */
	$wp_customize->add_section( 'skywp_post_page', array(
		'title'				=> esc_html__( 'Post Page', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_content_panel',
	) );

	/**
	 * Header
	 */
	$wp_customize->add_setting( 'skywp_content_heading_1', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_content_heading_1', array(
		'label'    				=> esc_html__( 'Post Display Style', 'skywp' ),
		'section'  				=> 'skywp_post_page',
		'settings'				=> 'skywp_content_heading_1',
		'priority' 				=> 10,
	) ) );

	/**
	 * Layout Style
	 */
	$wp_customize->add_setting( 'skywp_post_page_layout', array(
		'default'				=> 'default',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_post_page_layout', array(
		'label'					=> esc_html__('Layout Style', 'skywp'),
		'section'				=> 'skywp_post_page',
		'settings'				=> 'skywp_post_page_layout',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'default'   => __( 'Default', 'skywp' ),
        )
	) ) );

	/**
	 * Post Style
	 */
	$wp_customize->add_setting( 'skywp_post_page_style', array(
		'default'				=> 'default',
		'sanitize_callback' 	=> 'skywp_radio_sanitization',
	) );

	$wp_customize->add_control( new SkyWP_Image_Radio_Button_Control( $wp_customize, 'skywp_post_page_style', array(
		'label'					=> esc_html__('Post Style', 'skywp'),
		'section'				=> 'skywp_post_page',
		'settings'				=> 'skywp_post_page_style',
		'priority'				=> 10,
        'choices' => array(
			'default' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/blog-default.png',
				'name' => esc_html__( 'Default', 'skywp' ),
			),
			'masonry' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/blog-masonry.png',
				'name' => esc_html__( 'Masonry', 'skywp' ),
			),
		)
	) ) );

	/**
	 * Number Of Columns
	 */
	$wp_customize->add_setting( 'skywp_post_page_number_columns', array(
		'default'				=> 'one',
		'sanitize_callback' 	=> 'skywp_radio_sanitization',
	) );

	$wp_customize->add_control( new SkyWP_Image_Radio_Button_Control( $wp_customize, 'skywp_post_page_number_columns', array(
		'label'					=> esc_html__('Number Of Columns', 'skywp'),
		'section'				=> 'skywp_post_page',
		'settings'				=> 'skywp_post_page_number_columns',
		'priority'				=> 10,
        'choices' => array(
			'one' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/one-column.png',
				'name' => esc_html__( 'One', 'skywp' ),
			),
			'two' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/two-column.png',
				'name' => esc_html__( 'Two', 'skywp' ),
			),
			'three' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/three-column.png',
				'name' => esc_html__( 'Three', 'skywp' ),
			),
		)
	) ) );

	/**
	 * Background
	 */
	$wp_customize->add_setting( 'skywp_post_page_bg', array(
		'default'				=> '#fafafa',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_post_page_bg', array(
		'label'					=> esc_html__('Background', 'skywp'),
		'section'				=> 'skywp_post_page',
		'settings'				=> 'skywp_post_page_bg',
		'priority'				=> 10,
	) ) );

	/**
	 * Title Color
	 */
	$wp_customize->add_setting( 'skywp_post_page_title_color', array(
		'default'				=> '#333333',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_post_page_title_color', array(
		'label'					=> esc_html__('Title Color', 'skywp'),
		'section'				=> 'skywp_post_page',
		'settings'				=> 'skywp_post_page_title_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Meta Color
	 */
	$wp_customize->add_setting( 'skywp_post_page_meta_color', array(
		'default'				=> '#333333',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_post_page_meta_color', array(
		'label'					=> esc_html__('Meta Color', 'skywp'),
		'section'				=> 'skywp_post_page',
		'settings'				=> 'skywp_post_page_meta_color',
		'priority'				=> 10,
	) ) );





	/**
	 * Article Page
	 */
	$wp_customize->add_section( 'skywp_article_page', array(
		'title'				=> esc_html__( 'Article Page', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_content_panel',
	) );

	/**
	 * Meta color
	 */
	$wp_customize->add_setting( 'skywp_article_meta_color', array(
		'default'				=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_article_meta_color', array(
		'label'					=> esc_html__('Meta Color', 'skywp'),
		'section'				=> 'skywp_article_page',
		'settings'				=> 'skywp_article_meta_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_post_navigation_heading', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_post_navigation_heading', array(
		'label'    				=> esc_html__( 'Post Navigation', 'skywp' ),
		'section'  				=> 'skywp_article_page',
		'settings'				=> 'skywp_post_navigation_heading',
		'priority' 				=> 10,
	) ) );

	/**
	 * Color
	 */
	$wp_customize->add_setting( 'skywp_article_prev_next_color', array(
		'default'				=> '#333333',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_article_prev_next_color', array(
		'label'					=> esc_html__('Color', 'skywp'),
		'section'				=> 'skywp_article_page',
		'settings'				=> 'skywp_article_prev_next_color',
		'priority'				=> 10,
	) ) );

	$wp_customize->selective_refresh->add_partial( 'skywp_post_navigation_heading', array(
        'selector' => '.post-navigation .nav-links',
        'render_callback' => function() {
            return get_theme_mod( 'skywp_post_navigation_heading' );
        }
    ) );

	/**
	 * Background
	 */
	$wp_customize->add_setting( 'skywp_article_prev_next_bg', array(
		'default'				=> '#fafafa',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_article_prev_next_bg', array(
		'label'					=> esc_html__('Background', 'skywp'),
		'section'				=> 'skywp_article_page',
		'settings'				=> 'skywp_article_prev_next_bg',
		'priority'				=> 10,
	) ) );





	/**
	 * Section Pagination
	 */
	$wp_customize->add_section( 'skywp_pagination', array(
		'title'				=> esc_html__( 'Pagination', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_content_panel',
	) );

	/**
	 * Align
	 */
	$wp_customize->add_setting( 'skywp_pagination_align', array(
		'default'				=> 'center',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_pagination_align', array(
		'label'					=> esc_html__('Align:', 'skywp'),
		'section'				=> 'skywp_pagination',
		'settings'				=> 'skywp_pagination_align',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'center'   => esc_html__( 'Center', 'skywp' ),
            'left'  => esc_html__( 'Left', 'skywp' ),
            'right'  => esc_html__( 'Right', 'skywp' ),
        )
	) ) );

	/**
	 * Border Color
	 */
	$wp_customize->add_setting( 'skywp_pagination_border_color', array(
		'default'				=> '#9a9393',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_pagination_border_color', array(
		'label'					=> esc_html__('Border Color', 'skywp'),
		'section'				=> 'skywp_pagination',
		'settings'				=> 'skywp_pagination_border_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Color
	 */
	$wp_customize->add_setting( 'skywp_pagination_color', array(
		'default'				=> '#9a9393',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_pagination_color', array(
		'label'					=> esc_html__('Color', 'skywp'),
		'section'				=> 'skywp_pagination',
		'settings'				=> 'skywp_pagination_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Border Radius
	 */
	$wp_customize->add_setting( 'skywp_pagination_border_radius', array(
		'default'				=> '3',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_pagination_border_radius', array(
		'label'					=> esc_html__('Border Radius (px):', 'skywp'),
		'section'				=> 'skywp_pagination',
		'settings'				=> 'skywp_pagination_border_radius',
		'priority'				=> 10,
		'type'           => 'text',
	) ) );

	

	





	






}
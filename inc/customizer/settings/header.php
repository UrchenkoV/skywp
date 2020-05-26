<?php
/**
* Header Customizer Options
*
* @package Urchenko Technologies
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.0.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Customizer Header Options
*
* @since 1.0.0
*/
add_action( 'customize_register', 'skywp_customizer_header_options' );
function skywp_customizer_header_options( $wp_customize ) {

	/**
	 * Panel Header
	 */
	$wp_customize->add_panel( 'skywp_header_panel', array(
		'title' 			=> esc_html__( 'Header', 'skywp' ),
		'priority' 			=> 26,
	) );

	/**
	 * Section Header Main
	 */
	$wp_customize->add_section( 'skywp_header_main', array(
		'title'				=> esc_html__( 'Main', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_header_panel',
	) );

	/**
	 * Select header layout
	 */
	$wp_customize->add_setting( 'skywp_header_layout', array(
		'default'				=> 'standard',
		'sanitize_callback' 	=> 'skywp_radio_sanitization',
	) );

	$wp_customize->add_control( new SkyWP_Image_Radio_Button_Control( $wp_customize, 'skywp_header_layout', array(
		'label'					=> esc_html__('Select header layout', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_layout',
		'priority'				=> 10,
        'choices' => array(
			'standard' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/standard-menu.png',
				'name' => esc_html__( 'Standard Menu', 'skywp' ),
			),
			'centered' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/centered-menu.png',
				'name' => esc_html__( 'Centered Menu', 'skywp' ),
			),
			'left_aligned' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/left-aligned.png',
				'name' => esc_html__( 'Left Aligned Menu', 'skywp' ),
			),
			'standard_2' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/standard-menu-2.png',
				'name' => esc_html__( 'Standard Menu 2', 'skywp' ),
			),
			'banner' => array(
				'image' => SKYWP_THEME_URI . '/inc/customizer/assets/image/banner-menu.png',
				'name' => esc_html__( 'Banner Menu', 'skywp' ),
			),
		)
	) ) );

	/**
	 * Sticky Header
	 */
	$wp_customize->add_setting( 'skywp_header_sticky', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_sticky', array(
		'label'					=> esc_html__('Sticky Header', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_sticky',
		'priority'				=> 10,
	) ) );

	/**
	 * Header Border Bottom
	 */
	$wp_customize->add_setting( 'skywp_header_border_bottom', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_border_bottom', array(
		'label'					=> esc_html__('Border Bottom', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_border_bottom',
		'priority'				=> 10,
	) ) );

	/**
	* Header Border Bottom Color relative
	*/
	$wp_customize->add_setting( 'skywp_header_border_color_relative', array(
		'default'			=> '#e4e4e4',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_header_border_color_relative', array(
		'label'				=> esc_html__( 'Border Color', 'skywp' ),
		'section'			=> 'skywp_header_main',
		'settings'			=> 'skywp_header_border_color_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_header_border_bottom', false ) == true;
    	},
	) ) );

	/**
	* Position
	*/
	$wp_customize->add_setting( 'skywp_header_position', array(
		'default'			=> 'relative',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_position', array(
		'label'				=> esc_html__( 'Position', 'skywp' ),
		'type'				=> 'select',
		'section'			=> 'skywp_header_main',
		'settings'			=> 'skywp_header_position',
		'priority'			=> 10,
		'choices'			=> array(
			'relative'		=> esc_html__( 'Relative', 'skywp' ),
			'absolute'		=> esc_html__( 'Absolute', 'skywp' ),
		),
	) ) );

	/**
	 * Disable position absolute on all pages except the template: full-width page
	 */
	$wp_customize->add_setting( 'skywp_header_disable_position_absolute_all_except_full_width_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_disable_position_absolute_all_except_full_width_page', array(
		'label'					=> esc_html__('Disable position absolute on all pages except the template: full-width page.', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_disable_position_absolute_all_except_full_width_page',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_position' ) == 'absolute';
   		},
	) ) );

	/**
	 * Width
	 */
	$wp_customize->add_setting( 'header_width', array(
		'default'				=> '1200',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_width', array(
		'label'					=> esc_html__('Width (px):', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'header_width',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Offset Top (Desktop)
	 */
	$wp_customize->add_setting( 'skywp_header_offset_top', array(
		'default'				=> '0',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_offset_top', array(
		'label'					=> esc_html__('Offset Top (Desktop)', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_offset_top',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_topbar_position' ) == 'absolute';
   		},
	) ) );

	/**
	 * Offset Top (Tablet 768 - 425px)
	 */
	$wp_customize->add_setting( 'skywp_header_offset_top_tablet', array(
		'default'				=> '0',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_offset_top_tablet', array(
		'label'					=> esc_html__('Offset Top (Tablet 768 - 425px)', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_offset_top_tablet',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_topbar_position' ) == 'absolute';
   		},
	) ) );

	/**
	 * Offset Top (Mobile < 425px)
	 */
	$wp_customize->add_setting( 'skywp_header_offset_top_mobile', array(
		'default'				=> '0',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_offset_top_mobile', array(
		'label'					=> esc_html__('Offset Top (Mobile < 425px)', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_offset_top_mobile',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_topbar_position' ) == 'absolute';
   		},
	) ) );

	/**
	 * Links Color relative
	 */
	$wp_customize->add_setting( 'skywp_header_link_color_relative', array(
		'default' => '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_link_color_relative', array(
		'label'				=> esc_html__( 'Links Color', 'skywp' ),
		'description'     => __( 'This setting changes the color on pages where (Position: relative)', 'skywp' ),
		'section'			=> 'skywp_header_main',
		'settings'			=> 'skywp_header_link_color_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_position', 'relative' ) == 'relative' || get_theme_mod( 'skywp_header_disable_position_absolute_all_except_full_width_page', false ) == true;
   		},
	) ) );

	/**
	 * Links Color absolute
	 */
	$wp_customize->add_setting( 'skywp_header_link_color_absolute', array(
		'default' => '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_link_color_absolute', array(
		'label'				=> esc_html__( 'Links Color', 'skywp' ),
		'description'     => __( 'This setting changes the color on pages where (Position: absolute)', 'skywp' ),
		'section'			=> 'skywp_header_main',
		'settings'			=> 'skywp_header_link_color_absolute',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_position', 'relative' ) == 'absolute';
   		},
	) ) );

	/**
	 * Backgtoung relative
	 */
	$wp_customize->add_setting( 'skywp_bg_header_relative', array(
		'default'     => '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_bg_header_relative', array(
		'label'     => __( 'Background', 'skywp' ),
		'description'     => __( 'This setting changes the background on pages where (Position: relative)', 'skywp' ),
		'section'   => 'skywp_header_main',
		'settings'  => 'skywp_bg_header_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_position', 'relative' ) == 'relative' || get_theme_mod( 'skywp_header_disable_position_absolute_all_except_full_width_page', false ) == true;
   		},
	) ) );

	/**
	 * Backgtoung absolute
	 */
	$wp_customize->add_setting( 'skywp_bg_header_absolute', array(
		'default'     => 'rgba(255,255,255,0)',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_bg_header_absolute', array(
		'label'     => __( 'Background', 'skywp' ),
		'description'     => __( 'This setting changes the background on pages where (Position: absolute)', 'skywp' ),
		'section'   => 'skywp_header_main',
		'settings'  => 'skywp_bg_header_absolute',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_position', 'relative' ) == 'absolute';
   		},
	) ) );

	/**
	 * Backgtoung Sticky Header
	 */
	$wp_customize->add_setting( 'skywp_bg_sticky_header', array(
		'default'     => '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_bg_sticky_header', array(
		'label'     => __( 'Background Sticky', 'skywp' ),
		'section'   => 'skywp_header_main',
		'settings'  => 'skywp_bg_sticky_header',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_sticky', true );
   		},
	) ) );

	/**
	 * Links Effect
	 */
	$wp_customize->add_setting( 'skywp_header_links_effect', array(
		'default'				=> 'standard',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_links_effect', array(
		'label'					=> esc_html__('Links Effect', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_links_effect',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'standard'   => esc_html__( 'Color', 'skywp' ),
            'style-second'   => esc_html__( 'Border Bottom', 'skywp' ),
        )
	) ) );

	/**
	 * Font Size
	 */
	$wp_customize->add_setting( 'skywp_header_font_size', array(
		'default'				=> '14',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_font_size', array(
		'label'					=> esc_html__('Font Size (px)', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_font_size',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Font Weight
	 */
	$wp_customize->add_setting( 'skywp_header_font_weight', array(
		'default'				=> '400',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_font_weight', array(
		'label'					=> esc_html__('Font Weight', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_font_weight',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            '100'   => __( '400', 'skywp' ),
            '200'   => __( '400', 'skywp' ),
            '300'   => __( '400', 'skywp' ),
            '400'   => __( '400', 'skywp' ),
            '500'  => __( '500', 'skywp' ),
            '600'  => __( '600', 'skywp' ),
            '700'  => __( '700', 'skywp' ),
            '800'  => __( '800', 'skywp' ),
            '900'  => __( '900', 'skywp' ),
        )
	) ) );

	/**
	 * Text Transform
	 */
	$wp_customize->add_setting( 'skywp_header_text_transform', array(
		'default'				=> 'capitalize',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_text_transform', array(
		'label'					=> esc_html__('Text Transform', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_text_transform',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'uppercase'   => __( 'Uppercase', 'skywp' ),
            'lowercase'  => __( 'Lowercase', 'skywp' ),
            'capitalize'  => __( 'Capitalize', 'skywp' ),
            'none'  => __( 'None', 'skywp' ),
        )
	) ) );

	/**
	 * Letter Spacing
	 */
	$wp_customize->add_setting( 'skywp_header_letter_spacing', array(
		'default'				=> '1',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_letter_spacing', array(
		'label'					=> esc_html__('Letter Spacing (px)', 'skywp'),
		'section'				=> 'skywp_header_main',
		'settings'				=> 'skywp_header_letter_spacing',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );





	/**
	 * Section Mobile Menu
	 */
	$wp_customize->add_section( 'skywp_header_mobile_menu', array(
		'title'				=> esc_html__( 'Mobile Menu', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_header_panel',
	) );

	/**
	 * Position
	 */
	$wp_customize->add_setting( 'skywp_header_position_mobile_menu', array(
		'default'				=> 'left',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_position_mobile_menu', array(
		'label'					=> esc_html__('Position', 'skywp'),
		'section'				=> 'skywp_header_mobile_menu',
		'settings'				=> 'skywp_header_position_mobile_menu',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'left'   => __( 'Left', 'skywp' ),
            'right'  => __( 'Right', 'skywp' ),
            'top'  => __( 'Top', 'skywp' ),
            'bottom'  => __( 'Bottom', 'skywp' ),
        )
	) ) );

	/**
	 * Effect opening submenus
	 */
	$wp_customize->add_setting( 'skywp_header_opening_mobile_menu', array(
		'default'				=> 'overlap',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_opening_mobile_menu', array(
		'label'					=> esc_html__('Effect opening submenus', 'skywp'),
		'section'				=> 'skywp_header_mobile_menu',
		'settings'				=> 'skywp_header_opening_mobile_menu',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'overlap'   => __( 'Overlap levels', 'skywp' ),
            'expand'  => __( 'Expand levels', 'skywp' ),
            'none'  => __( 'Unfolded levels', 'skywp' ),
        )
	) ) );

	/**
	* Mobile menu button color - relative
	*/
	$wp_customize->add_setting( 'skywp_header_menu_button_color', array(
		'default'			=> '#212121',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_menu_button_color', array(
		'label'				=> esc_html__( 'Button Menu', 'skywp' ),
		'description'     => __( 'This setting changes the color on pages where (Position: relative)', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_menu_button_color',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return ( get_theme_mod( 'skywp_header_position', 'relative' ) == 'absolute' && get_theme_mod( 'skywp_header_disable_position_absolute_all_except_full_width_page', false ) == true ) || get_theme_mod( 'skywp_header_position', 'relative' ) == 'relative';
   		},
	) ) );

	/**
	 * Mobile menu button color - absolute
	 */
	$wp_customize->add_setting( 'skywp_header_m_menu_but_color_absolute', array(
		'default' => '#212121',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_header_m_menu_but_color_absolute', array(
		'label'				=> esc_html__( 'Button Menu', 'skywp' ),
		'description'     => __( 'This setting changes the color on pages where (Position: absolute)', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_m_menu_but_color_absolute',
		'priority'			=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_header_position', 'relative' ) == 'absolute';
   		},
	) ) );

	/**
	* Background
	*/
	$wp_customize->add_setting( 'skywp_header_background_mobile', array(
		'default'			=> '#212121',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_background_mobile', array(
		'label'				=> esc_html__( 'Background', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_background_mobile',
		'priority'			=> 10,
	) ) );

	/**
	* Background :Hover
	*/
	$wp_customize->add_setting( 'skywp_header_background_hover', array(
		'default'			=> '#484848',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_background_hover', array(
		'label'				=> esc_html__( 'Background :Hover', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_background_hover',
		'priority'			=> 10,
	) ) );

	/**
	* Border Color
	*/
	$wp_customize->add_setting( 'skywp_header_border_mobile_color', array(
		'default'			=> '#484848',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_border_mobile_color', array(
		'label'				=> esc_html__( 'Border Color', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_border_mobile_color',
		'priority'			=> 10,
	) ) );

	/**
	* Color
	*/
	$wp_customize->add_setting( 'skywp_header_mobile_color', array(
		'default'			=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_mobile_color', array(
		'label'				=> esc_html__( 'Color', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_mobile_color',
		'priority'			=> 10,
	) ) );

	/**
	* Color :Hover
	*/
	$wp_customize->add_setting( 'skywp_header_color_hover', array(
		'default'			=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_color_hover', array(
		'label'				=> esc_html__( 'Color :Hover', 'skywp' ),
		'section'			=> 'skywp_header_mobile_menu',
		'settings'			=> 'skywp_header_color_hover',
		'priority'			=> 10,
	) ) );





	/**
	 * Right Header Item
	 */
	$wp_customize->add_section( 'skywp_right_header_item', array(
		'title'				=> esc_html__( 'Right Header Item', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_header_panel',
	) );

	/**
	 * Right Header Item
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_select', array(
		'default'				=> 'none',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_select', array(
		'label'					=> esc_html__( 'Right Header Item', 'skywp' ),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_select',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'none'   => esc_html__( 'None', 'skywp' ),
            'search'   => esc_html__( 'Search', 'skywp' ),
            'button'   => esc_html__( 'Button', 'skywp' ),
            'text-html'   => esc_html__( 'Text / HTML', 'skywp' ),
            'widget'   => esc_html__( 'Widget', 'skywp' ),
            'woocommerce'   => esc_html__( 'WooCommerce', 'skywp' ),
        ),
	) ) );

	$wp_customize->selective_refresh->add_partial( 'skywp_right_header_item_select', array(
        'selector' => '.right-header-item',
        'render_callback' => function() {
            return get_theme_mod( 'skywp_right_header_item_select' );
        }
    ) );

	/**
	 * Hide on Tablet
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_hide_tablet', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_hide_tablet', array(
		'label'					=> esc_html__('Hide on Tablet', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_hide_tablet',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) !== 'none';
    	},
	) ) );

	/**
	 * Hide on Mobile
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_hide_mobile', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_hide_mobile', array(
		'label'					=> esc_html__('Hide on Mobile', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_hide_mobile',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) !== 'none';
    	},
	) ) );

	/**
	 * Search Style
	 */
	$wp_customize->add_setting( 'skywp_header_search_style', array(
		'default'				=> 'dropdown',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_search_style', array(
		'label'					=> esc_html__('Search Style', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_search_style',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'dropdown'   => __( 'Dropdown', 'skywp' ),
        ),
        'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'search';
    	},
	) ) );

	/**
	 * Button Text
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_button', array(
		'default'				=> esc_html__('Button', 'skywp'),
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_button', array(
		'label'					=> esc_html__('Button Text', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_button',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button';
    	},
	) ) );

	/**
	 * Button Link
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_button_link', array(
		'default'				=> 'https://urchenko.ru',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_button_link', array(
		'label'					=> esc_html__('Button Link', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_button_link',
		'priority'				=> 10,
		'type'           => 'url',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button';
    	},
	) ) );

	/**
	 * Open in New Tab
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_button_open_new_tab', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_button_open_new_tab', array(
		'label'					=> esc_html__('Open in New Tab', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_button_open_new_tab',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button';
    	},
	) ) );

	/**
	 * Button Link Rel
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_button_link_rel', array(
		'default'				=> '',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_button_link_rel', array(
		'label'					=> esc_html__('Button Link Rel', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_button_link_rel',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button';
    	},
	) ) );

	/**
	 * Button Style
	 */
	$wp_customize->add_setting( 'skywp_right_header_item_button_style', array(
		'default'				=> 'theme-button',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_right_header_item_button_style', array(
		'label'					=> esc_html__( 'Button Style', 'skywp' ),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_right_header_item_button_style',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'theme-button'   => __( 'Theme Button', 'skywp' ),
            'header-button'   => __( 'Header Button', 'skywp' ),
        ),
        'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button';
    	},
	) ) );

	/**
	 * Notice
	 */
	$wp_customize->add_setting( 'skywp_theme_button_notice', array(
			'default' => '',
			'sanitize_callback' => 'skywp_text_sanitization'
		)
	);

	$query['autofocus[section]'] = 'skywp_theme_buttons';
	$section_link = add_query_arg( $query, admin_url( 'customize.php' ) );

	$wp_customize->add_control( new SkyWP_Notice_Control( $wp_customize, 'skywp_theme_button_notice', array(
			'description' => sprintf( esc_html__( '%1$sCustomize Button Style.%2$s', 'skywp' ), '<a href="'. esc_url( $section_link ) .'">', '</a>' ),
			'section' => 'skywp_right_header_item',
			'priority'				=> 10,
			'active_callback'   => function() {
	        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'theme-button';
	    	},
		)
	) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_header_button', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_header_button', array(
		'label'    				=> esc_html__( 'Header Button', 'skywp' ),
		'section'  				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_heading_header_button',
		'priority' 				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Font Size
	 */
	$wp_customize->add_setting( 'skywp_header_button_font_size', array(
		'default'				=> '14',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_button_font_size', array(
		'label'					=> esc_html__('Font Size (px)', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_font_size',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Font Weight
	 */
	$wp_customize->add_setting( 'skywp_header_button_font_weight', array(
		'default'				=> '400',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_button_font_weight', array(
		'label'					=> esc_html__('Font Weight', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_font_weight',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            '400'   => __( '400', 'skywp' ),
            '500'  => __( '500', 'skywp' ),
            '600'  => __( '600', 'skywp' ),
            '700'  => __( '700', 'skywp' ),
            '800'  => __( '800', 'skywp' ),
            '900'  => __( '900', 'skywp' ),
        ),
        'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Text Transform
	 */
	$wp_customize->add_setting( 'skywp_header_button_text_transform', array(
		'default'				=> 'capitalize',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_button_text_transform', array(
		'label'					=> esc_html__('Text Transform:', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_text_transform',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'uppercase'   => __( 'Uppercase', 'skywp' ),
            'lowercase'  => __( 'Lowercase', 'skywp' ),
            'capitalize'  => __( 'Capitalize', 'skywp' ),
            'none'  => __( 'None', 'skywp' ),
        ),
        'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Padding
	 */
	$wp_customize->add_setting( 'skywp_header_button_padding', array(
		'default'				=> '10px 25px 10px 25px',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_button_padding', array(
		'label'					=> esc_html__('Padding (px)', 'skywp'),
		'description'			=> esc_html__( 'top right bottom left: 15px 25px 15px 25px', 'skywp' ),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_padding',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_header_button_color', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_header_button_color', array(
		'label'    				=> esc_html__( 'Color', 'skywp' ),
		'section'  				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_heading_header_button_color',
		'priority' 				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Color
	 */
	$wp_customize->add_setting( 'skywp_header_button_color', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_button_color', array(
		'label'					=> esc_html__('Color', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_color',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Color :Hover
	 */
	$wp_customize->add_setting( 'skywp_header_button_color_hover', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_button_color_hover', array(
		'label'					=> esc_html__('Color :Hover', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_color_hover',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_header_button_bg', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_header_button_bg', array(
		'label'    				=> esc_html__( 'Background', 'skywp' ),
		'section'  				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_heading_header_button_bg',
		'priority' 				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Background
	 */
	$wp_customize->add_setting( 'skywp_header_button_bg', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_header_button_bg', array(
		'label'					=> esc_html__('Background', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_bg',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Background :Hover
	 */
	$wp_customize->add_setting( 'skywp_header_button_bg_hover', array(
		'default'				=> '#0ba6e6',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_header_button_bg_hover', array(
		'label'					=> esc_html__('Background :Hover', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_bg_hover',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_header_button_border', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_header_button_border', array(
		'label'    				=> esc_html__( 'Border', 'skywp' ),
		'section'  				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_heading_header_button_border',
		'priority' 				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Border Buttons
	 */
	$wp_customize->add_setting( 'skywp_header_border_button', array(
		'default'				=> '0',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_border_button', array(
		'label'					=> esc_html__('Border (px)', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_border_button',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Border Color
	 */
	$wp_customize->add_setting( 'skywp_header_border_button_color', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_border_button_color', array(
		'label'					=> esc_html__('Border Color', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_border_button_color',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Border Color :Hover
	 */
	$wp_customize->add_setting( 'skywp_header_border_button_color_hover', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_header_border_button_color_hover', array(
		'label'					=> esc_html__('Border Color :Hover', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_border_button_color_hover',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Border Radius 
	 */
	$wp_customize->add_setting( 'skywp_header_border_button_radius', array(
		'default'				=> '3',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_border_button_radius', array(
		'label'					=> esc_html__('Border Radius (px)', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_border_button_radius',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Letter spacing
	 */
	$wp_customize->add_setting( 'skywp_header_button_letter_spacing', array(
		'default'				=> '0.5',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_button_letter_spacing', array(
		'label'					=> esc_html__('Letter Spacing (px)', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_button_letter_spacing',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' && get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'header-button';
    	},
	) ) );

	/**
	 * Text / HTML
	 */
	$wp_customize->add_setting( 'skywp_header_text_html', array(
		'default'				=> '<button>Hello</button>',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_header_text_html', array(
		'label'					=> esc_html__('Text / HTML', 'skywp'),
		'section'				=> 'skywp_right_header_item',
		'settings'				=> 'skywp_header_text_html',
		'priority'				=> 10,
		'type'           => 'textarea',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'text-html';
    	},
	) ) );










}
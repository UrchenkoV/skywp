<?php
/**
* TopBar Customizer Options
*
* @package Urchenko
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.2.3
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'skywp_customizer_options' );
function skywp_customizer_options( $wp_customize ) {

	/**
	 * Panel
	 */
	$wp_customize->add_panel( 'skywp_topbar_panel', array(
		'title' 			=> esc_html__( 'TopBar', 'skywp' ),
		'priority' 			=> 24,
	) );





	/**
	 * Section
	 */
	$wp_customize->add_section( 'skywp_topbar_main', array(
		'title'				=> esc_html__( 'Main', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_topbar_panel',
	) );

	/**
	 * TopBar
	 */
	$wp_customize->add_setting( 'skywp_topbar', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar', array(
		'label'					=> esc_html__('Show TopBar', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar',
		'priority'				=> 10,
	) ) );

	$wp_customize->selective_refresh->add_partial( 'skywp_topbar', array(
        'selector' => '#topbar.wrapper',
        'render_callback' => function() {
            return get_theme_mod( 'skywp_topbar' );
        }
    ) );

	/**
	 * Topbar Border Bottom
	 */
	$wp_customize->add_setting( 'skywp_topbar_border_bottom', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_border_bottom', array(
		'label'					=> esc_html__('Border Bottom', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_border_bottom',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* TopBar Border Bottom Color relative
	*/
	$wp_customize->add_setting( 'skywp_topbar_border_color_relative', array(
		'default'			=> '#e4e4e4',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_border_color_relative', array(
		'label'				=> esc_html__( 'Border Color', 'skywp' ),
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_border_color_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar_border_bottom', false ) == true && get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* Position
	*/
	$wp_customize->add_setting( 'skywp_topbar_position', array(
		'default'			=> 'relative',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_position', array(
		'label'				=> esc_html__( 'Position', 'skywp' ),
		'type'				=> 'select',
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_position',
		'priority'			=> 10,
		'choices'			=> array(
			'relative'		=> esc_html__( 'Relative', 'skywp' ),
			'absolute'		=> esc_html__( 'Absolute', 'skywp' ),
		),
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Show on all pages except the template: full-width page
	 */
	$wp_customize->add_setting( 'skywp_topbar_show_all_page_except_full_width_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_show_all_page_except_full_width_page', array(
		'label'					=> esc_html__('Show on all pages except the template: full-width page.', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_show_all_page_except_full_width_page',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'relative' &&  get_theme_mod( 'skywp_topbar', false ) == true;
   		},
	) ) );

	/**
	 * Disable position absolute on all pages except the template: full-width page
	 */
	$wp_customize->add_setting( 'skywp_topbar_disable_position_absolute_all_except_full_width_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_disable_position_absolute_all_except_full_width_page', array(
		'label'					=> esc_html__('Disable position absolute on all pages except the template: full-width page.', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_disable_position_absolute_all_except_full_width_page',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'absolute' &&  get_theme_mod( 'skywp_topbar', false ) == true;
   		},
	) ) );

	/**
	* TopBar Visibility
	*/
	$wp_customize->add_setting( 'skywp_topbar_visibility', array(
		'default'		=> 'all-devices',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_visibility', array(
		'label'			=> esc_html__('Visibility', 'skywp'),
		'type'			=> 'select',
		'section'		=> 'skywp_topbar_main',
		'settings'		=> 'skywp_topbar_visibility',
		'priority'		=> 10,
		'choices'		=> array(
			'all-devices'			=> esc_html__('Show On All Devices', 'skywp'),
			'hide-tablet'			=> esc_html__('Hide On Tablet', 'skywp'),
			'hide-mobile'			=> esc_html__('Hide On Mobile', 'skywp'),
			'hide-tablet-mobile'	=> esc_html__('Hide On Tablet and Mobile', 'skywp'),
		),
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Width
	 */
	$wp_customize->add_setting( 'topbar_width', array(
		'default'				=> '1200',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'topbar_width', array(
		'label'					=> esc_html__('Width (px)', 'skywp'),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'topbar_width',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Padding
	 */
	$wp_customize->add_setting( 'skywp_topbar_padding', array(
		'default'				=> '0px 0px 0px 0px',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_padding', array(
		'label'					=> esc_html__('Padding (px)', 'skywp'),
		'description'			=> esc_html__( 'top right bottom left: 10px 0px 10px 0px', 'skywp' ),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_padding',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* TopBar Alignment
	*/
	$wp_customize->add_setting( 'skywp_topbar_alignment', array(
		'default'			=> 'space-between',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_alignment', array(
		'label'				=> esc_html__( 'Alignment', 'skywp' ),
		'type'				=> 'select',
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_alignment',
		'priority'			=> 10,
		'choices'			=> array(
			'space-between'		=> esc_html__( 'Spece Between', 'skywp' ),
			'space-around'		=> esc_html__( 'Space Around', 'skywp' ),
			'center'		=> esc_html__( 'Center', 'skywp' ),
			'flex-start'		=> esc_html__( 'Flex Start', 'skywp' ),
			'flex-end'		=> esc_html__( 'Flex End', 'skywp' ),
		),
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Backgtoung relative
	 */
	$wp_customize->add_setting( 'skywp_bg_topbar_relative', array(
		'default'     => '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_bg_topbar_relative', array(
		'label'     => __( 'Background', 'skywp' ),
		'description'     => __( 'This setting changes the background on pages where (Position: relative)', 'skywp' ),
		'section'   => 'skywp_topbar_main',
		'settings'  => 'skywp_bg_topbar_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true ) && ( get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'relative' || get_theme_mod( 'skywp_topbar_disable_position_absolute_all_except_full_width_page', false ) == true );
    	},
	) ) );

	/**
	 * Backgtoung absolute
	 */
	$wp_customize->add_setting( 'skywp_bg_topbar_absolute', array(
		'default'     => 'rgba(255,255,255,0)',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_bg_topbar_absolute', array(
		'label'     => __( 'Background', 'skywp' ),
		'description'     => __( 'This setting changes the background on pages where (Position: absolute)', 'skywp' ),
		'section'   => 'skywp_topbar_main',
		'settings'  => 'skywp_bg_topbar_absolute',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true ) && get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'absolute';
    	},
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_topbar_content_heading', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_topbar_content_heading', array(
		'label'    				=> esc_html__( 'Content', 'skywp' ),
		'section'  				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_content_heading',
		'priority' 				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	* TopBar Text Color relative
	*/
	$wp_customize->add_setting( 'skywp_topbar_text_color_relative', array(
		'default'			=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_text_color_relative', array(
		'label'				=> esc_html__( 'Text Color', 'skywp' ),
		'description'     => __( 'This setting works on pages where (Position: relative)', 'skywp' ),
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_text_color_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true ) && ( get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'relative' || get_theme_mod( 'skywp_topbar_disable_position_absolute_all_except_full_width_page', false ) == true );
    	},
	) ) );

	/**
	* TopBar Text Color absolute
	*/
	$wp_customize->add_setting( 'skywp_topbar_text_color_absolute', array(
		'default'			=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_text_color_absolute', array(
		'label'				=> esc_html__( 'Text Color', 'skywp' ),
		'description'     => __( 'This setting works on pages where (Position: absolute)', 'skywp' ),
		'section'			=> 'skywp_topbar_main',
		'settings'			=> 'skywp_topbar_text_color_absolute',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true ) && get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'absolute';
    	},
	) ) );

	/**
	 * Font size
	 */
	$wp_customize->add_setting( 'skywp_topbar_text_font_size', array(
		'default'				=> '15',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_text_font_size', array(
		'label'					=> esc_html__('Font Size (px)', 'skywp'),
		'type'           => 'number',
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_text_font_size',
		'priority'				=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Font Weight
	 */
	$wp_customize->add_setting( 'skywp_topbar_text_font_weight', array(
		'default'				=> '400',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_text_font_weight', array(
		'label'					=> esc_html__('Font Weight', 'skywp'),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_text_font_weight',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            '100'   => __( '100', 'skywp' ),
            '200'   => __( '200', 'skywp' ),
            '300'   => __( '300', 'skywp' ),
            '400'   => __( '400', 'skywp' ),
            '500'  => __( '500', 'skywp' ),
            '600'  => __( '600', 'skywp' ),
            '700'  => __( '700', 'skywp' ),
            '800'  => __( '800', 'skywp' ),
            '900'  => __( '900', 'skywp' ),
        ),
        'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Text Transform
	 */
	$wp_customize->add_setting( 'skywp_topbar_text_transform', array(
		'default'				=> 'none',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_text_transform', array(
		'label'					=> esc_html__('Text Transform', 'skywp'),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_text_transform',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'uppercase'   => __( 'Uppercase', 'skywp' ),
            'lowercase'  => __( 'Lowercase', 'skywp' ),
            'capitalize'  => __( 'Capitalize', 'skywp' ),
            'none'  => __( 'None', 'skywp' ),
        ),
        'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );

	/**
	 * Letter Spacing
	 */
	$wp_customize->add_setting( 'skywp_topbar_text_letter_spacing', array(
		'default'				=> '1',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_text_letter_spacing', array(
		'label'					=> esc_html__('Letter Spacing (px)', 'skywp'),
		'section'				=> 'skywp_topbar_main',
		'settings'				=> 'skywp_topbar_text_letter_spacing',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) ) );





	/**
	 * Social buttons
	 */
	$wp_customize->add_section( 'skywp_topbar_social_buttons', array(
		'title'				=> esc_html__( 'Social media buttons', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_topbar_panel',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar', true );
    	},
	) );

	/**
	* Social media buttons style
	*/
	$wp_customize->add_setting( 'skywp_topbar_social_style', array(
		'default'		=> 'style-first',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_topbar_social_style', array(
		'label'			=> esc_html__('Social media buttons style', 'skywp'),
		'type'			=> 'select',
		'section'		=> 'skywp_topbar_social_buttons',
		'settings'		=> 'skywp_topbar_social_style',
		'priority'		=> 10,
		'choices'		=> array(
			'style-first'			=> esc_html__('Style first', 'skywp'),
		),
	) ) );

	/**
	 * Social buttons color relative
	 */
	$wp_customize->add_setting( 'skywp_topbar_social_buttons_color_relative', array(
		'default'     => '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_social_buttons_color_relative', array(
		'label'     => __( 'Color', 'skywp' ),
		'description'     => __( 'This setting works on pages where (Position: relative)', 'skywp' ),
		'section'   => 'skywp_topbar_social_buttons',
		'settings'  => 'skywp_topbar_social_buttons_color_relative',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'relative' || get_theme_mod( 'skywp_topbar_disable_position_absolute_all_except_full_width_page', false ) == true;
    	},
	) ) );

	/**
	 * Social buttons color absolute
	 */
	$wp_customize->add_setting( 'skywp_topbar_social_buttons_color_absolute', array(
		'default'     => '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_topbar_social_buttons_color_absolute', array(
		'label'     => __( 'Color', 'skywp' ),
		'description'     => __( 'This setting works on pages where (Position: absolute)', 'skywp' ),
		'section'   => 'skywp_topbar_social_buttons',
		'settings'  => 'skywp_topbar_social_buttons_color_absolute',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'absolute';
    	},
	) ) );

	




}




<?php
/**
* Main Customizer Options
*
* @package Urchenko
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.0.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', 'skywp_customizer_general_settings' );
function skywp_customizer_general_settings( $wp_customize ) {

	/**
	 * Panel Main Settings
	 */
	$wp_customize->add_panel( 'skywp_general_settings_panel', array(
		'title' 			=> esc_html__( 'Main', 'skywp' ),
		'priority' 			=> 22,
	) );

	/**
	 * Site Identity
	 */
	$wp_customize->add_section( 'title_tagline', array(
		'title'				=> esc_html__( 'Site Identity', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * Add a different logo in the template: Full-Width Page
	 */
	$wp_customize->add_setting( 'skywp_logo_full_width_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_logo_full_width_page', array(
		'label'					=> esc_html__('Add a different logo in the template: Full-Width Page', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'title_tagline',
		'settings'				=> 'skywp_logo_full_width_page',
		'priority'				=> 9,
	) ) );

	/**
	 * Logo - absolute
	 */
	$wp_customize->add_setting( 'skywp_logo_absolute', array(
			'default' => '',
			'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'skywp_logo_absolute', array(
			'label' => esc_html__( 'Logo', 'skywp' ),
			'section' => 'title_tagline',
			'priority' => 9.5,
			'flex_width' => false,
			'flex_height' => false,
			'width' => 155,
			'height' => 60,
			'active_callback'   => function(){
	       		return get_theme_mod( 'skywp_logo_full_width_page' ) == true;
	   		},
	) ) );





	/**
	 * Header Image
	 */
	$wp_customize->add_section( 'header_image', array(
		'title'				=> esc_html__( 'Header Image', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	$wp_customize->selective_refresh->add_partial( 'header_image', array(
        'selector' => '.custom-header-media',
        'render_callback' => function() {
            return get_theme_mod( 'header_image' );
        }
    ) );





	/**
	 * Section Main Styling
	 */
	$wp_customize->add_section( 'skywp_general_settings_styling', array(
		'title'				=> esc_html__( 'Main Styling', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * Width
	 */
	$wp_customize->add_setting( 'general_width', array(
		'default'				=> '1200',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'general_width', array(
		'label'					=> esc_html__('Width (px)', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'general_width',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Font size Body
	 */
	$wp_customize->add_setting( 'font_size_body', array(
		'default'				=> '16',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'font_size_body', array(
		'label'					=> esc_html__('Font Size (px)', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'font_size_body',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Base color scheme
	 */
	$wp_customize->add_setting( 'skywp_color_scheme', array(
		'default'				=> 'scheme-light',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_color_scheme', array(
		'label'					=> esc_html__('Base Color Scheme', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_color_scheme',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'scheme-light'   => __( 'Light', 'skywp' ),
            'scheme-dark'  => __( 'Dark', 'skywp' ),
        )
	) ) );

	/**
	 * Outer background
	 */
	$wp_customize->add_setting( 'skywp_outer_bg', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_outer_bg', array(
		'label'					=> esc_html__('Outer Background', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_outer_bg',
		'priority'				=> 10,
	) ) );

	/**
	 * Inner background
	 */
	$wp_customize->add_setting( 'skywp_inner_bg', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_inner_bg', array(
		'label'					=> esc_html__('Inner Background', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_inner_bg',
		'priority'				=> 10,
	) ) );

	/**
	 * Default Color
	 */
	$wp_customize->add_setting( 'skywp_default_color', array(
		'default'				=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_default_color', array(
		'label'					=> esc_html__('Default Color', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_default_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Accent Color
	 */
	$wp_customize->add_setting( 'skywp_accent_color', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_accent_color', array(
		'label'					=> esc_html__( 'Accent Color', 'skywp' ),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_accent_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Links color
	 */
	$wp_customize->add_setting( 'skywp_links_color', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_links_color', array(
		'label'					=> esc_html__('Links Color', 'skywp'),
		'description'					=> esc_html__('This controller is responsible for the color of links in the body of the site, except for links in articles.', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_links_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Links Color: Hover
	 */
	$wp_customize->add_setting( 'skywp_links_color_hover', array(
		'default'				=> '#0ba6e6',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_links_color_hover', array(
		'label'					=> esc_html__('Links Color: Hover', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_links_color_hover',
		'priority'				=> 10,
	) ) );

	/**
	 * The color of the header on all pages
	 */
	$wp_customize->add_setting( 'skywp_color_header_all_pages', array(
		'default'				=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_color_header_all_pages', array(
		'label'					=> esc_html__('The color of the header on all pages', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_color_header_all_pages',
		'priority'				=> 10,
	) ) );



	/**
	 * Heading Input / Textarea
	 */
	$wp_customize->add_setting( 'skywp_input_heading', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_input_heading', array(
		'label'    				=> esc_html__( 'Input / Textarea', 'skywp' ),
		'section'  				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_input_heading',
		'priority' 				=> 10,
	) ) );

	/**
	 * Label color
	 */
	$wp_customize->add_setting( 'skywp_form_label_color', array(
		'default'				=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_form_label_color', array(
		'label'					=> esc_html__('Label Color', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_form_label_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Input, textarea color
	 */
	$wp_customize->add_setting( 'skywp_form_color', array(
		'default'				=> '#555555',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_form_color', array(
		'label'					=> esc_html__('Text Color', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_form_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Form Border color
	 */
	$wp_customize->add_setting( 'skywp_form_border_color', array(
		'default'				=> '#e4e4e4',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_form_border_color', array(
		'label'					=> esc_html__('Border Color', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_form_border_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Border Color: Focus
	 */
	$wp_customize->add_setting( 'skywp_forms_border_color_focus', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_forms_border_color_focus', array(
		'label'					=> esc_html__('Border Color: Focus', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_forms_border_color_focus',
		'priority'				=> 10,
	) ) );

	/**
	 * Placeholder Color
	 */
	$wp_customize->add_setting( 'skywp_forms_placeholder_color', array(
		'default'				=> '#555555',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_forms_placeholder_color', array(
		'label'					=> esc_html__('Placeholder Color', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_forms_placeholder_color',
		'priority'				=> 10,
	) ) );



	/**
	 * Widgets
	 */
	$wp_customize->add_setting( 'skywp_widgets_heading', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_widgets_heading', array(
		'label'    				=> esc_html__( 'Widgets', 'skywp' ),
		'description'    				=> esc_html__( 'Widget settings in the right and left sidebars of the site.', 'skywp' ),
		'section'  				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_widgets_heading',
		'priority' 				=> 10,
	) ) );

	/**
	 * Title color
	 */
	$wp_customize->add_setting( 'skywp_widget_title_color', array(
		'default'				=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_widget_title_color', array(
		'label'					=> esc_html__('Title Color', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_widget_title_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Header
	 */
	$wp_customize->add_setting( 'skywp_colors_heading', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_colors_heading', array(
		'label'    				=> esc_html__( 'Colors', 'skywp' ),
		'description'    				=> esc_html__( 'These settings change the color in some places on the site, but they are primarily designed to change the color on WooCommerce pages.', 'skywp' ),
		'section'  				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_colors_heading',
		'priority' 				=> 10,
	) ) );

	/**
	 * Background
	 */
	$wp_customize->add_setting( 'skywp_colors_bg', array(
		'default'				=> '#fafafa',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_colors_bg', array(
		'label'					=> esc_html__('Background', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_colors_bg',
		'priority'				=> 10,
	) ) );

	/**
	 * Border
	 */
	$wp_customize->add_setting( 'skywp_colors_border', array(
		'default'				=> '#e4e4e4',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_colors_border', array(
		'label'					=> esc_html__('Border', 'skywp'),
		'section'				=> 'skywp_general_settings_styling',
		'settings'				=> 'skywp_colors_border',
		'priority'				=> 10,
	) ) );





	/**
	 * Section Setting Button Scroll Top
	 */
	$wp_customize->add_section( 'skywp_setting_scroll_top', array(
		'title'				=> esc_html__( 'Scroll To Top', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * Scroll Up Button
	 */
	$wp_customize->add_setting( 'skywp_scroll_up_button', array(
		'default'				=> true,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_scroll_up_button', array(
		'label'					=> esc_html__('Scroll Up Button', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_setting_scroll_top',
		'settings'				=> 'skywp_scroll_up_button',
		'priority'				=> 10,
	) ) );

	/**
	 * Backgtoung
	 */
	$wp_customize->add_setting( 'skywp_scroll_top_bg', array(
		'default'     => '#212121',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_scroll_top_bg', array(
		'label'     => __( 'Background', 'skywp' ),
		'section'   => 'skywp_setting_scroll_top',
		'settings'  => 'skywp_scroll_top_bg',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_scroll_up_button', true );
    	},
	) ) );

	/**
	* Color
	*/
	$wp_customize->add_setting( 'skywp_scroll_up_button_color', array(
		'default'			=> '#fff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_scroll_up_button_color', array(
		'label'				=> esc_html__( 'Color', 'skywp' ),
		'section'			=> 'skywp_setting_scroll_top',
		'settings'			=> 'skywp_scroll_up_button_color',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_scroll_up_button', true );
    	},
	) ) );

	/**
	* Color :hover
	*/
	$wp_customize->add_setting( 'skywp_scroll_up_button_color_hover', array(
		'default'			=> '#fff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_scroll_up_button_color_hover', array(
		'label'				=> esc_html__( 'Color :hover', 'skywp' ),
		'section'			=> 'skywp_setting_scroll_top',
		'settings'			=> 'skywp_scroll_up_button_color_hover',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_scroll_up_button', true );
    	},
	) ) );

	/**
	 * Border Radius
	 */
	$wp_customize->add_setting( 'skywp_scroll_top_border_radius', array(
		'default'				=> '3',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_scroll_top_border_radius', array(
		'label'					=> esc_html__('Border Radius', 'skywp'),
		'section'				=> 'skywp_setting_scroll_top',
		'settings'				=> 'skywp_scroll_top_border_radius',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_scroll_up_button', true );
    	},
	) ) );





	/**
	 * Section Widget Tags Cloud
	 */
	$wp_customize->add_section( 'skywp_widget_tags_cloud', array(
		'title'				=> esc_html__( 'Widget Tags Cloud', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * Letter Spacing
	 */
	$wp_customize->add_setting( 'skywp_tag_letter_spacing', array(
		'default'				=> '1',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_tag_letter_spacing', array(
		'label'					=> esc_html__('Letter Spacing (px):', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_letter_spacing',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Text Transform
	 */
	$wp_customize->add_setting( 'skywp_tag_text_transform', array(
		'default'				=> 'capitalize',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_tag_text_transform', array(
		'label'					=> esc_html__('Text Transform:', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_text_transform',
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
	 * Font Size
	 */
	$wp_customize->add_setting( 'skywp_tag_font_size', array(
		'default'				=> '13',
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_tag_font_size', array(
		'label'					=> esc_html__('Font Size (px):', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_font_size',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Font Weight
	 */
	$wp_customize->add_setting( 'skywp_tag_font_weight', array(
		'default'				=> '400',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_tag_font_weight', array(
		'label'					=> esc_html__('Font Weight:', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_font_weight',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            '400'   => __( '400', 'skywp' ),
            '500'  => __( '500', 'skywp' ),
            '600'  => __( '600', 'skywp' ),
            '700'  => __( '700', 'skywp' ),
            '800'  => __( '800', 'skywp' ),
            '900'  => __( '900', 'skywp' ),
        )
	) ) );

	/**
	 * Link Color
	 */
	$wp_customize->add_setting( 'skywp_tag_link_color', array(
		'default'				=> '#919191',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_tag_link_color', array(
		'label'					=> esc_html__('Link Color', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_link_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Link Color :Hover
	 */
	$wp_customize->add_setting( 'skywp_tag_link_color_hover', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_tag_link_color_hover', array(
		'label'					=> esc_html__('Link Color: Hover', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_link_color_hover',
		'priority'				=> 10,
	) ) );

	/**
	 * Backgtoung
	 */
	$wp_customize->add_setting( 'skywp_tag_bg_color', array(
		'default'     => 'rgba(255,255,255, 0)',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_tag_bg_color', array(
		'label'     => __( 'Background', 'skywp' ),
		'section'   => 'skywp_widget_tags_cloud',
		'settings'  => 'skywp_tag_bg_color',
		'priority'			=> 10,
	) ) );

	/**
	 * Border Color
	 */
	$wp_customize->add_setting( 'skywp_tag_border_color', array(
		'default'				=> '#c7c7c7',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_tag_border_color', array(
		'label'					=> esc_html__('Border Color', 'skywp'),
		'section'				=> 'skywp_widget_tags_cloud',
		'settings'				=> 'skywp_tag_border_color',
		'priority'				=> 10,
	) ) );





	/**
	 * Section Buttons
	 */
	$wp_customize->add_section( 'skywp_theme_buttons', array(
		'title'				=> esc_html__( 'Buttons', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * Font Size
	 */
	$wp_customize->add_setting( 'skywp_buttons_font_size', array(
		'default'				=> '14',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_buttons_font_size', array(
		'label'					=> esc_html__('Font Size (px)', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_font_size',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Font Weight
	 */
	$wp_customize->add_setting( 'skywp_buttons_font_weight', array(
		'default'				=> '400',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_buttons_font_weight', array(
		'label'					=> esc_html__('Font Weight', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_font_weight',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
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
	$wp_customize->add_setting( 'skywp_buttons_text_transform', array(
		'default'				=> 'capitalize',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_buttons_text_transform', array(
		'label'					=> esc_html__('Text Transform:', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_text_transform',
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
	 * Padding
	 */
	$wp_customize->add_setting( 'skywp_theme_buttons_padding', array(
		'default'				=> '10px 25px 10px 25px',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_theme_buttons_padding', array(
		'label'					=> esc_html__('Padding (px)', 'skywp'),
		'description'			=> esc_html__( 'top right bottom left: 15px 25px 15px 25px', 'skywp' ),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_theme_buttons_padding',
		'priority'				=> 10,
		'type'           => 'text',
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_button_color', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_button_color', array(
		'label'    				=> esc_html__( 'Color', 'skywp' ),
		'section'  				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_heading_button_color',
		'priority' 				=> 10,
	) ) );

	/**
	 * Link Color
	 */
	$wp_customize->add_setting( 'skywp_buttons_link_color', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_buttons_link_color', array(
		'label'					=> esc_html__('Color', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_link_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Link Color :Hover
	 */
	$wp_customize->add_setting( 'skywp_buttons_link_color_hover', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_buttons_link_color_hover', array(
		'label'					=> esc_html__('Color :Hover', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_link_color_hover',
		'priority'				=> 10,
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_button_bg', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_button_bg', array(
		'label'    				=> esc_html__( 'Background', 'skywp' ),
		'section'  				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_heading_button_bg',
		'priority' 				=> 10,
	) ) );

	/**
	 * Background
	 */
	$wp_customize->add_setting( 'skywp_buttons_bg_color', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_buttons_bg_color', array(
		'label'					=> esc_html__('Background', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_bg_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Background :Hover
	 */
	$wp_customize->add_setting( 'skywp_buttons_bg_color_hover', array(
		'default'				=> '#0ba6e6',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_buttons_bg_color_hover', array(
		'label'					=> esc_html__('Background :Hover', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_bg_color_hover',
		'priority'				=> 10,
	) ) );

	/**
	 * Heading
	 */
	$wp_customize->add_setting( 'skywp_heading_button_border', array(
		'sanitize_callback' 	=> 'wp_kses',
	) );

	$wp_customize->add_control( new SkyWP_Customizer_Heading_Control( $wp_customize, 'skywp_heading_button_border', array(
		'label'    				=> esc_html__( 'Border', 'skywp' ),
		'section'  				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_heading_button_border',
		'priority' 				=> 10,
	) ) );

	/**
	 * Border Buttons
	 */
	$wp_customize->add_setting( 'skywp_border_buttons', array(
		'default'				=> '0',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_border_buttons', array(
		'label'					=> esc_html__('Border (px)', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_border_buttons',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Border Color
	 */
	$wp_customize->add_setting( 'skywp_border_buttons_color', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_border_buttons_color', array(
		'label'					=> esc_html__('Border Color', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_border_buttons_color',
		'priority'				=> 10,
	) ) );

	/**
	 * Border Color :Hover
	 */
	$wp_customize->add_setting( 'skywp_border_buttons_color_hover', array(
		'default'				=> '#00b4ff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_border_buttons_color_hover', array(
		'label'					=> esc_html__('Border Color :Hover', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_border_buttons_color_hover',
		'priority'				=> 10,
	) ) );

	/**
	 * Border Radius 
	 */
	$wp_customize->add_setting( 'skywp_border_buttons_radius', array(
		'default'				=> '3',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_border_buttons_radius', array(
		'label'					=> esc_html__('Border Radius (px)', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_border_buttons_radius',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );

	/**
	 * Letter spacing
	 */
	$wp_customize->add_setting( 'skywp_buttons_letter_spacing', array(
		'default'				=> '0.5',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport' 			=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_buttons_letter_spacing', array(
		'label'					=> esc_html__('Letter Spacing (px)', 'skywp'),
		'section'				=> 'skywp_theme_buttons',
		'settings'				=> 'skywp_buttons_letter_spacing',
		'priority'				=> 10,
		'type'           => 'number',
	) ) );





	/**
	 * Section Breadcrumb
	 */
	$wp_customize->add_section( 'skywp_breadcrumb', array(
		'title'				=> esc_html__( 'Breadcrumb', 'skywp' ),
		'priority'			=> 10,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * Position
	 */
	$wp_customize->add_setting( 'skywp_position_breadcrumb', array(
		'default'				=> 'none',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_position_breadcrumb', array(
		'label'					=> esc_html__('Position', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_position_breadcrumb',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'none'   => __( 'None', 'skywp' ),
            'after_header'  => __( 'After Header', 'skywp' ),
            'before_title'  => __( 'Before Title', 'skywp' ),
        )
	) ) );

	$wp_customize->selective_refresh->add_partial( 'skywp_position_breadcrumb', array(
        'selector' => '.skywp-breadcrumb .content',
        'render_callback' => function() {
            return get_theme_mod( 'skywp_position_breadcrumb' );
        }
    ) );

	/**
	 * Disable on Home Page?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_home_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_home_page', array(
		'label'					=> esc_html__('Disable on Home Page?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_home_page',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	 * Disable on Blog / Posts Page?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_blog_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_blog_page', array(
		'label'					=> esc_html__('Disable on Blog / Posts Page?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_blog_page',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	 * Disable on Search?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_search', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_search', array(
		'label'					=> esc_html__('Disable on Search?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_search',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	 * Disable on Archive?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_archive', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_archive', array(
		'label'					=> esc_html__('Disable on Archive?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_archive',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	 * Disable on Attachment?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_attachment', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_attachment', array(
		'label'					=> esc_html__('Disable on Attachment?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_attachment',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Disable on Page?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_page', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_page', array(
		'label'					=> esc_html__('Disable on Page?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_page',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Disable on Post?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_post', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_post', array(
		'label'					=> esc_html__('Disable on Post?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_post',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Disable on 404 Page?
	 */
	$wp_customize->add_setting( 'skywp_bc_disable_404', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_404', array(
		'label'					=> esc_html__('Disable on 404 Page?', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_bc_disable_404',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	if ( class_exists( 'WooCommerce' ) ) {
		/**
		 * Disable on WooCommerce Page?
		 */
		$wp_customize->add_setting( 'skywp_bc_disable_woocommerce', array(
			'default'				=> true,
			'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_bc_disable_woocommerce', array(
			'label'					=> esc_html__('Disable on WooCommerce Page?', 'skywp'),
			'type'					=> 'checkbox',
			'section'				=> 'skywp_breadcrumb',
			'settings'				=> 'skywp_bc_disable_woocommerce',
			'priority'				=> 10,
			'active_callback'   => function(){
	       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
	   		},
		) ) );
	}

	/**
	 * Link Home
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_link_home', array(
		'default'				=> esc_html__( 'Home', 'skywp' ),
		'sanitize_callback' 	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_link_home', array(
		'label'					=> esc_html__('Link Home', 'skywp'),
		'description'					=> esc_html__('You can insert the Font Awesome code here.', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_link_home',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Breadcrumb Border Bottom
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_border_bottom', array(
		'default'				=> false,
		'sanitize_callback' 	=> 'skywp_sanitize_checkbox',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_border_bottom', array(
		'label'					=> esc_html__('Border Bottom', 'skywp'),
		'type'					=> 'checkbox',
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_border_bottom',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	* Breadcrumb Border Bottom Color
	*/
	$wp_customize->add_setting( 'skywp_breadcrumb_border_color', array(
		'default'			=> '#e4e4e4',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport' 			=> 'postMessage',
	) );
	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_breadcrumb_border_color', array(
		'label'				=> esc_html__( 'Border Color', 'skywp' ),
		'section'			=> 'skywp_breadcrumb',
		'settings'			=> 'skywp_breadcrumb_border_color',
		'priority'			=> 10,
		'active_callback'   => function(){
        	return get_theme_mod( 'skywp_breadcrumb_border_bottom', false ) == true && get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
    	},
	) ) );

	/**
	 * Alignment
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_alignment', array(
		'default'				=> 'left',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_alignment', array(
		'label'					=> esc_html__('Alignment', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_alignment',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
        	'left'		=> esc_html__( 'Left', 'skywp' ),
            'center'		=> esc_html__( 'Center', 'skywp' ),
			'right'		=> esc_html__( 'Right', 'skywp' ),
        ),
        'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Background Color
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_bg', array(
		'default'				=> '#ffffff',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new SkyWP_Customize_Color_Control( $wp_customize, 'skywp_breadcrumb_bg', array(
		'label'					=> esc_html__('Background', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_bg',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	 * Padding
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_padding', array(
		'default'				=> '15px 0px 15px 0px',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_padding', array(
		'label'					=> esc_html__('Padding (px)', 'skywp'),
		'description'			=> esc_html__( 'top right bottom left: 30px 0px 30px 0px', 'skywp' ),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_padding',
		'priority'				=> 10,
		'type'           => 'text',
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) == 'after_header';
   		},
	) ) );

	/**
	 * Color
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_color', array(
		'default'				=> '#333333',
		'sanitize_callback' 	=> 'skywp_sanitize_color',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skywp_breadcrumb_color', array(
		'label'					=> esc_html__('Color', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_color',
		'priority'				=> 10,
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Font Weight
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_font_weight', array(
		'default'				=> '400',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_font_weight', array(
		'label'					=> esc_html__('Font Weight', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_font_weight',
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
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Text Transform
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_text_transform', array(
		'default'				=> 'capitalize',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_text_transform', array(
		'label'					=> esc_html__('Text Transform', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_text_transform',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => array(
            'uppercase'   => __( 'Uppercase', 'skywp' ),
            'lowercase'  => __( 'Lowercase', 'skywp' ),
            'capitalize'  => __( 'Capitalize', 'skywp' ),
            'none'  => __( 'None', 'skywp' ),
        ),
        'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );

	/**
	 * Letter spacing
	 */
	$wp_customize->add_setting( 'skywp_breadcrumb_letter_spacing', array(
		'default'				=> '0',
		'sanitize_callback' 	=> 'wp_kses_post',
		'transport'				=> 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_breadcrumb_letter_spacing', array(
		'label'					=> esc_html__('Letter Spacing (px)', 'skywp'),
		'section'				=> 'skywp_breadcrumb',
		'settings'				=> 'skywp_breadcrumb_letter_spacing',
		'priority'				=> 10,
		'type'           => 'number',
		'active_callback'   => function(){
       		return get_theme_mod( 'skywp_position_breadcrumb' ) !== 'none';
   		},
	) ) );





	/**
	 * Pages Setup
	 */
	$wp_customize->add_section( 'skywp_pages_setup', array(
		'title'				=> esc_html__( 'Pages Setup', 'skywp' ),
		'priority'			=> 20,
		'panel'				=> 'skywp_general_settings_panel',
	) );

	/**
	 * 404
	 */
	$wp_customize->add_setting( 'skywp_template_404', array(
		'default'				=> 'default',
		'sanitize_callback' 	=> 'skywp_sanitize_select',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skywp_template_404', array(
		'label'					=> esc_html__('404', 'skywp'),
		'section'				=> 'skywp_pages_setup',
		'settings'				=> 'skywp_template_404',
		'priority'				=> 10,
		'type'           => 'select',
        'choices'        => skywp_get_pages_for_pages_setup(),
	) ) );




	






}
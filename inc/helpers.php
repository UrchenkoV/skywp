<?php
/**
 * This file includes helper functions used throughout the theme.
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
=======================================
:: TABLE OF CONTENTS
=======================================
* TOPBAR
* HEADER
* BREADCRUMB
* TYPOGRAPHY
* FOOTER
* BLOG
* CONTENT
*/

/*
 * Debug fuction var dump
 */
if ( ! function_exists( 'skywp_get_vd' ) ) {
	function skywp_get_vd( $var, $die = true ) {
		echo '<pre>';
		var_dump( $var );
		echo '</pre>';
		if ( $die ) {
			die();
		}
	}
}

/**
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 *
 * @since 1.1.4
 */
if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Triggered after the opening <body> tag.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Add default SkyWP wrapper - before
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_output_content_wrapper_start' ) ) {

	function skywp_output_content_wrapper_start() {

		if ( !is_page_template( 'template-parts/full-width-page.php' ) ) { ?>
			<div id="content-wrap" class="wrapper">
		<?php }
	}
}

/**
 * Add default SkyWP wrapper - after
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_output_content_wrapper_end' ) ) {

	function skywp_output_content_wrapper_end() {

		if ( !is_page_template( 'template-parts/full-width-page.php' ) ) { ?>
			</div><!-- #content-wrap -->
		<?php }
	}
}





/*
=======================================
TOPBAR
=======================================
*/

/**
 * Topbar layout connection function
 *
 * @since 1.0.3
 */
add_action( 'skywp_topbar', 'skywp_topbar_template' );
function skywp_topbar_template() {

	if ( get_theme_mod( 'skywp_topbar', false ) == true ) {

		if ( get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'relative' ) {

			if ( get_theme_mod( 'skywp_topbar_show_all_page_except_full_width_page', false ) == true ) {

				if ( !is_page_template( 'template-parts/full-width-page.php' ) ) {
					// Setting = true
					get_template_part( 'template-parts/topbar/layout' );
				}
			} else {
				// Setting = false.
				get_template_part( 'template-parts/topbar/layout' );
			}
			
		} else {
			// Position absolute
			get_template_part( 'template-parts/topbar/layout' );
		}
	}

}

/**
 * Topbar classes
 *
 * @since 1.2.3
 */
function skywp_topbar_classes() {
	// Visibility
	$classes[] = get_theme_mod( 'skywp_topbar_visibility', 'all-devices' );

	// Topbar border bottom
	if ( get_theme_mod( 'skywp_topbar_border_bottom', false ) == true ) {
		$classes[] = 'border-bottom';
	}

	// Alignment
	$classes[] = get_theme_mod( 'skywp_topbar_alignment', 'space-between' );

	$classes = implode( ' ', $classes );

	echo esc_attr( $classes );
}

/**
 * Hook: skywp_topbar_layout
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_topbar_column_layout' ) ) {
	function skywp_topbar_column_layout() {
		// Col 1
		if ( is_active_sidebar( 'topbar-left' ) ) {
		?>
			<div class="column col-1">
				<?php dynamic_sidebar('topbar-left'); ?>
			</div>
		<?php
		}
		// Col 2
		if ( is_active_sidebar( 'topbar-centered' ) ) {
		?>
			<div class="column col-2">
				<?php dynamic_sidebar('topbar-centered'); ?>
			</div>
		<?php
		}
		// Col 3
		if ( is_active_sidebar( 'topbar-right' ) || has_nav_menu( 'social_topbar' ) ) {
		?>
			<div class="column col-3">
				<?php dynamic_sidebar('topbar-right');
				
				if ( has_nav_menu( 'social_topbar' ) ) { ?>
					<nav class="social-navigation" role="navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social_topbar',
								'menu_class'     => 'social-links-menu',
								'fallback_cb'     => 'social_topbar',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							)
						);
						?>
					</nav>
				<?php } ?>
			</div>
		<?php
		}
	}
}





/**
 * Custom styles
 *
 * @since 1.1.4
 */
add_action( 'wp_enqueue_scripts', 'skywp_custom_styles_customizer' );
function skywp_custom_styles_customizer() {
	// BASE
	$skywp_default_color = esc_attr( get_theme_mod( 'skywp_default_color', '#333333' ) );
	$skywp_typography_body = skywp_typography_body() .', sans-serif';
	$general_width = absint( get_theme_mod( 'general_width', '1200' ) ) .'px';
	$skywp_links_color_hover = esc_attr( get_theme_mod( 'skywp_links_color_hover', '#0ba6e6' ) );
	$skywp_outer_bg = esc_attr( get_theme_mod( 'skywp_outer_bg', '#ffffff' ) );
	$skywp_inner_bg = esc_attr( get_theme_mod( 'skywp_inner_bg', '#ffffff' ) );
	$skywp_links_color = esc_attr( get_theme_mod( 'skywp_links_color', '#00b4ff' ) );
	$skywp_color_header_all_pages = esc_attr( get_theme_mod( 'skywp_color_header_all_pages', '#333333' ) );
	$font_size_body = esc_attr( get_theme_mod( 'font_size_body', '16' ) ) .'px';

	$skywp_colors_bg = esc_attr( get_theme_mod( 'skywp_colors_bg', '#fafafa' ) );
	$skywp_colors_border = esc_attr( get_theme_mod( 'skywp_colors_border', '#e4e4e4' ) );

	// TOPBAR
	$topbar_width = absint( get_theme_mod( 'topbar_width', '1200' ) ) .'px';
	$skywp_topbar_padding = esc_attr( get_theme_mod( 'skywp_topbar_padding', '0px 0px 0px 0px' ) );
	$skywp_topbar_position = esc_attr( get_theme_mod( 'skywp_topbar_position', 'relative' ) );
	$skywp_bg_topbar_relative = esc_attr( get_theme_mod( 'skywp_bg_topbar_relative', '#ffffff' ) );
	$skywp_bg_topbar_absolute = esc_attr( get_theme_mod( 'skywp_bg_topbar_absolute', 'rgba(255,255,255,0)' ) );
	$skywp_topbar_text_color_relative = esc_attr( get_theme_mod( 'skywp_topbar_text_color_relative', '#333333' ) );
	$skywp_topbar_text_color_absolute = esc_attr( get_theme_mod( 'skywp_topbar_text_color_absolute', '#333333' ) );
	$skywp_topbar_social_buttons_color_relative = esc_attr( get_theme_mod( 'skywp_topbar_social_buttons_color_relative', '#333333' ) );
	$skywp_topbar_social_buttons_color_absolute = esc_attr( get_theme_mod( 'skywp_topbar_social_buttons_color_absolute', '#333333' ) );
	$skywp_topbar_border_color_relative = esc_attr( get_theme_mod( 'skywp_topbar_border_color_relative', '#e4e4e4' ) );
	$skywp_topbar_text_font_size = absint( get_theme_mod( 'skywp_topbar_text_font_size', '15' ) ) .'px';
	$skywp_topbar_text_font_weight = esc_attr( get_theme_mod( 'skywp_topbar_text_font_weight', '400' ) );
	$skywp_topbar_text_transform = esc_attr( get_theme_mod( 'skywp_topbar_text_transform', 'none' ) );
	$skywp_topbar_text_letter_spacing = absint( get_theme_mod( 'skywp_topbar_text_letter_spacing', '1' ) ) . 'px';

	// HEADER
	$header_width = absint( get_theme_mod( 'header_width', '1200' ) ) .'px';
	$skywp_bg_header_relative = esc_attr( get_theme_mod( 'skywp_bg_header_relative', '#ffffff' ) );
	$skywp_bg_header_absolute = esc_attr( get_theme_mod( 'skywp_bg_header_absolute', 'rgba(255,255,255,0)' ) );
	$skywp_header_offset_top = esc_attr( get_theme_mod( 'skywp_header_offset_top', '0' ) ) .'px';
	$skywp_header_offset_top_tablet = esc_attr( get_theme_mod( 'skywp_header_offset_top_tablet', '0' ) ) .'px';
	$skywp_header_offset_top_mobile = esc_attr( get_theme_mod( 'skywp_header_offset_top_mobile', '0' ) ) .'px';
	$skywp_bg_sticky_header = esc_attr( get_theme_mod( 'skywp_bg_sticky_header', '#ffffff' ) );
	$skywp_header_link_color_relative = esc_attr( get_theme_mod( 'skywp_header_link_color_relative', '#333333' ) );
	$skywp_header_link_color_absolute = esc_attr( get_theme_mod( 'skywp_header_link_color_absolute', '#333333' ) );
	$skywp_accent_color = esc_attr( get_theme_mod( 'skywp_accent_color', '#00b4ff' ) );
	$skywp_header_font_size = esc_attr( get_theme_mod( 'skywp_header_font_size', '14' ) ) .'px';
	$skywp_header_font_weight = esc_attr( get_theme_mod( 'skywp_header_font_weight', '400' ) );
	$skywp_header_letter_spacing = esc_attr( get_theme_mod( 'skywp_header_letter_spacing', '1' ) ) .'px';
	$skywp_header_text_transform = esc_attr( get_theme_mod( 'skywp_header_text_transform', 'capitalize' ) );
	$skywp_header_menu_button_color = esc_attr( get_theme_mod( 'skywp_header_menu_button_color', '#212121' ) );
	$skywp_header_m_menu_but_color_absolute = esc_attr( get_theme_mod( 'skywp_header_m_menu_but_color_absolute', '#212121' ) );
	$skywp_header_background_mobile = esc_attr( get_theme_mod( 'skywp_header_background_mobile', '#212121' ) );
	$skywp_header_border_mobile_color = esc_attr( get_theme_mod( 'skywp_header_border_mobile_color', '#484848' ) );
	$skywp_header_mobile_color = esc_attr( get_theme_mod( 'skywp_header_mobile_color', '#ffffff' ) );
	$skywp_header_background_hover = esc_attr( get_theme_mod( 'skywp_header_background_hover', '#484848' ) );
	$skywp_header_color_hover = esc_attr( get_theme_mod( 'skywp_header_color_hover', '#ffffff' ) );
	$skywp_header_border_color_relative = esc_attr( get_theme_mod( 'skywp_header_border_color_relative', '#e4e4e4' ) );

	// BREADCRUMB
	$skywp_breadcrumb_bg = esc_attr( get_theme_mod( 'skywp_breadcrumb_bg', '#ffffff' ) );
	$skywp_breadcrumb_padding = esc_attr( get_theme_mod( 'skywp_breadcrumb_padding', '15px 0px 15px 0px' ) );
	$skywp_breadcrumb_color = esc_attr( get_theme_mod( 'skywp_breadcrumb_color', '#333333' ) );
	$skywp_breadcrumb_font_weight = esc_attr( get_theme_mod( 'skywp_breadcrumb_font_weight', '400' ) );
	$skywp_breadcrumb_text_transform = esc_attr( get_theme_mod( 'skywp_breadcrumb_text_transform', 'capitalize' ) );
	$skywp_breadcrumb_letter_spacing = esc_attr( get_theme_mod( 'skywp_breadcrumb_letter_spacing', '0' ) ) .'px';
	$skywp_breadcrumb_border_color = esc_attr( get_theme_mod( 'skywp_breadcrumb_border_color', '#e4e4e4' ) );

	// SCROLL TOP
	$skywp_scroll_top_bg = esc_attr( get_theme_mod( 'skywp_scroll_top_bg', '#212121' ) );
	$skywp_scroll_up_button_color = esc_attr( get_theme_mod( 'skywp_scroll_up_button_color', '#fff' ) );
	$skywp_scroll_top_border_radius = esc_attr( get_theme_mod( 'skywp_scroll_top_border_radius', '3' ) ) .'px';
	$skywp_scroll_up_button_color_hover = esc_attr( get_theme_mod( 'skywp_scroll_up_button_color_hover', '#fff' ) );

	// WIDGETS
	$skywp_tag_link_color = esc_attr( get_theme_mod( 'skywp_tag_link_color', '#919191' ) );
	$skywp_tag_border_color = esc_attr( get_theme_mod( 'skywp_tag_border_color', '#c7c7c7' ) );
	$skywp_tag_bg_color = esc_attr( get_theme_mod( 'skywp_tag_bg_color', 'rgba(255,255,255, 0)' ) );
	$skywp_tag_letter_spacing = esc_attr( get_theme_mod( 'skywp_tag_letter_spacing', '1' ) ) .'px';
	$skywp_tag_text_transform = esc_attr( get_theme_mod( 'skywp_tag_text_transform', 'capitalize' ) );
	$skywp_tag_font_weight = esc_attr( get_theme_mod( 'skywp_tag_font_weight', '400' ) );
	$skywp_tag_link_color_hover = esc_attr( get_theme_mod( 'skywp_tag_link_color_hover', '#ffffff' ) );
	$skywp_widget_title_color = esc_attr( get_theme_mod( 'skywp_widget_title_color', '#333333' ) );

	// BUTTON
	$skywp_buttons_font_size = esc_attr( get_theme_mod( 'skywp_buttons_font_size', '14' ) ) .'px';
	$skywp_buttons_font_weight = esc_attr( get_theme_mod( 'skywp_buttons_font_weight', '400' ) );
	$skywp_buttons_letter_spacing = esc_attr( get_theme_mod( 'skywp_buttons_letter_spacing', '0.5' ) ) .'px';
	$skywp_buttons_link_color = esc_attr( get_theme_mod( 'skywp_buttons_link_color', '#ffffff' ) );
	$skywp_buttons_bg_color = esc_attr( get_theme_mod( 'skywp_buttons_bg_color', '#00b4ff' ) );
	$skywp_theme_buttons_padding = esc_attr( get_theme_mod( 'skywp_theme_buttons_padding', '10px 25px 10px 25px' ) );
	$skywp_border_buttons = esc_attr( get_theme_mod( 'skywp_border_buttons', '0' ) ) .'px';
	$skywp_border_buttons_color = esc_attr( get_theme_mod( 'skywp_border_buttons_color', '#00b4ff' ) );
	$skywp_border_buttons_radius = esc_attr( get_theme_mod( 'skywp_border_buttons_radius', '3' ) ) .'px';
	$skywp_buttons_text_transform = esc_attr( get_theme_mod( 'skywp_buttons_text_transform', 'capitalize' ) );
	$skywp_buttons_link_color_hover = esc_attr( get_theme_mod( 'skywp_buttons_link_color_hover', '#ffffff' ) );
	$skywp_buttons_bg_color_hover = esc_attr( get_theme_mod( 'skywp_buttons_bg_color_hover', '#0ba6e6' ) );
	$skywp_border_buttons_color_hover = esc_attr( get_theme_mod( 'skywp_border_buttons_color_hover', '#00b4ff' ) );

	// HEADER BUTTON
	$skywp_header_button_font_size = esc_attr( get_theme_mod( 'skywp_header_button_font_size', '14' ) ) .'px';
	$skywp_header_button_font_weight = esc_attr( get_theme_mod( 'skywp_header_button_font_weight', '400' ) );
	$skywp_header_button_letter_spacing = esc_attr( get_theme_mod( 'skywp_header_button_letter_spacing', '0.5' ) ) .'px';
	$skywp_header_button_color = esc_attr( get_theme_mod( 'skywp_header_button_color', '#ffffff' ) );
	$skywp_header_button_bg = esc_attr( get_theme_mod( 'skywp_header_button_bg', '#00b4ff' ) );
	$skywp_header_button_padding = esc_attr( get_theme_mod( 'skywp_header_button_padding', '10px 25px 10px 25px' ) );
	$skywp_header_border_button = esc_attr( get_theme_mod( 'skywp_header_border_button', '0' ) ) .'px';
	$skywp_header_border_button_color = esc_attr( get_theme_mod( 'skywp_header_border_button_color', '#00b4ff' ) );
	$skywp_header_border_button_radius = esc_attr( get_theme_mod( 'skywp_header_border_button_radius', '3' ) ) .'px';
	$skywp_header_button_text_transform = esc_attr( get_theme_mod( 'skywp_header_button_text_transform', 'capitalize' ) );
	$skywp_header_button_color_hover = esc_attr( get_theme_mod( 'skywp_header_button_color_hover', '#ffffff' ) );
	$skywp_header_button_bg_hover = esc_attr( get_theme_mod( 'skywp_header_button_bg_hover', '#0ba6e6' ) );
	$skywp_header_border_button_color_hover = esc_attr( get_theme_mod( 'skywp_header_border_button_color_hover', '#00b4ff' ) );

	// INPUT / TEXTAREA
	$skywp_forms_border_color_focus = esc_attr( get_theme_mod( 'skywp_forms_border_color_focus', '#00b4ff' ) );
	$skywp_form_color = esc_attr( get_theme_mod( 'skywp_form_color', '#555555' ) );
	$skywp_form_border_color = esc_attr( get_theme_mod( 'skywp_form_border_color', '#e4e4e4' ) );
	$skywp_form_label_color = esc_attr( get_theme_mod( 'skywp_form_label_color', '#333333' ) );
	$skywp_forms_placeholder_color = esc_attr( get_theme_mod( 'skywp_forms_placeholder_color', '#555555' ) );

	// PAGINATION
	$skywp_pagination_align = esc_attr( get_theme_mod( 'skywp_pagination_align', 'center' ) );
	$skywp_pagination_color = esc_attr( get_theme_mod( 'skywp_pagination_color', '#9a9393' ) );
	$skywp_pagination_border_color = esc_attr( get_theme_mod( 'skywp_pagination_border_color', '#9a9393' ) );
	$skywp_pagination_border_radius = esc_attr( get_theme_mod( 'skywp_pagination_border_radius', '3' ) ) .'px';

	// POST
	$skywp_post_page_bg = esc_attr( get_theme_mod( 'skywp_post_page_bg', '#fafafa' ) );
	$skywp_post_page_title_color = esc_attr( get_theme_mod( 'skywp_post_page_title_color', '#333333' ) );
	$skywp_post_page_meta_color = esc_attr( get_theme_mod( 'skywp_post_page_meta_color', '#333333' ) );
	$skywp_article_meta_color = esc_attr( get_theme_mod( 'skywp_article_meta_color', '#333333' ) );

	$skywp_article_prev_next_color = esc_attr( get_theme_mod( 'skywp_article_prev_next_color', '#333333' ) );
	$skywp_article_prev_next_bg = esc_attr( get_theme_mod( 'skywp_article_prev_next_bg', '#fafafa' ) );

	// FOOTER
	$footer_width = absint( get_theme_mod( 'footer_width', '1200' ) ) .'px';
	$skywp_footer_bg = esc_attr( get_theme_mod( 'skywp_footer_bg', '#212121' ) );
	$skywp_footer_padding = esc_attr( get_theme_mod( 'skywp_footer_padding', '85px 0px 85px 0px' ) );
	$skywp_footer_title_color = esc_attr( get_theme_mod( 'skywp_footer_title_color', '#ffffff' ) );
	$skywp_footer_border_color = esc_attr( get_theme_mod( 'skywp_footer_border_color', '#c7c7c7' ) );
	$skywp_footer_text_color = esc_attr( get_theme_mod( 'skywp_footer_text_color', '#c7c7c7' ) );
	$skywp_tag_cloud_color_hover = esc_attr( get_theme_mod( 'skywp_tag_cloud_color_hover', '#ffffff' ) );
	$skywp_footer_tag_cloud_border_color = esc_attr( get_theme_mod( 'skywp_footer_tag_cloud_border_color', '#c7c7c7' ) );

	// COPYRIGHT
	$footer_copyright_width = absint( get_theme_mod( 'footer_copyright_width', '1200' ) ) .'px';
	$skywp_copyright_bg = esc_attr( get_theme_mod( 'skywp_copyright_bg', '#191c1e' ) );
	$skywp_footer_padding_copyright = esc_attr( get_theme_mod( 'skywp_footer_padding_copyright', '15px 0px 15px 0px' ) );
	$skywp_copyright_alignment = esc_attr( get_theme_mod( 'skywp_copyright_alignment', 'center' ) );
	

	$custom_css = "

		/*** BASE ***/
		body { color: $skywp_default_color; font-family: $skywp_typography_body; font-size: $font_size_body; }
		select { color: $skywp_default_color; }
		select { background: $skywp_colors_bg; }
		select { border-color: $skywp_colors_border; }
		.site_widget,
		.site_widget select { color: $skywp_default_color; }
		.wrapper { max-width: $general_width; }
		a { color: $skywp_accent_color; }
		#wrap.outer-wrapper { background: $skywp_outer_bg }
		#content #content-wrap { background: $skywp_inner_bg }

		.site_widget ul li a,
		.widget_calendar .calendar_wrap a,
		#comments .comment-list .comment .comment-body .comment-meta .comment-author .fn,
		#comments .comment-list .comment .comment-body .comment-meta .comment-author .fn a,
		#comments .comment-list .comment .comment-body .comment-meta .comment-metadata a,
		#comments .comment-list .comment .comment-body .reply a,
		#respond .logged-in-as a,
		.page-attachment .image-navigation .nav-links a,
		.page-attachment .entry-footer a { color: $skywp_links_color; }

		a:hover,
		.navigation.post-navigation .nav-links a:hover,
		#comments .comment-list .comment .comment-body .comment-meta .comment-author .fn a:hover,
		#comments .comment-list .comment .comment-body .comment-meta .comment-metadata a:hover,
		#comments .comment-list .comment .comment-body .reply a:hover,
		#respond .logged-in-as a:hover,
		.page-attachment .image-navigation .nav-links a:hover,
		.page-attachment .entry-footer a:hover,
		#footer-area .author-theme a:hover,
		.page-attachment .image-navigation .nav-links a:hover,
		.page-attachment .entry-footer a:hover,
		#footer-area .footer-wrap .site_widget a:hover { color: $skywp_links_color_hover; }

		#content-wrap .post-content-wrap .entry-title,
		#comments .comments-title,
		#respond .comment-reply-title,
		.no-results .page-header .page-title,
		.no-results .content-wrap .column-first .oops,
		.no-results .content-wrap .column-second h3,
		.error-404 .content-page .site_widget .error,
		.page-attachment .entry-header .entry-title { color: $skywp_color_header_all_pages; }
		


		/*** TOPBAR ***/
		#topbar-wrap .wrapper { max-width: $topbar_width; }
		#topbar { padding: $skywp_topbar_padding; }
		.topbar-position-relative #topbar-wrap { background: $skywp_bg_topbar_relative; }
		.topbar-position-absolute #topbar-wrap { background: $skywp_bg_topbar_absolute; }
		.topbar-position-relative #topbar-inner .site_widget { color: $skywp_topbar_text_color_relative; }
		.topbar-position-absolute #topbar-inner .site_widget { color: $skywp_topbar_text_color_absolute; }
		.topbar-position-relative .social-navigation .social-links-menu li a { color: $skywp_topbar_social_buttons_color_relative; }
		.topbar-position-absolute .social-navigation .social-links-menu li a { color: $skywp_topbar_social_buttons_color_absolute; }
		#topbar-wrap.border-bottom { border-bottom: 1px solid $skywp_topbar_border_color_relative; }
		#topbar-wrap .site_widget {
		font-size: $skywp_topbar_text_font_size;
		text-transform: $skywp_topbar_text_transform;
		font-weight: $skywp_topbar_text_font_weight;
		letter-spacing: $skywp_topbar_text_letter_spacing;
	}

		/*** HEADER ***/
		#site-header .wrapper { max-width: $header_width; }
		.header-position-absolute #site-header { top: $skywp_header_offset_top; }
		.header-position-relative #site-header { background: $skywp_bg_header_relative; }
		.header-position-absolute #site-header { background: $skywp_bg_header_absolute; }
		@media screen and (min-width: 425px) and (max-width: 768px) { .header-position-absolute #site-header.resize-offset-top-tablet { top: $skywp_header_offset_top_tablet; }}
		@media screen and (max-width: 425px) { .header-position-absolute #site-header.resize-offset-top-mobile { top: $skywp_header_offset_top_mobile; }}
		#site-header.fixed { background: $skywp_bg_sticky_header; }
		.header-position-relative #site-logo .site-title,
		.header-position-relative #site-logo .site-description,
		.header-position-relative #site-navigation-wrap #site-navigation #menu-all-pages .menu-item a,
		.header-position-relative #icom-search .menu_toggle_class,
		.header-position-relative .right-header-item .header-widget-area .site_widget { color: $skywp_header_link_color_relative; }
		.header-position-absolute #site-logo .site-title,
		.header-position-absolute #site-logo .site-description,
		.header-position-absolute #site-navigation-wrap #site-navigation #menu-all-pages .menu-item a,
		.header-position-absolute #icom-search .menu_toggle_class,
		.header-position-absolute .right-header-item .header-widget-area .site_widget { color: $skywp_header_link_color_absolute; }
		#site-header.border-bottom { border-bottom: 1px solid $skywp_header_border_color_relative }

		#site-logo .site-title:hover,
		.standard-current-menu #site-navigation-wrap #site-navigation #menu-all-pages .menu-item a:hover,
		#site-navigation-wrap #site-navigation #menu-all-pages .menu-item .sub-menu .menu-item a:hover,
		#site-navigation-wrap #site-navigation #menu-all-pages .menu-item .sub-menu .menu-item a:focus,
		.social-navigation .social-links-menu li a:hover::before,
		#icom-search .menu_toggle_class:focus,
		#icom-search .menu_toggle_class:hover { color: $skywp_accent_color; }

		#site-header .hc-nav-trigger:focus span,
		#site-header .hc-nav-trigger:focus span::before,
		#site-header .hc-nav-trigger:focus span::after { background: $skywp_accent_color; }

		#site-navigation-wrap #site-navigation #menu-all-pages .menu-item a { 
			font-size: $skywp_header_font_size; font-weight: $skywp_header_font_weight; letter-spacing: $skywp_header_letter_spacing; text-transform: $skywp_header_text_transform; }
		#site-header.standard-current-menu #site-navigation-wrap #site-navigation .current-menu-item a { color: $skywp_accent_color; }

		.header-position-relative #site-header .hc-nav-trigger span,
		.header-position-relative #site-header .hc-nav-trigger span::before,
		.header-position-relative #site-header .hc-nav-trigger span::after { background: $skywp_header_menu_button_color; }
		.header-position-absolute #site-header .hc-nav-trigger span,
		.header-position-absolute #site-header .hc-nav-trigger span::before,
		.header-position-absolute #site-header .hc-nav-trigger span::after { background: $skywp_header_m_menu_but_color_absolute; }
		body .hc-offcanvas-nav .nav-container, .hc-offcanvas-nav .nav-wrapper, .hc-offcanvas-nav ul { background: $skywp_header_background_mobile; }
		body .hc-offcanvas-nav li.nav-close a, .hc-offcanvas-nav li.nav-back a { background: $skywp_header_background_mobile; border-top: 1px solid $skywp_header_border_mobile_color; border-bottom: 1px solid $skywp_header_border_mobile_color; }
		body .hc-offcanvas-nav a,
		body .hc-offcanvas-nav .nav-item { color: $skywp_header_mobile_color; border-bottom: 1px solid $skywp_header_border_mobile_color; }
		body .hc-offcanvas-nav span.nav-next::before,
		body .hc-offcanvas-nav li.nav-back span::before { border-top: 2px solid $skywp_header_mobile_color; border-left: 2px solid $skywp_header_mobile_color; }
		body .hc-offcanvas-nav li.nav-close span::before,
		body .hc-offcanvas-nav li.nav-close span::after { border-top: 2px solid $skywp_header_mobile_color; border-left: 2px solid $skywp_header_mobile_color; }
		body .hc-offcanvas-nav a[href]:not([href=".'"#"'."]) > span.nav-next { border-left: 1px solid $skywp_header_border_mobile_color; }
		body .hc-offcanvas-nav li.nav-close a:hover, .hc-offcanvas-nav li.nav-back a:hover { background: $skywp_header_background_hover; }
		body .hc-offcanvas-nav:not(.touch-device) a:hover { color: $skywp_header_color_hover; background: $skywp_header_background_hover; }


		/*** BREADCRUMB ***/
		.skywp-breadcrumb.after-header { background: $skywp_breadcrumb_bg; padding: $skywp_breadcrumb_padding; }
		.skywp-breadcrumb .content ul li { color: $skywp_breadcrumb_color; font-weight: $skywp_breadcrumb_font_weight; text-transform: $skywp_breadcrumb_text_transform; letter-spacing: $skywp_breadcrumb_letter_spacing; }
		.skywp-breadcrumb.after-header.border-bottom { border-bottom: 1px solid $skywp_breadcrumb_border_color }


		/*** SCROLL TOP ***/
		#scroll-top { background: $skywp_scroll_top_bg; color: $skywp_scroll_up_button_color; border-radius: skywp_scroll_top_border_radius; }
		#scroll-top:hover { background: $skywp_accent_color; color: $skywp_scroll_up_button_color_hover; }


		/*** WIDGETS ***/
		.site_widget a:hover { color: $skywp_links_color_hover; }
		.site_widget .tagcloud a { color: $skywp_tag_link_color; border: 1px solid $skywp_tag_border_color; background: $skywp_tag_bg_color; letter-spacing: $skywp_tag_letter_spacing; text-transform: $skywp_tag_text_transform; font-weight: $skywp_tag_font_weight; }
		.site_widget .tagcloud a:hover,
		.site_widget .tagcloud a:focus { background: $skywp_accent_color; color: $skywp_tag_link_color_hover; border: 1px solid $skywp_accent_color; }
		.site_widget h2 { color: $skywp_widget_title_color; }
		.widget_nav_menu .current-menu-item a { color: $skywp_accent_color !important; }


		/*** BUTTON ***/
		button, [type=" .'"button"'. "], [type=" .'"reset"'. "], [type=" .'"submit"'. "], .skywp-button, #infinite-handle span {
			font-size: $skywp_buttons_font_size;
			font-weight: $skywp_buttons_font_weight;
			letter-spacing: $skywp_buttons_letter_spacing;
			color: $skywp_buttons_link_color;
			background: $skywp_buttons_bg_color;
			padding: $skywp_theme_buttons_padding;
			border: $skywp_border_buttons solid $skywp_border_buttons_color;
			border-radius: $skywp_border_buttons_radius;
			text-transform: $skywp_buttons_text_transform; }

		button:hover, 
		button:focus, 
		[type=" .'"button"'. "]:hover, 
		[type=" .'"button"'. "]:focus, 
		[type=" .'"reset"'. "]:hover, 
		[type=" .'"reset"'. "]:focus, 
		[type=" .'"submit"'. "]:hover, 
		[type=" .'"submit"'. "]:focus, 
		.skywp-button:hover, 
		.skywp-button:focus, 
		#infinite-handle span:hover,
		#infinite-handle span:focus { color: $skywp_buttons_link_color_hover; background: $skywp_buttons_bg_color_hover; 
		border: $skywp_border_buttons solid $skywp_border_buttons_color_hover; }


		/*** HEADER BUTTON ***/
		.skywp-custom-button {
			font-size: $skywp_header_button_font_size;
			font-weight: $skywp_header_button_font_weight;
			letter-spacing: $skywp_header_button_letter_spacing;
			color: $skywp_header_button_color;
			background: $skywp_header_button_bg;
			padding: $skywp_header_button_padding;
			border: $skywp_header_border_button solid $skywp_header_border_button_color;
			border-radius: $skywp_header_border_button_radius;
			text-transform: $skywp_header_button_text_transform; }

		.skywp-custom-button:hover { color: $skywp_header_button_color_hover; background: $skywp_header_button_bg_hover; 
		border: $skywp_header_border_button solid $skywp_header_border_button_color_hover; }


		/*** INPUT / TEXTAREA ***/
		input[type=" .'"text"'. "]:focus, input[type=" .'"checkbox"'. "]:focus, input[type=" .'"email"'. "]:focus, input[type=" .'"url"'. "]:focus, input[type=" .'"password"'. "]:focus, input[type=" .'"search"'. "]:focus, input[type=" .'"number"'. "]:focus, input[type=" .'"tel"'. "]:focus, input[type=" .'"range"'. "]:focus, input[type=" .'"date"'. "]:focus, input[type=" .'"month"'. "]:focus, input[type=" .'"week"'. "]:focus, input[type=" .'"time"'. "]:focus, input[type=" .'"datetime"'. "]:focus, input[type=" .'"datetime-local"'. "]:focus, input[type=" .'"color"'. "]:focus, textarea:focus { border-color: $skywp_forms_border_color_focus; }
		input:not([type=" .'"submit"'. "]),
		textarea { color: $skywp_form_color; border: 1px solid $skywp_form_border_color; }
		label { color: $skywp_form_label_color; }
		input::-webkit-input-placeholder, textarea::-webkit-input-placeholder { color: $skywp_forms_placeholder_color; }
		input::-moz-placeholder, textarea::-moz-placeholder { color: $skywp_forms_placeholder_color; }
		input:-ms-input-placeholder, textarea:-ms-input-placeholder { color: $skywp_forms_placeholder_color; }
		input::-ms-input-placeholder, textarea::-ms-input-placeholder { color: $skywp_forms_placeholder_color; }
		input::placeholder, textarea::placeholder { color: $skywp_forms_placeholder_color; }


		/*** PAGINATION ***/
		nav.navigation.pagination { text-align: $skywp_pagination_align; }
		nav.navigation.pagination .page-numbers { color: $skywp_pagination_color; border-color: $skywp_pagination_border_color; border-radius: $skywp_pagination_border_radius; }
		nav.navigation.pagination .page-numbers:hover { color: $skywp_accent_color; border-color: $skywp_accent_color; }
		nav.navigation.pagination .page-numbers.current { color: $skywp_accent_color; border-color: $skywp_accent_color; }


		/*** POST ***/
		#content-wrap #primary #main-style article .blog-wrap { background: $skywp_post_page_bg; }
		#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-title a { color: $skywp_post_page_title_color; }
		#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-title a:hover { color: $skywp_links_color_hover; }
		
		/* Blog page */
		#content-wrap .blog-page article .blog-wrap .post-content-wrap .entry-meta,
		#content-wrap .blog-page article .blog-wrap .post-content-wrap .entry-meta a { color: $skywp_post_page_meta_color; }

		/* Article page */
		#content-wrap .article-page article .blog-wrap .post-content-wrap .entry-meta,
		#content-wrap .article-page article .blog-wrap .post-content-wrap .entry-meta a { color: $skywp_article_meta_color; }

		#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-meta ul li a:hover { color: $skywp_links_color_hover; }
		#wrap blockquote { border-left: 3px solid $skywp_accent_color; }
		#content-wrap #primary article .blog-wrap .post-content-wrap .entry-meta a:hover { color: $skywp_links_color_hover; }

		.navigation.post-navigation .nav-links a { color: $skywp_article_prev_next_color; }
		.navigation.post-navigation .nav-links { background: $skywp_article_prev_next_bg; }


		/*** FOOTER ***/
		#footer-wrapper .wrapper { max-width: $footer_width; }
		#footer-wrapper { background: $skywp_footer_bg; padding: $skywp_footer_padding; }
		#footer-area .site_widget h2 { color: $skywp_footer_title_color; border-bottom: 1px solid $skywp_footer_border_color; }
		#footer-area .site_widget,
		#footer-area .site_widget a,
		#footer-area .author-theme a { color: $skywp_footer_text_color; }
		#footer-area .site_widget a:hover { color: $skywp_tag_link_color_hover; }
		#footer-area .site_widget .tagcloud a { border: 1px solid $skywp_footer_tag_cloud_border_color; }
		#footer-area .site_widget .tagcloud a:hover { border: 1px solid $skywp_accent_color; }
		#footer-area .footer-wrap .site_widget.widget_tag_cloud a:hover { color: $skywp_tag_cloud_color_hover; }


		/*** COPYRIGHT ***/
		#copyright .wrapper { max-width: $footer_copyright_width; }
		#copyright { background: $skywp_copyright_bg; }
		#copyright .container { padding: $skywp_footer_padding_copyright;
		-webkit-box-pack: $skywp_copyright_alignment;
	    -ms-flex-pack: $skywp_copyright_alignment;
	        justify-content: $skywp_copyright_alignment; }

		";
	wp_add_inline_style( 'skywp-main-style', $custom_css );
}



/*
=======================================
HEADER
=======================================
*/

/**
 * Header layout
 *
 * @since 1.0.3
 */
function skywp_header_template() {

	if ( 'standard' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		get_template_part( 'template-parts/header/layout' );
	}
	elseif ( 'centered' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		get_template_part( 'template-parts/header/layout' );
	}
	elseif ( 'left_aligned' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		get_template_part( 'template-parts/header/layout' );
	}
	elseif ( 'standard_2' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		get_template_part( 'template-parts/header/layout' );
	}
	elseif ( 'banner' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		get_template_part( 'template-parts/header/layout' );
	}
	
}

/**
 * Header classes
 *
 * @since 1.2.3
 */
function skywp_header_classes() {

	$classes = array();

	$classes[] = 'site-header';

	// Add classes on pages with position: absolute
	if ( get_theme_mod( 'skywp_header_position', 'relative' ) == 'absolute' ) {
		if ( get_theme_mod( 'skywp_header_disable_position_absolute_all_except_full_width_page', false ) == true ) {
			if ( is_page_template( 'template-parts/full-width-page.php' ) ) {
				$classes[] = 'resize-offset-top-tablet resize-offset-top-mobile';
			}
		} else {
			$classes[] = 'resize-offset-top-tablet resize-offset-top-mobile';
		}
	}

	if ( 'standard' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		$classes[] = 'standard-menu';
	}
	elseif ( 'centered' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		$classes[] = 'centered-menu';
	}
	elseif ( 'left_aligned' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		$classes[] = 'left-aligned-menu';
	}
	elseif ( 'standard_2' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		$classes[] = 'standard-2-menu';
	}
	elseif ( 'banner' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		$classes[] = 'banner-menu';
	}

	// Header border bottom
	if ( true == get_theme_mod( 'skywp_header_border_bottom', false ) ) {
		$classes[] = 'border-bottom';
	}

	// Header current menu item style
	if ( 'standard' == get_theme_mod( 'skywp_header_links_effect', 'standard' ) ) {
		$classes[] = 'standard-current-menu';
	} 
	else if ( 'style-second' == get_theme_mod( 'skywp_header_links_effect', 'standard' ) ) {
		$classes[] = 'style-second-current-menu';
	}

	// Right item in header hide on tablet or mobile
	if ( get_theme_mod( 'skywp_right_header_item_hide_tablet', false ) == true ) {
		$classes[] = 'right-header-item-hide-tablet';
	} 
	if ( get_theme_mod( 'skywp_right_header_item_hide_mobile', false ) == true ) {
		$classes[] = 'right-header-item-hide-mobile';
	}

	$classes = implode( ' ', $classes );

	echo esc_attr( $classes );	
}

/**
 * Header layout logo
 *
 * @since 1.0.3
 */
function skywp_header_template_logo() {

	get_template_part( 'template-parts/header/logo' );

}

/**
 * Header banner
 *
 * @since 1.1.4
 */
function skywp_header_template_banner() {
	if ( 'banner' == get_theme_mod( 'skywp_header_layout', 'standard' ) ) {
		
		get_template_part( 'template-parts/header/header-banner' );
	}
}

/**
 * If header layout = banner, that adding the wrapper for logo and banner - start
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_header_wrapper_banner_start' ) ) {
	function skywp_header_wrapper_banner_start() {
		if ( get_theme_mod( 'skywp_header_layout', 'standard' ) == 'banner' ) {
		?>
			<div class="header-wrap-banner">
		<?php
		}
	}
}

/**
 * If header layout = banner, that adding the wrapper for logo and banner - end
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_header_wrapper_banner_end' ) ) {
	function skywp_header_wrapper_banner_end() {
		if ( get_theme_mod( 'skywp_header_layout', 'standard' ) == 'banner' ) {
		?>
			</div>
		<?php
		}
	}
}

/**
 * If header layout = banner, that adding the wrapper for menu and right item - start
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_header_banner_wrapper_menu_start' ) ) {
	function skywp_header_banner_wrapper_menu_start() {
		if ( get_theme_mod( 'skywp_header_layout', 'standard' ) == 'banner' ) {
		?>
			<div class="header-wrap-menu">
		<?php
		}
	}
}

/**
 * If header layout = banner, that adding the wrapper for menu and right item - end
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_header_banner_wrapper_menu_end' ) ) {
	function skywp_header_banner_wrapper_menu_end() {
		if ( get_theme_mod( 'skywp_header_layout', 'standard' ) == 'banner' ) {
		?>
			</div>
		<?php
		}
	}
}

/**
 * Custom Header
 *
 * @since 1.2.0
 */
function skywp_custom_header_template() {

	if ( has_custom_header() ) {
		get_template_part( 'template-parts/header/custom-header' );
	}
	
}

/**
 * Header layout template menu navigation
 *
 * @since 1.0.3
 */
function skywp_header_template_navigation() {

	get_template_part( 'template-parts/header/nav' );
}

/**
 * Adding wrapper on a right header item - start
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_wrapper_start' ) ) {
	function skywp_right_header_item_wrapper_start() {
		if ( get_theme_mod( 'skywp_right_header_item_select', 'none' ) !== 'none' ) {
		?>
			<div class="right-header-item">
		<?php
		}
	}
}

/**
 * Adding wrapper on a right header item - end
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_wrapper_end' ) ) {
	function skywp_right_header_item_wrapper_end() {
		if ( get_theme_mod( 'skywp_right_header_item_select', 'none' ) !== 'none' ) {
		?>
			</div>
		<?php
		}
	}
}

/**
 * Right header item - Search
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_search' ) ) {
	function skywp_right_header_item_search() {

	if( get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'search' ) : ?>
		<div id="icom-search">
			<button type="button" class="menu_toggle_class">
				<i class="fas fa-search"></i>
			</button>
			<?php do_action( 'skywp_header_search' ); ?>
		</div>
	<?php
	endif;
	}
}

/**
 * Right header item - Button
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_button' ) ) {
	function skywp_right_header_item_button() {

	if( get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'button' ) :
		skywp_header_button();
	endif;
	}
}

/**
 * Right header item - Text / HTML
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_text_html' ) ) {
	function skywp_right_header_item_text_html() {

	if( get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'text-html' ) : ?>
		<div class="header-custom-html">
			<?php echo wp_kses( get_theme_mod( 'skywp_header_text_html', '<button>Hello</button>' ), 'post' ); ?>
		</div>
	<?php
	endif;
	}
}

/**
 * Right header item - Widget
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_widget' ) ) {
	function skywp_right_header_item_widget() {

	if( get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'widget' ) :
		?>
		<div class="header-widget-area">
			<?php if( is_active_sidebar( 'widget-right-header-item' ) ) {
				dynamic_sidebar( 'widget-right-header-item' );
			}
			else if ( current_user_can( 'edit_theme_options' ) ) { ?>
				<div class="no-widget">
					<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
						<?php esc_html_e( 'Add Widget', 'skywp' ); ?>
					</a>
				</div>
			<?php } ?>
		</div>
	<?php
	endif;
	}
}

/**
 * Right header item - Woocommerce
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_right_header_item_woocommerce' ) ) {
	function skywp_right_header_item_woocommerce() {
	if( class_exists( 'WooCommerce' ) && get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'woocommerce' ) :
		?>
		<div class="skywp-header-cart">
			<?php skywp_woocommerce_header_cart() ?>
		</div>
	<?php
	endif;
	}
}

/**
 * Connect search to the header
 *
 * @since 1.0.3
 */
function skywp_header_search_template() {

	if ( get_theme_mod( 'skywp_right_header_item_select', 'none' ) == 'search' ) {

		if ( 'dropdown' == get_theme_mod( 'skywp_header_search_style', 'dropdown' ) ) {
			get_template_part( 'template-parts/header/search-dropdown' );
		}
	}
}

/**
 * Right item in header - button
 *
 * @since 1.2.3
 */
if ( !function_exists( 'skywp_header_button' ) ) {
	function skywp_header_button() {
		
		$text = get_theme_mod( 'skywp_right_header_item_button', 'Button' );
		$link = get_theme_mod( 'skywp_right_header_item_button_link', 'https://urchenko.ru' );

		if ( get_theme_mod( 'skywp_right_header_item_button_open_new_tab', false ) == false ) {
			$target = '_self';
		} else {
			$target = '_blank';
		}

		if ( get_theme_mod( 'skywp_right_header_item_button_style', 'theme-button' ) == 'theme-button' ) {
			$class = 'skywp-button';
		} else {
			$class = 'skywp-custom-button';
		}

		$rel = '';
		if ( !empty( get_theme_mod( 'skywp_right_header_item_button_link_rel', '' ) ) ) {
			$rel = 'rel="'. get_theme_mod( 'skywp_right_header_item_button_link_rel', '' ) .'"';
		}

		echo '<a href="'. esc_url($link) .'"class="'. esc_attr($class) .'"  target="'. esc_attr($target) .'"'. esc_attr($rel) .'>'. esc_html($text) .'</a>';
	}
}





/*
=======================================
BREADCRUMB
=======================================
*/
/**
 * After Header Breadcrumb
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_breadcrumb_after_header_layout' ) ) {
	function skywp_breadcrumb_after_header_layout() {

		// Shutdown breadcrumbs on pages plugin BetterDocs.
		$betterdocs_page = '';
		if ( class_exists( 'BetterDocs' ) ) {
			if ( is_singular( 'docs' ) ) {
				$betterdocs_page = is_singular( 'docs' );
			}
			if ( is_tax( 'doc_tag' ) ) {
				$betterdocs_page = is_tax( 'doc_tag' );
			}
			if ( is_tax( 'doc_category' ) ) {
				$betterdocs_page = is_tax( 'doc_category' );
			}
			if ( is_post_type_archive( 'docs' ) ) {
				$betterdocs_page = is_post_type_archive( 'docs' );
			}
		}

		if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) == 'after_header' && !is_page_template( 'template-parts/full-width-page.php' ) && !$betterdocs_page ) {
			
			// Disable on Home Page?
			if ( get_theme_mod( 'skywp_bc_disable_home_page', false ) !== true ) {
				if ( is_front_page() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on Blog / Posts Page?
			if ( get_theme_mod( 'skywp_bc_disable_blog_page', false ) !== true ) {
				if ( is_home() && !is_front_page() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on Search?
			if ( get_theme_mod( 'skywp_bc_disable_search', false ) !== true ) {
				if ( is_search() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on Archive?
			if ( get_theme_mod( 'skywp_bc_disable_archive', false ) !== true ) {
				if ( class_exists( 'WooCommerce' ) ) {
					if ( is_archive() && !is_shop() && !is_tax() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				} else {
					if ( is_archive() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				}
				
			}
			// Disable on Attachment?
			if ( get_theme_mod( 'skywp_bc_disable_attachment', false ) !== true ) {
				if ( is_attachment() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on Single Page?
			if ( get_theme_mod( 'skywp_bc_disable_page', false ) !== true ) {
				if ( class_exists( 'WooCommerce' ) ) {
					if ( is_page() && !is_cart() && !is_account_page() && !is_checkout() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				} else {
					if ( is_page() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				}
			}
			// Disable on Single Post?
			if ( get_theme_mod( 'skywp_bc_disable_post', false ) !== true ) {
				if ( class_exists( 'WooCommerce' ) ) {
					if ( is_single() && !is_attachment() && !is_product() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				} else {
					if ( is_single() && !is_attachment() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				}
			}
			// Disable on 404 Page?
			if ( get_theme_mod( 'skywp_bc_disable_404', false ) !== true ) {
				if ( is_404() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on WooCommerce Page?
			if ( class_exists( 'WooCommerce' ) ) {
				if ( get_theme_mod( 'skywp_bc_disable_woocommerce', true ) == false ) {
					if ( is_shop() || is_cart() || is_checkout() || is_account_page() || is_tax() || is_product() ) {
						get_template_part( 'template-parts/breadcrumb/breadcrumb' );
					}
				}
			}
			
		}

	}
}

/**
 * Breadcrumb before title
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_breadcrumb_before_title_layout' ) ) {
	function skywp_breadcrumb_before_title_layout() {

		if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) == 'before_title' ) {

			// Disable on Post?
			if ( get_theme_mod( 'skywp_bc_disable_post', false ) !== true ) {
				if ( is_single() && !is_attachment() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on Page?
			if ( get_theme_mod( 'skywp_bc_disable_page', false ) !== true ) {
				if ( is_page() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			// Disable on Attachment?
			if ( get_theme_mod( 'skywp_bc_disable_attachment', false ) !== true ) {
				if ( is_attachment() ) {
					get_template_part( 'template-parts/breadcrumb/breadcrumb' );
				}
			}
			
		}

	}
}

/**
 * Hook: skywp_breadcrumb_wrapper_start
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_breadcrumb_wrapper_layout_start' ) ) {
	function skywp_breadcrumb_wrapper_layout_start() {

		if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) !== 'before_title' ) { ?>
			<div class="wrapper">
		<?php }
	}
}

/**
 * Hook: skywp_breadcrumb_wrapper_end
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'skywp_breadcrumb_wrapper_layout_end' ) ) {
	function skywp_breadcrumb_wrapper_layout_end() {

		if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) !== 'before_title' ) { ?>
			</div>
		<?php }
	}
}

/**
 * Displays the class names for the breadcrumb.
 *
 * @since 1.2.3
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 */
if ( ! function_exists( 'skywp_breadcrumb_class' ) ) {
	function skywp_breadcrumb_class( $class = '' ) {
		// Separates class names with a single space
		$classes = implode( ' ', skywp_get_breadcrumb_class( $class ) );

		echo esc_attr( $classes );
	}
}

/**
 * Retrieves an array of the class names for the breadcrumb.
 *
 * @since 1.2.3
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 * @return string[] Array of class names.
 */
if ( ! function_exists( 'skywp_get_breadcrumb_class' ) ) {
	function skywp_get_breadcrumb_class( $class = '' ) {
		$classes = array();

		$classes[] = 'skywp-breadcrumb';

		// Breadcrumb position
		if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) == 'after_header' ) {
			$classes[] = 'after-header';
		}
		else if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) == 'before_title' ) {
			$classes[] = 'before-title';
		}

		// Alignment
		if ( get_theme_mod( 'skywp_breadcrumb_alignment', 'left' ) == 'left' ) {
			$classes[] = 'left';
		}
		else if ( get_theme_mod( 'skywp_breadcrumb_alignment', 'left' ) == 'center' ) {
			$classes[] = 'center';
		}
		else if ( get_theme_mod( 'skywp_breadcrumb_alignment', 'left' ) == 'right' ) {
			$classes[] = 'right';
		}

		// Breadcrumb border bottom
		if ( get_theme_mod( 'skywp_position_breadcrumb', 'none' ) == 'after_header' && get_theme_mod( 'skywp_breadcrumb_border_bottom', false ) == true ) {
			$classes[] = 'border-bottom';
		}

		$classes = apply_filters( 'skywp_breadcrumb_class', $classes, $class );

		return array_unique( $classes );
	}
}





/*
=======================================
TYPOGRAPHY
=======================================
*/
/**
 * Typography Select
 *
 * @since 1.0.0
 */
add_action('wp_enqueue_scripts', 'skywp_typography_body');
function skywp_typography_body() {

	if ( 'roboto' == get_theme_mod( 'skywp_typography_font_family', 'roboto' ) ) {
		wp_register_style( 'skywp-google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap&subset=cyrillic-ext,greek-ext' );
		$classes[] = 'Roboto';
		
	} else if ( 'open-sans' == get_theme_mod( 'skywp_typography_font_family', 'roboto' ) ) {
		wp_register_style( 'skywp-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap&subset=cyrillic-ext,greek-ext' );
		$classes[] = 'Open Sans';
	} else if ( 'montserrat' == get_theme_mod( 'skywp_typography_font_family', 'roboto' ) ) {
		wp_register_style( 'skywp-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900&display=swap&subset=cyrillic' );
		$classes[] = 'Montserrat';
	} 
	wp_enqueue_style( 'skywp-google-fonts' );

	// Turn classes array into space seperated string
	$classes = implode( ' ', $classes );

	// Return classes
	return esc_attr( $classes );
}

/*
=======================================
FOOTER
=======================================
*/

/**
 * Footer layout templates
 *
 * @since 1.0.3
 */
add_action( 'skywp_footer_layout', 'skywp_footer_layout_templates' );
function skywp_footer_layout_templates() {

	// Footer 4 | 25%
	if ( '4_25' == get_theme_mod('skywp_footer_layout', '4_25' ) ) {
		get_template_part( 'template-parts/footer/footer-4-25' );
	}

}

/**
 * Add classes for footer layout
 *
 * @since 1.0.3
 */
if ( ! function_exists( 'skywp_footer_classes' ) ) {

	function skywp_footer_classes() {

	if ( '4_25' == get_theme_mod('skywp_footer_layout', '4_25' ) ) {
		$classes[] = 'four-columns';
	}

	$classes = implode( ' ', $classes );

	return $classes;

}

}

/**
 * Write who the author of the theme
 *
 * @since 1.0.3
 */
add_action( 'skywp_copyright_template', 'skywp_footer_copyright_text' );
function skywp_footer_copyright_text() {
	?>
	<div class="column">
		<div class="author-theme">
			<a href="<?php echo esc_url( 'https://urchenko.ru' ); ?>" target="_blank"><?php esc_html_e( 'SkyWP Theme WordPress', 'skywp' ); ?></a>
		</div>
	</div>
	<?php
}

/*
=======================================
BLOG
=======================================
*/

/**
 * Select post style
 *
 * @since 1.0.8
 */
function skywp_select_post_style() {
	if ( 'default' == get_theme_mod( 'skywp_post_page_style', 'default' ) ) {
		$classes[] = 'style-default';
	} else if ( 'masonry' == get_theme_mod( 'skywp_post_page_style', 'default' ) ) {
		$classes[] = 'style-masonry';
	}
	$classes = implode( ' ', $classes );
	return esc_attr( $classes );
}

/**
 * Number of columns posts
 * 
 * @since 1.0.8
 */
function skywp_number_columns_posts() {
	if ( 'one' == get_theme_mod( 'skywp_post_page_number_columns', 'one' ) ) {
		$classes[] = 'number-columns-one';
	} else if ( 'two' == get_theme_mod( 'skywp_post_page_number_columns', 'one' ) ) {
		$classes[] = 'number-columns-two';
	} else if ( 'three' == get_theme_mod( 'skywp_post_page_number_columns', 'one' ) ) {
		$classes[] = 'number-columns-three';
	}
	$classes = implode( ' ', $classes );
	return esc_attr( $classes );
}





/*
=======================================
CONTENT
=======================================
*/
/**
 * Displays the class names for the <div id="wrap"> element.
 *
 * @since 1.2.3
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 */
if ( ! function_exists( 'skywp_content_class' ) ) {
	function skywp_content_class( $class = '' ) {
		// Separates class names with a single space
		$classes = implode( ' ', skywp_get_content_class( $class ) );

		echo esc_attr( $classes );
	}
}

/**
 * Retrieves an array of the class names for the <div id="wrap"> element.
 *
 * @since 1.2.3
 *
 * @param string|string[] $class Space-separated string or array of class names to add to the class list.
 * @return string[] Array of class names.
 */
if ( ! function_exists( 'skywp_get_content_class' ) ) {
	function skywp_get_content_class( $class = '' ) {
		$classes = array();

		$classes[] = 'outer-wrapper';

		// Default layout sidebar
		if ( is_attachment() && get_theme_mod( 'skywp_default_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
			$classes[] = 'sidebar-right';
		}
		else if ( is_attachment() && get_theme_mod( 'skywp_default_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
			$classes[] = 'sidebar-left';
		}
		else if ( is_attachment() && get_theme_mod( 'skywp_default_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
			$classes[] = 'no-sidebar';
		}

		// Blog page sidebar
		if ( is_home() && get_theme_mod( 'skywp_blog_page_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
			$classes[] = 'sidebar-right';
		}
		else if ( is_home() && get_theme_mod( 'skywp_blog_page_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
			$classes[] = 'sidebar-left';
		}
		else if ( is_home() && get_theme_mod( 'skywp_blog_page_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
			$classes[] = 'no-sidebar';
		}

		// Search sidebar
		if ( is_search() && get_theme_mod( 'skywp_search_page_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
			$classes[] = 'sidebar-right';
		}
		else if ( is_search() && get_theme_mod( 'skywp_search_page_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
			$classes[] = 'sidebar-left';
		}
		else if ( is_search() && get_theme_mod( 'skywp_search_page_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
			$classes[] = 'no-sidebar';
		}

		// Topbar position
		if ( get_theme_mod( 'skywp_topbar_position', 'relative' ) == 'absolute' ) {
			if ( get_theme_mod( 'skywp_topbar_disable_position_absolute_all_except_full_width_page', false ) == true ) {
				if ( is_page_template( 'template-parts/full-width-page.php' ) ) {
					$classes[] = 'topbar-position-absolute';
				} else {
					$classes[] = 'topbar-position-relative';
				}
			} else {
				$classes[] = 'topbar-position-absolute';
			}
		} else {
			$classes[] = 'topbar-position-relative';
		}

		// Header position
		if ( get_theme_mod( 'skywp_header_position', 'relative' ) == 'absolute' ) {
			if ( get_theme_mod( 'skywp_header_disable_position_absolute_all_except_full_width_page', false ) == true ) {
				if ( is_page_template( 'template-parts/full-width-page.php' ) ) {
					$classes[] = 'header-position-absolute';
				} else {
					$classes[] = 'header-position-relative';
				}
			} else {
				$classes[] = 'header-position-absolute';
			}
		} else {
			$classes[] = 'header-position-relative';
		}

		if ( !class_exists( 'WooCommerce' ) ) {

			// Page sidebar
			if ( is_page() && !is_page_template( 'template-parts/full-width-page.php' ) && get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
				$classes[] = 'sidebar-right';
			}
			else if ( is_page() && !is_page_template( 'template-parts/full-width-page.php' ) && get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
				$classes[] = 'sidebar-left';
			}
			else if ( is_page() && !is_page_template( 'template-parts/full-width-page.php' ) && get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
				$classes[] = 'no-sidebar';
			}

			// Articles sidebar
			if ( is_single() && !is_attachment() && get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
				$classes[] = 'sidebar-right';
			}
			else if ( is_single() && !is_attachment() && get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
				$classes[] = 'sidebar-left';
			}
			else if ( is_single() && !is_attachment() && get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
				$classes[] = 'no-sidebar';
			}

			// Archives sidebar
			if ( is_archive() && get_theme_mod( 'skywp_archives_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
				$classes[] = 'sidebar-right';
			}
			else if ( is_archive() && get_theme_mod( 'skywp_archives_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
				$classes[] = 'sidebar-left';
			}
			else if ( is_archive() && get_theme_mod( 'skywp_archives_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
				$classes[] = 'no-sidebar';
			}
		}
		elseif ( class_exists( 'WooCommerce' ) ) {

			if ( !is_cart() && !is_shop() && !is_product() && !is_checkout() && !is_account_page() && !is_tax() ) {

				// Page sidebar
				if ( is_page() && !is_page_template( 'template-parts/full-width-page.php' ) && get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
					$classes[] = 'sidebar-right';
				}
				else if ( is_page() && !is_page_template( 'template-parts/full-width-page.php' ) && get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
					$classes[] = 'sidebar-left';
				}
				else if ( is_page() && !is_page_template( 'template-parts/full-width-page.php' ) && get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
					$classes[] = 'no-sidebar';
				}

				// Articles sidebar
				if ( is_single() && !is_attachment() && get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
					$classes[] = 'sidebar-right';
				}
				else if ( is_single() && !is_attachment() && get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
					$classes[] = 'sidebar-left';
				}
				else if ( is_single() && !is_attachment() && get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
					$classes[] = 'no-sidebar';
				}

				// Archives sidebar
				if ( is_archive() && get_theme_mod( 'skywp_archives_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
					$classes[] = 'sidebar-right';
				}
				else if ( is_archive() && get_theme_mod( 'skywp_archives_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
					$classes[] = 'sidebar-left';
				}
				else if ( is_archive() && get_theme_mod( 'skywp_archives_sidebar', 'sidebar-right' ) == 'no-sidebar' ) {
					$classes[] = 'no-sidebar';
				}
			}

			if ( is_cart() || is_shop() || is_checkout() || is_account_page() || is_tax() ) {
				// WooCommerce sidebar
				if ( get_theme_mod( 'skywp_woocommerce_sidebar', 'no-sidebar' ) == 'sidebar-right' ) {
					$classes[] = 'sidebar-right';
				}
				else if ( get_theme_mod( 'skywp_woocommerce_sidebar', 'no-sidebar' ) == 'sidebar-left' ) {
					$classes[] = 'sidebar-left';
				}
				else if ( get_theme_mod( 'skywp_woocommerce_sidebar', 'no-sidebar' ) == 'no-sidebar' ) {
					$classes[] = 'no-sidebar';
				}
			}
			
			// WooCommerce sidebar single product
			if ( is_product() ) {
				if ( get_theme_mod( 'skywp_woo_single_product_sidebar', 'no-sidebar' ) == 'sidebar-right' ) {
					$classes[] = 'sidebar-right';
				}
				else if ( get_theme_mod( 'skywp_woo_single_product_sidebar', 'no-sidebar' ) == 'sidebar-left' ) {
					$classes[] = 'sidebar-left';
				}
				else if ( get_theme_mod( 'skywp_woo_single_product_sidebar', 'no-sidebar' ) == 'no-sidebar' ) {
					$classes[] = 'no-sidebar';
				}
			}
			
		}

		$classes = apply_filters( 'skywp_content_class', $classes, $class );

		return array_unique( $classes );
	}
}


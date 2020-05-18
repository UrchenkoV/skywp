/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );





	/***** TOPBAR *****/

	// Topbar border bottom
	wp.customize( 'skywp_topbar_border_color_relative', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap' ).css({ 'border-color': newval });
		});
	});

	// Topbar background
	wp.customize( 'skywp_bg_topbar_relative', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap' ).css({ 'background': newval });
		});
	});

	// Topbar social buttons color relative
	wp.customize( 'skywp_topbar_social_buttons_color_relative', function( value ){
		value.bind( function( newval ){
			$( '.social-navigation .social-links-menu li a' ).css({ 'color': newval });
		});
	});

	// Topbar social buttons color absolute
	wp.customize( 'skywp_topbar_social_buttons_color_absolute', function( value ){
		value.bind( function( newval ){
			$( '.social-navigation .social-links-menu li a' ).css({ 'color': newval });
		});
	});

	// Width
	wp.customize( 'topbar_width', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Padding
	wp.customize( 'skywp_topbar_padding', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap #topbar' ).css({ 'padding': newval });
		});
	});

	// Visibility
	wp.customize( 'skywp_topbar_visibility', function( value ){
		value.bind( function( newval ){
			if ( 'all-devices' == newval ) {
				$( '#topbar-wrap' ).addClass( 'all-devices' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'all-devices' );
			}
			if ( 'hide-tablet' == newval ) {
				$( '#topbar-wrap' ).addClass( 'hide-tablet' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'hide-tablet' );
			}
			if ( 'hide-mobile' == newval ) {
				$( '#topbar-wrap' ).addClass( 'hide-mobile' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'hide-mobile' );
			}
			if ( 'hide-tablet-mobile' == newval ) {
				$( '#topbar-wrap' ).addClass( 'hide-tablet-mobile' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'hide-tablet-mobile' );
			}
			
		});
	});

	// Alignment
	wp.customize( 'skywp_topbar_alignment', function( value ){
		value.bind( function( newval ){
			if ( 'space-between' == newval ) {
				$( '#topbar' ).addClass( 'space-between' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'space-between' );
			}
			if ( 'space-around' == newval ) {
				$( '#topbar-wrap' ).addClass( 'space-around' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'space-around' );
			}
			if ( 'center' == newval ) {
				$( '#topbar-wrap' ).addClass( 'center' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'center' );
			}
			if ( 'flex-start' == newval ) {
				$( '#topbar-wrap' ).addClass( 'flex-start' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'flex-start' );
			}
			if ( 'flex-end' == newval ) {
				$( '#topbar-wrap' ).addClass( 'flex-end' );
			} else {
				$( '#topbar-wrap' ).removeClass( 'flex-end' );
			}
			
		});
	});

	// Text color relative
	wp.customize( 'skywp_topbar_text_color_relative', function( value ){
		value.bind( function( newval ){
			$( '.topbar-position-relative #topbar-inner .site_widget' ).css({ 'color': newval });
		});
	});

	// Text color absolute
	wp.customize( 'skywp_topbar_text_color_absolute', function( value ){
		value.bind( function( newval ){
			$( '.topbar-position-absolute #topbar-inner .site_widget' ).css({ 'color': newval });
		});
	});

	// Font size
	wp.customize( 'skywp_topbar_text_font_size', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap .site_widget' ).css({ 'font-size': newval + 'px' });
		});
	});

	// Font Weight
	wp.customize( 'skywp_topbar_text_font_weight', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap .site_widget' ).css({ 'font-weight': newval });
		});
	});

	// Text Transform
	wp.customize( 'skywp_topbar_text_transform', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap .site_widget' ).css({ 'text-transform': newval });
		});
	});

	// Letter Spacing
	wp.customize( 'skywp_topbar_text_letter_spacing', function( value ){
		value.bind( function( newval ){
			$( '#topbar-wrap .site_widget' ).css({ 'letter-spacing': newval + 'px' });
		});
	});





	/***** HEADER *****/

	// Width
	wp.customize( 'header_width', function( value ){
		value.bind( function( newval ){
			$( '#site-header .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Links Color relative
	wp.customize( 'skywp_header_link_color_relative', function( value ){
		value.bind( function( newval ){
			$( '.header-position-relative #site-logo .site-title, .header-position-relative #site-logo .site-description, .header-position-relative #site-navigation-wrap #site-navigation #menu-all-pages .menu-item a, .header-position-relative #icom-search .menu_toggle_class' ).css({ 'color': newval });
		});
	});

	// Links Color absolute
	wp.customize( 'skywp_header_link_color_absolute', function( value ){
		value.bind( function( newval ){
			$( '.header-position-absolute #site-logo .site-title, .header-position-absolute #site-logo .site-description, .header-position-absolute #site-navigation-wrap #site-navigation #menu-all-pages .menu-item a, .header-position-absolute #icom-search .menu_toggle_class' ).css({ 'color': newval });
		});
	});

	// Background header relative
	wp.customize( 'skywp_bg_header_relative', function( value ){
		value.bind( function( newval ){
			$( '.header-position-relative #site-header' ).css({ 'background': newval });
		});
	});

	// Background header absolute
	wp.customize( 'skywp_bg_header_absolute', function( value ){
		value.bind( function( newval ){
			$( '.header-position-absolute #site-header' ).css({ 'background': newval });
		});
	});

	// Background sticky header  
	wp.customize( 'skywp_bg_sticky_header', function( value ){
		value.bind( function( newval ){
			$( '#site-header.fixed' ).css({ 'background': newval });
		});
	});

	// Font Size
	wp.customize( 'skywp_header_font_size', function( value ){
		value.bind( function( newval ){
			$( '#site-navigation-wrap #site-navigation #menu-all-pages .menu-item a' ).css({ 'font-size': newval + 'px' });
		});
	});

	// Font Weight
	wp.customize( 'skywp_header_font_weight', function( value ){
		value.bind( function( newval ){
			$( '#site-navigation-wrap #site-navigation #menu-all-pages .menu-item a' ).css({ 'font-weight': newval });
		});
	});

	// Text Transform
	wp.customize( 'skywp_header_text_transform', function( value ){
		value.bind( function( newval ){
			$( '#site-navigation-wrap #site-navigation #menu-all-pages .menu-item a' ).css({ 'text-transform': newval });
		});
	});

	// Letter Spacing
	wp.customize( 'skywp_header_letter_spacing', function( value ){
		value.bind( function( newval ){
			$( '#site-navigation-wrap #site-navigation #menu-all-pages .menu-item a' ).css({ 'letter-spacing': newval + 'px' });
		});
	});

	// Header border bottom
	wp.customize( 'skywp_header_border_color_relative', function( value ){
		value.bind( function( newval ){
			$( '#site-header' ).css({ 'border-color': newval });
		});
	});





	/***** THEME BUTTON *****/

	// Font Size
	wp.customize( 'skywp_buttons_font_size', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'font-size': newval + 'px' });
		});
	});

	// Font Weight
	wp.customize( 'skywp_buttons_font_weight', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'font-weight': newval });
		});
	});

	// Text Transform
	wp.customize( 'skywp_buttons_text_transform', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'text-transform': newval });
		});
	});

	// Padding
	wp.customize( 'skywp_theme_buttons_padding', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'padding': newval });
		});
	});

	// Color
	wp.customize( 'skywp_buttons_link_color', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'color': newval });
		});
	});

	// Background
	wp.customize( 'skywp_buttons_bg_color', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'background': newval });
		});
	});

	// Border
	wp.customize( 'skywp_border_buttons', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'border-width': newval + 'px' });
		});
	});

	// Border Color
	wp.customize( 'skywp_border_buttons_color', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'border-color': newval });
		});
	});

	// Border Radius
	wp.customize( 'skywp_border_buttons_radius', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'border-radius': newval + 'px' });
		});
	});

	// Letter Spasing
	wp.customize( 'skywp_buttons_letter_spacing', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'letter-spacing': newval + 'px' });
		});
	});





	/***** HEADER CUSTOM BUTTON *****/

	// Font Size
	wp.customize( 'skywp_header_button_font_size', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'font-size': newval + 'px' });
		});
	});

	// Font Weight
	wp.customize( 'skywp_header_button_font_weight', function( value ){
		value.bind( function( newval ){
			$( 'button, [type="button"], [type="reset"], [type="submit"], .skywp-button, #infinite-handle span' ).css({ 'font-weight': newval });
		});
	});

	// Text Transform
	wp.customize( 'skywp_header_button_text_transform', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'text-transform': newval });
		});
	});

	// Padding
	wp.customize( 'skywp_header_button_padding', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'padding': newval });
		});
	});

	// Color
	wp.customize( 'skywp_header_button_color', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'color': newval });
		});
	});

	// Background
	wp.customize( 'skywp_header_button_bg', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'background': newval });
		});
	});

	// Border
	wp.customize( 'skywp_header_border_button', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'border-width': newval + 'px' });
		});
	});

	// Border Color
	wp.customize( 'skywp_header_border_button_color', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'border-color': newval });
		});
	});

	// Border Radius
	wp.customize( 'skywp_header_border_button_radius', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'border-radius': newval + 'px' });
		});
	});

	// Letter Spasing
	wp.customize( 'skywp_header_button_letter_spacing', function( value ){
		value.bind( function( newval ){
			$( '.skywp-custom-button' ).css({ 'letter-spacing': newval + 'px' });
		});
	});





	/***** CONTENT *****/

	// Background
	wp.customize( 'skywp_post_page_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#content-wrap #primary #main-style article .blog-wrap' ).css({'background': newval} );
		});
	});

	// Title
	wp.customize( 'skywp_post_page_title_color', function( value ) {
		value.bind( function( newval ) {
			$( '#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-title a' ).css({'color': newval} );
		});
	});

	// Meta
	wp.customize( 'skywp_post_page_meta_color', function( value ) {
		value.bind( function( newval ) {
			$( '#content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-meta ul li, #content-wrap #primary #main-style article .blog-wrap .post-content-wrap .entry-meta ul li a' ).css({'color': newval} );
		});
	});

	/* Post Navigation */
	// Color
	wp.customize( 'skywp_article_prev_next_color', function( value ) {
		value.bind( function( newval ) {
			$( '.navigation.post-navigation .nav-links a' ).css({'color': newval} );
		});
	});

	// Background
	wp.customize( 'skywp_article_prev_next_bg', function( value ) {
		value.bind( function( newval ) {
			$( '.navigation.post-navigation .nav-links' ).css({'background': newval} );
		});
	});





	/***** BREADCRUMB *****/

	// Background
	wp.customize( 'skywp_breadcrumb_bg', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb.after-header' ).css({'background': newval} );
		});
	});

	// Padding
	wp.customize( 'skywp_breadcrumb_padding', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb.after-header' ).css({'padding': newval} );
		});
	});

	// Color
	wp.customize( 'skywp_breadcrumb_color', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb .content ul li' ).css({'color': newval} );
		});
	});

	// Font Weight
	wp.customize( 'skywp_breadcrumb_font_weight', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb .content ul li' ).css({'font-weight': newval} );
		});
	});

	// Text Transform
	wp.customize( 'skywp_breadcrumb_text_transform', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb .content ul li' ).css({'text-transform': newval} );
		});
	});

	// Letter Spacing
	wp.customize( 'skywp_breadcrumb_letter_spacing', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb .content ul li' ).css({'letter-spacing': newval +'px'} );
		});
	});

	// Alignment
	wp.customize( 'skywp_breadcrumb_alignment', function( value ) {
		value.bind( function( newval ) {
			if ( 'left' == newval ) {
				$( '.skywp-breadcrumb' ).addClass( 'left' );
			} else {
				$( '.skywp-breadcrumb' ).removeClass( 'left' );
			}
			if ( 'center' == newval ) {
				$( '.skywp-breadcrumb' ).addClass( 'center' );
			} else {
				$( '.skywp-breadcrumb' ).removeClass( 'center' );
			}
			if ( 'right' == newval ) {
				$( '.skywp-breadcrumb' ).addClass( 'right' );
			} else {
				$( '.skywp-breadcrumb' ).removeClass( 'right' );
			}
		});
	});

	// Border bottom color
	wp.customize( 'skywp_breadcrumb_border_color', function( value ) {
		value.bind( function( newval ) {
			$( '.skywp-breadcrumb.after-header.border-bottom' ).css({'border-color': newval} );
		});
	});





	/***** BASE *****/

	// Width
	wp.customize( 'general_width', function( value ) {
		value.bind( function( newval ) {
			$( '.wrapper' ).css({'max-width': newval +'px'} );
		});
	});

	// Font size
	wp.customize( 'font_size_body', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css({'font-size': newval +'px'} );
		});
	});

	// Outer Background
	wp.customize( 'skywp_outer_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#wrap.outer-wrapper' ).css({'background': newval} );
		});
	});

	// Inner Background
	wp.customize( 'skywp_inner_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#content #content-wrap' ).css({'background': newval} );
		});
	});

	// Default color
	wp.customize( 'skywp_default_color', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css({'color': newval} );
		});
	});

	// Links color
	wp.customize( 'skywp_links_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site_widget ul li a, .widget_calendar .calendar_wrap a, #content-wrap  .navigation.post-navigation .nav-links a, #comments .comment-list .comment .comment-body .comment-meta .comment-author .fn, #comments .comment-list .comment .comment-body .comment-meta .comment-author .fn a, #comments .comment-list .comment .comment-body .comment-meta .comment-metadata a, #comments .comment-list .comment .comment-body .reply a, #respond .logged-in-as a, .page-attachment .image-navigation .nav-links a, .page-attachment .entry-footer a' ).css({'color': newval} );
		});
	});





	/***** FOOTER *****/

	// Width
	wp.customize( 'footer_width', function( value ){
		value.bind( function( newval ){
			$( '#footer-wrapper .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Padding
	wp.customize( 'skywp_footer_padding', function( value ){
		value.bind( function( newval ){
			$( '#footer-wrapper' ).css({ 'padding': newval });
		});
	});

	// Background
	wp.customize( 'skywp_footer_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-wrapper' ).css({'background': newval} );
		});
	});

	// Title color
	wp.customize( 'skywp_footer_title_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget h2' ).css({'color': newval} );
		});
	});

	// Border color
	wp.customize( 'skywp_footer_border_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget h2' ).css({'border-color': newval} );
		});
	});

	// Text color
	wp.customize( 'skywp_footer_text_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget, #footer-area .site_widget a, #footer-area .author-theme a' ).css({'color': newval} );
		});
	});

	// Tag cloud border color
	wp.customize( 'skywp_footer_tag_cloud_border_color', function( value ) {
		value.bind( function( newval ) {
			$( '#footer-area .site_widget .tagcloud a' ).css({'border-color': newval} );
		});
	});





	/***** COPYRIGHT *****/

	// Alignment
	wp.customize( 'skywp_copyright_alignment', function( value ){
		value.bind( function( newval ){
			$( '#copyright .container' ).css({ '-webkit-box-pack': newval, '-ms-flex-pack': newval, 'justify-content': newval });
		});
	});

	// Width
	wp.customize( 'footer_copyright_width', function( value ){
		value.bind( function( newval ){
			$( '#copyright .wrapper' ).css({ 'max-width': newval + 'px' });
		});
	});

	// Padding
	wp.customize( 'skywp_footer_padding_copyright', function( value ){
		value.bind( function( newval ){
			$( '#copyright .container' ).css({ 'padding': newval });
		});
	});

	// Background
	wp.customize( 'skywp_copyright_bg', function( value ) {
		value.bind( function( newval ) {
			$( '#copyright' ).css({'background': newval} );
		});
	});


	





} )( jQuery );

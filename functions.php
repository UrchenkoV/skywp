<?php
/**
 * SkyWP-theme functions and definitions.
 *
 *
 * When using a child theme (see https://developer.wordpress.org/themes/basics/theme-functions/ and 
 * http://codex.wordpress.org/Theme_Development and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.7
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core constants
define( 'SKYWP_THEME_VERSIONE', '1.2.7' );
define( 'SKYWP_THEME_DIR', get_template_directory() );
define( 'SKYWP_THEME_URI', get_template_directory_uri() );

	/**
	* Define constants
	*
	* @since 1.0.0
	*/
	function skywp_constants() {

		// CSS and Javascript Paths
		define( 'SKYWP_CSS_DIR_URI', SKYWP_THEME_URI .'/assets/css/' );
		define( 'SKYWP_JS_DIR_URI', SKYWP_THEME_URI .'/assets/js/' );

		// Include Paths
		define( 'SKYWP_INC_DIR', SKYWP_THEME_DIR .'/inc/' );
		define( 'SKYWP_INC_DIR_URI', SKYWP_THEME_URI .'/inc/' );

	}
	add_action( 'after_setup_theme', 'skywp_constants' );

	/**
	* Define setup
	*
	* @since 1.0.0
	*/
	add_action( 'after_setup_theme', 'skywp_setup' );
	function skywp_setup() {

		// Load theme translation
		load_theme_textdomain( 'skywp', SKYWP_THEME_DIR .'/languages' );

		// Get globals
		global $content_width;

		// Set content width based on the theme's default design
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		// Register navigation menus
		register_nav_menus( array(
			'main_menu'       => esc_html__( 'Main Menu', 'skywp' ),
			'social_topbar'	  => esc_html__( 'Social Topbar', 'skywp' ),
		) );

		// Enable support for Post Formats
		//add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );

		// Enable support for <title> tag
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails on posts and pages
		add_theme_support( 'post-thumbnails' );

		// Cropped image
		add_image_size( 'skywp-post-large', 1200, 800, true );
		add_image_size( 'skywp-post-medium', 800, 450, true );
		add_image_size( 'skywp-post-masonry', 800, 9999 );

		// Enable support for header image
		add_theme_support( 'custom-header', apply_filters( 'skywp_custom_header_args', array(
			'width'              => 2000,
			'height'             => 150,
		) ) );


		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 155,
			'height'      => 50,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Switch default core markup for search form, comment form, comments, galleries, captions and widgets to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets',
		) );

		// WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'skywp_custom_background_args', array(
			'default-color' => '#ffffff',
			'default-image' => '',
		) ) );

		// Add editor style
		add_editor_style( 'assets/css/editor-style.min.css' );

		// Declare support for selective refreshing of widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Admin only classes
		if ( is_admin() ) {
			require_once( SKYWP_INC_DIR .'tgm/class-tgm-plugin-activation.php' );
			require_once( SKYWP_INC_DIR .'tgm/custom-tgm-plugin.php' );
		}

	}

	/**
	* Define classes
	*
	* @since 1.0.0
	*/
	add_action( 'after_setup_theme', 'skywp_controls' );
	function skywp_controls() {

		// Customizer additions
		require_once( SKYWP_INC_DIR .'customizer/customizer.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/general.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/topbar.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/header.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/content.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/sidebar.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/footer.php' );
		require_once( SKYWP_INC_DIR .'customizer/sanitization-callbacks.php' );
		require_once( SKYWP_INC_DIR .'customizer/settings/typography.php' );

		// Helper functions
		require_once( SKYWP_INC_DIR .'admin/admin-functions.php' );
		require_once( SKYWP_INC_DIR .'helpers.php' );

		require_once( SKYWP_INC_DIR .'walker/class-walker-nav-menu.php' );
		
		// Register widgets
		require_once( SKYWP_INC_DIR .'widgets/class-sky-widget-recent-comments.php' );
		require_once( SKYWP_INC_DIR .'widgets/class-skywp-728-90-advertisement.php' );

		// Register widget area.
		require_once( SKYWP_INC_DIR . 'widgets/widgets.php' );

		// Actions
		require_once( SKYWP_INC_DIR . 'actions.php' );
	}

/**
 * Adds custom controls
 *
 * @since 1.0.0
 */
add_action( 'customize_register', 'skywp_custom_controls' );
function skywp_custom_controls( $wp_customize ) {

	require_once( SKYWP_THEME_DIR . '/inc/customizer/controls/image-radio-button.php' );
	require_once( SKYWP_THEME_DIR . '/inc/customizer/controls/alpha-color-picker.php' );
	require_once( SKYWP_THEME_DIR . '/inc/customizer/controls/class-control-heading.php' );
	require_once( SKYWP_THEME_DIR . '/inc/customizer/controls/class-control-notice.php' );
	require_once( SKYWP_THEME_DIR . '/inc/customizer/controls/class-control-sortable-pill.php' );

}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require SKYWP_THEME_DIR . '/woocommerce/woocommerce.php';
}


/**
* Custom settings widget tag cloud
*
* @since 1.0.0
*/
add_filter('widget_tag_cloud_args', function( $args ){
	$args['smallest'] = get_theme_mod( 'skywp_tag_font_size', '13' );
	$args['largest'] = get_theme_mod( 'skywp_tag_font_size', '13' );
	$args['unit'] = 'px';

	return $args;
});

/**
* Remove H2 navigation pagination
*
* @since 1.0.0
*/
add_filter('navigation_markup_template', 'skywp_navigation_pagination', 10, 2 );
function skywp_navigation_pagination( $template, $class ){
	return '
	<nav class="navigation %1$s" role="navigation">
	<div class="nav-links">%3$s</div>
	</nav>    
	';
}

/**
* Enqueue comment-reply.js
*
* @since 1.0.0
*/
add_action( 'wp_enqueue_scripts', 'skywp_enqueue_comment_reply' );
function skywp_enqueue_comment_reply() {
	if( is_singular() && comments_open() && (get_option('thread_comments') == 1) ) 
		wp_enqueue_script('comment-reply');
}

/**
* Changing excerpts post
*
* @since 1.1.1
*/
add_filter( 'excerpt_more', 'skywp_excerpt_more' );
function skywp_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '...';
	
}


/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'skywp_scripts_styles' );
function skywp_scripts_styles() {
	// Load standard style file
	wp_enqueue_style( 'skywp-style', get_stylesheet_uri(), [], SKYWP_THEME_VERSIONE );

	// Load plugin mobile menu
	wp_enqueue_style( 'skywp-mobile-nav', get_template_directory_uri() . '/assets/libs/mobile-nav/hc-offcanvas-nav.min.css' );

	// Load font awesome style
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/libs/font-awesome/all.min.css', array(), '5.3.1' );

	// Load main.css file
	wp_enqueue_style( 'skywp-main-style', get_template_directory_uri() . '/assets/css/main.min.css', [], SKYWP_THEME_VERSIONE );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load JQuery
	wp_enqueue_script( 'jquery' );

	// Load plugin Masonry
	if ( 'masonry' == get_theme_mod( 'skywp_post_page_style', 'default' ) ) {
		if ( is_home() || is_archive() || is_singular() ) {
			wp_enqueue_script('masonry');
		}
		if ( class_exists('WooCommerce') ) {
			if ( is_checkout() || is_account_page() || is_cart() ) {
				wp_enqueue_script('masonry');
			}
		}
	}
	
	// Load plugin mobile navigation
	wp_enqueue_script('mobile-nav', get_template_directory_uri() . '/assets/libs/mobile-nav/hc-offcanvas-nav.js', array('jquery'), '', true);

	// Load plugin scrolling pages
	wp_enqueue_script('page-scroll-to-id-master', get_template_directory_uri() . '/assets/libs/page-scroll-to-id-master/jquery.malihu.PageScroll2id.min.js', array('jquery'), '', true);

	// Load main.js
	wp_enqueue_script('skywp-main-script', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), SKYWP_THEME_VERSIONE, true);

}

/**
 * Load scripts in backend
 * 
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'skywp_backend_enqueue_script' );
function skywp_backend_enqueue_script( $hook ) {
	// Admin CSS
	wp_enqueue_style( 'skywp-admin-css', get_template_directory_uri() . '/assets/admin/admin.css', [], SKYWP_THEME_VERSIONE );
	
	if ( 'widgets.php' != $hook ) {
		wp_enqueue_script( 'skywp-admin-js', SKYWP_THEME_URI . '/assets/admin/admin.js', array( 'jquery' ), SKYWP_THEME_VERSIONE, true );
	}
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Build Sky class menu
class Sky_Menu_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'sub-menu' );

		$class_names = join( ' ', apply_filters( 'skywp_nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul>{$n}";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'skywp_nav_menu_item_args', $args, $item, $depth );

		$class_names = $item -> current ? ' class="current-menu-item"' : '';

		$output .= $indent . '<li' . $class_names . '>';

		$atts                 = array();
		$atts['title']        = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target']       = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']          = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		$atts = apply_filters( 'skywp_nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'skywp_the_title', $item->title, $item->ID );

		$title = apply_filters( 'skywp_nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'skywp_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
* Plugin settings One Click Demo Import
*
* @since 1.0.0
*/
add_action( 'pt-ocdi/after_import', 'skywp_ocdi_after_import_setup' );
function skywp_ocdi_after_import_setup() {
    // Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'main_menu' => $main_menu->term_id,
	)
);

    // Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}

add_filter( 'pt-ocdi/plugin_intro_text', 'skywp_ocdi_plugin_intro_text' );
function skywp_ocdi_plugin_intro_text( $default_text ) {

	$link_docs = esc_url( 'https://urchenko.ru/get-started/' );
	$info_text_install_docs = sprintf( esc_html__( 'Use the installation instructions %1$sGo to the documentation%2$s', 'skywp' ), '<a href="'. $link_docs .'" target="_blank">','</a>'
);

	// Database reset url
	if ( is_plugin_active( 'wordpress-database-reset/wp-reset.php' ) ) {
		$plugin_link 	= admin_url( 'tools.php?page=database-reset' );
	} else {
		$plugin_link 	= admin_url( 'plugin-install.php?s=WordPress+Database+Reset&tab=search' );
	}
	$info_text_import_demo = sprintf(esc_html__( 'Importing demo data allow you to quickly edit everything instead of creating content from scratch. It is recommended uploading sample data on a fresh WordPress install to prevent conflicts with your current content. You can use this plugin to reset your site if needed: %1$sWordpress Database Resets%2$s.', 'skywp' ), '<a href="'. $plugin_link .'" target="_blank">','</a>'
);
	$default_text .= '<div class="ocdi__intro-text">' . $info_text_install_docs . '<br><br>' . $info_text_import_demo . '</div>';

	return $default_text;
}

add_filter( 'pt-ocdi/plugin_page_setup', 'skywp_ocdi_plugin_page_setup' );
function skywp_ocdi_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Import Demo Data' , 'skywp' );
	$default_settings['menu_title']  = esc_html__( 'SkyWP Import Demo' , 'skywp' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'one-click-demo-import';

	return $default_settings;
}

// Disable alerts on the brand of the plugin
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
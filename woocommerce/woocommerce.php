<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package skywp
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function skywp_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'skywp_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function skywp_woocommerce_scripts() {
	wp_enqueue_style( 'skywp-woocommerce-style', SKYWP_THEME_URI . '/woocommerce/assets/css/woocommerce.css', [], SKYWP_THEME_VERSIONE );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$skywp_accent_color = esc_attr( get_theme_mod( 'skywp_accent_color', '#00b4ff' ) );


	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'skywp-woocommerce-style', $inline_font );


	$skywp_accent_color = esc_attr( get_theme_mod( 'skywp_accent_color', '#00b4ff' ) );
	$skywp_default_color = esc_attr( get_theme_mod( 'skywp_default_color', '#333333' ) );
	$skywp_links_color_hover = esc_attr( get_theme_mod( 'skywp_links_color_hover', '#0ba6e6' ) );

	$skywp_colors_bg = esc_attr( get_theme_mod( 'skywp_colors_bg', '#fafafa' ) );
	$skywp_colors_border = esc_attr( get_theme_mod( 'skywp_colors_border', '#e4e4e4' ) );

	// Button
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

	$woo_css = "

		/***General  ***/
		.site-header-cart .widget_shopping_cart_content .woocommerce-mini-cart__total .woocommerce-Price-amount,
		.sidebar .widget_shopping_cart .woocommerce-mini-cart__total .amount,
		.woocommerce ul.product-categories>li ul li:before,
		.woocommerce-products-header .page-title,
		.CardNumberField-input-wrapper input.InputElement,
		.CardField-child input.InputElement { 
			color: $skywp_accent_color; }

		.woocommerce table.shop_table thead,
		.woocommerce .cart-collaterals .cart_totals h2,
		.site-header-cart .widget_shopping_cart,
		.woocommerce .select2-container .select2-selection--single,
		.woocommerce select,
		.woocommerce-error,
		.woocommerce-message,
		.woocommerce-info,
		.woocommerce-account .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link.is-active a,
		.woocommerce-MyAccount-content .col2-set .woocommerce-Address-title,
		.payment_method_woocommerce_payments #wcpay-card-element,
		.woocommerce .woocommerce-customer-details .woocommerce-column__title { background: $skywp_colors_bg; }

		.woocommerce .woocommerce-table--order-downloads tbody tr td,
		.woocommerce .woocommerce-table--order-details tbody tr td,
		.woocommerce .shop_table tbody tr td,
		.woocommerce table.woocommerce-table--order-downloads,
		.woocommerce table.woocommerce-table--order-details,
		.woocommerce table.shop_table,
		.woocommerce .cart-collaterals .cart_totals h2,
		.woocommerce .cart-collaterals .cart_totals,
		.woocommerce .cart-collaterals .cart_totals .shop_table tr th,
		.woocommerce .cart-collaterals .cart_totals .shop_table tr td,
		.site-header-cart .widget_shopping_cart,
		.site-header-cart .widget_shopping_cart_content .woocommerce-mini-cart__total,
		.site-header-cart ul.product_list_widget li.mini_cart_item,
		.woocommerce .select2-container .select2-selection--single,
		.woocommerce select,
		.woocommerce .woocommerce-checkout #order_review_heading,
		.woocommerce .woocommerce-checkout .woocommerce-checkout-review-order,
		.woocommerce .woocommerce-checkout .woocommerce-billing-fields h3,
		.woocommerce-checkout .woocommerce-additional-fields h3,
		.woocommerce .woocommerce-checkout .woocommerce-checkout-review-order table.shop_table thead tr th,
		.woocommerce .woocommerce-checkout .woocommerce-checkout-review-order table.shop_table tfoot tr th,
		.woocommerce .woocommerce-checkout .woocommerce-checkout-review-order table.shop_table tfoot tr td,
		.woocommerce-account .woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link,
		.woocommerce-MyAccount-content .col2-set .woocommerce-Address-title,
		.woocommerce-MyAccount-content .woocommerce-Address,
		.woocommerce-MyAccount-content .woocommerce-EditAccountForm fieldset,
		.woocommerce .woocommerce-form-login, .woocommerce .woocommerce-form-register,
		.woocommerce #payment .payment_methods li .payment_box.payment_method_woocommerce_payments fieldset,
		.payment_method_woocommerce_payments #wcpay-card-element,
		.woocommerce ul.order_details li:not(:last-child),
		.woocommerce .woocommerce-table--order-details tfoot tr th, .woocommerce .woocommerce-table--order-details tfoot tr td,
		.woocommerce .woocommerce-customer-details address,
		.woocommerce .woocommerce-customer-details .woocommerce-column__title { border-color: $skywp_colors_border; }

		.woocommerce table.shop_table tbody td.product-remove a.remove { color: $skywp_colors_border; }

		/*** Button ***/
		.site-header-cart ul.product_list_widget li.mini_cart_item a { color: $skywp_default_color; }
		.site-header-cart ul.product_list_widget li.mini_cart_item a:hover,
		.sidebar .widget_shopping_cart ul.product_list_widget li a.remove:hover,
		.woocommerce table.shop_table tbody td.product-remove a.remove:hover { color: $skywp_links_color_hover; }

		.woocommerce a.button,
		.site-header-cart .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button,
		.sidebar .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button,
		ul.products li.product a.button,
		a.added_to_cart {
			font-size: $skywp_buttons_font_size;
			font-weight: $skywp_buttons_font_weight;
			letter-spacing: $skywp_buttons_letter_spacing;
			color: $skywp_buttons_link_color;
			background: $skywp_buttons_bg_color;
			padding: $skywp_theme_buttons_padding;
			border: $skywp_border_buttons solid $skywp_border_buttons_color;
			border-radius: $skywp_border_buttons_radius;
			text-transform: $skywp_buttons_text_transform; }
			
		.woocommerce a.button:hover,
		.woocommerce a.button:focus,
		.site-header-cart .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button:hover,
		.site-header-cart .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button:focus,
		.sidebar .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button:hover,
		.sidebar .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button:focus,
		ul.products li.product a.button:hover,
		ul.products li.product a.button:focus,
		a.added_to_cart:hover,
		a.added_to_cart:focus { color: $skywp_buttons_link_color_hover; background: $skywp_buttons_bg_color_hover; 
		border: $skywp_border_buttons solid $skywp_border_buttons_color_hover; }

		/***  ***/
		.widget_price_filter .ui-slider .ui-slider-handle,
		.widget_price_filter .ui-slider .ui-slider-range { background: $skywp_accent_color; }

		/*** Product on the shop page ***/
		ul.products li.product .skywp-shop-summary-wrapper a.skywp-loop-product__link { color: $skywp_default_color; }
		ul.products li.product .skywp-shop-summary-wrapper a.skywp-loop-product__link:hover { color: $skywp_links_color_hover; }

		/*** Onsale ***/
		.woocommerce .product .onsale { color: $skywp_buttons_link_color; background: $skywp_accent_color; }

		/*** Pagination ***/
		.woocommerce-pagination .page-numbers li .page-numbers.current { color: $skywp_buttons_link_color_hover; background: $skywp_buttons_bg_color; }
		.woocommerce-pagination .page-numbers li .page-numbers { color: $skywp_buttons_bg_color; border-color: $skywp_buttons_bg_color; }
		.woocommerce-pagination .page-numbers li .page-numbers:hover { color: $skywp_buttons_link_color_hover; background: $skywp_buttons_bg_color; }

		/*** Breadcrumb ***/
		.woocommerce-breadcrumb,
		.woocommerce-breadcrumb a { color: $skywp_default_color; }

		/*** Tabs ***/
		.woocommerce-tabs ul.tabs li a { color: $skywp_default_color; }
		.woocommerce-tabs ul.tabs li.active:before { background: $skywp_accent_color; }

		/*** Star rating ***/
		.woocommerce .star-rating:before,
		.woocommerce .star-rating span:before,
		.woocommerce p.stars a:before,
		.woocommerce p.stars a:hover ~ a:before,
		.woocommerce p.stars:hover a:before,
		.woocommerce p.stars.selected a.active:before,
		.woocommerce p.stars.selected a.active ~ a:before,
		.woocommerce p.stars.selected a:not(.active):before { color: $skywp_accent_color; }

		/*** Notices ***/
		.woocommerce-message,
		.woocommerce-info { border-color: $skywp_accent_color; }
		

	";
	wp_add_inline_style( 'skywp-woocommerce-style', $woo_css );

}
add_action( 'wp_enqueue_scripts', 'skywp_woocommerce_scripts' );


/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function skywp_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'skywp_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function skywp_woocommerce_products_per_page() {
	return 12;
}
//add_filter( 'loop_shop_per_page', 'skywp_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function skywp_woocommerce_thumbnail_columns() {
	return 4;
}
//add_filter( 'woocommerce_product_thumbnails_columns', 'skywp_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function skywp_woocommerce_loop_columns() {
	return 4;
}
//add_filter( 'loop_shop_columns', 'skywp_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function skywp_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
//add_filter( 'woocommerce_output_related_products_args', 'skywp_woocommerce_related_products_args' );

if ( ! function_exists( 'skywp_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function skywp_woocommerce_product_columns_wrapper() {
		$columns = skywp_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'skywp_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'skywp_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function skywp_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'skywp_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

if ( ! function_exists( 'skywp_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function skywp_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'skywp_woocommerce_wrapper_before' );

if ( ! function_exists( 'skywp_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function skywp_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'skywp_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'skywp_woocommerce_header_cart' ) ) {
			skywp_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'skywp_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function skywp_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		skywp_woocommerce_cart_link();
		$fragments['a.cart-content'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'skywp_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'skywp_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 * 
	 * @return void
	 */
	function skywp_woocommerce_cart_link() {
		?>
		<a class="cart-content" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'skywp' ); ?>">
			
			<span class="count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'skywp_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function skywp_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = 'cart-link';
		}
		?>
		<div id="site-header-cart" class="site-header-cart">
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php skywp_woocommerce_cart_link(); ?>
			</div>
			<div class="header-cart-data">
				<?php
				$instance = array(
					'title' => '',
				);
				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</div>
		</div>
		<?php
	}
}

// Removing price by default on the shop page
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

// Removing rating by default on the shop page
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Removing title by default on the shop page
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Removing sale notice by default on the shop page
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

// Removing breadcrumbs by default on the product page
add_action( 'template_redirect', 'skywp_remove_woo_breadcrumb' );
function skywp_remove_woo_breadcrumb() {
	if ( is_product() ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	}
}

// Wrapper image product on the shop page
add_action( 'woocommerce_before_shop_loop_item', 'skywp_template_loop_product_image_open', 9 );
if ( ! function_exists( 'skywp_template_loop_product_image_open' ) ) {
	function skywp_template_loop_product_image_open() {

		echo '<div class="skywp-shop-thumbnail-wrapper">';
	}
}

// Wrapper image product on the shop page
add_action( 'woocommerce_after_shop_loop_item', 'skywp_template_loop_product_image_close', 6 );
if ( ! function_exists( 'skywp_template_loop_product_image_close' ) ) {
	function skywp_template_loop_product_image_close() {

		echo '</div>';
	}
}

// Wrapper summary product on the shop page
add_action( 'woocommerce_after_shop_loop_item', 'skywp_template_loop_product_summary_open', 7 );
if ( ! function_exists( 'skywp_template_loop_product_summary_open' ) ) {
	function skywp_template_loop_product_summary_open() {

		echo '<div class="skywp-shop-summary-wrapper">';
	}
}

// Wrapper summary product on the shop page
add_action( 'woocommerce_after_shop_loop_item', 'skywp_template_loop_product_summary_close', 11 );
if ( ! function_exists( 'skywp_template_loop_product_summary_close' ) ) {
	function skywp_template_loop_product_summary_close() {

		echo '</div>';
	}
}

// Adding a title wrapped with a link on the shop page
add_action( 'woocommerce_after_shop_loop_item', 'skywp_woo_template_loop_product_title', 8 );
if ( ! function_exists( 'skywp_woo_template_loop_product_title' ) ) {
	function skywp_woo_template_loop_product_title() {

		echo '<a href="' . esc_url( get_the_permalink() ) . '" class="skywp-loop-product__link">';
			woocommerce_template_loop_product_title();
		echo '</a>';
	}
}

// Adding a price on the shop page
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 8.5 );

// Adding a rating on the shop page
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 8.7 );

// Adding a sale flash on the shop page
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9.5 );

// Adding breadcrumb on the product page
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 4 );

// Remove heading in tabs in a content single product.
add_filter('woocommerce_product_description_heading', '__return_null');
add_filter('woocommerce_product_additional_information_heading', '__return_null');
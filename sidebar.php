<?php
/**
 * Sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @version 1.2.3
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'WooCommerce' ) ) {
	if ( is_active_sidebar( 'main-sidebar' ) ) { ?>

			<aside id="main-sidebar" class="sidebar widget-area">

				<?php dynamic_sidebar( 'main-sidebar' ); ?>

			</aside>

		<?php
	}
} else {
	if ( is_active_sidebar( 'main-sidebar' ) ) {
		if ( !is_cart() && !is_shop() && !is_product() && !is_checkout() && !is_account_page() && !is_tax() ) { ?>

			<aside id="main-sidebar" class="sidebar widget-area">

				<?php dynamic_sidebar( 'main-sidebar' ); ?>

			</aside>

		<?php }
	}

	if ( is_active_sidebar( 'woocommerce-sidebar' ) ) {
		if ( is_shop() || is_cart() || is_checkout() || is_account_page() || is_tax() ) { ?>

			<aside id="woocommerce-sidebar" class="sidebar widget-area">

				<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>

			</aside>

		<?php }
	}

	if ( is_active_sidebar( 'product-sidebar' ) ) {
		if ( is_product() ) { ?>

			<aside id="woocommerce-sidebar" class="sidebar widget-area">

				<?php dynamic_sidebar( 'product-sidebar' ); ?>

			</aside>

		<?php }
	}
}






<?php
/**
* Main Header layout
*
* @package Urchenko
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.2.3
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header id="site-header" class="<?php skywp_header_classes(); ?>">

	<div id="top-header-inner" class="wrapper">
		<?php
		/**
		 * Hook: skywp_header_logo
		 *
		 * @hooked skywp_header_wrapper_banner_start - 5
		 * @hooked skywp_header_template_logo - 10
		 */
		do_action( 'skywp_header_logo' );

		/**
		 * Hook: skywp_header_banner
		 *
		 * @hooked skywp_header_template_banner - 10
		 * @hooked skywp_header_wrapper_banner_end - 20
		 */
		do_action( 'skywp_header_banner' );

		/**
		 * Hook: skywp_header_navigation
		 *
		 * @hooked skywp_header_banner_wrapper_menu_start - 5
		 * @hooked skywp_header_template_navigation - 10
		 */
		do_action( 'skywp_header_navigation' );

		/**
		 * Hook: skywp_right_header_item_template
		 *
		 * @hooked skywp_right_header_item_wrapper_start - 10
		 * @hooked skywp_right_header_item_search - 20
		 * @hooked skywp_right_header_item_button - 30
		 * @hooked skywp_right_header_item_text_html - 40
		 * @hooked skywp_right_header_item_widget - 50
		 * @hooked skywp_right_header_item_woocommerce - 60
		 * @hooked skywp_right_header_item_wrapper_end - 100
		 * @hooked skywp_header_banner_wrapper_menu_end - 110
		 */
		do_action( 'skywp_right_header_item_template' );
		?>
	</div>
</header>















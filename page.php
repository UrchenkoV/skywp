<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */

get_header();

if ( !class_exists( 'WooCommerce' ) ) {
	if ( get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
		get_sidebar();
	}
} else {
	if ( is_cart() || is_account_page() || is_checkout() ) {
		if ( get_theme_mod( 'skywp_woocommerce_sidebar', 'no-sidebar' ) == 'sidebar-left' ) :
			get_sidebar();
		endif;
	} else {
		if ( get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
			get_sidebar();
		}
	}
}
?>

<div id="primary" class="content-area">

	<div id="page-content" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
		endif;

		endwhile; // End of the loop.
		?>

	</div><!-- #page-content -->

</div><!-- #primary -->

<?php
if ( !class_exists( 'WooCommerce' ) ) {
	if ( get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
		get_sidebar();
	}
} else {
	if ( is_cart() || is_account_page() || is_checkout() ) {
		if ( get_theme_mod( 'skywp_woocommerce_sidebar', 'no-sidebar' ) == 'sidebar-right' ) :
			get_sidebar();
		endif;
	} else {
		if ( get_theme_mod( 'skywp_pages_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
			get_sidebar();
		}
	}
}
?>


<?php get_footer(); ?>

<?php
/**
 * The header for our theme
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */ 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="outer-wrap" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'skywp' ); ?></a>

		<div id="wrap" class="<?php skywp_content_class() ?>">

			<?php
			do_action( 'skywp_custom_header' );

			do_action( 'skywp_topbar' );

			do_action( 'skywp_header' );

			/**
			 * Hook: skywp_breadcrumb_header
			 *
			 * @hooked skywp_breadcrumb_after_header_layout - 10
			 */
			do_action( 'skywp_breadcrumb_header' );
			?>

			<div id="content" class="site-content">

				<?php
				do_action( 'skywp_outer_content_wrapper_before' );
				?>

				

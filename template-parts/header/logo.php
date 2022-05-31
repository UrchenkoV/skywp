<?php
/**
* Header logo
*
* @package Urchenko
* @subpackage SkyWP WordPress theme
* @since SkyWP 1.2.4
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="site-logo" class="logo">

	<?php
	if ( get_theme_mod( 'skywp_logo_full_width_page', false ) == true && is_page_template( 'template-parts/full-width-page.php' ) ) {
	 	if ( has_custom_logo() ) {
	 	?>
	 		<div id="site-logo-inner" class="logo">
	 			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
				<?php
				$skywp_logo = get_theme_mod( 'skywp_logo_absolute' );
				echo wp_get_attachment_image( $skywp_logo, [155, 60] );
				?>
				</a>
			</div>
		<?php
	 	}
	 } else {
	 	if ( has_custom_logo() ) {
	 	?>
	 		<div id="site-logo-inner" class="logo">
				<?php the_custom_logo() ?>
			</div>
		<?php
	 	}
	 }
	 ?>

	<?php if ( display_header_text() ) { ?>
		<div class="branding-text">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>

			<p class="site-description"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
		</div>
	<?php } ?>
	
</div>
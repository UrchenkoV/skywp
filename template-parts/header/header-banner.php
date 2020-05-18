<?php
/**
* Header banner
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

<div id="header-banner" class="clr">

	<?php
	if ( is_active_sidebar( 'header-banner' ) ) {
		dynamic_sidebar( 'header-banner' );
	}
	else if ( current_user_can( 'edit_theme_options' ) ) { ?>
		<div class="no-widget">
			<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
				<?php esc_html_e( 'Add Widget', 'skywp' ); ?>
			</a>
		</div>
	<?php
	}
	?>
	
</div>
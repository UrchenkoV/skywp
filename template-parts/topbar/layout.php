<?php
/**
* Topbar layout
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

<div id="topbar-wrap" class="<?php skywp_topbar_classes(); ?>">

	<div id="topbar" class="wrapper">

		<div id="topbar-inner" class="topbar-inner">

			<?php
			/**
			 * Hook: skywp_topbar_layout
			 *
			 * @hooked skywp_topbar_column_layout - 10
			 */
			do_action( 'skywp_topbar_layout' );
			?>
			
		</div><!-- topbar-inner -->
		
	</div><!-- topbar -->
	
</div>

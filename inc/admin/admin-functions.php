<?php
/**
 * SkyWP Admin Functions
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.4
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A notification asking you to put a 5-star rating on the theme.
 */
add_action( 'admin_notices', 'skywp_show_notice' );
function skywp_show_notice() {

	$user_id = get_current_user_id();
	$time = time();
	$user_clicked_maybe_later = get_user_meta( $user_id, 'skywp_user_clicked_maybe_later', true ); // The time where the user clicks.
	$user_clicked_close_notice = get_user_meta( $user_id, 'skywp_user_clicked_close_notice', true ); // The time where the user clicks.

	if ( $user_clicked_maybe_later == '' ) {
		$user_clicked_maybe_later = 0;
	}
	if ( $user_clicked_close_notice == '' ) {
		$user_clicked_close_notice = 0;
	}
	
	$fifteen_days = 1296000; // 15 days in seconds.
	$month_in_seconds = 2592000; // 30 days in seconds.

	if ( (($time - $user_clicked_maybe_later) < $fifteen_days) || (($time - $user_clicked_close_notice) < $month_in_seconds) ) {
		return;
	}
	?>
	<div id="theme-rating" class="notice is-dismissible">
		<p class="notice-container"></p>
		<div class="notice-content">
			<div class="notice-heading">
				<?php esc_html_e( 'Hello! Seems like you have used SkyWP theme to build this website - Thanks a ton!', 'skywp' ); ?>
			</div>
			<?php esc_html_e( 'Could you please do us a big favor and give it a 5-star rating on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the SkyWP theme.', 'skywp' ); ?>
			<div class="links-container">

				<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/skywp/reviews/?filter=5#new-post' ); ?>" class="button-primary" target="_blank"><?php esc_html_e( 'Sure!', 'skywp' ); ?></a>

				<span class="dashicons dashicons-calendar-alt"></span>
				<a href="?skywp_maybe_later=15" class="notice-close"><?php esc_html_e( 'Maybe later', 'skywp' ); ?></a>
				
				<span class="dashicons dashicons-smiley"></span>
				<a href="?skywp_close_notice=30" class="notice-close"><?php esc_html_e( 'I already did', 'skywp' ); ?></a>
			</div>
		</div>
		<p></p>
	</div>
	<?php
}

/**
 * Tracking how the user clicks on the button.
 */
add_action( 'admin_init', 'skywp_user_clicked_on_button' );
function skywp_user_clicked_on_button() {

	$user_id = get_current_user_id();
	$time = time();
	//delete_user_meta($user_id, 'skywp_user_clicked_maybe_later');
	//delete_user_meta($user_id, 'skywp_user_clicked_close_notice');
	
	if ( isset( $_GET['skywp_maybe_later'] ) == 15 ) {
		update_user_meta( $user_id, 'skywp_user_clicked_maybe_later', $time );
	}
	elseif ( isset( $_GET['skywp_close_notice'] ) == 30 ) {
		update_user_meta( $user_id, 'skywp_user_clicked_close_notice', $time );
	}
}
<?php
/**
 * Breadcrumb
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
<div class="<?php skywp_breadcrumb_class() ?>">
	<?php
	/**
	 * Hook: skywp_breadcrumb_wrapper_start
	 *
	 * @hooked skywp_breadcrumb_wrapper_layout_start - 10
	 */
	do_action( 'skywp_breadcrumb_wrapper_start' );
	?>
	<div class="content">
		<?php
		$skywp_home = get_theme_mod( 'skywp_breadcrumb_link_home', 'Home' );

		if ( is_archive() ) {
			add_filter( 'get_the_archive_title', function( $title ){
				return preg_replace('~^[^:]+: ~', '', $title );
			});
			?>
			<ul>
				<li class="home separator">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php echo wp_kses( $skywp_home, 'post' ); ?>
					</a>
				</li>
				<li>
					<?php the_archive_title() ?>
				</li>
			</ul>
			<?php
		}

		if ( is_single() ) {  ?>
			<ul>
				<li class="home separator">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php echo wp_kses( $skywp_home, 'post' ); ?>
					</a>
				</li>
				<?php if ( get_the_category( $post->ID ) ) :
					$skywp_category = get_the_category();
					$skywp_cat = $skywp_category[0];
					$skywp_id = $skywp_cat->cat_ID;
					$skywp_name = $skywp_cat->cat_name;
					$skywp_link = get_category_link( $skywp_id );
					?>
					<li class="separator">
						<a href="<?php echo esc_url( $skywp_link ); ?>">
							<?php $skywp_cat = get_the_category( $post->ID ); echo esc_html( $skywp_name ); ?>
						</a>
					</li>
				<?php endif; ?>
				<li><?php single_post_title(); ?></li>
			</ul>
		<?php
		}

		if ( is_page() ) {
			?>
			<ul>
				<li class="home separator">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php echo wp_kses( $skywp_home, 'post' ); ?>
					</a>
				</li>

				<li><?php single_post_title(); ?></li>
			</ul>
			<?php
		}

		if ( is_404() ) {
			?>
			<ul>
				<li class="home separator">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php echo wp_kses( $skywp_home, 'post' ); ?>
					</a>
				</li>
				<li><?php esc_html_e( '404 Not Found', 'skywp' ); ?></li>
			</ul>
			<?php
		}

		if ( is_search() ) {
			?>
			<ul>
				<li class="home separator">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php echo wp_kses( $skywp_home, 'post' ); ?>
					</a>
				</li>
				<li><?php esc_html_e( 'Search results for', 'skywp' ); ?> "<?php echo get_search_query(); ?>"</li>
			</ul>
			<?php
		}

		// Home Page
		if ( is_front_page() ) {
			?>
			<ul>
				<li class="home">
					<?php echo wp_kses( $skywp_home, 'post' ); ?>
				</li>
			</ul>
			<?php
		}

		// Blog / Posts Page
		if ( is_home() && !is_front_page() ) {
			?>
			<ul>
				<li class="home separator">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php echo wp_kses( $skywp_home, 'post' ); ?>
					</a>
				</li>

				<li>
					<?php echo esc_html( get_the_title( get_option( 'page_for_posts', true ) ) ); ?>
				</li>
			</ul>
			<?php
		}
		?>
	</div>
	<?php
	/**
	 * Hook: skywp_breadcrumb_wrapper_end
	 *
	 * @hooked skywp_breadcrumb_wrapper_layout_end - 10
	 */
	do_action( 'skywp_breadcrumb_wrapper_end' );
	?>
</div>
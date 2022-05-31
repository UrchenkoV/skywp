<?php

/**
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */

get_header();

if ( get_theme_mod( 'skywp_default_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
	get_sidebar();
} ?>

<div id="primary" class="content-area">

	<div class="content-wrapper page-attachment <?php echo esc_attr( skywp_select_post_style() .' '. skywp_number_columns_posts() ); ?>">

		<?php
		// Start the loop.
		while (have_posts()) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php
				/**
				 * Hook: skywp_breadcrumb_before_title
				 *
				 * @hooked skywp_breadcrumb_before_title_layout - 10
				 */
				do_action( 'skywp_breadcrumb_before_title' );
				?>

				<header class="entry-header">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				</header>

				<div class="entry-content">
					<div class="entry-attachment">
						<?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?>
					</div>
				</div>

				<footer class="entry-footer">

					<?php
						// Retrieve attachment metadata.
						$metadata = wp_get_attachment_metadata();
						if ($metadata) {
							printf(
								'<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
								esc_html_x('Full size', 'Used before full size attachment link.', 'skywp'),
								esc_url(wp_get_attachment_url()),
								absint($metadata['width']),
								absint($metadata['height'])
							);
						}
						?>
					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								__('Edit<span class="screen-reader-text"> "%s"</span>', 'skywp'),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
				</footer>

				<nav id="image-navigation" class="navigation image-navigation">
					<div class="nav-links">
						<div class="nav-previous"><?php previous_image_link(false, __('Previous Image', 'skywp')); ?></div>
						<div class="nav-next"><?php next_image_link(false, __('Next Image', 'skywp')); ?></div>
					</div>
				</nav>

			</article><!-- #post-<?php the_ID(); ?> -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) {
				comments_template();
			}


		// End the loop.
		endwhile;
		?>

	</div><!-- .content-wrapper -->

</div><!-- #primary -->

<?php if ( get_theme_mod( 'skywp_default_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
	get_sidebar();
} ?>

<?php get_footer(); ?>
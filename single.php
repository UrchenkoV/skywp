<?php
/**
 * The template for displaying all single posts
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.2.3
 */

get_header();
?>

	<?php if ( get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
		get_sidebar();
	} ?>

	<div id="primary" class="content-area single-page">

		<div id="single-content" class="article-page">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				the_post_navigation( [
					'next_text' => '%title <span class="right-arrow">&#8594</span>',
					'prev_text' => '<span class="left-arrow">&#8592</span> %title'
				] );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div><!-- #single-content -->

	</div><!-- #primary -->

	<?php if ( get_theme_mod( 'skywp_articles_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
		get_sidebar();
	} ?>


<?php get_footer(); ?>



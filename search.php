<?php
/**
 * The template for displaying search results pages
 *
 * @package Urchenko
 * @subpackage SkyWP WordPress theme
 * @since SkyWP 1.0.0
 */

get_header();
?>
<?php if ( get_theme_mod( 'skywp_search_page_sidebar', 'sidebar-right' ) == 'sidebar-left' ) {
	get_sidebar();
} ?>
	
	<div id="primary" class="content-area page-search">

		<main id="main-style" class="page-search blog-page">

			<?php if ( have_posts() ) { ?>
			<div class="content-wrapper <?php echo esc_attr( skywp_select_post_style() .' '. skywp_number_columns_posts() ); ?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'search' );

				endwhile; ?>
			</div><!-- .content-wrapper -->
			<?php } else {
				get_template_part( 'template-parts/content', 'none' );
			} ?>
				
			<?php the_posts_pagination(
				array(
					'show_all'     => true, // shows all pages in pagination involved
					'end_size'     => 1,     // number of pages at ends
					'mid_size'     => 1,     // number of pages around the current page
					'prev_next'    => true,  // whether to display side links "previous/next page".
					'prev_text'    => '<i class="fas fa-chevron-left"></i>',
					'next_text'    => '<i class="fas fa-chevron-right"></i>',
				)
			); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php if ( get_theme_mod( 'skywp_search_page_sidebar', 'sidebar-right' ) == 'sidebar-right' ) {
	get_sidebar();
} ?>

<?php get_footer(); ?>

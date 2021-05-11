<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Holo
 */

get_header();
?>

<?php get_sidebar(); ?>

    <main id="primary" class="c-main">

        <div class="c-main__header">
			<?php
			the_archive_title( '<h1 class="c-main__title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
        </div>

        <div class="c-main__wrapper">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
                <header>
                    <h1 class="c-main__title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
			?>
            <div class="c-pagination s-pagination">
				<?php
				holo_posts_pagination();
				?>
            </div>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
        </div>

<?php
get_footer();

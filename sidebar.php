<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Holo
 */

if ( ! get_theme_mod('show_sidebar', true) ) {
	return;
}
?>
<aside class="c-sidebar js-sidebar">
    <button class="c-sidebar__toggle js-sidebar-toggle" aria-label="<?php echo esc_attr_e('Toggle Sidebar', 'holo'); ?>">
        <svg class="c-sidebar__toggle__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><path d="M160 216a7.975 7.975 0 0 1-5.657-2.343l-80-80a8 8 0 0 1 0-11.314l80-80a8 8 0 0 1 11.314 11.314L91.314 128l74.343 74.343A8 8 0 0 1 160 216z"/><rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)" /></svg>
    </button>
	<?php
	$sticky_posts_id = get_option( 'sticky_posts' );

	$sticky_posts_args = array(
		'posts_per_page'      => get_option( 'posts_per_page' ),
		'post__in'            => $sticky_posts_id,
		'ignore_sticky_posts' => 0,
	);

	$sticky_posts = new WP_Query( $sticky_posts_args );


	if ( $sticky_posts->have_posts() ) :

		echo "<span class='c-sidebar__title'>". esc_html__('Pinned', 'holo') ."</span>";
		?>
        <div class="c-sidebar__main">
			<?php
			/* Start the Loop */
			while ( $sticky_posts->have_posts() ) :
				$sticky_posts->the_post();
				get_template_part( 'template-parts/content', 'archive' );
				wp_reset_query();
			endwhile; ?>
        </div>
	<?php

	endif;

	$args = array(
		'posts_per_page'      => get_option( 'posts_per_page' ),
		'post__not_in'            => $sticky_posts_id,
		'ignore_sticky_posts' => 1,
	);

	$recent_posts = new WP_Query( $args );
	?>
	<?php
	if ( $recent_posts->have_posts() ) :

		echo "<span class='c-sidebar__title c-sidebar__title--other'>". esc_html__('Other', 'holo') ."</span>"; ?>
        <div class="c-sidebar__main">
			<?php
			/* Start the Loop */
			while ( $recent_posts->have_posts() ) :
				$recent_posts->the_post();
				get_template_part( 'template-parts/content', 'archive' );
				wp_reset_query();
			endwhile; ?>
        </div> <?php
	endif;
	?>
    <div class="c-sidebar__footer">
        <a class="c-btn c-btn--secondary c-btn--fw" href="<?php echo esc_url(holo_get_blog_posts_page_url()); ?>"><?php esc_html_e('All Posts', 'holo'); ?></a>
    </div>
</aside>

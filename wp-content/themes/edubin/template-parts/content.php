<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edubin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'edubin-single-post edu-blog' ); ?>>
	<?php
	
	/**
	* edubin_single_post_thumbnail_before hook
	*
	* @hooked edubin_single_post_thumbnail_before_content - 10
	*/

	edubin_post_thumbnail(); 

	do_action( 'edubin_single_post_thumbnail_before' );
	

	?>

	<div class="entry-content">
		<?php
		if ( is_single() ) :
			/**
			 * edubin_single_post_before hook
			 *
			 */
			do_action( 'edubin_single_post_before' );

			the_content( sprintf(
				/* translators: %s: Name of current post. Only visible to screen readers */
				wp_kses( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'edubin' ), array( 'span' => array( 'class' => array() ) ) ),
				get_the_title()
			) );

			if ( function_exists( 'edubin_link_pages' ) ) :
				edubin_link_pages( array(
					'before' => '<nav class="edubin-theme-page-links">' . __( 'Pages:', 'edubin' ) . '<ul class="pager">',
					'after'  => '</ul></nav>',
				) );
			else :
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'edubin' ),
					'after'  => '</div>',
				) );
			endif;
			
			/**
			 * edubin_single_post_after hook
			 *
			 * @hooked edubin_single_post_after_cats_social_share - 10
			 * @hooked edubin_single_post_after_author_bio - 15
			 * @hooked edubin_post_nav_prev_next - 20
			 */
			do_action( 'edubin_single_post_after' );
		else :
			the_excerpt();
		endif;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edubin_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

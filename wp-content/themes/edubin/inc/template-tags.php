<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Edubin
 */

if ( ! function_exists( 'edubin_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function edubin_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) :
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		endif;

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'edubin' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'edubin_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function edubin_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'edubin' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'edubin_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function edubin_entry_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'edubin' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		endif;

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'edubin' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'edubin_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function edubin_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ( ! has_post_thumbnail() && ! get_the_post_thumbnail_url() ) ) :
			return;
		endif;

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'edubin-post-thumb', array(
				'alt' => the_title_attribute( array(
					'echo' => false
				) )
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


/**
 * Thumbnail alt attribute text
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_thumbanil_alt_text' ) ) :
	function edubin_thumbanil_alt_text( $image_id ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        $alt_text = $title = apply_filters( 'edubin_thumbanil_alt_default_text', __( 'Post Thumb', 'edubin' ) );
		$post_item = get_post( $image_id );

		if ( NULL !== $post_item ) :
			$title = $post_item->post_title;
		endif;

        if ( $alt ) :
            $alt_text = $alt;
        else :
            $alt_text = $title;
        endif;

		return $alt_text;
	}
endif;

/**
 * Get tags meta
 *
 * @return string
 */
if ( ! function_exists( 'edubin_entry_meta_tags' ) ) :
	function edubin_entry_meta_tags() {
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) :
			return sprintf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'edubin' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		endif;

		return '';
	}
endif;


// Posted author
if ( ! function_exists( 'edubin_posted_author' ) ) :
/**
 * Prints HTML with meta information for the current author
 */
function edubin_posted_author() {

	// Get the author name; wrap it in a link.
	$useravatar = get_avatar( get_the_author_meta( 'ID' ), 32 );
	// Get the author name; wrap it in a link.
	$byline = sprintf(
		
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ). '</a>'
	);
	
	// Finally, let's write all of this to the page.
	echo '<li class="byline list-inline-item"><span class="author vcard">' . $useravatar, $byline . '</li></span>';
}
endif;

/**
 * Single Post Before Content
 *
 * @since 1.0.0
 */
add_action( 'edubin_single_post_thumbnail_before', 'edubin_single_post_thumbnail_before_content', 10 );
function edubin_single_post_thumbnail_before_content() {

	$blog_comment_short_text  = Edubin::setting( 'blog_comment_short_text' );
	$blog_single_author_show  = Edubin::setting( 'blog_single_author_show' );
	$blog_single_author_bio_show  = Edubin::setting( 'blog_single_author_bio_show' );
	$blog_single_date_show  = Edubin::setting( 'blog_single_date_show' );
	$blog_single_category_show  = Edubin::setting( 'blog_single_category_show' );
	$blog_single_comment_show  = Edubin::setting( 'blog_single_comment_show' );

	echo '<div class="blog-details-top">';

		// if ( edubin_category_by_id( get_the_ID() ) ) :
		// 	echo '<span class="edubin-post-cat">' . wp_kses_post( edubin_category_by_id( get_the_ID(), 'category' ) ) . '</span>';
		// endif;

		//the_title( '<h3 class="post-main-title">', '</h3>' );

		echo '<ul class="blog-meta">';

           if ( 'post' === get_post_type() && $blog_single_author_show ): edubin_posted_author(); endif;

	 		if ( $blog_single_date_show ) {
				echo '<li>';
					echo '<i class="flaticon-calendar"></i>';
					echo esc_html( get_the_date() );
				echo '</li>';
			}

	 		if ( $blog_single_category_show ) {
				echo '<li class="meta-blog-cat">';
					echo '<i class="flaticon-folder"></i>';
					if ( edubin_category_by_id( get_the_ID() ) ) :
					echo wp_kses_post( edubin_category_by_id( get_the_ID(), 'category' ) );
					endif;
				echo '</li>';
			}

			if ( $blog_single_comment_show ) {
				echo '<li><i class="flaticon-chat"></i>';
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%2$s %1$s', '%2$s %1$s', get_comments_number(), 'comments title', 'edubin' ) ),
						number_format_i18n( get_comments_number() ),
						$blog_comment_short_text,
						'<span>' . get_the_title() . '</span>'
					);
				echo '</li>';
			}

		echo '</ul>';
	echo '</div>';
}

/**
 * Single Post After Content
 *
 * Post Category and Post Share
 *
 * @since 1.0.0
 */
add_action( 'edubin_single_post_after', 'edubin_single_post_after_cats_social_share', 10 );
function edubin_single_post_after_cats_social_share() {

	if ( 'post' === get_post_type() && Edubin::setting( 'blog_single_social_share' ) ) :

		$tags = edubin_category_by_id( get_the_ID(), 'post_tag', false );

		echo '<div class="edubin-tag-social-share-wrapper">';
			echo '<div class="edubin-tag-social-share edubin-row">';
				if ( empty( $tags ) ) :
					$column = 'edubin-col-md-12 tags-social-full-width';
					$tags_column = $column;
				else :
					$tags_column = 'edubin-col-md-7';
					$column = 'edubin-col-md-5';
				endif;

				$blog_single_tags_show  = Edubin::setting( 'blog_single_tags_show' );

				if( ! empty( $tags ) && $blog_single_tags_show ) :
					echo '<div class="' . esc_attr( $tags_column ). '">';
						echo '<div class="edubin-post-tag-wrapper">';
							echo '<div class="edubin-post-tag"><i class="flaticon-tags"></i>';
								echo wp_kses_post( $tags );
							echo '</div>';
						echo '</div>';
					echo '</div>';
				endif;
				
				echo '<div class="' . esc_attr( $column ). '">';
				
					// echo '<div class="edubin-single-post-social-share">';
					// 	echo '<span class="post-share-text">' . __( 'Share on: ', 'edubin' ) . '</span>';
					// 		edubin_get_sharing_list();
					// echo '</div>'; ?>

					<div class="edubin-social-share has-text-align-right">
						<div class="entry-post-share">
							<div class="post-share style-01">
								<div class="share-label">
									<?php esc_html_e( 'Share this post', 'edubin' ); ?>
								</div>
								<div class="share-media">
									<i class="share-icon flaticon-share"></i>

									<div class="share-list">
										<?php edubin_get_sharing_list(); ?>
									</div>
								</div>
							</div>
						</div>

						<?php
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	endif;
}

/**
 * Single Post After Content
 *
 * Author Bio
 *
 * @since 1.0.0
 */
add_action( 'edubin_single_post_after', 'edubin_single_post_after_author_bio', 15 );
function edubin_single_post_after_author_bio() {
	if ( 'post' === get_post_type() && Edubin::setting( 'blog_single_author_bio_show' ) ) :
		edubin_author_bio();
	endif;
}

/**
 * Single Post After Content
 *
 * Related Posts
 *
 * @since 1.0.0
 */
 add_action( 'edubin_single_post_after', 'edubin_related_posts', 21 );

/**
 * Related posts 
 */

function edubin_related_posts($postType = 'post', $postID = null, $totalPosts = null, $relatedBy = null) {


	$blog_related_show = Edubin::setting( 'blog_related_show' );
    $blog_related_title = Edubin::setting( 'blog_related_title' );
    $related_total_posts = Edubin::setting( 'related_total_posts' );
    $related_post_columns = Edubin::setting( 'related_post_columns' );
    $related_posts_by = Edubin::setting( 'related_posts_by' );

    global $post, $related_posts_custom_query_args;
    if (null === $postID) $postID = $post->ID;
    if (null === $totalPosts) $totalPosts = $related_total_posts;
    if (null === $relatedBy) $relatedBy = $related_posts_by;
    if (null === $postType) $postType = 'post';

    // Build our basic custom query arguments

    if ($relatedBy === 'category') {
        $categories = get_the_category( $post->ID );
        $catidlist = '';
        foreach( $categories as $category) {
            $catidlist .= $category->cat_ID . ",";
        }
        // Build our category based custom query arguments
        $related_posts_custom_query_args = array(
            'post_type' => $postType,
            'posts_per_page' => $totalPosts, // Number of related posts to display
            'post__not_in' => array($postID), // Ensure that the current post is not displayed
            'orderby' => 'rand', // Randomize the results
            'cat' => $catidlist, // Select posts in the same categories as the current post
        );
    }

    if ($relatedBy === 'tags') {

        // Get the tags for the current post
        $tags = wp_get_post_tags($postID);
        // If the post has tags, run the related post tag query
        if ($tags) {
            $tag_ids = array();
            foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
            // Build our tag related custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'tag__in' => $tag_ids, // Select posts with related tags
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
            );
        } else {
            // If the post does not have tags, run the standard related posts query
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
            );
        }

    }

    // Initiate the custom query
    $custom_query = new WP_Query( $related_posts_custom_query_args );


    // Run the loop and output data for the results
    if ( $custom_query->have_posts() && $blog_related_show ) : ?>

    <div class="related-post-wrap ">
    	
            <h3 class="related-title"><?php echo esc_html( $blog_related_title ); ?></h3>

        <div class="edubin-row">

        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

            <div class="edubin-col-sm-6 edubin-col-md-6 edubin-col-lg-<?php echo esc_attr( $related_post_columns ); ?>">
                <div class="post-item-wrap">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'course_thumb' ); ?></a>
                            </div>
                        <?php endif; ?>
                    <div class="entry-desc">
                        <h4 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <span class="entry-date"><?php edubin_posted_date_only(); ?></span>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
        </div>
    </div>

    <?php endif;
    // Reset postdata
    wp_reset_postdata();
}



/**
 * Single Post After Content
 *
 * Displays Previous & Next Post Naviation
 *
 * @since 1.0.0
 */
add_action( 'edubin_single_post_after', 'nav_page_links', 20 );
if ( ! function_exists( 'edubin_post_nav_prev_next' ) ) :
	function edubin_post_nav_prev_next() {
		if ( is_singular( 'post' ) ) :
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			if ( ! empty( $prev_post->post_title ) || ! empty( $next_post->post_title ) ) :
				echo '<div class="edubin-post-nav-prev-next edubin-row">';
					if ( ! empty( $prev_post->post_title ) ) :
						echo '<div class="edubin-col-md-6">';
							echo '<div class="edubin-single-post-nav edubin-prev-post">';
								echo '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '">';
									echo '<i class="edubin-pagination-icon flaticon-back-1"></i>';
									echo '<span class="post-title">' . esc_html( $prev_post->post_title ) . '</span>';
								echo '</a>';
							echo '</div>';
						echo '</div>';
					endif;

					if ( ! empty( $next_post->post_title ) ) :
						echo '<div class="edubin-col-md-6">';
							echo '<div class="edubin-single-post-nav edubin-next-post">';
								echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '">';
									echo '<span class="post-title">' . esc_html( $next_post->post_title ) . '</span>';
									echo '<i class="edubin-pagination-icon flaticon-next"></i>';
								echo '</a>';
							echo '</div>';
						echo '</div>';
					endif;
				echo '</div>';
			endif;
		endif;
	}
endif;

/**
 * edubin_get_sharing_list
 */

function edubin_get_sharing_list( $args = array() ) {

    $social_shear_show = Edubin::setting( 'social_shear_show' );
    $social_shear_tooltip = Edubin::setting( 'social_shear_tooltip' );
    $social_shear_facebook = Edubin::setting( 'social_shear_facebook' );
    $social_shear_twitter = Edubin::setting( 'social_shear_twitter' );
    $social_shear_linkedin = Edubin::setting( 'social_shear_linkedin' );
    $social_shear_tumblr = Edubin::setting( 'social_shear_tumblr' );
    $social_shear_email = Edubin::setting( 'social_shear_email' );

        $defaults       = array(
            'style'            => 'icons',
            'target'           => '_blank',
            'tooltip_enable'   => true,
            'tooltip_skin'     => 'primary',
            'tooltip_position' => 'top',
        );
        $args           = wp_parse_args( $args, $defaults );

        if ( $social_shear_show ) {
  
            $link_classes = '';

            if ( $social_shear_tooltip) {
                $link_classes .= "hint--bounce hint--{$args['tooltip_position']} hint--{$args['tooltip_skin']}";
            }

            if ( $social_shear_facebook ) {
                $facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
                ?>
                <a class="<?php echo esc_attr( $link_classes . ' facebook' ); ?>"
                   target="<?php echo esc_attr( $args['target'] ); ?>"
                   aria-label="<?php esc_attr_e( 'Facebook', 'edubin' ); ?>"
                   href="<?php echo esc_url( $facebook_url ); ?>">
                    <?php if ( $args['style'] === 'text' ) : ?>
                        <span><?php esc_html_e( 'Facebook', 'edubin' ); ?></span>
                    <?php else: ?>
                        <i class="flaticon-facebook-logo"></i>
                    <?php endif; ?>
                </a>
                <?php
            } 
            if ( $social_shear_twitter ) {
                ?>
                <a class="<?php echo esc_attr( $link_classes . ' twitter' ); ?>"
                   target="<?php echo esc_attr( $args['target'] ); ?>"
                   aria-label="<?php esc_attr_e( 'Twitter', 'edubin' ); ?>"
                   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
                    <?php if ( $args['style'] === 'text' ) : ?>
                        <span><?php esc_html_e( 'Twitter X', 'edubin' ); ?></span>
                    <?php else: ?>
                        <i class="flaticon-twitter"></i>
                    <?php endif; ?>
                </a>
                <?php
            } 
            if ( $social_shear_tumblr ) {
                ?>
                <a class="<?php echo esc_attr( $link_classes . ' tumblr' ); ?>"
                   target="<?php echo esc_attr( $args['target'] ); ?>"
                   aria-label="<?php esc_attr_e( 'Tumblr', 'edubin' ); ?>"
                   href="https://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
                    <?php if ( $args['style'] === 'text' ) : ?>
                        <span><?php esc_html_e( 'Tumblr', 'edubin' ); ?></span>
                    <?php else: ?>
                        <i class="flaticon-tumblr"></i>
                    <?php endif; ?>
                </a>
                <?php

            } 
            if ( $social_shear_linkedin ) {
                ?>
                <a class="<?php echo esc_attr( $link_classes . ' linkedin' ); ?>"
                   target="<?php echo esc_attr( $args['target'] ); ?>"
                   aria-label="<?php esc_attr_e( 'Linkedin', 'edubin' ); ?>"
                   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
                    <?php if ( $args['style'] === 'text' ) : ?>
                        <span><?php esc_html_e( 'Linkedin', 'edubin' ); ?></span>
                    <?php else: ?>
                        <i class="flaticon-linkedin"></i>
                    <?php endif; ?>
                </a>
                <?php
            } 
            if ( $social_shear_email ) {
                ?>
                <a class="<?php echo esc_attr( $link_classes . ' email' ); ?>"
                   target="<?php echo esc_attr( $args['target'] ); ?>"
                   aria-label="<?php esc_attr_e( 'Email', 'edubin' ); ?>"
                   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
                    <?php if ( $args['style'] === 'text' ) : ?>
                        <span><?php esc_html_e( 'Email', 'edubin' ); ?></span>
                    <?php else: ?>
                        <i class="flaticon-message"></i>
                    <?php endif; ?>
                </a>
                <?php
            }
        
        }
}


/**
 * nav_page_links posts 
 */
if ( ! function_exists( 'nav_page_links' ) ) :
    function nav_page_links() { 

	$blog_nav_show = Edubin::setting( 'blog_nav_show' );
		if ( $blog_nav_show ) {

	    ?>
	        <div class="blog-nav-links">
	            <div class="nav-list">
	                <div class="nav-item prev">
	                    <div class="inner">
	                        <?php
	                        $prev_post      = get_previous_post();
	                        $prev_thumbnail = '';
	                        $class          = 'hover-bg';

	                        if ( ! empty( $prev_post ) ) {
	                            $prev_thumbnail = get_the_post_thumbnail_url(get_previous_post(),'course_thumb'); 

	                            if ( ! empty( $prev_thumbnail ) ) {
	                                $class          .= ' has-thumbnail';
	                                $prev_thumbnail = 'style="background-image: url(' . $prev_thumbnail . ');"';
	                            }
	                        }

	                        previous_post_link( '%link', '<div class="' . esc_attr( $class ) . '" ' . $prev_thumbnail . '></div><h6>%title</h6>' );
	                        ?>
	                    </div>
	                </div>

	                <div class="nav-item next">
	                    <div class="inner">
	                        <?php
	                        $next_post      = get_next_post();
	                        $next_thumbnail = '';
	                        $class          = 'hover-bg';

	                        if ( ! empty( $next_post ) ) {
	                            $next_thumbnail = get_the_post_thumbnail_url(get_next_post(),'course_thumb'); 

	                            if ( ! empty( $next_thumbnail ) ) {
	                                $class          .= ' has-thumbnail';
	                                $next_thumbnail = 'style="background-image: url(' . $next_thumbnail . ');"';
	                            }
	                        }

	                        next_post_link( '%link', '<div class="' . esc_attr( $class ) . '" ' . $next_thumbnail . '></div><h6>%title</h6>' );
	                        ?>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <?php
	    }
    }
endif;

/**
 * edubin_posted_date_only
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Edubin
 */

if ( ! function_exists( 'edubin_posted_date_only' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function edubin_posted_date_only() {
	// Finally, let's write all of this to the page.
	echo '<span class="posted-on list-inline-item"><i class="flaticon-calendar"></i>' . edubin_time_link() . '</span>';
}
endif;


if ( ! function_exists( 'edubin_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function edubin_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d'); 
	
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'edubin' ),
		'<a href="' . esc_url( get_day_link( $archive_year, $archive_month, $archive_day) ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;


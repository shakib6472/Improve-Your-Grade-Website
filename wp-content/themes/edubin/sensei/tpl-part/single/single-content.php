<?php
/**
 * The template for displaying course single page
 */
    $sensei_intro_video_position = Edubin::setting( 'sensei_intro_video_position' ); 
    $sensei_single_page_layout  = Edubin::setting( 'sensei_single_page_layout' );

echo '<article id="post-'; the_ID(); echo '"'; post_class( 'edubin-course-single-wrap' ); echo '>';  

    if ( !in_array( $sensei_single_page_layout, array('5')) ) {
        if ( $sensei_intro_video_position == 'intro_video_content' ) : 
            get_template_part( 'sensei/tpl-part/single/media', 'content' );
        endif;
    }

    echo '<div class="post-wrapper">';
        /* translators: %s: Name of current post */
        the_content( sprintf(
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'edubin' ),
            get_the_title()
        ) );

        wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'edubin' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ) );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    echo '</div>'; // End post-wrapper

echo ' </article>'; //  End </article>
           
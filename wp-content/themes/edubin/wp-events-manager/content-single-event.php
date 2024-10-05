<?php
/**
 * The Template for displaying content single event.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/content-single-event.php
 *
 * @author        ThimPress, leehld
 * @package       WP-Events-Manager/Template
 * @version       2.1.7
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$edubin_single_tp_event_sidebar = Edubin::setting( 'edubin_single_tp_event_sidebar' );
$edubin_single_tp_event_speaker = Edubin::setting( 'edubin_single_tp_event_speaker' );
$edubin_single_tp_event_comment = Edubin::setting( 'edubin_single_tp_event_comment' );

$tpc_tp_content_column = 'edubin-col-lg-8';
if ( wpems_get_option( 'allow_register_event' ) == 'no' || ! $edubin_single_tp_event_sidebar ) :
	$tpc_tp_content_column = 'edubin-col-lg-12';
endif;

echo '<div class="tpc-event-contaner-wrapper">';
	echo '<div class="edubin-row">';
		echo '<div class="' . esc_attr( $tpc_tp_content_column ) . '">';

			$edubin_tp_event_video = get_post_meta( get_the_ID(), 'edubin_tp_event_video', true);

			if ( $edubin_tp_event_video ) : 

			    echo '<div class="intro-video-sidebar intro-video-content main-thumbnail">';  
			        echo '<div class="intro-video-content">';  
			            echo '<div class="intro-video" style="background-image: url(' . esc_url( get_the_post_thumbnail_url(get_the_ID(),'full') ) . ')">';

			                echo '<a href="' . esc_url( $edubin_tp_event_video ) . '" class="edubin-popup-videos bla-2">';
			                    echo '<i class="flaticon-play-button"></i>';
			                echo '</a>';

			            echo '</div>';   
			        echo '</div>';   
			    echo '</div>'; // End intro-video-sidebar
			   
			elseif( has_post_thumbnail() ) : 

			    echo '<div class="main-thumbnail">';
			        do_action( 'tp_event_single_event_thumbnail' );
			    echo '</div>';

			endif;

			the_content();

		echo '</div>';
	
		if ( $edubin_single_tp_event_sidebar ) :
			echo '<div class="edubin-col-lg-4">';

				get_template_part( 'wp-events-manager/loop/register' );

			echo '</div>';
		endif;


	echo '</div>';
	
	if ( $edubin_single_tp_event_speaker ) :
		wpems_get_template_part( 'tpl-part/event', 'speaker' );
	endif;

	if ( $edubin_single_tp_event_comment && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
echo '</div>';
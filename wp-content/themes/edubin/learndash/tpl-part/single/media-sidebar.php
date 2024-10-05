<?php

	$ld_intro_video_position = Edubin::setting( 'ld_intro_video_position' );
	$ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );

	$edubin_ld_video = get_post_meta( get_the_ID(), 'edubin_ld_video', true);


if ( $edubin_ld_video && $ld_intro_video_position == 'intro_video_sidebar' ) : 

	    echo '<div class="intro-video-sidebar intro-video-content is__sidebar">';  
	        echo '<div class="intro-video" style="background-image: url(' . esc_url( get_the_post_thumbnail_url(get_the_ID(),'full') ) . ')">';

	            echo '<a href="' . esc_url( $edubin_ld_video ) . '" class="edubin-popup-videos bla-2">';
	                echo '<i class="flaticon-play-button"></i>';
	            echo '</a>';

	        echo '</div>';   
	    echo '</div>';   

elseif( has_post_thumbnail() && $ld_intro_video_position == 'intro_video_sidebar' ) : 

	    echo '<div class="post-thumbnail">';    
	       the_post_thumbnail( 'full' ); 
	    echo '</div>';  

endif;




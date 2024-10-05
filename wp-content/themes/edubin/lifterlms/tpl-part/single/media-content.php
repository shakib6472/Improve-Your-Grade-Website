<?php

    $lif_intro_video_position = Edubin::setting( 'lif_intro_video_position' );
    $lif_single_page_layout = Edubin::setting( 'lif_single_page_layout' );

    $edubin_lif_video = get_post_meta( get_the_ID(), 'edubin_lif_video', true);

//if ( !$lif_intro_video_position == 'none' ) {

if ($edubin_lif_video && $lif_intro_video_position == 'intro_video_content') : 

    echo '<div class="intro-video-sidebar intro-video-content">';  
        echo '<div class="intro-video-content">';  
            echo '<div class="intro-video" style="background-image: url(' . esc_url( get_the_post_thumbnail_url(get_the_ID(),'full') ) . ')">';

                echo '<a href="' . esc_url( $edubin_lif_video ) . '" class="edubin-popup-videos bla-2">';
                    echo '<i class="flaticon-play-button"></i>';
                echo '</a>';

            echo '</div>';   
        echo '</div>';   
    echo '</div>'; // End intro-video-sidebar
   

elseif( has_post_thumbnail() && $lif_intro_video_position == 'intro_video_content') : 

        echo '<div class="post-thumbnail">';    
           the_post_thumbnail( 'full' ); 
        echo '</div>';  

endif;

//}

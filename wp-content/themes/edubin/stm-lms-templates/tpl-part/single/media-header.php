<?php

    $ms_intro_video_position = Edubin::setting( 'ms_intro_video_position' );
    $ms_single_page_layout = Edubin::setting( 'ms_single_page_layout' );

    $edubin_ms_video = get_post_meta( get_the_ID(), 'edubin_ms_video', true);


if ($edubin_ms_video) : 

    echo '<div class="intro-video-sidebar intro-video-sidebar is__sidebar">';  
        echo '<div class="intro-video-content">';  
            echo '<div class="intro-video" style="background-image: url(' . esc_url( get_the_post_thumbnail_url(get_the_ID(),'full') ) . ')">';

                echo '<a href="' . esc_url( $edubin_ms_video ) . '" class="edubin-popup-videos bla-2">';
                    echo '<i class="flaticon-play-button"></i>';
                echo '</a>';

            echo '</div>';   
        echo '</div>';   
    echo '</div>'; // End intro-video-sidebar

elseif( has_post_thumbnail()) : 

        echo '<div class="post-thumbnail">';    
           the_post_thumbnail( 'large' ); 
        echo '</div>';  

endif;

//}

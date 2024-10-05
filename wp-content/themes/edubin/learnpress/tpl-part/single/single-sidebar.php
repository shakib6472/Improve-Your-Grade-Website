<?php 

    global $post;
    $post_id    = $post->ID;
        
    $lp_related_course_position = Edubin::setting( 'lp_related_course_position' );
    $lp_single_social_shear = Edubin::setting( 'lp_single_social_shear' );
    $lp_single_course_info = Edubin::setting( 'lp_single_course_info' );
    $lp_single_course_cat = Edubin::setting( 'lp_single_course_cat' );
    $lp_single_course_price = Edubin::setting( 'lp_single_course_price' );
    $lp_single_enroll_btn = Edubin::setting( 'lp_single_enroll_btn' );
    $lp_single_course_graduation = Edubin::setting( 'lp_single_course_graduation' );
    $lp_single_course_time = Edubin::setting( 'lp_single_course_time' );
    $lp_single_progress = Edubin::setting( 'lp_single_progress' ); 
    $lp_intro_video_position = Edubin::setting( 'lp_intro_video_position' ); 
    $lp_single_sidebar_sticky = Edubin::setting( 'lp_single_sidebar_sticky' );
    $sidebar_sticky_on_off = ( $lp_single_sidebar_sticky ? 'do_sticky' : '');
    $lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );


echo '<aside id="secondary" class="widget-area '. esc_attr( $sidebar_sticky_on_off ) .'">';
    echo '<div class="course-sidebar-preview lp">';

    if ( in_array($lp_single_page_layout , array('1', '2', '3', '4')) ) { 

     echo '<div class="intro-video-sidebar intro-video-content is__sidebar">'; 

        $edubin_lp_video = get_post_meta( $post_id, 'edubin_lp_video', true );
        if ( $edubin_lp_video && $lp_intro_video_position == 'intro_video_sidebar' ) : 

            echo '<div class="intro-video" style="background-image: url(' . esc_url( get_the_post_thumbnail_url(get_the_ID(),'full') ) . ')">';

                echo '<a href="' . esc_url( $edubin_lp_video ) . '" class="edubin-popup-videos bla-2">';
                    echo '<i class="flaticon-play-button"></i>';
                echo '</a>';

            echo '</div>'; 

        elseif( has_post_thumbnail() && $lp_intro_video_position == 'intro_video_sidebar') :

            echo '<div class="post-thumbnail">';    
               the_post_thumbnail( 'full' ); 
            echo '</div>';  

        endif; 
    echo '</div>';  

   } 
        echo '<div class="lp_sidebar_wrap lp__widget">';   
        
            if ( $lp_single_course_graduation ) { 
                // Graduation.
                LP()->template( 'course' )->course_graduation();
            }
           if ( $lp_single_course_time ) { 
               LP()->template( 'course' )->user_time();
           }
           if ( $lp_single_progress ) { 
               LP()->template( 'course' )->user_progress();
           }

        echo '</div>';  

        if ( $lp_single_course_info ) { 

        if( function_exists('edubin_lp_course_info') ){ 

            echo '<div class="lp__widget">'; 

               edubin_lp_course_info(); 

            echo '</div>';  
        } 

        } 

        if ( $lp_single_social_shear ) { 
          
          echo '<div class="entry-post-share text-center tpc_pb_30">';
              echo '<div class="post-share style-03">';
                  echo '<div class="share-label">';
                    esc_html_e( 'Share this course', 'edubin' );
                  echo '</div>';
                  echo '<div class="share-media">';
                      echo '<i class="share-icon flaticon-share"></i>';

                      echo '<div class="share-list">';
                        edubin_get_sharing_list(); 
                      echo '</div>';
                  echo '</div>';
              echo '</div>';
          echo '</div>';
          
        } 
    echo '</div>';
    
    // edubin_lp_related_course_sidebar 
    if ($lp_related_course_position == 'sidebar') { 

        if( function_exists('edubin_lp_related_course_sidebar') ){ 
             echo '<div class="lp__widget">';
                edubin_lp_related_course_sidebar(); 
            echo '</div>';

        } 
    } 

    // edubin_lp_course_category
    if ( $lp_single_course_cat && !empty(get_the_terms(get_the_ID(), 'lp_course_category'))) { 

        if( function_exists('edubin_lp_course_category') ){ 
            echo '<div class="lp__widget">';
                edubin_lp_course_category(); 
            echo '</div>';

        }

    }

    // lp-course-sidebar-2 sidebar
    if ( is_active_sidebar( 'lp-course-sidebar-2' ) ) : 
        echo '<div class="lp__widget">';                   
            dynamic_sidebar( 'lp-course-sidebar-2' ); 
        echo '</div>';
    endif;


echo '</aside>';


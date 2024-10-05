<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $ms_intro_video_position = Edubin::setting( 'ms_intro_video_position' ); 
    $ms_related_course_position = Edubin::setting( 'ms_related_course_position' );
    $ms_single_enroll_btn = Edubin::setting( 'ms_single_enroll_btn' );
    $ms_single_social_shear = Edubin::setting( 'ms_single_social_shear' );
    $ms_course_header_style = Edubin::setting( 'ms_course_header_style' );

    // ==== Course Header =====

     while ( have_posts() ) : the_post(); 

    if ( '1' == $ms_course_header_style ) { 
        edubin_ms_course_page_title_section_05(); 
    }
     else { 
        edubin_ms_course_page_title_section_06();
    }

    endwhile; wp_reset_postdata();  

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';

                while ( have_posts() ) : the_post();

                    get_template_part( 'stm-lms-templates/tpl-part/single/single', 'content' );

                 echo '<div class="edubin-row">';
                    echo '<div class="edubin-col-lg-4"></div>';
                        echo '<div class="edubin-col-lg-4">';
                 $course_data = apply_filters( 'masterstudy_course_page_header', 'default' ); 
                    if ( ! $course_data['is_coming_soon'] || $course_data['course']->coming_soon_preorder ) {
                            ?>
                            <div class="ms-course-single-layout-03 masterstudy-single-course__cta">
                                <?php
                                STM_LMS_Templates::show_lms_template(
                                    'components/buy-button/buy-button',
                                    array(
                                        'post_id'              => $course_data['course']->id,
                                        'item_id'              => '',
                                        'user_id'              => $course_data['current_user_id'],
                                        'dark_mode'            => false,
                                        'prerequisite_preview' => false,
                                        'hide_group_course'    => false,
                                    )
                                );
                                ?>
                            </div>
                            <?php
                            STM_LMS_Templates::show_lms_template( 'components/course/money-back', array( 'course' => $course_data['course'] ) );
                        }
                        if ( $course_data['is_coming_soon'] && $course_data['course']->coming_soon_price && ! $course_data['course']->coming_soon_preorder ) {
                            ?>
                            <div class="masterstudy-single-course__cta">
                                <?php STM_LMS_Templates::show_lms_template( 'components/course/coming-button' ); ?>
                            </div>
                            <?php
                        }
                        STM_LMS_Templates::show_lms_template(
                            'components/course/expired',
                            array(
                                'course'         => $course_data['course'],
                                'user_id'        => $course_data['current_user_id'],
                                'is_coming_soon' => $course_data['is_coming_soon'],
                            )
                        );
                        echo '</div>';
                    echo '<div class="edubin-col-lg-4"></div>';
                 echo '</div>';

                endwhile; 
                      
                if ($ms_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_ms_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();
<?php $settings = $this->get_settings_for_display();
$title_tag = $settings['hero_title_html_tag']
?>
<div class="edubin-hero edubin-hero-section-<?php echo $settings['edubin_hero_style']; ?>" >
    <img class="shape-1" src="<?php echo get_template_directory_uri().'/assets/images/hero-shape-2.png';?>" alt="shape">
	<img class="shape-2" src="<?php echo get_template_directory_uri().'/assets/images/hero-shape-3.png';?>" alt="shape">
	<div class="shape-3"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="edubin-col-xl-5 edubin-col-lg-6">
                <!-- Hero Content Start -->
                <div class="hero-content">

                    <!-- Title -->
                    <?php if ($settings['title']): ?>
                        <<?php echo $title_tag?> class="title aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['title']; ?></<?php echo $title_tag?>>
                    <?php endif; ?>

                    <!-- Additional Text  -->
                    <?php if ($settings['description_text']): ?>
                        <p class="description-text aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['description_text']; ?></p>
                    <?php endif; ?>

                    <!-- Course Search  -->
                    <div class="tpc-courses-searching tpc-searching aos-init aos-animate"  data-aos="fade-up" data-aos-delay="900">

                        <?php if ($settings['search_type'] == 'tpc_wp_search'): ?>

                            <form class="tpc-course-form-wrapper" action="<?php echo esc_html(home_url('/')); ?>" method="get">
                                <input class="tpc-course-input" placeholder="<?php echo $settings['search_placeholder']; ?>" type="text" name="s" value="<?php the_search_query();?>" />
                                <button class="tpc-course-btn" type="submit"><?php if ($settings['search_btn_text']): echo $settings['search_btn_text'];else: ?> <i class="flaticon-loupe"></i><?php endif;?></button>
                                <span class="widget-search-close"></span>
                            </form>

                        <?php elseif ($settings['search_type'] == 'tpc_tutor_search'): ?>

                            <?php if (function_exists('tutor')): ?>
                                <form class="tpc-course-form-wrapper" method="get" action="<?php echo esc_url(get_post_type_archive_link(tutor()->course_post_type)); ?>">

                                    <input type="text" value="" name="s" placeholder="<?php echo $settings['search_placeholder']; ?>" class="tpc-course-input" autocomplete="off" />
                                    <input type="hidden" value="course" name="ref" />
                                    <button class="tpc-course-btn" type="submit"><?php if ($settings['search_btn_text']): echo $settings['search_btn_text'];else: ?> <i class="flaticon-loupe"></i><?php endif;?></button>
                                    <span class="widget-search-close"></span>

                                </form>

                            <?php else: ?>
                                <p class="none-massage"><?php echo esc_html__('Tutor LMS plugin not install', 'lmsmart-core'); ?></p>
                            <?php endif;?>

                        <?php elseif ($settings['search_type'] == 'tpc_lp_search'): ?>

                            <?php if (class_exists('LearnPress')): ?>
                            <form class="tpc-course-form-wrapper" method="get" action="<?php echo esc_url(get_post_type_archive_link('lp_course')); ?>">

                                <input type="text" value="" name="s" placeholder="<?php echo $settings['search_placeholder']; ?>" class="tpc-course-input" autocomplete="off" />
                                <input type="hidden" value="course" name="ref" />
                                <button class="tpc-course-btn" type="submit"><?php if ($settings['search_btn_text']): echo $settings['search_btn_text'];else: ?> <i class="flaticon-loupe"></i><?php endif;?></button>
                                <span class="widget-search-close"></span>

                            </form>

                            <?php else: ?>
                            <form class="tpc-course-form-wrapper" action="<?php echo esc_html(home_url('/')); ?>" method="get">
                                <input class="tpc-course-input" placeholder="<?php echo $settings['search_placeholder']; ?>" type="text" name="s" value="<?php the_search_query();?>" />
                                <button class="tpc-course-btn" type="submit"><?php if ($settings['search_btn_text']): echo $settings['search_btn_text'];else: ?> <i class="flaticon-loupe"></i><?php endif;?></button>
                                <span class="widget-search-close"></span>
                            </form>
                            <?php endif;?>

                        <?php elseif ($settings['search_type'] == 'tpc_ld_search'): ?>

                            <?php if (class_exists('SFWD_LMS')): ?>
                            <form class="tpc-course-form-wrapper" method="get" action="<?php echo esc_url(get_post_type_archive_link('sfwd-courses')); ?>">

                                <input type="text" value="" name="s" placeholder="<?php echo $settings['search_placeholder']; ?>" class="tpc-course-input" autocomplete="off" />
                                <input type="hidden" value="course" name="ref" />
                                <button class="tpc-course-btn" type="submit"><?php if ($settings['search_btn_text']): echo $settings['search_btn_text'];else: ?> <i class="flaticon-loupe"></i><?php endif;?></button>
                                <span class="widget-search-close"></span>
                            </form>

                            <?php else: ?>
                                <p class="none-massage"><?php echo esc_html__('LearnDash LMS plugin not install', 'lmsmart-core'); ?></p>
                            <?php endif;?>

                        <?php endif;?> <!-- //End LMS Search -->

                    </div>


                    
                </div>
                <!-- Hero Content End -->
            </div>
            <div class="edubin-col-xl-7 edubin-col-lg-6">
                <!-- Hero Images Start -->
                <div class="hero-images">
                    <img class="shape-4 parallaxed" src="<?php echo get_template_directory_uri();?>/assets/images/hero-shape-4.png" alt="shape">
					<img class="shape-5 parallaxed" src="<?php echo get_template_directory_uri();?>/assets/images/hero-shape-5.png" alt="shape">
					<img class="shape-6 parallaxed" src="<?php echo get_template_directory_uri();?>/assets/images/hero-shape-6.png" alt="shape">
                    <div class="image">
                        <?php echo '<img src="' . $settings['hero_image']['url'] . '">'; ?>
                    </div>
                </div>
                <!-- Hero Images End -->
            </div>
        </div>
    </div>

</div>


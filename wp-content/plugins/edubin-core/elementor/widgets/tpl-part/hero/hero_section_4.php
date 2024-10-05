<?php $settings = $this->get_settings_for_display();
    $title_tag = $settings['hero_title_html_tag']
?>
<div class="edubin-hero edubin-hero-section-<?php echo $settings['edubin_hero_style']; ?> ">
    <div class="container">
            
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

    <div class="svg-shape-1">
		<svg xmlns="http://www.w3.org/2000/svg" width="2246px" height="436px">
			<path d="M28.999,54.999 C157.999,372.999 242.860,11.848 841.999,145.999 C1230.829,233.61 1477.999,25.999 1786.999,163.999 C2095.999,301.999 2233.999,-212.0 2245.999,105.999 L2245.999,291.999 L35.0,435.999 C35.0,435.999 -39.131,-112.952 28.999,54.999 Z"></path>
		</svg>
	</div>
	<div class="svg-shape-2">
		<svg xmlns="http://www.w3.org/2000/svg" width="2314px" height="399px">
			<path d="M22.0,117.999 C111.999,60.999 639.999,-23.0 771.999,6.999 C903.999,36.999 1071.999,138.999 1266.999,36.999 C1470.771,-69.588 1761.999,144.999 1873.0,51.999 C1983.999,-41.0 1993.0,0.999 2145.999,120.999 C2298.999,240.999 2436.999,183.999 2130.999,294.999 C1824.999,405.999 189.999,399.999 168.999,396.999 C147.999,393.999 -67.999,174.999 22.0,117.999 Z"></path>
		</svg>
	</div>
	<div class="svg-shape-3">
		<svg xmlns="http://www.w3.org/2000/svg" width="2226px" height="438px">
			<path d="M246.0,51.999 C548.999,-47.0 908.999,-2.0 1034.999,177.999 C1160.999,357.999 1457.999,129.999 1634.999,72.999 C1812.0,15.999 2075.999,-44.0 2213.999,132.999 C2351.999,309.999 1196.999,450.999 1077.0,435.999 C957.0,420.999 6.0,261.999 6.0,249.999 C6.0,237.999 -56.999,150.999 246.0,51.999 Z"></path>
		</svg>
	</div>
</div>

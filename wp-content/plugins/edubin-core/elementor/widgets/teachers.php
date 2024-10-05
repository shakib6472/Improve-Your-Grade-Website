<?php

namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Edubin_Elementor_Widget_Teachers extends Widget_Base {
  
    
    
    public function get_name() {
        return 'edubin-teacher-addons';
    }

    public function get_title() {
        return __( 'Team/Teacher', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-person';
    }

	public function get_keywords() {
		return [ 'edubin', 'teacher', 'members', 'instructors', 'team', 'workers', 'stuff' ];
	}

    public function get_categories() {
        return [ 'edubin-core' ];
    }
    protected function register_controls() {


        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Teacher Content', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'teacher_style',
            [
                'label' => __('Style', 'edubin-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Style 1', 'edubin-core'),
                    '2' => __('Style 2', 'edubin-core'),
                ]
            ]
        );

        $this->add_control(
            'posts_column',
            [
                'label' => __('Items Column', 'edubin-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => __('1 Column', 'edubin-core'),
                    '6' => __('2 Column', 'edubin-core'),
                    '4' => __('3 Column', 'edubin-core'),
                    '3' => __('4 Column', 'edubin-core'),
                    '2' => __('6 Column', 'edubin-core'),
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'teacher_image',
            [
                'label' => esc_html__( 'Choose Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_group_control(
             \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'teacher_imagesize',
                'default' => 'large',
                'include' => [],
                'separator' => 'none',

            ]
        );
        $repeater->add_control(
            'teacher_name',
            [
              'label' => esc_html__( 'Name', 'edubin-core' ),
              'type'  => Controls_Manager::TEXT,
              'label_block' => true,
              'default' => esc_html__( 'Jonathan Bean', 'edubin-core' ),
          ]
      );

        $repeater->add_control(
            'teacher_degree',
            [
              'label' => esc_html__( 'Designation', 'edubin-core' ),
              'type'  => Controls_Manager::TEXT,
              'label_block' => true,
              'default' => esc_html__( 'Instructor, Math', 'edubin-core' ),
          ]
      );

        $repeater->add_control(
            'teacher_email',
            [
              'label' => esc_html__( 'Email', 'edubin-core' ),
              'type'  => Controls_Manager::TEXT,
              'label_block' => true,
              'default' => '',
          ]
      );

        $repeater->add_control(
            'teacher_details_link',
            [
                'label' => __( 'Teacher details page link', 'edubin-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
					'url' => '#',
				],
            ]
        );

        $repeater->add_control(
            'fb_link',
            [
                'label' => __( 'Facebook', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'twitter_link',
            [
                'label' => __( 'Twitter', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'linkedin_link',
            [
                'label' => __( 'Linkedin', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'youtube_link',
            [
                'label' => __( 'Youtube', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'instagram_link',
            [
                'label' => __( 'Instagram', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );  

        $repeater->add_control(
            'skype_link',
            [
                'label' => __( 'Skype', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'vk_link',
            [
                'label' => __( 'VK', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'github_link',
            [
                'label' => __( 'Github', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );
        $repeater->add_control(
            'bitbucket_link',
            [
                'label' => __( 'Bitbucket', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );
        $repeater->add_control(
            'whatsapp_link',
            [
                'label' => __( 'Whatsapp', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'tumblr_link',
            [
                'label' => __( 'Tumblr', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'stack_overflow_link',
            [
                'label' => __( 'Stack Overflow', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'soundcloud_link',
            [
                'label' => __( 'Soundcloud', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'slack_link',
            [
                'label' => __( 'Slack', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );
        $repeater->add_control(
            'dribbble_link',
            [
                'label' => __( 'Dribbble', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );
        $repeater->add_control(
            'behance_link',
            [
                'label' => __( 'Behance', 'edubin-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

     
        $this->add_control(
            'teacher_options',
            [
              'label'       => esc_html__( 'Add Teacher', 'edubin-core' ),
              'type'        => Controls_Manager::REPEATER,
              'show_label'  => true,
              'default'     => [
                  [
                    'teacher_image' => '',
                    'teacher_name'       => esc_html__( 'Teacher 1', 'edubin-core' ),
                    'teacher_degree' => esc_html__( 'Instructor, Math', 'edubin-core' ),
                ],
                [
                    'teacher_image' => '',
                    'teacher_name'       => esc_html__( 'Teacher 2', 'edubin-core' ),
                    'teacher_degree' => esc_html__( 'Instructor, Physics', 'edubin-core' ),
                ],
                [
                    'teacher_image' => '',
                    'teacher_name'       => esc_html__( 'Teacher 3', 'edubin-core' ),
                    'teacher_degree' => esc_html__( 'Instructor, Chemistry', 'edubin-core' ),
                ],
                [
                    'teacher_image' => '',
                    'teacher_name'       => esc_html__( 'Teacher 4', 'edubin-core' ),
                    'teacher_degree' => esc_html__( 'Instructor, Biology', 'edubin-core' ),
                ],
            ],
            'fields'  => $repeater->get_controls(),
            'title_field' => '{{{teacher_name}}}',
            'degree_field' => '{{{teacher_degree}}}',
        ]
    );

    $this->add_control(
        'default_scroll_animation',
        [
            'type'         => Controls_Manager::SWITCHER,
            'label'        => esc_html__( 'Scroll Animation', 'edubin-core' ),
            'label_on'     => esc_html__( 'Enable', 'edubin-core' ),
            'label_off'    => esc_html__( 'Disable', 'edubin-core' ),
            'default'      => 'no',
            'return_value' => 'yes',
        ]
    );



        $this->end_controls_section();

        // Star style tab
        $this->start_controls_section(
            'teacher_name_style',
            [
                'label' => esc_html__( 'Name', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __( 'Normal', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-content .title>a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();      

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __( 'Hover', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => __( 'Title Hover Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-name:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-content .title>a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-name, .edubin-teacher-style-2 .teacher-content .title',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_responsive_control(
            'name_bottom_space',
            [
                'label' => __( 'Name Bottom Space', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'teacher_degree_style',
            [
                'label' => esc_html__( 'Degree', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'Degree_color',
            [
                'label'     => __( 'Degree', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-degree' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-content .teacher-degree' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'Degree_typography',
                'selector' => '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-degree, .edubin-teacher-style-2 .teacher-content .teacher-degree',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'teacher_social_style',
            [
                'label' => esc_html__( 'Social', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_gap',
            [
                'label' => __( 'Icon Gap', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-social .social-link' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap .teacher-social .social-link' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-social .social-link' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap .teacher-social .social-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __( 'Icon Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-social .social-link:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap .teacher-social .social-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label'     => __( 'Icon Background Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap .teacher-social .social-link' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'teacher_style' => '2',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_hover_color',
            [
                'label'     => __( 'Icon Background Color Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap .teacher-social .social-link:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'teacher_style' => '2',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'teacher_style' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin_bottom',
            [
                'label' => __( 'Image Margin Bottom', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Image Border Radius', 'edubin-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img, .edubin-teacher-style-2 .teacher-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'image_overlay_color_options',
			[
				'label' => esc_html__( 'Image Hover Overlay Color', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap>a::after',
			]
		);

        $this->add_responsive_control(
            'image_overlay_opacity',
            [
                'label' => __( 'Opacity', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-teacher-style-2 .teacher-img-wrap>a:hover:after' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'layout_style',
            [
                'label' => esc_html__( 'Layout', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'teacher_style' => '1',
                ],
            ]
        );


        $this->add_responsive_control(
            'image_fixed_height',
            [
                'label' => __( 'Image Height', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-image img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_margin_bottom',
            [
                'label' => __( 'Margin Bottom', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  

        $this->add_responsive_control(
            'content_height',
            [
                'label' => __( 'Content Area Height', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 70,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'content_height_hover',
            [
                'label' => __( 'Content Area Height Hover', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 70,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher.active-social:hover .teacher-content-area' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       $this->add_responsive_control(
            'content_area_padding',
            [
                'label'      => __('Content Area Padding', 'edubin-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area .teacher-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_bg_color',
            [
                'label'     => __( 'Background Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'teacher_border_radius',
            [
                'label'      => __('Teacher Border Radius', 'edubin-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'teacher_content_border_radius',
            [
                'label'      => __('Teacher Content Border Radius', 'edubin-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-single-teacher .teacher-content-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }


    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'teacher_area_attr', 'class', 'edubin-teacher' );
        $this->add_render_attribute( 'teacher_row', 'class', 'edubin-row' );
        $this->add_render_attribute('edubin_posts_column', 'class', 'edubin-col-xs-' . '12' . ' edubin-col-sm-' . '6' . ' edubin-col-md-' . '6' . ' edubin-col-lg-' . $settings['posts_column'] );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'teacher_row' ); ?> >

            <?php foreach ( $settings['teacher_options'] as $teacher_option ) : ?>
                <div <?php echo $this->get_render_attribute_string( 'edubin_posts_column' ); ?> >

                    <?php 

                    // if item has social icons 
                    $all_social = $teacher_option['fb_link']['url'] || $teacher_option['twitter_link']['url'] || $teacher_option['linkedin_link']['url'] || $teacher_option['youtube_link']['url'] || $teacher_option['instagram_link']['url'] || $teacher_option['skype_link']['url'] || $teacher_option['vk_link']['url'] || $teacher_option['github_link']['url'] || $teacher_option['bitbucket_link']['url'] || $teacher_option['whatsapp_link']['url'] || $teacher_option['tumblr_link']['url'] || $teacher_option['stack_overflow_link']['url'] || $teacher_option['soundcloud_link']['url'] || $teacher_option['slack_link']['url'] || $teacher_option['dribbble_link']['url'] || $teacher_option['behance_link']['url']; 
                    // icon activated class
                    $all_social_class = ($all_social)?('active-social'):('');

                    // if item has link
                    $teacher_link_url = $teacher_option['teacher_details_link']['url'];
                    $is_external = ($teacher_option['teacher_details_link']['is_external']) ? ('target="_blank"'): (''); 
                    $link_tag = ('<a href="'.esc_url($teacher_link_url).'" '.$is_external.'>');
                    $link_end_tag = ('</a>');


                    // Social Icons Links
                    //fb
                    $facebook_link = $teacher_option['fb_link']['url'];
                    $fb_is_external = ($teacher_option['fb_link']['is_external']) ? ('target="_blank"') : ('');
                    //twitter
                    $twitter_link = $teacher_option['twitter_link']['url'];
                    $twitter_is_external = ($teacher_option['twitter_link']['is_external']) ? ('target="_blank"') : ('');
                    //linkedin
                    $linkedin_link = $teacher_option['linkedin_link']['url'];
                    $linkedin_is_external = ($teacher_option['linkedin_link']['is_external']) ? ('target="_blank"') : ('');
                    //youtube
                    $youtube_link = $teacher_option['youtube_link']['url'];
                    $youtube_is_external = ($teacher_option['youtube_link']['is_external']) ? ('target="_blank"') : ('');
                    //Instagram
                    $instagram_link = $teacher_option['instagram_link']['url'];
                    $instagram_is_external = ($teacher_option['instagram_link']['is_external']) ? ('target="_blank"') : ('');
                    //Skype
                    $skype_link = $teacher_option['skype_link']['url'];
                    $skype_is_external = ($teacher_option['skype_link']['is_external']) ? ('target="_blank"') : ('');
                    //VK
                    $vk_link = $teacher_option['vk_link']['url'];
                    $vk_is_external = ($teacher_option['vk_link']['is_external']) ? ('target="_blank"') : ('');
                    //github
                    $github_link = $teacher_option['github_link']['url'];
                    $github_is_external = ($teacher_option['github_link']['is_external']) ? ('target="_blank"') : ('');
                    //bitbucket
                    $bitbucket_link = $teacher_option['bitbucket_link']['url'];
                    $bitbucket_is_external = ($teacher_option['bitbucket_link']['is_external']) ? ('target="_blank"') : ('');
                    //whatsapp
                    $whatsapp_link = $teacher_option['whatsapp_link']['url'];
                    $whatsapp_is_external = ($teacher_option['whatsapp_link']['is_external']) ? ('target="_blank"') : ('');
                    //tumblr
                    $tumblr_link = $teacher_option['tumblr_link']['url'];
                    $tumblr_is_external = ($teacher_option['tumblr_link']['is_external']) ? ('target="_blank"') : ('');
                    //stackoverflow
                    $stackoverflow_link = $teacher_option['stack_overflow_link']['url'];
                    $stkflw_is_external = ($teacher_option['stack_overflow_link']['is_external']) ? ('target="_blank"') : ('');
                    //suncloud
                    $suncloud_link = $teacher_option['soundcloud_link']['url'];
                    $suncloud_is_external = ($teacher_option['soundcloud_link']['is_external']) ? ('target="_blank"') : ('');
                    //slack
                    $slack_link = $teacher_option['slack_link']['url'];
                    $slack_is_external = ($teacher_option['slack_link']['is_external']) ? ('target="_blank"') : ('');
                    //dribble
                    $dribble_link = $teacher_option['dribbble_link']['url'];
                    $dribble_is_external = ($teacher_option['dribbble_link']['is_external']) ? ('target="_blank"') : ('');
                    //behance
                    $behance_link = $teacher_option['behance_link']['url'];
                    $behance_is_external = ($teacher_option['behance_link']['is_external']) ? ('target="_blank"') : ('');

                    
                    // Render icon with tags 
                    $facebook = ($facebook_link) ? ('<a href="'.esc_url($facebook_link).'" '.$fb_is_external.' '.'class="social-link"><i class="flaticon-facebook-logo" aria-hidden="true"></i></a>') : ('');
                    $twitter = ($twitter_link) ? ('<a href="'.esc_url($twitter_link).'" '.$twitter_is_external.' '.'class="social-link"><i class="flaticon-twitter" aria-hidden="true"></i></a>') : ('');
                    $linkedin = ($linkedin_link) ? ('<a href="'.esc_url($linkedin_link).'" '.$linkedin_is_external.' '.'class="social-link"><i class="flaticon-linkedin" aria-hidden="true"></i></a>') : ('');
                    $youtube = ($youtube_link) ? ('<a href="'.esc_url($youtube_link).'" '.$youtube_is_external.' '.'class="social-link"><i class="flaticon-youtube" aria-hidden="true"></i></a>') : ('');
                    $instagram = ($instagram_link) ? ('<a href="'.esc_url($instagram_link).'" '.$instagram_is_external.' '.'class="social-link"><i class="flaticon-instagram" aria-hidden="true"></i></a>') : ('');
                    $skype = ($skype_link) ? ('<a href="'.esc_url($skype_link).'" '.$skype_is_external.' '.'class="social-link"><i class="flaticon-skype" aria-hidden="true"></i></a>') : ('');
                    $vk = ($vk_link) ? ('<a href="'.esc_url($vk_link).'" '.$vk_is_external.' '.'class="social-link"><i class="flaticon-vk" aria-hidden="true"></i></a>') : ('');
                    $github = ($github_link) ? ('<a href="'.esc_url($github_link).'" '.$github_is_external.' '.'class="social-link"><i class="flaticon-github" aria-hidden="true"></i></a>') : ('');
                    $bitbucket = ($bitbucket_link) ? ('<a href="'.esc_url($bitbucket_link).'" '.$bitbucket_is_external.' '.'class="social-link"><i class="flaticon-bitbucket-logo" aria-hidden="true"></i></a>') : ('');
                    $whatsapp = ($whatsapp_link) ? ('<a href="'.esc_url($whatsapp_link).'" '.$whatsapp_is_external.' '.'class="social-link"><i class="flaticon-whatsapp" aria-hidden="true"></i></a>') : ('');
                    $tumblr = ($tumblr_link) ? ('<a href="'.esc_url($tumblr_link).'" '.$tumblr_is_external.' '.'class="social-link"><i class="flaticon-tumblr" aria-hidden="true"></i></a>') : ('');
                    $stackoverflow = ($stackoverflow_link) ? ('<a href="'.esc_url($stackoverflow_link).'" '.$stkflw_is_external.' '.'class="social-link"><i class="flaticon-stack-overflow" aria-hidden="true"></i></a>') : ('');
                    $suncloud = ($suncloud_link) ? ('<a href="'.esc_url($suncloud_link).'" '.$suncloud_is_external.' '.'class="social-link"><i class="flaticon-soundcloud" aria-hidden="true"></i></a>') : ('');
                    $slack = ($slack_link) ? ('<a href="'.esc_url($slack_link).'" '.$slack_is_external.' '.'class="social-link"><i class="flaticon-slack" aria-hidden="true"></i></a>') : ('');
                    $dribble = ($dribble_link) ? ('<a href="'.esc_url($dribble_link).'" '.$dribble_is_external.' '.'class="social-link"><i class="flaticon-dribbble-logo" aria-hidden="true"></i></a>') : ('');
                    $behance = ($behance_link) ? ('<a href="'.esc_url($behance_link).'" '.$behance_is_external.' '.'class="social-link"><i class="flaticon-behance" aria-hidden="true"></i></a>') : ('');

                    $animation_attribute = '';
            
                    if ( 'yes' === $settings['default_scroll_animation'] ) :
                        $animation_attribute = ' data-sal';
                    endif;

                    if ($settings['teacher_style'] == 1){
                        echo '<div class="edubin-single-teacher text-center '.$all_social_class.'"'.esc_attr($animation_attribute).'>';
                             echo '<div class="teacher-image-wrap">';
                                echo $link_tag;
                                    echo '<div class="teacher-image">'.Group_Control_Image_Size::get_attachment_image_html( $teacher_option, 'teacher_imagesize', 'teacher_image' ).'</div>';
                                echo $link_end_tag;
                            echo '</div>';

                            if ($teacher_option['teacher_name']){
                                echo '<div class="teacher-content-area">';
                                    echo '<div class="teacher-content">';
                                        echo $link_tag;
                                            echo '<h6 class="teacher-name">';
                                                    echo $teacher_option['teacher_name'];
                                            echo '</h6>';
                                        echo $link_end_tag;
                                        echo ($teacher_option['teacher_degree']) ? ('<span class="teacher-degree">'. $teacher_option['teacher_degree'].'</span>') : ('');
                                        echo ($teacher_option['teacher_email']) ? ('<span class="teacher-degree teacher-email">'. $teacher_option['teacher_email'].'</span>') : ('');
                                        if($all_social){
                                            echo '<div class="teacher-social">';
                                                echo $facebook,
                                                    $twitter,
                                                    $linkedin,
                                                    $youtube,
                                                    $instagram,
                                                    $skype,
                                                    $vk,
                                                    $github,
                                                    $bitbucket,
                                                    $whatsapp,
                                                    $tumblr,
                                                    $stackoverflow,
                                                    $suncloud,
                                                    $slack,
                                                    $dribble,
                                                    $behance;
                                            echo '</div>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>'; //single teacher

                    }
                    elseif ($settings['teacher_style'] == 2){
                        echo '<div class="edubin-teacher-item edubin-teacher-style-'.$settings['teacher_style'].'"'.esc_attr($animation_attribute).'>';
                            echo '<div class="teacher-img-wrap">';
                                echo $link_tag;
                                    echo '<div class="teacher-img">';
                                        echo Group_Control_Image_Size::get_attachment_image_html( $teacher_option, 'teacher_imagesize', 'teacher_image' );
                                    echo '</div>';
                                echo $link_end_tag;
                                if($all_social){
                                    echo '<div class="teacher-social">';
                                        echo $facebook,
                                            $twitter,
                                            $linkedin,
                                            $youtube,
                                            $instagram,
                                            $skype,
                                            $vk,
                                            $github,
                                            $bitbucket,
                                            $whatsapp,
                                            $tumblr,
                                            $stackoverflow,
                                            $suncloud,
                                            $slack,
                                            $dribble,
                                            $behance;
                                    echo '</div>';
                                }
                            echo '</div>';
                            
                            echo '<div class="teacher-content">';
                                echo '<h5 class="title">';
                                    echo $link_tag;
                                        echo $teacher_option['teacher_name'];
                                    echo $link_end_tag;
                                echo '</h5>';
                                echo ($teacher_option['teacher_degree']) ? ('<span class="teacher-degree">'. $teacher_option['teacher_degree'].'</span>') : ('');
                            echo '</div>';
                            
                        echo '</div>';
                    }
            ?>      
            </div>
        <?php endforeach; ?>

    </div>

<?php
}
}
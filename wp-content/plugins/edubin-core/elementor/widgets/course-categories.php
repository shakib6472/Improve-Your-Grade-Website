<?php

namespace EdubinCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
class Edubin_Elementor_Widget_Course_Category_Custom extends Widget_Base {

    public function get_name() {
        return 'edubin-course-category-custom-addons';
    }
    
    public function get_title() {
        return __( 'Custom Course Category', 'edubin-core' );
    }
    public function get_keywords() {
        return [ 'Category', 'categories', 'course categories' , 'course Category' ];
    }
    public function get_icon() {
        return 'edubin-elementor-icon eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_script_depends() {
        return [
            // 'slick',
            'edubin-widgets-scripts',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_image',
            [
                'label' => __( 'Content', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'cat_layout',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Style 1', 'edubin-core'),
                    '2' => esc_html__('Style 2', 'edubin-core'),
                    '3' => esc_html__('Style 3', 'edubin-core'),
                    '4' => esc_html__('Style 4', 'edubin-core'),
                ],
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => __( 'Image/Icon', 'edubin-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', 
                'label' => __( 'Image Size', 'edubin-core' ),
                'default' => 'large',
            ]
        );

        $this->add_control(
            'course_cat_name',
            [
                'label'   => __( 'Course Category', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => __('Technology','edubin-core'),
                'default' => 'Technology',
            ]
        );
        $this->add_control(
            'total_course',
            [
                'label'   => __( 'Total Course', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => __('15','edubin-core'),
                'default' => '15',
                'condition' => [
                    'cat_layout!' => ['3','4'],
                ],
            ]
        );
        $this->add_control(
            'total_course_text',
            [
                'label'   => __( 'Courses', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => __('Courses','edubin-core'),
                'default' => '',
                'condition' => [
                    'cat_layout!' => ['3','4'],
                ],
            ]
        );

        $this->add_control(
            'cat_link',
            [
                'label' => __( 'Category Link', 'edubin-core' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'edubin-core' ),
                'default' => [
                    'url' => '#',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'show_hide_course_cat',
            [
                'label' => __( 'Total Courses', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'edubin-core' ),
                'label_off' => __( 'Hide', 'edubin-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'cat_layout' => '1',
                ],
            ]
        );
        $this->add_control(
            'hover_effect',
            [
                'label' => __( 'Hover Effect', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'edubin-core' ),
                'label_off' => __( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'cat_layout' => '1',
                ],
            ]
        );
        $this->add_control(
            'hover_effect_style',
            [
                'label' => __( 'Hover Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Style 1', 'edubin-core'),
                    '2' => esc_html__('Style 2', 'edubin-core'),
                ],
                'condition' => [
                    'cat_layout' => '1',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_section_style',
                [
                    'label' => __( 'Style', 'edubin-core' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'cat_layout!' => ['3','4'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-course-category .single-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .tpc-cat-item .single-items-1 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-course-category .single-items .items-image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-course-category .single-items .items-image img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tpc-cat-item .single-items-1 a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space_between',
            [
                'label' => __( 'Space Between', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-course-category .single-items .items-cont .course-cat' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tpc-cat-item .single-items-1 a' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       $this->add_responsive_control(
            'space_top',
            [
                'label' => __( 'Content Position', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'em', 'vw' ],
                'range' => [
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-course-category .single-items .items-cont' => 'top: {{SIZE}}{{UNIT}};',
                ],'condition' => [
                    'cat_layout!' => '2',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'lp_catogories_bg_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .edubin-course-category .single-items .items-image::before',
                'condition' => [
                    'cat_layout' => '1',
                ],
            ]
        );


    $this->end_controls_section();

    // Only for style 3
    $this->start_controls_section(
        'section_style_box_3',
            [
                'label' => __( 'Box Style', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'cat_layout' => ['3','4'],
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_style_3',
            [
                'label' => esc_html__( 'Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tpc-course-category-style-3 a.cat-item-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tpc-course-category-style-4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'cat_layout' => ['3','4'],
                ],
            ]
        );

        
        $this->add_responsive_control(
            'space_between_style_3',
            [
                'label' => __( 'Space Between', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 90,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpc-course-category-style-3 a.cat-item-3 img' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tpc-course-category-style-4 .cat-title-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Tab Start
        $this->start_controls_tabs(
			'style_tabs',
            [
                'condition' => [
                    'cat_layout' => ['3','4'],
                ],
            ]
		);

        $this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'edubin-core' ),
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_3_border',
				'selector' => '{{WRAPPER}} .tpc-course-category-style-3, {{WRAPPER}} .tpc-course-category-style-4',
                
			]
		);

        $this->add_responsive_control(
            'border_radius_style_3',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tpc-course-category-style-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tpc-course-category-style-4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'categories_bg_color_style_3',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tpc-course-category-style-3,{{WRAPPER}} .tpc-course-category-style-4',
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_box_shadow',
				'selector' => '{{WRAPPER}} .tpc-course-category-style-3,{{WRAPPER}} .tpc-course-category-style-4',
			]
		);

		$this->end_controls_tab();

        // Hover Tab
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'edubin-core' ),
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_3_border_hover',
				'selector' => '{{WRAPPER}} .tpc-course-category-style-3:hover, {{WRAPPER}} .tpc-course-category-style-4:hover',
			]
		);

        $this->add_responsive_control(
            'border_radius_style_3_hover',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tpc-course-category-style-3:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tpc-course-category-style-4:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'categories_bg_color_style_3_hover',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tpc-course-category-style-3:hover,{{WRAPPER}} .tpc-course-category-style-4:hover',
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_box_shadow_hover',
				'selector' => '{{WRAPPER}} .tpc-course-category-style-3:hover,{{WRAPPER}} .tpc-course-category-style-4:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


    $this->end_controls_section();

    // Only for style 3
    $this->start_controls_section(
    'section_style_image_3',
        [
            'label' => __( 'Image', 'edubin-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'cat_layout' => '3',
            ],
        ]
    );

    $this->add_responsive_control(
        'image_width_3',
        [
            'label' => __( 'Image Width', 'edubin-core' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .tpc-course-category-style-3 a.cat-item-3 img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'image_border_radius_style_3',
        [
            'label' => esc_html__( 'Image Border Radius', 'edubin-core' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .tpc-course-category-style-3 a.cat-item-3 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->end_controls_section();

    // Title Style
    $this->start_controls_section(
        'title_style_section',
            [
                'label' => __( 'Title', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Category Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-course-category .single-items .items-cont .course-cat, .tpc-cat-item .single-items-1 a .cat_name, .tpc-course-category-style-3 a.cat-item-3, .tpc-course-category-style-4 .cat-title-wrap>h4',
            ]
        );
        
        $this->start_controls_tabs('title_style_tabs');

                $this->start_controls_tab(
                    'title_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                $this->add_control(
                    'title_color',
                    [
                        'label' => __( 'Category Text Color', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'default'=>'',
                        'selectors' => [
                            '{{WRAPPER}} .edubin-course-category .single-items .items-cont .course-cat' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-cat-item .single-items-1 a .cat_name' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-course-category-style-3 a.cat-item-3' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-course-category-style-4 .cat-title-wrap' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'cat_bg_color',
                    [
                        'label' => __( 'Category Background Color', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'default'=>'',
                        'selectors' => [
                            '{{WRAPPER}} .tpc-cat-item .single-items-1 a' => 'background: {{VALUE}}',
                        ],
                        'condition' => [
                            'cat_layout' => '2',
                        ],
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'title_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );
                $this->add_control(
                    'title_hover_text_color',
                    [
                        'label' => __( 'Color', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'default'=>'',
                        'selectors' => [
                            '{{WRAPPER}} .tpc-cat-item .single-items-1 a:hover .cat_name' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-course-category-style-3:hover a.cat-item-3' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-course-category-style-4 .cat-title-wrap:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'title_hover_color',
                    [
                        'label' => __( 'Background Color', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'default'=>'',
                        'selectors' => [
                            '{{WRAPPER}} .edubin-course-category .single-items .items-cont .course-cat:hover' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-cat-item .single-items-1 a:hover' => 'background-color: {{VALUE}}',
                        ],
                        'condition' => [
                            'cat_layout!' => '4',
                        ],
                    ]
                );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

    $this->end_controls_section();

    $this->start_controls_section(
        'total_style_section',
            [
                'label' => __( 'Total Course', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'cat_layout' => '1',
                ],
            ]
        );

      $this->add_control(
            'total_courses_color',
            [
                'label' => __( 'Total Courses Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'separator'=>'before',
                'selectors' => [
                    '{{WRAPPER}} .edubin-course-category .single-items .items-cont .total-course' => 'color: {{VALUE}}',
                ],
            ]
        );      
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'total_courses_typography',
                'label' => __( 'Total Courses Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-course-category .single-items .items-cont .total-course',
            ]
        );
    $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        if ( empty( $settings['image']['url'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-image' );

        $this->add_render_attribute('title_link', 'class', 'cat-item_title-link');
        if (!empty($settings['cat_link']['url'])) {
            $this->add_link_attributes('title_link', $settings['cat_link']);
        }

        $this->add_render_attribute('cat_img', [
            'class' => 'cat-item_image',
            'src' => isset($settings['image']['url']) ? esc_url($settings['image']['url']) : '',
            'alt' => Control_Media::get_image_alt( $settings['image'] ),
        ]);

        $show_hide_course_cat = $settings['show_hide_course_cat']; 
        // $course_cat_name = $settings['course_cat_name'];
        $total_course = $settings['total_course'];
        $cat_link = $settings['cat_link'];

        // for hover effect
        $hover_style = 'cat-hover-effect-'.$settings['hover_effect_style'];
        $hover_ef_class = ($settings['hover_effect']) ? $hover_style : '' ;

        //link validation
        $cat_link_url = $settings['cat_link']['url'];
        $is_external = ($settings['cat_link']['is_external']) ? ('target="_blank"'): ('');
        $is_nofollow = ($settings['cat_link']['nofollow']) ? ('rel="nofollow"'): ('');
        $link_tag = ($settings['cat_link']['url']) ? ('<a href="'.esc_url($cat_link_url).'" '.$is_external.' '.$is_nofollow.'>'): ('');
        $link_end_tag = ($settings['cat_link']['url']) ? ('</a>'): ('');


        if($settings['cat_layout'] == '1'){
            echo '<div class="edubin-course-category '.$hover_ef_class.' ">';
                echo '<div class="single-items text-center">';
                    echo  $link_tag;
                       echo '<div class="items-image">';
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings );
                       echo ' </div>'; 
                    echo $link_end_tag;

                    echo '<div class="items-cont">';
                        echo  $link_tag;
                            echo '<h5 class="course-cat">';
                                echo $settings['course_cat_name'];
                            echo '</h5>';
                        echo $link_end_tag;
                        if($show_hide_course_cat){
                            if ($settings['total_course_text']) {
                                echo '<p class="total-course">'.esc_attr( $total_course ).esc_html($settings['total_course_text']).'</p>';
                            }else{
                                echo '<p class="total-course">'.esc_attr( $total_course );
                                    esc_html_e(' Courses', 'edubin-core');
                                echo '</p>';
                            };
                        };
                    echo '</div>';

                echo '</div>';
            echo '</div>';


        }elseif($settings['cat_layout'] == '2'){
            echo '<div class="tpc-cat-item">';
                echo '<div class="single-items-1">';
                    echo '<a ', $this->get_render_attribute_string('title_link'), '>';
                        echo '<div class="cat-icon-wrap">';
                            echo '<img '.$this->get_render_attribute_string('cat_img'). '/>';
                            echo'<span class="cat_name">'. $settings['course_cat_name'].'</span>';
                        echo '</div>';
                    echo '</a>';
                echo '</div>';
            echo '</div>';


        }elseif($settings['cat_layout'] == '3'){
            echo '<div class="tpc-course-category-style-'.$settings['cat_layout'].'" >';
                echo '<a class="cat-item-3" href="'.esc_url($cat_link_url).'" '.$is_external.' '.$is_nofollow.'>';
                    echo $settings['course_cat_name'];
                    echo '<img '.$this->get_render_attribute_string('cat_img'). '/>';
                echo '</a>';
            echo '</div>';
        }
        elseif($settings['cat_layout'] == '4'){
            echo '<div class="tpc-course-category-style-'.$settings['cat_layout'].'" >';
                echo '<a class="cat-image-wrap" href="'.esc_url($cat_link_url).'" '.$is_external.' '.$is_nofollow.'>';
                    echo '<img '.$this->get_render_attribute_string('cat_img'). '/>';
                echo '</a>';
                echo '<a class="cat-title-wrap" href="'.esc_url($cat_link_url).'" '.$is_external.' '.$is_nofollow.'>';
                    echo '<h4 class="cat-title">'.$settings['course_cat_name'].'</h4>';
                echo '</a>';
            echo '</div>';
        };

        
    }

}


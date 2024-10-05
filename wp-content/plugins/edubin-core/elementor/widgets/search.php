<?php
// Change by Sumon -1
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Core\Schemes\Typography as Scheme_Typography;

class Edubin_Elementor_Widget_Search extends Widget_Base {

    public function get_name() {
        return 'edubin-search';
    }

    public function get_title() {
        return __('Search', 'edubin-core');
    }
    public function get_keywords() {
        return [ 'Search', 'find', 'course search', 'site search'];
    }
    public function get_icon() {
        return 'edubin-elementor-icon eicon-search';
    }
    public function get_categories() {
        return ['edubin-core-hf'];
    }

    public function get_help_url() {
        return 'https://thepixelcurve.com/docs/general-widgets/call-to-action-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'search_content',
            [
                'label' => __( 'Search', 'edubin-core' ),
            ]
        );
        
            $this->add_control(
                'search_style',
                [
                    'label' => __( 'Style', 'edubin-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style 1', 'edubin-core' ),
                        '2'   => __( 'Style 2', 'edubin-core' ),
                        '3'   => __( 'Style 3', 'edubin-core' ),
                    ],
                ]
            );
            $this->add_control(
                'search_type',
                [
                    'label'   => __('Search Type', 'edubin-core'),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => 'tpc_wp_search',
                    'options' => [
                        'tpc_wp_search'    => __('WordPress Search', 'edubin-core'),
                        'tpc_tutor_search' => __('Tutor Search', 'edubin-core'),
                        'tpc_lp_search'    => __('LearnPress Search', 'edubin-core'),
                        'tpc_ld_search'    => __('LearnDash Search', 'edubin-core'),
                        'tpc_sen_search'    => __('Sensei Search', 'edubin-core'),
                    ],
                ]
            );
            $this->add_control(
                'inpur_placeholder',
                [
                    'label' => __( 'Placeholder Text', 'edubin-core' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Search Here..', 'edubin-core' ),
                    'placeholder' => __( 'Search Here..', 'edubin-core' ),
                ]
            );

            $this->add_control(
                'search_btn_icon_type',
                [
                    'label' => esc_html__('Button Icon Type','edubin-core'),
                    'type' =>Controls_Manager::CHOOSE,
                    'options' =>[
                        'buttontext' =>[
                            'title' =>__('Text','edubin-core'),
                            'icon' =>'eicon-font',
                        ],
                        'icon' =>[
                            'title' =>__('Icon','edubin-core'),
                            'icon' =>'eicon-favorite',
                        ]
                    ],
                    'default' =>'icon',

                ]
            );

            $this->add_control(
                'search_button_text',
                [
                    'label' => __( 'Search Button Text', 'edubin-core' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Search', 'edubin-core' ),
                    'placeholder' => __( 'Search', 'edubin-core' ),
                    'condition' => [
                        'search_btn_icon_type' => 'buttontext',
                    ]
                ]
            );


        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'edubin_search_style_section',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'search_style_align',
                [
                    'label' => __( 'Alignment', 'edubin-core' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'edubin-core' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'search_section_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'search_section_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'edubin_search_style_input',
            [
                'label' => __( 'Input', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'search_input_text_color',
                [
                    'label'     => __( 'Text Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input'   => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'search_input_placeholder_color',
                [
                    'label'     => __( 'Placeholder Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-search-box-wrap input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-search-box-wrap input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'search_input_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .edubin-search-box-wrap input',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'label' => __( 'Background', 'edubin-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .edubin-search-box-wrap input',
                ]
            );

            $this->add_responsive_control(
                'search_input_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'search_input_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'search_input_height',
                [
                    'label' => __( 'Height', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 48,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            $this->add_responsive_control(
                'search_input_width',
                [
                    'label' => __( 'Width', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'search_input_border',
                    'label' => __( 'Border', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .edubin-search-box-wrap input',
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'search_input_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-search-box-wrap input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .edubin-search-box-wrap.edubin-search-sty-wraple-1 input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'edubin_search_style_submit_button',
            [
                'label' => __( 'Submit Button', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            // Button Tabs Start
            $this->start_controls_tabs('search_style_submit_tabs');

                // Start Normal Submit button tab
                $this->start_controls_tab(
                    'search_style_submit_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );
                    
                    $this->add_control(
                        'search_submitbutton_text_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'search_submitbutton_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .edubin-search-box-wrap input',
                            'condition' => [
                                'search_btn_icon_type' => 'buttontext',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'search_submitbutton_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .edubin-search-box-wrap button.btn-search',
                        ]
                    );

                    $this->add_responsive_control(
                        'search_submitbutton_margin',
                        [
                            'label' => __( 'Margin', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'search_submitbutton_padding',
                        [
                            'label' => __( 'Padding', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'search_submitbutton_height',
                        [
                            'label' => __( 'Height', 'edubin-core' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'search_submitbutton_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .edubin-search-box-wrap button.btn-search',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'search_submitbutton_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal submit Button tab end

                // Start Hover Submit button tab
                $this->start_controls_tab(
                    'search_style_submit_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );
                    
                    $this->add_control(
                        'search_submitbutton_hover_text_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'search_submitbutton_hover_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .edubin-search-box-wrap button.btn-search:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'search_submitbutton_hover_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .edubin-search-box-wrap button.btn-search:hover',
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'search_submitbutton_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap button.btn-search:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Submit Button tab End

            $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section();

        $this->start_controls_section(
            'edubin_search_style_icon',
            [
                'label' => __( 'Search Icon', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            // Button Tabs Start
            $this->start_controls_tabs('search_style_icon_tabs');

                // Start Normal Submit button tab
                $this->start_controls_tab(
                    'search_style_icon_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );
                    
                    $this->add_control(
                        'search_style_icon_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap .top-search i'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal submit Button tab end

                // Start Hover Submit button tab
                $this->start_controls_tab(
                    'search_style_icon_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );
                    
                    $this->add_control(
                        'search_style_icon_text_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-search-box-wrap .top-search i:hover'   => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Submit Button tab End

            $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'edubin_search_attr', 'class', 'edubin-search-box-wrap' );
        $this->add_render_attribute( 'edubin_search_attr', 'class', 'edubin-search-sty-wraple-'.$settings['search_style'] );

        $this->add_render_attribute(
            'input_attr', [
                'placeholder' => $settings['inpur_placeholder'],
                'type' => 'text',
                'name' => 's',
                'title' => esc_html__( 'Search', 'edubin-core' ),
                'value' => get_search_query(),
            ]
        );
        

    echo '<div ' . $this->get_render_attribute_string('edubin_search_attr') . '>';

    // Search by LearnPress LMS 
    if ($settings['search_type'] == 'tpc_lp_search') {

        echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url(get_post_type_archive_link(LP_COURSE_CPT)) . '">';

        if ($settings['search_style'] == '2') {
            echo '<div class="top-search"><a href="#" id="search"><i class="flaticon-search"></i></a></div>';
        } else {
            echo '<input type="text" value="" name="search_query" placeholder="' . $settings['inpur_placeholder'] . '" class="input-search" autocomplete="off" />';
            echo '<input type="hidden" value="lp_course_search" name="tpc_lp_course_filter" />';

            if ($settings['search_btn_icon_type'] == 'icon') {
                echo '<button class="btn-search search-trigger search-button"><i class="flaticon-search"></i> ' . $settings['search_button_text'] . '</button>';
            } else {
                echo '<button type="submit" class="htb-btn btn-search">' . $settings['search_button_text'] . '</button>';
            }
        }

        echo '</form>';

    } elseif ($settings['search_type'] == 'tpc_ld_search') {
        echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url(get_post_type_archive_link( 'sfwd-courses' )) . '">';

        if ($settings['search_style'] == '2') {
            echo '<div class="top-search"><a href="#" id="search"><i class="flaticon-search"></i></a></div>';
        } else {
            echo '<input type="text" value="" name="search_query" placeholder="' . $settings['inpur_placeholder'] . '" class="input-search" autocomplete="off" />';
            echo '<input type="hidden" value="ld_course_search" name="tpc_ld_course_filter" />';

            if ($settings['search_btn_icon_type'] == 'icon') {
                echo '<button class="btn-search search-trigger search-button"><i class="flaticon-search"></i> ' . $settings['search_button_text'] . '</button>';
            } else {
                echo '<button type="submit" class="htb-btn btn-search">' . $settings['search_button_text'] . '</button>';
            }
        }

        echo '</form>';
    } elseif ($settings['search_type'] == 'tpc_tutor_search') {
        echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url(get_post_type_archive_link( 'courses' )) . '">';

        if ($settings['search_style'] == '2') {
            echo '<div class="top-search"><a href="#" id="search"><i class="flaticon-search"></i></a></div>';
        } else {
            echo '<input type="text" value="" name="search_query" placeholder="' . $settings['inpur_placeholder'] . '" class="input-search" autocomplete="off" />';
            echo '<input type="hidden" value="tutor_course_search" name="tpc_tutor_course_filter" />';

            if ($settings['search_btn_icon_type'] == 'icon') {
                echo '<button class="btn-search search-trigger search-button"><i class="flaticon-search"></i> ' . $settings['search_button_text'] . '</button>';
            } else {
                echo '<button type="submit" class="htb-btn btn-search">' . $settings['search_button_text'] . '</button>';
            }
        }
    } elseif ($settings['search_type'] == 'tpc_sen_search') {
        echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url(get_post_type_archive_link( 'course' )) . '">';

        if ($settings['search_style'] == '2') {
            echo '<div class="top-search"><a href="#" id="search"><i class="flaticon-search"></i></a></div>';
        } else {
            echo '<input type="text" value="" name="search_query" placeholder="' . $settings['inpur_placeholder'] . '" class="input-search" autocomplete="off" />';
            echo '<input type="hidden" value="sen_course_search" name="tpc_sen_course_filter" />';

            if ($settings['search_btn_icon_type'] == 'icon') {
                echo '<button class="btn-search search-trigger search-button"><i class="flaticon-search"></i> ' . $settings['search_button_text'] . '</button>';
            } else {
                echo '<button type="submit" class="htb-btn btn-search">' . $settings['search_button_text'] . '</button>';
            }
        }
    } else {

    echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url(home_url('/')) . '">';
    if ($settings['search_style'] == '2') {
        echo '<div class="top-search"><a href="#" id="search"><i class="flaticon-search"></i></a></div>';
    } else {
        echo '<input type="text" value="" name="s" placeholder="' . $settings['inpur_placeholder'] . '" class="input-search" autocomplete="off" />';

        echo '<input type="hidden" value="wp_course_search" name="tpc_wp_course_filter" />';
        
        if ($settings['search_btn_icon_type'] == 'icon') {
            echo '<button class="btn-search search-trigger search-button"><i class="flaticon-search"></i> ' . $settings['search_button_text'] . '</button>';
        } else {
            echo '<button type="submit" class="htb-btn btn-search">' . $settings['search_button_text'] . '</button>';
        }
    }

    echo '</form>';


    }

    echo '</div>';


    }

}


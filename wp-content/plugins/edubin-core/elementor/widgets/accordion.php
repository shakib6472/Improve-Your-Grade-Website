<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Edubin_Accordion extends Widget_Base {

    public function get_name() {
        return 'edubin-accordion';
    }

    public function get_title() {
        return __( 'Accordion', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-accordion';
    }

    public function get_keywords() {
        return [ 'edubin', 'toggle', 'tab' ];
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_script_depends() {
        return [
            'edubin-active',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'accordion_content',
            [
                'label' => __( 'Accordion New', 'edubin-core' ),
            ]
        );


        // Accordion One Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'accordion_title', 
            [
                'label'       => __( 'Title', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tab_icon_imagesize',
                'default' => 'thumbnail',
                'separator' => 'none',
                'condition' => [
                    'tab_icon_image[url]!' => '',
                    'icon_type' => 'image',
                ]
            ]
        );
        $repeater->add_control(
            'content_source', 
            [
                'label'   => __( 'Select Content Source', 'edubin-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom'    => __( 'Custom', 'edubin-core' ),
                    "elementor" => __( 'Elementor Template', 'edubin-core' ),
                ],
            ]
        );
        $repeater->add_control(
            'accordion_content', 
            [
                'label'       => __( 'Accordion Content', 'edubin-core' ),
                'type'        => Controls_Manager::WYSIWYG,
                'condition'   => [
                'content_source' =>'custom',
                    ],
            ]
        );
        $repeater->add_control(
            'template_id', 
            [
                
                'label'       => __( 'Accordion Content', 'edubin-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => edubin_elementor_template(),
                'condition'   => [
                    'content_source' => "elementor"
                ],
            ]
        );

        $this->add_control(
        'edubin_accordion_list',
        [
            'label'     => __( 'Accordion Items', 'edubin-core' ),
            'type'      => Controls_Manager::REPEATER,
            'fields'    => $repeater->get_controls(),
            'default' => [
                [
                    'accordion_title'   => __( 'Accordion Title One', 'edubin-core' ),
                    'accordion_content' => __( 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably have not heard of them accusamus labore sustainable VHS.', 'edubin-core' ),
                    
                ],
                [
                    'accordion_title'   => __( 'Accordion Title Two', 'edubin-core' ),
                    'accordion_content' => __( 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably have not heard of them accusamus labore sustainable VHS.', 'edubin-core' ),
                ],
                [
                    'accordion_title'   => __( 'Accordion Title Three', 'edubin-core' ),
                    'accordion_content' => __( 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably have not heard of them accusamus labore sustainable VHS.', 'edubin-core' ),
                ],
            ],
            'title_field' => '{{{ accordion_title }}}',
        ]
        ); //end style one


            $this->add_control(
                'accordion_title_html_tag',
                [
                    'label'   => __( 'Title HTML Tag', 'edubin-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => edubin_html_tag_lists(),
                    'default' => 'h4',

                ]
            );


            $this->add_control(
                'accordion_close_all',
                [
                    'label'   => __( 'Close All Item', 'edubin-core' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'return_value' => 'yes',
                ]
            );

            // $this->add_control(
            //     'accordion_multiple',
            //     [
            //         'label' => __( 'Multiple Item Open', 'edubin-core' ),
            //         'type'  => Controls_Manager::SWITCHER,
            //         'return_value' => 'yes',
            //     ]
            // );

            $this->add_control(
                'current_item',
                [
                    'label' => __( 'Current Item No', 'edubin-core' ),
                    'type'  => Controls_Manager::NUMBER,
                    'min'   => 1,
                    'max'   => 50,
                    'condition' => [
                        'accordion_close_all!' =>'yes',
                    ],
                ]
            );

        $this->end_controls_section();


        // Style tab section
        $this->start_controls_section(
            'edubin_button_style_section',
            [
                'label' => __( 'Accordion Item', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'accordion_item_spacing',
            [
                'label' => __( 'Accordion Item Spacing', 'edubin-core' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .single_accordion' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // $this->add_control(
        //     'accordion_box_decoration_color',
        //     [
        //         'label'     => __( 'Color', 'edubin-core' ),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .single_accordion:before' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );

        $this->end_controls_section();

        // Title style tab start
        $this->start_controls_section(
            'edubin_accordion_title_style',
            [
                'label'     => __( 'Accordion Title', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                
            ]
        );
            $this->add_responsive_control(
                'titlealign',
                [
                    'label'   => __( 'Alignment', 'edubin-core' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .edubin-accordion-header'   => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'accordion_title_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .edubin-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __( 'Typography', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header .accordion-title',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_color_border_heading',
                [
                    'label' => __( 'Colors, Border and Rotation ', 'edubin-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs('edubin_accordion_title_style_tabs');
                // Accordion Title Normal tab Start
                $this->start_controls_tab(
                    'accordion_title_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'accordion_title_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header .accordion-title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_title_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_title_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'title_box_shadow',
                            'label' => __( 'Box Shadow', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header',
                        ]
                    );

                $this->end_controls_tab(); // Accordion Title Normal tab End

                // Accordion Title Active tab Start
                $this->start_controls_tab(
                    'accordion_title_style_active_tab',
                    [
                        'label' => __( 'Active', 'edubin-core' ),
                    ]
                );
                
                    
                    $this->add_control(
                        'accordion_title_active_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active .accordion-title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'active_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header.active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_title_active_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} ..single_accordion .edubin-accordion-header.active',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_title_active_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'title_active_box_shadow',
                            'label' => __( 'Box Shadow', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header.active',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Accordion Title Active tab End

            $this->end_controls_tabs();
           
        $this->end_controls_section(); // Title style tab end


    

        // Icon style tab start
        $this->start_controls_section(
            'edubin_accordion_icon_style',
            [
                'label'     => __( 'Accordion Icon', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'accordion_icon_size',
                [
                    'label' => __( 'Icon Size', 'edubin-core' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'accordion_icon_align',
                [
                    'label'   => __( 'Alignment', 'edubin-core' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Start', 'edubin-core' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'End', 'edubin-core' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                    ],
                    'default'     => is_rtl() ? 'left' : 'right',
                    'toggle'      => false,
                    'label_block' => false,
                ]
            );
            $this->add_responsive_control(
                'accordion_icon_width',
                [
                    'label' => __( 'Icon Box Width', 'edubin-core' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'accordion_icon_height',
                [
                    'label' => __( 'Icon Box Height', 'edubin-core' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'accordion_icon_box_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'accordion_icon_color_border_heading',
                [
                    'label' => __( 'Colors and Border', 'edubin-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );            
            // Accordion Icon tabs Start
            $this->start_controls_tabs('edubin_accordion_icon_style_tabs');

                // Accordion Icon normal tab Start
                $this->start_controls_tab(
                    'accordion_icon_style_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_responsive_control(
                        'accordion_icon_rotate_normal',
                        [
                            'label' => __( 'Icon Rotate', 'edubin-core' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'step' => 5,
                                    'max' => 360,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon i' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                    $this->add_control(
                        'accordion_icon_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'icon_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_icon_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_icon_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_box_shadow',
                            'label' => __( 'Box Shadow', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header span.accordion-icon',
                        ]
                    );

                $this->end_controls_tab(); // Accordion Icon normal tab End

                // Accordion Icon Active tab Start
                $this->start_controls_tab(
                    'accordion_active_icon_style_tab',
                    [
                        'label' => __( 'Active', 'edubin-core' ),
                    ]
                );

                    $this->add_responsive_control(
                        'accordion_icon_rotate_active',
                        [
                            'label' => __( 'Icon Rotate', 'edubin-core' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'step' => 5,
                                    'max' => 360,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon i' => 'transform: rotate({{SIZE}}deg);',
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon svg' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                    $this->add_control(
                        'accordion_active_icon_color',
                        [
                            'label'     => __( 'Color', 'edubin-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'icon_active_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'accordion_active_icon_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'accordion_active_icon_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_active_box_shadow',
                            'label' => __( 'Box Shadow', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .single_accordion .edubin-accordion-header.active span.accordion-icon',
                        ]
                    );

                $this->end_controls_tab(); // Accordion Icon Active tab End

            $this->end_controls_tabs();

        $this->end_controls_section(); // Icon style tabs end


        // Content style tab start
        $this->start_controls_section(
            'edubin_accordion_content_style',
            [
                'label'     => __( 'Accordion Content', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'content_align',
                [
                    'label'   => __( 'Alignment', 'edubin-core' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon'  => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .accordion-body'   => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __( 'Typography', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .single_accordion .accordion-body .accordion-content',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'accordion_content_color',
                [
                    'label'     => __( 'Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .accordion-body .accordion-content' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'accordion_content_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .accordion-body .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .accordion--5 .single_accordion .va-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'accordion_content_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .accordion-body .accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_background',
                    'label' => __( 'Background', 'edubin-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single_accordion .accordion-body',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'accordion_content_border',
                    'label' => __( 'Border', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .single_accordion .accordion-body',
                ]
            );

            $this->add_responsive_control(
                'accordion_content_border_radius',
                [
                    'label' => __( 'Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single_accordion .accordion-body' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'content_box_shadow',
                    'label' => __( 'Box Shadow', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .single_accordion .accordion-body',
                    'separator' => 'before',
                ]
            );


        $this->end_controls_section(); // Content style tabs end

    }

    protected function render( $instance = [] ) {

        $settings           = $this->get_settings_for_display();
        $accordion_id       = $this->get_id();
        $accordion_list     = $settings['edubin_accordion_list'];

        $title_tag = edubin_validate_html_tag( $settings['accordion_title_html_tag'] );
        $title_class = 'class="accordion-title" ';
        $count_items = count($accordion_list);

        $data_id = [
            'accordion_id' => $accordion_id,
        ];
        $data_id = array_merge( $data_id );
        $this->add_render_attribute( 'item', 'class', 'accordion');
        // Js data pass
        $this->add_render_attribute( 'item', 'data-settings', wp_json_encode( $data_id ) );

        // for all item close
        if($settings['accordion_close_all'] === 'yes' ){
            $this->add_render_attribute( 'item', 'data-close-all', 'true' );
        }else{
            $this->add_render_attribute( 'item', 'data-close-all', 'false' );
        }

        // for specific item open
        if( !empty( $settings['current_item'] ) ){
            $current_item = $settings['current_item'];
            $current_item_index = $current_item - 1;
            $this->add_render_attribute( 'item', 'data-open-item', $current_item_index );
        }else{
            $this->add_render_attribute( 'item', 'data-open-item', 0 );
        }
        

        if ( $accordion_list ) {


            echo '<div ' . $this->get_render_attribute_string( 'item' ) . '>';
            if( !empty( $settings['current_item'] ) && $count_items >= $settings['current_item'] ){
                $current_item = $settings['current_item'];
            }else{
                $current_item = 1;
            }
                $i = 0;
                foreach ( $accordion_list as $item ) {
                    $i++;

                    echo '<div class="single_accordion edubin-icon-align-'.esc_attr( $settings['accordion_icon_align'] ).'">';
                        // Header 
                        
                            echo '<div class="edubin-accordion-header edubin-accordion-header'.$accordion_id.'">';
                                if($settings['accordion_icon_align']=='left'){
                                    echo '<span class="accordion-icon"><i class="flaticon-download edubin-icon edubin-icon'.$accordion_id.'"></i></span>';
                                }
                                echo '<'.esc_attr( $title_tag ).' '.$title_class.'>';
                                    echo edubin_kses_title( $item['accordion_title'] );
                                echo '</'.esc_attr( $title_tag ).'>';
                                if($settings['accordion_icon_align']=='right'){

                                    echo '<span class="accordion-icon"><i class="flaticon-download edubin-icon edubin-icon'.$accordion_id.'"></i></span>';
                                }
                            echo '</div>';
                        
                        

                        //Body
                        
                            echo '<div class="accordion-body accordion-body'.$accordion_id.'">';
                                echo '<div class="accordion-content">';
                                    // if( ( $current_item == $i ) && ( $settings['accordion_close_all'] != 'yes' ) ){
                                        if ( $item['content_source'] == 'custom' && !empty( $item['accordion_content'] ) ) {
                                            echo wp_kses_post( $item['accordion_content'] );
                                        } elseif ( $item['content_source'] == "elementor" && !empty( $item['template_id'] )) {
                                            echo Plugin::instance()->frontend->get_builder_content_for_display( $item['template_id'] );
                                        }
                                    // }
                                echo '</div>';
                            echo '</div>';
                        
                    echo '</div>';
            }
            echo '</div>';
          
        }
    }
}
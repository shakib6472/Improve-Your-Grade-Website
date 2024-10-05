<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Icon_Category extends Widget_Base {


    public function get_name() {
        return 'edubin-icon-category-addons';
    }

    public function get_title() {
        return __( 'Category Carousel', 'edubin-core' );
    }

    public function get_icon()
    {
        return 'edubin-elementor-icon eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['edubin-core'];
    }
    public function get_keywords() {
        return [ 'carousel', 'category', 'image carousel', 'addon', 'slider' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'carosul_content',
            [
                'label' => __('Icon Carousel', 'edubin-core'),
            ]
        );

        $this->add_control(
            'image_carosul_style',
            [
                'label'   => __('Style', 'edubin-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Style 1', 'edubin-core'),
                    '2' => __('Style 2', 'edubin-core'),
                    '3' => __('Style 3', 'edubin-core'),
                    '4' => __('Style 4', 'edubin-core'),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'carosul_image_title',
            [
                'label'       => __('Title', 'edubin-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Image Carosul Title.', 'edubin-core'),
            ]
        );

        $repeater->add_control(
            'carosul_image',
            [
                'label'   => __('Image', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'carosul_imagesize',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label'       => __('Link', 'edubin-core'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'edubin-core'),
                'default'     => [
                    'url' => '#',
                ],
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'bg_colors',
            [
                'label'     => __('Background Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
            ]
        );

        $repeater->add_control(
            'border_colors',
            [
                'label'     => __('Border Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
            ]
        );

        $repeater->add_control(
            'title_colors',
            [
                'label'     => __('Title Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
            ]
        );
        
        $repeater->end_controls_tab();

        $this->add_control(
            'carosul_image_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default'     => [

                    [
                        'carosul_image_title' => __('Item 1', 'edubin-core'),
                    ],
                    [
                        'carosul_image_title' => __('Item 2', 'edubin-core'),
                    ],
                    [
                        'carosul_image_title' => __('Item 3', 'edubin-core'),
                    ],
                    [
                        'carosul_image_title' => __('Item 4', 'edubin-core'),
                    ],

                ],
                'title_field' => '{{{ carosul_image_title }}}',
            ]
        );

        $this->add_control(
            'slider_on',
            [
                'label'        => __('Slider', 'edubin-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('On', 'edubin-core'),
                'label_off'    => __('Off', 'edubin-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        //Slider Options
        $this->start_controls_section(
            'testimonial_slider_option',
            [
                'label' => __( 'Slider Option', 'edubin-core' )
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'        => __( 'Infinite Loop', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => '',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'item_gap',
            [
                'label'        => __( 'Item Gap', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 20,
                'default'      => 20,
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
            ]
        );

        $this->add_control(
            'item_per_view',
            [
                'label'        => __( 'Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 3,
                'description'  => __( 'Numbers of item showed. Example value: 2', 'edubin-core' )
            ]
        );

        $this->add_control(
            'center_slides',
            [
                'label'        => __( 'Center Slides', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => __( 'Autoplay', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'        => __( 'Autoplay Speed', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 3000,
                'condition'    => [
                    'autoplay' => 'yes'
                ],
                'description'  => __( 'Speed in milliseconds. Example value: 3000', 'edubin-core' )
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'        => __( 'Pause On Hover', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                
            ]
        );

        $this->add_control(
            'pause_on_interaction',
            [
                'label'        => __( 'Pause On Interaction', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                
            ]
        );

        $this->add_control(
            'sl_navigation',
            [
                'label'        => __( 'Navigation', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sl_pagination',
            [
                'label'        => __( 'Pagination', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        //Tablet Breakpoints Controls 
        $this->add_control(
			'tablet_breakpoint_heading',
			[
				'label' => esc_html__( 'Tablet', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        // $this->add_control(
        //     'tablet_breakpoint',
        //     [
        //         'label'        => __( 'Tablet Breakpoint', 'edubin-core' ),
        //         'type'         => Controls_Manager::NUMBER,
        //         'description'  => __( 'Tablet Device Breakpoint in px. Example value: 998', 'edubin-core' )
        //     ]
        // );

        $this->add_control(
            'center_slides_tablet',
            [
                'label'        => __( 'Center Slides', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'tablet_item_gap',
            [
                'label'        => __( 'Tablet Item Gap', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 20,
                'default'      => 20,
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
            ]
        );

        $this->add_control(
            'tablet_item_per_view',
            [
                'label'        => __( 'Tablet Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'default'  => 2,
                'description'  => __( 'Numbers of item showed. Example value: 2', 'edubin-core' )
            ]
        );

        //Mobile Breakpoints Controls 
        $this->add_control(
			'mobile_breakpoint_heading',
			[
				'label' => esc_html__( 'Mobile', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        // $this->add_control(
        //     'mobile_breakpoint',
        //     [
        //         'label'        => __( 'Mobile Breakpoint', 'edubin-core' ),
        //         'type'         => Controls_Manager::NUMBER,
        //         'description'  => __( 'Mobile Device Breakpoint in px. Example value: 576', 'edubin-core' )
        //     ]
        // );
        $this->add_control(
            'center_slides_mobile',
            [
                'label'        => __( 'Center Slides', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'mobile_item_gap',
            [
                'label'        => __( 'Mobile Item Gap', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 20,
                'default'      => 20,
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
            ]
        );

        $this->add_control(
            'mobile_item_per_view',
            [
                'label'        => __( 'Mobile Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'default'  => 1,
                'description'  => __( 'Numbers of item showed. Example value: 2', 'edubin-core' )
            ]
        );

        $this->end_controls_section();


        // Category item style start
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'edubin-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'category_text_align',
			[
				'label' => esc_html__( 'Alignment', 'edubin-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'edubin-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'edubin-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'edubin-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .edubin-icon-category' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'item_height',
            [
                'label'      => __('Height', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-cat-carousel .edubin-icon-category .single-category' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label'      => __('Width', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-cat-carousel .edubin-icon-category .single-category' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__( 'Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tpc-cat-carousel .edubin-icon-category .single-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .tpc-cat-carousel .swiper-slide .edubin-icon-category .single-category',
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tpc-cat-carousel .swiper-slide .edubin-icon-category .single-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_indent',
            [
                'label'      => __('Intent', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-cat-carousel .edubin-icon-category .icon-category-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // Style Section End


         // Image Style
         $this->start_controls_section(
            'edubin_carousel_item_size',
            [
                'label'     => __('Image', 'edubin-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label'     => __('Image Width', 'edubin-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-icon-category .single-category img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
       

        $this->end_controls_section(); // Image Style End

         // Category Name Style
        $this->start_controls_section(
            'category_name_section',
            [
                'label' => __('Category Name', 'edubin-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('title_style_tabs');

        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __('Normal', 'edubin-core'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Category Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-icon-category .single-category .icon-category-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Category Typography', 'edubin-core'),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-icon-category .icon-category-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __('Hover', 'edubin-core'),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label'     => __('Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-icon-category .single-category .icon-category-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab(); // Hover Tab end

        $this->end_controls_tabs();
        $this->end_controls_section();
        // Title style end

        // Style Dots style start
        $this->start_controls_section(
            'edubin_carousel_dots_style',
            [
                'label'     => __( 'Pagination', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'sl_pagination'  => 'yes',
                ],
            ]
        );
            
            $this->start_controls_tabs( 'carousel_dots_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'carousel_dots_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_responsive_control(
                        'carousel_dots_pagination_align',
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
                                '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_dots_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'edubin_carousel_dots_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet',
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_size',
                        [
                            'label' => __( 'Dots Size', 'edubin-core' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 20,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 12,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_position_x',
                        [
                            'label' => __( 'Horizontal Position', 'edubin-core' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -100,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_pagination_margin',
                        [
                            'label' => __( 'Dot Gap', 'edubin-core' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
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
                                '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}} !important;; margin-right: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'carousel_dots_style_hover_tab',
                    [
                        'label' => __( 'Active', 'edubin-core' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_dots_hover_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'edubin_carousel_dots_hover_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );


                $this->end_controls_tab(); // Active tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Pagination style end



        // Style Navigation style start
        $this->start_controls_section(
            'edubin_carousel_nav_style',
            [
                'label'     => __( 'Navigation', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'sl_navigation'  => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'next_offset',
            [
                'label'      => __('Next Arrow Offset', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-category-carousel-wrapper .cat-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'prev_offset',
            [
                'label'      => __('Previous Arrow Offset', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-category-carousel-wrapper .cat-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
            
            $this->start_controls_tabs( 'carousel_nav_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'carousel_nav_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                $this->add_control(
                    'nav-arrow_color',
                    [
                        'label' => esc_html__( 'Navigation Arrow Color', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .cat-next::after' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .cat-prev::after' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                    

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'carousel_nav_style_hover_tab',
                    [
                        'label' => __( 'Active', 'edubin-core' ),
                    ]
                );

                $this->add_control(
                    'nav-arrow_color_hover',
                    [
                        'label' => esc_html__( 'Navigation Arrow Color Hover', 'edubin-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .cat-next:hover:after' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-category-carousel-wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .cat-prev:hover:after' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                    

                $this->end_controls_tab(); // Active tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Navigation style end
        

    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        $direction = is_rtl() ? 'true' : 'false';

        //Pagination Active Class
        $pg_class = ( $settings['sl_pagination'] == 'yes' ) ? ('edubin-pagination'):('');
        //Pagination Active Class
        $navi_class = ( $settings['sl_navigation'] == 'yes' ) ? ('edubin-navigation'):('');

        // Pass
        $slider_settings = [
            'infinite_loop' => ('yes' === $settings['infinite_loop']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'autoplay_speed' => absint($settings['autoplay_speed']),
            'display_columns' => $settings['item_per_view'],
            'item_gap' => $settings['item_gap'],
            'center_slides' => ('yes' === $settings['center_slides']),
            'pause_on_hover' => ('yes' === $settings['pause_on_hover']),
            'pause_on_interaction' => ('yes' === $settings['pause_on_interaction']),
            //Tablet Settings
            // 'tablet_breakpoint' => $settings['tablet_breakpoint'],
            'display_columns_tablet' => $settings['tablet_item_per_view'],
            'tablet_item_gap' => $settings['tablet_item_gap'],
            'center_slides_tablet' => ('yes' === $settings['center_slides_tablet']),
            //Mobile Settings
            // 'mobile_breakpoint' => $settings['mobile_breakpoint'],
            'display_columns_mobile' => $settings['mobile_item_per_view'],
            'mobile_item_gap' => $settings['mobile_item_gap'],
            'center_slides_mobile' => ('yes' === $settings['center_slides_mobile']),

        ];
        $slider_settings = array_merge( $slider_settings );
        // for style 5 and
        if($settings['image_carosul_style'] == 5){
            $this->add_render_attribute( 'wrapper', 'class', 'edubin-category-style-2');
        }

        $this->add_render_attribute( 'wrapper', 'class', 'tpc-category-carousel-wrapper edubin-category-style-'. esc_attr( $settings['image_carosul_style'] ).' '.$pg_class.' '.$navi_class);
        // Js data pass
        $this->add_render_attribute( 'wrapper', 'data-settings', wp_json_encode( $slider_settings ) );

        $this->add_render_attribute( 'container', 'class', 'tpc-cat-carousel tpc-category-style-'. esc_attr( $settings['image_carosul_style'] ));
        $sliderWrapper = 'swiper-wrapper';
        $sliderItem = 'swiper-slide';
       
        $this->add_render_attribute( 'container', 'class', 'swiper swiper-container' );

        $this->add_render_attribute( 'swiper', 'class', $sliderWrapper );

        if ( 'yes' === $settings['autoplay'] ) :
            $this->add_render_attribute( 'swiper', 'data-autoplay', 'true' );
            $this->add_render_attribute( 'swiper', 'data-autoplayspeed', intval( esc_attr( $settings['autoplay_speed'] ) ) );
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
           
                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                        foreach( $settings['carosul_image_list'] as $key => $cat_carousel ) : 
                            
                            $each_item = $this->get_repeater_setting_key('carosul_image_title', 'carosul_image_list', $key);
                            $item_class = ['item-wrap'];
                            $this->add_render_attribute( $each_item, 'class', $item_class );
                            $this->add_render_attribute( $each_item, 'class', 'elementor-repeater-item-'. esc_attr( $cat_carousel['_id'] ) );
                            echo '<div class="' . esc_attr( $sliderItem ) . '">';
                                echo '<div ' . $this->get_render_attribute_string( $each_item ) . '>';
                                    include EDUBIN_PLUGIN_DIR . 'elementor/widgets/tpl-part/category/category_carousel_'. $settings['image_carosul_style'] .'.php';
                                    
                                echo '</div>';
                            echo '</div>';
                        endforeach;
                    echo '</div>';
                    
                echo '</div>';
                if ( 'yes' === $settings['sl_pagination'] ) :
                    echo '<div class="category-pagination swiper-pagination"></div>';
                endif;
                if ( 'yes' === $settings['sl_navigation'] ) :
                    echo '<div class="cat-next"><i class="flaticon-next"></i></div>
                    <div class="cat-prev"><i class="flaticon-back-1"></i></div>';
                endif;

        echo '</div>';
       
    }

}


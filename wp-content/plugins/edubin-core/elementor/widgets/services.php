<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class edubin_Elementor_Widget_Services_Box extends Widget_Base {

    public function get_name()
    {
        return 'edubin-services-box';
    }

    public function get_title()
    {
        return __('Services', 'edubin-core');
    }

    public function get_icon()
    {
        return 'edubin-elementor-icon eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['edubin-core'];
    }

    public function get_script_depends()
    {
        return [
            'edubin-active',
        ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'carosul_content',
            [
                'label' => __('Content', 'edubin-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon_image',
            [
                'label'   => __('Choose Your Image', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'icon_imagesize',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );
        $repeater->add_control(
            'b_icon_image',
            [
                'label'   => __('Icon Image', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('/edubin-core/assets/images/ba.png'),
                ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'b_icon_imagesize',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );
        $repeater->add_control(
            'services_title',
            [
                'label'       => __('Service Title', 'edubin-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Science', 'edubin-core'),
            ]
        );
        $repeater->add_control(
            'content',
            [
                'label'       => __('Content', 'edubin-core'),
                'type'        => Controls_Manager::TEXT,
                'default' => 'You can start and finish one of these popular courses in under a day - for free! Check out the list below',
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label'       => __('Title Link', 'edubin-core'),
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
                'label'   => __('Background Color', 'edubin-core'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'icon_image_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default'     => [

                    [
                        'services_title' => __('Service Title', 'edubin-core'),
                    ],

                ],
                'title_field' => '{{{ services_title }}}',
            ]
        );

        $this->add_control(
            'carousel_on_off',
            [
                'label'        => __('Carousel', 'edubin-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('On', 'edubin-core'),
                'label_off'    => __('Off', 'edubin-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'default_scroll_animation',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Scroll Animation', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'carousel_on_off!' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // Slider setting
        $this->start_controls_section(
            'carosul_slider_option',
            [
                'label'     => __('Carousel Option', 'edubin-core'),
                'condition' => [
                    'carousel_on_off' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'        => __( 'Infinite Loop', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'item_gap',
            [
                'label'        => __( 'Item Gap', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 20,
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
            ]
        );

        $this->add_control(
            'slitems',
            [
                'label'        => __( 'Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 3,
                'description'  => __( 'Numbers of item showed. Example value: 2', 'edubin-core' )
            ]
        );

        $this->add_control(
            'slcentermode',
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
            'slautolay',
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
            'slautoplay_speed',
            [
                'label'        => __( 'Autoplay Speed', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 3000,
                'condition'    => [
                    'slautolay' => 'yes'
                ],
                'description'  => __( 'Speed in milliseconds. Example value: 3000', 'edubin-core' )
            ]
        );

        $this->add_control(
            'slpause_on_hover',
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
            'slarrows',
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
            'sldots',
            [
                'label'        => __( 'Pagination', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
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
            'slcentermode_tablet',
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
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
            ]
        );

        $this->add_control(
            'sltablet_display_columns',
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
            'slcentermode_mobile',
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
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
            ]
        );

        $this->add_control(
            'slmobile_display_columns',
            [
                'label'        => __( 'Mobile Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'default'  => 1,
                'description'  => __( 'Numbers of item showed. Example value: 2', 'edubin-core' )
            ]
        );

        $this->end_controls_section(); // Carousel Option end

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'edubin-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_image_max_size',
            [
                'label'       => __('Icon Image Size', 'edubin-core'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 20,
                        'max' => 120,
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .edubin-services-wrapper .cat-icon-img img ' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'edubin-core'),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-services-wrapper .cat-title',
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_border_radius',
            [
                'label'     => __('Border Radius', 'edubin-core'),
                'type'      => Controls_Manager::DIMENSIONS,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .edubin-services-wrapper .services-single-item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_responsive_control(
            'edubin_cat_box_padding',
            [
                'label'      => __('Padding', 'edubin-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-services-wrapper .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // Slider Option end


        // Style arrow style start
        $this->start_controls_section(
            'edubin_cat_box_arrow_style',
            [
                'label'     => __('Navigation Arrow', 'edubin-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'carousel_on_off' => 'yes',
                    'slarrows'    => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('cat_box_arrow_style_tabs');

        // Normal tab Start
        $this->start_controls_tab(
            'cat_box_arrow_style_normal_tab',
            [
                'label' => __('Normal', 'edubin-core'),
            ]
        );

        $this->add_control(
            'edubin_cat_box_arrow_color',
            [
                'label'     => __('Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-style button.slick-arrow i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_arrow_fontsize',
            [
                'label'      => __('Font Size', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 28,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-carousel-style button.slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'arrow_bg_color',
            [
                'label'     => __('Background Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-style button.edubin-carosul-prev.slick-arrow, .edubin-carousel-style button.edubin-carosul-next.slick-arrow' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'edubin_cat_box_arrow_border',
                'label'    => __('Border', 'edubin-core'),
                'selector' => '{{WRAPPER}} .edubin-carousel-style button.edubin-carosul-prev.slick-arrow, .edubin-carousel-style button.edubin-carosul-next.slick-arrow',
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_arrow_border_radius',
            [
                'label'     => __('Border Radius', 'edubin-core'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-style button.edubin-carosul-prev.slick-arrow, .edubin-carousel-style button.edubin-carosul-next.slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_arrow_height',
            [
                'label'      => __('Arrow Size', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 70,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-carousel-style button.edubin-carosul-prev.slick-arrow, .edubin-carousel-style button.edubin-carosul-next.slick-arrow' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab(); // Normal tab end

        // Hover tab Start
        $this->start_controls_tab(
            'cat_box_arrow_style_hover_tab',
            [
                'label' => __('Hover', 'edubin-core'),
            ]
        );

        $this->add_control(
            'edubin_cat_box_arrow_hover_color',
            [
                'label'     => __('Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-style button.slick-arrow:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label'     => __('Background Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-style button.slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'edubin_cat_box_arrow_hover_border',
                'label'    => __('Border', 'edubin-core'),
                'selector' => '{{WRAPPER}} .edubin-icon-category-style-1 .slick-arrow:hover',
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_arrow_hover_border_radius',
            [
                'label'     => __('Border Radius', 'edubin-core'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .edubin-icon-category-style-1 .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_tab(); // Hover tab end

        $this->end_controls_tabs();

        $this->end_controls_section(); // Style cat box arrow style end

        // Style cat box Dots style start
        $this->start_controls_section(
            'edubin_cat_box_dots_style',
            [
                'label'     => __('Dot Pagination', 'edubin-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'carousel_on_off' => 'yes',
                    'sldots'    => 'yes',
                ],
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
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('cat_box_dots_style_tabs');

        // Normal tab Start
        $this->start_controls_tab(
            'cat_box_dots_style_normal_tab',
            [
                'label' => __('Normal', 'edubin-core'),
            ]
        );

        $this->add_control(
            'dot_color',
            [
                'label'     => __('Dot Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_dots_height',
            [
                'label'      => __('Dot Size', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'edubin_cat_box_dots_space',
            [
                'label'      => __('Space Between', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}} !important;; margin-right: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'edubin_cat_box_dots_position',
            [
                'label'      => __('Dot Position', 'edubin-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -100,
                        'max'  => 10,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'edubin_carousel_dots_border',
                'label' => __( 'Border', 'edubin-core' ),
                'selector' => '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet',
            ]
        );

        $this->add_responsive_control(
            'edubin_carousel_dots_border_radius',
            [
                'label' => __( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_tab(); // Normal tab end

        // Hover tab Start
        $this->start_controls_tab(
            'cat_box_dots_style_hover_tab',
            [
                'label' => __('Active', 'edubin-core'),
            ]
        );
        $this->add_control(
            'dot_hover_color',
            [
                'label'     => __('Dot Active Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'edubin_carousel_dots_border_active',
                'label' => __( 'Border', 'edubin-core' ),
                'selector' => '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->add_responsive_control(
            'edubin_carousel_dots_border_radius_active',
            [
                'label' => __( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tpc-service-carousel-wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_tab(); // Active tab end

        $this->end_controls_tabs();

        $this->end_controls_section(); // Style cat box dots style end

    }

    protected function render($instance = [])
    {


        $settings = $this->get_settings_for_display();
        $direction = is_rtl() ? 'true' : 'false';


        if($settings['carousel_on_off'] != 'yes'){
       
            $this->add_render_attribute( 'wrapper', 'class', 'tpc-service-carousel-wrapper edubin-services-wrapper edubin-custom-carousel');
           
        }else{
            $this->add_render_attribute( 'wrapper', 'class', 'tpc-service-carousel-wrapper edubin-services-wrapper');
            if($settings['sldots'] == 'yes'){
                $this->add_render_attribute( 'wrapper', 'class', 'edubin-pagination');
            };
            if($settings['slarrows'] == 'yes'){
                $this->add_render_attribute( 'wrapper', 'class', 'edubin-navigation');
            };
        };
        // Js data pass
        
        // $sliderWrapper = 'swiper-wrapper';
        // $sliderItem = 'swiper-slide';

        if($settings['carousel_on_off'] == 'yes'){
            
            $this->add_render_attribute( 
                'swiper', 
                [

                    'data-infiniteLoop'             => ('yes' === $settings['infinite_loop']) ? ('true') : ('false'),
                    'data-autoplay'                  => ('yes' === $settings['slautolay']) ? ('true') : ('false'),
                    'data-autoplaySpeed'            => absint($settings['slautoplay_speed']),
                    'data-displayColumns'           => intval( esc_attr($settings['slitems'])),
                    'data-itemGap'                  => intval( esc_attr( $settings['item_gap'])),
                    'data-pauseOnHover'            => ('yes' === $settings['slpause_on_hover']) ? ('true') : ('false'),
                    'data-pauseOnInteraction'      => ('yes' === $settings['pause_on_interaction']) ? ('true') : ('false'),
                    //Tablet Settings
                    //'tablet_breakpoint'       => $settings['tablet_breakpoint'],
                    'data-displayColumnsTablet'    => intval( esc_attr( $settings['sltablet_display_columns'])),
                    'data-tabletItemGap'           => intval( esc_attr($settings['tablet_item_gap'])),
                    //Mobile Settings
                    //'mobile_breakpoint'       => $settings['mobile_breakpoint'],
                    'data-displayColumnsMobile'    => intval( esc_attr($settings['slmobile_display_columns'])),
                    'data-mobileItemGap'           => intval( esc_attr($settings['mobile_item_gap'])),
                ]
            );

            // $slider_settings = array_merge( $slider_settings );
            $this->add_render_attribute( 'container', 'class', 'edubin-service-activation edubin-carousel-style ');
            $this->add_render_attribute( 'container', 'class', 'swiper swiper-container' );
            $this->add_render_attribute( 'swiper', 'class', 'swiper-wrapper' );
        };

        $container = ($settings['carousel_on_off'] == 'yes') ? ('<div ' . $this->get_render_attribute_string( 'container' ) . '>') : ('');
        $container_close = ($settings['carousel_on_off'] == 'yes') ? ('</div>') : ('');
        $swiper = ($settings['carousel_on_off'] == 'yes') ? ('<div ' . $this->get_render_attribute_string( 'swiper' ) . '>') : ('');
        $swiper_close = ($settings['carousel_on_off'] == 'yes') ? ('</div>') : ('');
 
         if ( 'yes' === $settings['slautolay'] ) {
            $this->add_render_attribute( 'swiper', 'data-autoplay', 'true' );
            $this->add_render_attribute( 'swiper', 'data-autoplayspeed', intval( esc_attr( $settings['slautoplay_speed'] ) ) );
         };

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo $container;
                echo $swiper;

                foreach( $settings['icon_image_list'] as $key => $imagecarosul ){
                    $each_item = $this->get_repeater_setting_key('services_title', 'icon_image_list', $key);
                    // for link validation 
                    $service_link_url = $imagecarosul['link']['url'];
                    $is_external = ($imagecarosul['link']['is_external']) ? ('target="_blank"'): ('');
                    $is_nofollow = ($imagecarosul['link']['nofollow']) ? ('rel="nofollow"'): ('');
                    $link_tag = ($imagecarosul['link']['url']) ? ('<a href="'.esc_url($service_link_url).'" '.$is_external.' '.$is_nofollow.'>'): ('');
                    $link_end_tag = ($imagecarosul['link']['url']) ? ('</a>'): ('');

                    $animation_attribute = '';
                    if ( $settings['carousel_on_off'] != 'yes' ) :
                        if ( 'yes' === $settings['default_scroll_animation'] ) :
                            $animation_attribute = ' data-sal';
                        endif;
                    endif;


                    $bg_color = esc_attr__($imagecarosul['bg_colors']);
                    if($settings['carousel_on_off'] == 'yes'){
                    echo '<div class="swiper-slide">';
                    };
                        echo '<div class="services-single-wrap" '.esc_attr($animation_attribute).'>';
                            echo '<div class="services-single-item text-center" style="'.$bg_color.'">';
                                echo $link_tag;
                                    echo '<div class="cat-icon-img">';
                                        echo Group_Control_Image_Size::get_attachment_image_html($imagecarosul, 'icon_imagesize', 'icon_image');
                                    echo '</div>';
                                echo $link_end_tag;

                                echo '<div class="cat-balloon-img">';
                                    echo Group_Control_Image_Size::get_attachment_image_html($imagecarosul, 'b_icon_imagesize', 'b_icon_image');
                                echo '</div>';
                                echo $link_tag;
                                    echo '<h3 class="cat-title">';
                                        echo $imagecarosul['services_title'];
                                    echo '</h3>';
                                echo $link_end_tag;

                                echo '<p class="edubin-cat-content">';
                                    echo $imagecarosul['content'];
                                echo '</p>';
                            echo '</div>';
                        echo '</div>';
                    if($settings['carousel_on_off'] == 'yes'){
                        echo '</div>';
                    }

                };


                
                echo $swiper_close;
                if ( 'yes' === $settings['sldots'] ) :
                    echo '<div class="swiper-pagination service-pagination"></div>';
                endif;
                if ( 'yes' === $settings['slarrows'] ) :
                    echo '<div class="service-pg-next swiper-button-next"></div>
                    <div class="service-pg-prev swiper-button-prev"></div>';
                endif;
        echo $container_close;
        echo '</div>';
        //------------------------------------------------

        
    }

}

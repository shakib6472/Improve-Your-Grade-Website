<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Woo_Product extends Widget_Base {

    public function get_name()
    {
        return 'edubin-woo-product-addons';
    }

    public function get_title() {
        return esc_html__( 'Woo Product', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-products';
    }

    public function get_keywords() {
        return [ 'WooCommerce', 'woo', 'products' , 'product', 'shop' ];
    }
    public function get_categories() {
        return [ 'edubin-core' ];
    }

    // public function get_script_depends() {
    //     return [
    //         // 'slick',
    //         'edubin-widgets-scripts',
    //     ];
    // }

    protected function register_controls() {

        $this->start_controls_section(
            'woo_products_section',
            [
                'label' => esc_html__( 'Products', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'posts_column',
            [
                'label' => esc_html__('Items Column', 'edubin-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('4 Column', 'edubin-core'),
                    '4' => esc_html__('3 Column', 'edubin-core'),
                    '6' => esc_html__('2 Column', 'edubin-core'),
                ],
                'condition'=>[
                    'carousel_on_off!'=> 'yes',
                ]
            ]
        );

        $this->add_control(
            'carusel_items_column',
            [
                'label' => esc_html__( 'Items Column', 'edubin-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 3,
                'condition'=>[
                    'carousel_on_off'=>'yes',
                ]
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label' => esc_html__('Number of Product', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'custom_order',
            [
                'label' => esc_html__( 'Custom Order', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending','edubin-core'),
                    'ASC'   => esc_html__('Ascending','edubin-core'),
                ],
                'condition' => [
                    'custom_order!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Orderby', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'none'          => esc_html__('None','edubin-core'),
                    'ID'            => esc_html__('ID','edubin-core'),
                    'date'          => esc_html__('Date','edubin-core'),
                    'name'          => esc_html__('Name','edubin-core'),
                    'title'         => esc_html__('Title','edubin-core'),
                    'comment_count' => esc_html__('Comment count','edubin-core'),
                    'rand'          => esc_html__('Random','edubin-core'),
                ],
                'condition' => [
                    'custom_order' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'woo_shop_category',
            [
                'label' => esc_html__('Select Category', 'edubin-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => edubin_wooocommerce_shop_get_taxonomies(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'carousel_on_off',
            [
                'label' => esc_html__( 'Slider', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'separator'=>'before',
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
        $this->add_control(
            'title_length',
            [
                'label' => esc_html__( 'Title Length', 'edubin-core' ),
                'type' => Controls_Manager::NUMBER,
                'step' => 1,
                'default' => 5,
                'separator'=>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'large',
                'separator' => 'none',
            ]
        );
        $this->end_controls_section();

        //Slider Options
        $this->start_controls_section(
            'woo_slider_option',
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
                'description'  => __( 'Gap for each item in px. Example value: 20', 'edubin-core' )
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
            'nav_arrow_style',
            [
                'label' => __( 'Nav Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'edubin-core' ),
                    '2'   => __( 'Style 2', 'edubin-core' ),
                ],
                'condition' => [
                     'slarrows'=>'yes',
                ]
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


        // Style Meta tab section
        $this->start_controls_section(
            'post_meta_style_section',
            [
                'label' =>esc_html__( 'Meta', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        
        $this->add_control(
            'title_color',
            [
                'label' =>esc_html__( 'Product Name Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-product-inner .content .woocommerce-loop-product__title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' =>esc_html__( 'Title Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-single-product-inner .content .woocommerce-loop-product__title',
            ]
        );

        $this->add_control(
			'price_options',
			[
				'label' => esc_html__( 'Price Options', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' =>esc_html__( 'Price Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .woocommerce div.product .edubin-single-product-main-content-wrapper p.price, .woocommerce .edubin-yith-wcqv-wrapper .product-pricing .price, .woocommerce .edubin-single-product-inner .content .price',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' =>esc_html__( 'Price Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce div.product .edubin-single-product-main-content-wrapper p.price, .woocommerce .edubin-yith-wcqv-wrapper .product-pricing .price, .woocommerce .edubin-single-product-inner .content .price' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'woocomm_button_style',
            [
                'label'     =>esc_html__( 'Button', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' =>esc_html__( 'Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a',
            ]
        );

        $this->start_controls_tabs(
			'woo_style_tabs'
		);

		$this->start_controls_tab(
			'woo_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'edubin-core' ),
			]
		);

        $this->add_control(
            'button_color',
            [
                'label' =>esc_html__( 'Price Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} ..edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' =>esc_html__( 'Background Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} ..edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a' => 'background: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'woo_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'edubin-core' ),
			]
		);

        $this->add_control(
            'button_color_hover',
            [
                'label' =>esc_html__( 'Price Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} ..edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' =>esc_html__( 'Background Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} ..edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a' => 'background: {{VALUE}}',
                ],
            ]
        );


		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

        // Style Slider arrow style start
        $this->start_controls_section(
            'woocomm_arrow_style',
            [
                'label'     =>esc_html__( 'Arrow', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slarrows'  => 'yes',
                ],
            ]
        );
        
            $this->start_controls_tabs( 'woocomm_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'woocomm_arrow_style_normal_tab',
                    [
                        'label' =>esc_html__( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'arrow_color',
                        [
                            'label' =>esc_html__( 'Icon Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-1' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-2' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'arrow_position',
                        [
                            'label' =>esc_html__( 'Position', 'edubin-core' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => -100,
                                    'max' => 200,
                                    'step' => 1,
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-1' => 'top: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-2' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'arrow_bg_color',
                        [
                            'label' =>esc_html__( 'Background', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-1' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-2' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'course_arrow_border',
                            'label' =>esc_html__( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-1,.woocommerce-product-addon .edubin-arrow-style-2',
                        ]
                    );

                    $this->add_responsive_control(
                        'course_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-1' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .woocommerce-product-addon .edubin-arrow-style-2' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'woocomm_arrow_style_hover_tab',
                    [
                        'label' =>esc_html__( 'Hover', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label' =>esc_html__( 'Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_hover_background',
                            'label' =>esc_html__( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_hover_border',
                            'label' =>esc_html__( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .edubin-carousel-activation button.slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style arrow style end

        // Style Dot section
        $this->start_controls_section(
            'course_dot_style_section',
            [
                'label' =>esc_html__( 'Dot', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'sl_pagination'=>'yes',
               ]
            ]
        );
        $this->add_responsive_control(
            'dot_size',
            [
                'label' =>esc_html__( 'Dot Size', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_position',
            [
                'label' =>esc_html__( 'Position', 'edubin-core' ),
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
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_space_between',
            [
                'label' =>esc_html__( 'Space Between', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-carousel-activation .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Course body style
        $this->start_controls_section(
            'course_layout_style_section',
            [
                'label' =>esc_html__( 'Layout', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('body_box_tabs');

                $this->start_controls_tab(
                    'body_box_normal_tab',
                    [
                        'label' =>esc_html__( 'Normal', 'edubin-core' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow',
                        'selector' => '{{WRAPPER}} .edubin-single-course',
                    ]
                );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'body_box_hover_tab',
                    [
                        'label' =>esc_html__( 'Hover', 'edubin-core' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [   'label' =>esc_html__( 'Box Shadow Hover', 'edubin-core' ),
                        'name' => 'box_shadow_hover',
                        'selector' => '{{WRAPPER}} .edubin-single-course:hover',
                    ]
                );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();
            
         $this->add_control(
            'course_bg_color',
            [
                'label' =>esc_html__( 'Background', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-course .course-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $order          = $this->get_settings_for_display('order');
        $post_limit          = $this->get_settings_for_display('post_limit');

         //Pagination Active Class
         $pg_class = ( $settings['sl_pagination'] == 'yes' ) ? ('edubin-pagination'):('');
         //Pagination Active Class
         $navi_class = ( $settings['slarrows'] == 'yes' ) ? ('edubin-navigation'):('');

        if ($settings['carousel_on_off'] != 'yes'){
            // Main Wrapper
            $this->add_render_attribute( 'main_wrapper', 'class', 'woocommerce woocommerce-addons-wrapper' );
            // Product Wrapper
            $this->add_render_attribute( 'wrapper', 'class', 'edubin-row' );
            // Product  Column
            $this->add_render_attribute( 'column', 'class', ' edubin-col-12 edubin-col-sm-6 edubin-col-md-6 edubin-col-lg-'.$settings['posts_column'] );
            // $this->add_render_attribute( 'column', 'data-sal', '');
        }else{
            // Main Wrapper
            $this->add_render_attribute( 'main_wrapper', 'class', 'woocommerce woocommerce-addons-wrapper woocommerce-addons-wrapper-active swiper'.' '.$pg_class.' '.$navi_class );
             // Product Wrapper
             $this->add_render_attribute( 'wrapper', 'class', 'swiper-wrapper' );
             // Product  Column
             $this->add_render_attribute( 'column', 'class', 'swiper-slide' );
            // Swiper Settings
             $this->add_render_attribute( 
                'wrapper', 
                [
    
                    'data-infiniteLoop'             => ('yes' === $settings['infinite_loop']) ? ('true') : ('false'),
                    'data-autoplay'                  => ('yes' === $settings['slautolay']) ? ('true') : ('false'),
                    'data-autoplaySpeed'            => absint($settings['slautoplay_speed']),
                    'data-displayColumns'           => intval( esc_attr($settings['carusel_items_column'])),
                    'data-itemGap'                  => intval( esc_attr( $settings['item_gap'])),
                    'data-centerSlides'             => ('yes' === $settings['slcentermode']) ? ('true') : ('false'),
                    'data-pauseOnHover'            => ('yes' === $settings['slpause_on_hover']) ? ('true') : ('false'),
                    'data-pauseOnInteraction'      => ('yes' === $settings['pause_on_interaction']) ? ('true') : ('false'),
                    //Tablet Settings
                    //'tablet_breakpoint'       => $settings['tablet_breakpoint'],
                    'data-displayColumnsTablet'    => intval( esc_attr( $settings['tablet_item_per_view'])),
                    'data-tabletItemGap'           => intval( esc_attr($settings['tablet_item_gap'])),
                    'data-centerSlidesTablet'      => ('yes' === $settings['center_slides_tablet']),
                    //Mobile Settings
                    //'mobile_breakpoint'       => $settings['mobile_breakpoint'],
                    'data-displayColumnsMobile'    => intval( esc_attr($settings['mobile_item_per_view'])),
                    'data-mobileItemGap'           => intval( esc_attr($settings['mobile_item_gap'])),
                    'data-centerSlidesMobile'      => ('yes' === $settings['center_slides_mobile']),
                ]
            );
        }
       
            // $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            // $this->add_render_attribute( 'edubin_course_carousel_attr', 'data-settings', wp_json_encode( $slider_settings ) );
       
        // Query
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $post_limit,
            'order'                 => $order
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }
        if( !empty($settings['woo_shop_category']) ){
            $get_categories = $settings['woo_shop_category'];
        }else{
           $get_categories = $settings['woo_shop_category'];
        }

            $tribe_events_cats = str_replace(' ', '', $get_categories);

            if (  !empty( $get_categories ) ) {
                if( is_array($tribe_events_cats) && count($tribe_events_cats) > 0 ){
                    $field_name = is_numeric( $tribe_events_cats[0] ) ? 'term_id' : 'slug';
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'product_cat',
                            'terms' => $tribe_events_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                );
             }
        }

        $query = new \WP_Query( $args ); 
        echo '<div class="woocommerce-product-addon">';
            echo '<div ' . $this->get_render_attribute_string('main_wrapper') . '>';
                echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

                if (class_exists('WooCommerce')) {

                    if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                            global $product;

                            $animation_attribute = '';
                            if ( $settings['carousel_on_off'] != 'yes' ) :
                                if ( 'yes' === $settings['default_scroll_animation'] ) :
                                    $animation_attribute = ' data-sal';
                                endif;
                            endif;
                            echo '<div ' . $this->get_render_attribute_string('column') . ''.esc_attr($animation_attribute).'>';

                                 wc_get_template('tpl-part/layout.php');
         
                            echo '</div>';
                        endwhile;
                        wp_reset_postdata();
                        wp_reset_query();
                    endif;

                    } else {
                         echo '<p>' . esc_html__('WooCommerce is not running. ', 'edubin-core') . '<a href="' . esc_url(admin_url('plugins.php')) . '">' . esc_html__('Activate WooCommerce', 'edubin-core') . '</a></p>';
                    }

                echo '</div>';
            echo '</div>';

            if ( 'yes' === $settings['sl_pagination'] && $settings['carousel_on_off']=='yes' ) {
                echo '<div class="woo-pagination swiper-pagination"></div>';
            };
            if ( 'yes' === $settings['slarrows'] && $settings['carousel_on_off']=='yes' ) {
                echo '<div class="edubin-arrow-style-'.$settings['nav_arrow_style'].' next-icon woo-next"><i class="flaticon-next"></i></div>
                <div class="edubin-arrow-style-'.$settings['nav_arrow_style'].' prev-icon woo-prev"><i class="flaticon-back-1"></i></div>';
            };

        echo '</div>';
    }

}


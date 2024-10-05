<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Title extends Widget_Base {

    public function get_name() {
        return 'custom-title-addons';
    }
    
    public function get_title() {
        return __( 'Custom Title', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-heading';
    }
    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_keywords() {
        return ['title', 'heading', 'edubin', 'addons'];
    }
    
    public function get_help_url() {
        return 'https://thepixelcurve.com/docs/general-widgets/call-to-action-widget/';
    }
    protected function register_controls()
    {
        /*-----------------------------------------------------------------------------------*/
        /*  CONTENT -> GENERAL
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'tpc_double_headings_section',
            ['label' => esc_html__('General', 'edubin-core')]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'edubin-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => ['active' => true],
                'placeholder' => esc_attr__('ex: About Us', 'edubin-core'),
                'default' => esc_html__('Subtitle', 'edubin-core'),
            ]
        );

        $this->add_control(
            'dbl_title',
            [
                'label' => esc_html__('Title 1st Part', 'edubin-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'rows' => 1,
                'placeholder' => esc_attr__('1st part', 'edubin-core'),
                'default' => esc_html_x('Title ', 'Edubin Double Heading', 'edubin-core'),
            ]
        );

        $this->add_control(
            'dbl_title2',
            [
                'label' => esc_html__('Title 2nd Part', 'edubin-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'rows' => 1,
                'placeholder' => esc_attr__('2nd part', 'edubin-core'),
                'default' => esc_html_x('consists of parts', 'Edubin Double Heading', 'edubin-core'),
            ]
        );

        $this->add_control(
            'dbl_title3',
            [
                'label' => esc_html__('Title 3rd Part', 'edubin-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'rows' => 1,
                'placeholder' => esc_attr__('3rd part', 'edubin-core'),
            ]
        );

        $this->add_responsive_control(
            'subtitle_alignemnt',
                [
                    'label'         => esc_html__( 'Sub Title Alignment', 'edubin-core' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> esc_html__( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                            ],
                        'center'    => [
                            'title'=> esc_html__( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                            ],
                        'right'     => [
                            'title'=> esc_html__( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                            ],
                        ],
                    'toggle'        => false,
                    'default'       => 'center',
                    'selectors'     => [
                        '{{WRAPPER}} .dbl__subtitle' => 'text-align: {{VALUE}};',
                        ],
                ]
        );

        $this->add_responsive_control(
            'title_alignemnt',
                [
                    'label'         => esc_html__( 'Title Alignment', 'edubin-core' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> esc_html__( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                            ],
                        'center'    => [
                            'title'=> esc_html__( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                            ],
                        'right'     => [
                            'title'=> esc_html__( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                            ],
                        ],
                    'toggle'        => false,
                    'default'       => 'center',
                    'selectors'     => [
                        '{{WRAPPER}} .dbl__title-wrapper' => 'text-align: {{VALUE}};',
                        ],
                ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Title Link', 'edubin-core'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_attr__('https://your-link.com', 'edubin-core'),
            ]
        );
        $this->add_control(
            'shape_bg',
            [
                'label' => esc_html__('Title Shape', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'edubin-core'),
                'label_off' => esc_html__('Off', 'edubin-core'),
                'return_value' => 'yes',

            ]
        );

        $this->add_control(
            'shape_bg_style',
            [
                'label' => esc_html__( 'Title Shape Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Shape 01', 'edubin-core' ),
                    '2' => esc_html__( 'Shape 02', 'edubin-core' ),
                    '3' => esc_html__( 'Shape 03', 'edubin-core' ),
                ],
                'condition' => [
                    'shape_bg' => 'yes',
                    'shape_image!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'shape_image',
            [
                'label' => esc_html__('Title Image Shape', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'edubin-core'),
                'label_off' => esc_html__('Off', 'edubin-core'),
                'return_value' => 'yes',
                'condition' => [
                    'shape_bg' => 'yes',
                ],

            ]
        );

        // $this->add_control(
        //     'shape_type',
        //     [
        //         'label' => esc_html__( 'Shape Type', 'edubin-core' ),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'image',
        //         'options' => [
        //             'image' => esc_html__( 'Image', 'edubin-core' ),
        //             'svg' => esc_html__( 'SVG', 'edubin-core' ),
        //         ],
        //         'condition' => [
        //             'shape_bg' => 'yes',
        //             'shape_image' => 'yes',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'svg_style',
        //     [
        //         'label' => esc_html__( 'SVG Style', 'edubin-core' ),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => '1',
        //         'options' => [
        //             '1' => esc_html__( 'Style 01', 'edubin-core' ),
        //             '2' => esc_html__( 'Style 02', 'edubin-core' ),
        //         ],
        //         'condition' => [
        //             'shape_bg' => 'yes',
        //             'shape_image' => 'yes',
        //         ],
        //     ]
        // );

        $this->add_control(
            'shape_bg_animation',
            [
                'label' => esc_html__('Shape Animation', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'edubin-core'),
                'label_off' => esc_html__('Off', 'edubin-core'),
                'condition' => [
                    'shape_bg!' => '',
                ],
                
            ]
        );


        $this->add_responsive_control(
            'svg_shape_width',
            [
                'label' => esc_html__('Shape Size', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 2.0,
                        'step' => 0.1,
                    ],
                ],
                'default' => ['size' => ''],
                'condition' => [
                    'shape_bg_style' => ['2','3'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg>.shape__svg>svg' => 'transform: scale({{SIZE}});',
                    // '{{WRAPPER}} .dbl__title-wrapper .thumb-shape-bg' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_bg_width',
            [
                'label' => esc_html__('Shape Width', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => ['min' => 0, 'max' => 500],
                    '%' => ['min' => -100, 'max' => 100],
                ],
                'default' => ['size' => ''],
                'condition' => [
                    'shape_bg!' => '',
                    
                ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg, .elementor-widget-custom-title-addons .thumb-shape-bg>.thumb-shape__bg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg>.shape__bg' => 'width: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}} .dbl__title-wrapper .thumb-shape-bg' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_bg_height',
            [
                'label' => esc_html__('Shape Height', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => ['min' => 0, 'max' => 500],
                    '%' => ['min' => -100, 'max' => 100],
                ],
                'default' => ['size' => ''],
                'condition' => [
                    'shape_bg!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg, .elementor-widget-custom-title-addons .thumb-shape-bg>.thumb-shape__bg' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg>.shape__bg' => 'height: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}} .dbl__title-wrapper .thumb-shape-bg' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_bg_position_x',
            [
                'label' => esc_html__('Shape Position X', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => ['min' => -200, 'max' => 400],
                    '%' => ['min' => -100, 'max' => 100],
                ],
                'default' => ['size' => ''],
                'condition' => ['shape_bg!' => ''],
               'selectors' => [
                    '{{WRAPPER}} .dbl__title-wrapper .thumb-shape-bg>.thumb-shape__bg' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg > .shape__bg' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg > .shape__svg' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        $this->add_responsive_control(
            'shape_bg_position_y',
            [
                'label' => esc_html__('Shape Position Y', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => ['min' => -500, 'max' => 900],
                    '%' => ['min' => -100, 'max' => 100],
                ],
                'default' => ['size' => ''],
                'condition' => ['shape_bg!' => ''],
                'selectors' => [
                    '{{WRAPPER}} .dbl__title-wrapper .thumb-shape-bg>.thumb-shape__bg' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg > .shape__bg' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg > .shape__svg' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'shape_thumb',
            [
                'label' => esc_html__('Image Shape', 'edubin-core'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
                //  'condition' => ['shape_type' => 'image'],
                'condition' => [
                    'shape_image' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_imagesize',
                'default' => 'full',
                'separator' => 'none',
                // 'condition' => ['shape_type' => 'image'],
                'condition' => [
                    'shape_image' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLES -> TITLE
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'edubin-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_all',
                'selector' => '{{WRAPPER}} .dbl__title',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'edubin-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => '‹h1›',
                    'h2' => '‹h2›',
                    'h3' => '‹h3›',
                    'h4' => '‹h4›',
                    'h5' => '‹h5›',
                    'h6' => '‹h6›',
                    'span' => '‹span›',
                    'div' => '‹div›',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Heading Margin', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .tpc-double_heading .dbl__title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_1st_part',
            [
                'label' => esc_html__('1st Part', 'edubin-core'),
                'type' => Controls_Manager::HEADING,
                'condition' => ['dbl_title!' => ''],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_1st',
                'condition' => ['dbl_title!' => ''],
                'selector' => '{{WRAPPER}} .dbl-title_1',
            ]
        );

        $this->add_control(
            'title_1st_color',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['dbl_title!' => ''],
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .dbl-title_1' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'heading_2nd_part',
            [
                'label' => esc_html__('2nd Part', 'edubin-core'),
                'type' => Controls_Manager::HEADING,
                'condition' => ['dbl_title2!' => ''],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_2nd',
                'condition' => ['dbl_title2!' => ''],
                'selector' => '{{WRAPPER}} .dbl-title_2',
            ]
        );

        $this->add_control(
            'title_2nd_color',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['dbl_title2!' => ''],
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .dbl-title_2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_3rd_part',
            [
                'label' => esc_html__('3rd Part', 'edubin-core'),
                'type' => Controls_Manager::HEADING,
                'condition' => ['dbl_title3!' => ''],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_3rd',
                'condition' => ['dbl_title3!' => ''],
                'selector' => '{{WRAPPER}} .dbl-title_3',
            ]
        );

        $this->add_control(
            'title_3rd_color',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['dbl_title3!' => ''],
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .dbl-title_3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLES -> SUBTITLE
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'section_style_subtitle',
            [
                'label' => esc_html__('Subtitle', 'edubin-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['subtitle!' => ''],
            ]
        );

        $this->add_control(
            'subtitle_display',
            [
                'label' => esc_html__( 'Display', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'edubin-core' ),
                    'block' => esc_html__( 'Block', 'edubin-core' ),
                    'inline-block'  => esc_html__( 'Inline-Block', 'edubin-core' ),
                    'inline'  => esc_html__( 'Inline', 'edubin-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'selector' => '{{WRAPPER}} .dbl__subtitle',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '#4c5e78',
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_bg_color',
            [
                'label' => esc_html__('Subtitle Background Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hide_circle',
            [
                'label' => esc_html__('Hide Circle?', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle span:before' => 'display: none;',
                ],
            ]
        );

        $this->add_control(
            'additional_color',
            [
                'label' => esc_html__('Additional Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '#0071dc',
                'condition' => [ 'hide_circle' => '' ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle span:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label' => esc_html__('Padding', 'edubin-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'default' => [
                    'top' => '7',
                    'right' => '12',
                    'bottom' => '7',
                    'left' => '12',
                    'unit'  => 'px',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__('Margin', 'edubin-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_more_options',
            [
                'label' => esc_html__( 'Subtitle Border', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'subtitle_border',
                'selector' => '{{WRAPPER}} .dbl__subtitle',
            ]
        );

        $this->add_control(
            'subtitle_border_radius',
            [
                'label' => esc_html__('Border Radius', 'edubin-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit'  => 'px',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .dbl__subtitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'subtitle_shadow',
                'selector' => '{{WRAPPER}} .dbl__subtitle',
                // 'fields_options' => [
                   //  'box_shadow_type' => [
                      //   'default' => 'yes'
                   //  ],
                   //  'box_shadow' => [
                      //   'default' => [
                         //    'horizontal' => 5,
                         //    'vertical' => 4,
                         //    'blur' => 13,
                         //    'spread' => 0,
                         //    'color' => 'rgba( 46, 63, 99, .15)',
                      //   ]
                   //  ]
                // ]
            ]
        );
        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title_shape',
            [
                'label' => esc_html__('Shape', 'edubin-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['shape_bg!' => ''],
            ]
        );

        $this->add_control(
            'shape_bg_color',
            [
                'label' => esc_html__('Shape Background', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                // 'default' => '#ffd24d',
                'condition' => ['shape_bg!' => ''],
                'selectors' => [
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg>.shape__bg ' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .dbl__title-wrapper .shape-bg>.shape__svg>svg>path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $_s = $this->get_settings_for_display();

        $shape_1 = '<svg 
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="163.5px" height="10.5px">
                    <path fill-rule="evenodd"  stroke="red" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                    d="M0.500,5.821 C20.005,4.244 141.911,-2.588 162.500,2.142 C159.791,2.142 43.844,4.244 8.085,9.500 "/>
                    </svg>';

        $shape_2 = '<svg 
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="145.5px" height="16.5px">
                    <path fill-rule="evenodd"  stroke="green" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                    d="M0.500,14.500 C0.500,14.500 57.500,-9.500 144.500,6.500 "/>
                    </svg>';

        if (!empty($_s['link']['url'])) {
            $this->add_render_attribute('link', 'class', 'dbl__link');
            $this->add_link_attributes('link', $_s['link']);
        }

        $this->add_render_attribute('heading_wrapper', 'class', 'tpc-double_heading');

        echo '<div ', $this->get_render_attribute_string('heading_wrapper'), '>';

            if ($_s['subtitle']) {
                echo '<div class="dbl__subtitle">';
                    if ($_s['subtitle']) echo '<span>', $_s['subtitle'], '</span>';
                echo '</div>';
            }

            if ($_s['dbl_title'] || $_s['dbl_title2'] || $_s['dbl_title3'] || $_s['shape_bg']) {

                if (!empty($_s['link']['url'])) echo '<a ', $this->get_render_attribute_string('link'), '>';

                echo '<', $_s['title_tag'], ' class="dbl__title-wrapper">';


                if ($_s['dbl_title']) {
                    echo '<span class="dbl__title dbl-title_1">'.$_s['dbl_title'].'</span>';
                };

                if ($_s['dbl_title2']) {
                    $relative = ($_s['shape_bg'])?  ('style="position:relative;"') : ('');
                    $anim_active = ($_s['shape_bg_animation']) ? ('animation_active'): ('');
                    echo '<span class="dbl__title dbl-title_2"'.$relative.' >';
                        echo $_s['dbl_title2'];
                        //title Shape
                        if($_s['shape_bg']) {
                            if(!empty($_s['shape_thumb']['url']) && $_s['shape_image'] == 'yes') {
                                echo '<span class="thumb-shape-bg '.$anim_active.'">';
                                    echo '<span class="thumb-shape__bg">';
                                        echo Group_Control_Image_Size::get_attachment_image_html( $_s, 'shape_imagesize', 'shape_thumb' );
                                    echo '</span>';
                                echo '</span>';
                            }else{
                                echo '<span class="shape-bg '.$anim_active.'">';
                                    if($_s['shape_bg_style'] == '1' && $_s['shape_bg'] == 'yes' && $_s['shape_image'] != 'yes' ){
                                        echo '<span class="shape__bg"></span>';
                                    };
                                    if($_s[ 'shape_bg_style'] == '2'){ 
                                        echo '<span class="shape__svg">'.$shape_1.'</span>';
                                    };
                                    if($_s['shape_bg_style'] == '3'){
                                        echo '<span class="shape__svg">'.$shape_2.'</span>';
                                    };
                                echo '</span>';
                            };
                        };
                    echo '</span>';
                };

                if ($_s['dbl_title3']) {
                    echo '<span class="dbl__title dbl-title_3">'.$_s['dbl_title3'].'</span>';
                };

                echo '</', $_s['title_tag'], '>';

                if (!empty($_s['link']['url'])){
                    echo '</a>';
                };

            }

        echo '</div>';
    }
}

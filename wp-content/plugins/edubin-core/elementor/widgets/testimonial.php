<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Edubin_Elementor_Widget_Testimonial extends Widget_Base {

    public function get_name() {
        return 'edubin-testimonial-addons';
    }

    public function get_title() {
        return __( 'Testimonial', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-testimonial';
    }

    public function get_keywords() {
        return [ 'edubin', 'testimonials', 'reviews', 'blockquote', 'feedback', 'slider', 'carousel' ];
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }
    // public function get_script_depends() {
    //     return [
    //         'edubin-swiper',
    //         'edubin-active',
    //     ];
    // }
    // public function get_style_depends() {
    //     return [ 'edubin-swiper' ];
    // }
    protected function register_controls() {

        $this->start_controls_section(
            'edubin_testimonial_content_section',
            [
                'label' => __( 'Testimonial', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'testi_style',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'edubin-core' ),
                    '2'   => __( 'Style 2', 'edubin-core' ),
                    '3'   => __( 'Style 3', 'edubin-core' ),
                    '4'   => __( 'Style 4', 'edubin-core' ),
                    '6'   => __( 'Style 5', 'edubin-core' ),
                    '7'   => __( 'Style 6', 'edubin-core' ),
                    '8'   => __( 'Style 7', 'edubin-core' ),
                    '9'   => __( 'Style 8', 'edubin-core' ),
                ],
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'   => __( 'Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Happy Students','edubin-core'),
                'condition' => [
                    'testi_style' => ['2'],
                ]
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __( 'Image', 'edubin-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'testi_style' => '2',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_imagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'testi_style' => '2',
                ]
            ]
        );

        $this->add_responsive_control(
            'fixed_image_size',
            [
                'label' => __( 'Size', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-2-area .edubin-testi-bg-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testi_style' => ['2'],
                ]
            ]
        );

        // $this->add_control(
        //     'slider_on',
        //     [
        //         'label' => esc_html__( 'Carousel', 'edubin-core' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //         'separator'=>'before',
        //     ]
        // );


        $repeater = new Repeater();

        $repeater->add_control(
            'client_name',
            [
                'label'   => __( 'Name', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Johan Doe','edubin-core'),

            ]    
        );

        $repeater->add_control(
            'client_image',
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
                'name' => 'client_imagesize', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                // 'exclude' => [ 'custom' ],
                'include' => [],
                'default' => 'medium',
            ]
        );

        $repeater->add_control(
            'client_designation',
            [
                'label'   => __( 'Designation', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Managing Director','edubin-core'),
            ]
        );

        $repeater->add_control(
            'client_say_heading',
            [
                'label'   => __( 'Client Say Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('I enjoyed the course thoroughly!','edubin-core'),
            ]
        );

        $repeater->add_control(
            'client_say',
            [
                'label'   => __( 'Client Say', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __('Aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet sem nibh id elit sollicitudirem','edubin-core'),
            ]
        );

        $this->add_control(
            'edubin_testimonial_list',
            [
                'type'    => Controls_Manager::REPEATER,
                 'fields'  => $repeater->get_controls(),

                'default' => [

                    [
                        'client_name'           => __('James Smith','edubin-core'),
                        'client_designation'    => __( 'CFO Apple Corp','edubin-core' ),
                        'client_say_heading'            => __( 'Fantastic! Great instructor!', 'edubin-core' ),
                        'client_say'            => __( 'I am grateful for your wonderful course! Your tutors are the best, and I am completely satisfied with the level of professional teaching. I recommend these courses to everyone, and wish you, guys, luck with the new studies!', 'edubin-core' ),
                    ],

                    [
                        'client_name'           => __('Monica Blews','edubin-core'),
                        'client_designation'    => __( 'Manager','edubin-core' ),
                        'client_say_heading'            => __( 'I enjoyed every lesson', 'edubin-core' ),
                        'client_say'            => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet. It is a very good course for those who are the beginner. luck with the new studies!', 'edubin-core' ),
                    ],

                    [
                        'client_name'           => __('John Dowson','edubin-core'),
                        'client_designation'    => __( 'Developer','edubin-core' ),
                        'client_say_heading'            => __( 'Fantastic! Great instructor!', 'edubin-core' ),
                        'client_say'            => __( 'I am grateful for your wonderful course! Your tutors are the best, and I am completely satisfied with the level of professional teaching. I recommend these courses to everyone, and wish you, guys, luck with the new studies!', 'edubin-core' ),
                    ],
                ],
                'title_field' => '{{{ client_name }}}',
            ]
        );

        

        // $this->add_group_control(
        //     Group_Control_Image_Size::get_type(),
        //     [
        //         'name' => 'client_image_divider_size',
        //         'default' => 'large',
        //         'separator' => 'none',
        //     ]
        // );
    
        $this->add_responsive_control(
            'quote_show_hide',
            [
                'label' => esc_html__( 'Quote', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'separator'=>'before',
                'condition' => [
                    'testi_style' => ['4','7','8'],
                ]
            ]
        );

        $this->add_control(
            'quote_style',
            [
                'label' => __( 'Quote Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'edubin-core' ),
                    '2'   => __( 'Style 2', 'edubin-core' ),
                ],
                'condition' => [
                    'quote_show_hide' => 'yes',
                    'testi_style' => ['7'],
                ]
            ]
        );

        $this->end_controls_section();

        

        //Slider Options
        $this->start_controls_section(
            'testimonial_slider_option',
            [
                'label' => __( 'Slider Option', 'edubin-core' ),
                // 'condition' => [
                //     'slider_on' => 'yes',
                // ]
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
            'slitems',
            [
                'label'        => __( 'Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 2,
                'description'  => __( 'Numbers of item showed. Example value: 2', 'edubin-core' )
            ]
        );

        $this->add_control(
            'slcentermode',
            [
                'label'        => __( 'Center Mode', 'edubin-core' ),
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
                'default'      => 'no',
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
                'condition'    => [
                    'slautolay' => 'yes'
                ],
                
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
                'condition'    => [
                    'slautolay' => 'yes'
                ],
                
            ]
        );

        $this->add_control(
            'slarrows',
            [
                'label'        => __( 'Slider Arrow', 'edubin-core' ),
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
                'label'        => __( 'Slider dots', 'edubin-core' ),
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


        $this->start_controls_section(
            'testi_style_area',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-wrapper,{{WRAPPER}} .edubin-testi-4 .edubin-testi-single',
                'condition' => [
                    'testi_style' => ['4','7'],
                ],
            ]
        );
        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Background', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-1' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-2-area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-3 .testimonial-cont' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-3 .testimonial-cont:after' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-4 .edubin-testi-single' => 'background-color: {{VALUE}};',
                    // '{{WRAPPER}} .edubin-testi-style .edubin-testi-single' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-8 .edubin-testi-single .testimonial-wrapper' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-9' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'testi_style!' => '7',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'testi_thumb_background',
                'label' => __( 'Background Overlay', 'edubin-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-wrapper',
                'condition' => [
                    'testi_style' => '7',
                ],
            ]
        );

        $this->add_responsive_control(
            'edubin_testimonial_section_padding',
            [
                'label' => __( 'Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-2-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-3 .testimonial-cont' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-style .edubin-testi-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-single.layout-8 .testimonial-wrapper .testimonial-cont' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-9' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'edubin_testimonial_section_margin',
            [
                'label' => __( 'Margin', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-2-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-3 .testimonial-cont' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-style .edubin-testi-single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-8 .edubin-testi-single .testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-9 .edubin-testi-single .testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );


        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testi_border',
				'selector' => '{{WRAPPER}} .tpc-testimonial-item .edubin-testi-single',
			]
		);

        $this->add_responsive_control(
            'edubin_testimonial_border_radius',
            [
                'label' => __( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-3 .testimonial-cont' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-4 .edubin-testi-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-9' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testi_heading_style_area',
            [
                'label' => __( 'Heading', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testi_style' => ['2', '7'],
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __( 'Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-2-area .testi-heading .heading' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont .testi-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testi_heading_padding',
            [
                'label' => __( 'Heading Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-2-area .testi-heading .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'edubin_testi_heading_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont .testi-heading',
                'condition' => [
                    'testi_style' => ['7'],
                ],
            ]
        );


        

        $this->end_controls_section();

        // Style Testimonial image style start
        $this->start_controls_section(
            'edubin_testimonial_image_style',
            [
                'label'     => __( 'Image', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testi_style!' => ['2'],
                ],
            ]
        );
        $this->add_control(
            'edubin_testimonial_arrow_height',
            [
                'label' => __( 'Height', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-single .testimonial-thum img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-testi-style .testi-img img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'edubin_testimonial_image_border',
                'label' => __( 'Border', 'edubin-core' ),
                'selector' => '{{WRAPPER}} .testimonal-image img, .edubin-testi-style .testi-img img',
            ]
        );

        $this->add_responsive_control(
            'edubin_testimonial_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .testimonal-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    '{{WRAPPER}} .edubin-testi-style .testi-img img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_control(
            'author_img_bottom_space',
            [
                'label' => esc_html__( 'Image Bottom Space', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-9 .testi-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testi_style' => ['9'],
                ],
            ]
        );
        $this->add_control(
            'thumb_bg_color',
            [
                'label' => __( 'Image Background', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-6 .edubin-testi-single .testimonial-thum .testimonial-shape::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'testi_style!' => ['7','8'],
                ],
            ]
        );
        $this->end_controls_section(); // Style Testimonial image style end

        $this->start_controls_section(
            'testi_quote_style',
            [
                'label'     => __( 'Quote', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testi_style' => ['1','4','6','7','8'],
                ]
            ]
        );

            $this->add_control(
                'quote_icon_color',
                [
                    'label' => __( 'Icon Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-1 .edubin-testi-single .testimonial-thum .quote i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-4 .edubin-testi-single .testi-icon-wrap #qt-icon' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-6 .edubin-testi-single .testimonial-cont i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont svg path' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont .quote-bg ' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-8 .edubin-testi-single .testimonial-cont svg path' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-single.layout-8 .testimonial-wrapper .testimonial-cont .quote-icon i' => 'color: {{VALUE}};',
                    ],
                    
                ]
            );

            $this->add_control(
                'quote_bg_color',
                [
                    'label' => __( 'Background Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-1 .edubin-testi-single .testimonial-thum .quote i' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-4 .edubin-testi-single .testi-icon-wrap #qt-bg' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-6 .edubin-testi-single .testimonial-cont i' => 'background: {{VALUE}};',
                    ],
                    'condition' => [
                        'testi_style!' => ['7','8'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'quote_bottom_space',
                [
                    'label' => __( 'Quote Bottom Space', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -20,
                            'max' => 120,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single.layout-8 .testimonial-wrapper .testimonial-cont .quote-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testi_style' => '8',
                    ]
                ]
            );

        $this->end_controls_section(); // Style Testimonial image style end

        $this->start_controls_section(
            'edubin_testimonial_name_style',
            [
                'label'     => __( 'Name', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'edubin_testimonial_name_deg_space',
            [
                'label' => __( 'Name Degree Spacing', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-testi-4 .testi-name-degree' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testi_style' => '4',
                ],
            ]
        );
            $this->add_responsive_control(
                'edubin_testimonial_name_align',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .name' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .name' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-3 .name' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-9 .name' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'testi_name_color',
                [
                    'label' => __( 'Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .name' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .name' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-3 .name' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-style .name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'edubin_testimonial_name_typography',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-testi-single .testimonial-cont .name, .edubin-testi-2 .testi-single .name, .edubin-testi-style .name',
                ]
            );

            $this->add_responsive_control(
                'edubin_testimonial_name_padding',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .edubin-testi-style .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testi_style!' => '8',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'name_bottom_space',
                [
                    'label' => __( 'Name Bottom Space', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -20,
                            'max' => 120,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont .testi-name-degree .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testi_style' => '7',
                    ]
                ]
            );
        $this->end_controls_section(); // Style Testimonial name style end

        // Style Testimonial designation style start
        $this->start_controls_section(
            'edubin_testimonial_designation_style',
            [
                'label'     => __( 'Degree', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testi_style!' => ['8'],
                ],
            ]
        );
            
            $this->add_responsive_control(
                'edubin_testimonial_designation_align',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .degree' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .degree' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-style .degree' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'edubin_testimonial_designation_color',
                [
                    'label' => __( 'Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .degree' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .degree' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-style .degree' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'edubin_testimonial_designation_typography',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-testi-single .testimonial-cont .degree, .edubin-testi-2 .testi-single .degree, .edubin-testi-style .degree',
                ]
            );

            $this->add_responsive_control(
                'edubin_testimonial_designation_padding',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .degree' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .degree' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .edubin-testi-style .degree' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end


        // Style Testimonial designation style start
        $this->start_controls_section(
            'edubin_testimonial_clientsay_style',
            [
                'label'     => __( 'Client say', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'edubin_testimonial_clientsay_align',
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
                        '{{WRAPPER}} .edubin-testi-3 .testi-heading' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .client-say' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .content' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-style .testi-content' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );

            $this->add_control(
                'edubin_testimonial_clientsay_color',
                [
                    'label' => __( 'Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .client-say' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .content' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-testi-style .testi-content .client-say' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'edubin_testimonial_clientsay_typography',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-testi-single .testimonial-cont .client-say, .edubin-testi-2 .testi-single .content,  .edubin-testi-style .testi-content .client-say',
                ]
            );

            $this->add_responsive_control(
                'edubin_testimonial_clientsay_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-single .testimonial-cont .client-say' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .edubin-testi-2 .testi-single .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .edubin-testi-style .testi-content .client-say' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                    'condition' => [
                        'testi_style!' => '7',
                    ]
                ]
            );

            $this->add_responsive_control(
                'edubin_testimonial_content_padding_left',
                [
                    'label' => __( 'Client Say Padding', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -20,
                            'max' => 120,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont' => 'padding-left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testi_style' => '7',
                    ]
                ]
            );

            $this->add_responsive_control(
                'client_say_top_space',
                [
                    'label' => __( 'Client Say Top Space', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -20,
                            'max' => 120,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont p.client-say' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testi_style' => '7',
                    ]
                ]
            );

            $this->add_responsive_control(
                'client_say_bottom_space',
                [
                    'label' => __( 'Client Say Bottom Space', 'edubin-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -20,
                            'max' => 120,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-testi-7 .edubin-testi-single .testimonial-cont p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testi_style' => '7',
                    ]
                ]
            );

        $this->end_controls_section(); // Style Testimonial designation style end


        // Style Dots style start
        $this->start_controls_section(
            'edubin_carousel_dots_style',
            [
                'label'     => __( 'Pagination', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'sldots'  => 'yes',
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
                                '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_dots_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'edubin_carousel_dots_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet',
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                                '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}} !important;; margin-right: {{SIZE}}{{UNIT}} !important;',
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
                            'selector' => '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'edubin_carousel_dots_hover_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_responsive_control(
                        'edubin_carousel_dots_hover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-pagination .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                    'slarrows'  => 'yes',
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
                            '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .swiper-button-next::after' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .swiper-button-prev::after' => 'color: {{VALUE}}',
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
                            '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .swiper-button-next:hover:after' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .tpc-testimonial_wrapper.edubin-navigation .swiper.swiper-container.swiper-horizontal .swiper-button-prev:hover:after' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                    

                $this->end_controls_tab(); // Active tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Navigation style end

    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $direction = is_rtl() ? 'true' : 'false';

        //Pagination Active Class
        $pg_class = ( $settings['sldots'] ) ? ('edubin-pagination'):('');
        //Pagination Active Class
        $navi_class = ( $settings['slarrows'] ) ? ('edubin-navigation'):('');

        // Pass
        $slider_settings = [
            'infinite_loop' => ('yes' === $settings['infinite_loop']),
            'autoplay' => ('yes' === $settings['slautolay']),
            'autoplay_speed' => absint($settings['slautoplay_speed']),
            'display_columns' => $settings['slitems'],
            'item_gap' => $settings['item_gap'],
            'center_slides' => ('yes' === $settings['slcentermode']),
            'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
            'pause_on_interaction' => ('yes' === $settings['pause_on_interaction']),
            //Tablet Settings
            //'tablet_breakpoint' => $settings['tablet_breakpoint'],
            'display_columns_tablet' => $settings['tablet_item_per_view'],
            'tablet_item_gap' => $settings['tablet_item_gap'],
            'center_slides_tablet' => ('yes' === $settings['center_slides_tablet']),
            //Mobile Settings
            //'mobile_breakpoint' => $settings['mobile_breakpoint'],
            'display_columns_mobile' => $settings['mobile_item_per_view'],
            'mobile_item_gap' => $settings['mobile_item_gap'],
            'center_slides_mobile' => ('yes' === $settings['center_slides_mobile']),

        ];
        $slider_settings = array_merge( $slider_settings );

        //$bg_shape_img_url = $settings['testi_shape_image']['url'];

        $this->add_render_attribute( 'wrapper', 'class', 'tpc-testimonial_wrapper edubin-testi-style '.$pg_class.' '.$navi_class);
        // Js data pass
        $this->add_render_attribute( 'wrapper', 'data-settings', wp_json_encode( $slider_settings ) );

        $this->add_render_attribute( 'container', 'class', 'tpc_testimonial edubin-testi-'. esc_attr( $settings['testi_style'] ));
        $this->add_render_attribute( 'container', 'class', ' edubin-testimonial-style-'. esc_attr( $settings['testi_style'] ));
        $sliderWrapper = 'swiper-wrapper';
        $sliderItem = 'swiper-slide';
        //$has_autoplay_enabled = 'yes' === $this->get_settings_for_display( 'slautolay' );
       
        $this->add_render_attribute( 'container', 'class', 'swiper swiper-container' );

        
        $this->add_render_attribute( 'swiper', 'class', $sliderWrapper );

        // $this->add_render_attribute( [
		// 	'swiper' => [
		// 		'aria-live' => $has_autoplay_enabled ? 'off' : 'polite',
		// 	],

		// ] );
        
        if ( 'yes' === $settings['slautolay'] ) :
            $this->add_render_attribute( 'swiper', 'data-autoplay', 'true' );
            $this->add_render_attribute( 'swiper', 'data-autoplayspeed', intval( esc_attr( $settings['slautoplay_speed'] ) ) );
        endif;
            if($settings['testi_style'] == 2){
                
                        
                            echo '<div class="edubin-testi-2-area">';
                                echo '<div class="testi-heading">';
                                    echo '<h3 class="heading">'.esc_html__( $settings['heading'], 'edubin-core' ).'</h3>';
                                echo '</div>';
                                echo '<div '.$this->get_render_attribute_string( 'testimonial_area_attr' ).'>';

                                echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
                
                                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                                    echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                                    foreach($settings['edubin_testimonial_list'] as $testimonial){
                                        echo '<div class="' . esc_attr( $sliderItem ) . '">';
                                            echo '<div class="testi-single">';
                                                if( !empty($testimonial['client_image']['url']) ){
                                                    echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' );
                                                }
                                                if( !empty($testimonial['client_say']) ){
                                                    echo '<p class="content">'.esc_html__( $testimonial['client_say'], 'edubin-core' ).'</p>';
                                                }
                                                if( !empty($testimonial['client_name']) ){
                                                    echo '<h6 class="name">'.esc_html__( $testimonial['client_name'], 'edubin-core' ).'</h6>';
                                                }
                                                if( !empty($testimonial['client_designation']) ){
                                                    echo '<p class="degree">'.esc_html__( $testimonial['client_designation'], 'edubin-core' ).'</p>';
                                                }
                                            echo '</div>';
                                        echo '</div>';
                                    };

                                    echo '</div>';
                                    if ( 'yes' === $settings['sldots'] ) :
                                        echo '<div class="testi-pagination swiper-pagination"></div>';
                                    endif;
                                    if ( 'yes' === $settings['slarrows'] ) :
                                        echo '<div class="testi-button-next"><i class="flaticon-next"></i></div>
                                        <div class="testi-button-prev"><i class="flaticon-back-1"></i></div>';
                                    endif;
                                
                                echo '</div>';
            
                            echo '</div>';

                                echo '</div>';
                                if( !empty($settings['bg_image']['url']) ){
                                    echo '<div class="edubin-testi-bg-image">'.Group_Control_Image_Size::get_attachment_image_html( $settings, 'bg_imagesize', 'bg_image' ).'</div>';
                                }
                            echo '</div>';

            }else{
            echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
    
                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                        foreach( $settings['edubin_testimonial_list'] as $key => $testimonial ) :
                            
                            // $image         = $testimonial['thumb'];
                            // $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );
                            // $quote_icon_url = $testimonial['quote_icon']['url'];

                            // if ( empty( $image_src_url ) ) :
                            //     $image_url = $image['url']; 
                            // else :
                            //     $image_url = $image_src_url;
                            // endif;

                            $each_item = $this->get_repeater_setting_key('client_name', 'edubin_testimonial_list', $key);
                            $item_class = ['tpc-testimonial-item'];
                            $this->add_render_attribute( $each_item, 'class', $item_class );
                            $this->add_render_attribute( $each_item, 'class', 'elementor-repeater-item-'. esc_attr( $testimonial['_id'] ) );
                            echo '<div class="' . esc_attr( $sliderItem ) . '">';
                                echo '<div ' . $this->get_render_attribute_string( $each_item ) . '>';
                                    include EDUBIN_PLUGIN_DIR . 'elementor/widgets/tpl-part/testimonials/testimonial-'. $settings['testi_style'] .'.php';
                                    //echo '<h5 class="name">' . esc_html( $testimonial['name'] ) . '</h5>';
                                echo '</div>';
                            echo '</div>';
                        endforeach;

                    echo '</div>';
                        
                echo '</div>';

                if ( 'yes' === $settings['sldots'] ) :
                    echo '<div class="testi-pagination swiper-pagination"></div>';
                endif;
                if ( 'yes' === $settings['slarrows'] ) :
                    echo '<div class="testi-button-next"><i class="flaticon-next"></i></div>
                    <div class="testi-button-prev"><i class="flaticon-back-1"></i></div>';
                endif;

            echo '</div>';
            }

                        
                    
    }
}
<?php

namespace Edubin_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;

trait Slider {

	protected function settings() {

        if( 'slider' === $this->default_display_type ) :
            $this->start_controls_section(
                'slider_settings',
                [
                    'label' => __( 'Slider Settings', 'edubin-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'slider_settings',
                [
                    'label'     => __( 'Slider Settings', 'edubin-core' ),
                    'condition' => [
                        'display_type'    => 'slider'
                    ]
                ]
            );
        endif;

        // $this->add_control(
        //     'desktop_columns',
        //     [
        //         'label'        => __( 'Desktop Columns', 'edubin-core' ),
        //         'type'         => Controls_Manager::SLIDER,
        //         'range'        => [
        //             'px'       => [
        //                 'min'  => 1,
        //                 'max'  => $this->desktop_max_slider,
        //                 'step' => 1
        //             ]
        //         ],
        //         'default'      => [
        //             'size'     => $this->desktop_default_slider
        //         ],
        //         'description'  => __( 'Number of columns( starts from 1200px ). A maximum of ' . $this->desktop_max_slider . ' items are allowed.', 'edubin-core' )
        //     ]
        // );

        // $this->add_control(
        //     'tablet_columns',
        //     [
        //         'label'        => __( 'Tablet Columns', 'edubin-core' ),
        //         'type'         => Controls_Manager::SLIDER,
        //         'range'        => [
        //             'px'       => [
        //                 'min'  => 1,
        //                 'max'  => $this->tablet_max_slider,
        //                 'step' => 1
        //             ]
        //         ],
        //         'default'      => [
        //             'size'     => $this->tablet_default_slider
        //         ],
        //         'description'  => __( 'Number of columns in tablet( 768px to 1199px ). A maximum of ' . $this->tablet_max_slider . ' items are allowed.', 'edubin-core' )
        //     ]
        // );

        // $this->add_control(
        //     'mobile_columns',
        //     [
        //         'label'        => __( 'Mobile Columns', 'edubin-core' ),
        //         'type'         => Controls_Manager::SLIDER,
        //         'range'        => [
        //             'px'       => [
        //                 'min'  => 1,
        //                 'max'  => $this->mobile_max_slider,
        //                 'step' => 1
        //             ]
        //         ],
        //         'default'      => [
        //             'size'     => $this->mobile_default_slider
        //         ],
        //         'description'  => __( 'Number of columns in mobile( 576px to 767px ). A maximum of ' . $this->mobile_max_slider . ' items are allowed.', 'edubin-core' )
        //     ]
        // );

        // $this->add_control(
        //     'small_mobile_columns',
        //     [
        //         'label'        => __( 'Small Mobile Columns', 'edubin-core' ),
        //         'type'         => Controls_Manager::SLIDER,
        //         'range'        => [
        //             'px'       => [
        //                 'min'  => 1,
        //                 'max'  => 2,
        //                 'step' => 1
        //             ]
        //         ],
        //         'default'      => [
        //             'size'     => 1
        //         ],
        //         'description'  => __( 'Number of columns in mobile( 300px to 575px ). A maximum of 2 items are allowed.', 'edubin-core' )
        //     ]
        // );

        // $this->add_control(
        //     'transition_duration',
        //     [
        //         'label'     => __( 'Transition Duration', 'edubin-core' ),
        //         'type'      => Controls_Manager::NUMBER,
        //         'default'   => 1000
        //     ]
        // );

        // $this->add_control(
        //     'autoplay',
        //     [
        //         'label'        => __( 'Autoplay', 'edubin-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'edubin-core' ),
        //         'label_off'    => __( 'Disable', 'edubin-core' ),
        //         'default'      => 'yes',
        //         'return_value' => 'yes'
        //     ]
        // );

        // $this->add_control(
        //     'autoplay_speed',
        //     [
        //         'label'     => __( 'Autoplay Speed', 'edubin-core' ),
        //         'type'      => Controls_Manager::NUMBER,
        //         'default'   => 3000,
        //         'condition' => [
        //             'autoplay' => 'yes'
        //         ]
        //     ]
        // );

        // $this->add_control(
        //     'loop',
        //     [
        //         'label'        => __( 'Infinite Loop', 'edubin-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'edubin-core' ),
        //         'label_off'    => __( 'Disable', 'edubin-core' ),
        //         'default'      => 'yes',
        //         'return_value' => 'yes'
        //     ]
        // );

        // $this->add_control(
        //     'arrows_and_dots',
        //     [
        //         'label'      => __( 'Arrows and Dots', 'edubin-core' ),
        //         'type'       => Controls_Manager::SELECT,
        //         'default'    => 'none',
        //         'options'    => [
        //             'arrows' => __( 'Arrows', 'edubin-core' ),
        //             'dots'   => __( 'Dots', 'edubin-core' ),
        //             'both'   => __( 'Arrows and Dots', 'edubin-core' ),
        //             'none'   => __( 'None', 'edubin-core' )
        //         ]
        //     ]
        // );



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
                'placeholder'  => 30,
                'default'      => 30,
                'description'  => __( 'Gap for each item in px. Example value: 30', 'edubin-core' )
            ]
        );

        $this->add_control(
            'slitems',
            [
                'label'        => __( 'Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 3,
                'default'      => $this->desktop_default_slider,
                'description'  => __( 'Numbers of item showed. Example value: 3, Max : 6', 'edubin-core' )
            ]
        );

        // $this->add_control(
        //     'slcentermode',
        //     [
        //         'label'        => __( 'Center Mode', 'edubin-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'edubin-core' ),
        //         'label_off'    => __( 'Disable', 'edubin-core' ),
        //         'default'      => 'no',
        //         'return_value' => 'yes',
        //     ]
        // );

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

        // $this->add_control(
        //     'center_slides_tablet',
        //     [
        //         'label'        => __( 'Center Slides', 'edubin-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'edubin-core' ),
        //         'label_off'    => __( 'Disable', 'edubin-core' ),
        //         'default'      => 'no',
        //         'return_value' => 'yes',
        //     ]
        // );

        $this->add_control(
            'tablet_item_gap',
            [
                'label'        => __( 'Tablet Item Gap', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 30,
                'default'  => 30,
                'description'  => __( 'Gap for each item in px. Example value: 30', 'edubin-core' )
            ]
        );

        $this->add_control(
            'tablet_item_per_view',
            [
                'label'        => __( 'Tablet Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'default'  => $this->tablet_default_slider,
                'description'  => __( 'Numbers of item showed. Max value: '.$this->tablet_default_slider.'', 'edubin-core' )
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
        // $this->add_control(
        //     'center_slides_mobile',
        //     [
        //         'label'        => __( 'Center Slides', 'edubin-core' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'label_on'     => __( 'Enable', 'edubin-core' ),
        //         'label_off'    => __( 'Disable', 'edubin-core' ),
        //         'default'      => 'no',
        //         'return_value' => 'yes',
        //     ]
        // );

        $this->add_control(
            'mobile_item_gap',
            [
                'label'        => __( 'Mobile Item Gap', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'placeholder'  => 30,
                'default'  => 30,
                'description'  => __( 'Gap for each item in px. Example value: 30', 'edubin-core' )
            ]
        );

        $this->add_control(
            'mobile_item_per_view',
            [
                'label'        => __( 'Mobile Item Per View', 'edubin-core' ),
                'type'         => Controls_Manager::NUMBER,
                'default'  => $this->mobile_default_slider,
                'description'  => __( 'Numbers of item showed. Max value: '.$this->mobile_default_slider.'', 'edubin-core' )
            ]
        );


        $this->end_controls_section();
	}
}
<?php

namespace EdubinCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Edubin_Button extends Widget_Base {

	public function get_name() {
		return 'edubin-button';
	}

	public function get_title() {
		return __( 'Button', 'edubin-core' );
	}

    public function get_icon() {
        return 'edubin-elementor-icon eicon-button';
    }

	public function get_keywords() {
		return [ 'edubin', 'button', 'link', 'url', 'btn' ];
	}

	public function get_categories() {
		return [ 'edubin-core' ];
	}

    // =========== Register Controls ===========
	protected function register_controls() {

        $icon_position = is_rtl() ? 'before' : 'after';

  		$this->start_controls_section(
            'section_button',
            [
                'label' => __( 'Button', 'edubin-core' )
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __( 'Style', 'edubin-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    '1' => __( 'Default',   'edubin-core' ),
                    '2'     => __( 'Style 2',   'edubin-core' ),
                    '3'   => __( 'Style 3',   'edubin-core' ),
                    'custom'  => __( 'Custom',   'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'size',
            [
                'label'   => __( 'Size', 'edubin-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom' => __( 'Custom',   'edubin-core' ),
                    'small'  => __( 'Small',   'edubin-core' ),
                    'medium' => __( 'Medium',   'edubin-core' ),
                    'large'  => __( 'Large',   'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => __( 'Text', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Get Started', 'edubin-core' ),
                'placeholder' => __( 'Enter button text.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'url',
            [
                'label'         => __( 'Link', 'edubin-core' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'show_external' => true,
                'placeholder'   => __( 'https://your-link.com', 'edubin-core' ),
                'dynamic'        => [
                    'active'     => true
                ],
                'default'         => [
                    'url'         => '#',
                    'is_external' => ''
                ]
            ]
        );

        $this->add_control(
			'enable_btn_icon',
			[
				'label' => esc_html__( 'Button Icon', 'edubin-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'edubin-core' ),
				'label_off' => esc_html__( 'Hide', 'edubin-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'icon',
            [
                'label'   => __( 'Icon', 'edubin-core' ),
                'type'    => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'icon-4',
                    'library' => 'edubin-custom-icons'
                ],
                'condition' => [
                    'enable_btn_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => __( 'Icon Position', 'edubin-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => is_rtl() ? 'before' : 'after',
                'options' => [
                    'before' => __( 'Before',   'edubin-core' ),
                    'after'  => __( 'After',    'edubin-core' )
                ],
                'condition' => [
                    'enable_btn_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_indent',
            [
                'label'       => __( 'Icon Spacing', 'edubin-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .edubin-button-icon-position-before i, {{WRAPPER}} .edubin-button-icon-position-before svg' => 'padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-button-icon-position-after i, {{WRAPPER}} .edubin-button-icon-position-after svg'  => 'padding-left: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'enable_btn_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_top_spacing',
            [
                'label'       => __( 'Icon Top Spacing', 'edubin-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .edubin-button-icon-position-before i, {{WRAPPER}} .edubin-button-icon-position-before svg, {{WRAPPER}} .edubin-button-icon-position-after i, {{WRAPPER}} .edubin-button-icon-position-after svg'  => 'top: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'enable_btn_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'        => __( 'Icon Size', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-btn svg' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'enable_btn_icon' => 'yes',
                ],
            ]
        );


        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'edubin-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start' => [
                        'title'  => __( 'Left', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title'  => __( 'Right', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .edubin-button-widget-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // $this->start_controls_section(
        //     'container_style',
        //     [
        //         'label' => __( 'Container', 'edubin-core' ),
        //         'tab'   => Controls_Manager::TAB_STYLE,
        //         'condition' => [
        //             'size' => ['custom']
        //         ]
        //     ]
        // );


        // $this->add_responsive_control(
        //     'height',
        //     [
        //         'label'        => __( 'Height', 'edubin-core' ),
        //         'type'         => Controls_Manager::SLIDER,
        //         'size_units'   => [ 'px' ],
        //         'range'        => [
        //             'px'       => [
        //                 'min'  => 0,
        //                 'max'  => 200,
        //                 'step' => 1
        //             ]
        //         ],
        //         'selectors'    => [
        //             '{{WRAPPER}} .edubin-btn' => 'height: {{SIZE}}{{UNIT}};'
        //         ]
        //     ]
        // );

        // $this->add_responsive_control(
        //     'line_height',
        //     [
        //         'label'        => __( 'Line Height', 'edubin-core' ),
        //         'type'         => Controls_Manager::SLIDER,
        //         'size_units'   => [ 'px' ],
        //         'range'        => [
        //             'px'       => [
        //                 'min'  => 0,
        //                 'max'  => 200,
        //                 'step' => 1
        //             ]
        //         ],
        //         'selectors'    => [
        //             '{{WRAPPER}} .edubin-btn' => 'line-height: {{SIZE}}{{UNIT}};'
        //         ]
        //     ]
        // );

        // $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .edubin-btn',
            ]
        );
        $this->start_controls_tabs( 
            'style_tabs',
            [
                'condition' => [
                    'style' => ['custom','2', '3']
                ]
            ]
        );

            $this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', 'edubin-core' ) ] );

            $this->add_control(
                'color',
                [
                    'label'     => __( 'Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-btn' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-btn svg' => 'fill: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'bg_color',
                [
                    'label'     => __( 'Background Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-btn' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'border',
                    'selector' => '{{WRAPPER}} .edubin-btn'
                ]
            );

            $this->add_responsive_control(
                'border_radius',
                [
                    'label'      => __( 'Border Radius', 'edubin-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'box_shadow',
                    'selector' => '{{WRAPPER}} .edubin-btn'
                ]
            );

            $this->add_responsive_control(
                'padding',
                [
                    'label'      => __( 'Padding', 'edubin-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', 'edubin-core' ) ] );

            $this->add_control(
                'hover_color',
                [
                    'label'     => __( 'Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-btn:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-btn:hover svg' => 'fill: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'hover_bg_color',
                [
                    'label'     => __( 'Background Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-btn:hover' => 'background: {{VALUE}};',
                        '{{WRAPPER}} .edubin-btn:after' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'hover_border',
                    'selector' => '{{WRAPPER}} .edubin-btn:hover'
                ]
            );

            $this->add_responsive_control(
                'hover_border_radius',
                [
                    'label'      => __( 'Border Radius', 'edubin-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'hover_box_shadow',
                    'selector' => '{{WRAPPER}} .edubin-btn:hover'
                ]
            );

            $this->add_responsive_control(
                'padding_hover',
                [
                    'label'      => __( 'Padding', 'edubin-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-btn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
	}
// =========== Render ===========
	protected function render() {
        $settings     = $this->get_settings_for_display();

        $this->add_render_attribute(
            'container',
            [
                'class' => [
                    'edubin-btn',
                    'edubin-btn-' . esc_attr( $settings['style'] ),
                    'edubin-btn-size-' . esc_attr( $settings['size'] ),
                ]
            ]
        );

        if ($settings['enable_btn_icon'] == 'yes'){
            $this->add_render_attribute( 'container', 'class', ' edubin-btn-icon edubin-button-icon-position-' . esc_attr( $settings['icon_position'] ) );
        };

        if ( 'custom' !== $settings['style'] ) :
            $this->add_render_attribute( 'container', 'class', 'default-style' );
        endif;

        if ( $settings['url']['url'] ) :
            $this->add_render_attribute( 'container', 'href', esc_url( $settings['url']['url'] ) );
            if ( $settings['url']['is_external'] ) :
                $this->add_render_attribute( 'container', 'target', '_blank' );
            endif;
            if ( $settings['url']['nofollow'] ) :
                $this->add_render_attribute( 'container', 'rel', 'nofollow' );
            endif;
        endif;

        echo '<div class="edubin-button-widget-wrapper">';
            if ( $settings['text'] ) :
                echo '<a ' . $this->get_render_attribute_string( 'container' ) . '>';
                    if ( 'before' === $settings['icon_position'] && ! empty( $settings['icon']['value'] ) ) :
                        Icons_Manager::render_icon( $settings['icon'] );
                    endif;
                    echo esc_html( $settings['text'] );
                    if ( 'after' === $settings['icon_position'] && ! empty( $settings['icon']['value'] ) ) :
                        Icons_Manager::render_icon( $settings['icon'] );
                    endif;
                echo '</a>';
            endif;
        echo '</div>';
    }
}
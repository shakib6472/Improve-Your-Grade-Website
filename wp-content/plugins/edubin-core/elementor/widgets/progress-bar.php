<?php

namespace EdubinCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; 

class ProgressBar extends Widget_Base {

    public function get_name() {
        return 'edubin-progress-bar';
    }

    public function get_title() {
        return __( 'Progress Bar', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-skill-bar';
    }

	public function get_script_depends() {
		return [ 'count-to' ];
	}

	public function get_keywords() {
		return [ 'edubin', 'skill bar', 'progress', 'bar', 'pie', 'pregressbar'];
	}

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    // =========== Register Controls ===========
    protected function register_controls() {

        $this->start_controls_section( 
            'section_circle_progress', 
            [
			    'label' => __( 'Circle Progress', 'edubin-core' )
            ] 
        );

        $this->add_control(
            'title',
            [
                'label'   => __( 'Title', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Online Learning', 'edubin-core' )
            ]
        );

		$this->add_control( 
            'progress', 
            [
                'label'        => __( 'Progress', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'default'      => [
                    'size'     => 80
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1
                    ]
                ]
            ] 
        );

        $this->add_responsive_control(
            'height',
            [
                'label'      => __( 'Height', 'edubin-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px'     => [
                        'min'  => 5,
                        'max'  => 50,
                        'step' => 1
                    ]
                ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 10
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-single-progressbar .tpc-progressbar, {{WRAPPER}} .tpc-single-progressbar .tpc-progressbar-inner' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __( 'Border Radius', 'edubin-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px'     => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 5
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-single-progressbar .tpc-progressbar, {{WRAPPER}} .tpc-single-progressbar .tpc-progressbar-inner' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'spacing',
            [
                'label'      => __( 'Spacing', 'edubin-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px'     => [
                        'min'  => 5,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tpc-single-progressbar .tpc-progressbar-content' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
			'color_separator',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'default'
			]
		);
        
        $this->add_control(
			'background_color',
			[
				'label'		=> __( 'Background Color', 'edubin-core' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#e6e6e6',
				'selectors'	=> [
					'{{WRAPPER}} .tpc-single-progressbar .tpc-progressbar' => 'background-color: {{VALUE}};'
				]
			]
		);

        $this->add_control(
            'active_progress_color',
            [
				'label' => __( 'Progress Active Color', 'edubin-core' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'active_progress_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tpc-single-progressbar.sal-animate[data-sal] .tpc-progressbar-inner'
			]
		);

		$this->end_controls_section();
    }

   // =========== Render ===========
    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<div class="tpc-single-progressbar" data-sal data-width="' . esc_attr( $settings['progress']['size'] ) . '">';
        echo '<div class="tpc-progressbar-content">';
            echo '<h6 class="tpc-progressbar-title">' . esc_html( $settings['title'] ) . '</h6>';
            echo '<div class="tpc-progressbar-counter-wrapper">';
                echo '<span class="tpc-progressbar-counter">0</span><span>%</span>';
            echo '</div>';
        echo '</div>';
            echo '<div class="tpc-progressbar">';
                echo '<div class="tpc-progressbar-inner"></div>';
            echo '</div>';
        echo '</div>';
    }
}
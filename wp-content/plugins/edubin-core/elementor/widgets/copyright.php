<?php

namespace EdubinCore\HF\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; 

class Edubin_Copyright extends Widget_Base {

	public function get_name() {
		return 'edubin-footer-copyright';
	}

	public function get_title() {
		return __( 'Copyright', 'edubin-core' );
	}

    public function get_icon() {
        return 'edubin-elementor-icon eicon-footer';
    }

	public function get_keywords() {
		return [ 'edubin', 'copy', 'copyright', 'footer' ];
	}

	public function get_categories() {
		return [ 'edubin-core-hf' ];
	}

    // =========== Register Controls ===========
	protected function register_controls() {
       
     
        $this->start_controls_section(
            'section_copyright',
            [
                'label' => __( 'Copyright', 'edubin-core' )
            ]
        );

        $this->add_control(
			'shortcode',
			[
				'label'   => __( 'Copyright Text', 'edubin-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Copyright [edubin_core_running_year] [edubin_core_site_title] | Developed By Pixelcurve. All Rights Reserved', 'edubin-core' )
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'copyright_style',
            [
                'label'     => __( 'Copyright', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'edubin-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left' => [
                        'title'  => __( 'Left', 'edubin-core' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'edubin-core' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'   => [
                        'title'  => __( 'Right', 'edubin-core' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .edubin-copyright-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .edubin-copyright-wrapper span'
            ]
        );

        $this->add_control(
            'color',
            [
                'label'     => __( 'Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-copyright-wrapper span, {{WRAPPER}} .edubin-copyright-wrapper a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'       => __( 'Link Color', 'edubin-core' ),
                'type'        => Controls_Manager::COLOR,
                'description' => __( 'Only applicable if there is any link.', 'edubin-core' ),
                'selectors'   => [
                    '{{WRAPPER}} .edubin-copyright-wrapper span a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'       => __( 'Link Hover Color', 'edubin-core' ),
                'type'        => Controls_Manager::COLOR,
                'default'     => '#ffc600',
                'description' => __( 'Only applicable if there is any link.', 'edubin-core' ), 
                'selectors'   => [
                    '{{WRAPPER}} .edubin-copyright-wrapper a:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // =========== Render ===========
    protected function render() {
        $settings = $this->get_settings_for_display();
        $copyright = do_shortcode( shortcode_unautop( $settings['shortcode'] ) );

        echo '<div class="edubin-copyright-wrapper">';
            echo '<span>' . wp_kses_post( $copyright ) . '</span>';
        echo '</div>';
    }
}
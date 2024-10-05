<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Info_box extends Widget_Base {

    public function get_name()
    {
        return 'edubin-info-box';
    }

    public function get_title()
    {
        return __('Info Box', 'edubin-core');
    }

    public function get_icon()
    {
        return 'edubin-elementor-icon eicon-info-box';
    }

    public function get_categories()
    {
        return ['edubin-core'];
    }

    public function get_keywords() {
        return ['information', 'info box', 'information box', 'icon box', 'image box', 'addons'];
    }
    
    // public function get_help_url() {
    //     return 'https://thepixelcurve.com/docs/general-widgets/call-to-action-widget/';
    // }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'edubin-core'),
            ]
        );
    
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'edubin-core' ),
                    'image_icon' => esc_html__( 'Image Icon', 'edubin-core' ),
                ],
            ]
        );        

        $this->add_control(
            'selected_image',
            [
                'label' => __( 'Image', 'edubin-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image_icon',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'include' => [],
                'condition' => [
                    'icon_type' => 'image_icon',
                ],
			]
		);


        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'edubin-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-book-reader',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
			'info_text',
			[
				'label' => esc_html__( 'Info Text', 'edubin-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'This is default information text', 'edubin-core' ),
				'placeholder' => esc_html__( 'Type your text here', 'edubin-core' ),
                'separator' => 'before',
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
                    'p' => 'p',
                ],
                'default' => 'p',
            ]
        );

        $this->add_control(
			'mouse_track_effect',
			[
				'label' => esc_html__( 'Add Mouse Track Effect', 'edubin-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'edubin-core' ),
				'label_off' => esc_html__( 'No', 'edubin-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
        );
    
        $this->end_controls_section();

        $this->start_controls_section(
            'section_mouse_track',
            [
                'label'     => __( 'Mouse Move', 'edubin-core' ),
                'condition' => [
                    'mouse_track_effect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'mouse_speed',
            [
                'label'        => __( 'Speed', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -10,
                        'step' => 0.1,
                        'max'  => 10
                    ]
                ],
                'default'      => [
                    'size'     => 0.5
                ],
                'description'  => __( 'Negative value will work on mouse direction. Positive value will work on mouse reverse direction.', 'edubin-core' )
            ]
        );

        $this->end_controls_section();
    
        // Styles section
        $this->start_controls_section(
            'info_box_style',
            [
                'label' => __( 'Styles', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'info_box_margin',
            [
                'label' => esc_html__( 'Margin', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'info_box_padding',
            [
                'label' => esc_html__( 'Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'info_box_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .edubin-info-box-wrapper',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'info_box_border',
				'selector' => '{{WRAPPER}} .edubin-info-box-wrapper',
                'separator' => 'before',
			]
		);
    
        $this->add_responsive_control(
            'info_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'info_box_shadow',
				'selector' => '{{WRAPPER}} .edubin-info-box-wrapper',
			]
		);
        $this->add_responsive_control(
            'section_width',
            [
                'label' => __( 'Width', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1140,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        

        $this->end_controls_section();


        $this->start_controls_section(
            'image_icon_style',
            [
                'label' => __( 'Icon / Image', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'edubin-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__( 'Left', 'edubin-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'column' => [
						'title' => esc_html__( 'Top', 'edubin-core' ),
						'icon' => 'eicon-v-align-top',
					],
					'row-reverse' => [
						'title' => esc_html__( 'Right', 'edubin-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => true,
                'selectors' => [
					'{{WRAPPER}} .edubin-info-box-wrapper' => 'flex-direction: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'icon_wrap_margin',
            [
                'label' => esc_html__( 'Margin', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'icon_wrap_padding',
            [
                'label' => esc_html__( 'Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_wrap_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .icon-wrapper',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_wrapper_border',
				'selector' => '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper',
                'separator' => 'before',
			]
		);
    
        $this->add_responsive_control(
            'image_wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_wrapper_shadow',
				'selector' => '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper',
			]
		);
        $this->add_responsive_control(
            'img_wrapper_width',
            [
                'label' => __( 'Width', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1140,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'icon_image_options',
			[
				'label' => esc_html__( 'Icon / Image Settings', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => __( 'Icon Width', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1140,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-info-box-wrapper .icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'title_text_style',
            [
                'label' => __( 'Text', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'text_align',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .edubin-info-box-wrapper .info-text-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_box_content_typography',
				'selector' => '{{WRAPPER}} .edubin-info-box-wrapper .info-text-wrapper .info-text',
			]
		);

        $this->add_control(
			'info_box_text_color',
			[
				'label' => esc_html__( 'Text Color', 'edubin-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'color: {{VALUE}}',
				],
			]
		);


        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();


        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        $title_tag = $settings['title_tag'];
        $elem_id       = $this->get_id();

        $this->add_render_attribute('wrapper', 'class', 'edubin-info-box-wrapper');
        if($settings['icon_position'] == 'row-reverse'){
            $this->add_render_attribute('wrapper', 'class', 'icon-right');
        }
        if($settings['icon_position'] == 'column'){
            $this->add_render_attribute('wrapper', 'class', 'icon-top');
        }

        if($settings['mouse_track_effect'] == 'yes'){
            $this->add_render_attribute('info-animation', 'class', 'edubin-info-box-animation edubin-mouse-track-item');
            $this->add_render_attribute('info-animation', 'id', $elem_id);
            $this->add_render_attribute('main-wrapper', 'class', 'edubin-info-box-main');
            $this->add_render_attribute('main-wrapper', 'data-depth', esc_attr( $settings['mouse_speed']['size'] ));
        }
        if($settings['mouse_track_effect'] == 'yes'){
            echo '<div '.$this->get_render_attribute_string( 'info-animation' ).'>';
                echo '<div '.$this->get_render_attribute_string( 'main-wrapper' ).'>';
        }
                echo '<div '.$this->get_render_attribute_string( 'wrapper' ).'>';
                    echo '<div class="icon-wrapper">';
                        if($settings['icon_type'] == 'image_icon'){
                            echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_size', 'selected_image');
                        }else{
                            if ( $is_new || $migrated ) {
                                Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                            }else { 
                                echo '<i '.$this->print_render_attribute_string( 'icon' ).'></i>';
                            };                   
                        }
                    echo '</div>';
                    echo '<div class="info-text-wrapper">';
                        echo '<'.$title_tag.' class="info-text">';
                            echo  $settings['info_text'];
                        echo '</'.$title_tag.'>';
                    echo '</div>';
                echo '</div>';

        if($settings['mouse_track_effect'] == 'yes'){
                echo '</div>';
            echo '</div>';
        }

   

    }

}


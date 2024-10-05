<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use \Elementor\Widget_Base;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Section_3 extends Widget_Base {

    public function get_name()
    {
        return 'edubin-section-3';
    }

    public function get_title()
    {
        return __('Hero Section 3', 'edubin-core');
    }

    public function get_icon()
    {
        return 'edubin-elementor-icon eicon-layout-settings';
    }

    public function get_categories()
    {
        return ['edubin-core'];
    }

    public function get_keywords() {
        return ['hero', 'section', 'image', 'addons'];
    }
    
    public function get_help_url() {
        return 'https://thepixelcurve.com/docs/general-widgets/call-to-action-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'edubin-core'),
            ]
        );
       $this->add_control(
            'heading',
            [
                'label'   => __( 'Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "The <span>largest</span> online learning platform for improve skills",
            ]
        );
       $this->add_control(
            'sub_heading',
            [
                'label'   => __( 'Sub Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'This theme includes all the necessary pages of the onlineLorem ipsum gravida nibh vel velit auctor aliquetn ',
            ]
        );   
        $this->end_controls_section();
    
        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'edubin-core'),
            ]
        );
        $this->add_control(
            'show_button',
            [
                'label' => esc_html__( 'Button', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Text', 'edubin-core' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'Get Started for Free', 'edubin-core' ),
                ]
            );
    
            $this->add_control(
                'button_link',
                [
                    'label' => esc_html__( 'Link', 'edubin-core' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => esc_html__( 'https://your-link.com', 'edubin-core' ),
                    'default' => [
                        'url' => '#',
                    ],
                ]
            );
    
        $this->end_controls_section();
    
        $this->start_controls_section(
            'iamges_section',
            [
                'label' => __('Images', 'edubin-core'),
            ]
        );
    
        $this->add_control(
            'image_1',
            [
                'label'   => __('Image 1', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_1_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
    
        $this->add_control(
            'add_img_overlay',
            [
                'label' => esc_html__( 'Add Img Overlay?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edubin-core' ),
                'label_off' => esc_html__( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
    
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'img_overlay',
                'label' => __( 'Image Overlay', 'edubin-core' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .edubin-hero-2 .hero-images .img-man::before',
            ]
        );
    
        $this->add_control(
            'image_2',
            [
                'label'   => __('Image 2', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_2_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
        $this->add_control(
            'img_3_amim',
            [
                'label' => esc_html__( 'Animation Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'edubin-core' ),
                    'anim_1' => esc_html__( 'Animation 1', 'edubin-core' ),
                    'anim_2'  => esc_html__( 'Animation 2', 'edubin-core' ),
                    'anim_3' => esc_html__( 'Animation 3', 'edubin-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_3',
            [
                'label' => __( 'Animation Delay', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .hero-images .img-shape-1' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_control(
            'hide_shape_3',
            [
                'label' => esc_html__( 'Hide On Small Device', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edubin-core' ),
                'label_off' => esc_html__( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'image_3',
            [
                'label'   => __('Image 3', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_3_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
    
        $this->add_control(
            'image_4',
            [
                'label'   => __('Image 4', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_4_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
    
        $this->add_control(
            'img_1_amim',
            [
                'label' => esc_html__( 'Animation Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'mouse',
                'options' => [
                    'none' => esc_html__( 'None', 'edubin-core' ),
                    'mouse' => esc_html__( 'Mouse Move', 'edubin-core' ),
                    'anim_1' => esc_html__( 'Animation 1', 'edubin-core' ),
                    'anim_2'  => esc_html__( 'Animation 2', 'edubin-core' ),
                    'anim_3' => esc_html__( 'Animation 3', 'edubin-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_1',
            [
                'label' => __( 'Animation Delay', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-3' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_control(
            'hide_shape_1',
            [
                'label' => esc_html__( 'Hide On Small Device', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edubin-core' ),
                'label_off' => esc_html__( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'image_5',
            [
                'label'   => __('Image 5', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_control(
            'img_2_amim',
            [
                'label' => esc_html__( 'Animation Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'mouse',
                'options' => [
                    'none' => esc_html__( 'None', 'edubin-core' ),
                    'mouse' => esc_html__( 'Mouse Move', 'edubin-core' ),
                    'anim_1' => esc_html__( 'Animation 1', 'edubin-core' ),
                    'anim_2'  => esc_html__( 'Animation 2', 'edubin-core' ),
                    'anim_3' => esc_html__( 'Animation 3', 'edubin-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_2',
            [
                'label' => __( 'Animation Delay', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-4' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_control(
            'hide_shape_2',
            [
                'label' => esc_html__( 'Hide On Small Device', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edubin-core' ),
                'label_off' => esc_html__( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_5_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
        $this->end_controls_section();
    
        $this->start_controls_section(
            'front_section',
            [
                'label' => __('Front Content', 'edubin-core'),
            ]
        );
        $this->add_control(
            'show_front_section',
            [
                'label' => esc_html__( 'Front Section', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->add_control(
            'show_front_icon',
            [
                'label' => esc_html__( 'Icon', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
            $this->add_control(
                'front_icon',
                [
                    'label'   => __('Image', 'edubin-core'),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name'      => 'front_iconsize',
                    'default'   => 'full',
                    'separator' => 'none',
                ]
            );
       $this->add_control(
            'front_text',
            [
                'label'   => __( 'Front Text', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "Best <span>Learning Platform</span> for anyone & everything",
            ]
        );
    
       $this->add_control(
            'front_sub_text',
            [
                'label'   => __( 'Sub Text', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "Marian Hedge",
            ]
        );
    
        $this->end_controls_section();
    
            //======================================================================
            // Heading Style
            //======================================================================
    
            $this->start_controls_section(
                'title_style',
                [
                    'label' => __('Heading', 'edubin-core'),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography',
                    'label'    => __('Typography', 'edubin-core'),
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-hero-2 .title',
                ]
            );
            $this->add_control(
                'title_span_color',
                [
                    'label'     => __('Span Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#3BBC9B',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 .title span' => 'color: {{VALUE}}; text-decoration-color: {{VALUE}}',
                        '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .hero-content .title span:before' => 'background: {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_span_typography',
                    'label'    => __('Span Typography', 'edubin-core'),
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-hero-2 .title span, .edubin-hero-2.edubin-section-3 .hero-content .title span:before',
                ]
            );
    
            $this->add_control(
                'heading_sub_heading',
                [
                    'label'     => __('Sub Heading', 'edubin-core'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );
         $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography',
                    'label'    => __('Typography', 'edubin-core'),
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .hero-content .sub-title',
                ]
            );
            $this->add_control(
                'sub_title_color',
                [
                    'label'     => __('Sub Heading Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hero-content .sub-title' => 'color: {{VALUE}}; text-decoration-color: {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->end_controls_section();
    
            //======================================================================
            // Button style one
            //======================================================================
            $this->start_controls_section(
                'btn_section_style',
                [
                    'label' => __('Button', 'edubin-core'),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );
    
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'typography',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-hero-2 a.here-btn',
                ]
            );
    
            $this->start_controls_tabs('tabs_button_style');
    
            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => __('Normal', 'edubin-core'),
                ]
            );
    
            $this->add_control(
                'button_text_color',
                [
                    'label'     => __('Text Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn' => 'color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'background_color',
                [
                    'label'     => __('Background Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'button_hover_border_color_one',
                [
                    'label'     => __('Border Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->end_controls_tab();
    
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => __('Hover', 'edubin-core'),
                ]
            );
    
            $this->add_control(
                'hover_color',
                [
                    'label'     => __('Text Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'button_background_hover_color',
                [
                    'label'     => __('Background Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'button_hover_border_color',
                [
                    'label'     => __('Border Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->end_controls_tab();
    
            $this->end_controls_tabs();
    
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'        => 'border',
                    'placeholder' => '1px',
                    'default'     => '1px',
                    'selector'    => '{{WRAPPER}} .edubin-hero-2 a.here-btn',
                    'separator'   => 'before',
                ]
            );
    
            $this->add_control(
                'border_radius',
                [
                    'label'      => __('Border Radius', 'edubin-core'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .edubin-hero-2 a.here-btn',
                ]
            );
    
            $this->add_responsive_control(
                'text_padding',
                [
                    'label'      => __('Padding', 'edubin-core'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-hero-2 a.here-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'  => 'before',
                ]
            );
    
            $this->end_controls_section();
     
    
        // Styles section
        $this->start_controls_section(
            'front_text_section_style',
            [
                'label' => __( 'Front Text', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'front_bg_color',
            [
                'label'     => __('Background Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .front-image-content' => 'background: {{VALUE}}',
                ],
            ]
        );  
        $this->add_control(
            'front_text_color',
            [
                'label'     => __('Text Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .front-image-content .hero-content-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'front_text_spane_color',
            [
                'label'     => __('Text Span Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .front-image-content .hero-content-heading span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'front_sub_text_color',
            [
                'label'     => __('Sub Text Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .front-image-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'front_icon_bg_color',
            [
                'label'     => __('Icon background', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .front-image-content .image-icon' => 'background: {{VALUE}}',
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'front_contetn_box_shadow',
                    'selector' => '{{WRAPPER}} .front-image-content',
                ]
            );
    
            $this->add_responsive_control(
                'front_content_padding',
                [
                    'label'      => __('Padding', 'edubin-core'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .front-image-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'  => 'before',
                ]
            );
        $this->add_responsive_control(
            'front_content_position',
            [
                'label' => __( 'Front Content Position X', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .front-image-content' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'front_content_position_y',
            [
                'label' => __( 'Front Content Position Y', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .front-image-content' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    
        // Styles section
        $this->start_controls_section(
            'section_style_bg',
            [
                'label' => __( 'Background', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_color',
                'label' => __( 'Background', 'edubin-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .edubin-hero-2',
            ]
        );
        $this->end_controls_section();
    
        // Styles spicing
        $this->start_controls_section(
            'section_position_style',
            [
                'label' => __( 'Position & Spacing', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_responsive_control(
            'hero_area_padding',
            [
                'label'      => __('Padding', 'edubin-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-hero-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
        $this->add_responsive_control(
            'hero_section_height',
            [
                'label' => __( 'Section Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_top_space',
            [
                'label' => __( 'Content Top Space', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2 .hero-content' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'content_top_margin',
            [
                'label' => __( 'Content Top Margin', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ], 
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2 .hero-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_responsive_control(
            'media_bottom_space',
            [
                'label' => __( 'Media Top Space', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .hero-images' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_1_width',
            [
                'label' => __( 'Image 1 Width', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2 .img-man' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_1_position',
            [
                'label' => __( 'Image 1 Position X', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2 .img-man' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_1_position_y',
            [
                'label' => __( 'Image 1 Position Y', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2 .img-man' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'image_2_width',
            [
                'label' => __( 'Image 2 Width', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-images .img-shape-1 img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_2_position',
            [
                'label' => __( 'Image 2 Position X', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-images .img-shape-1' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );    
        $this->add_responsive_control(
            'image_2_position_y',
            [
                'label' => __( 'Image 2 Position Y', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-images .img-shape-1' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'image_3_position',
            [
                'label' => __( 'Image 3 Position X', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-3' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );    
        $this->add_responsive_control(
            'image_3_position_left',
            [
                'label' => __( 'Image 3 Position X From Left', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-3' => 'left: {{SIZE}}{{UNIT}}; right: unset !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_3_position_y',
            [
                'label' => __( 'Image 3 Position Y', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-3' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'image_4_position',
            [
                'label' => __( 'Image 4 Position X', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-4' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );    
        $this->add_responsive_control(
            'image_4_position_left',
            [
                'label' => __( 'Image 4 Position X From Left', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-4' => 'left: {{SIZE}}{{UNIT}}; right: unset !important;',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'image_4_position_y',
            [
                'label' => __( 'Image 4 Position Y', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-hero-2.edubin-section-3 .img-shape-4' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $add_img_overlay = ($settings['add_img_overlay'] == 'yes') ? ('edubin-img-overlay') : ('');
    $hide_shape_1 = ($settings['hide_shape_1'] == 'yes') ? ('img-hide') : ('');
    $hide_shape_2 = ($settings['hide_shape_2'] == 'yes') ? ('img-hide') : ('');
    $hide_shape_3 = ($settings['hide_shape_3'] == 'yes') ? ('img-hide') : ('');

    // Image 1 Animation 
    $image_animation_1 = $settings['img_1_amim'];
    $anim_class_1= '';
    switch ($image_animation_1) {
    case "anim_1":
        $anim_class_1 = 'anim-1';
        break;
    case "anim_2":
        $anim_class_1 = 'anim-2';
        break;
    case "anim_3":
        $anim_class_1 = 'anim-3';
        break;
    case "none":
        $anim_class_1 = ' ';
        break;
    default:
        $anim_class_1 = 'edubin-mouse-track-item';
    }

    // Image 2 Animation 
    $image_animation_2 = $settings['img_2_amim'];
    $anim_class_2 = '';
    switch ($image_animation_2) {
    case "anim_1":
        $anim_class_2 = 'anim-1';
        break;
    case "anim_2":
        $anim_class_2 = 'anim-2';
        break;
    case "anim_3":
        $anim_class_2 = 'anim-3';
        break;
    case "none":
        $anim_class_2 = ' ';
        break;
    default:
        $anim_class_2 = 'edubin-mouse-track-item';
    }

    // Image 3 Animation 
    $image_animation_3 = $settings['img_3_amim'];
    $anim_class_3 = '';
    switch ($image_animation_3) {
    case "anim_1":
        $anim_class_3 = 'anim-1';
        break;
    case "anim_2":
        $anim_class_3 = 'anim-2';
        break;
    case "anim_3":
        $anim_class_3 = 'anim-3';
        break;
    default:
        $anim_class_3 = ' ';
    }

    ?>

     <!-- Hero Start -->
        <div class="edubin-hero-2 edubin-section-3">
            <div class="img-shape-2">
               <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_3_size_size', 'image_3'); ?>
            </div>
            <div class="img-shape-3 <?php echo $anim_class_1.' '.$hide_shape_1 ?>">
                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_4_size_size', 'image_4'); ?>
            </div>
            <div class="img-shape-4 <?php echo $anim_class_2 .' '.$hide_shape_2 ?>">
                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_5_size_size', 'image_5'); ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="edubin-col-lg-6">
                        <!-- Hero Content Start -->
                        <div class="hero-content">
                            <?php if ($settings['heading']): ?>
                                <h2 class="title" data-sal="slide-up" data-sal-delay="100" data-sal-duration="1000"data-sal-easing="easeOutCubic"><?php echo $settings['heading']; ?></h2>
                            <?php endif ?>
                            <?php if ($settings['sub_heading']): ?>
                                <p class="sub-title" data-sal="slide-up" data-sal-delay="300" data-sal-duration="1000"data-sal-easing="easeOutCubic"><?php echo $settings['sub_heading']; ?></p>
                            <?php endif; ?>
                            <?php if ($settings['show_button']): ?>
                                <a class="edubin-btn" data-sal="slide-up" data-sal-delay="500" data-sal-duration="1000"data-sal-easing="easeOutCubic" <?php echo ($settings['button_link']["is_external"] == 'on') ? 'target="_blank"' : '' ; ?> href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo $settings['button_text']; ?></a>
                            <?php endif; ?>

                        </div>
                        <!-- Hero Content End -->
                    </div>
                    <div class="edubin-col-lg-6">
                        <!-- Hero Image Start -->
                        <div class="hero-images">
                            <?php if ($settings['image_2']): ?>
                                <div class="img-shape-1 <?php echo $anim_class_3.' '.$hide_shape_3 ?>">
                                   <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_2_size_size', 'image_2'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($settings['image_1']): ?>
                                <div class="img-man <?php echo $add_img_overlay?>">
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_1_size_size', 'image_1'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- Hero Image End -->
                            <?php if ($settings['show_front_section']): ?>
    
                                <div class="front-image-content">
                                    <?php if ($settings['show_front_icon']): ?>
                                        <div class="image-icon">
                                            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'front_iconsize', 'front_icon'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($settings['front_text']): ?>
                                    <h3 class="hero-content-heading">
                                       <?php echo $settings['front_text']; ?>
                                    </h3>
                                     <?php endif; ?>
                                     <?php if ($settings['front_sub_text']): ?>
                                        <p><?php echo $settings['front_sub_text']; ?></p>
                                     <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Hero End -->
<?php

    }

}


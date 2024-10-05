<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use \Elementor\Widget_Base;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Section_6 extends Widget_Base {

    public function get_name()
    {
        return 'edubin-section-6';
    }

    public function get_title()
    {
        return __('Hero Section 6', 'edubin-core');
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
        return ['section 4', 'section', 'image','hero', 'addons'];
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
            'title_1',
            [
                'label'   => __( 'Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "Online",
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_1',
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .edubin-section-6 .hero-content .hero-content-wrapper .title-1::after',
            ]
        );
        $this->add_control(
            'title_2',
            [
                'label'   => __( 'Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "Language",
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_2',
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .edubin-section-6 .hero-content .hero-content-wrapper .title-2::after',
            ]
        );
        $this->add_control(
            'title_3',
            [
                'label'   => __( 'Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "School",
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_3',
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .edubin-section-6 .hero-content .hero-content-wrapper .title-3::after',
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
                'label'   => __('Front Image', 'edubin-core'),
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
        $this->add_responsive_control(
            'image_1_position_x',
            [
                'label' => __( 'Front Image Position X', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-6 .hero-images .img-man' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'image_1_position_y',
            [
                'label' => __( 'Front Image Position Y', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-6 .hero-images .img-man' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_bg',
                'types' => [ 'classic' ],
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .edubin-section-6 .hero-images',
            ]
        );    
    
        $this->end_controls_section();
    
    
        // Shape
        $this->start_controls_section(
            'shape_section',
            [
                'label' => __('Shape', 'edubin-core'),
            ]
        );
        $this->add_control(
            'shape_a',
            [
                'label'   => __('Shape A', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                
            ]
        );
    
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'shape_a_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
    
        $this->add_responsive_control(
            'shape_a_position_x',
            [
                'label' => __( 'Shape A Position X', 'edubin-core' ),
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images .shape-2' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'shape_a_position_y',
            [
                'label' => __( 'Shape A Position Y', 'edubin-core' ),
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images .shape-2' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_control(
            'shape_b',
            [
                'label'   => __('Shape B', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                
            ]
        );
    
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'shape_b_size',
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );
    
        
    
        $this->add_responsive_control(
            'shape_b_position_x',
            [
                'label' => __( 'Shape B Position X', 'edubin-core' ),
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images .shape-3' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'shape_b_position_y',
            [
                'label' => __( 'Shape B Position Y', 'edubin-core' ),
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images .shape-3' => 'top: {{SIZE}}{{UNIT}};',
                ],
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
                    'selector' => '{{WRAPPER}} .edubin-section-6 .hero-content .hero-content-wrapper h2',
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label'     => __('Heading Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hero-content .hero-content-wrapper > h2' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
    
            $this->add_responsive_control(
                'title_align',
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
                        '{{WRAPPER}} .edubin-section-6 .hero-content .hero-content-wrapper' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                    'separator' =>'before',
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
                'selector' => '{{WRAPPER}} .edubin-section-6',
            ]
        );
    
        $this->add_control(
            'bottom_shape',
            [
                'label' => esc_html__( 'Add Bottom Shape?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                
            ]
        );
    
        $this->add_control(
            'bottom_shape_wave',
            [
                'label'   => __('Section Bottom Shape', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'condition' => [
                    'bottom_shape' => 'yes',
                ]
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
                    '{{WRAPPER}} .edubin-section-6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
    
        $this->add_responsive_control(
            'content_top_space',
            [
                'label' => __( 'Content Top Space', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-6 .hero-content' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'content_bottom_space',
            [
                'label' => __( 'Content Bottom Space', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-6 .hero-content' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images' => 'padding-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images .img-man' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-6 .hero-images .img-man' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        ?>
    
         <!-- Hero Start -->
            <div class="edubin-section-6">
                <?php if ($settings['bottom_shape_wave']): ?>
                    <div class="shape-1">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'bottom_shape_wave'); ?>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="edubin-col-lg-7 p-xl-0">
                            <!-- Hero Content Start -->
                            <div class="hero-content">
                                <div class="hero-content-wrapper">
                                    <?php if ($settings['title_1']): ?>
                                        <h2 class="title-1"><?php echo $settings['title_1']; ?></h2>
                                    <?php endif; ?>
                                    <?php if ($settings['title_2']): ?>
                                        <h2 class="title-2"><?php echo $settings['title_2']; ?></h2>
                                    <?php endif; ?>
                                    <?php if ($settings['title_3']): ?>
                                        <h2 class="title-3"><?php echo $settings['title_3']; ?></h2>
                                    <?php endif; ?>
                                </div> 
                            </div>
                            <!-- Hero Content End -->
                        </div>
                        <div class="edubin-col-lg-5">
                            <!-- Hero Image Start -->
                            <div class="hero-images">
                                <div class="shape-2">
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'shape_a_size', 'shape_a'); ?>
                                </div>
                                <div class="shape-3">
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'shape_b_size', 'shape_b'); ?>
                                </div>
                                
                                <?php if ($settings['image_1']): ?>
                                    <div class="img-man">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_1_size', 'image_1'); ?>
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


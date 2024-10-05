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

class Edubin_Elementor_Widget_Section_5 extends Widget_Base {

    public function get_name()
    {
        return 'edubin-section-5';
    }

    public function get_title()
    {
        return __('Hero Section 5', 'edubin-core');
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
            'heading',
            [
                'label'   => __( 'Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "Lets build skills with our professional 2500+ Courses",
            ]
        );
       $this->add_control(
            'sub_heading',
            [
                'label'   => __( 'Sub Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Build Your Future with our courses',
            ]
        );
          
        $this->end_controls_section();
    
        $this->start_controls_section(
            'hero_feature_section',
            [
                'label' => __('Hero Features', 'edubin-core'),
            ]
        );
       $this->add_control(
            'features_txt_1',
            [
                'label'   => __( 'Feature Text 1', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "Over 155,000 Online Courses",
            ]
        );
       $this->add_control(
            'features_txt_2',
            [
                'label'   => __( 'Feature Text 2', 'edubin-core' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'fetime courses from top instructo',
            ]
        );
        
        $this->add_control(
            'feature_img_1',
            [
                'label'   => __('Feature Image 2', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
            ]
        );
    
    
        $this->add_control(
            'feature_img_2',
            [
                'label'   => __('Feature Image 2', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
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
            'bottom_shape_wave',
            [
                'label'   => __('Section Bottom Shape', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                
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
                    'selector' => '{{WRAPPER}} .edubin-section-5 .title',
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label'     => __('Heading Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hero-content .title' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
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
            // Hero Feature Style
            //======================================================================
    
            $this->start_controls_section(
                'hero_feature_style',
                [
                    'label' => __('Hero Features', 'edubin-core'),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'feature_txt_typo',
                    'label'    => __('Typography', 'edubin-core'),
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                    'selector' => '{{WRAPPER}} .edubin-section-5 .hero-content .hero-skill-wrap .hero-feature-item .feature-txt p',
                ]
            );
            $this->add_control(
                'feature_txt_color',
                [
                    'label'     => __('Feature Text Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-section-5 .hero-content .hero-skill-wrap .hero-feature-item .feature-txt p' => 'color: {{VALUE}};',
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
                    'selector' => '{{WRAPPER}} .edubin-section-5 a.here-btn',
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
                        '{{WRAPPER}} .edubin-section-5 a.here-btn' => 'color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'background_color',
                [
                    'label'     => __('Background Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-section-5 a.here-btn' => 'background-color: {{VALUE}};',
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
                        '{{WRAPPER}} .edubin-section-5 a.here-btn' => 'border-color: {{VALUE}};',
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
                        '{{WRAPPER}} .edubin-section-5 a.here-btn:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_control(
                'button_background_hover_color',
                [
                    'label'     => __('Background Color', 'edubin-core'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-section-5 a.here-btn:hover' => 'background-color: {{VALUE}};',
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
                        '{{WRAPPER}} .edubin-section-5 a.here-btn:hover' => 'border-color: {{VALUE}};',
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
                    'selector'    => '{{WRAPPER}} .edubin-section-5 a.here-btn',
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
                        '{{WRAPPER}} .edubin-section-5 a.here-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .edubin-section-5 a.here-btn',
                ]
            );
    
            $this->add_responsive_control(
                'text_padding',
                [
                    'label'      => __('Padding', 'edubin-core'),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .edubin-section-5 a.here-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'  => 'before',
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
                'selector' => '{{WRAPPER}} .edubin-section-5',
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
                    '{{WRAPPER}} .edubin-section-5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-5' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-5 .hero-content' => 'padding-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-5 .hero-images' => 'padding-top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-5 .hero-images .img-man' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-5 .hero-images .img-man' => 'left: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .edubin-section-5 .hero-images .img-man' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
    
        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

    ?>

     <!-- Hero Start -->
        <div class="edubin-section-5">
            <?php if ($settings['bottom_shape_wave']): ?>
                <div class="shape-1">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'bottom_shape_wave'); ?>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="edubin-col-lg-6 p-xl-0 px-4">
                        <!-- Hero Content Start -->
                        <div class="hero-content">
                            <?php if ($settings['sub_heading']): ?>
                                <p class="sub-title" data-sal="slide-up" data-sal-delay="100" data-sal-duration="1000"data-sal-easing="easeOutCubic"><?php echo $settings['sub_heading']; ?></p>
                            <?php endif; ?>
                            <?php if ($settings['heading']): ?>
                                <h2 class="title" data-sal="slide-up" data-sal-delay="300" data-sal-duration="1000"data-sal-easing="easeOutCubic"><?php echo $settings['heading']; ?></h2>
                            <?php endif ?>
                            <?php if ($settings['show_button']): ?>
                                <a class="here-btn edubin-btn edubin-btn-2" data-sal="slide-up" data-sal-delay="500" data-sal-duration="1000"data-sal-easing="easeOutCubic" <?php echo ($settings['button_link']["is_external"] == 'on') ? 'target="_blank"' : '' ; ?> href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo $settings['button_text']; ?></a>
                            <?php endif; ?>
                            
                            <div class="hero-skill-wrap" data-aos="fade-up" data-aos-delay="800">
                                <div class="row">
                                    <div class="edubin-col-sm-6 edubin-col-10 p-0">
                                        <div class="hero-feature-item">
                                            <div class="feature-img">
                                                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'feature_img_1'); ?>
                                            </div>
                                            <div class="feature-txt">
                                                <p><?php echo $settings['features_txt_1']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edubin-col-sm-6 edubin-col-10 p-0">
                                        <div class="hero-feature-item">
                                            <div class="feature-img">
                                                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'feature_img_2'); ?>
                                            </div>
                                            <div class="feature-txt">
                                                <p><?php echo $settings['features_txt_2']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hero Content End -->
                    </div>
                    <div class="edubin-col-lg-6">
                        <!-- Hero Image Start -->
                        <div class="hero-images">
                            
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


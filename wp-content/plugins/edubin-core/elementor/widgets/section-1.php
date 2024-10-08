<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Section_1 extends Widget_Base {

    public function get_name()
    {
        return 'edubin-section-1-addons';
    }

    public function get_title()
    {
        return __('Section 1', 'edubin-core');
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
        return ['section 1', 'section', 'image', 'addons'];
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
    
        $this->end_controls_section();
    
    // Styles section
        $this->start_controls_section(
            'section_1_style',
            [
                'label' => __( 'Styles', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'top_shape_colors',
            [
                'label'     => __('Top Shape Color', 'edubin-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ff1949',
            ]
        );
    
    
        $this->add_responsive_control(
            'section_weight',
            [
                'label' => __( 'Section Width', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1140,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-addon-1' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'section_height',
            [
                'label' => __( 'Section Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 360,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-addon-1' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'image_1_height',
            [
                'label' => __( 'Image 1 Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-addon-1 .front-image-1 img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_1_width',
            [
                'label' => __( 'Image 1 Width', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-addon-1 .front-image-1 img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_2_height',
            [
                'label' => __( 'Image 2 Height', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-addon-1 .front-image-2 img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_2_width',
            [
                'label' => __( 'Image 2 Width', 'edubin-core' ),
                'description' => __('Keep blank value for the default', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-section-addon-1 .front-image-2 img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        $svg_color = esc_attr__($settings['top_shape_colors']);
        $svg_fill = ($settings['top_shape_colors']) ? ('fill="'.$svg_color.'"') : ('fill='.'"'.esc_attr('#000') .'"');
        $svg = '<svg 
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="263px" height="206px">
                    <path fill-rule="evenodd" '.$svg_fill.' d="M263.000,-0.001 L-0.000,-0.001 L-0.000,205.999 L263.000,-0.001 Z"/>
                </svg>';


        echo '<div class="edubin-section-addon-1">';
            echo $svg;
            if ($settings['image_1']){
                echo '<div class="front-image-1">';
                    echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_1_size_size', 'image_1');
                echo '</div>';
            };
            if ($settings['image_2']){
                echo '<div class="front-image-2">';
                    echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image_2_size_size', 'image_2');
                echo '</div>';
            };
        echo '</div>';
   

    }

}


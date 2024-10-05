<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Text_Stroke;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Programs extends Widget_Base {

    public function get_name() {
        return 'edubin-programs';
    }
    
    public function get_title() {
        return __( 'Programs', 'edubin-core' );
    }
    public function get_keywords() {
        return [ 'Programs', 'categories', 'course categories' , 'course program' ];
    }
    public function get_icon() {
        return 'edubin-elementor-icon eicon-table-of-contents';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }
    
    public function get_help_url() {
        return 'https://thepixelcurve.com/docs/general-widgets/call-to-action-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'edubin-core' ),
            ]
        );
        // $this->add_control(
        //     'layout_style',
        //     [
        //         'label' => __( 'Style', 'edubin-core' ),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => '1',
        //         'options' => [
        //             '1' => esc_html__('Style 1', 'edubin-core'),
        //             '2' => esc_html__('Style 2', 'edubin-core'),
        //         ],
        //     ]
        // );
        
        $this->add_control(
            'title',
            [
                'label'   => __( 'Title', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => __('Technology','edubin-core'),
                'default' => 'Fitness',
            ]
        );

       
        $this->add_control(
            'description',
            [
                'label'   => __( 'Description', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => __('Description','edubin-core'),
                'default' => 'The first thing to remember about success is that it is a process only for a select few people.',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'techmax-core' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'edubin-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'align',
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1' => 'text-align: {{VALUE}};',
                ],
                
            ]
        );
  
        $this->add_control(
			'title_bottom_line',
			[
				'label' => esc_html__( 'Title Bottom Line', 'edubin-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'edubin-core' ),
				'label_off' => esc_html__( 'Off', 'edubin-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_responsive_control(
            'line_width',
            [
                'label' => __( 'Width', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title.bottom-line::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title_bottom_line' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_position',
            [
                'label' => __( 'Line Position Y', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title.bottom-line::after' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title_bottom_line' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        // Styles Start

        $this->start_controls_section(
            'section_background',
            [
                'label' => __( 'Background', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'background_image',
			[
				'label' => esc_html__( 'Background Image', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
			]
		);
       
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_image',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .edubin-programs.style-1',
                
			]
		);

        $this->add_control(
			'bg_overlay',
			[
				'label' => esc_html__( 'Background Overlay', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .edubin-programs.style-1::after',
                
			]
		);

        $this->add_control(
			'bg_overlay_hover',
			[
				'label' => esc_html__( 'Background Overlay Hover', 'edubin-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay_hover',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .edubin-programs.style-1::before',
                
			]
		);
       

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
                [
                    'label' => __( 'Content', 'edubin-core' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

        $this->add_control(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_bottom_line_color',
            [
                'label' => __( 'Title Bottom Line Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title.bottom-line::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => __( 'Title Bottom Space', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title',
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Title Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title',
            ]
        );

        $this->add_control(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Title Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'default'=>'',
                'selectors' => [
                    '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __( 'Description Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .edubin-programs.style-1 .programs-wrapper .program-title',
            ]
        );

        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

         // if item has link
         $teacher_link_url = $settings['link']['url'];
         $is_external = ($settings['link']['is_external']) ? ('target="_blank"'): ('');
         $is_nofollow = ($settings['link']['nofollow']) ? ('rel="nofollow"'): ('');
         $link_tag = ($settings['link']['url']) ? ('<a href="'.esc_url($teacher_link_url).'" '.$is_external.' '.$is_nofollow.'>'): ('');
         $link_end_tag = ($settings['link']['url']) ? ('</a>'): ('');

         // Bottom Line On/Off
         $bottom_line = ($settings['title_bottom_line']) ? ('bottom-line') : ('');
    
        // if($settings['layout_style'] == '1'){
            echo '<div class="edubin-programs style-1">';
                echo $link_tag;
                    echo '<div class="programs-wrapper">';
                        echo ($settings['title']) ? ('<h2 class="program-title '.$bottom_line.'">'.$settings['title'].'</h2>'):('');
                        echo ($settings['description']) ? ('<p class="program-description">'.$settings['description'].'</p>'):('');
                    echo '</div>';
                echo $link_end_tag;
            echo '</div>';
        // }

        
    }

}


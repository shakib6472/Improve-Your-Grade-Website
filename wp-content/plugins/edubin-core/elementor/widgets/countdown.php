<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Elementor_Widget_Countdown extends Widget_Base {

    public function get_name() {
        return 'edubin-countdown';
    }
    
    public function get_title() {
        return __( 'Countdown', 'edubin-addons' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-countdown';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }
    public function get_keywords() {
        return [ 'countdown', 'edubin countdown', 'coundown', 'timer', 'count' ];
    }
    
    public function get_script_depends() {
        return [ 'edubin-active' ];
    }

    public function get_help_url() {
        return 'https://thepixelcurve.com/docs/general-widgets/call-to-action-widget/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'ctw_section',
            [
                'label' => __( 'Countdown', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'ctw_due_date',
            [
                'label' => __( 'Due Date', 'edubin-core' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
                'description' => sprintf( __( 'Date set according to your timezone: %s.', 'edubin-core' ), Utils::get_timezone_string() ),
                
            ]
        );
        $this->add_control(
            'ctw_show_days',
            [
                'label' => __( 'Days', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'edubin-core' ),
                'label_off' => __( 'Hide', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'ctw_show_hours',
            [
                'label' => __( 'Hours', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'edubin-core' ),
                'label_off' => __( 'Hide', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ctw_show_days' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ctw_show_minutes',
            [
                'label' => __( 'Minutes', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'edubin-core' ),
                'label_off' => __( 'Hide', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ctw_show_days' => 'yes',
                    'ctw_show_hours' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ctw_show_seconds',
            [
                'label' => __( 'Seconds', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'edubin-core' ),
                'label_off' => __( 'Hide', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ctw_show_days' => 'yes',
                    'ctw_show_hours' => 'yes',
                    'ctw_show_minutes' => 'yes',
                ],
            ]
        );
        $this->end_controls_section(); 
        
        $this->start_controls_section(
            'ctw_expire_section',
            [
                'label' => __( 'Countdown Expire' , 'edubin-core' )
            ]
        );
        
        $this->add_control(
            'ctw_expire_message',
            [
                'label'         => __('Expire Message', 'edubin-core'),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => __('Sorry you are late!','edubin-core'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ctw_label_text_section',
            [
                'label' => __( 'Change Labels Text' , 'edubin-core' )
            ]
        );
        $this->add_control(
            'ctw_change_labels',
            [
                'label' => __( 'Change Labels', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'edubin-core' ),
                'label_off' => __( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'ctw_label_days',
            [
                'label' => __( 'Days', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Days', 'edubin-core' ),
                'placeholder' => __( 'Days', 'edubin-core' ),
                'condition' => [
                    'ctw_change_labels' => 'yes',
                    'ctw_show_days' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ctw_label_hours',
            [
                'label' => __( 'Hours', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Hours', 'edubin-core' ),
                'placeholder' => __( 'Hours', 'edubin-core' ),
                'condition' => [
                    'ctw_change_labels' => 'yes',
                    'ctw_show_hours' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ctw_label_minuts',
            [
                'label' => __( 'Minutes', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Minutes', 'edubin-core' ),
                'placeholder' => __( 'Minutes', 'edubin-core' ),
                'condition' => [
                    'ctw_change_labels' => 'yes',
                    'ctw_show_minutes' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ctw_label_seconds',
            [
                'label' => __( 'Seconds', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Seconds', 'edubin-core' ),
                'placeholder' => __( 'Seconds', 'edubin-core' ),
                'condition' => [
                    'ctw_change_labels' => 'yes',
                    'ctw_show_seconds' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(   
            'ctw_style_section',
            [
                'label' => __( 'Box', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'ctw_box_align',
                [
                    'label'         => esc_html__( 'Alignment', 'edubin-core' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> esc_html__( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                            ],
                        'center'    => [
                            'title'=> esc_html__( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                            ],
                        'right'     => [
                            'title'=> esc_html__( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                            ],
                        ],
                    'toggle'        => false,
                    'default'       => 'center',
                    'selectors'     => [
                        '{{WRAPPER}} .edubin-countdown-timer-widget' => 'text-align: {{VALUE}};',
                        ],
                ]
        );
        $this->add_control(
            'ctw_box_background_color',
            [
                'label' => __( 'Background Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown-items' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'ctw_box_size',
            [
                'label' => __( 'Size', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-countdown-timer-widget .countdown-items' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ctw_box_spacing',
            [
                'label' => __( 'Box Gap', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .countdown-items:not(:first-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
                    'body:not(.rtl) {{WRAPPER}} .countdown-items:not(:last-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
                    'body.rtl {{WRAPPER}} .countdown-items:not(:first-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
                    'body.rtl {{WRAPPER}} .countdown-items:not(:last-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
                ],
            ]
        );        

        $this->add_responsive_control(
            'ctw_digit_spacing',
            [
                'label' => __( 'Digit Gap', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown-items .ctw-digits' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ctw_label_spacing',
            [
                'label' => __( 'Label Gap', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown-items .ctw-digits' => 'height: calc( {{SIZE}}{{UNIT}}/2 );',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .countdown-items',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ctw_box_border_radius',
            [
                'label' => __( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .countdown-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'ctw_digits_style_section',
            [
                'label' => __( 'Digits', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ctw_digit_background_color',
            [
                'label' => __( 'Background Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown-items .ctw-digits' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'ctw_digits_color',
            [
                'label' => __( 'Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ctw-digits' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ctw_digits_typography',
                'selector' => '{{WRAPPER}} .ctw-digits',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->end_controls_section();   
        
        $this->start_controls_section(
            'ctw_labels_style_section',
            [
                'label' => __( 'Labels', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ctw_label_background_color',
            [
                'label' => __( 'Background Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ctw-label' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'ctw_label_color',
            [
                'label' => __( 'Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ctw-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ctw_label_typography',
                'selector' => '{{WRAPPER}} .ctw-label',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->end_controls_section();   
        
        $this->start_controls_section(
            'ctw_finish_message_style_section',
            [
                'label' => __( 'Message', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ctw_message_color',
            [
                'label' => __( 'Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .finished-message' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ctw_message_typography',
                'selector' => '{{WRAPPER}} .finished-message',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->end_controls_section(); 

    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings();

        $countdown_id       = $this->get_id();
        $data_id = [
            'countdown_id' => $countdown_id,
            'countdown_date' => $settings['ctw_due_date'],
        ];
        $data_id = array_merge( $data_id );
        $this->add_render_attribute( 'item', 'class', 'edubin-countdown-timer-widget');
        // Js data pass
        $this->add_render_attribute( 'item', 'data-settings', wp_json_encode( $data_id ) );

        $this->add_render_attribute(
            'item',
            [
                'data-date' => $settings['ctw_due_date'],
            ]
        );
        $this->add_render_attribute( 'item', 'class', 'edubin-countdown-timer-widget');
        
        $day = $settings['ctw_show_days'];
        $hours = $settings['ctw_show_hours'];
        $minute = $settings['ctw_show_minutes'];
        $seconds = $settings['ctw_show_seconds'];
        $end_text = $settings['ctw_expire_message'];

        $render_days = '<div class="countdown-items"> <span id="days'.$countdown_id.'" class="ctw-digits"></span><span class="ctw-label ctw-label'.$countdown_id.'">'.$settings['ctw_label_days'].'</span></div>'; 
        $render_hours = '<div class="countdown-items"> <span id="hours'.$countdown_id.'" class="ctw-digits"></span><span class="ctw-label ctw-label'.$countdown_id.'">'.$settings['ctw_label_hours'].'</span></div>'; 
        $render_minute = '<div class="countdown-items"> <span id="minutes'.$countdown_id.'" class="ctw-digits"></span><span class="ctw-label ctw-label'.$countdown_id.'">'.$settings['ctw_label_minuts'].'</span></div>'; 
        $render_seconds = '<div class="countdown-items"> <span id="seconds'.$countdown_id.'" class="ctw-digits"></span><span class="ctw-label ctw-label'.$countdown_id.'">'.$settings['ctw_label_seconds'].'</span></div>'; 
        $render_lebel = '<div class="finished-message" style="display:none;" id="ctw-label'.$countdown_id.'">'.$end_text.'</div>'; 

        echo '<div ' . $this->get_render_attribute_string( 'item' ) . '>';
            echo '<div id="countdown'.$countdown_id.'">';
                if ($day == 'yes'){
                    echo ($day == "yes") ? ($render_days) : ('');
                    echo ($hours == "yes" && $day == "yes") ? ($render_hours) : ('');
                    echo ($minute == "yes" && $day == "yes" && $hours == "yes") ? ($render_minute) : ('');
                    echo ($seconds == "yes" && $minute == "yes"&& $day == "yes" && $hours == "yes") ? ($render_seconds) : ('');
                    
                }else{
                    echo '<h5>You need to turn on date at least</h5>';
                };
            echo '</div>';
                echo $render_lebel;
        echo '</div>';
 

    }


}


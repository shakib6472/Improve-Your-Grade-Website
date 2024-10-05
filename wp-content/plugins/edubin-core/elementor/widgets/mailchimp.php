<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Mail_Chimp extends Widget_Base {

    public function get_name()
    {
        return 'edubin-mail-chimp';
    }

    public function get_title()
    {
        return esc_html__('Mailchimp', 'edubin-core');
    }
    public function get_keywords()
    {
        return ['mailchimp','subscribe','subscriber', 'mail', 'marketing', 'contact', 'mail chimp', 'form', 'email'];
    }
    public function get_icon()
    {
        return 'edubin-elementor-icon eicon-mailchimp';
    }
    public function get_categories() {
        return [ 'edubin-core' ];
    }   
    public function edubin_mail_chimp_form()
    {
        $countactform      = array();
        $edubin_forms_args = array('posts_per_page' => -1, 'post_type' => 'mc4wp-form');
        $htmega_forms      = get_posts($edubin_forms_args);
        if ($htmega_forms) {
            foreach ($htmega_forms as $htmega_form) {
                $countactform[$htmega_form->ID] = $htmega_form->post_title;
            }
        } else {
            $countactform[esc_html__('Mailchimp form not selected', 'edubin-core')] = 0;
        }
        return $countactform;
    }
    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'edubin_mail_chimp_form_list',
            [
                'label'   => __('Search Form', 'edubin-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->edubin_mail_chimp_form(),
            ]
        );
        $this->end_controls_section();

        // Input Style
        $this->start_controls_section(
            'section_style_input',
            [
                'label' => __( 'Input', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'form_width',
            [
                'label'  => __( 'Width', 'edubin-core' ),
                'type'   => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input[type=email]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        $this->add_responsive_control(
            'form_height',
            [
                'label'  => __( 'Height', 'edubin-core' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 42,
                        'max' => 120,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input[type=email], .edubin-mailchimp-form-wrap .btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'input_typography',
                'label'    => __( 'Input Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .edubin-mailchimp-form-wrap input',
            ]
        );

        $this->add_control(
            'input_placholder_color',
            [
                'label'     => __( 'Placeholder', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        //Input Normal Focus tabs
        $this->start_controls_tabs('input_tabs_style');

        $this->start_controls_tab(
            'input_style_normal',
            [
                'label' => __('Normal', 'edubin-core'),
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => __( 'Input Text', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color',
            [
                'label'     => __( 'Input Border', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label'     => __( 'Input Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input' => 'background-color: {{VALUE}};',
                ],
            ]
        );
                
        $this->end_controls_tab();

        $this->start_controls_tab(
            'input_style_focus',
            [
                'label' => __('Focus', 'edubin-core'),
            ]
        );

        $this->add_control(
            'input_color_focus',
            [
                'label'     => __( 'Input Text', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label'     => __( 'Input Border', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color_focus',
            [
                'label'     => __( 'Input Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Submit Button Style
        $this->start_controls_section(
            'section_style_submit',
            [
                'label' => __( 'Submit', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'form_submit_width',
            [
                'label'  => __( 'Submit Button Width', 'edubin-core' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'froms_button_border_radious',
            [
                'label'     => esc_html__('Border Radius', 'edubin-core'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submit_typography',
                'label'    => __( 'Submit Typography', 'edubin-core' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn',
            ]
        );

        //Normal Hover Active tabs
        $this->start_controls_tabs('submit_tabs_style');

        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __('Normal', 'edubin-core'),
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label'     => __( 'Submit Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_color',
            [
                'label'     => __( 'Submit Border Normal', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label'     => __( 'Submit Text', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn' => 'color: {{VALUE}};',

                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover',
            [
                'label' => __('Hover', 'edubin-core'),
            ]
        );

        $this->add_control(
            'btn_bg_hover_color',
            [
                'label'     => __( 'Submit Background Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'btn_border_color_hover',
            [
                'label'     => __( 'Submit Border Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_hover_color',
            [
                'label'     => __( 'Submit Text Hover', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn:hover' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_active',
            [
                'label' => __('Active', 'edubin-core'),
            ]
        );

        $this->add_control(
            'btn_bg_active_color',
            [
                'label'     => __( 'Submit Background Active', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn:active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_color_active',
            [
                'label'     => __( 'Submit Border Active', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn:active' => 'border-color: {{VALUE}};',
                ],
            ]
        );   

        $this->add_control(
            'btn_text_active_color',
            [
                'label'     => __( 'Submit Text Active', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-mailchimp-form-wrap .btn:active' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



    } // End options

    protected function render( $instance = [] ) {
        
        $settings = $this->get_settings();
        ?>

            <?php
                if (!empty($settings['edubin_mail_chimp_form_list'])) {
                    echo do_shortcode('[mc4wp_form  id="' . $settings['edubin_mail_chimp_form_list'] . '"]');
                } else {
                    echo '<div class="form_no_select">' . __('Mailchimp form not selected', 'edubin-core') . '</div>';
                }
            ?>

        <?php

    }

}


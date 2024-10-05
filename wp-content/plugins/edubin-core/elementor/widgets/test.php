<?php
namespace EdubinCore\Widgets;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use ElementorPro\Modules\Woocommerce\Module;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Test extends Widget_Base {


    public function get_name() {
        return 'edubin-test-widget';
    }

    public function get_title() {
        return __( 'Testing Widget', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-posts-masonry';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'edubin-widgets-scripts',
        ];
    }

    protected function register_controls() {

        $this->register_general_content_controls();
        $this->register_cart_typo_content_controls();
    }

    /**
     * Register Menu Cart General Controls.
     *
     * @since 1.4.0
     * @access protected
     */
    protected function register_general_content_controls() {

        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Menu Cart', 'header-footer-elementor' ),
            ]
        );

        $this->add_control(
            'hfe_cart_type',
            [
                'label'   => __( 'Type', 'header-footer-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'header-footer-elementor' ),
                    'custom'  => __( 'Custom', 'header-footer-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'        => __( 'Icon', 'header-footer-elementor' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'bag-light'  => __( 'Bag Light', 'header-footer-elementor' ),
                    'bag-medium' => __( 'Bag Medium', 'header-footer-elementor' ),
                    'bag-solid'  => __( 'Bag Solid', 'header-footer-elementor' ),
                ],
                'default'      => 'bag-light',
                'prefix_class' => 'toggle-icon--',
                'condition'    => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'items_indicator',
            [
                'label'        => __( 'Items Count', 'header-footer-elementor' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'none'   => __( 'None', 'header-footer-elementor' ),
                    'bubble' => __( 'Bubble', 'header-footer-elementor' ),
                ],
                'prefix_class' => 'hfe-menu-cart--items-indicator-',
                'default'      => 'bubble',
                'condition'    => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'show_subtotal',
            [
                'label'        => __( 'Show Total Price', 'header-footer-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'header-footer-elementor' ),
                'label_off'    => __( 'No', 'header-footer-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'prefix_class' => 'hfe-menu-cart--show-subtotal-',
                'condition'    => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'hide_empty_indicator',
            [
                'label'        => __( 'Hide Empty', 'header-footer-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'header-footer-elementor' ),
                'label_off'    => __( 'No', 'header-footer-elementor' ),
                'return_value' => 'hide',
                'prefix_class' => 'hfe-menu-cart--empty-indicator-',
                'description'  => __( 'This will hide the items count until the cart is empty', 'header-footer-elementor' ),
                'condition'    => [
                    'items_indicator!' => 'none',
                    'hfe_cart_type'    => 'custom',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'              => __( 'Alignment', 'header-footer-elementor' ),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'left'   => [
                        'title' => __( 'Left', 'header-footer-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'header-footer-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'header-footer-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'frontend_available' => true,
                'prefix_class'       => 'elementor%s-align-',
                'default'            => '',
            ]
        );

        $this->end_controls_section();
    }


    /**
     * Register Menu Cart Typography Controls.
     *
     * @since 1.4.0
     * @access protected
     */
    protected function register_cart_typo_content_controls() {
        $this->start_controls_section(
            'section_heading_typography',
            [
                'label' => __( 'Menu Cart', 'header-footer-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'toggle_button_typography',
                'global'    => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector'  => '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button',
                'condition' => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label'     => __( 'Size', 'header-footer-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 15,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-masthead-custom-menu-items .hfe-site-header-cart .hfe-site-header-cart-li ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'hfe_cart_type' => 'default',
                ],
            ]
        );
        $this->add_control(
            'toggle_button_border_width',
            [
                'label'      => __( 'Border Width', 'header-footer-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button,{{WRAPPER}} .hfe-cart-menu-wrap-default .hfe-cart-count:after, {{WRAPPER}} .hfe-cart-menu-wrap-default .hfe-cart-count' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_border_radius',
            [
                'label'      => __( 'Border Radius', 'header-footer-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => '',
                    'bottom' => '',
                    'left'   => '',
                    'right'  => '',
                    'unit'   => 'px',
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button,{{WRAPPER}} .hfe-cart-menu-wrap-default .hfe-cart-count:after, {{WRAPPER}} .hfe-cart-menu-wrap-default .hfe-cart-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'toggle_button_padding',
            [
                'label'              => __( 'Padding', 'header-footer-elementor' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', 'em' ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'          => [
                    'hfe_cart_type' => 'custom',
                ],
                'frontend_available' => true,
            ]
        );

        $this->start_controls_tabs( 'toggle_button_colors' );

        $this->start_controls_tab(
            'toggle_button_normal_colors',
            [
                'label' => __( 'Normal', 'header-footer-elementor' ),
            ]
        );

        $this->add_control(
            'toggle_button_text_color',
            [
                'label'     => __( 'Text Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button,{{WRAPPER}} .hfe-cart-menu-wrap-default span.hfe-cart-count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_icon_color',
            [
                'label'     => __( 'Icon Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_background_color',
            [
                'label'     => __( 'Background Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button,{{WRAPPER}} .hfe-cart-menu-wrap-default span.hfe-cart-count' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_border_color',
            [
                'label'     => __( 'Border Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button,{{WRAPPER}} .hfe-cart-menu-wrap-default .hfe-cart-count:after, {{WRAPPER}} .hfe-masthead-custom-menu-items .hfe-cart-menu-wrap-default .hfe-cart-count' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'toggle_button_hover_colors',
            [
                'label' => __( 'Hover', 'header-footer-elementor' ),
            ]
        );

        $this->add_control(
            'toggle_button_hover_text_color',
            [
                'label'     => __( 'Text Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button:hover,{{WRAPPER}} .hfe-cart-menu-wrap-default span.hfe-cart-count:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_hover_icon_color',
            [
                'label'     => __( 'Icon Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button:hover .elementor-button-icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_hover_background_color',
            [
                'label'     => __( 'Background Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button:hover,{{WRAPPER}} .hfe-cart-menu-wrap-default span.hfe-cart-count:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_button_hover_border_color',
            [
                'label'     => __( 'Border Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button:hover,{{WRAPPER}} .hfe-cart-menu-wrap-default:hover .hfe-cart-count:after, {{WRAPPER}} .hfe-cart-menu-wrap-default:hover .hfe-cart-count' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            'toggle_icon_size',
            [
                'label'      => __( 'Icon Size', 'header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => [ 'px', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'hfe_cart_type' => 'custom',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_control(
            'toggle_icon_spacing',
            [
                'label'      => __( 'Icon Spacing', 'header-footer-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size-units' => [ 'px', 'em' ],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-text' => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-text' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'hfe_cart_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label'     => __( 'Items Count', 'header-footer-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon[value]!'     => '',
                    'items_indicator!' => 'none',
                    'hfe_cart_type'    => 'custom',
                ],
            ]
        );

        $this->add_control(
            'items_indicator_distance',
            [
                'label'     => __( 'Distance', 'header-footer-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'em',
                ],
                'range'     => [
                    'em' => [
                        'min'  => 0,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-icon[data-counter]:before' => 'right: -{{SIZE}}{{UNIT}}; top: -{{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'items_indicator' => 'bubble',
                ],
            ]
        );

        $this->start_controls_tabs( 'count_colors' );

        $this->start_controls_tab(
            'count_normal_colors',
            [
                'label' => __( 'Normal', 'header-footer-elementor' ),
            ]
        );

        $this->add_control(
            'items_indicator_text_color',
            [
                'label'     => __( 'Text Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-icon[data-counter]:before' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'items_indicator!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'items_indicator_background_color',
            [
                'label'     => __( 'Background Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button-icon[data-counter]:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'items_indicator' => 'bubble',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'count_hover_colors',
            [
                'label' => __( 'Hover', 'header-footer-elementor' ),
            ]
        );

        $this->add_control(
            'items_indicator_text_hover_color',
            [
                'label'     => __( 'Text Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle:hover .elementor-button-icon[data-counter]:before' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'items_indicator!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'items_indicator_background_hover_color',
            [
                'label'     => __( 'Background Color', 'header-footer-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-menu-cart__toggle:hover .elementor-button-icon[data-counter]:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'items_indicator' => 'bubble',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Menu Cart output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.4.0
     * @access protected
     */
    protected function render() {

            echo '<div class="edubin-woo-mini-cart-wrapper woocommerce">';
                echo '<div class="edubin-woo-mini-cart-inner">';
                    echo '<div class="edubin-woo-mini-cart-icon-wrapper edubin-woo-mini-cart-active-on-hover">';
                        echo '<a class="edubin-woo-mini-cart-link edubin-woo-mini-cart-visible-on-hover" href="' . esc_url( wc_get_cart_url() ) .'" target="_self">';
                            echo '<i aria-hidden="true" class="icon-3"></i>';
                        echo '</a>';

                        echo '<span class="edubin-woo-mini-cart-total-item">';
                            echo WC()->cart->get_cart_contents_count();
                        echo '</span>';
                        
                        echo '<div class="edubin-woo-mini-cart-content">';
                            echo '<div class="widget_shopping_cart_content">';
                                woocommerce_mini_cart();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            
    }

    /**
     * Render Menu Cart output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.4.0
     * @access protected
     */
    protected function content_template() {
    }
    }
<?php

namespace EdubinCore\HF\Widgets;

use \Edubin\Navwalker\Edubin_NavWalker;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Plugin;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Menu_List extends Widget_Base {
    protected $nav_menu_index = 1;

	public function get_name() {
		return 'edubin-menu-list';
	}

	public function get_title() {
		return __( 'Menu List', 'edubin-core' );
	}

    public function get_icon() {
        return 'edubin-elementor-icon eicon-nav-menu';
    }

	public function get_keywords() {
		return [ 'edubin', 'menu', 'nav', 'navigation' ];
	}

	public function get_categories() {
		return [ 'edubin-core-hf' ];
	}
    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }
    private function get_available_menus() {

        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) :
            $options[ $menu->slug ] = $menu->name;
        endforeach;
        return $options;
    }

    // =========== Register Controls ===========
	protected function register_controls() {
        
        $this->start_controls_section(
            'section_menu_list',
            [
                'label' => __( 'Menu List', 'edubin-core' )
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) :
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'edubin-core' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'edubin-core' ), admin_url( 'nav-menus.php' ) )
                ]
            );
        else :
            $this->add_control(
                'menu_alert',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'edubin-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info'
                ]
            );
        endif;

        $this->add_responsive_control(
            'alignment',
            [
                'label'             => __( 'Alignment', 'edubin-core' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'flex-start'    => [
                        'title'     => __( 'Left', 'edubin-core' ),
                        'icon'      => 'eicon-h-align-left'
                    ],
                    'center'        => [
                        'title'     => __( 'Center', 'edubin-core' ),
                        'icon'      => 'eicon-h-align-center'
                    ],
                    'flex-end'      => [
                        'title'     => __( 'Right', 'edubin-core' ),
                        'icon'      => 'eicon-h-align-right'
                    ],
                    'space-between' => [
                        'title'     => __( 'Justify', 'edubin-core' ),
                        'icon'      => 'eicon-h-align-stretch'
                    ]
                ],
                'selectors'         => [
                    '{{WRAPPER}} nav.edubin-el-menu-list' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu_style',
            [
                'label' => __( 'Nav Menu', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color',
            [
                'label'      => __( 'Color', 'edubin-core' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .edubin-el-single-depth-menu li a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'      => __( 'Hover Color', 'edubin-core' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .edubin-el-single-depth-menu li a:hover' => 'color: {{VALUE}}  !important;'
                ]
            ]
        );

        $this->add_responsive_control(
            'inner_spacing',
            [
                'label'        => __( 'Inner Spacing', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-el-single-depth-menu li:not(:last-child) a' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .edubin-el-single-depth-menu li a'
            ]
        );

        $this->end_controls_section();
    }
    
    // =========== Render ===========
    protected function render() {
        $settings = $this->get_settings_for_display();
        $args = [
            'echo'        => false,
            'depth'       => 1,
            'menu'        => $settings['menu'],
            'menu_class'  => 'edubin-nav-dropdown-menu',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container'   => ''
        ];

        $menu_html = wp_nav_menu( $args );

        $this->add_render_attribute( 'wrapper', 'class', 'edubin-el-single-depth-menu' );

        $this->add_render_attribute( 'menu', 'class', 'edubin-el-menu-list' );

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo '<nav ' . $this->get_render_attribute_string( 'menu' ) . '>';
                echo trim( $menu_html );
            echo '</nav>';
        echo '</div>';
    }
}
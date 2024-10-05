<?php

namespace EdubinCore\HF\Widgets;

use \Edubin\Navwalker\Edubin_NavWalker;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Plugin;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Nav_Menu extends Widget_Base {

    protected $nav_menu_index = 1;

	public function get_name() {
		return 'edubin-header-menu';
	}

	public function get_title() {
		return __( 'Nav Menu', 'edubin-core' );
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
            'section_nav_menu',
            [
                'label' => __( 'Nav Menu', 'edubin-core' )
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
                'toggle'            => true,
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
                    '{{WRAPPER}} .edubin-navbar-expand-lg .edubin-navbar-nav' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
			'hover_dash_enable',
			[
				'label' => esc_html__( 'Hover Dash Enable?', 'edubin-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'edubin-core' ),
				'label_off' => esc_html__( 'No', 'edubin-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu_responsive',
            [
                'label' => __( 'Responsive', 'edubin-core' )
            ]
        );

        $this->add_control(
            'breakpoint',
            [
                'label'        => __( 'Breakpoint', 'edubin-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'big-tablet',
                'options'      => [
                    'mobile'   => __( 'Mobile (768px >)', 'edubin-core' ),
                    'tablet'   => __( 'Tablet (992px >)', 'edubin-core' ),
                    'big-tablet' => __( 'Big Tablet (1200px >)', 'edubin-core' ),
                    'none'     => __( 'None', 'edubin-core' )
                ],
                'prefix_class' => 'edubin-nav-menu-breakpoint-'
            ]
        );

        $this->add_control(
            'menu_icon',
            [
                'label'       => __( 'Menu Icon', 'edubin-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'flaticon-menu',
                    'library' => 'edubin'
                ]
            ]
        );

        $this->add_control(
            'close_icon',
            [
                'label'       => __( 'Icon', 'edubin-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'flaticon-cancel',
                    'library' => 'edubin-custom-icons'
                ]
            ]
        );

        $spacing = is_rtl() ? 'left' : 'right';
        $this->add_control(
            'toggle_alignment',
            [
                'label'          => __( 'Toggle Alignment', 'edubin-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start' => [
                        'title'  => __( 'Left', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title'  => __( 'Right', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .edubin-elementor-mobile-hamburger-menu' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> MENU
        /*-----------------------------------------------------------------------------------*/


        $this->start_controls_section(
            'section_menu_position',
            [
                'label' => esc_html__('Sub Menu Position', 'edubin-core'),
            ]
        );
        $this->add_responsive_control(
            'menu_position_x',
            [
                'label' => __( 'Position X', 'edubin-core' ),
                'description' => __('Keep blank for default value', 'edubin-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -900,
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area .main-navigation ul .edubin-mega-menu' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> MENU
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'section_style_menu',
            [
                'label' => esc_html__('Menu', 'edubin-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'items',
                'selector' => '{{WRAPPER}} .main-navigation a',
            ]
        );

        $this->add_responsive_control(
            'menu_items_padding',
            [
                'label' => esc_html__('Items Padding', 'edubin-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li>a.nav-link, .edubin-header-area ul.edubin-navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'tabs_menu'
        );

        $this->start_controls_tab(
            'tab_menu_idle',
            ['label' => esc_html__('Normal' , 'edubin-core')]
        );

        $this->add_control(
            'menu_text_idle',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_icon_idle',
            [
                'label' => esc_html__('Icon Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area ul.edubin-navbar-nav>li.menu-item-has-children>a:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_border',
            [
                'label' => esc_html__('Border Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area .main-navigation ul.edubin-navbar-nav .menu-item-has-children li>a:before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .edubin-header-area .main-navigation ul ul.edubin-dropdown-menu' => 'border-top: 3px solid {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_menu_hover',
            ['label' => esc_html__('Hover' , 'edubin-core')]
        );

        $this->add_control(
            'menu_text_hover',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_icon_hover',
            [
                'label' => esc_html__('Icon Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area ul.edubin-navbar-nav>li.menu-item-has-children>a:hover:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_menu_active',
            ['label' => esc_html__('Active', 'edubin-core')]
        );

        $this->add_control(
            'menu_text_active',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation li.current-menu-item>a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .main-navigation li.current-menu-ancestor>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_icon_active',
            [
                'label' => esc_html__('Icon Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation li.current-menu-item a::before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edubin-header-area ul.edubin-navbar-nav > li.menu-item-has-children.current-menu-ancestor > a::before' => 'color: {{VALUE}}',
                ],
                
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLE -> SUBMENU
        /*-----------------------------------------------------------------------------------*/

        $this->start_controls_section(
            'section_style_submenu',
            [
                'label' => esc_html__('Submenu', 'edubin-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_typo',
                'selector' => '{{WRAPPER}} .main-navigation ul ul a',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'submenu_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .main-navigation ul li ul',
            ]
        );

        $this->start_controls_tabs(
            'tabs_submenu'
        );

        $this->start_controls_tab(
            'tab_submenu_idle',
            ['label' => esc_html__('Normal' , 'edubin-core')]
        );

        $this->add_control(
            'submenu_text_idle',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul ul a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_icon_idle',
            [
                'label' => esc_html__('Icon Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area ul li ul.edubin-dropdown-menu li.menu-item-has-children::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_submenu_hover',
            ['label' => esc_html__('Hover' , 'edubin-core')]
        );

        $this->add_control(
            'submenu_text_hover',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li ul li:hover > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_icon_hover',
            [
                'label' => esc_html__('Icon Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area ul li ul.edubin-dropdown-menu li.menu-item-has-children:hover:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_submenu_active',
            ['label' => esc_html__('Active' , 'edubin-core')]
        );

        $this->add_control(
            'submenu_text_active',
            [
                'label' => esc_html__('Text Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation li ul .current-menu-item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_icon_active',
            [
                'label' => esc_html__('Icon Color', 'edubin-core'),
                'type' => Controls_Manager::COLOR,
                'dynamic' => ['active' => true],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-header-area ul li ul.edubin-dropdown-menu > li.menu-item-has-children.current-menu-item::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submenu_border',
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .main-navigation ul li ul',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_shadow',
                'selector' => '{{WRAPPER}} .main-navigation ul li ul',
            ]
        );

        $this->add_responsive_control(
            'submenu_padding',
            [
                'label' => esc_html__('Padding', 'edubin-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li ul' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                    '{{WRAPPER}} .main-navigation ul li ul a' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // =========== Render ===========
     protected function render() {
        $settings = $this->get_settings_for_display();
        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'edubin-navbar-nav edubin-navbar-right nav-menu edubin-nav-ul-wrapper',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container'   => '',
            'walker'      => new Edubin_NavWalker
        ];

        $menu_html = wp_nav_menu( $args );

        $this->add_render_attribute( 'wrapper', 'class', 'edubin-nav-menu-wrapper edubin-header-area edubin-navbar-expand-lg edubin-elementor-nav-menu-wrapper' );

        $this->add_render_attribute( 'menu', 'class', 'main-navigation edubin-navbar-collapse edubin-elementor-nav' );

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo '<nav ' . $this->get_render_attribute_string( 'menu' ) . '>';
                echo trim( $menu_html );
            echo '</nav>';

            echo '<div class="edubin-default-header-mobile-navbar edubin-mobile-menu">';
                echo '<div class="edubin-elementor-mobile-menu-overlay"></div>';
                echo '<div class="edubin-elementor-mobile-hamburger-menu">';
                    echo '<a href="javascript:void(0);">';
                        Icons_Manager::render_icon( $settings['menu_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</a>';
                echo '</div>';
                echo '<div class="edubin-mobile-menu-nav-wrapper edubin-elementor-mobile-menu-nav-wrapper">';
                    echo '<div class="edubin-elementor-mobile-menu-close">';
                        echo '<a href="javascript:void(0);">';
                            Icons_Manager::render_icon( $settings['close_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '</a>';
                    echo '</div>';
                    wp_nav_menu( array(
                        'menu'       => $settings['menu'],
                        'depth'      => 4,
                        'container'  => 'ul',
                        'walker'     => new \Edubin\Navwalker\Edubin_NavWalker(),
                        'menu_id'    => 'edubin-elementor-mobile-menu-item',
                        'menu_class' => 'edubin-elementor-mobile-menu-item'                     
                    ) );
                echo '</div>';
            echo '</div>';
        echo '</div>';

        if ( Plugin::$instance->editor->is_edit_mode() ) :
            $this->render_editor_script();
        endif;
    }

    private function render_editor_script(){ 
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($) {
                $( '.main-navigation ul > li.mega-menu' ).each( function() {
                    let items       = $(this).find( ' > ul.edubin-dropdown-menu > li' ).length,
                    bodyWidth       = $( 'body' ).outerWidth(),
                    parentLinkWidth = $(this).find( ' > a' ).outerWidth(),
                    parentLinkpos   = $(this).find( ' > a' ).offset().left,
                    width           = items * 250,
                    left            = width / 2 - parentLinkWidth / 2,
                    linkleftWidth   = parentLinkpos + parentLinkWidth / 2,
                    linkRightWidth  = bodyWidth - (parentLinkpos + parentLinkWidth);

                    if (width / 2 > linkleftWidth) {
                        $(this).find( ' > ul.edubin-dropdown-menu' ).css( {
                            width: width + 'px',
                            right: 'inherit',
                            left: '-' + parentLinkpos + 'px'
                        } );
                    } else if (width / 2 > linkRightWidth) {
                        $(this).find( ' > ul.edubin-dropdown-menu' ).css( {
                            width: width + 'px',
                            left: 'inherit',
                            right: '-' + linkRightWidth + 'px'
                        } );
                    } else {
                        $(this).find( ' > ul.edubin-dropdown-menu' ).css( {
                            width: width + 'px',
                            left: '-' + left + 'px'
                        } );
                    }
                } );
            } );
        </script>
        <?php
    }
}
<?php

namespace EdubinCore\HF\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Social_Icons extends Widget_Base {

	public function get_name() {
		return 'edubin-social-icons';
	}

	public function get_title() {
		return __( 'Social Icons', 'edubin-core' );
	}

    public function get_icon() {
        return 'edubin-elementor-icon eicon-social-icons';
    }

	public function get_keywords() {
		return [ 'edubin', 'social', 'icons', 'share', 'link' ];
	}

	public function get_categories() {
		return [ 'edubin-core-hf' ];
	}

    // =========== Register Controls ===========
	protected function register_controls() {

        $this->start_controls_section(
            'section_social_icons',
            [
                'label' => __( 'Social Icons', 'edubin-core' )
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'each_icon_tabs' );

            $repeater->start_controls_tab( 'each_icon_content_tab', [ 'label' => __( 'Content', 'edubin-core' ) ] );

                $repeater->add_control(
                    'social_icons',
                    [
                        'label'         => __( 'Icon', 'edubin-core' ),
                        'type'          => Controls_Manager::ICONS,
                        'default'       => [
                            'value'     => 'fab fa-wordpress',
                            'library'   => 'fa-brands'
                        ],
                        'recommended'   => [
                            'fa-brands' => [
                                'android',
                                'apple',
                                'behance',
                                'bitbucket',
                                'codepen',
                                'delicious',
                                'deviantart',
                                'digg',
                                'dribbble',
                                'facebook',
                                'flickr',
                                'foursquare',
                                'free-code-camp',
                                'github',
                                'gitlab',
                                'globe',
                                'houzz',
                                'instagram',
                                'jsfiddle',
                                'linkedin',
                                'medium',
                                'meetup',
                                'mix',
                                'mixcloud',
                                'odnoklassniki',
                                'pinterest',
                                'product-hunt',
                                'reddit',
                                'shopping-cart',
                                'skype',
                                'slideshare',
                                'snapchat',
                                'soundcloud',
                                'spotify',
                                'stack-overflow',
                                'steam',
                                'telegram',
                                'thumb-tack',
                                'tripadvisor',
                                'tumblr',
                                'twitch',
                                'twitter',
                                'blinkr',
                                'vimeo',
                                'vk',
                                'weibo',
                                'weixin',
                                'whatsapp',
                                'wordpress',
                                'xing',
                                'yelp',
                                'youtube'
                            ],
                            'fa-solid' => [
                                'envelope',
                                'link',
                                'rss'
                            ]
                        ]
                    ]
                );

                $repeater->add_control(
                    'link',
                    [
                        'label'           => __( 'Link', 'edubin-core' ),
                        'type'            => Controls_Manager::URL,
                        'default'         => [
                            'is_external' => 'true'
                        ],
                        'dynamic'         => [
                            'active'      => true
                        ],
                        'placeholder'     => __( 'https://your-link.com', 'edubin-core' )
                    ]
                );

            $repeater->end_controls_tab();

            $repeater->start_controls_tab( 'each_icon_style_tab', [ 'label' => __( 'Style', 'edubin-core' ) ] );

                $repeater->add_control(
                    'each_icon_color',
                    [
                        'label'     => __( 'Color', 'edubin-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item i'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item svg' => 'fill: {{VALUE}};'
                        ]
                    ]
                );

                $repeater->add_control(
                    'each_icon_bg_color',
                    [
                        'label'     => __( 'Background Color', 'edubin-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $repeater->add_control(
                    'each_icon_hover_color',
                    [
                        'label'     => __( 'Hover Color', 'edubin-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item:hover i'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item:hover svg' => 'fill: {{VALUE}};'
                        ]
                    ]
                );

                $repeater->add_control(
                    'each_icon_hover_bg_color',
                    [
                        'label'     => __( 'Hover Background Color', 'edubin-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $repeater->add_responsive_control(
                    'each_icon_padding',
                    [
                        'label'      => __( 'Padding', 'edubin-core' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'selectors'  => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'each_icon_border',
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.edubin-social-icon-each-item'
                    ]
                );

            $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'social_icons_list',
            [
                'label'   => __( 'Social Icons', 'edubin-core' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'social_icons'       => [
                            'value'          => 'fab fa-facebook-f',
                            'library'        => 'fa-brands'
                        ],
                        'each_icon_bg_color' => '#4867AA'
                    ],
                    [
                        'social_icons'       => [
                            'value'          => 'fab fa-twitter',
                            'library'        => 'fa-brands'
                        ],
                        'each_icon_bg_color' => '#50ABF1'
                    ],
                    [
                        'social_icons'       => [
                            'value'          => 'fab fa-instagram',
                            'library'        => 'fa-brands'
                        ],
                        'each_icon_bg_color' => '#435EC8'
                    ],
                    [
                        'social_icons'       => [
                            'value'          => 'fab fa-linkedin-in',
                            'library'        => 'fa-brands'
                        ],
                        'each_icon_bg_color' => '#0074D0'
                    ]
                ],
                'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icons, false, true, false, true ) }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'social_icons_style',
            [
                'label'     => __( 'Icons', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'social_icon_style_tabs' );

            $this->start_controls_tab( 'social_icon_normal', [ 'label' => __( 'Normal', 'edubin-core' ) ] );

            $this->add_control(
                'color',
                [
                    'label'     => __( 'Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-social-icon-each-item i'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-social-icon-each-item svg' => 'fill: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'bg_color',
                [
                    'label'     => __( 'Background Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffc600',
                    'selectors' => [
                        '{{WRAPPER}} .edubin-social-icon-each-item' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'border',
                    'selector' => '{{WRAPPER}} .edubin-social-icon-each-item'
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'social_icon_hover', [ 'label' => __( 'Hover', 'edubin-core' ) ] );

            $this->add_control(
                'hover_color',
                [
                    'label'     => __( 'Hover Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-social-icon-each-item:hover i'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .edubin-social-icon-each-item:hover svg' => 'fill: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'hover_bg_color',
                [
                    'label'     => __( 'Hover Background Color', 'edubin-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .edubin-social-icon-each-item:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'hover_border',
                    'selector' => '{{WRAPPER}} .edubin-social-icon-each-item:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'edubin-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'separator'      => 'before',
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
                    '{{WRAPPER}} .edubin-social-icons-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'size',
            [
                'label'        => __( 'Icon Size', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px'],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 80,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 16
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-social-icon-each-item i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-social-icon-each-item svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $spacing = is_rtl() ? 'left' : 'right';
        $this->add_responsive_control(
            'spacing',
            [
                'label'        => __( 'Spacing', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px'],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-social-icon-each-item' => 'margin-' . $spacing . ': {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-social-icons-wrapper'  => 'margin-bottom: -{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_box_width',
            [
                'label'        => __( 'Icon Box Width', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px'],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} a.edubin-social-icon-each-item' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_box_height',
            [
                'label'        => __( 'Icon Box Height', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px'],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} a.edubin-social-icon-each-item' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_box_line_height',
            [
                'label'        => __( 'Icon Box Line Height', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px'],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} a.edubin-social-icon-each-item' => 'line-height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => __( 'Padding', 'edubin-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .edubin-social-icon-each-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __( 'Border Radius', 'edubin-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .edubin-social-icon-each-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'edubin-core' ),
                'type'  => Controls_Manager::HOVER_ANIMATION
            ]
        );

        $this->end_controls_section();
    }

    // =========== Render ===========
    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( is_array( $settings['social_icons_list'] ) ) :
            echo '<div class="edubin-social-icons-wrapper">';
            foreach ( $settings['social_icons_list'] as $key => $icon ) :
                $link_key = 'link_' . $key;
                $this->add_render_attribute( $link_key, 'class', 'elementor-repeater-item-'. esc_attr( $icon['_id'] ) );
                $this->add_render_attribute( $link_key, 'class', 'edubin-social-icon-each-item' );
                $this->add_render_attribute( $link_key, 'class', 'elementor-animation-' . esc_attr( $settings['hover_animation'] ) );
                if ( $icon['link']['url'] ) :
                    $this->add_render_attribute( $link_key, 'href', esc_url( $icon['link']['url'] ) );
                    if ( $icon['link']['is_external'] ) :
                        $this->add_render_attribute( $link_key, 'target', '_blank' );
                    endif;
                    if ( $icon['link']['nofollow'] ) :
                        $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    endif;
                endif;

                if ( ! empty( $icon['social_icons']['value'] ) ) :
                    echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                        Icons_Manager::render_icon( $icon['social_icons'], [ 'aria-hidden' => 'true' ] );
                    echo '</a>';
                endif;
            endforeach; 
            echo '</div>';
        endif;
    }
}
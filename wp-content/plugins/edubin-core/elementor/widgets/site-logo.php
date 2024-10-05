<?php

namespace EdubinCore\HF\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Plugin;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Site_Logo extends Widget_Base {

	public function get_name() {
		return 'edubin-site-logo';
	}

	public function get_title() {
		return __( 'Site Logo', 'edubin-core' );
	}
    public function get_icon() {
        return 'edubin-elementor-icon eicon-site-logo';
    }

	public function get_keywords() {
		return [ 'edubin', 'site', 'logo', 'branding' ];
	}

	public function get_categories() {
		return [ 'edubin-core-hf' ];
	}

    // =========== Register Controls ===========
	protected function register_controls() {
        
        $this->start_controls_section(
            'section_site_logo',
            [
                'label' => __( 'Site Logo', 'edubin-core' )
            ]
        );

        $this->add_control(
            'enable_custom_logo',
            [
                'label'       => __( 'Custom Logo', 'edubin-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => __( 'Enable', 'edubin-core' ),
                'label_off'   => __( 'Disable', 'edubin-core' ),
                'yes'         => __( 'Yes', 'edubin-core' ),
                'no'          => __( 'No', 'edubin-core' ),
                'default'     => 'no',
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'custom_logo',
            [
                'label'      => __( 'Custom Logo', 'edubin-core' ),
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'default'    => [
                    'url'    => Utils::get_placeholder_image_src()
                ],
                'condition'  => [
                    'enable_custom_logo' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'enable_transparent_logo',
            [
                'label'       => __( 'Transparent Logo', 'edubin-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => __( 'Enable', 'edubin-core' ),
                'label_off'   => __( 'Disable', 'edubin-core' ),
                'yes'         => __( 'Yes', 'edubin-core' ),
                'no'          => __( 'No', 'edubin-core' ),
                'default'     => 'no',
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'transparent_logo',
            [
                'label'       => __( 'Transparent Logo', 'edubin-core' ),
                'type'        => Controls_Manager::MEDIA,
                'show_label'  => false,
                'description' => __( 'Transparent Logo won\'t visible here. It\'ll show perfectly at your site.', 'edubin-core' ),
                'condition'   => [
                    'enable_transparent_logo' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'logo_size',
                'label'   => __( 'Logo Size', 'edubin-core' ),
                'default' => 'medium'
            ]
        );
        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'edubin-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'default'        => 'center',
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
                    '{{WRAPPER}} .edubin-site-main-logo, {{WRAPPER}} .edubin-logo-caption-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'caption_source',
            [
                'label'     => __( 'Caption', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'label_on'  => __( 'Enable', 'edubin-core' ),
                'label_off' => __( 'Disable', 'edubin-core' ),
                'default'   => 'no',
                'options'   => [
                    'no'    => __( 'No', 'edubin-core' ),
                    'yes'   => __( 'Yes', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'caption',
            [
                'label'       => __( 'Custom Caption', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'placeholder' => __( 'Enter caption', 'edubin-core' ),
                'condition'   => [
                    'caption_source' => 'yes'
                ],
                'dynamic'     => [
                    'active'  => true
                ]
            ]
        );

        $this->add_control(
            'link_to',
            [
                'label'       => __( 'Link', 'edubin-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'default',
                'options'     => [
                    'default' => __( 'Default', 'edubin-core' ),
                    'none'    => __( 'None', 'edubin-core' ),
                    'file'    => __( 'Media File', 'edubin-core' ),
                    'custom'  => __( 'Custom URL', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __( 'Link', 'edubin-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active'  => true
                ],
                'placeholder' => __( 'https://your-link.com', 'edubin-core' ),
                'condition'   => [
                    'link_to' => 'custom'
                ],
                'show_label'  => false
            ]
        );

        $this->add_control(
            'open_lightbox',
            [
                'label'       => __( 'Lightbox', 'edubin-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'default',
                'options'     => [
                    'default' => __( 'Default', 'edubin-core' ),
                    'yes'     => __( 'Yes', 'edubin-core' ),
                    'no'      => __( 'No', 'edubin-core' )
                ],
                'condition'   => [
                    'link_to' => 'file'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'site_logo_style',
            [
                'label' => __( 'Site Logo', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'          => __( 'Width', 'edubin-core' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => [ '%', 'px', 'vw' ],
                'range'          => [
                    '%'          => [
                        'min'    => 1,
                        'max'    => 100
                    ],
                    'px'         => [
                        'min'    => 1,
                        'max'    => 1000
                    ],
                    'vw'         => [
                        'min'    => 1,
                        'max'    => 100
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .edubin-site-main-logo img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label'          => __( 'Max Width', 'edubin-core' ) . ' (%)',
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => [ '%' ],
                'range'          => [
                    '%'          => [
                        'min'    => 1,
                        'max'    => 100
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .edubin-site-main-logo img' => 'max-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'separator_panel_style',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick'
            ]
        );

        $this->add_control(
            'site_logo_background_color',
            [
                'label'     => __( 'Background Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-site-main-logo' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'site_logo_image_border',
                'selector' => '{{WRAPPER}} .edubin-site-main-logo img'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'edubin-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-site-main-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .edubin-site-main-logo img'
            ]
        );

        $this->start_controls_tabs( 'image_effects' );

        $this->start_controls_tab(
            'normal',
            [
                'label' => __( 'Normal', 'edubin-core' )
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label'        => __( 'Opacity', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-site-main-logo img' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters',
                'selector' => '{{WRAPPER}} .edubin-site-main-logo img'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover',
            [
                'label' => __( 'Hover', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'opacity_hover',
            [
                'label'        => __( 'Opacity', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-site-main-logo:hover img' => 'opacity: {{SIZE}};'
                ]
            ]
        );
        $this->add_control(
            'background_hover_transition',
            [
                'label'        => __( 'Transition Duration', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'max'  => 3,
                        'step' => 0.1
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-site-main-logo img' => 'transition-duration: {{SIZE}}s'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .edubin-site-main-logo:hover img'
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'edubin-core' ),
                'type'  => Controls_Manager::HOVER_ANIMATION
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'caption_style',
            [
                'label'     => __( 'Caption', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'caption_source!' => 'none',
                    'caption!'        => ''
                ]
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-site-logo-caption-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'caption_background_color',
            [
                'label'     => __( 'Background Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-site-logo-caption-text' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'caption_typography',
                'selector' => '{{WRAPPER}} .edubin-site-logo-caption-text'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'caption_text_shadow',
                'selector' => '{{WRAPPER}} .edubin-site-logo-caption-text'
            ]
        );

        $this->add_responsive_control(
            'caption_padding',
            [
                'label'      => __( 'Padding', 'edubin-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .edubin-site-logo-caption-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'caption_space',
            [
                'label'       => __( 'Spacing', 'edubin-core' ),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'     => [
                    'size'    => 0,
                    'unit'    => 'px'
                ],
                'selectors'   => [
                    '{{WRAPPER}} .edubin-site-logo-caption-text' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: 0px;'
                ]
            ]
        );

        $this->end_controls_section();
    }

    private function has_caption( $settings ) {
        return ( ! empty( $settings['caption_source'] ) && 'no' !== $settings['caption_source'] );
    }

    private function get_caption( $settings ) {
        $caption = '';
        if ( 'yes' === $settings['caption_source'] ) :
            $caption = ! empty( $settings['caption'] ) ? $settings['caption'] : '';
        endif;
        return $caption;
    }

    public function site_image_url( $size ) {
        $settings = $this->get_settings_for_display();
        if ( ! empty( $settings['custom_logo']['url'] ) ) :
            $logo = wp_get_attachment_image_src( $settings['custom_logo']['id'], $size, true );
        else :
            $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $size, true );
        endif;
        return $logo[0];
    }

    // =========== Render ===========
    protected function render() {
        $settings = $this->get_settings_for_display();

        $has_caption = $this->has_caption( $settings );

        if ( 'yes' === $settings['enable_transparent_logo'] ) :
            if ( ! empty( $settings['transparent_logo']['id'] ) ) :
                $this->add_render_attribute( 'container', 'class', 'edubin-site-logo-has-transparent-menu' );
            endif;
        endif;

        $this->add_render_attribute( 'container', 'class', 'edubin-site-logo-widget-container' );

        $size = $settings['logo_size_size'];

        $site_image = $this->site_image_url( $size );

        if ( site_url() . '/wp-includes/images/media/default.png' === $site_image ) :
            $site_image = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';
        else :
            $site_image = $site_image;
        endif;

        if ( 'yes' === $settings['enable_custom_logo'] ) :
            $this->add_render_attribute( 'site-logo', 'alt', esc_attr( Control_Media::get_image_alt( $settings['custom_logo'] ) ) );
        else :
            if ( has_custom_logo() ) :
                $custom_logo_id  = get_theme_mod( 'custom_logo' );
                $custom_logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
                if ( empty( $custom_logo_alt ) ) :
                    $custom_logo_alt = get_bloginfo( 'name', 'display' );
                endif;
                $this->add_render_attribute( 'site-logo', 'alt', esc_attr( $custom_logo_alt ) );
            endif;
        endif;

        if ( 'file' === $settings['link_to'] ) :
            $link = $site_image;
            $logo_full = array();
            if ( 'yes' === $settings['enable_custom_logo'] ) :
                $logo_full = wp_get_attachment_image_src( $settings['custom_logo']['id'], 'full' );
            else :
                if ( has_custom_logo() ) :
                    $logo_full = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                endif;
            endif;
            $this->add_render_attribute( 'link', 'href', esc_url( $logo_full[0] ) );
            if ( 'yes' === $settings['enable_transparent_logo'] ) :
                if ( ! empty( $settings['transparent_logo']['id'] ) ) :
                    $transparent_logo_full = wp_get_attachment_image_src( $settings['transparent_logo']['id'], 'full' );
                    $this->add_render_attribute( 'transparent-logo-link', 'href', $transparent_logo_full[0] );
                endif;
            endif;
        elseif ( 'default' === $settings['link_to'] ) :
            $link = site_url();
            $this->add_render_attribute( 'link', 'href', $link );
            $this->add_render_attribute( 'transparent-logo-link', 'href', $link );
        else :
            $link     = $this->get_link_url( $settings );
            $link_url = isset( $link['url'] ) ? $link['url'] : '';
            $this->add_render_attribute( 'link', 'href', $link_url );
            $this->add_render_attribute( 'transparent-logo-link', 'href', $link_url );
            if ( ! empty( $link['nofollow'] ) ) :
                $this->add_render_attribute( 'link', 'rel', 'nofollow' );
                $this->add_render_attribute( 'transparent-logo-link', 'rel', 'nofollow' );
            endif;
            if ( ! empty( $link['is_external'] ) ) :
                $this->add_render_attribute( 'link', 'target', '_blank' );
                $this->add_render_attribute( 'transparent-logo-link', 'target', '_blank' );
            endif;
        endif;

        $class = '';
        if ( Plugin::$instance->editor->is_edit_mode() ) :
            $class = 'elementor-non-clickable';
        else :
            $class = 'elementor-clickable';
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
            if ( $has_caption ) :
                echo '<figure class="edubin-site-logo-caption">';
            endif;

            if ( $link ) :
                if ( 'no' === $settings['open_lightbox'] ) :
                    $class = 'elementor-non-clickable';
                endif;

                $this->add_render_attribute( 'link',
                    [
                        'data-elementor-open-lightbox' => esc_attr( $settings['open_lightbox'] ),
                        'class'                        => esc_attr( $class )
                    ]
                );

                $this->add_render_attribute( 'transparent-logo-link',
                    [
                        'data-elementor-open-lightbox' => esc_attr( $settings['open_lightbox'] ),
                        'class'                        => esc_attr( $class )
                    ]
                );
            endif;

            if ( empty( $site_image ) ) :
                return;
            endif;

            if ( 'custom' !== $size ) :
                $image_size = $size;
            else :
                require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';

                $image_dimension = $settings['logo_size_custom_dimension'];

                $image_size = [
                    0           => null, // Width.
                    1           => null, // Height.
                    'bfi_thumb' => true,
                    'crop'      => true
                ];

                $has_custom_size = false;
                if ( ! empty( $image_dimension['width'] ) ) :
                    $has_custom_size = true;
                    $image_size[0]   = $image_dimension['width'];
                endif;

                if ( ! empty( $image_dimension['height'] ) ) :
                    $has_custom_size = true;
                    $image_size[1]   = $image_dimension['height'];
                endif;

                if ( ! $has_custom_size ) :
                    $image_size = 'full';
                endif;
            endif;

            $image_url = $site_image;

            if ( ! empty( $settings['custom_logo']['url'] ) ) :
                $image_data = wp_get_attachment_image_src( $settings['custom_logo']['id'], $image_size, true );
            else :
                $image_data = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $image_size, true );
            endif;

            if ( ! empty( $image_data ) ) :
                $image_url = $image_data[0];
            endif;

            if ( site_url() . '/wp-includes/images/media/default.png' === $image_url ) :
                $image_url = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';
            else :
                $image_url = $image_url;
            endif;

            $image_unset = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';

            if ( $image_unset !== $image_url ) :
                $image_url = $image_url;
            endif;

            $this->add_render_attribute( 'site-logo', 'src', esc_url( $image_url ) );
            if ( ! empty( $settings['hover_animation'] ) ) :
                $this->add_render_attribute( 'site-logo', 'class', 'elementor-animation-' . esc_attr( $settings['hover_animation'] ) );
                $this->add_render_attribute( 'transparent-logo', 'class', 'elementor-animation-' . esc_attr( $settings['hover_animation'] ) );
            endif;

            $has_transparent_menu = $has_main_menu = '';
            if ( 'yes' === $settings['enable_transparent_logo'] ) :
                if ( ! empty( $settings['transparent_logo']['id'] ) ) :
                    $has_transparent_menu = ' edubin-has-transparent-logo';
                endif;
            endif;

            if ( ( 'yes' === $settings['enable_custom_logo'] && ! empty( $settings['custom_logo']['id'] ) ) ) :
                $has_main_menu = 'edubin-has-no-main-logo';
            endif;
            echo '<span class="edubin-site-main-logo edubin-site-main-logo-type' . esc_attr( $has_transparent_menu ) . '">';
                if ( $link ) :
                    echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
                endif;
                echo '<img ' . $this->get_render_attribute_string( 'site-logo' ) . '>';
                if ( $link ) :
                    echo '</a>';
                endif;
            echo '</span>';

            if ( 'yes' === $settings['enable_transparent_logo'] ) :
                $transparent_logo     = $settings['transparent_logo'];
                $transparent_logo_url = Group_Control_Image_Size::get_attachment_image_src( $transparent_logo['id'], 'logo_size', $settings );
                if ( empty( $transparent_logo_url ) ) :
                    $transparent_logo_url = $transparent_logo['url'];
                else :
                    $transparent_logo_url = $transparent_logo_url;
                endif;
                $this->add_render_attribute( 'transparent-logo', 'src', esc_url( $transparent_logo_url ) );
                $this->add_render_attribute( 'transparent-logo', 'alt', esc_attr( Control_Media::get_image_alt( $settings['transparent_logo'] ) ) );

                if ( ! empty( $settings['transparent_logo']['id'] ) ) :
                    echo '<span class="edubin-site-main-logo edubin-site-transparent-logo-type">';
                        if ( $link ) :
                            echo '<a ' . $this->get_render_attribute_string( 'transparent-logo-link' ) . '>';
                        endif;
                        echo '<img ' . $this->get_render_attribute_string( 'transparent-logo' ) . '>';
                        if ( $link ) :
                            echo '</a>';
                        endif;
                    echo '</span>';
                endif;
            endif;

            if ( $has_caption ) :
                $caption_text = $this->get_caption( $settings );
                if ( ! empty( $caption_text ) ) :
                    echo '<div class="edubin-logo-caption-wrapper"> ';
                        echo '<figcaption class="edubin-site-logo-caption-text">' . wp_kses_post( $caption_text ) . '</figcaption>';
                    echo '</div>';
                endif;
                echo '</figure>';
            endif;
        echo '</div>';
    }

    private function get_link_url( $settings ) {
        if ( 'none' === $settings['link_to'] ) :
            return false;
        endif;

        if ( 'custom' === $settings['link_to'] ) :
            if ( empty( $settings['link']['url'] ) ) :
                return false;
            endif;
            return $settings['link'];
        endif;

        if ( 'default' === $settings['link_to'] ) :
            if ( empty( $settings['link']['url'] ) ) :
                return false;
            endif;
            return site_url();
        endif;
    }
}

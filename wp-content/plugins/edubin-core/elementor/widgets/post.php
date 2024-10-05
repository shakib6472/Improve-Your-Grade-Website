<?php

namespace EdubinCore\Widgets;

use \EdubinCore\Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Edubin_Post extends Widget_Base {
    use \Edubin_Core\Traits\Posts;

    public function get_name() {
        return 'edubin-postgrid-addons';
    }

    public function get_title() {
        return __( 'Post Classic Layout 1', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-post-list';
    }

    public function get_keywords() {
        return [ 'edubin', 'query', 'blog', 'post', 'archive', 'posts', 'loop' ];
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    protected $category_taxonomy = 'category';

    protected function register_controls() {

        // Content Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' => __( 'Post Query', 'edubin-core' ),
            ]
            );
            $this->show_post_source();

        $this->end_controls_section(); // Content Option End
        $this->start_controls_section(
                'post_grid_content',
                [
                    'label' => __( 'Display Settings', 'edubin-core' ),
                ]
            );
            // $this->add_control(
            //     'post_grid_style',
            //     [
            //         'label' => __( 'Layout', 'edubin-core' ),
            //         'type' => 'edubin-preset-select',
            //         'default' => '1',
            //         'options' => [
            //             '1'   => __( 'Layout One', 'edubin-core' ),
            //             '2'   => __( 'Layout Two', 'edubin-core' ),
            //             '3'   => __( 'Layout Three', 'edubin-core' ),
            //             '4'   => __( 'Layout Four', 'edubin-core' ),
            //             '5'   => __( 'Layout Five', 'edubin-core' ),
            //         ],
            //     ]
            // );

            $this->add_control(
                'show_title',
                [
                    'label' => esc_html__( 'Show Title', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label' => __( 'Title Length', 'edubin-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 5,
                    'condition' => [
                        'show_title' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'title_tag',
                [
                    'label' => __('Title Tag', 'edubin-core'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'h4',
                    'options' => [
                        'h1' => __('H1', 'edubin-core'),
                        'h2' => __('H2', 'edubin-core'),
                        'h3' => __('H3', 'edubin-core'),
                        'h4' => __('H4', 'edubin-core'),
                        'h5' => __('H5', 'edubin-core'),
                        'h6' => __('H6', 'edubin-core'),
                        'span' => __('Span', 'edubin-core'),
                        'p' => __('P', 'edubin-core'),
                        'div' => __('Div', 'edubin-core'),
                    ],
                    'condition' => [
                        'show_title' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__( 'Show Category', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label' => esc_html__( 'Show Date', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_author',
                [
                    'label' => esc_html__( 'Show Author', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_content',
                [
                    'label' => esc_html__( 'Show Content', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'content_type',
                [
                    'label' => esc_html__( 'Content Source', 'edubin-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'content',
                    'options' => [
                        'content'          => esc_html__('Content','edubin-core'),
                        'excerpt'            => esc_html__('Excerpt','edubin-core'),
                    ],
                    'condition'=>[
                        'show_content'=>'yes',
                    ]
                ]
            );
            $this->add_control(
                'content_length',
                [
                    'label' => __( 'Content Length', 'edubin-core' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 1,
                    'default' => 20,
                    'condition'=>[
                        'show_content'=>'yes',
                        'content_type'=>'content',
                    ]
                ]
            );
            $this->add_control(
                'show_read_more_btn',
                [
                    'label' => esc_html__( 'Read More Button', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
    
            $this->add_control(
                'read_more_txt',
                [
                    'label' => __( 'Button Text', 'edubin-core' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Read More', 'edubin-core' ),
                    'placeholder' => __( 'Read More', 'edubin-core' ),
                    'label_block'=>true,
                    'condition'=>[
                        'show_read_more_btn'=>'yes',
                    ]
                ]
            );
            $this->add_control(
                'show_read_more_icon',
                [
                    'label' => esc_html__( 'Read More Button Icon', 'edubin-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();
        // Style tab section
        $this->start_controls_section(
            'post_items_style_section',
            [
                'label' => __( 'Items Style', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'item_background',
                    'label' => __( 'Background', 'edubin-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-post',
                    
                ]
            );  
            $this->add_responsive_control(
                'post_items_margin',
                [
                    'label' => __( 'Item Gap', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-post-grid-area .ht-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    ],
                   
                ]
            );
            $this->add_responsive_control(
                'item_box_padding',
                [
                    'label' => esc_html__('Item Padding', 'edubin-core'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-post-grid-area .ht-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'item_box_border',
                    'label' => esc_html__('Border', 'edubin-core'),
                    'selector' => '{{WRAPPER}} .edubin-post-grid-area .ht-post',
                ]
            );

            $this->add_responsive_control(
                'item_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .edubin-post-grid-area .ht-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'item_box_shadow',
                    'selector' => '{{WRAPPER}} .edubin-post-grid-area .ht-post',
                ]
            );
            $this->add_control(
                'content_box_style_heading',
                [
                    'label' => __( 'Content Box Style', 'edubin-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'post_items_item_padding_box',
                [
                    'label' => __( 'Content Box Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'post_items_item_margin_box',
                [
                    'label' => __( 'Content Box Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; width: auto; left:0; right:0;',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_box_bg',
                    'label' => __( 'Background', 'edubin-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-post .post-content',
                    
                ]
            );  
            $this->add_responsive_control(
                'content_box_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'post_items_item_alignment_box',
                [
                    'label' => __( 'Alignment', 'edubin-core' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();

        
        // Style Thumbnail section
        $this->start_controls_section(
            'thumbnail_section_style',
            [
                'label' => __( 'Thumbnail', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );
            
            $this->add_control(
                'post_carousel_image_overlay_heading',
                [
                    'label' => __( 'Image Overlay', 'edubin-core' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'post_slider_image_overlay',
                    'label' => __( 'Background', 'edubin-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-post .thumb a:after',
                    
                ]
            );   
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'edubin_image',
                    'label' => esc_html__( 'Image Size', 'edubin-core' ),
                    'exclude'      => ['custom'],
                    'default'      => 'full',
                    'separator' => 'none',
                ]
            );      
            $this->add_responsive_control(
                'post_items_item_border_radius_image',
                [
                    'label' => esc_html__( 'Image Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .thumb' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
        $this->end_controls_section();   
        // Style Title tab section
        $this->start_controls_section(
            'post_grid_title_style_section',
            [
                'label' => __( 'Title', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_title'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content h2 a,
                        {{WRAPPER}} .ht-post .post-content .content h4 a,
                        {{WRAPPER}} .ht-post .post-content .content .edubin-post-g-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'title_color_hover',
                [
                    'label' => __( 'Hover Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content h2 a:hover,
                        {{WRAPPER}} .ht-post .post-content .content h4 a:hover,
                        {{WRAPPER}} .ht-post .post-content .content .edubin-post-g-title a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __( 'Typography', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .ht-post .post-content .content h4, {{WRAPPER}} .ht-post .post-content .content h2,{{WRAPPER}} .ht-post .post-content .content .edubin-post-g-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content h4,
                        {{WRAPPER}} .ht-post .post-content .content h2,{{WRAPPER}} .ht-post .post-content .content .edubin-post-g-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content h4,
                        {{WRAPPER}} .ht-post .post-content .content h2,
                        {{WRAPPER}} .ht-post .post-content .content .edubin-post-g-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_align',
                [
                    'label' => __( 'Alignment', 'edubin-core' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'edubin-core' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content h2,{{WRAPPER}} .ht-post .post-content .content h4,{{WRAPPER}} .ht-post .post-content .content .edubin-post-g-title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );


        $this->end_controls_section();

        // Style Date tab section
        $this->start_controls_section(
            'post_grid_date_style_section',
            [
                'label' => __( 'Date', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_date'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'date_color',
                [
                    'label' => __( 'Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content .meta .meta-item.date' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'date_typography',
                    'label' => __( 'Typography', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .ht-post .post-content .content .meta .meta-item.date',
                ]
            );

            $this->add_responsive_control(
                'date_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content .meta .meta-item.date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'date_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content .meta .meta-item.date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'date_align',
                [
                    'label' => __( 'Alignment', 'edubin-core' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'edubin-core' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'edubin-core' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'edubin-core' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'edubin-core' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post .post-content .content .meta .meta-item.date' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Category tab section
        $this->start_controls_section(
            'post_grid_category_style_section',
            [
                'label' => __( 'Category', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_category'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'category_color',
                [
                    'label' => __( 'Color', 'edubin-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ht-post a.post-category' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'label' => __( 'Typography', 'edubin-core' ),
                    'selector' => '{{WRAPPER}} .ht-post a.post-category',
                ]
            );

            $this->add_responsive_control(
                'category_margin',
                [
                    'label' => __( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post a.post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'category_padding',
                [
                    'label' => __( 'Padding', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post a.post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'category_border_radius',
                [
                    'label' => __( 'Border Radius', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .ht-post a.post-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'category_background',
                    'label' => __( 'Background', 'edubin-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ht-post a.post-category',
                ]
            );

        $this->end_controls_section();
        // Content style
        $this->start_controls_section(
            'post_description_section',
            [
                'label' => esc_html__('Description', 'edubin-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes',
                ]
            ]
            );
            
            $this->add_control(
                'post_description_color',
                [
                    'label' => esc_html__('Color', 'edubin-core'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} p.edubin-post-g-description' => 'color: {{VALUE}};',
                    ],

                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'post_description_typography',
                    'selector' => '{{WRAPPER}} p.edubin-post-g-description',
                ]
            );
            $this->add_responsive_control(
                'post_description_margin',
                [
                    'label' => esc_html__( 'Margin', 'edubin-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} p.edubin-post-g-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],                
                ]
            );
            
        $this->end_controls_section();
        // Style Read More button section
        $this->start_controls_section(
            'readmore_style_section',
            [
                'label' => __( 'Read More', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_read_more_btn'=>'yes',
                    'read_more_txt!'=>'',
                ]
            ]
            );
            $this->start_controls_tabs('readmore_style_tabs');

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'edubin-core' ),
                    ]
                );

                    $this->add_control(
                        'readmore_color',
                        [
                            'label' => __( 'Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} a.edubin-post-g-read-more' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'readmore_typography',
                            'label' => __( 'Typography', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} a.edubin-post-g-read-more',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} a.edubin-post-g-read-more',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} a.edubin-post-g-read-more',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} a.edubin-post-g-read-more' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'readmore_padding',
                        [
                            'label' => __( 'Padding', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} a.edubin-post-g-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label' => __( 'Margin', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} a.edubin-post-g-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'edubin-core' ),
                    ]
                );
                    $this->add_control(
                        'readmore_hover_color',
                        [
                            'label' => __( 'Color', 'edubin-core' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} a.edubin-post-g-read-more:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_hover_background',
                            'label' => __( 'Background', 'edubin-core' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} a.edubin-post-g-read-more:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_hover_border',
                            'label' => __( 'Border', 'edubin-core' ),
                            'selector' => '{{WRAPPER}} a.edubin-post-g-read-more:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} a.edubin-post-g-read-more:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $post_type = $settings['grid_post_type'];
        if( 'post'== $post_type ){
            $post_categorys = $settings['grid_categories'];
        } else if( 'product'== $post_type ){
            $post_categorys = isset( $settings['grid_prod_categories'] ) ? $settings['grid_prod_categories'] : $settings['grid_categories'];
        }else {
            $post_categorys = $settings[ $post_type.'_post_category'];
        }
        $post_author = $settings['post_author'];
        $exclude_posts = $settings['exclude_posts'];
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');
        $category_name =  get_object_taxonomies($post_type);
        $this->add_render_attribute( 'edubin_post_grid', 'class', 'edubin-post-grid-area' );

        // Post query
        $args = array(
            'post_type'             => $post_type,
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? (int)$settings['post_limit'] : 3,
        );

        if (  !empty( $post_categorys ) ) {

            if( $category_name['0'] == "product_type" ){
                    $category_name['0'] = 'product_cat';
            }

            if( is_array($post_categorys) && count($post_categorys) > 0 ){

                $field_name = is_numeric( $post_categorys[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $category_name[0],
                        'terms' => $post_categorys,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }
        // author check
        if (  !empty( $post_author ) ) {
            $args['author__in'] = $post_author;
        }
        // order by  check
        if ( !empty( $orderby ) ) {
            if ( 'date' == $orderby && 'yes'== $settings['custom_order_by_date'] && (!empty( $settings['order_by_date_after'] || $settings['order_by_date_before'] ) ) ) {
            $order_by_date_after = strtotime($settings['order_by_date_after']);
            $order_by_date_before = strtotime($settings['order_by_date_before']);
                $args['date_query'] = array(
                    array(
                        'before'    => array(
                            'year'  => date('Y', $order_by_date_before),
                            'month' =>date('m', $order_by_date_before),
                            'day'   => date('d', $order_by_date_before),
                        ),
                        'after'    => array(
                            'year'  => date('Y', $order_by_date_after),
                            'month' =>date('m', $order_by_date_after),
                            'day'   => date('d', $order_by_date_after),
                        ),
                        'inclusive' => true,
                    ),
                );

            } else {
                $args['orderby'] = $orderby;
            }
        }

        // Exclude posts check
        if (  !empty( $exclude_posts ) ) {
            $exclude_posts = explode(',',$exclude_posts);
            $args['post__not_in'] =  $exclude_posts;
        }

        // Order check
        if (  !empty( $postorder ) ) {
            $args['order'] =  $postorder;
        }

        $grid_post = new \WP_Query( $args );
       

        $this->add_render_attribute( 'edubin_post_attr', 'class', 'edubin-post-g-title' );
        $edubin_image_size  = $this->get_settings_for_display('edubin_image_size');
        ?>
            
        <div <?php echo $this->get_render_attribute_string( 'edubin_post_grid' ); ?>>
            <div class="edubin-col">
                <div class="row">
                    <?php
                    $countrow = $gdc = $rowcount = 0;
                    if($grid_post->have_posts() ):
                    while( $grid_post->have_posts() ) : $grid_post->the_post();
                        $countrow++;
                        $gdc++;
                        

                        if ( 0 > $settings['title_length'] ) {
                            $title_link_text = "<a href='".get_the_permalink()."'>".get_the_title()."</a>";
                        } else { 
                            $title_link_text = "<a href='".get_the_permalink()."'>".wp_trim_words( get_the_title(), $settings['title_length'], '' )."</a>";
                        }
                        ?>

                            <div class="edubin-col-12 edubin-col-sm-6 edubin-col-md-6 edubin-col-lg-<?php echo $settings['post_column_layout']?>">
                                <div class="ht-post black-overlay mt--30">
                                        <div class="thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail($edubin_image_size);
                                                } else {
                                                    echo '<img src="' . EDUBIN_PLUGIN_URL . '/assets/images/image-placeholder.png" alt="' . get_the_title() . '" />';
                                                }
                                                ?>
                                            </a>
                                            <?php
                                            if( $settings['show_category'] == 'yes' ){
                                                if( $category_name ){
                                                    $i=0;
                                                    $get_terms = get_the_terms($grid_post->ID, $category_name[0] );
                                                    if( $settings['grid_post_type'] == 'product' ){
                                                        $get_terms = get_the_terms($grid_post->ID, 'product_cat');
                                                    }
                                                    if( $get_terms ){
                                                        foreach ( $get_terms as $category ) {
                                                            $i++;
                                                            $term_link = get_term_link( $category );
                                                            ?>
                                                                <a href="<?php echo esc_url( $term_link ); ?>" class="category post-category post-position-top-left <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name );?></a>
                                                            <?php
                                                            if($i==1){break;}
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            ?>
                                        </div>
                                    <?php
                                    
                                    if ($settings['show_title'] == 'yes' || $settings['show_date'] == 'yes' || $settings['show_content'] == 'yes' || $settings['show_read_more_btn'] == 'yes') {
                                        ?>
                                        <div class="post-content">
                                            <div class="content">
                                                <div class="meta">
                                                <?php if( $settings['show_author'] == 'yes' ): ?>
                                                        <span class="meta-item author">  
                                                            <?php echo get_the_author(); ?>
                                                        </span>
                                                    <?php endif;?>
                                                    <?php if( $settings['show_date'] == 'yes' ): ?>
                                                        <span class="meta-item date">  
                                                            <?php the_time( 'd M Y' ); ?>
                                                        </span>
                                                    <?php endif;?>
                                                </div>

                                                <?php if( $settings['show_title'] == 'yes' ):

                                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                                edubin_escape_tags( $settings['title_tag'], 'h4' ),
                                                $this->get_render_attribute_string( 'edubin_post_attr' ),
                                                $title_link_text);

                                                endif; ?>
                                                
                                                <?php
                                                if( $settings['show_content'] == 'yes' ):
                                                    if( $settings['content_type'] == 'excerpt' ){
                                                        echo '<p class="edubin-post-g-description">'.get_the_excerpt().'</p>';
                                                    } else {
                                                        echo '<p class="edubin-post-g-description">'.wp_trim_words( strip_shortcodes( get_the_content() ), $settings['content_length'], '' ).'</p>'; 
                                                    }
                                                endif;
                                                if( $settings['show_read_more_btn'] == 'yes' && !empty( $settings['read_more_txt'] ) ): ?>
                                                    <a class="edubin-post-g-read-more" href="<?php the_permalink();?>">
                                                        <?php echo edubin_kses_desc( $settings['read_more_txt'] ); ?>
                                                        <?php echo ($settings['show_read_more_icon'] === 'yes') ? ('<i class="flaticon-next"></i>') : ('')?>
                                                    </a>
                                                    <?php
                                                endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            </div>


                        <?php 
                    endwhile; wp_reset_postdata(); wp_reset_query(); 
                    else:
                        echo "<div class='edubin-error-notice'>".esc_html__('There are no posts in this query','edubin-core')."</div>";
                    endif;
                    ?>
                </div>
            </div>
        </div>

        <?php

    }
    // post query fields
    public function show_post_source(){

        $this->add_control(
            'grid_post_type',
            [
                'label' => esc_html__( 'Post Type', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => edubin_get_post_types(),
                'default' =>'post',
                'frontend_available' => true,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label' => __( 'Include By', 'edubin-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'default' =>'in_category',
                'options' => [
                    'in_author'      => __( 'Author', 'edubin-core' ),
                    'in_category'      => __( 'Category', 'edubin-core' ),
                ],
            ]
        );
        $this->add_control(
            'post_author',
            [
                'label' => esc_html__( 'Authors', 'edubin-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => edubin_get_authors_list(),
                'condition' =>[
                    'include_by' => 'in_author',
                ]
            ]
        );
        $all_post_type = edubin_get_post_types();
        foreach( $all_post_type as $post_key => $post_item ){
            
            if( 'post' == $post_key ){
                $this->add_control(
                    'grid_categories',
                    [
                        'label' => esc_html__( 'Categories', 'edubin-core' ),
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => edubin_get_taxonomies(),
                        'condition' =>[
                            'grid_post_type' => 'post',
                            'include_by' => 'in_category',
                        ]
                    ]
                );
            } else if( 'product' == $post_key){
                $this->add_control(
                    'grid_prod_categories',
                    [
                        'label' => esc_html__( 'Categories', 'edubin-core' ),
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => edubin_get_taxonomies('product_cat'),
                        'condition' =>[
                            'grid_post_type' => 'product',
                            'include_by' => 'in_category',
                        ]
                    ]
                );

            } else {
                $this->add_control(
                    "{$post_key}_post_category",
                    [
                        'label' => esc_html__( 'Select Categories', 'edubin-core' ),
                        'type' => Controls_Manager::SELECT2,
                        'label_block' => true,
                        'multiple' => true,
                        'options' => all_object_taxonomie_show_catagory($post_key),
                        'condition' => [
                            'grid_post_type' => $post_key,
                            'include_by' => 'in_category',
                        ],
                    ]
                );
            }

        }
        $this->add_control(
            "exclude_posts",
            [
                'label' => esc_html__( 'Exclude Posts', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Example: 10,11,105', 'edubin-core' ),
                'description' => esc_html__( "To Exclude Post, Enter  the post id separated by ','", 'edubin-core' ),
            ]
        );
        $this->add_control(
            'post_limit',
            [
                'label' => __('Limit', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'separator'=>'before',
            ]
        );

        $this->add_control(
            'post_column_layout',
            [
                'label' => __( 'Column Layout', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12'   => __( 'Column 1', 'edubin-core' ),
                    '6'   => __( 'Column 2', 'edubin-core' ),
                    '4'   => __( 'Column 3', 'edubin-core' ),
                    '3'   => __( 'Column 4', 'edubin-core' ),
                    '2'   => __( 'Column 6', 'edubin-core' ),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID'            => esc_html__('ID','edubin-core'),
                    'date'          => esc_html__('Date','edubin-core'),
                    'name'          => esc_html__('Name','edubin-core'),
                    'title'         => esc_html__('Title','edubin-core'),
                    'comment_count' => esc_html__('Comment count','edubin-core'),
                    'rand'          => esc_html__('Random','edubin-core'),
                ],
            ]
        );
        $this->add_control(
            'custom_order_by_date',
            [
                'label' => esc_html__( 'Custom Date', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
                'condition' =>[
                    'orderby'=>'date'
                ]
            ]
        );
        $this->add_control(
            'order_by_date_before',
            [
                'label' => __( 'Before Date', 'edubin-core' ),
                'type' => Controls_Manager::DATE_TIME,
                'condition' =>[
                    'orderby'=>'date',
                    'custom_order_by_date'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'order_by_date_after',
            [
                'label' => __( 'After Date', 'edubin-core' ),
                'type' => Controls_Manager::DATE_TIME,
                'condition' =>[
                    'orderby'=>'date',
                    'custom_order_by_date'=>'yes',
                ]
            ]
        );
        $this->add_control(
            'postorder',
            [
                'label' => esc_html__( 'Order', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending','edubin-core'),
                    'ASC'   => esc_html__('Ascending','edubin-core'),
                ],
                'separator' => 'after'

            ]
        );
    }
}
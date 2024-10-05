<?php

namespace EdubinCore\Events\Widgets;

use \EdubinCore\Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class WP_Events_Manager extends Widget_Base {
    use \Edubin_Core\Traits\Slider_Arrows;
    use \Edubin_Core\Traits\Slider_Dots;
    use \Edubin_Core\Traits\Posts;
    use \Edubin_Core\Traits\Grid, \Edubin_Core\Traits\Slider {
        \Edubin_Core\Traits\Slider::settings insteadof \Edubin_Core\Traits\Grid;
        \Edubin_Core\Traits\Grid::settings as grid_settings;
    }
    public function get_name() {
        return 'edubin-wpem';
    }

    public function get_title() {
        return __( 'WP Events Manager', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-sitemap';
    }

    public function get_keywords() {
        return [ 'edubin', 'events', 'meetup', 'online', 'conversation', 'WP Events Manager' ];
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    protected $post_type            = 'tp_event';
    protected $category_taxonomy    = 'tp_event_category';
    protected $desktop_max_slider     = 6;
    protected $desktop_default_slider = 3;
    protected $desktop_default_grid   = 3;
    protected $tablet_max_slider      = 3;
    protected $tablet_default_slider  = 2;
    protected $tablet_default_grid    = 2;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 1;
    protected $mobile_default_grid    = 1;
    protected $default_content_type, $default_display_type;

    protected function register_controls() {

        $this->start_controls_section(
            'section_posts',
            [
                'label' => __( 'Events', 'edubin-core' )
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'      => __( 'Style', 'edubin-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => '1',
                'options'    => [
                    '1'   => __( 'Style 01', 'edubin-core' ),
                    '2'   => __( 'Style 02', 'edubin-core' ),
                    '3'   => __( 'Style 03', 'edubin-core' ),
                ]
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'      => __( 'Display Type', 'edubin-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'grid',
                'options'    => [
                    'grid'   => __( 'Grid', 'edubin-core' ),
                    'slider' => __( 'Slider', 'edubin-core' ),
                    //'list' => __( 'List', 'edubin-core' )
                ],
                // 'condition'    => [
                //     'layout' => '1'
                // ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'edubin-post-thumb'
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'        => __( 'Image Height', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 100,
                        'step' => 10,
                        'max'  => 600
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-event-two-item-single .event-image img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        $this->add_control(
            'events_heading',
            [
                'label'   => __( 'Events Heading', 'edubin-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Upcoming events',
                'placeholder' => __('Upcoming events','edubin-core'),
            ]
        );

        $this->add_control(
            'default_scroll_animation',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Default Scroll Animation', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'display_type' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'enable_masonry',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Masonry Layout', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'display_type' => 'grid'
                ]
            ]
        );
        $this->add_control(
            'container_alert_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( 'It will work only in FrontEnd mode.', 'edubin-core' ),
                'content_classes' => 'edubin-elementor-widget-alert elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                    'display_type'   => 'grid',
                    'enable_masonry' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'event_label',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Label', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'layout' => '2'
                ]
            ]
        );

        $this->add_control(
            'label_text',
            [
                'type'         => Controls_Manager::TEXT,
                'label'        => __( 'Label Text', 'edubin-core' ),
                'default'      => __( 'Event', 'edubin-core' ),
                'condition'    => [
                    'event_label' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->query();

        $this->grid_settings();

        $this->settings();

        $this->arrows();

        $this->dots();

        // Style Scetion start
        $this->start_controls_section(
            'section_event_style',
            [
                'label' => __( 'Events', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'headign_color',
            [
                'label'     => __( 'Heading', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-event .event-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'eading_typography',
                'selector' => '{{WRAPPER}} .edubin-event .event-title h3',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => __( 'Heading Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-event .event-title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-event' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-single-event-addon .event-content-wrap' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'body_padding',
            [
                'label' => __( 'Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-single-event-addon .event-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'body_box_shadow',
                'selector' => '{{WRAPPER}} .edubin-event',
            ]
        );

        $this->add_control(
            'divider_options',
            [
                'label' => esc_html__( 'Event Divider', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    'layout'=> '1',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'event_border',
                'selector' => '{{WRAPPER}} .edubin-event .tpc-event-single-item',
                'condition'=>[
                    'layout'=> '1',
                ]
            ]
        );

        $this->add_responsive_control(
            'event_divider_padding',
            [
                'label' => __( 'Divider Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-event .tpc-event-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'=>[
                    'layout'=> '1',
                ]
            ]
        );
    
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __( 'Normal', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-event-addon a h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-event .tpc-event-single-item h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();      

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __( 'Hover', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => __( 'Title Hover Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-event .tpc-event-single-item .wpem-event-title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-single-event-addon a:hover h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .tpc-event-item .wpem-event-title a',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Title Padding', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-event .tpc-event-single-item .wpem-event-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edubin-single-event-addon a h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_meta',
            [
                'label' => __( 'Meta', 'edubin-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label'     => __( 'Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-event .edubin-event-date' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-single-event .edubin-event-time' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-single-event-addon .event-meta-wrap>span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .edubin-single-event .edubin-event-date, .edubin-single-event .edubin-event-time, .edubin-single-event-addon .event-meta-wrap>span',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->add_control(
            'meta_icon_color',
            [
                'label'     => __( 'Icon Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-event .edubin-event-date i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-single-event .edubin-event-time i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .edubin-single-event-addon .event-meta-wrap>span i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'meta_location_color',
            [
                'label'     => __( 'Location Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-event .tpc-event-single-item .edubin-single-event span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label'     => __( 'Price Color', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-event-addon .edubin-event-price-1 span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'price_bg_color',
            [
                'label'     => __( 'Price Background', 'edubin-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .edubin-single-event-addon .edubin-event-price-1 span' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * return post featured image
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $image_id, $settings ) {
        $image_size = $settings['thumb_size_size'];

        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumb_size', $settings );
        }else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        };
        
        return '<img src="' . esc_url( $image_src ). '" alt="' . esc_attr( edubin_thumbanil_alt_text( $image_id ) ) . '" />';
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings      = $this->get_settings_for_display();
        $events_heading = $settings['events_heading'];
        $direction     = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 'wrapper', 'class', 'tpc-events-wrapper' );
        $this->add_render_attribute( 'container', 'class', 'tpc-events-items' );
        $this->add_render_attribute( 'container', 'class', 'tpc-events-container-' . esc_attr( $settings['display_type'] ) );
        $this->add_render_attribute( 'container', 'class', 'tpc-events-' . esc_attr( $settings['display_type'] ) );
        $this->add_render_attribute( 'single', 'class', 'tpc-event-single-item' );

        if ( '1' === $settings['layout'] ) {

         // ===== Start Only for style 01 header section =====

            echo '<div id="edubin-event" class="edubin-event layout-1">';

            if(!empty($events_heading)) { 
                echo '<div class="event-title">';
                    echo '<h3>';
                       echo $events_heading;
                    echo '</h3>';
                echo '</div>';
            };

        }
       // ===== End Only for style 02 header section =====

        elseif( 'grid' === $settings['display_type'] ) {  

            $this->add_render_attribute( 'container', 'class', 'edubin-row' );
            if ( '5' === $settings['desktop_grid_columns'] ) {
                $grid_desktop_column = 'el-5';
            }else {
                $grid_desktop_column = 12/$settings['desktop_grid_columns'];
            };
            $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
            $grid_mobile_column  = 12/$settings['mobile_grid_columns'];

            $grid_column = 'edubin-col-lg-' . esc_attr( $grid_desktop_column ) . ' edubin-col-md-' . esc_attr( $grid_tablet_column ) . ' edubin-col-sm-' . esc_attr( $grid_mobile_column );

            $grid_column_none = '';

            if ( $settings['layout'] != '1' ) {
                $this->add_render_attribute( 'single', 'class', $grid_column );
            }else {
                 $this->add_render_attribute( 'single', 'class', $grid_column_none );
            };

            if ( 'yes' === $settings['default_scroll_animation'] ) {
                $this->add_render_attribute( 'single', 'data-sal' );
            };

            if ( 'yes' === $settings['enable_masonry'] ) {
                $this->add_render_attribute( 'container', 'class', 'tpc-masonry-grid-wrapper' );
                $this->add_render_attribute( 'single', 'class', 'tpc-masonry-item' );
            };

        }else{        
            $this->add_render_attribute( 'wrapper', 'class', 'tpc-slider-wrapper' );
            $this->add_render_attribute( 'container', 'class', 'swiper swiper-container' );
            $this->add_render_attribute( 'single', 'class', 'edubin-slider-item swiper-slide' );

            $this->add_render_attribute( 
                'swiper', 
                [

                    'data-infiniteLoop'             => ('yes' === $settings['infinite_loop']) ? ('true') : ('false'),
                    'data-autoplay'                  => ('yes' === $settings['slautolay']) ? ('true') : ('false'),
                    'data-autoplaySpeed'            => absint($settings['slautoplay_speed']),
                    'data-displayColumns'           => intval( esc_attr($settings['slitems'])),
                    'data-itemGap'                  => intval( esc_attr( $settings['item_gap'])),
                    'data-pauseOnHover'            => ('yes' === $settings['slpause_on_hover']) ? ('true') : ('false'),
                    'data-pauseOnInteraction'      => ('yes' === $settings['pause_on_interaction']) ? ('true') : ('false'),
                    //Tablet Settings
                    //'tablet_breakpoint'       => $settings['tablet_breakpoint'],
                    'data-displayColumnsTablet'    => intval( esc_attr( $settings['tablet_item_per_view'])),
                    'data-tabletItemGap'           => intval( esc_attr($settings['tablet_item_gap'])),
                    //Mobile Settings
                    //'mobile_breakpoint'       => $settings['mobile_breakpoint'],
                    'data-displayColumnsMobile'    => intval( esc_attr($settings['mobile_item_per_view'])),
                    'data-mobileItemGap'           => intval( esc_attr($settings['mobile_item_gap'])),
                ]
            );
            $this->add_render_attribute( 'swiper', 'class', 'swiper-wrapper' );
    
            // if ( 'yes' === $settings['slautoplay_speed'] ) {
            //     $this->add_render_attribute( 'swiper', 'data-autoplay', 'true' );
            //     $this->add_render_attribute( 'swiper', 'data-autoplayspeed', intval( esc_attr( $settings['slautoplay_speed'] ) ) );
            // };
    
            // if ( 'yes' === $settings['infinite_loop'] ) {
            //     $this->add_render_attribute( 'swiper', 'data-loop', 'true' );
            // };


            if ( 'yes' === $settings['slarrows'] ) :
                $this->add_render_attribute( 'wrapper', 'class', 'tpc-slider-wrapper-arrows-enable' );
            endif;

            if ( 'yes' === $settings['sldots'] ) :
                $this->add_render_attribute( 'wrapper', 'class', 'tpc-slider-wrapper-dots-enable' );
                $this->add_render_attribute( 'container', 'class', 'tpc-slider-dots-enable' );
                
            endif;
        };

        $wp_query = new \WP_Query( Helper::query_args( $settings, $this->post_type, $this->category_taxonomy ) );
        
        if ( $wp_query->have_posts() ) { 
            echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    if ( 'slider' === $settings['display_type'] ) { 
                        echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                    };

                    while ( $wp_query->have_posts() ) { $wp_query->the_post();
                        global $post;
                        $the_id    = get_the_ID();
                        $start_time = get_post_meta( $the_id, 'tp_event_date_start', true ) ? strtotime( get_post_meta( $the_id, 'tp_event_date_start', true ) ) : '';
                        $location = get_post_meta( $the_id, 'tp_event_location', true ) ? get_post_meta( $the_id, 'tp_event_location', true ) : '';

                        $time_start = wpems_event_start( get_option( 'time_format' ) );
				        $time_end   = wpems_event_end( get_option( 'time_format' ) );
				        $starting_date   = wp_date( 'd/M/Y', $start_time );
				        $start_date   = explode( '/', $starting_date );

                        $label_on_off = $settings['event_label'];
                        $label_text = $settings['label_text'];

                        if ( 'default' === $settings['date_format'] ) {
                            $date_format = get_option( 'date_format' );
                        }elseif ( 'custom' === $settings['date_format'] ) {
                            $date_format = $settings['custom_date_format'];
                        }else {
                            $date_format = $settings['date_format'];
                        };

                        echo '<div ' . $this->get_render_attribute_string( 'single' ) . '>';
                            echo '<div class="tpc-event-item tpc-event-style-' . esc_attr( $settings['layout'] ). '">';

                            include EDUBIN_PLUGIN_DIR . 'elementor/widgets/tpl-part/tp-event/layout-' . $settings['layout'] . '.php';

                            //get_template_part( 'wp-events-manager/content',  'event' );

                            echo '</div>';
                        echo '</div>';
                    };

                    if ( 'slider' === $settings['display_type'] ){
                        echo '</div>';
                    };
                    
                    if ( 'slider' === $settings['display_type'] ) : 
                        if ( 'yes' === $settings['sldots'] ) :
                            echo '<div class="slider-events-pegination swiper-pagination"></div>';
                        endif;
                    endif;
                echo '</div>';

                if ( 'yes' === $settings['slarrows'] && $settings['display_type']==='slider' ) :
                    echo '<div class="edubin-arrow-style-'.$settings['nav_arrow_style'].' prev-icon slide-prev">';
                        echo '<i class="flaticon-back-1"></i>';
                    echo '</div>';
                    echo '<div class="edubin-arrow-style-'.$settings['nav_arrow_style'].' next-icon slide-next">';
                        echo '<i class="flaticon-next"></i>';
                    echo '</div>';
                endif;
            echo '</div>';
        };

        if( '1' === $settings['layout'] ) {   

         // ===== Start Only for style 02 header section =====

           echo '</div>';

        // ===== End Only for style 02 header section ===== 
        };

        wp_reset_postdata();
    }
}
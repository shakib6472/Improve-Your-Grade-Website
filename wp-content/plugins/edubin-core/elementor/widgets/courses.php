<?php

namespace EdubinCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class Courses extends Widget_Base {
    use \Edubin_Core\Traits\Posts;
    use \Edubin_Core\Traits\Slider_Arrows;
    use \Edubin_Core\Traits\Slider_Dots;
    use \Edubin_Core\Traits\Grid, \Edubin_Core\Traits\Slider {
        \Edubin_Core\Traits\Slider::settings insteadof \Edubin_Core\Traits\Grid;
        \Edubin_Core\Traits\Grid::settings as grid_settings;
    }

    public function get_name() {
        return 'edubin-courses';
    }

    public function get_title() {
        return __( 'Courses( Grid / Carousel / Isotope )', 'edubin-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid edubin-elementor-icon';
    }

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    protected $desktop_max_slider     = 6;
    protected $desktop_default_slider = 3;
    protected $desktop_default_grid   = 3;
    protected $tablet_max_slider      = 3;
    protected $tablet_default_slider  = 2;
    protected $tablet_default_grid    = 2;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 1;
    protected $mobile_default_grid    = 1;
    protected $post_type              = LP_COURSE_CPT;
    protected $category_taxonomy      = 'course_category';
    protected $default_content_type, $default_display_type;

    // =========== Register Controls ===========
    protected function register_controls() {
                
        $this->start_controls_section(
            'section_courses',
            [
                'label' => __( 'Courses', 'edubin-core' )
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => __( 'Style', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => [
                    '1' => __('Style 01', 'edubin-core'),
                    '2' => __('Style 02', 'edubin-core'),
                    '3' => __('Style 03', 'edubin-core'),
                    '4' => __('Style 04', 'edubin-core'),
                    '5' => __('Style 05', 'edubin-core'),
                    '6' => __('Style 06', 'edubin-core'),
                ]
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'      => __( 'Display Grid/Slider', 'edubin-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'grid',
                'options'    => [
                    'grid'   => __( 'Grid', 'edubin-core' ),
                    'slider' => __( 'Slider', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'enable_filter',
            [
                'label'        => __( 'Filter', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,    
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
            'masonry_alert_text',
            [
                'type' => Controls_Manager::ALERT,
                'alert_type' => 'warning',
                'content' => esc_html__( 'It will function in preview mode only.', 'elementor' ),
                'condition'         => [
                    'enable_filter' => 'yes',
                    'display_type'  => 'grid'
                ]
            ]
        );
        $all_text_condition = [
            'enable_filter' => 'yes',
            'display_type'    => 'grid'
        ];
        if ( 'edubin-lpcourse-addons' === $this->get_name() ) :
            $this->add_control(
                'filter_type',
                [
                    'label'             => __( 'Filter Type', 'edubin-core' ),
                    'type'              => Controls_Manager::SELECT,
                    'label_block'       => true,
                    'default'           => 'cat-filter',
                    'options'           => [
                        'cat-filter'    => __( 'Category Filtering', 'edubin-core' ),
                        'tab-filter'    => __( 'Filter by New/ Featured/ Popular',   'edubin-core' )
                    ],
                    'condition'         => [
                        'enable_filter' => 'yes',
                        'display_type'  => 'grid'
                    ]
                ]
            );
            $all_text_condition = [
                'enable_filter' => 'yes',
                'display_type'    => 'grid',
                'filter_type'     => 'cat-filter'
            ];
        endif;

        $this->add_control(
            'filter_all_text',
            [   
                'label'     => __( 'Custom Text (All)', 'edubin-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'All', 'edubin-core' ),
                'condition' => $all_text_condition
            ]
        );
        $this->add_control(
            'default_scroll_animation',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Scroll Animation', 'edubin-core' ),
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
                'type' => Controls_Manager::ALERT,
                'alert_type' => 'warning',
                'content' => esc_html__( 'It will function in preview mode only.', 'elementor' ),
                'condition'       => [
                    'display_type'   => 'grid',
                    'enable_masonry' => 'yes'
                ]
            ]
        );
        // $this->add_control(
        //     'show_excerpt',
        //     [
        //         'label' => esc_html__('Excerpt?', 'edubin-core'),
        //         'type' => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //         'default' => '',
        //     ]
        // );
        // $this->add_control(
        //     'button_text',
        //     [
        //         'label'       => __( 'Button Text', 'edubin-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'label_block' => false
        //     ]
        // );
  
        // $this->add_group_control(
        //     Group_Control_Image_Size::get_type(),
        //     [
        //         'name'      => 'thumb_size',
        //         'default'   => 'edubin-post-thumb'
        //     ]
        // );

        $this->end_controls_section();

        $this->start_controls_section(
            'control_style',
            [
                'label'     => __( 'Control', 'edubin-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filter' => 'yes',
                    'display_type'  => 'grid'
                ]
            ]
        );

        $this->add_responsive_control(
            'control_alignment',
            [
                'label'          => __( 'Control Alignment', 'edubin-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start'       => [
                        'title'  => __( 'Left', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'      => [
                        'title'  => __( 'Right', 'edubin-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .edubin-filter-course' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'control_margin',
            [
                'label'        => __( 'Margin', 'edubin-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', 'em', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .edubin-filter-course' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );  

        $this->end_controls_section();

        // query()
        $this->query();

        // grid_settings()
        $this->grid_settings();

        // settings()
        $this->settings();
// ======= Course Meta =========

        $this->start_controls_section(
        'course_meta_section',
            [
                'label' => __( 'Meta & Content', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'show_media',
            [
                'label' => esc_html__('Media?', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'edubin-post-thumb'
            ]
        );

        $this->add_control(
            'show_intor_video',
            [
                'label' => esc_html__('Popup Intro Video?', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        
        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Title?', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
 
        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Excerpt', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
                'default' => '',
            ]
        );

        $this->add_control(
            'grid_excerpt_length',
            [
                'label'       => __( 'Number of Excerpt Words Grid', 'edubin-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 20,
                'condition'   => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );

        // $this->add_control(
        //     'excerpt_end',
        //     [
        //         'label'       => __( 'Excerpt End Text', 'edubin-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'default'     => '...',
        //         'separator' => 'before',
        //         // 'condition' => [
        //         //     'show_excerpt' => 'yes',
        //         //     'show_excerpt_list' => 'yes',
        //         // ],
        //         'conditions' => [
        //             'relation' => 'or',
        //             'terms' => [
        //                 [
        //                     'name' => 'show_excerpt',
        //                     'operator' => '==',
        //                     'value' => 'yes',
        //                 ]
        //             ],
        //         ],
        //     ]
        // );
        $this->add_control(
            'show_price',
            [
                'label' => esc_html__('Price?', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
            
        $this->add_control(
            'show_lessons',
            [
                'label' => esc_html__( 'Lessons?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_lessons_text',
            [
                'label' => esc_html__( 'Lessons Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_lessons' => 'yes',
                ]
            ]
        );

    if ( class_exists( 'SFWD_LMS' ) ) :

        $this->add_control(
            'show_topic',
            [
                'label' => esc_html__( 'Topic?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_topic_text',
            [
                'label' => esc_html__( 'Topic Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_topic' => 'yes',
                ]
            ]
        );

    endif;

    if ( class_exists( 'LearnPress' ) ) :

        $this->add_control(
            'show_enrolled',
            [
                'label' => esc_html__( 'Enrolled Students?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        
        $this->add_control(
            'show_enrolled_text',
            [
                'label' => esc_html__( 'Enrolled Students Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'    => [
                    'show_enrolled' => 'yes'
                ]
            ]
        );
    endif;

    //if ( class_exists( 'LearnPress' ) ) :

        $this->add_control(
            'show_quiz',
            [
                'label' => esc_html__( 'Quiz?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        
        $this->add_control(
            'show_quiz_text',
            [
                'label' => esc_html__( 'Quiz Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'condition'    => [
                    'show_quiz' => 'yes'
                ]
            ]
        );
        
   // endif;

        $this->add_control(
            'show_cat',
            [
                'label' => esc_html__( 'Category?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_wishlist',
            [
                'label' => esc_html__( 'Wishlist?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );    

        $this->add_control(
            'show_level',
            [
                'label' => esc_html__( 'Level?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_review',
            [
                'label' => esc_html__( 'Reviews?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
         
        $this->add_control(
            'show_review_text',
            [
                'label' => esc_html__( 'Reviews Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'    => [
                    'show_review' => 'yes'
                ]
            ]
        );
           
        $this->add_control(
            'show_author_img',
            [
                'label' => esc_html__( 'Author Image?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
               
        $this->add_control(
            'show_author_name',
            [
                'label' => esc_html__( 'Author Name?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
                 
        $this->add_control(
            'show_button',
            [
                'label' => esc_html__( 'See More Button?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

       $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );
       
        $this->end_controls_section();

        // ======= Pagination =====
        
        $this->start_controls_section(
        'pagination_section',
            [
                'label' => __( 'Pagination', 'edubin-core' ),
            ]
        );

        $this->add_control(
        'pagi_on_off',
            [
                'label' => esc_html__( 'Pagination', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        ); 
        $this->add_responsive_control(
        'pagi_align',
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
                // 'toggle'        => false,
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} nav.edubin-pagination-wrapper .page-number' => 'justify-content: {{VALUE}};',
                    ],
            ]
        );
        $this->add_control(
            'pagi_end_size',
            [
                'label' => __('End Size', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2,
            ]
        );  
        $this->add_control(
        'pagi_mid_size',
            [
                'label' => __('Mid Size', 'edubin-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );  

        $this->add_control(
        'pagi_show_all',
            [   
                'label' => esc_html__( 'Show All', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'edubin-core'),
                'label_on' => __('Yes', 'edubin-core'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->end_controls_section();

    }

    /**
     * return course featured image
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $image_id, $settings ) {
        $image_size = $settings['thumb_size_size'];
        if ( 'custom' === $image_size ) :
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumb_size', $settings );
        else :
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        endif;
        return $image_src;
    }

    /**
     * return number of courses to show for load more button
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function load_more_button_page_number( $settings ) {
        global $wp_query;
        $number_of_posts = $settings['per_page']['size'];
        return $wp_query->$number_of_posts;
    }

    /**
     * return grid columns
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function grid( $settings ) {
        if ( '5' === $settings['desktop_grid_columns'] ) :
            $grid_desktop_column = 'el-5';
        else :
            $grid_desktop_column = 12/$settings['desktop_grid_columns'];
        endif;
        $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
        $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
        $grid_column = 'edubin-col-lg-' . esc_attr( $grid_desktop_column ) . ' edubin-col-md-' . esc_attr( $grid_tablet_column ) . ' edubin-col-sm-' . esc_attr( $grid_mobile_column );

        return $grid_column;
    }

    /**
     * render slider settings
     *
     * @since 1.0.0
     *
     * @access protected
     */
 protected function slider( $settings ) {
        $direction  = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 'swiper', 'class', 'swiper-wrapper' );

        
        
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

        // if ( 'yes' === $settings['slautolay'] ) :
        //     $this->add_render_attribute( 'swiper', 'data-autoplay', 'true' );
        //     $this->add_render_attribute( 'swiper', 'data-autoplayspeed', intval( esc_attr( $settings['autoplay_speed'] ) ) );
        // endif;

        // if ( 'yes' === $settings['loop'] ) :
        //     $this->add_render_attribute( 'swiper', 'data-loop', 'true' );
        // endif;
    }

    /**
     * print jquery script for course filter
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_editor_script() { 
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($) {
                if ( $.isFunction( $.fn.isotope ) ) {
                    $( '.edubin-filter-type-cat-filter' ).each( function() {
                        let wrapper = $( this ).find( '.edubin-course-filter-type-cat-filter' ),
                        courseItem  = '#' + $(this).attr( 'id' );
                        wrapper.isotope( {
                            filter: '*',
                            animationOptions: {
                                queue: true
                            }
                        } );

                        $( courseItem + ' .edubin-category-controls-yes span' ).click(function(){
                            $( courseItem + ' .edubin-category-controls-yes span.current' ).removeClass( 'current' );
                            $(this).addClass( 'current' );
                     
                            let selector = $(this).attr( 'data-filter' );
                            wrapper.isotope( {
                                filter: selector,
                                animationOptions: {
                                    queue: true
                                }
                            } );
                            return false;
                        } );
                    } );
                }
            } );
        </script>
        <?php
    }
}
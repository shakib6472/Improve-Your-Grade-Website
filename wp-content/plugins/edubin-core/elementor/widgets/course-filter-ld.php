<?php

namespace EdubinCore\LD\Widgets;

use \Elementor\Controls_Manager;
use \Edubin\Filter;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; 
class Course_Filter extends Widget_Base {

    public function get_name() {
        return 'edubin-course-filter-ld';
    }
    public function get_title() {
        return __( 'Course Filter (LearnDash)', 'edubin-core' );
    }
    public function get_icon() {
        return 'edubin-elementor-icon eicon-filter';
    }
    public function get_keywords() {
        return [ 'edubin', 'ld', 'courses', 'course', 'lms', 'learndash','filter', 'Course filter', 'sidebar filter', 'filter sidebar', 'course category', 'course tag', 'course instructor', 'instructor', 'course level' ];
    }
    public function get_categories() {
        return [ 'edubin-core' ];
    }

    protected function _register_controls() {

    // =====  $filter_by ======

        $filter_by = apply_filters( 'edubin_course_filter_options', [
            'search'     => __( 'Search Field', 'edubin-core' ),
            'category'   => __( 'Category', 'edubin-core' ),
            'tags'       => __( 'Tags', 'edubin-core' ),
            'instructor' => __( 'Instructor', 'edubin-core' ),
            'languages'       => __( 'Languages', 'edubin-core' ),
            // 'lp_level'   => __( 'Level', 'edubin-core' ),
            // 'lp_price'   => __( 'Price', 'edubin-core' )
        ] );

        // ===== Course Filter======

        $this->start_controls_section(
            'course_query_section',
            [
                'label' => __( 'Course Query', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'grid_style',
            [
                'label'     => __( 'Grid Course Style', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => Filter::grid_layout()
            ]
        );

        $this->add_control(
            'list_style',
            [
                'label'     => __( 'List Course Style', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'list-01',
                'options'   => Filter::list_layout()
            ]
        );

        $this->add_control(
            'filter_options',
            [
                'label'         => __( 'Filter By', 'edubin-core' ),
                'label_block'   => true,
                'type'          => Controls_Manager::SELECT2,
                'default'       => [ 'search', 'category', 'tags', 'languages', 'instructor' ],
                'multiple'      => true,
                'options'       => $filter_by                   
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'     => __( 'Course Layout', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid-list',
                'options'   => [
                    'grid-list' => __( 'Grid & List', 'edubin-core' ),
                    'grid'      => __( 'Grid Only', 'edubin-core' ),
                    'list'      => __( 'List Only', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'default_layout',
            [
                'label'     => __( 'Active Layout', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'  => __( 'Grid', 'edubin-core' ),
                    'list'  => __( 'List', 'edubin-core' )
                ],
                'condition'        => [
                    'content_type' => 'grid-list'
                ]
            ]
        );

        $this->add_control(
            'filter_layout',
            [
                'label'     => __( 'Filter Position', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'filter-left-align',
                'options'   => [
                    'filter-left-align'  => __( 'Left', 'edubin-core' ),
                    'filter-right-align' => __( 'Right', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number of Courses', 'edubin-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Default courses 9. Put -1 for all available courses', 'edubin-core' ),
                'separator' => 'before',
                'default'       => [
                    'size'      => 9
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1
                    ]
                ]
            ]
        ); 

         $this->end_controls_section();

        // ======= Responsive =========

        $this->start_controls_section(
        'course_responsive_section',
            [
                'label' => __( 'Grid Columns', 'edubin-core' ),
            ]
        );
        $this->add_control(
            'large_desktop_grid_columns',
            [
                'label'       => __( 'Large Screen Columns', 'edubin-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 3,
                'description' => __( 'It will affect 1200px upper screen.', 'edubin-core' ),
                'options'     => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'desktop_grid_columns',
            [
                'label'       => __( 'Desktop Columns', 'edubin-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 2,
                'description' => __( 'It will affect 992px upper screen.', 'edubin-core' ),
                'options'     => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'tablet_grid_columns',
            [
                'label'        => __( 'Tablet Columns', 'edubin-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 2,
                'options'      => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' ),
                    '4' => __( '4 Columns', 'edubin-core' ),
                    '6' => __( '6 Columns', 'edubin-core' )
                ],
                'description'  => __( 'It will affect up to 992px screen', 'edubin-core' )
            ]
        );

        $this->add_control(
            'mobile_grid_columns',
            [
                'label'        => __( 'Mobile Columns', 'edubin-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 2,
                'options'      => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' ),
                    '4' => __( '4 Columns', 'edubin-core' ),
                    '6' => __( '6 Columns', 'edubin-core' )
                ],
                'description'  => __( 'It will affect between 768 to 576px.', 'edubin-core' )
            ]
        );
        
        $this->add_control(
            'enable_masonry',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Masonry Layout', 'edubin-core' ),
                'default'      => 'no',
                'description'   =>  __( 'The Masonry will be working on preview mode only.', 'edubin-core' ),
                'return_value' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

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

        $this->add_control(
            'excerpt_end',
            [
                'label'       => __( 'Excerpt End Text', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '...',
                'separator' => 'before',
                // 'condition' => [
                //     'show_excerpt' => 'yes',
                //     'show_excerpt_list' => 'yes',
                // ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'show_excerpt',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'show_excerpt_list',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );
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
                'default' => '',
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
        // ======= List Layouts ======
        $this->add_control(
            'course_list_layout_title',
            [
                'label' => esc_html__( 'Course List Layout', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_excerpt_list',
            [
                'label' => esc_html__('Excerpt?', 'edubin-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_length_list',
            [
                'label'       => __( 'Number of Excerpt Words', 'edubin-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 25,
                'condition'   => [
                    'show_excerpt_list' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_cat_list',
            [
                'label' => esc_html__( 'Category?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_wishlist_list',
            [
                'label' => esc_html__( 'Wishlist?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_review_list',
            [
                'label' => esc_html__( 'Reviews?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
         
        $this->add_control(
            'show_review_list_text',
            [
                'label' => esc_html__( 'Reviews?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'    => [
                    'show_review_list' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'show_lessons_list',
            [
                'label' => esc_html__( 'Lessons?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_lessons_text_list',
            [
                'label' => esc_html__( 'Lessons Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_lessons_list' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'show_topic_list',
            [
                'label' => esc_html__( 'Topic?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_topic_text_list',
            [
                'label' => esc_html__( 'Topic Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_topic_list' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'show_quiz_list',
            [
                'label' => esc_html__( 'Quiz?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        
        $this->add_control(
            'show_quiz_text_list',
            [
                'label' => esc_html__( 'Quiz Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
                'condition'    => [
                    'show_quiz_list' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

       // ===== Course Filter =====

        $this->start_controls_section(
            'filter_section',
            [
                'label' => __( 'Course Filter', 'edubin-core' )
            ]
        );

        $this->add_control(
            'default_scroll_animation',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Default Scroll Animation', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );
        $this->add_control(
            'filter_resposnive_status',
            [
                'label'          => __( 'Toggle Filter at Small Device?', 'edubin-core' ),
                'type'           => Controls_Manager::SWITCHER,    
                'default'        => 'yes',
                'return_value'   => 'yes',
                'description'    => __( 'It will affect below 992px.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'enable_ordering',
            [
                'label'        => __( 'Ordering', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'default'      => 'yes',
                'return_value' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'order_default_text',
            [
                'type'                => Controls_Manager::TEXT,
                'label'               => __( 'Order Default Text', 'edubin-core' ),
                'default'             => __( 'Filters', 'edubin-core' ),
                'condition'           => [
                    'enable_ordering' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'enable_found_text',
            [
                'label'        => __( 'Course Found Text', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'found_text_type',
            [
                'label'         => __( 'Found Text Type', 'edubin-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'default',
                'options'       => [
                    'default'   => __( 'Default', 'edubin-core' ),
                    'alter'     => __( 'Alter', 'edubin-core' ),
                    'secondary' => __( 'Secondary', 'edubin-core' )
                ],
                'condition'     => [
                    'enable_found_text' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'search_placeholder_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Search Placeholder Text', 'edubin-core' ),
                'default'            => __( 'Search Courses...', 'edubin-core' ),
                'condition'          => [
                    'filter_options' => 'search'
                ]
            ]
        );

        $this->add_control(
            'category_label_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Category Label Text', 'edubin-core' ),
                'default'            => __( 'Categories', 'edubin-core' ),
                'condition'          => [
                    'filter_options' => 'category'
                ]
            ]
        );

        $this->add_control(
            'category_number',
            [
                'label'              => __( 'Number of Categories', 'edubin-core' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 0,
                'description'        => __( 'The value of 0 is used by default to display all categories.', 'edubin-core' ),
                'condition'          => [
                    'filter_options' => 'category'
                ]
            ]
        );

        $this->add_control(
            'tags_label_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Tags Label Text', 'edubin-core' ),
                'default'            => __( 'Tags', 'edubin-core' ),
                'separator' => 'before',
                'condition'          => [
                    'filter_options' => 'tags'
                ]
            ]
        );

        $this->add_control(
            'languages_label_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Languages Label Text', 'edubin-core' ),
                'default'            => __( 'Languages', 'edubin-core' ),
                'separator' => 'before',
                'condition'          => [
                    'filter_options' => 'languages'
                ]
            ]
        );

        $this->add_control(
            'instructor_label_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Instructor Label Text', 'edubin-core' ),
                'default'            => __( 'Instructor', 'edubin-core' ),
                'separator' => 'before',
                'condition'          => [
                    'filter_options' => 'instructor'
                ]
            ]
        );

        // $this->add_control(
        //     'price_label_text',
        //     [
        //         'type'               => Controls_Manager::TEXT,
        //         'label'              => __( 'Price Label Text', 'edubin-core' ),
        //         'default'            => __( 'Price', 'edubin-core' ),
        //         'separator' => 'before',
        //         'condition'          => [
        //             'filter_options' => 'ld_price'
        //         ]
        //     ]
        // );

        // $this->add_control(
        //     'level_label_text',
        //     [
        //         'type'               => Controls_Manager::TEXT,
        //         'label'              => __( 'Level Label Text', 'edubin-core' ),
        //         'default'            => __( 'Level', 'edubin-core' ),
        //         'separator' => 'before',
        //         'condition'          => [
        //             'filter_options' => 'ld_level'
        //         ]
        //     ]
        // );

        $this->add_control(
            'grid_filter_text',
            [
                'type'             => Controls_Manager::TEXT,
                'label'            => __( 'Grid Filter Text', 'edubin-core' ),
                'default'          => __( 'Grid', 'edubin-core' ),
                'condition'        => [
                    'content_type' => 'grid-list'
                ]
            ]
        );

        $this->add_control(
            'list_filter_text',
            [
                'type'      => Controls_Manager::TEXT,
                'label'     => __( 'List Filter Text', 'edubin-core' ),
                'default'   => __( 'List', 'edubin-core' ),
                'condition' => [
                    'content_type' => 'grid-list'
                ]
            ]
        );

        $this->add_control(
            'filter_resposnive_toggle_text',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => __( 'Filter Toggle Text', 'edubin-core' ),
                'default'     => __( 'Filter Sidebar', 'edubin-core' ),
                'description' => __( 'This value will be shown for toggle the sidebar filter when the screen width is below 992px.', 'edubin-core' ),
                'condition'   => [
                    'filter_resposnive_status' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'no_course_found_text',
            [
                'label'       => __( 'No Course Found Text', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Sorry, No Course Found.', 'edubin-core' ),
                'description' => __( 'This text will be shown if wishlist is empty.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'reset_filter_button',
            [
                'label'      => __( 'Reset Filter Button', 'edubin-core' ),
                'type'       => Controls_Manager::TEXT,
                'separator' => 'before',
                'default'    => __( 'Reset Filter', 'edubin-core' )
            ]
        );
        
        $this->end_controls_section();

       // ===== Pagination =====

        $this->start_controls_section(
            'pagination_section',
            [
                'label' => __( 'Pagination', 'edubin-core' )
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'        => __( 'Pagination', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'default'      => 'yes',
                'return_value' => 'yes'
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
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .edubin-pagination-wrapper .page-number' => 'justify-content: {{VALUE}};',
                ],
                'condition'      => [
                    'pagination' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pagination_show_all',
            [
                'label'          => __( 'Show All?', 'edubin-core' ),
                'type'           => Controls_Manager::SWITCHER,    
                'default'        => 'no',
                'return_value'   => 'yes',
                'description'    => __( 'By default, disable. Whether to show all pages.', 'edubin-core' ),
                'condition'      => [
                    'pagination' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pagination_end_size',
            [
                'label'          => __( 'End Size?', 'edubin-core' ),
                'type'           => Controls_Manager::NUMBER,
                'default'        => 1,
                'description'    => __( 'By Default 1. The amount of numbers on the margins of the start and finish lists.', 'edubin-core' ),
                'condition'      => [
                    'pagination' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pagination_mid_size',
            [
                'label'          => __( 'Mid Size?', 'edubin-core' ),
                'type'           => Controls_Manager::NUMBER,
                'default'        => 2,
                'description'    => __( 'By Default 2. Numbers to either side of the pages that are currently displayed.', 'edubin-core' ),
                'condition'      => [
                    'pagination' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $settings['course_cpt'] = 'sfwd-courses'; 

        // Initialize filtered categories, tags & levels as empty arrays
        $filtered_category = ! empty( $_GET['course_cats'] ) ? ( array ) $_GET['course_cats'] : array();
        $filtered_category = array_map( 'sanitize_text_field', $filtered_category );
        $filtered_category = array_map( 'intval', $filtered_category );

        $filtered_tags = ! empty( $_GET['course_tags'] ) ? ( array ) $_GET['course_tags'] : array();
        $filtered_tags = array_map( 'sanitize_text_field', $filtered_tags );
        $filtered_tags = array_map( 'intval', $filtered_tags );
        
        $filtered_languages = ! empty( $_GET['course_languages'] ) ? ( array ) $_GET['course_languages'] : array();
        $filtered_languages = array_map( 'sanitize_text_field', $filtered_languages );
        $filtered_languages = array_map( 'intval', $filtered_languages );
        
        $filtered_level = ! empty( $_GET['course_level'] ) ? ( array ) $_GET['course_level'] : array( 'all_levels' );
        $filtered_level = array_map( 'sanitize_text_field', $filtered_level );

        $filtered_instructor = ! empty( $_GET['course_instructor'] ) ? ( array ) $_GET['course_instructor'] : array();
        $filtered_instructor = array_map( 'sanitize_text_field', $filtered_instructor );

        $search_value = ! empty( $_GET['course_search'] ) ? $_GET['course_search'] : '';

        if ( isset( $wp_query->queried_object->term_id ) ) :
            $filtered_category = array( $wp_query->queried_object->term_id );
        endif;

        $course_ordering = apply_filters( 'edubin_course_order_default', 'default' );
        if ( isset( $_GET['course_serialize'] ) && ! empty( $_GET['course_serialize'] ) ) :
            $course_ordering = wp_unslash( $_GET['course_serialize'] );
        endif;
        
        // Handle the reset button for category, tags, search value & course ordering
        if ( isset( $_GET['reset'] ) ) :
            $filtered_category = array();
            $filtered_tags = array();
            $filtered_languages = array();
            $filtered_instructor = array();
            $search_value = '';
            $course_ordering = 'newest_first';
        endif;

        $search_placeholder_text = $category_label_text = '';
        $category_number = 0;

        if ( in_array( 'search', $settings['filter_options'] ) ) :
            $search_placeholder_text = $settings['search_placeholder_text'];
            $settings['search_value'] = $search_value;
            $settings['search_placeholder_text'] = $search_placeholder_text;
        endif;

        if ( in_array( 'category', $settings['filter_options'] ) ) :
            $category_label_text = $settings['category_label_text'];
            $category_number = $settings['category_number'];
            $settings['category_number'] = $category_number;
            $settings['filtered_category'] = $filtered_category;
            $settings['course_category'] = 'ld_course_category';
            $settings['course_cats'] = 'course_cats';
            $settings['category_label_text'] = $category_label_text;
        endif;

        if ( in_array( 'tags', $settings['filter_options'] ) ) :
            $tags_label_text = $settings['tags_label_text'];
            $settings['tags_label_text'] = $tags_label_text;
            $settings['filtered_tags'] = $filtered_tags;
            $settings['course_tag'] = 'ld_course_tag';
            $settings['course_tags'] = 'course_tags';
        endif;

        if ( in_array( 'languages', $settings['filter_options'] ) ) :
            $languages_label_text = $settings['languages_label_text'];
            $settings['languages_label_text'] = $languages_label_text;
            $settings['filtered_languages'] = $filtered_languages;
            $settings['course_language'] = 'ld_course_language';
            $settings['course_languages'] = 'course_languages';
        endif;

        if ( in_array( 'instructor', $settings['filter_options'] ) ) :
            $instructor_label_text = $settings['instructor_label_text'];
            $settings['instructor_label_text'] = $instructor_label_text;
            $settings['filtered_instructor'] = $filtered_instructor;
        endif;

        $settings['orderby_types'] = apply_filters( 'edubin_courses_orderby', array(
            'newest_first'    => __( 'Newest', 'edubin-core' ),
            'oldest_first'    => __( 'Oldest', 'edubin-core' ),
            'course_title_az' => __( 'Course Title (a-z)', 'edubin-core' ),
            'course_title_za' => __( 'Course Title (z-a)', 'edubin-core' )
        ) );

        $this->add_render_attribute( 'wrapper', 'class', 'edubin-row' );
        $this->add_render_attribute( 'wrapper', 'class', esc_attr( $settings['filter_layout'] ) );
        $this->add_render_attribute( 'wrapper', 'class', 'content-layout-type-' . esc_attr( $settings['content_type'] ) );
        if ( 'yes' === $settings['filter_resposnive_status'] ) :
            $this->add_render_attribute( 'wrapper', 'class', 'tpc-sidebar-toggle-activated' );
        endif;
        $this->add_render_attribute( 'grid', 'class', 'edubin-row' );
        $this->add_render_attribute( 'list', 'class', 'edubin-row' );

        if ( 'list' !== $settings['content_type'] ) :
            $this->add_render_attribute( 'grid_single', 'class', esc_attr( Filter::column( $settings ) ) );

            if ( 'yes' === $settings['enable_masonry'] ) :
                $this->add_render_attribute( 'grid', 'class', 'tpc-masonry-grid-wrapper' );
                $this->add_render_attribute( 'grid_single', 'class', 'tpc-masonry-item' );
            endif;
        endif;

        if ( 'grid' !== $settings['content_type'] ) :
            $this->add_render_attribute( 'list_single', 'class', 'edubin-col-lg-12' );
        endif;

        $settings['course_ordering'] = $course_ordering;
        $args = Filter::query( $filtered_category, $filtered_tags, $filtered_languages, $settings );

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;
        $args['posts_per_page'] = $settings['per_page']['size'] ? $settings['per_page']['size'] : -1;
        $args['paged'] = $paged;

        if ( 'yes' === $settings['filter_resposnive_status'] ) :
            echo '<div class="edubin-filter-active-overlay"></div>';
        endif;

        echo '<div class="edubin-course-filter-sidebar">';
            echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
                Filter::sidebar( $settings );
                echo '<div class="edubin-col-lg-9 filter-course-column">';
                    echo '<div class="filtered-courses">';
                        $args = apply_filters( 'edubin_ld_course_filter_args', $args );
                        $query = new \WP_Query( $args );

                        if ( $query->have_posts() ) :
                            $args = [];

                            $args['enable_excerpt'] = true;

                            if ( $settings['excerpt_end'] ) :
                                $args['excerpt_end'] = $settings['excerpt_end'];
                            endif;

                            if ( $settings['show_excerpt'] ) :
                                 $args['show_excerpt'] = $settings['show_excerpt'];
                            endif;

                            if ( $settings['grid_excerpt_length'] ) :
                                 $args['excerpt_length'] = $settings['grid_excerpt_length'];
                            endif;

                            $animation_attribute = '';
                            if ( 'yes' === $settings['default_scroll_animation'] ) :
                                $animation_attribute = ' data-sal';
                            endif;


                            if ( $settings['button_text'] ) :
                                $args['button_text'] = $settings['button_text'];
                            endif;

                            if ( $settings['show_button'] ) :
                                $args['show_button'] = $settings['show_button'];
                            endif;

                            if ( $settings['show_title'] ) :
                                $args['show_title'] = $settings['show_title'];
                            endif;
      
                            if ( $settings['show_media'] ) :
                                $args['show_media'] = $settings['show_media'];
                            endif;

                            if ( $settings['show_intor_video'] ) :
                                $args['show_intor_video'] = $settings['show_intor_video'];
                            endif;

                            if ( $settings['show_price'] ) :
                                $args['show_price'] = $settings['show_price'];
                            endif;
 
                            if ( $settings['show_lessons'] ) :
                                $args['show_lessons'] = $settings['show_lessons'];
                            endif;

                            if ( $settings['show_lessons_text'] ) :
                                $args['show_lessons_text'] = $settings['show_lessons_text'];
                            endif;
 
                            if ( $settings['show_topic'] ) :
                                $args['show_topic'] = $settings['show_topic'];
                            endif;

                            if ( $settings['show_topic_text'] ) :
                                $args['show_topic_text'] = $settings['show_topic_text'];
                            endif;

                            if ( $settings['show_quiz'] ) :
                                $args['show_quiz'] = $settings['show_quiz'];
                            endif;

                            if ( $settings['show_quiz_text'] ) :
                                $args['show_quiz_text'] = $settings['show_quiz_text'];
                            endif;

                            if ( $settings['show_cat'] ) :
                                $args['show_cat'] = $settings['show_cat'];
                            endif;

                           if ( $settings['show_wishlist'] ) :
                                $args['show_wishlist'] = $settings['show_wishlist'];
                            endif;
                        
                           if ( $settings['show_level'] ) :
                                $args['show_level'] = $settings['show_level'];
                            endif;
                        
                           if ( $settings['show_review'] ) :
                                $args['show_review'] = $settings['show_review'];
                            endif;
                        
                           if ( $settings['show_review_text'] ) :
                                $args['show_review_text'] = $settings['show_review_text'];
                            endif;
                        
                           if ( $settings['show_author_img'] ) :
                                $args['show_author_img'] = $settings['show_author_img'];
                            endif;
                        
                           if ( $settings['show_author_name'] ) :
                                $args['show_author_name'] = $settings['show_author_name'];
                            endif;

                            Filter::top_filter( $settings, $query );

                            if ( 'list' !== $settings['content_type'] ) :
                                $this->add_render_attribute( 'grid', 'class', 'display-layout-grid edubin-course-archive' );
                                if( 'grid' === $settings['content_type'] ) :
                                    $this->add_render_attribute( 'grid', 'class', 'active' );
                                elseif( 'grid-list' === $settings['content_type'] && 'grid' === $settings['default_layout'] ) :
                                    $this->add_render_attribute( 'grid', 'class', 'active' );
                                endif;

                                echo '<div ' . $this->get_render_attribute_string( 'grid' ) . '>';
                                    while ( $query->have_posts() ) : $query->the_post();
                                        global $post; 
                                        $thumb_url = '';
                                        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                                            $thumb_url = Filter::render_image( get_post_thumbnail_id( $post->ID ), $settings );
                                        else :
                                            $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
                                        endif;
                                        $args['thumb_url'] = $thumb_url;
                                        
                                        echo '<div ' . $this->get_render_attribute_string( 'grid_single' ) . '>';
                                            $args['style'] = $settings['grid_style'];
                                            // if ( $settings['grid_excerpt_length'] ) :
                                            //     $args['excerpt_length'] = $settings['grid_excerpt_length'];
                                            // endif;
                                            $post_class = 'edubin-course-style-' . esc_attr( $settings['grid_style'] );
                                        ?>
                                            <div id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>  <?php echo esc_attr( $animation_attribute ); ?>>
                                            <?php
                                                include ( locate_template( 'learndash/tpl-part/course/el-layouts.php', false, false, compact( 'args' ) ) ); 
                                            echo '</div>';  
                                        echo '</div>';  
                                    endwhile;
                                    wp_reset_postdata();
                                    wp_reset_query();
                                echo '</div>';  
                            endif;

                            if ( 'grid' !== $settings['content_type'] ) :
                                $this->add_render_attribute( 'list', 'class', 'display-layout-list' );
                                $this->add_render_attribute( 'list', 'class', 'course-list-style-' . esc_attr( $settings['list_style'] ) );
                                if( 'list' === $settings['content_type'] ) :
                                    $this->add_render_attribute( 'list', 'class', 'active' );
                                elseif( 'grid-list' === $settings['content_type'] && 'list' === $settings['default_layout'] ) :
                                    $this->add_render_attribute( 'list', 'class', 'active' );
                                endif;

                                echo '<div ' . $this->get_render_attribute_string( 'list' ) . '>';
                                    while ( $query->have_posts() ) : $query->the_post();
                                        global $post; 
                                        $thumb_url = '';
                                        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                                            $thumb_url = Filter::render_image( get_post_thumbnail_id( $post->ID ), $settings );
                                        else :
                                            $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
                                        endif;
                                        $args['thumb_url'] = $thumb_url;

                                        echo '<div ' . $this->get_render_attribute_string( 'list_single' ) . '>';
                                        
                                            // ===== List Layout =====

                                            if ( $settings['show_wishlist_list'] ) :
                                                $args['show_wishlist_list'] = $settings['show_wishlist_list'];
                                            endif;
                                                                    
                                            if ( $settings['show_excerpt_list'] ) :
                                                 $args['show_excerpt_list'] = $settings['show_excerpt_list'];
                                            endif;
                        
                                            if ( $settings['excerpt_length_list'] ) :
                                                 $args['excerpt_length_list'] = $settings['excerpt_length_list'];
                                            endif;

                                            if ( $settings['show_cat_list'] ) :
                                                $args['show_cat_list'] = $settings['show_cat_list'];
                                            endif;

                                            if ( $settings['show_lessons_list'] ) :
                                                $args['show_lessons_list'] = $settings['show_lessons_list'];
                                            endif;

                                            if ( $settings['show_lessons_text_list'] ) :
                                                $args['show_lessons_text_list'] = $settings['show_lessons_text_list'];
                                            endif;

                                            if ( $settings['show_topic_list'] ) :
                                                $args['show_topic_list'] = $settings['show_topic_list'];
                                            endif;

                                            if ( $settings['show_topic_text_list'] ) :
                                                $args['show_topic_text_list'] = $settings['show_topic_text_list'];
                                            endif;

                                            if ( $settings['show_quiz_list'] ) :
                                                $args['show_quiz_list'] = $settings['show_quiz_list'];
                                            endif;

                                            if ( $settings['show_quiz_text_list'] ) :
                                                $args['show_quiz_text_list'] = $settings['show_quiz_text_list'];
                                            endif;
                                            if ( $settings['show_review_list'] ) :
                                                $args['show_review_list'] = $settings['show_review_list'];
                                            endif;
                                
                                            if ( $settings['show_review_list_text'] ) :
                                                $args['show_review_list_text'] = $settings['show_review_list_text'];
                                            endif;
                                            
                                            $args['style'] = $settings['list_style'];

                                            // if ( $settings['list_excerpt_length'] ) :
                                            //     $args['excerpt_length'] = $settings['list_excerpt_length'];
                                            // endif;
                                        ?>
                                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>  <?php echo esc_attr( $animation_attribute ); ?>>
                                            <?php
                                                include ( locate_template( 'learndash/tpl-part/course/el-layouts.php', false, false, compact( 'args' ) ) ); 
                                            echo '</div>';  
                                        echo '</div>';  
                                    endwhile;
                                    wp_reset_postdata();
                                    wp_reset_query();
                                echo '</div>';  
                            endif;
                            Filter::pagination( $query, $settings );
                        else :
                            echo '<h3 class="no-course-found filter-course">' . esc_html( $settings['no_course_found_text'] ). '</h3>';
                        endif;
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    } 
} 

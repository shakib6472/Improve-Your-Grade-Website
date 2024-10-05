<?php

namespace EdubinCore\TL\Widgets;

use \Elementor\Controls_Manager;
use \Edubin\Filter;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Course_Filter extends Widget_Base {

    public function get_name() {
        return 'edubin-course-filter-tutor';
    }

    public function get_title() {
        return __( 'Course Filter Sidebar(Tutor LMS)', 'edubin-core' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-filter';
    }

	public function get_keywords() {
		return [ 'edubin', 'query', 'courses', 'lms', 'lp', 'tutor lms', 'archive', 'loop','filter', 'sidebar filter', 'filter sidebar' ];
	}

    public function get_categories() {
        return [ 'edubin-core' ];
    }

    // =========== Register Controls ===========
    protected function _register_controls() {
        $filter_options = apply_filters( 'edubin_course_filter_options', [
            'search'     => __( 'Search Field', 'edubin-core' ),
            'category'   => __( 'Category', 'edubin-core' ),
            'tags'       => __( 'Tags', 'edubin-core' ),
            'tl_level'   => __( 'Level', 'edubin-core' ),
            'tl_price'   => __( 'Price', 'edubin-core' ),
            'languages' => __( 'Languages', 'edubin-core' ),
            'instructor' => __( 'Instructor', 'edubin-core' )
        ] );

        $this->start_controls_section(
            'filter_section',
            [
                'label' => __( 'Course Filter', 'edubin-core' )
            ]
        );

        $this->add_control(
            'filter_options',
            [
                'label'         => __( 'Filter Options', 'edubin-core' ),
                'label_block'   => true,
                'type'          => Controls_Manager::SELECT2,
                'default'       => [ 'category', 'tags', 'languages' ],
                'multiple'      => true,
                'options'       => $filter_options                   
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'     => __( 'Content Type', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid-list',
                'options'   => [
                    'grid-list' => __( 'Grid & List Both', 'edubin-core' ),
                    'grid'      => __( 'Grid Only', 'edubin-core' ),
                    'list'      => __( 'List Only', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'default_layout',
            [
                'label'     => __( 'Default Active Layout', 'edubin-core' ),
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
                'label'     => __( 'Filter Layout', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'filter-left-align',
                'options'   => [
                    'filter-left-align'  => __( 'Filter Left Side', 'edubin-core' ),
                    'filter-right-align' => __( 'Filter Right Side', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'enable_ordering',
            [
                'label'        => __( 'Ordering', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
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
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
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
                'condition'          => [
                    'filter_options' => 'instructor'
                ]
            ]
        );

        $this->add_control(
            'price_label_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Price Label Text', 'edubin-core' ),
                'default'            => __( 'Price', 'edubin-core' ),
                'condition'          => [
                    'filter_options' => 'tl_price'
                ]
            ]
        );

        $this->add_control(
            'level_label_text',
            [
                'type'               => Controls_Manager::TEXT,
                'label'              => __( 'Level Label Text', 'edubin-core' ),
                'default'            => __( 'Level', 'edubin-core' ),
                'condition'          => [
                    'filter_options' => 'tl_level'
                ]
            ]
        );

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
            'filter_resposnive_status',
            [
                'label'          => __( 'Enable Sidebar Filter Toggle at Small Device?', 'edubin-core' ),
                'type'           => Controls_Manager::SWITCHER,    
                'label_on'       => __( 'Enable', 'edubin-core' ),
                'label_off'      => __( 'Disable', 'edubin-core' ),
                'default'        => 'yes',
                'return_value'   => 'yes',
                'description'    => __( 'Enabling this option activates the sidebar filter via a toggle button when the screen width is below 992px.', 'edubin-core' )
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_courses',
            [
                'label' => __( 'Courses', 'edubin-core' )
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number Of Courses', 'edubin-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'By default has 9 courses. Put -1 for all available courses.', 'edubin-core' ),
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

        // $this->add_group_control(
        //     Group_Control_Image_Size::get_type(),
        //     [
        //         'name'      => 'thumb_size',
        //         'default'   => 'edubin-post-thumb'
        //     ]
        // );

        // $this->add_control(
        //     'excerpt_end',
        //     [
        //         'label'       => __( 'Excerpt End Text', 'edubin-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'default'     => '...',
        //     ]
        // );

        $this->add_control(
            'no_course_found_text',
            [
                'label'       => __( 'No Course Found Text', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Sorry, No Course Found.', 'edubin-core' ),
                'description' => __( 'This text will be shown if wishlist is empty.', 'edubin-core' )
            ]
        );

        // $this->add_control(
        //     'button_text',
        //     [
        //         'label'       => __( 'Button Text', 'edubin-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'label_block' => false
        //     ]
        // );

        $this->add_control(
            'default_scroll_animation',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Default Scroll Animation', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'grid_layout',
            [
                'label'     => __( 'Grid Layout', 'edubin-core' ),
                'condition' => [
                    'content_type!' => 'list'
                ]
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

        // $this->add_control(
        //     'grid_excerpt_length',
        //     [
        //         'label'       => __( 'Number of Words', 'edubin-core' ),
        //         'type'        => Controls_Manager::NUMBER,
        //         'default'     => 20,
        //         'description' => __( 'Number of excerpt words.', 'edubin-core' )
        //     ]
        // );

        $this->add_control(
            'enable_masonry',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Masonry Layout', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'container_alert_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( 'The Masonry will be working on preview mode only.', 'edubin-core' ),
                'content_classes' => 'edubin-elementor-widget-alert elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                    'enable_masonry' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'large_desktop_grid_columns',
            [
                'label'       => __( 'Large Desktop Columns', 'edubin-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 3,
                'description' => __( 'Only for grid layout and required a width of minimum 1200px.', 'edubin-core' ),
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
                'description' => __( 'Only for grid layout and required a width of minimum 992px.', 'edubin-core' ),
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
                'description'  => __( 'Number of columns in tablet( up to 992 px ) and only applicable for Grid layout.', 'edubin-core' )
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

        $this->end_controls_section();

        $this->start_controls_section(
            'list_layout',
            [
                'label'     => __( 'List Layout', 'edubin-core' ),
                'condition' => [
                    'content_type!' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'list_style',
            [
                'label'     => __( 'Grid Course Style', 'edubin-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'list-01',
                'options'   => Filter::list_layout()
            ]
        );

        $this->add_control(
            'list_excerpt_length',
            [
                'label'       => __( 'Number of Words', 'edubin-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 200,
                'description' => __( 'Number of excerpt words.', 'edubin-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => __( 'Button', 'edubin-core' )
            ]
        );

        $this->add_control(
            'apply_filter_button',
            [
                'label'      => __( 'Apply Filter Button', 'edubin-core' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => __( 'Apply Filter', 'edubin-core' )
            ]
        );

        $this->add_control(
            'reset_filter_button',
            [
                'label'      => __( 'Reset Filter Button', 'edubin-core' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => __( 'Reset Filter', 'edubin-core' )
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
            'show_enrolled',
            [
                'label' => esc_html__( 'Enrolled?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        
        $this->add_control(
            'show_enrolled_text',
            [
                'label' => esc_html__( 'Enrolled Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_enrolled' => 'yes',
                ]
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
        // $this->add_control(
        //     'show_topic',
        //     [
        //         'label' => esc_html__( 'Topic?', 'edubin-core' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //     ]
        // );
        
        // $this->add_control(
        //     'show_topic_text',
        //     [
        //         'label' => esc_html__( 'Topic Text?', 'edubin-core' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //         'condition' => [
        //             'show_topic' => 'yes',
        //         ]
        //     ]
        // );

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
                'default' => 'yes',
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
                'label'       => __( 'Button Text Here', 'edubin-core' ),
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
                'label' => esc_html__( 'Reviews Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition'    => [
                    'show_review_list' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'show_enrolled_list',
            [
                'label' => esc_html__( 'Enrolled Students?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_enrolled_text_list',
            [
                'label' => esc_html__( 'Students Text?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_enrolled_list' => 'yes',
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

        // $this->add_control(
        //     'show_topic_list',
        //     [
        //         'label' => esc_html__( 'Topic?', 'edubin-core' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //     ]
        // );
        
        // $this->add_control(
        //     'show_topic_text_list',
        //     [
        //         'label' => esc_html__( 'Topic Text?', 'edubin-core' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //         'condition' => [
        //             'show_topic_list' => 'yes',
        //         ]
        //     ]
        // );

        $this->add_control(
            'show_quiz_list',
            [
                'label' => esc_html__( 'Quiz?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
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
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'pagination_show_all',
            [
                'label'          => __( 'Show All?', 'edubin-core' ),
                'type'           => Controls_Manager::SWITCHER,    
                'label_on'       => __( 'Enable', 'edubin-core' ),
                'label_off'      => __( 'Disable', 'edubin-core' ),
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

    // =========== Render ===========
    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $settings['course_cpt'] = 'courses'; 

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

        $filtered_level = ! empty( $_GET['course_level'] ) ? ( array ) $_GET['course_level'] : array();
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
            $filtered_instructor = array();
            $filtered_languages = array();
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
            $settings['course_category'] = 'course-category';
            $settings['course_cats'] = 'course_cats';
            $settings['category_label_text'] = $category_label_text;
        endif;

        if ( in_array( 'tags', $settings['filter_options'] ) ) :
            $tags_label_text = $settings['tags_label_text'];
            $settings['tags_label_text'] = $tags_label_text;
            $settings['filtered_tags'] = $filtered_tags;
            $settings['course_tag'] = 'course-tag';
            $settings['course_tags'] = 'course_tags';
        endif;

        if ( in_array( 'languages', $settings['filter_options'] ) ) :
            $languages_label_text = $settings['languages_label_text'];
            $settings['languages_label_text'] = $languages_label_text;
            $settings['filtered_languages'] = $filtered_languages;
            $settings['course_language'] = 'tutor_course_language';
            $settings['course_languages'] = 'course_languages';
        endif;

        if ( in_array( 'instructor', $settings['filter_options'] ) ) :
            $instructor_label_text = $settings['instructor_label_text'];
            $settings['instructor_label_text'] = $instructor_label_text;
            $settings['filtered_instructor'] = $filtered_instructor;
        endif;

        if ( in_array( 'tl_price', $settings['filter_options'] ) ) :
            $price_label_text = $settings['price_label_text'];
            $settings['price_label_text'] = $price_label_text;
        endif;

        if ( in_array( 'tl_level', $settings['filter_options'] ) ) :
            $level_label_text = $settings['level_label_text'];
            $settings['filtered_level'] = $filtered_level;
            $settings['level_label_text'] = $level_label_text;
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
        $get_options['posts_per_page'] = $settings['per_page']['size'] ? $settings['per_page']['size'] : -1;
        $get_options['paged'] = $paged;

        if ( 'yes' === $settings['filter_resposnive_status'] ) :
            echo '<div class="edubin-filter-active-overlay"></div>';
        endif;

        echo '<div class="edubin-course-filter-sidebar">';
            echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
                Filter::sidebar( $settings );
                echo '<div class="edubin-col-lg-9 filter-course-column">';
                    echo '<div class="filtered-courses">';
                        if ( ! empty( $filtered_level ) && in_array( 'tl_level', $settings['filter_options'] ) ) :
                            $get_options['meta_query'][] = array(
                                'key'     => '_tutor_course_level',
                                'value'   => $filtered_level,
                                'compare' => 'IN'
                            );
                        endif;

                        if ( ( isset( $_GET['course_price'] ) && ( 'free' === $_GET['course_price'] ) ) && ! isset( $_GET['reset'] ) && in_array( 'tl_price', $settings['filter_options'] ) ) :
                            $get_options['meta_query'][] = array(
                                'key'     => '_tutor_course_product_id',
                                'compare' => 'NOT EXISTS',
                            );
                        elseif ( ( isset( $_GET['course_price'] ) && ( 'paid' === $_GET['course_price'] ) ) && ! isset( $_GET['reset'] ) && in_array( 'tl_price', $settings['filter_options'] ) ) :
                            $get_options['meta_query'][] = array(
                                'key'     => '_tutor_course_product_id',
                                'compare' => 'EXISTS',
                            );
                        endif;

                        $args = apply_filters( 'edubin_tl_course_filter_args', $args );
                        $query = new \WP_Query( $args );

                        if ( $query->have_posts() ) :
                            $get_options = [];
                            $get_options['enable_excerpt'] = true;

                            if ( $settings['excerpt_end'] ) :
                                $get_options['excerpt_end'] = $settings['excerpt_end'];
                            endif;
        
                            if ( $settings['button_text'] ) :
                                $get_options['button_text'] = $settings['button_text'];
                            endif;
            
                            $animation_attribute = '';
                            if ( 'yes' === $settings['default_scroll_animation'] ) :
                                $animation_attribute = ' data-sal';
                            endif;





                            $get_options['enable_excerpt'] = true;

                            if ( $settings['excerpt_end'] ) :
                                $get_options['excerpt_end'] = $settings['excerpt_end'];
                            endif;

                            if ( $settings['show_excerpt'] ) :
                                 $get_options['show_excerpt'] = $settings['show_excerpt'];
                            endif;

                            if ( $settings['grid_excerpt_length'] ) :
                                 $get_options['excerpt_length'] = $settings['grid_excerpt_length'];
                            endif;

                            $animation_attribute = '';
                            if ( 'yes' === $settings['default_scroll_animation'] ) :
                                $animation_attribute = ' data-sal';
                            endif;


                            if ( $settings['thumb_size_size'] ) :
                                $get_options['thumb_size_size'] = $settings['thumb_size_size'];
                            endif;

                            if ( $settings['show_button'] ) :
                                $get_options['show_button'] = $settings['show_button'];
                            endif;

                            if ( $settings['show_title'] ) :
                                $get_options['show_title'] = $settings['show_title'];
                            endif;
      
                            if ( $settings['show_media'] ) :
                                $get_options['show_media'] = $settings['show_media'];
                            endif;

                            if ( $settings['show_intor_video'] ) :
                                $get_options['show_intor_video'] = $settings['show_intor_video'];
                            endif;

                            if ( $settings['show_price'] ) :
                                $get_options['show_price'] = $settings['show_price'];
                            endif;
 
                            if ( $settings['show_enrolled'] ) :
                                $get_options['show_enrolled'] = $settings['show_enrolled'];
                            endif;

                            if ( $settings['show_enrolled_text'] ) :
                                $get_options['show_enrolled_text'] = $settings['show_enrolled_text'];
                            endif;
 
                            if ( $settings['show_lessons'] ) :
                                $get_options['show_lessons'] = $settings['show_lessons'];
                            endif;

                            if ( $settings['show_lessons_text'] ) :
                                $get_options['show_lessons_text'] = $settings['show_lessons_text'];
                            endif;
 
                            // if ( $settings['show_topic'] ) :
                            //     $get_options['show_topic'] = $settings['show_topic'];
                            // endif;

                            // if ( $settings['show_topic_text'] ) :
                            //     $get_options['show_topic_text'] = $settings['show_topic_text'];
                            // endif;

                            if ( $settings['show_quiz'] ) :
                                $get_options['show_quiz'] = $settings['show_quiz'];
                            endif;

                            if ( $settings['show_quiz_text'] ) :
                                $get_options['show_quiz_text'] = $settings['show_quiz_text'];
                            endif;

                            if ( $settings['show_cat'] ) :
                                $get_options['show_cat'] = $settings['show_cat'];
                            endif;

                           if ( $settings['show_wishlist'] ) :
                                $get_options['show_wishlist'] = $settings['show_wishlist'];
                            endif;
                        
                           if ( $settings['show_level'] ) :
                                $get_options['show_level'] = $settings['show_level'];
                            endif;
                        
                           if ( $settings['show_review'] ) :
                                $get_options['show_review'] = $settings['show_review'];
                            endif;
                        
                           if ( $settings['show_review_text'] ) :
                                $get_options['show_review_text'] = $settings['show_review_text'];
                            endif;
                        
                           if ( $settings['show_author_img'] ) :
                                $get_options['show_author_img'] = $settings['show_author_img'];
                            endif;
                        
                           if ( $settings['show_author_name'] ) :
                                $get_options['show_author_name'] = $settings['show_author_name'];
                            endif;

        

                            Filter::top_filter( $settings, $query );

                            if ( 'list' !== $settings['content_type'] ) :
                                $this->add_render_attribute( 'grid', 'class', 'display-layout-grid tpc-tutor-archive-courses edubin-course-archive' );
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
                                            // $thumb_url = \LP()->image( 'no-image.png' );
                                        endif;
                                        $get_options['thumb_url'] = $thumb_url;
                                        echo '<div ' . $this->get_render_attribute_string( 'grid_single' ) . '>';

                                            $get_options['style'] = $settings['grid_style'];
                                            if ( $settings['grid_excerpt_length'] ) :
                                                $get_options['excerpt_length'] = $settings['grid_excerpt_length'];
                                            endif;
                                            $post_class = 'edubin-course-style-' . esc_attr( $settings['grid_style'] );
                                        ?>
                                            <div id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>  <?php echo esc_attr( $animation_attribute ); ?>>
                                            <?php
                                                tutor_load_template( 'tpl-part.course.th-layouts', $get_options );
                                            echo '</div>';  
                                        echo '</div>';  
                                    endwhile;
                                    wp_reset_postdata();
                                    wp_reset_query();
                                echo '</div>';  
                            endif;

                            if ( 'grid' !== $settings['content_type'] ) :
                                $this->add_render_attribute( 'list', 'class', 'display-layout-list tpc-tutor-archive-courses' );
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
                                            // $thumb_url = \LP()->image( 'no-image.png' );
                                        endif;
                                        $get_options['thumb_url'] = $thumb_url;
                                        echo '<div ' . $this->get_render_attribute_string( 'list_single' ) . '>';

                                            $get_options['style'] = $settings['list_style'];

                                            // if ( $settings['list_excerpt_length'] ) :
                                            //     $get_options['excerpt_length'] = $settings['list_excerpt_length'];
                                            // endif;

                                            if ( $settings['show_excerpt_list'] ) :
                                                $get_options['show_excerpt_list'] = $settings['show_excerpt_list'];
                                            endif;

                                            if ( $settings['excerpt_length_list'] ) :
                                                $get_options['excerpt_length_list'] = $settings['excerpt_length_list'];
                                            endif;

                                            if ( $settings['show_cat_list'] ) :
                                                $get_options['show_cat_list'] = $settings['show_cat_list'];
                                            endif;

                                            if ( $settings['show_wishlist_list'] ) :
                                                $get_options['show_wishlist_list'] = $settings['show_wishlist_list'];
                                            endif;

                                            if ( $settings['show_review_list'] ) :
                                                $get_options['show_review_list'] = $settings['show_review_list'];
                                            endif;

                                            if ( $settings['show_enrolled_list'] ) :
                                                $get_options['show_enrolled_list'] = $settings['show_enrolled_list'];
                                            endif;

                                            if ( $settings['show_enrolled_text_list'] ) :
                                                $get_options['show_enrolled_text_list'] = $settings['show_enrolled_text_list'];
                                            endif;

                                            if ( $settings['show_lessons_list'] ) :
                                                $get_options['show_lessons_list'] = $settings['show_lessons_list'];
                                            endif;

                                            if ( $settings['show_lessons_text_list'] ) :
                                                $get_options['show_lessons_text_list'] = $settings['show_lessons_text_list'];
                                            endif;

                                            if ( $settings['show_quiz_list'] ) :
                                                $get_options['show_quiz_list'] = $settings['show_quiz_list'];
                                            endif;

                                            if ( $settings['show_quiz_text_list'] ) :
                                                $get_options['show_quiz_text_list'] = $settings['show_quiz_text_list'];
                                            endif;
                                        ?>
                                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>  <?php echo esc_attr( $animation_attribute ); ?>>
                                            <?php
                                                tutor_load_template( 'tpl-part.course.th-layouts', $get_options );
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

<?php

namespace Edubin_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \EdubinCore\Helper;
use \Elementor\Controls_Manager;
trait Posts {

    protected function query() {

        if ( NULL === $this->post_type ) :
            $this->post_type = 'post';
        endif;

        if ( NULL === $this->default_content_type ) :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Options', 'edubin-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Options', 'edubin-core' ),
                    'condition' => [
                        'content_type' => 'dynamic'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number Of Posts', 'edubin-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Default courses 6. Put -1 for all available courses', 'edubin-core' ),
                'default'       => [
                    'size'      => 6,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1
                    ]
                ]
            ]
        ); 

        $this->add_control(
            'order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => __( 'Order', 'edubin-core' ),
                'default'       => 'DESC',
                'description'   => __( 'Order', 'edubin-core' ),
                'options'       => [
                    'ASC'       => __( 'Ascending', 'edubin-core' ),
                    'DESC'      => __( 'Descending', 'edubin-core' )
                ]
            ]
        );        

        $this->add_control(
            'order_by',
            [
                'type'              => Controls_Manager::SELECT,
                'label'             => __( 'Order by', 'edubin-core' ),
                'default'           => 'date',
                'options'           => [
                    'none'            => __( 'No order', 'edubin-core' ),
                    'ID'              => __( 'Post ID', 'edubin-core' ),
                    'author'          => __( 'Author', 'edubin-core' ),
                    'title'           => __( 'Title', 'edubin-core' ),
                    'name'            => __( 'Name', 'edubin-core' ),
                    'type'            => __( 'Type', 'edubin-core' ),
                    'date'            => __( 'Published Date', 'edubin-core' ),
                    'modified'        => __( 'Modified Date', 'edubin-core' ),
                    'parent'          => __( 'By Parent', 'edubin-core' ),
                    'rand'            => __( 'Random Order', 'edubin-core' ),
                    'comment_count'   => __( 'Comment Count', 'edubin-core' ),
                    'relevance'       => __( 'Relevance', 'edubin-core' ),
                    'menu_order'      => __( 'Menu Order', 'edubin-core' ),
                    'meta_value'      => __( 'Meta Value', 'edubin-core' ),
                    'meta_value_num'  => __( 'Meta Value Num', 'edubin-core' ),
                    'post__in'        => __( 'Post In( by include order )', 'edubin-core' ),
                    'post_name__in'   => __( 'Post Name In', 'edubin-core' ),
                    'post_parent__in' => __( 'post Parent In', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'specific_post_include',
            [   
                'label'       => __( 'Specific Posts( Include )', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( $this->post_type ),
                'description' => __( 'It will show the selected posts only.', 'edubin-core' )

            ]
        );

        $this->add_control(
            'specific_post_exclude',
            [   
                'label'       => __( 'Specific Posts( Exclude )', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( $this->post_type ),
                'description' => __( 'It will hide the selected posts only.', 'edubin-core' )

            ]
        );

        $this->add_control(
            'enable_only_featured_posts',
            [
                'label'        => __( 'Only Has Featured Image', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'description'  => __( 'Only show posts which has feature image set.', 'edubin-core' ),           
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        if ( 'post' === $this->post_type ) :
            $this->add_control(
                'ignore_sticky',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label'        => __( 'Ignore Sticky Posts?', 'edubin-core' ),
                    'label_on'     => __( 'Enable', 'edubin-core' ),
                    'label_off'    => __( 'Disable', 'edubin-core' ),
                    'default'      => 'no',
                    'return_value' => 'yes'
                ]
            );
        endif;

        $this->add_control(
            'enable_date',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Date', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'date_format',
            [
                'type'            => Controls_Manager::SELECT,
                'label'           => __( 'Date Format', 'edubin-core' ),
                'default'         => 'default',
                'options'         => [
                    'default'     => __( 'Default', 'edubin-core' ),
                    'F j, Y'      => __( 'F j, Y', 'edubin-core' ),
                    'Y-m-d'       => __( 'Y-m-d', 'edubin-core' ),
                    'm/d/Y'       => __( 'm/d/Y', 'edubin-core' ),
                    'd/m/Y'       => __( 'd/m/Y', 'edubin-core' ),
                    'j M, Y'      => __( 'j M, Y', 'edubin-core' ),
                    'd M, Y'      => __( 'd M, Y', 'edubin-core' ),
                    'l F j, Y'    => __( 'l F j, Y', 'edubin-core' ),
                    'D M j'       => __( 'D M j', 'edubin-core' ),
                    'dS M Y'      => __( 'dS M Y', 'edubin-core' ),
                    'F Y'         => __( 'F Y', 'edubin-core' ),
                    'custom'      => __( 'Custom', 'edubin-core' )
                ],
                'condition'       => [
                    'enable_date' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'custom_date_format',
            [   
                'label'           => __( 'Custom Date Format', 'edubin-core' ),
                'type'            => Controls_Manager::TEXT,
                'default'         => __( 'F j, Y', 'edubin-core' ),
                'condition'       => [
                    'enable_date' => 'yes',
                    'date_format' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'enable_excerpt',
            [
                'label'        => __( 'Excerpt.', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'excerpt_length',
            [
                'label'       => __( 'Number of Words', 'edubin-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 20,
                'description' => __( 'Number of excerpt words.', 'edubin-core' ),
                'condition'   => [
                    'enable_excerpt' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'excerpt_end',
            [
                'label'       => __( 'Excerpt End Text', 'edubin-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '...',
                'condition'   => [
                    'enable_excerpt' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include Specific Category', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->category_taxonomy, true ),
                'multiple'    => true
            ]
        );

        $this->end_controls_section();
    }
}
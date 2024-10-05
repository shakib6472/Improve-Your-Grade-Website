<?php

namespace Edubin_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \EdubinCore\Helper;
use \Elementor\Controls_Manager;
trait Users {

    protected function query() {
        if ( NULL === $this->default_content_type ) :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Settings', 'edubin-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Settings', 'edubin-core' ),
                    'condition' => [
                        'content_type' => 'dynamic'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'image_size',
            [
                'label'       => __( 'Image Size', 'edubin-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'min' => 100,
                        'max' => 1200
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => $this->image_size
                ]
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number Of Instructors', 'edubin-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Number of instructors to show. Default -1, it will show all.', 'edubin-core' ),
                'default'       => [
                    'size'      => -1,
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
                'description'       => __( 'Orderby', 'edubin-core' ),
                'options'           => [
                    'none'            => __( 'No order', 'edubin-core' ),
                    'ID'              => __( 'User ID', 'edubin-core' ),
                    'display_name'    => __( 'Display Name', 'edubin-core' ),
                    'user_name'       => __( 'User Name', 'edubin-core' ),
                    'include'         => __( 'Include', 'edubin-core' ),
                    'user_login'      => __( 'User Login', 'edubin-core' ),
                    'user_nicename'   => __( 'User Nicename', 'edubin-core' ),
                    'user_url'        => __( 'User URL', 'edubin-core' ),
                    'user_registered' => __( 'User Registered', 'edubin-core' ),
                    'post_count'      => __( 'Post Count', 'edubin-core' )
                ]
            ]
        );
        
        $this->add_control(
            'specific_user_include',
            [   
                'label'       => __( 'Specific Instructors( Include )', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => edubin_get_all_instructors( $this->instructor ),
                'description' => __( 'It will show the selected instructors only.', 'edubin-core' )

            ]
        );

        $this->add_control(
            'specific_user_exclude',
            [   
                'label'       => __( 'Specific Instructors( Exclude )', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => edubin_get_all_instructors( $this->instructor ),
                'description' => __( 'It will hide the selected instructors only.', 'edubin-core' )

            ]
        );

        $this->end_controls_section();
    }
}
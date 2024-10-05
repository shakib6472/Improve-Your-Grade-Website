<?php

namespace Edubin_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \EdubinCore\Helper;
use \Elementor\Controls_Manager;

trait Taxonomy {

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
            'items_to_show',
            [
                'label'       => __( 'Number of Category to Show.', 'edubin-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 0,
                'min'         => 0,
                'step'        => 1,
                'description' => __( 'Default 0. It will show all the category items.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include Specific Category', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->taxomy_name ),
                'multiple'    => true
            ]
        );

        $this->add_control(
            'exclude_categories',
            [
                'label'       => __( 'Exclude Specific Category', 'edubin-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->taxomy_name ),
                'multiple'    => true,
                'description' => __( 'Either use exclude or include, don\'t use both together.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'order_by',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => __( 'Order by', 'edubin-core' ),
                'default' => 'name',
                'options' => [
                    'name'       => __( 'Name', 'edubin-core' ),
                    'id'         => __( 'ID', 'edubin-core' ),
                    'count'      => __( 'Count', 'edubin-core' ),
                    'slug'       => __( 'Slug', 'edubin-core' ),
                    'term_group' => __( 'Term Group', 'edubin-core' ),
                    'none'       => __( 'None', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => __( 'Order', 'edubin-core' ),
                'default'       => 'DESC',
                'options'       => [
                    'ASC'       => __( 'Ascending', 'edubin-core' ),
                    'DESC'      => __( 'Descending', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'enable_parent_only',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Only Top Level Category?', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => __( 'By enabling this option, only top level category will show.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'hide_empty_cat',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Empty Category', 'edubin-core' ),
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->end_controls_section();
    }
}
<?php

namespace Edubin_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;

trait Grid {

	protected function settings() {

        if( 'grid' === $this->default_display_type ) :
            $this->start_controls_section(
                'grid_settings',
                [
                    'label'     => __( 'Grid Columns', 'edubin-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'grid_settings',
                [
                    'label'     => __( 'Grid Columns', 'edubin-core' ),
                    'condition' => [
                        'display_type' => 'grid'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'desktop_grid_columns',
            [
                'label'        => __( 'Desktop Columns', 'edubin-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->desktop_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' ),
                    '4' => __( '4 Columns', 'edubin-core' ),
                    '5' => __( '5 Columns', 'edubin-core' ),
                    '6' => __( '6 Columns', 'edubin-core' )
                ]
            ]
        );

        $this->add_control(
            'tablet_grid_columns',
            [
                'label'        => __( 'Tablet Columns', 'edubin-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->tablet_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' ),
                    '4' => __( '4 Columns', 'edubin-core' ),
                    '6' => __( '6 Columns', 'edubin-core' )
                ],
                'description'  => __( 'It will affect up to 992px screen.', 'edubin-core' )
            ]
        );

        $this->add_control(
            'mobile_grid_columns',
            [
                'label'        => __( 'Mobile Columns', 'edubin-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->mobile_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'edubin-core' ),
                    '2' => __( '2 Columns', 'edubin-core' ),
                    '3' => __( '3 Columns', 'edubin-core' ),
                    '4' => __( '4 Columns', 'edubin-core' ),
                    '6' => __( '6 Columns', 'edubin-core' )
                ],
                'description'  => __( 'It will affect 768px to 576px screen.', 'edubin-core' )
            ]
        );

        $this->end_controls_section();
	}
}
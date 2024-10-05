<?php
namespace EdubinCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Edubin_Counter_Up extends Widget_Base {

    public function get_name() {
        return 'edubin-counter';
    }
    
    public function get_title() {
        return __( 'Counter', 'edubin-addons' );
    }

    public function get_icon() {
        return 'edubin-elementor-icon eicon-counter';
    }

    public function get_categories() {
        return [ 'edubin_elementor_widgets' ];
    }
    public function get_keywords() {
        return [ 'counter', 'edubin counter', 'timer', 'count', 'increase', 'counter up', 'count up' ];
    }

    public function get_script_depends() {
        return [
            'jquery-counterup',
            'jquery-waypoints',
            'edubin-active',
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_counter',
            [
                'label' => esc_html__( 'Counter', 'edubin-core' ),
            ]
        );


        $this->add_control(
            'counter_style',
            [
                'label' => __( 'Style', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'edubin-core' ),
                    '2'   => __( 'Style 2', 'edubin-core' ),
                    '3'   => __( 'Style 3', 'edubin-core' ),
                ],
            ]
        );

        $this->add_control(
            'starting_number',
            [
                'label' => esc_html__( 'Starting Number', 'edubin-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label' => esc_html__( 'Ending Number', 'edubin-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 100,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label' => esc_html__( 'Number Prefix', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'placeholder' => 1,
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label' => esc_html__( 'Number Suffix', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'placeholder' => esc_html__( 'Plus', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'count_unit',
            [
                'label' => __( 'Counter Unit', 'edubin-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'crore',
                'options' => [
                    ''   => __( 'none', 'edubin-core' ),
                    'hundred'   => __( 'hundred', 'edubin-core' ),
                    'thousand'   => __( 'thousand', 'edubin-core' ),
                    'lakh'   => __( 'lakh', 'edubin-core' ),
                    'crore'   => __( 'crore', 'edubin-core' ),
                    'million'   => __( 'million', 'edubin-core' ),
                    'billion'   => __( 'billion', 'edubin-core' ),
                    'trillion'   => __( 'trillion', 'edubin-core' ),
                    'K'   => __( 'K', 'edubin-core' ),
                    'M'   => __( 'M', 'edubin-core' ),
                    'B'   => __( 'B', 'edubin-core' ),
                ],
                'condition' => [
                    'counter_style' => '2',
                ],

            ]
        );
        
        $this->add_control(
            'thousands_separator',
            [
                'label' => esc_html__( 'Thousands Separator', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edubin-core' ),
                'label_off' => esc_html__( 'Hide', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'edubin-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Cool Number', 'edubin-core' ),
                'placeholder' => esc_html__( 'Cool Number', 'edubin-core' ),
            ]
        );

        

        $this->add_control(
            'counter_image',
            [
                'label'   => __('Image', 'edubin-core'),
                'type'    => Controls_Manager::MEDIA,
                'separator' => 'before',
                'condition' => [
                    'counter_style' => '2',
                ],
            ]
        );
    

        $this->add_control(
            'view',
            [
                'label' => esc_html__( 'View', 'edubin-core' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->add_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'edubin-core'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'edubin-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'edubin-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'edubin-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter .edubin-counter-number-wrapper-no' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .edubin-counter .edubin-counter-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'inline_counter',
            [
                'label' => esc_html__( 'Inline Counter', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edubin-core' ),
                'label_off' => esc_html__( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'counter_style' => '1',
                ],
            ]
        );
        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'section_box_style',
            [
                'label' => esc_html__( 'Style', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_style' => '3',
                ],
            ]
        );

        $this->add_control(
            'counter_width',
            [
                'label' => esc_html__( 'Width', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 700,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter.counter-style-3' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'counter_height',
            [
                'label' => esc_html__( 'Height', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 700,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter.counter-style-3' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'counter_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edubin-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter.counter-style-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background_options',
            [
                'label' => esc_html__( 'Background', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'counter_background',
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .edubin-counter.counter-style-3',
            ]
        );

        $this->add_control(
            'box_shadow_options',
            [
                'label' => esc_html__( 'Background', 'edubin-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'counter_box_shadow',
                'selector' => '{{WRAPPER}} .edubin-counter.counter-style-3',
            ]
        );

        $this->add_control(
            'parallax_effect',
            [
                'label' => esc_html__( 'Add Parallax Effect?', 'edubin-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edubin-core' ),
                'label_off' => esc_html__( 'No', 'edubin-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // Number Style
        $this->start_controls_section(
            'section_number',
            [
                'label' => esc_html__( 'Number', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Text Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter-number-wrapper-no' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_number',
                'selector' => '{{WRAPPER}} .edubin-counter-number-wrapper-no',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'number_shadow',
                'selector' => '{{WRAPPER}} .edubin-counter-number-wrapper-no',
            ]
        );

        $this->add_control(
            'number_bottom_space',
            [
                'label' => esc_html__( 'Number Bottom Space', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter .edubin-counter-number-wrapper-no' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Text Color', 'edubin-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Title Spacing', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter-title' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'inline_counter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_suffix_spacing',
            [
                'label' => esc_html__( 'Title Suffix Spacing', 'edubin-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -30,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .edubin-counter-number-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'inline_counter' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .edubin-counter-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .edubin-counter-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_parallax',
            [
                'label'     => __( 'Parallax', 'edubin-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'parallax_effect' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'x_axis_translation',
            [
                'label'        => __( 'X', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of scrolling at horizontal(X) axis. unit: pixels', 'edubin-core' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 0
                ]
            ]
        );

        $this->add_control(
            'y_axis_translation',
            [
                'label'        => __( 'Y', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of scrolling at vertical(Y) axis.', 'edubin-core' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 70
                ]
            ]
        );

        $this->add_control(
            'x_axis_rotation',
            [
                'label'        => __( 'rotateX', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at horizontal(X) axis. unit: degrees', 'edubin-core' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'y_axis_rotation',
            [
                'label'        => __( 'rotateY', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at vertical(Y) axis. unit: degrees', 'edubin-core' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'z_axis_rotation',
            [
                'label'        => __( 'rotateZ', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at Z axis. unit: degrees', 'edubin-core' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'global_scale',
            [
                'label'        => __( 'scale( global )', 'edubin-core' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of global scale. unit: ratio', 'edubin-core' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 3
                    ]
                ],
                'default'      => [
                    'size'     => 1
                ]
            ]
        );

        $this->add_control(
            'disable_parallax_at_responsive_big_tablet',
            [
                'label'        => __( 'Disable Parallax at Big Tablet.', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'label'        => __( 'Disable Parallax at Responsive Devices ( screen size < 1200px ).', 'edubin-core' ),
            ]
        );

        $this->add_control(
            'disable_parallax_at_responsive_small_tablet',
            [
                'label'        => __( 'Disable Parallax at Big Tablet.', 'edubin-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'edubin-core' ),
                'label_off'    => __( 'Disable', 'edubin-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'label'        => __( 'Disable Parallax at Responsive Devices ( screen size < 992px ).', 'edubin-core' ),
            ]
        );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $num_value = esc_html( $settings['ending_number'] );
        $thous_separator = ($settings['thousands_separator'] == 'yes')?(number_format( $num_value)):($num_value) ;
        $make_inline = ($settings['inline_counter'] == 'yes') ? ('inline-counter') : ('');

        $prefix = $suffix = '';
        if( !empty($settings['prefix']) ){
            $prefix = '<span class="edubin-counter-number-prefix">'.$settings['prefix'].'</span>';
        }
        if( !empty($settings['suffix']) ){ 
            $suffix = '<span class="edubin-counter-number-suffix">'.$settings['suffix'].'</span>';
        }
        
        if ($settings['counter_style'] == '1'){
            echo '<div class="edubin-counter counter-style-'.$settings['counter_style'].' '.$make_inline.'">';
                echo '<div class="edubin-counter-number-wrapper-no">';
                    if( !empty( $settings['ending_number'] ) ){
                        echo edubin_kses_title( $prefix ).'<span class="eb_counting">'.$thous_separator.'</span>'.edubin_kses_title( $suffix );
                    }
                echo '</div>';
                if( !empty( $settings['title'] ) ){
                    echo '<div class="edubin-counter-title">'.esc_html( $settings['title'] ).'</div>';
                }
            echo '</div>';
        }elseif($settings['counter_style'] == '2'){
            echo '<div class="edubin-counter counter-style-'.$settings['counter_style'].'">';
                echo '<div class="counter-wrapper">';
                    echo '<div class="counter-icon">';
                        if( isset( $settings['counter_image']['url'] ) ){
                            echo Group_Control_Image_Size::get_attachment_image_html($settings, 'counter_image');
                        }
                    echo '</div>';
                    echo '<div class="counter-content">';
                        echo '<div class="edubin-counter-number-wrapper-no">';
                            if( !empty( $settings['ending_number'] ) ){
                                echo edubin_kses_title( $prefix ).'<span class="eb_counting">'.$thous_separator.'</span>'.edubin_kses_title( $suffix );
                            };
                            if( $settings['count_unit'] != ''){
                                echo '<span class="count-unit">'.$settings['count_unit'].'</span>';
                            };
                        echo '</div>';
                        if( !empty( $settings['title'] ) ){
                            echo '<div class="edubin-counter-title">'.esc_html( $settings['title'] ).'</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        elseif($settings['counter_style'] == '3'){

            $this->add_render_attribute( 'container', 'class', 'edubin-counter counter-style-'.$settings['counter_style'].'' );
            if($settings['parallax_effect'] == 'yes'){

                $x_axis_translation = $settings['x_axis_translation']['size'] ? $settings['x_axis_translation']['size'] : 0;
                $y_axis_translation = $settings['y_axis_translation']['size'] ? $settings['y_axis_translation']['size'] : 0;
                $x_axis_rotation    = $settings['x_axis_rotation']['size'] ? $settings['x_axis_rotation']['size'] : 0;
                $y_axis_rotation    = $settings['y_axis_rotation']['size'] ? $settings['y_axis_rotation']['size'] : 0;
                $z_axis_rotation    = $settings['z_axis_rotation']['size'] ? $settings['z_axis_rotation']['size'] : 0;
                $global_scale       = $settings['global_scale']['size'] ? $settings['global_scale']['size'] : 1;
                
                $this->add_render_attribute(
                    'container',
                    [
                        'class'         => 'edubin-counter counter-style-'.$settings['counter_style'].' demo-parallax-item',
                        'data-parallax' => '{"x": ' . esc_attr( $x_axis_translation ) . ', "y": ' . esc_attr( $y_axis_translation ) . ', "rotateX": ' . esc_attr( $x_axis_rotation ) . ', "rotateY": ' . esc_attr( $y_axis_rotation ) . ', "rotateZ": ' . esc_attr( $z_axis_rotation ) . ', "scale": ' . esc_attr( $global_scale ) . '}'
                    ]
                );
                if ( 'yes' === $settings['disable_parallax_at_responsive_big_tablet'] ){
                    $this->add_render_attribute( 'container', 'class', 'edubin-counter counter-style-'.$settings['counter_style'].' demo-parallax-disable-at-big-tablet' );
                };
        
                if ( 'yes' === $settings['disable_parallax_at_responsive_small_tablet'] ) {
                    $this->add_render_attribute( 'container', 'class', 'edubin-counter counter-style-'.$settings['counter_style'].' demo-parallax-disable-at-small-tablet' );
                };

            }

            echo '<div '. $this->get_render_attribute_string( 'container' ) .'>';
                echo '<div class="counter-wrapper">';
                    echo '<div class="counter-content">';
                        echo '<div class="edubin-counter-number-wrapper-no">';
                            if( !empty( $settings['ending_number'] ) ){
                                echo edubin_kses_title( $prefix ).'<span class="eb_counting">'.$thous_separator.'</span>'.edubin_kses_title( $suffix );
                            }
                        echo '</div>';
                        if( !empty( $settings['title'] ) ){
                            echo '<div class="edubin-counter-title">'.esc_html( $settings['title'] ).'</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        

    }
}

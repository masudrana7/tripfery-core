<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Banner_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Banner Slider', 'tripfery-core' );
		$this->rt_base = 'rt-banner-slider';		
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'banner_image', [
                'type' => Controls_Manager::MEDIA,
                'label' =>   esc_html__('Image', 'tripfery-core'),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],                
            ]
        );
		$repeater->add_control(
            'slider_sub_title', [
                'type' => Controls_Manager::TEXT,
                'label' =>   esc_html__('Sub title', 'tripfery-core'),
                'label_block' => true, 
                'default' => esc_html__('SINCE 1987', 'tripfery-core' ),
            ]
        );
		$repeater->add_control(
            'slider_shadow_title', [
                'type' => Controls_Manager::TEXT,
                'label' =>   esc_html__('Shadow Title', 'tripfery-core'),
                'label_block' => true,
                'default' => esc_html__('Innovation In', 'tripfery-core' ),
            ]
        );
		$repeater->add_control(
            'slider_title', [
                'type' => Controls_Manager::TEXT,
                'label' =>   esc_html__('Title', 'tripfery-core'),
                'label_block' => true,
                'default' => esc_html__('Power & Engineer', 'tripfery-core' ),
            ]
        );
		$repeater->add_control(
            'slider_text', [
                'type' => Controls_Manager::TEXTAREA,
                'label' =>   esc_html__('Description', 'tripfery-core'),
                'default' => esc_html__( 'Business hen an unknown printer took a galley of type and scrambled make wype specimenIt has survived not only.', 'tripfery-core' ),
				'label_block' => true, 
            ]
        );
		$repeater->add_control(
            'button_text', [
                'type' => Controls_Manager::TEXT,
                'label'   => esc_html__( 'Button Text', 'tripfery-core' ),
				'default' => esc_html__( 'Explore Services', 'tripfery-core' ),
                'label_block' => true,
            ]
        );
		$repeater->add_control(
            'button_url', [
                'type' => Controls_Manager::URL,
                'label'   => esc_html__( 'Button URL', 'tripfery-core' ),
				'placeholder' => esc_url('https://your-link.com' ),
                'label_block' => true, 
            ]
        );
		
		$fields=array(
            array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'Banner Slider', 'tripfery-core' ),
			),
            array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'content_align',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Alignment', 'tripfery-core' ),
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content' => 'text-align: {{VALUE}}',
				),
			),
            array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'banner_lists',
				'label'   => esc_html__( 'Slider Items', 'tripfery-core' ),
				'fields' => $repeater->get_controls(),
				'default' => array(
					['title' => 'Power & Engineer', ],
					['title' => 'Power & Engineer', ],
					['title' => 'Power & Engineer', ],
				),
			),
			array(
				'type' 			=> Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      		=> 'slide_height',
				'label'   		=> esc_html__( 'Slide Height', 'tripfery-core' ),						
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => '',
				),
				'range' => array(
	                'px' => array(
	                    'min' => 0,
	                    'max' => 1200,
	               	),
	               	'%' => array(
	                    'min' => 0,
	                    'max' => 100,
	               	),
		       	),
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .single-slider' => 'min-height: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'slider_overlay_color',
				'label'   => esc_html__( 'Slider Overlay Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .swiper-slide:after' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_animation',
				'label'       => esc_html__( 'Slider Animation', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
            array(
				'mode' => 'section_end',
			),
            // Title style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_title_style',
				'label'   => esc_html__( 'Title Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .banner-slider .slider-content .slider-title',
			),
            array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .slider-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'title_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Title Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .banner-slider .slider-content .slider-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'title_align',
				'label'   => esc_html__( 'Alignment', 'tripfery-core' ),
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => '',
			),
			array(
				'type' 			=> Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      		=> 'title_width',
				'label'   		=> esc_html__( 'Title Width', 'tripfery-core' ),						
				'size_units' => array( 'px', '%' ),
				'default' => array(
				'unit' => '%',
				'size' => '',
				),
				'range' => array(
	                'px' => array(
	                    'min' => 0,
	                    'max' => 1200,
	               	),
	               	'%' => array(
	                    'min' => 0,
	                    'max' => 100,
	               	),
		       	),
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .slider-title' => 'max-width: {{SIZE}}{{UNIT}};',
				)
			),
            array(
				'mode' => 'section_end',
			),			
			/*Shadow title*/
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_shadow_itle_style',
	            'label'   => esc_html__( 'Shadow Title', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'shadow_title_typo',
				'label'   => esc_html__( 'Shadow Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .banner-slider .slider-content .shadow-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'shadow_title_color',
				'label'   => esc_html__( 'Shadow Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .shadow-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'shadow_title_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Shadow Title Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .banner-slider .slider-content .shadow-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
	        array(
				'mode' => 'section_end',
			),
            // SubTitle style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_subtitle_style',
				'label'   => esc_html__( 'Subtitle Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'subtitle_typo',
				'label'   => esc_html__( 'Subtitle Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .banner-slider .slider-content .sub-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color',
				'label'   => esc_html__( 'Subtitle Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .sub-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_line',
				'label'       => esc_html__( 'Display Line', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_line_color',
				'label'   => esc_html__( 'Line Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .sub-title .line' => 'background-color: {{VALUE}}',
				),
				'condition' => array( 'display_line' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'subtitle_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Subtitle Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .banner-slider .slider-content .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'mode' => 'section_end',
			),
            // Content style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_content_style',
				'label'   => esc_html__( 'Content Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content_typo',
				'label'   => esc_html__( 'Content Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .banner-slider .slider-content .slider-text',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .slider-text' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'content_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Content Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .banner-slider .slider-content .slider-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'text_align',
				'label'   => esc_html__( 'Alignment', 'tripfery-core' ),
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => '',
			),
			array(
				'type' 			=> Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      		=> 'text_width',
				'label'   		=> esc_html__( 'Content Width', 'tripfery-core' ),						
				'size_units' => array( 'px', '%' ),
				'default' => array(
				'unit' => '%',
				'size' => '',
				),
				'range' => array(
	                'px' => array(
	                    'min' => 0,
	                    'max' => 1200,
	               	),
	               	'%' => array(
	                    'min' => 0,
	                    'max' => 100,
	               	),
		       	),
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .slider-content .slider-text' => 'max-width: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'mode' => 'section_end',
			),
			// Button style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_button',
				'label'   => esc_html__( 'Button Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__( 'Button Display', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'button_size',
				'label'   => esc_html__( 'Button Size', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bg_color',
				'label'   => esc_html__( 'Button Bg Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bg_hover_color',
				'label'   => esc_html__( 'Button Bg Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common::before' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_border_color',
				'label'   => esc_html__( 'Button Border Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common' => 'border-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_border_hover_color',
				'label'   => esc_html__( 'Button Border Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common:hover' => 'border-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_color',
				'label'   => esc_html__( 'Button Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common' => 'color: {{VALUE}}',
					'{{WRAPPER}} .banner-slider .btn-common path.rt-button-cap' => 'stroke: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_hover_color',
				'label'   => esc_html__( 'Button Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .banner-slider .btn-common:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .banner-slider .btn-common:hover path.rt-button-cap' => 'stroke: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'button_padding',
	            'label'   => __( 'Padding', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .banner-slider .btn-common' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),
			// Nav Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_nav_option',
				'label'   => esc_html__( 'Nav Option', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_arrow',
				'label'       => esc_html__( 'Navigation Arrow', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'nav_position',
				'label'   => esc_html__( 'Nav Position', 'tripfery-core' ),				
				'options' => array(
					'default' 		=> esc_html__( 'Default', 'tripfery-core' ),
					'top-right' 	=> esc_html__( 'Top Right', 'tripfery-core' ),
				),
				'default' => 'default',
				'condition'   => array( 'display_arrow' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'nav_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Nav Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -200,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .top-right .rt-swiper-slider .swiper-navigation' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array( 'display_arrow' => array( 'yes' ), 'nav_position' => array( 'top-right' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'prev_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Prev Arrow', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array( 'display_arrow' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'next_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array( 'display_arrow' => array( 'yes' ) ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_buttet',
				'label'       => esc_html__( 'Pagination', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: Off', 'tripfery-core' ),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_color',
				'label'   => esc_html__( 'Nav Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_hover_color',
				'label'   => esc_html__( 'Nav Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div:hover' => 'color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_bg_color',
				'label'   => esc_html__( 'Nav Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'background-color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_bg_hover_color',
				'label'   => esc_html__( 'Nav Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div:hover' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'nav_width',
				'label'   => esc_html__( 'Nav Width', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'width: {{SIZE}}px;',
				),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'nav_height',
				'label'   => esc_html__( 'Nav Height', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'width: {{SIZE}}px;',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'nav_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Nav Radius', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'pag_bg_color',
				'label'   => esc_html__( 'Pagination BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'pag_bg_active_color',
				'label'   => esc_html__( 'Pagination BG Active Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'pagination_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Pagination Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'mode' => 'section_end',
			),
            // Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'tripfery-core' ),
			),			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => esc_html__( 'Autoplay', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      => 'slides_per_group',
				'label'   => esc_html__( 'slides Per Group', 'tripfery-core' ),
				'default' => array(
					'size' => 1,
				),
				'description' => esc_html__( 'slides Per Group. Default: 1', 'tripfery-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'centered_slides',
				'label'       => esc_html__( 'Centered Slides', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Centered Slides. Default: On', 'tripfery-core' ),
				
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'slides_space',
				'label'       => esc_html__( 'Slides Space', 'tripfery-core' ),
				'default'     => 10,
				'description' => esc_html__( 'Slides Space. Default: 10', 'tripfery-core' ),
			),		
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_delay',
				'label'   => esc_html__( 'Autoplay Slide Delay', 'tripfery-core' ),
				'default' => 5000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'tripfery-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_speed',
				'label'   => esc_html__( 'Autoplay Slide Speed', 'tripfery-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'tripfery-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => esc_html__( 'Loop', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'tripfery-core' ),
			),
			array(
				'mode' => 'section_end',
			),

			/*Slider responsive*/
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider_pervice',
				'label'       => esc_html__( 'Slides PerView Options', 'tripfery-core' ),
			),
			
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'desktop',
				'label'   => esc_html__( 'Desktops: > 1600px', 'tripfery-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
					'4' => esc_html__( '4',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'md_desktop',
				'label'   => esc_html__( 'Desktops: > 1200px', 'tripfery-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'1.5' => esc_html__( '1.5', 'tripfery-core' ),
					'2.5' => esc_html__( '2.5', 'tripfery-core' ),
					'3.5' => esc_html__( '3.5',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'sm_desktop',
				'label'   => esc_html__( 'Desktops: > 992px', 'tripfery-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'1.5' => esc_html__( '1.5', 'tripfery-core' ),
					'2.5' => esc_html__( '2.5', 'tripfery-core' ),
					'3.5' => esc_html__( '3.5',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'tablet',
				'label'   => esc_html__( 'Tablets: > 768px', 'tripfery-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'mobile',
				'label'   => esc_html__( 'Phones: > 576px', 'tripfery-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'1.5' => esc_html__( '1.5', 'tripfery-core' ),
					'2.5' => esc_html__( '2.5', 'tripfery-core' ),
					'3.5' => esc_html__( '3.5',  'tripfery-core' ),
				),
			),
			array(
				'mode' => 'section_end',
			),
        );

		return $fields;
	}

	protected function render() {

		$data = $this->get_settings();
        if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}



		$swiper_data = array(
			'slidesPerView' 	=>2,
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		=>$data['slides_space'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
			'slideToClickedSlide' =>true,
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['slider_autoplay_speed'],
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'576'    =>array('slidesPerView' =>$data['mobile']),
				'768'    =>array('slidesPerView' =>$data['tablet']),
				'992'    =>array('slidesPerView' =>$data['sm_desktop']),
				'1200'    =>array('slidesPerView' =>$data['md_desktop']),				
				'1600'    =>array('slidesPerView' =>$data['desktop'])				

			),
			'auto'   =>$data['slider_autoplay']
		);

		$template = 'rt-banner-slider';
        $data['swiper_data'] = json_encode( $swiper_data );   
		return $this->rt_template( $template, $data );
	}
}
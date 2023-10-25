<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Hero_Banner extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Hero Banner', 'tripfery-core' );
		$this->rt_base = 'rt-hero-banner';
		parent::__construct( $data, $args );
	}
	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'shadow_title',
				'label'   => esc_html__( 'Shadow Title', 'tripfery-core' ),
				'default' => esc_html__( 'Innovation In', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Welcome To Tripfery', 'tripfery-core' ),
			),
			array(
				'type' => Controls_Manager::SELECT,
				'id'      => 'heading_size',
				'label'   => esc_html__( 'HTML Tag', 'tripfery-core' ),
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				),
				'default' => 'h2',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'sub_title',
				'label'   => esc_html__( 'Sub Title', 'tripfery-core' ),
				'default' => esc_html__('SINCE 1987', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'tripfery-core' ),
				'default' => esc_html__('Business hen an unknown printer took a galley of type and scrambled make wype specimenIt has survived not only.', 'tripfery-core' ),
			),
			/*button 01*/
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__( 'Button Display 1', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'tripfery-core' ),
				'default' => esc_html__( 'Read More', 'tripfery-core' ),
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'buttonurl',
				'label'   => esc_html__( 'Button URL', 'tripfery-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),

			/*button 02*/
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display2',
				'label'       => esc_html__( 'Button Display 2', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext2',
				'label'   => esc_html__( 'Button Text', 'tripfery-core' ),
				'default' => esc_html__( 'About Us', 'tripfery-core' ),
				'condition'   => array( 'button_display2' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'buttonurl2',
				'label'   => esc_html__( 'Button URL', 'tripfery-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'button_display2' => array( 'yes' ) ),
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
				'selector' => '{{WRAPPER}} .rt-hero-banner .entry-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .entry-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-hero-banner .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
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
				'selector' => '{{WRAPPER}} .rt-hero-banner .shadow-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'shadow_title_color',
				'label'   => esc_html__( 'Shadow Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .shadow-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-hero-banner .shadow-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
	        array(
				'mode' => 'section_end',
			),
			// Sub Title style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_sub_title',
				'label'   => esc_html__( 'Sub Title', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Sub Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-hero-banner .entry-subtitle',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'sub_title_color',
				'label'   => esc_html__( 'Sub Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .entry-subtitle' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'sub_title_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Sub Title Space', 'tripfery-core' ),
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
					'{{WRAPPER}} .rt-hero-banner .entry-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'id'      => 'title_line_color',
				'label'   => esc_html__( 'Line Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .line' => 'background-color: {{VALUE}}',
				),
				'condition' => array( 'display_line' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'line_width',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Line Width', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .rt-hero-banner.active-animation .line' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array( 'display_line' => array( 'yes' ) ),
			),
			array(
				'mode' => 'section_end',
			),
			// Text style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_text_style',
				'label'   => esc_html__( 'Text style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'text_typo',
				'label'   => esc_html__( 'Text Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-hero-banner .entry-content',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .entry-content' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-banner ul li' => 'color: {{VALUE}}',
				),
			),			
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'text_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Text Space', 'tripfery-core' ),
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
					'{{WRAPPER}} .rt-hero-banner .entry-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Button style 1
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_button_style2',
				'label'   => esc_html__( 'Button Style 1', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'button_typo2',
				'label'   => esc_html__( 'Button Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-hero-banner .button-style-4',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_border_color2',
				'label'   => esc_html__( 'Button Border Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-4' => 'border-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bag_color2',
				'label'   => esc_html__( 'Button Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-4' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bag_hover_color2',
				'label'   => esc_html__( 'Button Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-4::before' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_text_color2',
				'label'   => esc_html__( 'Button Text Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-4' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_text_hover_color2',
				'label'   => esc_html__( 'Button Text Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-4:hover' => 'color: {{VALUE}}',
				),
			),			
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_radius2',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Button Radius', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-banner .button-style-4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_padding2',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Button Padding', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-banner .button-style-4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),		
			array(
				'mode' => 'section_end',
			),

			// Button style 2
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_button_style',
				'label'   => esc_html__( 'Button Style 2', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array( 'button_display2' => array( 'yes' ) ),
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'button_typo',
				'label'   => esc_html__( 'Button Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-hero-banner .button-style-2',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bag_color',
				'label'   => esc_html__( 'Button Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-2' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_bag_hover_color',
				'label'   => esc_html__( 'Button Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-2::before' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_text_color',
				'label'   => esc_html__( 'Button Text Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-2' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'button_text_hover_color',
				'label'   => esc_html__( 'Button Text Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-banner .button-style-2:hover' => 'color: {{VALUE}}',
				),
			),			
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Button Radius', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-banner .button-style-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Button Padding', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-banner .button-style-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),		
			array(
				'mode' => 'section_end',
			),
			// Animation style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_animation_style',
	            'label'   => esc_html__( 'Animation', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation',
				'label'   => esc_html__( 'Animation', 'tripfery-core' ),
				'options' => array(
					'wow'        => esc_html__( 'On', 'tripfery-core' ),
					'hide'        => esc_html__( 'Off', 'tripfery-core' ),
				),
				'default' => 'hide',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'tripfery-core' ),
				'options' => array(
                    'none' => esc_html__( 'none', 'tripfery-core' ),
					'bounce' => esc_html__( 'bounce', 'tripfery-core' ),
					'flash' => esc_html__( 'flash', 'tripfery-core' ),
					'pulse' => esc_html__( 'pulse', 'tripfery-core' ),
					'rubberBand' => esc_html__( 'rubberBand', 'tripfery-core' ),
					'shakeX' => esc_html__( 'shakeX', 'tripfery-core' ),
					'shakeY' => esc_html__( 'shakeY', 'tripfery-core' ),
					'headShake' => esc_html__( 'headShake', 'tripfery-core' ),
					'swing' => esc_html__( 'swing', 'tripfery-core' ),					
					'fadeIn' => esc_html__( 'fadeIn', 'tripfery-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'tripfery-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'tripfery-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'tripfery-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'tripfery-core' ),					
					'bounceIn' => esc_html__( 'bounceIn', 'tripfery-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'tripfery-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'tripfery-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'tripfery-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'tripfery-core' ),			
					'slideInDown' => esc_html__( 'slideInDown', 'tripfery-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'tripfery-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'tripfery-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'tripfery-core' ), 
                ),
				'default' => 'fadeInUp',
				'condition'   => array('animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();		
		$template = 'rt-hero-banner';
	
		return $this->rt_template( $template, $data );
	}
}
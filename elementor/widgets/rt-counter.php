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

class RT_Counter extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'RT Counter', 'tripfery-core' );
		$this->rt_base = 'rt-counter';
		parent::__construct( $data, $args );
	}
	private function rt_load_scripts(){
		wp_enqueue_script( 'counterup' );
		wp_enqueue_script( 'waypoints' );
	}
	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Counter Layout', 'tripfery-core' ),
				'options' => array(
					'style1' => esc_html__( 'Layout 01' , 'tripfery-core' ),
					'style2' => esc_html__( 'Layout 02' , 'tripfery-core' ),
					'style3' => esc_html__( 'Layout 03' , 'tripfery-core' ),
				),
				'default' => 'style1',
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
					'{{WRAPPER}} .rt-counter-box .rt-item' => 'text-align: {{VALUE}};',
				),
				'condition'   => array( 'style' => array( 'style1' ) ),
			),

			array(
				'type'    => Controls_Manager::SWITCHER,
				'id'      => 'showhide',
				'label'   => esc_html__( 'Icon', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array(
				'type'    => Controls_Manager::ICONS,
				'id'      => 'icon_class',
				'label'   => esc_html__( 'Icon', 'tripfery-core' ),
				'default' => array(
					'value' => 'fas fa-award',
					'library' => 'fa-solid',
				),
				'condition'   => array( 'showhide' =>'yes' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Experiences', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Counter Number', 'tripfery-core' ),
				'default' => 25,
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'after_text',
				'label'   => esc_html__( 'Counter Unit', 'tripfery-core' ),
				'default' => esc_html__( '+', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'speed',
				'label'   => esc_html__( 'Animation Speed', 'tripfery-core' ),
				'default' => 5000,
				'description' => esc_html__( 'The total duration of the count animation in milisecond eg. 5000', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'steps',
				'label'   => esc_html__( 'Animation Steps', 'tripfery-core' ),
				'default' => 10,
				'description' => esc_html__( 'Counter steps eg. 10', 'tripfery-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'item_angle',
				'label'       => esc_html__( 'Item Angle', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
				'mode' => 'section_end',
			),
			// Box Style
			array(
				'mode'    => 'section_start',
				'id'      => 'bg_style',
				'label'   => esc_html__( 'Box background', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
				'type'    => Controls_Manager::SWITCHER,
				'id'      => 'bg_showhide',
				'label'   => esc_html__( 'Box Background Color', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_bg',
				'label'   => esc_html__( 'Box Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-box .rt-item' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-counter-style1 .item-angle:after' => 'background-color: {{VALUE}}',
				),
				'condition'   => array( 'bg_showhide' =>'yes' ),
			),	
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_padding',
	            'label'   => __( 'Box Padding', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-counter-box .rt-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',                    
	            ),
	        ),
	        array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_radius',
	            'label'   => __( 'Radius', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-counter-box .rt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',                    
	            ),
	        ),
			array(
				'mode' => 'section_end',
			),
			// Title Style
			array(
				'mode'    => 'section_start',
				'id'      => 'title_style',
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-box .rt-item .rt-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-box .rt-item .rt-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Counter Style
			array(
				'mode'    => 'section_start',
				'id'      => 'counter_style',
				'label'   => esc_html__( 'Counter', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'counter_typo',
				'label'   => esc_html__( 'Counter Style', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-box .rt-item .counter-number',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'counter_color',
				'label'   => esc_html__( 'Counter Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-box .rt-item .counter-number' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'counter_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Counter Space', 'tripfery-core' ),
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
					'{{WRAPPER}} .rt-counter-box .rt-item .counter-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Icon Style
			array(
				'mode'    => 'section_start',
				'id'      => 'icon_style',
				'label'   => esc_html__( 'Icon', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-box .rt-item .rt-media i' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_bg_color',
				'label'   => esc_html__( 'Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-style2 .rt-item .rt-media i' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-counter-style3 .rt-item .rt-media i' => 'background-color: {{VALUE}}',
				),
				'condition'   => array( 'style!' => array( 'style1' ) ),
			),	
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_size',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Font Size', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-box .rt-item .rt-media i' => 'font-size: {{VALUE}}px',
				),
			),
	        array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'icon_radius',
	            'label'   => __( 'Radius', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-counter-box .rt-item .rt-media i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',                    
	            ),
				'condition'   => array( 'style!' => array( 'style1' ) ),
	        ),
			array(
				'mode' => 'section_end',
			),
			// General style
			array(
				'mode'    => 'section_start',
				'id'      => 'general_style_tow',
				'label'   => esc_html__('General Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array('style' => array('style2')),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_tow_bg',
				'label'   => esc_html__('Background Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-style2 .rt-content' => 'background-color: {{VALUE}}',
				),
			),	
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'mode'          => 'responsive',
				'size_units' => ['px', '%', 'em'],
				'id'      => 'box_area_padding',
				'label'   => __('Box Padding', 'tripfery-core'),
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-style2 .rt-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'box_width',
				'mode'          => 'responsive',
				'label'   => esc_html__('Box Width', 'tripfery-core'),
				'size_units' => array('%', 'px'),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-style2 .rt-content' => 'width: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'box_height',
				'mode'          => 'responsive',
				'label'   => esc_html__('Box Height', 'tripfery-core'),
				'size_units' => array('%', 'px'),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-counter-style2 .rt-content' => 'height: {{SIZE}}{{UNIT}};',
				),
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
				'type'    => Controls_Manager::TEXT,
				'id'      => 'delay',
				'label'   => esc_html__( 'Delay', 'tripfery-core' ),
				'default' => '0.2',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'tripfery-core' ),
				'default' => '1.2',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();
		
		switch ( $data['style'] ) {
			case 'style3':
			$template = 'rt-counter-3';
			break;
			case 'style2':
			$template = 'rt-counter-2';
			break;
			default:			
			$template = 'rt-counter-1';
			break;
		}
		return $this->rt_template( $template, $data );
	}

}
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
class RT_Feature_Room extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Feature Room', 'tripfery-core' );
		$this->rt_base = 'rt-feature-room';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$repeater = new \Elementor\Repeater(); 
		$repeater->add_control(
			'image', [
				'type'  => Controls_Manager::MEDIA,
				'label' => esc_html__( 'Image', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'title', [
				'type'  => Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'subtitle',
				'label'   => esc_html__('Sub Title', 'tripfery-core'),
				'default' => esc_html__('Room', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__('Title', 'tripfery-core'),
				'default' => esc_html__('Stay with Us', 'tripfery-core'),
			),	
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'description',
				'label'   => esc_html__('Description', 'tripfery-core'),
				'default' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the as integer quam dolor nunc semper.', 'tripfery-core'),
			),

			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'rt-rooms',
				'label'   => esc_html__('Add as many rooms as you want', 'tripfery-core'),
				'fields' => $repeater->get_controls(),
			),

			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'item_space',
				'label'   => esc_html__( 'Item Space', 'tripfery-core' ),
				'options' => array(
					'g-0' => esc_html__( 'Gutters 0', 'tripfery-core' ),
					'g-1' => esc_html__( 'Gutters 1', 'tripfery-core' ),
					'g-2' => esc_html__( 'Gutters 2', 'tripfery-core' ),
					'g-3' => esc_html__( 'Gutters 3', 'tripfery-core' ),
					'g-4' => esc_html__( 'Gutters 4', 'tripfery-core' ),
					'g-5' => esc_html__( 'Gutters 5', 'tripfery-core' ),
				),
				'default' => 'g-4',
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
					'{{WRAPPER}} .rt-logo-grid .row' => 'justify-content: {{VALUE}};',
				),
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'logos',
				'label'   => esc_html__( 'Add as many logos as you want', 'tripfery-core' ),
				'fields' => $repeater->get_controls(),				
			),
			array(
				'mode' => 'section_end',
			),
			
			// Title style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_title_style',
	            'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Style', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-logo-default .logo-box .entry-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
			 	'id'      => 'title_color',				
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-logo-default .logo-box .entry-title' => 'color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'title_margin',
	            'label'   => __( 'Title Margin', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-logo-default .logo-box .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	        ),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_width',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Logo Width', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
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
					'{{WRAPPER}} .rt-logo-default .logo-box img' => 'width: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
			 	'id'      => 'box_bg_color',				
				'label'   => esc_html__( 'Box BG Color', 'tripfery-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-logo-grid .logo-box' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_padding',
	            'label'   => __( 'Box Padding', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-logo-grid .logo-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),				
				'condition'   => array( 'style' => array( 'style2' ) ),
	        ),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_radius',
	            'label'   => __( 'Box Radius', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-logo-grid .logo-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
				'separator' => 'before',
				'condition'   => array( 'style' => array( 'style2' ) ),
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

	protected function render()
	{
		$data = $this->get_settings();
		$template = 'rt-feature-room';
		return $this->rt_template($template, $data);
	}

}
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Shape extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Shape', 'tripfery-core' );
		$this->rt_base = 'rt-shape';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			/*Shape layout*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Shape Style', 'tripfery-core' ),
				'options' => array(
					'style1' => esc_html__( 'Shape Style 1' , 'tripfery-core' ),
					'style2' => esc_html__( 'Shape Style 2', 'tripfery-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'shape_one',
				'label'   => esc_html__( 'Element', 'tripfery-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended image size 113 X 104', 'tripfery-core' ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'tripfery-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',		
				'condition'   => array('style' => array( 'style2' ) ),
			),
			array(
				'mode' => 'section_end',
			),

			/*sub title section*/
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_image_position',
	            'label'   => esc_html__( 'Image Option', 'tripfery-core' ),
	        ),
	        array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'position',
				'label'   => esc_html__( 'Position', 'tripfery-core' ),				
				'options' => array(
					'relative' 		=> esc_html__( 'Relative', 'tripfery-core' ),
					'absolute' 		=> esc_html__( 'Absolute', 'tripfery-core' ),
				),
				'default' => 'relative',
			),
	        array(
				'type' 			=> Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      		=> 'shape_left_right',
				'label'   		=> esc_html__( 'Shape Left / Right', 'tripfery-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => '',
				),
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
					'{{WRAPPER}} .rt-shape-layout .rt-shape-item' => 'left: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type' 			=> Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      		=> 'shape_top_bottom',
				'label'   		=> esc_html__( 'Shape Top / Bottom', 'tripfery-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => '',
				),
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
					'{{WRAPPER}} .rt-shape-layout .rt-shape-item' => 'top: {{SIZE}}{{UNIT}};',
				)
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation',
				'label'   => esc_html__( 'Animation', 'tripfery-core' ),
				'options' => array(
					'wow'        => esc_html__( 'On', 'tripfery-core' ),
					'hide'        => esc_html__( 'Off', 'tripfery-core' ),
				),
				'default' => 'wow',
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
				'default' => 'fadeInDown',
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

			/*title section*/
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_style',
	            'label'   => esc_html__( 'Style', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'shape_color',
				'label'   => esc_html__( 'Shape Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-shape-layout .rt-shape-item' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'shape_width',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Shape Width', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .rt-shape-layout .rt-shape-item' => 'width: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'shape_height',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Shape Height', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .rt-shape-layout .rt-shape-item' => 'height: {{SIZE}}{{UNIT}};',
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
		$template = 'rt-shape';
		return $this->rt_template( $template, $data );
	}
}
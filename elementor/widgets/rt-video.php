<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Video extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Video', 'tripfery-core' );
		$this->rt_base = 'rt-video';
		parent::__construct( $data, $args );
	}
	
	private function rt_load_scripts(){
		wp_enqueue_script( 'magnific-popup' );
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
				'label'   => esc_html__( 'Video Style', 'tripfery-core' ),
				'options' => array(
					'style1' => esc_html__( 'Video Style 1' , 'tripfery-core' ),
					'style2' => esc_html__( 'Video Style 2', 'tripfery-core' ),
					'style3' => esc_html__( 'Video Style 3', 'tripfery-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'video_layout',
				'label'   => esc_html__( 'Play Button', 'tripfery-core' ),				
				'options' => array(
					'play-btn-primary' 		=> esc_html__( 'Play Primary', 'tripfery-core' ),
					'play-btn-white' 	 	=> esc_html__( 'Play White', 'tripfery-core' ),
					'play-btn-white-lg' 	=> esc_html__( 'Play White-lg', 'tripfery-core' ),
					'play-btn-transparent' 	=> esc_html__( 'Play transparent', 'tripfery-core' ),
				),
				'default' => 'play-btn-white',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'video_title',
				'label'   => esc_html__( 'Video Title', 'tripfery-core' ),
				'default' => esc_html__( 'Watch Our Presentation!', 'tripfery-core' ),
				'condition'   => array( 'style!' => array( 'style3' ) ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'videourl',
				'label'   => esc_html__( 'Video URL', 'tripfery-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'video_image',
				'label'   => esc_html__( 'Image', 'tripfery-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'tripfery-core' ),
				'condition'   => array( 'style!' => array( 'style3' ) ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'tripfery-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',
				'condition'   => array( 'style!' => array( 'style3' ) ),
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
				'selectors' => [
					'{{WRAPPER}} .rt-video' => 'text-align: {{VALUE}};',
				],
			),		
			array(
				'mode' => 'section_end',
			),
			/*Box section*/
			array(
	            'mode'    => 'section_start',
	            'id'      => 'video_button_style',
	            'label'   => esc_html__( 'Box Style', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	            'condition'   => array( 'style!' => array( 'style3' ) ),
	        ),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-video-layout .rt-video .video-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-video-layout .rt-video .video-title' => 'color: {{VALUE}}',
				),
			),	
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'video_icon_size',
				'label'   => esc_html__( 'Icon Size', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-video-layout .rt-video .rt-icon .rt-play' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'video_icon_color',
				'label'   => esc_html__( 'Icon Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-video-layout .rt-video .rt-icon .rt-play' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bag_color',
				'label'   => esc_html__( 'Image Overlay Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-video-layout .rt-video .rt-img:after' => 'background-color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'border_width',
	            'label'   => __( 'Border Width', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-video-style1 .rt-video .rt-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                  
	            ),
	            'separator' => 'before',
	            'condition'   => array( 'style' => array( 'style1' ) ),
	        ),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'border_color',
				'label'   => esc_html__( 'Border Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-video-style1 .rt-video .rt-img img' => 'background-color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_radius',
	            'label'   => __( 'Box Radius', 'tripfery-core' ),                 
	            'selectors' => array(                  
	                '{{WRAPPER}} .rt-video-layout .rt-video .rt-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                  
	                '{{WRAPPER}} .rt-video-layout .rt-video .rt-img:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                  
	                '{{WRAPPER}} .rt-video-style1 .rt-video .rt-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
	        array(
				'type'    => Group_Control_Css_Filter::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'Image Blend', 'tripfery-core' ),	
				'name' => 'blend', 
				'selector' => '{{WRAPPER}} img',		
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_height',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Image Height', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors' => array( 
					'{{WRAPPER}} .rt-video-layout .rt-video .rt-img img' => 'height: {{SIZE}}{{UNIT}};',
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
			$template = 'rt-video-3';
			break;
			case 'style2':
			$template = 'rt-video-2';
			break;
			default:
			$template = 'rt-video-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}
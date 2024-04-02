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

class RT_Social_Icons extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Social Icons', 'tripfery-core' );
		$this->rt_base = 'rt-social-icons';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$repeater = new \Elementor\Repeater(); 


		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Icon', 'tripfery-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);
		
		$repeater->add_control(
			'link', [
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'URL(optional)', 'tripfery-core' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'https://your-link.com', 'tripfery-core' ),
			]
		);
		$repeater->add_control(
			'icon_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'techkit-core' ),
				'default'  => '',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'title', array(
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Social' , 'tripfery-core' ),
				'label_block' => true,
            )
		);
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'Social Icons', 'tripfery-core' ),
			),			
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'social_icon_list',
				'label'   => esc_html__( 'Social Icons', 'tripfery-core' ),
				'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls(),
				'default' => array(
					[
						'title' => 'Facebook',
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Twitter',
						'social_icon' => [
							'value' => 'fab fa-x-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Pinterest',
						'social_icon' => [
							'value' => 'fab fa-pinterest',
							'library' => 'fa-brands',
						],
					],
				),	
			),
			array(
				'mode' => 'section_end',
			),
			
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Icon Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'content_align',
				'mode'	  => 'responsive',
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
					'{{WRAPPER}} .rt-social a' => 'text-align: {{VALUE}};',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_text_color',
				'label'   => esc_html__( 'Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-social a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_text_color_hover',
				'label'   => esc_html__( 'Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-social a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bag_color',
				'label'   => esc_html__( 'Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-social a' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bag_hover_color',
				'label'   => esc_html__( 'Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-social a::after' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Button Padding', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-social a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'rt-social-icons';
		return $this->rt_template( $template, $data );
	}
}
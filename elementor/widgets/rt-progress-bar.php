<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Progress_Bar extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'RT Progress Bar', 'tripfery-core' );
		$this->rt_base = 'rt-progress-bar';
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
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Total Posts', 'tripfery-core' ),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Style', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-progress-bar .entry-name',
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'number',
				'label'   => esc_html__( 'Percentage', 'tripfery-core' ),
				'default' => array( 'size' => 77 ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number_height',
				'label'   => esc_html__( 'Percentage Height', 'tripfery-core' ),
				'default' => '',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'progress_height',
				'label'   => esc_html__( 'Progress Height', 'tripfery-core' ),
				'default' => '',
				'selectors' => array( '{{WRAPPER}} .rt-progress-bar .progress' => 'height: {{VALUE}}px' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bgcolor_color',
				'label'   => esc_html__( 'Bgcolor', 'tripfery-core' ),
				'default' => '',
				'selectors' => array( '{{WRAPPER}} .rt-progress-bar .progress' => 'background-color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'fgcolor_color',
				'label'   => esc_html__( 'Fgcolor', 'clenix-core' ),
				'default' => '',
				'selectors' => array( '{{WRAPPER}} .rt-progress-bar .progress .progress-bar' => 'background-color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'per_color',
				'label'   => esc_html__( 'Percent Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array( '{{WRAPPER}} .rt-progress-bar .progress .progress-bar > span' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array( '{{WRAPPER}} .rt-progress-bar .entry-name' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'border_color',
				'label'   => esc_html__( 'Border Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array( '{{WRAPPER}} .rt-progress-bar .progress' => 'border-color: {{VALUE}}' ),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'progress_padding',
	            'label'   => __( 'Padding', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-progress-bar .progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'rt-progress-bar';

		return $this->rt_template( $template, $data );
	}
}
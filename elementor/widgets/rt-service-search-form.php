<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use BABE_Post_types;
if ( ! defined( 'ABSPATH' ) ) exit;
class RT_Service_Search_Form extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Services Search Form', 'tripfery-core' );
		$this->rt_base = 'rt-services-search-form';
		parent::__construct( $data, $args );
	}
	public function rt_fields(){
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'post_not_in', [
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Post ID', 'tripfery-core' ),
				'default' => '0',
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
				'id'      => 'price',
				'label'   => esc_html__('Price', 'tripfery-core'),
				'default' => 'Price',
			),

			array(
				'mode' => 'section_end',
			),
			/*Option section*/
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_option_style',
	            'label'   => esc_html__( 'Option', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Sub Title Style', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-case-isotope .rtin-item .rtin-title',
			),

			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'item_title_color',
				'label'   => esc_html__( 'Item Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array( 
					'{{WRAPPER}} .rt-case-isotope .rtin-item .rtin-title a' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'item_title_hov_color',
				'label'   => esc_html__( 'Item Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-case-isotope .rtin-item .rtin-title a:hover' => 'color: {{VALUE}}',
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
		$template = 'rt-service-search-form';
		$this->rt_template($template, $data);
	}
}
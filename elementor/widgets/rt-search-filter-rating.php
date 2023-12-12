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
class RT_Search_Filter_Rating extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'BA Search Filter Ratings', 'tripfery-core' );
		$this->rt_base = 'rt-be-filter-rating';
		parent::__construct( $data, $args );
	}
	public function rt_fields(){
		$terms  = get_terms(array(
			'taxonomy' => 'taxonomies_list',
			'fields' => 'id=>name',
			'hide_empty' => false,
		));
		$category_dropdown = array('0' => esc_html__('Select Category', 'tripfery-core'));
		foreach ($terms as $id => $name) {
			$category_dropdown[$id] = $name;
		}
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'category_list',
				'label'   => esc_html__('Select Category', 'tripfery-core'),
				'options' => $category_dropdown,
				'default' => 'Select Category',
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
		$template = 'rt-search-filter-rating';
		$this->rt_template($template, $data);
	}
}
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
class RT_BE_Search_Form extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'BA Search Form', 'tripfery-core' );
		$this->rt_base = 'rt-be-search-form';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){

		$taxonomies_list = array();
		$taxonomies = get_terms(array(
			'taxonomy' => BABE_Post_types::$taxonomies_list_tax,
			'hide_empty' => false
		));

		$text = [];
		if (!is_wp_error($taxonomies) && !empty($taxonomies)) {
			foreach ($taxonomies as  $key => $tax_term ) {

				$taxonomies_list[$tax_term->slug] = apply_filters('translate_text', $tax_term->name);
				$text[] = array(
					'type'    => Controls_Manager::TEXT,
					'id'      => BABE_Post_types::$attr_tax_pref . $key . '_title',
					'label'        => esc_html__('Title ', 'tripfery-color') . $tax_term->name,
					'default'      => ucfirst($tax_term->name)
				);
			}
		}

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
				'id'      => 'start_date',
				'label'   => esc_html__('Start Date', 'tripfery-core'),
				'default' => esc_html__('Start Date', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'end_date',
				'label'   => esc_html__('End Date', 'tripfery-core'),
				'default' => esc_html__('End Date', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'guests',
				'label'   => esc_html__('Guests', 'tripfery-core'),
				'default' => esc_html__('Guests', 'tripfery-core'),
			),
		);

		$fields2 = array(
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
		return array_merge($fields, $text, $fields2);
	}
	protected function render() {
		$data = $this->get_settings();
		$template = 'rt-be-search-form';
		$this->rt_template($template, $data);
	}
}
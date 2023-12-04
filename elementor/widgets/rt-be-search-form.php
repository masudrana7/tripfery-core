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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_menu',
				'label'       => esc_html__('Display Menu', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
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
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'content_align',
				'mode'    => 'responsive',
				'label'   => esc_html__('Alignment', 'tripfery-core'),
				'options' => array(
					'left' => array(
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __('Center', 'elementor'),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => '',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'button_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__('Form Radius', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rt-search-customize .babe-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
if ( ! defined( 'ABSPATH' ) ) exit;
class RT_Service_Locations extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__('RT Destinations', 'tripfery-core' );
		$this->rt_base = 'rt-service-booking';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'tripfery-core' ),
				'6'  => esc_html__( '2 Col', 'tripfery-core' ),
				'4'  => esc_html__( '3 Col', 'tripfery-core' ),
				'3'  => esc_html__( '4 Col', 'tripfery-core' ),
				'2'  => esc_html__( '6 Col', 'tripfery-core' ),
			),
		);
		parent::__construct( $data, $args );
	}
	public function rt_fields(){
		// Select Location
		$terms  = get_terms(array(
			'taxonomy' => 'ba_locations',
			'fields' => 'id=>name',
			'hide_empty' => false,
		));

		$category_dropdown = array( '0' => esc_html__( 'Select Location', 'tripfery-core' ) );
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}

		// Select Category
		$sec_cat  = get_terms(array(
			'taxonomy' => 'categories',
			'fields' => 'id=>name',
			'hide_empty' => false,
		));

		$cat_dropdown = array( '0' => esc_html__( 'Select Category', 'tripfery-core' ) );
		foreach ($sec_cat as $id => $name ) {
			$cat_dropdown[$id] = $name;
		}
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'category_list',
			[
				'type'    => Controls_Manager::SELECT2,
				'name'    => 'cat_multi_box',
				'label'   => esc_html__('Locations', 'tripfery-core'),
				'options' => $category_dropdown,
				'default' => 'Select Location',
			]
		); 
		$repeater->add_control(
			'sec_cat',
			[
				'type'    => Controls_Manager::SELECT2,
				'name'    => 'cat_box',
				'label'   => esc_html__('Categories', 'tripfery-core'),
				'options' => $cat_dropdown,
				'default' => 'Select Categories',
				'multiple' => true,
			]
		); 
		$repeater->add_control(
			'image',
			[
				'type'  => Controls_Manager::MEDIA,
				'label' => esc_html__('Image', 'tripfery-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'view_all',
			[
				'type'  => Controls_Manager::TEXT,
				'label' => esc_html__('View All', 'tripfery-core'),
				'label_block' => true,
				'default' => 'View All',
				'condition'   => array('style' => array('style6')),
			]
		);
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__('General', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__('Style', 'tripfery-core'),
				'options' => array(
					'style1' => esc_html__('Style 1', 'tripfery-core'),
					'style2' => esc_html__('Style 2', 'tripfery-core'),
					'style3' => esc_html__('Style 3', 'tripfery-core'),
					'style4' => esc_html__('Style 4(Slider)', 'tripfery-core'),
					'style5' => esc_html__('Style 5', 'tripfery-core'),
					'style6' => esc_html__('Style 6', 'tripfery-core'),
					'style7' => esc_html__('Style 7', 'tripfery-core'),
				),
				'default' => 'style1',
			),
			
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'rt-service-booking',
				'label'   => esc_html__('Add as many logos as you want', 'tripfery-core'),
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_category',
				'label'       => esc_html__('Show Navigation', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
				'condition'   => array('style' => array('style4')),
			),	
			array(
				'mode' => 'section_end',
			),
			
			// Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style_option',
				'label'   => esc_html__( 'Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__('Title Typo', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .hotel-name, {{WRAPPER}} .panel .panel-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__('Title Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .hotel-name a, {{WRAPPER}} .panel .panel-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__('Title Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .hotel-name a:hover, {{WRAPPER}} .panel .panel-title a:hover' => 'color: {{VALUE}} !important',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'title_space',
				'mode'          => 'responsive',
				'label'   => esc_html__('Title Space', 'tripfery-core'),
				'size_units' => array('%', 'px'),
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
					'{{WRAPPER}} .hotel-name, {{WRAPPER}} .panel .panel-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'border_height',
				'mode'          => 'responsive',
				'label'   => esc_html__('Border Height', 'tripfery-core'),
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
					'{{WRAPPER}} .rt-destionation-slider .destination-info::after' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array('style' => array('style4', 'style5')),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'activity_color',
				'label'   => esc_html__('Activities Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .panel-content .feature-list li .feature-name' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat_hover_color',
				'label'   => esc_html__('Activities Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .panel-content .feature-list li .feature-name:hover' => 'color: {{VALUE}} !important',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'border_color',
				'label'   => esc_html__('Activities Border Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .panel-content .feature-list li .feature-name' => 'border-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'activity_bg',
				'label'   => esc_html__('Activities BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .panel-content .feature-list li .feature-name' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'activity_bg_hover',
				'label'   => esc_html__('Activities Hover BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .panel-content .feature-list li .feature-name:hover' => 'background-color: {{VALUE}} !important',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'border_hover_color',
				'label'   => esc_html__('Activities Border Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .panel-content .feature-list li .feature-name:hover' => 'border-color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Responsive Grid Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__('Number of Responsive Columns', 'tripfery-core'),
				'condition'   => array('style' => array('style5', 'style6')),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xl',
				'label'   => esc_html__('Desktops: > 1199px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__('Desktops: > 991px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__('Tablets: > 767px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__('Phones: < 768px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__('Small Phones: < 480px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
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
		switch ($data['style']) {
			case 'style7':
				$template = 'rt-servic-locations-grid-7';
				break;
			case 'style6':
				$template = 'rt-servic-locations-grid-6';
				break;
			case 'style5':
				$template = 'rt-servic-locations-grid-5';
				break;
			case 'style4':
				$template = 'rt-servic-locations-slider-4';
				break;
			case 'style3':
				$template = 'rt-servic-locations-grid-3';
				break;
			case 'style2':
				$template = 'rt-servic-locations-grid-2';
				break;
			default:
				$template = 'rt-servic-locations-grid-1';
				break;
		}
		return $this->rt_template($template, $data);
	}
}
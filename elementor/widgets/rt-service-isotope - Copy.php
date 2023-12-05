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

class RT_Service_Isotope extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Category Filter', 'tripfery-core' );
		$this->rt_base = 'rt-services-isotope';
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

	private function rt_load_scripts(){
		wp_enqueue_script( 'isotope-pkgd' );
	}

	public function rt_fields(){
		$terms  = get_terms( array( 'taxonomy' => 'categories', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => __( 'Please Selecet category', 'tripfery-core' ) );
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
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
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__('Style', 'tripfery-core'),
				'options' => array(
					'style1' => esc_html__('Style One', 'tripfery-core'),
					'style2' => esc_html__('Style Two (Car)', 'tripfery-core'),
				),
				'default' => 'style1',
			),
			/*Start category*/			
			array(
				'id'      => 'catid',
				'label' => esc_html__( 'Categories', 'tripfery-core' ),
	            'type' => Controls_Manager::SELECT2,
	            'options' => $category_dropdown,
	            'label_block' => true,
	            'multiple' => true,
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'btn_text',
				'label'   => esc_html__('Button Text', 'tripfery-core'),
				'default' => esc_html__('View Availability', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'act_text',
				'label'   => esc_html__('Activity Text', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'manual',
				'label'   => esc_html__('Manual Text', 'tripfery-core'),
				'default' => esc_html__('Manual', 'tripfery-core'),
				'condition'   => array('style' => array('style2')),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'title_position',
				'label'   => esc_html__('Tilte Position', 'tripfery-core'),
				'options' => array(
					'top'	=> esc_html__('Top', 'tripfery-core'),
					'bottom'	=> esc_html__('Bottom', 'tripfery-core'),
				),
				'default' => 'bottom',
				'condition'   => array('style' => array('style1')),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'rating_display',
				'label'       => esc_html__('Rating Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
				'condition'   => array('style' => array('style1')),
				
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'rating_position',
				'label'   => esc_html__('Rating Position', 'tripfery-core'),
				'options' => array(
					'top'	=> esc_html__('Top', 'tripfery-core'),
					'bottom'	=> esc_html__('Bottom', 'tripfery-core'),
				),
				'default' => 'bottom',
				'condition'   => array('rating_display' => array('yes')),
			),

			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'wishlist_position',
				'label'   => esc_html__('Wishlist Position', 'tripfery-core'),
				'options' => array(
					'top'	=> esc_html__('Top', 'tripfery-core'),
					'bottom'	=> esc_html__('Bottom', 'tripfery-core'),
				),
				'default' => 'bottom',
				'condition'   => array('style' => array('style1')),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__('Button Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
				'condition'   => array('style' => array('style1')),
				
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'price_display',
				'label'       => esc_html__('Price Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
			),
			
			/*Post Order*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_order',
				'label'   => esc_html__( 'Post Ordering', 'tripfery-core' ),
				'options' => array(
					'DESC'	=> esc_html__( 'Desecending', 'tripfery-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'tripfery-core' ),
				),
				'default' => 'DESC',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_orderby',
				'label'   => esc_html__( 'Post Sorting', 'tripfery-core' ),				
				'options' => array(
					'recent' 		=> esc_html__( 'Recent Post', 'tripfery-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'tripfery-core' ),
					'menu_order' 	=> esc_html__( 'Custom Order', 'tripfery-core' ),
					'title' 		=> esc_html__( 'By Name', 'tripfery-core' ),
				),
				'default' => 'recent',
			),	

			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'posts_not_in',
				'label'   => esc_html__( 'Enter Post ID that will not display', 'tripfery-core' ),
				'fields' => $repeater->get_controls(),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_display',
				'label'       => esc_html__( 'Category Name Display', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemnumber',
				'label'   => esc_html__( 'Item Number', 'tripfery-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items( Showing items per category )', 'tripfery-core' ),
			),
			array(
				'mode' => 'section_end',
			),

			/*Location Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'location_style',
				'label'   => esc_html__('Location Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_color',
				'label'   => esc_html__( 'Text Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge .badge-text' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_hover_color',
				'label'   => esc_html__( 'Text Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge:hover .badge-text' => 'color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_icon',
				'label'   => esc_html__( 'Icon Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge .badge-icon' => 'color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_hover_icon',
				'label'   => esc_html__( 'Icon Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge:hover .badge-icon' => 'color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_bg',
				'label'   => esc_html__( 'Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge' => 'background-color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_hover_bg',
				'label'   => esc_html__( 'Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge:hover' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'badge_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'loc_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .badge .badge-text',
			),	
			array(
				'mode' => 'section_end',
			),

			/*Title Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'title_style',
				'label'   => esc_html__('Title Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__('Title Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .listing-card .listing-card-title a' => 'color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__('Title Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .listing-card:hover .listing-card-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .listing-card-title',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),

			/*Price Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'price_style',
				'label'   => esc_html__('Price Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'price_color',
				'label'   => esc_html__('Price Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .listing-card .price-text' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'prcie_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .listing-card .price-text',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'price_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Price Area Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .price-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),

			/*Button Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'button_style',
				'label'   => esc_html__('Button Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_color',
				'label'   => esc_html__('Button Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a' => 'color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_hover_color',
				'label'   => esc_html__('Button Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a:hover' => 'color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_bg_color',
				'label'   => esc_html__('Button Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a' => 'background-color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_bg_hover_color',
				'label'   => esc_html__('Button BG Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a:hover' => 'background-color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'btn_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .price-area a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'btn_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .price-area a',
			),
			
			array(
				'mode' => 'section_end',
			),
			// Global Style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_option_style',
				'label'   => esc_html__('Global Option', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'wishlist_icon_color',
				'label'   => esc_html__('Wishlist Icon Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .wishlist svg' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'wishlist_icon_hover_color',
				'label'   => esc_html__('Wishlist Icon Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .wishlist svg:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'sec_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'img_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__('Image Radius', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card .listing-thumb-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'sec_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__('Button Radius', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'default' => '0.4',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 1199px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Desktops: > 991px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Tablets: > 767px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Phones: < 768px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}
	protected function render()
	{
		$this->rt_load_scripts();
		$data = $this->get_settings();
		switch ($data['style']) {
			case 'style2':
				$template = 'rt-service-isotope-2';
				break;
			default:
				$template = 'rt-service-isotope-1';
				break;
		}
		return $this->rt_template($template, $data);
	}
}
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

class RT_Pricing_Table extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Pricing Table', 'tripfery-core' );
		$this->rt_base = 'rt-pricing-table';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$repeater1 = new \Elementor\Repeater();
		$repeater2 = new \Elementor\Repeater();
		$repeater3 = new \Elementor\Repeater();

		/*Monthly*/
		$repeater1->add_control(
			'title', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Standard Plan', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'price', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price', 'tripfery-core' ),
				'default'  => '$39',
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'offer_price', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Offer Price', 'tripfery-core' ),
				'default'  => '$29',
				'label_block' => true,
			]
		);		
		$repeater1->add_control(
			'unit', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Unit Name', 'tripfery-core' ),
				'default' => esc_html__( 'per month', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'buttonurl', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Link (Optional)', 'tripfery-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'buttontext', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'tripfery-core' ),
				'default' => esc_html__( 'Purchase Now', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'text', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Content', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		/*Yearly*/
		$repeater2->add_control(
			'title2', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Business Plan', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'price2', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price', 'tripfery-core' ),
				'default'  => '$39',
				'label_block' => true,
			]
		);	
		$repeater2->add_control(
			'offer_price2', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Offer Price', 'tripfery-core' ),
				'default'  => '$24',
				'label_block' => true,
			]
		);	
		$repeater2->add_control(
			'unit2', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Unit Name', 'tripfery-core' ),
				'default' => esc_html__( 'per yearly', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'buttonurl2', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Link (Optional)', 'tripfery-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'buttontext2', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'tripfery-core' ),
				'default' => esc_html__( 'Purchase Now', 'tripfery-core' ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'text2', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Content', 'tripfery-core' ),
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
				'label'   => esc_html__( 'Style', 'tripfery-core' ),
				'options' => array(
					'style1' => esc_html__( 'Pricing Tab', 'tripfery-core' ),
					'style2' => esc_html__( 'Pricing Switch', 'tripfery-core' ),
				),
				'default' => 'style1',
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
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'offer_display',
				'label'       => esc_html__( 'Offer', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Content. Default: on', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'offer_text',
				'label'   => esc_html__( 'Offer Text', 'tripfery-core' ),
				'default' => esc_html__( '15% Off', 'tripfery-core' ),
				'condition'   => array( 'offer_display' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'monthly_text',
				'label'   => esc_html__( 'Monthly Text', 'tripfery-core' ),
				'default' => esc_html__( 'Monthly', 'tripfery-core' ),
				'separator' => 'before',
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'feature_monthly',
				'fields' => $repeater1->get_controls(),
				'default' => array(
					['title' => 'Standard Plan', ],
					['title' => 'Business Plan', ],
					['title' => 'Enterise Plan', ],
				),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'yearly_text',
				'label'   => esc_html__( 'Yearly Text', 'tripfery-core' ),
				'default' => esc_html__( 'Yearly', 'tripfery-core' ),
				'separator' => 'before',
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'feature_yearly',
				'fields' => $repeater2->get_controls(),
				'default' => array(
					['title' => 'Standard Plan', ],
					['title' => 'Business Plan', ],
					['title' => 'Enterise Plan', ],
				),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'note_display',
				'label'       => esc_html__( 'Note', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Content. Default: on', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'note_desc',
				'label'   => esc_html__( 'Note Description', 'tripfery-core' ),
				'default' => esc_html__( 'Note: All prices are given in USD exclusive TAX/ VAT. TAX/ VAT will be charged depending on the destination country.', 'tripfery-core' ),
				'condition'   => array( 'note_display' => array( 'yes' ) ),
			),
			array(
				'mode' => 'section_end',
			),
			/*Tab Option*/
			array(
				'mode'    => 'section_start',
				'id'      => 'tab_style',
				'label'   => esc_html__( 'Tab Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'tab_color',
				'label'   => esc_html__( 'Tab Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .nav-tabs .nav-link' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'tab_active_color',
				'label'   => esc_html__( 'Tab Active Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .nav-tabs .nav-link.active' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'tab_bg_color',
				'label'   => esc_html__( 'Tab BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .nav-tabs .nav-link' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'tab_active_bg_color',
				'label'   => esc_html__( 'Tab Active BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .nav-tabs .nav-link.active' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			/*Box Option*/
			array(
				'mode'    => 'section_start',
				'id'      => 'box_style',
				'label'   => esc_html__( 'Box Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_bg_color',
				'label'   => esc_html__( 'Box Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .rt-price-tab-box' => 'background-color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_border_width',
	            'label'   => esc_html__( 'Box Border Width', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-pricing-tab .rt-price-tab-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',            
	            ),	            
	        ),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_border_color',
				'label'   => esc_html__( 'Box Border Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .rt-price-tab-box' => 'border-color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'box_padding',
	            'label'   => __( 'Box Padding', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-pricing-tab .rt-price-tab-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',            
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),
			/*Title Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'title_style',
				'label'   => esc_html__( 'Title Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-tab .price-header .rt-title',
			),			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .price-header .rt-title' => 'color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'title_margin',
	            'label'   => __( 'Title Margin', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-pricing-tab .price-header .rt-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),
			/*Price Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'price_style',
				'label'   => esc_html__( 'Price Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'price_typo',
				'label'   => esc_html__( 'Price Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-tab .price-header .rt-price',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'price_color',
				'label'   => esc_html__( 'Price Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .price-header .rt-price' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'save_price_color',
				'label'   => esc_html__( 'Save Price Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .price-header .save-price' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'save_price_bg_color',
				'label'   => esc_html__( 'Save Price Bg Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .price-header .save-price' => 'background-color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'price_margin',
	            'label'   => __( 'Price Margin', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-pricing-tab .price-header .rt-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),
			/*Content Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'content_style',
				'label'   => esc_html__( 'Content Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content_typo',
				'label'   => esc_html__( 'Content Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-tab .rt-features li',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .rt-features li' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_link_color',
				'label'   => esc_html__( 'Content Link Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .rt-features li a' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'icon_typo',
				'label'   => esc_html__( 'Icon Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-tab .rt-features li i',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-pricing-tab .rt-features li i' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			/*Note Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'note_style',
				'label'   => esc_html__( 'Note Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'note_typo',
				'label'   => esc_html__( 'Note Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .price-note',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'note_color',
				'label'   => esc_html__( 'Note Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-note' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'note_bg_color',
				'label'   => esc_html__( 'Note BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-note' => 'background-color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'note_padding',
	            'label'   => __( 'Note Padding', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .price-note' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
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

		switch ( $data['style'] ) {
			case 'style2':
			$template = 'rt-pricing-switch';
			break;
			default:
			$template = 'rt-pricing-tab';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}
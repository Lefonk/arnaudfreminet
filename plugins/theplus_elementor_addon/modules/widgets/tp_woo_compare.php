<?php
/**
 * Wiget Name: Woo Compare
 * Description: Woo Compare
 * Author: Posimyth
 * Author URI: http://posimyth.com
 *
 * @package WooMultiCompare
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo Multi Step Main Elementor Class
 *
 * @since 5.5.4
 */
class ThePlus_Woo_Compare extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	

	/**
	 * Widget Name.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_name() {
		return 'tp-woo-compare';
	}

	/**
	 * Widget title.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Woo Compare', 'theplus' );
	}

	/**
	 * Widget Icon.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_icon() {
		return 'fa fa-icon-woo-compare theplus_backend_icon';
	}

	/**
	 * Get Custom URL.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Widget categories.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Widget search key words
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_keywords() {
		return array( 'compare', 'woo', 'woo compare', 'match' );
	}

	/**
	 * Register Woo Compare.
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'section_wc_layout',
			array(
				'label' => esc_html__( 'Woo Compare', 'theplus' ),
			)
		);
		$this->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_wc_button',
				'options' => array(
					'tp_wc_button' => esc_html__( 'Button', 'theplus' ),
					'tp_wc_count'  => esc_html__( 'Count', 'theplus' ),
					'tp_wc_list'   => esc_html__( 'List', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'count_type',
			array(
				'label'     => esc_html__( 'Count Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tp_wc_count_button',
				'options'   => array(
					'tp_wc_count_button'    => esc_html__( 'Button', 'theplus' ),
					'tp_wc_count_list_view' => esc_html__( 'List View', 'theplus' ),
				),
				'condition' => array(
					'type' => 'tp_wc_count',
				),
			)
		);
		$this->add_control(
			'countlist_type_notice',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<p class="tp-controller-notice"><i>Note : This Fields Only work with WooCommerce.</i></p>',
				'condition'       => array(
					'type'       => 'tp_wc_count',
					'count_type' => 'tp_wc_count_list_view',
				),
			)
		);
		$this->add_control(
			'query',
			array(
				'label'   => esc_html__( 'Post Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'product',
				'options' => theplus_get_post_type(),
			)
		);
		$this->add_control(
			'uniquename',
			array(
				'label'     => esc_html__( 'Unique Name', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'tp-woocompare',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'query!' => 'product',
				),
			)
		);
		$this->add_control(
			'loading_text',
			array(
				'label'       => __( 'Loading Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Loading...',
				'placeholder' => __( 'Type Your loading Text', 'theplus' ),
				'condition'   => array(
					'type' => 'tp_wc_list',
				),
			)
		);
		$this->add_responsive_control(
			'btn_align',
			array(
				'label'     => __( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare' => 'justify-content:{{VALUE}};',
				),
				'condition' => array(
					'type' => array( 'tp_wc_list', 'tp_wc_count' ),
				),
			)
		);
		$this->end_controls_section();

		/** Button Section Start*/
		$this->start_controls_section(
			'section_wcbtn_layout',
			array(
				'label'     => esc_html__( 'Woo Compare Button', 'theplus' ),
				'condition' => array(
					'type' => 'tp_wc_button',
				),
			)
		);
		$this->add_control(
			'btn_type',
			array(
				'label'   => esc_html__( 'Compare Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_wc_texti',
				'options' => array(
					'tp_wc_icon'  => esc_html__( 'Icon', 'theplus' ),
					'tp_wc_text'  => esc_html__( 'Text', 'theplus' ),
					'tp_wc_texti' => esc_html__( 'Text/Icon', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'cmp_ttl',
			array(
				'label'     => esc_html__( 'Add to Compare', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Add to Compare', 'theplus' ),
				'condition' => array(
					'btn_type!' => 'tp_wc_icon',
				),
			)
		);
		$this->add_control(
			'cmp_rttl',
			array(
				'label'     => esc_html__( 'Remove From Compare', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Remove From Compare', 'theplus' ),
				'condition' => array(
					'btn_type!' => 'tp_wc_icon',
				),
			)
		);
		$this->add_control(
			'cmp_alttl',
			array(
				'label'   => esc_html__( 'Already in Compare', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => esc_html__( 'Already in Compare', 'theplus' ),
			)
		);
		$this->add_control(
			'cmp_add_icon',
			array(
				'label'     => esc_html__( 'Add Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-heart',
					'library' => 'solid',
				),
				'condition' => array(
					'btn_type!' => 'tp_wc_text',
				),
			)
		);
		$this->add_control(
			'cmp_remove_icon',
			array(
				'label'     => esc_html__( 'Remove Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-heart',
					'library' => 'solid',
				),
				'condition' => array(
					'btn_type!' => 'tp_wc_text',
				),
			)
		);
		$this->end_controls_section();

		/** Count Button Section Start*/
		$this->start_controls_section(
			'section_wccountbtn_layout',
			array(
				'label'     => esc_html__( 'Woo Compare Count Button', 'theplus' ),
				'condition' => array(
					'type' => 'tp_wc_count',
				),
			)
		);
		$this->add_control(
			'cnt_btn_text',
			array(
				'label'   => esc_html__( 'Compare Count', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => esc_html__( 'Woo Compare Count', 'theplus' ),
			)
		);
		$this->add_control(
			'count_number',
			array(
				'label'   => esc_html__( 'Count', 'theplus' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 10,
				'step'    => 1,
				'default' => 0,
			)
		);
		$this->add_control(
			'cnt_btn_list_text',
			array(
				'label'       => esc_html__( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Text', 'theplus' ),
				'default'     => esc_html__( 'List', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'count_type' => 'tp_wc_count_list_view',
				),
			)
		);
		$this->add_control(
			'cnt_btn_icon',
			array(
				'label'   => esc_html__( 'Icon Library', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-recycle',
					'library' => 'solid',
				),
			)
		);
		$this->add_control(
			'cnt_btn_url',
			array(
				'label'       => esc_html__( 'URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'count_type' => 'tp_wc_count_button',
				),
			)
		);
		$this->end_controls_section();

		/** List Section Start*/
		$this->start_controls_section(
			'section_wcl_layout',
			array(
				'label'     => esc_html__( 'Woo Compare List', 'theplus' ),
				'condition' => array(
					'type' => 'tp_wc_list',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'tp_wc_field_label',
			array(
				'label'   => esc_html__( 'Label', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'tp_wc_field_type',
			array(
				'label'     => esc_html__( 'Field', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'title',
				'separator' => 'before',
				'options'   => $this->tp_wc_get_all_field_list(),
			)
		);
		$repeater->add_control(
			'tp_wc_field_type_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note : This Fields Only work with WooCommerce.', 'theplus' ),
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'tp_wc_field_type!' => array( 'image', 'title', 'excerpt', 'description', 'custom', 'empty', 'remove', 'acf' ),
				),
			)
		);
		$repeater->add_control(
			'tp_wc_field_acf',
			array(
				'label'     => esc_html__( 'ACF Field Name', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'tp_wc_field_type' => 'acf',
				),
			)
		);
		$repeater->add_control(
			'tp_wc_field_acf_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<p class="tp-controller-notice"><i>Note : This is not work with Repeater Field.</i></p>',
				'condition'       => array(
					'tp_wc_field_type' => 'acf',
				),
			)
		);
		$repeater->add_control(
			'tp_wc_field_custom',
			array(
				'label'     => esc_html__( 'Field Name', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'tp_wc_field_type' => 'custom',
				),
			)
		);
		$repeater->add_control(
			'tp_wc_field_empty',
			array(
				'label'     => esc_html__( 'Empty Content', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'tp_wc_field_type!' => array( 'image', 'title', 'remove', 'acf' ),
				),
			)
		);
		$repeater->add_control(
			'tp_wc_field_add_to_cart',
			array(
				'label'     => esc_html__( 'Add to Cart', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Add to Cart', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'tp_wc_field_type' => 'add-to-cart',
				),
			)
		);
		$repeater->add_control(
			'tp_wc_field_out_of_stock',
			array(
				'label'     => esc_html__( 'Out of Stock', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Out of Stock', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'tp_wc_field_type' => 'add-to-cart',
				),
			)
		);
		$this->add_control(
			'loop_content',
			array(
				'label'       => esc_html__( 'List', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'tp_wc_field_label' => 'Image',
						'tp_wc_field_type'  => 'image',
					),
					array(
						'tp_wc_field_label' => 'Title',
						'tp_wc_field_type'  => 'title',
					),
					array(
						'tp_wc_field_label' => 'Price',
						'tp_wc_field_type'  => 'price',
					),
					array(
						'tp_wc_field_label' => 'Description',
						'tp_wc_field_type'  => 'description',
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tp_wc_field_label }}}',
			)
		);
		$this->end_controls_section();

		/** Icon Styling Section Start*/
		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type'      => 'tp_wc_button',
					'btn_type!' => 'tp_wc_text',
				),
			)
		);
		$this->add_responsive_control(
			'icon_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} i.tp_icon_ad,{{WRAPPER}} .tp_icon_rm, {{WRAPPER}} tp_compare_addr .tp-woo-compare.tp_wc_button button > svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};, height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_icon_tab' );
		$this->start_controls_tab(
			'tab_icon_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'color:{{VALUE}};',
					'{{WRAPPER}} tp_compare_addr .tp-woo-compare.tp_wc_button button > svg' => 'fill:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_icon_ad:hover,{{WRAPPER}} .tp_icon_rm:hover' => 'color:{{VALUE}};',
					'{{WRAPPER}} tp_compare_addr .tp-woo-compare.tp_wc_button button:hover > svg' => 'fill:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Spinner Styling Section Start*/
		$this->start_controls_section(
			'section_spinner_styling',
			array(
				'label'     => esc_html__( 'Spinner', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wc_button',
				),
			)
		);
		$this->add_responsive_control(
			'spin_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-compare .tp-wc-button-loading' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'spin_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare  .tp-wc-button-loading',
			)
		);
		$this->add_control(
			'spin_fill_clr',
			array(
				'label'     => esc_html__( 'Fill Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare  .tp-wc-button-loading' => 'border-top-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Button Styling Section Start*/
		$this->start_controls_section(
			'section_Button_styling',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wc_button',
				),
			)
		);
		$this->add_responsive_control(
			'btn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_compare_addr,{{WRAPPER}} .tp_compare_addrs,{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_compare_addr,{{WRAPPER}} .tp_compare_addrs,{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp_compare_addr,{{WRAPPER}} .tp_compare_addrs,{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove' => 'min-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'Ratingalign',
			array(
				'label'     => __( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare.tp_wc_button' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'btn_typography',
				'selector'  => '{{WRAPPER}} .tp_compare_addr .tp_compare_extra,{{WRAPPER}} .tp_compare_addrs .tp_compare_extra,{{WRAPPER}} .tp_compare_button .tp_compare_extra,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove .tp_compare_extra',
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_btn_tab' );
		$this->start_controls_tab(
			'tab_btn_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'btn_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_compare_addr,{{WRAPPER}} .tp_compare_addrs,{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btn_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove',
			)
		);
		$this->add_responsive_control(
			'btn_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btn_shadow',
				'selector' => '{{WRAPPER}} .tp_compare_button,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_btn_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'btn_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_compare_addr:hover,{{WRAPPER}} .tp_compare_addrs:hover,{{WRAPPER}} .tp_compare_button:hover,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove:hover' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp_compare_button:hover,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btn_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp_compare_button:hover,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove:hover',
			)
		);
		$this->add_responsive_control(
			'btn_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_compare_button:hover,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btn_shadow_h',
				'selector' => '{{WRAPPER}} .tp_compare_button:hover,{{WRAPPER}} .tp-wc-active.tp_woo_compare_remove:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Count Styling Section Start*/
		$this->start_controls_section(
			'section_count_styling',
			array(
				'label'     => esc_html__( 'Count', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wc_count',
				),
			)
		);
		$this->add_responsive_control(
			'cnt_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'cnt_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'cnt_typography',
				'selector'  => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a',
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_cnt_tab' );
		$this->start_controls_tab(
			'tab_cnt_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'cnt_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cnt_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cnt_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a',
			)
		);
		$this->add_responsive_control(
			'cnt_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cnt_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cnt_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'cnt_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a:hover' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cnt_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cnt_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a:hover',
			)
		);
		$this->add_responsive_control(
			'cnt_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cnt_shadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover, {{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_list_view a:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'cntIcn_head',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'cntIcn_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a i,{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a svg' => 'font-size:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cntIcn_tab' );
		$this->start_controls_tab(
			'tab_cntIcn_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'cntIcn_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cntIcn_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'cntIcn_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tp-woo-compare-count-wrapper.tp_wc_count_button a:hover svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'wc_cntNum_head',
			array(
				'label'     => esc_html__( 'Number', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'cntNum_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count' => 'font-size:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cntNum' );
		$this->start_controls_tab(
			'tab_cntNum_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'cntNum_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cntNum_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cntNum_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count',
			)
		);
		$this->add_responsive_control(
			'cntNum_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cntNum_bshadow',
				'selector' => '{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cntNum_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'cntNum_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cntNum_bg_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cntNum_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count:hover',
			)
		);
		$this->add_responsive_control(
			'cntNum_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cntNum_bshadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-compare .tp-woo-compare-count-wrapper .tp-woo-compare-count:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** List-Box Styling Section Start*/
		$this->start_controls_section(
			'section_list_box_styling',
			array(
				'label'     => esc_html__( 'Box', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wc_list',
				),
			)
		);
		$this->add_responsive_control(
			'listbox_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'listbox_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_list_box_tab' );
		$this->start_controls_tab(
			'tab_list_box_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'listbox_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper',
			)
		);
		$this->add_responsive_control(
			'listbox_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'listbox_bshadow',
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_list_box_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'listbox_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'listbox_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'listbox_bshadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** List-Heading Styling Section Start*/
		$this->start_controls_section(
			'section_list_heading_styling',
			array(
				'label'     => esc_html__( 'Heading', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wc_list',
				),
			)
		);
		$this->add_responsive_control(
			'listheading_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'listheading_typo',
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > th',
			)
		);
		$this->start_controls_tabs( 'tabs_list_heading_tab' );
		$this->start_controls_tab(
			'tab_list_heading_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'listheading_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > th' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'listheading_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > th',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_list_heading_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'listheading_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper table tr:hover > th' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'listheading_bg_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper table tr:hover > th',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** List-Content Styling section Start*/
		$this->start_controls_section(
			'section_list_content_styling',
			array(
				'label'     => esc_html__( 'Content', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wc_list',
				),
			)
		);
		$this->add_responsive_control(
			'listcontent_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'listcontent_typo',
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > td',
			)
		);
		$this->start_controls_tabs( 'tabs_list_content_tab' );
		$this->start_controls_tab(
			'tab_list_content_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'listcontent_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > td' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'listcontent_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper table tr > td',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_list_content_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'listcontent_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-compare-table-wrapper table tr:hover > td' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'listcontent_bg_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-compare-table-wrapper table tr:hover > td',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	/**
	 * For the get value of product field.
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	public function tp_wc_get_all_field_list() {

		$value['image'] = 'Image';
		$value['title'] = 'Title';
		$value['price'] = 'Price';

		$value['excerpt']     = 'Excerpt';
		$value['description'] = 'Description';

		$value['sku'] = 'SKU';

		if ( class_exists( 'Woocommerce' ) ) {
			$attributes_tax = wc_get_attribute_taxonomies();
			foreach ( $attributes_tax as $wgalist ) {
				$value[ wc_attribute_taxonomy_name( $wgalist->attribute_name ) ] = $wgalist->attribute_label;
			}
		}

		$value['stock']  = 'Availability';
		$value['weight'] = 'Weight';

		$value['dimension'] = 'Dimension';
		$value['rating']    = 'Rating';

		$value['add-to-cart'] = 'Add to cart';

		$value['remove'] = 'Remove';
		$value['empty']  = 'Empty';
		$value['custom'] = 'Custom Field';

		$value['acf'] = 'ACF';
		return $value;
	}

	/**
	 * Render Woo Compare widget load.
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	public function render() {
		$settings = $this->get_settings_for_display();
		global $product;

		$post_id = get_the_ID();

		$type  = ! empty( $settings['type'] ) ? $settings['type'] : 'tp_wc_button';
		$query = ! empty( $settings['query'] ) ? $settings['query'] : 'product';

		$btn_type = ! empty( $settings['btn_type'] ) ? $settings['btn_type'] : 'tp_wc_texti';
		$cmp_ttl  = ! empty( $settings['cmp_ttl'] ) ? $settings['cmp_ttl'] : '';
		$cmp_rttl = ! empty( $settings['cmp_rttl'] ) ? $settings['cmp_rttl'] : '';

		$load_text  = ! empty( $settings['loading_text'] ) ? $settings['loading_text'] : '';
		$cmp_alttl  = ! empty( $settings['cmp_alttl'] ) ? $settings['cmp_alttl'] : '';
		$count_type = ! empty( $settings['count_type'] ) ? $settings['count_type'] : 'tp_wc_count_button';

		$count_number = ! empty( $settings['count_number'] ) ? $settings['count_number'] : 0;
		$cnt_btn_text = ! empty( $settings['cnt_btn_text'] ) ? $settings['cnt_btn_text'] : '';
		$cmp_add_icon = ! empty( $settings['cmp_add_icon']['value'] ) ? $settings['cmp_add_icon']['value'] : 'fas fa-heart';

		$cmp_remove_icon = ! empty( $settings['cmp_remove_icon']['value'] ) ? $settings['cmp_remove_icon']['value'] : 'far fa-heart';

		$compare_attr = array();

		$compare_attr['type']     = $type;
		$compare_attr['btn_type'] = $btn_type;

		if ( ! empty( $btn_type ) && ( 'tp_wc_text' === $btn_type || 'tp_wc_texti' === $btn_type ) ) {
			$compare_attr['addtext']     = $cmp_ttl;
			$compare_attr['removetext']  = $cmp_rttl;
			$compare_attr['alreadytext'] = $cmp_alttl;
		}

		if ( ! empty( $btn_type ) && ( 'tp_wc_icon' === $btn_type || 'tp_wc_texti' === $btn_type ) ) {
			$compare_attr['addicon']    = $cmp_add_icon; // add condition for icon!
			$compare_attr['removeicon'] = $cmp_remove_icon;
		}

		$compare_attr = htmlspecialchars( wp_json_encode( $compare_attr ), ENT_QUOTES, 'UTF-8' );

		$uniquename = 'tp-woocompare';

		if ( ! empty( $query ) && 'product' !== $query && ! empty( $settings['uniquename'] ) ) {
			$uniquename = $settings['uniquename'];
		}

		$output = '<div class="tp-woo-compare ' . esc_attr( $type ) . '" data-type="' . esc_attr( $type ) . '" data-wid=' . esc_attr( $uniquename ) . '>';

		if ( 'tp_wc_button' === $type ) {
			$output .= '<a class="tp_compare_button" data-product="' . esc_attr( $post_id ) . '" href="#" data-compare="' . esc_attr( $compare_attr ) . '" title="' . esc_attr( $cmp_ttl ) . '">';
			if ( ! empty( $btn_type ) ) {
					$output .= '<button class="tp_compare_addr">';

				if ( ! empty( $btn_type ) && ( 'tp_wc_text' === $btn_type || 'tp_wc_texti' === $btn_type ) ) {
					$output .= '<span class="tp_compare_extra">' . esc_html( $cmp_ttl ) . '</span>';
				}
				if ( ! empty( $btn_type ) && ( 'tp_wc_icon' === $btn_type || 'tp_wc_texti' === $btn_type ) ) {
					$output .= '<i class="tp_icon_rm ' . esc_attr( $cmp_remove_icon ) . '"></i>';
				}
					$output .= '</button>';
			}
					$output .= '</a>';
		} elseif ( 'tp_wc_count' === $type ) {
			$icon = '';

			$button_list_text = '';
			if ( ! empty( $settings['cnt_btn_icon'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['cnt_btn_icon'], array( 'aria-hidden' => 'true' ) );
				$icon = ob_get_contents();
				ob_end_clean();
			}

			if ( 'tp_wc_count_button' === $count_type ) {
				if ( ! empty( $settings['cnt_btn_url']['url'] ) ) {
					$this->add_link_attributes( 'button', $settings['cnt_btn_url'] );
				}
			} elseif ( 'tp_wc_count_list_view' === $count_type ) {
				$button_list_text = ! empty( $settings['cnt_btn_list_text'] ) ? $settings['cnt_btn_list_text'] : '';
			}

			$output .= '<div class="tp-woo-compare-count-wrapper ' . esc_attr( $count_type ) . '" data-count-type="' . esc_attr( $count_type ) . '" >';
			if ( ! empty( $settings['cnt_btn_url']['url'] ) ) {
				$output .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';
			} else {
				$output .= '<a href="#" >' . esc_attr( $button_list_text );
			}

				$output .= $icon;
				$output .= '' . esc_attr( $cnt_btn_text ) . '<div class="tp-woo-compare-count">' . esc_html( $count_number ) . '</div>';

				$output .= '</a>';
				$output .= '</div>';

			if ( 'tp_wc_count' === $type && 'tp_wc_count_list_view' === $count_type ) {
				$output     .= '<div class="tp-wc-count-list-quick-view">';
					$output .= '<div class="tp-wc-count-list-quick-view-close"><i aria-hidden="true" class="fas fa-window-close"></i></div>';
					$output .= '<div class="tp-wc-count-list-quick-view-content"></div>';
				$output     .= '</div>';
			}
		} elseif ( 'tp_wc_list' === $type ) {
			$tabledata = tp_plus_simple_decrypt( wp_json_encode( $settings['loop_content'] ), 'ey' );

			$queryval = tp_plus_simple_decrypt( wp_json_encode( 'product' ), 'ey' );
			if ( ! empty( $query ) && 'product' !== $query ) {
				$queryval = tp_plus_simple_decrypt( wp_json_encode( $query ), 'ey' );
			}

			$output .= '<div class="tp-woo-compare-table-wrapper" data-loadtext = "' . esc_attr( $load_text ) . '" data-tptablewc= \'' . $tabledata . '\' data-query= \'' . $queryval . '\'></div>';
		}

		$output .= '</div>';

		echo $output;
	}
}

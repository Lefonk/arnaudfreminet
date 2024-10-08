<?php
/**
 * Widget Name: Post Meta
 * Description: Post Meta
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Post_Meta
 */
class ThePlus_Post_Meta extends Widget_Base {

	/**
	 * Document Link For Need help
	 *
	 * @var tp_doc of the class
	 */
	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-post-meta';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Post Meta', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-info-circle theplus_backend_icon';
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-builder' );
	}

	/**
	 * Get Custom url
	 *
	 * @since 5.0.0
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Post Meta', 'Custom Fields', 'Post Data', 'Meta Data', 'Advanced Fields' );
	}

	/**
	 * Register controls
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Post Meta', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'metaLayout',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'theplus' ),
					'layout-2' => esc_html__( 'Layout 2', 'theplus' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'sortfield',
			array(
				'label'   => esc_html__( 'Select Field', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'     => esc_html__( 'Date', 'theplus' ),
					'category' => esc_html__( 'Taxonomies', 'theplus' ),
					'author'   => esc_html__( 'Author', 'theplus' ),
					'comments' => esc_html__( 'Comments', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'date_type',
			array(
				'label'     => esc_html__( 'Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'post_published',
				'options'   => array(
					'post_published' => esc_html__( 'Post Published', 'tpebl' ),
					'post_modified'  => esc_html__( 'Post Modified', 'tpebl' ),
				),
				'condition' => array(
					'sortfield' => 'date',
				),
			)
		);
		$repeater->add_control(
			'category_taxonomies',
			array(
				'label'     => esc_html__( 'Taxonomies', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => theplus_get_post_taxonomies(),
				'default'   => 'category',
				'condition' => array(
					'sortfield' => 'category',
				),
			)
		);
		$repeater->add_control(
			'category_taxonomies_load',
			array(
				'label'     => esc_html__( 'Show', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'All', 'theplus' ),
					'bypost'  => esc_html__( 'Current Post', 'theplus' ),
				),
				'condition' => array(
					'sortfield' => 'category',
				),
			)
		);
		$repeater->add_control(
			'category_taxonomies_load_cat_tag',
			array(
				'label'     => esc_html__( 'Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tpcategory',
				'options'   => array(
					'tpcategory' => esc_html__( 'Category', 'theplus' ),
					'tptag'      => esc_html__( 'Tag', 'theplus' ),
				),
				'condition' => array(
					'sortfield'                => 'category',
					'category_taxonomies_load' => 'bypost',
				),
			)
		);
		$this->add_control(
			'metaSort',
			array(
				'label'       => esc_html__( 'Sortable', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'sortfield' => 'date',
					),
					array(
						'sortfield' => 'category',
					),
					array(
						'sortfield' => 'author',
					),
					array(
						'sortfield' => 'comments',
					),

				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ sortfield }}}',
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Box Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'flex-start',
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-meta-info' => 'justify-content: {{VALUE}};',
				),
				'separator' => 'before',

			)
		);
		$this->add_responsive_control(
			'contentalignment',
			array(
				'label'     => esc_html__( 'Content Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'flex-start',
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-meta-info span' => 'display:flex; align-items: {{VALUE}} !important;justify-content: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		/** Meta Info Styling Section*/
		$this->start_controls_section(
			'section_meta_info_style',
			array(
				'label' => esc_html__( 'Meta Info', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'metaTypo',
				'label'    => esc_html__( 'Label Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-meta-label',
			)
		);
		$this->add_control(
			'metaColor',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'metavalueTypo',
				'label'    => esc_html__( 'Value Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-meta-value',
			)
		);
		$this->add_control(
			'metavalueColor',
			array(
				'label'     => esc_html__( 'Value Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-value' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'metatopoffset',
			array(
				'label'       => esc_html__( 'Top Offset', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-value,{{WRAPPER}} .tp-post-meta-info .tp-meta-category-list' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/** Separator Styling Section*/
		$this->start_controls_section(
			'section_separator_style',
			array(
				'label'     => esc_html__( 'Separator', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'metaLayout' => 'layout-1',
				),
			)
		);
		$this->add_control(
			'separator',
			array(
				'label'     => esc_html__( 'Separator', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( ',', 'theplus' ),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner>span:not(:last-child):after' => 'content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'sepColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner>span:not(:last-child):after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'sepSize',
			array(
				'label'       => esc_html__( 'Size', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner>span:not(:last-child):after' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'sepLeftSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Space', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner>span:not(:last-child):after' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'sepRightSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Space', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner>span:not(:last-child):after' => 'margin-right: {{SIZE}}{{UNIT}};',
				),

			)
		);
		$this->end_controls_section();

		/** Post Date Styling Section*/
		$this->start_controls_section(
			'section_post_date_style',
			array(
				'label' => esc_html__( 'Post Date', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'showDate',
			array(
				'label'     => esc_html__( 'Show Post Date', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'datePrefix',
			array(
				'label'       => esc_html__( 'Prefix Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Prefix', 'theplus' ),
				'condition'   => array(
					'showDate' => 'yes',
				),
			)
		);
		$this->add_control(
			'dateIcon',
			array(
				'label'     => esc_html__( 'Select Date Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'                => esc_html__( 'None', 'theplus' ),
					'fas fa-clock'        => esc_html__( 'Clock 1', 'theplus' ),
					'far fa-clock'        => esc_html__( 'Clock 2', 'theplus' ),
					'fas fa-calendar-alt' => esc_html__( 'Calendar 1', 'theplus' ),
					'far fa-calendar-alt' => esc_html__( 'Calendar 2', 'theplus' ),
					'fas fa-calendar-day' => esc_html__( 'Calendar 3', 'theplus' ),
				),
				'condition' => array(
					'showDate' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'dateIconSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Space', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-meta-date i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'showDate'  => 'yes',
					'dateIcon!' => 'none',
				),

			)
		);
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showDate' => 'yes',
				),
			)
		);
		$this->add_control(
			'dateColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-date a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showDate' => 'yes',
				),
			)
		);
		$this->add_control(
			'dateIconColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-date i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showDate'  => 'yes',
					'dateIcon!' => 'none',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showDate' => 'yes',
				),
			)
		);
		$this->add_control(
			'dateHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-date a:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showDate' => 'yes',
				),
			)
		);
		$this->add_control(
			'dateIconHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-date a:hover i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showDate'  => 'yes',
					'dateIcon!' => 'none',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Post Taxonomies Styling Section*/
		$this->start_controls_section(
			'section_post_category_style',
			array(
				'label' => esc_html__( 'Post Taxonomies', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'showCategory',
			array(
				'label'     => esc_html__( 'Post Taxonomies', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'catePrefixType',
			array(
				'label'     => esc_html__( 'Prefix', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pttext',
				'options'   => array(
					'pttext' => esc_html__( 'Text', 'theplus' ),
					'pticon' => esc_html__( 'Icon', 'theplus' ),
				),
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->add_control(
			'catePrefix',
			array(
				'label'     => esc_html__( 'Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'in', 'theplus' ),
				'condition' => array(
					'showCategory'   => 'yes',
					'catePrefixType' => 'pttext',
				),
			)
		);
		$this->add_control(
			'catePrefixIcon',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-list',
					'library' => 'solid',
				),
				'condition' => array(
					'showCategory'   => 'yes',
					'catePrefixType' => 'pticon',
				),
			)
		);
		$this->add_responsive_control(
			'catePrefixIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-meta-category-label i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-meta-category-label svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'showCategory'   => 'yes',
					'catePrefixType' => 'pticon',
				),
			)
		);
		$this->add_control(
			'cateDisplayNo',
			array(
				'label'     => esc_html__( 'Taxonomy Limit', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 200,
				'step'      => 1,
				'default'   => 5,
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_category_style' );
		$this->start_controls_tab(
			'tab_category_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->add_control(
			'cateColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-category a,{{WRAPPER}} .tp-post-meta-info .tp-meta-category:after,{{WRAPPER}} .tp-post-meta-info .tp-meta-category .tp-meta-category-label i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category .tp-meta-category-label svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_category_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->add_control(
			'cateHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-category a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category:hover .tp-meta-category-label svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'cateStyle',
			array(
				'label'     => esc_html__( 'Category Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),

				),
				'separator' => 'before',
				'condition' => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'cateSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Category Space', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'catemargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showCategory' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'catepadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cate_bg_style' );
		$this->start_controls_tab(
			'tab_cate_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'cateBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a',
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cateBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a',
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',

				),
			)
		);
		$this->add_responsive_control(
			'cateBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',

				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cateBoxShadow',
				'selector'  => '{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a',
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cate_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',

				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'cateBgHover',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a:hover',
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',

				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cateBorderHover',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a:hover',
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'cateBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cateBoxShadowHover',
				'selector'  => '{{WRAPPER}} .tp-post-meta-info .tp-meta-category.style-2 a:hover',
				'condition' => array(
					'showCategory' => 'yes',
					'cateStyle'    => 'style-2',

				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Post Author Styling Section*/
		$this->start_controls_section(
			'section_post_author_style',
			array(
				'label' => esc_html__( 'Post Author', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'showAuthor',
			array(
				'label'     => esc_html__( 'Post Author', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'authorPrefix',
			array(
				'label'     => esc_html__( 'Prefix Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'By', 'theplus' ),
				'condition' => array(
					'showAuthor' => 'yes',
				),
			)
		);
		$this->add_control(
			'authorIcon',
			array(
				'label'     => esc_html__( 'Select Author Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'               => esc_html__( 'None', 'theplus' ),
					'fas fa-user'        => esc_html__( 'Icon 1', 'theplus' ),
					'far fa-user'        => esc_html__( 'Icon 2', 'theplus' ),
					'fas fa-user-alt'    => esc_html__( 'Icon 3', 'theplus' ),
					'fas fa-user-circle' => esc_html__( 'Icon 4', 'theplus' ),
					'fas fa-user-tie'    => esc_html__( 'Icon 5', 'theplus' ),
					'profile'            => esc_html__( 'Avatar', 'theplus' ),
				),
				'condition' => array(
					'showAuthor' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'authorIconSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Space', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-meta-author i,{{WRAPPER}} .tp-meta-author img' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'showAuthor'  => 'yes',
					'authorIcon!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'authorIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-meta-author i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'showAuthor'  => 'yes',
					'authorIcon!' => array( 'none', 'profile' ),
				),
			)
		);
		$this->add_responsive_control(
			'authorAvtarSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Avatar Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 24,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-meta-author img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'showAuthor' => 'yes',
					'authorIcon' => 'profile',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_author_style' );
		$this->start_controls_tab(
			'tab_author_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showAuthor' => 'yes',
				),
			)
		);
		$this->add_control(
			'authorColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-author a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showAuthor' => 'yes',
				),
			)
		);
		$this->add_control(
			'authorIconColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-author i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showAuthor'  => 'yes',
					'authorIcon!' => array( 'none', 'avatar' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_author_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showAuthor' => 'yes',
				),
			)
		);
		$this->add_control(
			'authorHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-author a:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showAuthor' => 'yes',
				),
			)
		);
		$this->add_control(
			'authorIconHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-author a:hover i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showAuthor'  => 'yes',
					'authorIcon!' => array( 'none', 'avatar' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Post Taxonomies Styling Section*/
		$this->start_controls_section(
			'section_post_comment_style',
			array(
				'label' => esc_html__( 'Post Comment', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'showComment',
			array(
				'label'     => esc_html__( 'Post Comment', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'commentPrefix',
			array(
				'label'     => esc_html__( 'Prefix Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Comment', 'theplus' ),
				'condition' => array(
					'showComment' => 'yes',
				),
			)
		);
		$this->add_control(
			'commentIcon',
			array(
				'label'     => esc_html__( 'Select Comment Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'                => esc_html__( 'None', 'theplus' ),
					'fas fa-comments'     => esc_html__( 'Icon 1', 'theplus' ),
					'far fa-comments'     => esc_html__( 'Icon 2', 'theplus' ),
					'fas fa-comment-dots' => esc_html__( 'Icon 3', 'theplus' ),
					'far fa-comment-dots' => esc_html__( 'Icon 4', 'theplus' ),
					'far fa-comment'      => esc_html__( 'Icon 5', 'theplus' ),
					'far fa-comment-alt'  => esc_html__( 'Icon 6', 'theplus' ),
				),
				'condition' => array(
					'showComment' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'commentIconSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Space', 'theplus' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-meta-comment i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'showComment'  => 'yes',
					'commentIcon!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'commentIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-meta-comment i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'showComment'  => 'yes',
					'commentIcon!' => 'none',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_auth_comment_style' );
		$this->start_controls_tab(
			'tab_auth_comment_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showComment' => 'yes',
				),
			)
		);
		$this->add_control(
			'commentColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-comment a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showComment' => 'yes',
				),
			)
		);
		$this->add_control(
			'commentIconColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-comment i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showComment'  => 'yes',
					'commentIcon!' => 'none',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_auth_comment_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showComment' => 'yes',
				),
			)
		);
		$this->add_control(
			'commentHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-comment a:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showComment' => 'yes',
				),
			)
		);
		$this->add_control(
			'commentIconHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-meta-comment a:hover i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showComment'  => 'yes',
					'commentIcon!' => 'none',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**Inner Content Area Styling Section*/
		$this->start_controls_section(
			'section_incontent_bg_style',
			array(
				'label' => esc_html__( 'Inner Content Area', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'inpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'inmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_incontent_bg_style' );
		$this->start_controls_tab(
			'tab_incontent_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inboxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inboxBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment',
			)
		);
		$this->add_responsive_control(
			'inboxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inboxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_incontent_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inboxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author:hover, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inboxBorderHover',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author:hover, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment:hover',
			)
		);
		$this->add_responsive_control(
			'inboxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author:hover, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inboxBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-date:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-category:hover,{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-author:hover, {{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner .tp-meta-comment:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**Main Content Area Styling Section*/
		$this->start_controls_section(
			'section_content_bg_style',
			array(
				'label' => esc_html__( 'Main Content Area', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_content_bg_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-meta-info .tp-post-meta-info-inner:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Post Meta
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$post    = get_queried_object();
		$post_id = get_queried_object_id();

		$show_date   = ! empty( $settings['showDate'] ) ? $settings['showDate'] : false;
		$show_author = ! empty( $settings['showAuthor'] ) ? $settings['showAuthor'] : false;
		$meta_layout = ! empty( $settings['metaLayout'] ) ? $settings['metaLayout'] : 'layout-1';
		$date_prefix = ! empty( $settings['datePrefix'] ) ? $settings['datePrefix'] : '';

		$show_comment  = ! empty( $settings['showComment'] ) ? $settings['showComment'] : false;
		$show_category = ! empty( $settings['showCategory'] ) ? $settings['showCategory'] : false;

		$meta_layout_class = 'tp-meta-' . esc_attr( $meta_layout );

		$output  = '<div class="tp-post-meta-info ' . esc_attr( $meta_layout_class ) . '" >';
		$output .= '<div class="tp-post-meta-info-inner">';

		$loop_content = $settings['metaSort'];
		if ( ! empty( $loop_content ) ) {
			$index = 0;
			foreach ( $loop_content as $index => $item ) {
				$sortfield = ! empty( $item['sortfield'] ) ? $item['sortfield'] : 'date';

				if ( 'date' === $sortfield ) {
					if ( $show_date ) {
						$date_icon = '';
						if ( ! empty( $settings['dateIcon'] ) && 'none' !== $settings['dateIcon'] ) {
							$date_icon = '<i class="' . esc_attr( $settings['dateIcon'] ) . '"></i>';
						}
						$date_type  = ! empty( $item['date_type'] ) ? $item['date_type'] : 'post_published';
						$date_mtype = '';

						if ( 'post_modified' === $date_type ) {
							$date_mtype = get_the_modified_date();
						} else {
							$date_mtype = get_the_date();
						}

						$output .= '<span class="tp-meta-date" ><span class="tp-meta-date-label tp-meta-label" >' . esc_html( $date_prefix ) . '</span><a class="tp-meta-value" href="' . esc_url( get_the_permalink() ) . '">' . $date_icon . esc_html( $date_mtype ) . '</a></span>';
					}
				}

				$category_taxonomies = 'category';
				if ( 'category' === $sortfield ) {
					if ( 'yes' === $show_category ) {
						$cate_prefix = '';
						$cate_style  = ! empty( $settings['cateStyle'] ) ? $settings['cateStyle'] : 'style-1';

						$cate_display_no  = ! empty( $settings['cateDisplayNo'] ) ? $settings['cateDisplayNo'] : 5;
						$cate_prefix_type = ! empty( $settings['catePrefixType'] ) ? $settings['catePrefixType'] : 'pttext';

						$category_taxonomies = ! empty( $item['category_taxonomies'] ) ? $item['category_taxonomies'] : 'category';

						if ( 'pttext' === $cate_prefix_type ) {
							$cate_prefix = $settings['catePrefix'];
						} elseif ( 'pticon' === $cate_prefix_type ) {
							ob_start();
							\Elementor\Icons_Manager::render_icon( $settings['catePrefixIcon'], array( 'aria-hidden' => 'true' ) );
							$cate_prefix = ob_get_contents();
							ob_end_clean();
						}

						if ( ! empty( $item['category_taxonomies_load'] ) && 'bypost' === $item['category_taxonomies_load'] ) {
							if ( ! empty( $item['category_taxonomies_load_cat_tag'] ) && 'tptag' === $item['category_taxonomies_load_cat_tag'] ) {
								$terms = get_the_tags( $post_id );
							} elseif ( ! empty( get_post_type() ) && 'product' === get_post_type() && ! empty( $category_taxonomies ) && 'product_tag' === $category_taxonomies ) {
								$terms = get_terms( $settings['post_taxonomies'] );
							} elseif ( ! empty( get_post_type() ) && 'post' !== get_post_type() && ! empty( $category_taxonomies ) && 'category' !== $category_taxonomies ) {
								$terms = get_the_terms( $post_id, $category_taxonomies );
							} else {
								$terms = get_the_category( $post_id );
							}
						} else {
							$terms = get_terms(
								$category_taxonomies,
								array(
									'orderby'    => 'count',
									'hide_empty' => 0,
									'exclude'    => array( 1 ),
								)
							);
						}

						$category_list = '';
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
							$i = 1;
							foreach ( $terms as $term ) {
								if ( $cate_display_no >= $i ) {
									$category_list .= '<a class="tp-meta-value" href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( '%s', 'theplus' ), $term->name ) ) . '">' . $term->name . '</a>';
								}
								++$i;
							}
						}

						$output .= '<span class="tp-meta-category ' . esc_attr( $cate_style ) . '" >';
						if ( ! empty( $cate_prefix ) ) {
							$output .= '<span class="tp-meta-category-label tp-meta-label">' . $cate_prefix . '</span>';
						}
						$output .= '<span class="tp-meta-category-list">' . $category_list . '</span></span>';
					}
				}

				if ( 'author' === $sortfield ) {
					if ( 'yes' === $show_author ) {
						global $post;
						$author_id = $post->post_author;

						$author_icon   = ! empty( $settings['authorIcon'] ) ? $settings['authorIcon'] : 'none';
						$author_prefix = ! empty( $settings['authorPrefix'] ) ? $settings['authorPrefix'] : 'By';

						$iconauthor = '';
						if ( 'profile' === $author_icon ) {
							$iconauthor = '<span>' . get_avatar( get_the_author_meta( 'ID' ), 200 ) . '</span>';
						} elseif ( 'none' !== $author_icon ) {
							$iconauthor = '<i class="' . esc_attr( $author_icon ) . '"></i>';
						}

						$output .= '<span class="tp-meta-author" ><span class="tp-meta-author-label tp-meta-label" >' . esc_html( $author_prefix ) . '</span><a class="tp-meta-value" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="' . esc_attr__( 'author', 'theplus' ) . '">' . $iconauthor . get_the_author_meta( 'display_name', $author_id ) . '</a></span>';
					}
				}

				if ( 'comments' === $sortfield ) {
					if ( ! empty( $show_comment ) ) {
						$count = 0;

						$comment_icon   = '';
						$comment_prefix = ! empty( $settings['commentPrefix'] ) ? $settings['commentPrefix'] : '';
						$comments_count = wp_count_comments( $post_id );

						if ( ! empty( $settings['commentIcon'] ) && 'none' !== $settings['commentIcon'] ) {
							$comment_icon = '<i class="' . esc_attr( $settings['commentIcon'] ) . '"></i>';
						}

						if ( ! empty( $comments_count ) ) {
							$count = $comments_count->total_comments;
						}

						if ( $count === 0 ) {
							$comment_text = 'No Comments';
						} elseif ( $count > 0 ) {
							$comment_text = 'Comments(' . $count . ')';
						}

						$output .= '<span class="tp-meta-comment" ><span class="tp-meta-comment-label tp-meta-label" >' . esc_html( $comment_prefix ) . '</span><a class="tp-meta-value" href="' . esc_url( get_the_permalink() ) . '#respond" rel="' . esc_attr__( 'comment', 'theplus' ) . '">' . $comment_icon . $comment_text . '</a></span>';
					}
				}

				++$index;
			}
		}

		$output .= '</div>';
		$output .= '</div>';

		echo $output;
	}

	/**
	 * Render content_template
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}

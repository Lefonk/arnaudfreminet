<?php
/**
 * Widget Name: TP Search Bar
 * Description: Content of text text block.
 * Author: Theplus
 * Author URI: https://posimyth.com
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
 * Class ThePlus_Search_Filter.
 */
class ThePlus_Search_Bar extends Widget_Base {

	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_name() {
		return 'tp-search-bar';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_title() {
		return esc_html__( 'WP Search Bar', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_icon() {
		return 'fa fa-search theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_categories() {
		return array( 'plus-search-filter' );
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
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_keywords() {
		return array( 'Search bar', 'search widget', 'search element', 'search tool', 'search form', 'search box', 'search input', 'search functionality', 'Elementor', 'widget', 'search bar', 'search', 'bar', 'Elementor Addon' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'Custom_section',
			array(
				'label' => esc_html__( 'Search Bar Fields', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'sourceType',
			array(
				'label'   => __( 'Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''         => __( 'Select Source', 'theplus' ),
					'post'     => __( 'Post', 'theplus' ),
					'taxonomy' => __( 'Taxonomy', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'postType',
			array(
				'label'     => wp_kses_post( "Select Type <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-ajax-search-for-woocommerce-products-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => theplus_get_post_type(),
				'default'   => array( 'post' ),
				'condition' => array(
					'sourceType' => 'post',
				),
			)
		);
		$repeater->add_control(
			'TaxonomyType',
			array(
				'label'     => esc_html__( 'Select Taxonomy', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => theplus_get_post_taxonomies(),
				'condition' => array(
					'sourceType' => 'taxonomy',
				),
			)
		);
		$repeater->add_control(
			'how_it_works_tag',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "search-woocommerce-products-by-tag-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'TaxonomyType' => array( 'product_tag' ),
				),
			)
		);
		$repeater->add_control(
			'work_product-cat',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "search-woocommerce-products-by-category-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'TaxonomyType' => array( 'product_cat' ),
				),
			)
		);
		$repeater->add_control(
			'work_catagory',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "search-by-post-category-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'TaxonomyType' => array( 'category' ),
				),
			)
		);
		$repeater->add_control(
			'how_it_works_post_tag',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "search-by-post-tag-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'TaxonomyType' => array( 'post_tag' ),
				),
			)
		);
		$repeater->add_control(
			'fieldLabel',
			array(
				'label'       => __( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Label', 'theplus' ),
				'placeholder' => __( 'Type your title here', 'theplus' ),
			)
		);
		$repeater->add_control(
			'DefText',
			array(
				'label'       => __( 'Placeholder', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'All Posts', 'theplus' ),
				'placeholder' => __( 'Enter Value', 'theplus' ),
			)
		);

		$repeater->add_control(
			'showCount',
			array(
				'label'     => esc_html__( 'Show Index', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$repeater->add_control(
			'showsubcat',
			array(
				'label'     => esc_html__( 'Show Sub category', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
				'condition' => array(
					'sourceType'   => 'taxonomy',
					'TaxonomyType' => 'category',
				),
			)
		);
		$this->add_control(
			'searchField',
			array(
				'label'       => __( 'Search Bar', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'_id'        => uniqid( 'RId-' ),
						'sourceType' => '',
						'fieldLabel' => 'Label',
						'showCount'  => 'no',
					),
				),
				'title_field' => '{{{ sourceType }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'Search_section',
			array(
				'label' => esc_html__( 'Search Input', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'searchLabel',
			array(
				'label'       => __( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Label', 'theplus' ),
				'placeholder' => __( 'Type your title here', 'theplus' ),
			)
		);
		$this->add_control(
			'placeholder',
			array(
				'label'       => __( 'Placeholder', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Search ...', 'theplus' ),
				'placeholder' => __( 'Type your title here', 'theplus' ),
			)
		);
		$this->add_control(
			'InputIcon',
			array(
				'label'   => __( 'Icon', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-search',
					'library' => 'solid',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'Results_section',
			array(
				'label'     => esc_html__( 'Results Area', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'ResultStyle',
			array(
				'label'   => esc_html__( 'Result Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'postCount',
			array(
				'label'      => __( 'Posts Per Page', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 3,
				),
				'condition'  => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'columnResult',
			array(
				'label'        => __( 'Column', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'ResultStyle' => 'style-2',
				),
			)
		);
		$this->start_popover();
		$this->add_control(
			'inputRADc',
			array(
				'label'   => esc_html__( 'Desktop', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 6,
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_control(
			'inputRATc',
			array(
				'label'   => esc_html__( 'Tablet', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_control(
			'inputRAMc',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '6',
				'separator' => 'after',
				'options'   => theplus_get_columns_list(),
			)
		);
		$this->end_popover();
		$this->add_control(
			'ResultSetting',
			array(
				'label'        => __( 'Result Visibility Settings', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'TitleOn',
			array(
				'label'     => esc_html__( 'Enable Title', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'ContentOn',
			array(
				'label'     => esc_html__( 'Enable Content', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'ThubOn',
			array(
				'label'     => esc_html__( 'Enable Thumb', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'PriceOn',
			array(
				'label'     => esc_html__( 'Enable Price (Woo)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'ShortDescOn',
			array(
				'label'     => esc_html__( 'Enable Short Description', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'totalresult',
			array(
				'label'     => esc_html__( 'Enable Total Count', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'totalresulttxt',
			array(
				'label'       => __( 'Total Result Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Results', 'theplus' ),
				'placeholder' => __( 'Type your title here', 'theplus' ),
			)
		);
		$this->end_popover();

		$this->add_control(
			'TextLimit',
			array(
				'label'        => __( 'Text Limit', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'TxtTitle',
			array(
				'label'     => esc_html__( 'Title Limit', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'TextType',
			array(
				'label'     => esc_html__( 'Limit On', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'TextLimit' => 'yes',
					'TxtTitle'  => 'yes',
				),
			)
		);
		$this->add_control(
			'TextCount',
			array(
				'label'     => esc_html__( 'Limit Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 2000,
				'step'      => 1,
				'default'   => 100,
				'condition' => array(
					'TextLimit' => 'yes',
					'TxtTitle'  => 'yes',
				),
			)
		);
		$this->add_control(
			'TextDots',
			array(
				'label'     => esc_html__( 'Display Dots', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '...', 'theplus' ),
				'separator' => 'after',
				'condition' => array(
					'TextLimit' => 'yes',
					'TxtTitle'  => 'yes',
				),
			)
		);
		$this->add_control(
			'ContentTitle',
			array(
				'label'     => esc_html__( 'Content Limit', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'ContentType',
			array(
				'label'     => esc_html__( 'Limit On', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'TextLimit'    => 'yes',
					'ContentTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'ContentCount',
			array(
				'label'     => esc_html__( 'Limit Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 2000,
				'step'      => 1,
				'default'   => 100,
				'condition' => array(
					'TextLimit'    => 'yes',
					'ContentTitle' => 'yes',
				),
			)
		);
		$this->add_control(
			'ContentDots',
			array(
				'label'     => esc_html__( 'Display Dots', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '...', 'theplus' ),
				'condition' => array(
					'TextLimit'    => 'yes',
					'ContentTitle' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'Resultlink',
			array(
				'label'        => __( 'Result area link', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'ResultlinkOn',
			array(
				'label'        => __( 'Result link Enable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'Resultlinktarget',
			array(
				'label'     => __( 'Result link target', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '_blank',
				'options'   => array(
					'_blank' => __( 'blank', 'theplus' ),
					'_self'  => __( 'self', 'theplus' ),
				),
				'condition' => array(
					'ResultlinkOn' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'ScrollBar',
			array(
				'label'     => esc_html__( 'Enable ScrollBar', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'resultArea',
			array(
				'label'      => __( 'ScrollBar Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 100,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-scrollbar' => 'height:{{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'ScrollBar' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'StandardSearch_section',
			array(
				'label'     => esc_html__( 'Standard Search', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'SearchType',
			array(
				'label'    => __( 'Search Type', 'theplus' ),
				'type'     => Controls_Manager::SELECT,
				'multiple' => true,
				'options'  => array(
					'fullMatch'   => __( 'Full Match', 'theplus' ),
					'wordmatch'   => __( 'Word Match', 'theplus' ),
					'otheroption' => __( 'Default', 'theplus' ),
				),
				'default'  => 'otheroption',
			)
		);
		$this->add_control(
			'GenericFilter',
			array(
				'label'        => __( 'Generic Filters', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'haddingGF',
			array(
				'label'           => '',
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Generic Filters', 'theplus' ),
				'content_classes' => 'gfdhaki',
				'separator'       => 'after',
			)
		);
		$this->add_control(
			'sintitle',
			array(
				'label'     => wp_kses_post( "Search in Title <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "search-posts-by-title-only-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'sinexcerpt',
			array(
				'label'     => esc_html__( 'Search in Excerpt', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'sincontent',
			array(
				'label'     => esc_html__( 'Search in Content', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'sinname',
			array(
				'label'     => esc_html__( 'Search in Permalink', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'sincategory',
			array(
				'label'     => esc_html__( 'Search in Category', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'sinTags',
			array(
				'label'     => esc_html__( 'Search in Tags', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->end_popover();
		$this->add_control(
			'ACFFilter',
			array(
				'label'        => __( 'ACF Filters', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->start_popover();
		$this->add_control(
			'HeaderACF',
			array(
				'label'           => '',
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'ACF Options', 'theplus' ),
				'content_classes' => 'acfdhaki',
				'separator'       => 'after',
			)
		);
		$this->add_control(
			'ACFkey',
			array(
				'label'       => wp_kses_post( "ACF Key <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "search-posts-by-custom-field-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>", 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter ACF Key', 'theplus' ),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		/* Load More/Lazy Load Option start */
		$this->start_controls_section(
			'loadmore_lazyload_section',
			array(
				'label'     => esc_html__( 'Load More/Lazy Load', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'post_extra_option',
			array(
				'label'   => esc_html__( 'Loading Options', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => theplus_post_loading_option(),
			)
		);
		$this->add_control(
			'how_it_works_lazy_load',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-ajax-lazy-load-to-search-result-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'post_extra_option' => array( 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_load_more',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-ajax-load-more-button-to-search-result-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_pagination',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-ajax-pagination-to-search-result-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'showcounter',
			array(
				'label'        => __( 'Counter Enable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'counterlimit',
			array(
				'label'     => __( 'Counter Limit', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'step'      => 1,
				'default'   => '',
				'condition' => array(
					'post_extra_option' => array( 'pagination' ),
					'showcounter'       => 'yes',
				),
			)
		);
		$this->add_control(
			'shownextprev',
			array(
				'label'        => __( 'Arrow Navigation', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'counterstyle',
			array(
				'label'     => __( 'Counter Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'after'  => __( 'After Arrow', 'theplus' ),
					'center' => __( 'Between Arrow', 'theplus' ),
					'before' => __( 'Before Arrow', 'theplus' ),
				),
				'condition' => array(
					'post_extra_option' => array( 'pagination' ),
					'showcounter'       => 'yes',
					'shownextprev'      => 'yes',
				),
			)
		);
		$this->add_control(
			'nexttxt',
			array(
				'label'       => __( 'Next text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Next', 'theplus' ),
				'placeholder' => __( 'Enter Text', 'theplus' ),
				'condition'   => array(
					'shownextprev'      => 'yes',
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'nexticon',
			array(
				'label'     => __( 'Next Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => '',
					'library' => 'solid',
				),
				'condition' => array(
					'shownextprev'      => 'yes',
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'prevtxt',
			array(
				'label'       => __( 'Previous text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Prev', 'theplus' ),
				'placeholder' => __( 'Enter Text', 'theplus' ),
				'condition'   => array(
					'shownextprev'      => 'yes',
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'previcon',
			array(
				'label'     => __( 'Previous Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => '',
					'library' => 'solid',
				),
				'condition' => array(
					'shownextprev'      => 'yes',
					'post_extra_option' => array( 'pagination' ),
				),
			)
		);
		$this->add_control(
			'load_more_btn_text',
			array(
				'label'     => esc_html__( 'Button Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Load More', 'theplus' ),
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'tp_loading_text',
			array(
				'label'     => esc_html__( 'Loading Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Loading...', 'theplus' ),
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'loaded_posts_text',
			array(
				'label'     => esc_html__( 'All Posts Loaded Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All done!', 'theplus' ),
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'load_more_post',
			array(
				'label'     => esc_html__( 'More posts on click/scroll', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 30,
				'step'      => 1,
				'default'   => 4,
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'Load_page',
			array(
				'label'        => __( 'Counter', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_control(
			'loadPagetxt',
			array(
				'label'       => __( 'Counter Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Total :', 'theplus' ),
				'placeholder' => __( 'Enter Title', 'theplus' ),
				'condition'   => array(
					'post_extra_option' => array( 'load_more' ),
					'Load_page'         => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'Extra_section',
			array(
				'label' => esc_html__( 'Extra Option', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'ajaxsearch',
			array(
				'label'     => esc_html__( 'AJAX Search', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'ajaxsearch_Note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b> If you disable this option, Search results will be on search page after redirection.',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'ajaxsearchCharLimit',
			array(
				'label'     => esc_html__( 'Search Character Limit', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 25,
				'step'      => 1,
				'default'   => 3,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'ajaxsearchCharLimit_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b>  After how many characters want to start search AJAX results?',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'ajaxsearch' => 'yes',
				),
			)
		);

		$this->add_control(
			'SpecialCTP',
			array(
				'label'        => __( 'Only for specific CPT', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'SpecialCTP_Note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b> If you disable this option, Search results will be on search page after redirection.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'SpecialCTP' => 'yes',
				),
			)
		);
		$this->add_control(
			'SpecialCTPType',
			array(
				'label'     => esc_html__( 'Special CPT Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'post',
				'options'   => theplus_get_post_type(),
				'condition' => array(
					'SpecialCTP' => 'yes',
				),
			)
		);

		$this->add_control(
			'RelatedSearchPen',
			array(
				'label'        => __( 'Keyword Suggestions Area', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->start_popover();
		$this->add_control(
			'RelatedSearchhead',
			array(
				'label'     => __( 'Keyword Suggestions Area', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$this->add_control(
			'relatedSBtn',
			array(
				'label'     => wp_kses_post( "Below Search Bar <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-keyword-suggestions-below-search-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'related_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b> Add Search terms below search bar for easy access of your popular terms.',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'relatedSBtnText',
			array(
				'label'       => __( 'Label Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Related Search', 'theplus' ),
				'placeholder' => __( 'Enter label Text', 'theplus' ),
				'condition'   => array(
					'relatedSBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'relatedSBtnTag',
			array(
				'label'       => esc_html__( 'Related Tag', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Value', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'relatedSBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'relatedtxt_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b>  Use “|” to enter multiple values in suggestion words.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'relatedSBtn' => 'yes',
				),
			)
		);

		$this->add_control(
			'searchsuggest',
			array(
				'label'     => esc_html__( 'Prefilled Suggestions', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'suggest_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b> These values will come default in search results in the beginning.',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'suggesttxt',
			array(
				'label'       => __( 'Enter Suggestions Word', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => '',
				'placeholder' => __( 'Enter Keyword', 'theplus' ),
				'condition'   => array(
					'searchsuggest' => 'yes',
				),
			)
		);
		$this->add_control(
			'suggesttxt_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<b>Note :</b>  Use “|” to enter multiple values in suggestion words.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'searchsuggest' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'showBtnPen',
			array(
				'label'        => __( 'Search Button', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'showHead',
			array(
				'label'     => __( 'Search Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$this->add_control(
			'showBtn',
			array(
				'label'     => esc_html__( 'Search Button', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'BtnText',
			array(
				'label'       => __( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Search', 'theplus' ),
				'placeholder' => __( 'Enter Button Text', 'theplus' ),
				'condition'   => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnMedia',
			array(
				'label'     => __( 'Button Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => array(
					''      => __( 'None', 'theplus' ),
					'icon'  => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
				),
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnIcon',
			array(
				'label'     => __( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-search',
					'library' => 'solid',
				),
				'condition' => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'icon',
				),
			)
		);
		$this->add_control(
			'BtnImage',
			array(
				'label'     => __( 'Choose Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array( 'url' => Utils::get_placeholder_image_src() ),
				'condition' => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'image',
				),
			)
		);
		$this->add_control(
			'BtnPosition',
			array(
				'label'     => __( 'Button Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'before' => __( 'Before', 'theplus' ),
					'after'  => __( 'After', 'theplus' ),
				),
				'default'   => 'before',
				'condition' => array(
					'showBtn'   => 'yes',
					'BtnText!'  => '',
					'BtnMedia!' => '',
				),
			)
		);
		$this->end_popover();
		$this->add_control(
			'errormsg',
			array(
				'label'       => __( 'Post Not Found Message', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Sorry, No Results Were Found.', 'theplus' ),
				'placeholder' => __( 'Enter Error Text', 'theplus' ),
				'condition'   => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'label_styling',
			array(
				'label' => esc_html__( 'Label', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'lblPadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'lblmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'lblTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label',
			)
		);
		$this->start_controls_tabs( 'lbl_tabs' );
		$this->start_controls_tab(
			'lbl_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'lblNCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'lblNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'lblNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label',
			)
		);
		$this->add_responsive_control(
			'lblNBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'lblNSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-label',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'lbl_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'lblHCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form:hover .tp-search-label' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'lblHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form:hover .tp-search-label',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'lblHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form:hover .tp-search-label',
			)
		);
		$this->add_responsive_control(
			'lblHBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form:hover .tp-search-label' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'lblHSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form:hover .tp-search-label',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'InputF_styling',
			array(
				'label' => esc_html__( 'SearchBox', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'inPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-input-inner-field' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'InInnPad',
			array(
				'label'      => __( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'InWidth',
			array(
				'label'      => __( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-input-field' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'SinputTypo',
				'label'    => __( 'Placeholder Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input',
			)
		);
		$this->add_control(
			'ClosePen',
			array(
				'label'        => __( 'Ajax close/spinner Icon', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->start_popover();
		$this->add_control(
			'SiBoxClose_had',
			array(
				'label'     => __( 'Close Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'EnableCloseBE',
			array(
				'label'        => __( 'Enable In Backend', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'flex',
				'default'      => '',
				'selectors'    => array(
					'{{WRAPPER}} .tp-search-bar.tp-search-backend .tp-search-form .tp-close-btn' => 'display:{{VALUE}}',
				),
				'condition'    => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'CloseIconsize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-close-btn-icon' => 'font-size:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'CloseIconCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-close-btn' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'spinner_had',
			array(
				'label'     => __( 'Spinner', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'EnableSpinnerBE',
			array(
				'label'        => __( 'Enable In Backend', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'flex',
				'default'      => '',
				'selectors'    => array(
					'{{WRAPPER}} .tp-search-bar.tp-search-backend .tp-search-form .tp-ajx-loading' => 'display:{{VALUE}}',
				),
				'condition'    => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'spinnerImgsize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-ajx-loading .tp-spinner-loader' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'spinNCr',
			array(
				'label'     => __( 'Search Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-ajx-loading .tp-spinner-loader' => 'border-top-color:{{VALUE}}',
				),
			)
		);
		$this->end_popover();
		$this->start_controls_tabs( 'input_tabs' );
		$this->start_controls_tab(
			'input_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'PlastxtNCr',
			array(
				'label'     => __( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input::-webkit-input-placeholder' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'intextColor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'inNiconCr',
			array(
				'label'     => __( 'Search Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input-icon svg' => 'width:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'inNiconSvg',
			array(
				'label'      => __( 'Svg Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '20',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inbgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inNBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form input.tp-search-input',
			)
		);
		$this->add_responsive_control(
			'inNBradius',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inNBshadow',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'input_Focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'PlastxtHCr',
			array(
				'label'     => __( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus::placeholder' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'intxtFcolor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'inHiconCr',
			array(
				'label'     => __( 'Search Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus + .tp-search-input-icon ' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus + .tp-search-input-icon svg' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inFbgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inFBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus',
			)
		);
		$this->add_responsive_control(
			'inHBradius',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),

				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inHFBshadow',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'inFB_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'inFB_bf_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'inFB_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'inFB_bf_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-input' => '-webkit-backdrop-filter:grayscale({{inFB_bf_grayscale.SIZE}})  blur({{inFB_bf_blur.SIZE}}{{inFB_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{inFB_bf_grayscale.SIZE}})  blur({{inFB_bf_blur.SIZE}}{{inFB_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'inFB_bf' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'SiBox_had',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'SiBoxPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-form .tp-input-field' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'SiBoxMrg',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-form .tp-input-field' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'SiBox_tabs' );
		$this->start_controls_tab(
			'SiBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'SiBoxNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-form .tp-input-field',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'SiBoxNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-form .tp-input-field',
			)
		);
		$this->add_control(
			'SiBoxNBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-form .tp-input-field' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'SiBoxNSd',
				'selector' => '{{WRAPPER}} .tp-search-form .tp-input-field',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'SiBox_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'SiBoxHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-form .tp-input-field:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'SiBoxHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-form .tp-input-field:hover',
			)
		);
		$this->add_control(
			'SiBoxHBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-form .tp-input-field:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'SiBoxHSd',
				'selector' => '{{WRAPPER}} .tp-search-form .tp-input-field:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'SiBoxSd_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'SiBoxSd_bf_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'SiBoxSd_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'SiBoxSd_bf_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-form .tp-input-field' => '-webkit-backdrop-filter:grayscale({{SiBoxSd_bf_grayscale.SIZE}})  blur({{SiBoxSd_bf_blur.SIZE}}{{SiBoxSd_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{SiBoxSd_bf_grayscale.SIZE}})  blur({{SiBoxSd_bf_blur.SIZE}}{{SiBoxSd_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'SiBoxSd_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		$this->start_controls_section(
			'selectdd_styling',
			array(
				'label' => esc_html__( 'DropDown', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'DDpad',
			array(
				'label'      => __( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-select' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'DDmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-select' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'DDWidth',
			array(
				'label'      => __( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-post-dropdown' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'DDTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-select,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown-menu',
			)
		);
		$this->start_controls_tabs( 'dd_tabs' );
		$this->start_controls_tab(
			'dd_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'DdTxtCrN',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-select,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown-menu' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'DdIconCrN',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-select .tp-dd-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DdBgN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DdTxtBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu',
			)
		);
		$this->add_responsive_control(
			'DdTxtBRsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DdBsdN',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'dd_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'DdTxtCrH',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-select,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-sbar-dropdown-menu' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'DdIconCrH',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-select:hover .tp-dd-icon,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-dd-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DdBgH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-sbar-dropdown-menu',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DdTxtBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-sbar-dropdown-menu',
			)
		);
		$this->add_responsive_control(
			'DdTxtBRsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-sbar-dropdown-menu' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DdBsdH',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover,{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown:hover .tp-sbar-dropdown-menu',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DDMouseHeading',
			array(
				'label'     => __( 'Mouse Hover', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'DdTxtCrMH',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu .tp-searchbar-li:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DdBgMH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu .tp-searchbar-li:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DdBsdMH',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu .tp-searchbar-li:hover',
			)
		);
		$this->add_control(
			'DDScrollHeading',
			array(
				'label'     => __( 'Scroll Bar', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'DDscrollC_style' );
		$this->start_controls_tab(
			'DDscrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DDScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'DDScrollWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DDscrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DDThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'DDThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDThumbBsw',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar-thumb',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DDscrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DDTrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'DDTrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar-track' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDTrackBsw',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-sbar-dropdown .tp-sbar-dropdown-menu::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DDBox_had',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'DDBoxPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'DDBoxMrg',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'DDBox_tabs' );
		$this->start_controls_tab(
			'DDBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DDBoxNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DDBoxNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown',
			)
		);
		$this->add_control(
			'DDBoxNBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDBoxNSd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DDBox_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DDBoxHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DDBoxHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown:hover',
			)
		);
		$this->add_control(
			'DDBoxHBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDBoxHSd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-post-dropdown:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'Button_styling',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'BtnPadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-search-btn' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'BtnMargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-search-btn' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'btnTypo',
				'label'     => __( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-form .tp-search-btn',
				'separator' => 'before',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'Btnalign',
			array(
				'label'     => esc_html__( 'Button Alignment', 'theplus' ),
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
				'default'   => 'left',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-btn-wrap' => 'justify-content:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'Btntxtoffset',
			array(
				'label'      => __( 'Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-search-btn-txt.before' => 'padding-left:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-search-btn-txt.after' => 'padding-right:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'showBtn'  => 'yes',
					'BtnMedia' => array( 'icon', 'image' ),
				),
			)
		);
		$this->start_controls_tabs( 'Button_tabs' );
		$this->start_controls_tab(
			'Button_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'BtnNtxtCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-btn-txt' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnNIconCr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-button-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-button-icon svg' => 'fill:{{VALUE}}',
				),
				'condition' => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'icon',
				),
			)
		);
		$this->add_responsive_control(
			'BtnNIconSvgSize',
			array(
				'label'      => __( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '20',
				),
				'condition'  => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-button-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sbtnBgtype',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-btn',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'sbtnBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-btn',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sbtnBradius',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-search-btn' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'sbtnBshadow',
				'selector'  => '{{WRAPPER}} .tp-search-form .tp-search-btn',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Button_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'BtnHtxtCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}  .tp-search-bar .tp-search-form .tp-search-btn-txt:hover' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnHIconCr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-btn:hover .tp-button-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-btn:hover .tp-button-icon svg' => 'fill:{{VALUE}}',
				),
				'condition' => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'icon',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sbtnHbg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-form .tp-search-btn:hover',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'sbtnHborder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-form .tp-search-btn:hover',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sbtnHBradius',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-form .tp-search-btn:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'sbtnHshadow',
				'selector'  => '{{WRAPPER}} .tp-search-form .tp-search-btn:hover',
				'condition' => array(
					'showBtn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'Btnimg_Hading',
			array(
				'label'     => __( 'Image Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'image',
				),
			)
		);
		$this->add_responsive_control(
			'BtnImgWidth',
			array(
				'label'      => __( 'Image Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-button-ImageTag' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'BtnImgB',
				'label'     => __( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-form-field .tp-button-ImageTag',
				'condition' => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'image',
				),
			)
		);
		$this->add_responsive_control(
			'BtnImgBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-form-field .tp-button-ImageTag' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showBtn'  => 'yes',
					'BtnMedia' => 'image',
				),
			)
		);

		$this->add_control(
			'BtnBox_had',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'BTNBoxPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'BTNBoxMrg',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'BTNBox_tabs' );
		$this->start_controls_tab(
			'BTNBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'BTNBoxNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'BTNBoxNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap',
			)
		);
		$this->add_control(
			'BTNBoxNBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'BTNBoxNSd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'BTNBox_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'BTNBoxHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'BTNBoxHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap:hover',
			)
		);
		$this->add_control(
			'BTNBoxHBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'BTNBoxHSd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form .tp-btn-wrap:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'RA_styling',
			array(
				'label'     => esc_html__( 'Results Box', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaBoxHad',
			array(
				'label' => __( 'Box Option', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'RabPadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RabMargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RaWidth',
			array(
				'label'      => __( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'RaTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area',
			)
		);
		$this->start_controls_tabs( 'Ra_tabs' );
		$this->start_controls_tab(
			'Ra_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RaTxtCrN',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RaTxtBgCrN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area',
			)
		);
		$this->add_responsive_control(
			'RaBRsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaBsdN',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Ra_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RaTxtBgCrH',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'listBgtype',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover',
			)
		);
		$this->add_responsive_control(
			'RaBRsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaBsdH',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'RaIn_styling',
			array(
				'label'     => esc_html__( 'Results Heading', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'RaInPadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RaInMargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'RaInTypo',
				'label'     => __( 'Total Count Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header .tp-search-resultcount',
				'condition' => array(
					'totalresult' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'RaIn_tabs' );
		$this->start_controls_tab(
			'RaIn_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RaInTxtCrN',
			array(
				'label'     => __( 'Total Count Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header .tp-search-resultcount' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'totalresult' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RaInBgCrN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaInBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header',
			)
		);
		$this->add_responsive_control(
			'RaInBRsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaInBsdN',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-header',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RaIn_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RaInTxtCrH',
			array(
				'label'     => __( 'Total Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-header .tp-search-resultcount' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'totalresult' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RaInBgCrH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-header',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaInBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-header',
			)
		);
		$this->add_responsive_control(
			'RaInBRsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaInBsdH',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-header',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'RaInBody_styling',
			array(
				'label'     => esc_html__( 'Results Content', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_control(
			'RainBPadingPop',
			array(
				'label'        => __( 'Padding Option', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_responsive_control(
			'RaInBTitlePad',
			array(
				'label'      => __( 'Title Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-title' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'TitleOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'RaInBContPad',
			array(
				'label'      => __( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-excerpt' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ContentOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'RaInBPricePad',
			array(
				'label'      => __( 'Woo Price Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-price' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'PriceOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'RaInBSdPad',
			array(
				'label'      => __( 'Woo ShortDesc Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-shortDesc' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ShortDescOn' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'RaInBTitleTypo',
				'label'     => __( 'Title Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-title',
				'condition' => array(
					'TitleOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'RaInBContentTypo',
				'label'     => __( 'Content Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-excerpt',
				'condition' => array(
					'ContentOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'RaInBPriceTypo',
				'label'     => __( 'Woo Price Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-price',
				'condition' => array(
					'PriceOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'RaInBSdTypo',
				'label'     => __( 'Woo ShortDesc Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-shortDesc',
				'condition' => array(
					'ShortDescOn' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'RaInBody_tabs' );
		$this->start_controls_tab(
			'RaInBody_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RaTilteTxCrN',
			array(
				'label'     => __( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-title' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'TitleOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaContentTxCrN',
			array(
				'label'     => __( 'Content Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-serpost-title:hover .tp-serpost-title' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'ContentOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaPriceTxCrN',
			array(
				'label'     => __( 'Woo Price Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-price' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'PriceOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaSdTxCrN',
			array(
				'label'     => __( 'Woo Short Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-serpost-shortDesc' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'ShortDescOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RatitleBgCrN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaInBoxN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item',
			)
		);
		$this->add_responsive_control(
			'RaInBoxBrsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaInBoxBsdN',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RaInBody_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RaTilteTxCrH',
			array(
				'label'     => __( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-serpost-title:hover .tp-serpost-title' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'TitleOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaContentTxCrH',
			array(
				'label'     => __( 'Content Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-serpost-excerpt' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'ContentOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaPriceTxCrH',
			array(
				'label'     => __( 'Woo Price Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-serpost-price' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'PriceOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RaSdTxCrH',
			array(
				'label'     => __( 'Woo Short Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-serpost-shortDesc' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'ShortDescOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RatitleBgCrH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaInBoxH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item:hover',
			)
		);
		$this->add_responsive_control(
			'RaInBoxBrsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaInBoxBsdH',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-slider .tp-ser-item:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'RaBodyImage_had',
			array(
				'label'     => __( 'Image Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'ThubOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'RaInBimgPad',
			array(
				'label'      => __( 'Image Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list .tp-item-image' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ThubOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'imagewidth',
			array(
				'label'      => __( 'Image Box Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list .tp-serpost-thumb' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'ThubOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ImageB',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list .tp-item-image',
				'condition' => array(
					'ThubOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ImageBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list .tp-item-image' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ThubOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ImageBSd',
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list .tp-item-image',
				'condition' => array(
					'ThubOn' => 'yes',
				),
			)
		);

		$this->add_control(
			'RaBodyBox_had',
			array(
				'label'     => __( 'Result Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'RaInBPadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RaInBMargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'RaInBBG_tabs' );
		$this->start_controls_tab(
			'RaInBBG_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RaInBBGN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaInBBBGN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list',
			)
		);
		$this->add_responsive_control(
			'RaInBrsBGN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaInBsdBGN',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-search-list',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RaInBBG_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RaInBBGH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-list',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RaInBBBGH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-list',
			)
		);
		$this->add_responsive_control(
			'RaInBrsBGH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-list' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RaInBsdBGH',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area:hover .tp-search-list',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'Pagi_styling',
			array(
				'label'     => esc_html__( 'Pagination', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ajaxsearch'        => 'yes',
					'post_extra_option' => 'pagination',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pagitypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink',
			)
		);
		$this->add_responsive_control(
			'pagitypoSvgIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Svg Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '20',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'Pagi_tabs' );
		$this->start_controls_tab(
			'Pagi_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'pagiColor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pagiBgtype',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pagiBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Pagi_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'pagiHColor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink:hover' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink:hover svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pagihoverBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pagihoverbor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink:hover',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Pagi_Active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'pagiActColor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink.active' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink.active svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pagiActBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink.active',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pagiActbor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-area .tp-pagelink.active',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'Nextbtnhad',
			array(
				'label'     => __( 'Next Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'NextM_Normal' );
		$this->start_controls_tab(
			'Next_Normal',
			array( 'label' => esc_html__( 'Normal', 'theplus' ) )
		);
		$this->add_control(
			'nxtbtntxtNcr',
			array(
				'label'     => __( 'Next button Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-area .tp-pagelink.next' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-area .tp-pagelink.next svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nxtbtntxtNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.next',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nextbtnN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.next',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Next_hover',
			array( 'label' => esc_html__( 'Hover', 'theplus' ) )
		);
		$this->add_control(
			'nxtbtntxtHcr',
			array(
				'label'     => __( 'Next button Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-area .tp-pagelink.next:hover' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-area .tp-pagelink.next:hover svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nxtbtntxtHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.next:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nextbtnH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.next:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'prevbtnhad',
			array(
				'label'     => __( 'Prev Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'prevM_Normal' );
		$this->start_controls_tab(
			'prev_Normal',
			array( 'label' => esc_html__( 'Normal', 'theplus' ) )
		);
		$this->add_control(
			'prebtntxtNcr',
			array(
				'label'     => __( 'Prev button Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-area .tp-pagelink.prev' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-area .tp-pagelink.prev svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'prebtntxtNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.prev',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'PrevbtnN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.prev',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Prev_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'prebtntxtHcr',
			array(
				'label'     => __( 'Prev button Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-area .tp-pagelink.prev:hover' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-area .tp-pagelink.prev:hover svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'prebtntxtHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.prev:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'PrevbtnH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-pagelink.prev:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'adspages_section',
			array(
				'label'     => esc_html__( 'Load More/Lazy Load', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ajaxsearch'        => 'yes',
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_responsive_control(
			'loadmore_Padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .ajax_load_more .post-load-more' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_responsive_control(
			'loadmore_Margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .ajax_load_more .post-load-more' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'load_more_typography',
				'label'     => esc_html__( 'Load More Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'loaded_posts_typo',
				'label'     => esc_html__( 'Loaded All Posts Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .plus-all-posts-loaded',
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_load_more_style' );
		$this->start_controls_tab(
			'tab_load_more_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more,{{WRAPPER}} .ajax_load_more .tp-morefilter:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'loaded_posts_color',
			array(
				'label'     => esc_html__( 'Loaded Posts Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-all-posts-loaded' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'loading_spin_heading',
			array(
				'label'     => esc_html__( 'Loading Spinner ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'post_extra_option' => 'lazy_load',
				),
			)
		);
		$this->add_control(
			'loading_spin_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ajax_lazy_load .post-lazy-load .tp-spin-ring div' => 'border-color: {{VALUE}} transparent transparent transparent',
				),
				'condition' => array(
					'post_extra_option' => 'lazy_load',
				),
			)
		);
		$this->add_responsive_control(
			'loading_spin_size',
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
					'{{WRAPPER}} .ajax_lazy_load .post-lazy-load .tp-spin-ring div' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'post_extra_option' => 'lazy_load',
				),
			)
		);
		$this->add_responsive_control(
			'loading_spin_border_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .ajax_lazy_load .post-lazy-load .tp-spin-ring div' => 'border-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'post_extra_option' => 'lazy_load',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'load_more_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more,{{WRAPPER}} .ajax_load_more .tp-morefilter',
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'load_more_border_N',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .ajax_load_more .post-load-more',
			)
		);
		$this->add_responsive_control(
			'load_more_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .ajax_load_more .post-load-more' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'load_more_shadow',
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more,{{WRAPPER}} .ajax_load_more .tp-morefilter',
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_color_hover',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover,{{WRAPPER}} .ajax_load_more .tp-morefilter:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'load_more_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover,{{WRAPPER}} .ajax_load_more .tp-morefilter:hover',
				'condition' => array(
					'ajaxsearch'        => 'yes',
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'load_more_border_H',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .ajax_load_more .post-load-more:hover',
			)
		);
		$this->add_responsive_control(
			'load_more_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .ajax_load_more .post-load-more:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'load_more_hover_shadow',
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover,{{WRAPPER}} .ajax_load_more .tp-morefilter:hover',
				'condition' => array(
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/*Overlay Option start*/
		$this->start_controls_section(
			'Overlay_section',
			array(
				'label' => esc_html__( 'Overlay Option', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'OverlayOn',
			array(
				'label'     => esc_html__( 'Overlay Enable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'OverlayBg',
				'label'     => __( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-bar .tp-rental-overlay',
				'condition' => array(
					'OverlayOn' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'keywordsuggestionsAreastyle',
			array(
				'label'     => esc_html__( 'Keyword Suggestions Area', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'relatedSBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'RelatedSl_label',
			array(
				'label'     => esc_html__( 'Related Text label', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'BelowSearchlabel',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-title',
			)
		);
		$this->add_responsive_control(
			'RelatedSl_Margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RelatedSl_Padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-title' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'RelatedSl_tabs' );
		$this->start_controls_tab(
			'RelatedSl_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RelatedSl_N_cr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RelatedSl_N_bcr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-related-search-area .tp-rsearch-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RelatedSl_N_b',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-related-search-area .tp-rsearch-title',
			)
		);
		$this->add_responsive_control(
			'RelatedSl_n_brs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-related-search-area .tp-rsearch-title' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RelatedSl_N_bsd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-related-search-area .tp-rsearch-title',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RelatedSl_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RelatedSl_H_cr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-related-search-area:hover .tp-rsearch-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RelatedSl_H_bcr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-related-search-area:hover .tp-rsearch-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RelatedSl_H_b',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-related-search-area:hover .tp-rsearch-title',
			)
		);
		$this->add_responsive_control(
			'RelatedSl_H_brs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-related-search-area:hover .tp-rsearch-title' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RelatedSl_H_bsd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-related-search-area:hover .tp-rsearch-title',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'RelatedSl_tag_label',
			array(
				'label'     => esc_html__( 'Related Tag Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'BelowSearchtag',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname',
			)
		);
		$this->add_responsive_control(
			'RelatedSl_tag_Margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RelatedSl_tag_Padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'RelatedSl_tag_tabs' );
		$this->start_controls_tab(
			'RelatedSl_tag_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RelatedSl_Ntag_cr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RelatedSl_Ntag_bcr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RelatedSl_Ntag_b',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname',
			)
		);
		$this->add_responsive_control(
			'RelatedSl_Ntag_brs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RelatedSl_Ntag_bsd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RelatedSl_tag_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RelatedSl_Htag_cr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RelatedSl_Htag_bcr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RelatedSl_Htag_b',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname:hover',
			)
		);
		$this->add_responsive_control(
			'RelatedSl_Htag_brs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RelatedSl_tagH_bsd',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-rsearch-tag .tp-rsearch-tagname:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'BG_section',
			array(
				'label' => esc_html__( 'Background Option', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'BG_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'flex-end',
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form .tp-form-field' => 'align-items:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'Bg_Padding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'Bg_Margin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'BGControl' );
		$this->start_controls_tab(
			'BGo_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'formBGN',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'formBN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form',
			)
		);
		$this->add_responsive_control(
			'formBBrN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'formNsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form',
			)
		);
		$this->add_control(
			'secbackdropshadown',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'secbackdropshadown_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'secbackdropshadown' => 'yes',
				),
			)
		);
		$this->add_control(
			'secbackdropshadown_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form' => '-webkit-backdrop-filter:grayscale({{secbackdropshadown_grayscale.SIZE}})  blur({{secbackdropshadown_blur.SIZE}}{{secbackdropshadown_blur.UNIT}}) !important;backdrop-filter:grayscale({{secbackdropshadown_grayscale.SIZE}})  blur({{secbackdropshadown_blur.SIZE}}{{secbackdropshadown_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'secbackdropshadown' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'BGo_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'formBGH',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'formBH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form',
			)
		);
		$this->add_responsive_control(
			'formBBrH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'formHsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-form:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'formsd_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'formsd_bf_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'formsd_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'formsd_bf_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-form' => '-webkit-backdrop-filter:grayscale({{formsd_bf_grayscale.SIZE}})  blur({{formsd_bf_blur.SIZE}}{{formsd_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{formsd_bf_grayscale.SIZE}})  blur({{formsd_bf_blur.SIZE}}{{formsd_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'formsd_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		$this->start_controls_section(
			'ScrollBarTab',
			array(
				'label'     => esc_html__( 'Scroll Bar', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ScrollBar' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'scrollC_style' );
		$this->start_controls_tab(
			'scrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'ScrollWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'ThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar-thumb' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ThumbBsw',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar-thumb',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'TrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar-track' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TrackBsw',
				'selector' => '{{WRAPPER}} .tp-search-bar .tp-search-scrollbar::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'errorsection',
			array(
				'label'     => esc_html__( 'Error Option', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ajaxsearch' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ErrorTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error',
			)
		);
		$this->add_control(
			'errorpadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-area .tp-search-error.active' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'errortabs' );
		$this->start_controls_tab(
			'errorNormal',
			array( 'label' => esc_html__( 'Normal', 'theplus' ) )
		);
		$this->add_control(
			'errortxtNCr',
			array(
				'label'     => __( 'Text color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-area .tp-search-error' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'errorNbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'errorNb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'errornsd',
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'errorhover',
			array( 'label' => esc_html__( 'Hover', 'theplus' ) )
		);
		$this->add_control(
			'errortxtHCr',
			array(
				'label'     => __( 'Text color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-area .tp-search-error:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'errorHbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'errorHb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'errorhsd',
				'selector' => '{{WRAPPER}} .tp-search-area .tp-search-error:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation_styling',
			array(
				'label' => esc_html__( 'On Scroll View Animation', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'animation_effects',
			array(
				'label'   => esc_html__( 'In Animation Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no-animation',
				'options' => theplus_get_animation_options(),
			)
		);
		$this->add_control(
			'animation_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Delay', 'theplus' ),
				'default'   => array(
					'unit' => '',
					'size' => 50,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 4000,
						'step' => 15,
					),
				),
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);

		$this->add_control(
			'animated_column_list',
			array(
				'label'     => esc_html__( 'List Load Animation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					'stagger' => esc_html__( 'Stagger Based Animation', 'theplus' ),
				),
				'condition' => array(
					'animation_effects!' => array( 'no-animation' ),
				),
			)
		);
		$this->add_control(
			'animation_stagger',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Stagger', 'theplus' ),
				'default'   => array(
					'unit' => '',
					'size' => 150,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 6000,
						'step' => 10,
					),
				),
				'condition' => array(
					'animation_effects!'   => array( 'no-animation' ),
					'animated_column_list' => 'stagger',
				),
			)
		);

		$this->add_control(
			'animation_duration_default',
			array(
				'label'     => esc_html__( 'Animation Duration', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animate_duration',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Duration Speed', 'theplus' ),
				'default'   => array(
					'unit' => 'px',
					'size' => 50,
				),
				'range'     => array(
					'px' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'condition' => array(
					'animation_effects!'         => 'no-animation',
					'animation_duration_default' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$elementer_i_d = $this->get_unique_selector();

		$page_i_d = get_the_ID();
		$WidgetId = uniqid( 'uId-' );
		$output   = '';

		$Backclass   = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? 'tp-search-backend' : '';
		$AJAXSearch  = ! empty( $settings['ajaxsearch'] ) ? true : false;
		$PageStyle   = isset( $settings['post_extra_option'] ) ? $settings['post_extra_option'] : 'none';
		$LoadPage    = ! empty( $settings['Load_page'] ) ? 1 : 0;
		$scrollclass = ! empty( $settings['ScrollBar'] ) ? 'tp-search-scrollbar' : '';
		$Overlay     = ! empty( $settings['OverlayOn'] ) ? $settings['OverlayOn'] : '';
		$SearchType  = ! empty( $settings['SearchType'] ) ? $settings['SearchType'] : 'otheroption';
		$totalresult = ! empty( $settings['totalresult'] ) ? 1 : 0;
		$RelatedSBtn = ! empty( $settings['relatedSBtn'] ) ? 1 : 0;
		$SubRefresh  = ! empty( $settings['showBtn'] ) ? 'true' : 'false';

		/*--On Scroll View Animation ---*/
		$Plus_Listing_block = 'Plus_Listing_block';
		$animated_columns   = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$Rcolumn = '';
		$RStyle  = ! empty( $settings['ResultStyle'] ) ? $settings['ResultStyle'] : 'style-1';
		if ( 'style-2' === $RStyle ) {
			$Rcolumn = $this->tp_search_column( $settings['inputRADc'], $settings['inputRATc'], $settings['inputRAMc'] );
		} else {
			$Rcolumn = 'tp-col-lg-12 tp-col-md-12 tp-col-sm-12 tp-col-12';
		}

		if ( ! empty( $AJAXSearch ) ) {
			$PageData = $GFilter = array();

			$AcfData = array(
				'ACFEnable' => ! empty( $settings['ACFFilter'] ) ? 1 : 0,
				'ACFkey'    => ! empty( $settings['ACFkey'] ) ? $settings['ACFkey'] : '',
			);

			$ResultOnOff = array(
				'ONTitle'           => ! empty( $settings['TitleOn'] ) ? 1 : 0,
				'ONContent'         => ! empty( $settings['ContentOn'] ) ? 1 : 0,
				'ONThumb'           => ! empty( $settings['ThubOn'] ) ? 1 : 0,
				'ONPrice'           => ! empty( $settings['PriceOn'] ) ? 1 : 0,
				'ONShortDesc'       => ! empty( $settings['ShortDescOn'] ) ? 1 : 0,
				'TotalResult'       => $totalresult,
				'TotalResultTxt'    => ! empty( $totalresult ) ? $settings['totalresulttxt'] : '',
				'ResultlinkOn'      => ! empty( $settings['ResultlinkOn'] ) ? 1 : 0,
				'Resultlinktarget'  => ! empty( $settings['Resultlinktarget'] ) ? $settings['Resultlinktarget'] : '',
				'textlimit'         => ! empty( $settings['TextLimit'] ) ? 1 : 0,
				'TxtTitle'          => ! empty( $settings['TxtTitle'] ) ? 1 : 0,
				'texttype'          => ! empty( $settings['TextType'] ) ? $settings['TextType'] : '',
				'textcount'         => ! empty( $settings['TextCount'] ) ? $settings['TextCount'] : 100,
				'textdots'          => ! empty( $settings['TextDots'] ) ? $settings['TextDots'] : '',
				'Txtcont'           => ! empty( $settings['ContentTitle'] ) ? 1 : 0,
				'ContType'          => ! empty( $settings['ContentType'] ) ? $settings['ContentType'] : '',
				'ContCount'         => ! empty( $settings['ContentCount'] ) ? $settings['ContentCount'] : 100,
				'ContDots'          => ! empty( $settings['ContentDots'] ) ? $settings['ContentDots'] : '',
				'animation_effects' => ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : 'no-animation',
				'errormsg'          => ! empty( $settings['errormsg'] ) ? $settings['errormsg'] : 'Sorry, But Nothing Matched Your Search Terms.',
			);

			if ( 'pagination' === $PageStyle ) {
				$PageData = array(
					'Pagestyle'   => $PageStyle,
					'Pcounter'    => ! empty( $settings['showcounter'] ) ? 1 : 0,
					'PClimit'     => ! empty( $settings['counterlimit'] ) ? $settings['counterlimit'] : 5,
					'PNavigation' => ! empty( $settings['shownextprev'] ) ? 1 : 0,
					'PNxttxt'     => ! empty( $settings['nexttxt'] ) ? $settings['nexttxt'] : '',
					'PPrevtxt'    => ! empty( $settings['prevtxt'] ) ? $settings['prevtxt'] : '',
					'PNxticon'    => ! empty( $settings['nexticon'] ) ? $settings['nexticon']['value'] : '',
					'PPrevicon'   => ! empty( $settings['previcon'] ) ? $settings['previcon']['value'] : '',
					'Pstyle'      => ! empty( $settings['counterstyle'] ) ? $settings['counterstyle'] : 'center',
				);
			} else {
				$PageData = array(
					'Pagestyle'   => $PageStyle,
					'loadbtntxt'  => ! empty( $settings['load_more_btn_text'] ) ? $settings['load_more_btn_text'] : '',
					'loadingtxt'  => ! empty( $settings['tp_loading_text'] ) ? $settings['tp_loading_text'] : '',
					'loadedtxt'   => ! empty( $settings['loaded_posts_text'] ) ? $settings['loaded_posts_text'] : '',
					'loadnumber'  => ! empty( $settings['load_more_post'] ) ? $settings['load_more_post'] : '',
					'loadpage'    => $LoadPage,
					'loadPagetxt' => ! empty( $settings['loadPagetxt'] ) ? $settings['loadPagetxt'] : '',
				);
			}

			if ( ! empty( $settings['GenericFilter'] ) ) {
				$GFilter = array(
					'GFEnable'   => 1,
					'GFSType'    => $SearchType,
					'GFTitle'    => ! empty( $settings['sintitle'] ) ? 1 : 0,
					'GFContent'  => ! empty( $settings['sincontent'] ) ? 1 : 0,
					'GFName'     => ! empty( $settings['sinname'] ) ? 1 : 0,
					'GFExcerpt'  => ! empty( $settings['sinexcerpt'] ) ? 1 : 0,
					'GFCategory' => ! empty( $settings['sincategory'] ) ? 1 : 0,
					'GFTags'     => ! empty( $settings['sinTags'] ) ? 1 : 0,
				);
			} else {
				$GFilter = array(
					'GFEnable' => 0,
					'GFSType'  => $SearchType,
				);
			}

			$AcfData     = 'data-acfdata="' . htmlspecialchars( json_encode( $AcfData, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			$ResultOnOff = 'data-result-setting="' . htmlspecialchars( json_encode( $ResultOnOff, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			$PageJson    = 'data-pagination-data="' . htmlspecialchars( json_encode( $PageData, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			$GFarray     = 'data-genericfilter="' . htmlspecialchars( json_encode( $GFilter, true ), ENT_QUOTES, 'UTF-8' ) . '"';
		} else {
			$PageJson    = '';
			$GFarray     = '';
			$ResultOnOff = '';
			$AcfData     = '';
		}

		$Defa_Postype = $Defa_tex = array();
		$temp         = ! empty( $settings['searchField'] ) ? $settings['searchField'] : array();
		if ( ! empty( $temp ) ) {
			foreach ( $temp as $item ) {
				$STY      = ! empty( $item['sourceType'] ) ? $item['sourceType'] : 'post';
				$PostType = ! empty( $item['postType'] ) ? $item['postType'] : array( 'post' );

				if ( $STY == 'post' ) {
					foreach ( $PostType as $item1 ) {
						$Defa_Postype[] = $item1;
					}
				}
			}
		}

		$SpecialCTP      = ! empty( $settings['SpecialCTP'] ) ? 1 : 0;
		$SpecialCTPType  = ! empty( $settings['SpecialCTPType'] ) ? $settings['SpecialCTPType'] : 'post';
		$DefaultSettingg = array(
			'Def_Post'       => $Defa_Postype,
			'SpecialCTP'     => $SpecialCTP,
			'SpecialCTPType' => $SpecialCTPType,
		);
		$DefaultSetting  = json_encode( $DefaultSettingg, true );

		$dataattr = array(
			'ajax'                => ! empty( $settings['ajaxsearch'] ) ? 'yes' : 'no',
			'nonce'               => wp_create_nonce( 'tp-searchbar' ),
			'ajaxsearchCharLimit' => ! empty( $settings['ajaxsearchCharLimit'] ) ? $settings['ajaxsearchCharLimit'] : 3,
			'style'               => $RStyle,
			'styleColumn'         => $Rcolumn,
			'post_page'           => ( ! empty( $settings['postCount'] ) && ! empty( $settings['postCount']['size'] ) ) ? (int) $settings['postCount']['size'] : 3,
			'Postype_Def'         => $Defa_Postype,
		);
		$dataattr = htmlspecialchars( json_encode( $dataattr ), ENT_QUOTES, 'UTF-8' );

		$output .= '<div class="tp-search-bar ' . esc_attr( $Backclass ) . ' ' . esc_attr( $WidgetId ) . '" data-id="' . esc_attr( $WidgetId ) . '" data-ajax_search=\'' . $dataattr . '\' ' . $GFarray . ' ' . $ResultOnOff . ' ' . $PageJson . ' ' . $AcfData . ' data-default-data= \'' . $DefaultSetting . '\' >';
		if ( 'yes' === $Overlay ) {
			$output .= '<div class="tp-rental-overlay"></div>';
		}

		$output .= '<form class="tp-search-form" method="get" action="' . esc_url( site_url() ) . '" onSubmit="return ' . esc_attr( $SubRefresh ) . ';">';

		$output .= '<div class="tp-form-field tp-row">';

		$output .= $this->tp_search_repeater( $settings, $WidgetId );

		$output .= $this->tp_search_button( $settings );

		if ( ! empty( $SpecialCTP ) ) {
			$output .= '<input type="hidden" name="post_type" value="' . esc_attr( $SpecialCTPType ) . '" />';
		}
				$output .= '</div>';
			$output     .= '</form>';

		if ( ! empty( $AJAXSearch ) ) {
			$output     .= '<div class="tp-search-area ' . esc_attr( $RStyle ) . '">';
				$output .= '<div class="tp-search-error"></div>';
				$output .= '<div class="tp-search-header">';

			if ( ! empty( $totalresult ) ) {
				$output .= '<div class="tp-search-resultcount"></div>';
			}

			if ( ( 'pagination' === $PageStyle ) || ( 'load_more' === $PageStyle && ! empty( $LoadPage ) ) ) {
				$output .= '<div class="tp-search-pagina"></div>';
			}

				$output .= '</div>';
				$output .= '<div class="tp-search-list ">';
				$output .= '<div class="tp-search-list-inner ' . $animated_class . '" ' . $animation_attr . '></div>';
				$output .= '</div>';

			if ( 'load_more' === $PageStyle ) {
				$output .= '<div class="ajax_load_more"></div>';
			} elseif ( 'lazy_load' === $PageStyle ) {
				$output .= '<div class="ajax_lazy_load"></div>';
			}

			$output .= '</div>';
		}

		if ( ! empty( $RelatedSBtn ) ) {
			$RelatedSBtn    = ! empty( $settings['relatedSBtnText'] ) ? $settings['relatedSBtnText'] : '';
			$RelatedSBtnTag = ! empty( $settings['relatedSBtnTag'] ) ? explode( '|', $settings['relatedSBtnTag'] ) : array();

			$output .= '<div class="tp-related-search-area">';
			if ( ! empty( $RelatedSBtn ) ) {
				$output .= '<div class="tp-rsearch-title">' . esc_html( $RelatedSBtn ) . '</div>';
			}

			if ( ! empty( $RelatedSBtnTag ) ) {
				$output .= '<div class="tp-rsearch-tag">';

				foreach ( $RelatedSBtnTag as $item ) {
					$tagname = ltrim( rtrim( ucwords( $item ) ) );
					$output .= '<a href="" class="tp-rsearch-tagname">' . esc_html( $tagname ) . '</a>';
				}

				$output .= '</div>';
			}

			$output .= '</div>';
		}
		$output .= '</div>';
		echo $output;
	}

	/**
	 * Generate HTML markup for a search bar with options and dropdowns.
	 *
	 * @param array  $attr     Attributes for the search bar.
	 * @param string $WidgetId Widget ID for unique identification.
	 *
	 * @return string HTML markup for the search bar.
	 */
	protected function tp_search_repeater( $attr, $WidgetId ) {
		$output      = '';
		$placeholder = ! empty( $attr['placeholder'] ) ? $attr['placeholder'] : '';
		$searchLabel = ! empty( $attr['searchLabel'] ) ? $attr['searchLabel'] : '';
		$InputIcon   = ! empty( $attr['InputIcon'] ) ? $attr['InputIcon']['value'] : '';
		$searchField = ! empty( $attr['searchField'] ) ? $attr['searchField'] : array();
		$suggestOn   = ! empty( $attr['searchsuggest'] ) ? 1 : 0;
		$suggestTxt  = ! empty( $attr['suggesttxt'] ) ? $attr['suggesttxt'] : '';

		$suggest = $suggestlist = '';
		if ( $suggestOn ) {
			$suggestlist = 'list="tp-input-suggestions"';
			$sugExplod   = explode( '|', $suggestTxt );
			$suggest    .= '<datalist id="tp-input-suggestions">';
			foreach ( $sugExplod as $two ) {
				$suggest .= '<option value="' . ltrim( rtrim( $two ) ) . '">';
			}
			$suggest .= '</datalist>';
		}

		$output     .= '<div class="tp-input-field">';
			$output .= '<div class="tp-input-label-field">';
		if ( ! empty( $searchLabel ) ) {
			$output .= '<label class="tp-search-label">' . esc_attr( $searchLabel ) . '</label>';
		}
			$output .= '</div>';

			$output     .= '<div class="tp-input-inner-field">';
				$output .= '<input type="text" name="s" ' . $suggestlist . ' class="tp-search-input" id="seatxt-' . esc_attr( $WidgetId ) . '" placeholder="' . esc_attr( $placeholder ) . '" autocomplete="off" />';
				$output .= $suggest;

		if ( ! empty( $attr['InputIcon'] ) && ! empty( $attr['InputIcon']['value'] ) ) {
			ob_start();
				\Elementor\Icons_Manager::render_icon( $attr['InputIcon'], array( 'aria-hidden' => 'true' ) );
				$Icon = ob_get_contents();
			ob_end_clean();
			$output .= '<span class="tp-search-input-icon">' . $Icon . '</span>';
		}

				$output .= '<div class="tp-ajx-loading"><div class="tp-spinner-loader"></div></div>';
				$output .= '<span class="tp-close-btn"><i class="fas fa-times-circle tp-close-btn-icon"></i></span>';
			$output     .= '</div>';
		$output         .= '</div>';

		if ( ! empty( $searchField ) ) {
			foreach ( $searchField as $index => $item ) {
				$FieldValue   = '';
				$sourceType   = ! empty( $item['sourceType'] ) ? $item['sourceType'] : '';
				$PostData     = ! empty( $item['postType'] ) ? $item['postType'] : array( 'post' );
				$taxonomyData = ! empty( $item['TaxonomyType'] ) ? $item['TaxonomyType'] : '';
				$showsubcat   = ! empty( $item['showsubcat'] ) ? $item['showsubcat'] : '';

				$DataArray = array();
				if ( ( 'post' === $sourceType ) && ( ! empty( $PostData ) && is_array( $PostData ) || is_object( $PostData ) ) ) {
					foreach ( $PostData as $value ) {
						$post_type_object = get_post_type_object( $value );

						$getlabel = $value;
						if ( ! empty( $post_type_object ) && isset( $post_type_object->label ) ) {
							$getlabel = $post_type_object->label;
						}

						$count               = wp_count_posts( $value );
						$countNum            = ! empty( $count->publish ) ? $count->publish : 0;
						$DataArray[ $value ] = array(
							'name'  => $getlabel,
							'count' => $countNum,
						);
					}

					if ( ! empty( $DataArray ) ) {
						$FieldValue .= $this->tp_search_drop_down( $DataArray, 'post', $WidgetId, $taxonomy = '', $item );
					}
				} elseif ( 'taxonomy' === $sourceType && ! empty( $taxonomyData ) ) {
					$cat_args  = array(
						'taxonomy'   => $taxonomyData,
						'parent'     => 0,
						'hide_empty' => false,
					);
					$tax_terms = get_categories( $cat_args );

					foreach ( $tax_terms as $index => $value ) {
						$Name   = ! empty( $value->name ) ? $value->name : '';
						$Number = ! empty( $value->category_count ) ? $value->category_count : 0;
						$TermId = ! empty( $value->term_id ) ? $value->term_id : '';

						$DataArray[ $TermId ] = array(
							'name'   => $Name,
							'count'  => $Number,
							'parent' => '',
						);

						if ( 'category' === $taxonomyData && 'yes' === $showsubcat ) {
							$args2 = array(
								'taxonomy'     => $taxonomyData,
								'child_of'     => 0,
								'parent'       => $TermId,
								'orderby'      => 'name',
								'show_count'   => 1,
								'pad_counts'   => 0,
								'hierarchical' => 1,
								'title_li'     => '',
								'hide_empty'   => 0,
							);

							$tax_terms2 = get_categories( $args2 );
							foreach ( $tax_terms2 as $one ) {
								$Oname                      = ! empty( $one->name ) ? $one->name : '';
								$Ocount                     = ! empty( $one->count ) ? $one->count : '';
								$DataArray[ $one->term_id ] = array(
									'name'   => ' - ' . ucwords( $Oname ),
									'count'  => $Ocount,
									'parent' => $Name,
								);
							}
						}
					}

					if ( ! empty( $DataArray ) ) {
						$FieldValue .= $this->tp_search_drop_down( $DataArray, 'category', $WidgetId, $taxonomy = $taxonomyData, $item );
					}
				}

				if ( ! empty( $FieldValue ) ) {
					$output .= '<div class="tp-post-dropdown">' . $FieldValue . '</div>';
				}
			}
		}

		return $output;
	}

	/**
	 * Generate HTML markup for a dropdown menu in a search bar.
	 *
	 * @param array  $data     Data for the dropdown menu.
	 * @param string $name     Name of the dropdown.
	 * @param string $id       ID of the dropdown.
	 * @param string $taxo     Taxonomy for the dropdown.
	 * @param array  $repeater Repeater settings for the dropdown.
	 *
	 * @return string HTML markup for the dropdown menu.
	 */
	protected function tp_search_drop_down( $data, $name, $id, $taxo, $repeater ) {
		$output  = '';
		$showCnt = ! empty( $repeater['showCount'] ) ? 'yes' : '';
		$label   = ! empty( $repeater['fieldLabel'] ) ? $repeater['fieldLabel'] : '';
		$DefText = ! empty( $repeater['DefText'] ) ? $repeater['DefText'] : '';

		if ( ! empty( $taxo ) ) {
			// $output .= '<input name="taxonomy" type="hidden" value="' . esc_attr( $taxo ) . '">';
		}
		if ( ! empty( $label ) ) {
			$output .= '<label class="tp-search-label">' . esc_html( $label ) . '</label>';
		}

		$DatName = '';
		if ( 'post' === $name ) {
			$DatName = 'post_type';
		} elseif ( 'category' === $name ) {
			// $DatName = 'cat';
			$DatName = 'taxonomy_' . esc_attr( $taxo );
		}

		$output .= '<div class="tp-sbar-dropdown">';

			$output .= '<div class="tp-select">';

				$output .= '<span>' . esc_html( $DefText ) . '</span><i class="fas fa-chevron-down tp-dd-icon"></i>';

			$output .= '</div>';

			$output .= '<input type="hidden" name="' . esc_attr( $DatName ) . '" id="' . esc_attr( $DatName ) . '" >';

			$output .= '<ul class="tp-sbar-dropdown-menu">';

				$output .= '<li id="" class="tp-searchbar-li">' . esc_attr( $DefText ) . '</li>';

		foreach ( $data as $key => $label ) {
			$LName  = ! empty( $label['name'] ) ? $label['name'] : '';
			$Lcount = ! empty( $label['count'] ) ? $label['count'] : 0;

			$output .= '<li id="' . esc_attr( $key ) . '" class="tp-searchbar-li" >';

			if ( ! empty( $showCnt ) ) {
				$output .= esc_html( $LName ) . ' (' . esc_html( $Lcount ) . ')';
			} else {
				$output .= esc_html( $LName );
			}

			$output .= '</li>';
		}
			$output .= '</ul>';
		$output     .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML markup for a search button.
	 *
	 * @param array $attr Attributes for the search button.
	 *
	 * @return string HTML markup for the search button.
	 */
	protected function tp_search_button( $attr ) {
		$output  = '';
		$showBtn = ! empty( $attr['showBtn'] ) ? $attr['showBtn'] : '';

		if ( ! empty( $showBtn ) ) {
			$BtnText  = ! empty( $attr['BtnText'] ) ? $attr['BtnText'] : '';
			$BtnMedia = ! empty( $attr['BtnMedia'] ) ? $attr['BtnMedia'] : '';
			$BtnPos   = ! empty( $attr['BtnPosition'] ) ? $attr['BtnPosition'] : 'before';
			$BtnImage = ( ! empty( $attr['BtnImage'] ) && ! empty( $attr['BtnImage']['url'] ) ) ? $attr['BtnImage']['url'] : THEPLUS_ASSETS_URL . 'images/placeholder-grid.jpg';

			$GetMedia = '';
			if ( $BtnMedia == 'icon' && ! empty( $attr['BtnIcon'] ) && ! empty( $attr['BtnIcon']['value'] ) ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $attr['BtnIcon'], array( 'aria-hidden' => 'true' ) );
					$Icon = ob_get_contents();
				ob_end_clean();
				$GetMedia = '<span class="tp-button-icon">' . $Icon . '</span>';
			} elseif ( $BtnMedia == 'image' ) {
				$GetMedia = '<span class="tp-button-Image"><img src="' . esc_url( $BtnImage ) . '" class="tp-button-ImageTag"></span>';
			}

			$output         .= '<div class="tp-btn-wrap">';
				$output     .= '<button class="tp-search-btn" name="submit" >';
					$output .= ( $BtnPos == 'before' ) ? $GetMedia : '';
			if ( ! empty( $BtnText ) ) {
				$output .= '<span class="tp-search-btn-txt ' . esc_attr( $BtnPos ) . '">' . esc_attr( $BtnText ) . '</span>';
			}
					$output .= ( $BtnPos == 'after' ) ? $GetMedia : '';
				$output     .= '</button>';
			$output         .= '</div>';
		}

		return $output;
	}

	/**
	 * Generate responsive column classes based on the provided column widths.
	 *
	 * @since 1.0.0
	 *
	 * @param int $Desktop Desktop column width.
	 * @param int $Tablet Tablet column width.
	 * @param int $Mobile Mobile column width.
	 *
	 * @return string Responsive column classes.
	 */
	protected function tp_search_column( $Desktop, $Tablet, $Mobile ) {
		$Rcolumn  = 'tp-col-lg-' . esc_attr( $Desktop );
		$Rcolumn .= ' tp-col-md-' . esc_attr( $Tablet );
		$Rcolumn .= ' tp-col-sm-' . esc_attr( $Mobile );
		$Rcolumn .= ' tp-col-' . esc_attr( $Mobile );

		return $Rcolumn;
	}

	/**
	 * Display the archive "Read More" section.
	 *
	 * @since 1.0.0
	 * @return empty empty.
	 */
	protected function content_template() {}
}

<?php
/**
 * Widget Name: Search Filter
 * Description: Search Filter
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
class ThePlus_Search_Filter extends Widget_Base {

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
		return 'tp-search-filter';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_title() {
		return esc_html__( 'WP Filters', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_icon() {
		return 'fa fa-sort-size-up-alt theplus_backend_icon';
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
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_keywords() {
		return array( 'WooCommerce', 'Filter', 'Product Filter', 'Shop Filter', 'Ecommerce Filter', 'Elementor WooCommerce Filter', 'Elementor Product Filter', 'Elementor Shop Filter', 'Elementor Ecommerce Filter', 'Search bar', 'search widget', 'search element', 'search tool', 'search functionality', 'search feature', 'search box', 'search option', 'search module', 'search plugin', 'search extension', 'search component', 'search elementor addon', 'search plus addons for elementor', 'search filters', 'filter widget', 'filter element', 'filter tool', 'filter functionality', 'filter feature', 'filter box', 'filter option', 'filter module', 'filter plugin', 'filter extension', 'filter component', 'filter elementor addon', 'filter plus addons for elementor', 'Elementor', 'widget', 'search bar', 'search', 'bar', 'Elementor Addon', 'Horizontal Filters', 'Elementor Filters', 'Filters Widget', 'Filter Bar', 'Filter Menu', 'Filter Options', 'Filter Navigation', 'Elementor Search Bar', 'Search Widget', 'Search Bar', 'Elementor Addon', 'Elementor Plugin', 'Elementor Extension', 'Elementor Element', 'Modal', 'Popup', 'Filters', '', 'Search bar', 'Search widget', 'Elementor addon', 'Search functionality', 'Search tool', 'Inline Filters', 'Filterable Content', 'Content Filters', 'Elementor Filters', 'Advanced Filters', 'Dynamic Filters', 'Filterable Elements', 'Filterable Widgets', 'Filterable Sections', 'Filterable Blocks', 'Filterable Dividers', 'Filterable Containers', 'Filterable Rows', 'Filterable Columns', 'Filterable Grids', 'Filterable Galleries', 'Filterable Portfolios', 'Filterable Testimonials', 'Filterable Team Members', 'Filterable Pricing Tables', 'Filterable Accordion', 'Filterable Tabs', 'Filterable Toggle', 'Filterable Carousel' );
	}

	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'FilterArea_section',
			array(
				'label' => esc_html__( 'Filter Area', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'filteroption',
			array(
				'label'   => esc_html__( 'Filter Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'wpfilter',
				'options' => array(
					'wpfilter'    => esc_html__( 'WP Filter', 'theplus' ),
					'Woofilter'   => esc_html__( 'Woo Filter', 'theplus' ),
					'extrafilter' => esc_html__( 'Filter Meta', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'WpFilterType',
			array(
				'label'     => esc_html__( 'Select Source', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''             => esc_html__( 'Select Source', 'theplus' ),
					'alphabet'     => esc_html__( 'Alphabet Filter', 'theplus' ),
					'checkbox'     => esc_html__( 'CheckBox', 'theplus' ),
					'date'         => esc_html__( 'Date Picker', 'theplus' ),
					'drop_down'    => esc_html__( 'Drop Down', 'theplus' ),
					'radio'        => esc_html__( 'Radio Button', 'theplus' ),
					'range'        => esc_html__( 'Range Slider', 'theplus' ),
					'search'       => esc_html__( 'Search Input', 'theplus' ),
					'tabbing'      => esc_html__( 'Tabbing Filter', 'theplus' ),
					'autocomplete' => esc_html__( 'Autocomplete', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'wpfilter',
				),
			)
		);
		$repeater->add_control(
			'WooFilterType',
			array(
				'label'     => esc_html__( 'Select Source', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''       => esc_html__( 'Select Source', 'theplus' ),
					'button' => esc_html__( 'Button', 'theplus' ),
					'color'  => esc_html__( 'Color', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'rating' => esc_html__( 'Rating', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'Woofilter',
				),
			)
		);
		$repeater->add_control(
			'how_it_works_rating',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-woocommerce-rating-filter-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'filteroption'  => 'Woofilter',
					'WooFilterType' => 'rating',
				),
			)
		);
		$repeater->add_control(
			'ExFilterType',
			array(
				'label'     => esc_html__( 'Select Source', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'filter_tag',
				'options'   => array(
					'filter_tag'     => esc_html__( 'Filter Tag', 'theplus' ),
					'filter_reset'   => esc_html__( 'Filter Reset', 'theplus' ),
					'total_results'  => esc_html__( 'Search Results', 'theplus' ),
					'Column_results' => esc_html__( 'Filter Column', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'extrafilter',
				),
			)
		);
		$repeater->add_control(
			'works_filter_tag',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-applied-product-filters-as-tags-in-woocommerce-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'filter_reset',
				),
			)
		);
		$repeater->add_control(
			'works_search_reset',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-applied-product-filters-as-tags-in-woocommerce-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'filter_reset',
				),
			)
		);
		$repeater->add_control(
			'works_filter_column',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-woocommerce-filter-reset-button-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'Column_results',
				),
			)
		);
		$repeater->add_control(
			'ContentType',
			array(
				'label'      => esc_html__( 'Select Type', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => array(
					''              => esc_html__( 'Select Source', 'theplus' ),
					'taxonomy'      => esc_html__( 'Taxonomy', 'theplus' ),
					'acf_conne'     => esc_html__( 'ACF connection', 'theplus' ),
					'pods_conne'    => esc_html__( 'PODs connection', 'theplus' ),
					'toolset_conne' => esc_html__( 'Toolset connection', 'theplus' ),
					'metabox_conne' => esc_html__( 'Metabox connection', 'theplus' ),
				),
				'condition'  => array(
					'filteroption' => array( 'wpfilter', 'Woofilter' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => 'in',
							'value'    => array( 'checkbox', 'date', 'drop_down', 'search', 'tabbing', 'radio', 'range', 'autocomplete' ),
						),
						array(
							'name'     => 'WooFilterType',
							'operator' => 'in',
							'value'    => array( 'color', 'image', 'button', 'rating' ),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'TaxonomyType',
			array(
				'label'      => esc_html__( 'Select Taxonomy', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => theplus_get_post_taxonomies(),
				'condition'  => array(
					'filteroption' => array( 'wpfilter', 'Woofilter' ),
					'ContentType'  => 'taxonomy',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => 'in',
							'value'    => array( 'checkbox', 'date', 'drop_down', 'tabbing', 'radio' ),
						),
						array(
							'name'     => 'WooFilterType',
							'operator' => 'in',
							'value'    => array( 'color', 'image', 'button' ),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'pAttr',
			array(
				'label'      => esc_html__( 'Select Attributes', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => theplus_get_woocommerce_taxonomies(),
				'condition'  => array(
					'filteroption' => array( 'Woofilter' ),
					'ContentType'  => 'taxonomy',
					'TaxonomyType' => 'product_attr',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WooFilterType',
							'operator' => 'in',
							'value'    => array( 'color', 'image', 'button' ),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'acfKey',
			array(
				'label'       => __( 'Connection Key', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter Key', 'theplus' ),
				'condition'   => array(
					'filteroption' => array( 'wpfilter', 'Woofilter' ),
					'ContentType'  => array( 'acf_conne', 'pods_conne', 'toolset_conne', 'metabox_conne' ),
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => 'in',
							'value'    => array( 'checkbox', 'date', 'drop_down', 'search', 'tabbing', 'radio', 'range', 'autocomplete' ),
						),
						array(
							'name'     => 'WooFilterType',
							'operator' => 'in',
							'value'    => array( 'color', 'image', 'button', 'rating' ),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'ColorPickerKey',
			array(
				'label'       => __( 'ACF ColorPicker', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter ACF Key', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'Woofilter',
					'ContentType'  => array( 'acf_conne', 'pods_conne', 'toolset_conne', 'metabox_conne' ),
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WooFilterType',
							'operator' => '===',
							'value'    => 'color',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'placeholder',
			array(
				'label'       => __( 'Placeholder Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Type your keyword to search...', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'search' ),
				),
			)
		);
		$repeater->add_control(
			'GenericFilter',
			array(
				'label'        => __( 'Generic Filters', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'search',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'haddingGF',
			array(
				'label'     => __( 'Generic Filters', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$repeater->add_control(
			'sintitle',
			array(
				'label'     => esc_html__( 'Search in Title', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$repeater->add_control(
			'sincontent',
			array(
				'label'     => esc_html__( 'Search in Content', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$repeater->add_control(
			'sinname',
			array(
				'label'     => esc_html__( 'Search in Name', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$repeater->add_control(
			'sinexcerpt',
			array(
				'label'     => esc_html__( 'Search in Excerpt', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$repeater->add_control(
			'sincategory',
			array(
				'label'     => esc_html__( 'Search in Category', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$repeater->add_control(
			'sinTags',
			array(
				'label'     => esc_html__( 'Search in Tags', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
			)
		);
		$repeater->add_control(
			'SearchMatch',
			array(
				'label'    => __( 'Search Type', 'theplus' ),
				'type'     => Controls_Manager::SELECT,
				'multiple' => true,
				'options'  => array(
					'otheroption' => __( 'Default', 'theplus' ),
					'fullMatch'   => __( 'Full Match', 'theplus' ),
				),
				'default'  => 'otheroption',
			)
		);
		$repeater->end_popover();
		$repeater->add_control(
			'layout_date',
			array(
				'label'     => __( 'Date layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => __( 'Default', 'theplus' ),
					'style-2' => __( 'Custom', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'date',
				),
			)
		);
		$repeater->add_control(
			'lableDisable',
			array(
				'label'        => __( 'Show Label', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'date',
					'layout_date'  => 'style-1',
				),
			)
		);
		$repeater->add_control(
			'lableOne_date',
			array(
				'label'       => __( 'First Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Start', 'theplus' ),
				'placeholder' => __( 'Enter First Label', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'date',
					'lableDisable' => 'yes',
					'layout_date'  => 'style-1',
				),
			)
		);
		$repeater->add_control(
			'lableTwo_date',
			array(
				'label'       => __( 'Second Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'End', 'theplus' ),
				'placeholder' => __( 'Enter Second Label', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'date',
					'lableDisable' => 'yes',
					'layout_date'  => 'style-1',
				),
			)
		);
		$repeater->add_control(
			'lableStyleDate',
			array(
				'label'     => __( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => __( 'Default', 'theplus' ),
					'inline'  => __( 'Inline', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'date',
					'lableDisable' => 'yes',
					'layout_date'  => 'style-1',
				),
			)
		);

		$repeater->add_control(
			'CustomDateFilter',
			array(
				'label'        => __( 'Custom Filters', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'date',
					'layout_date'  => 'style-2',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'CustomDatehadding',
			array(
				'label'     => __( 'Custom Date', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$repeater->add_control(
			'Datemultiselect',
			array(
				'label'    => __( 'Date Option', 'theplus' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => array(
					'AutoApplyEn'          => __( 'Auto Apply', 'theplus' ),
					'showDropdownsEn'      => __( 'Show Dropdowns', 'theplus' ),
					'showranges'           => __( 'Show Ranges', 'theplus' ),
					'alwaysShowCalendars'  => __( 'Show Calendar', 'theplus' ),
					'showWeekNumbers'      => __( 'Show WeekNumber', 'theplus' ),
					'linkedCalendars'      => __( 'Show linked Calendar', 'theplus' ),
					'showCustomRangeLabel' => __( 'show CustomRange Label', 'theplus' ),
				),
				'default'  => array( 'showranges', 'alwaysShowCalendars' ),
			)
		);
		$repeater->add_control(
			'Rangemultiselect',
			array(
				'label'     => __( 'Date Range Option', 'theplus' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => array(
					'today'      => __( 'Today', 'theplus' ),
					'yesterday'  => __( 'Yesterday', 'theplus' ),
					'Last7Days'  => __( 'Last 7 Days', 'theplus' ),
					'Last30Days' => __( 'Last 30 Days', 'theplus' ),
					'ThisMonth'  => __( 'This Month', 'theplus' ),
					'LastMonth'  => __( 'Last Month', 'theplus' ),
				),
				'default'   => array( 'today', 'Last7Days', 'ThisMonth' ),
				'condition' => array(
					'Datemultiselect' => 'showranges',
				),
			)
		);

		$repeater->add_control(
			'Applybtntxt',
			array(
				'label'       => __( 'Apply Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Apply', 'theplus' ),
				'placeholder' => __( 'Enter Button Text', 'theplus' ),
				'condition'   => array(
					'Datemultiselect'  => 'alwaysShowCalendars',
					'Datemultiselect!' => 'AutoApplyEn',
				),
			)
		);
		$repeater->add_control(
			'Applybtnclass',
			array(
				'label'       => __( 'Apply Button class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter Button class', 'theplus' ),
				'condition'   => array(
					'Datemultiselect'  => 'alwaysShowCalendars',
					'Datemultiselect!' => 'AutoApplyEn',
				),
			)
		);
		$repeater->add_control(
			'Cancelbtntxt',
			array(
				'label'       => __( 'Cancel Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Cancel', 'theplus' ),
				'placeholder' => __( 'Enter Button Text', 'theplus' ),
				'condition'   => array(
					'Datemultiselect'  => 'alwaysShowCalendars',
					'Datemultiselect!' => 'AutoApplyEn',
				),
			)
		);
		$repeater->add_control(
			'Cancelbtnclass',
			array(
				'label'       => __( 'Cancel Button class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter Button class', 'theplus' ),
				'condition'   => array(
					'Datemultiselect'  => 'alwaysShowCalendars',
					'Datemultiselect!' => 'AutoApplyEn',
				),
			)
		);
		$repeater->add_control(
			'Customlabletxt',
			array(
				'label'       => __( 'Custom label Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Custom', 'theplus' ),
				'placeholder' => __( 'Enter Custom label Text', 'theplus' ),
				'condition'   => array(
					'Datemultiselect' => 'showCustomRangeLabel',
				),
			)
		);

		$repeater->add_control(
			'daysOfWeek',
			array(
				'label'       => __( 'Days Of Week', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Su | Mo | Tu | We | Th | Fr | Sa', 'theplus' ),
				'placeholder' => __( 'Enter Days of week', 'theplus' ),
				'condition'   => array(
					'Datemultiselect' => 'alwaysShowCalendars',
				),
			)
		);
		$repeater->add_control(
			'monthNames',
			array(
				'label'       => __( 'Month Name', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'January | February | March | April | May | June | July | August | September | October | November | December', 'theplus' ),
				'placeholder' => __( 'Enter Days of week', 'theplus' ),
				'condition'   => array(
					'Datemultiselect' => 'alwaysShowCalendars',
				),
			)
		);

		$repeater->add_control(
			'DropsPosition',
			array(
				'label'   => __( 'Drops Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => array(
					'up'   => __( 'UP', 'theplus' ),
					'down' => __( 'Down', 'theplus' ),
					'auto' => __( 'Auto', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'opensPosition',
			array(
				'label'   => __( 'Opens Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'   => __( 'Left', 'theplus' ),
					'center' => __( 'Center', 'theplus' ),
					'right'  => __( 'Right', 'theplus' ),
				),
			)
		);

		$repeater->add_control(
			'DateDefaultSelect',
			array(
				'label'        => __( 'Default Select', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$repeater->add_control(
			'start_date',
			array(
				'label'          => __( 'Start Date', 'theplus' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => 1,
				'condition'      => array(
					'DateDefaultSelect' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'end_date',
			array(
				'label'          => __( 'End Date', 'theplus' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => 1,
				'separator'      => 'after',
				'condition'      => array(
					'DateDefaultSelect' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'DateDisplay',
			array(
				'label'        => __( 'Display Date', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$repeater->add_control(
			'min_date',
			array(
				'label'          => __( 'Start Date', 'theplus' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => 0,
				'condition'      => array(
					'DateDisplay' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'max_date',
			array(
				'label'          => __( 'End Date', 'theplus' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => 0,
				'separator'      => 'after',
				'condition'      => array(
					'DateDisplay' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'YearDisplay',
			array(
				'label'        => __( 'Display Date Year', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$repeater->add_control(
			'Min_DateYear',
			array(
				'label'       => __( 'Min Year', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( '2020', 'theplus' ),
				'condition'   => array(
					'YearDisplay' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'Max_DateYear',
			array(
				'label'       => __( 'Max Year', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( '2020', 'theplus' ),
				'condition'   => array(
					'YearDisplay' => 'yes',
				),
			)
		);
		$repeater->end_popover();

		$repeater->add_control(
			'AlphabetType',
			array(
				'label'     => __( 'Alphabet Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => array(
					'alphabet' => __( 'Alphabet (A-Z)', 'theplus' ),
					'number'   => __( 'Number (0-9)', 'theplus' ),
				),
				'default'   => array( 'alphabet' ),
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'alphabet',
				),
			)
		);

		$repeater->add_control(
			'TabbingContent',
			array(
				'label'     => __( 'Select Media', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'  => __( 'None', 'theplus' ),
					'icon'  => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'tabbing',
				),
			)
		);
		$repeater->add_control(
			'TabbingIconlib',
			array(
				'label'     => __( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'WpFilterType'   => 'tabbing',
					'TabbingContent' => 'icon',
				),
				'default'   => array(
					'value'   => 'fa fa-bank',
					'library' => 'solid',
				),
				'condition' => array(
					'WpFilterType'   => 'tabbing',
					'TabbingContent' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'TabbingImage',
			array(
				'label'     => __( 'Choose Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'WpFilterType'   => 'tabbing',
					'TabbingContent' => 'image',
				),
			)
		);

		$repeater->add_control(
			'DDtitle',
			array(
				'label'       => __( 'Default Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'All Data', 'theplus' ),
				'placeholder' => __( 'Enter Default', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'ContentType'  => array( 'taxonomy', 'acf_conne', 'pods_conne', 'toolset_conne', 'metabox_conne' ),
					'WpFilterType' => 'drop_down',
				),
			)
		);
		$repeater->add_control(
			'layout_style',
			array(
				'label'     => __( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => __( 'Style-1', 'theplus' ),
					'style-2' => __( 'Style-2', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'drop_down', 'radio' ),
				),
			)
		);
		$repeater->add_control(
			'Imageshow',
			array(
				'label'        => __( 'Show Image', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'ContentType'  => 'taxonomy',
					'WpFilterType' => array( 'checkbox', 'drop_down', 'radio', 'tabbing' ),
				),
			)
		);
		$repeater->add_control(
			'WooFiltersSort',
			array(
				'label'        => __( 'Woo Sorting', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'ContentType'  => 'taxonomy',
				),
				'conditions'   => array(
					'relation' => 'AND',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'alphabet',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'checkbox',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'date',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'radio',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'range',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'search',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'WooFiltersSelect',
			array(
				'label'      => __( 'Select', 'theplus' ),
				'type'       => Controls_Manager::SELECT2,
				'multiple'   => true,
				'options'    => array(
					'featured'   => __( 'Featured', 'theplus' ),
					'on_sale'    => __( 'On sale', 'theplus' ),
					'top_sales'  => __( 'Top Sales', 'theplus' ),
					'instock'    => __( 'In Stock', 'theplus' ),
					'outofstock' => __( 'Out of Stock', 'theplus' ),
				),
				'default'    => array( 'on_sale' ),
				'condition'  => array(
					'filteroption'   => 'wpfilter',
					'ContentType'    => 'taxonomy',
					'WooFiltersSort' => 'yes',
				),
				'conditions' => array(
					'relation' => 'AND',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'alphabet',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'checkbox',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'date',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'radio',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'range',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'search',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'showCount',
			array(
				'label'        => __( 'Show Count', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => array( 'wpfilter', 'Woofilter' ),
					'ContentType'  => 'taxonomy',
				),
				'conditions'   => array(
					'relation' => 'AND',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'alphabet',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'date',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'search',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '!==',
							'value'    => 'range',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'showtickIcon',
			array(
				'label'        => __( 'Show Tick icon', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'tabbing',
				),
			)
		);
		$repeater->add_control(
			'showChild',
			array(
				'label'        => __( 'Show Child Category', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => array( 'wpfilter' ),
					'ContentType'  => 'taxonomy',
				),
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => '===',
							'value'    => 'checkbox',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '===',
							'value'    => 'radio',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'exclude_category_switch',
			array(
				'label'        => __( 'Exclude', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => array( 'wpfilter' ),
					'ContentType'  => 'taxonomy',
				),
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => '===',
							'value'    => 'checkbox',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '===',
							'value'    => 'radio',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'exclude_category',
			array(
				'label'       => esc_html__( 'Exclude Category', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => esc_html__( '', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Exclude Id', 'theplus' ),
				'condition'   => array(
					'filteroption'            => array( 'wpfilter' ),
					'ContentType'             => 'taxonomy',
					'exclude_category_switch' => 'yes',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'WpFilterType',
							'operator' => '===',
							'value'    => 'checkbox',
						),
						array(
							'name'     => 'WpFilterType',
							'operator' => '===',
							'value'    => 'radio',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'Range_note',
			array(
				'label'     => esc_html__( 'Note : Works in Products.', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'filteroption' => 'wpfilter',
					'ContentType'  => 'taxonomy',
					'WpFilterType' => 'range',
				),
			)
		);
		$repeater->add_control(
			'maxPrice',
			array(
				'label'     => __( 'Maximum Price', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 25,
				'default'   => 10000,
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'range',
					'ContentType'  => array( 'taxonomy', 'pods_conne', 'toolset_conne', 'metabox_conne' ),
				),
			)
		);
		$repeater->add_control(
			'minPrice',
			array(
				'label'     => __( 'Minimum Price', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 10,
				'default'   => 0,
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'range',
					'ContentType'  => array( 'taxonomy', 'pods_conne', 'toolset_conne', 'metabox_conne' ),
				),
			)
		);
		$repeater->add_control(
			'steps',
			array(
				'label'     => __( 'Steps', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 5,
				'default'   => 100,
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'range',
					'ContentType'  => array( 'taxonomy', 'pods_conne', 'toolset_conne', 'metabox_conne' ),
				),
			)
		);
		$repeater->add_control(
			'rpricesymbol',
			array(
				'label'       => esc_html__( 'Price Symbol', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '₹', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Price Symbol', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => 'range',
				),
			)
		);
		$repeater->add_control(
			'ColumnChange',
			array(
				'label'     => __( 'Column Change', 'theplus' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => array(
					'12' => __( 'Column 1', 'theplus' ),
					'6'  => __( 'Column 2', 'theplus' ),
					'4'  => __( 'Column 3', 'theplus' ),
					'3'  => __( 'Column 4', 'theplus' ),
				),
				'default'   => array( '2', '12' ),
				'condition' => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'Column_results',
				),
			)
		);
		$repeater->add_control(
			'ShowMorePen',
			array(
				'label'        => __( 'Show More', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'ShowMore',
			array(
				'label'        => __( 'ShowMore', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
				),
			)
		);
		$repeater->add_control(
			'MoreDefault',
			array(
				'label'     => __( 'Default Display', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => 3,
				'condition' => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
					'ShowMore'     => 'yes',
				),
			)
		);
		$repeater->add_control(
			'showmoretxt',
			array(
				'label'       => __( 'ShowMore Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Show More', 'theplus' ),
				'placeholder' => __( 'Enter Value', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
					'ShowMore'     => 'yes',
				),
			)
		);
		$repeater->add_control(
			'showlesstxt',
			array(
				'label'       => __( 'ShowLess Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Show Less', 'theplus' ),
				'placeholder' => __( 'Enter Value', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
					'ShowMore'     => 'yes',
				),
			)
		);
		$repeater->add_control(
			'scrollOn',
			array(
				'label'        => __( 'Scroll Height', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
					'ShowMore'     => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'height_scroll',
			array(
				'label'      => __( 'Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'condition'  => array(
					'filteroption' => 'wpfilter',
					'WpFilterType' => array( 'checkbox', 'radio', 'tabbing' ),
					'ShowMore'     => 'yes',
					'scrollOn'     => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->add_control(
			'reset_enable',
			array(
				'label'        => esc_html__( 'Fix Reset Button', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'theplus' ),
				'label_off'    => esc_html__( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'filter_reset',
				),
			)
		);
		$repeater->add_control(
			'resettext',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Reset Button text', 'theplus' ),
				'default'     => 'Reset all',
				'placeholder' => esc_html__( 'Enter your text', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'filter_reset',
				),
			)
		);

		$repeater->add_control(
			'tooltip',
			array(
				'label'        => __( 'Tooltip', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'separator'    => 'before',
				'condition'    => array(
					'filteroption'  => 'Woofilter',
					'WooFilterType' => array( 'color', 'image', 'button' ),
				),
			)
		);
		$repeater->add_control(
			'RDesktop_column',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'filteroption'  => 'Woofilter',
					'WooFilterType' => array( 'color', 'image', 'button' ),
				),
			)
		);
		$repeater->add_control(
			'RTablet_column',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'filteroption'  => 'Woofilter',
					'WooFilterType' => array( 'color', 'image', 'button' ),
				),
			)
		);
		$repeater->add_control(
			'RMobile_column',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '6',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'filteroption'  => 'Woofilter',
					'WooFilterType' => array( 'color', 'image', 'button' ),
				),
			)
		);
		$repeater->add_control(
			'FRemove_style',
			array(
				'label'     => __( 'Tag Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'end',
				'options'   => array(
					'start' => __( 'Start', 'theplus' ),
					'end'   => __( 'End', 'theplus' ),
				),
				'condition' => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'filter_reset',
				),
			)
		);
		$repeater->add_control(
			'FTR_txt',
			array(
				'label'       => __( 'Total Results Text', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Showing {visible_product_no} of {total_product_no} results', 'theplus' ),
				'placeholder' => __( 'Enter Total Message', 'theplus' ),
				'condition'   => array(
					'filteroption' => 'extrafilter',
					'ExFilterType' => 'total_results',
				),
			)
		);
		$repeater->add_control(
			'FTR_Note',
			array(
				'label'     => esc_html__( 'Note : You can include dynamic tags like {visible_product_no} and {total_product_no} here.', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'filteroption' => array( 'extrafilter' ),
					'ExFilterType' => 'total_results',
				),
			)
		);
		$repeater->add_control(
			'HadingPopup',
			array(
				'label'        => __( 'Heading setting', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => array( 'wpfilter', 'Woofilter' ),
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'headingOn',
			array(
				'label'        => __( 'Enable Heading', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'filteroption' => array( 'wpfilter', 'Woofilter' ),
				),
			)
		);
		$repeater->add_control(
			'fieldTitle',
			array(
				'label'       => __( 'Title Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Category', 'theplus' ),
				'placeholder' => __( 'Enter Title Text', 'theplus' ),
				'condition'   => array(
					'headingOn' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'Titlelayout',
			array(
				'label'     => __( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => __( 'Default', 'theplus' ),
					'inline'  => __( 'inline', 'theplus' ),
				),
				'condition' => array(
					'headingOn' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'DDwidth',
			array(
				'label'      => __( 'Title Label Width', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-filter .tp-search-form {{CURRENT_ITEM}} .tp-title-inline' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'headingOn'   => 'yes',
					'Titlelayout' => 'inline',
				),
			)
		);
		$repeater->add_control(
			'Toggdisable',
			array(
				'label'        => __( 'Toggle Disable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'headingOn' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ToggDef',
			array(
				'label'        => __( 'Default Toggle On', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'headingOn'   => 'yes',
					'Toggdisable' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'showIcon',
			array(
				'label'        => __( 'Show Icon', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'headingOn' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'Iconlib',
			array(
				'label'     => __( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-university',
					'library' => 'solid',
				),
				'condition' => array(
					'headingOn' => 'yes',
					'showIcon'  => 'yes',
				),
			)
		);
		$repeater->end_popover();

		$this->add_control(
			'searchField',
			array(
				'label'       => esc_html__( 'Search Field', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array( 'filteroption' => 'wpfilter' ),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ fieldTitle }}}',
			)
		);
		$this->end_controls_section();

		/*columns start*/
		$this->start_controls_section(
			'columns_manage_section',
			array(
				'label' => esc_html__( 'Columns Manage', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'desktop_column',
			array(
				'label'   => esc_html__( 'Desktop', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_control(
			'tablet_column',
			array(
				'label'   => esc_html__( 'Tablet', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_control(
			'mobile_column',
			array(
				'label'   => esc_html__( 'Mobile', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => theplus_get_columns_list(),
			)
		);
		$this->add_responsive_control(
			'columnSpace',
			array(
				'label'      => esc_html__( 'Columns Gap / Space Between', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'columnSpaceMargin',
			array(
				'label'      => esc_html__( 'Columns Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/*columns end*/

		/*Extra start */
		$this->start_controls_section(
			'ExtraOption_section',
			array(
				'label' => esc_html__( 'Extra Option', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'FilterBtnPen',
			array(
				'label'        => __( 'Filter Toggle Button', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'yes', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->start_popover();
		$this->add_control(
			'FilterBtn',
			array(
				'label'        => __( 'Filter Toggle Button', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'TogBtnNum',
			array(
				'label'     => __( 'Default Filters', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'step'      => 1,
				'default'   => 3,
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'TogBtnPos',
			array(
				'label'     => __( 'Button Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'relative',
				'options'   => array(
					'fix'      => __( 'Fix', 'theplus' ),
					'relative' => __( 'Relative', 'theplus' ),
				),
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'TogBtnTitle',
			array(
				'label'       => __( 'Show More', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Show More', 'theplus' ),
				'placeholder' => __( 'Enter Text', 'theplus' ),
				'condition'   => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'TogBtnTitleLess',
			array(
				'label'       => __( 'Show Less', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Show Less', 'theplus' ),
				'placeholder' => __( 'Enter Text', 'theplus' ),
				'condition'   => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'ToggleMedia',
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
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'ToggleBtnIcon',
			array(
				'label'     => __( 'Select Button Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'FilterBtn'   => 'yes',
					'ToggleMedia' => 'icon',
				),
				'default'   => array(
					'value'   => 'fas fa-sliders-h',
					'library' => 'solid',
				),
			)
		);
		$this->add_control(
			'Toggleimage',
			array(
				'label'     => __( 'Choose Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'FilterBtn'   => 'yes',
					'ToggleMedia' => 'image',
				),
			)
		);
		$this->add_control(
			'TogMPosition',
			array(
				'label'     => __( 'Icon Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'start' => __( 'Before', 'theplus' ),
					'end'   => __( 'After', 'theplus' ),
				),
				'default'   => 'start',
				'condition' => array(
					'FilterBtn'    => 'yes',
					'TogBtnTitle!' => '',
					'ToggleMedia!' => '',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'AjaxbuttonPen',
			array(
				'label'        => __( 'Ajax Button Enable', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'yes', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->start_popover();
		$this->add_control(
			'HaddingAjaxBtn',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Ajax Button', 'theplus' ),
				'content_classes' => 'tp-ajax-button',
				'separator'       => 'after',
			)
		);
		$this->add_control(
			'Ajaxbutton',
			array(
				'label'        => __( 'Ajax Button Enable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'Ajaxbtntxt',
			array(
				'label'       => __( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Click Me', 'theplus' ),
				'placeholder' => __( 'Type your title here', 'theplus' ),
				'condition'   => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_control(
			'AjaxLoadbtntxt',
			array(
				'label'       => __( 'Loading Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Loadding', 'theplus' ),
				'placeholder' => __( 'Type Your loading Text', 'theplus' ),
				'condition'   => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_control(
			'AjaxloadiconOn',
			array(
				'label'        => __( 'Loadding Icon Enable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_control(
			'AjaxbtnMedia',
			array(
				'label'     => __( 'Button Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''      => __( 'None', 'theplus' ),
					'icon'  => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
				),
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_control(
			'AjaxBtnIcon',
			array(
				'label'     => __( 'Select Button Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'FilterBtn'   => 'yes',
					'ToggleMedia' => 'icon',
				),
				'default'   => array(
					'value'   => 'fas fa-sliders-h',
					'library' => 'solid',
				),
				'condition' => array(
					'Ajaxbutton'   => 'yes',
					'AjaxbtnMedia' => 'icon',
				),
			)
		);
		$this->add_control(
			'AjaxBtnimage',
			array(
				'label'     => __( 'Choose Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'Ajaxbutton'   => 'yes',
					'AjaxbtnMedia' => 'image',
				),
			)
		);
		$this->add_control(
			'AjaxBtnPosition',
			array(
				'label'     => __( 'Icon Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'start' => __( 'Before', 'theplus' ),
					'end'   => __( 'After', 'theplus' ),
				),
				'default'   => 'start',
				'condition' => array(
					'Ajaxbutton'    => 'yes',
					'Ajaxbtntxt!'   => '',
					'AjaxbtnMedia!' => '',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'archivepen',
			array(
				'label'        => __( 'Archive Page Options', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'yes', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'enable_archive',
			array(
				'label'        => __( 'Only Active Archive Category', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'  => esc_html__( "If enabled, If will show category & It's subcategory of current archive page. If disabled, It will show all categories in filter" ),
			)
		);
		$this->add_control(
			'enable_archive_highlight',
			array(
				'label'        => __( 'Active Sub Category Name', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'enable_archive' => '',
				),
			)
		);
		$this->add_control(
			'enable_archivefiled',
			array(
				'label'        => __( 'Show All Button', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'  => esc_html__( 'If enabled, It will have button for showing all remaining categories.' ),
				'condition'    => array(
					'enable_archive' => 'yes',
				),
			)
		);
		$this->add_control(
			'archive_showall',
			array(
				'label'       => esc_html__( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Show All', 'theplus' ),
				'placeholder' => esc_html__( 'Show All', 'theplus' ),
				'condition'   => array(
					'enable_archive'      => 'yes',
					'enable_archivefiled' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'fieldorderpen',
			array(
				'label'        => __( 'Field Order', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'yes', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'fieldorder',
			array(
				'label'        => __( 'Sorting', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Enable', 'theplus' ),
				'label_off'    => __( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'description'  => esc_html__( 'For Tabing, Checkbox, Dropdown and Radio', 'theplus' ),
				'default'      => '',
			)
		);
		$this->add_control(
			'orderpost',
			array(
				'label'     => __( 'Order', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'ASC'  => __( 'ASC', 'theplus' ),
					'DESC' => __( 'DESC', 'theplus' ),
				),
				'default'   => 'DESC',
				'condition' => array(
					'fieldorder' => 'yes',
				),
			)
		);
		$this->add_control(
			'orderbypost',
			array(
				'label'     => __( 'Orderby', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'   => __( 'none', 'theplus' ),
					'author' => __( 'Author', 'theplus' ),
					'date'   => __( 'Date', 'theplus' ),
					'ID'     => __( 'ID', 'theplus' ),
					'name'   => __( 'Name', 'theplus' ),
					'parent' => __( 'Parent', 'theplus' ),
					'rand'   => __( 'Rand', 'theplus' ),
					'title'  => __( 'Title', 'theplus' ),
				),
				'default'   => 'parent',
				'condition' => array(
					'fieldorder' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'URLParameter',
			array(
				'label'        => wp_kses_post( "URL Parameter <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "enable-url-parameter-filters-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'URLParameterNote',
			array(
				'label'     => esc_html__( 'Note : By enabling this option, You will have semantic URLs with all selected filters as a URL postfix. It\'s make filter pages SEO Friendly.', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					'URLParameter' => 'yes',
				),
			)
		);
		$this->add_control(
			'Ftagtitle',
			array(
				'label'        => __( 'Filtertag Title Enable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'delayload',
			array(
				'label'     => esc_html__( 'Ajax Load Delay', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0.1,
				'max'       => 2,
				'step'      => 0.1,
				'default'   => 0.5,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ErrorMsg',
			array(
				'label'       => __( 'Post Not Found Message', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Sorry! No Results Found! Try Again.', 'theplus' ),
				'placeholder' => __( 'Enter Error Message', 'theplus' ),
			)
		);
		$this->end_controls_section();
		/*
		Extra start*/
		/*
		style start*/
		/*Title start*/
		$this->start_controls_section(
			'FieldTitle_styling',
			array(
				'label' => esc_html__( 'Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'titlePad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'titleMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TitleTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-text',
			)
		);
		$this->add_responsive_control(
			'TitleSvgIconTypo',
			array(
				'label'      => __( 'Svg Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '20',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-icon i' => 'font-size:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Title_Ntabs' );
		$this->start_controls_tab(
			'Title_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'titletxtNrcolor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-text' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-icon svg' => 'fill:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'titleIconNrcolor',
			array(
				'label'     => __( 'Toggle Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-toggle' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'titleNbackground',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-field-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TitleNBg',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-field-title',
			)
		);
		$this->add_responsive_control(
			'titleNBBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'titleNboxshadow',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .field-col .tp-field-title',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Title_Htabs',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'titletxtHrcolor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .field-col:hover .tp-field-title .tp-title-text' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-field-title .tp-title-icon svg' => 'fill:{{VALUE}}',
					'{{WRAPPER}} .field-col:hover .tp-field-title .tp-title-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'titleIconHrcolor',
			array(
				'label'     => __( 'Toggle Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .field-col:hover .tp-field-title .tp-title-toggle' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'titleHbackground',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .field-col:hover .tp-field-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TitleHBg',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col:hover .tp-field-title',
			)
		);
		$this->add_responsive_control(
			'titleHBBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col:hover .tp-field-title' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'titleHboxshadow',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .field-col:hover .tp-field-title',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Title End*/

		/*Alphabet start*/
		$this->start_controls_section(
			'AlphabetSection',
			array(
				'label' => esc_html__( 'Alphabet', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'AlphabetPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'AlphabetMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'AlphabetTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content',
			)
		);
		$this->start_controls_tabs( 'Alphabet_tab' );
		$this->start_controls_tab(
			'Alphabet_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'AlfNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'AlfNbackground',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AlfNborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content',
			)
		);
		$this->add_responsive_control(
			'AlphaNBRds',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Alphabet_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'AlfHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'AlfHground',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AlfHborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content:hover',
			)
		);
		$this->add_responsive_control(
			'AlphaHBRds',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Alphabet_Active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'AlfActiveColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .field-col .tp-alphabet-content .tp-alphabet-item.active' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ActAbackground',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .field-col .tp-alphabet-content .tp-alphabet-item.active',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'AlfAborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .field-col .tp-alphabet-content .tp-alphabet-item.active',
			)
		);
		$this->add_responsive_control(
			'AlphaABRds',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-content .tp-alphabet-item.active' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'AlphaBox_hadding',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'AlphabetBPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'AlphabetBMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'AlphabetBox_tab' );
		$this->start_controls_tab(
			'AlphabetBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Aplha_Nbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'AlphaBNsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Alph_BoxN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper',
			)
		);
		$this->add_responsive_control(
			'Alph_NBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'AlphabetBox_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Aplha_Hbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'AlphaBHsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Alph_BoxH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'Alph_HBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-alphabet-wrapper:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/*Checkbox start*/
		$this->start_controls_section(
			'CheckBox_styling',
			array(
				'label' => esc_html__( 'Check Box', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'checkSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-check-icon' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; min-width:{{SIZE}}{{UNIT}}; min-height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'leftOffset',
			array(
				'label'      => __( 'Offset Left', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-check-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'CB_tabs' );
		$this->start_controls_tab(
			'CB_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'checkBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-check-icon',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'checkBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-check-icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'CB_Focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'checkedkBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkBox input[type=checkbox]:checked+label .tp-check-icon',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'checkedkBor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkBox input[type=checkbox]:checked+label .tp-check-icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'checkBradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-check-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'CB_Heading',
			array(
				'label'     => __( 'Select Checkbox Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'checkIconSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-check-icon .checkbox-icon' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'CBI_tabs' );
		$this->start_controls_tab(
			'CBI_Normal',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'cheIcHvrColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkBox input[type=checkbox]+label:hover .tp-check-icon .checkbox-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'CBI_Focus',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_control(
			'chekedIconColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkBox input[type=checkbox]:checked+label .tp-check-icon .checkbox-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'CBL_Heading',
			array(
				'label'     => __( 'Label (style-2)', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'chlabelTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-field-content',
			)
		);
		$this->start_controls_tabs( 'CBL_tabs' );
		$this->start_controls_tab(
			'CBL_Normal',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'chlabelColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toggle-div .tp-checkBox .tp-field-content' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'CBL_Focus',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_control(
			'chkedLaColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toggle-div .tp-checkBox input[type=checkbox]:checked+label .tp-field-content' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'CBcount_Heading',
			array(
				'label'     => __( 'Counter', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'Ck_countpad',
			array(
				'label'      => __( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'Ck_countmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'Ck_countTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter',
			)
		);
		$this->start_controls_tabs( 'Ck_count_tabs' );
			$this->start_controls_tab(
				'Ck_count_Normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
		$this->add_control(
			'Ck_countNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Ck_countBgN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Ck_countTxtBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter',
			)
		);
		$this->add_responsive_control(
			'Ck_countTxtBRsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Ck_countBsdN',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2 .tp-field-Counter',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Ck_count_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'Ck_countHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2:hover .tp-field-Counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Ck_countBgH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2:hover .tp-field-Counter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Ck_countTxtBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2:hover .tp-field-Counter',
			)
		);
		$this->add_responsive_control(
			'Ck_countTxtBRsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2:hover .tp-field-Counter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Ck_countBsdH',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-checkBox.style-2:hover .tp-field-Counter',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'TogIcon_Heading',
			array(
				'label'     => __( 'Toggle Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'togplusiconSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tog-plus' => 'font-size:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'togplusiconalign',
			array(
				'label'      => __( 'Position', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-toggle' => 'right:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'togplus_tabs' );
		$this->start_controls_tab(
			'togplus_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'togNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-toggle' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'togplus_Focus',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'togHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-toggle:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'CkImage_Heading',
			array(
				'label'     => __( 'Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ckimageWidth',
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
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-checkbox-thumbimg' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ckOffsetsH',
			array(
				'label'      => esc_html__( 'Image Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-checkbox-thumbimg' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Ckimg_tabs' );
		$this->start_controls_tab(
			'Ckimg_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ckimg_Nb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-checkbox-thumbimg',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ckimg_Nbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-checkbox-thumbimg',
			)
		);
		$this->add_responsive_control(
			'ckbrsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox .tp-checkbox-thumbimg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Ckimg_Focus',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ckimg_Hb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox:hover .tp-checkbox-thumbimg',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ckimg_Hbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox:hover .tp-checkbox-thumbimg',
			)
		);
		$this->add_responsive_control(
			'ckbrsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-checkBox:hover .tp-checkbox-thumbimg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/*Ck Scroll Bar*/
		$this->add_control(
			'Ck_showmore_Heading',
			array(
				'label'     => __( 'Scroll Bar', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'Ck_scrollC_style' );
		$this->start_controls_tab(
			'Ck_scrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Ck_ScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'Ck_ScrollWidth',
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
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll::-webkit-scrollbar' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Ck_scrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Ck_ThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'Ck_ThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Ck_ThumbBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Ck_scrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Ck_TrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'Ck_TrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll::-webkit-scrollbar-track' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Ck_TrackBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox.tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'CkBox_hadding',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'CkBPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'CkBMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'CkBox_tab' );
		$this->start_controls_tab(
			'CkBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'CkB_Nbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'CkBNsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Ck_BoxN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox',
			)
		);
		$this->add_responsive_control(
			'Ck_NBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'CkB_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'CkB_Hbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'CkBHsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'CkB_BoxH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox:hover',
			)
		);
		$this->add_responsive_control(
			'CkB_HBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-checkBox:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		/*Checkbox end*/

		/*Datepicker Start*/
		$this->start_controls_section(
			'datesection',
			array(
				'label' => esc_html__( 'DatePicker', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'Date_Style',
			array(
				'label'   => __( 'Date layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default', 'theplus' ),
					'custom'  => __( 'Custom', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'DatelableHadding',
			array(
				'label'     => __( 'Lable Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'datelabletypo',
				'label'     => esc_html__( 'Lable Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > label',
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->add_control(
			'datelablepad',
			array(
				'label'      => __( 'Lable Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->start_controls_tabs(
			'Datelbltabs',
			array(
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->start_controls_tab(
			'Datelbl_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'Datelbl_Ncolor',
			array(
				'label'     => __( 'lable Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > label' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Datelbl_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'Datelbl_Hcolor',
			array(
				'label'     => __( 'lable Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap:hover > div > label' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DatepickerHadding',
			array(
				'label'     => __( 'Datepicker Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'datetypo',
				'label'     => esc_html__( 'Date Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > input[type=date]',
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->add_control(
			'Datepickerepad',
			array(
				'label'      => __( 'Datepicker Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > input[type=date]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->start_controls_tabs(
			'Datepickertabs',
			array(
				'condition' => array(
					'Date_Style' => 'default',
				),
			)
		);
		$this->start_controls_tab(
			'datepicker_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'Datepicker_Ncolor',
			array(
				'label'     => __( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > input[type=date]' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DatepickerNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > input[type=date]',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Datepicker_NBorder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > input[type=date]',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Datepicker_Nshadow',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-date-wrap > div > input[type=date]',
			)
		);
		$this->add_control(
			'DatepickericonNCr',
			array(
				'label'       => __( 'Icon Opacity', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap input[type=date]::-webkit-calendar-picker-indicator' => 'filter:invert({{SIZE}});',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'datepicker_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'Datepicker_Hcolor',
			array(
				'label'     => __( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap:hover > div > input[type=date]' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DatepickerHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-date-wrap:hover > div > input[type=date]',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Datepicker_HBorder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-date-wrap:hover > div > input[type=date]',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Datepicker_Hshadow',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-date-wrap:hover > div > input[type=date]',
			)
		);
		$this->add_control(
			'DatepickericonHCr',
			array(
				'label'       => __( 'Icon Opacity', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-search-filter .tp-date-wrap:hover input[type=date]::-webkit-calendar-picker-indicator' => 'filter:invert({{SIZE}});',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'Date_input_cus',
			array(
				'label'     => __( 'Input Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'DateInp_cuspad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'DateInp_cusmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tabs(
			'Dateinput_tab',
			array(
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tab(
			'Dateinput_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'DateinputNcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateinputNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateinputNB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateinputNsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Dateinput_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'DateinputHcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateinputHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateinputHB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateinputHsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-custom-date:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DateRange_hadding',
			array(
				'label'     => __( 'Date Range Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'DateRangepad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'.daterangepicker div.ranges' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'DateRangemar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'.daterangepicker div.ranges' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_control(
			'DateRangewidth',
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
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'.daterangepicker div.ranges ul' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'DateRangetypo',
				'label'     => esc_html__( 'Date Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '.daterangepicker div.ranges li',
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);

		$this->start_controls_tabs(
			'Daterange_tab',
			array(
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tab(
			'Daterange_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'DaterangeNcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.daterangepicker div.ranges ul li' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DaterangeNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker div.ranges ul li',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DaterangeNsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '.daterangepicker div.ranges ul li',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Daterange_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'DaterangeHcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.daterangepicker div.ranges ul li:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DaterangeHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker div.ranges ul li:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DaterangeHsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '.daterangepicker div.ranges ul li:hover',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Daterange_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'DaterangeAcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.daterangepicker div.ranges ul li.active' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DaterangeABg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker div.ranges ul li.active',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DaterangeAsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '.daterangepicker div.ranges ul li.active',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'Datecalendar_hadding',
			array(
				'label'     => __( 'Calendar Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'DateCalendar_pad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'.daterangepicker div.drp-calendar.left,.daterangepicker div.drp-calendar.right' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'DateCalendar_mar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'.daterangepicker div.drp-calendar.left,.daterangepicker div.drp-calendar.right' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tabs(
			'DateCalendar_tab',
			array(
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tab(
			'DateCalendar_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'DateCalendarNcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.daterangepicker div.drp-calendar.left,.daterangepicker div.drp-calendar.right,.daterangepicker div.calendar-table,.daterangepicker select.monthselect,.daterangepicker select.yearselect,.daterangepicker td:not(.active).available' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateCalendarNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker div.drp-calendar.left,.daterangepicker div.drp-calendar.right,.daterangepicker div.calendar-table,.daterangepicker select.monthselect,.daterangepicker select.yearselect,.daterangepicker td:not(.active).available',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DateCalendar_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'DateCalendarHcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.daterangepicker:hover div.drp-calendar.left,.daterangepicker:hover div.drp-calendar.right,.daterangepicker:hover div.calendar-table,.daterangepicker:hover select.monthselect,.daterangepicker:hover select.yearselect,.daterangepicker:hover  td:not(.active).available' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateCalendarHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker:hover div.drp-calendar.left,.daterangepicker:hover div.drp-calendar.right,.daterangepicker:hover div.calendar-table,.daterangepicker:hover select.monthselect,.daterangepicker:hover select.yearselect,.daterangepicker:hover  td:not(.active).available',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DateCalendar_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'DateCalendarAcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( 'div.daterangepicker td.active, div.daterangepicker td.active:hover' => 'color: {{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateCalendarABg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => 'div.daterangepicker td.active, div.daterangepicker td.active:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DateDropdown_hadding',
			array(
				'label'     => __( 'Monath & Year Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->add_responsive_control(
			'DateDropdown_Pad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array( 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
				'condition'  => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->add_responsive_control(
			'DateDropdown_mar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array( 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
				'condition'  => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'DateDropdownTypo',
				'label'     => esc_html__( 'Date Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect',
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tabs(
			'DateDropdown_tab',
			array(
				'condition' => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->start_controls_tab(
			'DateDropdown_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'DateDropdownNcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect' => 'color:{{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateDropdownNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateDropdownNB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateDropdownNsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => 'div.daterangepicker select.monthselect, div.daterangepicker select.yearselect',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DateDropdown_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'DateDropdownHcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( 'div.daterangepicker select.monthselect:hover, div.daterangepicker select.yearselect:hover' => 'color:{{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateDropdownHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => 'div.daterangepicker select.monthselect:hover, div.daterangepicker select.yearselect:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateDropdownHB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => 'div.daterangepicker:hover select.monthselect, div.daterangepicker:hover select.yearselect',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateDropdownHsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => 'div.daterangepicker select.monthselect:hover, div.daterangepicker select.yearselect:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DateIcon_hadding',
			array(
				'label'     => __( 'Icon Button Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->add_responsive_control(
			'DateIcon_Pad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array( 'div.daterangepicker th.prev, div.daterangepicker th.next' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
				'condition'  => array( 'Date_Style' => 'custom' ),
			)
		);

		$this->start_controls_tabs(
			'DateIconBtn_tab',
			array(
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tab(
			'DateIconBtn_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'DateIconBtnNcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( 'div.daterangepicker th.prev, div.daterangepicker th.next' => 'color:{{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateIconBtnNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => 'div.daterangepicker th.prev, div.daterangepicker th.next',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateIconBtnNB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => 'div.daterangepicker th.prev, div.daterangepicker th.next',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateIconBtnNsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => 'div.daterangepicker th.prev, div.daterangepicker th.next',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DateIconBtn_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'DateIconBtnHcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( 'div.daterangepicker th.prev:hover, div.daterangepicker th.next:hover' => 'color:{{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateIconBtnHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => 'div.daterangepicker th.prev:hover, div.daterangepicker th.next:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateIconBtnHB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => 'div.daterangepicker th.prev:hover, div.daterangepicker th.next:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateIconBtnHsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => 'div.daterangepicker th.prev:hover, div.daterangepicker th.next:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'Datefooter_hadding',
			array(
				'label'     => __( 'Date Footer Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->add_responsive_control(
			'Datefooter_Pad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array( 'div.daterangepicker div.drp-buttons' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
				'condition'  => array( 'Date_Style' => 'custom' ),
			)
		);
		$this->add_control(
			'Datefooterlablecr',
			array(
				'label'     => __( 'lable Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( 'div.daterangepicker .drp-buttons .drp-selected' => 'color:{{VALUE}}' ),
			)
		);
		$this->start_controls_tabs(
			'Datefooter_tab',
			array(
				'condition' => array(
					'Date_Style' => 'custom',
				),
			)
		);
		$this->start_controls_tab(
			'Datefooter_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'Datefooter_Ncr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '.daterangepicker div.drp-buttons button.cancelBtn, .daterangepicker div.drp-buttons button.applyBtn' => 'color:{{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Datefooter_NBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker div.drp-buttons button.cancelBtn, .daterangepicker div.drp-buttons button.applyBtn',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Datefooter_NB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '.daterangepicker div.drp-buttons button.cancelBtn, .daterangepicker div.drp-buttons button.applyBtn',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Datefooter_Nsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '.daterangepicker div.drp-buttons button.cancelBtn, .daterangepicker div.drp-buttons button.applyBtn',
			)
		);
		$this->add_control(
			'Datefooter_NBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array( '.daterangepicker div.drp-buttons button.cancelBtn, .daterangepicker div.drp-buttons button.applyBtn' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Datefooter_Hcancel',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'Datefooter_Hcr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '.daterangepicker div.drp-buttons button.cancelBtn:hover, .daterangepicker div.drp-buttons button.applyBtn:hover' => 'color:{{VALUE}}' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Datefooter_HBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.daterangepicker div.drp-buttons button.cancelBtn:hover, .daterangepicker div.drp-buttons button.applyBtn:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Datefooter_HB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '.daterangepicker div.drp-buttons button.cancelBtn:hover, .daterangepicker div.drp-buttons button.applyBtn:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Datefooter_Hsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '.daterangepicker div.drp-buttons button.cancelBtn:hover, .daterangepicker div.drp-buttons button.applyBtn:hover',
			)
		);
		$this->add_control(
			'Datefooter_HBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array( '.daterangepicker div.drp-buttons button.cancelBtn:hover, .daterangepicker div.drp-buttons button.applyBtn:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DateBox_hadding',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'DateBPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'DateBMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'DateBox_tab' );
		$this->start_controls_tab(
			'DateBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateB_Nbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Date_BoxN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap',
			)
		);
		$this->add_responsive_control(
			'Date_NBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateBNsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DateB_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'DateB_Hbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DateB_BoxH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap:hover',
			)
		);
		$this->add_responsive_control(
			'DateB_HBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DateBHsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-date-wrap:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		/*Datepicker End*/

		/*DropDown start*/
		$this->start_controls_section(
			'Select_styling',
			array(
				'label' => esc_html__( 'DropDown', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'selepad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'selemar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'DDwidth',
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
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-select' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'SelectTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select',
			)
		);
		$this->start_controls_tabs( 'Select_tabs' );
		$this->start_controls_tab(
			'Select_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'seletxtColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'selebgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select,{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-sbar-dropdown-menu',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'seleNBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select',
			)
		);
		$this->add_responsive_control(
			'seleNbrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'seleNBshadow',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Select_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'seletxtFcolor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'seleFbgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'seleFBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select:hover',
			)
		);
		$this->add_responsive_control(
			'seleHbrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'selFBshadow',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'DD_innerHeading',
			array(
				'label'     => __( 'DropDown Inner', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'DDenableimge',
			array(
				'label'        => __( 'Show Backend Only', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'block',
				'default'      => '',
				'selectors'    => array(
					'{{WRAPPER}} .tp-search-filter.tp-searchfilter-backend .tp-toggle-div .tp-select .tp-sbar-dropdown-menu' => 'display:{{value}};',
				),
			)
		);
		$this->start_controls_tabs( 'SelectInn_tabs' );
		$this->start_controls_tab(
			'SelectInn_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'selectInnCrN',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'selectInnBgCrN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'selectInnBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu',
			)
		);
		$this->add_responsive_control(
			'selectInnBrsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'selectInnBSdN',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'SelectInn_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'selectInnCrF',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'selectInnBgCrf',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'selectInnBf',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu:hover',
			)
		);
		$this->add_responsive_control(
			'selectInnBrsf',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'selectInnBSdf',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu:hover',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'SelectInn_Select',
			array(
				'label' => esc_html__( 'select', 'theplus' ),
			)
		);
		$this->add_control(
			'selectInnCrH',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-searchbar-li:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'selectInnBgCrH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-searchbar-li:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'selectInnBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-searchbar-li:hover',
			)
		);
		$this->add_responsive_control(
			'selectInnBrsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-searchbar-li:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'selectInnBSdH',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-searchbar-li:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'selectcount_Heading',
			array(
				'label'     => __( 'Counter', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'select_counterimageWidth',
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
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-select.style-2 .tp-sbar-dropdown-menu .tp-dd-counttxt' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'select_countmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-select.style-2 .tp-sbar-dropdown-menu .tp-dd-counttxt' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'select_countTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select.style-2 .tp-sbar-dropdown-menu .tp-dd-counttxt',
			)
		);
		$this->start_controls_tabs( 'select_count_tabs' );
		$this->start_controls_tab(
			'select_count_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'select_countNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu .tp-dd-counttxt' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'select_countBgN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu .tp-dd-counttxt',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'select_countTxtBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu .tp-dd-counttxt',
			)
		);
		$this->add_responsive_control(
			'select_countTxtBRsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu .tp-dd-counttxt' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'select_countBsdN',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu .tp-dd-counttxt',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'select_count_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'select_countHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu:hover .tp-dd-counttxt' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'select_countBgH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu:hover .tp-dd-counttxt',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'select_countTxtBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu:hover .tp-dd-counttxt',
			)
		);
		$this->add_responsive_control(
			'select_countTxtBRsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu:hover .tp-dd-counttxt' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'select_countBsdH',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-select .tp-sbar-dropdown-menu:hover .tp-dd-counttxt',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'DDImage_Heading',
			array(
				'label'     => __( 'Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'DDimageWidth',
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
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'DDOffsetsH',
			array(
				'label'      => esc_html__( 'Image Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'DDimg_tabs' );
		$this->start_controls_tab(
			'DDimg_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DDimg_Nb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDimg_Nbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg',
			)
		);
		$this->add_responsive_control(
			'DDbrsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'DDimg_Focus',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'DDimg_Hb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDimg_Hbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg:hover',
			)
		);
		$this->add_responsive_control(
			'DDbrsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu .tp-dd-thumbimg:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/*DD Scroll Bar*/
		$this->add_control(
			'DDScrollBarTab',
			array(
				'label'     => __( 'Scroll Bar', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'DDScrollheight',
			array(
				'label'      => __( 'Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu' => 'max-height:{{SIZE}}{{UNIT}};',
				),
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
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu::-webkit-scrollbar',
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
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu::-webkit-scrollbar' => 'width:{{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'DDThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDThumbBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu',
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
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'DDTrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu::-webkit-scrollbar-track' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'DDTrackBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-select .tp-sbar-dropdown-menu::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*DropDown End*/

		/*Radio start*/
		$this->start_controls_section(
			'Radio_styling',
			array(
				'label' => esc_html__( 'Radio Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'radioSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio .tp-radio-icon' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; line-height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'raleftOffset',
			array(
				'label'      => __( 'Offset Left', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio .tp-radio-icon' => 'margin-right:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'RadioIcon_Heading',
			array(
				'label'     => __( 'Radio Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'radioIconSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio .tp-radio-icon .radioIcon' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Radio_tabs' );
		$this->start_controls_tab(
			'Radio_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'radioNCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-radio input[type=radio]+label .tp-radio-icon svg' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'radioBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-radio .tp-radio-icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Radio_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'radioHCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-radio input[type=radio]+label:hover .tp-radio-icon svg' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Radio_Focus',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_control(
			'radiocCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-radio input[type=radio]:checked+label .tp-radio-icon svg' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'radiocheBor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-radio input[type=radio]:checked+label .tp-radio-icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'radioBradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio .tp-radio-icon' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'RadioLable_Heading',
			array(
				'label'     => __( 'Label', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rolabelTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-radio .tp-field-content',
			)
		);
		$this->start_controls_tabs( 'RadioLable_tabs' );
		$this->start_controls_tab(
			'RadioLable_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'rolabelNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio .tp-field-content' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RadioLable_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'rolabelColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio .tp-field-content:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RadioLable_Focus',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_control(
			'rokedLaColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toggle-div .tp-radio input[type=radio]:checked+label .tp-field-content' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'Rdcount_Heading',
			array(
				'label'     => __( 'Counter (Style 2)', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'Rd_countpad',
			array(
				'label'      => __( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'Rd_countmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'Rd_countTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter',
			)
		);
		$this->start_controls_tabs( 'Rd_count_tabs' );
		$this->start_controls_tab(
			'Rd_count_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'Rd_countNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Rd_countBgN',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Rd_countTxtBN',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter',
			)
		);
		$this->add_responsive_control(
			'Rd_countTxtBRsN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Rd_countBsdN',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-radio.style-2 .tp-field-Counter',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Rd_count_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'Rd_countHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-radio.style-2:hover .tp-field-Counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Rd_countBgH',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-radio.style-2:hover .tp-field-Counter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Rd_countTxtBH',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-radio.style-2:hover .tp-field-Counter',
			)
		);
		$this->add_responsive_control(
			'Rd_countTxtBRsH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-radio.style-2:hover .tp-field-Counter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Rd_countBsdH',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-radio.style-2:hover .tp-field-Counter',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'RadioTogIcon_Head',
			array(
				'label'     => __( 'Toggle Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'RadioTogsize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tog-plus' => 'font-size:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'radiotognalign',
			array(
				'label'      => __( 'Position', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-toggle' => 'right:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'radiotogplus_tabs' );
		$this->start_controls_tab(
			'radiotogplus_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'radiotogNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-toggle' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'radiotogplus_Focus',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'radiotogHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-toggle:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'RdImage_Heading',
			array(
				'label'     => __( 'Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'RdimageWidth',
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
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RdOffsetsH',
			array(
				'label'      => esc_html__( 'Image Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Rdimg_tabs' );
		$this->start_controls_tab(
			'Rdimg_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Rdimg_Nb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Rdimg_Nbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg',
			)
		);
		$this->add_responsive_control(
			'RdbrsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Rdimg_Focus',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Rdimg_Hb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Rdimg_Hbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg:hover',
			)
		);
		$this->add_responsive_control(
			'RdbrsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-radio .tp-radio-thumbimg:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/*Ck Scroll Bar*/
		$this->add_control(
			'rd_showmore_Heading',
			array(
				'label'     => __( 'Scroll Bar', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'rd_scrollC_style' );
		$this->start_controls_tab(
			'rd_scrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rd_ScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'rd_ScrollWidth',
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
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll::-webkit-scrollbar' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'rd_scrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rd_ThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'rd_ThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'rd_ThumbBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'rd_scrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rd_TrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'rd_TrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll::-webkit-scrollbar-track' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'rd_TrackBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio.tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'RdBox_hadding',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'RdBPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RdBMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'RdBox_tab' );
		$this->start_controls_tab(
			'RdBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RdBox_Nbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RdBoxNsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Rd_BoxN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio',
			)
		);
		$this->add_responsive_control(
			'Rd_NBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RdB_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RdB_Hbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RdBHsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RdB_BoxH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio:hover',
			)
		);
		$this->add_responsive_control(
			'RdB_HBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-wp-radio:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Radio End*/

		/*Range start*/
		$this->start_controls_section(
			'RangeSection',
			array(
				'label' => esc_html__( 'Range slider', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'RangePadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'RangeMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'RangeTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-range-silder .noUi-tooltip',
			)
		);
		$this->add_responsive_control(
			'RangeWid',
			array(
				'label'      => __( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 500,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .tp-range' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Rangeatab' );
		$this->start_controls_tab(
			'Rangeatab_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RangeLineNCr',
			array(
				'label'     => __( 'Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-connects' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'RangeAcLineNCr',
			array(
				'label'     => __( 'Active Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-connect' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'RangeBtnLineNCr',
			array(
				'label'     => __( 'Button Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-handle' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'RangeNBrs',
			array(
				'label'      => __( 'Button Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-handle' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Rangeatab_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RangeLineHCr',
			array(
				'label'     => __( 'Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-connects' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'RangeAcLineHCr',
			array(
				'label'     => __( 'Active Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-connect' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'RangeBtnLineHCr',
			array(
				'label'     => __( 'Button Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-handle' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'RangeHBrs',
			array(
				'label'      => __( 'Button Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-handle' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'RangeTips_had',
			array(
				'label'     => __( 'Tooltips Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'RangeTpPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'RangeTpMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RangeTpWid',
			array(
				'label'      => __( 'Position', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 5,
					),
					'%'  => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip' => 'bottom:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'RangeTptab' );
		$this->start_controls_tab(
			'RangeTptab_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RangeTpNCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RangeNTPBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RangeNTPB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip',
			)
		);
		$this->add_responsive_control(
			'RangeNTPBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RangeNTpshadow',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder .noUi-tooltip',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RangeTptab_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RangeTpHCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-tooltip' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'RangeHTPBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-tooltip',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RangeHTPB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-tooltip',
			)
		);
		$this->add_responsive_control(
			'RangeHTPBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RangeHTpshadow',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-range-silder:hover .noUi-tooltip',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Range End*/

		/*SearchInput start*/
		$this->start_controls_section(
			'SearchInput_styling',
			array(
				'label' => esc_html__( 'Search Input', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'SiPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'SiMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'SearchInputTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-wrap .tp-search-input',
			)
		);
		$this->start_controls_tabs( 'SI_tabs' );
		$this->start_controls_tab(
			'SI_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'textPlNCr',
			array(
				'label'     => __( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input::placeholder' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:-ms-input-placeholder' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:-ms-input-placeholder' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'textNCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'iconNcolor',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inbgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-wrap .tp-search-input',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inNBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-wrap .tp-search-input',
			)
		);
		$this->add_responsive_control(
			'inNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-wrap .tp-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inNBshadow',
				'selector' => '{{WRAPPER}} .tp-search-wrap .tp-search-input',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'SI_Focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'textPlHCr',
			array(
				'label'     => __( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus::placeholder' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus:-ms-input-placeholder' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus:-ms-input-placeholder' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'intxtFcolor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'iconHFcolor',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus + .tp-search-icon' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inFbgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-search-input:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inFBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus',
			)
		);
		$this->add_responsive_control(
			'inhBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inFBshadow',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-search-wrap .tp-search-input:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'searchBox_hadding',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'searchBPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'searchBMar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'searchBox_tab' );
		$this->start_controls_tab(
			'searchBox_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'search_Nbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'searchBNsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'search_BoxN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap',
			)
		);
		$this->add_responsive_control(
			'search_NBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'searchBox_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'search_Hbg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'searchHsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'search_BoxH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap:hover',
			)
		);
		$this->add_responsive_control(
			'search_HBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-search-wrap:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*SearchInput end*/

		/*Tabs Button start*/
		$this->start_controls_section(
			'TabsSection',
			array(
				'label' => esc_html__( 'Tab Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'TabInpadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing .tp-tabbing-wrapper' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'TabInmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing .tp-tabbing-wrapper' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TabTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper',
			)
		);
		$this->add_responsive_control(
			'TabSvgIconTypo',
			array(
				'label'      => __( 'Svg Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '20',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper svg' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabControl' );
		$this->start_controls_tab(
			'tab_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'TabNColor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TabNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TabNborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper',
			)
		);
		$this->add_responsive_control(
			'TabNbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'CounterNTabhadding',
			array(
				'label'     => __( 'Counter Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'TabshowColor',
			array(
				'label'     => __( 'Count Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper .tp-tabbing-counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'CounterNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper .tp-tabbing-counter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'CounterNborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper .tp-tabbing-counter',
			)
		);
		$this->add_responsive_control(
			'CounterNbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper .tp-tabbing-counter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'TabHColor',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TabHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TabHborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'TabHbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'CounterHTabhadding',
			array(
				'label'     => __( 'Counter Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'counterHColor',
			array(
				'label'     => __( 'Count Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover .tp-tabbing-counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'counterHBgColor',
			array(
				'label'     => __( 'Count Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover .tp-tabbing-counter' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'counterHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover .tp-tabbing-counter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'counterHborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover .tp-tabbing-counter',
			)
		);
		$this->add_responsive_control(
			'CounterHbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover .tp-tabbing-counter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_Active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'TabAshowColor',
			array(
				'label'     => __( 'Count Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active .tp-tabbing-counter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TabAshowBgColor',
			array(
				'label'     => __( 'Count Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active .tp-tabbing-counter' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'TabAColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TabABg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TabAborder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active',
			)
		);
		$this->add_responsive_control(
			'TabAbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper.active' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'TabImage_Heading',
			array(
				'label'     => __( 'Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'TabimageWidth',
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
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing .tp-dy-tabbing-thumbimg' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'TabOffsetsH',
			array(
				'label'      => esc_html__( 'Image Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing .tp-dy-tabbing-thumbimg' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Tabimg_tabs' );
		$this->start_controls_tab(
			'Tabimg_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Tabimg_Nb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing .tp-dy-tabbing-thumbimg',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Tabimg_Nbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing .tp-dy-tabbing-thumbimg',
			)
		);
		$this->add_responsive_control(
			'TabbrsN',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing .tp-dy-tabbing-thumbimg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Tabimg_Focus',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Tabimg_Hb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing:hover .tp-dy-tabbing-thumbimg',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Tabimg_Hbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing:hover .tp-dy-tabbing-thumbimg',
			)
		);
		$this->add_responsive_control(
			'TabbrsH',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tabbing:hover .tp-dy-tabbing-thumbimg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/*Tick Scroll Bar*/
		$this->add_control(
			'TabTick_Heading',
			array(
				'label'     => __( 'Tick Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'Tab_Tick_style' );
		$this->start_controls_tab(
			'Tab_Tick_Bar',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'TickNColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper .tp-tick-contener' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Tab_Tick_Tmb',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'TickHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper:hover .tp-tick-contener' => 'color:{{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/*Tab Scroll Bar*/
		$this->add_control(
			'Tab_showmore_Heading',
			array(
				'label'     => __( 'Scroll Bar', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'Tab_scrollC_style' );
		$this->start_controls_tab(
			'Tab_scrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Tab_ScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'Tab_ScrollWidth',
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
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll::-webkit-scrollbar' => 'width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Tab_scrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Tab_ThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'Tab_ThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Tab_ThumbBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Tab_scrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Tab_TrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'Tab_TrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll::-webkit-scrollbar-track' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Tab_TrackBsw',
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .field-col .tp-tabbing.tp-normal-scroll::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'BoxTabhadding',
			array(
				'label'     => __( 'Box Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TabCounterTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing-wrapper .tp-tabbing-counter',
			)
		);
		$this->add_responsive_control(
			'Tabpadding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'Tabmargin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TabBoxBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TabBoxB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing',
			)
		);
		$this->add_responsive_control(
			'TabBoxBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-tabbing' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/*Tab Button End*/

		/*Button Field Start*/
		$this->start_controls_section(
			'ButtonField_styling',
			array(
				'label' => esc_html__( 'Woo Button Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'BtnPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox .tp-color-opt' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'Btnmar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox .tp-color-opt' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'butnSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox .tp-color-opt' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; line-height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Button_tabs' );
		$this->start_controls_tab(
			'ButtonB_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'butnBor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox .tp-color-opt',
			)
		);
		$this->add_responsive_control(
			'butnNBradius',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox .tp-color-opt' => 'border-radius:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btnNSw',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox .tp-color-opt',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ButtonB_Checked',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btnBorchebor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox input[type=radio]:checked+label .tp-color-opt',
			)
		);
		$this->add_responsive_control(
			'butnHBradius',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox input[type=radio]:checked+label .tp-color-opt' => 'border-radius:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btnHSw',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-buttonBox input[type=radio]:checked+label .tp-color-opt',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Button Field Start*/

		/*Color Field Start*/
		$this->start_controls_section(
			'ColorField_styling',
			array(
				'label' => esc_html__( 'Woo Color Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'colorPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'colorMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'colorSize',
			array(
				'label'      => __( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-colorBox .tp-color-opt' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Color_tabs' );
		$this->start_controls_tab(
			'ColorB_Normal',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'colorBor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-colorBox span.tp-color-opt',
			)
		);
		$this->add_responsive_control(
			'colorNBradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-colorBox span.tp-color-opt' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ColorB_Checked',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Colorchebor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toggle-div .tp-colorBox input[type=checkbox]:checked+label span.tp-color-opt',
			)
		);
		$this->add_responsive_control(
			'colorHBradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toggle-div .tp-colorBox input[type=checkbox]:checked+label span.tp-color-opt' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'BoxCr_Heading',
			array(
				'label'     => __( 'Box Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'wooCrBPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'wooCrBMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bCrBG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bCrB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bCrbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-color',
			)
		);
		$this->end_controls_section();
		/*Color Field End*/

		/*Image Field Start*/
		$this->start_controls_section(
			'ImageField_styling',
			array(
				'label' => esc_html__( 'Woo Image Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'imgPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'imgmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Image_tabs' );
		$this->start_controls_tab(
			'ImageB_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'imgBor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox .woo-img-tag',
			)
		);
		$this->add_responsive_control(
			'imgNBradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox .woo-img-tag' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ImageNSw',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox .woo-img-tag',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ImageB_Checked',
			array(
				'label' => esc_html__( 'Checked', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'imgBorchebor',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox input[type=checkbox]:checked+label .woo-img-tag',
			)
		);
		$this->add_responsive_control(
			'imgHBradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox input[type=checkbox]:checked+label .woo-img-tag' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ImageHSw',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-imgBox input[type=checkbox]:checked+label .woo-img-tag',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'BOxImg_Heading',
			array(
				'label'     => __( 'Box Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'wooimgBPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-image' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'wooimgBMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-image' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bImgBG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-image',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bImgB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-image',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bImgbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-woo-image',
			)
		);
		$this->end_controls_section();
		/*image Field Start*/

		/*Rating ⭐ Start*/
		$this->start_controls_section(
			'Ratingsection',
			array(
				'label' => esc_html__( 'Woo Rating', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'starPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'starMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'starSize',
			array(
				'label'      => __( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon' => 'font-size:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Startabs' );
		$this->start_controls_tab(
			'StarNormal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'StarNCr',
			array(
				'label'     => __( 'Star Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					// '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon'=>'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-star-rating label' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-star-rating label~label' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'StarNBgCr',
			array(
				'label'     => __( 'Star Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'StarNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon',
			)
		);
		$this->add_responsive_control(
			'StarNBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'StarNBSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating .tp-start-icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'StarHover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'StarHCr',
			array(
				'label'     => __( 'Star Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-star-rating label:hover' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-star-rating label:hover~label' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'StarHBgCr',
			array(
				'label'     => __( 'Star Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover .tp-start-icon' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'StarHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover .tp-start-icon',
			)
		);
		$this->add_responsive_control(
			'StarHBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover .tp-start-icon' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'StarHBSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover .tp-start-icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'RatingBoxHead',
			array(
				'label'     => __( 'Box Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'Ratingalign',
			array(
				'label'     => __( 'Rating Alignment', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'RatingPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'RatingMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Ratingtabs' );
		$this->start_controls_tab(
			'RatingNormal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'RatingNBgCr',
			array(
				'label'     => __( 'Star Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RatingNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating',
			)
		);
		$this->add_responsive_control(
			'RatingNBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RatingNBSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'RatingHover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'RatinghBgCr',
			array(
				'label'     => __( 'Star Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'RatingHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover',
			)
		);
		$this->add_responsive_control(
			'RatingHBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'RatingHBSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-star-rating:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/* Rating End */

		/* Tooltip Field Start */
		$this->start_controls_section(
			'TooltipField_styling',
			array(
				'label' => esc_html__( 'Woo Tooltip', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'ToolPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ToolMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ToolPositon',
			array(
				'label'      => __( 'Top Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip' => 'bottom:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'ToolTxtCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ToolArrowCr',
			array(
				'label'     => __( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-tooltip::after' => 'border-right-color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ToolBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ToolB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ToolSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-tooltip',
			)
		);
		$this->end_controls_section();
		/* Tooltip Field End */

		/* Autocomplate Start */
		$this->start_controls_section(
			'Autocomplate_styling',
			array(
				'label' => esc_html__( 'Autocomplete', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'acpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap .tp-search-input-autocomplete' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'actabs' );
		$this->start_controls_tab(
			'acnormal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'acNCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap .tp-search-input-autocomplete' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'acNBgCr',
			array(
				'label'     => __( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap .tp-search-input-autocomplete' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'acNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap .tp-search-input-autocomplete',
			)
		);
		$this->add_responsive_control(
			'acNBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap .tp-search-input-autocomplete' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'acNBSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap .tp-search-input-autocomplete',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'achover',
			array(
				'label' => esc_html__( 'hover', 'theplus' ),
			)
		);
		$this->add_control(
			'achCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap:hover .tp-search-input-autocomplete' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'achBgCr',
			array(
				'label'     => __( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap:hover .tp-search-input-autocomplete' => 'Background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'achB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap:hover .tp-search-input-autocomplete',
			)
		);
		$this->add_responsive_control(
			'achBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap:hover .tp-search-input-autocomplete' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'achBSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap:hover .tp-search-input-autocomplete',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'acbox_heading',
			array(
				'label'     => __( 'Box Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'acboxBPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'acboxBMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'acboxbBG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'acboxbB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'acboxbsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-toggle-div .tp-autocomplete-wrap',
			)
		);
		$this->end_controls_section();
		/* Autocomplate End */

		/* Filter Tag start */
		$this->start_controls_section(
			'FilterTag_styling',
			array(
				'label' => esc_html__( 'Filter Tag', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'tagPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container .tp-filter-tag' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'tagMar',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'default'    => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container .tp-filter-tag' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'Fttexttypo',
				'label'    => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container .tp-filter-tag,{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container .tp-tag-link',
			)
		);
		$this->start_controls_tabs( 'FilterTag_tabs' );
		$this->start_controls_tab(
			'FilterTag_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tagColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container .tp-filter-tag' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'iconColor',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container .tp-tag-link i' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tagBgtypr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-tag',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FtNb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-tag',
			)
		);
		$this->add_responsive_control(
			'ftagNBBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-tag' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'FilterTag_Checked',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'tagHColor',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container:hover .tp-filter-tag' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'iconHcolor',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-container:hover .tp-tag-link i' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tagHbgType',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-tag:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FtHb',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-tag:hover',
			)
		);
		$this->add_responsive_control(
			'ftagHBBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-tag-wrap .tp-filter-tag:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/* Filter Tag End */

		/* Filter Reset start */
		$this->start_controls_section(
			'filterReset_section',
			array(
				'label' => __( 'Filter Reset Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'FiterResetPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'FiterResetmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filterResetTypo',
				'label'    => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset',
			)
		);
		$this->start_controls_tabs( 'FRTab' );
		$this->start_controls_tab(
			'FRN',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);

		$this->add_control(
			'FRnCR',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'FRiconNCR',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset .tp-tag-link i' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FRNBGCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FRNB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset',
			)
		);
		$this->add_responsive_control(
			'FRNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'FRNSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta span.tp-tag-reset',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'FRH',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'FRiconHCR',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta .tp-tag-link:hover .tp-tag-reset' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'FRHBGCr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta .tp-tag-link:hover .tp-tag-reset',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'FRHB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta .tp-tag-link:hover .tp-tag-reset',
			)
		);
		$this->add_responsive_control(
			'FRHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-filter-meta .tp-tag-link:hover .tp-tag-reset' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'FRHSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-filter-meta .tp-tag-link:hover .tp-tag-reset',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/* Filter Reset End */

		/* Filter TotalResult End */
		$this->start_controls_section(
			'totalresult_section',
			array(
				'label' => __( 'Total Result (Filter Meta)', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'Totalalign',
			array(
				'label'     => esc_html__( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-total-results-wrap' => 'justify-content:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'TRtxtPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-total-results-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'TRtxtmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-total-results-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'TRtxttypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap',
			)
		);
		$this->start_controls_tabs( 'TRTab' );
		$this->start_controls_tab(
			'TRN',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'TRNCR',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-total-results-wrap .tp-total-results-txt' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TRNBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TRB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap',
			)
		);
		$this->add_responsive_control(
			'TRNBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-total-results-wrap' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TRNBrsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'TRH',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'TRHCR',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-total-results-wrap:hover .tp-total-results-txt' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TRHBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'TRHB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap:hover',
			)
		);
		$this->add_responsive_control(
			'TRHBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-total-results-wrap:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TRHBrSd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-total-results-wrap:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/* Filter TotalResult End */

		/* Filter Column start */
		$this->start_controls_section(
			'ColumnFilterStyle',
			array(
				'label' => esc_html__( 'Column Filter (Filter Meta)', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'Cl_padding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'Cl_margin',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'Cl_Tab' );
		$this->start_controls_tab(
			'Cl_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'Cl_Ncr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Cl_NBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label svg',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Cl_NB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label svg',
			)
		);
		$this->add_responsive_control(
			'Cl_NBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label svg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Cl_NBsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label svg',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Cl_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'Cl_Hcr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label:hover svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Cl_HBg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label:hover svg',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Cl_HB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label:hover svg',
			)
		);
		$this->add_responsive_control(
			'Cl_HBrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label:hover svg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Cl_HBsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label:hover svg',
			)
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'Cl_Active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'Cl_Acr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label.active svg' => 'fill:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'Cl_ABg',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label.active svg',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'Cl_AB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label.active svg',
			)
		);
		$this->add_responsive_control(
			'Cl_ABrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label.active svg' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'Cl_ABsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap .tp-column-label.active svg',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'Cl_Heading',
			array(
				'label'     => __( 'Box Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'cl_BPad',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'cl_BMAr',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cl_BG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cl_BB',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cl_Bsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-column-result-wrap',
			)
		);
		$this->end_controls_section();
		/* Filter Column end */

		/* Showmore start */
		$this->start_controls_section(
			'ShowmoreSection',
			array(
				'label' => esc_html__( 'Showmore / Showless', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'showmorealign',
			array(
				'label'     => esc_html__( 'ShowMore Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
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
				'default'   => 'flex-start',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-tabbing-redmore' => 'justify-content:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ShowPadding',
			array(
				'label'      => __( 'More Text Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'ShowMargin',
			array(
				'label'      => __( 'More Text Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'MoreTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore',
			)
		);
		$this->start_controls_tabs( 'BasicTab' );
		$this->start_controls_tab(
			'BasicNormal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'ShowMANCr',
			array(
				'label'     => __( 'ShowMore Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore.ShowMore' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ShowlNCr',
			array(
				'label'     => __( 'ShowLess Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore.Showless' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'showNBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'showNB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore',
			)
		);
		$this->add_responsive_control(
			'showNBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'showNsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'BasicHover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'ShowMAHCr',
			array(
				'label'     => __( 'ShowMore Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore.ShowMore:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ShowlHCr',
			array(
				'label'     => __( 'ShowLess Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore.Showless:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'showHBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'showHB',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore:hover',
			)
		);
		$this->add_responsive_control(
			'showHBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'showHsd',
				'selector' => '{{WRAPPER}} .tp-search-filter .field-col .tp-filter-readmore:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Showmore End*/

		/*Filter button start*/
		$this->start_controls_section(
			'FilterBtnsection',
			array(
				'label'     => esc_html__( 'Filter Toggle Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnColumnSetting',
			array(
				'label'        => __( 'Columns option', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->start_popover();
		$this->add_control(
			'EnableBtnColumn',
			array(
				'label'        => __( 'Enable', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'BtnDesktop',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 3,
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'EnableBtnColumn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnTablet',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 3,
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'EnableBtnColumn' => 'yes',
				),
			)
		);
		$this->add_control(
			'BtnMobile',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 3,
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'EnableBtnColumn' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_control(
			'TogBtnalign',
			array(
				'label'     => esc_html__( 'Button Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => 'right',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-button-filter' => 'justify-content:{{VALUE}}',
				),
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'TogBtnalignRela',
			array(
				'label'     => esc_html__( 'Button Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'start'  => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'fa fa-chevron-up',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'end'    => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'fa fa-chevron-down',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-button-filter' => 'align-items:{{VALUE}};',
				),
				'condition' => array(
					'FilterBtn' => 'yes',
				),
				'toggle'    => true,
			)
		);
		$this->add_responsive_control(
			'FBtnPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'FBtnmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'FBtntxt',
				'label'     => __( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-text',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TogIconsize',
			array(
				'label'      => __( 'Icon or Image Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-icon' => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-ImageTag' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'FilterBtnTab' );
		$this->start_controls_tab(
			'ToggleBtnN',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'FbtextNCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-text' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'FbIconNCr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button .tp-button-icon svg' => 'fill:{{VALUE}}',
				),
				'condition' => array(
					'FilterBtn'   => 'yes',
					'ToggleMedia' => 'icon',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'TogNBG',
				'label'     => __( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'TogNBorder',
				'label'     => __( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TogNBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-button-filter .tp-toggle-button' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'TogNshadow',
				'label'     => __( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ToggleBtnH',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'FbtextHCr',
			array(
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button:hover .tp-button-text' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'FbIconHCr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button:hover .tp-button-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-toggle-button:hover .tp-button-icon svg' => 'fill:{{VALUE}}',
				),
				'condition' => array(
					'FilterBtn'   => 'yes',
					'ToggleMedia' => 'icon',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'TogHBG',
				'label'     => __( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button:hover',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'TogHBorder',
				'label'     => __( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button:hover',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TogHBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-button-filter .tp-toggle-button:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'TogHshadow',
				'label'     => __( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-toggle-button:hover',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'TogMPadd',
			array(
				'label'      => __( 'Media Padding', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-filter .tp-button-filter .tp-toggle-button.start .tp-button-text' => 'padding-left:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-search-filter .tp-button-filter .tp-toggle-button.end .tp-button-text' => 'padding-right:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/*Filter Button End*/

		/*Filter AjaxButton start*/
		$this->start_controls_section(
			'ajaxbtn_section',
			array(
				'label'     => esc_html__( 'Ajax Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_control(
			'ajaxBtnalign',
			array(
				'label'     => esc_html__( 'Button Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => '',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-ajaxbtn-filter' => 'justify-content:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ajaxBtnalignheight',
			array(
				'label'     => __( 'Button Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'flex-start' => __( 'Top', 'theplus' ),
					'center'     => __( 'Center', 'theplus' ),
					'flex-end'   => __( 'End', 'theplus' ),
					'stretch'    => __( 'stretch', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-ajaxbtn-filter' => 'align-items:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'ajaxBtnPad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-ajax-button' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ajaxBtnmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-ajax-button' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ajaxBtntypo',
				'label'    => __( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-ajax-button',
			)
		);
		$this->add_responsive_control(
			'ajaxBtnmediasize',
			array(
				'label'      => __( 'Icon or Image Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajaxbtn-icon' => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajaxbtn-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajaxbtn-ImageTag' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'AjaxbtnMedia!' => '',
				),
			)
		);
		$this->start_controls_tabs( 'ajaxBtnTab' );
		$this->start_controls_tab(
			'ajaxBtnN',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'ajaxBtnNCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ajaxbtnIconNCr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button .tp-ajaxbtn-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button .tp-ajaxbtn-icon svg' => 'fill:{{VALUE}}',
				),
				'condition' => array(
					'AjaxbtnMedia!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ajaxbtnNBG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ajaxbtnNBorder',
				'label'     => __( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ajaxbtnBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ajaxbtnshadow',
				'label'     => __( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ajaxBtnH',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'ajaxBtnHCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'ajaxbtnIconHCr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover .tp-ajaxbtn-icon' => 'color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover .tp-ajaxbtn-icon svg' => 'fill:{{VALUE}}',
				),
				'condition' => array(
					'Ajaxbutton'    => 'yes',
					'AjaxbtnMedia!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ajaxbtnHBG',
				'label'     => __( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover',
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ajaxbtnHBorder',
				'label'     => __( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ajaxbtHBRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ajaxbtHshadow',
				'label'     => __( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button:hover',
				'condition' => array(
					'FilterBtn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'ajaxBtnA',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'ajaxBtnACr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button.active' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_control(
			'ajaxbtnIconACr',
			array(
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button.active .tp-ajaxbtn-icon' => 'color:{{VALUE}}',
				),
				'condition' => array(
					'Ajaxbutton'    => 'yes',
					'AjaxbtnMedia!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ajaxbtnABG',
				'label'     => __( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button.active',
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ajaxbtnABorder',
				'label'     => __( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button.active',
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ajaxbtABRs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button.active' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ajaxbtAshadow',
				'label'     => __( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajaxbtn-filter .tp-ajax-button.active',
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'ajaxbtnSpinner',
			array(
				'label'        => __( 'BackEnd Enable Spinner', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'theplus' ),
				'label_off'    => __( 'Hide', 'theplus' ),
				'return_value' => 'inline-flex',
				'default'      => '',
				'separator'    => 'before',
				'condition'    => array(
					'Ajaxbutton'     => 'yes',
					'AjaxloadiconOn' => 'yes',
				),
				'selectors'    => array(
					'{{WRAPPER}} .tp-search-filter.tp-searchfilter-backend .tp-ajaxbtn-spinner-loader' => 'display:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'AjaxBtnlayout',
			array(
				'label'     => __( 'layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => __( 'Style-1', 'theplus' ),
					'style-2' => __( 'Style-2', 'theplus' ),
					'style-3' => __( 'Style-3', 'theplus' ),
				),
				'condition' => array(
					'Ajaxbutton'     => 'yes',
					'AjaxloadiconOn' => 'yes',
				),
			)
		);
		$this->add_control(
			'ajaxBtnsprACr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader.style-1,{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader.style-2,{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader.style-3' => 'border-top-color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader.style-2,{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader.style-3' => 'border-bottom-color:{{VALUE}}',
					'{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader.style-3' => 'border-left-color:{{VALUE}}',
				),
				'condition' => array(
					'Ajaxbutton'     => 'yes',
					'AjaxloadiconOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ajaxBtnsprABCr',
				'label'     => __( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-search-filter .tp-ajax-button.active .tp-ajaxbtn-spinner-loader',
				'condition' => array(
					'Ajaxbutton' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Filter AjaxButton End*/

		/*Archive Option start*/
		$this->start_controls_section(
			'archive_section',
			array(
				'label'     => esc_html__( 'Archive showMore Option', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'enable_archive'      => 'yes',
					'enable_archivefiled' => 'yes',
				),
			)
		);
		$this->add_control(
			'archivenalign',
			array(
				'label'     => esc_html__( 'Button Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => '',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore' => 'justify-content:{{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'archivePad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'archivemoreTab' );
		$this->start_controls_tab(
			'archivemoreN',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'archivemoreNCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'archivemoreNBG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'archivemoreNBorder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'archiveNshadow',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'archivemoreH',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'archivemoreHCr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'archivemoreHBG',
				'label'    => __( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'archivemoreHBorder',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'archiveHshadow',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter .tp-search-form .tp-archive-readmore:hover',
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
			'Bg_Padding',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tp-search-filter' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .tp-search-filter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'formBN',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter',
			)
		);
		$this->add_responsive_control(
			'formBBrN',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'formNsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter',
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
					'{{WRAPPER}} .tp-search-filter' => '-webkit-backdrop-filter:grayscale({{secbackdropshadown_grayscale.SIZE}})  blur({{secbackdropshadown_blur.SIZE}}{{secbackdropshadown_blur.UNIT}}) !important;backdrop-filter:grayscale({{secbackdropshadown_grayscale.SIZE}})  blur({{secbackdropshadown_blur.SIZE}}{{secbackdropshadown_blur.UNIT}}) !important;',
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
				'selector' => '{{WRAPPER}} .tp-search-filter:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'formBH',
				'label'    => __( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter:hover',
			)
		);
		$this->add_responsive_control(
			'formBBrH',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-search-filter:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'formHsd',
				'label'    => __( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-search-filter:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		$output        = '';
		$settings      = $this->get_settings_for_display();
		$ElementerID   = $this->get_unique_selector();
		$PageID        = get_the_ID();
		$WidgetId      = uniqid( 'wp-filter-' );
		$WidgetUniqId  = $this->get_id();
		$desktop_class = 'tp-col-lg-' . $settings['desktop_column'];
		$tablet_class  = 'tp-col-md-' . $settings['tablet_column'];
		$mobile_class  = 'tp-col-sm-' . $settings['mobile_column'];
		$mobile_class .= ' tp-col-' . $settings['mobile_column'];
		$DefType       = ! empty( $settings['TogBtnPos'] ) ? $settings['TogBtnPos'] : 'relative';

		$FieldArr    = array();
		$FilterField = $ResultTag = $FTR_txt = '';
		$searchField = ! empty( $settings['searchField'] ) ? $settings['searchField'] : array();
		if ( ! empty( $searchField ) ) {
			foreach ( $searchField as $index => $Filter ) {
				$RepeaterClass = 'elementor-repeater-item-' . esc_attr( $Filter['_id'] );
				$FilterOption  = isset( $Filter['filteroption'] ) ? $Filter['filteroption'] : '';
				$Wp_Type       = isset( $Filter['WpFilterType'] ) ? $Filter['WpFilterType'] : '';
				$Woo_Type      = isset( $Filter['WooFilterType'] ) ? $Filter['WooFilterType'] : '';
				$Ex_Type       = isset( $Filter['ExFilterType'] ) ? $Filter['ExFilterType'] : 'filter_tag';
				$ContentType   = isset( $Filter['ContentType'] ) ? $Filter['ContentType'] : '';
				$Title         = isset( $Filter['fieldTitle'] ) ? $Filter['fieldTitle'] : 'Category';
				$pAttr         = ! empty( $Filter['pAttr'] ) ? $Filter['pAttr'] : '';
				$ShowCount     = ! empty( $Filter['showCount'] ) ? 'yes' : '';
				$tooltip       = ! empty( $Filter['tooltip'] ) ? 'yes' : '';
				$ShowChild     = ! empty( $Filter['showChild'] ) ? 'yes' : '';
				$Titlelayout   = 'inline' === $Filter['Titlelayout'] ? 'tp-layout-inline' : '';

				if ( 'extrafilter' === $FilterOption ) {
					if ( 'filter_tag' === $Ex_Type ) {
						$ResultTag .= '<div class="tp-filter-tag-wrap"></div>';
					} elseif ( 'filter_reset' === $Ex_Type ) {
						$ResetEnable  = ! empty( $Filter['reset_enable'] ) ? true : false;
						$TagRemovePos = ! empty( $Filter['FRemove_style'] ) ? $Filter['FRemove_style'] : '';
						$Resettext    = ! empty( $Filter['resettext'] ) ? $Filter['resettext'] : '';

						$ResettextArray = array( 'Resettext' => $Resettext );
						$Resetdata      = 'data-resetbtndata="' . htmlspecialchars( json_encode( $ResettextArray, true ), ENT_QUOTES, 'UTF-8' ) . '"';

						$ResultTag .= '<div class="tp-filter-removetag ' . esc_attr( $TagRemovePos ) . ' hide" ' . $Resetdata . '></div>';

						if ( $ResetEnable ) {
							$ResultTag .= '<span class="tp-tag-reset-contener"><a class="tp-tag-link" data-type="fix_tagremove" data-name="fix_tagremove" data-id="fix_tagremove"><span class="tp-tag-reset"><i class="fa fa-times" aria-hidden="true"></i> ' . esc_html( $Resettext ) . '</span></a></span>';
						}
					} elseif ( 'total_results' === $Ex_Type ) {
						$FTR_txt = ! empty( $Filter['FTR_txt'] ) ? $Filter['FTR_txt'] : '';

						$FilterField         .= '<div class="field-col ' . esc_attr( $desktop_class ) . ' ' . esc_attr( $tablet_class ) . ' ' . esc_attr( $mobile_class ) . ' ">';
							$FilterField     .= '<div class="tp-total-results-wrap">';
								$FilterField .= '<span class="tp-total-resulttxt-org hide">' . esc_html( $FTR_txt ) . '</span>';
								$FilterField .= '<span class="tp-total-results-txt">' . esc_html( $FTR_txt ) . '</span>';
							$FilterField     .= '</div>';
						$FilterField         .= '</div>';
					} elseif ( 'Column_results' === $Ex_Type ) {
						$columnMerge = $this->tp_search_column( $settings['desktop_column'], $settings['tablet_column'], $settings['mobile_column'] );
						$ResultTag  .= $this->tp_column_change( $Filter, $columnMerge );
					}
				} else {
					$FilterField   .= '<div class="field-col ' . esc_attr( $Titlelayout ) . ' ' . esc_attr( $RepeaterClass ) . ' ' . esc_attr( $desktop_class ) . ' ' . esc_attr( $tablet_class ) . ' ' . esc_attr( $mobile_class ) . ' ">';
						$TaxonomyTT = isset( $Filter['TaxonomyType'] ) ? $Filter['TaxonomyType'] : '';
					if ( 'acf_conne' === $ContentType ) {
						$acfKey = '';
						if ( class_exists( 'acf' ) ) {
							$acfKey     = ! empty( $Filter['acfKey'] ) ? $Filter['acfKey'] : '';
							$cusField   = acf_get_field( $acfKey );
							$TaxonomyTT = ! empty( $cusField['name'] ) ? $cusField['name'] : '';
							$CPKey      = ! empty( $Filter['ColorPickerKey'] ) ? $Filter['ColorPickerKey'] : '';
						} else {
							$FilterField .= $this->Filter_ErrorShow( 'Install & Activate ACF Plugin to use this Option.' );
						}
					} elseif ( 'pods_conne' === $ContentType ) {
						if ( class_exists( 'PodsInit' ) ) {
							$TaxonomyTT = ! empty( $Filter['acfKey'] ) ? $Filter['acfKey'] : '';

							if ( $Woo_Type == 'color' ) {
								$TaxonomyTT = ! empty( $Filter['ColorPickerKey'] ) ? $Filter['ColorPickerKey'] : '';
							}
						} else {
							$FilterField .= $this->Filter_ErrorShow( 'Install & Activate PODs Plugin to use this Option.' );
						}
					} elseif ( 'toolset_conne' === $ContentType ) {
						if ( is_plugin_active( 'types/wpcf.php' ) ) {
							$TaxonomyTT = ! empty( $Filter['acfKey'] ) ? 'wpcf-' . esc_attr( $Filter['acfKey'] ) : '';

							if ( 'color' === $Woo_Type ) {
								$TaxonomyTT = ! empty( $Filter['ColorPickerKey'] ) ? 'wpcf-' . $Filter['ColorPickerKey'] : '';
							}
						} else {
							$FilterField .= $this->Filter_ErrorShow( 'Install & Activate Toolset Plugin to use this Option.' );
						}
					} elseif ( 'metabox_conne' === $ContentType ) {
						if ( class_exists( 'RWMB_Field' ) ) {
							$TaxonomyTT = ! empty( $Filter['acfKey'] ) ? $Filter['acfKey'] : '';

							if ( 'color' === $Woo_Type ) {
								$TaxonomyTT = ! empty( $Filter['ColorPickerKey'] ) ? $Filter['ColorPickerKey'] : '';
							}
						} else {
							$FilterField .= $this->Filter_ErrorShow( 'Install & Activate Toolset Plugin to use this Option.' );
						}
					}

						$WooSorting = ! empty( $Filter['WooFiltersSort'] ) ? $Filter['WooFiltersSort'] : '';
					if ( 'wpfilter' === $FilterOption ) {
						if ( 'alphabet' === $Wp_Type ) {
							$TPPrefix  = $this->tp_unique_widget_id( 'a', $Filter );
							$RID       = ! empty( $Filter['_id'] ) ? substr( $Filter['_id'], 3 ) : '';
							$Namevalue = "{$TPPrefix}-{$RID}";

							$FilterField           .= $this->tp_alphabet( $Filter, $Namevalue );
							$FieldArr['alphabet'][] = $this->tp_filter_aaray( "{$Namevalue}", 'taxonomy', 'alphabet' );
						} elseif ( 'checkbox' === $Wp_Type ) {
							$FilterField           .= $this->tp_filter_content( $Filter );
							$FieldArr['checkBox'][] = array(
								'name'  => $TaxonomyTT,
								'id'    => uniqid( $TaxonomyTT ),
								'field' => 'checkBox',
								'type'  => $ContentType,
							);
						} elseif ( 'drop_down' === $Wp_Type ) {
							$FilterField .= $this->tp_filter_content( $Filter );
							if ( ! empty( $WooSorting ) ) {
								$FieldArr['select'][] = array(
									'name'  => 'woo_SgDropDown',
									'id'    => uniqid( 'woo_SgDropDown-' ),
									'field' => 'woo_SgDropDown',
									'type'  => $ContentType,
								);
							} else {
								$FieldArr['select'][] = array(
									'name'  => $TaxonomyTT,
									'id'    => uniqid( $TaxonomyTT ),
									'field' => 'DropDown',
									'type'  => $ContentType,
								);
							}
						} elseif ( 'date' === $Wp_Type ) {
							$layout_Type  = ( ! empty( $Filter['layout_date'] ) ) ? $Filter['layout_date'] : 'style-1';
							$FilterField .= $this->tp_filter_content( $Filter );

							$TPPrefix  = $this->tp_unique_widget_id( 'date', $Filter );
							$RID       = ! empty( $Filter['_id'] ) ? substr( $Filter['_id'], 3 ) : '';
							$Namevalue = "{$TPPrefix}-{$RID}";

							if ( 'taxonomy' === $ContentType ) {
								$TaxonomyTT = $Namevalue;
							}

							$FieldArr['date'][] = $this->tp_filter_aaray( $TaxonomyTT, $ContentType, 'date', $layout_Type );
						} elseif ( 'radio' === $Wp_Type ) {
							$FilterField        .= $this->tp_filter_content( $Filter );
							$FieldArr['radio'][] = array(
								'name'  => $TaxonomyTT,
								'id'    => uniqid( $TaxonomyTT ),
								'field' => 'radio',
								'type'  => $ContentType,
							);
						} elseif ( 'search' === $Wp_Type ) {
							$TPPrefix = $this->tp_unique_widget_id( 's', $Filter );
							$RID      = ! empty( $Filter['_id'] ) ? substr( $Filter['_id'], 3 ) : '';

							if ( $ContentType == 'taxonomy' ) {
								$TaxonomyTT = "{$TPPrefix}-{$RID}";
							}

							$FilterField         .= $this->tp_filter_content( $Filter );
							$FieldArr['search'][] = $this->tp_filter_aaray( $TaxonomyTT, $ContentType, 'search' );
						} elseif ( 'tabbing' === $Wp_Type ) {
							$FilterField .= $this->tp_filter_content( $Filter );
							if ( ! empty( $WooSorting ) ) {
								$FieldArr['tabbing'][] = array(
									'name'  => 'woo_SgTabbing',
									'id'    => uniqid( 'woo_SgTabbing-' ),
									'field' => 'woo_SgTabbing',
									'type'  => $ContentType,
								);
							} else {
								$FieldArr['tabbing'][] = $this->tp_filter_aaray( $TaxonomyTT, $ContentType, 'tabbing' );
							}
						} elseif ( 'range' === $Wp_Type ) {
							$TPPrefix  = $this->tp_unique_widget_id( 'range', $Filter );
							$RID       = ! empty( $Filter['_id'] ) ? substr( $Filter['_id'], 3 ) : '';
							$Namevalue = "{$TPPrefix}-{$RID}";

							$FieldArr['range'][] = $this->tp_filter_aaray( $Namevalue, $ContentType, 'range' );

							$FilterField .= $this->tp_filter_content( $Filter );
						} elseif ( 'autocomplete' === $Wp_Type ) {
							if ( empty( $TaxonomyTT ) ) {
								$FieldName = 'autocomplete-' . $Filter['_id'];
							} else {
								$FieldName = $TaxonomyTT;
							}

							$FilterField               .= $this->tp_filter_content( $Filter );
							$FieldArr['autocomplete'][] = $this->tp_filter_aaray( $FieldName, $ContentType, 'autocomplete' );
						} elseif ( empty( $Wp_Type ) ) {
							$FilterField .= $this->Filter_ErrorShow( 'Select Source' );
						}
					} elseif ( 'Woofilter' === $FilterOption ) {
						if ( 'button' === $Woo_Type ) {
							if ( 'taxonomy' === $ContentType ) {
								$TaxonomyTT = $pAttr;
							}

							$FilterField         .= $this->tp_filter_content( $Filter );
							$FieldArr['button'][] = array(
								'name'  => $TaxonomyTT,
								'id'    => uniqid( $TaxonomyTT ),
								'field' => 'button',
								'type'  => $ContentType,
							);
						} elseif ( 'color' === $Woo_Type ) {
							if ( 'taxonomy' === $ContentType ) {
								$TaxonomyTT = $pAttr;
							}

							$FilterField        .= $this->tp_filter_content( $Filter );
							$FieldArr['color'][] = $this->tp_filter_aaray( $TaxonomyTT, $ContentType, 'color' );
						} elseif ( 'image' === $Woo_Type ) {
							if ( 'taxonomy' === $ContentType ) {
								$TaxonomyTT = $pAttr;
							}

							$FilterField        .= $this->tp_filter_content( $Filter );
							$FieldArr['image'][] = array(
								'name'  => $TaxonomyTT,
								'id'    => uniqid( $TaxonomyTT ),
								'field' => 'image',
								'type'  => $ContentType,
							);
						} elseif ( 'rating' === $Woo_Type ) {
							$TPPrefix  = $this->tp_unique_widget_id( 'rating', $Filter );
							$RID       = ! empty( $Filter['_id'] ) ? substr( $Filter['_id'], 3 ) : '';
							$Namevalue = "{$TPPrefix}-{$RID}";

							if ( 'taxonomy' === $ContentType ) {
								$TaxonomyTT = $Namevalue;
							}

							$FilterField         .= $this->tp_filter_content( $Filter );
							$FieldArr['rating'][] = array(
								'name'  => $TaxonomyTT,
								'id'    => uniqid( 'rating' ),
								'field' => 'rating',
								'type'  => $ContentType,
							);
						} elseif ( empty( $Woo_Type ) ) {
							$FilterField .= $this->Filter_ErrorShow( 'Select Source' );
						}
					}
					$FilterField .= '</div>';
				}
			}
		}

		$ErrorMsg = json_encode(
			array(
				'errormsg' => ! empty( $settings['ErrorMsg'] ) ? $settings['ErrorMsg'] : '',
			),
			true
		);

		$JSData = json_encode(
			array(
				'URLParameter'  => ! empty( $settings['URLParameter'] ) ? 1 : 0,
				'errormsg'      => ! empty( $settings['ErrorMsg'] ) ? $settings['ErrorMsg'] : '',
				'security'      => wp_create_nonce( 'theplus-searchfilter' ),
				'FilterTitle'   => ! empty( $settings['Ftagtitle'] ) ? 1 : 0,
				'AjaxButton'    => ! empty( $settings['Ajaxbutton'] ) ? 1 : 0,
				'Widgetid'      => ! empty( $WidgetUniqId ) ? $WidgetUniqId : '',
				'delayload'     => ! empty( $settings['delayload'] ) ? $settings['delayload'] : 0.3,
				'enablearchive' => ! empty( $settings['enable_archive'] ) ? true : false,
			),
			true
		);

		$Backclass = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? 'tp-searchfilter-backend' : '';

		$output                     .= '<div class="tp-search-filter ' . esc_attr( $Backclass ) . ' ' . esc_attr( $WidgetId ) . '" data-id="' . esc_attr( $WidgetId ) . '" data-basic=\'' . $JSData . '\' data-errordata= \'' . $ErrorMsg . '\'  data-connection="tp_list" onSubmit="return false;" >';
			$output                 .= '<div class="tp-filter-meta">' . $ResultTag . '</div>';
				$output             .= '<form class="tp-search-form" data-field=\'' . json_encode( $FieldArr ) . '\' >';
					$output         .= '<div class="tp-toggle-div">';
						$output     .= ( $DefType == 'fix' ) ? $this->tp_filter_button( $settings ) : '';
						$output     .= '<div class="tp-row">';
							$output .= $FilterField;
							$output .= $this->tp_ajax_button( $settings );
							$output .= ( $DefType == 'relative' ) ? $this->tp_filter_button( $settings ) : '';
						$output     .= '</div>';
					$output         .= '</div>';
				$output             .= '</form>';
		$output                     .= '</div>';

		echo $output;
	}

	/**
	 * Filter content for tp_filter_content.
	 *
	 * @since 1.0.0
	 * @param array $repeater The content to be filtered.
	 * @return HTML content.
	 */
	protected function tp_filter_content( $repeater ) {
		$output        = '';
		$settings      = $this->get_settings_for_display();
		$Uid           = ! empty( $repeater['_id'] ) ? $repeater['_id'] : uniqid();
		$Filter_Option = isset( $repeater['filteroption'] ) ? $repeater['filteroption'] : '';
		$Wp_Type       = isset( $repeater['WpFilterType'] ) ? $repeater['WpFilterType'] : '';
		$Woo_Type      = isset( $repeater['WooFilterType'] ) ? $repeater['WooFilterType'] : '';

		$ContentType = isset( $repeater['ContentType'] ) ? $repeater['ContentType'] : '';

		$Title = isset( $repeater['fieldTitle'] ) ? $repeater['fieldTitle'] : 'Category';

		$ShowCount = ! empty( $repeater['showCount'] ) ? 'yes' : '';
		$ShowChild = ! empty( $repeater['showChild'] ) ? 'yes' : '';
		$tooltip   = ! empty( $repeater['tooltip'] ) ? 'yes' : '';

		$fieldorder  = ! empty( $settings['fieldorder'] ) ? 'yes' : '';
		$orderpost   = ( ! empty( $fieldorder ) && ! empty( $settings['orderpost'] ) ) ? $settings['orderpost'] : 'ACE';
		$orderbypost = ( ! empty( $fieldorder ) && ! empty( $settings['orderbypost'] ) ) ? $settings['orderbypost'] : 'parent';

		$attr_class = '';
		if ( 'Woofilter' === $Filter_Option ) {
			$attr_class .= isset( $repeater['RDesktop_column'] ) ? ' tp-col-lg-' . esc_attr( $repeater['RDesktop_column'] ) : 'tp-col-lg-3';
			$attr_class .= isset( $repeater['RTablet_column'] ) ? ' tp-col-md-' . esc_attr( $repeater['RTablet_column'] ) : 'tp-col-md-4';
			$attr_class .= isset( $repeater['RMobile_column'] ) ? ' tp-col-sm-' . esc_attr( $repeater['RMobile_column'] ) : 'tp-col-md-4';
			$attr_class .= isset( $repeater['RMobile_column'] ) ? ' tp-col-' . esc_attr( $repeater['RMobile_column'] ) : 'tp-col-4';
		}

		if ( 'taxonomy' === $ContentType ) {
			$category = array();
			$Taxonomy = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';
			$pAttr    = ! empty( $repeater['pAttr'] ) ? $repeater['pAttr'] : '';

			if ( $Wp_Type != 'search' && $Wp_Type != 'range' && $Woo_Type != 'rating' && $Wp_Type != 'autocomplete' ) {
				if ( ! empty( $Taxonomy ) ) {
					$sequence  = array();
					$attrSlug  = ( $Taxonomy != 'product_attr' ) ? $Taxonomy : $pAttr;
					$cat_args  = array(
						'taxonomy'     => $attrSlug,
						'parent'       => 0,
						'show_count'   => 1,
						'hierarchical' => true,
						'hide_empty'   => 1,
						'order'        => $orderpost,
						'orderby'      => $orderbypost,
					);
					$tax_terms = get_terms( $cat_args );
					$sequence  = $this->hierarchical_sub_category_tree( $attrSlug );

					foreach ( $tax_terms as $value ) {
						$ImageURL = '';
						$TermId   = ! empty( $value->term_id ) ? $value->term_id : '';

						if ( ( $Taxonomy == 'category' || $Taxonomy == 'post_tag' || $Taxonomy == 'product_tag' ) && ! empty( $TermId ) ) {
							$ImageURL = get_term_meta( $TermId, 'tp_taxonomy_image', true );
						} elseif ( ( $Taxonomy == 'product_cat' ) && ! empty( $TermId ) ) {
							$GetImgID = get_term_meta( $TermId, 'thumbnail_id', true );

							$GetImgurl = wp_get_attachment_image_src( $GetImgID, 'tp-image-grid' );
							if ( ! empty( $GetImgurl ) ) {
								$ImageURL = $GetImgurl[0];
							}
						} elseif ( ! empty( $TermId ) ) {
							$ImageURL = get_term_meta( $TermId, 'tp_taxonomy_image', true );
						}

						$sub_args       = array(
							'taxonomy'     => $attrSlug,
							'child_of'     => $TermId,
							'orderby'      => 'parent',
							'hierarchical' => true,
							'hide_empty'   => 1,
						);
						$sub_categories = get_categories( $sub_args );

						$count = '';
						if ( ! empty( $value->count ) ) {
							$count = $value->count;
						} elseif ( ! empty( $sub_categories ) ) {
							$count = count( $sub_categories );
						}

						$category[ $TermId ] = array(
							'name'           => ! empty( $value->name ) ? $value->name : '',
							'slug'           => ! empty( $value->slug ) ? $value->slug : '',
							'count'          => ! empty( $count ) ? $count : '',
							'child'          => $sub_categories,
							'image'          => ! empty( $ImageURL ) ? $ImageURL : '',
							'tax_terms'      => $tax_terms,
							'child_sequence' => $sequence,
						);
					}
				} else {
					$output .= $this->Filter_ErrorShow( 'Select Taxonomy Option' );
				}
			}

			if ( $Filter_Option == 'wpfilter' ) {
				if ( $Wp_Type == 'search' ) {
					$output .= $this->tp_text_field( $Uid, 'searTxt', $repeater );
				} elseif ( $Wp_Type == 'checkbox' && ! empty( $category ) ) {
					$output .= $this->tp_checkbox( $category, $Title, $Taxonomy, $ShowCount, $pAttr, $ShowChild, $repeater );
				} elseif ( $Wp_Type == 'drop_down' && ! empty( $category ) ) {
					$output .= $this->tp_drop_down( $category, $Title, $Taxonomy, $ShowCount, $pAttr, $repeater );
				} elseif ( $Wp_Type == 'date' ) {
					$TPPrefix  = $this->tp_unique_widget_id( 'date', $repeater );
					$RID       = ! empty( $repeater['_id'] ) ? substr( $repeater['_id'], 3 ) : '';
					$Namevalue = "{$TPPrefix}-{$RID}";

					$output .= $this->tp_date( $Title, $Namevalue, $repeater );
				} elseif ( $Wp_Type == 'tabbing' && ! empty( $category ) ) {
					$output .= $this->tp_tabbing_filter( $category, $Taxonomy, $ShowCount, $repeater );
				} elseif ( $Wp_Type == 'radio' && ! empty( $category ) ) {
					$output .= $this->tp_radio( $category, $Title, $Taxonomy, $ShowCount, $pAttr, $ShowChild, $repeater );
				} elseif ( $Wp_Type == 'range' ) {
					$MaxPrice = ! empty( $repeater['maxPrice'] ) ? $repeater['maxPrice'] : 10000;
					$MinPrice = ! empty( $repeater['minPrice'] ) ? $repeater['minPrice'] : 0;
					$Steps    = ! empty( $repeater['steps'] ) ? $repeater['steps'] : 100;
					$output  .= $this->tp_range( $Title, $MaxPrice, $MinPrice, $Steps, 'price', $repeater );
				} elseif ( $Wp_Type == 'autocomplete' ) {
					$FieldName = 'autocomplete-' . $repeater['_id'];
					$output   .= $this->tp_autocomplete( $FieldName, $repeater );
				}
			} elseif ( $Filter_Option == 'Woofilter' ) {
				if ( $Woo_Type == 'button' && ! empty( $category ) ) {
					$output .= $this->tp_button_field( $category, $Taxonomy, $ShowCount, $pAttr, $tooltip, $attr_class, $repeater );
				} elseif ( $Woo_Type == 'color' && ! empty( $category ) ) {
					$output .= $this->tp_color_field( $category, $Taxonomy, $ShowCount, $pAttr, $tooltip, $attr_class, $repeater );
				} elseif ( $Woo_Type == 'image' ) {
					$output .= $this->tp_image_field( $category, $Taxonomy, $ShowCount, $pAttr, $tooltip, $attr_class, $repeater );
				} elseif ( $Woo_Type == 'rating' ) {
					$output .= $this->tp_rating( $repeater, 'rating' );
				}
			}
		} elseif ( 'acf_conne' === $ContentType ) {
			$acfArr = array();
			if ( class_exists( 'ACF' ) ) {
				$acfKey   = ! empty( $repeater['acfKey'] ) ? $repeater['acfKey'] : '';
				$cusField = acf_get_field( $acfKey );
				$cusType  = ! empty( $cusField['type'] ) ? $cusField['type'] : '';
				$cusName  = ! empty( $cusField['name'] ) ? $cusField['name'] : '';

				if ( ! empty( $cusField ) && ! empty( $cusField['choices'] ) ) {
					foreach ( $cusField['choices'] as $value => $data ) {
						$acfArr[ $value ] = array( 'name' => $data );
					}
				}

				if ( $Filter_Option == 'wpfilter' ) {
					if ( $Wp_Type == 'search' ) {
						$output .= $this->tp_text_field( $Uid, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'checkbox' ) {
						$output .= $this->tp_checkbox( $acfArr, $Title, $cusName, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'date' ) {
						$output .= $this->tp_date( $Title, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'drop_down' ) {
						$output .= $this->tp_drop_down( $acfArr, $Title, $cusName, '', '', $repeater );
					} elseif ( $Wp_Type == 'radio' ) {
						$output .= $this->tp_radio( $acfArr, $Title, $cusName, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'range' ) {
						$Max  = ( ! empty( $cusField ) && ! empty( $cusField['max'] ) ) ? $cusField['max'] : 10000;
						$Min  = ( ! empty( $cusField ) && ! empty( $cusField['min'] ) ) ? $cusField['min'] : 0;
						$step = ( ! empty( $cusField ) && ! empty( $cusField['step'] ) ) ? $cusField['step'] : 5;

						$output .= $this->tp_range( $Title, $Max, $Min, $step, $cusName, $repeater );
					} elseif ( $Wp_Type == 'tabbing' ) {
						$data = array();
						global $post, $wpdb;
						$PubliStatus   = 'publish';
						$PrepareQ      = $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_status=%s", $PubliStatus );
							$GetResult = $wpdb->get_results( $PrepareQ );
						if ( is_array( $GetResult ) ) {
							$data = array();
							foreach ( $GetResult as $key => $one ) {
								$AcfCrName = get_field( $acfKey, $one->ID );
								if ( ! empty( $AcfCrName ) ) {
									$array2 = explode( '|', $AcfCrName );

									foreach ( $array2 as $key => $two ) {
										$value          = str_replace( ' ', '-', ltrim( rtrim( $two ) ) );
										$data[ $value ] = array( 'name' => $value );
									}
								}
							}
						}
						$output .= $this->tp_tabbing_filter( $data, $acfKey, $ShowCount, $repeater );
					}
				} elseif ( $Filter_Option == 'Woofilter' ) {
					if ( $Woo_Type == 'rating' ) {
						$output .= $this->tp_rating( $repeater, $cusName );
					} elseif ( $Woo_Type == 'color' ) {
						$CPKey = ! empty( $repeater['ColorPickerKey'] ) ? $repeater['ColorPickerKey'] : '';
						global $post, $wpdb;
							$PrepareQ  = $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_status='publish'" );
							$GetResult = $wpdb->get_results( $PrepareQ );
						if ( is_array( $GetResult ) ) {
							$data = array();
							foreach ( $GetResult as $key => $one ) {
								$AcfCrName = get_field( $acfKey, $one->ID );
								$ColorCode = get_field( $CPKey, $one->ID );

								$ColorName = str_replace( ' ', '-', $AcfCrName );
								$i         = 0;
								if ( ! empty( $ColorName ) ) {
									++$count[ $ColorName ];
								}
								if ( ! empty( $ColorName ) && ! empty( $ColorCode ) ) {
									$data[ $ColorName ] = array(
										'name'  => $ColorName,
										'code'  => $ColorCode,
										'count' => $count,
									);
								}
							}
						}
						$output .= $this->tp_color_field( $data, $Taxonomy, $ShowCount, $CPKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'image' ) {
						$data = array();
						global $post, $wpdb;
							$PrepareQ  = $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_status='publish'" );
							$GetResult = $wpdb->get_results( $PrepareQ );
						if ( is_array( $GetResult ) ) {
							foreach ( $GetResult as $key => $one ) {
								$AcfCrName = get_field( $acfKey, $one->ID );
								if ( ! empty( $AcfCrName ) ) {
									$data[ $AcfCrName['ID'] ] = array(
										'name'  => $AcfCrName['ID'],
										'title' => $AcfCrName['title'],
										'url'   => $AcfCrName['sizes']['thumbnail'],
									);
								}
							}
						}
						$output .= $this->tp_image_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'button' ) {
						$data = array();
						global $post, $wpdb;
						$PrepareQ  = $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_status='publish'" );
						$GetResult = $wpdb->get_results( $PrepareQ );
						if ( is_array( $GetResult ) ) {
							foreach ( $GetResult as $key => $one ) {
								$Name = get_field( $acfKey, $one->ID );
								if ( ! empty( $Name ) ) {
									$data[ $Name ] = array( 'name' => $Name );
								}
							}
						}
						$output .= $this->tp_button_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
					}
				}
			}
		} elseif ( 'toolset_conne' === $ContentType ) {
			if ( is_plugin_active( 'types/wpcf.php' ) ) {
				$acfArr   = array();
				$acfKey   = ! empty( $repeater['acfKey'] ) ? 'wpcf-' . esc_attr( $repeater['acfKey'] ) : '';
				$Taxonomy = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';
				if ( $Filter_Option == 'wpfilter' ) {
					if ( $Wp_Type == 'search' ) {
						$output .= $this->tp_text_field( $Uid, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'tabbing' ) {
						$Conn_values = $this->tp_connection_values( $acfKey, $ContentType );
						$output     .= $this->tp_tabbing_filter( $Conn_values, $acfKey, $ShowCount, $repeater );
					} elseif ( $Wp_Type == 'date' ) {
						$output .= $this->tp_date( $Title, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'checkbox' ) {
						if ( ! empty( $acfKey ) ) {
							global $post, $wpdb;
							$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", 'publish', $acfKey ) );

							foreach ( $DB_Result as $data ) {
								if ( ! empty( $data ) && ! empty( $data->post_id ) ) {
									$chk = get_post_field( $acfKey, $data->post_id );

									foreach ( $chk as $data1 ) {
										$acfArr[ $data1[0] ] = array( 'name' => $data1[0] );
									}
								}
							}
						}

						$output .= $this->tp_checkbox( $acfArr, $Title, $acfKey, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'radio' ) {
						if ( ! empty( $acfKey ) ) {
							global $post, $wpdb;
							$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", 'publish', $acfKey ) );

							foreach ( $DB_Result as $data ) {
								if ( ! empty( $data ) && ! empty( $data->post_id ) ) {
									$chk = get_post_field( $acfKey, $data->post_id );
									if ( ! empty( $chk ) ) {
										$acfArr[ $chk ] = array( 'name' => $chk );
									}
								}
							}
						}
						$output .= $this->tp_radio( $acfArr, $Title, $acfKey, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'range' ) {
						$Max  = ! empty( $repeater['maxPrice'] ) ? $repeater['maxPrice'] : 10000;
						$Min  = ! empty( $repeater['minPrice'] ) ? $repeater['minPrice'] : 0;
						$step = ! empty( $repeater['steps'] ) ? $repeater['steps'] : 100;

						$output .= $this->tp_range( $Title, $Max, $Min, $step, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'drop_down' ) {
						if ( ! empty( $acfKey ) ) {
							global $post, $wpdb;
							$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", 'publish', $acfKey ) );

							foreach ( $DB_Result as $key => $data ) {
								if ( ! empty( $data ) && ! empty( $data->post_id ) ) {
									$chk = get_post_field( $acfKey, $data->post_id );
									if ( ! empty( $chk ) ) {
										$acfArr[ $chk ] = array( 'name' => $chk );
									}
								}
							}
						}

						$output .= $this->tp_drop_down( $acfArr, $Title, $acfKey, '', '', $repeater );
					} elseif ( $Wp_Type == 'autocomplete' ) {
						$output .= $this->tp_autocomplete( $acfKey, $repeater );
					}
				} elseif ( $Filter_Option == 'Woofilter' ) {
					if ( $Woo_Type == 'rating' ) {
						$output .= $this->tp_rating( $repeater, $acfKey );
					} elseif ( $Woo_Type == 'color' ) {
						$data  = array();
						$CPKey = ! empty( $repeater['ColorPickerKey'] ) ? 'wpcf-' . $repeater['ColorPickerKey'] : '';

						global $post, $wpdb;
						$GetResult = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->postmeta}.meta_key FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", 'publish', $CPKey ) );

						if ( is_array( $GetResult ) && ! empty( $GetResult ) ) {
							foreach ( $GetResult as $one ) {
								$CrName    = $count = array();
								$PostId    = $one->post_id;
								$MetaValue = $one->meta_value;

								if ( ! empty( $acfKey ) ) {
									$CrName = get_post_meta( $PostId, $acfKey, false );
								}

								if ( ! empty( $one->meta_value ) ) {
									if ( ! empty( $count[ $one->meta_value ] ) ) {
										++$count[ $one->meta_value ];
									} else {
										$count[ $one->meta_value ] = 1;
									}
								}

								$data[ $one->meta_value ] = array(
									'name'  => ! empty( $CrName[0] ) ? $CrName[0] : $MetaValue,
									'code'  => $one->meta_value,
									'count' => $count,
								);
							}
						}
						$output .= $this->tp_color_field( $data, $Taxonomy, $ShowCount, $CPKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'image' ) {
						$data = array();
						if ( ! empty( $acfKey ) ) {
							global $post, $wpdb;
							$GetResult = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->postmeta}.meta_key FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", 'publish', $acfKey ) );

							if ( is_array( $GetResult ) && ! empty( $GetResult ) ) {
								foreach ( $GetResult as $key => $one ) {
									$data[ $one->meta_value ] = array(
										'name'  => $one->meta_value,
										'title' => $one->meta_key,
										'url'   => $one->meta_value,
									);
								}
							}
						}
						$output .= $this->tp_image_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'button' ) {
						$data = array();
						global $post, $wpdb;
						$GetResult = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->postmeta}.meta_key FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->posts}.post_status = %s AND {$wpdb->postmeta}.meta_key = %s ", 'publish', $acfKey ) );

						if ( is_array( $GetResult ) && ! empty( $GetResult ) ) {
							foreach ( $GetResult as $one ) {
								if ( ! empty( $one ) ) {
									$array2 = explode( '|', $one->meta_value );

									foreach ( $array2 as $two ) {
										$data[ trim( $two ) ] = array( 'name' => trim( $two ) );
									}
								}
							}
						}
						$output .= $this->tp_button_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
					}
				}
			}
		} elseif ( 'pods_conne' === $ContentType ) {
			if ( class_exists( 'PodsInit' ) ) {
				$acfArr   = array();
				$acfKey   = ! empty( $repeater['acfKey'] ) ? $repeater['acfKey'] : '';
				$Taxonomy = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';

				if ( $Filter_Option == 'wpfilter' ) {
					if ( $Wp_Type == 'search' ) {
						$output .= $this->tp_text_field( $Uid, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'tabbing' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->posts}.post_name = %s AND {$wpdb->posts}.post_status = %s AND {$wpdb->posts}.post_type = %s AND {$wpdb->postmeta}.meta_key = %s ", $acfKey, 'publish', '_pods_field', $acfKey ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$Data[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_tabbing_filter( $Data, $acfKey, $ShowCount, $repeater );
					} elseif ( $Wp_Type == 'date' ) {
						$output .= $this->tp_date( $Title, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'checkbox' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$acfArr[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}

						$output .= $this->tp_checkbox( $acfArr, $Title, $acfKey, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'radio' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $key => $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$acfArr[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_radio( $acfArr, $Title, $acfKey, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'range' ) {
						$Max  = ! empty( $repeater['maxPrice'] ) ? $repeater['maxPrice'] : 10000;
						$Min  = ! empty( $repeater['minPrice'] ) ? $repeater['minPrice'] : 0;
						$step = ! empty( $repeater['steps'] ) ? $repeater['steps'] : 100;

						$output .= $this->tp_range( $Title, $Max, $Min, $step, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'drop_down' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$acfArr[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_drop_down( $acfArr, $Title, $acfKey, '', '', $repeater );
					} elseif ( $Wp_Type == 'autocomplete' ) {
						$output .= $this->tp_autocomplete( $acfKey, $repeater );
					}
				} elseif ( $Filter_Option == 'Woofilter' ) {
					if ( $Woo_Type == 'rating' ) {
						$output .= $this->tp_rating( $repeater, $acfKey );
					} elseif ( $Woo_Type == 'color' ) {
						$data  = array();
						$CPKey = ! empty( $repeater['ColorPickerKey'] ) ? $repeater['ColorPickerKey'] : '';
						global $post, $wpdb;

						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $CPKey, 'publish' ) );

						foreach ( $DB_Result as $value ) {
							$CrName    = array();
							$PostId    = $value->post_id;
							$MetaValue = $value->meta_value;

							if ( ! empty( $acfKey ) ) {
								$CrName = get_post_meta( $PostId, $acfKey, false );
							}

							if ( ! empty( $MetaValue ) ) {
								if ( ! empty( $count[ $MetaValue ] ) ) {
									++$count[ $MetaValue ];
								} else {
									$count[ $MetaValue ] = 1;
								}
							}

							$data[ $MetaValue ] = array(
								'name'  => ! empty( $CrName[0] ) ? $CrName[0] : $MetaValue,
								'code'  => $MetaValue,
								'count' => $count,
							);
						}
						$output .= $this->tp_color_field( $data, $Taxonomy, $ShowCount, $CPKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'image' ) {
						$data = array();
						if ( ! empty( $acfKey ) ) {
							global $post, $wpdb;
							$GetResult = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->posts}.guid, {$wpdb->posts}.post_title FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.meta_key = %s AND {$wpdb->postmeta}.meta_value = {$wpdb->posts}.ID ", $acfKey ) );

							if ( is_array( $GetResult ) && ! empty( $GetResult ) ) {
								foreach ( $GetResult as $one ) {
									$data[ $one->meta_value ] = array(
										'name'  => $one->meta_value,
										'title' => $one->post_title,
										'url'   => $one->guid,
									);
								}
							}
						}
						$output .= $this->tp_image_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'button' ) {
						$data = array();
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.meta_key = %s And {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );
								foreach ( $array2 as $two ) {
									$data[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_button_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
					}
				}
			}
		} elseif ( 'metabox_conne' === $ContentType ) {
			if ( class_exists( 'RWMB_Field' ) ) {
				$acfArr   = array();
				$acfKey   = ! empty( $repeater['acfKey'] ) ? $repeater['acfKey'] : '';
				$Taxonomy = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';

				if ( $Filter_Option == 'wpfilter' ) {
					if ( $Wp_Type == 'search' ) {
						$output .= $this->tp_text_field( $Uid, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'tabbing' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$Data[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_tabbing_filter( $Data, $acfKey, $ShowCount, $repeater );
					} elseif ( $Wp_Type == 'date' ) {
						$output .= $this->tp_date( $Title, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'checkbox' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$acfArr[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}

						$output .= $this->tp_checkbox( $acfArr, $Title, $acfKey, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'radio' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$acfArr[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_radio( $acfArr, $Title, $acfKey, '', '', '', $repeater );
					} elseif ( $Wp_Type == 'range' ) {
						$Max  = ! empty( $repeater['maxPrice'] ) ? $repeater['maxPrice'] : 10000;
						$Min  = ! empty( $repeater['minPrice'] ) ? $repeater['minPrice'] : 0;
						$Step = ! empty( $repeater['steps'] ) ? $repeater['steps'] : 100;

						$output .= $this->tp_range( $Title, $Max, $Min, $Step, $acfKey, $repeater );
					} elseif ( $Wp_Type == 'drop_down' ) {
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$acfArr[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_drop_down( $acfArr, $Title, $acfKey, '', '', $repeater );
					} elseif ( $Wp_Type == 'autocomplete' ) {
						$output .= $this->tp_autocomplete( $acfKey, $repeater );
					}
				} elseif ( $Filter_Option == 'Woofilter' ) {
					if ( $Woo_Type == 'rating' ) {
						$output .= $this->tp_rating( $repeater, $acfKey );
					} elseif ( $Woo_Type == 'color' ) {
						$data  = array();
						$CPKey = ! empty( $repeater['ColorPickerKey'] ) ? $repeater['ColorPickerKey'] : '';
						global $post, $wpdb;

						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $CPKey, 'publish' ) );

						foreach ( $DB_Result as $value ) {
							$CrName    = array();
							$PostId    = ( ! empty( $value ) && ! empty( $value->post_id ) ) ? $value->post_id : '';
							$MetaValue = ( ! empty( $value ) && ! empty( $value->meta_value ) ) ? $value->meta_value : '';

							if ( ! empty( $acfKey ) ) {
								$CrName = get_post_meta( $PostId, $acfKey, false );
							}

							if ( ! empty( $MetaValue ) ) {
								if ( ! empty( $count[ $MetaValue ] ) ) {
									++$count[ $MetaValue ];
								} else {
									$count[ $MetaValue ] = 1;
								}
							}

							$data[ $MetaValue ] = array(
								'name'  => ! empty( $CrName[0] ) ? $CrName[0] : $MetaValue,
								'code'  => $MetaValue,
								'count' => $count,
							);
						}
						$output .= $this->tp_color_field( $data, $Taxonomy, $ShowCount, $CPKey, $tooltip, $attr_class, $repeater );
					} elseif ( $Woo_Type == 'image' ) {
						$data = array();
						if ( ! empty( $acfKey ) ) {
							global $post, $wpdb;
							$GetResult = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_value, {$wpdb->posts}.guid, {$wpdb->posts}.post_title FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.meta_key = %s AND {$wpdb->postmeta}.meta_value = {$wpdb->posts}.ID ", $acfKey ) );

							if ( is_array( $GetResult ) && ! empty( $GetResult ) ) {
								foreach ( $GetResult as $one ) {
									$data[ $one->meta_value ] = array(
										'name'  => $one->meta_value,
										'title' => $one->post_title,
										'url'   => $one->guid,
									);
								}
							}
							$output .= $this->tp_image_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );
						}
					} elseif ( $Woo_Type == 'button' ) {
						$data = array();
						global $post, $wpdb;
						$DB_Result = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->postmeta}.post_id, {$wpdb->postmeta}.meta_key, {$wpdb->postmeta}.meta_value FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID And {$wpdb->postmeta}.meta_key = %s AND {$wpdb->posts}.post_status = %s ", $acfKey, 'publish' ) );

						if ( ! empty( $DB_Result ) ) {
							foreach ( $DB_Result as $value ) {
								$array2 = explode( '|', $value->meta_value );

								foreach ( $array2 as $two ) {
									$data[ trim( $two ) ] = array( 'name' => trim( $two ) );
								}
							}
						}
						$output .= $this->tp_button_field( $data, $Taxonomy, $ShowCount, $acfKey, $tooltip, $attr_class, $repeater );

					}
				}
			}
		} else {
			$output .= $this->Filter_ErrorShow( 'Select Type' );
		}

		return $output;
	}

	/**
	 * Generate a hierarchical sub-category tree based on specified attribute slug.
	 *
	 * @since 1.0.0
	 *
	 * @param string $attrSlug The attribute slug for building the sub-category tree.
	 *
	 * @return mixed The result of generating the hierarchical sub-category tree.
	 */
	protected function hierarchical_sub_category_tree( $attrSlug ) {
		$ChildSpace  = array(
			'taxonomy'     => $attrSlug,
			'orderby'      => 'parent',
			'hierarchical' => true,
			'hide_empty'   => 1,
		);
		$ChildSpaCat = get_categories( $ChildSpace );

		$a1 = $a2 = $a3 = $a4 = $a5 = $sequence = array();
		foreach ( $ChildSpaCat as $prod_cat ) {
			if ( $prod_cat->parent == 0 ) {
				$a1[]                           = $prod_cat->term_id;
				$sequence[ $prod_cat->term_id ] = '1';
			}
		}
		foreach ( $ChildSpaCat as $c1 ) {
			foreach ( $a1 as $p2 ) {
				if ( $c1->parent == $p2 ) {
					$a2[]                     = $c1->term_id;
					$sequence[ $c1->term_id ] = '2';
				}
			}
		}
		foreach ( $ChildSpaCat as $c1 ) {
			foreach ( $a2 as $p3 ) {
				if ( $c1->parent == $p3 ) {
					$a3[]                     = $c1->term_id;
					$sequence[ $c1->term_id ] = '3';
				}
			}
		}
		foreach ( $ChildSpaCat as $c1 ) {
			foreach ( $a3 as $p4 ) {
				if ( $c1->parent == $p4 ) {
					$a4[]                     = $c1->term_id;
					$sequence[ $c1->term_id ] = '4';
				}
			}
		}
		foreach ( $ChildSpaCat as $c1 ) {
			foreach ( $a4 as $p5 ) {
				if ( $c1->parent == $p5 ) {
					$a5[]                     = $c1->term_id;
					$sequence[ $c1->term_id ] = '4';
				}
			}
		}
		return $sequence;
	}

	/**
	 * Generate an array for filtering based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param string $TaxonomyTT  The taxonomy term for filtering.
	 * @param string $ContentType The content type for filtering.
	 * @param string $Field       The field for filtering.
	 * @param string $layout_Type Optional layout type for filtering.
	 *
	 * @return mixed The result of generating the array for filtering.
	 */
	protected function tp_filter_aaray( $TaxonomyTT, $ContentType, $Field, $layout_Type = '' ) {
		$array = array(
			'name'  => $TaxonomyTT,
			'id'    => uniqid( $TaxonomyTT ),
			'field' => $Field,
			'type'  => $ContentType,
		);

		if ( $Field == 'date' ) {
			$Date  = array( 'layout' => $layout_Type );
			$array = array_merge( $array, $Date );
		}
		return $array;
	}

	/**
	 * Retrieve values for a connection based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param string $ConnectionKey The key for the connection.
	 * @param string $ContentType   The content type for the connection.
	 *
	 * @return mixed The result of retrieving values for the connection.
	 */
	protected function tp_connection_values( $ConnectionKey, $ContentType ) {
		global $post, $wpdb;

		$Data        = array();
		$KeyName     = '';
		$PubliStatus = 'publish';
		$GetResult   = $wpdb->get_results( $wpdb->prepare( "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_status = %s ", $PubliStatus ) );
		if ( ! empty( $GetResult ) && is_array( $GetResult ) ) {
			foreach ( $GetResult as $one ) {
				if ( $ContentType == 'toolset_conne' ) {
					$KeyName = get_post_field( $ConnectionKey, $one->ID );
				}

				if ( ! empty( $KeyName ) ) {
					$array2 = explode( '|', $KeyName );

					foreach ( $array2 as $two ) {
						$value          = str_replace( ' ', '-', ltrim( rtrim( $two ) ) );
						$Data[ $value ] = array( 'name' => $value );
					}
				}
			}
		}

		return $Data;
	}

	/**
	 * Generate a title for a filter based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array $repeater The repeater settings array.
	 *
	 * @return mixed The result of generating the title for the filter.
	 */
	protected function tp_filter_title( $repeater ) {
		$output    = '';
		$HeadingOn = ! empty( $repeater['headingOn'] ) ? $repeater['headingOn'] : '';

		if ( ! empty( $HeadingOn ) ) {
			$title        = ! empty( $repeater['fieldTitle'] ) ? $repeater['fieldTitle'] : '';
			$DiableToggle = ! empty( $repeater['Toggdisable'] ) ? true : false;
			$showIcon     = ! empty( $repeater['showIcon'] ) ? true : false;
			$Titlelayout  = ( $repeater['Titlelayout'] == 'inline' ) ? 'tp-title-inline' : '';

			$DataValue = json_encode(
				array(
					'ToggleOn'     => $DiableToggle,
					'DefaultValue' => ! empty( $repeater['ToggDef'] ) ? true : false,
				),
				true
			);

			$output .= '<div class="tp-field-title ' . esc_attr( $Titlelayout ) . '" data-ShowData=' . esc_attr( $DataValue ) . ' >';
			if ( ! empty( $showIcon ) && ! empty( $repeater['Iconlib'] ) && ! empty( $repeater['Iconlib']['value'] ) ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $repeater['Iconlib'], array( 'aria-hidden' => 'true' ) );
					$Icon = ob_get_contents();
				ob_end_clean();
				$output .= '<span class="tp-title-icon">' . $Icon . '</span>';
			}
				$output .= '<span class="tp-title-text">' . esc_html( $title ) . '</span>';
			if ( ! empty( $DiableToggle ) ) {
				$output     .= '<span class="tp-title-toggle">';
					$output .= '<i class="fas fa-angle-up tp-toggle-up" aria-hidden="true"></i>';
					$output .= '<i class="fas fa-angle-down tp-toggle-down" aria-hidden="true"></i>';
				$output     .= '</span>';
			}
			$output .= '</div>';
		}
		return $output;
	}

	/**
	 * Generate HTML for text input fields based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param string $WidgetId  The ID of the widget.
	 * @param string $key       The key for the text input field.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the text input fields.
	 */
	protected function tp_text_field( $WidgetId, $key, $repeater ) {
		$op          = '';
		$Placeholder = ! empty( $repeater['placeholder'] ) ? $repeater['placeholder'] : '';
		$RID         = ! empty( $repeater['_id'] ) ? substr( $repeater['_id'], 3 ) : '';
		$TPPrefix    = $this->tp_unique_widget_id( 's', $repeater );
		$TPPrefix    = "$TPPrefix-$RID";

		$GFilter = array();
		if ( ! empty( $repeater['GenericFilter'] ) ) {
			$GFilter = array(
				'GFEnable'   => 1,
				'GFSType'    => ! empty( $repeater['SearchMatch'] ) ? $repeater['SearchMatch'] : 'otheroption',
				'GFTitle'    => ! empty( $repeater['sintitle'] ) ? 1 : 0,
				'GFContent'  => ! empty( $repeater['sincontent'] ) ? 1 : 0,
				'GFName'     => ! empty( $repeater['sinname'] ) ? 1 : 0,
				'GFExcerpt'  => ! empty( $repeater['sinexcerpt'] ) ? 1 : 0,
				'GFCategory' => ! empty( $repeater['sincategory'] ) ? 1 : 0,
				'GFTags'     => ! empty( $repeater['sinTags'] ) ? 1 : 0,
			);
		} else {
			$GFilter = array( 'GFEnable' => 0 );
		}

		$GFarray = json_encode( $GFilter, true );

		$op     .= $this->tp_filter_title( $repeater );
		$op     .= '<div class="tp-search-wrap">';
			$op .= '<input id="' . esc_attr( $TPPrefix ) . '" class="form-control tp-search-input" type="text" name="search" placeholder="' . esc_attr( $Placeholder ) . '" data-key="' . esc_attr( $key ) . '" data-genericfilter=' . $GFarray . '  data-title="search" />';
			$op .= '<i class="fas fa-search tp-search-icon" aria-hidden="true"></i>';
		$op     .= '</div>';
		return $op;
	}

	/**
	 * Generate HTML for dropdown (select) input fields based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data     The data for the dropdown input field.
	 * @param string $label    The label for the dropdown input field.
	 * @param string $name     The name for the dropdown input field.
	 * @param bool   $showCnt  Whether to show a container for the dropdown input field.
	 * @param array  $attr     Additional attributes for the dropdown input field.
	 * @param array  $repeater The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the dropdown input fields.
	 */
	protected function tp_drop_down( $data, $label, $name, $showCnt, $attr, $repeater ) {
		$output  = '';
		$output .= $this->tp_filter_title( $repeater );

		$WooSorting   = ! empty( $repeater['WooFiltersSort'] ) ? $repeater['WooFiltersSort'] : '';
		$DefaultTitle = ! empty( $repeater['DDtitle'] ) ? $repeater['DDtitle'] : '';
		$ImageON      = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$layout_style = ! empty( $repeater['layout_style'] ) ? $repeater['layout_style'] : 'style-1';

		if ( ! empty( $WooSorting ) ) {
			$WooFiltersSelect = ! empty( $repeater['WooFiltersSelect'] ) ? $repeater['WooFiltersSelect'] : array();
			$WooName          = array( '' => $DefaultTitle );
			if ( ! empty( $WooFiltersSelect ) ) {
				foreach ( $WooFiltersSelect as $val ) {
					if ( $val == 'featured' ) {
						$WooName[ $val ] = 'Featured';
					} elseif ( $val == 'on_sale' ) {
						$WooName[ $val ] = 'On sale';
					} elseif ( $val == 'top_sales' ) {
						$WooName[ $val ] = 'Top Sales';
					} elseif ( $val == 'instock' ) {
						$WooName[ $val ] = 'In Stock';
					} elseif ( $val == 'outofstock' ) {
						$WooName[ $val ] = 'Out of Stock';
					}
				}
			}

			$output         .= '<div class="tp-select tp-woo-sorting">';
				$output     .= '<div class="tp-select-dropdown">';
					$output .= '<span>' . esc_html__( $DefaultTitle ) . '</span>';
					$output .= '<i class="fas fa-chevron-down tp-dd-icon"></i>';
				$output     .= '</div>';
				$output     .= '<input type="hidden" name="woo_SgDropDown" id="woo_SgDropDown" data-txtval="">';
				$output     .= '<ul class="tp-sbar-dropdown-menu">';
			foreach ( $WooName as $key => $item ) {
				$output     .= '<li id="' . esc_attr( $key ) . '" class="tp-searchbar-li" >';
					$output .= '<div class="tp-dd-labletxt" >' . esc_html__( $item ) . '</div>';
				$output     .= '</li>';
			}
				$output .= '</ul>';
			$output     .= '</div>';
		} else {
			$output         .= '<div class="tp-select ' . esc_attr( $layout_style ) . '">';
				$output     .= '<div class="tp-select-dropdown">';
					$output .= '<span>' . esc_html__( $DefaultTitle ) . '</span>';
					$output .= '<i class="fas fa-chevron-down tp-dd-icon"></i>';
				$output     .= '</div>';
				$output     .= '<input type="hidden" name="' . esc_attr( $name ) . '" id="' . esc_attr( $name ) . '" data-title="" data-txtval="">';
				$output     .= '<ul class="tp-sbar-dropdown-menu">';
				$output     .= '<li id="" class="tp-searchbar-li" >' . esc_html__( $DefaultTitle ) . '</li>';
			foreach ( $data as $value => $label ) {
				$DataName  = ! empty( $label['name'] ) ? $label['name'] : '';
				$DataCount = ! empty( $label['count'] ) ? $label['count'] : '';
				$DataImage = ! empty( $label['image'] ) ? $label['image'] : '';

				$output .= '<li id="' . esc_attr( $value ) . '" class="tp-searchbar-li" >';
				if ( ! empty( $ImageON ) && ! empty( $DataImage ) ) {
						$output .= '<div class="tp-dd-lableImg" ><img src="' . esc_html( $DataImage ) . '" class="tp-dd-thumbimg" /></div>';
				}

				if ( $layout_style == 'style-1' ) {
							$output .= '<div class="tp-dd-labletxt" >' . esc_html( $DataName ) . '</div>';
							$output .= ! empty( $showCnt ) ? '<div class="tp-dd-counttxt" >(' . esc_html( $DataCount ) . ')</div>' : '';
				} elseif ( $layout_style == 'style-2' ) {
					$output .= '<div class="tp-dd-contener" >';
					$output .= '<div class="tp-dd-labletxt" >' . esc_html( $DataName ) . '</div>';
					$output .= ! empty( $showCnt ) ? '<div class="tp-dd-counttxt" >' . esc_html( $DataCount ) . '</div>' : '';
					$output .= '</div>';
				}
								$output .= '</li>';
			}
				$output .= '</ul>';
			$output     .= '</div>';
		}
		return $output;
	}

	/**
	 * Generate HTML for checkbox input fields based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data      The data for the checkbox input field.
	 * @param string $label     The label for the checkbox input field.
	 * @param string $name      The name for the checkbox input field.
	 * @param bool   $showCnt   Whether to show a container for the checkbox input field.
	 * @param array  $attr      Additional attributes for the checkbox input field.
	 * @param bool   $showchild Whether to show child elements for the checkbox input field.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the checkbox input fields.
	 */
	protected function tp_checkbox( $data, $label, $name, $showCnt, $attr, $showchild, $repeater ) {
		$settings                = $this->get_settings_for_display();
		$output                  = '';
		$output                 .= '<input type="hidden" class="tp-checkbox-hidden ' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $name ) . '">';
		$output                 .= $this->tp_filter_title( $repeater );
		$TPPrefix                = $this->tp_unique_widget_id( $name, $repeater );
		$Taxonomy                = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';
		$ImageON                 = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$layout_style            = ! empty( $repeater['layout_style'] ) ? $repeater['layout_style'] : 'style-1';
		$Archivpage              = ! empty( $settings['enable_archive'] ) ? true : false;
		$ArchivMore              = ! empty( $settings['enable_archivefiled'] ) ? true : false;
		$Archive_showall         = ! empty( $settings['archive_showall'] ) ? $settings['archive_showall'] : '';
		$exclude_category_switch = ! empty( $repeater['exclude_category_switch'] ) ? true : false;
		$ExcludeCategory         = ! empty( $repeater['exclude_category'] ) ? explode( ',', $repeater['exclude_category'] ) : '';
		$EnableARHighlight       = ! empty( $settings['enable_archive_highlight'] ) ? $settings['enable_archive_highlight'] : '';
		$ArInputHandler          = '';

		$CatName = $this->tp_archive_name();

		$output         .= '<div class="tp-wp-checkBox tb-checkBox-data" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';
			$ArchiveName = $classArchive = '';
		if ( ! empty( $exclude_category_switch ) && ! empty( $ExcludeCategory ) ) {

			foreach ( $data as $key => $Perent ) {
				if ( in_array( $key, $ExcludeCategory ) ) {
					unset( $data[ $key ] );
				}

				$child = ! empty( $Perent['child'] ) ? $Perent['child'] : array();
				if ( ! empty( $child ) ) {
					foreach ( $child as $childkey => $childItem ) {
						$C_Term_ID = ! empty( $childItem->term_id ) ? $childItem->term_id : '';

						if ( in_array( $C_Term_ID, $ExcludeCategory ) ) {
							if ( ! empty( $data[ $key ]['child'][ $childkey ] ) ) {
								unset( $data[ $key ]['child'][ $childkey ] );
							}
						}
					}
				}
			}
		}

		if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() && ( ! empty( $Archivpage ) || ! empty( $EnableARHighlight ) ) ) {
			$ArInputHandler = 'tp-archive-option';

			foreach ( $data as $value => $label ) {
				$DataName = ! empty( $label['slug'] ) ? $label['slug'] : '';
				if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
					$EnableChecked = 'checked';
					$ArchiveName   = $value;

					$output .= $this->tp_checkbox_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchive, $ArInputHandler );
				}
			}

			if ( empty( $ArchiveName ) ) {
				foreach ( $data as $key => $Perent ) {
					$DataChild = ! empty( $Perent['child'] ) ? $Perent['child'] : array();
					if ( ! empty( $DataChild ) ) {
						foreach ( $DataChild as $value => $label ) {
							$DataName   = ( ! empty( $label ) && ! empty( $label->slug ) ) ? $label->slug : '';
							$DataTermId = ( ! empty( $label ) && ! empty( $label->term_id ) ) ? $label->term_id : '';
							$value      = $DataTermId;

							if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
								$EnableChecked = 'checked';
								$ArchiveName   = $value;
								$label         = json_decode( json_encode( $label ), true );
								$output       .= $this->tp_checkbox_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchive, $ArInputHandler );
							}
						}
					}
				}
			}
		}

		foreach ( $data as $value => $label ) {
			$EnableChecked = $ArInputHandler = $classArchiveHandler = '';
			$DataName      = ! empty( $label['name'] ) ? $label['name'] : '';

			if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
					$EnableChecked = 'checked';
				}

				if ( ! empty( $Archivpage ) && empty( $EnableChecked ) ) {
					$classArchiveHandler = 'tp-archive-hidden';
				}
			}
			if ( $ArchiveName != $value ) {
				$output .= $this->tp_checkbox_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchiveHandler, $ArInputHandler );
			}
		}

		if ( ! empty( $ArchivMore ) ) {
			$output .= $this->tp_archive_more( $repeater );
		}

			$output .= $this->tp_showmore_content( $repeater, 'checkbox' );
		$output     .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML for checkbox inputs based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $repeater      The repeater settings array.
	 * @param string $label         The label for the checkbox input.
	 * @param string $value         The value for the checkbox input.
	 * @param string $TPPrefix      The prefix for the checkbox input.
	 * @param string $name          The name for the checkbox input.
	 * @param bool   $EnableChecked Whether to enable the checked state for the checkbox input.
	 * @param string $classArchive  CSS classes for the archive.
	 * @param mixed  $ArInputHandler Additional input handler (potentially an array).
	 *
	 * @return mixed The result of generating HTML for the checkbox inputs.
	 */
	protected function tp_checkbox_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchive, $ArInputHandler ) {
		$showCnt      = ! empty( $repeater['showCount'] ) ? 'yes' : '';
		$showchild    = ! empty( $repeater['showChild'] ) ? 'yes' : '';
		$ImageON      = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$Taxonomy     = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';
		$layout_style = ! empty( $repeater['layout_style'] ) ? $repeater['layout_style'] : 'style-1';

		$DataName       = ! empty( $label['name'] ) ? $label['name'] : '';
		$DataCount      = ! empty( $label['count'] ) ? $label['count'] : '';
		$Datachild      = ! empty( $label['child'] ) ? $label['child'] : '';
		$DataImage      = ! empty( $label['image'] ) ? $label['image'] : '';
		$child_sequence = ! empty( $label['child_sequence'] ) ? $label['child_sequence'] : array();

		$output                          = '<div class="tp-checkBox ' . esc_attr( $layout_style ) . ' ' . esc_attr( $classArchive ) . '">';
			$output                     .= '<div class="tp-group">';
				$output                 .= '<div class="tp-group-one">';
					$output             .= '<input type="checkbox" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" class="' . esc_attr( $ArInputHandler ) . '" data-title="' . esc_attr( $DataName ) . '" ' . $EnableChecked . '/>';
					$output             .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" class="tp-lable">';
						$output         .= '<span class="tp-check-icon">';
							$output     .= '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="check" class="checkbox-icon svg-inline--fa fa-check fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
								$output .= '<path fill="currentColor" d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path>';
							$output     .= '</svg>';
						$output         .= '</span>';

		if ( ! empty( $DataImage ) && ! empty( $ImageON ) ) {
			$output .= '<span class="tp-checkbox-Img"><img src="' . esc_html( $DataImage ) . '" class="tp-checkbox-thumbimg" /></span>';
		}

						$output     .= '<div class="tp-field-content">';
							$output .= '<span class="tp-field-label">' . $DataName . '</span>';
							$output .= ( $layout_style == 'style-1' && ! empty( $showCnt ) ) ? '<span class="tp-field-Counter">(' . $DataCount . ')</span>' : '';
						$output     .= '</div>';
					$output         .= '</label>';
				$output             .= '</div>';
				$output             .= '<div class="tp-group-two">';
		if ( ! empty( $Datachild ) && ! empty( $showchild ) ) {
			$output     .= '<span class="tp-toggle">';
				$output .= '<i class="tog-plus fa fa-plus" aria-hidden="true"></i>';
				$output .= '<i class="tog-minus fa fa-minus" aria-hidden="true"></i>';
			$output     .= '</span>';
		}
					$output .= ( $layout_style == 'style-2' && ! empty( $showCnt ) ) ? '<span class="tp-field-Counter">' . $DataCount . '</span>' : '';
				$output     .= '</div>';
			$output         .= '</div>';

		if ( ! empty( $Datachild ) && ! empty( $showchild ) ) {
			$output .= '<div class="tp-child-taxo">';
			foreach ( $Datachild as $key => $child ) {
				$ImageURL   = '';
				$TermId     = ! empty( $child->term_id ) ? $child->term_id : '';
				$ChildName  = ! empty( $child->name ) ? $child->name : '';
				$ChildCount = ! empty( $child->category_count ) ? $child->category_count : '';
				$Parent     = ! empty( $child->parent ) ? $child->parent : '';
				$slug       = ! empty( $child->slug ) ? $child->slug : '';

				$Archecked   = '';
				$ArchiveName = $this->tp_archive_name();
				if ( $ArchiveName == $slug ) {
					$Archecked = 'checked';
				}
				if ( ! empty( $EnableChecked ) ) {
					$Archecked = 'checked';
				}

				if ( ( $Taxonomy == 'product_cat' ) && ! empty( $TermId ) ) {
					$GetImgID  = get_term_meta( $TermId, 'thumbnail_id', true );
					$GetImgurl = wp_get_attachment_image_src( $GetImgID, 'tp-image-grid' );
					if ( ! empty( $GetImgurl ) ) {
						$ImageURL = $GetImgurl[0];
					}
				}
				$SubCName = 0;
				if ( ! empty( $child_sequence[ $TermId ] ) ) {
					$SubCName = 'tp-childsequence-' . $child_sequence[ $TermId ];
				}

				$output                 .= '<div class="tp-child-checkbox ' . esc_attr( $SubCName ) . '">';
					$output             .= '<input type="checkbox" name="' . esc_attr( $name ) . '" value="' . esc_attr( $TermId ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $TermId ) . '" data-title="' . esc_attr( $ChildName ) . '" ' . esc_attr( $Archecked ) . '/>';
					$output             .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $TermId ) . '" >';
						$output         .= '<span class="tp-check-icon">';
							$output     .= '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="check" class="checkbox-icon svg-inline--fa fa-check fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
								$output .= '<path fill="currentColor" d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path>';
							$output     .= '</svg>';
						$output         .= '</span>';
				if ( ! empty( $ImageURL ) && ! empty( $ImageON ) ) {
					$output .= '<span class="tp-checkbox-Img"><img src="' . esc_html( $ImageURL ) . '" class="tp-checkbox-thumbimg" /></span>';
				}

						$output     .= '<div class="tp-field-content">';
							$output .= '<span class="tp-field-label">' . $ChildName . '</span>';
				if ( $layout_style == 'style-1' && ! empty( $showCnt ) ) {
					$output .= '<span class="tp-field-Counter">(' . $ChildCount . ')</span>';
				} elseif ( $layout_style == 'style-2' && ! empty( $showCnt ) ) {
					$output .= '<span class="tp-field-Counter">' . $ChildCount . '</span>';
				}
							$output .= '</div>';
							$output .= '</div>';
			}
				$output .= '</div>';
		}
		$output .= '</div>';

		return $output;
	}

	/**
	 * Retrieve the name of the current archive.
	 *
	 * @since 1.0.0
	 *
	 * @return string The name of the archive.
	 */
	protected function tp_archive_name() {
		$Name = '';
		if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			global $wp_query;
			$query_var = $wp_query->query_vars;

			if ( isset( $query_var['cat'] ) ) {
				$Name = $query_var['category_name'];
			}
			if ( isset( $query_var['tag'] ) ) {
				$Name = $query_var['tag'];
			}
			if ( ! empty( $query_var ) && isset( $query_var['taxonomy'] ) && isset( $query_var[ $query_var['taxonomy'] ] ) ) {
				$Name = $query_var[ $query_var['taxonomy'] ];
			}
		}

		return $Name;
	}

	/**
	 * Generate HTML for radio input fields based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data      The data for the radio input field.
	 * @param string $label     The label for the radio input field.
	 * @param string $name      The name for the radio input field.
	 * @param bool   $showCnt   Whether to show a container for the radio input field.
	 * @param array  $attr      Additional attributes for the radio input field.
	 * @param bool   $showchild Whether to show child elements for the radio input field.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the radio input fields.
	 */
	protected function tp_radio( $data, $label, $name, $showCnt, $attr, $showchild, $repeater ) {
		$settings     = $this->get_settings_for_display();
		$TPPrefix     = $this->tp_unique_widget_id( $name, $repeater );
		$Taxonomy     = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';
		$ImageON      = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$layout_style = ! empty( $repeater['layout_style'] ) ? $repeater['layout_style'] : 'style-1';

		$Archivpage      = ! empty( $settings['enable_archive'] ) ? true : false;
		$ArchivMore      = ! empty( $settings['enable_archivefiled'] ) ? true : false;
		$Archive_showall = ! empty( $settings['archive_showall'] ) ? $settings['archive_showall'] : '';

		$exclude_category_switch = ! empty( $repeater['exclude_category_switch'] ) ? true : false;
		$ExcludeCategory         = ! empty( $repeater['exclude_category'] ) ? explode( ',', $repeater['exclude_category'] ) : '';
		$EnableARHighlight       = ! empty( $settings['enable_archive_highlight'] ) ? $settings['enable_archive_highlight'] : '';

		$CatName = '';
		if ( ! empty( $exclude_category_switch ) && ! empty( $ExcludeCategory ) ) {
			foreach ( $data as $key => $Perent ) {
				if ( in_array( $key, $ExcludeCategory ) ) {
					unset( $data[ $key ] );
				}

				$child = ! empty( $Perent['child'] ) ? $Perent['child'] : array();
				if ( ! empty( $child ) ) {
					foreach ( $child as $childkey => $childItem ) {
						$C_Term_ID = ! empty( $childItem->term_id ) ? $childItem->term_id : '';

						if ( in_array( $C_Term_ID, $ExcludeCategory ) ) {
							if ( ! empty( $data[ $key ]['child'][ $childkey ] ) ) {
								unset( $data[ $key ]['child'][ $childkey ] );
							}
						}
					}
				}
			}
		}
		if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			global $wp_query;
			$query_var = $wp_query->query_vars;

			if ( isset( $query_var['cat'] ) ) {
				$CatName = $query_var['category_name'];
			}
			if ( isset( $query_var['tag'] ) ) {
				$CatName = $query_var['tag'];
			}
			if ( ! empty( $query_var ) && isset( $query_var['taxonomy'] ) && isset( $query_var[ $query_var['taxonomy'] ] ) ) {
				$CatName = $query_var[ $query_var['taxonomy'] ];
			}
		}

		$output  = '';
		$output .= '<input name="radiohidden" type="hidden" value="' . esc_attr( $name ) . '">';
		$output .= $this->tp_filter_title( $repeater );

		$output         .= '<div class="tp-wp-radio tb-checkBox-data" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';
			$ArchiveName = $classArchive = '';

		if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() && ( ! empty( $Archivpage ) || ! empty( $EnableARHighlight ) ) ) {
			foreach ( $data as $value => $label ) {
				$DataName      = ! empty( $label['slug'] ) ? $label['slug'] : '';
				$EnableChecked = '';

				if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
					$EnableChecked = 'checked';
					$ArchiveName   = $value;
					$output       .= $this->tp_radio_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchive );
				}
			}

			if ( empty( $ArchiveName ) ) {
				foreach ( $data as $key => $Perent ) {
					$DataChild = ! empty( $Perent['child'] ) ? $Perent['child'] : array();
					if ( ! empty( $DataChild ) ) {
						foreach ( $DataChild as $value => $label ) {
							$DataName = ( ! empty( $label ) && ! empty( $label->slug ) ) ? $label->slug : '';

							if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
								$EnableChecked = 'checked';
								$ArchiveName   = $value;
								$label         = json_decode( json_encode( $label ), true );
								$output       .= $this->tp_radio_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchive );
							}
						}
					}
				}
			}
		}

		foreach ( $data as $value => $label ) {
			$RadioName     = ! empty( $label['name'] ) ? $label['name'] : '';
			$EnableChecked = $classArchiveHandler = '';

			if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $RadioName ) ) {
					$EnableChecked = 'checked';
				}
				if ( ! empty( $Archivpage ) && empty( $EnableChecked ) ) {
					$classArchiveHandler = 'tp-archive-hidden';
				}
			}

			if ( $ArchiveName != $value ) {
				$output .= $this->tp_radio_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchiveHandler );
			}
		}

		if ( ! empty( $ArchivMore ) ) {
			$output .= $this->tp_archive_more( $repeater );
		}

			$output .= $this->tp_showmore_content( $repeater, 'radio' );
		$output     .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML for radio inputs based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $repeater       The repeater settings array.
	 * @param string $label          The label for the radio input.
	 * @param string $value          The value for the radio input.
	 * @param string $TPPrefix       The prefix for the radio input.
	 * @param string $name           The name for the radio input.
	 * @param bool   $EnableChecked  Whether to enable the checked state for the radio input.
	 * @param string $classArchive   CSS classes for the archive.
	 *
	 * @return mixed The result of generating HTML for the radio inputs.
	 */
	protected function tp_radio_html( $repeater, $label, $value, $TPPrefix, $name, $EnableChecked, $classArchive ) {
		$showCnt        = ! empty( $repeater['showCount'] ) ? 'yes' : '';
		$showchild      = ! empty( $repeater['showChild'] ) ? 'yes' : '';
		$ImageON        = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$Taxonomy       = ! empty( $repeater['TaxonomyType'] ) ? $repeater['TaxonomyType'] : '';
		$layout_style   = ! empty( $repeater['layout_style'] ) ? $repeater['layout_style'] : 'style-1';
		$RadioName      = ! empty( $label['name'] ) ? $label['name'] : '';
		$RadioCount     = ! empty( $label['count'] ) ? $label['count'] : '';
		$DataImage      = ! empty( $label['image'] ) ? $label['image'] : '';
		$child_sequence = ! empty( $label['child_sequence'] ) ? $label['child_sequence'] : array();

		$output                      = '<div class="tp-radio ' . esc_attr( $layout_style ) . ' ' . esc_attr( $classArchive ) . '">';
			$output                 .= '<div class="tp-group">';
				$output             .= '<div class="tp-group-one">';
					$output         .= '<input type="radio" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" data-title="' . esc_attr( $RadioName ) . '" ' . $EnableChecked . '/>';
					$output         .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" class="tp-lable">';
						$output     .= '<span class="tp-radio-icon">';
							$output .= '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="scrubber" class="radioIcon svg-inline--fa fa-scrubber fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 312c-35.3 0-64-28.7-64-64s28.7-64 64-64 64 28.7 64 64-28.7 64-64 64z"></path></svg>';
						$output     .= '</span>';

		if ( ! empty( $DataImage ) && ! empty( $ImageON ) ) {
			$output .= '<span class="tp-radio-Img"><img src="' . esc_html( $DataImage ) . '" class="tp-radio-thumbimg" /></span>';
		}

						$output     .= '<div class="tp-field-content">';
							$output .= '<span class="tp-field-label">' . $RadioName . '</span>';
							$output .= ( $layout_style == 'style-1' && ! empty( $showCnt ) ) ? '<span class="tp-field-Counter">(' . $RadioCount . ')</span>' : '';
						$output     .= '</div>';

					$output .= '</label>';
				$output     .= '</div>';

				$output .= '<div class="tp-group-two">';
		if ( ! empty( $label['child'] ) && ! empty( $showchild ) ) {
			$output .= '<span class="tp-toggle"><i class="tog-plus fa fa-plus" aria-hidden="true"></i><i class="tog-minus fa fa-minus" aria-hidden="true"></i></span>';
		}
					$output .= ( $layout_style == 'style-2' && ! empty( $showCnt ) ) ? '<span class="tp-field-Counter">' . $RadioCount . '</span>' : '';
				$output     .= '</div>';
			$output         .= '</div>';

		if ( ! empty( $label['child'] ) && ! empty( $showchild ) ) {
			$output .= '<div class="tp-child-taxo">';
			foreach ( $label['child'] as $child ) {
				$ChildTermId   = ! empty( $child->term_id ) ? $child->term_id : '';
				$childName     = ! empty( $child->name ) ? $child->name : '';
				$CategoryCount = ! empty( $child->category_count ) ? $child->category_count : 0;
				$ParentID      = ! empty( $child->parent ) ? $child->parent : '';

				$ImageURL = '';
				if ( ( $Taxonomy == 'product_cat' ) && ! empty( $ChildTermId ) ) {
					$GetImgID  = get_term_meta( $ChildTermId, 'thumbnail_id', true );
					$GetImgurl = wp_get_attachment_image_src( $GetImgID, 'tp-image-grid' );
					if ( ! empty( $GetImgurl ) ) {
						$ImageURL = $GetImgurl[0];
					}
				}

				$SubCName = 0;
				if ( ! empty( $child_sequence[ $ChildTermId ] ) ) {
					$SubCName = 'tp-childsequence-' . $child_sequence[ $ChildTermId ];
				}

				$output             .= '<div class="tp-child-checkbox ' . esc_attr( $SubCName ) . '">';
					$output         .= '<input type="radio" name="' . esc_attr( $name ) . '" value="' . esc_attr( $ChildTermId ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $ChildTermId ) . '" data-title="' . esc_attr( $childName ) . '" />';
					$output         .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $ChildTermId ) . '" >';
						$output     .= '<span class="tp-radio-icon">';
							$output .= '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="scrubber" class="radioIcon svg-inline--fa fa-scrubber fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 312c-35.3 0-64-28.7-64-64s28.7-64 64-64 64 28.7 64 64-28.7 64-64 64z"></path></svg>';
						$output     .= '</span>';
				if ( ! empty( $ImageURL ) && ! empty( $ImageON ) ) {
					$output .= '<span class="tp-radio-Img"><img src="' . esc_html( $ImageURL ) . '" class="tp-radio-thumbimg" /></span>';
				}

						$output         .= '<div class="tp-field-content">';
								$output .= '<span class="tp-field-label">' . esc_html( $childName ) . '</span>';
				if ( $layout_style == 'style-1' && ! empty( $showCnt ) ) {
					$output .= '<span class="tp-field-Counter">(' . esc_html( $CategoryCount ) . ')</span>';
				} elseif ( $layout_style == 'style-2' && ! empty( $showCnt ) ) {
					$output .= '<span class="tp-field-Counter">' . esc_html( $CategoryCount ) . '</span>';
				}
							$output .= '</div>';
							$output .= '</div>';
			}
				$output .= '</div>';
		}
		$output .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML for a range input based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param string $label    The label for the range input.
	 * @param int    $max      The maximum value for the range input.
	 * @param int    $min      The minimum value for the range input.
	 * @param int    $step     The step value for the range input.
	 * @param string $key      The key for the range input.
	 * @param array  $repeater The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the range input.
	 */
	protected function tp_range( $label, $max, $min, $step, $key, $repeater ) {
		$TPPrefix = $this->tp_unique_widget_id( 'range', $repeater );
		$RID      = ! empty( $repeater['_id'] ) ? substr( $repeater['_id'], 3 ) : '';
		$TPPrefix = "{$TPPrefix}-{$RID}";

		$sildAttr                = array();
		$sildAttr['maxValue']    = $max;
		$sildAttr['minValue']    = $min;
		$sildAttr['stepValue']   = (int) $step;
		$sildAttr['type']        = isset( $repeater['ContentType'] ) ? $repeater['ContentType'] : '';
		$sildAttr['field']       = 'range';
		$sildAttr['uniqname']    = $TPPrefix;
		$sildAttr['name']        = $key;
		$sildAttr['pricesymbol'] = ! empty( $repeater['rpricesymbol'] ) ? $repeater['rpricesymbol'] : '';

		$op      = '';
		$op     .= $this->tp_filter_title( $repeater );
		$op     .= '<div class="tp-range-silder" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';
			$op .= '<div class="tp-range" id="' . esc_attr( $TPPrefix ) . '" data-sliderattr=\'' . json_encode( $sildAttr ) . '\' ></div>';
		$op     .= '</div>';

		return $op;
	}

	/**
	 * Handle date-related functionality based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title    The title for the date.
	 * @param string $key      The key for the date.
	 * @param array  $repeater The repeater settings array.
	 *
	 * @return mixed The result of handling date-related functionality.
	 */
	protected function tp_date( $title, $key, $repeater ) {
		$lableOn     = ! empty( $repeater['lableDisable'] ) ? 1 : 0;
		$lableOne    = ( ! empty( $lableOn ) && ! empty( $repeater['lableOne_date'] ) ) ? $repeater['lableOne_date'] : '';
		$lableTwo    = ( ! empty( $lableOn ) && ! empty( $repeater['lableTwo_date'] ) ) ? $repeater['lableTwo_date'] : '';
		$lableStyle  = ( ! empty( $lableOn ) && ! empty( $repeater['lableStyleDate'] ) ) ? $repeater['lableStyleDate'] : 'default';
		$layout_date = ( ! empty( $repeater['layout_date'] ) ) ? $repeater['layout_date'] : 'style-1';

		$DateStyle = '';
		if ( ! empty( $lableOn ) && $lableStyle == 'inline' ) {
			$DateStyle = 'tp-date-inline';
		}

		$op  = '';
		$op .= $this->tp_filter_title( $repeater );
		if ( $layout_date == 'style-1' ) {
			$op     .= '<div class="tp-date-wrap ' . esc_attr( $DateStyle ) . ' ' . esc_attr( $layout_date ) . '" data-tpprefix="' . esc_attr( $key ) . '">';
				$op .= '<div class="tp-date">';
			if ( ! empty( $lableOn ) && ! empty( $lableOne ) ) {
				$op .= '<label for="tp-date1">' . esc_html( $lableOne ) . '</label>';
			}
					$op .= '<input id="' . esc_attr( $key ) . '" name="tp-date" type="date" class="tp-datepicker1" date-key="' . esc_attr( $key ) . '">';
				$op     .= '</div>';
				$op     .= '<div class="tp-date1">';
			if ( ! empty( $lableOn ) && ! empty( $lableTwo ) ) {
				$op .= '<label for="tp-date2">' . esc_html( $lableTwo ) . '</label>';
			}
					$op .= '<input id="' . esc_attr( $key ) . '" name="tp-date" type="date" class="tp-datepicker1">';
				$op     .= '</div>';
			$op         .= '</div>';
		} elseif ( $layout_date == 'style-2' ) {
			$Datemultiselect = ( ! empty( $repeater['Datemultiselect'] ) ) ? $repeater['Datemultiselect'] : array();
			$DateOption      = array();
			if ( is_array( $Datemultiselect ) ) {
				foreach ( $Datemultiselect as $value ) {
					$DateOption[] = $value;
				}
			}

			$AutoApply            = ( in_array( 'AutoApplyEn', $DateOption ) ) ? true : false;
			$ShowDD               = ( in_array( 'showDropdownsEn', $DateOption ) ) ? true : false;
			$ShowCalendars        = ( in_array( 'alwaysShowCalendars', $DateOption ) ) ? true : false;
			$showranges           = ( in_array( 'showranges', $DateOption ) ) ? true : false;
			$showWeekNumber       = ( in_array( 'showWeekNumbers', $DateOption ) ) ? true : false;
			$linkedCalendars      = ( in_array( 'linkedCalendars', $DateOption ) ) ? true : false;
			$ShowCustomRangeLabel = ( in_array( 'showCustomRangeLabel', $DateOption ) ) ? true : false;

			$today = $yesterday = $Last7Days = $Last30Days = $ThisMonth = $LastMonth = false;
			if ( ! empty( $showranges ) ) {
				$Rangemultiselect = ( ! empty( $repeater['Rangemultiselect'] ) ) ? $repeater['Rangemultiselect'] : array();
				$RangeOption      = array();
				if ( is_array( $Rangemultiselect ) ) {
					foreach ( $Rangemultiselect as $value ) {
						$RangeOption[] = $value;
					}
				}
				$today      = ( in_array( 'today', $RangeOption ) ) ? true : false;
				$yesterday  = ( in_array( 'yesterday', $RangeOption ) ) ? true : false;
				$Last7Days  = ( in_array( 'Last7Days', $RangeOption ) ) ? true : false;
				$Last30Days = ( in_array( 'Last30Days', $RangeOption ) ) ? true : false;
				$ThisMonth  = ( in_array( 'ThisMonth', $RangeOption ) ) ? true : false;
				$LastMonth  = ( in_array( 'LastMonth', $RangeOption ) ) ? true : false;
			}

			$Week      = $Month = array();
			$AplBtnTxt = $ApplyBtnclass = $CancelBtnTxt = $CancelBtnclass = '';
			if ( ! empty( $ShowCalendars ) ) {
				$DaysOfWeek = ( ! empty( $repeater['daysOfWeek'] ) ) ? explode( '|', $repeater['daysOfWeek'] ) : explode( '|', 'Su | Mo | Tu | We | Th | Fr | Sa' );
				$MonthNames = ( ! empty( $repeater['monthNames'] ) ) ? explode( '|', $repeater['monthNames'] ) : explode( '|', 'January | February | March | April | May | June | July | August | September | October | November | December' );

				if ( is_array( $DaysOfWeek ) ) {
					foreach ( $DaysOfWeek as $val ) {
						$Week[] = ltrim( rtrim( $val ) );
					}
				}
				if ( is_array( $MonthNames ) ) {
					foreach ( $MonthNames as $val ) {
						$Month[] = ltrim( rtrim( $val ) );
					}
				}
				if ( empty( $AutoApply ) ) {
					$AplBtnTxt      = ( ! empty( $repeater['Applybtntxt'] ) ) ? $repeater['Applybtntxt'] : '';
					$ApplyBtnclass  = ( ! empty( $repeater['Applybtnclass'] ) ) ? $repeater['Applybtnclass'] : '';
					$CancelBtnTxt   = ( ! empty( $repeater['Cancelbtntxt'] ) ) ? $repeater['Cancelbtntxt'] : '';
					$CancelBtnclass = ( ! empty( $repeater['Cancelbtnclass'] ) ) ? $repeater['Cancelbtnclass'] : '';
				}
			}

			$CustomLabelTxt = ( ! empty( $ShowCustomRangeLabel ) && ! empty( $repeater['Customlabletxt'] ) ) ? $repeater['Customlabletxt'] : '';
			$DropsPosition  = ! empty( $repeater['DropsPosition'] ) ? $repeater['DropsPosition'] : '';
			$OpensPosition  = ! empty( $repeater['opensPosition'] ) ? $repeater['opensPosition'] : '';
			$DefaultSelect  = ! empty( $repeater['DateDefaultSelect'] ) ? 1 : 0;
			$start_date     = ( ! empty( $DefaultSelect ) && ! empty( $repeater['start_date'] ) ) ? $this->tp_custom_date( $repeater['start_date'] ) : 0;
			$end_date       = ( ! empty( $DefaultSelect ) && ! empty( $repeater['end_date'] ) ) ? $this->tp_custom_date( $repeater['end_date'] ) : 0;
			$DateDisplay    = ! empty( $repeater['DateDisplay'] ) ? 1 : 0;
			$Min_date       = ( ! empty( $DateDisplay ) && ! empty( $repeater['min_date'] ) ) ? $this->tp_custom_date( $repeater['min_date'] ) : 0;
			$Max_date       = ( ! empty( $DateDisplay ) && ! empty( $repeater['max_date'] ) ) ? $this->tp_custom_date( $repeater['max_date'] ) : 0;
			$YearDisplay    = ! empty( $repeater['YearDisplay'] ) ? 1 : 0;
			$Min_DateYear   = ( ! empty( $YearDisplay ) && ! empty( $repeater['Min_DateYear'] ) ) ? $repeater['Min_DateYear'] : '';
			$Max_DateYear   = ( ! empty( $YearDisplay ) && ! empty( $repeater['Max_DateYear'] ) ) ? $repeater['Max_DateYear'] : '';

			$CustomDate = json_encode(
				array(
					'ShowCalendars'        => $ShowCalendars,
					'showranges'           => $showranges,
					'AutoApplyBtn'         => $AutoApply,
					'showDropdown'         => $ShowDD,
					'ShowWeekNumber'       => $showWeekNumber,
					'linkedCalendar'       => $linkedCalendars,
					'ShowCustomRangeLabel' => $ShowCustomRangeLabel,
					'DefaultSelect'        => $DefaultSelect,
					'StartDate'            => $start_date,
					'EndDate'              => $end_date,
					'DisplayDate'          => $DateDisplay,
					'Min_date'             => $Min_date,
					'Max_date'             => $Max_date,
					'DisplayYear'          => $YearDisplay,
					'Min_Year'             => $Min_DateYear,
					'Max_Year'             => $Max_DateYear,
					'ApplyBtntxt'          => $AplBtnTxt,
					'ApplyBtnclass'        => $ApplyBtnclass,
					'CancelBtntxt'         => $CancelBtnTxt,
					'CancelBtnclass'       => $CancelBtnclass,
					'CustomLabelTxt'       => $CustomLabelTxt,
					'DropsPosition'        => $DropsPosition,
					'OpensPosition'        => $OpensPosition,
					'RangesOption'         => array(
						'today'      => $today,
						'yesterday'  => $yesterday,
						'Last7Days'  => $Last7Days,
						'Last30Days' => $Last30Days,
						'ThisMonth'  => $ThisMonth,
						'LastMonth'  => $LastMonth,
					),
					'locale'               => array(
						'Week'   => $Week,
						'Months' => $Month,
					),
				),
				true
			);

			$op     .= '<div class="tp-date-wrap ' . esc_attr( $layout_date ) . '" data-tpprefix="' . esc_attr( $key ) . '" data-CustomDate= \'' . $CustomDate . '\'>';
				$op .= '<input type="text" name="tp-date" id="' . esc_attr( $key ) . '" class="tp-custom-date ' . esc_attr( $key ) . '" date-key="' . esc_attr( $key ) . '" autocomplete="off" />';
			$op     .= '</div>';
		}

		return $op;
	}

	/**
	 * Format a date based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param string $date The date to be formatted.
	 *
	 * @return mixed The result of formatting the date.
	 */
	protected function tp_custom_date( $date ) {
		$FinalDate  = '';
		$ConverDate = getdate( strtotime( $date ) );
		if ( ! empty( $ConverDate ) ) {
			$Month = ( ! empty( $ConverDate ) && ! empty( $ConverDate['mon'] ) ) ? $ConverDate['mon'] : '';
			$MDate = ( ! empty( $ConverDate ) && ! empty( $ConverDate['mday'] ) ) ? $ConverDate['mday'] : '';
			$Year  = ( ! empty( $ConverDate ) && ! empty( $ConverDate['year'] ) ) ? $ConverDate['year'] : '';

			$FinalDate = $Month . '/' . $MDate . '/' . $Year;
		}

		return $FinalDate;
	}

	/**
	 * Generate HTML for a rating section based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $repeater The repeater settings array.
	 * @param string $name     The name for the rating section.
	 *
	 * @return mixed The result of generating HTML for the rating section.
	 */
	protected function tp_rating( $repeater, $name ) {
		$uniqid   = $this->tp_unique_widget_id( $name, $repeater );
		$RID      = ! empty( $repeater['_id'] ) ? substr( $repeater['_id'], 3 ) : '';
		$TPPrefix = "{$uniqid}-{$RID}";

		$op  = '';
		$op .= $this->tp_filter_title( $repeater );
		$op .= '<div class="tp-star-rating" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';
		for ( $i = 1; $i <= 5; $i++ ) {
			$value = 6 - $i;
			$op   .= '<input type="radio" name="' . esc_attr( $TPPrefix ) . '" class="stars-' . esc_attr( $value ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" value="' . esc_attr( $value ) . '" data-title="' . esc_attr( $value ) . '" />';
			$op   .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" class="star tp-start-icon">&#9733;</label>';
		}
		$op .= '</div>';
		return $op;
	}

	/**
	 * Generate HTML for an alphabet section based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $repeater    The repeater settings array.
	 * @param string $Namevalue   The name value for the alphabet section.
	 *
	 * @return mixed The result of generating HTML for the alphabet section.
	 */
	protected function tp_alphabet( $repeater, $Namevalue ) {
		$output       = '';
		$AlphabetType = ! empty( $repeater['AlphabetType'] ) ? $repeater['AlphabetType'] : array( 'alphabet' );
		$Number       = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );
		$character    = array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );

		$AlphaBet = array();
		if ( count( $AlphabetType ) == 2 ) {
			$AlphaBet = array_merge( $character, $Number );
		} else {
			foreach ( $AlphabetType as $Num ) {
				if ( $Num == 'alphabet' ) {
					$AlphaBet = $character;
				} elseif ( $Num == 'number' ) {
					$AlphaBet = $Number;
				}
			}
		}

		$output .= $this->tp_filter_title( $repeater );
		$output .= '<div class="tp-alphabet-wrapper" data-tpprefix="' . esc_attr( $Namevalue ) . '">';
		foreach ( $AlphaBet as $key => $value ) {
			$output .= '<div class="tp-alphabet-content">
                    <label class="tp-alphabet-item" >
                        <input type="checkbox" class="tp-alphabet-input" id="' . esc_attr( $Namevalue ) . '-' . esc_attr( $value ) . '" name="' . esc_attr( $Namevalue ) . '" value="' . esc_attr( $value ) . '" data-title="' . esc_attr( $value ) . '">
                        <span class="tp-alphabet-button">' . esc_html( $value ) . '</span>
                    </label>
                </div>';
		}
		$output .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML for tabbing filters based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data      The data for the tabbing filter (presumably the filter label or text).
	 * @param string $name     The name of the tabbing filter.
	 * @param bool   $showCnt    Whether to show a container for the tabbing filter.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the tabbing filter.
	 */
	protected function tp_tabbing_filter( $data, $name, $showCnt, $repeater ) {
		$settings     = $this->get_settings_for_display();
		$output       = '';
		$WooSorting   = ! empty( $repeater['WooFiltersSort'] ) ? $repeater['WooFiltersSort'] : '';
		$TabbingMedia = ! empty( $repeater['TabbingContent'] ) ? $repeater['TabbingContent'] : '';
		$ImageON      = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$TickIcon     = ! empty( $repeater['showtickIcon'] ) ? 'tp-tick-enable' : '';

		$Archivpage      = ! empty( $settings['enable_archive'] ) ? true : false;
		$ArchivMore      = ! empty( $settings['enable_archivefiled'] ) ? true : false;
		$Archive_showall = ! empty( $settings['archive_showall'] ) ? $settings['archive_showall'] : '';
		$output         .= $this->tp_filter_title( $repeater );

		if ( ! empty( $WooSorting ) ) {
			$WooFiltersSelect = ! empty( $repeater['WooFiltersSelect'] ) ? $repeater['WooFiltersSelect'] : array();
			$WooName          = array();
			if ( ! empty( $WooFiltersSelect ) ) {
				foreach ( $WooFiltersSelect as $val ) {
					if ( $val == 'featured' ) {
						$WooName[ $val ] = 'Featured';
					} elseif ( $val == 'on_sale' ) {
						$WooName[ $val ] = 'On sale';
					} elseif ( $val == 'top_sales' ) {
						$WooName[ $val ] = 'Top Sales';
					} elseif ( $val == 'instock' ) {
						$WooName[ $val ] = 'In Stock';
					} elseif ( $val == 'outofstock' ) {
						$WooName[ $val ] = 'Out of Stock';
					}
				}
			}

			$output .= '<div class="tp-tabbing tp-wootab-sorting ' . esc_attr( $TickIcon ) . '">';
			foreach ( $WooName as $key => $value ) {
				$output     .= '<div class="tp-tabbing-wrapper">';
					$output .= '<label class="tp-tabbing-item">';
				if ( $TabbingMedia == 'icon' ) {
					if ( ! empty( $repeater['TabbingIconlib'] ) ) {
								ob_start();
									\Elementor\Icons_Manager::render_icon( $repeater['TabbingIconlib'], array( 'aria-hidden' => 'true' ) );
									$list_img = ob_get_contents();
								ob_end_clean();
								$output .= '<span class="tp-tabbing-media">' . $list_img . '</span>';
					}
				} elseif ( $TabbingMedia == 'image' ) {
					$Image   = ! empty( $repeater['TabbingImage'] ) ? $repeater['TabbingImage']['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
					$output .= '<span class="tp-tabbing-media"><img src="' . esc_url( $Image ) . '" class="tp-tabbing-image" alt="atl"></span>';
				}
						$output .= '<input type="checkbox" class="tp-tabbing-input" id="woo_SgTabbing" name="woo_SgTabbing" value="' . esc_attr( $key ) . '" data-title="' . esc_attr( $value ) . '">';
						$output .= '<span class="tp-tabbing-button">' . esc_html( $value ) . '</span>';
					$output     .= '</label>';
					$output     .= '</div>';
			}
				$output .= $this->tp_showmore_content( $repeater, 'tabbing' );
			$output     .= '</div>';
		} else {
			$ArchiveName = $classArchive = $CatName = '';
			if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				global $wp_query;
				$query_var = $wp_query->query_vars;

				if ( isset( $query_var['cat'] ) ) {
					$CatName = $query_var['category_name'];
				}
				if ( isset( $query_var['tag'] ) ) {
					$CatName = $query_var['tag'];
				}
				if ( ! empty( $query_var ) && isset( $query_var['taxonomy'] ) && isset( $query_var[ $query_var['taxonomy'] ] ) ) {
					$CatName = $query_var[ $query_var['taxonomy'] ];
				}
			}

			$output .= '<div class="tp-tabbing ' . esc_attr( $TickIcon ) . '">';
			if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				foreach ( $data as $key => $value ) {
					$DataName = ! empty( $value['name'] ) ? $value['name'] : '';

					if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
						$ArchiveName   = $DataName;
						$ArchiveActive = 'active';
						$output       .= $this->tp_tabbing_html( $repeater, $value, $key, $name, $ArchiveActive, $classArchive );
					}
				}
			}

			foreach ( $data as $key => $value ) {
				$DataName      = ! empty( $value['name'] ) ? $value['name'] : '';
				$Count         = ! empty( $value['count'] ) ? $value['count'] : '';
				$DataImage     = ! empty( $value['image'] ) ? $value['image'] : '';
				$ArchiveActive = '';

				if ( is_archive() && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					if ( ! empty( $CatName ) && strtolower( $CatName ) == strtolower( $DataName ) ) {
						$ArchiveActive = 'active';
					}
					if ( ! empty( $Archivpage ) ) {
						$classArchive = 'tp-archive-hidden';
					}
				}

				if ( strtolower( $ArchiveName ) != strtolower( $DataName ) ) {
					$output .= $this->tp_tabbing_html( $repeater, $value, $key, $name, $ArchiveActive, $classArchive );
				}
			}

			if ( ! empty( $ArchivMore ) ) {
				$output .= $this->tp_archive_more( $repeater );
			}

				$output .= $this->tp_showmore_content( $repeater, 'tabbing' );
			$output     .= '</div>';
		}

		return $output;
	}

	/**
	 * Generate HTML for tabbing based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $repeater      The repeater settings array.
	 * @param mixed  $value         The value for tabbing.
	 * @param mixed  $key           The key for tabbing.
	 * @param string $name          The name for tabbing.
	 * @param bool   $ArchiveActive Whether the archive is active.
	 * @param string $classArchive  CSS classes for the archive.
	 *
	 * @return mixed The result of generating HTML for tabbing.
	 */
	protected function tp_tabbing_html( $repeater, $value, $key, $name, $ArchiveActive, $classArchive ) {
		$TabbingMedia = ! empty( $repeater['TabbingContent'] ) ? $repeater['TabbingContent'] : '';

		$ImageON   = ! empty( $repeater['Imageshow'] ) ? $repeater['Imageshow'] : '';
		$TickIcon  = ! empty( $repeater['showtickIcon'] ) ? 'tp-tick-enable' : '';
		$showCnt   = ! empty( $repeater['showCount'] ) ? 'yes' : '';
		$DataName  = ! empty( $value['name'] ) ? $value['name'] : '';
		$Count     = ! empty( $value['count'] ) ? $value['count'] : '';
		$DataImage = ! empty( $value['image'] ) ? $value['image'] : '';

		$EnableChecked = ! empty( $ArchiveActive ) ? 'checked' : '';

		$output = '<div class="tp-tabbing-wrapper ' . $ArchiveActive . ' ' . $classArchive . '">';

			$output .= '<label class="tp-tabbing-item">';

				$output .= '<input type="checkbox" class="tp-tabbing-input" id="tp-' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $key ) . '" data-title="' . esc_attr( $DataName ) . '" ' . $EnableChecked . '>';

		if ( 'icon' === $TabbingMedia ) {
			if ( ! empty( $repeater['TabbingIconlib'] ) ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $repeater['TabbingIconlib'], array( 'aria-hidden' => 'true' ) );
					$list_img = ob_get_contents();
				ob_end_clean();

				$output .= '<span class="tp-tabbing-media">' . $list_img . '</span>';
			}
		} elseif ( 'image' === $TabbingMedia ) {
			$Image   = ! empty( $repeater['TabbingImage'] ) ? $repeater['TabbingImage']['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
			$output .= '<span class="tp-dy-tabbing-Img"><img src="' . esc_url( $Image ) . '" class="tp-dy-tabbing-thumbimg" alt="atl"></span>';
		}

		if ( ! empty( $DataImage ) && ! empty( $ImageON ) ) {
			$output .= '<span class="tp-dy-tabbing-Img"><img src="' . esc_url( $DataImage ) . '" class="tp-dy-tabbing-thumbimg"/></span>';
		}

			$output .= '<span class="tp-tabbing-button">' . esc_html( $DataName ) . '</span>';

		if ( ! empty( $showCnt ) ) {
			$output .= '<span class="tp-tabbing-counter">' . esc_html( $Count ) . '</span>';
		}

			$output .= '</label>';
		$output     .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML for a color field based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data      The data for the color field (presumably the color value).
	 * @param string $name      The name of the color field.
	 * @param bool   $showCnt   Whether to show a container for the color field.
	 * @param array  $attr      Additional attributes for the color field.
	 * @param string $tooltip   Tooltip text for the color field.
	 * @param string $class     CSS classes for the color field.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the color field.
	 */
	protected function tp_color_field( $data, $name, $showCnt, $attr, $tooltip, $class, $repeater ) {
		$ContentType = isset( $repeater['ContentType'] ) ? $repeater['ContentType'] : '';
		$TPPrefix    = $this->tp_unique_widget_id( $name, $repeater );

		$op  = '';
		$op .= $this->tp_filter_title( $repeater );
		$op .= '<div class="tp-woo-color tp-row" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';

		foreach ( $data as $value => $label ) {
			$DataName   = ! empty( $label['name'] ) ? $label['name'] : '';
			$inputvalue = $value;
			if ( 'taxonomy' === $ContentType ) {
				$color = get_term_meta( $value, 'product_attribute_color', true );
			} elseif ( $ContentType == 'acf_conne' ) {
				$color      = $label['code'];
				$inputvalue = $label['code'];
				$value      = str_replace( array( '#' ), '', $label['code'] );
			} elseif ( $ContentType == 'toolset_conne' || $ContentType == 'pods_conne' || $ContentType == 'metabox_conne' ) {
				$color      = $label['code'];
				$inputvalue = $label['code'];
				$value      = str_replace( array( '#' ), '', $label['code'] );
			}

			$op .= '<div class="tp-colorBox ' . esc_attr( $class ) . '">';

				$op .= '<input type="checkbox" name="' . esc_attr( $attr ) . '" value="' . esc_attr( $inputvalue ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" data-title="' . esc_attr( $DataName ) . '" />';

				$op .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '"> ';

					$op .= '<div class="tp-color-wrap">';

						$op .= '<span style="background-color:' . esc_attr( $color ) . '" class="tp-color-opt"></span>';

			if ( ! empty( $tooltip ) ) {
				if ( ! empty( $showCnt ) ) {
					$count = ! empty( $label['count'] ) ? $label['count'] : '';
					$op   .= '<span class="tp-tooltip">' . esc_html( $DataName ) . '(' . esc_html( $count ) . ') </span>';
				} else {
					$op .= '<span class="tp-tooltip">' . esc_html( ucwords( $DataName ) ) . ' </span>';
				}
			}
					$op .= '</div>';
				$op     .= '</label>';

			$op .= '</div>';
		}

		$op .= '</div>';

		return $op;
	}

	/**
	 * Generate HTML for a button field based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data      The data for the button field (presumably the button label or text).
	 * @param string $name      The name of the button field.
	 * @param bool   $showCnt   Whether to show a container for the button.
	 * @param array  $attr      Additional attributes for the button field.
	 * @param string $tooltip   Tooltip text for the button field.
	 * @param string $class     CSS classes for the button field.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the button field.
	 */
	protected function tp_button_field( $data, $name, $showCnt, $attr, $tooltip, $class, $repeater ) {
		$TPPrefix = $this->tp_unique_widget_id( $name, $repeater );

		$op  = '';
		$op .= $this->tp_filter_title( $repeater );
		$op .= '<div class="tp-woo-button tp-row" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';

		foreach ( $data as $value => $label ) {
			$Name = ! empty( $label['name'] ) ? $label['name'] : '';

			$op .= '<div class="tp-buttonBox ' . esc_attr( $class ) . '">';

				$op .= '<input type="radio" name="' . esc_attr( $attr ) . '" value="' . esc_attr( $value ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" data-title="' . esc_attr( $Name ) . '" />';

				$op .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '"> ';

					$op .= '<div class="tp-color-wrap">';

						$op .= '<span class="tp-color-opt">' . esc_html( $Name ) . '</span>';

			if ( ! empty( $tooltip ) ) {
				if ( ! empty( $showCnt ) ) {
					$count = ! empty( $label['count'] ) ? $label['count'] : '';
					$op   .= '<span class="tp-tooltip">' . esc_html( $Name ) . '(' . esc_html( $count ) . ') </span>';
				} else {
					$op .= '<span class="tp-tooltip">' . esc_html( $Name ) . ' </span>';
				}
			}

					$op .= '</div>';
				$op     .= '</label>';
			$op         .= '</div>';
		}
		$op .= '</div>';

		return $op;
	}

	/**
	 * Generate HTML for an image field based on specified parameters.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $data      The data for the image field.
	 * @param string $name      The name of the image field.
	 * @param bool   $showCnt   Whether to show a container for the image.
	 * @param array  $attr      Additional attributes for the image field.
	 * @param string $tooltip   Tooltip text for the image field.
	 * @param string $class     CSS classes for the image field.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating HTML for the image field.
	 */
	protected function tp_image_field( $data, $name, $showCnt, $attr, $tooltip, $class, $repeater ) {
		$ContentType = isset( $repeater['ContentType'] ) ? $repeater['ContentType'] : '';
		$TPPrefix    = $this->tp_unique_widget_id( $name, $repeater );

		$op = '';

		$op .= $this->tp_filter_title( $repeater );

		$op .= '<div class="tp-woo-image tp-row" data-tpprefix="' . esc_attr( $TPPrefix ) . '">';

		foreach ( $data as $value => $label ) {
			$DataTitle = $DataName = ! empty( $label['name'] ) ? $label['name'] : '';
			if ( $ContentType == 'taxonomy' ) {
				$attachment_id = absint( get_term_meta( $value, 'product_attribute_image', true ) );
				$imageSrc      = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
				$image         = ! empty( $imageSrc[0] ) ? $imageSrc[0] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
			} elseif ( $ContentType == 'acf_conne' ) {
				$image     = ! empty( $label['url'] ) ? $label['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
				$DataTitle = ! empty( $label['title'] ) ? $label['title'] : '';
			} else {
				$image     = ! empty( $label['url'] ) ? $label['url'] : THEPLUS_ASSETS_URL . 'images/tp-placeholder.jpg';
				$DataTitle = ! empty( $label['title'] ) ? $label['title'] : '';
			}

			$op                 .= '<div class="tp-imgBox tp-col ' . esc_attr( $class ) . '">';
				$op             .= '<input type="checkbox" name="' . esc_attr( $attr ) . '" value="' . esc_attr( $value ) . '" id="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '" data-title="' . esc_attr( $DataTitle ) . '" />';
				$op             .= '<label for="' . esc_attr( $TPPrefix ) . esc_attr( $value ) . '"> ';
					$op         .= '<div class="tp-img-wrap">';
						$op     .= '<span class="tp-img-opt">';
							$op .= '<img src="' . esc_url( $image ) . '" class="woo-img-tag" alt="' . esc_html__( 'Attr_img', 'theplus' ) . '" >';
						$op     .= '</span>';

			if ( ! empty( $tooltip ) ) {

				if ( ! empty( $showCnt ) ) {

					$count = ! empty( $label['count'] ) ? $label['count'] : '';
					$op   .= '<span class="tp-tooltip">' . esc_html( $DataTitle ) . '(' . esc_html( $count ) . ') </span>';
				} else {

					$op .= '<span class="tp-tooltip">' . esc_html( $DataTitle ) . ' </span>';
				}
			}

					$op .= '</div>';
				$op     .= '</label>';
				$op     .= '</div>';
		}

		$op .= '</div>';
		return $op;
	}

	/**
	 * Generate autocomplete functionality based on the specified name and repeater settings.
	 *
	 * @since 1.0.0
	 *
	 * @param string $name      The name parameter.
	 * @param array  $repeater  The repeater settings array.
	 *
	 * @return mixed The result of generating autocomplete functionality.
	 */
	protected function tp_autocomplete( $name, $repeater ) {
		$TPPrefix = $this->tp_unique_widget_id( $name, $repeater );

		$output = '';

		$output .= $this->tp_filter_title( $repeater );

		$output .= '<div class="tp-autocomplete-wrap" data-tpprefix="' . esc_attr( $TPPrefix ) . '" >';

		$output .= '<svg xmlns="http://www.w3.org/2000/svg" class="tp-nearme tp-autocomplete-icon" viewBox="0 0 512 512"><path d="M176 256C176 211.8 211.8 176 256 176C300.2 176 336 211.8 336 256C336 300.2 300.2 336 256 336C211.8 336 176 300.2 176 256zM256 0C273.7 0 288 14.33 288 32V66.65C368.4 80.14 431.9 143.6 445.3 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H445.3C431.9 368.4 368.4 431.9 288 445.3V480C288 497.7 273.7 512 256 512C238.3 512 224 497.7 224 480V445.3C143.6 431.9 80.14 368.4 66.65 288H32C14.33 288 0 273.7 0 256C0 238.3 14.33 224 32 224H66.65C80.14 143.6 143.6 80.14 224 66.65V32C224 14.33 238.3 0 256 0zM128 256C128 326.7 185.3 384 256 384C326.7 384 384 326.7 384 256C384 185.3 326.7 128 256 128C185.3 128 128 185.3 128 256z"/></svg>';

			$output .= '<input type="text" id="tp-autocomplete-input" class="tp-search-input-autocomplete" name="' . esc_attr( $name ) . '" placeholder="location" autocomplete="off" data-location="" />';

		$output .= '</div>';

		return $output;
	}

	/**
	 * Generate HTML content for a "Show More" button or link based on the specified settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $repeater The repeater settings array.
	 * @param string $value    The value parameter.
	 *
	 * @return string The HTML content for the "Show More" button or link.
	 */
	protected function tp_showmore_content( $repeater, $value ) {
		$show_more = ! empty( $repeater['ShowMore'] ) ? $repeater['ShowMore'] : false;
		$moretxt   = ! empty( $repeater['showmoretxt'] ) ? $repeater['showmoretxt'] : '';
		$scroll_on = ! empty( $repeater['scrollOn'] ) ? true : false;

		$op = '';
		if ( ! empty( $show_more ) ) {
			$showmore_data = json_encode(
				array(
					'className'       => $value,
					'ShowOn'          => $show_more,
					'ShowValue'       => ! empty( $repeater['MoreDefault'] ) ? (int) $repeater['MoreDefault'] : 3,
					'ShowMoretxt'     => $moretxt,
					'Showlesstxt'     => ! empty( $repeater['showlesstxt'] ) ? $repeater['showlesstxt'] : '',
					'ScrollclassName' => 'tp-normal-scroll',
					'scrollOn'        => $scroll_on,
					'scrollheight'    => ! empty( $repeater['height_scroll'] ) ? (int) $repeater['height_scroll']['size'] : 150,
				),
				true
			);

			$op .= '<div class="tp-tabbing-redmore">';

				$op .= '<a class="tp-filter-readmore ShowMore" data-ShowMore="' . esc_attr( $showmore_data ) . '" >' . esc_html( $moretxt ) . '</a>';

			$op .= '</div>';
		}

		return $op;
	}

	/**
	 * Generate or handle a filter button based on the specified settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings The settings array for the filter button.
	 *
	 * @return HTML The result of generating or handling the filter button.
	 */
	protected function tp_filter_button( $settings ) {
		$FilterBtn       = ! empty( $settings['FilterBtn'] ) ? $settings['FilterBtn'] : false;
		$DefNumber       = ! empty( $settings['TogBtnNum'] ) ? $settings['TogBtnNum'] : 3;
		$TextBtn         = ! empty( $settings['TogBtnTitle'] ) ? $settings['TogBtnTitle'] : '';
		$TogBtnTitleLess = ! empty( $settings['TogBtnTitleLess'] ) ? $settings['TogBtnTitleLess'] : '';
		$MediaBtn        = ! empty( $settings['ToggleMedia'] ) ? $settings['ToggleMedia'] : '';
		$MediaPos        = ! empty( $settings['TogMPosition'] ) ? $settings['TogMPosition'] : 'start';
		$IconBtn         = ( ! empty( $settings['ToggleBtnIcon'] ) && ! empty( $settings['ToggleBtnIcon']['value'] ) ) ? $settings['ToggleBtnIcon']['value'] : 'fas fa-sliders-h';
		$ImageBtn        = ( ! empty( $settings['Toggleimage'] ) && ! empty( $settings['Toggleimage']['url'] ) ) ? $settings['Toggleimage']['url'] : THEPLUS_ASSETS_URL . 'images/placeholder-grid.jpg';

		$Btncolumn   = '';
		$BtnColumnOn = ! empty( $settings['EnableBtnColumn'] ) ? 1 : 0;
		if ( ! empty( $BtnColumnOn ) ) {
			$BtnDesktop = ! empty( $settings['BtnDesktop'] ) ? $settings['BtnDesktop'] : 6;
			$BtnTablet  = ! empty( $settings['BtnTablet'] ) ? $settings['BtnTablet'] : 6;
			$BtnMobile  = ! empty( $settings['BtnMobile'] ) ? $settings['BtnMobile'] : 6;
			$Btncolumn  = $this->tp_search_column( $BtnDesktop, $BtnTablet, $BtnMobile );
		}

		$BtnValue = json_encode(
			array(
				'Number'   => $DefNumber,
				'showmore' => $TextBtn,
				'showless' => $TogBtnTitleLess,
			),
			true
		);

		$GetMedia = '';
		if ( 'icon' === $MediaBtn && ! empty( $settings['ToggleBtnIcon'] ) ) {
			ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['ToggleBtnIcon'], array( 'aria-hidden' => 'true' ) );
				$Icon = ob_get_contents();
			ob_end_clean();

			$GetMedia = '<span class="tp-button-icon">' . $Icon . '</span>';
		} elseif ( 'image' === $MediaBtn && ! empty( $ImageBtn ) ) {
			$GetMedia = '<span class="tp-button-Image"><img src="' . esc_url( $ImageBtn ) . '" class="tp-button-ImageTag" ></span>';
		}

		$op = '';
		if ( ! empty( $FilterBtn ) ) {
			$op .= '<div class="tp-button-filter ' . esc_attr( $Btncolumn ) . '" data-Button-Filter= \'' . $BtnValue . '\'>';

				$op .= '<button class="tp-toggle-button ' . esc_attr( $MediaPos ) . '">';

					$op .= 'start' === $MediaPos ? $GetMedia : '';
					$op .= ! empty( $TextBtn ) ? '<span class="tp-button-text">' . esc_html( $TextBtn ) . '</span>' : '';
					$op .= 'end' === $MediaPos ? $GetMedia : '';

				$op .= '</button>';

			$op .= '</div>';
		}

		return $op;
	}

	/**
	 * Generate or handle an AJAX button based on the specified settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings The settings array for the AJAX button.
	 *
	 * @return mixed The result of generating or handling the AJAX button.
	 */
	protected function tp_ajax_button( $settings ) {
		$op = '';

		$AjaxBtn   = ! empty( $settings['Ajaxbutton'] ) ? 1 : 0;
		$BtnColumn = $this->tp_search_column( $settings['desktop_column'], $settings['tablet_column'], $settings['mobile_column'] );

		if ( ! empty( $AjaxBtn ) ) {
			$AjaxBtnTxt      = ! empty( $settings['Ajaxbtntxt'] ) ? $settings['Ajaxbtntxt'] : '';
			$AjaxbtnMedia    = ! empty( $settings['AjaxbtnMedia'] ) ? $settings['AjaxbtnMedia'] : '';
			$AjaxBtnIcon     = ! empty( $settings['AjaxBtnIcon'] ) ? $settings['AjaxBtnIcon'] : '';
			$AjaxBtnPosition = ! empty( $settings['AjaxBtnPosition'] ) ? $settings['AjaxBtnPosition'] : '';
			$AjaxBtnimage    = ( ! empty( $settings['AjaxBtnimage'] ) && ! empty( $settings['AjaxBtnimage']['url'] ) ) ? $settings['AjaxBtnimage']['url'] : THEPLUS_ASSETS_URL . 'images/placeholder-grid.jpg';
			$AjaxloadiconOn  = ! empty( $settings['AjaxloadiconOn'] ) ? 1 : 0;
			$AjaxBtnlayout   = ! empty( $settings['AjaxBtnlayout'] ) ? $settings['AjaxBtnlayout'] : 'style-1';

			$AjaxData = json_encode(
				array(
					'AjaxBtnTxt'      => $AjaxBtnTxt,
					'AjaxLoaddingtxt' => ! empty( $settings['AjaxLoadbtntxt'] ) ? $settings['AjaxLoadbtntxt'] : '',
					'Ajaxloadicon'    => $AjaxloadiconOn,
				),
				true
			);

			$GetMedia = '';
			if ( 'icon' === $AjaxbtnMedia && ! empty( $AjaxBtnIcon ) ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $AjaxBtnIcon, array( 'aria-hidden' => 'true' ) );
					$Icon = ob_get_contents();
				ob_end_clean();

				$GetMedia = '<span class="tp-ajaxbtn-icon">' . $Icon . '</span>';
			} elseif ( 'image' === $AjaxbtnMedia && ! empty( $AjaxBtnimage ) ) {
				$GetMedia = '<span class="tp-ajaxbtn-Image"><img src="' . esc_url( $AjaxBtnimage ) . '" class="tp-ajaxbtn-ImageTag" ></span>';
			}

			$op .= '<div class="tp-ajaxbtn-filter ' . esc_attr( $BtnColumn ) . '">';

				$op .= '<button class="tp-ajax-button ' . esc_attr( $AjaxBtnPosition ) . '" data-ajaxbutton= \'' . $AjaxData . '\'>';

					$op .= 'start' === $AjaxBtnPosition ? $GetMedia : '';
					$op .= ! empty( $AjaxBtnTxt ) ? '<span class="tp-ajaxbtn-text">' . esc_html( $AjaxBtnTxt ) . '</span>' : '';
					$op .= 'end' === $AjaxBtnPosition ? $GetMedia : '';
					$op .= ! empty( $AjaxloadiconOn ) ? '<span class="tp-ajaxbtn-spinner-loader ' . $AjaxBtnlayout . '"></span>' : '';

				$op .= '</button>';

			$op .= '</div>';
		}

		return $op;
	}

	/**
	 * Change columns based on specified conditions.
	 *
	 * @since 1.0.0
	 *
	 * @param string $filter      The filter to check.
	 * @param string $columnMerge The column value to use.
	 *
	 * @return mixed The modified column value.
	 */
	protected function tp_column_change( $filter, $columnMerge ) {
		$output = '';

		$column_change = ! empty( $filter['ColumnChange'] ) ? array_reverse( $filter['ColumnChange'] ) : array();

		if ( $column_change ) {
			$output     .= '<div class="field-col ' . esc_attr( $columnMerge ) . '">';
				$output .= '<div class="tp-column-result-wrap">';

			foreach ( $column_change as $value ) {
				$Icon = '';
				if ( '12' === $value ) {
					$Icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000pt" height="25.000000pt" viewBox="0 0 125.000000 125.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,125.000000) scale(0.100000,-0.100000)" ><path d="M12 1238 c-17 -17 -17 -1209 0 -1226 17 -17 1209 -17 1226 0 17 17 17 1209 0 1226 -17 17 -1209 17 -1226 0z m1223 -613 l0 -610 -610 0 -610 0 -3 600 c-1 330 0 606 3 613 3 10 131 12 612 10 l608 -3 0 -610z"/><path d="M354 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M640 810 c0 -6 53 -10 140 -10 87 0 140 4 140 10 0 6 -53 10 -140 10 -87 0 -140 -4 -140 -10z"/><path d="M640 740 c0 -6 53 -10 140 -10 87 0 140 4 140 10 0 6 -53 10 -140 10 -87 0 -140 -4 -140 -10z"/><path d="M354 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M640 490 c0 -6 53 -10 140 -10 87 0 140 4 140 10 0 6 -53 10 -140 10 -87 0 -140 -4 -140 -10z"/><path d="M640 420 c0 -6 53 -10 140 -10 87 0 140 4 140 10 0 6 -53 10 -140 10 -87 0 -140 -4 -140 -10z"/></g></svg>';
				} elseif ( '6' === $value ) {
					$Icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000pt" height="25.000000pt" viewBox="0 0 125.000000 125.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,125.000000) scale(0.100000,-0.100000)"><path d="M12 1238 c-17 -17 -17 -1209 0 -1226 17 -17 1209 -17 1226 0 17 17 17 1209 0 1226 -17 17 -1209 17 -1226 0z m1223 -613 l0 -610 -610 0 -610 0 -3 600 c-1 330 0 606 3 613 3 10 131 12 612 10 l608 -3 0 -610z"/><path d="M377 874 c-12 -13 -8 -179 5 -192 18 -18 162 -16 177 2 8 9 11 46 9 103 l-3 88 -90 3 c-50 1 -94 0 -98 -4z m178 -94 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M697 874 c-12 -13 -8 -179 5 -192 18 -18 162 -16 177 2 8 9 11 46 9 103 l-3 88 -90 3 c-50 1 -94 0 -98 -4z m178 -94 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M377 554 c-12 -13 -8 -179 5 -192 18 -18 162 -16 177 2 8 9 11 46 9 103 l-3 88 -90 3 c-50 1 -94 0 -98 -4z m178 -94 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M697 554 c-12 -13 -8 -179 5 -192 18 -18 162 -16 177 2 8 9 11 46 9 103 l-3 88 -90 3 c-50 1 -94 0 -98 -4z m178 -94 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/></g></svg>';
				} elseif ( '4' === $value ) {
					$Icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000pt" height="25.000000pt" viewBox="0 0 125.000000 125.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,125.000000) scale(0.100000,-0.100000)"><path d="M12 1238 c-17 -17 -17 -1209 0 -1226 17 -17 1209 -17 1226 0 17 17 17 1209 0 1226 -17 17 -1209 17 -1226 0z m1223 -613 l0 -610 -610 0 -610 0 -3 600 c-1 330 0 606 3 613 3 10 131 12 612 10 l608 -3 0 -610z"/><path d="M214 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M534 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M854 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M214 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M534 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M854 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/></g></svg>';
				} elseif ( '3' === $value ) {
					$Icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000pt" height="25.000000pt" viewBox="0 0 125.000000 125.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,125.000000) scale(0.100000,-0.100000)" ><path d="M12 1238 c-17 -17 -17 -1209 0 -1226 17 -17 1209 -17 1226 0 17 17 17 1209 0 1226 -17 17 -1209 17 -1226 0z m1223 -613 l0 -610 -610 0 -610 0 -3 600 c-1 330 0 606 3 613 3 10 131 12 612 10 l608 -3 0 -610z"/><path d="M114 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M394 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M674 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M954 867 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M114 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M394 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M674 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/><path d="M954 547 c-2 -8 -4 -52 -2 -98 l3 -84 95 0 95 0 0 95 0 95 -93 3 c-71 2 -94 0 -98 -11z m181 -87 l0 -85 -85 0 -85 0 -3 74 c-2 41 -1 80 2 88 4 11 25 13 88 11 l83 -3 0 -85z"/></g></svg>';
				}

				$output .= '<label class="tp-column-label">';

					$output .= '<input type="radio" class="tp-column-input" name="columninput" value="' . esc_attr( $value ) . '" />';
					$output .= '<span class="tp-column-Icon" >' . $Icon . '</span>';

				$output .= '</label>';
			}

				$output .= '</div>';
			$output     .= '</div>';
		}

		return $output;
	}

	/**
	 * Display an error message within a styled div.
	 *
	 * @since 1.0.0
	 *
	 * @param string $massage The error message to be displayed.
	 *
	 * @return string HTML for the styled error message div.
	 */
	protected function Filter_ErrorShow( $massage ) {
		return "<div class='Sf-Error-Handal'> {$massage} </div>";
	}

	/**
	 * Generate column classes for responsive design.
	 *
	 * @since 1.0.0
	 *
	 * @param int $desktop The number of columns for desktop.
	 * @param int $tablet  The number of columns for tablet.
	 * @param int $mobile  The number of columns for mobile.
	 *
	 * @return string The concatenated column class string.
	 */
	protected function tp_search_column( $desktop, $tablet, $mobile ) {
		$column  = 'tp-col-lg-' . esc_attr( $desktop );
		$column .= ' tp-col-md-' . esc_attr( $tablet );
		$column .= ' tp-col-sm-' . esc_attr( $mobile );
		$column .= ' tp-col-' . esc_attr( $mobile );

		return $column;
	}

	/**
	 * Generate a unique widget ID based on the provided name and repeater options.
	 *
	 * @since 1.0.0
	 *
	 * @param string $name      The base name for the widget ID.
	 * @param array  $repeater  The repeater options, containing 'filteroption' and 'WooFilterType' among others.
	 *
	 * @return string The unique widget ID.
	 */
	protected function tp_unique_widget_id( $name, $repeater ) {
		$TPPrefix = '';
		$WidgetId = $this->get_id();

		$filteroption = ! empty( $repeater['filteroption'] ) ? $repeater['filteroption'] : '';

		if ( 'Woofilter' === $filteroption ) {
			$WooFilterType = ! empty( $repeater['WooFilterType'] ) ? $repeater['WooFilterType'] : '';

			$Woo_Type = array( 'color', 'button', 'image', 'rating' );
			if ( 'product_attr' === $name && in_array( $WooFilterType, $Woo_Type ) ) {
				$name = ! empty( $repeater['pAttr'] ) ? $repeater['pAttr'] : '';
			}
		}

		$TPPrefix = 'tp-' . esc_attr( $name ) . '-' . esc_attr( $WidgetId );

		return $TPPrefix;
	}

	/**
	 * Display the archive "Read More" section.
	 *
	 * @since 1.0.0
	 * @return string The HTML for the archive "Read More" section.
	 */
	protected function tp_archive_more( $repeater ) {
		$settings        = $this->get_settings_for_display();
		$Archive_showall = ! empty( $settings['archive_showall'] ) ? $settings['archive_showall'] : '';

		return '<div class="tp-archive-readmore">' . esc_html( $Archive_showall ) . '</div>';
	}

	/**
	 * Display the archive "Read More" section.
	 *
	 * @since 1.0.0
	 * @return empty empty.
	 */
	protected function content_template() { }
}

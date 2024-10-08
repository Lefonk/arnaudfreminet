<?php
/**
 * Widget Name: Woocommerce Product Listing
 * Description: Different style of woocommerce product listing layouts.
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
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ThePlus_Product_ListOut extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @var tp_doc of the class.
	 */
	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Tablet prefix class
	 *
	 * @var slick_tablet of the class.
	 */
	public $slick_tablet = 'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .list-carousel-slick ';

	/**
	 * Mobile prefix class.
	 *
	 * @var slick_mobile of the class.
	 */
	public $slick_mobile = 'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .list-carousel-slick ';


	public function get_name() {
		return 'tp-product-listout';
	}

	public function get_title() {
		return esc_html__( 'Woo Product Listing', 'theplus' );
	}

	public function get_icon() {
		return 'fa fa-product-hunt theplus_backend_icon';
	}

	public function get_categories() {
		return array( 'plus-listing' );
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

	public function get_keywords() {
		return array( 'WooCommerce', 'Products', 'tp', 'theplus' );
	}

	public function is_reload_preview_required() {
		return true;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content Layout', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'product_post_listing',
			array(
				'label'   => esc_html__( 'Product Listing Types', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'page_listing',
				'options' => array(
					'page_listing'    => esc_html__( 'Normal Page', 'theplus' ),
					'archive_listing' => esc_html__( 'Archive Page', 'theplus' ),
					'related_product' => esc_html__( 'Single Page Related Products', 'theplus' ),
					'search_list'     => esc_html__( 'Search List', 'theplus' ),
					'upsell'          => esc_html__( 'Upsells', 'theplus' ),
					'cross_sells'     => esc_html__( 'Cross Sells', 'theplus' ),
					'recently_viewed' => esc_html__( 'Recently Viewed', 'theplus' ),
					'wishlist'        => esc_html__( 'Wishlist', 'theplus' ),
				)
			)
		);
		$this->add_control(
			'how_it_works_archive_page',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-woocommerce-product-archive-page-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'product_post_listing' => array( 'archive_listing' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_search_list',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "customize-woocommerce-search-results-page-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'product_post_listing' => array( 'search_list' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_upsell',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-upsell-products-in-woocommerce-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'product_post_listing' => array( 'upsell' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_cross_sell',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-cross-sell-products-in-woocommerce-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'product_post_listing' => array( 'cross_sells' ),
				),
			)
		);
		$this->add_control(
			'search_list_note',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note : This feature not works in Carousel Layout.', 'theplus' ),
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'product_post_listing' => 'search_list',
					'layout'               => 'carousel',
				),
			)
		);
		$this->add_control(
			'recently_viewed_note',
			array(
				'label'     => wp_kses_post( "<p class='tp-controller-notice'><i>Note : Need to enable WooCommerce Recently Viewed from ThePlus Settings -> Extra Options <a href='" . esc_url( theplus_dashboard_url( 'theplus_api_connection_data' ) ) . "' target='_blank' rel='noopener noreferrer'> Link </a></i></p>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'product_post_listing' => 'recently_viewed',
				),
			)
		);
		$this->add_control(
			'related_product_by',
			array(
				'label'     => wp_kses_post( "Related Post Type <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-related-products-on-a-product-page/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'both',
				'options'   => array(
					'category' => esc_html__( 'Based on Category', 'theplus' ),
					'tags'     => esc_html__( 'Based on Tags', 'theplus' ),
					'both'     => esc_html__( 'Both', 'theplus' ),
				),
				'condition' => array(
					'product_post_listing' => 'related_product',
				),
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list_custom_pro(),
			)
		);
		$this->add_control(
			'skin_template',
			array(
				'label'       => esc_html__( 'Select a template', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'style' => 'custom',
				),
			)
		);
		$this->add_control(
			'multiple_skin_enable',
			array(
				'label'     => esc_html__( 'Multiple Loops', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'style' => 'custom',
				),
			)
		);
		$this->add_control(
			'skin_template2',
			array(
				'label'       => esc_html__( 'Loop Template 2', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'style'                => 'custom',
					'multiple_skin_enable' => 'yes',
				),
			)
		);
		$this->add_control(
			'skin_template3',
			array(
				'label'       => esc_html__( 'Loop Template 3', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'style'                => 'custom',
					'multiple_skin_enable' => 'yes',
				),
			)
		);
		$this->add_control(
			'skin_template4',
			array(
				'label'       => esc_html__( 'Loop Template 4', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'style'                => 'custom',
					'multiple_skin_enable' => 'yes',
				),
			)
		);
		$this->add_control(
			'skin_template5',
			array(
				'label'       => esc_html__( 'Loop Template 5', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'style'                => 'custom',
					'multiple_skin_enable' => 'yes',
				),
			)
		);
		$this->add_control(
			'layout_custom_heading',
			array(
				'label'     => esc_html__( 'Metro and Masonry Layouts needs extra care when you design them in custom skin.', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => array(
					'style' => 'custom',
				),
			)
		);
		$this->add_control(
			'template_order',
			array(
				'label'     => esc_html__( 'Template Order', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'default', 'theplus' ),
					'reverse' => esc_html__( 'reverse', 'theplus' ),
					'random'  => esc_html__( 'random', 'theplus' ),
				),
				'condition' => array(
					'style' => 'custom',
				),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => theplus_get_list_layout_style(),
			)
		);
		$this->add_control(
			'wishlist_rcvp_list_note',
			array(
				'label'     => esc_html__( 'Note : This feature not works with Metro & Carousel.', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'product_post_listing' => array( 'wishlist', 'recently_viewed' ),
					'layout'               => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-woocommerce-products-in-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'grid' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-woocommerce-products-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'masonry' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_metro',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-woocommerce-products-in-metro-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_carousel',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-woocommerce-product-carousel-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_source_section',
			array(
				'label' => esc_html__( 'Content Source', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_category',
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => wp_kses_post( "Select Category <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "display-woocommerce-products-by-category-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'default'     => '',
				'multiple'    => true,
				'label_block' => true,
				'options'     => theplus_get_woo_product_categories(),
				'separator'   => 'before',
				'condition'   => array(
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'include_exclude',
			array(
				'label'     => esc_html__( 'if you want to include/exclude multiple products so use comma as separator. Such as abc , xyz', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'wishlist', 'recently_viewed' ),
				),
			)
		);
		$this->add_control(
			'include_products',
			array(
				'label'       => wp_kses_post( "Include Product(s) <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-specific-woocommerce-product-by-product-id-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'product_id',
				'label_block' => true,
				'condition'   => array(
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'wishlist', 'recently_viewed' ),
				),
			)
		);
		$this->add_control(
			'exclude_products',
			array(
				'label'       => esc_html__( 'Exclude Product(s)', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'product_id',
				'label_block' => true,
				'separator'   => 'after',
				'condition'   => array(
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'wishlist', 'recently_viewed' ),
				),
			)
		);
		$this->add_control(
			'display_posts',
			array(
				'label'   => esc_html__( 'Maximum Posts Display', 'theplus' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 200,
				'step'    => 1,
				'default' => 8,
			)
		);
		$this->add_control(
			'post_offset',
			array(
				'label'       => esc_html__( 'Offset Posts', 'theplus' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'default'     => '',
				'description' => esc_html__( 'Hide posts from the beginning of listing.', 'theplus' ),
				'condition'   => array(
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'wishlist', 'recently_viewed' ),
				),
			)
		);
		$this->add_control(
			'post_order_by',
			array(
				'label'   => esc_html__( 'Order By', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => theplus_orderby_arr(),
			)
		);
		$this->add_control(
			'post_order',
			array(
				'label'   => esc_html__( 'Order', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => theplus_order_arr(),
			)
		);
		$this->add_control(
			'display_product',
			array(
				'label'     => esc_html__( 'Display Product', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'all',
				'options'   => theplus_woo_product_display(),
				'condition' => array(
					'product_post_listing!' => array( 'recently_viewed' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_featured',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "display-featured-products-in-woocmmerce-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'display_product' => array( 'featured' ),
				),
			)
		);
		$this->end_controls_section();
		/*columns*/
		$this->start_controls_section(
			'columns_section',
			array(
				'label'     => esc_html__( 'Columns Manage', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'desktop_column',
			array(
				'label'     => esc_html__( 'Desktop Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'tablet_column',
			array(
				'label'     => esc_html__( 'Tablet Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'mobile_column',
			array(
				'label'     => esc_html__( 'Mobile Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '6',
				'options'   => theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'metro_column',
			array(
				'label'     => esc_html__( 'Metro Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'3' => esc_html__( 'Column 3', 'theplus' ),
					'4' => esc_html__( 'Column 4', 'theplus' ),
					'5' => esc_html__( 'Column 5', 'theplus' ),
					'6' => esc_html__( 'Column 6', 'theplus' ),
				),
				'condition' => array(
					'layout' => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_style_3',
			array(
				'label'     => esc_html__( 'Metro Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 4, '', 'custom' ),
				'condition' => array(
					'metro_column' => '3',
					'layout'       => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_custom_col_3',
			array(
				'label'       => esc_html__( 'Custom Layout', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => esc_html__( '1:2 | 2:1 ', 'theplus' ),
				'condition'   => array(
					'metro_column'  => '3',
					'metro_style_3' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'col_3_notice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i><b>Note</b> : Display multiple list using separator "|". e.g. 1:2 | 2:1 | 2:2.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'metro_column'  => '3',
					'metro_style_3' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_style_4',
			array(
				'label'     => esc_html__( 'Metro Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 3, '', 'custom' ),
				'condition' => array(
					'metro_column' => '4',
					'layout'       => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_custom_col_4',
			array(
				'label'       => esc_html__( 'Custom Layout', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => esc_html__( '1:2 | 2:1 ', 'theplus' ),
				'condition'   => array(
					'metro_column'  => '4',
					'metro_style_4' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'col_4_notice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i><b>Note</b> : Display multiple list using separator "|". e.g. 1:2 | 2:1 | 2:2.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'metro_column'  => '4',
					'metro_style_4' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_style_5',
			array(
				'label'     => esc_html__( 'Metro Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 1, '', 'custom' ),
				'condition' => array(
					'metro_column' => '5',
					'layout'       => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_custom_col_5',
			array(
				'label'       => esc_html__( 'Custom Layout', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => esc_html__( '1:2 | 2:1 ', 'theplus' ),
				'condition'   => array(
					'metro_column'  => '5',
					'metro_style_5' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'col_5_notice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i><b>Note</b> : Display multiple list using separator "|". e.g. 1:2 | 2:1 | 2:2.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'metro_column'  => '5',
					'metro_style_5' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_style_6',
			array(
				'label'     => esc_html__( 'Metro Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 1, '', 'custom' ),
				'condition' => array(
					'metro_column' => '6',
					'layout'       => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_custom_col_6',
			array(
				'label'       => esc_html__( 'Custom Layout', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => esc_html__( '1:2 | 2:1 ', 'theplus' ),
				'condition'   => array(
					'metro_column'  => '6',
					'metro_style_6' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'col_6_notice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i><b>Note</b> : Display multiple list using separator "|". e.g. 1:2 | 2:1 | 2:2.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'metro_column'  => '6',
					'metro_style_6' => 'custom',
					'layout'        => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'responsive_tablet_metro',
			array(
				'label'     => esc_html__( 'Tablet Responsive', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'no', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'layout' => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'tablet_metro_column',
			array(
				'label'     => esc_html__( 'Metro Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'3' => esc_html__( 'Column 3', 'theplus' ),
					'4' => esc_html__( 'Column 4', 'theplus' ),
					'5' => esc_html__( 'Column 5', 'theplus' ),
					'6' => esc_html__( 'Column 6', 'theplus' ),
				),
				'condition' => array(
					'responsive_tablet_metro' => 'yes',
					'layout'                  => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'tablet_metro_style_3',
			array(
				'label'     => esc_html__( 'Tablet Metro Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 4, '', 'custom' ),
				'condition' => array(
					'responsive_tablet_metro' => 'yes',
					'tablet_metro_column'     => '3',
					'layout'                  => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_custom_col_tab',
			array(
				'label'       => esc_html__( 'Custom Layout', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => esc_html__( '1:2 | 2:1', 'theplus' ),
				'condition'   => array(
					'responsive_tablet_metro' => 'yes',
					'tablet_metro_column'     => '3',
					'tablet_metro_style_3'    => 'custom',
					'layout'                  => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'col_tab_notice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i><b>Note</b> : Display multiple list using separator "|". e.g. 1:2 | 2:1 | 2:2.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'responsive_tablet_metro' => 'yes',
					'tablet_metro_column'     => '3',
					'tablet_metro_style_3'    => 'custom',
					'layout'                  => array( 'metro' ),
				),
			)
		);
		$this->add_responsive_control(
			'columns_gap',
			array(
				'label'      => esc_html__( 'Columns Gap/Space Between', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'separator'  => 'before',
				'condition'  => array(
					'layout!' => array( 'carousel' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/*
		columns*/
		/*post Extra options*/
		$this->start_controls_section(
			'extra_option_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => theplus_get_tags_options(),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'variation_price_on',
			array(
				'label'        => esc_html__( 'Variable Product Price Range', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'hide_outofstock_product',
			array(
				'label'     => esc_html__( 'Hide Out of Stock Product', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'product_post_listing' => array( 'archive_listing' ),
					'post_extra_option'    => 'none',
				),
			)
		);
		$this->add_control(
			'hover_image_on_off',
			array(
				'label'        => esc_html__( 'On Hover Image Change', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'display_catagory',
			array(
				'label'        => esc_html__( 'Display Category', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Hide', 'theplus' ),
				'label_off'    => esc_html__( 'Show', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'display_rating',
			array(
				'label'        => wp_kses_post( "Display Rating <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-star-rating-in-woocommerce-product-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Hide', 'theplus' ),
				'label_off'    => esc_html__( 'Show', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'display_cart_button',
			array(
				'label'        => wp_kses_post( "Cart Button Display <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "hide-add-to-cart-button-in-woocommerce-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Hide', 'theplus' ),
				'label_off'    => esc_html__( 'Show', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'dcb_single_product',
			array(
				'label'     => esc_html__( 'Add to Cart Text', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Add to cart', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_cart_button' => 'yes',
				),
			)
		);
		$this->add_control(
			'dcb_variation_product',
			array(
				'label'     => esc_html__( 'Select Options Text', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'select options', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_cart_button' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_yith_list',
			array(
				'label'     => esc_html__( 'Display YITH Buttons', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_yith_compare',
			array(
				'label'     => wp_kses_post( "Compare <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-product-compare-button-for-woocommerce-products-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'display_yith_list' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_yith_wishlist',
			array(
				'label'     => wp_kses_post( "Wishlist <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-wishlist-button-for-woocommerce-products-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'display_yith_list' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_yith_quickview',
			array(
				'label'     => esc_html__( 'Quick View', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'display_yith_list' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_theplus_quickview',
			array(
				'label'     => esc_html__( 'Display TP Quickview', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tpqc',
			array(
				'label'     => wp_kses_post( "Quickview <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-quick-view-button-on-woocommerce-products-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'         => esc_html__( 'Default', 'theplus' ),
					'custom_template' => esc_html__( 'Custom Template', 'theplus' ),
				),
				'condition' => array(
					'display_theplus_quickview' => 'yes',
				),
			)
		);
		$this->add_control(
			'custom_template_select',
			array(
				'label'       => esc_html__( 'Template', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'display_theplus_quickview' => 'yes',
					'tpqc'                      => 'custom_template',
				),
				'separator'   => 'after',
			)
		);
		$this->add_control(
			'featured_image_type',
			array(
				'label'     => esc_html__( 'Featured Image Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'full',
				'options'   => array(
					'full'   => esc_html__( 'Full Image', 'theplus' ),
					'grid'   => esc_html__( 'Grid Image', 'theplus' ),
					'custom' => esc_html__( 'Custom', 'theplus' ),
				),
				'condition' => array(
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail_car',
				'default'   => 'full',
				'separator' => 'none',
				'separator' => 'after',
				'exclude'   => array( 'custom' ),
				'condition' => array(
					'layout'              => array( 'carousel' ),
					'featured_image_type' => array( 'custom' ),
				),
			)
		);
		$this->add_control(
			'display_thumbnail',
			array(
				'label'     => esc_html__( 'Display Image Size', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'separator' => 'after',
				'exclude'   => array( 'custom' ),
				'condition' => array(
					'layout!'           => 'carousel',
					'display_thumbnail' => 'yes',
				),
			)
		);
		$this->add_control(
			'filter_category',
			array(
				'label'     => wp_kses_post( "Category Wise Filter <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "filter-woocommerce-products-by-category-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'layout!'               => 'carousel',
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'all_filter_category_switch',
			array(
				'label'     => esc_html__( 'All Filter', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'filter_category'       => 'yes',
					'layout!'               => 'carousel',
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'all_filter_category',
			array(
				'label'     => esc_html__( 'All Filter Category Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All', 'theplus' ),
				'condition' => array(
					'filter_category'            => 'yes',
					'all_filter_category_switch' => 'yes',
					'layout!'                    => 'carousel',
					'product_post_listing!'      => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'filter_style',
			array(
				'label'     => esc_html__( 'Category Filter Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 4 ),
				'condition' => array(
					'filter_category'       => 'yes',
					'layout!'               => 'carousel',
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'filter_hover_style',
			array(
				'label'     => esc_html__( 'Filter Hover Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 4 ),
				'condition' => array(
					'filter_category'       => 'yes',
					'layout!'               => 'carousel',
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);

		$this->add_control(
			'filter_category_align',
			array(
				'label'       => esc_html__( 'Filter Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'default'     => 'center',
				'toggle'      => true,
				'label_block' => false,
				'condition'   => array(
					'filter_category'       => 'yes',
					'layout!'               => 'carousel',
					'product_post_listing!' => array( 'archive_listing', 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'post_extra_option',
			array(
				'label'     => esc_html__( 'More Post Loading Options', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => theplus_post_loading_option(),
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
				),
			)
		);
		$this->add_control(
			'paginationType',
			array(
				'label'     => esc_html__( 'Pagination Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'standard',
				'options'   => array(
					'standard'  => esc_html__( 'Standard', 'theplus' ),
					'ajaxbased' => esc_html__( 'Ajax Based', 'theplus' ),
				),
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells' ),
					'post_extra_option'     => 'pagination',
				),
			)
		);
		// pagination style
		$this->add_control(
			'pagination_next',
			array(
				'label'       => wp_kses_post( "Pagination Next <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-pagination-to-woocommerce-products-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Next', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Text', 'theplus' ),
				'label_block' => true,
				'condition'   => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'pagination',
				),
			)
		);
		$this->add_control(
			'pagination_prev',
			array(
				'label'       => esc_html__( 'Pagination Previous', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'PREV', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Text', 'theplus' ),
				'label_block' => true,
				'condition'   => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'pagination',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'pagination_typography',
				'label'     => esc_html__( 'Pagination Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .theplus-pagination a,{{WRAPPER}} .theplus-pagination span',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'pagination',
				),
			)
		);
		$this->add_control(
			'pagination_color',
			array(
				'label'     => esc_html__( 'Pagination Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-pagination a,{{WRAPPER}} .theplus-pagination span' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'pagination',
				),
			)
		);
		$this->add_control(
			'pagination_hover_color',
			array(
				'label'     => esc_html__( 'Pagination Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-pagination > a:hover,{{WRAPPER}} .theplus-pagination > a:focus,{{WRAPPER}} .theplus-pagination span.current' => 'color: {{VALUE}};border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'pagination',
				),
			)
		);
		// load more style
		$this->add_control(
			'load_more_btn_text',
			array(
				'label'     => wp_kses_post( "Button Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-load-more-button-in-woocommerce-products-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Load More', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->add_control(
			'tp_loading_text',
			array(
				'label'     => wp_kses_post( "Loading Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-infinite-scroll-to-woocommerce-products-list-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Loading...', 'theplus' ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'loaded_posts_text',
			array(
				'label'     => esc_html__( 'All Posts Loaded Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All done!', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => array( 'load_more', 'lazy_load' ),
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
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => array( 'load_more', 'lazy_load' ),
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
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
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
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'load_more_border',
			array(
				'label'     => esc_html__( 'Load More Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);

		$this->add_control(
			'load_more_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'load_more_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_load_more_border_style' );
		$this->start_controls_tab(
			'tab_load_more_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->add_control(
			'load_more_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'load_more_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->add_control(
			'load_more_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'load_more_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
					'load_more_border'      => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_load_more_style' );
		$this->start_controls_tab(
			'tab_load_more_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
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
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
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
				'separator' => 'after',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_control(
			'loading_spin_heading',
			array(
				'label'     => esc_html__( 'Loading Spinner ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'lazy_load',
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
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'lazy_load',
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
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'lazy_load',
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
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'lazy_load',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'load_more_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'load_more_shadow',
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
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
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'load_more_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
				'separator' => 'after',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_shadow_hover_options',
			array(
				'label'     => esc_html__( 'Hover Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'load_more_hover_shadow',
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
				'condition' => array(
					'layout!'               => array( 'carousel' ),
					'product_post_listing!' => array( 'related_product', 'upsell', 'cross_sells', 'recently_viewed', 'wishlist' ),
					'post_extra_option'     => 'load_more',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'empty_posts_message',
			array(
				'label'       => __( 'No Posts Message', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Products not found', 'theplus' ),
				'description' => '',
			)
		);
		$this->add_control(
			'pnfmsg_recvp',
			array(
				'label'     => esc_html__( 'Not Visited Any Product Notice', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'product_post_listing' => 'recently_viewed',
				),
			)
		);
		$this->end_controls_section();
		/*post Extra options*/

		/*catagory options start*/
		$this->start_controls_section(
			'section_catagory_style',
			array(
				'label'     => esc_html__( 'Category', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_catagory' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'catagory_marign',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .post-inner-loop .post-catagory' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'catagory_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .product-list .post-inner-loop .post-catagory',
			)
		);
		$this->start_controls_tabs( 'tabs_catagory_style' );
		$this->start_controls_tab(
			'tab_catagory_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'catagory_color',
			array(
				'label'     => esc_html__( 'Category Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .post-catagory' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_catagory_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'catagory_hover_color',
			array(
				'label'     => esc_html__( 'Category Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .product-list-content:hover .post-catagory' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_catagory_metro_style' );
		$this->start_controls_tab(
			'tab_catagory_metro_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'catagory_metro_background',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-3.list-isotope-metro .post-catagory' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_catagory_metro_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'post-catagory_metro_hover_background',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-3 .product-list-content:hover .post-catagory' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*catagory options end*/

		/*Post Title*/
		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .product-list .post-inner-loop .post-title,{{WRAPPER}} .product-list .post-inner-loop .post-title a',
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .post-title,{{WRAPPER}} .product-list .post-inner-loop .post-title a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .product-list-content:hover .post-title,{{WRAPPER}} .product-list .post-inner-loop .product-list-content:hover .post-title a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_title_metro_style' );
		$this->start_controls_tab(
			'tab_title_metro_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'title_metro_background',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-3.list-isotope-metro .post-title' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_metro_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'title_metro_hover_background',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-3 .product-list-content:hover .post-title' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Title*/

		/*rating start*/
		$this->start_controls_section(
			'section_rating_style',
			array(
				'label'     => esc_html__( 'Rating', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_rating' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'rating_marign',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .woocommerce-product-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'rating_color',
			array(
				'label'     => esc_html__( 'Rating Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .product-list .star-rating span::before,{{WRAPPER}} .product-list .star-rating::before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'rating_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .product-list .woocommerce-product-rating' => 'justify-content: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();
		/*rating end*/

		/*Product Price*/
		$this->start_controls_section(
			'section_price_style',
			array(
				'label' => esc_html__( 'Price', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'price_marign',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .wrapper-cart-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Price Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .product-list .wrapper-cart-price .price .amount,{{WRAPPER}} .product-list .wrapper-cart-price .price .amount .woocommerce-Price-currencySymbol',
			)
		);
		$this->start_controls_tabs( 'tabs_price_style' );
		$this->start_controls_tab(
			'tab_price_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'price_color',
			array(
				'label'     => esc_html__( 'Price Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .wrapper-cart-price .price .amount,{{WRAPPER}} .product-list .wrapper-cart-price .price .amount .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_price_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'price_hover_color',
			array(
				'label'     => esc_html__( 'Price Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content:hover .wrapper-cart-price .price .amount,{{WRAPPER}} .product-list .product-list-content:hover .wrapper-cart-price .price .amount .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'sale_price_options',
			array(
				'label'     => esc_html__( 'Previous Price', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sale_price_typography',
				'label'    => esc_html__( 'Price Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .product-list .wrapper-cart-price .price del .amount,{{WRAPPER}} .product-list .product-list-content .wrapper-cart-price .price del .amount .woocommerce-Price-currencySymbol',
			)
		);

		$this->start_controls_tabs( 'tabs_sale_price_style' );
		$this->start_controls_tab(
			'tab_sale_price_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'sale_price_color',
			array(
				'label'     => esc_html__( 'Previous Price Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .wrapper-cart-price .price del .amount,{{WRAPPER}} .product-list .product-list-content .wrapper-cart-price .price del .amount .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_sale_price_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'sale_price_hover_color',
			array(
				'label'     => esc_html__( 'Previous Price Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content:hover .wrapper-cart-price .price del .amount,{{WRAPPER}} .product-list .product-list-content:hover .wrapper-cart-price .price del .amount .woocommerce-Price-currencySymbol' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_price_metro_style' );
		$this->start_controls_tab(
			'tab_price_metro_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'price_metro_background',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-3.list-isotope-metro .wrapper-cart-price .price .amount' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_price_metro_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'price_metro_hover_background',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-3.list-isotope-metro .product-list-content:hover .wrapper-cart-price .price .amount' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Product Price*/
		/*Badge*/
		$this->start_controls_section(
			'section_badge_style',
			array(
				'label' => esc_html__( 'Badge', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'b_dis_badge_switch',
			array(
				'label'     => esc_html__( 'Display Badge', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'out_of_stock',
			array(
				'label'       => esc_html__( 'Out of Stock Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Out of Stock',
				'default'     => esc_html__( 'Out of Stock', 'theplus' ),
				'label_block' => true,
				'condition'   => array(
					'b_dis_badge_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'b_outofstock_switch',
			array(
				'label'     => esc_html__( 'Out of Stock style', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'b_dis_badge_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'b_outofstock_price',
			array(
				'label'     => esc_html__( 'Out of Stock Price', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'b_dis_badge_switch'  => 'yes',
					'b_outofstock_switch' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'b_outofstock_typo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content span.badge.out-of-stock',
				'condition' => array(
					'b_dis_badge_switch'  => 'yes',
					'b_outofstock_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'b_outofstock_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content span.badge.out-of-stock' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'b_dis_badge_switch'  => 'yes',
					'b_outofstock_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'b_outofstock_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content span.badge.out-of-stock' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'b_dis_badge_switch'  => 'yes',
					'b_outofstock_switch' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'b_outofstock_shadow',
				'selector'  => '{{WRAPPER}} .product-list .product-list-content span.badge.out-of-stock',
				'condition' => array(
					'b_dis_badge_switch'  => 'yes',
					'b_outofstock_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'b_onsale_switch',
			array(
				'label'     => esc_html__( 'On sale Style', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'b_dis_badge_switch' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'b_onsale_typo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content span.badge.onsale',
				'condition' => array(
					'b_dis_badge_switch' => 'yes',
					'b_onsale_switch'    => 'yes',
				),
			)
		);
		$this->add_control(
			'b_onsale_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content span.badge.onsale' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'b_dis_badge_switch' => 'yes',
					'b_onsale_switch'    => 'yes',
				),
			)
		);
		$this->add_control(
			'b_onsale_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content span.badge.onsale' => 'background: {{VALUE}}',
					'{{WRAPPER}} .product-list .product-list-content span.badge.onsale:before' => 'border-color: transparent transparent transparent {{VALUE}}',
					'{{WRAPPER}} .product-list .product-list-content span.badge.onsale:after' => 'border-color: {{VALUE}} transparent transparent',
				),
				'condition' => array(
					'b_dis_badge_switch' => 'yes',
					'b_onsale_switch'    => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'b_onsale_shadow',
				'selector'  => '{{WRAPPER}} .product-list .product-list-content span.badge.out-of-stock',
				'condition' => array(
					'b_dis_badge_switch' => 'yes',
					'b_onsale_switch'    => 'yes',
				),
			)
		);
		$this->end_controls_section();
		/*
		Badge*/
		/*Content Background*/
		$this->start_controls_section(
			'section_content_bg_style',
			array(
				'label' => esc_html__( 'Content Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'content_alignment',
			array(
				'label'       => esc_html__( 'Content Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'default'     => 'left',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => esc_html__( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .post-content-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
				'name'     => 'contnet_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content .post-content-bottom',
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
				'name'     => 'content_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content:hover .post-content-bottom',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_box_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_content_shadow_style' );
		$this->start_controls_tab(
			'tab_content_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_shadow',
				'selector' => '{{WRAPPER}} .product-list .product-list-content .post-content-bottom',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_hover_shadow',
				'selector' => '{{WRAPPER}} .product-list .product-list-content:hover .post-content-bottom',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Content Background*/
		/*Product Featured Image*/
		$this->start_controls_section(
			'section_post_image_style',
			array(
				'label' => esc_html__( 'Product Image', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs( 'tabs_image_style' );
		$this->start_controls_tab(
			'tab_image_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_image_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content .product-image:before,{{WRAPPER}} .product-list .product-list-content .product-bg-image-metro:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_image_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content:hover .product-image:before,{{WRAPPER}} .product-list .product-list-content:hover .product-bg-image-metro:before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'featured_image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .product-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => 'metro',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_image_shadow_style' );
		$this->start_controls_tab(
			'tab_image_shadow_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'layout!' => 'metro',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_shadow',
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .product-image',
				'condition' => array(
					'layout!' => 'metro',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_shadow_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'layout!' => 'metro',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_hover_shadow',
				'selector'  => '{{WRAPPER}} .product-list .product-list-content:hover .product-image',
				'condition' => array(
					'layout!' => 'metro',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Product Featured Image*/
		/*Cart Button style*/
		$this->start_controls_section(
			'section_cart_button_styling',
			array(
				'label' => esc_html__( 'Add To Cart Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'style!' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-1 .add_to_cart_button span.icon .arrow svg *' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .product-list.product-style-1 .add_to_cart_button .icon .sr-loader-icon::after,{{WRAPPER}} .product-list.product-style-1 .add_to_cart_button .icon .check::after,{{WRAPPER}} .product-list.product-style-1 .add_to_cart_button .icon .check::before' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple',
				'condition' => array(
					'style!' => 'style-2',
				),
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'   => esc_html__( 'None', 'theplus' ),
					'solid'  => esc_html__( 'Solid', 'theplus' ),
					'dotted' => esc_html__( 'Dotted', 'theplus' ),
					'dashed' => esc_html__( 'Dashed', 'theplus' ),
					'groove' => esc_html__( 'Groove', 'theplus' ),
				),
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'style!' => array( 'style-2' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_border_style!' => 'none',
					'style!'               => array( 'style-2' ),
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'style!'               => array( 'style-2' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);

		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style!' => array( 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple',
				'condition' => array(
					'style!' => array( 'style-2' ),
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btn_icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-1 .add_to_cart_button:hover span.icon .arrow svg *' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple:hover',
				'separator' => 'after',
				'condition' => array(
					'style!' => 'style-2',
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'style!'               => array( 'style-2' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);

		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style!' => array( 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .add_to_cart.product_type_simple:hover',
				'condition' => array(
					'style!' => array( 'style-2' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'quick_view_options',
			array(
				'label'     => esc_html__( 'Quick View Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_quick_view_style' );
		$this->start_controls_tab(
			'tab_quick_view_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'quick_view_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-2 .product-list-content a.quick-view-btn' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'quick_view_background',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-2 .product-list-content a.quick-view-btn' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_quick_view_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'quick_view_icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-2 .product-list-content a.quick-view-btn:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'quick_view_hover_background',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list.product-style-2 .product-list-content a.quick-view-btn:hover' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*button style*/

		/*YITH Buttons style*/
		$this->start_controls_section(
			'section_yith_button_styling',
			array(
				'label'      => esc_html__( 'YITH / TP Quickview Buttons', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'display_yith_list',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'display_theplus_quickview',
									'operator' => '==',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'yith_b_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'yith_b_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'yith_b_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'yith_b_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
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
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'yith_b_icon_size',
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
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_yith_b' );
		$this->start_controls_tab(
			'tab_yith_b_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'yith_b_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'yith_b_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'yith_b_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'yith_b_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'yith_b_shadow',
				'selector' => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_yith_b_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'yith_b_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner:hover i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'yith_b_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'yith_b_border_h',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner:hover',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'yith_b_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'yith_b_shadow_h',
				'selector' => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper .tp-yith-inner:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*YITH Buttons style*/

		/*YITH Buttons Box style*/
		$this->start_controls_section(
			'section_yith_button_box_styling',
			array(
				'label'      => esc_html__( 'YITH / TP Quickview Buttons Box', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'display_yith_list',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'display_theplus_quickview',
									'operator' => '==',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'yith_bb_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'yith_bb_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'yith_bb_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'yith_bb_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'yith_bb_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'yith_bb_shadow',
				'selector' => '{{WRAPPER}} .product-list .product-list-content .tp-yith-wrapper',
			)
		);
		$this->end_controls_section();
		/*YITH Buttons Box style*/

		/*Filter Category style*/
		$this->start_controls_section(
			'section_filter_category_styling',
			array(
				'label'     => esc_html__( 'Filter Category', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'filter_category' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'filter_category_typography',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'filter_category_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-1 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-3 li a,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'filter_category_marign',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'filters_text_color',
			array(
				'label'     => esc_html__( 'Filters Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link line,{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link circle,{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link polyline' => 'stroke: {{VALUE}}',
				),
				'condition' => array(
					'filter_style' => array( 'style-4' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_filter_color_style' );
		$this->start_controls_tab(
			'tab_filter_category_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'filter_category_color',
			array(
				'label'     => esc_html__( 'Category Filter Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'filter_category_4_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a:before' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'filter_hover_style' => array( 'style-4' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'filter_category_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a:after',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => array( 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'filter_category_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'filter_category_shadow',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_filter_category_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'filter_category_hover_color',
			array(
				'label'     => esc_html__( 'Category Filter Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a:hover,{{WRAPPER}}  .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a:focus,{{WRAPPER}}  .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a.active,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'filter_category_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'filter_category_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'filter_category_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before',
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'filter_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-1 li a::after' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'filter_hover_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'count_filter_category_options',
			array(
				'label'     => esc_html__( 'Count Filter Category', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'category_count_color',
			array(
				'label'     => esc_html__( 'Category Count Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a span.all_post_count' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'category_count_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'condition' => array(
					'filter_style' => array( 'style-1' ),
				),
			)
		);
		$this->add_control(
			'category_count_bg_color',
			array(
				'label'     => esc_html__( 'Count Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-3 a span.all_post_count' => 'background: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-3 a span.all_post_count:before' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'filter_style' => array( 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'filter_category_count_shadow',
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'separator' => 'before',
				'condition' => array(
					'filter_style' => array( 'style-1' ),
				),
			)
		);
		$this->end_controls_section();
		/*
		Filter Category style*/
		/*Box Loop style*/
		$this->start_controls_section(
			'section_box_loop_styling',
			array(
				'label' => esc_html__( 'Box Loop Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_active_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_active_shadow',
				'selector' => '{{WRAPPER}} .product-list .post-inner-loop .grid-item .product-list-content:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Box Loop style*/
		/*carousel option*/
		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'carousel',
				),
			)
		);
		$this->add_control(
			'carousel_unique_id',
			array(
				'label'       => esc_html__( 'Unique Carousel ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'separator'   => 'after',
				'description' => esc_html__( 'Keep this blank or Setup Unique id for carousel which you can use with "Carousel Remote" widget.', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_direction',
			array(
				'label'   => esc_html__( 'Slider Mode', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'theplus' ),
					'vertical'   => esc_html__( 'Vertical', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'carousel_direction',
			array(
				'label'   => esc_html__( 'Slide Direction', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => array(
					'rtl' => esc_html__( 'Right to Left', 'theplus' ),
					'ltr' => esc_html__( 'Left to Right', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slide_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Slide Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
			)
		);

		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			array(
				'label' => esc_html__( 'Desktop', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_desktop_column',
			array(
				'label'   => esc_html__( 'Desktop Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_carousel_desktop_columns(),
			)
		);
		$this->add_control(
			'steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'slider_padding',
			array(
				'label'      => esc_html__( 'Slide Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '10',
						'bottom' => '',
						'left'   => '10',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'multi_drag',
			array(
				'label'     => esc_html__( 'Multi Drag', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_draggable' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'slider_pause_hover',
			array(
				'label'     => esc_html__( 'Pause On Hover', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_adaptive_height',
			array(
				'label'     => esc_html__( 'Adaptive Height', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_animation',
			array(
				'label'   => esc_html__( 'Animation Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => array(
					'ease'   => esc_html__( 'With Hold', 'theplus' ),
					'linear' => esc_html__( 'Continuous', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 3000,
				),
				'condition'  => array(
					'slider_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
					'style-7' => esc_html__( 'Style 7', 'theplus' ),
				),
				'condition' => array(
					'slider_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button,{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 .slick-active button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_top_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Dots Top Padding', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
				),
				'condition' => array(
					'slider_arrows' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'arrows_position',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top-right',
				'options'   => array(
					'top-right'     => esc_html__( 'Top-Right', 'theplus' ),
					'bottm-left'    => esc_html__( 'Bottom-Left', 'theplus' ),
					'bottom-center' => esc_html__( 'Bottom-Center', 'theplus' ),
					'bottom-right'  => esc_html__( 'Bottom-Right', 'theplus' ),
				),
				'condition' => array(
					'slider_arrows'       => array( 'yes' ),
					'slider_arrows_style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-6:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-6:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows'       => 'yes',
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
				),
			)
		);
		$this->add_control(
			'hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_center_effects',
			array(
				'label'     => esc_html__( 'Center Slide Effects', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => theplus_carousel_center_effects(),
				'condition' => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'scale_center_slide',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Center Slide Scale', 'theplus' ),
				'size_units'  => '',
				'range'       => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'     => array(
					'unit' => '',
					'size' => 1,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center,
					{{WRAPPER}} .list-carousel-slick .slick-slide.scc-animate' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});opacity:1;',
				),
				'condition'   => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_control(
			'scale_normal_slide',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Normal Slide Scale', 'theplus' ),
				'size_units'  => '',
				'range'       => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'     => array(
					'unit' => '',
					'size' => 0.8,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});transition: .3s all linear;',
				),
				'condition'   => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'shadow_active_slide',
				'selector'  => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center .product-list-content',
				'condition' => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'shadow',
				),
			)
		);
		$this->add_control(
			'opacity_normal_slide',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Normal Slide Opacity', 'theplus' ),
				'size_units'  => '',
				'range'       => array(
					'' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'     => array(
					'unit' => '',
					'size' => 0.7,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => 'opacity:{{SIZE}}',
				),
				'condition'   => array(
					'slider_center_mode'     => 'yes',
					'slider_center_effects!' => 'none',
				),
			)
		);
		$this->add_control(
			'slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slide_row_top_space',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Row Top Space', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick[data-slider_rows="2"] .slick-slide > div:last-child,{{WRAPPER}} .list-carousel-slick[data-slider_rows="3"] .slick-slide > div:nth-last-child(-n+2)' => 'padding-top:{{SIZE}}px',
				),
				'condition'  => array(
					'slider_rows' => array( '2', '3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			array(
				'label' => esc_html__( 'Tablet', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_tablet_column',
			array(
				'label'   => esc_html__( 'Tablet Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_carousel_tablet_columns(),
			)
		);
		$this->add_control(
			'tablet_steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);

		$this->add_control(
			'slider_responsive_tablet',
			array(
				'label'     => esc_html__( 'Responsive Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tablet_slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
				'condition'  => array(
					'slider_responsive_tablet' => 'yes',
					'tablet_slider_autoplay'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
					'style-7' => esc_html__( 'Style 7', 'theplus' ),
				),
				'condition' => array(
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					$this->slick_tablet . 'ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_tablet . 'ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-2 li button, ' . $this->slick_tablet . ' ul.slick-dots.style-3 li button, ' . $this->slick_tablet . ' .slick-dots.style-4 li button:before, ' . $this->slick_tablet . ' .slick-dots.style-5 button, ' . $this->slick_tablet . ' .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_tablet . '.slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_tablet . '.slick-dots.style-2 li::after,' . $this->slick_tablet . '.slick-dots.style-4 li.slick-active button:before,' . $this->slick_tablet . '.slick-dots.style-5 .slick-active button,' . $this->slick_tablet . '.slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_dots_top_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Dots Top Padding', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					$this->slick_tablet . '.slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tablet_slider_dots'       => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
				),
				'condition' => array(
					'tablet_slider_arrows'     => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrows_position',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top-right',
				'options'   => array(
					'top-right'     => esc_html__( 'Top-Right', 'theplus' ),
					'bottm-left'    => esc_html__( 'Bottom-Left', 'theplus' ),
					'bottom-center' => esc_html__( 'Bottom-Center', 'theplus' ),
					'bottom-right'  => esc_html__( 'Bottom-Right', 'theplus' ),
				),
				'condition' => array(
					'tablet_slider_arrows'       => array( 'yes' ),
					'tablet_slider_arrows_style' => array( 'style-3', 'style-4' ),
					'slider_responsive_tablet'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1,' . $this->slick_tablet . '.slick-nav.slick-next.style-1,' . $this->slick_tablet . '.slick-nav.style-3:before,' . $this->slick_tablet . '.slick-prev.style-3:before,' . $this->slick_tablet . '.slick-prev.style-6:before,' . $this->slick_tablet . '.slick-next.style-6:before' => 'background: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-4:before,' . $this->slick_tablet . '.slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1:before,' . $this->slick_tablet . '.slick-nav.slick-next.style-1:before,' . $this->slick_tablet . '.slick-prev.style-3:before,' . $this->slick_tablet . '.slick-nav.style-3:before,' . $this->slick_tablet . '.slick-prev.style-4:before,' . $this->slick_tablet . '.slick-nav.style-4:before,' . $this->slick_tablet . '.slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-2 .icon-wrap:before,' . $this->slick_tablet . '.slick-prev.style-2 .icon-wrap:after,' . $this->slick_tablet . '.slick-next.style-2 .icon-wrap:before,' . $this->slick_tablet . '.slick-next.style-2 .icon-wrap:after,' . $this->slick_tablet . '.slick-prev.style-5 .icon-wrap:before,' . $this->slick_tablet . '.slick-prev.style-5 .icon-wrap:after,' . $this->slick_tablet . '.slick-next.style-5 .icon-wrap:before,' . $this->slick_tablet . '.slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1:hover,' . $this->slick_tablet . '.slick-nav.slick-next.style-1:hover,' . $this->slick_tablet . '.slick-prev.style-2:hover::before,' . $this->slick_tablet . '.slick-next.style-2:hover::before,' . $this->slick_tablet . '.slick-prev.style-3:hover:before,' . $this->slick_tablet . '.slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-4:hover:before,' . $this->slick_tablet . '.slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_tablet . '.slick-nav.slick-prev.style-1:hover:before,' . $this->slick_tablet . '.slick-nav.slick-next.style-1:hover:before,' . $this->slick_tablet . '.slick-prev.style-3:hover:before,' . $this->slick_tablet . '.slick-nav.style-3:hover:before,' . $this->slick_tablet . '.slick-prev.style-4:hover:before,' . $this->slick_tablet . '.slick-nav.style-4:hover:before,' . $this->slick_tablet . '.slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_tablet . '.slick-prev.style-2:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-prev.style-2:hover .icon-wrap::after,' . $this->slick_tablet . '.slick-next.style-2:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-next.style-2:hover .icon-wrap::after,' . $this->slick_tablet . '.slick-prev.style-5:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-prev.style-5:hover .icon-wrap::after,' . $this->slick_tablet . '.slick-next.style-5:hover .icon-wrap::before,' . $this->slick_tablet . '.slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'tablet_slider_arrows'       => 'yes',
					'slider_responsive_tablet'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tablet_slider_arrows'       => 'yes',
					'tablet_slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
					'slider_responsive_tablet'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tablet_slider_arrows'     => 'yes',
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_responsive_tablet' => 'yes',
					'tablet_center_mode'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			array(
				'label' => esc_html__( 'Mobile', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_mobile_column',
			array(
				'label'   => esc_html__( 'Mobile Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => theplus_carousel_mobile_columns(),
			)
		);
		$this->add_control(
			'mobile_steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);

		$this->add_control(
			'slider_responsive_mobile',
			array(
				'label'     => esc_html__( 'Responsive Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'mobile_slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
				'condition'  => array(
					'slider_responsive_mobile' => 'yes',
					'mobile_slider_autoplay'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
					'style-7' => esc_html__( 'Style 7', 'theplus' ),
				),
				'condition' => array(
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-1 li button,' . $this->slick_mobile . '.slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					$this->slick_mobile . 'ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					$this->slick_mobile . 'ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-2 li button,' . $this->slick_mobile . 'ul.slick-dots.style-3 li button,' . $this->slick_mobile . '.slick-dots.style-4 li button:before,' . $this->slick_mobile . '.slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					$this->slick_mobile . '.slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					$this->slick_mobile . '.slick-dots.style-2 li::after,' . $this->slick_mobile . '.slick-dots.style-4 li.slick-active button:before,' . $this->slick_mobile . '.slick-dots.style-5 .slick-active button,' . $this->slick_mobile . '.slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_dots_top_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Dots Top Padding', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					$this->slick_mobile . '.slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
				),
				'condition' => array(
					'mobile_slider_arrows'     => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrows_position',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top-right',
				'options'   => array(
					'top-right'     => esc_html__( 'Top-Right', 'theplus' ),
					'bottm-left'    => esc_html__( 'Bottom-Left', 'theplus' ),
					'bottom-center' => esc_html__( 'Bottom-Center', 'theplus' ),
					'bottom-right'  => esc_html__( 'Bottom-Right', 'theplus' ),
				),
				'condition' => array(
					'mobile_slider_arrows'       => 'yes',
					'mobile_slider_arrows_style' => array( 'style-3', 'style-4' ),
					'slider_responsive_mobile'   => 'yes',

				),
			)
		);
		$this->add_control(
			'mobile_arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1,' . $this->slick_mobile . '.slick-nav.slick-next.style-1,' . $this->slick_mobile . '.slick-nav.style-3:before,' . $this->slick_mobile . '.slick-prev.style-3:before,' . $this->slick_mobile . '.slick-prev.style-6:before,' . $this->slick_mobile . '.slick-next.style-6:before' => 'background: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-4:before,' . $this->slick_mobile . '.slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1:before,' . $this->slick_mobile . '.slick-nav.slick-next.style-1:before,' . $this->slick_mobile . '.slick-prev.style-3:before,' . $this->slick_mobile . '.slick-nav.style-3:before,' . $this->slick_mobile . '.slick-prev.style-4:before,' . $this->slick_mobile . '.slick-nav.style-4:before,' . $this->slick_mobile . '.slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-2 .icon-wrap:before,' . $this->slick_mobile . '.slick-prev.style-2 .icon-wrap:after,' . $this->slick_mobile . '.slick-next.style-2 .icon-wrap:before,' . $this->slick_mobile . '.slick-next.style-2 .icon-wrap:after,' . $this->slick_mobile . '.slick-prev.style-5 .icon-wrap:before,' . $this->slick_mobile . '.slick-prev.style-5 .icon-wrap:after,' . $this->slick_mobile . '.slick-next.style-5 .icon-wrap:before,' . $this->slick_mobile . '.slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1:hover,' . $this->slick_mobile . '.slick-nav.slick-next.style-1:hover,' . $this->slick_mobile . '.slick-prev.style-2:hover::before,' . $this->slick_mobile . '.slick-next.style-2:hover::before,' . $this->slick_mobile . '.slick-prev.style-3:hover:before,' . $this->slick_mobile . '.slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-4:hover:before,' . $this->slick_mobile . '.slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					$this->slick_mobile . '.slick-nav.slick-prev.style-1:hover:before,' . $this->slick_mobile . '.slick-nav.slick-next.style-1:hover:before,' . $this->slick_mobile . '.slick-prev.style-3:hover:before,' . $this->slick_mobile . '.slick-nav.style-3:hover:before,' . $this->slick_mobile . '.slick-prev.style-4:hover:before,' . $this->slick_mobile . '.slick-nav.style-4:hover:before,' . $this->slick_mobile . '.slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					$this->slick_mobile . '.slick-prev.style-2:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-prev.style-2:hover .icon-wrap::after,' . $this->slick_mobile . '.slick-next.style-2:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-next.style-2:hover .icon-wrap::after,' . $this->slick_mobile . '.slick-prev.style-5:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-prev.style-5:hover .icon-wrap::after,' . $this->slick_mobile . '.slick-next.style-5:hover .icon-wrap::before,' . $this->slick_mobile . '.slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'mobile_slider_arrows'       => 'yes',
					'slider_responsive_mobile'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'mobile_slider_arrows'       => 'yes',
					'mobile_slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
					'slider_responsive_mobile'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'mobile_slider_arrows'     => 'yes',
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_responsive_mobile' => 'yes',
					'mobile_center_mode'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*carousel option*/

		/*post not found options*/
		$this->start_controls_section(
			'section_post_not_found_styling',
			array(
				'label' => esc_html__( 'Post Not Found Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pnf_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-posts-not-found' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pnf_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .theplus-posts-not-found',
			)
		);
		$this->add_control(
			'pnf_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-posts-not-found' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'pnf_bg',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-posts-not-found',
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pnf_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-posts-not-found',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'pnf_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-posts-not-found' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'pnf_shadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-posts-not-found',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		/*post not found options*/

		/*Extra options*/
		$this->start_controls_section(
			'section_extra_options_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'messy_column',
			array(
				'label'     => esc_html__( 'Messy Columns', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->start_controls_tabs( 'tabs_extra_option_style' );
		$this->start_controls_tab(
			'tab_column_1',
			array(
				'label'     => esc_html__( '1', 'theplus' ),
				'condition' => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'desktop_column_1',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Column 1', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_2',
			array(
				'label'     => esc_html__( '2', 'theplus' ),
				'condition' => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'desktop_column_2',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Column 2', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_3',
			array(
				'label'     => esc_html__( '3', 'theplus' ),
				'condition' => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'desktop_column_3',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Column 3', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_4',
			array(
				'label'     => esc_html__( '4', 'theplus' ),
				'condition' => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'desktop_column_4',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Column 4', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_5',
			array(
				'label'     => esc_html__( '5', 'theplus' ),
				'condition' => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'desktop_column_5',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Column 5', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_6',
			array(
				'label'     => esc_html__( '6', 'theplus' ),
				'condition' => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'desktop_column_6',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Column 6', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'messy_column' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		/*Extra options*/

		/*--On Scroll View Animation ---*/
			$Plus_Listing_block = 'Plus_Listing_block';
			include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
			include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Product Listing.
	 *
	 * @since 1.0.0
	 * @version 5.6.0
	 */

	protected function render() {
		$settings             = $this->get_settings_for_display();
		$query_args           = $this->get_query_args();
		$query                = new \WP_Query( $query_args );
		$style                = $settings['style'];
		$layout               = $settings['layout'];
		$display_thumbnail    = $settings['display_thumbnail'];
		$thumbnail            = $settings['thumbnail_size'];
		$thumbnail_car        = $settings['thumbnail_car_size'];
		$product_post_listing = ! empty( $settings['product_post_listing'] ) ? $settings['product_post_listing'] : 'page_listing';
		$paginationType       = ! empty( $settings['paginationType'] ) ? $settings['paginationType'] : 'standard';
		$b_outofstock_price   = isset( $settings['b_outofstock_price'] ) ? $settings['b_outofstock_price'] : '';

		$post_title_tag        = $settings['post_title_tag'];
		$post_category         = $settings['post_category'];
		$display_cart_button   = $settings['display_cart_button'];
		$dcb_single_product    = $settings['dcb_single_product'];
		$dcb_variation_product = $settings['dcb_variation_product'];
		$display_catagory      = $settings['display_catagory'];
		$display_rating        = $settings['display_rating'];

		$display_yith_list      = $settings['display_yith_list'];
		$display_yith_compare   = $settings['display_yith_compare'];
		$display_yith_wishlist  = $settings['display_yith_wishlist'];
		$display_yith_quickview = $settings['display_yith_quickview'];

		$display_theplus_quickview = $settings['display_theplus_quickview'];
		$MorePostOptions           = ! empty( $settings['post_extra_option'] ) ? $settings['post_extra_option'] : 'none';

		$carousel_direction = $carousel_slider = '';
		if ( $layout == 'carousel' ) {
			$carousel_direction = ! empty( $settings['carousel_direction'] ) ? $settings['carousel_direction'] : 'ltr';

			if ( ! empty( $carousel_direction ) ) {
				$carousel_data = array(
					'carousel_direction' => $carousel_direction,
				);

				$carousel_slider = 'data-result="' . htmlspecialchars( wp_json_encode( $carousel_data, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			}
		}

		$temp_array = array();
		if ( $style == 'custom' && ! empty( $settings['skin_template'] ) ) {
			$temp_array[] = $settings['skin_template'];
		}
		if ( ! empty( $settings['multiple_skin_enable'] ) && $settings['multiple_skin_enable'] == 'yes' ) {
			if ( $style == 'custom' && ! empty( $settings['skin_template2'] ) ) {
				$temp_array[] = $settings['skin_template2'];
			}
			if ( $style == 'custom' && ! empty( $settings['skin_template3'] ) ) {
				$temp_array[] = $settings['skin_template3'];
			}
			if ( $style == 'custom' && ! empty( $settings['skin_template4'] ) ) {
				$temp_array[] = $settings['skin_template4'];
			}
			if ( $style == 'custom' && ! empty( $settings['skin_template5'] ) ) {
				$temp_array[] = $settings['skin_template5'];
			}
		}
		$array_key   = array_keys( $temp_array );
		$array_value = array_values( $temp_array );
		if ( $settings['template_order'] == 'default' ) {
			$rv         = $array_value;
			$temp_array = array_combine( $array_key, $rv );
		} elseif ( $settings['template_order'] == 'reverse' ) {
			$rv         = array_reverse( $array_value );
			$temp_array = array_combine( $array_key, $rv );
		} elseif ( $settings['template_order'] == 'random' ) {
			$temp_array = $array_value;
			shuffle( $temp_array );
		}

		if ( isset( $settings['b_dis_badge_switch'] ) ) {
			$b_dis_badge_switch = ( 'yes' == $settings['b_dis_badge_switch'] ) ? $settings['b_dis_badge_switch'] : '';
		} else {
			$b_dis_badge_switch = 'yes';
		}

		if ( isset( $settings['variation_price_on'] ) ) {
			$variation_price_on = ( 'yes' == $settings['variation_price_on'] ) ? $settings['variation_price_on'] : 'no';
		} else {
			$variation_price_on = 'no';
		}

		if ( isset( $settings['hover_image_on_off'] ) ) {
			$hover_image_on_off = ( 'yes' == $settings['hover_image_on_off'] ) ? $settings['hover_image_on_off'] : 'no';
		} else {
			$hover_image_on_off = 'yes';
		}

		$featured_image_type = ( ! empty( $settings['featured_image_type'] ) ) ? $settings['featured_image_type'] : 'full';

		$content_alignment = ( $settings['content_alignment'] != '' ) ? 'text-' . $settings['content_alignment'] : '';

		/*--On Scroll View Animation ---*/
		$Plus_Listing_block = 'Plus_Listing_block';
		$animated_columns   = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		// columns
		$desktop_class = $tablet_class = $mobile_class = '';
		if ( $layout != 'carousel' && $layout != 'metro' ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $settings['desktop_column'] );
			$tablet_class  = 'tp-col-md-' . esc_attr( $settings['tablet_column'] );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $settings['mobile_column'] );
			$mobile_class .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
		}

		// layout
		$layout_attr = $data_class = '';
		if ( $layout != '' ) {
			$data_class .= theplus_get_layout_list_class( $layout );
			$layout_attr = theplus_get_layout_list_attr( $layout );
		} else {
			$data_class .= ' list-isotope';
		}

		if ( $layout == 'metro' ) {
			$postid        = '';
			$metro_columns = $settings['metro_column'];
			$metro3        = ! empty( $settings['metro_style_3'] ) ? $settings['metro_style_3'] : '';
			$metro4        = ! empty( $settings['metro_style_4'] ) ? $settings['metro_style_4'] : '';
			$metro5        = ! empty( $settings['metro_style_5'] ) ? $settings['metro_style_5'] : '';
			$metro6        = ! empty( $settings['metro_style_6'] ) ? $settings['metro_style_6'] : '';

			$metrocustomCol = '';

			if ( 'custom' === $metro3 ) {
				$metrocustomCol = ! empty( $settings['metro_custom_col_3'] ) ? $settings['metro_custom_col_3'] : '';
			} elseif ( 'custom' === $metro4 ) {
				$metrocustomCol = ! empty( $settings['metro_custom_col_4'] ) ? $settings['metro_custom_col_4'] : '';
			} elseif ( 'custom' === $metro5 ) {
				$metrocustomCol = ! empty( $settings['metro_custom_col_5'] ) ? $settings['metro_custom_col_5'] : '';
			} elseif ( 'custom' === $metro6 ) {
				$metrocustomCol = ! empty( $settings['metro_custom_col_6'] ) ? $settings['metro_custom_col_6'] : '';
			}

			$mecusCol = array();
			if ( ! empty( $metrocustomCol ) ) {
				$exString = explode( ' | ', $metrocustomCol );
				foreach ( $exString as $index => $item ) {
					if ( ! empty( $item ) ) {
						$mecusCol[ $index + 1 ] = array( 'layout' => $item );
					}
				}
				$total        = count( $exString );
				$layout_attr .= 'data-metroAttr="' . htmlspecialchars( wp_json_encode( $mecusCol, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			}

			$layout_attr .= ' data-metro-columns="' . esc_attr( $metro_columns ) . '" ';
			$layout_attr .= ' data-metro-style="' . esc_attr( $settings[ 'metro_style_' . $metro_columns ] ) . '" ';
			if ( ! empty( $settings['responsive_tablet_metro'] ) && $settings['responsive_tablet_metro'] == 'yes' ) {
				$tablet_metro_column = $settings['tablet_metro_column'];
				$layout_attr        .= ' data-tablet-metro-columns="' . esc_attr( $tablet_metro_column ) . '" ';

				if ( isset( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) && ! empty( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) ) {
					$metrocustomColtab = ! empty( $settings['metro_custom_col_tab'] ) ? $settings['metro_custom_col_tab'] : '';
					$mecusColtab       = array();
					if ( ! empty( $metrocustomColtab ) ) {
						$exString = explode( ' | ', $metrocustomColtab );
						foreach ( $exString as $index => $item ) {
							if ( ! empty( $item ) ) {
								$mecusColtab[ $index + 1 ] = array( 'layout' => $item );
							}
						}
						$total        = count( $exString );
						$layout_attr .= 'data-tablet-metroAttr="' . htmlspecialchars( wp_json_encode( $mecusColtab, true ), ENT_QUOTES, 'UTF-8' ) . '"';
					}

					$layout_attr .= 'data-tablet-metro-style="' . esc_attr( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) . '"';
				}
			}
		}

		$data_class .= ' product-' . $style;
		$output      = $data_attr = '';

		// carousel
		if ( $layout == 'carousel' ) {
			if ( ! empty( $settings['hover_show_dots'] ) && $settings['hover_show_dots'] == 'yes' ) {
				$data_class .= ' hover-slider-dots';
			}
			if ( ! empty( $settings['hover_show_arrow'] ) && $settings['hover_show_arrow'] == 'yes' ) {
				$data_class .= ' hover-slider-arrow';
			}
			if ( ! empty( $settings['outer_section_arrow'] ) && $settings['outer_section_arrow'] == 'yes' && ( $settings['slider_arrows_style'] == 'style-1' || $settings['slider_arrows_style'] == 'style-2' || $settings['slider_arrows_style'] == 'style-5' || $settings['slider_arrows_style'] == 'style-6' ) ) {
				$data_class .= ' outer-slider-arrow';
			}
			$data_attr .= $this->get_carousel_options();
			if ( $settings['slider_arrows_style'] == 'style-3' || $settings['slider_arrows_style'] == 'style-4' ) {
				$data_class .= ' ' . $settings['arrows_position'];
			}
			if ( ( $settings['slider_rows'] > 1 ) || ( $settings['tablet_slider_rows'] > 1 ) || ( $settings['mobile_slider_rows'] > 1 ) ) {
				$data_class .= ' multi-row';
			}
		}
		if ( $settings['filter_category'] == 'yes' ) {
			$data_class .= ' pt-plus-filter-post-category ';
		}

		$kij = 0;
		$ji  = 1;
		$ij  = '';
		$uid = uniqid( 'post' );
		if ( ! empty( $settings['carousel_unique_id'] ) ) {
			$uid        = 'tpca_' . $settings['carousel_unique_id'];
			$data_attr .= ' data-carousel-bg-conn="bgcarousel' . esc_attr( $settings['carousel_unique_id'] ) . '"';
		}

		$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';

		if ( ! empty( $settings['display_theplus_quickview'] ) && $settings['display_theplus_quickview'] == 'yes' ) {
			if ( ! empty( $settings['tpqc'] ) && $settings['tpqc'] == 'custom_template' && ! empty( $settings['custom_template_select'] ) ) {
				$data_attr .= ' data-customtemplateqcw="yes"';
				$data_attr .= ' data-templateqcw="' . $settings['custom_template_select'] . '"';
			}
		}

		$out_of_stock = '';
		if ( ! empty( $settings['b_dis_badge_switch'] ) && $settings['b_dis_badge_switch'] == 'yes' ) {
			$out_of_stock = ! empty( $settings['out_of_stock'] ) ? $settings['out_of_stock'] : 'Out of Stock';
		}

		$tablet_metro_class = $tablet_ij = '';
		if ( ! class_exists( 'woocommerce' ) ) {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( "Wondering why it's not working? Please install WooCommerce Plugin and create your products to make this section working.", 'theplus' ) . '</h3>';
		} elseif ( ! $query->have_posts() && ! empty( $product_post_listing ) && 'wishlist' !== $product_post_listing && 'recently_viewed' !== $product_post_listing ) {
			$output .= '<h3 class="theplus-posts-not-found">' . $settings['empty_posts_message'] . '</h3>';
		} else {
			$SearchGrid = '';
			if ( ! empty( $product_post_listing ) && ( $product_post_listing == 'search_list' ) ) {
				$SearchGrid = 'tp-searchlist';
			}

			$output .= '<div id="pt-plus-product-list" class="product-list ' . esc_attr( $uid ) . ' tp-pro-l-type-' . esc_attr( $product_post_listing ) . ' ' . esc_attr( $data_class ) . ' ' . $animated_class . ' ' . esc_attr( $SearchGrid ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . '  data-enable-isotope="1">';

			// category filter
			if ( $settings['filter_category'] == 'yes' ) {
				$output .= $this->get_filter_category();
			}

			// Extra Options pagination/load more/lazy load
			$metro_style = $tablet_metro_style = $tablet_metro_column = $responsive_tablet_metro = 'no';
			if ( $layout == 'metro' ) {
				$metro_columns = $settings['metro_column'];
				if ( ! empty( $settings[ 'metro_style_' . $metro_columns ] ) ) {
					$metro_style = $settings[ 'metro_style_' . $metro_columns ];
				}
				$responsive_tablet_metro = ( ! empty( $settings['responsive_tablet_metro'] ) ) ? $settings['responsive_tablet_metro'] : 'no';
				$tablet_metro_column     = $settings['tablet_metro_column'];
				if ( ! empty( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) ) {
					$tablet_metro_style = $settings[ 'tablet_metro_style_' . $tablet_metro_column ];
				}
			}

			$category_product   = array();
			$post_category_list = '';
			if ( ! empty( $post_category ) ) {
				$terms = get_terms(
					array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => true,
					)
				);
				if ( $terms != null ) {
					foreach ( $terms as $term ) {
						if ( in_array( $term->term_id, $post_category ) ) {
							$category_product[] = $term->slug;
						}
					}
				}
				$post_category_list = implode( ',', $category_product );
			}

			if ( ! empty( $settings['product_post_listing'] ) && $settings['product_post_listing'] == 'archive_listing' ) {
				global $wp_query;
				$query_var = $wp_query->query_vars;
				if ( isset( $query_var['product_cat'] ) ) {
					$post_category_list = $query_var['product_cat'];
				}
			}

			$is_archive  = $is_search = 0;
			$ArchivePage = $SearchPage = array();
			$ProductName = '';
			if ( ! empty( $product_post_listing ) && ( $product_post_listing == 'search_list' ) || ( $product_post_listing == 'archive_listing' || ( $MorePostOptions == 'load_more' || $MorePostOptions == 'lazy_load' ) ) || ( $paginationType == 'ajaxbased' ) ) {
				if ( is_archive() ) {
					global $wp_query;
					$query_var = $wp_query->query_vars;
					if ( isset( $query_var['product_cat'] ) ) {
						$ProductName        = 'product_cat';
						$post_category_list = $query_var['product_cat'];
					}

					if ( isset( $query_var['product_tag'] ) ) {
						$ProductName        = 'product_tag';
						$post_category_list = $query_var['product_tag'];
					}

					if ( ! empty( $query_var ) && isset( $query_var['taxonomy'] ) && isset( $query_var[ $query_var['taxonomy'] ] ) ) {
						$ProductName        = $query_var['taxonomy'];
						$post_category_list = $query_var[ $query_var['taxonomy'] ];
					}

					$is_archive  = 1;
					$GetId       = get_term_by( 'slug', $post_category_list, $ProductName );
					$ArchivePage = array(
						'archive_Type' => $ProductName,
						'archive_Name' => $post_category_list,
						'archive_Id'   => ! empty( $GetId ) ? $GetId->term_id : 0,
					);
				}

				if ( is_search() ) {
					$is_search  = 1;
					$search     = get_query_var( 's' );
					$SearchPage = array(
						'is_search_value' => ( $search ) ? $search : '',
					);
				}
			}

			if ( ( $product_post_listing == 'page_listing' || ( $MorePostOptions == 'load_more' || $MorePostOptions == 'lazy_load' || $product_post_listing == 'search_list' ) ) ) {
				$ProductName = 'product_cat';
			}

			$loaded_posts_text = ( ! empty( $settings['loaded_posts_text'] ) ) ? $settings['loaded_posts_text'] : 'All done!';
			$tp_loading_text   = ( ! empty( $settings['tp_loading_text'] ) ) ? $settings['tp_loading_text'] : 'Loading...';

			$total_posts = '';
			if ( $query->have_posts() != '' ) {
				$total_posts   = $query->found_posts;
				$post_offset   = ( $settings['post_offset'] != '' ) ? $settings['post_offset'] : 0;
				$display_posts = ( $settings['display_posts'] != '' ) ? $settings['display_posts'] : 0;
				$offset_posts  = intval( $display_posts + $post_offset );
				$total_posts   = intval( $total_posts - $offset_posts );
				if ( $total_posts != 0 && $settings['load_more_post'] != 0 ) {
					$load_page = ceil( $total_posts / $settings['load_more_post'] );
				} else {
					$load_page = 1;
				}
				$load_page = $load_page + 1;
			} else {
				$load_page = 1;
			}

			$include_products = ! empty( $settings['include_products'] ) ? $settings['include_products'] : '';
			$exclude_products = ! empty( $settings['exclude_products'] ) ? $settings['exclude_products'] : '';

			$filter_type = ! empty( $settings['product_post_listing'] ) ? $settings['product_post_listing'] : '';

			$postattr     = array();
			$data_loadkey = $serchAttr = $TotProduct = $TotCount = $recentviewAttr = $wishlistAttr = $wooAttr = $plwl = $shopName = '';

			if ( 'wishlist' === $filter_type ) {
				$shopName = 'tpwishlist';
			} else if ( 'recently_viewed' === $filter_type ) {
				$shopName = 'tpwoorpvlist';
			}

			if ( ( ( $MorePostOptions == 'load_more' || $MorePostOptions == 'lazy_load' ) && $layout != 'carousel' ) || ( $filter_type == 'search_list' ) || ( $paginationType == 'ajaxbased' ) || 'recently_viewed' === $filter_type || 'wishlist' === $filter_type ) {
				$postattr = array(
					'load'                      => 'products',
					'post_type'                 => 'product',
					// 'texonomy_category' => 'product_cat',
					'texonomy_category'         => $ProductName,
					'layout'                    => esc_attr( $layout ),
					'offset-posts'              => esc_attr( $settings['post_offset'] ),
					'offset_posts'              => esc_attr( $settings['post_offset'] ),
					'display_post'              => esc_attr( $settings['display_posts'] ),
					'post_load_more'            => esc_attr( $settings['load_more_post'] ),
					'post_title_tag'            => esc_attr( $post_title_tag ),
					'badge'                     => esc_attr( $b_dis_badge_switch ),
					'out_of_stock'              => esc_attr( $out_of_stock ),
					'style'                     => esc_attr( $style ),
					'desktop-column'            => esc_attr( $settings['desktop_column'] ),
					'tablet-column'             => esc_attr( $settings['tablet_column'] ),
					'mobile-column'             => esc_attr( $settings['mobile_column'] ),
					'metro_column'              => esc_attr( $settings['metro_column'] ),
					'metro_style'               => esc_attr( $metro_style ),
					'responsive_tablet_metro'   => esc_attr( $responsive_tablet_metro ),
					'tablet_metro_column'       => esc_attr( $tablet_metro_column ),
					'tablet_metro_style'        => esc_attr( $tablet_metro_style ),
					'category_type'             => ! empty( $settings['post_category'] ) ? true : false,
					'category'                  => esc_attr( $post_category_list ),
					'order_by'                  => esc_attr( $settings['post_order_by'] ),
					'post_order'                => esc_attr( $settings['post_order'] ),
					'filter_category'           => esc_attr( $settings['filter_category'] ),
					'animated_columns'          => esc_attr( $animated_columns ),
					'cart_button'               => esc_attr( $display_cart_button ),
					'featured_image_type'       => esc_attr( $featured_image_type ),
					'variationprice'            => esc_attr( $variation_price_on ),
					'hoverimagepro'             => esc_attr( $hover_image_on_off ),
					'display_thumbnail'         => esc_attr( $display_thumbnail ),
					'thumbnail'                 => esc_attr( $thumbnail ),
					'thumbnail_car'             => esc_attr( $thumbnail_car ),
					'display_product'           => esc_attr( $settings['display_product'] ),
					'display_catagory'          => esc_attr( $display_catagory ),
					'display_rating'            => esc_attr( $display_rating ),
					'display_yith_list'         => esc_attr( $display_yith_list ),
					'display_theplus_quickview' => esc_attr( $display_theplus_quickview ),
					'display_yith_compare'      => esc_attr( $display_yith_compare ),
					'display_yith_wishlist'     => esc_attr( $display_yith_wishlist ),
					'display_yith_quickview'    => esc_attr( $display_yith_quickview ),
					'dcb_single_product'        => esc_attr( $dcb_single_product ),
					'dcb_variation_product'     => esc_attr( $dcb_variation_product ),
					'include_posts'             => esc_attr( $include_products ),
					'exclude_posts'             => esc_attr( $exclude_products ),
					'paginationType'            => esc_attr( $paginationType ),
					'theplus_nonce'             => wp_create_nonce( 'theplus-addons' ),

					'is_search'                 => $is_search,
					'is_search_page'            => $SearchPage,
					'is_archive'                => $is_archive,
					'archive_page'              => $ArchivePage,

					'skin_template'             => $temp_array,
					'loadmoretxt'               => $settings['load_more_btn_text'],
					'No_PostFound'              => $settings['empty_posts_message'],
					'listing_type'              => $product_post_listing,
				);

				if ( 'wishlist' === $filter_type || 'recently_viewed' === $filter_type  ) {
					$postattr['shopname'] = esc_attr( $shopName );
				}

				if ( $MorePostOptions == 'pagination' ) {
					$PaginationNext = ! empty( $settings['pagination_next'] ) ? $settings['pagination_next'] : 'NEXT';
					$PaginationPrev = ! empty( $settings['pagination_prev'] ) ? $settings['pagination_prev'] : 'PREV';

					$PageArray = array(
						'page_next' => $PaginationNext,
						'page_prev' => $PaginationPrev,
					);
					$postattr  = array_merge( $postattr, $PageArray );
				}

				$data_loadkey = tp_plus_simple_decrypt( json_encode( $postattr ), 'ey' );
				$postOffset   = ! empty( $settings['post_offset'] ) ? $settings['post_offset'] : 0;
				if ( $filter_type == 'search_list' || $paginationType == 'ajaxbased' ) {
					$serchAttr  = 'data-searchAttr= \'' . json_encode( $postattr ) . '\' ';
					$TotProduct = 'data-total-result="' . $query->found_posts . '"';
					$proCount   = $query->found_posts - $postOffset;
					$TotCount   = 'data-total-count="' . $proCount . '"';
				}

				if ( 'recently_viewed' === $filter_type ) {
					$recentviewAttr = 'data-rpvlistAttr= \'' . json_encode( $postattr ) . '\' ';
				}

				if ( 'wishlist' === $filter_type ) {
					$wishlistAttr = 'data-wishlistAttr= \'' . wp_json_encode( $postattr ) . '\' ';
				}

				if ( 'recently_viewed' === $filter_type || 'wishlist' === $filter_type ) {
					$wooAttr = ' data-wooAttr= \'' . wp_json_encode( $data_loadkey ) . '\' ';
					// $wooAttr = 'data-wooAttr= ' . wp_json_encode( $data_loadkey );
					$plwl    = ' data-wid=' . esc_attr( $shopName );
				}
			}

			$ajaxclass = '';
			if ( 'ajaxbased' === $paginationType ) {
				$ajaxclass = 'tp-ajax-paginate-wrapper';
			}

			$pnfmsg_recvp = isset( $settings['pnfmsg_recvp'] ) ? $settings['pnfmsg_recvp'] : 'no';

			$output .= '<div id="' . esc_attr( $uid ) . '" class="tp-row post-inner-loop ' . esc_attr( $ajaxclass ) . ' ' . esc_attr( $uid ) . ' ' . esc_attr( $content_alignment ) . ' tp_list" ' . $plwl . ' ' . $serchAttr . ' ' . $recentviewAttr . ' ' . $wishlistAttr . ' ' . $wooAttr . ' ' . $TotProduct . ' ' . $TotCount . ' data-widgetId = ' . esc_attr( $this->get_id() ) . '>';
			if ( ! $query->have_posts() && ! empty( $product_post_listing ) && 'recently_viewed' === $product_post_listing && 'yes' === $pnfmsg_recvp ) {
				$output .= '<h3 class="theplus-posts-not-found">' . $settings['empty_posts_message'] . '</h3>';
			} else {
				while ( $query->have_posts() ) {

					$query->the_post();
					$post = $query->post;

					if ( $layout == 'metro' ) {
						$metro_columns = $settings['metro_column'];
						if ( ! empty( $settings[ 'metro_style_' . $metro_columns ] ) ) {
							$ij = theplus_metro_style_layout( $ji, $settings['metro_column'], $settings[ 'metro_style_' . $metro_columns ] );
						}
						if ( ! empty( $settings['responsive_tablet_metro'] ) && $settings['responsive_tablet_metro'] == 'yes' ) {
							$tablet_metro_column = $settings['tablet_metro_column'];
							if ( ! empty( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) ) {
								$tablet_ij          = theplus_metro_style_layout( $ji, $settings['tablet_metro_column'], $settings[ 'tablet_metro_style_' . $tablet_metro_column ] );
								$tablet_metro_class = 'tb-metro-item' . esc_attr( $tablet_ij );
							}
						}
					}
					// category filter
					$category_filter = '';
					if ( $settings['filter_category'] == 'yes' ) {
						$terms = get_the_terms( $query->ID, 'product_cat' );
						if ( $terms != null ) {
							foreach ( $terms as $term ) {
								$category_filter .= ' ' . esc_attr( $term->slug ) . ' ';
								unset( $term );
							}
						}
					}

					$template_id = '';
					if ( ! empty( $temp_array ) ) {
						$count       = count( $temp_array );
						$value       = $kij % $count;
						$template_id = $temp_array[ $value ];
					}

					// grid item loop
					$output .= '<div class="grid-item metro-item' . esc_attr( $ij ) . ' ' . esc_attr( $tablet_metro_class ) . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . $category_filter . ' ' . $animated_columns . '">';
					if ( ! empty( $style ) ) {
						ob_start();
						include THEPLUS_WSTYLES . 'product/product-' . sanitize_file_name( $style ) . '.php';
						$output .= ob_get_contents();
						ob_end_clean();
					}
					$output .= '</div>';

					++$ji;
					++$kij;
				}
			}
			$output .= '</div>';

			if ( $settings['post_extra_option'] == 'pagination' && $layout != 'carousel' ) {
				$pagination_next = ! empty( $settings['pagination_next'] ) ? $settings['pagination_next'] : 'NEXT';
				$pagination_prev = ! empty( $settings['pagination_prev'] ) ? $settings['pagination_prev'] : 'PREV';

				if ( ( $paginationType == 'ajaxbased' ) ) {
					$offsetPos    = ! empty( $settings['post_offset'] ) ? $settings['post_offset'] : 0;
					$totalPost    = $query->found_posts - $offsetPos;
					$paginatePgae = ceil( $totalPost / $display_posts );
					if ( $display_posts < $totalPost ) {
						$output     .= '<div class="theplus-pagination">';
							$output .= '<a class="paginate-prev tp-ajax-paginate tp-page-hide" href="#"><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>' . esc_attr( $PaginationPrev ) . '</a>';
						for ( $i = 1; $i <= $paginatePgae; $i++ ) {
							$Name = '';
							if ( $i == 1 ) {
								$Name = 'current';
							} elseif ( $i > 3 ) {
								$Name = 'tp-page-hide';
							}

							$output .= '<a href="#" class="tp-ajax-paginate tp-number ' . esc_attr( $Name ) . '" data-page="' . esc_attr( $i ) . '">' . $i . '</a>';
						}
							$output .= '<a class="paginate-next tp-ajax-paginate" href="#">' . esc_attr( $PaginationNext ) . '<i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></a>';
						$output     .= '</div>';
					}
				} else {
					$output .= theplus_pagination( $query->max_num_pages, '2', $pagination_next, $pagination_prev );
				}
			} elseif ( $settings['post_extra_option'] == 'load_more' && $layout != 'carousel' ) {
				if ( ! empty( $total_posts ) && $total_posts > 0 ) {

					$output     .= '<div class="ajax_load_more">';
						$output .= '<a class="post-load-more" data-layout="' . esc_attr( $layout ) . '" data-offset-posts="' . ( $settings['post_offset'] ) . '" data-load-class="' . esc_attr( $uid ) . '" data-display_post="' . esc_attr( $settings['display_posts'] ) . '" data-post_load_more="' . esc_attr( $settings['load_more_post'] ) . '" data-loaded_posts="' . esc_attr( $loaded_posts_text ) . '" data-tp_loading_text="' . esc_attr( $tp_loading_text ) . '" data-page="1" data-total_page="' . esc_attr( $load_page ) . '" data-loadattr= \'' . $data_loadkey . '\'>' . esc_html( $settings['load_more_btn_text'] ) . '</a>';
					$output     .= '</div>';
				}
			} elseif ( $settings['post_extra_option'] == 'lazy_load' && $layout != 'carousel' ) {
				if ( ! empty( $total_posts ) && $total_posts > 0 ) {
					$output     .= '<div class="ajax_lazy_load">';
						$output .= '<a class="post-lazy-load" data-load-class="' . esc_attr( $uid ) . '" data-layout="' . esc_attr( $layout ) . '" data-offset-posts="' . ( $settings['post_offset'] ) . '" data-display_post="' . esc_attr( $settings['display_posts'] ) . '"  data-post_load_more="' . esc_attr( $settings['load_more_post'] ) . '" data-page="1" data-total_page="' . esc_attr( $load_page ) . '" data-loaded_posts="' . esc_attr( $loaded_posts_text ) . '" data-tp_loading_text="' . esc_attr( $tp_loading_text ) . '" data-loadattr= \'' . $data_loadkey . '\'><div class="tp-spin-ring"><div></div><div></div><div></div><div></div></div></a>';
						$output .= '</div>';
				}
			}
			$output .= '</div>';
		}

		$css_rule = $desktop_column = $tablet_column = $mobile_column = $css_messy = '';
		if ( $settings['messy_column'] == 'yes' ) {
			if ( $layout == 'grid' || $layout == 'masonry' ) {
				$desktop_column = $settings['desktop_column'];
				$tablet_column  = $settings['tablet_column'];
				$mobile_column  = $settings['mobile_column'];
			} elseif ( $layout == 'carousel' ) {
				$desktop_column = $settings['slider_desktop_column'];
				$tablet_column  = $settings['slider_tablet_column'];
				$mobile_column  = $settings['slider_mobile_column'];
			}
			for ( $x = 1; $x <= 6; $x++ ) {
				if ( ! empty( $settings[ 'desktop_column_' . $x ] ) ) {
					$desktop    = ! empty( $settings[ 'desktop_column_' . $x ]['size'] ) ? $settings[ 'desktop_column_' . $x ]['size'] . $settings[ 'desktop_column_' . $x ]['unit'] : '';
					$tablet     = ! empty( $settings[ 'desktop_column_' . $x . '_tablet' ]['size'] ) ? $settings[ 'desktop_column_' . $x . '_tablet' ]['size'] . $settings[ 'desktop_column_' . $x . '_tablet' ]['unit'] : '';
					$mobile     = ! empty( $settings[ 'desktop_column_' . $x . '_mobile' ]['size'] ) ? $settings[ 'desktop_column_' . $x . '_mobile' ]['size'] . $settings[ 'desktop_column_' . $x . '_mobile' ]['unit'] : '';
					$css_messy .= theplus_messy_columns( $x, $layout, $uid, $desktop, $tablet, $mobile, $desktop_column, $tablet_column, $mobile_column );
				}
			}
			$css_rule = '<style>' . $css_messy . '</style>';
		}
		echo $output . $css_rule;
		wp_reset_postdata();
	}

	/**
	 * Get filter category Product Listing.
	 *
	 * @since 1.0.0
	 * @version 5.6.0
	 */
	protected function get_filter_category() {
		$settings      = $this->get_settings_for_display();
		$query_args    = $this->get_query_args();
		$query         = new \WP_Query( $query_args );
		$post_category = $settings['post_category'];

		$category_filter = '';
		if ( $settings['filter_category'] == 'yes' ) {

			$filter_style        = $settings['filter_style'];
			$filter_hover_style  = $settings['filter_hover_style'];
			$all_filter_category = ( ! empty( $settings['all_filter_category'] ) ) ? $settings['all_filter_category'] : esc_html__( 'All', 'theplus' );

			$terms        = get_terms(
				array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => true,
				)
			);
			$all_category = $category_post_count = '';

			if ( $filter_style == 'style-1' ) {
				$count        = $query->post_count;
				$all_category = '<span class="all_post_count">' . esc_html( $count ) . '</span>';
			}
			if ( $filter_style == 'style-2' || $filter_style == 'style-3' ) {
				$count               = $query->post_count;
				$category_post_count = '<span class="all_post_count">' . esc_attr( $count ) . '</span>';
			}

			$count_cate = array();
			if ( $filter_style == 'style-2' || $filter_style == 'style-3' ) {
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$categories = get_the_terms( $query->ID, 'product_cat' );
						if ( $categories ) {
							foreach ( $categories as $category ) {
								if ( isset( $count_cate[ $category->slug ] ) ) {
									$count_cate[ $category->slug ] = $count_cate[ $category->slug ] + 1;
								} else {
									$count_cate[ $category->slug ] = 1;
								}
							}
						}
					}
				}
				wp_reset_postdata();
			}

			$category_filter .= '<div class="post-filter-data ' . esc_attr( $filter_style ) . ' text-' . esc_attr( $settings['filter_category_align'] ) . '">';
			if ( $filter_style == 'style-4' ) {
				$category_filter .= '<span class="filters-toggle-link">' . esc_html__( 'Filters', 'theplus' ) . '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><g><line x1="0" y1="32" x2="63" y2="32"></line></g><polyline points="50.7,44.6 63.3,32 50.7,19.4 "></polyline><circle cx="32" cy="32" r="31"></circle></svg></span>';
			}
				$category_filter .= '<ul class="category-filters ' . esc_attr( $filter_style ) . ' hover-' . esc_attr( $filter_hover_style ) . '">';
			if ( ! empty( $settings['all_filter_category_switch'] ) && $settings['all_filter_category_switch'] == 'yes' ) {
				$category_filter .= '<li><a href="#" class="filter-category-list active all" data-filter="*" >' . $category_post_count . '<span data-hover="' . esc_attr( $all_filter_category ) . '">' . esc_html( $all_filter_category ) . '</span>' . $all_category . '</a></li>';
			}

			if ( $terms != null ) {
				foreach ( $terms as $term ) {
					$category_post_count = '';
					if ( $filter_style == 'style-2' || $filter_style == 'style-3' ) {
						if ( isset( $count_cate[ $term->slug ] ) ) {
							$count = $count_cate[ $term->slug ];
						} else {
							$count = 0;
						}
						$category_post_count = '<span class="all_post_count">' . esc_html( $count ) . '</span>';
					}
					if ( ! empty( $post_category ) ) {

						if ( in_array( $term->term_id, $post_category ) ) {
							$category_filter .= '<li><a href="#" class="filter-category-list"  data-filter=".' . esc_attr( $term->slug ) . '">' . $category_post_count . '<span data-hover="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</span></a></li>';
							unset( $term );
						}
					} else {
						$category_filter .= '<li><a href="#" class="filter-category-list"  data-filter=".' . esc_attr( $term->slug ) . '">' . $category_post_count . '<span data-hover="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</span></a></li>';
						unset( $term );
					}
				}
			}
				$category_filter .= '</ul>';
			$category_filter     .= '</div>';
		}
		return $category_filter;
	}

	/**
	 * get query args Product Listing.
	 *
	 * @since 1.0.0
	 * @version 5.6.0
	 */
	protected function get_query_args() {
		$settings        = $this->get_settings_for_display();
		$display_product = $settings['display_product'];
		$postrOffset     = ! empty( $settings['post_offset'] ) ? $settings['post_offset'] : 0;
		$terms           = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);
		$category        = array();
		$post_category   = $settings['post_category'];
		if ( $terms != null && ! empty( $post_category ) ) {
			foreach ( $terms as $term ) {
				if ( in_array( $term->term_id, $post_category ) ) {
					$category[] = $term->slug;
				}
			}
		}

		$category         = ( $category != '' ) ? implode( ',', $category ) : '';
		$include_products = ( $settings['include_products'] ) ? explode( ',', $settings['include_products'] ) : array();
		$exclude_products = ( $settings['exclude_products'] ) ? explode( ',', $settings['exclude_products'] ) : array();
		$query_args       = array(
			'post_type'           => 'product',
			'product_cat'         => $category,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $settings['display_posts'] ),
			'orderby'             => $settings['post_order_by'],
			'order'               => $settings['post_order'],
			'post__not_in'        => $exclude_products,
			'post__in'            => $include_products,
			'tax_query'           => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'exclude-from-search', 'exclude-from-catalog' ),
					'operator' => 'NOT IN',
				),
			),
		);
		// Related Posts
		if ( ! empty( $settings['product_post_listing'] ) && $settings['product_post_listing'] == 'related_product' ) {
			global $post;
			$category_args = array();
			$tags_args     = array();
			$tags          = get_the_terms( $post->ID, 'product_tag' );
			if ( $tags && ! empty( $settings['related_product_by'] ) && ( $settings['related_product_by'] == 'both' || $settings['related_product_by'] == 'tags' ) ) {
				$tag_ids = array();
				foreach ( $tags as $term ) {
					$tag_ids[] = $term->term_id;
				}
				$tags_args = array(
					'taxonomy' => 'product_tag',
					'field'    => 'id',
					'terms'    => $tag_ids,
				);
			}

			$categories = wp_get_post_terms( $post->ID, 'product_cat' );
			if ( $categories && ! empty( $settings['related_product_by'] ) && ( $settings['related_product_by'] == 'both' || $settings['related_product_by'] == 'category' ) ) {
				$category_ids = array();
				foreach ( $categories as $key => $term ) {
					$check_for_children = get_categories(
						array(
							'parent'   => $term->term_id,
							'taxonomy' => 'product_cat',
						)
					);
					if ( empty( $check_for_children ) ) {
						$category_ids[] = $term->term_id;
					}
				}
				$category_args = array(
					'taxonomy' => 'product_cat',
					'field'    => 'id',
					'terms'    => $category_ids,
				);
			}

			// @since v5.0.11
			$query_args['tax_query']    = array(
				'relation' => 'OR',
				$category_args,
				$tags_args,
			);
			$query_args['post__not_in'] = array( $post->ID );
		}

		// upsells
		if ( ! empty( $settings['product_post_listing'] ) && $settings['product_post_listing'] == 'upsell' ) {

				global $product;
			if ( ! $product ) {
				return;
			}
				$upsells = $product->get_upsell_ids();
			if ( ! empty( $upsells ) ) {
				$query_args['post__in'] = array_values( $upsells );
			} else {
				$query_args['post__in'] = array( '0' );
			}
		}

		// crosssells
		if ( ! empty( $settings['product_post_listing'] ) && $settings['product_post_listing'] == 'cross_sells' ) {
			global $product;
			if ( ! $product ) {
				return;
			}
			$crosssells = $product->get_cross_sell_ids();
			if ( ! empty( $crosssells ) ) {
				$query_args['post__in'] = array_values( $crosssells );
			} else {
				$query_args['post__in'] = array( '0' );
			}

			// $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);
		}

		/** Wishlist*/
		if ( ! empty( $settings['product_post_listing'] ) && ( 'wishlist' === $settings['product_post_listing'] || 'recently_viewed' === $settings['product_post_listing'] ) ) {
			$whishlist = array();
			if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				$whishlist = array( '0' );
			}
			$query_args['post__in'] = $whishlist;
		}

		$hide_outofstock_product = isset( $settings['hide_outofstock_product'] ) ? $settings['hide_outofstock_product'] : 'no';

		// Archive Products
		if ( ! empty( $settings['product_post_listing'] ) && $settings['product_post_listing'] == 'archive_listing' ) {
			global $wp_query;
			$query_var = $wp_query->query_vars;

			if ( ! empty( $query_var['taxonomy'] ) && ( $query_var['taxonomy'] == 'product_cat' || $query_var['taxonomy'] == 'product_tag' ) ) {
				if ( isset( $query_var['product_cat'] ) ) {
					$query_args['product_cat'] = $query_var['product_cat'];
				}
				if ( isset( $query_var['product_tag'] ) ) {
					$query_args['product_tag'] = $query_var['product_tag'];
				}
			} elseif ( isset( $query_var['taxonomy'] ) ) {
					$query_args[ $query_var['taxonomy'] ] = $query_var[ $query_var['taxonomy'] ];
			}
			if ( is_search() ) {
				$search              = get_query_var( 's' );
				$query_args['s']     = $search;
				$query_args['exact'] = false;
			}

			if ( isset( $hide_outofstock_product ) && $hide_outofstock_product == 'yes' ) {
				$query_args['meta_query'] = array(
					array(
						'key'   => '_stock_status',
						'value' => 'instock',
					),
				);
			}
		} elseif ( ! empty( $settings['product_post_listing'] ) && $settings['product_post_listing'] == 'search_list' ) {
			if ( is_archive() ) {
				global $wp_query;
				$query_var = $wp_query->query_vars;
				if ( ! empty( $query_var['taxonomy'] ) && ( $query_var['taxonomy'] == 'product_cat' || $query_var['taxonomy'] == 'product_tag' ) ) {
					if ( isset( $query_var['product_cat'] ) ) {
						$query_args['product_cat'] = $query_var['product_cat'];
					}
					if ( isset( $query_var['product_tag'] ) ) {
						$query_args['product_tag'] = $query_var['product_tag'];
					}
				} elseif ( isset( $query_var['taxonomy'] ) ) {
						$query_args[ $query_var['taxonomy'] ] = $query_var[ $query_var['taxonomy'] ];
				}
			}

			if ( is_search() ) {
				$search              = get_query_var( 's' );
				$query_args['s']     = $search;
				$query_args['exact'] = false;
			}
		}

		$offset = $settings['post_offset'];
		$offset = ! empty( $offset ) ? absint( $offset ) : 0;

		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		if ( $settings['post_extra_option'] != 'pagination' ) {
			$query_args['offset'] = $offset;
		} elseif ( $settings['post_extra_option'] == 'pagination' ) {
			$query_args['paged']  = $paged;
			$page                 = max( 1, $paged );
			$offset               = ( $page - 1 ) * intval( $settings['display_posts'] ) + $offset;
			$query_args['offset'] = $offset;
		}
		// $query_args['offset'] = 1;

		if ( ! isset( $display_product ) || $display_product == '' ) {
			$display_product = 'all';
		}

		switch ( $display_product ) {
			case 'recent':
				$query_args['meta_query'] = WC()->query->get_meta_query();
				break;
			case 'featured':
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				);
				break;
			case 'on_sale':
				global $woocommerce;
				$sale_product_ids         = wc_get_product_ids_on_sale();
				$meta_query               = array();
				$meta_query[]             = $woocommerce->query->visibility_meta_query();
				$meta_query[]             = $woocommerce->query->stock_status_meta_query();
				$query_args['meta_query'] = $meta_query;
				$query_args['post__in']   = $sale_product_ids;
				break;
			case 'top_rated':
				add_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
				$query_args['meta_query'] = WC()->query->get_meta_query();
				break;
			case 'top_sales':
				$query_args['meta_key']   = 'total_sales';
				$query_args['orderby']    = 'meta_value_num';
				$query_args['meta_query'] = array(
					array(
						'key'     => 'total_sales',
						'value'   => 0,
						'compare' => '>',
					),
				);
				break;
			case 'instock':
				$query_args['meta_query'] = array(
					array(
						'key'   => '_stock_status',
						'value' => 'instock',
					),
				);
				break;
			case 'outofstock':
				$query_args['meta_query'] = array(
					array(
						'key'   => '_stock_status',
						'value' => 'outofstock',
					),
				);
				break;
		}

		return $query_args;
	}

	/**
	 * Render Carousel Options
	 *
	 * @since 2.0.0
	 * @version 5.5.3
	 */
	protected function get_carousel_options() {
		return include THEPLUS_PATH . 'modules/widgets/theplus-carousel-options.php';
	}
}
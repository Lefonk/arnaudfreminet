<?php
/**
 * Widget Name: Woo Single Image
 * Description: Woo Single Image
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
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Woo_Single_Image
 */
class ThePlus_Woo_Single_Image extends Widget_Base {

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

	/**
	 * Get Widget Name
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-woo-single-image';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Woo Product Images', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-file-image-o theplus_backend_icon';
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
	 * Get Widget Categories
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Single Basic, woocomerce', 'theplus', 'single product', 'product gallery', 'feature image', 'thumbnail', 'post', 'product' );
	}

	/**
	 * Register controls
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Start*/
		$this->start_controls_section(
			'section_woo_single_image',
			array(
				'label' => esc_html__( 'Layout', 'theplus' ),
			)
		);
		$this->add_control(
			'select',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'product_gallery',
				'options' => array(
					'product_gallery' => esc_html__( 'Image Gallery', 'theplus' ),
					'single_product'  => esc_html__( 'Single Image', 'theplus' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'single_product_thumbnail',
				'default'   => 'full',
				'condition' => array(
					'select' => 'single_product',
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
				'default'      => 'no',
				'separator'    => 'before',
				'condition'    => array(
					'select' => 'single_product',
				),
			)
		);
		$this->add_control(
			'on_image_link',
			array(
				'label'     => esc_html__( 'Link', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select' => 'single_product',
				),
			)
		);
		$this->add_control(
			'select_pg_style',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style_1',
				'options'   => array(
					'style_1' => esc_html__( 'Style 1', 'theplus' ),
					'style_3' => esc_html__( 'Style 2', 'theplus' ),
				),
				'condition' => array(
					'select' => 'product_gallery',
				),
			)
		);
		$this->add_control(
			'select_pg_thumb',
			array(
				'label'     => esc_html__( 'Thumbnail Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tp_pg_thumb_pos_d',
				'options'   => array(
					'tp_pg_thumb_pos_d' => esc_html__( 'Default', 'theplus' ),
					'tp_pg_thumb_pos_l' => esc_html__( 'Left', 'theplus' ),
					'tp_pg_thumb_pos_r' => esc_html__( 'Right', 'theplus' ),
				),
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_1',
				),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'     => esc_html__( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grid',
				'options'   => theplus_get_list_layout_style(),
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
				),
			)
		);
		$this->add_control(
			'src_image_type',
			array(
				'label'     => esc_html__( 'Image Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'full',
				'options'   => array(
					'full' => esc_html__( 'Full Image', 'theplus' ),
					'grid' => esc_html__( 'Grid Image', 'theplus' ),
				),
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
					'layout'          => array( 'carousel' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'columns_section',
			array(
				'label'     => esc_html__( 'Columns Manage', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
					'layout!'         => array( 'carousel' ),
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
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_opt_section',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
				),
			)
		);
		$this->add_control(
			'tp_enable_video',
			array(
				'label'     => esc_html__( 'Video', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
				),
			)
		);
		$this->add_control(
			'tp_enable_video_pos',
			array(
				'label'     => esc_html__( 'Video Location', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'first',
				'options'   => array(
					'first' => esc_html__( 'First', 'theplus' ),
					'last'  => esc_html__( 'Last', 'theplus' ),
				),
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
					'tp_enable_video' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_image_styling',
			array(
				'label'     => esc_html__( 'Image Box', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mm_image' );
		$this->start_controls_tab(
			'tab_image_box_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'image_box_filters',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_box_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro',
			)
		);
		$this->add_responsive_control(
			'image_box_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_box_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'image_box_filters_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img:hover,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_box_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img:hover,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro:hover',
			)
		);
		$this->add_responsive_control(
			'image_box_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img:hover,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item img:hover,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery.list-isotope-metro .post-inner-loop .grid-item .woo-gallery-bg-image-metro:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_video_styling',
			array(
				'label'     => esc_html__( 'Video', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
					'tp_enable_video' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mm_video' );
		$this->start_controls_tab(
			'tab_video_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'video_filters',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'video_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper',
			)
		);
		$this->add_responsive_control(
			'video_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'video_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_video_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'video_filters_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'video_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'video_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'video_shadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_3 .tp-woo-gallery .post-inner-loop .grid-item .tp-wc-video_wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
					'layout'          => 'carousel',
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
						'min'  => -200,
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
					'{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});',
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
				'selector'  => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center .blog-list-content',
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
					'{{WRAPPER}} .list-carousel-slick .slick-slide:not(.slick-center)' => 'opacity:{{SIZE}}',
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
					'tablet_slider_dots' => array( 'yes' ),
					'slider_responsive_tablet' => 'yes'
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
					'slider_responsive_tablet' => 'yes'
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
					'slider_responsive_tablet' => 'yes'
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
					'slider_responsive_tablet' => 'yes'
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
					'slider_responsive_tablet' => 'yes'
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
					'tablet_slider_dots' => 'yes',
					'slider_responsive_tablet' => 'yes'
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
					'tablet_slider_dots' => 'yes',
					'slider_responsive_tablet' => 'yes'
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
					'tablet_slider_arrows' => array( 'yes' ),
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
					'slider_responsive_tablet' => 'yes',
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
					'slider_responsive_tablet' => 'yes',
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
					'slider_responsive_tablet' => 'yes',
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
					'slider_responsive_tablet' => 'yes',
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
					'slider_responsive_tablet' => 'yes',
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
					'slider_responsive_tablet' => 'yes',
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
					'tablet_slider_arrows' => 'yes',
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
					'mobile_slider_dots' => array( 'yes' ),
					'slider_responsive_mobile' => 'yes'
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
					$this->slick_mobile . '.slick-dots.style-1 li button,'. $this->slick_mobile . '.slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
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
					'slider_responsive_mobile' => 'yes'
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
					$this->slick_mobile . '.slick-dots.style-2 li button,' .$this->slick_mobile . 'ul.slick-dots.style-3 li button,' .$this->slick_mobile . '.slick-dots.style-4 li button:before,' .$this->slick_mobile . '.slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mobile_slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'mobile_slider_dots'       => 'yes',
					'slider_responsive_mobile' => 'yes'
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
					'slider_responsive_mobile' => 'yes'
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
					'slider_responsive_mobile' => 'yes'
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
					'mobile_slider_dots' => 'yes',
					'slider_responsive_mobile' => 'yes'
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
					'mobile_slider_dots' => 'yes',
					'slider_responsive_mobile' => 'yes'
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
					'mobile_slider_arrows' => array( 'yes' ),
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
					'mobile_slider_arrows'       => array( 'yes' ),
					'mobile_slider_arrows_style' => array( 'style-3', 'style-4' ),
					'slider_responsive_mobile' => 'yes',

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
					'slider_responsive_mobile' => 'yes',
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
					'slider_responsive_mobile' => 'yes',
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
					'slider_responsive_mobile' => 'yes',
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
					'slider_responsive_mobile' => 'yes',
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
					'slider_responsive_mobile' => 'yes',
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
					'mobile_slider_arrows' => 'yes',
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

		$this->start_controls_section(
			'section_single_image_styling',
			array(
				'label'     => esc_html__( 'Image', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select' => 'single_product',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_s_image' );
		$this->start_controls_tab(
			'tab_s_image_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 's_image_css',
				'selector' => '{{WRAPPER}} .tp-woo-single-image img',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's_image_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image',
			)
		);
		$this->add_responsive_control(
			's_image_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's_image_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-image',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_s_image_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 's_image_css_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-image:hover img',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's_image_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image:hover',
			)
		);
		$this->add_responsive_control(
			's_image_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's_image_shadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-image:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_m_gal_img_styling',
			array(
				'label'     => esc_html__( 'Main Image', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'm_gal_img_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-viewport',
			)
		);
		$this->add_responsive_control(
			'm_gal_img_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'm_gal_img_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-viewport',
			)
		);
		$this->add_control(
			'm_gal_img_zoom_heading',
			array(
				'label'     => esc_html__( 'Zoom Icon Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'm_gal_img_zoom_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__trigger::before' => 'border:2px solid {{VALUE}}',
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__trigger::after' => 'background:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'm_gal_img_zoom_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__trigger',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'm_gal_img_zoom_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__trigger',
			)
		);
		$this->add_responsive_control(
			'm_gal_img_zoom_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'm_gal_img_zoom_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .woocommerce-product-gallery__trigger',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_thumb_gal_img_styling',
			array(
				'label'     => esc_html__( 'Thumbnail', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_1',
				),
			)
		);
		$this->add_responsive_control(
			'tgi_space_d',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 60,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs li' => 'padding-right: calc({{SIZE}}{{UNIT}} / 2);
					padding-left: calc({{SIZE}}{{UNIT}} / 2);padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tgi_style' );
		$this->start_controls_tab(
			'tab_tgi_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			't_gal_img_opacity',
			array(
				'label'      => esc_html__( 'Opacity', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img' => 'opacity: {{SIZE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'label'    => esc_html__( 'CSS Filter', 'theplus' ),
				'name'     => 't_gal_img_css_filters',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 't_gal_img_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img',
			)
		);
		$this->add_responsive_control(
			't_gal_img_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 't_gal_img_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tgi_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			't_gal_img_opacity_act',
			array(
				'label'      => esc_html__( 'Opacity', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img.flex-active,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img:hover' => 'opacity: {{SIZE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'label'    => esc_html__( 'CSS Filter', 'theplus' ),
				'name'     => 't_gal_img_css_filters_act',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img.flex-active,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 't_gal_img_border_act',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img.flex-active,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img:hover',
			)
		);
		$this->add_responsive_control(
			't_gal_img_radius_act',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img.flex-active,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 't_gal_img_shadow_act',
				'selector' => '{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img.flex-active,
				{{WRAPPER}} .tp-woo-single-image.tp-pg-style_1 .flex-control-thumbs img:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_options_styling',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select'          => 'product_gallery',
					'select_pg_style' => 'style_3',
				),
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
				'separator' => 'before',
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
	}

	/**
	 * Render Woo Single Image
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		if ( class_exists( 'woocommerce' ) ) {
			$select = ! empty( $settings['select'] ) ? $settings['select'] : 'product_gallerys';

			$select_pg_style = ! empty( $settings['select_pg_style'] ) ? $settings['select_pg_style'] : 'style_1';
			$select_pg_thumb = ! empty( $settings['select_pg_thumb'] ) ? $settings['select_pg_thumb'] : 'tp_pg_thumb_pos_d';
			$sp_thumbnail    = $settings['single_product_thumbnail_size'];

			$hover_image_on_off = ! empty( $settings['hover_image_on_off'] ) ? $settings['hover_image_on_off'] : '';

			$hover_image_class = '';
			if ( 'single_product' === $select && 'yes' === $hover_image_on_off ) {
				$hover_image_class = 'tp-on-hover-image';
			}

			$uid = uniqid( 'tp' );

			global $product;
			$product = wc_get_product();

			if ( empty( $product ) ) {
				return;
			}

			$product_id     = $product->get_image_id();
			$attachment_ids = $product->get_gallery_image_ids();

			$select_pg_style_o   = '';
			$select_pg_thumb_pos = '';
			if ( 'product_gallery' === $select ) {
				if ( ! empty( $select_pg_style ) ) {
					$select_pg_style_o = 'tp-pg-' . $select_pg_style;
					if ( ! empty( $select_pg_thumb ) ) {
						$select_pg_thumb_pos = $select_pg_thumb;
					}
				}
			}

			echo '<div class="tp-woo-single-image ' . esc_attr( $select_pg_style_o ) . ' ' . esc_attr( $select_pg_thumb_pos ) . ' ' . $hover_image_class . '">';

			/** Single Product Start*/
			if ( 'single_product' === $select ) {
				$attachment_ids = $product->get_gallery_image_ids();

				// if ($attachment_ids) {
				if ( isset( $settings['on_image_link'] ) && 'yes' === $settings['on_image_link'] ) {
					echo '<a href="' . esc_url( get_the_permalink() ) . '">';
				}
				if ( ! empty( $hover_image_on_off ) && 'yes' === $hover_image_on_off && ! empty( $attachment_ids ) ) {
					echo '<span class="product-image hover-image">' . tp_get_image_rander( $attachment_ids[0], $sp_thumbnail ) . '</span>';
				}

					echo tp_get_image_rander( get_post_thumbnail_id(), $sp_thumbnail );

				if ( isset( $settings['on_image_link'] ) && 'yes' === $settings['on_image_link'] ) {
					echo '</a>';
				}
				// }
			}

			/** Single Product Gallery Start*/
			if ( 'product_gallery' === $select ) {

				/** Single Product Gallery Style-1 Start*/
				if ( ! empty( $select_pg_style ) && 'style_1' === $select_pg_style ) {
					wc_get_template( 'single-product/product-image.php' );
				}

				/** Single Product Gallery Style-3 Start*/
				if ( 'product_gallery' === $select && ( ! empty( $select_pg_style ) && 'style_3' === $select_pg_style ) ) {
					$layout = $settings['layout'];

					/** Comlums*/
					$desktop_class = '';
					$tablet_class  = '';
					$mobile_class  = '';
					if ( 'carousel' !== $layout && 'metro' !== $layout ) {
						$desktop_class = 'tp-col-lg-' . esc_attr( $settings['desktop_column'] );
						$tablet_class  = 'tp-col-md-' . esc_attr( $settings['tablet_column'] );
						$mobile_class  = 'tp-col-sm-' . esc_attr( $settings['mobile_column'] );
						$mobile_class .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
					}

					/** Layout*/
					$layout_attr = '';
					$data_class  = '';
					if ( ! empty( $layout ) ) {
						$data_class .= theplus_get_layout_list_class( $layout );
						$layout_attr = theplus_get_layout_list_attr( $layout );
					} else {
						$data_class .= ' list-isotope';
					}

					if ( 'metro' === $layout ) {
						$postid = '';
						$metro3 = ! empty( $settings['metro_style_3'] ) ? $settings['metro_style_3'] : '';
						$metro4 = ! empty( $settings['metro_style_4'] ) ? $settings['metro_style_4'] : '';
						$metro5 = ! empty( $settings['metro_style_5'] ) ? $settings['metro_style_5'] : '';
						$metro6 = ! empty( $settings['metro_style_6'] ) ? $settings['metro_style_6'] : '';

						$metro_columns  = ! empty( $settings['metro_column'] ) ? $settings['metro_column'] : 3;
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
						if ( ! empty( $settings['responsive_tablet_metro'] ) && 'yes' === $settings['responsive_tablet_metro'] ) {
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

					$output      = '';
					$data_attr   = '';
					$outputvideo = '';

					$carousel_slider    = '';
					$carousel_direction = '';

					/** Carousel*/
					if ( 'carousel' === $layout ) {
						if ( ! empty( $settings['hover_show_dots'] ) && 'yes' === $settings['hover_show_dots'] ) {
							$data_class .= ' hover-slider-dots';
						}

						if ( ! empty( $settings['hover_show_arrow'] ) && 'yes' === $settings['hover_show_arrow'] ) {
							$data_class .= ' hover-slider-arrow';
						}

						if ( ! empty( $settings['outer_section_arrow'] ) && 'yes' === $settings['outer_section_arrow'] && ( 'style-1' === $settings['slider_arrows_style'] || 'style-2' === $settings['slider_arrows_style'] || 'style-5' === $settings['slider_arrows_style'] || 'style-6' === $settings['slider_arrows_style'] ) ) {
							$data_class .= ' outer-slider-arrow';
						}

						$data_attr .= $this->get_carousel_options();
						if ( 'style-3' === $settings['slider_arrows_style'] || 'style-4' === $settings['slider_arrows_style'] ) {
							$data_class .= ' ' . $settings['arrows_position'];
						}

						if ( ( $settings['slider_rows'] > 1 ) || ( $settings['tablet_slider_rows'] > 1 ) || ( $settings['mobile_slider_rows'] > 1 ) ) {
							$data_class .= ' multi-row';
						}

						$carousel_direction = ! empty( $settings['carousel_direction'] ) ? $settings['carousel_direction'] : 'ltr';

						if ( ! empty( $carousel_direction ) ) {
							$carousel_data = array(
								'carousel_direction' => $carousel_direction,
							);

							$carousel_slider = 'data-result="' . htmlspecialchars( wp_json_encode( $carousel_data, true ), ENT_QUOTES, 'UTF-8' ) . '"';
						}
					}

					$ji  = 1;
					$ij  = '';
					$uid = uniqid( 'post' );
					if ( ! empty( $settings['carousel_unique_id'] ) ) {
						$uid = 'tpca_' . $settings['carousel_unique_id'];
					}

					$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
					$tablet_ij  = '';

					$tablet_metro_class = '';

					$output     .= '<div id="tp-woo-gallery" class="tp-woo-gallery ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' " ' . $layout_attr . ' ' . $data_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-enable-isotope="1">';
						$output .= '<div id="' . esc_attr( $uid ) . '" class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ">';

						$dyna_cat_check = theplus_get_option( 'general', 'check_elements' );
						$check_category = get_option( 'theplus_api_connection_data' );

					if ( isset( $dyna_cat_check ) && ! empty( $dyna_cat_check ) && in_array( 'tp_woo_single_image', $dyna_cat_check ) && ! empty( $check_category['theplus_custom_field_video_switch'] ) ) {
						if ( ! empty( $settings['tp_enable_video'] ) && 'yes' === $settings['tp_enable_video'] ) {

							if ( ! empty( $layout ) && 'metro' === $layout ) {
											$metro_columns = $settings['metro_column'];
								if ( ! empty( $settings[ 'metro_style_' . $metro_columns ] ) ) {
									$ij = theplus_metro_style_layout( $ji, $settings['metro_column'], $settings[ 'metro_style_' . $metro_columns ] );
								}
								if ( ! empty( $settings['responsive_tablet_metro'] ) && 'yes' === $settings['responsive_tablet_metro'] ) {
									$tablet_metro_column = $settings['tablet_metro_column'];
									if ( ! empty( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) ) {
										$tablet_ij          = theplus_metro_style_layout( $ji++, $settings['tablet_metro_column'], $settings[ 'tablet_metro_style_' . $tablet_metro_column ] );
										$tablet_metro_class = 'tb-metro-item' . esc_attr( $tablet_ij );
									}
								}
							}

							$outputvideo .= '<div class="grid-item metro-item' . esc_attr( $ij ) . ' ' . esc_attr( $tablet_metro_class ) . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ">';
							$outputvideo .= '<div class="tp-wc-video_wrapper">
												<iframe frameborder="0" width="100%" height="100%" src="' . get_post_meta( get_the_id(), 'theplus_custom_field_video', true ) . '" autoplay="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen >
												</iframe></div>';
							$outputvideo .= '</div>';
						}
					}
					if ( isset( $dyna_cat_check ) && ! empty( $dyna_cat_check ) && in_array( 'tp_woo_single_image', $dyna_cat_check ) && ! empty( $check_category['theplus_custom_field_video_switch'] ) ) {
						if ( ! empty( $settings['tp_enable_video'] ) && 'yes' === $settings['tp_enable_video'] ) {
							if ( ! empty( $settings['tp_enable_video_pos'] ) && 'first' === $settings['tp_enable_video_pos'] ) {
								$output .= $outputvideo;
							}
						}
					}

					/** Video*/
					$featured_image = '';
					if ( ! empty( $attachment_ids ) ) {
						foreach ( $attachment_ids as $attachment_id ) {
							if ( ! empty( $layout ) && 'metro' === $layout ) {
								$metro_columns = $settings['metro_column'];
								if ( ! empty( $settings[ 'metro_style_' . $metro_columns ] ) ) {
									$ij = theplus_metro_style_layout( $ji, $settings['metro_column'], $settings[ 'metro_style_' . $metro_columns ] );
								}
								if ( ! empty( $settings['responsive_tablet_metro'] ) && 'yes' === $settings['responsive_tablet_metro'] ) {
									$tablet_metro_column = $settings['tablet_metro_column'];
									if ( ! empty( $settings[ 'tablet_metro_style_' . $tablet_metro_column ] ) ) {
										$tablet_ij          = theplus_metro_style_layout( $ji++, $settings['tablet_metro_column'], $settings[ 'tablet_metro_style_' . $tablet_metro_column ] );
										$tablet_metro_class = 'tb-metro-item' . esc_attr( $tablet_ij );
									}
								}
							}

										$output .= '<div class="grid-item metro-item' . esc_attr( $ij ) . ' ' . esc_attr( $tablet_metro_class ) . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ">';

										// $featured_image = wp_get_attachment_image_src( $attachment_id );
										$featured_image = tp_get_image_rander( $attachment_id, 'full', array(), 'post' );

										$lazyclass = '';
							if ( ! empty( $layout ) && 'metro' === $layout ) {
								$featured_image = wp_get_attachment_image_src( $attachment_id, 'full' );
								if ( tp_has_lazyload() ) {
									$lazyclass = ' lazy-background';
								}
								$featured_image = 'style="background:url(' . esc_url( $featured_image[0] ) . ') #f7f7f7;" ';
								$featured_image = '<div class="woo-gallery-bg-image-metro ' . esc_attr( $lazyclass ) . '" ' . $featured_image . '></div>';
							}

							if ( ! empty( $layout ) && 'grid' === $layout ) {
								$featured_image = tp_get_image_rander( $attachment_id, 'tp-image-grid' );
							} elseif ( ! empty( $layout ) && 'masonry' === $layout ) {
								$featured_image = tp_get_image_rander( $attachment_id, 'full' );
							} elseif ( ! empty( $layout ) && 'carousel' === $layout ) {
								if ( ! empty( $settings['src_image_type'] ) && 'grid' === $settings['src_image_type'] ) {
									$featured_image = tp_get_image_rander( $attachment_id, 'tp-image-grid' );
								} elseif ( ! empty( $settings['src_image_type'] ) && 'full' === $settings['src_image_type'] ) {
									$featured_image = tp_get_image_rander( $attachment_id, 'full' );
								}

								$featured_image = $featured_image;
							}

										$output .= $featured_image;
										$output .= '</div>';
										++$ij;
						}
					} else {
						echo '<div id="tp-woo-gallery" class="tp-woo-gallery ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' " ' . $layout_attr . ' ' . $data_attr . '  data-enable-isotope="1">';
						echo '<div id="' . esc_attr( $uid ) . '" class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ">';
						echo '<div class="grid-item metro-item' . esc_attr( $ij ) . ' ' . esc_attr( $tablet_metro_class ) . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ">';

						$attachment_ids = $product->get_gallery_image_ids();
						if ( ! empty( $layout ) && 'grid' === $layout ) {
							echo tp_get_image_rander( get_post_thumbnail_id(), 'tp-image-grid' );
						} elseif ( ! empty( $layout ) && 'masonry' === $layout ) {
							echo tp_get_image_rander( get_post_thumbnail_id(), 'full' );
						} elseif ( ! empty( $layout ) && 'carousel' === $layout ) {
							echo tp_get_image_rander( get_post_thumbnail_id(), 'full' );
						}

						echo '</div>';
						echo '</div>';
						echo '</div>';
					}

					++$ji;

					if ( isset( $dyna_cat_check ) && ! empty( $dyna_cat_check ) && in_array( 'tp_woo_single_image', $dyna_cat_check ) && ! empty( $check_category['theplus_custom_field_video_switch'] ) ) {
						if ( ! empty( $settings['tp_enable_video'] ) && 'yes' === $settings['tp_enable_video'] ) {
							if ( ! empty( $settings['tp_enable_video_pos'] ) && 'last' === $settings['tp_enable_video_pos'] ) {
								$output .= $outputvideo;
							}
						}
					}

					$output .= '</div>';
					$output .= '</div>';

					$css_rule  = '';
					$css_messy = '';
					if ( 'yes' === $settings['messy_column'] ) {
						if ( 'grid' === $layout || 'masonry' === $layout ) {
							$desktop_column = $settings['desktop_column'];
							$tablet_column  = $settings['tablet_column'];
							$mobile_column  = $settings['mobile_column'];
						} elseif ( 'carousel' === $layout ) {
							$desktop_column = $settings['slider_desktop_column'];
							$tablet_column  = $settings['slider_tablet_column'];
							$mobile_column  = $settings['slider_mobile_column'];
						}
						if ( 'metro' !== $layout ) {
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
					}

					echo $output . $css_rule;
					wp_reset_postdata();

				}

				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
					<script type='text/javascript'>
						jQuery( '.woocommerce-product-gallery' ).each( function() {
							jQuery( this ).wc_product_gallery();
						} );
					</script> 
					<?php
				} elseif ( wp_doing_ajax() ) {
					?>
					<script type='text/javascript'>
						jQuery( '.woocommerce-product-gallery' ).each( function() {
							jQuery( this ).wc_product_gallery();
						} );
					</script> 
					<?php
				}
			}

			echo '</div>';
		}
	}

	/**
	 * Render Carousel
	 *
	 * @since 5.0.0
	 * @version 5.5.3
	 */
	protected function get_carousel_options() {
		return include THEPLUS_PATH . 'modules/widgets/theplus-carousel-options.php';
	}
}
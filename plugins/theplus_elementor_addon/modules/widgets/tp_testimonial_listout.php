<?php
/*
Widget Name: Testimonial Carousel
Description: Different style of testimonial.
Author: Theplus
Author URI: https://posimyth.com
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

class ThePlus_Testimonial_ListOut extends Widget_Base {

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
		return 'tp-testimonial-listout';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'theplus' );
	}

	public function get_icon() {
		return 'fa fa-users theplus_backend_icon';
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
		return array( 'testimonial', 'feedback', 'customer review', 'client comment', 'tp', 'theplus' );
	}

	/**
	 * Update is_reload_preview_required.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
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
			'style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list( 4 ),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'theplus' ),
					'masonry'  => esc_html__( 'Masonry', 'theplus' ),
					'carousel' => esc_html__( 'Carousel', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-testimonials-in-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'grid' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_Masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-testimonials-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'masonry' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_carousel',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-testimonial-carousel-slider-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'content_alignment_4',
			array(
				'label'       => esc_html__( 'Content Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'left',
				'condition'   => array(
					'style' => 'style-4',
				),
				'label_block' => false,
				'toggle'      => true,
			)
		);
		$this->add_control(
			'style4separator',
			array(
				'type'      => Controls_Manager::DIVIDER,
				'condition' => array( 'style' => 'style-4' ),
			)
		);
		$this->add_control(
			'style_3_layout',
			array(
				'label'     => esc_html__( 'Style Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => theplus_get_style_list( 2 ),
				'separator' => 'after',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'tlContentFrom',
			array(
				'label'   => esc_html__( 'Select Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tlcontent',
				'options' => array(
					'tlcontent'  => esc_html__( 'Post Type', 'theplus' ),
					'tlrepeater' => esc_html__( 'Repeater', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_Post_Type',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-testimonials-with-custom-post-type-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'tlContentFrom' => array( 'tlcontent' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'testiAuthor',
			array(
				'label'       => esc_html__( 'Testimonial Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Testimonial Content', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'testiTitle',
			array(
				'label'       => esc_html__( 'Testimonial Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Testimonial Title', 'theplus' ),
			)
		);
		$repeater->add_control(
			'testiLabel',
			array(
				'label'       => esc_html__( 'Author Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Author Name', 'theplus' ),
			)
		);
		$repeater->add_control(
			'testiDesign',
			array(
				'label'       => esc_html__( 'Author Designation', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Designation', 'theplus' ),
			)
		);
		$repeater->add_control(
			'testiImage',
			array(
				'label'   => esc_html__( 'Author Image', 'theplus' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'testiLogo',
			array(
				'label'   => esc_html__( 'Company Logo', 'theplus' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'testiLogoNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : This is just for style 4.',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'testiAllList',
			array(
				'label'       => esc_html__( 'Manage Testimonials', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'testiAuthor' => 'I have been using the software from XYZ Business for a few weeks now and it has exceeded my expectations. It is user-friendly, efficient, and the customer support team is always available to help. Highly recommend this software!',
						'testiTitle'  => 'Outstanding Support',
						'testiLabel'  => 'Emily Thompson',
						'testiDesign' => 'CEO of CodeCraft Inc.',
					),
					array(
						'testiAuthor' => 'I have been using the software from XYZ Business for a few weeks now and it has exceeded my expectations. It is user-friendly, efficient, and the customer support team is always available to help. Highly recommend this software!',
						'testiTitle'  => 'Improved Productivity',
						'testiLabel'  => 'Benjamin Reed',
						'testiDesign' => 'Founder of X Community',
					),
					array(
						'testiAuthor' => 'I have been using the software from XYZ Business for a few weeks now and it has exceeded my expectations. It is user-friendly, efficient, and the customer support team is always available to help. Highly recommend this software!',
						'testiTitle'  => 'Highly recommend',
						'testiLabel'  => 'Rachel Johnson',
						'testiDesign' => 'COO of AppFinity Solutions',
					),
				),
				'title_field' => '{{{ testiLabel }}}',
				'condition'   => array(
					'tlContentFrom' => 'tlrepeater',
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
					'layout!' => array( 'carousel' ),
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
					'layout!' => array( 'carousel' ),
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
					'layout!' => array( 'carousel' ),
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
					'{{WRAPPER}} .testimonial-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/*columns*/
		$this->start_controls_section(
			'content_source_section',
			array(
				'label'     => esc_html__( 'Content Source', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'tlContentFrom!' => 'tlrepeater',
				),
			)
		);
		$this->add_control(
			'post_category',
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Select Category', 'theplus' ),
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'options'     => theplus_get_testimonial_categories(),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'display_posts',
			array(
				'label'     => esc_html__( 'Maximum Posts Display', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 200,
				'step'      => 1,
				'default'   => 8,
				'separator' => 'before',
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

		$this->end_controls_section();
		$this->start_controls_section(
			'content_extra_options_section',
			array(
				'label' => esc_html__( 'Extra Option', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_title_tag',
			array(
				'label'   => esc_html__( 'Title Tag', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => theplus_get_tags_options(),
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
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array( 'custom' ),
				'condition' => array(
					'display_thumbnail' => 'yes',
				),
			)
		);
		$this->add_control(
			'caroByheight',
			array(
				'label'     => esc_html__( 'Content Limit By', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => esc_html__( 'Default', 'theplus' ),
					'height'     => esc_html__( 'Height', 'theplus' ),
					'text-limit' => esc_html__( 'Text Limit', 'theplus' ),
				),
				'condition' => array(
					// 'tlContentFrom' => array( 'tlrepeater' ),
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->add_responsive_control(
			'contentHei',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => wp_kses_post( "Content Height(px) <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "set-elementor-testimonial-carousel-height/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content' => 'height: {{SIZE}}{{UNIT}};overflow-y: auto; padding-right: 5px;',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'titleHei',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Title Height(px)', 'theplus' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content .testimonial-author-title' => 'height: {{SIZE}}{{UNIT}};overflow-y: auto; padding-right: 5px;',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'cntscrollOn',
			array(
				'label'      => esc_html__( 'Content Scroll', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'on-hover',
				'options'    => array(
					'on-hover' => esc_html__( 'On Hover', 'theplus' ),
					'visible'  => esc_html__( 'Visible', 'theplus' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'descByLimit',
			array(
				'label'      => wp_kses_post( "Excerpt Limit <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-elementor-testimonial-carousel-by-text/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'default',
				'options'    => array(
					'default' => esc_html__( 'Default', 'theplus' ),
					'letters' => esc_html__( 'By Letters', 'theplus' ),
					'words'   => esc_html__( 'By Words', 'theplus' ),
				),
				'condition'  => array(
					'tlContentFrom' => array( 'tlrepeater' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'masonry',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'text-limit',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'descLimit',
			array(
				'label'      => esc_html__( 'Maximum Letters/Words', 'theplus' ),
				'type'       => Controls_Manager::NUMBER,
				'min'        => 0,
				'max'        => 1000,
				'step'       => 1,
				'default'    => 30,
				'condition'  => array(
					'tlContentFrom' => array( 'tlrepeater' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'masonry',
								),
								array(
									'name'     => 'descByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'text-limit',
								),
								array(
									'name'     => 'descByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'titleByLimit',
			array(
				'label'     => esc_html__( 'Title Limit', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'Default', 'theplus' ),
					'letters' => esc_html__( 'By Letters', 'theplus' ),
					'words'   => esc_html__( 'By Words', 'theplus' ),
				),
				'condition' => array(
					'layout'        => array( 'carousel' ),
					'tlContentFrom' => array( 'tlrepeater' ),
					'caroByheight'  => array( 'text-limit' ),
				),
			)
		);
		$this->add_control(
			'titleLimit',
			array(
				'label'     => esc_html__( 'Maximum Letters/Words', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'default'   => 30,
				'condition' => array(
					'layout'        => array( 'carousel' ),
					'tlContentFrom' => array( 'tlrepeater' ),
					'caroByheight'  => array( 'text-limit' ),
					'titleByLimit!' => 'default',
				),
			)
		);
		$this->add_control(
			'redmorTxt',
			array(
				'label'       => esc_html__( 'Read More', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
				'default'     => esc_html__( 'Read More', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Read More', 'theplus' ),
				'condition'   => array(
					'tlContentFrom' => array( 'tlrepeater' ),
					'layout'        => array( 'masonry', 'carousel' ),
					'caroByheight'  => array( 'text-limit' ),
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'descByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'titleByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'redlesTxt',
			array(
				'label'       => esc_html__( 'Read Less', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Read Less', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Read Less', 'theplus' ),
				'condition'   => array(
					'tlContentFrom' => array( 'tlrepeater' ),
					'layout'        => array( 'masonry', 'carousel' ),
					'caroByheight'  => array( 'text-limit' ),
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'descByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'titleByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->end_controls_section();
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
				'selector' => '{{WRAPPER}} .testimonial-list .post-content-image .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-title',
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
					'{{WRAPPER}} .testimonial-list .post-content-image .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .post-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Post Title*/
		/*Post Extra options*/
		$this->start_controls_section(
			'section_extra_title_style',
			array(
				'label' => esc_html__( 'Extra Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'extra_title_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-author-title',
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_extra_title_style' );

		$this->start_controls_tab(
			'tab_extra_title_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'extra_title_color',
			array(
				'label'     => esc_html__( 'Extra Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-author-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_extra_title_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'extra_title_hover_color',
			array(
				'label'     => esc_html__( 'Extra Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .testimonial-author-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_designation_style',
			array(
				'label' => esc_html__( 'Designation', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-2 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-3 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-designation',
			)
		);
		$this->start_controls_tabs( 'tabs_designation_style' );
		$this->start_controls_tab(
			'tab_designation_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'designation_color',
			array(
				'label'     => esc_html__( 'Designation Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-2 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-3 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-designation' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_designation_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'designation_hover_color',
			array(
				'label'     => esc_html__( 'Designation Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .post-designation' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Post Extra options*/
		/*Post Excerpt*/
		$this->start_controls_section(
			'section_excerpt_style',
			array(
				'label' => esc_html__( 'Excerpt/Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'excerpt_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .testimonial-list .entry-content',
			)
		);
		$this->start_controls_tabs( 'tabs_excerpt_style' );
		$this->start_controls_tab(
			'tab_excerpt_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'excerpt_color',
			array(
				'label'     => esc_html__( 'Content Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list .entry-content,{{WRAPPER}} .testimonial-list .entry-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_excerpt_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'excerpt_hover_color',
			array(
				'label'     => esc_html__( 'Content Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content,{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Post Excerpt*/
		/*Content Background*/
		$this->start_controls_section(
			'section_content_bg_style',
			array(
				'label' => esc_html__( 'Content Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'content_bg_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'      => 'border',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .testimonial-list .testimonial-list-content',
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content',
			)
		);
		$this->add_control(
			'down_arrow_color',
			array(
				'label'     => esc_html__( 'Down Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text:after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'border_bottom_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-content-text:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'style'          => 'style-3',
					'style_3_layout' => 'style-1',
				),
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover',
			)
		);
		$this->add_control(
			'down_arrow_hover_color',
			array(
				'label'     => esc_html__( 'Down Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-content-text:after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'border_bottom_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover .testimonial-content-text:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'style'          => 'style-3',
					'style_3_layout' => 'style-1',
				),
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content',
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Content Background*/
		/*Read More/Less*/
		$this->start_controls_section(
			'section_readML_style',
			array(
				'label'      => esc_html__( 'Read More/Less', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition'  => array(
					'tlContentFrom' => array( 'tlrepeater' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'masonry',
								),
								array(
									'name'     => 'descByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'titleByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'readTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .testimonial-list .testimonial-content-text .entry-content a.testi-readbtn,{{WRAPPER}} .testimonial-list .testimonial-content-text .entry-content a.testi-readbtn',
			)
		);
		$this->start_controls_tabs( 'tabs_readML_style' );
		$this->start_controls_tab(
			'tab_readML_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'readColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content .entry-content a.testi-readbtn,{{WRAPPER}} .testimonial-list .testimonial-list-content .entry-content a.testi-readbtn' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_readML_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'readmhvrColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content a.testi-readbtn,{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content a.testi-readbtn' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Read More/Less*/
		/*Scroll Bar*/
		$this->start_controls_section(
			'scroll_testi_section',
			array(
				'label'      => esc_html__( 'Scroll Bar', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->start_controls_tabs( 'scroll_Tl_style' );
		$this->start_controls_tab(
			'scrollTl_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tesSclBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'tesSclWidth',
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
					'{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollTl_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tesThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-thumb,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'tesThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-thumb,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tesThumbBsw',
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-thumb,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-thumb',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollTl_Trk',
			array(
				'label' => esc_html__( 'Track', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tesTrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-track,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'tesTrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-track,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tesTrackBsw',
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-track,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*
		Scroll Bar*/
		/*Post Featured Image*/
		$this->start_controls_section(
			'section_post_image_style',
			array(
				'label' => esc_html__( 'Featured Image', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'featured_image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-featured-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_image_shadow_style' );
		$this->start_controls_tab(
			'tab_image_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-featured-image img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_hover_shadow',
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .testimonial-featured-image img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*carousel option*/
		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => array( 'carousel' ),
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
				'default' => '3',
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
				'separator'   => 'after',
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
						'top'      => '',
						'right'    => '10',
						'bottom'   => '',
						'left'     => '10',
						'isLinked' => true,
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
			'arrow_y_space',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Position Y', 'theplus' ),
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-nav' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_arrows' => 'yes',
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
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Slide Scale', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center,
					{{WRAPPER}} .list-carousel-slick .slick-slide.scc-animate' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});opacity:1;',
				),
				'condition'  => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_control(
			'scale_normal_slide',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Normal Slide Scale', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0.8,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});transition: .3s all linear;',
				),
				'condition'  => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'shadow_active_slide',
				'selector'  => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center',
				'condition' => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'shadow',
				),
			)
		);
		$this->add_control(
			'opacity_normal_slide',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Normal Slide Opacity', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0.7,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => 'opacity:{{SIZE}}',
				),
				'condition'  => array(
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
				'separator'   => 'after',
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
				'separator'   => 'after',
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
		/*carousel option*/

		/*post not found options*/
		$this->start_controls_section(
			'section_post_not_found_styling',
			array(
				'label'     => esc_html__( 'Post Not Found Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tlContentFrom' => array( 'tlcontent' ),
				),
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
			include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
			include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$query         = $this->get_query_args();
		$post_name     = theplus_testimonial_post_name();
		$taxonomy_name = theplus_testimonial_post_category();

		$display_thumbnail = $settings['display_thumbnail'];
		$thumbnail         = $settings['thumbnail_size'];

		$style          = $settings['style'];
		$layout         = ! empty( $settings['layout'] ) ? $settings['layout'] : 'carousel';
		$post_title_tag = $settings['post_title_tag'];
		$post_category  = $settings['post_category'];

		$style_3_layout = ( $settings['style_3_layout'] != '' ) ? 'layout-' . $settings['style_3_layout'] : '';
		$tlContentFrom  = ! empty( $settings['tlContentFrom'] ) ? $settings['tlContentFrom'] : 'tlcontent';
		$testiAllList   = ! empty( $settings['testiAllList'] ) ? $settings['testiAllList'] : array();

		$content_alignment_4 = ( $settings['content_alignment_4'] != '' ) ? 'content-' . $settings['content_alignment_4'] : '';

		$descByLimit  = ! empty( $settings['descByLimit'] ) ? $settings['descByLimit'] : 'default';
		$descLimit    = ! empty( $settings['descLimit'] ) ? $settings['descLimit'] : 30;
		$cntscrollOn  = ! empty( $settings['cntscrollOn'] ) ? $settings['cntscrollOn'] : 'on-hover';
		$caroByheight = ! empty( $settings['caroByheight'] ) ? $settings['caroByheight'] : '';
		$titleByLimit = ! empty( $settings['titleByLimit'] ) ? $settings['titleByLimit'] : 'default';
		$titleLimit   = ! empty( $settings['titleLimit'] ) ? $settings['titleLimit'] : 30;
		$redmorTxt    = ! empty( $settings['redmorTxt'] ) ? $settings['redmorTxt'] : '';
		$redlesTxt    = ! empty( $settings['redlesTxt'] ) ? $settings['redlesTxt'] : '';

		/*--On Scroll View Animation ---*/
		$animated_columns = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		/** slide_direction */
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

		// columns
		$desktop_class = $tablet_class = $mobile_class = '';
		if ( $layout != 'carousel' ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $settings['desktop_column'] );
			$tablet_class  = 'tp-col-md-' . esc_attr( $settings['tablet_column'] );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $settings['mobile_column'] );
			$mobile_class .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
		}

		// layout
		$layout_attr = $data_class = '';
		if ( $layout != '' ) {
			if ( $layout != 'grid' ) {
				$data_class  .= theplus_get_layout_list_class( $layout );
				$layout_attr .= theplus_get_layout_list_attr( $layout );
			} else {
				$data_class .= ' list-isotope';
			}
		} else {
				$data_class .= ' list-isotope';
		}

		if ( $layout == 'carousel' ) {
			$data_class .= ' list-carousel-slick ';
		}
		$data_class .= ' testimonial-' . $style;

		$readAttr = array();
		$attr     = '';
		if ( $layout == 'masonry' || ( $layout == 'carousel' && $caroByheight == 'text-limit' ) ) {

			$readAttr['readMore'] = wp_kses_post( $redmorTxt );
			$readAttr['readLess'] = wp_kses_post( $redlesTxt );

			$readAttr = htmlspecialchars( json_encode( $readAttr ), ENT_QUOTES, 'UTF-8' );

			$attr = 'data-readData = \'' . $readAttr . '\'';
		}

		$output = $data_attr = '';
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
		$i   = 1;
		$uid = uniqid( 'post' );
		if ( ! empty( $settings['carousel_unique_id'] ) ) {
			$uid        = 'tpca_' . $settings['carousel_unique_id'];
			$data_attr .= ' data-carousel-bg-conn="bgcarousel' . esc_attr( $settings['carousel_unique_id'] ) . '"';
			$data_attr .= ' data-connection="tptab_' . esc_attr( $settings['carousel_unique_id'] ) . '"';
		}
		$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';

		if ( ! empty( $tlContentFrom ) && $tlContentFrom == 'tlrepeater' ) {
			if ( ! empty( $testiAllList ) ) {
				$index       = 1;
				$output     .= '<div id="theplus-testimonial-post-list" class="testimonial-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $style_3_layout ) . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-enable-isotope="1">';
					$output .= '<div class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ' . esc_attr( $content_alignment_4 ) . '">';
				foreach ( $testiAllList as $item ) {
					$testiAuthor  = ! empty( $item['testiAuthor'] ) ? $item['testiAuthor'] : '';
					$testiTitle   = ! empty( $item['testiTitle'] ) ? $item['testiTitle'] : '';
					$testiLabel   = ! empty( $item['testiLabel'] ) ? $item['testiLabel'] : '';
					$testiDesign  = ! empty( $item['testiDesign'] ) ? $item['testiDesign'] : '';
					$testiImage   = ! empty( $item['testiImage']['url'] ) ? $item['testiImage']['url'] : '';
					$testiImageId = ! empty( $item['testiImage']['id'] ) ? $item['testiImage']['id'] : '';
					$testiLogo    = ! empty( $item['testiLogo']['url'] ) ? $item['testiLogo']['url'] : '';
					$testiLogoId  = ! empty( $item['testiLogo']['id'] ) ? $item['testiLogo']['id'] : '';
					// grid item loop
					$output .= '<div class="grid-item ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . $animated_columns . '">';
					if ( ! empty( $style ) ) {
							ob_start();
								include THEPLUS_WSTYLES . 'testimonial/testimonial-' . sanitize_file_name( $style ) . '.php';
								$output .= ob_get_contents();
							ob_end_clean();
					}
							$output .= '</div>';
							++$index;
				}
					$output .= '</div>';

				$output .= '</div>';
			}
		} elseif ( ! $query->have_posts() ) {

				$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Posts not found', 'theplus' ) . '</h3>';
		} else {
			$output .= '<div id="theplus-testimonial-post-list" class="testimonial-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $style_3_layout ) . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-enable-isotope="1">';

				$output .= '<div class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ' . esc_attr( $content_alignment_4 ) . '">';
			while ( $query->have_posts() ) {

				$query->the_post();
				$post = $query->post;

				/**grid item loop*/
				$output .= '<div class="grid-item ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . $animated_columns . '">';
				if ( ! empty( $style ) ) {
					ob_start();
						include THEPLUS_WSTYLES . 'testimonial/testimonial-' . sanitize_file_name( $style ) . '.php';
						$output .= ob_get_contents();
					ob_end_clean();
				}
				$output .= '</div>';

				++$i;
			}
				$output .= '</div>';

			$output .= '</div>';
		}

		$css_rule = $css_messy = '';
		if ( $settings['messy_column'] == 'yes' ) {
			$layout = 'carousel';
			if ( $layout == 'carousel' ) {
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

	protected function content_template() {
	}

	protected function get_query_args() {
		$settings      = $this->get_settings_for_display();
		$post_name     = theplus_testimonial_post_name();
		$taxonomy_name = theplus_testimonial_post_category();

		$terms         = get_terms(
			array(
				'taxonomy'   => $taxonomy_name,
				'hide_empty' => true,
			)
		);
		$post_category = $settings['post_category'];
		$category      = array();
		if ( ! is_wp_error( $terms ) && ! empty( $terms ) && ! empty( $post_category ) ) {
			foreach ( $terms as $term ) {
				if ( in_array( $term->term_id, $post_category ) ) {
					$category[] = $term->slug;
				}
			}
		}
		$query_args = array(
			'post_type'           => $post_name,
			$taxonomy_name        => $category,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $settings['display_posts'] ),
			'orderby'             => $settings['post_order_by'],
			'order'               => $settings['post_order'],
		);

		$offset = $settings['post_offset'];
		$offset = ! empty( $offset ) ? absint( $offset ) : 0;

		if ( $offset ) {
			$query_args['offset'] = $offset;
		}
		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$query_args['paged'] = $paged;

		$query = new \WP_Query( $query_args );

		return $query;
	}

	/**
	 * Render Carousel Options
	 *
	 * @since 1.1.0
	 * @version 5.5.3
	 */
	protected function get_carousel_options() {
		return include THEPLUS_PATH . 'modules/widgets/theplus-carousel-options.php';
	}
}
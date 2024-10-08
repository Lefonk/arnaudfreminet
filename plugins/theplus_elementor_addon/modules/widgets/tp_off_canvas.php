<?php
/**
 * Widget Name: Popup Builder
 * Description: Toggle Content off canvas.
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Off_Canvas
 */
class ThePlus_Off_Canvas extends Widget_Base {

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
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-off-canvas';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Popup Builder / Off Canvas', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-bars theplus_backend_icon';
	}

	/**
	 * Get Custom url.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_keywords() {
		return array( 'Offcanvas', 'Off-canvas', 'Slide out', 'Slide-in', 'Side menu', 'Overlay menu', 'Hidden menu', 'Drawer menu', 'Hamburger menu', 'Mobile menu', 'Popup', 'Modal', 'Pop-up', 'Overlay', 'Lightbox', 'Popover', 'Dialog', 'Message box', 'Notification', 'Alert' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'content_open_style',
			array(
				'label'     => wp_kses_post( "Popup Type <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "off-canvas-popup-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slide',
				'options'   => array(
					'popup'      => esc_html__( 'Modal Popup', 'theplus' ),
					'reveal'     => esc_html__( 'Reveal Content', 'theplus' ),
					'corner-box' => esc_html__( 'Corner Box', 'theplus' ),
					'slide'      => esc_html__( 'Slide', 'theplus' ),
					/** 'push' => esc_html__( 'Push Content', 'theplus' ),
					 * 'slide-along' => esc_html__( 'Slide Along Content', 'theplus' ),
					 */
				),
				'selectors' => array(
					'.plus-{{ID}}-open .plus-{{ID}}.plus-canvas-content-wrap:not(.plus-popup).plus-visible' => '-webkit-transform: translate3d(0,0,0);transform: translate3d(0,0,0);',
					/** '.plus-{{ID}}-open .plus-{{ID}}.plus-canvas-content-wrap.plus-popup.plus-visible' => '-webkit-transform: translateY(-50%) scale(1);transform: translateY(-50%) scale(1);',*/
				),
			)
		);
		$this->add_control(
			'content_open_direction_popup',
			array(
				'label'     => esc_html__( 'Open Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'top-left'      => esc_html__( 'Top Left', 'theplus' ),
					'top-center'    => esc_html__( 'Top Center', 'theplus' ),
					'top-right'     => esc_html__( 'Top Right', 'theplus' ),
					'left'          => esc_html__( 'Left', 'theplus' ),
					'right'         => esc_html__( 'Right', 'theplus' ),
					'center'        => esc_html__( 'Center', 'theplus' ),
					'bottom-left'   => esc_html__( 'Bottom Left', 'theplus' ),
					'bottom-center' => esc_html__( 'Bottom Center', 'theplus' ),
					'bottom-right'  => esc_html__( 'Bottom Right', 'theplus' ),
				),
				'condition' => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'content_open_height',
			array(
				'label'      => esc_html__( 'Open Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'vh' ),
				'range'      => array(
					'vh' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'vh',
					'size' => 100,
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-slide' => 'height: {{SIZE}}{{UNIT}};',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-slide .plus-content-editor' => 'height: 100%;',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-slide .plus-stylist-list-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'content_open_style' => 'slide',
				),
			)
		);
		$this->add_control(
			'content_open_direction',
			array(
				'label'     => esc_html__( 'Open Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'content_open_style!' => array( 'corner-box', 'popup' ),
				),
			)
		);
		$this->add_control(
			'content_open_corner_box_direction',
			array(
				'label'     => esc_html__( 'Corner Box Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top-left',
				'options'   => array(
					'top-left'  => esc_html__( 'Top Left', 'theplus' ),
					'top-right' => esc_html__( 'Top Right', 'theplus' ),
				),
				'condition' => array(
					'content_open_style' => 'corner-box',
				),
			)
		);
		$this->add_responsive_control(
			'content_open_width',
			array(
				'label'      => wp_kses_post( "Open Width <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "full-width-menu-popup-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 800,
						'step' => 2,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 300,
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-top,.plus-{{ID}}.plus-canvas-content-wrap.plus-bottom' => 'width: 100%;height: {{SIZE}}{{UNIT}};',
					'.plus-{{ID}}.plus-canvas-content-wrap' => 'width: {{SIZE}}{{UNIT}};',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-left .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-left .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-left .plus-offcanvas-container' => '-webkit-transform: translate3d({{SIZE}}{{UNIT}}, 0, 0);transform: translate3d({{SIZE}}{{UNIT}}, 0, 0);',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-right .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-right .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-right .plus-offcanvas-container' => '-webkit-transform: translate3d(-{{SIZE}}{{UNIT}}, 0, 0);transform: translate3d(-{{SIZE}}{{UNIT}}, 0, 0);',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-top .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-top .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-top .plus-offcanvas-container' => '-webkit-transform: translate3d(0,{{SIZE}}{{UNIT}}, 0);transform: translate3d( 0,{{SIZE}}{{UNIT}}, 0);',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-bottom .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-bottom .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-bottom .plus-offcanvas-container' => '-webkit-transform: translate3d(0,-{{SIZE}}{{UNIT}}, 0);transform: translate3d( 0,-{{SIZE}}{{UNIT}}, 0);',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-corner-box' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-top-left.plus-corner-box' => '-webkit-transform: translate3d(-{{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);transform: translate3d(-{{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-top-right.plus-corner-box' => '-webkit-transform: translate3d({{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);transform: translate3d({{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);',
				),
				'condition'  => array(
					'content_open_style!' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'content_open_popup_width',
			array(
				'label'      => esc_html__( 'Popup Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 800,
						'step' => 2,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-popup' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'content_open_popup_height',
			array(
				'label'      => esc_html__( 'Popup Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 800,
						'step' => 2,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-popup' => 'max-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'content_open_left_right_padding',
			array(
				'label'      => esc_html__( 'Popup Left/Right Space', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-popup' => 'margin-left :{{SIZE}}{{UNIT}};margin-right :{{SIZE}}{{UNIT}};width: calc(100% - {{SIZE}}{{UNIT}} * 2);',
				),
				'condition'  => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'content_open_top_botton_padding',
			array(
				'label'      => esc_html__( 'Popup Top/Bottom Space', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-popup' => 'margin-top :{{SIZE}}{{UNIT}};margin-bottom :{{SIZE}}{{UNIT}};width: calc(100% - {{SIZE}}{{UNIT}} * 2);',
				),
				'condition'  => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_control(
			'content_template_type',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tp-template',
				'separator' => 'before',
				'options'   => array(
					'tp-template' => esc_html__( 'Template', 'theplus' ),
					'tp-content'  => esc_html__( 'Content', 'theplus' ),
					'tp-manually' => esc_html__( 'Shortcode', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'content_template',
			array(
				'label'       => wp_kses_post( "Select Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "popup-with-elementor-templates/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'content_template_type' => 'tp-template',
				),
			)
		);
		$this->add_control(
			'content_description',
			array(
				'label'       => esc_html__( 'Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'placeholder' => esc_html__( 'Type your content here', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'content_template_type' => 'tp-content',
				),
			)
		);
		$this->add_control(
			'content_template_id',
			array(
				'label'       => esc_html__( 'Enter Elementor Template Shortcode', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'placeholder' => '[elementor-template id="70"]',
				'condition'   => array(
					'content_template_type' => 'tp-manually',
				),
			)
		);
		$this->add_control(
			'select_toggle_canvas',
			array(
				'label'     => wp_kses_post( "Select Option <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "open-popup-on-button-click-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'button',
				'options'   => array(
					'icon'   => esc_html__( 'Icon', 'theplus' ),
					'button' => esc_html__( 'Call To Action', 'theplus' ),
					'hide'   => esc_html__( 'Hidden', 'theplus' ),
					'lottie' => esc_html__( 'Lottie', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'toggle_icon_style',
			array(
				'label'     => esc_html__( 'Icon Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'custom'  => esc_html__( 'Custom', 'theplus' ),
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
				),
			)
		);
		$this->add_control(
			'image_svg_icn',
			array(
				'label'     => esc_html__( 'Choose Image/SVG', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style'    => 'custom',
				),
			)
		);
		$this->add_control(
			'toggle_img_svg_size',
			array(
				'label'     => esc_html__( 'Image/Svg Size', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 500,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 60,
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style'    => 'custom',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'toggle_icon_size',
			array(
				'label'     => esc_html__( 'Icon Width', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 150,
					),
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style!'   => 'custom',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'toggle_icon_weight',
			array(
				'label'     => esc_html__( 'Icon Weight', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 0.5,
					),
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style!'   => 'custom',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3 span.menu_line' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'toggle_icon_padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style!'   => 'custom',
				),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'     => esc_html__( 'Button Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Click Here', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_control(
			'button_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
					'none'           => esc_html__( 'None', 'theplus' ),
				),
				'separator' => 'before',
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_control(
			'button_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => false,
				'default'     => 'fa fa-chevron-right',
				'condition'   => array(
					'select_toggle_canvas' => 'button',
					'button_icon_style'    => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icon_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
					'button_icon_style'    => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'button_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'select_toggle_canvas' => 'button',
					'button_icon_style'    => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'button_before_after',
			array(
				'label'     => esc_html__( 'Icon Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After', 'theplus' ),
					'before' => esc_html__( 'Before', 'theplus' ),
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
					'button_icon_style!'   => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'button_icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
					'button_icon_style!'   => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon.button-after' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon.button-before' => 'padding-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 200,
					),
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
					'button_icon_style!'   => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'lottieUrl',
			array(
				'label'       => esc_html__( 'Lottie URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'select_toggle_canvas' => 'lottie',
				),
			)
		);
		$this->add_responsive_control(
			'button_align',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'prefix_class' => 'text-%s',
				'default'      => 'center',
				'condition'    => array(
					'select_toggle_canvas!' => 'hide',
				),
				'separator'    => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_option_content_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'event_esc_close_content',
			array(
				'label'        => wp_kses_post( "Esc Button Close Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "close-elementor-popup-with-esc-or-by-clicking-outside/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'event_body_click_close_content',
			array(
				'label'        => wp_kses_post( "Outer Click Close Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "close-elementor-popup-with-esc-or-by-clicking-outside/' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'click_offcanvas_close',
			array(
				'label'        => esc_html__( 'On Click Link Popup Close', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'fixed_toggle_button',
			array(
				'label'     => esc_html__( 'Fixed Toggle Button', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'show_scroll_window_offset',
			array(
				'label'     => esc_html__( 'Show Menu Scroll Offset', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'scroll_top_offset_value',
			array(
				'label'      => esc_html__( 'Scroll Top Offset Value', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 'px',
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'condition'  => array(
					'fixed_toggle_button'       => array( 'yes' ),
					'show_scroll_window_offset' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'fixed_toggle_position' );
		$this->start_controls_tab(
			'fixed_toggle_desktop',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'd_pos_xposition',
			array(
				'label'      => esc_html__( 'Left', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 0,
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'd_left_auto'         => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_pos_rightposition',
			array(
				'label'      => esc_html__( 'Right', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 0,
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'd_right_auto'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_pos_yposition',
			array(
				'label'      => esc_html__( 'Top', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 5,
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 800,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'd_top_auto'          => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_pos_bottomposition',
			array(
				'label'      => esc_html__( 'Bottom', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 0,
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 800,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'd_bottom_auto'       => array( 'yes' ),
				),
			)
		);
		/*extra effect*/
		$this->add_control(
			'contentextraeffect',
			array(
				'label'     => esc_html__( 'Content Transform', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'content_open_style!' => 'popup',
				),
			)
		);
		$this->add_control(
			'contentextraeffectrotatex',
			array(
				'label'      => esc_html__( 'Rotate X', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'deg' ),
				'default'    => array(
					'unit' => 'deg',
					'size' => '0',
				),
				'range'      => array(
					'deg' => array(
						'min'  => -360,
						'max'  => 360,
						'step' => 15,
					),
				),
				'condition'  => array(
					'content_open_style!' => 'popup',
					'contentextraeffect'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'contentextraeffectrotatey',
			array(
				'label'      => esc_html__( 'Rotate Y', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'deg' ),
				'default'    => array(
					'unit' => 'deg',
					'size' => '-20',
				),
				'range'      => array(
					'deg' => array(
						'min'  => -360,
						'max'  => 360,
						'step' => 15,
					),
				),
				'condition'  => array(
					'content_open_style!' => 'popup',
					'contentextraeffect'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'contentextraeffecttranslatex',
			array(
				'label'      => esc_html__( 'Translate X', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => '0',
				),
				'range'      => array(
					'deg' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 15,
					),
				),
				'condition'  => array(
					'content_open_style!' => 'popup',
					'contentextraeffect'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'contentextraeffecttranslatey',
			array(
				'label'      => esc_html__( 'Translate Y', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => '0',
				),
				'range'      => array(
					'deg' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 15,
					),
				),
				'condition'  => array(
					'content_open_style!' => 'popup',
					'contentextraeffect'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'contentextraeffectsacle',
			array(
				'label'      => esc_html__( 'Scale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => '1',
				),
				'range'      => array(
					'deg' => array(
						'min'  => .1,
						'max'  => 1,
						'step' => .1,
					),
				),
				'selectors'  => array(
					'.plus-{{ID}}-open body' => '-webkit-perspective:1500px;perspective: 1500px;',
					'.plus-{{ID}}-open .plus-offcanvas-container' => '-webkit-transform: translate3d(100px, 0, -600px) rotateY({{contentextraeffectrotatey.SIZE}}{{contentextraeffectrotatey.UNIT}}) rotateX({{contentextraeffectrotatex.SIZE}}{{contentextraeffectrotatex.UNIT}}) translateX({{contentextraeffecttranslatex.SIZE}}{{contentextraeffecttranslatex.UNIT}}) translateY({{contentextraeffecttranslatey.SIZE}}{{contentextraeffecttranslatey.UNIT}}) scale({{contentextraeffectsacle.SIZE}});
					transform: translate3d(100px, 0, -600px) rotateY({{contentextraeffectrotatey.SIZE}}{{contentextraeffectrotatey.UNIT}}) rotateX({{contentextraeffectrotatex.SIZE}}{{contentextraeffectrotatex.UNIT}}) translateX({{contentextraeffecttranslatex.SIZE}}{{contentextraeffecttranslatex.UNIT}}) translateY({{contentextraeffecttranslatey.SIZE}}{{contentextraeffecttranslatey.UNIT}}) scale({{contentextraeffectsacle.SIZE}});',
				),
				'condition'  => array(
					'content_open_style!' => 'popup',
					'contentextraeffect'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'contentextraeffectbg',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'.plus-{{ID}}-open body,.plus-{{ID}}-open' => 'background:{{VALUE}};',
				),
				'condition' => array(
					'content_open_style!' => 'popup',
					'contentextraeffect'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'popinanimationheading',
			array(
				'label'     => esc_html__( 'Model Popup In/Out Animation', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'content_open_style' => 'popup',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'popinanimation',
			array(
				'label'     => esc_html__( 'In Animation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'              => esc_html__( 'Select Animation', 'theplus' ),
					'fadeIn'            => esc_html__( 'FadeIn', 'theplus' ),
					'fadeInDown'        => esc_html__( 'FadeInDown', 'theplus' ),
					'fadeInDownBig'     => esc_html__( 'FadeInDownBig', 'theplus' ),
					'fadeInLeft'        => esc_html__( 'FadeInLeft', 'theplus' ),
					'fadeInLeftBig'     => esc_html__( 'FadeInLeftBig', 'theplus' ),
					'fadeInRight'       => esc_html__( 'FadeInRight', 'theplus' ),
					'fadeInRightBig'    => esc_html__( 'FadeInRightBig', 'theplus' ),
					'fadeInUp'          => esc_html__( 'FadeInUp', 'theplus' ),
					'fadeInUpBig'       => esc_html__( 'FadeInUpBig', 'theplus' ),
					'fadeInTopLeft'     => esc_html__( 'FadeInTopLeft', 'theplus' ),
					'fadeInTopRight'    => esc_html__( 'FadeInTopRight', 'theplus' ),
					'fadeInBottomLeft'  => esc_html__( 'FadeInBottomLeft', 'theplus' ),
					'fadeInBottomRight' => esc_html__( 'FadeInBottomRight', 'theplus' ),
					'zoomIn'            => esc_html__( 'ZoomIn', 'theplus' ),
					'slideInDown'       => esc_html__( 'SlideInDown', 'theplus' ),
					'slideInLeft'       => esc_html__( 'SlideInLeft', 'theplus' ),
					'slideInRight'      => esc_html__( 'SlideInRight', 'theplus' ),
					'slideInUp'         => esc_html__( 'SlideInUp', 'theplus' ),
					'flipInX'           => esc_html__( 'FlipInX', 'theplus' ),
					'flipInY'           => esc_html__( 'FlipInY', 'theplus' ),
				),
				'condition' => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_control(
			'popoutanimation',
			array(
				'label'     => esc_html__( 'Out Animation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'               => esc_html__( 'Select Animation', 'theplus' ),
					'fadeOut'            => esc_html__( 'FadeOut', 'theplus' ),
					'fadeOutDown'        => esc_html__( 'FadeOutDown', 'theplus' ),
					'fadeOutDownBig'     => esc_html__( 'FadeOutDownBig', 'theplus' ),
					'fadeOutLeft'        => esc_html__( 'FadeOutLeft', 'theplus' ),
					'fadeOutLeftBig'     => esc_html__( 'FadeOutLeftBig', 'theplus' ),
					'fadeOutRight'       => esc_html__( 'FadeOutRight', 'theplus' ),
					'fadeOutRightBig'    => esc_html__( 'FadeOutRightBig', 'theplus' ),
					'fadeOutUp'          => esc_html__( 'FadeOutUp', 'theplus' ),
					'fadeOutUpBig'       => esc_html__( 'FadeOutUpBig', 'theplus' ),
					'fadeOutTopLeft'     => esc_html__( 'FadeOutTopLeft', 'theplus' ),
					'fadeOutTopRight'    => esc_html__( 'FadeOutTopRight', 'theplus' ),
					'fadeOutBottomLeft'  => esc_html__( 'FadeOutBottomLeft', 'theplus' ),
					'fadeOutBottomRight' => esc_html__( 'FadeOutBottomRight', 'theplus' ),
					'zoomOut'            => esc_html__( 'ZoomOut', 'theplus' ),
					'slideOutDown'       => esc_html__( 'SlideOutDown', 'theplus' ),
					'slideOutLeft'       => esc_html__( 'SlideOutLeft', 'theplus' ),
					'slideOutRight'      => esc_html__( 'SlideOutRight', 'theplus' ),
					'slideOutUp'         => esc_html__( 'SlideOutUp', 'theplus' ),
					'flipOutX'           => esc_html__( 'FlipOutX', 'theplus' ),
					'flipOutY'           => esc_html__( 'FlipOutY', 'theplus' ),
				),
				'condition' => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_control(
			'popoutanimationdelay',
			array(
				'label'     => esc_html__( 'Delay', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'     => esc_html__( 'Default', 'theplus' ),
					'delay-1s' => esc_html__( '1s', 'theplus' ),
					'delay-2s' => esc_html__( '2s', 'theplus' ),
					'delay-3s' => esc_html__( '3s', 'theplus' ),
					'delay-4s' => esc_html__( '4s', 'theplus' ),
					'delay-5s' => esc_html__( '5s', 'theplus' ),
				),
				'condition' => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->add_control(
			'popoutanimationspeed',
			array(
				'label'     => esc_html__( 'Speed', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'   => esc_html__( 'Default', 'theplus' ),
					'faster' => esc_html__( 'Faster', 'theplus' ),
					'fast'   => esc_html__( 'Fast', 'theplus' ),
					'slow'   => esc_html__( 'Slow', 'theplus' ),
					'slower' => esc_html__( 'Slower', 'theplus' ),
				),
				'condition' => array(
					'content_open_style' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'fixed_toggle_tablet',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_responsive',
			array(
				'label'     => esc_html__( 'Responsive Values', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_xposition',
			array(
				'label'      => esc_html__( 'Left', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 1200,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
					't_left_auto'         => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_rightposition',
			array(
				'label'      => esc_html__( 'Right', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 1200,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
					't_right_auto'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_yposition',
			array(
				'label'      => esc_html__( 'Top', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 800,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
					't_top_auto'          => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_bottomposition',
			array(
				'label'      => esc_html__( 'Bottom', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 800,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					't_responsive'        => array( 'yes' ),
					't_bottom_auto'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'fixed_toggle_mobile',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_responsive',
			array(
				'label'     => esc_html__( 'Responsive Values', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_xposition',
			array(
				'label'      => esc_html__( 'Left', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 700,
						'step' => 1,
					),
				),
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
					'm_left_auto'         => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_rightposition',
			array(
				'label'      => esc_html__( 'Right', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 700,
						'step' => 1,
					),
				),
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
					'm_right_auto'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_yposition',
			array(
				'label'      => esc_html__( 'Top', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 700,
						'step' => 1,
					),
				),
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
					'm_top_auto'          => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_bottomposition',
			array(
				'label'      => esc_html__( 'Bottom', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'range'      => array(
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => -100,
						'max'  => 700,
						'step' => 1,
					),
				),
				'condition'  => array(
					'fixed_toggle_button' => array( 'yes' ),
					'm_responsive'        => array( 'yes' ),
					'm_bottom_auto'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'popup_display_content_section',
			array(
				'label' => esc_html__( 'Display Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		/*
		$this->add_control(
			'openTrigger',
			[
				'label' => esc_html__( 'On Button Click', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'openTriggerNote',
			[
				'label' => esc_html__( 'Note: You need to Select Option Hidden from Popup Builder Content Tab', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'openTrigger!' => 'yes',
				],
			]
		);
		*/

		$this->add_control(
			'pageload',
			array(
				'label'        => wp_kses_post( "On Page Load <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "trigger-popup-on-page-load-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'scroll',
			array(
				'label'        => wp_kses_post( "On Scroll <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "popup-after-page-scroll-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'scrollHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Scroll Offset (PX)L', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 10,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scroll' => 'yes',
				),
			)
		);
		$this->add_control(
			'exit',
			array(
				'label'        => wp_kses_post( "On Exit Intent <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "exit-intent-popup-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'inactivity',
			array(
				'label'        => wp_kses_post( "After Inactivity <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "popup-on-user-inactivity-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'inactivitySec',
			array(
				'label'     => esc_html__( 'Inactivity MilliSecond', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 10000,
				'step'      => 100,
				'condition' => array(
					'inactivity' => 'yes',
				),
			)
		);
		$this->add_control(
			'pageviews',
			array(
				'label'        => wp_kses_post( "After X Page Views <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "popup-on-page-views-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'pageViewsCount',
			array(
				'label'     => esc_html__( 'Page View Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 50,
				'step'      => 1,
				'condition' => array(
					'pageviews' => 'yes',
				),
			)
		);
		$this->add_control(
			'prevurl',
			array(
				'label'        => wp_kses_post( "Arriving From Specific URL <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-elementor-popup-arriving-from-a-specific-url/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'previousUrl',
			array(
				'label'       => esc_html__( 'Source URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'http://', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'condition'   => array(
					'prevurl' => 'yes',
				),
			)
		);
		$this->add_control(
			'extraclick',
			array(
				'label'        => wp_kses_post( "On Any Other Element's Click <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-popup-on-other-element-click/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'extraId',
			array(

				'label'       => esc_html__( 'Unique Class (Open)', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Unique Class', 'theplus' ),
				'condition'   => array(
					'extraclick' => 'yes',
				),
			)
		);
		$this->add_control(
			'extraIdClose',
			array(
				'label'       => esc_html__( 'Unique Class (Close)', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Unique Class', 'theplus' ),
				'condition'   => array(
					'extraclick' => 'yes',
				),
			)
		);
		$this->add_control(
			'showTime',
			array(
				'label'   => wp_kses_post( "Show For Specific Time <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-popup-on-specific-date-and-time/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'dateStart',
			array(

				'label'     => esc_html__( 'Start Date', 'theplus' ),
				'type'      => Controls_Manager::DATE_TIME,
				'condition' => array(
					'showTime' => 'yes',
				),
			)
		);
		$this->add_control(
			'dateEnd',
			array(
				'label'     => esc_html__( 'End Date', 'theplus' ),
				'type'      => Controls_Manager::DATE_TIME,
				'condition' => array(
					'showTime' => 'yes',
				),
			)
		);
		$this->add_control(
			'showRestricted',
			array(
				'label'   => wp_kses_post( "Show X Times per User <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-popup-once-per-website-session/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'showXTimes',
			array(
				'label'     => esc_html__( 'Number of Times', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 50,
				'step'      => 1,
				'condition' => array(
					'showRestricted' => 'yes',
				),
			)
		);
		$this->add_control(
			'showXDays',
			array(
				'label'     => esc_html__( 'Inactive Days', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 365,
				'step'      => 1,
				'condition' => array(
					'showRestricted' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'toggle_content_section_styling',
			array(
				'label' => esc_html__( 'Open Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'open_content_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '25',
					'bottom'   => '10',
					'left'     => '25',
					'isLinked' => false,
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Content Text Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor, 
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor p, 
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h1, 
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h2, 
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h3, 
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h4,
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h5,
				.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h6',
				'condition' => array(
				'content_template_type!' => 'tp-template', 
				),
			)
		);
		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Content Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor,.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor p, .plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h1, .plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h2, .plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h3, .plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h4, .plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h5, .plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor h6' => 'color:{{VALUE}};',
				),
				'condition' => array(
				'content_template_type!' => 'tp-template', 
				),
			)
		);
		$this->start_controls_tabs( 'tabs_open_content_style' );
		$this->start_controls_tab(
			'tab_open_content_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'open_content_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap',
			)
		);
		$this->add_responsive_control(
			'open_content_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'open_content_shadow',
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_open_content_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'open_content_hover_shadow',
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'open_content_close_icon_heading',
			array(
				'label'     => esc_html__( 'Close Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'open_content_close_icon_display',
			array(
				'label'        => esc_html__( 'Display Close Icon', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'close_icon_color',
			array(
				'label'     => esc_html__( 'Close Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'.plus-canvas-content-wrap.plus-{{ID}} .plus-offcanvas-close:before, .plus-canvas-content-wrap.plus-{{ID}} .plus-offcanvas-close:after' => 'border-color: {{VALUE}};',
				),

			),
		);
		$this->add_control(
			'open_close_icon_sticky',
			array(
				'label'     => esc_html__( 'Sticky/Fixed Close Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_control(
			'close_image_custom',
			array(
				'label'     => esc_html__( 'Custom Close Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_control(
			'close_image_custom_source',
			array(
				'label'     => esc_html__( 'Choose Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
					'close_image_custom'              => 'yes',
				),
			)
		);
		$this->add_control(
			'open_content_close_icon_align',
			array(
				'label'       => esc_html__( 'Icon Alignment', 'theplus' ),
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
				'default'     => 'right',
				'toggle'      => true,
				'label_block' => false,
				'condition'   => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_open_content_close_style' );
		$this->start_controls_tab(
			'tab_open_content_close_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_control(
			'open_content_close_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:before,.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:after' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
					'close_image_custom'              => 'no',
				),
			)
		);
		$this->add_control(
			'off_cus_close_img',
			array(
				'label'      => esc_html__( 'Close Image Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close,.plus-{{ID}}.plus-canvas-content-wrap .off-close-image .close-custom_img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'open_content_close_icon_display' => 'yes',
					'close_image_custom'              => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'open_content_close_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close',
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'open_content_close_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close,.plus-{{ID}}.plus-canvas-content-wrap .off-close-image .close-custom_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'open_content_close_shadow',
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close',
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_open_content_close_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_control(
			'open_content_close_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover:before,.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover:after' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
					'close_image_custom'              => 'no',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'open_content_close_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover',
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'open_content_close_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover,.plus-{{ID}}.plus-canvas-content-wrap .off-close-image .close-custom_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'open_content_close_hover_shadow',
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover',
				'condition' => array(
					'open_content_close_icon_display' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'open_content_overlay_heading',
			array(
				'label'     => esc_html__( 'Popup Background Overlay', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'open_content_overlay_background',
				'label'    => esc_html__( 'Overlay Color', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.plus-offcanvas-content-widget.plus-{{ID}}-open .plus-offcanvas-container:after',
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'open_content_filter',
				'selector' => '.plus-{{ID}}-open .plus-offcanvas-container',
			)
		);
		$this->add_control(
			'open_content_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Hidden', 'theplus' ),
				'label_off' => __( 'Visible', 'theplus' ),
				'selectors' => array(
					'.plus-{{ID}}.plus-canvas-content-wrap' => 'overflow:hidden;',
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'toggle_icon_style_section_styling',
			array(
				'label'     => esc_html__( 'Toggle Icon/Hamburger', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select_toggle_canvas' => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_border',
			array(
				'label'     => esc_html__( 'Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'icon_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => esc_html__( 'None', 'theplus' ),
					'solid'  => esc_html__( 'Solid', 'theplus' ),
					'dotted' => esc_html__( 'Dotted', 'theplus' ),
					'dashed' => esc_html__( 'Dashed', 'theplus' ),
					'groove' => esc_html__( 'Groove', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,
					{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'icon_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3 span.menu_line' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'toggle_icon_style!' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg',
			)
		);
		$this->add_responsive_control(
			'icon_border_width',
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
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_border'        => 'yes',
					'icon_border_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,
					{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'icon_border'        => 'yes',
					'icon_border_style!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'icon_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,
					{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,
				{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover span.menu_line' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'toggle_icon_style!' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover,
				{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg:hover',
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover,
					{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg:hover' => 'border-color: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'icon_border'        => 'yes',
					'icon_border_style!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'icon_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover,
					{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover,
				{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'toggle_style_section_styling',
			array(
				'label'     => esc_html__( 'Toggle Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_control(
			'button_full_width',
			array(
				'label'     => esc_html__( 'Full Width Button', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '25',
					'bottom'   => '10',
					'left'     => '25',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn, {{WRAPPER}} span.btn-text',
			)
		);
		$this->add_control(
			'button_border',
			array(
				'label'     => esc_html__( 'Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => esc_html__( 'None', 'theplus' ),
					'solid'  => esc_html__( 'Solid', 'theplus' ),
					'dotted' => esc_html__( 'Dotted', 'theplus' ),
					'dashed' => esc_html__( 'Dashed', 'theplus' ),
					'groove' => esc_html__( 'Groove', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'button_border' => 'yes',
				),
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
			'button_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn',
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
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_border'        => 'yes',
					'button_border_style!' => 'none',
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
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_border'        => 'yes',
					'button_border_style!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn',
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
			'button_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover',
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'border-color: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'button_border'        => 'yes',
					'button_border_style!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label'     => esc_html__( 'Lottie', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'select_toggle_canvas' => 'lottie',
				),
			)
		);
		$this->add_control(
			'lottiedisplay',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Display', 'theplus' ),
				'default' => 'inline-block',
				'options' => array(
					'block'        => esc_html__( 'Block', 'theplus' ),
					'inline-block' => esc_html__( 'Inline Block', 'theplus' ),
					'flex'         => esc_html__( 'Flex', 'theplus' ),
					'inline-flex'  => esc_html__( 'Inline Flex', 'theplus' ),
					'initial'      => esc_html__( 'Initial', 'theplus' ),
					'inherit'      => esc_html__( 'Inherit', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'lottieWidth',
			array(
				'label'   => esc_html__( 'Width', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 50,
				),
			)
		);
		$this->add_responsive_control(
			'lottieHeight',
			array(
				'label'   => esc_html__( 'Height', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 50,
				),
			)
		);
		$this->add_responsive_control(
			'lottieSpeed',
			array(
				'label'   => esc_html__( 'Speed', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 1,
				),
			)
		);
		$this->add_control(
			'lottieLoop',
			array(
				'label'     => esc_html__( 'Loop Animation', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'lottiehover',
			array(
				'label'     => esc_html__( 'Hover Animation', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		/*lottie style*/
		$this->start_controls_section(
			'content_scrolling_bar_section_styling',
			array(
				'label' => esc_html__( 'Content Scrolling Bar', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			)
		);
		$this->add_control(
			'display_scrolling_bar',
			array(
				'label'     => esc_html__( 'Content Scrolling Bar', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->start_controls_tabs( 'tabs_scrolling_bar_style' );
		$this->start_controls_tab(
			'tab_scrolling_bar_scrollbar',
			array(
				'label'     => esc_html__( 'Scrollbar', 'theplus' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_scrollbar_width',
			array(
				'label'      => esc_html__( 'ScrollBar Width', 'theplus' ),
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
					'size' => 10,
				),
				'selectors'  => array(
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);	
		$this->add_control(
			'scroll_scrollbar_height',
			array(
				'label'      => esc_html__( 'ScrollBar Height', 'theplus' ),
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
					'size' => 10,
				),
				'selectors'  => array(
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_scrollbar_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_thumb',
			array(
				'label'     => esc_html__( 'Thumb', 'theplus' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_thumb_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-thumb',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_thumb_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_thumb_shadow',
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-thumb',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_track',
			array(
				'label'     => esc_html__( 'Track', 'theplus' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_track_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-track',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_track_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_track_shadow',
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-track',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'content_sticky_navigation_styling',
			array(
				'label' => esc_html__( 'Sticky Navigation Connection', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			)
		);
		$this->add_control(
			'Pop_stickNav_Note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note: This Option Is Related To Navigation Menu Widget’s Sticky Menu Settings.',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->start_controls_tabs( 'sticky_navigation_tabs' );
		$this->start_controls_tab(
			'sticky_navigation_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'sn_button_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sn_button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn',
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_control(
			'sn_button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
					'button_border'        => 'yes',
					'button_border_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1 span.menu_line,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2 span.menu_line,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3 span.menu_line' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style!'   => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sn_icon_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg',
				'condition' => array(
					'select_toggle_canvas' => 'icon',
				),
			)
		);
		$this->add_control(
			'sn_icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'icon_border'          => 'yes',
					'icon_border_style!'   => 'none',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sticky_navigation_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'sn_button_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sn_button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover',
				'condition' => array(
					'select_toggle_canvas' => 'button',
				),
			)
		);
		$this->add_control(
			'sn_button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'border-color: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'select_toggle_canvas' => 'button',
					'button_border'        => 'yes',
					'button_border_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sn_icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover span.menu_line,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover span.menu_line,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover span.menu_line' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'toggle_icon_style!'   => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sn_icon_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover,
				.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg:hover',
				'condition' => array(
					'select_toggle_canvas' => 'icon',
				),
			)
		);
		$this->add_control(
			'sn_icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-widget-tp-off-canvas .elementor-widget-container .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-custom .off-can-img-svg:hover' => 'border-color: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'select_toggle_canvas' => 'icon',
					'icon_border'          => 'yes',
					'icon_border_style!'   => 'none',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}


	/**
	 * Render Off Canvas
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$offset_time = wp_timezone_string();
		$widget_uid  = 'canvas-' . $this->get_id();
		$show_times  = ! empty( $settings['showTime'] ) ? $settings['showTime'] : '';

		$now  = new \DateTime( 'NOW', new \DateTimeZone( $offset_time ) );
		$flag = true;

		if ( 'yes' === $show_times ) {
			$date_start = new \DateTime( $settings['dateStart'], new \DateTimeZone( $offset_time ) );
			$date_end   = new \DateTime( $settings['dateEnd'], new \DateTimeZone( $offset_time ) );

			if ( ( $date_start <= $now ) && ( $now <= $date_end ) ) {
				$flag = true;
			} else {
				$flag = false;
			}
		}

		$content_id = $this->get_id();

		$exit   = ! empty( $settings['exit'] ) ? $settings['exit'] : 'no';
		$scroll = ! empty( $settings['scroll'] ) ? $settings['scroll'] : 'no';
		$fix_tb = ! empty( $settings['fixed_toggle_button'] ) ? $settings['fixed_toggle_button'] : '';

		$prevurl  = ! empty( $settings['prevurl'] ) ? $settings['prevurl'] : 'no';
		$show_swf = ! empty( $settings['show_scroll_window_offset'] ) ? $settings['show_scroll_window_offset'] : '';
		$pageload = ! empty( $settings['pageload'] ) ? $settings['pageload'] : 'no';
		$exted_id = ! empty( $settings['extraId'] ) ? $settings['extraId'] : '';
		$exted_ic = ! empty( $settings['extraIdClose'] ) ? $settings['extraIdClose'] : '';

		$pageviews  = ! empty( $settings['pageviews'] ) ? $settings['pageviews'] : 'no';
		$extraclick = ! empty( $settings['extraclick'] ) ? $settings['extraclick'] : 'no';
		$inactivity = ! empty( $settings['inactivity'] ) ? $settings['inactivity'] : 'no';

		$in_activity  = ! empty( $settings['inactivitySec'] ) ? $settings['inactivitySec'] : '';
		$content_cbox = ! empty( $settings['content_open_corner_box_direction'] ) ? $settings['content_open_corner_box_direction'] : 'top-left';

		$content_open_style  = ! empty( $settings['content_open_style'] ) ? $settings['content_open_style'] : 'slide';
		$fixed_toggle_button = ( 'yes' === $fix_tb ) ? 'position-fixed' : '';

		$display_scrolling_bar   = ( 'yes' !== $settings['display_scrolling_bar'] ) ? 'scroll-bar-disable' : '';
		$content_open_direction  = ! empty( $settings['content_open_direction'] ) ? $settings['content_open_direction'] : 'left';
		$event_esc_close_content = ( 'yes' === $settings['event_esc_close_content'] ) ? 'yes' : 'no';

		$scroll_top_offset_value   = ( 'yes' === $fix_tb && 'yes' === $show_swf ) ? 'data-scroll-view="' . esc_attr( $settings['scroll_top_offset_value']['size'] ) . '"' : '';
		$show_scroll_window_offset = ( 'yes' === $fix_tb && 'yes' === $show_swf ) ? 'scroll-view' : '';

		$event_body_click_close_content = ( 'yes' === $settings['event_body_click_close_content'] ) ? 'yes' : 'no';

		$extra_id = '';

		$previous_url   = '';
		$extra_id_close = '';
		$inactivity_sec = '';

		if ( 'yes' === $prevurl && ! empty( $settings['previousUrl']['url'] ) ) {
			$previous_url = $settings['previousUrl']['url'];
		}

		if ( 'yes' === $extraclick ) {
			$extra_id = $exted_id;
		}

		if ( 'yes' === $extraclick && ! empty( $exted_ic ) ) {
			$extra_id_close = $exted_ic;
		}

		if ( 'yes' === $inactivity && ! empty( $in_activity ) ) {
			$inactivity_sec = $in_activity;
		}

		if ( 'corner-box' === $content_open_style ) {
			$content_open_direction = $content_cbox;
		} elseif ( 'popup' === $content_open_style ) {
			$content_open_direction = 'popup';
		}
			include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$off_canvas = '';

		if ( ! empty( $flag ) ) {
			$uid = uniqid( 'canvas-' );
			$pvc = '';

			$pvc_style = '';

			$scroll_height = '';

			$scroling_size = ! empty( $settings['scrollHeight']['size'] ) ? $settings['scrollHeight']['size'] : '';
			if ( 'yes' === $scroll && ! empty( $scroling_size ) ) {
				$scroll_height = $scroling_size;
			}

			$page_viewcount = ! empty( $settings['pageViewsCount'] ) ? $settings['pageViewsCount'] : '';
			if ( 'yes' === $pageviews && ! empty( $page_viewcount ) ) {
				$pvc       = $page_viewcount;
				$pvc_style = 'style="display:none;"';
			}

			$sr = '';

			$srxtime = '';
			$srxdays = '';

			$inactiv_day   = ! empty( $settings['showXDays'] ) ? $settings['showXDays'] : '';
			$show_redirect = ! empty( $settings['showRestricted'] ) ? $settings['showRestricted'] : '';
			$number_oftime = ! empty( $settings['showXTimes'] ) ? $settings['showXTimes'] : '';

			if ( 'yes' === $show_redirect && ! empty( $number_oftime ) && ! empty( $inactiv_day ) ) {
				$sr = $show_redirect;

				$srxtime = $number_oftime;
				$srxdays = $inactiv_day;

				$pvc_style = 'style="display:none;"';
			}

			$data_attr = 'data-settings={"content_id":"' . esc_attr( $content_id ) . '","transition":"' . esc_attr( $content_open_style ) . '","direction":"' . esc_attr( $content_open_direction ) . '","esc_close":"' . esc_attr( $event_esc_close_content ) . '","body_click_close":"' . esc_attr( $event_body_click_close_content ) . '","trigger":"yes","tpageload":"' . esc_attr( $pageload ) . '","tscroll":"' . esc_attr( $scroll ) . '","scrollHeight":"' . esc_attr( $scroll_height ) . '","texit":"' . esc_attr( $exit ) . '","tinactivity":"' . esc_attr( $inactivity ) . '","tpageviews":"' . esc_attr( $pageviews ) . '","tpageviewscount":"' . esc_attr( $pvc ) . '","tprevurl":"' . esc_attr( $prevurl ) . '","previousUrl":"' . esc_attr( $previous_url ) . '","textraclick":"' . esc_attr( $extraclick ) . '","extraId":"' . esc_attr( $extra_id ) . '","extraIdClose":"' . esc_attr( $extra_id_close ) . '","inactivitySec":"' . esc_attr( $inactivity_sec ) . '","sr":"' . esc_attr( $sr ) . '","srxtime":"' . esc_attr( $srxtime ) . '","srxdays":"' . esc_attr( $srxdays ) . '"}';

			$toggle_content  = '';
			$select_togelbtn = ! empty( $settings['select_toggle_canvas'] ) ? $settings['select_toggle_canvas'] : 'button';

			$full_width_button = ( 'button' === $select_togelbtn && ! empty( $settings['button_full_width'] ) && 'yes' === $settings['button_full_width'] ) ? 'btn_full_width' : '';
			if ( 'button' === $select_togelbtn ) {
				$toggle_content .= '<div class="offcanvas-toggle-btn toggle-button-style ' . esc_attr( $fixed_toggle_button ) . ' ' . esc_attr( $full_width_button ) . '">';

					$toggle_content .= $this->render_text_one();

				$toggle_content .= '</div>';
			}

			$lottie_icon = $select_togelbtn;
			if ( 'lottie' === $lottie_icon ) {
				$ext = pathinfo( $settings['lottieUrl']['url'], PATHINFO_EXTENSION );
				if ( 'json' !== $ext ) {
					$toggle_content .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
				} else {
					$lottiedisplay = isset( $settings['lottiedisplay'] ) ? $settings['lottiedisplay'] : 'inline-block';
					$lottie_width  = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 50;
					$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 50;
					$lottie_speed  = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;
					$lottie_loop   = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : '';
					$lottie_hover  = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';

					$lottie_loop_value = '';

					if ( 'yes' === $lottie_loop ) {
						$lottie_loop_value = 'loop';
					}

					$lottie_anim = 'autoplay';
					if ( 'yes' === $lottie_hover ) {
						$lottie_anim = 'hover';
					}

					$toggle_content .= '<lottie-player src="' . esc_url( $settings['lottieUrl']['url'] ) . '" style="display: ' . esc_attr( $lottiedisplay ) . '; width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px;" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
				}
			}

			$toggle_ic = ! empty( $settings['toggle_icon_style'] ) ? $settings['toggle_icon_style'] : 'style-1';

			if ( 'icon' === $select_togelbtn && ! empty( $toggle_ic ) ) {
				if ( 'style-1' === $toggle_ic || 'style-2' === $toggle_ic || 'style-3' === $toggle_ic ) {
					$toggle_content .= '<div class="offcanvas-toggle-btn humberger-' . esc_attr( $toggle_ic ) . ' ' . esc_attr( $fixed_toggle_button ) . '">';

						$toggle_content .= '<span class="menu_line menu_line--top"></span>';
						$toggle_content .= '<span class="menu_line menu_line--center"></span>';
						$toggle_content .= '<span class="menu_line menu_line--bottom"></span>';

					$toggle_content .= '</div>';
				} elseif ( 'custom' === $toggle_ic ) {
					$toggle_content .= '<div class="offcanvas-toggle-btn humberger-' . esc_attr( $toggle_ic ) . ' ' . esc_attr( $fixed_toggle_button ) . '">';

					$alt = '';
					if ( ! empty( $settings['image_svg_icn']['id'] ) ) {
						$alt = get_post_meta( $settings['image_svg_icn']['id'], '_wp_attachment_image_alt', true );
					}

						$toggle_content .= '<img src="' . esc_url( $settings['image_svg_icn']['url'] ) . '" alt="' . esc_attr( $alt ) . '" class="off-can-img-svg" />';

					$toggle_content .= '</div>';
				}
			}

			$off_canvas = '<div class="plus-offcanvas-wrapper ' . esc_attr( $widget_uid ) . ' ' . esc_attr( $animated_class ) . ' ' . esc_attr( $show_scroll_window_offset ) . '" data-canvas-id="' . esc_attr( $widget_uid ) . '" ' . $data_attr . ' ' . $scroll_top_offset_value . ' ' . $animation_attr . ' ' . esc_attr( $pvc_style ) . '>';

			$off_canvas .= '<div class="offcanvas-toggle-wrap">';
			if ( 'lottie' === $lottie_icon ) {
				$off_canvas .= '<div class="offcanvas-toggle-btn custom-lottie">';
			}
					$off_canvas .= $toggle_content;
			if ( 'lottie' === $lottie_icon ) {
				$off_canvas .= '</div>';
			}
			$off_canvas .= '</div>';

			$popupdirclass = '';

			$content_dir_popup = ! empty( $settings['content_open_direction_popup'] ) ? $settings['content_open_direction_popup'] : 'center';
			if ( 'popup' === $content_open_style && ! empty( $content_dir_popup ) ) {
				$popupdirclass = ! empty( $content_dir_popup ) ? 'tp-popup-dir-' . $content_dir_popup : 'tp-popup-dir-center';
			}
			$popinanimation   = '';
			$popoutanimation  = '';
			$popinoutaniclass = '';

			$popoutanimationspeed = '';
			$popoutanimationdelay = '';

			$popinam     = ! empty( $settings['popinanimation'] ) ? $settings['popinanimation'] : 'none';
			$popoutin    = ! empty( $settings['popoutanimation'] ) ? $settings['popoutanimation'] : 'none';
			$popoutdely  = ! empty( $settings['popoutanimationdelay'] ) ? $settings['popoutanimationdelay'] : 'none';
			$popoutspeed = ! empty( $settings['popoutanimationspeed'] ) ? $settings['popoutanimationspeed'] : 'none';

			if ( 'none' !== $popinam || ( ! empty( $popoutin ) && 'none' !== $popoutin ) || 'none' !== $popoutdely || ( ! empty( $popoutspeed ) && 'none' !== $popoutspeed ) ) {
				$popinoutaniclass = 'tp_animate__animated';
				$popinanimation   = 'animate__' . $popinam;
				$popoutanimation  = 'animate__' . $popoutin;

				$popoutanimationdelay = 'animate__' . $popoutdely;
				$popoutanimationspeed = 'animate__' . $popoutspeed;
			}

			$off_canvas .= '<div class="plus-canvas-content-wrap ' . esc_attr( $popinoutaniclass ) . ' ' . esc_attr( $popinanimation ) . ' ' . esc_attr( $popoutanimation ) . ' tp-outer-' . esc_attr( $event_body_click_close_content ) . ' ' . esc_attr( $popupdirclass ) . ' plus-' . esc_attr( $content_id ) . ' plus-' . esc_attr( $content_open_direction ) . ' plus-' . esc_attr( $content_open_style ) . ' ' . esc_attr( $display_scrolling_bar ) . '">';

			$open_content_icon  = ! empty( $settings['open_content_close_icon_display'] ) ? $settings['open_content_close_icon_display'] : '';
			$open_content_close = ! empty( $settings['close_image_custom'] ) ? $settings['close_image_custom'] : 'no';

			if ( 'yes' === $open_content_icon ) {
				$sticky_btn = ! empty( $settings['open_close_icon_sticky'] && 'yes' === $settings['open_close_icon_sticky'] ) ? 'sticky-close-btn' : '';

				$close_icon_class = ( 'yes' === $open_content_close ) ? 'off-close-image' : '';
				$close_img_icon   = ! empty( $settings['close_image_custom_source']['url'] ) ? $settings['close_image_custom_source']['url'] : '';

				$off_canvas .= '<div class="plus-offcanvas-header direction-' . esc_attr( $settings['open_content_close_icon_align'] ) . ' ' . esc_attr( $sticky_btn ) . '"><div class="plus-offcanvas-close plus-offcanvas-close-' . esc_attr( $content_id ) . ' ' . esc_attr( $close_icon_class ) . '" role="button">';
				if ( 'yes' === $open_content_close && ! empty( $close_img_icon ) ) {
					$off_canvas .= '<img src="' . esc_url( $close_img_icon ) . '" class="close-custom_img"/>';
				}
				$off_canvas .= '</div></div>';
			}
			$content_temp        = ! empty( $settings['content_template'] ) ? $settings['content_template'] : '';
			$content_description = ! empty( $settings['content_description'] ) ? $settings['content_description'] : '';
			$content_template_id = ! empty( $settings['content_template_id'] ) ? $settings['content_template_id'] : '';

			$content_template_type = ! empty( $settings['content_template_type'] ) ? $settings['content_template_type'] : 'tp-template';

			if ( ! empty( $content_template_type ) ) {
				if ( 'tp-content' === $content_template_type && ! empty( $content_description ) ) {
					$off_canvas .= '<div class="plus-content-editor">' . wp_kses_post( $content_description ) . '</div>';
				} elseif ( 'tp-manually' === $content_template_type && ! empty( $content_template_id ) ) {
					$off_canvas .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $content_template_id, 24, -2 ) ) . '</div>';
				} elseif ( ! empty( $content_temp ) ) {
					$off_canvas .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_temp ) . '</div>';
				}
			}
				$off_canvas .= '</div>';

			$off_canvas .= '</div>';

			if ( 'yes' === $fix_tb ) {
				$off_canvas .= '<style>';

				$rpos = 'auto';
				$bpos = 'auto';
				$ypos = 'auto';
				$xpos = 'auto';

				$d_top_auto  = ! empty( $settings['d_top_auto'] ) ? $settings['d_top_auto'] : '';
				$d_left_auto = ! empty( $settings['d_left_auto'] ) ? $settings['d_left_auto'] : '';

				$d_right_auto  = ! empty( $settings['d_right_auto'] ) ? $settings['d_right_auto'] : '';
				$d_button_auto = ! empty( $settings['d_bottom_auto'] ) ? $settings['d_bottom_auto'] : '';

				if ( 'yes' === $d_left_auto ) {
					if ( ! empty( $settings['d_pos_xposition']['size'] ) || '0' === $settings['d_pos_xposition']['size'] ) {
						$xpos = $settings['d_pos_xposition']['size'] . $settings['d_pos_xposition']['unit'];
					}
				}

				if ( 'yes' === $d_top_auto ) {
					if ( ! empty( $settings['d_pos_yposition']['size'] ) || '0' === $settings['d_pos_yposition']['size'] ) {
						$ypos = $settings['d_pos_yposition']['size'] . $settings['d_pos_yposition']['unit'];
					}
				}

				if ( 'yes' === $d_button_auto ) {
					if ( ! empty( $settings['d_pos_bottomposition']['size'] ) || '0' === $settings['d_pos_bottomposition']['size'] ) {
						$bpos = $settings['d_pos_bottomposition']['size'] . $settings['d_pos_bottomposition']['unit'];
					}
				}

				if ( 'yes' === $d_right_auto ) {
					if ( ! empty( $settings['d_pos_rightposition']['size'] ) || '0' === $settings['d_pos_rightposition']['size'] ) {
						$rpos = $settings['d_pos_rightposition']['size'] . $settings['d_pos_rightposition']['unit'];
					}
				}

				$off_canvas .= '.' . esc_attr( $widget_uid ) . ' .offcanvas-toggle-wrap .offcanvas-toggle-btn.position-fixed{top:' . esc_attr( $ypos ) . ';bottom:' . esc_attr( $bpos ) . ';left:' . esc_attr( $xpos ) . ';right:' . esc_attr( $rpos ) . ';}';

				$responsiv_t = ! empty( $settings['t_responsive'] ) ? $settings['t_responsive'] : '';
				if ( 'yes' === $responsiv_t ) {
					$tablet_xpos = 'auto';
					$tablet_ypos = 'auto';
					$tablet_bpos = 'auto';
					$tablet_rpos = 'auto';

					if ( 'yes' === $settings['t_left_auto'] ) {
						if ( ! empty( $settings['t_pos_xposition']['size'] ) || '0' === $settings['t_pos_xposition']['size'] ) {
							$tablet_xpos = $settings['t_pos_xposition']['size'] . $settings['t_pos_xposition']['unit'];
						}
					}

					if ( 'yes' === $settings['t_top_auto'] ) {
						if ( ! empty( $settings['t_pos_yposition']['size'] ) || '0' === $settings['t_pos_yposition']['size'] ) {
							$tablet_ypos = $settings['t_pos_yposition']['size'] . $settings['t_pos_yposition']['unit'];
						}
					}

					if ( 'yes' === $settings['t_bottom_auto'] ) {
						if ( ! empty( $settings['t_pos_bottomposition']['size'] ) || '0' === $settings['t_pos_bottomposition']['size'] ) {
							$tablet_bpos = $settings['t_pos_bottomposition']['size'] . $settings['t_pos_bottomposition']['unit'];
						}
					}

					if ( 'yes' === $settings['t_right_auto'] ) {
						if ( ! empty( $settings['t_pos_rightposition']['size'] ) || '0' === $settings['t_pos_rightposition']['size'] ) {
							$tablet_rpos = $settings['t_pos_rightposition']['size'] . $settings['t_pos_rightposition']['unit'];
						}
					}

					$off_canvas .= '@media (min-width:601px) and (max-width:990px){.' . esc_attr( $widget_uid ) . ' .offcanvas-toggle-wrap .offcanvas-toggle-btn.position-fixed{top:' . esc_attr( $tablet_ypos ) . ';bottom:' . esc_attr( $tablet_bpos ) . ';left:' . esc_attr( $tablet_xpos ) . ';right:' . esc_attr( $tablet_rpos ) . ';}';

					$off_canvas .= '}';
				}

				$m_responsive = ! empty( $settings['m_responsive'] ) ? $settings['m_responsive'] : '';
				if ( 'yes' === $m_responsive ) {
					$mobile_xpos = 'auto';
					$mobile_ypos = 'auto';
					$mobile_bpos = 'auto';
					$mobile_rpos = 'auto';

					if ( 'yes' === $settings['m_left_auto'] ) {
						if ( ! empty( $settings['m_pos_xposition']['size'] ) || '0' === $settings['m_pos_xposition']['size'] ) {
							$mobile_xpos = $settings['m_pos_xposition']['size'] . $settings['m_pos_xposition']['unit'];
						}
					}

					if ( 'yes' === $settings['m_top_auto'] ) {
						if ( ! empty( $settings['m_pos_yposition']['size'] ) || '0' === $settings['m_pos_yposition']['size'] ) {
							$mobile_ypos = $settings['m_pos_yposition']['size'] . $settings['m_pos_yposition']['unit'];
						}
					}

					if ( 'yes' === $settings['m_bottom_auto'] ) {
						if ( ! empty( $settings['m_pos_bottomposition']['size'] ) || '0' === $settings['m_pos_bottomposition']['size'] ) {
							$mobile_bpos = $settings['m_pos_bottomposition']['size'] . $settings['m_pos_bottomposition']['unit'];
						}
					}

					if ( 'yes' === $settings['m_right_auto'] ) {
						if ( ! empty( $settings['m_pos_rightposition']['size'] ) || '0' === $settings['m_pos_rightposition']['size'] ) {
							$mobile_rpos = $settings['m_pos_rightposition']['size'] . $settings['m_pos_rightposition']['unit'];
						}
					}
					$off_canvas .= '@media (max-width:600px){.' . esc_attr( $widget_uid ) . ' .offcanvas-toggle-wrap .offcanvas-toggle-btn.position-fixed{top:' . esc_attr( $mobile_ypos ) . ';bottom:' . esc_attr( $mobile_bpos ) . ';left:' . esc_attr( $mobile_xpos ) . ';right:' . esc_attr( $mobile_rpos ) . ';}';

					$off_canvas .= '}';
				}
				$off_canvas .= '</style>';
			}

			$onclick_close = ! empty( $settings['click_offcanvas_close'] ) ? $settings['click_offcanvas_close'] : '';
			if ( 'yes' === $onclick_close ) {
				$off_canvas .= '<script type="text/javascript">';

					$off_canvas .= 'jQuery(document).ready(function(i){
									"use strict";
									jQuery(".plus-content-editor a:not(.dropdown-toggle),.plus-content-editor .tp-search-filter .tp-range-silder").on("click",function(){							
										jQuery(this).closest(".plus-canvas-content-wrap").find( ".plus-offcanvas-close").trigger( "click" );
									})
									
									jQuery(".plus-content-editor .tp-search-filter .tp-search-form").on("change",function(){
										jQuery(this).closest(".plus-canvas-content-wrap").find( ".plus-offcanvas-close").trigger( "click" );
									})';
					$off_canvas .= '});';

				$off_canvas .= '</script>';
			}
		}
		echo $off_canvas;
	}

	/**
	 * Render_text_one
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function render_text_one() {
		$settings = $this->get_settings_for_display();

		$icons_after  = '';
		$icons_before = '';
		$button_text  = '';
		$before_after = ! empty( $settings['button_before_after'] ) ? $settings['button_before_after'] : '';
		$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';

		$icons    = '';
		$btn_icon = ! empty( $settings['button_icon_style'] ) ? $settings['button_icon_style'] : '';

		if ( 'font_awesome' === $btn_icon ) {
			$icons = $settings['button_icon'];
		} elseif ( 'icon_mind' === $btn_icon ) {
			$icons = $settings['button_icons_mind'];
		} elseif ( 'font_awesome_5' === $btn_icon ) {
			ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
			ob_end_clean();
		}

		if ( 'before' === $before_after && ! empty( $icons ) ) {
			if ( 'font_awesome_5' === $btn_icon ) {
				$icons_before = '<span class="btn-icon button-before">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
			}
		}
		if ( 'after' === $before_after && ! empty( $icons ) ) {
			if ( 'font_awesome_5' === $btn_icon ) {
				$icons_after = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
		}

		$button_text = $icons_before . '<span class="btn-text">' . wp_kses_post( $button_text ) . '</span>' . $icons_after;

		return $button_text;
	}
}
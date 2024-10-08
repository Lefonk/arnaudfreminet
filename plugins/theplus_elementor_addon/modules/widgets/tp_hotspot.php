<?php
/**
 * Widget Name: Hotspot.
 * Description: Style of pin point tooltips.
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

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Hotspot.
 */
class ThePlus_Hotspot extends Widget_Base {

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
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-hotspot';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Hotspot', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-thumb-tack theplus_backend_icon';
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
	 * Get Widget Categories.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keywords.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Hotspot', 'Pin Point', 'Marker', 'Location', 'Pointer', 'Indicator', 'Map', 'Navigation', 'Interactive', 'Clickable', 'Tooltip', 'Information', 'Icon' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hotspot_image',
			array(
				'label'   => esc_html__( 'Hotspot Image', 'theplus' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'exclude'   => array( 'custom' ),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'pin_title',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '', 'theplus' ),
				'placeholder' => esc_html__( 'Pin Title', 'theplus' ),
			)
		);
		$repeater->add_control(
			'layer_position',
			array(
				'label' => esc_html__( 'Pin Position', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$repeater->add_control(
			'select_option',
			array(
				'label'   => esc_html__( 'Pin Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					'icon'   => esc_html__( 'Icon', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'text'   => esc_html__( 'Text', 'theplus' ),
					'lottie' => esc_html__( 'Lottie', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'lottieUrl',
			array(
				'label'       => esc_html__( 'Lottie URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array( 'select_option' => 'lottie' ),
			)
		);
		$repeater->add_control(
			'icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
				),
				'condition' => array(
					'select_option' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome',
			array(
				'label'       => esc_html__( 'Icon', 'theplus' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => false,
				'default'     => 'fa fa-chevron-right',
				'condition'   => array(
					'select_option' => 'icon',
					'icon_style'    => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'select_option' => 'icon',
					'icon_style'    => 'font_awesome_5',
				),
			)
		);
		$repeater->add_control(
			'icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'select_option' => 'icon',
					'icon_style'    => 'icon_mind',
				),
			)
		);
		$repeater->add_control(
			'pin_image',
			array(
				'label'     => wp_kses_post( "Pin Image <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-an-image-as-a-hotspot-pin-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'pin_image_hover',
			array(
				'label'     => esc_html__( 'Pin Hover Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'pin_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'pin_text',
			array(
				'label'     => wp_kses_post( "Pin Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-text-as-a-hotspot-pin-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Theplus', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->start_controls_tabs( 'icon_style_options' );
		$repeater->start_controls_tab(
			'icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$repeater->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner .pin-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner .pin-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$repeater->add_control(
			'pin_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner .pin-loop-content' => 'background: {{VALUE}}',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$repeater->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner:hover .pin-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner:hover .pin-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$repeater->add_control(
			'pin_hover_bg_color',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner:hover .pin-loop-content' => 'background: {{VALUE}}',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->start_controls_tabs( 'responsive_device' );
		$repeater->start_controls_tab(
			'normal',
			array(
				'label' => esc_html__( 'Desktop', 'theplus' ),
			)
		);
		/** Desktop Start*/
		$repeater->add_control(
			'd_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$repeater->add_control(
			'd_pos_xposition',
			array(
				'label'     => esc_html__( 'Left', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 40,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_left_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'd_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$repeater->add_control(
			'd_pos_rightposition',
			array(
				'label'     => esc_html__( 'Right', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 40,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_right_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'd_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$repeater->add_control(
			'd_pos_yposition',
			array(
				'label'     => esc_html__( 'Top', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 20,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_top_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'd_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$repeater->add_control(
			'd_pos_bottomposition',
			array(
				'label'     => esc_html__( 'Bottom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 20,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_bottom_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();

		/** Tablet Start*/
		$repeater->start_controls_tab(
			'tablet',
			array(
				'label' => esc_html__( 'Tablet', 'theplus' ),
			)
		);
		$repeater->add_control(
			't_responsive',
			array(
				'label'     => esc_html__( 'Responsive Values', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$repeater->add_control(
			't_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_pos_xposition',
			array(
				'label'     => esc_html__( 'Left', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
					't_left_auto'  => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_pos_rightposition',
			array(
				'label'     => esc_html__( 'Right', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
					't_right_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_pos_yposition',
			array(
				'label'     => esc_html__( 'Top', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
					't_top_auto'   => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			't_pos_bottomposition',
			array(
				'label'     => esc_html__( 'Bottom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive'  => array( 'yes' ),
					't_bottom_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();

		/** Mobile Start*/
		$repeater->start_controls_tab(
			'mobile',
			array(
				'label' => esc_html__( 'Mobile', 'theplus' ),
			)
		);
		$repeater->add_control(
			'm_responsive',
			array(
				'label'     => esc_html__( 'Responsive Values', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$repeater->add_control(
			'm_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_pos_xposition',
			array(
				'label'     => esc_html__( 'Left', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
					'm_left_auto'  => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_pos_rightposition',
			array(
				'label'     => esc_html__( 'Right', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
					'm_right_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_pos_yposition',
			array(
				'label'     => esc_html__( 'Top', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
					'm_top_auto'   => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'm_pos_bottomposition',
			array(
				'label'     => esc_html__( 'Bottom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive'  => array( 'yes' ),
					'm_bottom_auto' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		/** Pint Content Start*/
		$repeater->add_control(
			'pin_content_options',
			array(
				'label'     => esc_html__( 'Pin Content', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->start_controls_tabs( 'plus_tooltip_tabs' );
		$repeater->start_controls_tab(
			'plus_tooltip_content_tab',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_type',
			array(
				'label'   => esc_html__( 'Content Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal_desc',
				'options' => array(
					'normal_desc'     => esc_html__( 'Content Text', 'theplus' ),
					'content_wysiwyg' => esc_html__( 'Content WYSIWYG', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_desc',
			array(
				'label'     => esc_html__( 'Description', 'theplus' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'default'   => esc_html__( 'Luctus nec ullamcorper mattis', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_wysiwyg',
			array(
				'label'     => esc_html__( 'Tooltip Content', 'theplus' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'plus_tooltip_content_type' => 'content_wysiwyg',
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_align',
			array(
				'label'       => esc_html__( 'Text Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'center',
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
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				),
				'condition'   => array(
					'plus_tooltip_content_type' => 'normal_desc',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'plus_tooltip_content_typography',
				'selector'  => '{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content',
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'plus_tooltip_styles_tab',
			array(
				'label' => esc_html__( 'Style', 'theplus' ),
			)
		);
		$repeater->add_group_control(
			\Theplus_Tooltips_Option_Group::get_type(),
			array(
				'label'     => wp_kses_post( "Tooltip Options <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "hotspot-tooltip-on-click-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'name'        => 'tooltip_opt',
				'render_type' => 'template',
			)
		);
		$repeater->add_group_control(
			\Theplus_Loop_Tooltips_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Style Options', 'theplus' ),
				'name'        => 'tooltip_style',
				'render_type' => 'template',
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'extra_options',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'image_effect',
			array(
				'label'   => esc_html__( 'Continues Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal-drop_waves',
				'options' => array(
					''                  => esc_html__( 'None', 'theplus' ),
					'pulse'             => esc_html__( 'Pulse', 'theplus' ),
					'floating'          => esc_html__( 'Floating', 'theplus' ),
					'tossing'           => esc_html__( 'Tossing', 'theplus' ),
					'normal-drop_waves' => esc_html__( 'Normal Drop Waves', 'theplus' ),
					'image-drop_waves'  => esc_html__( 'Continue Drop Waves', 'theplus' ),
					'hover_drop_waves'  => esc_html__( 'Hover Drop Waves', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'drop_waves_color',
			array(
				'label'     => esc_html__( 'Drop Wave Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner.hover_drop_waves:after,{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner.normal-drop_waves:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'image_effect' => array( 'normal-drop_waves', 'image-drop_waves', 'hover_drop_waves' ),
				),
			)
		);
		$repeater->add_control(
			'hs_link_switch',
			array(
				'label'     => esc_html__( 'Link', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'hs_link',
			array(
				'label'       => esc_html__( 'Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'hs_link_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'pin_hotspot',
			array(
				'label'       => esc_html__( 'Add Multiple Pin Hotspot', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'description' => 'Add Pin Sections with Positions.',
				'default'     => array(
					'select_option' => 'icon',
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{pin_title}}}',
			)
		);
		$this->end_controls_section();

		/** Icon Style Start*/
		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label' => esc_html__( 'Pin Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pin_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 25,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font .pin-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font .pin-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Pin Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 40,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'icon_radius',
			array(
				'label'      => esc_html__( 'Icon Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font,{{WRAPPER}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-loop-inner.hover_drop_waves:hover:after,{{WRAPPER}} .pin-loop-inner.normal-drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content.pin-icon-font',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Pin Image Style Start*/
		$this->start_controls_section(
			'section_pin_image_styling',
			array(
				'label' => esc_html__( 'Pin Image', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pin_image_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Pin Image Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 25,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image img.pin-icon' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pin_image_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Pin Image Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 60,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image,{{WRAPPER}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-loop-inner.hover_drop_waves:hover:after,{{WRAPPER}} .pin-loop-inner.normal-drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image',
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
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content.pin-icon-image',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Pin Text Style Start*/
		$this->start_controls_section(
			'section_text_styling',
			array(
				'label' => esc_html__( 'Pin Text', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Text Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text .pin-icon',
			)
		);
		$this->add_control(
			'text_padding',
			array(
				'label'      => esc_html__( 'Text Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'text_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text,{{WRAPPER}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-loop-inner.hover_drop_waves:hover:after,{{WRAPPER}} .pin-loop-inner.normal-drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_text_style' );
		$this->start_controls_tab(
			'tab_text_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'text_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_text_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'text_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content.pin-icon-text',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Pin Lottie Style Start*/
		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label' => esc_html__( 'Lottie', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'size' => 25,
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
					'size' => 25,
				),
			)
		);
		$this->add_control(
			'lottieVertical',
			array(
				'label'   => esc_html__( 'Vertical Align', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'middle',
				'options' => array(
					'top'    => esc_html__( 'Top', 'theplus' ),
					'middle' => esc_html__( 'Middle', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
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

		/** Common Style Option Start*/
		$this->start_controls_section(
			'section_common_styling',
			array(
				'label' => esc_html__( 'Common Styling', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'cs_icon_heading',
			array(
				'label' => esc_html__( 'Icon/Text', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->start_controls_tabs( 'cs_icon_tabs' );
		$this->start_controls_tab(
			'cs_icon_normal',
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
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content .pin-icon' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_background',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cs_drop_waves_color',
			array(
				'label'     => esc_html__( 'Drop Wave Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:after' => 'background: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'cs_icon_hover',
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
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content .pin-icon' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_background_h',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content' => 'background: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'cs_pin_content_heading',
			array(
				'label'     => esc_html__( 'Pin Content', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cs_tooltip_typography',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .tippy-popper .tippy-content',
			)
		);
		$this->add_control(
			'cs_tooltip_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop .tippy-popper .tippy-content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cs_tooltip_background',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pin-hotspot-loop .tippy-popper .tippy-tooltip' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cs_tooltip_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .tippy-popper .tippy-tooltip',
			)
		);
		$this->add_responsive_control(
			'cs_tooltip_border_r',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pin-hotspot-loop .tippy-popper .tippy-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cs_tooltip_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .tippy-popper .tippy-tooltip',
			)
		);
		$this->add_control(
			'cs_tooltip_box_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'cs_tooltip_box_bf_blur',
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
					'cs_tooltip_box_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'cs_tooltip_box_bf_grayscale',
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
					'{{WRAPPER}} .pin-hotspot-loop .tippy-popper' => '-webkit-backdrop-filter:grayscale({{cs_tooltip_box_bf_grayscale.SIZE}})  blur({{cs_tooltip_box_bf_blur.SIZE}}{{cs_tooltip_box_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{cs_tooltip_box_bf_grayscale.SIZE}})  blur({{cs_tooltip_box_bf_blur.SIZE}}{{cs_tooltip_box_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'cs_tooltip_box_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->add_control(
			'cs_tooltip_arrows_color',
			array(
				'label'     => esc_html__( 'Arrows Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tippy-popper[x-placement^=left] .tippy-arrow' => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .tippy-popper[x-placement^=right] .tippy-arrow' => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}} .tippy-popper[x-placement^=top] .tippy-arrow' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .tippy-popper[x-placement^=bottom] .tippy-arrow' => 'border-bottom-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		/** Extra Option Start*/
		$this->start_controls_section(
			'section_extra_option_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'overlay_color_option',
			array(
				'label'     => esc_html__( 'Hover Overlay Color', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'overlay_background',
				'label'     => esc_html__( 'Overlay Background Color', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-hotspot .theplus-hotspot-inner:after',
				'condition' => array(
					'overlay_color_option' => 'yes',
				),
			)
		);
		$this->add_control(
			'tooltip_delay_visible',
			array(
				'label'     => __( 'Tooltip Visibility Delay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),
			)
		);
		$this->add_control(
			'tooltip_delay_time',
			array(
				'label'      => __( 'Delay Timeout', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array(
					's' => array(
						'min'  => 0,
						'max'  => 15,
						'step' => 0.01,
					),
				),
				'default'    => array(
					'unit' => 's',
					'size' => 0,
				),
				'condition'  => array(
					'tooltip_delay_visible' => 'yes',
				),
			)
		);
		$this->add_control(
			'hot_spot_transform',
			array(
				'label'       => esc_html__( 'Transform css', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'rotate(360deg)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};transform-style: preserve-3d;-ms-transform-style: preserve-3d;-moz-transform-style: preserve-3d;-webkit-transform-style: preserve-3d;',
				),
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();

		/** On Scroll Animation Option*/
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
				'label'   => esc_html__( 'Choose Animation Effect', 'theplus' ),
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
			'as_switch',
			array(
				'label'     => esc_html__( 'Animation Stagger', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!' => 'no-animation',
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
					'animation_effects!' => array( 'no-animation' ),
					'as_switch'          => 'yes',
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
		$this->add_control(
			'animation_out_effects',
			array(
				'label'     => esc_html__( 'Out Animation Effect', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'no-animation',
				'options'   => theplus_get_out_animation_options(),
				'separator' => 'before',
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Out Animation Delay', 'theplus' ),
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
					'animation_effects!'     => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_duration_default',
			array(
				'label'     => esc_html__( 'Out Animation Duration', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!'     => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_duration',
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
					'animation_effects!'             => 'no-animation',
					'animation_out_effects!'         => 'no-animation',
					'animation_out_duration_default' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Process/Steps.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$overlay_color_option   = 'yes' === $settings['overlay_color_option'] ? 'overlay-bg-color' : '';
		$animated_strager_class = '';

		$animation_effects = isset( $settings['animation_effects'] ) ? $settings['animation_effects'] : 'no-animation';
		$animation_delay   = isset( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		if ( 'no-animation' === $animation_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = theplus_scroll_animation();
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $animation_effects ) . '" data-animate-delay="' . esc_attr( $animation_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( ! empty( $settings['as_switch'] ) && 'yes' === $settings['as_switch'] ) {
				$animation_attr .= ' data-animate-columns="stagger"';
				$animation_attr .= ' data-animate-stagger="' . esc_attr( ( isset( $settings['animation_stagger']['size'] ) ) ? $settings['animation_stagger']['size'] : 150 ) . '"';

				$animated_strager_class = 'animated-columns';
			}

			if ( 'yes' === $settings['animation_duration_default'] ) {
				$animate_duration = isset( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
				$animation_attr  .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( ! empty( $settings['animation_out_effects'] ) && 'no-animation' !== $settings['animation_out_effects'] ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $settings['animation_out_effects'] ) . '" data-animate-out-delay="' . esc_attr( ( isset( $settings['animation_out_delay']['size'] ) ) ? $settings['animation_out_delay']['size'] : 50 ) . '"';
				if ( 'yes' === $settings['animation_out_duration_default'] ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( ( isset( $settings['animation_out_duration']['size'] ) ) ? $settings['animation_out_duration']['size'] : 50 ) . '"';
				}
			}
		}

		$pin_loop = '';
		if ( ! empty( $settings['pin_hotspot'] ) ) {
			$index = 0;

			foreach ( $settings['pin_hotspot'] as $item ) {
				$css_loop = '';
				$list_img = '';
				$uid_loop = uniqid( 'pin' ) . $item['_id'];

				$select_option   = '';
				$list_img_hover  = '';
				$continue_effect = '';

				if ( ! empty( $item['image_effect'] ) ) {
					$continue_effect = $item['image_effect'];
				}

				$this->add_render_attribute( '_tooltip', 'data-tippy', '', true );

				if ( ! empty( $item['plus_tooltip_content_type'] ) && 'normal_desc' === $item['plus_tooltip_content_type'] ) {
					$this->add_render_attribute( '_tooltip', 'title', theplus_senitize_js_input( $item['plus_tooltip_content_desc'] ), true );
				} elseif ( ! empty( $item['plus_tooltip_content_type'] ) && 'content_wysiwyg' === $item['plus_tooltip_content_type'] ) {
					$tooltip_content = $item['plus_tooltip_content_wysiwyg'];
					$this->add_render_attribute( '_tooltip', 'title', theplus_senitize_js_input( $tooltip_content ), true );
				}

				$plus_tooltip_position = ! empty( $item['tooltip_opt_plus_tooltip_position'] ) ? $item['tooltip_opt_plus_tooltip_position'] : 'top';
				$this->add_render_attribute( '_tooltip', 'data-tippy-placement', $plus_tooltip_position, true );

				$tooltip_interactive = ( '' === $item['tooltip_opt_plus_tooltip_interactive'] || 'yes' === $item['tooltip_opt_plus_tooltip_interactive'] ) ? 'true' : 'false';
				$this->add_render_attribute( '_tooltip', 'data-tippy-interactive', $tooltip_interactive, true );

				$plus_tooltip_theme = ! empty( $item['tooltip_opt_plus_tooltip_theme'] ) ? $item['tooltip_opt_plus_tooltip_theme'] : 'dark';
				$this->add_render_attribute( '_tooltip', 'data-tippy-theme', $plus_tooltip_theme, true );

				$tooltip_arrow = ( 'none' !== $item['tooltip_opt_plus_tooltip_arrow'] || '' === $item['tooltip_opt_plus_tooltip_arrow'] ) ? 'true' : 'false';
				$this->add_render_attribute( '_tooltip', 'data-tippy-arrow', $tooltip_arrow, true );

				$plus_tooltip_arrow = ! empty( $item['tooltip_opt_plus_tooltip_arrow'] ) ? $item['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
				$this->add_render_attribute( '_tooltip', 'data-tippy-arrowtype', $plus_tooltip_arrow, true );

				$plus_tooltip_animation = ! empty( $item['tooltip_opt_plus_tooltip_animation'] ) ? $item['tooltip_opt_plus_tooltip_animation'] : 'shift-toward';
				$this->add_render_attribute( '_tooltip', 'data-tippy-animation', $plus_tooltip_animation, true );

				$plus_tooltip_x_offset = ! empty( $item['tooltip_opt_plus_tooltip_x_offset'] ) ? $item['tooltip_opt_plus_tooltip_x_offset'] : 0;
				$plus_tooltip_y_offset = ! empty( $item['tooltip_opt_plus_tooltip_y_offset'] ) ? $item['tooltip_opt_plus_tooltip_y_offset'] : 0;
				$this->add_render_attribute( '_tooltip', 'data-tippy-offset', $plus_tooltip_x_offset . ',' . $plus_tooltip_y_offset, true );

				$tooltip_duration_in  = ! empty( $item['tooltip_opt_plus_tooltip_duration_in'] ) ? $item['tooltip_opt_plus_tooltip_duration_in'] : 250;
				$tooltip_duration_out = ! empty( $item['tooltip_opt_plus_tooltip_duration_out'] ) ? $item['tooltip_opt_plus_tooltip_duration_out'] : 200;
				$tooltip_trigger      = ! empty( $item['tooltip_opt_plus_tooltip_triggger'] ) ? $item['tooltip_opt_plus_tooltip_triggger'] : 'mouseenter';
				$tooltip_arrowtype    = ! empty( $item['tooltip_opt_plus_tooltip_arrow'] ) ? $item['tooltip_opt_plus_tooltip_arrow'] : 'sharp';

				if ( 'icon' === $item['select_option'] ) {
					$icons = '';
					if ( ! empty( $item['icon_style'] ) && 'font_awesome' === $item['icon_style'] ) {
						$icons = $item['icon_fontawesome'];
					} elseif ( ! empty( $item['icon_style'] ) && 'icon_mind' === $item['icon_style'] ) {
						$icons = $item['icons_mind'];
					} elseif ( ! empty( $item['icon_style'] ) && 'font_awesome_5' === $item['icon_style'] ) {
						ob_start();
							\Elementor\Icons_Manager::render_icon( $item['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
							$icons = ob_get_contents();
						ob_end_clean();
					}
					if ( ! empty( $item['icon_style'] ) && 'font_awesome_5' === $item['icon_style'] ) {
						$list_img = '<span class="pin-icon" >' . $icons . '</span>';
					} else {
						$list_img = '<i class=" ' . esc_attr( $icons ) . ' pin-icon" ></i>';
					}

					$select_option = 'pin-icon-font';
				} elseif ( 'image' === $item['select_option'] ) {
					$image = '';
					if ( ! empty( $item['pin_image']['url'] ) ) {
						$image_id = $item['pin_image']['id'];
						$image    = tp_get_image_rander( $image_id, $item['pin_thumbnail_size'], array( 'class' => 'pin-icon pin-normal-icon' ) );
					}

					$imagehover = '';
					if ( ! empty( $item['pin_image_hover']['url'] ) ) {
						$imagehover_id = $item['pin_image_hover']['id'];
						$imagehover    = tp_get_image_rander( $imagehover_id, $item['pin_thumbnail_size'], array( 'class' => 'pin-icon pin-icon-hover pin-hover-icon' ) );
					}

					$list_img = $image;

					$list_img_hover = $imagehover;
					$select_option  = 'pin-icon-image';
				} elseif ( 'text' === $item['select_option'] ) {
					$text = '';
					if ( ! empty( $item['pin_text'] ) ) {
						$text = $item['pin_text'];
					}
					$list_img      = '<div class="pin-icon ">' . esc_html( $text ) . '</div>';
					$select_option = 'pin-icon-text';
				} elseif ( isset( $item['select_option'] ) && 'lottie' === $item['select_option'] ) {
					$ext = pathinfo( $item['lottieUrl']['url'], PATHINFO_EXTENSION );
					if ( 'json' !== $ext ) {
						$list_img .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
					} else {
						$lottie_loop  = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : 'no';
						$lottiehover  = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';
						$lottie_width = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 25;
						$lottie_speed = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;

						$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 25;
						$lottiedisplay = isset( $settings['lottiedisplay'] ) ? $settings['lottiedisplay'] : 'inline-block';

						$lottie_vertical   = isset( $settings['lottieVertical'] ) ? $settings['lottieVertical'] : 'middle';
						$lottie_loop_value = '';
						if ( ! empty( $settings['lottieLoop'] ) && 'yes' === $settings['lottieLoop'] ) {
							$lottie_loop_value = 'loop';
						}
						$lottie_anim = 'autoplay';
						if ( ! empty( $settings['lottiehover'] ) && 'yes' === $settings['lottiehover'] ) {
							$lottie_anim = 'hover';
						}
						$list_img .= '<lottie-player src="' . esc_url( $item['lottieUrl']['url'] ) . '" style="display: ' . esc_attr( $lottiedisplay ) . '; width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px; vertical-align: ' . esc_attr( $lottie_vertical ) . ';" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
					}
				}

				$link   = '';
				$target = '';

				$nofollow = '';
				$link_key = 'link_' . $index;
				if ( ! empty( $item['hs_link_switch'] ) && 'yes' === $item['hs_link_switch'] ) {
					if ( ! empty( $item['hs_link']['url'] ) ) {
						$this->add_link_attributes( $link_key, $item['hs_link'] );
					}
				}

				if ( ( ! empty( $item['hs_link_switch'] ) && 'yes' === $item['hs_link_switch'] ) && ! empty( $item['hs_link']['url'] ) ) {
					$pin_loop .= '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
				}

				$hoverclass = '';
				if ( 'image' === $item['select_option'] && ! empty( $item['pin_image_hover']['url'] ) ) {
					$hoverclass = ' tp-hover-image-exists';
				}

				$pin_loop .= '<div id="' . esc_attr( $uid_loop ) . '" class="pin-hotspot-loop ' . esc_attr( $hoverclass ) . ' ' . esc_attr( $uid_loop ) . ' elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $animated_strager_class ) . '" ' . $this->get_render_attribute_string( '_tooltip' ) . '>';

					$pin_loop .= '<div class="pin-loop-inner ' . esc_attr( $continue_effect ) . '">';

						$pin_loop .= '<div class="pin-loop-content ' . esc_attr( $select_option ) . '">';

							$pin_loop .= $list_img;

							$pin_loop .= $list_img_hover;

						$pin_loop .= '</div>';

					$pin_loop .= '</div>';

				$pin_loop .= '</div>';

				if ( ( ! empty( $item['hs_link_switch'] ) && 'yes' === $item['hs_link_switch'] ) && ! empty( $item['hs_link']['url'] ) ) {
					$pin_loop .= '</a>';
				}

				$rpos = 'auto';
				$bpos = 'auto';
				$ypos = 'auto';
				$xpos = 'auto';

				if ( 'yes' === $item['d_left_auto'] ) {
					if ( ! empty( $item['d_pos_xposition']['size'] ) || '0' === $item['d_pos_xposition']['size'] ) {
						$xpos = $item['d_pos_xposition']['size'] . $item['d_pos_xposition']['unit'];
					}
				}

				if ( 'yes' === $item['d_top_auto'] ) {
					if ( ! empty( $item['d_pos_yposition']['size'] ) || '0' === $item['d_pos_yposition']['size'] ) {
						$ypos = $item['d_pos_yposition']['size'] . $item['d_pos_yposition']['unit'];
					}
				}

				if ( 'yes' === $item['d_bottom_auto'] ) {
					if ( ! empty( $item['d_pos_bottomposition']['size'] ) || '0' === $item['d_pos_bottomposition']['size'] ) {
						$bpos = $item['d_pos_bottomposition']['size'] . $item['d_pos_bottomposition']['unit'];
					}
				}

				if ( 'yes' === $item['d_right_auto'] ) {
					if ( ! empty( $item['d_pos_rightposition']['size'] ) || '0' === $item['d_pos_rightposition']['size'] ) {
						$rpos = $item['d_pos_rightposition']['size'] . $item['d_pos_rightposition']['unit'];
					}
				}

				$css_loop .= '.pin-hotspot-loop.' . esc_attr( $uid_loop ) . '{top:' . esc_attr( $ypos ) . ';bottom:' . esc_attr( $bpos ) . ';left:' . esc_attr( $xpos ) . ';right:' . esc_attr( $rpos ) . ';margin: 0 auto;}';

				if ( ! empty( $item['t_responsive'] ) && 'yes' === $item['t_responsive'] ) {
					$tablet_xpos = 'auto';
					$tablet_ypos = 'auto';
					$tablet_bpos = 'auto';
					$tablet_rpos = 'auto';

					if ( 'yes' === $item['t_left_auto'] ) {
						if ( ! empty( $item['t_pos_xposition']['size'] ) || '0' === $item['t_pos_xposition']['size'] ) {
							$tablet_xpos = $item['t_pos_xposition']['size'] . $item['t_pos_xposition']['unit'];
						}
					}

					if ( 'yes' === $item['t_top_auto'] ) {
						if ( ! empty( $item['t_pos_yposition']['size'] ) || '0' === $item['t_pos_yposition']['size'] ) {
							$tablet_ypos = $item['t_pos_yposition']['size'] . $item['t_pos_yposition']['unit'];
						}
					}

					if ( 'yes' === $item['t_bottom_auto'] ) {
						if ( ! empty( $item['t_pos_bottomposition']['size'] ) || '0' === $item['t_pos_bottomposition']['size'] ) {
							$tablet_bpos = $item['t_pos_bottomposition']['size'] . $item['t_pos_bottomposition']['unit'];
						}
					}

					if ( 'yes' === $item['t_right_auto'] ) {
						if ( ! empty( $item['t_pos_rightposition']['size'] ) || '0' === $item['t_pos_rightposition']['size'] ) {
							$tablet_rpos = $item['t_pos_rightposition']['size'] . $item['t_pos_rightposition']['unit'];
						}
					}

					$css_loop .= '@media (min-width:601px) and (max-width:990px){.pin-hotspot-loop.' . esc_attr( $uid_loop ) . '{top:' . esc_attr( $tablet_ypos ) . ';bottom:' . esc_attr( $tablet_bpos ) . ';left:' . esc_attr( $tablet_xpos ) . ';right:' . esc_attr( $tablet_rpos ) . ';margin: 0 auto;}}';
				}

				if ( ! empty( $item['m_responsive'] ) && 'yes' === $item['m_responsive'] ) {
					$mobile_xpos = 'auto';
					$mobile_ypos = 'auto';
					$mobile_bpos = 'auto';
					$mobile_rpos = 'auto';

					if ( 'yes' === $item['m_left_auto'] ) {
						if ( ! empty( $item['m_pos_xposition']['size'] ) || '0' === $item['m_pos_xposition']['size'] ) {
							$mobile_xpos = $item['m_pos_xposition']['size'] . $item['m_pos_xposition']['unit'];
						}
					}

					if ( 'yes' === $item['m_top_auto'] ) {
						if ( ! empty( $item['m_pos_yposition']['size'] ) || '0' === $item['m_pos_yposition']['size'] ) {
							$mobile_ypos = $item['m_pos_yposition']['size'] . $item['m_pos_yposition']['unit'];
						}
					}

					if ( 'yes' === $item['m_bottom_auto'] ) {
						if ( ! empty( $item['m_pos_bottomposition']['size'] ) || '0' === $item['m_pos_bottomposition']['size'] ) {
							$mobile_bpos = $item['m_pos_bottomposition']['size'] . $item['m_pos_bottomposition']['unit'];
						}
					}

					if ( 'yes' === $item['m_right_auto'] ) {
						if ( ! empty( $item['m_pos_rightposition']['size'] ) || '0' === $item['m_pos_rightposition']['size'] ) {
							$mobile_rpos = $item['m_pos_rightposition']['size'] . $item['m_pos_rightposition']['unit'];
						}
					}

					$css_loop .= '@media (max-width:600px){.pin-hotspot-loop.' . esc_attr( $uid_loop ) . '{top:' . esc_attr( $mobile_ypos ) . ';bottom:' . esc_attr( $mobile_bpos ) . ';left:' . esc_attr( $mobile_xpos ) . ';right:' . esc_attr( $mobile_rpos ) . ';margin: 0 auto;}}';
				}

				if ( ! empty( $settings['tooltip_delay_visible'] ) && 'yes' === $settings['tooltip_delay_visible'] && ! empty( $settings['tooltip_delay_time']['size'] ) ) {
					$delay_time = $settings['tooltip_delay_time']['size'] * 1000;
				} else {
					$delay_time = 0;
				}

				$inline_tippy_js = '';

				$inline_tippy_js = 'jQuery( document ).ready(function() {
				"use strict";
					if(typeof tippy === "function"){
						setTimeout(function(){
							tippy( "#' . esc_attr( $uid_loop ) . '" , {
								arrowType : "' . esc_attr( $tooltip_arrowtype ) . '",
								duration : [' . esc_attr( $tooltip_duration_in ) . ',' . esc_attr( $tooltip_duration_out ) . '],
								trigger : "' . esc_attr( $tooltip_trigger ) . '",
								appendTo: document.querySelector("#' . esc_attr( $uid_loop ) . '")
							});
						}, ' . esc_attr( $delay_time ) . ');
					}
				});';

				$pin_loop .= wp_print_inline_script_tag( $inline_tippy_js );
				$pin_loop .= '<style>' . esc_attr( $css_loop ) . '</style>';

				++$index;
			}
		}

		$hotspot = '<div class="theplus-hotspot ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';

			$hotspot .= '<div class="theplus-hotspot-inner ' . esc_attr( $overlay_color_option ) . '">';

		if ( ! empty( $settings['hotspot_image']['url'] ) ) {
			$image_id = $settings['hotspot_image']['id'];
			$img_src  = tp_get_image_rander( $image_id, $settings['thumbnail_size'], array( 'class' => 'hotspot-image' ) );
			$hotspot .= $img_src;
		}

			$hotspot     .= '<div class="hotspot-content-overlay">';
				$hotspot .= $pin_loop;
			$hotspot     .= '</div>';

			$hotspot .= '</div>';
		$hotspot     .= '</div>';

		echo $hotspot;
	}

	/**
	 * Render content_template.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}
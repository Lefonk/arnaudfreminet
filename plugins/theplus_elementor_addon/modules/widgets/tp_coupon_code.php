<?php
/**
 * Widget Name: Coupon Code
 * Description: Coupon Code.
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
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class ThePlus_Countdown.
 */
class ThePlus_Coupon_Code extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name.
	 *
	 * @since 5.0.4
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-coupon-code';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 5.0.4
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Coupon Code', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 5.0.4
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa- tp-coupancode-icon theplus_backend_icon';
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
	 * Get Widget Category.
	 *
	 * @since 5.0.4
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Register controls.
	 *
	 * @since 5.0.4
	 * @version 5.4.2
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
			'couponType',
			array(
				'label'   => esc_html__( 'Coupon Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => array(
					'standard' => esc_html__( 'Standard', 'theplus' ),
					'peel'     => esc_html__( 'Peel', 'theplus' ),
					'scratch'  => esc_html__( 'Scratch', 'theplus' ),
					'slideOut' => esc_html__( 'Slide Out', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'standardStyle',
			array(
				'label'     => esc_html__( 'Standard Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'couponText',
			array(
				'label'     => esc_html__( 'Title', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Show Code', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'redirectLink',
			array(
				'label'         => __( 'Redirect Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'standardCntAlign',
			array(
				'label'     => esc_html__( 'Content Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-code-inner.style-1 .coupon-text,
					{{WRAPPER}} .tp-coupon-code .coupon-code-inner.style-2 .coupon-text,
					{{WRAPPER}} .tp-coupon-code .coupon-code-inner.style-3 .coupon-text,
					{{WRAPPER}} .tp-coupon-code .coupon-code-inner.style-4 .coupon-text,
					{{WRAPPER}} .tp-coupon-code .coupon-code-inner.style-5 .coupon-text,{{WRAPPER}} .copy-style-1 span.full-code-text,{{WRAPPER}} .copy-style-2 span.full-code-text,{{WRAPPER}} .copy-style-3 span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text' => 'text-align: {{VALUE}};justify-content: {{VALUE}}',
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'standardAlign',
			array(
				'label'     => esc_html__( 'Box Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code,{{WRAPPER}} .tp-coupon-code .coupon-code-outer' => 'text-align: {{VALUE}};text-align: -webkit-{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'StndModalCpCd_opts',
			array(
				'label'     => esc_html__( 'Copy Code', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'couponType' => 'standard',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'copyCodeStyle',
			array(
				'label'     => esc_html__( 'Copy Code Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'couponCode',
			array(
				'label'     => esc_html__( 'Code', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'X246-17GT-OL57', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'actionType',
			array(
				'label'     => esc_html__( 'Select Action', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'click',
				'options'   => array(
					'click' => esc_html__( 'Click', 'theplus' ),
					'popup' => esc_html__( 'Popup', 'theplus' ),
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'hideLink',
			array(
				'label'       => esc_html__( 'Hide Link', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'no',
				'description' => esc_html__( 'Note : If you enable this, It will replace your URL text with masked text and open single or multiple URLs on click as per your below configuration.', 'theplus' ),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'click',
				),
			)
		);
		$this->add_control(
			'hideLinkMaskText',
			array(
				'label'       => esc_html__( 'Link Masking Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '#',
				'placeholder' => esc_html__( 'Enter Masking Text', 'theplus' ),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'click',
					'hideLink'   => 'yes',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'LinkMaskLabel',
			array(
				'label'       => esc_html__( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Label', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Label', 'theplus' ),
			)
		);
		$repeater->add_control(
			'LinkMaskLink',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array( 'url' => '#' ),
				'dynamic'       => array( 'active' => true ),
			)
		);
		$this->add_control(
			'LinkMaskList',
			array(
				'label'       => esc_html__( 'Open URLs : Single/Multiple', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'LinkMaskLabel' => 'Wordpress',
					),
				),
				'title_field' => '{{{ LinkMaskLabel }}}',
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'click',
					'hideLink'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tabReverse',
			array(
				'label'       => esc_html__( 'Tab Reverse', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'no',
				'description' => esc_html__( 'Note : If you choose this option Link will open in existing tab and current website will be open in new tab.', 'theplus' ),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'copLoop',
			array(
				'label'     => esc_html__( 'Loop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'popupBgImage',
			array(
				'type'      => Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Popup Background Image', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'copLoop'    => 'yes',
				),
			)
		);
		$this->add_control(
			'popupTitle',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Here is your coupon code', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'popupDesc',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Use code on site', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'copyBtnText',
			array(
				'label'     => esc_html__( 'Copy Button', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Copy Code', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'afterCopyText',
			array(
				'label'     => esc_html__( 'After Copy', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Copied!', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'visitBtnText',
			array(
				'label'     => esc_html__( 'Visit Button', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Visit Site', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'modelClsIcon',
			array(
				'label'     => esc_html__( 'Close Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fa fa-times',
					'library' => 'solid',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'standardCdAlign',
			array(
				'label'     => esc_html__( 'Code Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-code-outer' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'scratchWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-coupon-code.coupon-code-scratch,{{WRAPPER}} .tp-coupon-code.coupon-code-slideOut,{{WRAPPER}} .tp-coupon-code.coupon-code-peel' => 'max-width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'scratchHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-coupon-code.coupon-code-scratch,{{WRAPPER}} .tp-coupon-code.coupon-code-slideOut,{{WRAPPER}} .tp-coupon-code.coupon-code-peel' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'fillPercent',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Fill Percent For Reveal', 'theplus' ),
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
					'size' => 70,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'couponType' => 'scratch',
				),
			)
		);
		$this->add_control(
			'slideDirection',
			array(
				'label'     => esc_html__( 'Slide Out Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'couponType' => 'slideOut',
				),
			)
		);
		$this->add_control(
			'slideDirectionhint',
			array(
				'label'     => esc_html__( 'Direction Hint Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'couponType' => 'slideOut',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_front_side_section',
			array(
				'label'     => esc_html__( 'Front Side', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_control(
			'frontContentType',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'  => esc_html__( 'Default', 'theplus' ),
					'template' => esc_html__( 'Template', 'theplus' ),
				),
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_control(
			'frontContent',
			array(
				'label'       => esc_html__( 'Content', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Front Content', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'couponType!'      => 'standard',
					'frontContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'frontContentTag',
			array(
				'label'     => esc_html__( 'Content Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => theplus_get_tags_options(),
				'condition' => array(
					'couponType!'      => 'standard',
					'frontContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'frontTemp',
			array(
				'label'       => esc_html__( 'Template', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'couponType!'      => 'standard',
					'frontContentType' => 'template',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_back_side_section',
			array(
				'label'     => esc_html__( 'Back Side', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_control(
			'backContentType',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'  => esc_html__( 'Default', 'theplus' ),
					'template' => esc_html__( 'Template', 'theplus' ),
				),
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_control(
			'backTitle',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Back Title', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'couponType!'     => 'standard',
					'backContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'backTitleTag',
			array(
				'label'     => esc_html__( 'Title Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => theplus_get_tags_options(),
				'condition' => array(
					'couponType!'     => 'standard',
					'backContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'backDesc',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Back Description', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'couponType!'     => 'standard',
					'backContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'backTemp',
			array(
				'label'       => esc_html__( 'Template', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'couponType!'     => 'standard',
					'backContentType' => 'template',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_extra_scroll_section',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'ccd_popup_width',
			array(
				'label'      => esc_html__( 'Popup Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'.ccd-main-modal' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'CdScrollOn',
			array(
				'label'     => esc_html__( 'On Scroll', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'CdScrollHgt',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_standard_styling',
			array(
				'label'     => esc_html__( 'Standard', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'Stndbtn_opts',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'buttonPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-btn-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'buttonTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .coupon-code-inner .coupon-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'buttonWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width (%)', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-code-inner,{{WRAPPER}} .tp-coupon-code .copy-style-1 span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-2 span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-3 span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text' => 'width: {{SIZE}}%',
				),
				'condition'   => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'ArWBdrColor',
			array(
				'label'     => esc_html__( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-1::before' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .coupon-code-inner.style-1::after' => 'border-right-color: {{VALUE}};',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => 'style-1',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_Stndbtn' );
		$this->start_controls_tab(
			'tab_Stndbtn_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'buttonNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner .coupon-text' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btns2NmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-2 .coupon-text',
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'btns2BdrNmlClr',
			array(
				'label'     => esc_html__( 'Border Left Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-2 .coupon-text::after' => 'border-left-color: {{VALUE}}',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'btnScratchNColor',
			array(
				'label'     => esc_html__( 'Border Bottom Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link::after' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'buttonNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-1 .coupon-text,{{WRAPPER}} .coupon-code-inner.style-3 .coupon-text,{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link',
				'condition' => array(
					'couponType'     => 'standard',
					'standardStyle!' => array( 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btnNmlBdr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .coupon-btn-link,{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link',
			)
		);
		$this->add_responsive_control(
			'btnNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-btn-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btnNBShadow',
				'selector' => '{{WRAPPER}} .coupon-btn-link',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_Stndbtn_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'buttonHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner .coupon-btn-link:hover .coupon-text' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btns2HvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-2 .coupon-btn-link:hover .coupon-text',
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'btns2BdrHvrClr',
			array(
				'label'     => esc_html__( 'Border Left Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-2 .coupon-btn-link:hover .coupon-text::after' => 'border-left-color: {{VALUE}}',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'btnScratchHColor',
			array(
				'label'     => esc_html__( 'Border Bottom Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover::after' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'buttonHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-1 .coupon-btn-link:hover .coupon-text,{{WRAPPER}} .coupon-code-inner.style-3 .coupon-btn-link:hover .coupon-text,{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link:hover,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover',
				'condition' => array(
					'couponType'     => 'standard',
					'standardStyle!' => array( 'style-2' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btnHvrBdr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .coupon-btn-link:hover,{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link:hover,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover',
			)
		);
		$this->add_responsive_control(
			'btnHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-btn-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btnHBShadow',
				'selector' => '{{WRAPPER}} .coupon-btn-link:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'StndIcon_opts',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'btnIconWidth',
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
					'{{WRAPPER}} .coupon-code-inner.style-4 .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'btnIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
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
					'{{WRAPPER}} .coupon-code-inner.style-4 .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndIcon' );
		$this->start_controls_tab(
			'tab_StndIcon_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'btnIconNColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-4 .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-icon' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btnIconNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-4 .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-icon',
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btnIconNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-4 .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-icon',
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'btnIconNmlBdrad',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-code-inner.style-4 .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndIcon_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'btnIconHColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link:hover .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover .coupon-icon' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btnIconHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link:hover .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover .coupon-icon',
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btnIconHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link:hover .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover .coupon-icon',
				'condition' => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'btnIconHvrBdrad',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-code-inner.style-4 .coupon-btn-link:hover .coupon-icon,{{WRAPPER}} .coupon-code-inner.style-5 .coupon-btn-link:hover .coupon-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType'    => 'standard',
					'standardStyle' => array( 'style-4', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'StndCpyCd_opts',
			array(
				'label'     => esc_html__( 'Copy Code', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'couponType' => 'standard',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'cCodePadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .full-code-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'cCodeTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-coupon-code span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'cCodebuttonWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width (%)', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-coupon-code .copy-style-1 .coupon-code-outer span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-2 .coupon-code-outer span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-3 .coupon-code-outer span.full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'CodeArwBdrColor',
			array(
				'label'     => esc_html__( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .copy-style-1 span.full-code-text::before' => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .copy-style-1 span.full-code-text::after' => 'border-right-color: {{VALUE}}',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'copyCodeStyle' => 'style-1',
					'actionType'    => 'click',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndCpyCd' );
		$this->start_controls_tab(
			'tab_StndCpyCd_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'cCodeNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code span.full-code-text' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'cCodeNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cCodeNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'cCodeNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code span.full-code-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cCodeNBShadow',
				'selector'  => '{{WRAPPER}} .tp-coupon-code span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndCpyCd_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'cCodeHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code:hover span.full-code-text' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'cCodeHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code:hover span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cCodeHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code:hover span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_responsive_control(
			'cCodeHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code:hover span.full-code-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cCodeHBShadow',
				'selector'  => '{{WRAPPER}} .tp-coupon-code:hover span.full-code-text',
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modalboxCIcn_styling',
			array(
				'label'     => esc_html__( 'Popup Close Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'cIconPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'cIconMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'cIconWidth',
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
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'cIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndClsIcon' );
		$this->start_controls_tab(
			'tab_StndClsIcon_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'cIconNColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn' => 'color:{{VALUE}};',
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn svg' => 'fill:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'cIconNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cIconNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'cIconNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cIconNBShadow',
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndClsIcon_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'cIconHColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn:hover' => 'color:{{VALUE}};',
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn:hover svg' => 'fill:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'cIconHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cIconHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'cIconHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cIconHBShadow',
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-ccd-closebtn:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_ttl_desc_styling',
			array(
				'label'     => esc_html__( 'Popup Title/Description', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'TtldescPadding',
			array(
				'label'      => esc_html__( 'Content Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .popup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'TtldescMargin',
			array(
				'label'      => esc_html__( 'Content Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .popup-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'StndMdlTtl_opts',
			array(
				'label'     => esc_html__( 'Title', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'titlePadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .popup-content .content-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'titleTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .popup-content .content-title',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndMdlTtl' );
		$this->start_controls_tab(
			'tab_StndMdlTtl_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'titleNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .popup-content .content-title' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'titleNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-title',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'titleNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-title',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'titleNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .popup-content .content-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'titleNmlBsw',
				'selector'  => '{{WRAPPER}} .popup-content .content-title',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndMdlTtl_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'titleHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .popup-content .content-title:hover' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'titleHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-title:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'titleHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-title:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'titleHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .popup-content .content-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'titleHvrBsw',
				'selector'  => '{{WRAPPER}} .popup-content .content-title:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'StndMdlDesc_opts',
			array(
				'label'     => esc_html__( 'Description', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'descPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .popup-content .content-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'descAbvSpace',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Above Space', 'theplus' ),
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
					'{{WRAPPER}} .popup-content .content-desc' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'descTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .popup-content .content-desc',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndMdlDesc' );
		$this->start_controls_tab(
			'tab_StndMdlDesc_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'descNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .popup-content .content-desc' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'descNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-desc',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'descNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-desc',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'descNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .popup-content .content-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'descNmlBsw',
				'selector'  => '{{WRAPPER}} .popup-content .content-desc',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndMdlDesc_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'descHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .popup-content .content-desc:hover' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'descHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-desc:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'descHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .popup-content .content-desc:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'descHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .popup-content .content-desc:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'descHvrBsw',
				'selector'  => '{{WRAPPER}} .popup-content .content-desc:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'TtlDescAlign',
			array(
				'label'     => esc_html__( 'Title/Desc Alignment', 'theplus' ),
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .popup-content' => 'align-items:{{VALUE}};',
				),
				'toggle'    => true,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_PopCpCd_styling',
			array(
				'label'     => esc_html__( 'Popup Copy Code', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'CpTxtPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'CpTxtMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'PopcCodeTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'PopcCodebuttonWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width (%)', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'PopArwBdrColor',
			array(
				'label'     => esc_html__( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .copy-style-1 span.full-code-text.tp-code-popup::before' => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .copy-style-1 span.full-code-text.tp-code-popup::after' => 'border-right-color: {{VALUE}}',
				),
				'condition' => array(
					'couponType'    => 'standard',
					'copyCodeStyle' => 'style-1',
					'actionType'    => 'popup',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_PopCpyCd' );
		$this->start_controls_tab(
			'tab_PopCpyCd_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'PopcCodeNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'PopcCodeNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'PopcCodeNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'PopcCodeNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'PopcCodeNBShadow',
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_PopCpyCd_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'PopcCodeHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup:hover' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'PopcCodeHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'PopcCodeHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'PopcCodeHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'PopcCodeHBShadow',
				'selector'  => '{{WRAPPER}} .copy-style-1 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-2 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .copy-style-3 .coupon-code-outer span.full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-4 .full-code-text.tp-code-popup:hover,{{WRAPPER}} .tp-coupon-code .copy-style-5 .full-code-text.tp-code-popup:hover',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_PopCpyBtn_styling',
			array(
				'label'     => esc_html__( 'Popup Copy Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_responsive_control(
			'copyBtnPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .copy-code-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'copyBtnMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .copy-code-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'copyBtnTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .copy-code-btn',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndCpyBtn' );
		$this->start_controls_tab(
			'tab_StndCpyBtn_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_control(
			'copyBtnNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .copy-code-btn' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'copyBtnNmlBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .copy-code-btn',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'copyBtnNmlBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .copy-code-btn',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_responsive_control(
			'copyBtnNBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .copy-code-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'copyBtnNBShadow',
				'selector'  => '{{WRAPPER}} .copy-code-btn',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndCpyBtn_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_control(
			'copyBtnHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .copy-code-btn:hover' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'copyBtnHvrBG',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .copy-code-btn:hover',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'copyBtnHvrBdr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .copy-code-btn:hover',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_responsive_control(
			'copyBtnHBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .copy-code-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'copyBtnHBShadow',
				'selector'  => '{{WRAPPER}} .copy-code-btn:hover',
				'condition' => array(
					'couponType'   => 'standard',
					'actionType'   => 'popup',
					'copyBtnText!' => '',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modalVstBtn_styling',
			array(
				'label'     => esc_html__( 'Popup Visit Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'VstBtnPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-store-visit .store-visit-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'VstBtnMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-store-visit .store-visit-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'visitBtnTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link,{{WRAPPER}} .coupon-store-visit .store-visit-link a',
			)
		);
		$this->start_controls_tabs( 'tabs_visitBtn' );
		$this->start_controls_tab(
			'tab_visitBtn_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'visitBtnNColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-store-visit .store-visit-link,{{WRAPPER}} .coupon-store-visit .store-visit-link a' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'visitBtnNmlBG',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'visitBtnNmlBdr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link',
			)
		);
		$this->add_responsive_control(
			'visitBtnNBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-store-visit .store-visit-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'visitBtnNBShadow',
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_visitBtn_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
				),
			)
		);
		$this->add_control(
			'visitBtnHColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .coupon-store-visit .store-visit-link:hover,{{WRAPPER}} .coupon-store-visit .store-visit-link:hover a' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'visitBtnHvrBG',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'visitBtnHvrBdr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link:hover',
			)
		);
		$this->add_responsive_control(
			'visitBtnHBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-store-visit .store-visit-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'visitBtnHBShadow',
				'selector' => '{{WRAPPER}} .coupon-store-visit .store-visit-link:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'VstBtnAlign',
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .popup-code-modal .coupon-store-visit' => 'align-items:{{VALUE}};',
				),
				'toggle'    => true,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_ScrlBr_styling',
			array(
				'label'     => esc_html__( 'Popup Scroll Bar', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'CCd_scrollC_style' );
		$this->start_controls_tab(
			'CCd_scrollC_Bar',
			array(
				'label'     => esc_html__( 'Scrollbar', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'CCdScrollBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'CCdScrollWidth',
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
					'{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'CCdscrollC_Tmb',
			array(
				'label'     => esc_html__( 'Thumb', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'CCdThumbBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar-thumb',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'CCdThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'CCdThumbBsw',
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar-thumb',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'CCdscrollC_Trk',
			array(
				'label'     => esc_html__( 'Track', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'CCdTrackBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar-track',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'CCdTrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'CCdTrackBsw',
				'selector'  => '{{WRAPPER}} .tp-coupon-code .tp-code-scroll::-webkit-scrollbar-track',
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
					'CdScrollOn' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_modalBox_styling',
			array(
				'label'     => esc_html__( 'Popup Modal Box', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'StndModalPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .ccd-main-modal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_responsive_control(
			'StndModalMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .ccd-main-modal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_StndModal' );
		$this->start_controls_tab(
			'tab_StndModal_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'StndModalBGNml',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-coupon-code .ccd-main-modal',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'StndModalBorderNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-coupon-code .ccd-main-modal',
			)
		);
		$this->add_responsive_control(
			'StndModalBRadiusNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .ccd-main-modal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'StndModalBshadowNml',
				'selector' => '{{WRAPPER}} .tp-coupon-code .ccd-main-modal',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_StndModal_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'StndModalBGHvr',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-coupon-code .ccd-main-modal:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'StndModalBorderHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-coupon-code .ccd-main-modal:hover',
			)
		);
		$this->add_responsive_control(
			'StndModalBRadiusHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code .ccd-main-modal:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'StndModalBshadowHvr',
				'selector' => '{{WRAPPER}} .tp-coupon-code .ccd-main-modal:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mbbf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'mbbf_blur',
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
					'mbbf' => 'yes',
				),
			)
		);
		$this->add_control(
			'mbbf_grayscale',
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
					'{{WRAPPER}} .tp-coupon-code .ccd-main-modal' => '-webkit-backdrop-filter:grayscale({{mbbf_grayscale.SIZE}})  blur({{mbbf_blur.SIZE}}{{mbbf_blur.UNIT}}) !important;backdrop-filter:grayscale({{mbbf_grayscale.SIZE}})  blur({{mbbf_blur.SIZE}}{{mbbf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'mbbf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_Pl_Scrh_SldOut_styling',
			array(
				'label'     => esc_html__( 'Front Side Content', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'frontTtltypo',
				'label'     => esc_html__( 'Title Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .coupon-front-content',
				'condition' => array(
					'frontContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'frontTtlclr',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-front-content' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'frontContentType' => 'default',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'frontBG',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .coupon-front-side',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'frontBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .coupon-front-side',
			)
		);
		$this->add_responsive_control(
			'frontBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-front-side' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'frontBshadow',
				'selector' => '{{WRAPPER}} .coupon-front-side',
			)
		);
		$this->add_control(
			'slidehinticoncolor',
			array(
				'label'     => esc_html__( 'HInt Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-anim-pos-cont svg' => 'color:{{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'couponType'         => 'slideOut',
					'slideDirectionhint' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_Pl_Scrh_SldOut_back_styling',
			array(
				'label'     => esc_html__( 'Back Side Content', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'backTtltypo',
				'label'     => esc_html__( 'Title Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .coupon-back-title',
				'condition' => array(
					'backContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'backTtlclr',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-back-title' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'backContentType' => 'default',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'backDesctypo',
				'label'     => esc_html__( 'Description Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-coupon-code .coupon-back-description',
				'condition' => array(
					'backContentType' => 'default',
				),
			)
		);
		$this->add_control(
			'backDescclr',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-coupon-code .coupon-back-description' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'backContentType' => 'default',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'backBG',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .coupon-back-side',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'backBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .coupon-back-side',
			)
		);
		$this->add_responsive_control(
			'backBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .coupon-back-side' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'backBshadow',
				'selector' => '{{WRAPPER}} .coupon-back-side',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_boxcontent_styling',
			array(
				'label'     => esc_html__( 'Box Content', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType!' => 'standard',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxcontentBG',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-coupon-code',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxcontentBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-coupon-code',
			)
		);
		$this->add_responsive_control(
			'boxcontentBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-coupon-code' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxcontentBshadow',
				'selector' => '{{WRAPPER}} .tp-coupon-code',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_opts_styling',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'couponType' => 'standard',
					'actionType' => 'popup',
				),
			)
		);
		$this->add_control(
			'CCd_overlay_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .copy-code-wrappar::after' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'olcbf',
			array(
				'label'        => esc_html__( 'Overlay Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'olcbf_blur',
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
					'olcbf' => 'yes',
				),
			)
		);
		$this->add_control(
			'olcbf_grayscale',
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
					'{{WRAPPER}} .copy-code-wrappar::after' => '-webkit-backdrop-filter:grayscale({{olcbf_grayscale.SIZE}})  blur({{olcbf_blur.SIZE}}{{olcbf_blur.UNIT}}) !important;backdrop-filter:grayscale({{olcbf_grayscale.SIZE}})  blur({{olcbf_blur.SIZE}}{{olcbf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'olcbf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();
	}

	/**
	 * Coupan Code Render.
	 *
	 * @since 5.0.4
	 * @version 5.4.2
	 */
	protected function render() {

		$settings        = $this->get_settings_for_display();
		$coupon_type     = ! empty( $settings['couponType'] ) ? $settings['couponType'] : 'standard';
		$standard_style  = ! empty( $settings['standardStyle'] ) ? $settings['standardStyle'] : 'style-1';
		$coupon_text     = ! empty( $settings['couponText'] ) ? $settings['couponText'] : '';
		$copy_btn_text   = ! empty( $settings['copyBtnText'] ) ? $settings['copyBtnText'] : '';
		$after_copy_text = ! empty( $settings['afterCopyText'] ) ? $settings['afterCopyText'] : '';
		$copycodestyle   = ! empty( $settings['copyCodeStyle'] ) ? $settings['copyCodeStyle'] : 'style-1';
		$visit_btn_text  = ! empty( $settings['visitBtnText'] ) ? strtoupper( $settings['visitBtnText'] ) : '';
		$coupon_code     = ! empty( $settings['couponCode'] ) ? $settings['couponCode'] : '';
		$popup_title     = ! empty( $settings['popupTitle'] ) ? $settings['popupTitle'] : '';
		$popup_desc      = ! empty( $settings['popupDesc'] ) ? $settings['popupDesc'] : '';
		$action_type     = ! empty( $settings['actionType'] ) ? $settings['actionType'] : 'click';
		$fill_percent    = ! empty( $settings['fillPercent']['size'] ) ? $settings['fillPercent']['size'] : '70';
		$slide_direction = ! empty( $settings['slideDirection'] ) ? $settings['slideDirection'] : 'left';

		$front_content_type = ! empty( $settings['frontContentType'] ) ? $settings['frontContentType'] : 'default';

		$front_content   = ! empty( $settings['frontContent'] ) ? $settings['frontContent'] : '';
		$frontContentTag = ! empty( $settings['frontContentTag'] ) ? $settings['frontContentTag'] : 'h3';

		$frontTemp = ! empty( $settings['frontTemp'] ) ? $settings['frontTemp'] : '0';
		$backTitle = ! empty( $settings['backTitle'] ) ? $settings['backTitle'] : '';
		$backDesc  = ! empty( $settings['backDesc'] ) ? $settings['backDesc'] : '';
		$backTemp  = ! empty( $settings['backTemp'] ) ? $settings['backTemp'] : '0';
		$target    = ! empty( $settings['redirectLink']['is_external'] ) ? '_blank' : '';
		$nofollow  = ! empty( $settings['redirectLink']['nofollow'] ) ? 'nofollow' : '';
		$scrollOn  = ! empty( $settings['CdScrollOn'] ) ? $settings['CdScrollOn'] : 'no';
		$scrollHgt = ! empty( $settings['CdScrollHgt']['size'] ) ? (int) $settings['CdScrollHgt']['size'] : '';

		$redirectLink = ! empty( $settings['redirectLink']['url'] ) ? $settings['redirectLink']['url'] : '';
		$backTitleTag = ! empty( $settings['backTitleTag'] ) ? $settings['backTitleTag'] : 'h3';
		$cstmStdWidth = ! empty( $settings['buttonWidth']['size'] ) ? (int) $settings['buttonWidth']['size'] : '100';

		$tabReverse = isset( $settings['tabReverse'] ) ? $settings['tabReverse'] : 'no';
		$copLoop    = isset( $settings['copLoop'] ) ? $settings['copLoop'] : 'no';
		$hideLink   = isset( $settings['hideLink'] ) ? $settings['hideLink'] : 'no';

		$backContentType  = ! empty( $settings['backContentType'] ) ? $settings['backContentType'] : 'default';
		$hideLinkMaskText = ! empty( $settings['hideLinkMaskText'] ) ? $settings['hideLinkMaskText'] : '#';

		$iduu = get_the_ID();
		if ( ! empty( $copLoop ) && 'yes' === $copLoop ) {
			$uid_ccd = 'tp-ccd' . $this->get_id() . $iduu;
		} else {
			$uid_ccd = 'tp-ccd' . $this->get_id();
		}

		$click_action = '';
		$visitLink    = '';
		$modelClsIcon = '';

		$tabReverseClass = '';
		if ( 'click' === $action_type ) {
			$click_action .= 'href="' . esc_url( $redirectLink ) . '"';
			$click_action .= ' target="' . esc_attr( $target ) . '"';
			$click_action .= ' nofollow="' . esc_attr( $nofollow ) . '"';
		} elseif ( 'popup' === $action_type ) {
			if ( ! empty( $tabReverse ) && 'yes' === $tabReverse ) {
				$tabReverseClass = ' tp-tab-cop-rev';

				if ( ! empty( $copLoop ) && 'yes' === $copLoop ) {
					$click_action .= 'href="#tp-widget-' . esc_attr( $uid_ccd ) . '"';
				} else {
					$click_action .= 'href="#tp-widget-' . esc_attr( $uid_ccd ) . '"';
				}
			} else {
				$click_action .= 'href="' . esc_url( $redirectLink ) . '"';
			}

			$click_action .= ' target="' . esc_attr( $target ) . '"';
			$click_action .= ' nofollow="' . esc_attr( $nofollow ) . '"';

			$visitLink .= 'href="' . esc_url( $redirectLink ) . '"';
			$visitLink .= ' target="' . esc_attr( $target ) . '"';
			$visitLink .= ' nofollow="' . esc_attr( $nofollow ) . '"';
		}

		$coupon_code_attr = array();

		$coupon_code_attr['id'] = $uid_ccd;

		$coupon_code_attr['couponType'] = $coupon_type;

		if ( 'standard' === $coupon_type ) {
			$coupon_code_attr['actionType']    = $action_type;
			$coupon_code_attr['coupon_code']   = theplus_senitize_js_input( $coupon_code );
			$coupon_code_attr['copy_btn_text'] = $copy_btn_text;

			$coupon_code_attr['after_copy_text']  = $after_copy_text;
			$coupon_code_attr['copy_code_style']  = $copycodestyle;
			$coupon_code_attr['cstm_stdBtn_wdth'] = $cstmStdWidth;

			if ( ! empty( $scrollOn ) && 'yes' === $scrollOn ) {
				$coupon_code_attr['classname'] = 'tp-code-scroll';
				$coupon_code_attr['scrollon']  = $scrollOn;
				$coupon_code_attr['sclheight'] = $scrollHgt;
			}

			if ( 'popup' === $action_type && ! empty( $tabReverse ) && 'yes' === $tabReverse ) {
				$coupon_code_attr['extlink'] = esc_url( $redirectLink );
			}
		}

		if ( 'scratch' === $coupon_type ) {
			$coupon_code_attr['fillPercent'] = $fill_percent;
		}

		$slide_out_class = '';
		if ( 'slideOut' === $coupon_type ) {
			$coupon_code_attr['slideDirection'] = $slide_direction;

			$slide_out_class = ' slide-out-' . $slide_direction;
		}

		if ( ! empty( $settings['modelClsIcon'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['modelClsIcon'], array( 'aria-hidden' => 'true' ) );
			$modelClsIcon = ob_get_contents();
			ob_end_clean();
		}

		$coupon_code_attr = htmlspecialchars( wp_json_encode( $coupon_code_attr ), ENT_QUOTES, 'UTF-8' );

		$output  = '';
		$output .= '<div id="tp-widget-' . $uid_ccd . '" class="tp-coupon-code action-' . esc_attr( $action_type ) . ' coupon-code-' . esc_attr( $coupon_type ) . '' . esc_attr( $slide_out_class ) . ' tp-widget-' . esc_attr( $uid_ccd ) . ' ' . esc_attr( $tabReverseClass ) . ' tp-widget-' . $uid_ccd . '" data-tp_cc_settings=\'' . $coupon_code_attr . '\'>';
		if ( 'standard' === $coupon_type ) {
			$output .= '<div class="coupon-code-inner ' . esc_attr( $standard_style ) . '">';

			$data = array();
			if ( 'yes' === $hideLink && ! empty( $hideLinkMaskText ) ) {
				foreach ( $settings['LinkMaskList'] as $item ) {
					$hideLinks = ! empty( $item['LinkMaskLink']['url'] ) ? $item['LinkMaskLink']['url'] : '';
					$data[]    = $hideLinks;
				}

				if ( ! empty( $redirectLink ) ) {
					$data[] = $redirectLink;
				}

				$data = wp_json_encode( $data );

				$output .= '<a class="coupon-btn-link tp-hl-links" href="' . esc_attr( $hideLinkMaskText ) . '" data-hlset=\'' . $data . '\'>';
			} else {
				$output .= '<a class="coupon-btn-link" ' . $click_action . '>';
			}

			if ( 'style-4' === $standard_style || 'style-5' === $standard_style ) {
				$output .= '<span class="coupon-icon">';
				$output .= '<i class="fa fa-scissors coupon-type"></i>';
				$output .= '</span>';
			}

			$output .= '<div class="coupon-text">' . esc_html( $coupon_text ) . '</div>';
			if ( 'style-4' !== $standard_style && 'style-5' !== $standard_style ) {
				$output .= '<div class="coupon-code">' . esc_html( $coupon_code ) . '</div>';
			}

			$output .= '</a>';
			if ( 'popup' === $action_type ) {
				$output .= '<div class="copy-code-wrappar" role="dialog"></div>';

				$popupBgImage = isset( $settings['popupBgImage'] ) ? $settings['popupBgImage']['url'] : '';
				$ppbistyle    = '';
				if ( ! empty( $copLoop ) && 'yes' === $copLoop && ! empty( $popupBgImage ) ) {
					$ppbistyle = 'style="background-image: url(' . esc_url( $popupBgImage ) . ');background-position: center center;background-repeat: no-repeat;background-size: cover;"';
				}

				$output .= '<div ' . $ppbistyle . ' class="ccd-main-modal copy-' . esc_attr( $copycodestyle ) . '" role="alert">';
				if ( ! empty( $modelClsIcon ) ) {
					$output .= '<button class="tp-ccd-closebtn" role="button">' . $modelClsIcon . '</button>';
				}

					$output .= '<div class="popup-code-modal">';

				if ( 'popup' === $action_type ) {
					$output .= '<div class="popup-content">';

						$output .= '<div class="content-title">' . esc_html( $popup_title ) . '</div>';
						$output .= '<div class="content-desc">' . esc_html( $popup_desc ) . '</div>';

					$output .= '</div>';
				}

				$output .= '<div class="coupon-code-outer">';

					$output .= '<span class="full-code-text">' . esc_html( $coupon_code ) . '</span>';
					$output .= '<button class="copy-code-btn">' . esc_html( $copy_btn_text ) . '</button>';

				$output .= '</div>';

				if ( ! empty( $visit_btn_text ) ) {
					$output .= '<div class="coupon-store-visit">';

						$output .= '<a class="store-visit-link" ' . $visitLink . '>' . esc_html( $visit_btn_text ) . '</a>';

					$output .= '</div>';
				}

					$output .= '</div>';

				$output .= '</div>';
			}

			$output .= '</div>';
		} elseif ( 'standard' !== $coupon_type ) {

			$output .= '<div class="coupon-front-side" id="front-side-' . esc_attr( $uid_ccd ) . '">';

				$output .= '<div class="coupon-front-inner">';

					$slideDirectionhint = isset( $settings['slideDirectionhint'] ) ? $settings['slideDirectionhint'] : '';

			if ( 'yes' === $slideDirectionhint ) {
				$output .= '<div class="tp-anim-pos-cont ' . esc_attr( $slide_out_class ) . '"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="67.000000pt" height="34.000000pt" viewBox="0 0 67.000000 34.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,34.000000) scale(0.100000,-0.100000)" fill="currentcolor" stroke="none"><path d="M300 250 c0 -64 -9 -86 -25 -60 -3 6 -13 10 -21 10 -29 0 -25 -30 9 -72 19 -24 38 -53 41 -66 7 -20 14 -22 69 -22 l62 0 14 53 c23 88 24 112 7 126 -12 10 -16 11 -16 1 0 -10 -3 -10 -15 0 -8 6 -19 9 -24 6 -5 -4 -13 -2 -16 4 -4 6 -15 8 -26 5 -17 -6 -19 -1 -19 39 0 39 -3 46 -20 46 -18 0 -20 -7 -20 -70z"/><path d="M91 156 l-32 -24 37 -23 c26 -16 39 -19 42 -11 2 7 17 12 33 12 24 0 29 4 29 25 0 21 -5 25 -30 25 -16 0 -30 5 -30 10 0 16 -14 12 -49 -14z"/><path d="M590 170 c0 -5 -16 -10 -35 -10 -31 0 -35 -3 -35 -25 0 -22 4 -25 34 -25 19 0 36 -5 38 -12 3 -8 15 -4 37 11 l33 24 -29 23 c-31 25 -43 29 -43 14z"/></g></svg></div>';
			}

			if ( 'default' === $front_content_type && ! empty( $front_content ) ) {
				$output .= '<div class="coupon-inner-content">';
				$output .= '<' . theplus_validate_html_tag( $frontContentTag ) . ' class="coupon-front-content">' . esc_attr( $front_content ) . '</' . theplus_validate_html_tag( $frontContentTag ) . '>';
				$output .= '</div>';
			} elseif ( 'template' === $front_content_type && ( ! empty( $frontTemp ) && '0' !== $frontTemp ) ) {
				$output .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $frontTemp ) . '</div>';
			}

			$output .= '</div>';
			$output .= '<div class="coupon-code-overlay"></div>';
			$output .= '</div>';

			$output .= '<div class="coupon-back-side">';
			$output .= '<div class="coupon-back-inner">';

			if ( 'default' === $backContentType ) {
				$output .= '<div class="coupon-back-content">';

				if ( ! empty( $backTitle ) ) {
					$output .= '<' . theplus_validate_html_tag( $backTitleTag ) . ' class="coupon-back-title">' . esc_html( $backTitle ) . '</' . theplus_validate_html_tag( $backTitleTag ) . '>';
				}

				if ( ! empty( $backDesc ) ) {
					$output .= '<p class="coupon-back-description">' . wp_kses_post( $backDesc ) . '</p>';
				}

				$output .= '</div>';

			} elseif ( 'template' === $backContentType && ( ! empty( $backTemp ) && '0' !== $backTemp ) ) {
				$output .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $backTemp ) . '</div>';
			}

			$output .= '</div>';
			$output .= '<div class="coupon-code-overlay"></div>';
			$output .= '</div>';
		}

		$output .= '</div>';

		echo $output;
	}
}

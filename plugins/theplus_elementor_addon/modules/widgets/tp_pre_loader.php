<?php
/**
 * Widget Name: Pre Loader
 * Description: Pre Loader
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
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Tp_Shape_Divider.
 */
class ThePlus_Pre_Loader extends Widget_Base {

	/**
	 * Widget Doc Link.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 *
	 * @var 5.0.0
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
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-pre-loader';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Pre Loader', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fas fa-spinner theplus_backend_icon';
	}

	/**
	 * Get doc url.
	 *
	 * @since 5.0.0
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget Categories.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keywords.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Preloader', 'Loading screen', 'Page loader', 'Spinner', 'Loading animation', 'Loading icon', 'Elementor preloader', 'Elementor loading screen', 'Elementor page loader', 'Elementor spinner', 'Elementor loading animation', 'Elementor loading icon' );
	}

	/**
	 * Register controls.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Pre Loader Content Section Start*/
		$this->start_controls_section(
			'contentSection',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'plcSelect',
			array(
				'label'   => wp_kses_post( "Select <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "multiple-preloaders-animations-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Image',
				'options' => array(
					'Image'       => esc_html__( 'Image', 'theplus' ),
					'Icon'        => esc_html__( 'Icon', 'theplus' ),
					'TextContent' => esc_html__( 'Text Content', 'theplus' ),
					'PreDefined'  => esc_html__( 'Predefined', 'theplus' ),
					'Lottie'      => esc_html__( 'Lottie', 'theplus' ),
					'CustomCode'  => esc_html__( 'Custom Code', 'theplus' ),
					'Shortcode'   => esc_html__( 'Shortcode', 'theplus' ),
					'Progress'    => esc_html__( 'Progress', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'plcprecentagelayout',
			array(
				'label'     => esc_html__( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'plcper1',
				'options'   => array(
					'plcper1' => esc_html__( 'Layout 1', 'theplus' ),
					'plcper2' => esc_html__( 'Layout 2', 'theplus' ),
					'plcper3' => esc_html__( 'Layout 3', 'theplus' ),
					'plcper4' => esc_html__( 'Layout 4', 'theplus' ),
					'plcper5' => esc_html__( 'Layout 5', 'theplus' ),
					'plcper6' => esc_html__( 'Layout 6', 'theplus' ),
				),
				'condition' => array(
					'plcSelect' => 'Progress',
				),
			)
		);
		$repeater->add_control(
			'plcper3prefix',
			array(
				'label'       => esc_html__( 'Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Prefix', 'theplus' ),
				'condition'   => array(
					'plcSelect'           => 'Progress',
					'plcprecentagelayout' => 'plcper3',
				),
			)
		);
		$repeater->add_control(
			'plcper3postfix',
			array(
				'label'       => esc_html__( 'Postfix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Postfix', 'theplus' ),
				'condition'   => array(
					'plcSelect'           => 'Progress',
					'plcprecentagelayout' => 'plcper3',
				),
			)
		);
		$repeater->add_control(
			'plcprecentagelayoutpos',
			array(
				'label'     => esc_html__( 'Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'plcperpostop',
				'options'   => array(
					'plcperpostop'    => esc_html__( 'Top', 'theplus' ),
					'plcperposbottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'plcSelect'           => 'Progress',
					'plcprecentagelayout' => 'plcper2',
				),
			)
		);
		$repeater->add_control(
			'plcsImage',
			array(
				'type'      => Controls_Manager::MEDIA,
				'label'     => wp_kses_post( "Image <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "image-preloader-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'plcSelect' => 'Image',
				),
			)
		);
		$repeater->add_control(
			'plcsImageLoader',
			array(
				'label'     => esc_html__( 'Loader on Image', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'plcSelect' => 'Image',
				),
			)
		);
		$repeater->add_control(
			'plcsIcons',
			array(
				'label'     => wp_kses_post( "Icon <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "icon-preloader-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-spinner',
					'library' => 'solid',
				),
				'condition' => array(
					'plcSelect' => 'Icon',
				),
			)
		);
		$repeater->add_control(
			'plcsText',
			array(
				'label'       => wp_kses_post( "Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "how-to-add-text-based-preloader-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Loading…', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Content Text', 'theplus' ),
				'condition'   => array(
					'plcSelect' => 'TextContent',
				),
			)
		);
		$repeater->add_control(
			'plcsTextLoader',
			array(
				'label'     => esc_html__( 'Loader on Text', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'plcSelect' => 'TextContent',
				),
			)
		);
		$repeater->add_control(
			'plcsLottieUrl',
			array(
				'label'       => wp_kses_post( "Lottie URL <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "lottie-file-preloader-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'plcSelect' => 'Lottie',
				),
			)
		);
		$repeater->add_responsive_control(
			'plcsLottieWidth',
			array(
				'label'     => esc_html__( 'Width', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 300,
				),
				'separator' => 'before',
				'condition' => array(
					'plcSelect' => 'Lottie',
				),
			)
		);
		$repeater->add_responsive_control(
			'plcsLottieHeight',
			array(
				'label'     => esc_html__( 'Height', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 300,
				),
				'condition' => array(
					'plcSelect' => 'Lottie',
				),
			)
		);
		$repeater->add_responsive_control(
			'plcsLottieSpeed',
			array(
				'label'     => esc_html__( 'Speed', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 1,
				),
				'condition' => array(
					'plcSelect' => 'Lottie',
				),
			)
		);
		$repeater->add_control(
			'plcsLottieLoop',
			array(
				'label'     => esc_html__( 'Loop Animation', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'plcSelect' => 'Lottie',
				),
			)
		);
		$repeater->add_control(
			'plcsPreAnimation',
			array(
				'label'     => esc_html__( 'Select', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'animation-1',
				'options'   => array(
					'animation-1'  => esc_html__( 'Animation 1', 'theplus' ),
					'animation-2'  => esc_html__( 'Animation 2', 'theplus' ),
					'animation-3'  => esc_html__( 'Animation 3', 'theplus' ),
					'animation-4'  => esc_html__( 'Animation 4', 'theplus' ),
					'animation-5'  => esc_html__( 'Animation 5', 'theplus' ),
					'animation-6'  => esc_html__( 'Animation 6', 'theplus' ),
					'animation-7'  => esc_html__( 'Animation 7', 'theplus' ),
					'animation-8'  => esc_html__( 'Animation 8', 'theplus' ),
					'animation-9'  => esc_html__( 'Animation 9', 'theplus' ),
					'animation-10' => esc_html__( 'Animation 10', 'theplus' ),
					'animation-12' => esc_html__( 'Animation 11', 'theplus' ),
					'animation-14' => esc_html__( 'Animation 12', 'theplus' ),
					'animation-15' => esc_html__( 'Animation 13', 'theplus' ),
				),
				'condition' => array(
					'plcSelect' => 'PreDefined',
				),
			)
		);
		$repeater->add_control(
			'plcsCustomCode',
			array(
				'label'       => wp_kses_post( "code <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "custom-css-preloader-animations-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Your Custom Code.', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'plcSelect' => 'CustomCode',
				),
			)
		);
		$repeater->add_control(
			'plcsCustomShortCode',
			array(
				'label'       => wp_kses_post( "Shortcode <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "shortcode-based-preloader-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Shortcode.', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'plcSelect' => 'Shortcode',
				),
			)
		);
		$this->add_control(
			'preLoaderContent',
			array(
				'label'       => wp_kses_post( "Preloader <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "preloader-elementor-widget-settings-overview/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'plcSelect' => 'Image',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ plcSelect }}}',
			)
		);
		$this->add_control(
			'backpreloader',
			array(
				'label'       => esc_html__( 'Backend Visibility', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'no',
				'description' => esc_html__( 'Note : It will show static preloader area just for design purpose.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();

		/** Animation Load first Section Start*/
		$this->start_controls_section(
			'aniLoadFirstSection',
			array(
				'label' => esc_html__( 'Load First', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'alfSwitch',
			array(
				'label'     => wp_kses_post( "Exclude Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "exclude-content-from-preloader-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'alfExclude',
			array(
				'label'     => esc_html__( 'Exclude', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'alfheader',
				'options'   => array(
					'alfheader' => esc_html__( 'Header', 'theplus' ),
					'alfcustom' => esc_html__( 'Custom', 'theplus' ),
				),
				'condition' => array(
					'alfSwitch' => 'yes',
				),
			)
		);
		$this->add_control(
			'alfExcludecustom',
			array(
				'label'       => esc_html__( 'Class', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => '',
				'placeholder' => esc_html__( '.your-class', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'alfSwitch'  => 'yes',
					'alfExclude' => 'alfcustom',
				),
			)
		);
		$this->add_control(
			'alfExcludeZIndexpos',
			array(
				'label'     => esc_html__( 'Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'alfSwitch'  => 'yes',
					'alfExclude' => 'alfcustom',
				),
			)
		);
		$this->add_control(
			'alfExcludeZIndex',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Z-Index', 'theplus' ),
				'size_units' => array( 'px' ),
				'separator'  => 'before',
				'default'    => array(
					'unit' => 'px',
					'size' => 12345,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 99999,
						'step' => 100,
					),
				),
				'condition'  => array(
					'alfSwitch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/** Page Transition Section Start*/
		$this->start_controls_section(
			'pageLoadSection',
			array(
				'label' => esc_html__( 'Page Transition', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'inTransition',
			array(
				'label' => wp_kses_post( "In Transition <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "page-loading-transition-effects-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'pageLoadTransition',
			array(
				'label'   => esc_html__( 'Transition', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'pageloadfadein',
				'options' => array(
					'pageloadfadein'       => esc_html__( 'Fade', 'theplus' ),
					'pageloadslidein'      => esc_html__( 'Slide', 'theplus' ),
					'pageloadtripleswoosh' => esc_html__( 'Triple Swoosh', 'theplus' ),
					'pageloadsimple'       => esc_html__( 'Simple', 'theplus' ),
					'pageloadduomove'      => esc_html__( 'Duo Move', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'pageLoad4InDir',
			array(
				'label'     => esc_html__( 'Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'        => esc_html__( 'Left', 'theplus' ),
					'right'       => esc_html__( 'Right', 'theplus' ),
					'top'         => esc_html__( 'Top', 'theplus' ),
					'bottom'      => esc_html__( 'Bottom', 'theplus' ),
					'topleft'     => esc_html__( 'Top Left', 'theplus' ),
					'topright'    => esc_html__( 'Top Right', 'theplus' ),
					'bottomleft'  => esc_html__( 'Bottom Left', 'theplus' ),
					'bottomright' => esc_html__( 'Bottom Right', 'theplus' ),
				),
				'condition' => array(
					'pageLoadTransition' => array( 'pageloadtripleswoosh', 'pageloadsimple', 'pageloadduomove' ),
				),
			)
		);
		$this->add_control(
			'pageLoadSlideInDir',
			array(
				'label'     => esc_html__( 'Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'pageLoadTransition' => 'pageloadslidein',
				),
			)
		);
		$this->add_control(
			'outTransition',
			array(
				'label'     => esc_html__( 'Out Transition', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'postLoadTransition',
			array(
				'label'     => esc_html__( 'Transition', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'postloadfadeout',
				'options'   => array(
					'postloadfadeout'       => esc_html__( 'Fade', 'theplus' ),
					'postloadslideout'      => esc_html__( 'Slide', 'theplus' ),
					'postloadstripleswoosh' => esc_html__( 'Triple Swoosh', 'theplus' ),
					'postloadssimple'       => esc_html__( 'Simple', 'theplus' ),
					'postloadsduomove'      => esc_html__( 'Duo Move', 'theplus' ),
				),
				'condition' => array(
					'outTransition' => 'yes',
				),
			)
		);
		$this->add_control(
			'postLoad4InDir',
			array(
				'label'     => esc_html__( 'Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'        => esc_html__( 'Left', 'theplus' ),
					'right'       => esc_html__( 'Right', 'theplus' ),
					'top'         => esc_html__( 'Top', 'theplus' ),
					'bottom'      => esc_html__( 'Bottom', 'theplus' ),
					'topleft'     => esc_html__( 'Top Left', 'theplus' ),
					'topright'    => esc_html__( 'Top Right', 'theplus' ),
					'bottomleft'  => esc_html__( 'Bottom Left', 'theplus' ),
					'bottomright' => esc_html__( 'Bottom Right', 'theplus' ),
				),
				'condition' => array(
					'outTransition'      => 'yes',
					'postLoadTransition' => array( 'postloadstripleswoosh', 'postloadssimple', 'postloadsduomove' ),
				),
			)
		);
		$this->add_control(
			'postLoadSlideInDir',
			array(
				'label'     => esc_html__( 'Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'outTransition'      => 'yes',
					'postLoadTransition' => 'postloadslideout',
				),
			)
		);
		$this->add_control(
			'postLoadExcludeCustom',
			array(
				'label'       => esc_html__( 'Exclude Class', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Exclude Class.', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'outTransition' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/** Extra Option Section Start*/
		$this->start_controls_section(
			'extraOptionsSection',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'loadtime',
			array(
				'label'   => esc_html__( 'Load Time', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'loadtimedefault',
				'options' => array(
					'loadtimedefault' => esc_html__( 'Default', 'theplus' ),
					'loadtimemin'     => esc_html__( 'Minimum', 'theplus' ),
					'loadtimemax'     => esc_html__( 'Maximum', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'loadmaxtime',
			array(
				'label'     => esc_html__( 'Time (Second)', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 60,
						'step' => 1,
					),
				),
				'condition' => array(
					'loadtime' => 'loadtimemax',
				),
			)
		);
		$this->add_responsive_control(
			'loadmintime',
			array(
				'label'     => esc_html__( 'Time (Second)', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 60,
						'step' => 1,
					),
				),
				'condition' => array(
					'loadtime' => 'loadtimemin',
				),
			)
		);
		$this->end_controls_section();

		/** Image Style Section Start*/
		$this->start_controls_section(
			'pr_image_styling',
			array(
				'label' => esc_html__( 'Image', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pr_image_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max Width', 'theplus' ),
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
					'.tp-loader-wrapper #tp-loader #tp-preloader-logo-img img,#tp-img-loader .tp-preloader-logo-img' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'pr_image_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader #tp-preloader-logo-img img,
                    #tp-img-loader .tp-preloader-logo-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pr_image_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '.tp-loader-wrapper #tp-loader #tp-preloader-logo-img img, #tp-img-loader .tp-preloader-logo-img',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'pr_imageb_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader #tp-preloader-logo-img img, #tp-img-loader .tp-preloader-logo-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pr_image_shadow',
				'selector' => '.tp-loader-wrapper #tp-loader #tp-preloader-logo-img img, #tp-img-loader .tp-preloader-logo-img',
			)
		);
		$this->add_control(
			'imageloaderheading',
			array(
				'label'     => esc_html__( 'Image Loader', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'il_tabs' );
		$this->start_controls_tab(
			'il_norm',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'if_n_i_opacity',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Opacity', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => .1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0.3,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} #tp-img-loader .tp-preloader-logo-img' => 'opacity: {{SIZE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'if_n_i_filters',
				'selector'  => '{{WRAPPER}} #tp-img-loader .tp-preloader-logo-img',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'il_fill',
			array(
				'label' => esc_html__( 'Fill', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'if_f_i_opacity',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Opacity', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => .1,
						'max'  => 1,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 1,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-img-loader-wrap .tp-img-loader-wrap-in' => 'opacity: {{SIZE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'if_f_i_filters',
				'selector'  => '{{WRAPPER}} #tp-img-loader-wrap .tp-img-loader-wrap-in',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Icon Style Section Start*/
		$this->start_controls_section(
			'pr_icon_styling',
			array(
				'label' => esc_html__( 'Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pr_icon_size',
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
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'pr_icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon i,.tp-loader-wrapper #tp-loader .tp-preloader-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pr_icon_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon i,.tp-loader-wrapper #tp-loader .tp-preloader-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'pr_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon i:before' => 'color: {{VALUE}};',
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pr_icon_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-icon i,.tp-loader-wrapper #tp-loader .tp-preloader-icon svg',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pr_icon_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-icon i,.tp-loader-wrapper #tp-loader .tp-preloader-icon svg',
			)
		);
		$this->add_responsive_control(
			'pr_iconb_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-icon i,.tp-loader-wrapper #tp-loader .tp-preloader-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pr_icon_shadow',
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-icon i,.tp-loader-wrapper #tp-loader .tp-preloader-icon svg',
			)
		);
		$this->end_controls_section();

		/** Text Style Section Start*/
		$this->start_controls_section(
			'pr_text_styling',
			array(
				'label' => esc_html__( 'Text', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pr_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
					.tp-loader-wrapper .tp-text-loader,.tp-loader-wrapper .tp-text-loader .tp-text-loader-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pr_text_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
					.tp-loader-wrapper .tp-text-loader,.tp-loader-wrapper .tp-text-loader .tp-text-loader-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pr_text_typography',
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
				.tp-loader-wrapper .tp-text-loader,.tp-loader-wrapper .tp-text-loader .tp-text-loader-inner',
			)
		);
		$this->add_control(
			'pr_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,.tp-loader-wrapper .tp-text-loader' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pr_text_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
				.tp-loader-wrapper .tp-text-loader',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pr_text_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
				.tp-loader-wrapper .tp-text-loader',
			)
		);
		$this->add_responsive_control(
			'pr_textb_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
					.tp-loader-wrapper .tp-text-loader' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pr_text_shadow',
				'selector' => '.tp-loader-wrapper #tp-loader .tp-preloader-animated-text span,
				.tp-loader-wrapper .tp-text-loader',
			)
		);
		$this->add_control(
			'textloaderheading',
			array(
				'label'     => esc_html__( 'Text Loader', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'textloader_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-loader-wrapper .tp-text-loader .tp-text-loader-inner' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Predefied Style Section Start*/
		$this->start_controls_section(
			'pr_predefined_styling',
			array(
				'label' => esc_html__( 'Predefined', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pr_predefine_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'#tp-loader > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pr_predefine_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'#tp-loader > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pr_predefined_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'.tp-ball-grid-pulse>div,
					.tp-rounded-triangle' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'pr_predefined_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Progress bar Style Section Start*/
		$this->start_controls_section(
			'pr_progress_styling',
			array(
				'label' => esc_html__( 'Progress Bar', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'progresswidth',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vw' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 300,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-preloader-wrap,
					{{WRAPPER}} .tp-preloader-wrap4,
					{{WRAPPER}} .tp-preloader-wrap6' => 'min-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'progressheight',
			array(
				'label'     => esc_html__( 'Height', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 30,
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-loader,{{WRAPPER}} .tp-percentage,{{WRAPPER}} .percentagelayout,{{WRAPPER}} .tp-preloader-wrap4' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'progressmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-preloader-wrap,
					{{WRAPPER}} .tp-preloader-wrap4,
					{{WRAPPER}} .tp-preloader-wrap6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'progressbar',
			array(
				'label'     => esc_html__( 'Progress Bar', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'progressbargradiantcolor',
			array(
				'label'     => esc_html__( 'Gradient Color', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'progressbarcolor1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6fc784',
				'condition' => array(
					'progressbargradiantcolor!' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolor2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6fc784d4',
				'selectors' => array(
					'{{WRAPPER}} .tp-loadbar,{{WRAPPER}} .percentagelayout,{{WRAPPER}} .tp-preloader-wrap4.plcper4 .tp-preloader-wrap4-in,
					{{WRAPPER}} .tp-preloader-wrap5.plcper5 .tp-pre-5' => 'background: repeating-linear-gradient(45deg,  {{progressbarcolor1.VALUE}}, {{progressbarcolor1.VALUE}} 10px, {{progressbarcolor2.VALUE}} 10px, {{progressbarcolor2.VALUE}} 20px);',
					'{{WRAPPER}} .tp-glow' => 'box-shadow: 0 0 60px 10px {{progressbarcolor1.VALUE}};',
				),
				'condition' => array(
					'progressbargradiantcolor!' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffd33d',
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg3',
			array(
				'label'     => esc_html__( 'Color 3', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8072fc',
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg4',
			array(
				'label'     => esc_html__( 'Color 4', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6fc784',
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg5',
			array(
				'label'     => esc_html__( 'Color 5', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f7d782',
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg6',
			array(
				'label'     => esc_html__( 'Color 6', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorg7',
			array(
				'label'     => esc_html__( 'Color 7', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8072fc',
				'selectors' => array(
					'{{WRAPPER}} .tp-loadbar,{{WRAPPER}} .percentagelayout,{{WRAPPER}} .tp-preloader-wrap4.plcper4 .tp-preloader-wrap4-in,
					{{WRAPPER}} .tp-preloader-wrap5.plcper5 .tp-pre-5' => 'background: linear-gradient(90deg,{{progressbarcolorg1.VALUE}},{{progressbarcolorg2.VALUE}} 17%,{{progressbarcolorg3.VALUE}} 34%,{{progressbarcolorg4.VALUE}} 51%,{{progressbarcolorg5.VALUE}} 68%,{{progressbarcolorg6.VALUE}} 85%,{{progressbarcolorg7.VALUE}});',
					'{{WRAPPER}} .tp-glow' => 'box-shadow: 0 0 60px 10px {{progressbarcolorg1.VALUE}};',
				),
				'condition' => array(
					'progressbargradiantcolor' => 'yes',
				),
			)
		);
		$this->add_control(
			'progressbarcolorempty',
			array(
				'label'     => esc_html__( 'Progress Empty Color (Layout 4)', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff7d',
				'selectors' => array(
					'{{WRAPPER}} .tp-preloader-wrap4.plcper4' => 'background-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'progressbar5size',
			array(
				'label'     => esc_html__( 'Progress Size (Layout 5)', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 25,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 3,
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-preloader-wrap5.plcper5 .tp-pre-5-in3,{{WRAPPER}}  .tp-preloader-wrap5.plcper5 .tp-pre-5-in4' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-preloader-wrap5.plcper5 .tp-pre-5-in1,{{WRAPPER}}  .tp-preloader-wrap5.plcper5 .tp-pre-5-in2' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'progressbordercolor',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-percentage.tp-percentage-load',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'progressborderradious',
			array(
				'label'     => esc_html__( 'Border Radius', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-loadbar,.percentagelayout,{{WRAPPER}} .tp-percentage.tp-percentage-load' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		/** Progress Number Style Section Start*/
		$this->start_controls_section(
			'progresstext_styling',
			array(
				'label' => esc_html__( 'Progress Number', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'progresstexttypography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-percentage.tp-percentage-load,{{WRAPPER}} .tp-preloader-wrap.plcper3 div#tp-precent3,
				{{WRAPPER}} .tp-preloader-wrap4.plcper4 .tp-preloader-wrap4-in',

			)
		);
		$this->add_control(
			'progresstextcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .tp-percentage.tp-percentage-load,{{WRAPPER}} .tp-preloader-wrap.plcper3 div#tp-precent3,
					{{WRAPPER}} .tp-preloader-wrap4.plcper4 .tp-preloader-wrap4-in' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_control(
			'progresstextprepostheading',
			array(
				'label'     => esc_html__( 'Progress Layout 3', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'progresstextprefix',
			array(
				'label' => esc_html__( 'Prefix', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'progresstextprefixtypography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-preloader-wrap.plcper3 span.tp-perc-prepostfix.tp-perc-pre',

			)
		);
		$this->add_control(
			'progresstextprefixcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .tp-preloader-wrap.plcper3 span.tp-perc-prepostfix.tp-perc-pre' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_control(
			'progresstextpostfix',
			array(
				'label'     => esc_html__( 'Postfix', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'progresstextpostfixtypography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-preloader-wrap.plcper3 span.tp-perc-prepostfix.tp-perc-post',

			)
		);
		$this->add_control(
			'progresstextpostfixcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .tp-preloader-wrap.plcper3 span.tp-perc-prepostfix.tp-perc-post' => 'color: {{VALUE}}',
				),

			)
		);
		$this->end_controls_section();

		/** Progress Circle Style Section Start*/
		$this->start_controls_section(
			'progresscircle_styling',
			array(
				'label' => esc_html__( 'Progress Circle', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'pctextemptycolor',
			array(
				'label'   => esc_html__( 'Empty Color', 'theplus' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff36',

			)
		);
		$this->add_control(
			'pctextfillcolor',
			array(
				'label'   => esc_html__( 'Fill Color', 'theplus' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#fff',

			)
		);
		$this->add_responsive_control(
			'pctextstrocksize',
			array(
				'label'      => esc_html__( 'Stroke Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 4,
				),
			)
		);
		$this->add_control(
			'pctextheading',
			array(
				'label'     => esc_html__( 'Percentage Styling', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pctexttypography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-preloader-wrap6.plcper6 .tp-percentage.tp-percentage-load',

			)
		);
		$this->add_control(
			'pctextcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .tp-preloader-wrap6.plcper6 .tp-percentage.tp-percentage-load' => 'color: {{VALUE}}',
				),

			)
		);
		$this->end_controls_section();

		/** Transition Style Section Start*/
		$this->start_controls_section(
			'pr_extra_transition_styling',
			array(
				'label'     => esc_html__( 'Transition Effect', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pageLoadTransition' => array( 'pageloadtripleswoosh', 'pageloadsimple', 'pageloadduomove' ),
				),
			)
		);
		$this->add_control(
			'tp4color1',
			array(
				'label'   => esc_html__( 'Color 1', 'theplus' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ff5a6e',
			)
		);
		$this->add_control(
			'tp4color2',
			array(
				'label'      => esc_html__( 'Color 2', 'theplus' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#8072fc',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'pageLoadTransition',
									'operator' => '==',
									'value'    => 'pageloadtripleswoosh',
								),
								array(
									'name'     => 'pageLoadTransition',
									'operator' => '==',
									'value'    => 'pageloadduomove',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'tp4color3',
			array(
				'label'      => esc_html__( 'Color 3', 'theplus' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#6fc784',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'pageLoadTransition',
									'operator' => '==',
									'value'    => 'pageloadtripleswoosh',
								),
							),
						),
					),
				),
			)
		);
		$this->end_controls_section();

		/** Box Style Section Start*/
		$this->start_controls_section(
			'pr_box_styling',
			array(
				'label' => esc_html__( 'Box', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pr_box_width',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vw' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-loader-wrapper #tp-loader' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pr_box_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'#tp-loader-wrapper #tp-loader' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pr_box_BG',
				'label'    => esc_html__( 'Background Type', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '#tp-loader-wrapper #tp-loader',

			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pr_box_Border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '#tp-loader-wrapper #tp-loader',
			)
		);
		$this->add_responsive_control(
			'pr_box_BRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'#tp-loader-wrapper #tp-loader' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pr_box_Shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '#tp-loader-wrapper #tp-loader',

			)
		);
		$this->add_control(
			'whole_pr_box',
			array(
				'label'     => esc_html__( 'Whole Background', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pr_whole_box_BG',
				'label'    => esc_html__( 'Background Type', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '#tp-loader-wrapper',

			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Pre Loader.
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$pre_loader_content = $settings['preLoaderContent'];

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && ( ! empty( $settings['backpreloader'] ) && 'yes' === $settings['backpreloader'] ) ) {
			echo '<style>.tp-loaded #tp-loader-wrapper{visibility:visible;opacity:1}.tp-loaded #tp-loader{opacity:1}.tp-loadbar{width:50%}.tp-percentage{border:2px solid #6fc784}</style>';
		}

		$page_load4_in_dir = ! empty( $settings['pageLoad4InDir'] ) ? $settings['pageLoad4InDir'] : 'left';
		$post_load4_in_dir = ! empty( $settings['postLoad4InDir'] ) ? $settings['postLoad4InDir'] : 'left';

		$page_load_transition = ! empty( $settings['pageLoadTransition'] ) ? $settings['pageLoadTransition'] : 'pageloadfadein';
		$post_load_transition = ! empty( $settings['postLoadTransition'] ) ? $settings['postLoadTransition'] : 'postloadfadeout';

		$page_load_slide_in_dir = ! empty( $settings['pageLoadSlideInDir'] ) ? $settings['pageLoadSlideInDir'] : 'left';
		$post_load_slide_in_dir = ! empty( $settings['postLoadSlideInDir'] ) ? $settings['postLoadSlideInDir'] : 'left';

		$slideinclass  = '';
		$preloader_src = '';
		$slideoutclass = '';

		$slideinclasseclass = '';

		if ( 'pageloadslidein' === $page_load_transition && ! empty( $page_load_slide_in_dir ) ) {
			$slideinclass = 'tp-duo-move-' . esc_attr( $page_load_slide_in_dir );
		}

		if ( ! empty( $post_load_transition ) && 'postloadslideout' === $post_load_transition && ! empty( $page_load_slide_in_dir ) ) {
			$slideoutclass = 'tp-out-duo-move-' . esc_attr( $post_load_slide_in_dir );
		}

		if ( 'pageloadtripleswoosh' === $page_load_transition || 'pageloadsimple' === $page_load_transition || 'pageloadduomove' === $page_load_transition || 'postloadstripleswoosh' === $post_load_transition || 'postloadssimple' === $post_load_transition || 'postloadsduomove' === $post_load_transition ) {
			$slideinclasseclass = 'tp-preload-transion4';
		}

		if ( 'pageloadtripleswoosh' === $page_load_transition && ! empty( $page_load4_in_dir ) ) {
			$slideinclass = 'tp-tripleswoosh tp-4-preload-' . esc_attr( $page_load4_in_dir );
		}

		if ( ! empty( $post_load_transition ) && 'postloadstripleswoosh' === $post_load_transition && ! empty( $post_load4_in_dir ) ) {
			$slideoutclass = 'tp-tripleswoosh tp-4-postload-' . esc_attr( $post_load4_in_dir );
		}

		if ( 'pageloadsimple' === $page_load_transition && ! empty( $page_load4_in_dir ) ) {
			$slideinclass = 'tp-simple tp-4-preload-' . esc_attr( $page_load4_in_dir );
		}

		if ( ! empty( $post_load_transition ) && 'postloadssimple' === $post_load_transition && ! empty( $post_load4_in_dir ) ) {
			$slideoutclass = 'tp-tripleswoosh tp-4-postload-' . esc_attr( $post_load4_in_dir );
		}

		if ( 'pageloadduomove' === $page_load_transition && ! empty( $page_load4_in_dir ) ) {
			$slideinclass = 'tp-duomove2 tp-4-preload-' . esc_attr( $page_load4_in_dir );
		}

		if ( ! empty( $post_load_transition ) && 'postloadsduomove' === $post_load_transition && ! empty( $post_load4_in_dir ) ) {
			$slideoutclass = 'tp-tripleswoosh tp-4-postload-' . esc_attr( $post_load4_in_dir );
		}

		$preload_opt = array();
		$data_attr   = '';

		$preload_opt['post_load_opt'] = 'disablepostload';
		if ( ! empty( $settings['outTransition'] ) && 'yes' === $settings['outTransition'] ) {
			$preload_opt['post_load_opt'] = 'enablepostload';
			if ( ! empty( $settings['postLoadExcludeCustom'] ) ) {
				$preload_opt['post_load_exclude_class'] = $settings['postLoadExcludeCustom'];
			}
		}

		if ( ! empty( $settings['loadtime'] ) && 'loadtimedefault' !== $settings['loadtime'] ) {
			if ( 'loadtimemin' === $settings['loadtime'] && isset( $settings['loadmintime'] ) && ! empty( $settings['loadmintime']['size'] ) ) {
				$preload_opt['loadtime']    = 'loadtimemin';
				$preload_opt['loadmintime'] = $settings['loadmintime']['size'];
			} elseif ( 'loadtimemax' === $settings['loadtime'] && isset( $settings['loadmaxtime'] ) && ! empty( $settings['loadmaxtime']['size'] ) ) {
				$preload_opt['loadtime']    = 'loadtimemax';
				$preload_opt['loadmaxtime'] = $settings['loadmaxtime']['size'];
			}
		}

		$data_attr = ' data-plec=\'' . wp_json_encode( $preload_opt ) . '\'';
		if ( ! empty( $pre_loader_content ) ) {
			$index = 0;

			$sectioncolumn  = 'body';
			$preloader_src .= '<div id="tp-loader-wrapper" class="tp-loader-wrapper ' . esc_attr( $slideinclass ) . ' ' . esc_attr( $slideoutclass ) . ' ' . esc_attr( $slideinclasseclass ) . '" ' . $data_attr . ' data-post_load_opt=' . esc_attr( $preload_opt['post_load_opt'] ) . '>';

			foreach ( $pre_loader_content as $item1 ) {

				$plc_select1 = ! empty( $item1['plcSelect'] ) ? $item1['plcSelect'] : 'Image';

				$plc_precentage_layout1     = ! empty( $item1['plcprecentagelayout'] ) ? $item1['plcprecentagelayout'] : 'plcper1';
				$plc_precentage_layout_pos1 = ! empty( $item1['plcprecentagelayoutpos'] ) ? $item1['plcprecentagelayoutpos'] : 'plcperpostop';
				if ( ( ! empty( $plc_select1 ) && 'Progress' === $plc_select1 ) && ( ! empty( $plc_precentage_layout1 ) && 'plcper2' === $plc_precentage_layout1 ) ) {
					$plcposclass = '';
					if ( ! empty( $plc_precentage_layout_pos1 ) ) {
						if ( 'plcperpostop' === $plc_precentage_layout_pos1 ) {
							$plcposclass = 'tp-perc-top';
						} elseif ( 'plcperposbottom' === $plc_precentage_layout_pos1 ) {
							$plcposclass = 'tp-perc-bottom';
						}
					}
					$preloader_src .= '<span class="percentagelayout ' . esc_attr( $plcposclass ) . '"></span>';
				} elseif ( 'Progress' === $plc_select1 && ( ! empty( $plc_precentage_layout1 ) && 'plcper5' === $plc_precentage_layout1 ) ) {
					$preloader_src .= '<div class="tp-preloader-wrap5 ' . esc_attr( $plc_precentage_layout1 ) . '">
					<div class="tp-pre-5 tp-pre-5-in1" id="tp-precent5"></div>
					<div class="tp-pre-5 tp-pre-5-in2" id="tp-precent5"></div>
					<div class="tp-pre-5 tp-pre-5-in3" id="tp-precent5"></div>
					<div class="tp-pre-5 tp-pre-5-in4" id="tp-precent5"></div>
					</div>';
				}
				++$index;
			}

			$preloader_src .= '<div id="tp-loader">';

			foreach ( $pre_loader_content as $item ) {

				$plc_select  = ! empty( $item['plcSelect'] ) ? $item['plcSelect'] : 'Image';
				$plcs_text   = ! empty( $item['plcsText'] ) ? $item['plcsText'] : 'Loading…';
				$alf_exclude = ! empty( $settings['alfExclude'] ) ? $settings['alfExclude'] : 'alfheader';

				$plcs_pre_animation = ! empty( $item['plcsPreAnimation'] ) ? $item['plcsPreAnimation'] : 'animation-1';
				if ( ! empty( $plc_select ) ) {
					/** Image*/
					if ( 'Image' === $plc_select && ! empty( $item['plcsImage']['url'] ) ) {
						$plcs_image = $item['plcsImage']['url'];
						$image_id   = $item['plcsImage']['id'];
						$image_alt  = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

						if ( ! empty( $image_alt ) ) {
							$image_alt = get_the_title( $image_id );
						} elseif ( ! empty( $image_alt ) ) {
							$image_alt = 'Image';
						}

						if ( isset( $item['plcsImageLoader'] ) && 'yes' === $item['plcsImageLoader'] ) {
							$preloader_src .= "<div id='tp-img-loader'><div class='tp-img-loader-wrap'><span style='background-image: url(" . esc_url( $plcs_image ) . ");' data-no-lazy='1' class='tp-img-loader-wrap-in skip-lazy'></span></div><img data-no-lazy='1' class='tp-preloader-logo-img skip-lazy' alt='" . esc_attr( $image_alt ) . "' src='" . esc_url( $plcs_image ) . "'></div>";
						} else {
							$preloader_src .= '<div id="tp-preloader-logo-img" class="img"><img class="tp-preloader-image" src=' . esc_url( $plcs_image ) . ' alt="' . esc_attr( $image_alt ) . '" /></div>';
						}
					}

					/** Icon*/
					if ( 'Icon' === $plc_select && ! empty( $item['plcsIcons'] ) ) {
						ob_start();
						\Elementor\Icons_Manager::render_icon( $item['plcsIcons'], array( 'aria-hidden' => 'true' ) );
						$preloader_icon_src = ob_get_contents();
						ob_end_clean();
						$preloader_src .= '<div id="tp-preloader-logo-img" class="icon"><span class="tp-preloader-icon">' . $preloader_icon_src . '</span></div>';
					}
					/** Text*/
					if ( 'TextContent' === $plc_select && ! empty( $plcs_text ) ) {
						if ( isset( $item['plcsTextLoader'] ) && 'yes' === $item['plcsTextLoader'] ) {
							$preloader_src .= "<div class='tp-text-loader'>" . esc_html( $plcs_text ) . "<div class='tp-text-loader-inner'>" . esc_html( $plcs_text ) . '</div></div>';
						} else {
							$preloader_src .= '<div class="tp-preloader-animated-text"><span>' . esc_html( $plcs_text ) . '</span></div>';
						}
					}

					/** Predefine Animation*/
					if ( 'PreDefined' === $plc_select && ! empty( $plcs_pre_animation ) ) {
						if ( 'animation-1' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
						} elseif ( 'animation-2' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-ball-triangle-path"><div></div><div></div><div></div></div>';
						} elseif ( 'animation-3' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-ball-scale-ripple-multiple"><div></div><div></div><div></div></div>';
						} elseif ( 'animation-4' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-triangle-skew-spin"><div></div></div>';
						} elseif ( 'animation-5' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-rounded-triangle"></div>';
						} elseif ( 'animation-6' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp_preloader_audio_wave"><span></span><span></span><span></span><span></span><span></span></div>';
						} elseif ( 'animation-7' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp_typing_loader"></div>';
						} elseif ( 'animation-8' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-preloader-help"></div>';
						} elseif ( 'animation-9' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-preloader-cord"><div class="tp-cord tp-leftMove"><div class="tp-ball"></div></div><div class="tp-cord"><div class="tp-ball"></div></div><div class="tp-cord"><div class="tp-ball"></div></div><div class="tp-cord"><div class="tp-ball"></div></div><div class="tp-cord"><div class="tp-ball"></div></div><div class="tp-cord"><div class="tp-ball"></div></div><div class="tp-cord tp-rightMove"><div class="tp-ball" id="tp-first"></div></div><div class="tp-shadows"><div class="tp-leftShadow"></div><div></div><div></div><div></div><div></div><div></div><div class="tp-rightShadow"></div></div></div>';
						} elseif ( 'animation-10' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-preloader-dot"><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span><span class="tp-preloader-dots"></span></div>';
						} elseif ( 'animation-12' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp-preloader-12-main"><span class="tp-preloader-12 tp_dot_1"></span><span class="tp-preloader-12 tp_dot_2"></span><span class="tp-preloader-12 tp_dot_3"></span><span class="tp-preloader-12 tp_dot_4"></span></div>';
						} elseif ( 'animation-14' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp_preloader_the_shake"><span></span><span></span><span></span><span></span><span></span></div>';
						} elseif ( 'animation-15' === $plcs_pre_animation ) {
							$preloader_src .= '<div class="tp_preloader_spinning_disc_block"><div class="tp_preloader_spinning_disc"></div></div>';
						}
					}

					/** Predefine Animation*/
					if ( 'Lottie' === $plc_select && ! empty( $item['plcsLottieUrl']['url'] ) ) {
						$ext = pathinfo( $item['plcsLottieUrl']['url'], PATHINFO_EXTENSION );
						if ( 'json' !== $ext ) {
							echo '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';

							return false;
						} else {
							$plcs_lottie_width  = isset( $item['plcsLottieWidth']['size'] ) ? $item['plcsLottieWidth']['size'] : 300;
							$plcs_lottie_height = isset( $item['plcsLottieHeight']['size'] ) ? $item['plcsLottieHeight']['size'] : 300;
							$plcs_lottie_speed  = isset( $item['plcsLottieSpeed']['size'] ) ? $item['plcsLottieSpeed']['size'] : 1;
							$plcs_lottie_loop   = isset( $item['plcsLottieLoop'] ) ? $item['plcsLottieLoop'] : 'no';

							$plcs_lottie_loop_value = '';
							if ( ! empty( $item['plcsLottieLoop'] ) && 'yes' === $item['plcsLottieLoop'] ) {
								$plcs_lottie_loop_value = 'loop';
							}

							$preloader_src .= '<lottie-player src="' . esc_url( $item['plcsLottieUrl']['url'] ) . '" style="width: ' . esc_attr( $plcs_lottie_width ) . 'px; height: ' . esc_attr( $plcs_lottie_height ) . 'px;" ' . esc_attr( $plcs_lottie_loop_value ) . '  speed="' . esc_attr( $plcs_lottie_speed ) . '" autoplay></lottie-player>';
						}
					}

					/** Custom */
					$plc_precentage_layout = ! empty( $item['plcprecentagelayout'] ) ? $item['plcprecentagelayout'] : 'plcper1';
					if ( 'CustomCode' === $plc_select && ! empty( $item['plcsCustomCode'] ) ) {
						$preloader_src .= '<div class="tp-preloader-custom">' . wp_kses_post( $item['plcsCustomCode'] ) . '</div>';
					}

					if ( 'Shortcode' === $plc_select && ! empty( $item['plcsCustomShortCode'] ) ) {
						$preloader_src .= '<div class="tp-preloader-custom-shortcode">' . do_shortcode( shortcode_unautop( $item['plcsCustomShortCode'] ) ) . '</div>';
					}

					if ( 'Progress' === $plc_select && ( ! empty( $plc_precentage_layout ) && 'plcper1' === $plc_precentage_layout ) ) {
						$preloader_src .= '<div class="tp-preloader-wrap"><div class="tp-percentage" id="tp-precent"></div><div class="tp-loader"><div class="p-trackbar"><div class="tp-loadbar"></div></div><div class="tp-glow"></div></div></div>';
					} elseif ( 'Progress' === $plc_select && ( ! empty( $plc_precentage_layout ) && 'plcper3' === $plc_precentage_layout ) ) {
						$percpre  = '';
						$percpost = '';

						if ( ! empty( $item['plcper3prefix'] ) ) {
							$percpre = '<span class="tp-perc-prepostfix tp-perc-pre">' . esc_html( $item['plcper3prefix'] ) . '</span>';
						}

						if ( ! empty( $item['plcper3postfix'] ) ) {
							$percpost = '<span class="tp-perc-prepostfix tp-perc-post">' . esc_html( $item['plcper3postfix'] ) . '</span>';
						}

						$preloader_src .= '<div class="tp-preloader-wrap ' . esc_attr( $plc_precentage_layout ) . '">' . $percpre . '<div class="tp-percentage" id="tp-precent3"></div>' . $percpost . '</div>';
					} elseif ( 'Progress' === $plc_select && ( ! empty( $plc_precentage_layout ) && 'plcper4' === $plc_precentage_layout ) ) {
						$preloader_src .= '<div class="tp-preloader-wrap4 ' . esc_attr( $plc_precentage_layout ) . '"><div class="tp-preloader-wrap4-in" id="tp-precent4"></div></div>';
					} elseif ( 'Progress' === $plc_select && ( ! empty( $plc_precentage_layout ) && 'plcper6' === $plc_precentage_layout ) ) {
						$pctextfillcolor  = ! empty( $settings['pctextfillcolor'] ) ? $settings['pctextfillcolor'] : '#fff';
						$pctextemptycolor = ! empty( $settings['pctextemptycolor'] ) ? $settings['pctextemptycolor'] : '#ffffff36';
						$pctextstrocksize = ! empty( $settings['pctextstrocksize'] ) ? $settings['pctextstrocksize']['size'] : 4;

						$preloader_src .= '<div class="tp-preloader-wrap6 ' . esc_attr( $plc_precentage_layout ) . '"><svg class="progress-ring" width="120" height="120"><circle id="tp-precent6" class="progress-ring__circle progress-ring1" style="stroke-dasharray: 326.726, 326.726;stroke-dashoffset: 326.726;" stroke="' . esc_attr( $pctextfillcolor ) . '" stroke-width="' . esc_attr( $pctextstrocksize ) . '" fill="transparent" r="52" cx="60" cy="60"/></svg><svg class="progress-ring progress-ring2" width="120" height="120"><circle class="progress-ring__circle" style="stroke-dasharray: 326.726, 326.726;stroke-dashoffset:0;" stroke="' . esc_attr( $pctextemptycolor ) . '" stroke-width="' . esc_attr( $pctextstrocksize ) . '" fill="transparent" r="52" cx="60" cy="60"/></svg><div class="tp-percentage" id="tp-precent3"></div></div>';
					}
				}

				++$index;
			}

				/** Predefine Style*/
				$get_ele_pre = '.elementor-element' . $this->get_unique_selector();
				$pd_color_1  = ! empty( $settings['pr_predefined_color1'] ) ? $settings['pr_predefined_color1'] : '#000';
				$pd_color_2  = ! empty( $settings['pr_predefined_color2'] ) ? $settings['pr_predefined_color2'] : '';

				$preloader_src .= '<style>' . $get_ele_pre . ' .tp-preloader-help:after,' . $get_ele_pre . ' .tp-preloader-cord .tp-ball,' . $get_ele_pre . ' .tp-preloader-dots:before,' . $get_ele_pre . ' .tp_preloader_the_shake span{
						background:' . $pd_color_1 . ';
					}
					' . $get_ele_pre . ' .tp-ball-triangle-path>div,' . $get_ele_pre . '  .tp-ball-scale-ripple-multiple>div,' . $get_ele_pre . ' .tp-preloader-help{
						border-color:' . $pd_color_1 . ';
					}
					' . $get_ele_pre . ' .tp-triangle-skew-spin>div{
						border-bottom-color:' . $pd_color_1 . ';
					}
					' . $get_ele_pre . ' .tp_dot_1,.tp-preloader-dot .tp-preloader-dots:after{
						background:' . $pd_color_2 . ';
					}
					' . $get_ele_pre . ' .tp_preloader_spinning_disc:after{
						border-top:10px solid ' . $pd_color_2 . ';
						border-bottom:10px solid ' . $pd_color_2 . ';
					}
					@-webkit-keyframes tp_typing_loader {
						0% {
							background-color: ' . $pd_color_1 . ';
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '33
						}

						25% {
							background-color: ' . $pd_color_1 . '66;
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '33
						}

						75% {
							background-color: ' . $pd_color_1 . '66;
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '
						}
					}

					@-moz-keyframes tp_typing_loader {
						0% {
							background-color: ' . $pd_color_1 . ';
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '33
						}

						25% {
							background-color: ' . $pd_color_1 . '66;
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '33
						}

						75% {
							background-color: ' . $pd_color_1 . '66;
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '
						}
					}

					@keyframes tp_typing_loader {
						0% {
							background-color: ' . $pd_color_1 . ';
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '33
						}

						25% {
							background-color: ' . $pd_color_1 . '66;
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '33
						}

						75% {
							background-color: ' . $pd_color_1 . '66;
							box-shadow: 12px 0 0 0 ' . $pd_color_1 . '33,24px 0 0 0 ' . $pd_color_1 . '
						}
					}

					@-webkit-keyframes tp_preloader_1 {
						0% {height:5px;-webkit-transform:translateY(0px);-ms-transform:translateY(0px);-moz-transform:translateY(0px);-o-transform: translateY(0px); transform:translateY(0px);background:' . $pd_color_1 . ';}
						25% {height:30px;-webkit-transform:translateY(15px);-ms-transform:translateY(15px);-moz-transform:translateY(15px);-o-transform: translateY(15px); transform:translateY(15px);background:' . $pd_color_2 . ';}
						50% {height:5px;-webkit-transform:translateY(0px);-ms-transform:translateY(0px);-moz-transform:translateY(0px);-o-transform: translateY(0px); transform:translateY(0px);background:' . $pd_color_1 . ';}
						100% {height:5px;-webkit-transform:translateY(0px);-ms-transform:translateY(0px);-moz-transform:translateY(0px);-o-transform: translateY(0px); transform:translateY(0px);background:' . $pd_color_1 . ';}
					}

					@-moz-keyframes tp_preloader_1 {
						0% {height:5px;-moz-transform:translateY(0px);background:' . $pd_color_1 . ';}
						25% {height:30px;-moz-transform:translateY(15px);background:' . $pd_color_2 . ';}
						50% {height:5px;-moz-transform:translateY(0px);background:' . $pd_color_1 . ';}
						100% {height:5px;-moz-transform:translateY(0px);background:' . $pd_color_1 . ';}
					}

					@keyframes tp_preloader_1 {
						0% {height:5px;transform:translateY(0px);background:' . $pd_color_1 . ';}
						25% {height:30px;transform:translateY(15px);background:' . $pd_color_2 . ';}
						50% {height:5px;transform:translateY(0px);background:' . $pd_color_1 . ';}
						100% {height:5px;transform:translateY(0px);background:' . $pd_color_1 . ';}
					}

					.tp_preloader_circular_square span,.tp-preloader-12,.tp_preloader_spinning_disc{	
						background:' . $pd_color_1 . ';
					}

					@-webkit-keyframes tp_preloader_5 {
						0% {-webkit-transform: rotate(0deg);}
						50% {-webkit-transform: rotate(180deg);background:' . $pd_color_2 . ';}
						100% {-webkit-transform: rotate(360deg);}
					}

					@-webkit-keyframes tp_preloader_5_after {
						0% {border-top:10px solid ' . $pd_color_2 . ';border-bottom:10px solid ' . $pd_color_2 . ';}
						50% {border-top:10px solid ' . $pd_color_1 . ';border-bottom:10px solid ' . $pd_color_1 . ';}
						100% {border-top:10px solid ' . $pd_color_2 . ';border-bottom:10px solid ' . $pd_color_2 . ';}
					}

					@-moz-keyframes tp_preloader_5 {
						0% {-moz-transform: rotate(0deg);}
						50% {-moz-transform: rotate(180deg);background:' . $pd_color_2 . ';}
						100% {-moz-transform: rotate(360deg);}
					}

					@-moz-keyframes tp_preloader_5_after {
						0% {border-top:10px solid ' . $pd_color_2 . ';border-bottom:10px solid ' . $pd_color_2 . ';}
						50% {border-top:10px solid ' . $pd_color_1 . ';border-bottom:10px solid ' . $pd_color_1 . ';}
						100% {border-top:10px solid ' . $pd_color_2 . ';border-bottom:10px solid ' . $pd_color_2 . ';}
					}

					@keyframes tp_preloader_5 {
						0% {transform: rotate(0deg);}
						50% {transform: rotate(180deg);background:' . $pd_color_2 . ';}
						100% {transform: rotate(360deg);}
					}

					@keyframes tp_preloader_5_after {
						0% {border-top:10px solid ' . $pd_color_2 . ';border-bottom:10px solid ' . $pd_color_2 . ';}
						50% {border-top:10px solid ' . $pd_color_1 . ';border-bottom:10px solid ' . $pd_color_1 . ';}
						100% {border-top:10px solid ' . $pd_color_2 . ';border-bottom:10px solid ' . $pd_color_2 . ';}
					}

					@-webkit-keyframes tp_preloader_4 {
						0% {opacity: 0.3; -webkit-transform:translateY(0px); -webkit-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1);  box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
						50% {opacity: 1; -webkit-transform: translateY(-10px); background:' . $pd_color_2 . '; -webkit-box-shadow:0px 20px 3px rgba(0, 0, 0, 0.05); box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
						100%  {opacity: 0.3; -webkit-transform:translateY(0px);	-webkit-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
					}

					@-moz-keyframes tp_preloader_4 {
						0% {opacity: 0.3; -moz-transform:translateY(0px); -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
						50% {opacity: 1; -moz-transform: translateY(-10px); background:' . $pd_color_2 . ';	-moz-box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
						100%  {opacity: 0.3; -moz-transform:translateY(0px);-moz-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1);	box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
					}

					@-ms-keyframes tp_preloader_4 {
						0% {opacity: 0.3; -ms-transform:translateY(0px); -webkit-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
						50% {opacity: 1; -ms-transform: translateY(-10px); background:' . $pd_color_2 . '; -webkit-box-shadow:0px 20px 3px rgba(0, 0, 0, 0.05); -moz-box-shadow:0px 20px 3px rgba(0, 0, 0, 0.05);box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
						100%  {opacity: 0.3; -ms-transform:translateY(0px);	-webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);-moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
					}

					@keyframes tp_preloader_4 {
						0% {opacity: 0.3; transform:translateY(0px);-webkit-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1);-moz-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
						50% {opacity: 1; transform: translateY(-10px); background:' . $pd_color_2 . '; -webkit-box-shadow:0px 20px 3px rgba(0, 0, 0, 0.05); -moz-box-shadow:0px 20px 3px rgba(0, 0, 0, 0.05);box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
						100%  {opacity: 0.3; transform:translateY(0px);	-webkit-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1);-moz-box-shadow:0px 0px 3px rgba(0, 0, 0, 0.1); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
					}
				</style>';

			$preloader_src .= '</div>';

			if ( 'pageloadtripleswoosh' === $page_load_transition ) {
				$preloader_src .= '<div class="tp-preload-reveal-layer-box"><div style="background:' . $settings['tp4color1'] . '" class="tp-preload-reveal-layer"></div><div style="background:' . $settings['tp4color2'] . '" class="tp-preload-reveal-layer"></div><div style="background:' . $settings['tp4color3'] . '" class="tp-preload-reveal-layer"></div></div>';
			} elseif ( 'pageloadsimple' === $page_load_transition ) {
				$preloader_src .= '<div class="tp-preload-reveal-layer-box"><div style="background:' . $settings['tp4color1'] . '" class="tp-preload-reveal-layer"></div></div>';
			} elseif ( 'pageloadduomove' === $page_load_transition ) {
				$preloader_src .= '<div class="tp-preload-reveal-layer-box"><div style="background:' . $settings['tp4color1'] . '" class="tp-preload-reveal-layer"></div><div style="background:' . $settings['tp4color2'] . '" class="tp-preload-reveal-layer"></div></div>';
			}

			$preloader_src .= '</div>';

			$alf_switch = ! empty( $settings['alfSwitch'] ) ? $settings['alfSwitch'] : '';
			if ( 'yes' === $alf_switch && 'alfcustom' === $alf_exclude && ! empty( $settings['alfExcludecustom'] ) && ! empty( $settings['alfExcludeZIndex']['size'] ) && ! empty( $settings['alfExcludeZIndexpos'] ) ) {

				$topbottom = '';
				if ( 'top' === $settings['alfExcludeZIndexpos'] ) {
					$topbottom = 'top:0';
				} elseif ( 'bottom' === $settings['alfExcludeZIndexpos'] ) {
					$topbottom = 'bottom:0';
				}

				$preloader_src .= '<style>body:not(.tp-loaded):not(.tp-out-loaded) ' . esc_attr( $settings['alfExcludecustom'] ) . '{z-index : ' . esc_attr( $settings['alfExcludeZIndex']['size'] ) . ';width:100%;position:fixed;' . esc_attr( $topbottom ) . '}</style>';
			} elseif ( 'yes' === $alf_switch && 'alfheader' === $alf_exclude && ! empty( $settings['alfExcludeZIndex']['size'] ) ) {
				$preloader_src .= '<style>body:not(.tp-loaded):not(.tp-out-loaded) header{z-index : ' . esc_attr( $settings['alfExcludeZIndex']['size'] ) . ' !important;width:100% !important;position:fixed !important;}</style>';
			}

			echo $preloader_src;
		}
	}

	/**
	 * Render content_template.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}

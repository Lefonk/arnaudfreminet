<?php
/**
 * Widget Name: Scroll Sequence
 * Description: Image Scroll Sequence
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Scroll_Sequence
 */
class ThePlus_Scroll_Sequence extends Widget_Base {

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
	 */
	public function get_name() {
		return 'tp-scroll-sequence';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Scroll Sequence', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-scroll-sequence theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return array( 'Scroll Sequence', 'Image Sequence', 'Video Scroll Sequence', 'Image Scroll Sequence', 'Cinematic Scroll Sequence', 'Cinematic Scroll Animation', 'Image Scroll Animation' );
	}

	/**
	 * Get doc URLs.
	 *
	 * @since 1.0.0
	 * 
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Check Elementor preview mode.
	 *
	 * @since 1.0.0
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.3.4
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'scroll_sequence_tab_content',
			array(
				'label' => esc_html__( 'Scroll Sequence', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'applyTo',
			array(
				'label'   => esc_html__( 'Apply To', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'        => esc_html__( 'Default', 'theplus' ),
					'body'           => esc_html__( 'Body', 'theplus' ),
					'innerContainer' => esc_html__( 'Inner Column', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'applbodyNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => wp_kses_post( "Note : To make content visible, You need to set z-index value to 1 from Style tab of this widget. <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-image-sequence-on-page-body-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'applyTo' => 'body',
				),
			)
		);
		$this->add_control(
			'imageUpldType',
			array(
				'label'   => esc_html__( 'Upload Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'gallery',
				'options' => array(
					'gallery' => esc_html__( 'Gallery', 'theplus' ),
					'server'  => esc_html__( 'Remote Server', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'imgUpldNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note : Only Image files are accepted here.', 'theplus' ),
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'imageGallery',
			array(
				'label'     => esc_html__( 'Image Upload', 'theplus' ),
				'type'      => Controls_Manager::GALLERY,
				'default'   => array(),
				'condition' => array(
					'imageUpldType' => 'gallery',
				),
			)
		);
		$this->add_control(
			'imagePath',
			array(
				'label'       => wp_kses_post( "Folder Path <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-image-sequence-scroll-animation-from-a-url/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->add_control(
			'imagePathNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Include full folder path. Add digits in increment mode at the end of each image to load all in sequence. <br> e.g. https://xyz.com/uploads/image(001).jpg and so on.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'imageUpldType' => 'server',
				),
			)
		);

		$this->add_control(
			'imagePrefix',
			array(
				'label'       => esc_html__( 'Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your prefix', 'theplus' ),
				'condition'   => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->add_control(
			'prefixtxtNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Enter the name of image your have used above without digits. e.g. image.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->add_control(
			'imageDigit',
			array(
				'label'     => esc_html__( 'Digit', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1-9', 'theplus' ),
					'2' => esc_html__( '01-99', 'theplus' ),
					'3' => esc_html__( '001-999', 'theplus' ),
					'4' => esc_html__( '0001-9999', 'theplus' ),
				),
				'condition' => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->add_control(
			'imageDigitNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Choose right number of digits based on your total number of images. e.g. If you are having 39 images, choose 01-99.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->add_control(
			'imageType',
			array(
				'label'     => esc_html__( 'Image Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'jpg',
				'options'   => array(
					'jpg'  => esc_html__( 'JPG', 'theplus' ),
					'png'  => esc_html__( 'PNG', 'theplus' ),
					'webp' => esc_html__( 'WebP', 'theplus' ),
				),
				'condition' => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->add_control(
			'totalImage',
			array(
				'label'     => esc_html__( 'Total Image', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 5000,
				'step'      => 1,
				'default'   => 20,
				'condition' => array(
					'imageUpldType' => 'server',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_Opt_section',
			array(
				'label' => esc_html__( 'Extra Option', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'preloadImg',
			array(
				'label'   => wp_kses_post( "Preload Image (%) <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "scroll-sequence-elementor-widget-settings-overview/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 20,
			)
		);
		$this->add_control(
			'stickySec',
			array(
				'label'     => wp_kses_post( "Sticky Sections <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-sticky-sections-in-image-scroll-sequence/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'sectionId',
			array(
				'label' => esc_html__( 'Section ID', 'theplus' ),
				'type'  => Controls_Manager::TEXT,
				'title' => 'Add Section Id to make content sticky',
			)
		);
		$repeater->add_control(
			'secStart',
			array(
				'label' => esc_html__( 'Start', 'theplus' ),
				'type'  => Controls_Manager::NUMBER,
				'title' => 'Enter image number where element becomes visible',
			)
		);
		$repeater->add_control(
			'secEnd',
			array(
				'label' => esc_html__( 'End', 'theplus' ),
				'type'  => Controls_Manager::NUMBER,
				'title' => 'Enter image number where element becomes Hidden',
			)
		);
		$repeater->add_control(
			'offsetop',
			array(
				'label'      => esc_html__( 'Top (%)', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '5',
				),
			)
		);
		$repeater->add_control(
			'secAnimationstart',
			array(
				'label'   => esc_html__( 'Start Animation', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'none'           => esc_html__( 'None', 'theplus' ),
					'tp-fadein'      => esc_html__( 'Fade In', 'theplus' ),
					'tp-fadeinup'    => esc_html__( 'Fade In Up', 'theplus' ),
					'tp-fadeindown'  => esc_html__( 'Fade In Down', 'theplus' ),
					'tp-fadeinleft'  => esc_html__( 'Fade In Left', 'theplus' ),
					'tp-fadeinright' => esc_html__( 'Fade In Right', 'theplus' ),
					'tp-rotatein'    => esc_html__( 'Rotate In', 'theplus' ),
				),
				'default' => 'none',
			)
		);
		$repeater->add_control(
			'secAnimationend',
			array(
				'label'   => esc_html__( 'End Animation', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'none'            => esc_html__( 'None', 'theplus' ),
					'tp-fadeout'      => esc_html__( 'Fade Out', 'theplus' ),
					'tp-fadeoutup'    => esc_html__( 'Fade Out Up', 'theplus' ),
					'tp-fadeoutdown'  => esc_html__( 'Fade Out Down', 'theplus' ),
					'tp-fadeoutleft'  => esc_html__( 'Fade Out Left', 'theplus' ),
					'tp-fadeoutright' => esc_html__( 'Fade Out Right', 'theplus' ),
					'tp-rotateout'    => esc_html__( 'Rotate Out', 'theplus' ),
				),
				'default' => 'none',
			)
		);
		$this->add_control(
			'seclist',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => array(
					'stickySec' => 'yes',
				),
				'default'     => array(
					array(
						'secAnimationstart' => esc_html__( 'none', 'theplus' ),
						'secAnimationend'   => esc_html__( 'none', 'theplus' ),
					),
				),
				'title_field' => '{{{ sectionId }}}',
			)
		);
		$this->end_controls_section();

		/**Scroll Sequence Style Start*/
		$this->start_controls_section(
			'scroll_seq_section_style',
			array(
				'label' => esc_html__( 'Scroll Sequence', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'canVidPosition',
			array(
				'label'        => __( 'Position', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->start_popover();
		$this->add_responsive_control(
			'posTop',
			array(
				'label'       => esc_html__( 'Top (%)', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
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
					'.tp-scroll-seq-inner.elementor-element-{{ID}}-canvas' => 'top: {{SIZE}}% !important;',
				),
				'condition'   => array(
					'canVidPosition' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'posLeft',
			array(
				'label'       => esc_html__( 'Left (%)', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
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
					'.tp-scroll-seq-inner.elementor-element-{{ID}}-canvas' => 'left: {{SIZE}}% !important;',
				),
				'condition'   => array(
					'canVidPosition' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->add_control(
			'canVidZIndex',
			array(
				'label'     => esc_html__( 'Z-Index', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -10,
				'max'       => 10,
				'step'      => 1,
				'default'   => 0,
				'selectors' => array(
					'.tp-scroll-seq-inner.elementor-element-{{ID}}-canvas' => 'z-index: {{VALUE}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'canVidWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),

				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.tp-scroll-seq-inner.elementor-element-{{ID}}-canvas' => 'width: {{SIZE}}{{UNIT}} !important;',

				),
			)
		);
		$this->add_responsive_control(
			'canVidHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),

				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.tp-scroll-seq-inner.elementor-element-{{ID}}-canvas' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'canStartOffset',
			array(
				'label'       => esc_html__( 'Start Offset (px)', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
			)
		);
		$this->add_responsive_control(
			'canEndOffset',
			array(
				'label'       => esc_html__( 'End Offset (px)', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
			)
		);
		$this->end_controls_section();
		/**Scroll Sequence Style End*/

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Progress Bar
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.3.4
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$uid_scroll = uniqid( 'tp-scs' );

		$image_upld_type = ! empty( $settings['imageUpldType'] ) ? $settings['imageUpldType'] : 'gallery';

		$image_gallery = ! empty( $settings['imageGallery'] ) ? $settings['imageGallery'] : array();
		$image_path    = ! empty( $settings['imagePath']['url'] ) ? $settings['imagePath']['url'] : '';
		$image_prefix  = ! empty( $settings['imagePrefix'] ) ? $settings['imagePrefix'] : '';
		$image_digit   = ! empty( $settings['imageDigit'] ) ? (int) $settings['imageDigit'] : '1';
		$image_type    = ! empty( $settings['imageType'] ) ? $settings['imageType'] : 'jpg';
		$total_image   = ! empty( $settings['totalImage'] ) ? $settings['totalImage'] : 20;
		$apply_to      = ! empty( $settings['applyTo'] ) ? $settings['applyTo'] : 'default';
		$preload_img   = ! empty( $settings['preloadImg'] ) ? $settings['preloadImg'] : 20;

		$can_start_offset = ! empty( $settings['canStartOffset']['size'] ) ? $settings['canStartOffset']['size'] : 0;
		$can_end_offset   = isset( $settings['canEndOffset']['size'] ) ? $settings['canEndOffset']['size'] : 0;

		$sticky_sec = ! empty( $settings['stickySec'] ) ? $settings['stickySec'] : 0;
		$seclist    = ! empty( $settings['seclist'] ) ? $settings['seclist'] : '';

		$data_attr = array();
		$img_glr   = array();

		if ( 'gallery' === $image_upld_type && ! empty( $image_gallery ) ) {
			$img_glr = array_column( $image_gallery, 'url' );
		} elseif ( 'server' === $image_upld_type ) {

			if ( is_numeric( $image_digit ) && ! empty( $image_path ) && ! empty( $total_image ) && in_array( $image_type, array( 'jpg', 'png', 'webp' ) ) ) {
				for ( $i = 1; $i <= $total_image; $i++ ) {
					$immm    = str_pad( $i, $image_digit, '0', STR_PAD_LEFT );
					$img_url = $image_path . '/' . $image_prefix . $immm . '.' . $image_type;

					$u_r_lexists = wp_remote_get( $img_url );
					if ( ! empty( $u_r_lexists ) ) {
						$img_glr[] = $img_url;
					}
				}
			}
		}

		$massage = '';
		$icon    = '';
		if ( ! empty( $img_glr ) ) {
			$data_attr = array(
				'widget_id'   => $this->get_id(),
				'imgGellary'  => $img_glr,
				'applyto'     => esc_attr( $apply_to ),
				'imgUpdType'  => esc_attr( $image_upld_type ),
				'preloadImg'  => esc_attr( $preload_img ),
				'startOffset' => esc_attr( $can_start_offset ),
				'endOffset'   => esc_attr( $can_end_offset ),
				'stickySec'   => esc_attr( $sticky_sec ),
				'seclist'     => $seclist,
			);
		} else {
			$error_title   = 'No Image Selected!';
			$error_massage = 'Please Select Image To Get The Desired Result';

			$massage = theplus_get_widgetError( $error_title, $error_massage );
		}

		$data_attr = 'data-attr="' . htmlspecialchars( wp_json_encode( $data_attr, true ), ENT_QUOTES, 'UTF-8' ) . '"';

		$output = '';

		$output     .= '<div class="tp-scroll-sequence tp-widget-' . esc_attr( $uid_scroll ) . '" ' . $data_attr . '>';
			$output .= $massage;
		$output     .= '</div>';

		echo $output;
	}
}

<?php
/**
 * Widget Name: Smooth Scroll
 * Description: smooth page scroll.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Mouse_Cursor
 */
class ThePlus_Smooth_Scroll extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-smooth-scroll';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Smooth Scroll', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-hourglass-start theplus_backend_icon';
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
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Smooth Scroll', 'Scroll Widget', 'Elementor Scroll', 'Scroll Animation', 'Smooth Scrolling', 'Scroll Effect', 'Elementor Smooth Scroll', 'Scroll Widget for Elementor', 'Scroll Animation for Elementor', 'Smooth Scrolling for Elementor', 'Elementor Scroll Effect' );
	}

	/**
	 * Register controls.
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Scrolling Core', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'frameRate',
			array(
				'label'      => esc_html__( 'Frame Rate', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'Hz' ),
				'range'      => array(
					'Hz' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'Hz',
					'size' => 150,
				),
			)
		);
		$this->add_control(
			'animationTime',
			array(
				'label'      => esc_html__( 'Animation Time', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'ms' ),
				'range'      => array(
					'ms' => array(
						'min'  => 300,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'    => array(
					'unit' => 'ms',
					'size' => 1000,
				),
			)
		);
		$this->add_control(
			'stepSize',
			array(
				'label'      => esc_html__( 'Step Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_pulse_section',
			array(
				'label' => esc_html__( 'Pulse ratio of "Tail" to "Acceleration" ', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'pulseAlgorithm',
			array(
				'label'        => esc_html__( 'Plus Algorithm', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'pulseScale',
			array(
				'label'      => esc_html__( 'Pulse Scale', 'theplus' ),
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
					'size' => 4,
				),
			)
		);
		$this->add_control(
			'pulseNormalize',
			array(
				'label'      => esc_html__( 'Pulse Normalize', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_acceleration_section',
			array(
				'label' => esc_html__( 'Acceleration', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'accelerationDelta',
			array(
				'label'      => esc_html__( 'Acceleration Delta', 'theplus' ),
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
					'size' => 50,
				),
			)
		);
		$this->add_control(
			'accelerationMax',
			array(
				'label'      => esc_html__( 'Acceleration Max', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 3,
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_keyboard_settings_section',
			array(
				'label' => esc_html__( 'Keyboard Settings', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'keyboardSupport',
			array(
				'label'        => esc_html__( 'Keyboard Support', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'arrowScroll',
			array(
				'label'      => esc_html__( 'Arrow Scroll', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_other_section',
			array(
				'label' => esc_html__( 'Other Settings', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'touchpadSupport',
			array(
				'label'        => esc_html__( 'Touch pad Support', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'fixedBackground',
			array(
				'label'        => esc_html__( 'Fixed Support', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'browsers',
			array(
				'label'    => __( 'Allowed Browsers', 'theplus' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => array(
					'mobile'  => __( 'Mobile Browsers', 'theplus' ),
					'ieWin7'  => __( 'IeWin7', 'theplus' ),
					'edge'    => __( 'Edge', 'theplus' ),
					'chrome'  => __( 'Chrome', 'theplus' ),
					'safari'  => __( 'Safari', 'theplus' ),
					'firefox' => __( 'Firefox', 'theplus' ),
					'other'   => __( 'Other', 'theplus' ),
				),
				'default'  => array(),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_responsive_section',
			array(
				'label' => esc_html__( 'Responsive', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'tablet_off_scroll',
			array(
				'label'     => esc_html__( 'Tablet/Mobile Smooth Scroll', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Off', 'theplus' ),
				'label_off' => esc_html__( 'On', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render Flip box
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$frame_rate      = $settings['frameRate']['size'];
		$animation_time  = $settings['animationTime']['size'];
		$step_size       = $settings['stepSize']['size'];
		$pulse_algorithm = 'yes' === $settings['pulseAlgorithm'] ? '1' : '0';
		$pulse_scale     = $settings['pulseScale']['size'];
		$pulse_normalize = $settings['pulseNormalize']['size'];

		$acceleration_delta = $settings['accelerationDelta']['size'];

		$acceleration_max = $settings['accelerationMax']['size'];
		$keyboard_support = 'yes' === $settings['keyboardSupport'] ? '1' : '0';
		$arrow_scroll     = $settings['arrowScroll']['size'];
		$touchpad_support = 'yes' === $settings['touchpadSupport'] ? '1' : '0';
		$fixed_background = 'yes' === $settings['fixedBackground'] ? '1' : '0';

		$browsers = ! empty( $settings['browsers'] ) ? $settings['browsers'] : array( 'ieWin7', 'chrome', 'firefox', 'safari' );
		$browsers = wp_json_encode( $browsers );

		$smoothscroll_array = array(
			'Browsers' => ! empty( $settings['browsers'] ) ? $settings['browsers'] : array( 'ieWin7', 'chrome', 'firefox', 'safari' ),
		);

		$smoothscroll_data = htmlspecialchars( wp_json_encode( $smoothscroll_array ), ENT_QUOTES, 'UTF-8' );

		if ( ! empty( $settings['tablet_off_scroll'] ) && 'yes' === $settings['tablet_off_scroll'] ) {
			$tablet_off = ' data-tablet-off="yes"';
		} else {
			$tablet_off = ' data-tablet-off="no"';
		}

		echo '<div class="plus-smooth-scroll" data-frameRate="' . esc_attr( $frame_rate ) . '" data-animationTime="' . esc_attr( $animation_time ) . '" data-stepSize="' . esc_attr( $step_size ) . '" data-pulseAlgorithm="' . esc_attr( $pulse_algorithm ) . '" data-pulseScale="' . esc_attr( $pulse_scale ) . '" data-pulseNormalize="' . esc_attr( $pulse_normalize ) . '" data-accelerationDelta="' . esc_attr( $acceleration_delta ) . '" data-accelerationMax="' . esc_attr( $acceleration_max ) . '" data-keyboardSupport="' . esc_attr( $keyboard_support ) . '" data-arrowScroll="' . esc_attr( $arrow_scroll ) . '" data-touchpadSupport="' . esc_attr( $touchpad_support ) . '" data-fixedBackground="' . esc_attr( $fixed_background ) . '" ' . $tablet_off . ' data-basicdata= "' . esc_attr( $smoothscroll_data ) . '" >';

		echo '<script>var smoothAllowedBrowsers = ' . $browsers . '</script>';

		echo '</div>';
	}

	/**
	 * Render content_template
	 *
	 * @since 3.3.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}

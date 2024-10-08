<?php
/**
 * Widget Name: Meeting Scheduler
 * Description: Meeting Scheduler
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Meeting_Scheduler.
 */
class ThePlus_Meeting_Scheduler extends Widget_Base {

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
	 * @since 4.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-meeting-scheduler';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Meeting Scheduler', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-calendar theplus_backend_icon';
	}

	/**
	 * Get Widget Categories.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-adapted' );
	}

	/**
	 * Get Widget Keywords.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Meeting Scheduler', 'Schedule Meeting', 'Meeting Planner', 'Meeting Organizer', 'Meeting Arranger', 'Meeting Time Manager', 'Meeting Coordinator', 'Meeting Scheduling Tool', 'Meeting Booking', 'Meeting Calendar' );
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
	 * Register controls.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Meeting Scheduler', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'scheduler_select',
			array(
				'label'   => wp_kses_post( "Select <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "meeting-scheduler-widget-settings-overview/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'calendly',
				'options' => array(
					'calendly'    => esc_html__( 'Calendly', 'theplus' ),
					'freebusy'    => esc_html__( 'Freebusy', 'theplus' ),
					'meetingbird' => esc_html__( 'Meetingbird', 'theplus' ),
					'vyte'        => esc_html__( 'Vyte', 'theplus' ),
					'xai'         => esc_html__( 'X Ai', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'calendly_username',
			array(
				'label'       => wp_kses_post( "User Name <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "embed-calendly-meeting-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter User Name', 'theplus' ),
				'description' => 'How to get Username from Calendly?  <a href="https://help.calendly.com/hc/en-us" class="theplus-btn" target="_blank">Get Steps!</a>',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_time',
			array(
				'label'     => esc_html__( 'Time', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '15min',
				'options'   => array(
					'15min' => esc_html__( '15 Minutes', 'theplus' ),
					'30min' => esc_html__( '30 Minutes', 'theplus' ),
					'60min' => esc_html__( '60 Minutes', 'theplus' ),
					''      => esc_html__( 'All', 'theplus' ),
				),
				'condition' => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_event',
			array(
				'label'     => esc_html__( 'Display Event Type', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'scheduler_select' => 'calendly',
					'calendly_time!'   => '',
				),
			)
		);
		$this->add_control(
			'calendly_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 650,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'calendly',
				),
				'selectors'   => array(
					'{{WRAPPER}} .calendly-inline-widget,{{WRAPPER}} .calendly-wrapper' => 'height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'freebusy_url',
			array(
				'label'       => wp_kses_post( "URL <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "embed-freebusy-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter URL', 'theplus' ),
				'description' => 'How to get Freebusy URL?  <a href="https://help.freebusy.io/en/articles/3313368-how-to-share-your-availability-by-generating-a-link-though-your-freebusy-account" class="theplus-btn" target="_blank">Get Steps!</a>',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_scroll',
			array(
				'label'     => esc_html__( 'Scroll Bar', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'meetingbird_url',
			array(
				'label'       => esc_html__( 'URL', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter URL', 'theplus' ),
				'description' => 'How to get Meeting Bird URL?  <a href="https://help.meetingbird.com/en/collections/168865-getting-started" class="theplus-btn" target="_blank">Get Steps!</a>',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'meetingbird',
				),
			)
		);
		$this->add_control(
			'meetingbird_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min. Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'meetingbird',
				),
			)
		);
		$this->add_control(
			'vyte_url',
			array(
				'label'       => wp_kses_post( "URL <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "embed-vyte-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter URL', 'theplus' ),
				'description' => 'If you need help getting details. <a href="https://support.vyte.in/en/" class="theplus-btn" target="_blank">Helpdesk!</a>',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'vyte_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'vyte_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'xai_username',
			array(
				'label'       => esc_html__( 'User Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter User Name', 'theplus' ),
				'description' => 'If you need help getting details. <a href="https://help.x.ai/en/" class="theplus-btn" target="_blank">Helpdesk!</a>',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'xai',
				),
			)
		);
		$this->add_control(
			'xai_pagename',
			array(
				'label'       => esc_html__( 'Page Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Page Name', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'xai',
				),
			)
		);
		$this->end_controls_section();
		/*style start*/
		$this->start_controls_section(
			'calendly_style',
			array(
				'label'     => esc_html__( 'Calendly Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_text_color',
			array(
				'label' => esc_html__( 'Text', 'theplus' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'calendly_primary_color',
			array(
				'label' => esc_html__( 'Link', 'theplus' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'calendly_background_color',
			array(
				'label' => esc_html__( 'Background', 'theplus' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->end_controls_section();
		/*style end*/

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Meeting Scheduler.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$output   = '';

		$xai_output  = '';
		$time_output = '';

		$calendly_event   = '';
		$scheduler_select = ! empty( $settings['scheduler_select'] ) ? $settings['scheduler_select'] : 'calendly';

		if ( 'calendly' === $scheduler_select ) {
			if ( ! empty( $settings['calendly_username'] ) ) {

				$time = $settings['calendly_time'];
				if ( empty( $time ) ) {
					$time_output .= '';
				} else {
					$time_output .= '/' . $time . '/';
				}

				$calendly_text_color    = ! empty( $settings['calendly_text_color'] ) ? '&text_color=' . str_replace( '#', '', $settings['calendly_text_color'] ) : '';
				$calendly_primary_color = ! empty( $settings['calendly_primary_color'] ) ? '&primary_color=' . str_replace( '#', '', $settings['calendly_primary_color'] ) : '';

				$calendly_background_color = ! empty( $settings['calendly_background_color'] ) ? '&background_color=' . str_replace( '#', '', $settings['calendly_background_color'] ) : '';

				if ( ! empty( $settings['calendly_event'] ) && 'yes' === $settings['calendly_event'] ) {
					$calendly_event = '';
				} else {
					$calendly_event = 'hide_event_type_details=1';
				}

				$output .= '<div class="calendly-inline-widget" data-url="https://calendly.com/' . esc_attr( $settings['calendly_username'] ) . esc_attr( $time_output ) . '?' . esc_attr( $calendly_event ) . esc_attr( $calendly_text_color ) . esc_attr( $calendly_primary_color ) . esc_attr( $calendly_background_color ) . '"></div>';

				$output .= ' <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>';
				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					$output .= '<div class="calendly-wrapper" style="width:100%; position:absolute; top:0; left:0; z-index:100;"></div>';
				}
			}
		} elseif ( 'freebusy' === $scheduler_select ) {
			$freebusy_scroll = ! empty( $settings['freebusy_scroll'] ) ? $settings['freebusy_scroll'] : 'no';

			if ( ! empty( $settings['freebusy_url'] ) ) {
				$output .= '<iframe src="' . esc_url( $settings['freebusy_url'] ) . '" width="' . esc_attr( $settings['freebusy_width']['size'] ) . '" height="' . esc_attr( $settings['freebusy_height']['size'] ) . '" frameborder="0" scrolling="' . esc_attr( $freebusy_scroll ) . '"></iframe>';
			}
		} elseif ( 'meetingbird' === $scheduler_select ) {
			if ( ! empty( $settings['meetingbird_url'] ) ) {
				$output .= '<iframe src="' . esc_url( $settings['meetingbird_url'] ) . '" style="width: 100%; border: none; min-height: ' . esc_attr( $settings['meetingbird_height']['size'] ) . 'px;"></iframe>';
			}
		} elseif ( 'vyte' === $scheduler_select ) {
			if ( ! empty( $settings['vyte_url'] ) ) {
				$output .= '<iframe src="' . esc_url( $settings['vyte_url'] ) . '" width="' . esc_attr( $settings['vyte_width']['size'] ) . '" height="' . esc_attr( $settings['vyte_height']['size'] ) . '" frameborder="0"></iframe>';
			}
		} elseif ( 'xai' === $scheduler_select ) {
			if ( ! empty( $settings['xai_username'] ) ) {
				if ( ! empty( $settings['xai_pagename'] ) ) {
					$xai_output .= '/' . $settings['xai_pagename'];
				}
				$output .= '<script type="text/javascript" src="https://x.ai/embed/xdotai-embed.js" id="xdotaiEmbed" data-page="/' . esc_url( $settings['xai_username'] ) . esc_url( $xai_output ) . '" data-height data-width data-element async></script>';
			}
		}

		echo $output;
	}

	/**
	 * Render content_template.
	 *
	 * @since 4.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}

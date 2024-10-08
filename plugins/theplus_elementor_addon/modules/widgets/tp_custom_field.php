<?php
/**
 * Widget Name: TP Custom Field
 * Description: Dynamic Content Custom Field Display.
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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Custom_Field
 */
class ThePlus_Custom_Field extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-custom-field';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'TP Custom Field', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-th theplus_backend_icon';
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
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-listing' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Custom Field', 'Dynamic Content', 'Dynamic Listing' );
	}

	/**
	 * Register controls.
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start */
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Custom Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'custom-field-key',
			array(
				'label'       => __( 'Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Your Custom Field Name/Key', 'theplus' ),
				'default'     => __( 'field_key', 'theplus' ),
			)
		);
		$this->add_control(
			'cfkey_type',
			array(
				'label'   => __( 'Field Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'text'   => __( 'Default', 'theplus' ),
					'image'  => __( 'Image', 'theplus' ),
					'link'   => __( 'Link', 'theplus' ),
					'video'  => __( 'Video', 'theplus' ),
					'audio'  => __( 'Audio', 'theplus' ),
					'date'   => __( 'Date', 'theplus' ),
					'html'   => __( 'Html', 'theplus' ),
					'oembed' => __( 'oEmbed', 'theplus' ),
				),
				'default' => 'text',
			)
		);
		$this->add_control(
			'key_link_type',
			array(
				'label'     => __( 'Link Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'default' => __( 'Default Link', 'theplus' ),
					'email'   => __( 'Email', 'theplus' ),
					'tel'     => __( 'Telephone', 'theplus' ),
				),
				'default'   => 'default',
				'condition' => array(
					'cfkey_type' => 'link',
				),
			)
		);
		if ( class_exists( 'acf' ) ) {
			$this->add_control(
				'field_acf_key',
				array(
					'label'     => __( 'ACF Field/Key', 'theplus' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __( 'Yes', 'theplus' ),
					'label_off' => __( 'No', 'theplus' ),
					'condition' => array(
						'cfkey_type' => array( 'text', 'link', 'audio', 'date' ),
					),
				)
			);
		}
		$this->add_control(
			'field_date_format',
			array(
				'label'       => __( 'Date format', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => $this->theplus_date_format_list(),
				'default'     => 'F j, Y',
				'condition'   => array(
					'field_acf_key' => '',
					'cfkey_type'    => 'date',
				),

			)
		);
		$this->add_control(
			'date_custom_format',
			array(
				'label'       => __( 'Date Format', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Date Format', 'theplus' ),
				'default'     => 'y:m:d',
				'description' => 'Enter date and time formatting documentation : <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank"> Click here</a>',
				'condition'   => array(
					'field_date_format' => 'custom',
				),
			)
		);
		$this->add_control(
			'field_link_type',
			array(
				'label'     => __( 'Links To', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'static'       => __( 'Static', 'theplus' ),
					'post'         => __( 'Post', 'theplus' ),
					'custom_field' => __( 'Custom Field', 'theplus' ),
				),
				'default'   => 'static',
				'condition' => array(
					'cfkey_type' => 'link',
				),
			)
		);
		$this->add_control(
			'field_link_text',
			array(
				'label'       => __( 'Static Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Link Text', 'theplus' ),
				'default'     => __( 'Read More', 'theplus' ),
				'condition'   => array(
					'cfkey_type'      => 'link',
					'field_link_type' => 'static',
				),
			)
		);
		$this->add_control(
			'field_link_dynamic_text',
			array(
				'label'       => __( 'Enter Dynamic Field Key', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Field Key', 'theplus' ),
				'default'     => '',
				'condition'   => array(
					'cfkey_type'      => 'link',
					'field_link_type' => 'custom_field',
				),
				'description' => __( 'Custom field will be used for anchor text', 'theplus' ),
			)
		);
		$this->add_control(
			'field_link_target',
			array(
				'label'     => __( 'Open in new tab', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'condition' => array(
					'cfkey_type' => array( 'link', 'image' ),
				),
			)
		);
		$this->add_control(
			'field_link_download',
			array(
				'label'        => __( 'Download on Click', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'theplus' ),
				'label_off'    => __( 'No', 'theplus' ),
				'return_value' => 1,
				'default'      => __( 'label_off', 'theplus' ),
				'condition'    => array(
					'cfkey_type' => array( 'link' ),
				),
			)
		);
		$this->add_control(
			'field_label',
			array(
				'label'       => __( 'Label', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'theplus' ),
				'default'     => '',
				'condition'   => array(
					'cfkey_type' => array( 'text', 'link', 'date' ),
				),
			)
		);
		$this->add_control(
			'header_tag',
			array(
				'label'     => __( 'HTML Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1'   => __( 'H1', 'theplus' ),
					'h2'   => __( 'H2', 'theplus' ),
					'h3'   => __( 'H3', 'theplus' ),
					'h4'   => __( 'H4', 'theplus' ),
					'h5'   => __( 'H5', 'theplus' ),
					'h6'   => __( 'H6', 'theplus' ),
					'div'  => __( 'div', 'theplus' ),
					'span' => __( 'span', 'theplus' ),
					'p'    => __( 'p', 'theplus' ),
				),
				'default'   => 'h3',
				'condition' => array(
					'cfkey_type' => array( 'text', 'date' ),
				),
			)
		);
		$this->add_responsive_control(
			'field_align',
			array(
				'label'     => __( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justify', 'theplus' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'cfkey_type!' => 'video',
				),
			)
		);
		$this->add_control(
			'field_links_to_image',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => __( 'Image Link to', 'theplus' ),
				'options'   => array(
					''             => __( 'None', 'theplus' ),
					'post'         => __( 'Post Url', 'theplus' ),
					'media'        => __( 'Full Image', 'theplus' ),
					'lightbox'     => __( 'Light Box', 'theplus' ),
					'static'       => __( 'Custom URL', 'theplus' ),
					'custom_field' => __( 'Custom Field', 'theplus' ),
				),
				'default'   => '',
				'condition' => array(
					'cfkey_type' => 'image',
				),
			)
		);
		$this->add_control(
			'field_link_image',
			array(
				'label'       => __( 'Custom URL', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Custom URL', 'theplus' ),
				'default'     => '',
				'condition'   => array(
					'cfkey_type'           => 'image',
					'field_links_to_image' => 'static',
				),
			)
		);
		$this->add_control(
			'field_link_dynamic_image',
			array(
				'label'       => __( 'Enter Field Key', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Field Key', 'theplus' ),
				'default'     => '',
				'condition'   => array(
					'cfkey_type'           => 'image',
					'field_links_to_image' => 'custom_field',
				),
				'description' => __( 'Custom field will be used for image link', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'field_image_size',
				'label'     => __( 'Image Size', 'theplus' ),
				'default'   => 'full',
				'exclude'   => array( 'custom' ),
				'condition' => array(
					'cfkey_type' => 'image',
				),
			)
		);
		$this->add_control(
			'field_video_type',
			array(
				'label'     => __( 'Video Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'youtube' => __( 'Youtube Video', 'theplus' ),
					'vimeo'   => __( 'Vimeo Video', 'theplus' ),
				),
				'default'   => 'youtube',
				'condition' => array(
					'cfkey_type' => 'video',
				),
			)
		);
		$this->add_control(
			'aspect_ratio',
			array(
				'label'              => __( 'Aspect Ratio', 'theplus' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'169' => '16:9',
					'43'  => '4:3',
					'32'  => '3:2',
				),
				'frontend_available' => true,
				'default'            => '16-9',
				'condition'          => array(
					'cfkey_type' => 'video',
				),
			)
		);
		$this->add_control(
			'youtube_field_opt',
			array(
				'label'     => __( 'Youtube Video Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'field_yt_autoplay',
			array(
				'label'     => __( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'field_yt_controls',
			array(
				'label'     => __( 'Player Control', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'theplus' ),
				'label_on'  => __( 'Show', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'field_yt_rel',
			array(
				'label'     => __( 'Youtube Suggested Videos', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'field_yt_showinfo',
			array(
				'label'     => __( 'Video Title & Actions', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'theplus' ),
				'label_on'  => __( 'Show', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'vimeo_field_opt',
			array(
				'label'     => __( 'Vimeo Video Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'field_vimeo_bg',
			array(
				'label'     => __( 'Background Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'lablel_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'default'   => '',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'field_vimeo_autoplay',
			array(
				'label'     => __( 'Vimeo Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'theplus' ),
				'label_on'  => __( 'Yes', 'theplus' ),
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
					'field_vimeo_bg'   => '',
				),
			)
		);
		$this->add_control(
			'field_vimeo_title',
			array(
				'label'     => __( 'Vimeo Intro Title', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
					'field_vimeo_bg'   => '',
				),
			)
		);
		$this->add_control(
			'field_vimeo_loop',
			array(
				'label'     => __( 'Vimeo Loop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'theplus' ),
				'label_on'  => __( 'Yes', 'theplus' ),
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
					'field_vimeo_bg'   => '',
				),
			)
		);
		$this->add_control(
			'field_vimeo_portrait',
			array(
				'label'     => __( 'Vimeo Intro Portrait', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
					'field_vimeo_bg'   => '',
				),
			)
		);
		$this->add_control(
			'field_vimeo_byline',
			array(
				'label'     => __( 'Vimeo Intro Byline', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'theplus' ),
				'label_on'  => __( 'Show', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
					'field_vimeo_bg'   => '',
				),
			)
		);
		$this->add_control(
			'field_vimeo_color',
			array(
				'label'     => __( 'Controls Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
				),
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
					'field_vimeo_bg'   => '',
				),
			)
		);
		$this->add_control(
			'field_vimeo_muted',
			array(
				'label'     => __( 'Muted', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'theplus' ),
				'lablel_on' => __( 'Yes', 'theplus' ),
				'default'   => '',
				'condition' => array(
					'cfkey_type'       => 'video',
					'field_video_type' => 'vimeo',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'txt_fld_limit',
			array(
				'label'     => esc_html__( 'Text Field Limit', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'cfkey_type' => 'text',
				),
			)
		);
		$this->add_control(
			'display_txt_limit',
			array(
				'label'     => esc_html__( 'Text Limit', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_text_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'theplus' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'display_txt_limit' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_txt_input',
			array(
				'label'     => esc_html__( 'Text Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'display_txt_limit' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'custom_field',
			array(
				'label' => esc_html__( 'Custom Field Styling', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ec_rtn_shop_heading',
			array(
				'label'     => esc_html__( 'Field Styling', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'cfkey_type' => array( 'text', 'html', 'link', 'date' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'field_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap',
				'condition' => array(
					'cfkey_type' => array( 'text', 'html', 'link', 'date' ),
				),

			)
		);
		$this->add_control(
			'field_color',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'cfkey_type' => array( 'text', 'html', 'link', 'date' ),
				),
			)
		);
		$this->add_control(
			'field_h_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'cfkey_type' => array( 'text', 'link', 'date' ),
				),
			)
		);
		$this->add_control(
			'cf_label_heading',
			array(
				'label'     => esc_html__( 'Label Styling', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'field_label!' => '',
					'cfkey_type'   => array( 'text', 'link', 'date' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'cf_label_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-field-wrapper .tp-field-label',
				'condition' => array(
					'field_label!' => '',
					'cfkey_type'   => array( 'text', 'link', 'date' ),
				),

			)
		);
		$this->add_responsive_control(
			'cf_label_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-field-wrapper .tp-field-label' => 'margin-right:{{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'field_label!' => '',
					'cfkey_type'   => array( 'text', 'link', 'date' ),
				),
			)
		);
		$this->add_control(
			'cf_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-field-wrapper .tp-field-label' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'field_label!' => '',
					'cfkey_type'   => array( 'text', 'link', 'date' ),
				),
			)
		);
		$this->add_responsive_control(
			'cf_img_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Image Size', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap img' => 'width:{{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'cfkey_type' => array( 'image' ),
				),
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'cf_img_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap img',
				'condition' => array(
					'cfkey_type' => array( 'image' ),
				),
			)
		);
		$this->add_responsive_control(
			'cf_img_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'cfkey_type' => array( 'image' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cf_img_shadow',
				'selector'  => '{{WRAPPER}} .tp-field-wrapper .plus-custom-field-wrap img',
				'condition' => array(
					'cfkey_type' => array( 'image' ),
				),
			)
		);
		$this->add_responsive_control(
			'cf_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-field-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cf_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-field-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cf_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-field-wrapper',
			)
		);
		$this->add_responsive_control(
			'cf_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cf_shadow',
				'selector' => '{{WRAPPER}} .tp-field-wrapper',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render Limit world function
	 *
	 * @param string $string The attribute slug for world.
	 * @param string $word_limit The attribute slug for World Limit.
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	protected function limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string );
		return implode( ' ', array_splice( $words, 0, $word_limit ) );
	}

	/**
	 * Render TP Custom Field
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$cfkey_type   = ! empty( $settings['cfkey_type'] ) ? $settings['cfkey_type'] : 'text';
		$custom_field = ! empty( $settings['custom-field-key'] ) ? $settings['custom-field-key'] : 'field_key';

		$post_image_size = $settings['field_image_size_size'];
		$display_text_by = ! empty( $settings['display_text_by'] ) ? $settings['display_text_by'] : 'char';

		$field_link_target = ! empty( $settings['field_link_target'] ) ? $settings['field_link_target'] : '';
		$image_type_select = ! empty( $settings['field_links_to_image'] ) ? $settings['field_links_to_image'] : '';

		$post_data = array();
		if ( ! isset( $GLOBALS['post'] ) ) {
			return $post_data;
		}

		$preview_id = '';
		$post_id    = '';
		if ( 'elementor_library' === $GLOBALS['post']->post_type ) {
			$post_id    = $GLOBALS['post']->ID;
			$preview_id = get_post_meta( $post_id, 'tp_preview_post', true );

			if ( ! empty( $preview_id ) && 0 != $preview_id ) :
				$post_data = get_post( $preview_id );
			else :
				$args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => 1,
				);

				$get_data  = get_posts( $args );
				$post_data = $get_data[0];
			endif;
		} else {
			$post_data = $GLOBALS['post'];
		}

		if ( empty( $post_data ) ) {
			$post_data = get_post( 0 );
		}

		$post_id    = $post_data->ID;
		$post_title = $post_data->post_title;

		/**--- if(class_exists('acf') && in_array($settings['cfkey_type'],['text','link','audio', 'date']) && $settings['field_acf_key'] == 'yes'){ */
		if ( class_exists( 'acf' ) && ( ( in_array( $cfkey_type, array( 'text', 'link', 'audio', 'date' ) ) && 'yes' === $settings['field_acf_key'] ) || ( 'image' === $cfkey_type ) ) ) {
			$custom_field_val = get_field( $custom_field, $post_id );
		} else {
			$custom_field_val = get_post_meta( $post_id, $custom_field, true );
		}

		$field_link_dynamic_text = '';
		if ( ! empty( $settings['field_link_dynamic_text'] ) ) {
			$field_link_dynamic_text = get_post_meta( $post_id, $settings['field_link_dynamic_text'], true );
		}

		$field_link_dynamic_image = '';
		if ( 'image' === $cfkey_type && 'custom_field' === $image_type_select && ! empty( $settings['field_link_dynamic_image'] ) ) {
			$field_link_dynamic_image = get_post_meta( $post_id, $settings['field_link_dynamic_image'], true );
		}

		$repeater_field = theplus_acf_repeater_field_data();

		if ( $repeater_field['is_repeater_field'] ) {
			if ( isset( $repeater_field['field'] ) ) {
				$field_data = get_field( $repeater_field['field'], $post_id );
				if ( $field_data[0][ $custom_field ] ) {
					$custom_field_val = $field_data[0][ $custom_field ];
				}

				if ( 'link' === $cfkey_type && ! empty( $settings['field_link_dynamic_text'] ) ) {
					$field_link_dynamic_text = $field_data[0][ $settings['field_link_dynamic_text'] ];
				}

				if ( 'image' === $cfkey_type && 'custom_field' === $image_type_select && ! empty( $settings['field_link_dynamic_image'] ) ) {
					$field_link_dynamic_image = $field_data[0][ $settings['field_link_dynamic_image'] ];
				}
			} else {
				$custom_field_val = get_sub_field( $custom_field );
				if ( 'link' === $cfkey_type ) {
					$field_link_dynamic_text = get_sub_field( $settings['field_link_dynamic_text'] );
				}

				if ( 'image' === $cfkey_type && 'custom_field' === $image_type_select && ! empty( $settings['field_link_dynamic_image'] ) ) {
					$field_link_dynamic_image = get_sub_field( $settings['field_link_dynamic_image'] );
				}
			}
		}

		if ( 'text' === $cfkey_type ) {
			if ( ( ! empty( $settings['display_txt_limit'] ) && 'yes' === $settings['display_txt_limit'] ) && ! empty( $settings['display_txt_input'] ) ) {
				if ( 'char' === $display_text_by ) {
					$custom_field_val = substr( $custom_field_val, 0, $settings['display_txt_input'] );
				} elseif ( 'word' === $display_text_by ) {
					$custom_field_val = $this->limit_words( $custom_field_val, $settings['display_txt_input'] );
				}
			} else {
				$custom_field_val = $custom_field_val;
			}
		}

		$this->add_render_attribute( 'tp-field-class', 'class', 'tp-field-wrapper' );
		$this->add_render_attribute( 'tp-field-class', 'class', 'tp-field-' . $cfkey_type );

		$this->add_render_attribute( 'tp-custom-field-class', 'class', 'plus-custom-field-wrap' );

		if ( empty( $custom_field_val ) ) {
			$this->add_render_attribute( 'tp-field-class', 'class', 'hide' );
		}

		if ( '1' === $settings['field_link_download'] ) {
			$this->add_render_attribute( 'tp-custom-field-class', 'download', '' );
		}

		if ( 'yes' === $field_link_target ) {
			$this->add_render_attribute( 'tp-custom-field-class', 'target', '_blank' );
		}

		/**-- $cfkey_type = $settings['cfkey_type']; */
		$widget_id  = $this->get_id();
		$field_html = '';
		switch ( $cfkey_type ) {

			case 'image':
				if ( 'post' === $image_type_select ) {
					$post_permalink = get_permalink( $post_id );
				} elseif ( 'media' === $image_type_select ) {
					$image_link     = wp_get_attachment_image_src( $custom_field_val, 'full' );
					$post_permalink = $image_link[0];
				} elseif ( 'lightbox' === $image_type_select ) {
					$image_link     = wp_get_attachment_image_src( $custom_field_val, 'full' );
					$post_permalink = $image_link[0];
				} elseif ( 'static' === $image_type_select ) {
					$post_permalink = $settings['field_link_image'];
				} elseif ( 'custom_field' === $image_type_select ) {
					$post_permalink = $field_link_dynamic_image;
				}

				if ( is_numeric( $custom_field_val ) ) {
					$field_html = '<div ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . '>';
					if ( ! empty( $image_type_select ) ) {
						$target = '';
						if ( 'yes' === $field_link_target ) {
							$target = ' target="_blank"';
						}
						$field_html .= '<a href="' . esc_url( $post_permalink ) . '" title="' . esc_attr( $post_title ) . '"' . $target . '>';
					}
					$field_html .= wp_get_attachment_image( $custom_field_val, $post_image_size );
					if ( ! empty( $image_type_select ) ) {
						$field_html .= '</a>';
					}
					$field_html .= '</div>';
				} elseif ( is_array( $custom_field_val ) ) {

					/**--- if(!isset($custom_field_val[$post_image_size])){ */
					if ( ! isset( $custom_field_val['sizes'][ $post_image_size ] ) ) {
						if ( ! empty( $custom_field_val['guid'] ) ) {
							$custom_field_val = $custom_field_val['guid'];
						} else {
							$custom_field_val = $custom_field_val['url'];
						}
					} else {
						/**--- $custom_field_val = $custom_field_val[$post_image_size]; */
						$custom_field_val = $custom_field_val['sizes'][ $post_image_size ];
					}
					$target = '';
					if ( 'yes' === $field_link_target ) {
						$target = ' target="_blank"';
					}
					$field_html = '<div ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . '>';
					if ( 'lightbox' === $image_type_select ) {
						$field_html .= '<a href="' . esc_url( $custom_field_val ) . '" ' . $target . ' title="' . esc_attr( $post_title ) . '">';
					} elseif ( ! empty( $image_type_select ) ) {
						$field_html .= '<a href="' . esc_url( $post_permalink ) . '" ' . $target . ' title="' . esc_attr( $post_title ) . '">';
					}
					$field_html .= '<img src="' . esc_url( $custom_field_val ) . '" />';
					if ( ! empty( $image_type_select ) || 'lightbox' === $image_type_select ) {
						$field_html .= '</a>';
					}
					$field_html .= '</div>';
				} else {
					$field_html = '<div ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . '>';
					if ( ! empty( $image_type_select ) ) {
						$target = '';
						if ( 'yes' === $field_link_target ) {
							$target = ' target="_blank"';
						}
						if ( ! empty( $post_permalink ) ) {
							$field_html .= '<a href="' . esc_url( $post_permalink ) . '" ' . $target . ' title="' . esc_attr( $post_title ) . '">';
						} else {
							$field_html .= '<a href="' . esc_url( $custom_field_val ) . '" ' . $target . ' title="' . esc_attr( $post_title ) . '">';
						}
					}
					$field_html .= '<img src="' . esc_url( $custom_field_val ) . '" />';
					if ( ! empty( $image_type_select ) ) {
						$field_html .= '</a>';
					}
					$field_html .= '</div>';
				}

				break;

			/*
			-- case "link":
			if(is_array($custom_field_val)){
			$custom_field_val = $custom_field_val['url'];
			}
			if($settings['key_link_type'] == 'email'){
			$custom_field_val = 'mailto:'.$custom_field_val;
			}elseif($settings['key_link_type'] == 'tel'){
			$custom_field_val = 'tel:'.$custom_field_val;
			}

			if(!empty($settings['field_link_text']) && $settings['field_link_type'] == 'static'){
			$static_text = ($settings['field_link_text']) ? $settings['field_link_text'] : __('Read More','theplus');
			$field_html = '<a href="'.$custom_field_val.'" '.$this->get_render_attribute_string( 'tp-custom-field-class' ).'  >'.$static_text.'</a>';
			}else if(!empty($field_link_dynamic_text) && $settings['field_link_type'] == 'custom_field') {
			$field_html = '<a href="'.$custom_field_val.'" '.$this->get_render_attribute_string( 'tp-custom-field-class' ).' >'.$field_link_dynamic_text.'</a>';
			}else{
			if($settings['key_link_type'] != 'default'){
			$field_html = '<a href="'.$custom_field_val.'" '.$this->get_render_attribute_string( 'tp-custom-field-class' ).'>'. get_post_meta($post_id,$custom_field,true) .'</a>';
			}else{
			$field_html = '<a href="'.$custom_field_val.'" '.$this->get_render_attribute_string( 'tp-custom-field-class' ).' >'.$custom_field_val.'</a>';
			}
			}   -*/

			case 'link':
				$custom_field_val_array = false;
				if ( is_array( $custom_field_val ) ) {
					$custom_field_val_array = $custom_field_val;

					$custom_field_val = esc_url( $custom_field_val['url'] );
				}
				if ( 'email' === $settings['key_link_type'] ) {
					$custom_field_val = 'mailto:' . $custom_field_val;
				} elseif ( 'tel' === $settings['key_link_type'] ) {
					$custom_field_val = 'tel:' . $custom_field_val;
				}

				if ( ! empty( $settings['field_link_text'] ) && 'static' === $settings['field_link_type'] ) {
					$static_text = ( $settings['field_link_text'] ) ? $settings['field_link_text'] : __( 'Read More', 'theplus' );
					$field_html  = '<a href="' . esc_url( $custom_field_val ) . '" ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . ' >' . esc_attr( $static_text ) . '</a>';
				} elseif ( ! empty( $field_link_dynamic_text ) && 'custom_field' === $settings['field_link_type'] ) {
					$field_html = '<a href="' . esc_url( $custom_field_val ) . '" ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . ' >' . esc_attr( $field_link_dynamic_text ) . '</a>';
				} elseif ( 'default' !== $settings['key_link_type'] ) {
					$field_html = '<a href="' . esc_url( $custom_field_val ) . '" ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . '>' . get_post_meta( $post_id, $custom_field, true ) . '</a>';
				} elseif ( is_array( $custom_field_val_array ) ) {
					$field_html = '<a href="' . esc_url( $custom_field_val ) . '" ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . ( isset( $custom_field_val_array['target'] ) ? ' target="' . $custom_field_val_array['target'] . '" ' : ' ' ) . ' >' . ( ! empty( $custom_field_val_array['title'] ) ? $custom_field_val_array['title'] : $custom_field_val ) . '</a>';
				} else {
					$field_html = '<a href="' . esc_url( $custom_field_val ) . '" ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . ' >' . $custom_field_val . '</a>';
				}

				if ( 'post' === $settings['field_link_type'] ) {
					$field_html = '<a href="' . get_permalink( $post_id ) . '" ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . ' >' . $custom_field_val . '</a>';
				}

				break;

			case 'video':
				add_filter( 'oembed_result', array( $this, 'theplus_video_embed_field' ), 55, 3 );

				$field_html  = wp_oembed_get( $custom_field_val, wp_embed_defaults() );
				$argument    = "['" . $widget_id . "','" . esc_attr( $settings['aspect_ratio'] ) . "']";
				$field_html .= "<script type='text/javascript'>
					jQuery(document).ready(function(){
						jQuery(document).trigger('elementor/render/tp-field-video'," . $argument . ");
					});
					
					jQuery(window).on('resize',function() {
						jQuery(document).trigger('elementor/render/tp-field-video'," . $argument . ");
					});
					jQuery(document).trigger('elementor/render/tp-field-video'," . $argument . ');
					</script>';

				remove_filter( 'oembed_result', array( $this, 'theplus_video_embed_field' ), 55 );

				break;

			case 'audio':
				$field_html = wp_audio_shortcode( array( 'src' => $custom_field_val ) );
				break;

			case 'date':
				if ( empty( $custom_field_val ) ) {
					break;
				}

				if ( ! empty( $settings['field_acf_key'] ) ) {
					$format = 'g:i A';
					if ( 'custom' === $settings['field_date_format'] ) {
						$format = $settings['date_custom_format'];
					} elseif ( 'default' === $settings['field_date_format'] ) {
						$format = get_option( 'date_format' );
					} else {
						$format = $settings['field_date_format'];
					}

					$custom_field_val = str_replace( '/', '-', $custom_field_val );
					$field_html       = date( $format, strtotime( $custom_field_val ) );
				} else {
					$field_html = $custom_field_val;
				}

				$field_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', theplus_validate_html_tag( $settings['header_tag'] ), $this->get_render_attribute_string( 'tp-custom-field-class' ), do_shortcode( $field_html ) );

				break;

			case 'html':
				if ( ! empty( $custom_field_val ) ) {
					$field_html = '<div ' . $this->get_render_attribute_string( 'tp-custom-field-class' ) . '>' . wpautop( do_shortcode( $custom_field_val ) ) . '</div>';
				}
				break;

			case 'oembed':
				if ( $repeater_field['is_repeater_field'] ) {
					$field_html = $custom_field_val;
				} else {
					$field_html = wp_oembed_get( $custom_field_val, wp_embed_defaults() );
				}
				break;

			default:
				$field_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', theplus_validate_html_tag( $settings['header_tag'] ), $this->get_render_attribute_string( 'tp-custom-field-class' ), do_shortcode( $custom_field_val ) );
				break;
		}

		$output = '<div ' . $this->get_render_attribute_string( 'tp-field-class' ) . '>';

		if ( ( 'text' === $cfkey_type ) || ( 'link' === $cfkey_type ) || ( 'date' === $cfkey_type ) ) {
			if ( ! empty( $settings['field_label'] ) && ! empty( $custom_field_val ) ) {
				$output .= '<span class="tp-field-label">' . wp_kses_post( $settings['field_label'] ) . '</span>';
			}
		}

		$output .= $field_html;
		$output .= '</div>';

		echo $output;
	}

	/**
	 * Render Video field
	 *
	 * @param string $html The attribute slug for HTML Content.
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	public function theplus_video_embed_field( $html ) {
		$settings = $this->get_settings();

		$data_params = array();

		if ( 'youtube' === $settings['field_video_type'] ) {
			$yt_options = array( 'autoplay', 'controls', 'rel', 'showinfo' );

			foreach ( $yt_options as $option ) {
				$value = ( 'yes' === $settings[ 'field_yt_' . $option ] ) ? '1' : '0';

				$data_params[ $option ] = $value;
			}

			$data_params['wmode'] = 'opaque';
		}

		if ( 'vimeo' === $settings['field_video_type'] ) {
			$vimeo_options = array( 'autoplay', 'loop', 'portrait', 'title', 'byline', 'muted', 'bg' );

			foreach ( $vimeo_options as $option ) {

				$value = ( 'yes' === $settings[ 'field_vimeo_' . $option ] ) ? '1' : '0';

				$data_params[ $option ] = $value;
				if ( 'yes' === $settings['field_vimeo_bg'] ) {
					unset( $data_params ['loop'] );
					unset( $data_params ['autoplay'] );
					unset( $data_params ['title'] );
				}
			}

			$data_params['color'] = str_replace( '#', '', $settings['field_vimeo_color'] );
		}

		if ( ! empty( $data_params ) ) {
			preg_match( '/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $html, $matches );
			$embed_url = esc_url( add_query_arg( $data_params, $matches[1] ) );

			$html = str_replace( $matches[1], $embed_url, $html );
		}

		return $html;
	}

	/**
	 * Get theplus_date_format_list
	 *
	 * @since 1.0.0
	 */
	public function theplus_date_format_list() {
		$date_format_list = array(
			'F j, Y'           => date( 'F j, Y' ),
			'F j, Y g:i a'     => date( 'F j, Y g:i a' ),
			'F, Y'             => date( 'F, Y' ),
			'g:i a'            => date( 'g:i a' ),
			'g:i:s a'          => date( 'g:i:s a' ),
			'l, F jS, Y'       => date( 'l, F jS, Y' ),
			'M j, Y @ G:i'     => date( 'M j, Y @ G:i' ),
			'Y/m/d'            => date( 'Y/m/d' ),
			'Y/m/d \a\t g:i A' => date( 'Y/m/d \a\t g:i A' ),
			'Y/m/d \a\t g:ia'  => date( 'Y/m/d \a\t g:ia' ),
			'Y/m/d g:i:s A'    => date( 'Y/m/d g:i:s A' ),
			'Y-m-d'            => date( 'Y-m-d' ),
			'Y-m-d \a\t g:i A' => date( 'Y-m-d \a\t g:i A' ),
			'Y-m-d \a\t g:ia'  => date( 'Y-m-d \a\t g:ia' ),
			'Y-m-d g:i:s A'    => date( 'Y-m-d g:i:s A' ),
			'custom'           => __( 'Custom', 'theplus' ),
			'default'          => __( 'Default', 'theplus' ),
		);

		return $date_format_list;
	}

	/**
	 * Render content_template
	 *
	 * @since 3.1.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}

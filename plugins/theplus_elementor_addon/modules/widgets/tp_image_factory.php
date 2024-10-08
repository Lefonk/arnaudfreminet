<?php
/**
 * Widget Name: Creative Image Factory
 * Description: Display image factory creative.
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
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Image_Factory.
 */
class ThePlus_Image_Factory extends Widget_Base {

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
	 * @since 1.4.2
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-image-factory';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.4.2
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Creative Image', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.4.2
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
	 * Get Widget Categories.
	 *
	 * @since 1.4.2
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keywords.
	 *
	 * @since 1.4.2
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Creative Images', 'Image Gallery', 'Image Slider', 'Image Carousel', 'Image Showcase', 'Image Grid', 'Image Masonry', 'Image Wall', 'Image Portfolio' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.4.2
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
			'animated_style',
			array(
				'label'   => esc_html__( 'Image Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'creative-simple-image',
				'options' => array(
					'creative-simple-image' => esc_html__( 'Creative Image', 'theplus' ),
					'animate-image'         => esc_html__( 'Scroll Reveal Image', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works',
			array(
				'label' => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-image-reveal-animation-on-scroll-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
				'condition' => array(
					'animated_style' => 'animate-image',
				),
			)
		);
		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'theplus' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => '',
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'bg_color',
			array(
				'label'     => esc_html__( 'Animated Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'animated_style' => 'animate-image',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'animated_direction',
			array(
				'label'     => esc_html__( 'Animation Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'animated_style' => 'animate-image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'none',
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'   => esc_html__( 'Image Alignment', 'theplus' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
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
				'toggle'  => true,
			)
		);
		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link to', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://your-link.com', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'img_max_width',
			array(
				'label'      => esc_html__( 'Max Width Image', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_animated_image img,{{WRAPPER}} .pt_plus_animated_image .scroll-image-wrap,{{WRAPPER}} .pt_plus_animated_image figure.js-tilt' => 'max-width: {{SIZE}}{{UNIT}};width:100%;',
				),
				'condition'  => array(
					'animated_style' => array( 'creative-simple-image' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_styling',
			array(
				'label' => esc_html__( 'Style Image', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'scroll_image_effect',
			array(
				'label'     => wp_kses_post( "Scroll Image <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-scroll-on-hover-to-an-image-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'scroll_image_height',
			array(
				'label'     => esc_html__( 'Min Height', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'step' => 10,
						'min'  => 5,
						'max'  => 1200,
					),
				),
				'default'   => array(
					'size' => 400,
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap .creative-scroll-image' => 'min-height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'scroll_image_effect' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'transition_duration',
			array(
				'label'     => esc_html__( 'Transition Duration', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 2,
				),
				'range'     => array(
					'px' => array(
						'step' => 0.1,
						'min'  => 0.1,
						'max'  => 10,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap .creative-scroll-image' => 'transition: background-position {{SIZE}}s ease-in-out;-webkit-transition: background-position {{SIZE}}s ease-in-out;',
				),
				'condition' => array(
					'scroll_image_effect' => 'yes',
				),
			)
		);
		$this->add_control(
			'mask_image_display',
			array(
				'label'     => wp_kses_post( "Mask Image Shape <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "mask-an-image-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Use PNG image with the shape you want to mask around Media Image.', 'theplus' ),
				'label_on'    => esc_html__( 'On', 'theplus' ),
				'label_off'   => esc_html__( 'Off', 'theplus' ),
				'default'     => 'no',
				'separator'   => 'before',
				'condition'   => array(
					'animated_style' => array( 'creative-simple-image' ),
				),
			)
		);
		$this->add_control(
			'mask_shape_image',
			array(
				'label'       => esc_html__( 'Mask Image', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array(
					'url' => '',
				),
				'description' => esc_html__( 'Use PNG image with the shape you want to mask around feature image.', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_animated_image .vc_single_image-wrapper.creative-mask-media' => 'mask-image: url({{URL}});-webkit-mask-image: url({{URL}});',
				),
				'condition'   => array(
					'animated_style'     => array( 'creative-simple-image' ),
					'mask_image_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'mask_shape_image_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Mask Position', 'theplus' ),
				'default'   => 'center center',
				'options'   => theplus_get_image_position_options(),
				'selectors' => array(
					'{{WRAPPER}}  .pt_plus_animated_image .vc_single_image-wrapper.creative-mask-media' => '-webkit-mask-position:{{VALUE}};',
				),
				'condition' => array(
					'animated_style'     => array( 'creative-simple-image' ),
					'mask_image_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'mask_shape_image_repeat',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Mask Repeat', 'theplus' ),
				'default'   => 'no-repeat',
				'options'   => theplus_get_image_reapeat_options(),
				'selectors' => array(
					'{{WRAPPER}}  .pt_plus_animated_image .vc_single_image-wrapper.creative-mask-media' => 'mask-repeat:{{VALUE}};-webkit-mask-repeat:{{VALUE}};',
				),
				'condition' => array(
					'animated_style'     => array( 'creative-simple-image' ),
					'mask_image_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'mask_shape_image_size',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Mask Size', 'theplus' ),
				'default'   => 'contain',
				'options'   => theplus_get_image_size_options(),
				'selectors' => array(
					'{{WRAPPER}}  .pt_plus_animated_image .vc_single_image-wrapper.creative-mask-media' => 'mask-size:{{VALUE}};-webkit-mask-size:{{VALUE}};',
				),
				'condition' => array(
					'animated_style'     => array( 'creative-simple-image' ),
					'mask_image_display' => 'yes',
				),
			)
		);
		$this->add_control(
			'mask_image_shadow',
			array(
				'label'       => esc_html__( 'Image Shadow', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_animated_image' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				),
				'render_type' => 'ui',
				'condition'   => array(
					'animated_style'     => array( 'creative-simple-image' ),
					'mask_image_display' => 'yes',
				),
			)
		);
		$this->add_control(
			'bg_image_parallax',
			array(
				'label'     => wp_kses_post( "Super Parallax <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-parallax-image-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'This effect will be parallax on scroll effect. It will move image as you scroll your page.', 'theplus' ),
				'label_on'    => esc_html__( 'On', 'theplus' ),
				'label_off'   => esc_html__( 'Off', 'theplus' ),
				'default'     => 'no',
				'render_type' => 'template',
				'separator'   => 'before',
				'condition'   => array(
					'animated_style' => array( 'creative-simple-image' ),
				),
			)
		);
		$this->add_control(
			'super_scroll_parallax',
			array(
				'label'      => esc_html__( 'Move Scroll (X)', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 40,
						'max'  => 700,
						'step' => 4,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 120,
				),
				'condition'  => array(
					'animated_style'    => array( 'creative-simple-image' ),
					'bg_image_parallax' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_mouse_move_parallax',
			array(
				'label'     => esc_html__( 'Mouse Move Parallax', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Mouse_Move_Parallax_Group::get_type(),
			array(
				'label'     => esc_html__( 'Parallax Options', 'theplus' ),
				'name'      => 'plus_mouse_parallax',
				'condition' => array(
					'plus_mouse_move_parallax' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'magic_scroll',
			array(
				'label'       => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Scroll Options', 'theplus' ),
				'name'        => 'scroll_option',
				'render_type' => 'template',
				'condition'   => array(
					'magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_magic_scroll' );
		$this->start_controls_tab(
			'tab_scroll_from',
			array(
				'label'     => esc_html__( 'Initial', 'theplus' ),
				'condition' => array(
					'magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label'     => esc_html__( 'Initial Position', 'theplus' ),
				'name'      => 'scroll_from',
				'condition' => array(
					'magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scroll_to',
			array(
				'label'     => esc_html__( 'Final', 'theplus' ),
				'condition' => array(
					'magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label'     => esc_html__( 'Final Position', 'theplus' ),
				'name'      => 'scroll_to',
				'condition' => array(
					'magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'plus_tooltip',
			array(
				'label'       => esc_html__( 'Tooltip', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);

		$this->start_controls_tabs( 'plus_tooltip_tabs' );

		$this->start_controls_tab(
			'plus_tooltip_content_tab',
			array(
				'label'       => esc_html__( 'Content', 'theplus' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_type',
			array(
				'label'       => esc_html__( 'Content Type', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'normal_desc',
				'options'     => array(
					'normal_desc'     => esc_html__( 'Content Text', 'theplus' ),
					'content_wysiwyg' => esc_html__( 'Content WYSIWYG', 'theplus' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_desc',
			array(
				'label'     => esc_html__( 'Description', 'theplus' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'default'   => esc_html__( 'Luctus nec ullamcorper mattis', 'theplus' ),
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_wysiwyg',
			array(
				'label'       => esc_html__( 'Tooltip Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip_content_type' => 'content_wysiwyg',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_align',
			array(
				'label'     => esc_html__( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
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
				'selectors' => array(
					'{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'plus_tooltip_content_typography',
				'selector'  => '{{WRAPPER}} .tippy-tooltip .tippy-content',
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
					'plus_tooltip'              => 'yes',
				),
			)
		);

		$this->add_control(
			'plus_tooltip_content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tippy-tooltip .tippy-content,{{WRAPPER}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'plus_tooltip_styles_tab',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'condition' => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$this->add_group_control(
			\Theplus_Tooltips_Option_Group::get_type(),
			array(
				'label'       => esc_html__( 'Tooltip Options', 'theplus' ),
				'name'        => 'tooltip_opt',
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Tooltips_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Style Options', 'theplus' ),
				'name'        => 'tooltip_style',
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'plus_tilt_parallax',
			array(
				'label'       => esc_html__( 'Tilt 3D Parallax', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'description' => esc_html__( 'You can put option of on hover tilt effect on section using this option.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Tilt_Parallax_Group::get_type(),
			array(
				'label'     => esc_html__( 'Tilt Options', 'theplus' ),
				'name'      => 'plus_tilt_opt',
				'condition' => array(
					'plus_tilt_parallax' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'plus_overlay_effect',
			array(
				'label'       => esc_html__( 'Overlay Special Effect', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'description' => esc_html__( 'This effect will create two color animation ok this when someone scroll and reach to this section.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Overlay_Special_Effect_Group::get_type(),
			array(
				'label'     => esc_html__( 'Overlay Color', 'theplus' ),
				'name'      => 'plus_overlay_spcial',
				'condition' => array(
					'plus_overlay_effect' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'plus_continuous_animation',
			array(
				'label'     => esc_html__( 'Continuous Animation', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'plus_animation_effect',
			array(
				'label'       => esc_html__( 'Animation Effect', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'pulse',
				'options'     => array(
					'pulse'    => esc_html__( 'Pulse', 'theplus' ),
					'floating' => esc_html__( 'Floating', 'theplus' ),
					'tossing'  => esc_html__( 'Tossing', 'theplus' ),
					'rotating' => esc_html__( 'Rotating', 'theplus' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_animation_hover',
			array(
				'label'       => esc_html__( 'Hover animation', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);

		$this->add_control(
			'plus_transform_origin',
			array(
				'label'       => esc_html__( 'Transform Origin', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center center',
				'options'     => array(
					'top left'      => esc_html__( 'Top Left', 'theplus' ),
					'top center"'   => esc_html__( 'Top Center', 'theplus' ),
					'top right'     => esc_html__( 'Top Right', 'theplus' ),
					'center left'   => esc_html__( 'Center Left', 'theplus' ),
					'center center' => esc_html__( 'Center Center', 'theplus' ),
					'center right'  => esc_html__( 'Center Right', 'theplus' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'theplus' ),
					'bottom center' => esc_html__( 'Bottom Center', 'theplus' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'theplus' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
					'plus_animation_effect'     => 'rotating',
				),
			)
		);
		$this->add_control(
			'plus_animation_duration',
			array(
				'label'      => esc_html__( 'Duration Time', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 's',
				'range'      => array(
					's' => array(
						'min'  => 0.5,
						'max'  => 50,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 's',
					'size' => 2.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'plus_continuous_animation' => 'yes',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'image_border',
			array(
				'label'     => esc_html__( 'Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'image_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'image_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'image_border_width',
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
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'image_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_css_filter_style' );
		$this->start_controls_tab(
			'tab_css_filter_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'image_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'image_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'image_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'css_filters',
				'selector'  => '{{WRAPPER}} .pt-plus-animated-image-wrapper img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_css_filter_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'image_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'image_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'image_hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'image_hover_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_hover_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'hover_css_filters',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'responsive_visible_opt',
			array(
				'label'     => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'desktop_opt',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_opt',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_opt',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_plus_extra_adv_hs',
			array(
				'label' => esc_html__( 'Plus Extras', 'theplus' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Post Author.
	 *
	 * @since 1.4.2
	 * @version 5.4.2
	 */
	protected function render() {

		$settings           = $this->get_settings_for_display();
		$animated_style     = ! empty( $settings['animated_style'] ) ? $settings['animated_style'] : 'creative-simple-image';
		$animated_direction = ! empty( $settings['animated_direction'] ) ? $settings['animated_direction'] : 'left';

		$visiblity_hide = '';

		$respo_visible = ! empty( $settings['responsive_visible_opt'] ) ? $settings['responsive_visible_opt'] : '';

		if ( 'yes' === $respo_visible ) {
			$visiblity_hide .= ( 'yes' !== $settings['desktop_opt'] && empty( $settings['desktop_opt'] ) ? 'hide-desktop ' : '' );
			$visiblity_hide .= ( 'yes' !== $settings['tablet_opt'] && empty( $settings['tablet_opt'] ) ? 'hide-tablet ' : '' );
			$visiblity_hide .= ( 'yes' !== $settings['mobile_opt'] && empty( $settings['mobile_opt'] ) ? 'hide-mobile ' : '' );
		}

		$magic_class     = '';
		$magic_attr      = '';
		$parallax_scroll = '';

		$mg_scroll = ! empty( $settings['magic_scroll'] ) ? $settings['magic_scroll'] : '';

		if ( 'yes' === $mg_scroll ) {

			// not use.
			if ( empty( $settings['scroll_option_popover_toggle'] ) ) {
					$scroll_offset   = 0;
					$scroll_duration = 300;
			} else {
				$scroll_offset   = ( isset( $settings['scroll_option_scroll_offset'] ) ? $settings['scroll_option_scroll_offset'] : 0 );
				$scroll_duration = ( isset( $settings['scroll_option_scroll_duration'] ) ? $settings['scroll_option_scroll_duration'] : 300 );
			}

			if ( empty( $settings['scroll_from_popover_toggle'] ) ) {
				$scroll_x_from = 0;
				$scroll_y_from = 0;

				$scroll_opacity_from = 1;
				$scroll_scale_from   = 1;
				$scroll_rotate_from  = 0;
			} else {
				$scroll_x_from = ( isset( $settings['scroll_from_scroll_x_from'] ) ? $settings['scroll_from_scroll_x_from'] : 0 );
				$scroll_y_from = ( isset( $settings['scroll_from_scroll_y_from'] ) ? $settings['scroll_from_scroll_y_from'] : 0 );

				$scroll_opacity_from = ( isset( $settings['scroll_from_scroll_opacity_from'] ) ? $settings['scroll_from_scroll_opacity_from'] : 1 );
				$scroll_scale_from   = ( isset( $settings['scroll_from_scroll_scale_from'] ) ? $settings['scroll_from_scroll_scale_from'] : 1 );
				$scroll_rotate_from  = ( isset( $settings['scroll_from_scroll_rotate_from'] ) ? $settings['scroll_from_scroll_rotate_from'] : 0 );
			}

			if ( empty( $settings['scroll_to_popover_toggle'] ) ) {
				$scroll_x_to       = 0;
				$scroll_y_to       = -50;
				$scroll_opacity_to = 1;
				$scroll_scale_to   = 1;
				$scroll_rotate_to  = 0;
			} else {
				$scroll_x_to = ( isset( $settings['scroll_to_scroll_x_to'] ) ? $settings['scroll_to_scroll_x_to'] : 0 );
				$scroll_y_to = ( isset( $settings['scroll_to_scroll_y_to'] ) ? $settings['scroll_to_scroll_y_to'] : -50 );

				$scroll_opacity_to = ( isset( $settings['scroll_to_scroll_opacity_to'] ) ? $settings['scroll_to_scroll_opacity_to'] : 1 );
				$scroll_scale_to   = ( isset( $settings['scroll_to_scroll_scale_to'] ) ? $settings['scroll_to_scroll_scale_to'] : 1 );
				$scroll_rotate_to  = ( isset( $settings['scroll_to_scroll_rotate_to'] ) ? $settings['scroll_to_scroll_rotate_to'] : 0 );
			}

			$magic_attr .= ' data-scroll_type="position" ';
			$magic_attr .= ' data-scroll_offset="' . esc_attr( $scroll_offset ) . '" ';
			$magic_attr .= ' data-scroll_duration="' . esc_attr( $scroll_duration ) . '" ';

			$magic_attr .= ' data-scroll_x_from="' . esc_attr( $scroll_x_from ) . '" ';
			$magic_attr .= ' data-scroll_x_to="' . esc_attr( $scroll_x_to ) . '" ';
			$magic_attr .= ' data-scroll_y_from="' . esc_attr( $scroll_y_from ) . '" ';
			$magic_attr .= ' data-scroll_y_to="' . esc_attr( $scroll_y_to ) . '" ';
			$magic_attr .= ' data-scroll_opacity_from="' . esc_attr( $scroll_opacity_from ) . '" ';
			$magic_attr .= ' data-scroll_opacity_to="' . esc_attr( $scroll_opacity_to ) . '" ';
			$magic_attr .= ' data-scroll_scale_from="' . esc_attr( $scroll_scale_from ) . '" ';
			$magic_attr .= ' data-scroll_scale_to="' . esc_attr( $scroll_scale_to ) . '" ';
			$magic_attr .= ' data-scroll_rotate_from="' . esc_attr( $scroll_rotate_from ) . '" ';
			$magic_attr .= ' data-scroll_rotate_to="' . esc_attr( $scroll_rotate_to ) . '" ';

			$parallax_scroll .= ' parallax-scroll ';

			$magic_class .= ' magic-scroll ';
		}

		$tp_tooltip = ! empty( $settings['plus_tooltip'] ) ? $settings['plus_tooltip'] : '';

		if ( 'yes' === $tp_tooltip ) {

			$this->add_render_attribute( '_tooltip', 'data-tippy', '', true );

			$tooltip_cont_type = ! empty( $settings['plus_tooltip_content_type'] ) ? $settings['plus_tooltip_content_type'] : 'normal_desc';

			if ( 'normal_desc' === $tooltip_cont_type ) {
				$this->add_render_attribute( '_tooltip', 'title', wp_kses_post( $settings['plus_tooltip_content_desc'] ), true );
			} elseif ( 'content_wysiwyg' === $tooltip_cont_type ) {
				$tooltip_content = ! empty( $settings['plus_tooltip_content_wysiwyg'] ) ? $settings['plus_tooltip_content_wysiwyg'] : '';
				$this->add_render_attribute( '_tooltip', 'title', wp_kses_post( $tooltip_content ), true );
			}

			$plus_tooltip_position = ! empty( $settings['tooltip_opt_plus_tooltip_position'] ) ? $settings['tooltip_opt_plus_tooltip_position'] : 'top';
			$this->add_render_attribute( '_tooltip', 'data-tippy-placement', $plus_tooltip_position, true );

			$tooltip_interactive = ! empty( $settings['tooltip_opt_plus_tooltip_interactive'] ) || 'yes' === $settings['tooltip_opt_plus_tooltip_interactive'] ? 'true' : 'false';
			$this->add_render_attribute( '_tooltip', 'data-tippy-interactive', $tooltip_interactive, true );

			$plus_tooltip_theme = ! empty( $settings['tooltip_opt_plus_tooltip_theme'] ) ? $settings['tooltip_opt_plus_tooltip_theme'] : 'dark';
			$this->add_render_attribute( '_tooltip', 'data-tippy-theme', $plus_tooltip_theme, true );

			$tooltip_arrow = ( 'none' !== $settings['tooltip_opt_plus_tooltip_arrow'] || empty( $settings['tooltip_opt_plus_tooltip_arrow'] ) ) ? 'true' : 'false';
			$this->add_render_attribute( '_tooltip', 'data-tippy-arrow', $tooltip_arrow, true );

			$plus_tooltip_arrow = ! empty( $settings['tooltip_opt_plus_tooltip_arrow'] ) ? $settings['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
			$this->add_render_attribute( '_tooltip', 'data-tippy-arrowtype', $plus_tooltip_arrow, true );

			$plus_tooltip_animation = ! empty( $settings['tooltip_opt_plus_tooltip_animation'] ) ? $settings['tooltip_opt_plus_tooltip_animation'] : 'shift-toward';
			$this->add_render_attribute( '_tooltip', 'data-tippy-animation', $plus_tooltip_animation, true );

			$plus_tooltip_x_offset = ! empty( $settings['tooltip_opt_plus_tooltip_x_offset'] ) ? $settings['tooltip_opt_plus_tooltip_x_offset'] : 0;
			$plus_tooltip_y_offset = ! empty( $settings['tooltip_opt_plus_tooltip_y_offset'] ) ? $settings['tooltip_opt_plus_tooltip_y_offset'] : 0;
			$this->add_render_attribute( '_tooltip', 'data-tippy-offset', $plus_tooltip_x_offset . ',' . $plus_tooltip_y_offset, true );

			$tooltip_duration_in  = ! empty( $settings['tooltip_opt_plus_tooltip_duration_in'] ) ? $settings['tooltip_opt_plus_tooltip_duration_in'] : 250;
			$tooltip_duration_out = ! empty( $settings['tooltip_opt_plus_tooltip_duration_out'] ) ? $settings['tooltip_opt_plus_tooltip_duration_out'] : 200;
			$tooltip_trigger      = ! empty( $settings['tooltip_opt_plus_tooltip_triggger'] ) ? $settings['tooltip_opt_plus_tooltip_triggger'] : 'mouseenter';
			$tooltip_arrowtype    = ! empty( $settings['tooltip_opt_plus_tooltip_arrow'] ) ? $settings['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
		}

		$tilt_attr  = '';
		$hover_tilt = '';

		$tp_tilt_parallax = ! empty( $settings['plus_tilt_parallax'] ) ? $settings['plus_tilt_parallax'] : '';

		if ( 'yes' === $tp_tilt_parallax ) {

			$hover_tilt = 'js-tilt';
			$tilt_scale = ! empty( $settings['plus_tilt_opt_tilt_scale']['size'] ) ? $settings['plus_tilt_opt_tilt_scale']['size'] : 1.1;
			$tilt_max   = ! empty( $settings['plus_tilt_opt_tilt_max']['size'] ) ? $settings['plus_tilt_opt_tilt_max']['size'] : 20;
			$tilt_speed = ! empty( $settings['plus_tilt_opt_tilt_speed']['size'] ) ? $settings['plus_tilt_opt_tilt_speed']['size'] : 400;

			$tilt_perspective = ! empty( $settings['plus_tilt_opt_tilt_perspective']['size'] ) ? $settings['plus_tilt_opt_tilt_perspective']['size'] : 400;

			$this->add_render_attribute( '_tilt_parallax', 'data-tilt', '', true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-scale', $tilt_scale, true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-max', $tilt_max, true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-perspective', $tilt_perspective, true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-speed', $tilt_speed, true );

			// not use.
			if ( 'custom' !== $settings['plus_tilt_opt_tilt_easing'] ) {
				$easing_tilt = $settings['plus_tilt_opt_tilt_easing'];
			} elseif ( 'custom' === $settings['plus_tilt_opt_tilt_easing'] ) {
				$easing_tilt = $settings['plus_tilt_opt_tilt_easing_custom'];
			} else {
				$easing_tilt = 'cubic-bezier(.03,.98,.52,.99)';
			}

			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-easing', $easing_tilt, true );
		}

		$move_parallax_attr = '';

		$move_parallax = '';
		$parallax_move = '';

		$tp_mouse_move = ! empty( $settings['plus_mouse_move_parallax'] ) ? $settings['plus_mouse_move_parallax'] : '';

		if ( 'yes' === $tp_mouse_move ) {
			$move_parallax = 'pt-plus-move-parallax';
			$parallax_move = 'parallax-move';

			$parallax_speed_x = ! empty( $settings['plus_mouse_parallax_speed_x']['size'] ) ? $settings['plus_mouse_parallax_speed_x']['size'] : 30;
			$parallax_speed_y = ! empty( $settings['plus_mouse_parallax_speed_y']['size'] ) ? $settings['plus_mouse_parallax_speed_y']['size'] : 30;

			$move_parallax_attr .= ' data-move_speed_x="' . esc_attr( $parallax_speed_x ) . '" ';
			$move_parallax_attr .= ' data-move_speed_y="' . esc_attr( $parallax_speed_y ) . '" ';
		}

		$reveal_effects = '';
		$effect_attr    = '';

		$tp_overlay_effect = ! empty( $settings['plus_overlay_effect'] ) ? $settings['plus_overlay_effect'] : '';

		if ( 'yes' === $tp_overlay_effect ) {
			$effect_rand_no = uniqid( 'reveal' );

			$color_1 = ! empty( $settings['plus_overlay_spcial_effect_color_1'] ) ? $settings['plus_overlay_spcial_effect_color_1'] : '#313131';
			$color_2 = ! empty( $settings['plus_overlay_spcial_effect_color_2'] ) ? $settings['plus_overlay_spcial_effect_color_2'] : '#ff214f';

			$effect_attr   .= ' data-reveal-id="' . esc_attr( $effect_rand_no ) . '" ';
			$effect_attr   .= ' data-effect-color-1="' . esc_attr( $color_1 ) . '" ';
			$effect_attr   .= ' data-effect-color-2="' . esc_attr( $color_2 ) . '" ';
			$reveal_effects = ' pt-plus-reveal ' . esc_attr( $effect_rand_no ) . ' ';
		}

		$continuous_animation = '';

		$coni_ani = ! empty( $settings['plus_continuous_animation'] ) ? $settings['plus_continuous_animation'] : '';

		if ( 'yes' === $coni_ani ) {

			$tp_ani_hover = ! empty( $settings['plus_animation_hover'] ) ? $settings['plus_animation_hover'] : '';
			if ( 'yes' === $tp_ani_hover ) {
				$animation_class = 'hover_';
			} else {
				$animation_class = 'image-';
			}

			$tp_ani_effect        = ! empty( $settings['plus_animation_effect'] ) ? $settings['plus_animation_effect'] : 'pulse';
			$continuous_animation = $animation_class . $tp_ani_effect;
		}

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$PlusExtra_Class = 'plus-adv-text-widget';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$content_image = '';

		$img_id = $settings['image']['id'];

		$image_altn = 'image info';

		$choose_image = ! empty( $settings['image'] ) ? $settings['image'] : '';

		if ( ! empty( $choose_image['url'] ) ) {
			$imageidn = $choose_image['id'];

			$image_altn = get_post_meta( $imageidn, '_wp_attachment_image_alt', true );
			if ( ! $image_altn ) {
				$image_altn = get_the_title( $imageidn );
			}

			$this->add_render_attribute( 'image', 'src', $choose_image['url'] );
			$this->add_render_attribute( 'image', 'class', 'hover__img info_img' );
			$content_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
		} else {
			$content_image .= theplus_loading_image_grid( get_the_ID() );
		}

		$scroll_image = '';
		$scroll_img   = ! empty( $settings['scroll_image_effect'] ) ? $settings['scroll_image_effect'] : '';

		if ( 'yes' === $scroll_img ) {

			$this->add_render_attribute( 'scroll-image', 'style', 'background-image: url(' . esc_url( $settings['image']['url'] ) . ');' );
			$content_image = '<div class="creative-scroll-image" ' . $this->get_render_attribute_string( 'scroll-image' ) . '></div>';
			$scroll_image  = 'scroll-image-wrap';
		}

		$img_link = ! empty( $settings['link'] ) ? $settings['link'] : '';

		if ( ! empty( $img_link['url'] ) ) {

			$this->add_render_attribute( 'link', 'href', esc_url( $img_link['url'] ) );

			if ( $img_link['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $img_link['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		$mask_image  = '';
		$mask_imgset = ! empty( $settings['mask_image_display'] ) ? $settings['mask_image_display'] : '';

		if ( 'yes' === $mask_imgset ) {
			$mask_image = ' creative-mask-media';
		}

		$wrapper_class = 'vc_single_image-wrapper ' . esc_attr( $mask_image ) . ' ' . esc_attr( $scroll_image );
		if ( 'creative-simple-image' === $animated_style ) {
			$wrapper_class = 'vc_single_image-wrapper ' . esc_attr( $mask_image ) . ' ' . esc_attr( $scroll_image );
		}

		$data_image = '';
		if ( ! empty( $img_id ) ) {
			$full_image = wp_get_attachment_image_src( $img_id, 'full' );
			$data_image = 'background:url(' . ( isset( $full_image[0] ) ? esc_url( $full_image[0] ) : Utils::get_placeholder_image_src() ) . ') #f7f7f7;';
		} else {
			$data_image = theplus_loading_image_grid( '', 'background' );
		}

		if ( ! empty( $img_link['url'] ) ) {

			if ( 'animate-image' === $animated_style ) {
				$html = '<a aria-label="' . $image_altn . '" ' . $this->get_render_attribute_string( 'link' ) . ' class="' . esc_attr( $wrapper_class ) . ' pt-plus-bg-image-animated ' . esc_attr( $animated_direction ) . '" style="' . esc_attr( $data_image ) . '" >' . $content_image . '</a>';
			} else {
				$html = '<a aria-label="' . $image_altn . '" ' . $this->get_render_attribute_string( 'link' ) . ' class="' . esc_attr( $wrapper_class ) . ' ' . esc_attr( $reveal_effects ) . ' " ' . $effect_attr . '>' . $content_image . '</a>';
			}
		} elseif ( 'animate-image' === $animated_style ) {
			$html = '<div class="' . esc_attr( $wrapper_class ) . ' pt-plus-bg-image-animated ' . esc_attr( $animated_direction ) . '" style="' . esc_attr( $data_image ) . '" >' . $content_image . '</div>';
		} else {
			$html = '<div class="' . esc_attr( $wrapper_class ) . ' ' . esc_attr( $reveal_effects ) . '" ' . $effect_attr . '>' . $content_image . '</div>';
		}

		$uid      = uniqid( 'bg-image' );
		$css_rule = '';
		$css_data = '';

		if ( 'animate-image' === $animated_style ) {
			$bg_animated = ' background-image-animated ';
			$bg_anim     = ' bg-img-animated ';

			$animated_class = 'animate-general';
			$css_data       = '.' . esc_attr( $uid ) . ' .pt-plus-bg-image-animated:after{background:' . esc_attr( $settings['bg_color'] ) . ';}';
		} else {
			$bg_animated = '';
			$bg_anim     = '';
		}

		$css_class  = '';
		$css_class  = ' text-' . esc_attr( $settings['alignment'] ) . ' ' . esc_attr( $animated_class );
		$css_class .= ! empty( $settings['alignment_tablet'] ) ? ' text--tablet' . esc_attr( $settings['alignment_tablet'] ) : '';
		$css_class .= ! empty( $settings['alignment_mobile'] ) ? ' text--mobile' . esc_attr( $settings['alignment_mobile'] ) : '';

		$parallax_image_scroll = '';

		$sup_parallax = ! empty( $settings['bg_image_parallax'] ) ? $settings['bg_image_parallax'] : '';

		if ( 'yes' === $sup_parallax && 'creative-simple-image' === $animated_style ) {
			$parallax_image_scroll = 'section-parallax-img';

			$html .= '<figure class="creative-simple-img-parallax" data-scroll-parallax="' . esc_attr( $settings['super_scroll_parallax']['size'] ) . '"><figure class="pt-plus-parallax-img-parent"><div class="parallax-img-container">';

			$image = wp_get_attachment_image_src( $img_id, 'full' );

			$html .= '<img class="simple-parallax-img" src="' . ( isset( $image[0] ) ? esc_url( $image[0] ) : Utils::get_placeholder_image_src() ) . '"  title="">';

			$html .= '</div></figure></figure>';
		}

		$uid_widget = uniqid( 'plus' );
		if ( 'creative-simple-image' === $animated_style || 'animate-image' === $animated_style ) {
			$output = '<div id="' . esc_attr( $uid_widget ) . '" class="pt-plus-animated-image-wrapper   ' . esc_attr( $magic_class ) . ' ' . esc_attr( $visiblity_hide ) . '  ' . esc_attr( $continuous_animation ) . '" ' . $this->get_render_attribute_string( '_tooltip' ) . '>';

				$output .= '<div class="animated-image-parallax  ' . esc_attr( $move_parallax ) . ' ' . esc_attr( $parallax_scroll ) . '" ' . $magic_attr . '>';

				$output .= '<div class="pt_plus_animated_image ' . esc_attr( $uid ) . ' ' . trim( $css_class ) . ' ' . esc_attr( $bg_anim ) . ' " ' . $animation_attr . ' > <figure class="' . esc_attr( $parallax_image_scroll ) . ' ' . esc_attr( $bg_animated ) . ' ' . esc_attr( $parallax_move ) . '  ' . esc_attr( $hover_tilt ) . ' " ' . $this->get_render_attribute_string( '_tilt_parallax' ) . ' ' . $move_parallax_attr . '>' . wp_kses_post( $html ) . ' </figure> </div>';

				$output .= '</div>';

			$output .= '</div>';
		}

		$inline_tippy_js = '';
		if ( 'yes' === $tp_tooltip ) {
			$inline_tippy_js = 'jQuery( document ).ready(function() {
				"use strict";
					if( typeof tippy === "function" ){
						tippy( "#' . esc_attr( $uid_widget ) . '" , {
							arrowType : "' . esc_attr( $tooltip_arrowtype ) . '",
							duration : [' . esc_attr( $tooltip_duration_in ) . ',' . esc_attr( $tooltip_duration_out ) . '],
							trigger : "' . esc_attr( $tooltip_trigger ) . '",
							appendTo: document.querySelector("#' . esc_attr( $uid_widget ) . '")
						});
					}
				});';

			$output .= wp_print_inline_script_tag( $inline_tippy_js );
		}

		$css_rule = '';
		if ( ! empty( $css_data ) ) {
			$css_rule  = '<style >';
			$css_rule .= esc_attr( $css_data );
			$css_rule .= '</style>';
		}

		echo $before_content . $css_rule . $output . $after_content;
	}
}
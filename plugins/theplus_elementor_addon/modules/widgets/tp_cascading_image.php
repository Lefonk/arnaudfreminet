<?php
/**
 * Widget Name: Cascading Image/Text
 * Description: cascading multiple image/Text creative effects.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 *  @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Cascading_Image.
 */
class ThePlus_Cascading_Image extends Widget_Base {

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
		return 'tp-cascading-image';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Image Cascading', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-object-group theplus_backend_icon';
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
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keyword.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Image', 'Cascading', 'Image Cascading', 'Image Gallery', 'Image Grid', 'Image Masonry', 'Image Stack', 'Image Layout', 'Elementor Image', 'Elementor Image Cascading', 'Elementor Image Gallery', 'Elementor Image Grid', 'Elementor Image Masonry', 'Elementor Image Stack', 'Elementor Image Layout' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Image Cascading', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'layer_position',
			array(
				'label' => esc_html__( 'Layer Position', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$repeater->start_controls_tabs( 'responsive_device' );
		$repeater->start_controls_tab(
			'normal',
			array(
				'label' => esc_html__( 'Desktop', 'theplus' ),
			)
		);

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
		$repeater->add_control(
			'd_pos_width',
			array(
				'label'     => esc_html__( 'Width', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => 'px',
					'size' => 150,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 2,
					),
				),
				'separator' => 'after',
			)
		);
		$repeater->end_controls_tab();

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
		$repeater->add_control(
			't_pos_width',
			array(
				'label'     => esc_html__( 'Width', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => 'px',
					'size' => '',
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 2,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();

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
		$repeater->add_control(
			'm_pos_width',
			array(
				'label'     => esc_html__( 'Width', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => 'px',
					'size' => '',
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 2,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'select_option',
			array(
				'label'     => esc_html__( 'Layer Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'image',
				'options'   => array(
					'image'  => esc_html__( 'Image', 'theplus' ),
					'text'   => esc_html__( 'Text Content', 'theplus' ),
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
			'multiple_image',
			array(
				'label'     => esc_html__( 'Image Select', 'theplus' ),
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
				'name'      => 'image',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'text_content',
			array(
				'label'     => esc_html__( 'Text Content', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'ThePlus Addons', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_content_typography',
				'label'     => esc_html__( 'Text Typography', 'theplus' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content a',
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);

		$repeater->add_control(
			'text_content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content a' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->add_control(
			'text_content_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}}:hover .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}}:hover .cascading-inner-content a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'text_content_bg',
				'label'     => esc_html__( 'Text Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content',
				'separator' => 'before',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->add_control(
			'text_content_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_content_shadow',
				'label'     => esc_html__( 'Text Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content',
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'text' ),
				),
			)
		);
		$repeater->add_control(
			'extra_options',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_control(
			'image_effect',
			array(
				'label'     => esc_html__( 'Continues Effect', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''                 => esc_html__( 'None', 'theplus' ),
					'pulse'            => esc_html__( 'Pulse', 'theplus' ),
					'floating'         => esc_html__( 'Floating', 'theplus' ),
					'tossing'          => esc_html__( 'Tossing', 'theplus' ),
					'rotate-continue'  => esc_html__( 'Rotating', 'theplus' ),
					'continue-scale'   => esc_html__( 'Kenburns Scale', 'theplus' ),
					'hover-scale'      => esc_html__( 'Hover Scale', 'theplus' ),
					'drop-waves'       => esc_html__( 'Drop Waves', 'theplus' ),
					'hover-drop-waves' => esc_html__( 'Hover Drop Waves', 'theplus' ),
				),
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_control(
			'drop_waves_color',
			array(
				'label'     => esc_html__( 'Drop Wave Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.hover-drop-waves:after,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content.hover-drop-waves:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
					'image_effect'  => array( 'drop-waves', 'hover-drop-waves' ),
				),
			)
		);
		$repeater->add_control(
			'mask_image_display',
			array(
				'label'     => wp_kses_post( "Mask Image Shape <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-mask-on-images-in-elementor-image-cascading-widget/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'separator'   => 'before',
				'description' => esc_html__( 'Use PNG image with the shape you want to mask around Media Image.', 'theplus' ),
				'condition'   => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_control(
			'mask_shape_image',
			array(
				'label'       => esc_html__( 'Mask Image', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array(
					'url' => '',
				),
				'description' => esc_html__( 'Use PNG image with the shape you want to mask around feature image.', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content' => 'mask-image: url({{URL}});-webkit-mask-image: url({{URL}});',
				),
				'condition'   => array(
					'mask_image_display' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'mask_image_shadow',
			array(
				'label'       => esc_html__( 'Image Shadow', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}},{{WRAPPER}} .cascading-text{{CURRENT_ITEM}}' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				),
				'render_type' => 'ui',
				'condition'   => array(
					'mask_image_display' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'css_background_filter',
			array(
				'label'        => esc_html__( 'CSS Background Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'condition'    => array(
					'select_option' => 'text',
				),
			)
		);
		$repeater->add_responsive_control(
			'css_background_width',
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
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'select_option'         => 'text',
					'css_background_filter' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'css_background_height',
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
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'select_option'         => 'text',
					'css_background_filter' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'box_bg_bf_blur',
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
					'select_option'         => 'text',
					'css_background_filter' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'box_bg_bf_grayscale',
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
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content' => '-webkit-backdrop-filter:grayscale({{box_bg_bf_grayscale.SIZE}})  blur({{box_bg_bf_blur.SIZE}}{{box_bg_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{box_bg_bf_grayscale.SIZE}})  blur({{box_bg_bf_blur.SIZE}}{{box_bg_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'select_option'         => 'text',
					'css_background_filter' => 'yes',
				),
			)
		);
		$repeater->end_popover();

		$repeater->add_control(
			'loop_magic_scroll',
			array(
				'label'     => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Scroll Options', 'theplus' ),
				'name'        => 'loop_scroll_option',
				'render_type' => 'template',
				'condition'   => array(
					'loop_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$repeater->start_controls_tabs( 'loop_tab_magic_scroll' );
		$repeater->start_controls_tab(
			'loop_tab_scroll_from',
			array(
				'label'     => esc_html__( 'Initial', 'theplus' ),
				'condition' => array(
					'loop_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label'     => esc_html__( 'Initial Position', 'theplus' ),
				'name'      => 'loop_scroll_from',
				'condition' => array(
					'loop_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'loop_tab_scroll_to',
			array(
				'label'     => esc_html__( 'Final', 'theplus' ),
				'condition' => array(
					'loop_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label'     => esc_html__( 'Final Position', 'theplus' ),
				'name'      => 'loop_scroll_to',
				'condition' => array(
					'loop_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'plus_tooltip',
			array(
				'label'     => esc_html__( 'Tooltip', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			)
		);

		$repeater->start_controls_tabs( 'plus_tooltip_tabs' );

		$repeater->start_controls_tab(
			'plus_tooltip_content_tab',
			array(
				'label'     => esc_html__( 'Content', 'theplus' ),
				'condition' => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_type',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal_desc',
				'options'   => array(
					'normal_desc'     => esc_html__( 'Content Text', 'theplus' ),
					'content_wysiwyg' => esc_html__( 'Content WYSIWYG', 'theplus' ),
				),
				'condition' => array(
					'plus_tooltip' => 'yes',
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
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip_content_wysiwyg',
			array(
				'label'     => esc_html__( 'Tooltip Content', 'theplus' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'condition' => array(
					'plus_tooltip_content_type' => 'content_wysiwyg',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$repeater->add_control(
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
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'plus_tooltip_content_typography',
				'selector'  => '{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content',
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
					'plus_tooltip'              => 'yes',
				),
			)
		);

		$repeater->add_control(
			'plus_tooltip_content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content p,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'plus_tooltip_styles_tab',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'condition' => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
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
		$repeater->add_group_control(
			\Theplus_Loop_Tooltips_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Style Options', 'theplus' ),
				'name'        => 'tooltip_style',
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();
		$repeater->add_control(
			'special_effect',
			array(
				'label'     => esc_html__( 'Special Effect', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_control(
			'effect_color_1',
			array(
				'label'     => esc_html__( 'Effect Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'condition' => array(
					'special_effect' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'effect_color_2',
			array(
				'label'     => esc_html__( 'Effect Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff214f',
				'condition' => array(
					'special_effect' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'cascading_move_parallax',
			array(
				'label'     => esc_html__( 'Parallax Move', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_control(
			'cascading_move_speed_x',
			array(
				'label'     => esc_html__( 'Move Parallax (X)', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 30,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 2,
					),
				),
				'condition' => array(
					'cascading_move_parallax' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'cascading_move_speed_y',
			array(
				'label'     => esc_html__( 'Move Parallax (Y)', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 30,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 2,
					),
				),
				'condition' => array(
					'cascading_move_parallax' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'hover_parallax',
			array(
				'label'     => esc_html__( 'On Hover Tilt', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'select_option' => array( 'image', 'text' ),
				),
			)
		);
		$repeater->add_control(
			'parallax_translatez',
			array(
				'label'     => esc_html__( 'TranslateZ', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => 'px',
					'size' => 30,
				),
				'range'     => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 2,
					),
				),
				'condition' => array(
					'hover_parallax' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'link_option',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Link /Popup', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
				'options'   => array(
					''            => esc_html__( 'Select Option', 'theplus' ),
					'normal_link' => esc_html__( 'Link', 'theplus' ),
					'popup_link'  => esc_html__( 'Popup', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'image_link',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'separator'     => 'after',
				'condition'     => array(
					'link_option' => array( 'normal_link' ),
				),
			)
		);
		$repeater->add_control(
			'popup_content',
			array(
				'label'         => esc_html__( 'Popup Content', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://www.youtube.com/embed/2ReiWfKUxIM', 'theplus' ),
				'show_external' => false,
				'description'   => esc_html__( 'Enter direct link of Youtube,Vimeo, Google Map or any other.', 'theplus' ),
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
				),
				'separator'     => 'after',
				'condition'     => array(
					'link_option' => array( 'popup_link' ),
				),
			)
		);
		$repeater->start_controls_tabs( 'nav_shadow_style' );
		$repeater->start_controls_tab(
			'nav_shadow_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'overlay_background',
			array(
				'label'     => esc_html__( 'Overlay Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'img_shadow',
				'selector'  => '{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-image-inner',
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'opacity_normal',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 1,
				),
				'range'     => array(
					'%' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'transform_css',
			array(
				'label'       => esc_html__( 'Transform css', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};transform-style: preserve-3d;-ms-transform-style: preserve-3d;-moz-transform-style: preserve-3d;-webkit-transform-style: preserve-3d;',
				),
				'condition'   => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-image-inner,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.hover-drop-waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'nav_shadow_active',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'hover_overlay_background',
			array(
				'label'     => esc_html__( 'Overlay Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content:hover:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'img_hover_shadow',
				'selector'  => '{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover',
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'opacity_hover',
			array(
				'label'     => esc_html__( 'Hover Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 1,
				),
				'range'     => array(
					'%' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'transform_hover_css',
			array(
				'label'       => esc_html__( 'Transform Hover css', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};',
				),
				'condition'   => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'border_radius_hover',
			array(
				'label'      => esc_html__( 'Border Radius Hover', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover .cascading-inner-content:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover .cascading-inner-content.hover-drop-waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'responsive_visible_opt',
			array(
				'label'     => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'select_option' => array( 'image' ),
				),
			)
		);
		$repeater->add_control(
			'desktop_opt',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'select_option'          => array( 'image' ),
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'tablet_opt',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'select_option'          => array( 'image' ),
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'mobile_opt',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'select_option'          => array( 'image' ),
					'responsive_visible_opt' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_cascading',
			array(
				'label'       => esc_html__( 'Add Multiple Cascading Sections', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'description' => 'Add Cascading Sections with Positions.',
				'default'     => array(
					array(
						'select_option' => 'image',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{select_option}}}',
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'styling_section',
			array(
				'label' => esc_html__( 'Styling', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_responsive_control(
			'min_height',
			array(
				'label'     => esc_html__( 'Minimum Height', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 400,
				),
				'range'     => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
				),
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_animated_image.cascading-block' => 'min-height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'slide_show',
			array(
				'label'   => esc_html__( 'Slide Show', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'slide_change_opt',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'SlideShow Type', 'theplus' ),
				'default'   => 'onclick',
				'options'   => array(
					'onclick'     => esc_html__( 'On Click', 'theplus' ),
					'setinterval' => esc_html__( 'Autoplay', 'theplus' ),
				),
				'condition' => array(
					'slide_show' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'interval_time',
			array(
				'type'      => Controls_Manager::TEXT,
				'label'     => esc_html__( 'Autoplay Duration', 'theplus' ),
				'default'   => 4000,
				'condition' => array(
					'slide_show'       => array( 'yes' ),
					'slide_change_opt' => array( 'setinterval' ),
				),
			)
		);
		$this->add_control(
			'section_overflow_desktop',
			array(
				'label'       => esc_html__( 'Overflow Hidden (Desktop)', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'separator'   => 'before',
				'description' => esc_html__( 'You can setup over flow hidden option if your section is going out and having unwanted scrollbar.', 'theplus' ),
			)
		);
		$this->add_control(
			'section_overflow_tablet',
			array(
				'label'   => esc_html__( 'Overflow Hidden (Tablet)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'section_overflow_mobile',
			array(
				'label'   => esc_html__( 'Overflow Hidden (Mobile)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label' => esc_html__( 'Lottie', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'size' => 100,
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
					'size' => 100,
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

		$this->start_controls_tabs( 'style_tabs' );
		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'textdomain' ),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'custom_css_filters',
				'selector' => '{{WRAPPER}} .cascading-inner-loop .cascading-image-inner',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'textdomain' ),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'custom_css_filters1',
				'selector' => '{{WRAPPER}} .cascading-inner-loop .cascading-image-inner:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Casceding image Render.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$overflow_attr = '';
		$uid_cascading = uniqid( 'cascading_' );

		$uid  = uniqid( 'slide' );
		$attr = '';

		$wrapper_class = '';

		$overflow_attr .= ( ! empty( $settings['section_overflow_desktop'] ) && 'yes' === $settings['section_overflow_desktop'] ) ? ' data-overflow-desktop="yes"' : '';
		$overflow_attr .= ( ! empty( $settings['section_overflow_tablet'] ) && 'yes' === $settings['section_overflow_tablet'] ) ? ' data-overflow-tablet="yes"' : '';
		$overflow_attr .= ( ! empty( $settings['section_overflow_mobile'] ) && 'yes' === $settings['section_overflow_mobile'] ) ? ' data-overflow-mobile="yes"' : '';

		if ( ! empty( $settings['slide_show'] ) && 'yes' === $settings['slide_show'] ) {
			$wrapper_class .= ' slide_show_image ' . esc_attr( $uid );

			$attr .= ' data-play="' . esc_attr( $settings['slide_change_opt'] ) . '"';
			$attr .= ' data-uid="' . esc_attr( $uid ) . '"';
			$attr .= ' data-interval_time="' . esc_attr( $settings['interval_time'] ) . '"';
		}

		$cascading_loop = '';

		$css_loop   = '';
		$hover_tilt = '';

		$ij = 0;

		if ( ! empty( $settings['image_cascading'] ) ) {
			$position = '';
			$effects  = '';

			$animate_speed = '';
			$parallax_move = '';

			$move_parallax_attr      = '';
			$cascading_move_parallax = '';

			foreach ( $settings['image_cascading'] as $item ) {

				$visiblity_hide = '';
				if ( ! empty( $item['responsive_visible_opt'] ) && 'yes' === $item['responsive_visible_opt'] ) {
					$visiblity_hide .= ( ( 'yes' !== $item['desktop_opt'] && empty( $item['desktop_opt'] ) ) ? 'hide-desktop ' : '' );
					$visiblity_hide .= ( ( 'yes' !== $item['tablet_opt'] && empty( $item['tablet_opt'] ) ) ? 'hide-tablet ' : '' );
					$visiblity_hide .= ( ( 'yes' !== $item['mobile_opt'] && empty( $item['mobile_opt'] ) ) ? 'hide-mobile ' : '' );
				}

				$mask_image = '';
				if ( ! empty( $item['mask_image_display'] ) && 'yes' === $item['mask_image_display'] ) {
					$mask_image = ' creative-mask-media';
				}

				$image_effect = '';
				if ( ! empty( $item['image_effect'] ) ) {
					if ( 'pulse' === $item['image_effect'] ) {
						$image_effect = 'tp-pulse';
					} else {
						$image_effect = $item['image_effect'];
					}
				}

				$magic_class = '';
				$magic_attr  = '';

				$parallax_scroll = '';

				if ( ! empty( $item['loop_magic_scroll'] ) && 'yes' === $item['loop_magic_scroll'] ) {

					if ( empty( $item['loop_scroll_option_popover_toggle'] ) ) {
						$scroll_offset   = 0;
						$scroll_duration = 300;
					} else {
						$scroll_offset   = isset( $item['loop_scroll_option_scroll_offset'] ) ? $item['loop_scroll_option_scroll_offset'] : 0;
						$scroll_duration = isset( $item['loop_scroll_option_scroll_duration'] ) ? $item['loop_scroll_option_scroll_duration'] : 300;
					}

					if ( empty( $item['loop_scroll_from_popover_toggle'] ) ) {
						$scroll_x_from = 0;
						$scroll_y_from = 0;

						$scroll_opacity_from = 1;
						$scroll_scale_from   = 1;
						$scroll_rotate_from  = 0;
					} else {
						$scroll_x_from = ( isset( $item['loop_scroll_from_scroll_x_from'] ) ? $item['loop_scroll_from_scroll_x_from'] : 0 );
						$scroll_y_from = ( isset( $item['loop_scroll_from_scroll_y_from'] ) ? $item['loop_scroll_from_scroll_y_from'] : 0 );

						$scroll_opacity_from = ( isset( $item['loop_scroll_from_scroll_opacity_from'] ) ? $item['loop_scroll_from_scroll_opacity_from'] : 1 );
						$scroll_scale_from   = ( isset( $item['loop_scroll_from_scroll_scale_from'] ) ? $item['loop_scroll_from_scroll_scale_from'] : 1 );
						$scroll_rotate_from  = ( isset( $item['loop_scroll_from_scroll_rotate_from'] ) ? $item['loop_scroll_from_scroll_rotate_from'] : 0 );
					}
					if ( empty( $item['loop_scroll_to_popover_toggle'] ) ) {
						$scroll_x_to = 0;
						$scroll_y_to = -50;

						$scroll_opacity_to = 1;
						$scroll_scale_to   = 1;
						$scroll_rotate_to  = 0;
					} else {
						$scroll_x_to = ( isset( $item['loop_scroll_to_scroll_x_to'] ) ? $item['loop_scroll_to_scroll_x_to'] : 0 );
						$scroll_y_to = ( isset( $item['loop_scroll_to_scroll_y_to'] ) ? $item['loop_scroll_to_scroll_y_to'] : -50 );

						$scroll_opacity_to = ( isset( $item['loop_scroll_to_scroll_opacity_to'] ) ? $item['loop_scroll_to_scroll_opacity_to'] : 1 );
						$scroll_scale_to   = ( isset( $item['loop_scroll_to_scroll_scale_to'] ) ? $item['loop_scroll_to_scroll_scale_to'] : 1 );
						$scroll_rotate_to  = ( isset( $item['loop_scroll_to_scroll_rotate_to'] ) ? $item['loop_scroll_to_scroll_rotate_to'] : 0 );
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
					$magic_class     .= ' magic-scroll ';
				}

				$_tooltip = '_tooltip' . $ij;

				if ( 'yes' === $item['plus_tooltip'] ) {

					$this->add_render_attribute( $_tooltip, 'data-tippy', '', true );

					if ( ! empty( $item['plus_tooltip_content_type'] ) && 'normal_desc' === $item['plus_tooltip_content_type'] ) {
						$this->add_render_attribute( $_tooltip, 'title', wp_kses_post( $item['plus_tooltip_content_desc'] ), true );
					} elseif ( ! empty( $item['plus_tooltip_content_type'] ) && 'content_wysiwyg' === $item['plus_tooltip_content_type'] ) {
						$tooltip_content = $item['plus_tooltip_content_wysiwyg'];
						$this->add_render_attribute( $_tooltip, 'title', wp_kses_post( $tooltip_content ), true );
					}

					$plus_tooltip_position = ( ! empty( $item['tooltip_opt_plus_tooltip_position'] ) ) ? $item['tooltip_opt_plus_tooltip_position'] : 'top';
					$this->add_render_attribute( $_tooltip, 'data-tippy-placement', $plus_tooltip_position, true );

					$tooltip_interactive = ( isset( $item['tooltip_opt_plus_tooltip_interactive'] ) && 'yes' === $item['tooltip_opt_plus_tooltip_interactive'] ) ? 'true' : 'false';
					$this->add_render_attribute( $_tooltip, 'data-tippy-interactive', $tooltip_interactive, true );

					$plus_tooltip_theme = ( ! empty( $item['tooltip_opt_plus_tooltip_theme'] ) ) ? $item['tooltip_opt_plus_tooltip_theme'] : 'dark';
					$this->add_render_attribute( $_tooltip, 'data-tippy-theme', $plus_tooltip_theme, true );

					$tooltip_arrow = ( 'none' !== $item['tooltip_opt_plus_tooltip_arrow'] || empty( $item['tooltip_opt_plus_tooltip_arrow'] ) ) ? 'true' : 'false';
					$this->add_render_attribute( $_tooltip, 'data-tippy-arrow', $tooltip_arrow, true );

					$plus_tooltip_arrow = ( ! empty( $item['tooltip_opt_plus_tooltip_arrow'] ) ) ? $item['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
					$this->add_render_attribute( $_tooltip, 'data-tippy-arrowtype', $plus_tooltip_arrow, true );

					$plus_tooltip_animation = ( ! empty( $item['tooltip_opt_plus_tooltip_animation'] ) ) ? $item['tooltip_opt_plus_tooltip_animation'] : 'shift-toward';
					$this->add_render_attribute( $_tooltip, 'data-tippy-animation', $plus_tooltip_animation, true );

					$plus_tooltip_x_offset = ( ! empty( $item['tooltip_opt_plus_tooltip_x_offset'] ) ) ? $item['tooltip_opt_plus_tooltip_x_offset'] : 0;
					$plus_tooltip_y_offset = ( ! empty( $item['tooltip_opt_plus_tooltip_y_offset'] ) ) ? $item['tooltip_opt_plus_tooltip_y_offset'] : 0;
					$this->add_render_attribute( $_tooltip, 'data-tippy-offset', $plus_tooltip_x_offset . ',' . $plus_tooltip_y_offset, true );

					$tooltip_duration_in  = ( ! empty( $item['tooltip_opt_plus_tooltip_duration_in'] ) ) ? $item['tooltip_opt_plus_tooltip_duration_in'] : 250;
					$tooltip_duration_out = ( ! empty( $item['tooltip_opt_plus_tooltip_duration_out'] ) ) ? $item['tooltip_opt_plus_tooltip_duration_out'] : 200;
					$tooltip_trigger      = ( ! empty( $item['tooltip_opt_plus_tooltip_triggger'] ) ) ? $item['tooltip_opt_plus_tooltip_triggger'] : 'mouseenter';
					$tooltip_arrowtype    = ( ! empty( $item['tooltip_opt_plus_tooltip_arrow'] ) ) ? $item['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
				}

				$rand_no = wp_rand( 1000000, 1500000 );

				if ( ! empty( $item['hover_parallax'] ) && 'yes' === $item['hover_parallax'] ) {
					$css_loop .= '.parallax-hover-' . esc_js( $rand_no ) . '{-webkit-transform:translateZ(' . esc_js( $item['parallax_translatez']['size'] . $item['parallax_translatez']['unit'] ) . ') !important;-ms-transform:translateZ(' . esc_js( $item['parallax_translatez']['size'] . $item['parallax_translatez']['unit'] ) . ') !important;-moz-transform:translateZ(' . esc_js( $item['parallax_translatez']['size'] . $item['parallax_translatez']['unit'] ) . ') !important;-o-transform:translateZ(' . esc_js( $item['parallax_translatez']['size'] . $item['parallax_translatez']['unit'] ) . ') !important; transform: translateZ(' . esc_js( $item['parallax_translatez']['size'] . $item['parallax_translatez']['unit'] ) . ') !important;}';
				}

				$move_parallax_attr = '';
				$parallax_move      = '';

				if ( ! empty( $item['cascading_move_parallax'] ) && 'yes' === $item['cascading_move_parallax'] ) {
					$cascading_move_parallax = 'pt-plus-move-parallax';

					$parallax_move = 'parallax-move';
					if ( ! empty( $item['cascading_move_speed_x']['size'] ) ) {
						$move_parallax_attr .= ' data-move_speed_x="' . esc_attr( $item['cascading_move_speed_x']['size'] ) . '" ';
					} else {
						$move_parallax_attr .= ' data-move_speed_x="0" ';
					}
					if ( ! empty( $item['cascading_move_speed_y']['size'] ) ) {
						$move_parallax_attr .= ' data-move_speed_y="' . esc_attr( $item['cascading_move_speed_y']['size'] ) . '" ';
					} else {
						$move_parallax_attr .= ' data-move_speed_y="0" ';
					}
				}

				$reveal_effects = '';
				$effect_attr    = '';
				if ( ! empty( $item['special_effect'] ) && 'yes' === $item['special_effect'] ) {
					$effect_rand_no = uniqid( 'reveal' );
					$effect_attr   .= ' data-reveal-id="' . esc_attr( $effect_rand_no ) . '" ';
					if ( ! empty( $item['effect_color_1'] ) ) {
						$effect_attr .= ' data-effect-color-1="' . esc_attr( $item['effect_color_1'] ) . '" ';
					} else {
						$effect_attr .= ' data-effect-color-1="#313131" ';
					}
					if ( ! empty( $item['effect_color_2'] ) ) {
						$effect_attr .= ' data-effect-color-2="' . esc_attr( $item['effect_color_2'] ) . '" ';
					} else {
						$effect_attr .= ' data-effect-color-2="#ff214f" ';
					}
					$reveal_effects = ' pt-plus-reveal ' . esc_attr( $effect_rand_no ) . ' ';
				}

				$target   = '';
				$nofollow = '';
				$urllink  = '';
				$uimg_id  = uniqid( 'img' ) . esc_attr( $ij );
				$uid_loop = uniqid( 'cascading' );
				if ( 'image' === $item['select_option'] ) {
					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$link_class = 'link-content';
					} else {
						$link_class = 'not-link-content';
					}
					if ( ! empty( $item['multiple_image']['id'] ) ) {
						$multiple_image = $item['multiple_image']['id'];
						$img_src        = tp_get_image_rander( $multiple_image, $item['image_size'], array( 'class' => 'parallax_image' ) );
						$content_image  = $img_src;

						$cascading_loop .= '<div id="' . esc_attr( $uid_loop ) . esc_attr( $ij ) . '" class="cascading-image hehe elementor-repeater-item-' . $item['_id'] . ' ' . esc_attr( $uimg_id ) . ' ' . esc_attr( $visiblity_hide ) . ' ' . esc_attr( $magic_class ) . ' ' . esc_attr( $parallax_move ) . '" ' . $this->get_render_attribute_string( $_tooltip ) . ' ' . $move_parallax_attr . '>';

							$cascading_loop .= '<div class="cascading-image-inner ' . esc_attr( $parallax_scroll ) . '" ' . $magic_attr . '>';

								$cic_bg          = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $item['text_content_bg_image'] ) : '';
								$cascading_loop .= '<div class="cascading-inner-content parallax-hover-' . esc_attr( $rand_no ) . ' ' . $image_effect . ' ' . esc_attr( $reveal_effects ) . ' ' . esc_attr( $link_class ) . ' ' . esc_attr( $mask_image ) . ' ' . $cic_bg . '" ' . $effect_attr . '>';

						if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
							$data_popup = '';
							if ( 'popup_link' === $item['link_option'] ) {
								$data_popup = 'data-lity=""';
							}
							if ( ! empty( $item['popup_content']['url'] ) && 'popup_link' === $item['link_option'] ) {
								$target   = $item['popup_content']['is_external'] ? '' : '';
								$nofollow = $item['popup_content']['nofollow'] ? ' rel="nofollow"' : '';
								$urllink  = $item['popup_content']['url'];
							}

							if ( ! empty( $item['image_link']['url'] ) && 'normal_link' === $item['link_option'] ) {
								$target   = $item['image_link']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $item['image_link']['nofollow'] ? ' rel="nofollow"' : '';
								$urllink  = $item['image_link']['url'];
							}
							$cascading_loop .= '<a href="' . esc_url( $urllink ) . '" ' . $target . $nofollow . ' ' . $data_popup . '>';
						}
						$cascading_loop .= $content_image;
						if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
							$cascading_loop .= '</a>';
						}
								$cascading_loop .= '</div>';
							$cascading_loop     .= '</div>';
						$cascading_loop         .= '</div>';

					}
				}
				if ( 'text' === $item['select_option'] ) {
						$text_content = $item['text_content'];
					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$link_class = 'link-content';
					} else {
						$link_class = 'not-link-content';
					}
						$cascading_loop .= '<div id="' . esc_attr( $uid_loop ) . esc_attr( $ij ) . '" class="cascading-text elementor-repeater-item-' . $item['_id'] . ' ' . esc_attr( $uimg_id ) . ' ' . esc_attr( $visiblity_hide ) . ' ' . esc_attr( $magic_class ) . ' ' . esc_attr( $parallax_move ) . '" ' . $this->get_render_attribute_string( $_tooltip ) . ' ' . $move_parallax_attr . '>';

							$cascading_loop .= '<div class="cascading-image-inner ' . esc_attr( $parallax_scroll ) . '" ' . $magic_attr . '>';

								$cic_bg1         = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $item['text_content_bg_image'] ) : '';
								$cascading_loop .= '<div class="cascading-inner-content parallax-hover-' . esc_attr( $rand_no ) . ' ' . $image_effect . ' ' . esc_attr( $reveal_effects ) . ' ' . esc_attr( $link_class ) . ' ' . esc_attr( $mask_image ) . ' ' . $cic_bg1 . '" ' . $effect_attr . '>';

					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$data_popup = '';
						if ( 'popup_link' === $item['link_option'] ) {
							$data_popup = 'data-lity=""';
						}
						if ( ! empty( $item['popup_content']['url'] ) && 'popup_link' === $item['link_option'] ) {
							$target   = $item['popup_content']['is_external'] ? '' : '';
							$nofollow = $item['popup_content']['nofollow'] ? ' rel="nofollow"' : '';
							$urllink  = $item['popup_content']['url'];
						}

						if ( ! empty( $item['image_link']['url'] ) && 'normal_link' === $item['link_option'] ) {
							$target   = $item['image_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['image_link']['nofollow'] ? ' rel="nofollow"' : '';
							$urllink  = $item['image_link']['url'];
						}
						$cascading_loop .= '<a href="' . esc_url( $urllink ) . '" ' . $target . $nofollow . ' ' . $data_popup . '>';
					}

					$cascading_loop .= $text_content;

					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$cascading_loop .= '</a>';
					}
								$cascading_loop .= '</div>';
							$cascading_loop     .= '</div>';
						$cascading_loop         .= '</div>';

				}
				if ( isset( $item['select_option'] ) && 'lottie' === $item['select_option'] ) {
					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$link_class = 'link-content';
					} else {
						$link_class = 'not-link-content';
					}
					$cascading_loop .= '<div id="' . esc_attr( $uid_loop ) . esc_attr( $ij ) . '" class="cascading-image elementor-repeater-item-' . $item['_id'] . ' ' . esc_attr( $uimg_id ) . ' ' . esc_attr( $visiblity_hide ) . ' ' . esc_attr( $magic_class ) . ' ' . esc_attr( $parallax_move ) . '" ' . $this->get_render_attribute_string( $_tooltip ) . ' ' . $move_parallax_attr . '>';

						$cascading_loop .= '<div class="cascading-image-inner ' . esc_attr( $parallax_scroll ) . '" ' . $magic_attr . '>';

								$cic_bg          = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $item['text_content_bg_image'] ) : '';
								$cascading_loop .= '<div class="cascading-inner-content parallax-hover-' . esc_attr( $rand_no ) . ' ' . $image_effect . ' ' . esc_attr( $reveal_effects ) . ' ' . esc_attr( $link_class ) . ' ' . esc_attr( $mask_image ) . ' ' . $cic_bg . '" ' . $effect_attr . '>';

					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$data_popup = '';
						if ( 'popup_link' === $item['link_option'] ) {
							$data_popup = 'data-lity=""';
						}
						if ( ! empty( $item['popup_content']['url'] ) && 'popup_link' === $item['link_option'] ) {
							$target   = $item['popup_content']['is_external'] ? '' : '';
							$nofollow = $item['popup_content']['nofollow'] ? ' rel="nofollow"' : '';
							$urllink  = $item['popup_content']['url'];
						}

						if ( ! empty( $item['image_link']['url'] ) && 'normal_link' === $item['link_option'] ) {
							$target   = $item['image_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['image_link']['nofollow'] ? ' rel="nofollow"' : '';
							$urllink  = $item['image_link']['url'];
						}
						$cascading_loop .= '<a href="' . esc_url( $urllink ) . '" ' . $target . $nofollow . ' ' . $data_popup . '>';
					}
					$ext = pathinfo( $item['lottieUrl']['url'], PATHINFO_EXTENSION );
					if ( 'json' !== $ext ) {
						$cascading_loop .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
					} else {
						$lottie_width  = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 100;
						$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 100;
						$lottie_speed  = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;
						$lottie_loop   = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : 'no';
						$lottiehover   = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';

						$lottie_loop_value = '';
						if ( ! empty( $settings['lottieLoop'] ) && 'yes' === $settings['lottieLoop'] ) {
							$lottie_loop_value = 'loop';
						}
						$lottie_anim = 'autoplay';
						if ( ! empty( $settings['lottiehover'] ) && 'yes' === $settings['lottiehover'] ) {
							$lottie_anim = 'hover';
						}
						$cascading_loop .= '<lottie-player src="' . esc_url( $item['lottieUrl']['url'] ) . '" style="width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px;" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
					}
					if ( 'normal_link' === $item['link_option'] || 'popup_link' === $item['link_option'] ) {
						$cascading_loop .= '</a>';
					}
								$cascading_loop .= '</div>';

							$cascading_loop .= '</div>';

					$cascading_loop .= '</div>';
				}

				$inline_tippy_js = '';

				if ( 'yes' === $item['plus_tooltip'] ) {
					$inline_tippy_js = 'jQuery( document ).ready(function() {
								"use strict";
									if(typeof tippy === "function"){
										tippy( "#' . esc_attr( $uid_loop ) . esc_attr( $ij ) . '" , {
											arrowType : "' . esc_attr( $tooltip_arrowtype ) . '",
											duration : [' . esc_attr( $tooltip_duration_in ) . ',' . esc_attr( $tooltip_duration_out ) . '],
											trigger : "' . esc_attr( $tooltip_trigger ) . '",
											appendTo: document.querySelector("#' . esc_attr( $uid_loop ) . esc_attr( $ij ) . '")
										});
									}
								});';
					$cascading_loop .= wp_print_inline_script_tag( $inline_tippy_js );
				}
				$rpos = 'auto';

				$bpos = 'auto';
				$ypos = 'auto';
				$xpos = 'auto';

				if ( 'yes' === $item['d_left_auto'] ) {
					if ( ! empty( $item['d_pos_xposition']['size'] ) || '0' == $item['d_pos_xposition']['size'] ) {
						$xpos = $item['d_pos_xposition']['size'] . $item['d_pos_xposition']['unit'];
					}
				}
				if ( 'yes' === $item['d_top_auto'] ) {
					if ( ! empty( $item['d_pos_yposition']['size'] ) || '0' == $item['d_pos_yposition']['size'] ) {
						$ypos = $item['d_pos_yposition']['size'] . $item['d_pos_yposition']['unit'];
					}
				}
				if ( 'yes' === $item['d_bottom_auto'] ) {
					if ( ! empty( $item['d_pos_bottomposition']['size'] ) || '0' == $item['d_pos_bottomposition']['size'] ) {
						$bpos = $item['d_pos_bottomposition']['size'] . $item['d_pos_bottomposition']['unit'];
					}
				}
				if ( 'yes' === $item['d_right_auto'] ) {
					if ( ! empty( $item['d_pos_rightposition']['size'] ) || '0' == $item['d_pos_rightposition']['size'] ) {
						$rpos = $item['d_pos_rightposition']['size'] . $item['d_pos_rightposition']['unit'];
					}
				}

				$d_max_width = '';

				if ( $item['d_pos_width']['size'] ) {
					$width       = $item['d_pos_width']['size'] . $item['d_pos_width']['unit'];
					$d_max_width = 'max-width:' . esc_attr( $width ) . ';';
				}
				if ( 'image' === $item['select_option'] || 'lottie' === $item['select_option'] ) {
					$css_loop .= '.cascading-image.' . esc_attr( $uimg_id ) . '{top:' . esc_attr( $ypos ) . ';bottom:' . esc_attr( $bpos ) . ';left:' . esc_attr( $xpos ) . ';right:' . esc_attr( $rpos ) . ';' . $d_max_width . 'margin: 0 auto;}';
				}
				if ( 'text' === $item['select_option'] ) {
					$css_loop .= '.cascading-text.' . esc_attr( $uimg_id ) . '{top:' . esc_attr( $ypos ) . ';bottom:' . esc_attr( $bpos ) . ';left:' . esc_attr( $xpos ) . ';right:' . esc_attr( $rpos ) . ';' . $d_max_width . 'margin: 0 auto;}';
				}
				if ( ! empty( $item['t_responsive'] ) && 'yes' === $item['t_responsive'] ) {
					$tablet_xpos = 'auto';
					$tablet_ypos = 'auto';
					$tablet_bpos = 'auto';
					$tablet_rpos = 'auto';
					if ( 'yes' === $item['t_left_auto'] ) {
						if ( ! empty( $item['t_pos_xposition']['size'] ) || '0' == $item['t_pos_xposition']['size'] ) {
							$tablet_xpos = $item['t_pos_xposition']['size'] . $item['t_pos_xposition']['unit'];
						}
					}
					if ( 'yes' === $item['t_top_auto'] ) {
						if ( ! empty( $item['t_pos_yposition']['size'] ) || '0' == $item['t_pos_yposition']['size'] ) {
							$tablet_ypos = $item['t_pos_yposition']['size'] . $item['t_pos_yposition']['unit'];
						}
					}
					if ( 'yes' === $item['t_bottom_auto'] ) {
						if ( ! empty( $item['t_pos_bottomposition']['size'] ) || '0' == $item['t_pos_bottomposition']['size'] ) {
							$tablet_bpos = $item['t_pos_bottomposition']['size'] . $item['t_pos_bottomposition']['unit'];
						}
					}
					if ( 'yes' === $item['t_right_auto'] ) {
						if ( ! empty( $item['t_pos_rightposition']['size'] ) || '0' == $item['t_pos_rightposition']['size'] ) {
							$tablet_rpos = $item['t_pos_rightposition']['size'] . $item['t_pos_rightposition']['unit'];
						}
					}
					$t_max_width = '';
					if ( $item['t_pos_width']['size'] ) {
						$width       = $item['t_pos_width']['size'] . $item['t_pos_width']['unit'];
						$t_max_width = 'max-width:' . esc_attr( $width ) . ';';
					}
					if ( 'image' === $item['select_option'] || 'lottie' === $item['select_option'] ) {
						$css_loop .= '@media (min-width:601px) and (max-width:990px){.cascading-image.' . esc_attr( $uimg_id ) . '{top:' . esc_attr( $tablet_ypos ) . ';bottom:' . esc_attr( $tablet_bpos ) . ';left:' . esc_attr( $tablet_xpos ) . ';right:' . esc_attr( $tablet_rpos ) . ';' . $t_max_width . 'margin: 0 auto;}}';
					}
					if ( 'text' === $item['select_option'] ) {
						$css_loop .= '@media (min-width:601px) and (max-width:990px){.cascading-text.' . esc_attr( $uimg_id ) . '{top:' . esc_attr( $tablet_ypos ) . ';bottom:' . esc_attr( $tablet_bpos ) . ';left:' . esc_attr( $tablet_xpos ) . ';right:' . esc_attr( $tablet_rpos ) . ';' . $t_max_width . 'margin: 0 auto;}}';
					}
				}
				if ( ! empty( $item['m_responsive'] ) && 'yes' === $item['m_responsive'] ) {
					$mobile_xpos = 'auto';
					$mobile_ypos = 'auto';
					$mobile_bpos = 'auto';
					$mobile_rpos = 'auto';

					if ( 'yes' === $item['m_left_auto'] ) {
						if ( ! empty( $item['m_pos_xposition']['size'] ) || '0' == $item['m_pos_xposition']['size'] ) {
							$mobile_xpos = $item['m_pos_xposition']['size'] . $item['m_pos_xposition']['unit'];
						}
					}

					if ( 'yes' === $item['m_top_auto'] ) {
						if ( ! empty( $item['m_pos_yposition']['size'] ) || '0' == $item['m_pos_yposition']['size'] ) {
							$mobile_ypos = $item['m_pos_yposition']['size'] . $item['m_pos_yposition']['unit'];
						}
					}

					if ( 'yes' === $item['m_bottom_auto'] ) {
						if ( ! empty( $item['m_pos_bottomposition']['size'] ) || '0' == $item['m_pos_bottomposition']['size'] ) {
							$mobile_bpos = $item['m_pos_bottomposition']['size'] . $item['m_pos_bottomposition']['unit'];
						}
					}

					if ( 'yes' === $item['m_right_auto'] ) {
						if ( ! empty( $item['m_pos_rightposition']['size'] ) || '0' == $item['m_pos_rightposition']['size'] ) {
							$mobile_rpos = $item['m_pos_rightposition']['size'] . $item['m_pos_rightposition']['unit'];
						}
					}

					$m_max_width = '';
					if ( $item['m_pos_width']['size'] ) {
						$width       = $item['m_pos_width']['size'] . $item['m_pos_width']['unit'];
						$m_max_width = 'max-width:' . esc_attr( $width ) . ';';
					}

					if ( 'image' === $item['select_option'] || 'lottie' === $item['select_option'] ) {
						$css_loop .= '@media (max-width:600px){.cascading-image.' . esc_attr( $uimg_id ) . '{top:' . esc_attr( $mobile_ypos ) . ';bottom:' . esc_attr( $mobile_bpos ) . ';left:' . esc_attr( $mobile_xpos ) . ';right:' . esc_attr( $mobile_rpos ) . ';' . $m_max_width . 'margin: 0 auto;}}';
					}

					if ( 'text' === $item['select_option'] ) {
						$css_loop .= '@media (max-width:600px){.cascading-text.' . esc_attr( $uimg_id ) . '{top:' . esc_attr( $mobile_ypos ) . ';bottom:' . esc_attr( $mobile_bpos ) . ';left:' . esc_attr( $mobile_xpos ) . ';right:' . esc_attr( $mobile_rpos ) . ';' . $m_max_width . 'margin: 0 auto;}}';
					}
				}

				if ( ! empty( $item['hover_parallax'] ) && 'yes' === $item['hover_parallax'] ) {
					$hover_tilt = 'hover-tilt';
				}

				++$ij;
			}
		}

		$output  = '<div class="pt_plus_animated_image cascading-block  wpb_single_image ' . esc_attr( $uid_cascading ) . ' ' . $wrapper_class . ' ' . esc_attr( $cascading_move_parallax ) . ' ' . esc_attr( $hover_tilt ) . '" ' . $attr . ' ' . $overflow_attr . '>';
		$output .= '<div class="cascading-inner-loop ">';
		$output .= $cascading_loop;
		$output .= '</div>';
		$output .= '</div>';

		$css_loop = '<style>' . $css_loop . '</style>';

		echo $output . $css_loop;
	}
}
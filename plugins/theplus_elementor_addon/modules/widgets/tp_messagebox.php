<?php
/**
 * Widget Name: Message Box
 * Description: Message Box
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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_MessageBox
 */
class ThePlus_MessageBox extends Widget_Base {

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
		return 'tp-messagebox';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Message Box', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-calendar-o theplus_backend_icon';
	}

	/**
	 * Get Widget Category.
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
		return array( 'Message Box', 'Alert Box', 'Notification Box', 'Info Box', 'Callout Box', 'Warning Box', 'Success Box', 'Error Box', 'Message Widget', 'Alert Widget', 'Notification Widget', 'Info Widget', 'Callout Widget', 'Warning Widget', 'Success Widget', 'Error Widget' );
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
	 * Register controls.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'message_box_content_section',
			array(
				'label' => esc_html__( 'Text Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'Title',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'This is alert need your attention', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Title', 'theplus' ),
				'label_block' => false,
				'ai' => array(
					'active' => false,
				),
			)
		);
		$this->add_control(
			'Description',
			array(
				'label'     => esc_html__( 'Description', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'descText',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I Am Text Block. Click Edit Button To Change This Text. Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Ut Elit Tellus, Luctus Nec Ullamcorper Mattis, Pulvinar Dapibus Leo.', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Description here', 'theplus' ),
				'condition'   => array(
					'Description' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'message_icnbtn_section',
			array(
				'label' => esc_html__( 'Icon & Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'icon',
			array(
				'label'     => esc_html__( 'Main Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'IconName',
			array(
				'label'     => esc_html__( 'Select Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fa fa-exclamation',
					'library' => 'solid',
				),
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);
		$this->add_control(
			'dismiss',
			array(
				'label'     => wp_kses_post( "Close Button <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-close-button-in-alert-box-message-box-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'dismsIcon',
			array(
				'label'     => esc_html__( 'Select Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-times-circle',
					'library' => 'solid',
				),
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'speed',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Closing Animation Duration', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 5000,
						'step' => 50,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'message_box_title_styling',
			array(
				'label' => esc_html__( 'Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'titleTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .msg-title',
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->add_responsive_control(
			'titleAdjust',
			array(
				'label'      => esc_html__( 'Title Adjust', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .msg-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'mesg_title_color' );
		$this->start_controls_tab(
			'title_color_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'titleNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .msg-title' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'titleNmlBg',
				'label'     => esc_html__( 'Background Type', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .msg-title',
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'titleNShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box .msg-title',
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_color_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'titleHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-title' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'titleHvrBg',
				'label'     => esc_html__( 'Background Type', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box:hover .msg-title',
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'titleHvrShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box:hover .msg-title',
				'condition' => array(
					'Title!' => '',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'message_box_desc_styling',
			array(
				'label'     => esc_html__( 'Description', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'Description' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'descTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .msg-desc',
				'condition' => array(
					'Description' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'descAdjust',
			array(
				'label'      => esc_html__( 'Description Adjust', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .msg-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Description' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'mesg_desc_color' );
		$this->start_controls_tab(
			'desc_color_n',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'Description' => 'yes',
				),
			)
		);
		$this->add_control(
			'descNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .msg-desc' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'Description' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'descNmlBG',
				'label'     => esc_html__( 'Background Type', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .msg-desc',
				'condition' => array(
					'Description' => 'yes',
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
					'{{WRAPPER}} .msg-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Description' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'desc_color_h',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'Description' => 'yes',
				),
			)
		);
		$this->add_control(
			'descHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-desc' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'Description' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'descHvrBG',
				'label'     => esc_html__( 'Background Type', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box:hover .msg-desc',
				'condition' => array(
					'Description' => 'yes',
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
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'Description' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'message_box_icon_styling',
			array(
				'label'     => esc_html__( 'Main Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'iconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 25,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'icon' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'iconWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 40,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'icon' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'msgArrow',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'after',
			)
		);
		$this->start_controls_tabs( 'mesg_icon_color' );
		$this->start_controls_tab(
			'icon_color_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'iconNormalColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'bgNormalColor',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'arrowNormalColor',
			array(
				'label'     => esc_html__( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'msgArrow' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .msg-arrow::after' => 'border-left-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconNmlBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box .msg-icon-content',
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'iconBdrNmlRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-icon-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'nmlIconShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box .msg-icon-content',
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_color_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'iconHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-icon-content i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-icon-content svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'bgHoverColor',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-icon-content' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'arrowHoverColor',
			array(
				'label'     => esc_html__( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'msgArrow' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-arrow::after' => 'border-left-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconHvrBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box:hover .msg-icon-content',
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'iconBdrHvrRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-icon-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'hvrIconShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box:hover .msg-icon-content',
				'condition' => array(
					'icon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'message_box_dismiss_styling',
			array(
				'label'     => esc_html__( 'Close Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'dIconSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 37,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'dismiss' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'dIconWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 38,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'dismiss' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'after',
			)
		);
		$this->start_controls_tabs( 'mesg_dismiss_color' );
		$this->start_controls_tab(
			'dIcon_color_n',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_control(
			'dIconNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'dismiss' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'dIconNmlBG',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'dIconNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'dIconNmlShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box .msg-dismiss-content',
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'dIcon_color_h',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_control(
			'dIconHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'dismiss' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-dismiss-content i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-dismiss-content svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'dIconHvrBG',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-dismiss-content' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'dIconHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box:hover .msg-dismiss-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'dIconHvrShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .messagebox-bg-box:hover .msg-dismiss-content',
				'condition' => array(
					'dismiss' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'message_box_background_styling',
			array(
				'label' => esc_html__( 'Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'bgPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'mesg_background' );
		$this->start_controls_tab(
			'bg_color_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'normalBG',
				'label'    => esc_html__( 'Background Type', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .messagebox-bg-box',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bgNmlBorder',
				'label'    => esc_html__( 'Border Type', 'theplus' ),
				'selector' => '{{WRAPPER}} .messagebox-bg-box',
			)
		);
		$this->add_responsive_control(
			'boxBdrNmlRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nmlboxShadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .messagebox-bg-box',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bg_color_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'HoverBG',
				'label'    => esc_html__( 'Background Type', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .messagebox-bg-box:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bgHvrBorder',
				'label'    => esc_html__( 'Border Type', 'theplus' ),
				'selector' => '{{WRAPPER}} .messagebox-bg-box:hover',
			)
		);
		$this->add_responsive_control(
			'boxBdrHvrRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .messagebox-bg-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hvrboxShadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .messagebox-bg-box:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Social Sharing Render.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$get_icon = '';

		$uid_msgbox = uniqid( 'tp-msg' );
		$msg_arrow  = ! empty( $settings['msgArrow'] ) ? $settings['msgArrow'] : false;

		$icon = ! empty( $settings['icon'] ) ? $settings['icon'] : 'yes';

		$dissmiss = ! empty( $settings['dismiss'] ) ? $settings['dismiss'] : 'yes';

		$arrow = '';
		if ( 'yes' === $icon ) {
			if ( ! empty( $msg_arrow ) ) {
				$arrow = ' msg-arrow';
			}

			if ( ! empty( $settings['IconName'] ) ) {
				$get_icon .= '<div class="msg-icon-content ' . esc_attr( $arrow ) . '">';
					ob_start();
					\Elementor\Icons_Manager::render_icon( $settings['IconName'], array( 'aria-hidden' => 'true' ) );
					$get_icon .= ob_get_contents();
					ob_end_clean();
				$get_icon .= '</div>';
			}
		}

		$get_dismiss = '';
		if ( 'yes' === $dissmiss ) {
			$get_dismiss .= '<div class="msg-dismiss-content">';

			if ( ! empty( $settings['dismsIcon'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['dismsIcon'], array( 'aria-hidden' => 'true' ) );
				$get_dismiss .= ob_get_contents();
				ob_end_clean();
			}

			$get_dismiss .= '</div>';
		}

		$get_titile = '';
		if ( ! empty( $settings['Title'] ) ) {
			$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['titleNmlBg_image'], $settings['titleHvrBg_image'] ) : '';

			$get_titile .= '<div class="msg-title ' . esc_attr( $lz1 ) . '" >' . wp_kses_post( $settings['Title'] ) . '</div>';
		}

		$get_desc = '';
		if ( ( 'yes' === $settings['Description'] ) && ! empty( $settings['descText'] ) ) {
			$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['descNmlBG_image'], $settings['descHvrBG_image'] ) : '';

			$get_desc .= '<div class="msg-desc ' . esc_attr( $lz2 ) . '">' . wp_kses_post( $settings['descText'] ) . '</div>';
		}

		$speed = '';
		if ( 'yes' === $settings['dismiss'] ) {
			$speed = ! empty( $settings['speed']['size'] ) ? $settings['speed']['size'] : '500';
		}

		$output = '<div class="tp-messagebox tp-widget-' . esc_attr( $uid_msgbox ) . '" data-speed="' . $speed . '">';

			$lz3 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['normalBG_image'], $settings['HoverBG_image'] ) : '';

			$output .= '<div class="messagebox-bg-box ' . esc_attr( $lz3 ) . '">';

				$output .= '<div class="message-media ">';

					$output .= $get_icon;
					$output .= '<div class="msg-content">';

						$output .= $get_titile;
						$output .= $get_desc;

					$output .= '</div>';
					$output .= $get_dismiss;

				$output .= '</div>';

			$output .= '</div>';

		$output .= '</div>';

		echo $output;
	}
}

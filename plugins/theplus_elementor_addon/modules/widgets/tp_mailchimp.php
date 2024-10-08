<?php
/**
 * Widget Name: MailChimp
 * Description: Subscribe Email Form Using Mailchimp.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_MailChimp_Subscribe
 */
class ThePlus_MailChimp_Subscribe extends Widget_Base {

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
		return 'tp-mailchimp-subscribe';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Mailchimp', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-envelope theplus_backend_icon';
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
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-adapted' );
	}


	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Mailchimp', 'Subscription', 'Email Subscription', 'Email Opt-in', 'Email Signup', 'Newsletter Signup', 'Newsletter Subscription' );
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
				'label' => esc_html__( 'Layout', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'form_style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list( 3 ),
			)
		);
		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control,
					{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-post-search-forms input.form-control' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'form_style' => 'style-3',
				),
				'default'   => 'center',
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'name_field_section',
			array(
				'label'     => esc_html__( 'Name Field', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'form_style!' => 'style-1',
				),
			)
		);
		$this->add_control(
			'name_switch',
			array(
				'label'   => esc_html__( 'Display Name Field', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'name_switch_fname',
			array(
				'label'     => esc_html__( 'Display First Name', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'name_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'name_field_placeholder',
			array(
				'label'       => esc_html__( 'First Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Enter First Name', 'theplus' ),
				'placeholder' => esc_html__( 'Enter First Name', 'theplus' ),
				'condition'   => array(
					'name_switch'       => 'yes',
					'name_switch_fname' => 'yes',
				),
			)
		);
		$this->add_control(
			'name_icon',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
				),
				'condition' => array(
					'name_switch'       => 'yes',
					'name_switch_fname' => 'yes',
					'form_style!'       => 'style-3',
				),
			)
		);
		$this->add_control(
			'name_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Name Icon Prefix', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-user',
				'condition' => array(
					'name_switch'       => 'yes',
					'name_switch_fname' => 'yes',
					'form_style!'       => 'style-3',
					'name_icon'         => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'name_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-user',
					'library' => 'solid',
				),
				'condition' => array(
					'name_switch'       => 'yes',
					'name_switch_fname' => 'yes',
					'form_style!'       => 'style-3',
					'name_icon'         => 'font_awesome_5',
				),
			)
		);
		$this->add_responsive_control(
			'name_field_width',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control.tp-mailchimp-first-name' => 'width: {{SIZE}}%;',
				),
				'condition'  => array(
					'form_style'        => 'style-3',
					'name_switch'       => 'yes',
					'name_switch_fname' => 'yes',
				),
			)
		);
		$this->add_control(
			'name_switch_lname',
			array(
				'label'     => esc_html__( 'Display Last Name', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'name_switch' => 'yes',
					'form_style'  => 'style-3',
				),
			)
		);
		$this->add_control(
			'last_name_field_placeholder',
			array(
				'label'       => esc_html__( 'Last Name', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Enter Last Name', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Last Name', 'theplus' ),
				'condition'   => array(
					'name_switch'       => 'yes',
					'name_switch_lname' => 'yes',
					'form_style'        => 'style-3',
				),
			)
		);
		$this->add_responsive_control(
			'lname_field_width',
			array(
				'label'      => esc_html__( 'Last Name Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control.tp-mailchimp-last-name' => 'width: {{SIZE}}%;',
				),
				'condition'  => array(
					'form_style'        => 'style-3',
					'name_switch'       => 'yes',
					'name_switch_lname' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'birth_field_section',
			array(
				'label'     => esc_html__( 'Birth Field', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'form_style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'birth_switch',
			array(
				'label'   => esc_html__( 'Display Birth Field', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'bith_field_placeholder_month',
			array(
				'label'       => esc_html__( 'Month', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'MM', 'theplus' ),
				'placeholder' => esc_html__( 'MM', 'theplus' ),
				'condition'   => array(
					'birth_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'bith_field_placeholder_day',
			array(
				'label'       => esc_html__( 'Day', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'DD', 'theplus' ),
				'placeholder' => esc_html__( 'DD', 'theplus' ),
				'condition'   => array(
					'birth_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'birth_field_width',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control.tp-mailchimp-birth-month,
					{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control.tp-mailchimp-birth-day' => 'width: {{SIZE}}%;',
				),
				'separator'  => 'before',
				'condition'  => array(
					'form_style'   => 'style-3',
					'birth_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'phone_field_section',
			array(
				'label'     => esc_html__( 'Phone Field', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'form_style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'phone_switch',
			array(
				'label'   => esc_html__( 'Display Phone Field', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'phone_field_placeholder',
			array(
				'label'       => esc_html__( 'Phone', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( '+1 123-4567', 'theplus' ),
				'placeholder' => esc_html__( '+1 123-4567', 'theplus' ),
				'condition'   => array(
					'phone_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'phone_field_width',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control.tp-mailchimp-phone' => 'width: {{SIZE}}%;',
				),
				'separator'  => 'before',
				'condition'  => array(
					'form_style'   => 'style-3',
					'phone_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'email_field_section',
			array(
				'label' => esc_html__( 'Email Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'email_field_placeholder',
			array(
				'label'       => esc_html__( 'Email Field Placeholder', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Enter email address', 'theplus' ),
				'placeholder' => esc_html__( 'Enter email address', 'theplus' ),
			)
		);
		$this->add_control(
			'email_icon',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
				),
				'condition' => array(
					'form_style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'email_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Email Icon Prefix', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-envelope-o',
				'condition' => array(
					'form_style!' => 'style-3',
					'email_icon'  => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'email_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-envelope',
					'library' => 'solid',
				),
				'condition' => array(
					'form_style!' => 'style-3',
					'email_icon'  => 'font_awesome_5',
				),
			)
		);
		$this->add_responsive_control(
			'email_field_width',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 .theplus-mailchimp-form input.form-control.tp-mailchimp-email' => 'width: {{SIZE}}%;',
				),
				'separator'  => 'before',
				'condition'  => array(
					'form_style' => 'style-3',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'mailchimp_gdpr_section',
			array(
				'label' => esc_html__( 'GDPR Compliance', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'gdpr_switch',
			array(
				'label'     => esc_html__( 'GDPR', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
			)
		);
		$this->add_control(
			'gdpr_text',
			array(
				'label'     => esc_html__( 'GDPR Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'you must agree to the terms and conditions.', 'theplus' ),
				'condition' => array(
					'gdpr_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'gdpr_text_pos',
			array(
				'label'     => esc_html__( 'Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'gdpr_text_pos_above',
				'options'   => array(
					'gdpr_text_pos_above' => esc_html__( 'Above Button', 'theplus' ),
					'gdpr_text_pos_below' => esc_html__( 'Below Button', 'theplus' ),
				),
				'condition' => array(
					'gdpr_switch' => 'yes',
					'form_style'  => 'style-3',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'subscribe_button_section',
			array(
				'label' => esc_html__( 'Subscribe Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'placeholder' => esc_html__( 'SUBSCRIBE', 'theplus' ),
				'default'     => esc_html__( 'SUBSCRIBE', 'theplus' ),
			)
		);
		$this->add_control(
			'button_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'           => esc_html__( 'None', 'theplus' ),
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'button_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-chevron-right',
				'condition' => array(
					'button_icon_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-chevron-right',
					'library' => 'solid',
				),
				'condition' => array(
					'button_icon_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'button_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'button_icon_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'icon_align',
			array(
				'label'     => esc_html__( 'Icon Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => array(
					'left'  => esc_html__( 'Left', 'theplus' ),
					'right' => esc_html__( 'Right', 'theplus' ),
				),
				'condition' => array(
					'button_icon_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'button_icon_indent',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'default'   => array(
					'size' => 8,
				),
				'condition' => array(
					'button_icon_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form .subscribe-btn-icon.btn-after'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-mailchimp-form .subscribe-btn-icon.btn-before'   => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'button_icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'button_icon_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form .subscribe-btn-icon'  => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-mailchimp-form .subscribe-btn-icon svg'  => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_field_width',
			array(
				'label'      => esc_html__( 'Button Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition'  => array(
					'form_style' => 'style-3',
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 button' => 'width: {{SIZE}}%;',
				),
			)
		);
		$this->add_control(
			'button_align_custom',
			array(
				'label'     => esc_html__( 'Button Custom Alignment', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'button_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'unset' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-3 button' => 'float: {{VALUE}};display:block;margin:0 auto;margin-top: 10px;',
				),
				'default'   => 'center',
				'separator' => 'before',
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'condition' => array(
					'button_align_custom' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'redirect_thank_you_section',
			array(
				'label' => esc_html__( 'Redirect Thank you Page', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'switch_redirect_thankyou',
			array(
				'label'     => esc_html__( 'Redirect Thank You Page', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'redirect_thankyou',
			array(
				'label'         => esc_html__( 'Page Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => false,
				'dynamic'       => array( 'active' => true ),
				'condition'     => array(
					'switch_redirect_thankyou' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'mailchimp_extra_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'mc_double_opt_in',
			array(
				'label'     => esc_html__( 'Double Opt-In', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'mc_cst_group',
			array(
				'label'     => esc_html__( 'Groups', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mc_cst_group_value',
			array(
				'label'       => esc_html__( 'Enter Group ID', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Display multiple Groups use separator e.g. id1 | id2 | id3', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'mc_cst_group' => 'yes',
				),
			)
		);
		$this->add_control(
			'mc_cst_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>How to <a href="https://api.mailchimp.com/playground/" class="theplus-btn" target="_blank">Get Group ID?</a></i></p>',
				'label_block' => true,
				'condition'   => array(
					'mc_cst_group' => 'yes',
				),
			)
		);
		$this->add_control(
			'mc_cst_tag',
			array(
				'label'     => esc_html__( 'Tags', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mc_cst_tags_value',
			array(
				'label'       => esc_html__( 'Enter Tag', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Display multiple Tags use separator e.g. tag1 | tag2 | tag3', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'mc_cst_tag' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'response_msg_section',
			array(
				'label' => esc_html__( 'Response Message', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'loading_suscribe_msg',
			array(
				'label'       => esc_html__( 'Loading Subscribe Message', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Subscribing you please wait.', 'theplus' ),
				'placeholder' => esc_html__( 'Subscribing you please wait.', 'theplus' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'incorrect_msg',
			array(
				'label'       => esc_html__( 'Incorrect Email Id', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Incorrect email address.', 'theplus' ),
				'placeholder' => esc_html__( 'Incorrect email address.', 'theplus' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'correct_msg',
			array(
				'label'       => esc_html__( 'Success Message', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Thanks for subscribing with us. Just wait for our next email.', 'theplus' ),
				'placeholder' => esc_html__( 'Thanks for subscribing with us. Just wait for our next email.', 'theplus' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'double_opt_in_msg',
			array(
				'label'       => esc_html__( 'Double Opt In Message', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Thanks for subscribing with us. Please check email and confirm your subscription.', 'theplus' ),
				'placeholder' => esc_html__( 'Thanks for subscribing with us. Please check email and confirm your subscription.', 'theplus' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'mc_double_opt_in' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_prefix_icon_input',
			array(
				'label'     => esc_html__( 'Prefix Email Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'form_style!' => 'style-3',
				),
			)
		);
		$this->add_responsive_control(
			'prefix_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 8,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .plus-newsletter-input-wrapper span.prefix-icon' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .theplus-mailchimp-wrapper .plus-newsletter-input-wrapper span.prefix-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'prefix_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .plus-newsletter-input-wrapper span.prefix-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-mailchimp-wrapper .plus-newsletter-input-wrapper span.prefix-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'prefix_icon_adjust',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Adjust', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .plus-newsletter-input-wrapper span.prefix-icon' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'prefix_icon_adjust_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Left Adjust', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 30,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper.form-style-2 .plus-newsletter-input-wrapper span.prefix-icon' => 'left: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'form_style' => 'style-2',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_input',
			array(
				'label' => esc_html__( 'Fields Styling', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'email_typography',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-form input.form-control',
			)
		);
		$this->add_control(
			'email_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control::placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'email_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'email_outer_padding',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_email_field_style' );
		$this->start_controls_tab(
			'tab_email_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'input_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'email_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-mailchimp-form input.form-control',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_email_focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'input_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'email_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-mailchimp-form input.form-control:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_border_width',
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
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Focus', 'theplus' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-form input.form-control:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-form input.form-control',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_active_shadow',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-form input.form-control:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'gdpr_styling',
			array(
				'label'     => esc_html__( 'GDPR Compliance', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'gdpr_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'gdpr_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'flex-start',
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
				'selectors' => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr' => 'justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'gdpr_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'gdpr_check_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Checkbox Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-mailchimp-gdpr label:before' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'gdpr_text_heading',
			array(
				'label'     => esc_html__( 'Text', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'gdpr_text_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-mailchimp-gdpr label',
			)
		);
		$this->add_control(
			'gdpr_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'gdpr_uncheck_heading',
			array(
				'label'     => esc_html__( 'Uncheck Box', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'gdpr_uncheck_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr label:before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'gdpr_uncheck_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-mailchimp-gdpr label:before',
			)
		);
		$this->add_responsive_control(
			'gdpr_uncheck_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'gdpr_check_heading',
			array(
				'label'     => esc_html__( 'Check Box', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'gdpr_check_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr input#checkbox1:checked + label::before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'gdpr_check_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-mailchimp-gdpr input#checkbox1:checked + label::before',
			)
		);
		$this->add_responsive_control(
			'gdpr_check_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mailchimp-gdpr input#checkbox1:checked + label::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_subscribe_button_styling',
			array(
				'label' => esc_html__( 'Subscribe Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit',
			)
		);
		$this->add_responsive_control(
			'button_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'button_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hover_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'button_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'button_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_box_border_width',
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
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_border_style' );
		$this->start_controls_tab(
			'tab_button_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'button_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_button_shadow_style' );
		$this->start_controls_tab(
			'tab_button_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-wrapper button.subscribe-btn-submit:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_subscribe_msg_styling',
			array(
				'label' => esc_html__( 'Response Message', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'message_typography',
				'selector' => '{{WRAPPER}} .theplus-mailchimp-wrapper .theplus-notification',
			)
		);
		$this->add_control(
			'message_color',
			array(
				'label'     => esc_html__( 'Message Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .theplus-notification' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'message_loading_bg',
			array(
				'label'     => esc_html__( 'Loading Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .theplus-notification' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'message_success_bg',
			array(
				'label'     => esc_html__( 'Success Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .theplus-notification.success-msg' => 'background: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_responsive_styling',
			array(
				'label' => esc_html__( 'Responsive', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Maximum Width', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 250,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-mailchimp-wrapper .theplus-mailchimp-form' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'theplus' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
	}

	/**
	 * Render mailchimp
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$id    = 'plus-mailchimp-' . $this->get_id();
		$style = ! empty( $settings['form_style'] ) ? $settings['form_style'] : 'style-1';

		$name_on  = ! empty( $settings['name_switch'] ) ? $settings['name_switch'] : '';
		$thank_on = ! empty( $settings['switch_redirect_thankyou'] ) ? $settings['switch_redirect_thankyou'] : '';

		$loading_msg = ! empty( $settings['loading_suscribe_msg'] ) ? $settings['loading_suscribe_msg'] : 'Subscribing you please wait...';
		$correct_msg = ! empty( $settings['correct_msg'] ) ? $settings['correct_msg'] : 'Thanks for Subscribing with us. Just wait for our Next Email.';
		$fname_phold = ! empty( $settings['name_field_placeholder'] ) ? $settings['name_field_placeholder'] : '';

		$content_align = 'text-' . ( ! empty( $settings['content_align'] ) ? $settings['content_align'] : '' );
		$incorrect_msg = ! empty( $settings['incorrect_msg'] ) ? $settings['incorrect_msg'] : 'Incorrect Email Address.';

		$double_opt_in_msg = ! empty( $settings['double_opt_in_msg'] ) ? $settings['double_opt_in_msg'] : 'Thanks for Subscribing with us. Please Check Email and Confirm to Subscribe.';

		$content_align_tablet = ! empty( $settings['content_align_tablet'] ) ? 'text--tablet' . $settings['content_align_tablet'] : '';
		$content_align_mobile = ! empty( $settings['content_align_mobile'] ) ? 'text--mobile' . $settings['content_align_mobile'] : '';

		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$redirect_thankyou = '';

		if ( 'yes' === $thank_on ) {
			$thnk_url = ! empty( $settings['redirect_thankyou']['url'] ) ? $settings['redirect_thankyou']['url'] : '';

			if ( ! empty( $thnk_url ) ) {
				$redirect_thankyou = $thnk_url;
			}
		}

		$output = '<div class="theplus-mailchimp-wrapper form-' . esc_attr( $style ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';

			$output .= '<form action="' . site_url() . '/wp-admin/admin-ajax.php" id="' . esc_attr( $id ) . '" class="theplus-mailchimp-form ' . esc_attr( $content_align ) . ' ' . esc_attr( $content_align_tablet ) . ' ' . esc_attr( $content_align_mobile ) . '" data-thank-you="' . esc_attr( $redirect_thankyou ) . '">';

				$output .= '<div class="plus-newsletter-input-wrapper">';

					$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['email_field_bg_image'], $settings['email_field_focus_bg_image'] ) : '';

		if ( 'style-2' === $style && 'yes' === $name_on ) {
			$icons = '';

			$name_icon = ! empty( $settings['name_icon'] ) ? $settings['name_icon'] : 'font_awesome';

			if ( 'font_awesome_5' === $name_icon && ! empty( $settings['name_icon_fontawesome_5'] ) && 'style-3' !== $style ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['name_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
				ob_end_clean();
				$output .= '<span class="prefix-icon"><span>' . $icons . '</span></span>';
			} elseif ( ! empty( $settings['name_icon_fontawesome'] ) && 'style-3' !== $style ) {
				$output .= '<span class="prefix-icon"><i class="' . esc_attr( $settings['name_icon_fontawesome'] ) . '"></i></span>';
			}

			$output .= '<input type="text" name="FNAME" placeholder="' . esc_attr( $fname_phold ) . '"class="form-control tp-mailchimp-first-name ' . esc_attr( $lz1 ) . '">';
		}

		if ( 'style-3' === $style ) {
			if ( 'yes' === $name_on ) {

				$fname_on = ! empty( $settings['name_switch_fname'] ) ? $settings['name_switch_fname'] : '';
				if ( 'yes' === $fname_on ) {
					$output .= '<input type="text" name="FNAME" placeholder="' . esc_attr( $fname_phold ) . '"class="form-control tp-mailchimp-first-name ' . esc_attr( $lz1 ) . '">';
				}

				$lname_on = ! empty( $settings['name_switch_lname'] ) ? $settings['name_switch_lname'] : '';
				if ( 'yes' === $lname_on ) {
					$output .= '<input type="text" name="LNAME" placeholder="' . esc_attr( $settings['last_name_field_placeholder'] ) . '" class="form-control tp-mailchimp-last-name ' . esc_attr( $lz1 ) . '">';
				}
			}

			$birth_on = ! empty( $settings['birth_switch'] ) ? $settings['birth_switch'] : '';
			if ( 'yes' === $birth_on ) {
				$output .= '<input type="number" name="BIRTHMONTH" placeholder="' . esc_attr( $settings['bith_field_placeholder_month'] ) . '" class="form-control tp-mailchimp-birth-month ' . esc_attr( $lz1 ) . '" min="1" max="12">';
				$output .= '<input type="number" name="BIRTHDAY" placeholder="' . esc_attr( $settings['bith_field_placeholder_day'] ) . '" class="form-control tp-mailchimp-birth-day ' . esc_attr( $lz1 ) . '" min="01" max="31">';
			}

			$p_field    = ! empty( $settings['phone_switch'] ) ? $settings['phone_switch'] : '';
			$p_fpholder = ! empty( $settings['phone_field_placeholder'] ) ? $settings['phone_field_placeholder'] : '';
			if ( 'yes' === $p_field ) {
				$output .= '<input type="text" name="PHONE" placeholder="' . esc_attr( $p_fpholder ) . '" class="form-control tp-mailchimp-phone ' . esc_attr( $lz1 ) . '">';
			}
		}

		$eicons  = '';
		$e_icon  = ! empty( $settings['email_icon'] ) ? $settings['email_icon'] : 'font_awesome';
		$e_ifnts = ! empty( $settings['email_icon_fontawesome'] ) ? $settings['email_icon_fontawesome'] : '';

		if ( 'font_awesome_5' === $e_icon && ! empty( $settings['email_icon_fontawesome_5'] ) && 'style-3' !== $style ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['email_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
			$eicons = ob_get_contents();
			ob_end_clean();
			$output .= '<span class="prefix-icon"><span>' . $eicons . '</span></span>';
		} elseif ( ! empty( $e_ifnts ) && 'style-3' !== $style ) {
			$output .= '<span class="prefix-icon"><i class="' . esc_attr( $e_ifnts ) . '"></i></span>';
		}

		$output .= '<input type="email" name="email" placeholder="' . esc_attr( $settings['email_field_placeholder'] ) . '" required class="form-control tp-mailchimp-email ' . esc_attr( $lz1 ) . '" />';
		$output .= '<input type="hidden" name="action" value="plus_mailchimp_subscribe" />';

		$mc_dopt = ! empty( $settings['mc_double_opt_in'] ) ? $settings['mc_double_opt_in'] : '';

		if ( 'yes' === $mc_dopt ) {
			$output .= '<input type="hidden" name="mc_double_opt_in" value="pending" />';
		}

		$mc_cstg = ! empty( $settings['mc_cst_group'] ) ? $settings['mc_cst_group'] : '';

		$mc_cstg_value = ! empty( $settings['mc_cst_group_value'] ) ? $settings['mc_cst_group_value'] : '';

		if ( 'yes' === $mc_cstg && ! empty( $mc_cstg_value ) ) {
			$output .= '<input type="hidden" name="mc_cst_group_value" value="' . esc_attr( $settings['mc_cst_group_value'] ) . '" />';
		}

		$mc_csttag    = ! empty( $settings['mc_cst_tag'] ) ? $settings['mc_cst_tag'] : '';
		$mc_tag_value = ! empty( $settings['mc_cst_tags_value'] ) ? $settings['mc_cst_tags_value'] : '';

		if ( 'yes' === $mc_csttag && ! empty( $mc_tag_value ) ) {
			$output .= '<input type="hidden" name="mc_cst_tags_value" value="' . esc_attr( $mc_tag_value ) . '" />';
		}

		$gdpr_text   = ! empty( $settings['gdpr_text'] ) ? $settings['gdpr_text'] : '';
		$gdpr_switch = ! empty( $settings['gdpr_switch'] ) ? $settings['gdpr_switch'] : '';

		$gdpr_text_pos = ! empty( $settings['gdpr_text_pos'] ) ? $settings['gdpr_text_pos'] : 'gdpr_text_pos_above';
		if ( 'gdpr_text_pos_above' === $gdpr_text_pos ) {

			if ( ! empty( $gdpr_text ) ) {

				$output .= '<div class="tp-mailchimp-gdpr">';

					$output .= '<input type="checkbox" name="gdprcheckbox[]" id="checkbox1">';

					$output .= '<label for="gdprcheckbox1">' . wp_kses_post( $gdpr_text ) . '</lable>';

				$output .= '</div>';
			}
		}

		$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['button_bg_image'], $settings['button_hover_bg_image'] ) : '';

		$output .= '<button class="subscribe-btn-submit ' . esc_attr( $lz2 ) . '">' . $this->render_text( $settings ) . '</button>';

		if ( 'gdpr_text_pos_below' === $gdpr_text_pos ) {

			if ( ! empty( $gdpr_text ) ) {

				$output .= '<div class="tp-mailchimp-gdpr">';

					$output .= '<input type="checkbox" name="gdprcheckbox[]" id="checkbox1">';
					$output .= '<label for="gdprcheckbox1">' . wp_kses_post( $gdpr_text ) . '</lable>';

				$output .= '</div>';
			}
		}

		if ( ! empty( $gdpr_switch ) ) { ?>

			<script type="text/javascript">
			
			jQuery(document).ready(function($) {

				if(jQuery('.tp-mailchimp-gdpr').length){
					jQuery('.theplus-mailchimp-wrapper .theplus-mailchimp-form .subscribe-btn-submit').attr('disabled', 'disabled');
				}

				var mcb = jQuery('.theplus-mailchimp-wrapper .tp-mailchimp-gdpr input#checkbox1');

				jQuery(mcb).change(function() {

					if(mcb[0].checked){
						mcb.closest('.theplus-mailchimp-wrapper').find('.subscribe-btn-submit').removeAttr("disabled");
					}else{
						jQuery('.theplus-mailchimp-wrapper .theplus-mailchimp-form .subscribe-btn-submit').attr('disabled', 'disabled');
					}
				});
			});
			</script>

			<?php
		}

		$output .= '</div>';
		$output .= '<div class="theplus-notification"><div class="subscribe-response"></div></div>';
		$output .= '</form>';
		$output .= '</div>';
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				'use strict';
				$('#<?php echo esc_attr( $id ); ?>').on('submit',function(event){
					event.preventDefault()
					var mailchimpform = $(this);
					var loading_text='<span class="loading-spinner"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></span><?php echo esc_html( $loading_msg ); ?>';
					var notverify='<span class="loading-spinner"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span><?php echo esc_html__( 'Error : API Key or List ID invalid. Please check that again in Plugin Settings.', 'theplus' ); ?>';
					var incorrect_text='<span class="loading-spinner"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span><?php echo esc_html( $incorrect_msg ); ?>';
					var correct_text='<span class="loading-spinner"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><?php echo esc_html( $correct_msg ); ?>';
					var double_opt_in_text='<span class="loading-spinner"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><?php echo esc_html( $double_opt_in_msg ); ?>';
					$("#<?php echo esc_attr( $id ); ?> .theplus-notification").removeClass("not-verify danger-msg success-msg");
					$.ajax({
						type:"POST",						
						data:mailchimpform.serialize(),
						url:theplus_ajax_url,
						beforeSend: function() {
							$("#<?php echo esc_attr( $id ); ?> .theplus-notification").fadeIn().animate({						
								opacity: 1
								}, 200 );
							$("#<?php echo esc_attr( $id ); ?> .theplus-notification .subscribe-response").html(loading_text);
						},
						success:function(data){
							
							if(data=='not-verify'){
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification").addClass("not-verify");
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification .subscribe-response").html(notverify);
							}
							if(data=='incorrect'){
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification").addClass("danger-msg");
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification .subscribe-response").html(incorrect_text);
							}
							if(data=='correct'){
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification").addClass("success-msg");
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification .subscribe-response").html(correct_text);
								if($('#<?php echo esc_attr( $id ); ?>').data("thank-you") != undefined && $('#<?php echo esc_attr( $id ); ?>').data("thank-you") != ''){
									var redirect_url=$('#<?php echo esc_attr( $id ); ?>').data("thank-you");
									setTimeout(function(){
										window.location.href = redirect_url;
									}, 700);
								}
							}
							if(data=='pending'){
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification").addClass("success-msg");
								$("#<?php echo esc_attr( $id ); ?> .theplus-notification .subscribe-response").html(double_opt_in_text);
								if($('#<?php echo esc_attr( $id ); ?>').data("thank-you") != undefined && $('#<?php echo esc_attr( $id ); ?>').data("thank-you") != ''){
									var redirect_url=$('#<?php echo esc_attr( $id ); ?>').data("thank-you");
									setTimeout(function(){
										window.location.href = redirect_url;
									}, 700);
								}
							}
							$("#<?php echo esc_attr( $id ); ?> .theplus-notification").delay(2500).fadeOut().animate({						
								opacity: 0
							}, 2500 );
							
						}
					});
					return false;
				});
			});	
		</script>
		
		<?php
		echo $before_content . $output . $after_content;
	}

	/**
	 * Render text mailchimp
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 *
	 * @param string $settings The attribute slug.
	 *
	 * @version 5.4.2
	 */
	public function render_text( $settings ) {

		$this->add_render_attribute( 'content-wrapper', 'class', 'theplus-subscribe-btn-wrapper' );

		$btn_icon  = '';
		$btn_icons = ! empty( $settings['button_icon_style'] ) ? $settings['button_icon_style'] : 'none';

		$btn_icon_f5   = ! empty( $settings['button_icon_fontawesome_5'] ) ? $settings['button_icon_fontawesome_5'] : '';
		$btn_icon_mind = ! empty( $settings['button_icons_mind'] ) ? $settings['button_icons_mind'] : '';

		if ( 'none' !== $btn_icons ) {
			if ( 'font_awesome' === $btn_icons && ! empty( $settings['button_icon_fontawesome'] ) ) {
				$btn_icon = $settings['button_icon_fontawesome'];
			}
			if ( 'font_awesome_5' === $btn_icons && ! empty( $btn_icon_f5 ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $btn_icon_f5, array( 'aria-hidden' => 'true' ) );
				$btn_icon = ob_get_contents();
				ob_end_clean();
			}
			if ( 'icon_mind' === $btn_icons && ! empty( $btn_icon_mind ) ) {
				$btn_icon = $btn_icon_mind;
			}
		}

		$btn_before = '';
		$btn_after  = '';

		$i_align = ! empty( $settings['icon_align'] ) ? $settings['icon_align'] : 'right';

		if ( 'font_awesome_5' === $btn_icons && ! empty( $btn_icon_f5 ) && ! empty( $btn_icon ) ) {
			if ( 'left' === $i_align ) {
				$btn_before = '<span class="subscribe-btn-icon btn-before">' . $btn_icon . '</span>';
			} elseif ( 'right' === $i_align ) {
				$btn_after = '<span class="subscribe-btn-icon btn-after">' . $btn_icon . '</span>';
			}
		} else {
			if ( 'left' === $i_align && ! empty( $btn_icon ) ) {
				$btn_before = '<i class="subscribe-btn-icon btn-before ' . esc_attr( $btn_icon ) . '" aria-hidden="true"></i>';
			}
			if ( 'right' === $i_align && ! empty( $btn_icon ) ) {
				$btn_after = '<i class="subscribe-btn-icon btn-after ' . esc_attr( $btn_icon ) . '" aria-hidden="true"></i>';
			}
		}

		$subscribe_button = $btn_before . esc_attr( $settings['button_text'] ) . $btn_after;

		return $subscribe_button;
	}
}

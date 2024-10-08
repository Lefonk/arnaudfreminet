<?php
/**
 * Widget Name: Protected Content
 * Description: Protected Content
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Frontend;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Protected_Content.
 */
class ThePlus_Protected_Content extends Widget_Base {

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
		return 'tp-protected-content';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Protected Content', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-lock theplus_backend_icon';
	}

	/**
	 * Get categories.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
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
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {
		/*start Protected Content*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Protected Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'content_type',
			array(
				'label'   => esc_html__( 'Content Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'content'       => esc_html__( 'Content', 'theplus' ),
					'page_template' => esc_html__( 'Page Template', 'theplus' ),
				),
				'default' => 'content',
			)
		);
		$this->add_control(
			'protected_content_field',
			array(
				'label'       => esc_html__( 'Protected Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'This is the content that you want to be protected.', 'theplus' ),
				'condition'   => array(
					'content_type' => 'content',
				),
			)
		);
		$this->add_control(
			'protected_content_template',
			array(
				'label'     => wp_kses_post( "Elementor Templates <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "protected-content-for-elementor-template/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'options'   => theplus_get_templates(),
				'condition' => array(
					'content_type' => 'page_template',
				),
			)
		);
		$this->end_controls_section();

		/*protected content protection start*/
		$this->start_controls_section(
			'pc_protection',
			array(
				'label' => esc_html__( 'Protection Type', 'theplus' ),
			)
		);
		$this->add_control(
			'pc_protection_type',
			array(
				'label'       => esc_html__( 'Protection Type', 'theplus' ),
				'label_block' => false,
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'role'              => esc_html__( 'User role', 'theplus' ),
					'password'          => esc_html__( 'Single Password', 'theplus' ),
					'multiple_password' => esc_html__( 'Multiple Password', 'theplus' ),
				),
				'default'     => 'password',
			)
		);
		$this->add_control(
			'how_it_works_role',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "protect-content-based-on-user-role-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'pc_protection_type' => array( 'role' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_multiple_password',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "multiple-password-protected-content-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'pc_protection_type' => array( 'multiple_password' ),
				),
			)
		);
		$this->add_control(
			'pc_role',
			array(
				'label'       => esc_html__( 'Select Roles', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => theplus_user_roles(),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'pc_protection_type' => 'role',
				),
			)
		);
		$this->add_control(
			'pc_error_message',
			array(
				'label'        => esc_html__( 'Preview of Error Message', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Show', 'theplus' ),
				'label_off'    => esc_html__( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'description'  => 'Show error message',
				'dynamic'      => array(
					'active' => true,
				),
				'condition'    => array(
					'pc_protection_type' => 'role',
				),
			)
		);
		$this->add_control(
			'protection_password',
			array(
				'label'     => esc_html__( 'Set Password', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'pc_protection_type' => 'password',
				),
			)
		);
		/*multiple password field start*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'protection_password_multi',
			array(
				'label'      => esc_html__( 'Set Password', 'theplus' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'password',
				'dynamic'    => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'protection_password_list',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'protection_password_multi' => esc_html__( '1234', 'theplus' ),
					),

				),
				'title_field' => '{{{ protection_password_multi }}}',
				'condition'   => array(
					'pc_protection_type' => 'multiple_password',
				),
			)
		);
		/*multiple password field end*/

		$this->add_control(
			'show_content',
			array(
				'label'        => esc_html__( 'Show Content', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Show', 'theplus' ),
				'label_off'    => esc_html__( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'condition'    => array(
					'pc_protection_type' => array( 'password', 'multiple_password' ),
				),
			)
		);

		$this->add_control(
			'show_cookie',
			array(
				'label'     => esc_html__( 'Cookie', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
				'condition' => array(
					'pc_protection_type' => array( 'password', 'multiple_password' ),
				),
			)
		);
		$this->add_control(
			'days',
			array(
				'label'     => esc_html__( 'Days', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'dynamic'   => array(
					'active' => true,
				),
				'min'       => 1,
				'max'       => 365,
				'default'   => 1,
				'condition' => array(
					'show_cookie' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		/*protected content protection end*/

		/*protected content message start*/
		$this->start_controls_section(
			'pc_message',
			array(
				'label' => esc_html__( 'Message', 'theplus' ),
			)
		);
		$this->add_control(
			'pc_message_source',
			array(
				'label'       => esc_html__( 'Message Source', 'theplus' ),
				'label_block' => false,
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Set a message or a elementor template when the content is protected.', 'theplus' ),
				'options'     => array(
					'none'          => esc_html__( 'None', 'theplus' ),
					'text'          => esc_html__( 'Message', 'theplus' ),
					'page_template' => esc_html__( 'Elementor Templates', 'theplus' ),
				),
				'default'     => 'text',
			)
		);
		$this->add_control(
			'pc_message_text',
			array(
				'label'     => esc_html__( 'Text', 'theplus' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'You do not have permission to see this content.', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'pc_message_source' => 'text',
				),
			)
		);
		$this->add_control(
			'pc_message_template',
			array(
				'label'     => esc_html__( 'Choose Elementor Template', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => theplus_get_templates(),
				'condition' => array(
					'pc_message_source' => 'page_template',
				),
			)
		);
		$this->end_controls_section();
		/*form input start*/
		$this->start_controls_section(
			'pc_form_input_section',
			array(
				'label' => esc_html__( 'Form Text', 'theplus' ),
			)
		);
		$this->add_control(
			'form_input_text',
			array(
				'label'       => esc_html__( 'Input text', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Enter Password', 'theplus' ),
				'placeholder' => esc_html__( 'Your Text Here', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'form_button_text',
			array(
				'label'       => esc_html__( 'Button text', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Submit', 'theplus' ),
				'placeholder' => esc_html__( 'Submit', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();
		/**
		 * Form input end
		 * */
		/*Error message start*/
		$this->start_controls_section(
			'pc_error_message_section',
			array(
				'label' => esc_html__( 'Error Message', 'theplus' ),
			)
		);
		$this->add_control(
			'error_message_text',
			array(
				'label'       => esc_html__( 'Error Message', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Wrong password, please try again.', 'theplus' ),
				'placeholder' => esc_html__( 'Type your Error Message here', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();
		/**
		 * Error message end
		 * */
		/**
		 * Protected content message end
		 * */
		/**
		 * Text color style start
		 * */
		$this->start_controls_section(
			'section_message',
			array(
				'label' => esc_html__( 'Message', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'message_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-pc-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'message_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-pc-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'message_typography',
				'selector' => '{{WRAPPER}} .theplus-pc-message .theplus-pc-message-text',
			)
		);
		$this->start_controls_tabs( 'tabs_textarea_field_style' );
				$this->start_controls_tab(
					'message_normal',
					array(
						'label' => esc_html__( 'Normal', 'theplus' ),
					)
				);
				$this->add_control(
					'message_color',
					array(
						'label'     => esc_html__( 'Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .theplus-pc-message .theplus-pc-message-text' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'message_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .theplus-pc-message',
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'message_border',
						'label'    => esc_html__( 'Border', 'theplus' ),
						'selector' => '{{WRAPPER}} .theplus-pc-message',
					)
				);
				$this->add_responsive_control(
					'message_border_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'theplus' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .theplus-pc-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'message_box_shadow',
						'selector' => '{{WRAPPER}} .theplus-pc-message',
					)
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'message_hover',
					array(
						'label' => esc_html__( 'Hover', 'theplus' ),
					)
				);
				$this->add_control(
					'message_color_hover',
					array(
						'label'     => esc_html__( 'Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .theplus-pc-message .theplus-pc-message-text:hover' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'message_bg_hover',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .theplus-pc-message:hover',
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'message_border_hover',
						'label'    => esc_html__( 'Border', 'theplus' ),
						'selector' => '{{WRAPPER}} .theplus-pc-message:hover',
					)
				);
				$this->add_responsive_control(
					'message_border_radius_hover',
					array(
						'label'      => esc_html__( 'Border Radius', 'theplus' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .theplus-pc-message:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'message_box_shadow_hover',
						'selector' => '{{WRAPPER}} .theplus-pc-message:hover',
					)
				);
				$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		/*message style end*/

		/*form input start*/
		$this->start_controls_section(
			'form_input',
			array(
				'label'     => esc_html__( 'Form Input', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pc_protection_type' => array( 'password', 'multiple_password' ),
				),
			)
		);
		$this->add_responsive_control(
			'form_input_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'form_input_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 2000,
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
					'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'tab_form_input_placeholder',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-password-pc-fields input::-webkit-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_input_typography',
				'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password',
			)
		);
		$this->start_controls_tabs( 'tabs_form_input' );
			$this->start_controls_tab(
				'tab_form_input',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'form_input_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'form_input_bg',
				array(
					'label'     => esc_html__( 'Background', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_input_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password',
				)
			);
				$this->add_responsive_control(
					'form_input_border_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'theplus' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'form_input_box_shadow',
						'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password',
					)
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_form_input_focus',
				array(
					'label' => esc_html__( 'Focus', 'theplus' ),
				)
			);
			$this->add_control(
				'form_input_color_focus',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password:focus' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'form_input_bg_focus',
				array(
					'label'     => esc_html__( 'Background', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password:focus' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_input_border_focus',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password:focus',
				)
			);
				$this->add_responsive_control(
					'form_input_border_radius_focus',
					array(
						'label'      => esc_html__( 'Border Radius', 'theplus' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'form_input_box_shadow_focus',
						'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-password:focus',
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/**
		 * Form input end
		 * */
		/**
		 * Form button start
		 * */
		$this->start_controls_section(
			'form_submit',
			array(
				'label'     => esc_html__( 'Submit Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pc_protection_type' => array( 'password', 'multiple_password' ),
				),
			)
		);
		$this->add_responsive_control(
			'form_submit_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_pc_wrapper .theplus-password-pc-fields input + input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_button_typography',
				'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit',
			)
		);
		$this->start_controls_tabs( 'tabs_form_button' );
			$this->start_controls_tab(
				'tab_form_button',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'form_button_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'form_button_bg',
				array(
					'label'     => esc_html__( 'Background', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_button_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit',
				)
			);
				$this->add_responsive_control(
					'form_button_border_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'theplus' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'form_button_box_shadow',
						'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit',
					)
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_form_button_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'form_button_color_hover',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit:hover' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'form_button_hover_bg',
				array(
					'label'     => esc_html__( 'Background', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit:hover' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_button_hover_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit:hover',
				)
			);
				$this->add_responsive_control(
					'form_button_hover_border_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'theplus' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'form_button_hover_box_shadow',
						'selector' => '{{WRAPPER}} .theplus-password-pc-fields form.theplus-pc-form input.theplus-pc-submit:hover',
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*form button end*/

		/*form error message start*/
		$this->start_controls_section(
			'form_err_msg',
			array(
				'label'     => esc_html__( 'Error Message', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pc_protection_type' => array( 'password', 'multiple_password' ),
				),
			)
		);
		$this->add_responsive_control(
			'form_err_msg_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-pc-error-msg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'form_err_msg_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-pc-error-msg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_err_msg_typography',
				'selector' => '{{WRAPPER}} .theplus-pc-error-msg',
			)
		);
		$this->add_control(
			'form_err_msg_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-pc-error-msg' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'form_err_msg_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-pc-error-msg',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'form_err_msg_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-pc-error-msg',
			)
		);
		$this->add_responsive_control(
			'form_err_msg_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-pc-error-msg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		/**
		 * Form error message end
		 * */
		/**
		 * Front content start
		 * */
		$this->start_controls_section(
			'pro_con_front',
			array(
				'label' => esc_html__( 'Front Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pro_con_front_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max Width', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 2000,
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
					'{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap' => 'max-width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'pc_protection_type!' => 'role',
				),
			)
		);
		$this->add_control(
			'pro_con_front_align',
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
					'{{WRAPPER}} .theplus-protected-content .theplus-pc-message-text' => 'text-align: {{VALUE}}',
				),
				'default'   => 'center',
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'pro_con_front_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap,{{WRAPPER}} .plus_pc_wrapper .theplus-pc-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pro_con_front_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap,{{WRAPPER}} .plus_pc_wrapper .theplus-pc-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->start_controls_tabs( 'tabs_pro_con_front_style' );
			$this->start_controls_tab(
				'pro_con_front_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'pro_con_front_bg',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'pro_con_front_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap',
				)
			);
			$this->add_responsive_control(
				'pro_con_front_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'pro_con_front_box_shadow',
					'selector' => '{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'pro_con_front_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'pro_con_front_bg_hover',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'pro_con_front_border_hover',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap:hover',
				)
			);
			$this->add_responsive_control(
				'pro_con_front_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'pro_con_front_box_shadow_hover',
					'selector' => '{{WRAPPER}} .plus_pc_wrapper .plus_pc_inner_wrap:hover',
				)
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		/*protected content start*/
		$this->start_controls_section(
			'pro_con',
			array(
				'label' => esc_html__( 'Protected Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pro_con_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max Width', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 2000,
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
					'{{WRAPPER}} .plus_pc_wrapper .theplus-protected-content-main,{{WRAPPER}} .plus_pc_wrapper .theplus-protected-content' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'pro_con_align',
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
				'condition' => array(
					'pc_protection_type!' => 'role',
				),
				'default'   => 'center',
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'pro_con_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-protected-content-main,{{WRAPPER}} .theplus-protected-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pro_con_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-protected-content-main,{{WRAPPER}} .theplus-protected-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'pro_con_typography',
				'selector'  => '{{WRAPPER}} .theplus-protected-content-main .protected-content,{{WRAPPER}} .theplus-protected-content-main .protected-content p',
				'condition' => array(
					'content_type' => 'content',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_input_field_style' );
			$this->start_controls_tab(
				'pro_con_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'pro_con_color',
				array(
					'label'     => esc_html__( 'Text Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-protected-content-main .protected-content,{{WRAPPER}} .theplus-protected-content-main .protected-content p' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'content_type' => 'content',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'pro_con_bg',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .theplus-protected-content-main,{{WRAPPER}} .theplus-protected-content',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'pro_con_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .theplus-protected-content-main,{{WRAPPER}} .theplus-protected-content',
				)
			);
			$this->add_responsive_control(
				'pro_con_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .theplus-protected-content-main,{{WRAPPER}} .theplus-protected-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'pro_con_box_shadow',
					'selector' => '{{WRAPPER}} .theplus-protected-content-main,{{WRAPPER}} .theplus-protected-content',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'pro_con_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'pro_con_color_hover',
				array(
					'label'     => esc_html__( 'Text Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .theplus-protected-content-main .protected-content:hover,{{WRAPPER}} .theplus-protected-content-main .protected-content:hover p,{{WRAPPER}} .theplus-protected-content:hover' => 'color: {{VALUE}};',
					),
					'condition' => array(
						'content_type' => 'content',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'pro_con_bg_hover',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .theplus-protected-content-main:hover,{{WRAPPER}} .theplus-protected-content:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'pro_con_border_hover',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .theplus-protected-content-main:hover,{{WRAPPER}} .theplus-protected-content:hover',
				)
			);
			$this->add_responsive_control(
				'pro_con_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .theplus-protected-content-main:hover,{{WRAPPER}} .theplus-protected-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'pro_con_box_shadow_hover',
					'selector' => '{{WRAPPER}} .theplus-protected-content-main:hover,{{WRAPPER}} .theplus-protected-content:hover',
				)
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 * */
	protected function render() {

		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		$pro_con_front_align = 'text-' . $settings['pro_con_front_align'] . ' align' . $settings['pro_con_front_align'];

		$pro_con_align = 'text-' . $settings['pro_con_align'] . ' align' . $settings['pro_con_align'];

		$lz3       = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['pro_con_bg_image'], $settings['pro_con_bg_hover_image'] ) : '';
		$pro_type  = ! empty( $settings['pc_protection_type'] ) ? $settings['pc_protection_type'] : 'password';
		$error_msg = ! empty( $settings['pc_error_message'] ) ? $settings['pc_error_message'] : 'no';

		$protection_password = isset( $_POST[ 'protection_password' . $widget_id ] ) ? sanitize_text_field( wp_unslash( $_POST[ 'protection_password' . $widget_id ] ) ) : '';

		echo '<div class="plus_pc_wrapper">';

		if ( 'role' === $pro_type ) {

			echo '<div class="theplus-protected-content ' . esc_attr( $lz3 ) . '">';

			if ( true === $this->current_user_writes() ) {
				$this->theplus_render_content( $this->get_settings_for_display() );
			} else {
				$this->theplus_render_message( $this->get_settings_for_display() );
			}

			if ( 'yes' === $error_msg ) {
				$this->theplus_render_message( $this->get_settings_for_display() );
			}

			echo '</div>';
		} else {

			if ( 'multiple_password' === $pro_type && ! empty( $settings['protection_password_list'] ) ) {
				foreach ( $settings['protection_password_list'] as $item ) {
					if ( ! session_status() ) {
						session_start();
					}

					if ( ! empty( $protection_password ) && $protection_password === $item['protection_password_multi'] ) {
						$_SESSION[ 'protection_password' . $widget_id ] = true;
					}
				}
			} elseif ( ! empty( $settings['protection_password'] ) ) {
				if ( ! session_status() ) {
					session_start();
				}

				if ( ! empty( $protection_password ) && $protection_password === $settings['protection_password'] ) {
					$_SESSION[ 'protection_password' . $widget_id ] = true;
				}
			}

			if ( ! isset( $_SESSION[ 'protection_password' . $widget_id ] ) && ! isset( $_COOKIE[ 'protection_password' . $widget_id ] ) ) {
				$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['pro_con_front_bg_image'], $settings['pro_con_front_bg_hover_image'] ) : '';
				echo '<div class="plus_pc_inner_wrap ' . esc_attr( $pro_con_front_align ) . ' ' . esc_attr( $lz2 ) . '">';

				if ( 'yes' !== $settings['show_content'] ) {
					$this->theplus_render_message( $this->get_settings_for_display() );
					$this->theplus_pc_form( $settings, $widget_id );
					echo '</div></div>';

					return;
				}

				echo '</div>';
			}

			$show_cookie = isset( $settings['show_cookie'] ) ? $settings['show_cookie'] : '';
			$days        = ! empty( $settings['days'] ) ? $settings['days'] : '';
			if ( 'yes' === $show_cookie && ! empty( $days ) && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo "<script type='text/javascript'>
						var expires = new Date();
						expires.setTime(expires.getTime() + (3600 * 1000 * 24 * {$days}));
						document.cookie = 'protection_password{$widget_id}=true;expires=' + expires.toUTCString();
					</script>";
			}

			if ( 'yes' === $show_cookie && ! empty( $days ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo "<script type='text/javascript'>delete_cookie('protection_password{$widget_id}');</script>";
			}

			if ( isset( $_COOKIE[ 'protection_password' . $widget_id ] ) && 'yes' === $show_cookie && ! empty( $days ) && ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '<div class="theplus-protected-content-main ' . esc_attr( $pro_con_align ) . ' ' . esc_attr( $lz3 ) . '">';
					$this->theplus_render_content( $this->get_settings_for_display() );
				echo '</div>';
			} else {
				echo '<div class="theplus-protected-content-main ' . esc_attr( $pro_con_align ) . ' ' . esc_attr( $lz3 ) . '">';
					$this->theplus_render_content( $this->get_settings_for_display() );
				echo '</div>';
			}
		}
		?>
		</div>
		<?php
	}

	/**
	 * Render message
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 *
	 * @param array $settings An array containing settings for rendering the message.
	 * */
	protected function theplus_render_message( $settings ) {
		$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['message_bg_image'], $settings['message_bg_hover_image'] ) : '';
		ob_start();
		$msg_source = ! empty( $settings['pc_message_source'] ) ? $settings['pc_message_source'] : '';

		?>
		<div class="theplus-pc-message <?php echo $lz1; ?>">
			<?php
			if ( 'text' === $msg_source ) {
				if ( ! empty( $msg_source ) ) {
					?>
					<div class="theplus-pc-message-text"><?php echo wp_kses_post( $settings['pc_message_text'] ); ?></div>
					<?php
				}
			} elseif ( ! empty( $settings['pc_message_template'] ) ) {
				$theplus_et_id    = $settings['pc_message_template'];
				$theplus_frontend = new Frontend();

				echo $theplus_frontend->get_builder_content( $theplus_et_id, true );
			}
			?>
		</div>  
		<?php
		echo ob_get_clean();
	}

	/**
	 * Render content
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 *
	 * @param array $settings An array containing settings for rendering the message.
	 * */
	protected function theplus_render_content( $settings ) {
		ob_start();
		?>
			<div class="protected-content">
				<?php
				if ( 'content' === $settings['content_type'] ) {
					if ( ! empty( $settings['protected_content_field'] ) ) {
						?>
							<p>
								<?php echo wp_kses_post( $settings['protected_content_field'] ); ?>
							</p>
						<?php
					}
				} elseif ( 'page_template' === $settings['content_type'] ) {
					if ( ! empty( $settings['protected_content_template'] ) ) {
						$theplus_et_id    = $settings['protected_content_template'];
						$theplus_frontend = new Frontend();

						echo $theplus_frontend->get_builder_content( $theplus_et_id, true );
					}
				}
				?>
			</div>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Check current user role
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 * */
	protected function current_user_writes() {
		if ( ! is_user_logged_in() ) {
			return;
		}

		$user_role = reset( wp_get_current_user()->roles );
		if ( $this->get_settings( 'pc_role' ) ) {
			return in_array( $user_role, $this->get_settings( 'pc_role' ) );
		}
	}

	/**
	 * Get list of user role for protected content widget end
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function theplus_pc_form( $settings, $widget_id ) {
		echo '<div class="theplus-password-pc-fields">';
			echo '<form class="theplus-pc-form" method="post">';
		if ( ! empty( $settings['form_input_text'] ) ) {
			$input_ph_text = $settings['form_input_text'];
		} else {
			$input_ph_text = 'Enter Password';
		}

		if ( ! empty( $settings['form_button_text'] ) ) {
			$input_btn_text = $settings['form_button_text'];
		} else {
			$input_btn_text = 'Submit';
		}
				echo '<input type="password" name="protection_password' . esc_attr( $widget_id ) . '" class="theplus-pc-password" placeholder="' . esc_attr( $input_ph_text ) . '">';
				echo '<input type="submit" value="' . esc_attr( $input_btn_text ) . '" class="theplus-pc-submit">';
			echo '</form>';
		if ( ! empty( $settings['error_message_text'] ) ) {
			$error_msg = $settings['error_message_text'];
		} else {
			$error_msg = 'Wrong Password,Please Try Again...!';
		}
		if ( isset( $_POST[ 'protection_password' . $widget_id ] ) && sanitize_text_field( $_POST[ 'protection_password' . $widget_id ] ) && ! isset( $_SESSION[ 'protection_password' . $widget_id ] ) ) {
			echo '<p class="theplus-pc-error-msg">' . $error_msg . '</p>';
		}
		echo '</div>';
	}
}

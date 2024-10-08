<?php
/**
 * Widget Name: TP Text Block
 * Description: Content of text text block.
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
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Adv_Text_Block.
 */
class ThePlus_Adv_Text_Block extends Widget_Base {

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
	 * @version 5.4.1
	 */
	public function get_name() {
		return 'tp-adv-text-block';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_title() {
		return esc_html__( 'TP Text Block', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_icon() {
		return 'fa fa-file-text theplus_backend_icon';
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
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function get_keywords() {
		return array( 'Advance Text Block', 'Advanced Text Block', 'Text Block', 'Enhanced Text Block', 'Improved Text Block', 'Customizable Text Block', 'Stylish Text Block', 'Unique Text Block', 'Elementor Text Block', 'Elementor Advanced Text Block', 'Elementor Enhanced Text Block', 'Elementor Customizable Text Block', 'Elementor Stylish Text Block', 'Elementor Unique Text Block', 'Elementor Addon Text Block', 'Text Block', 'Text Editor', 'Rich Text Editor', 'Elementor Text Editor', 'Elementor Rich Text Editor' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Advanced Text Block', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'content_description',
			array(
				'label'       => wp_kses_post( "Description <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "advanced-text-block-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_responsive_control(
			'content_align',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justify', 'theplus' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'prefix_class' => 'text-%s',
			)
		);
		$this->add_control(
			'display_count',
			array(
				'label'     => wp_kses_post( "Description Limit <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-wordcount-text-widget-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_count_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'theplus' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'display_count' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_count_input',
			array(
				'label'     => esc_html__( 'Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'display_count' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_3_dots',
			array(
				'label'     => esc_html__( 'Display Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'display_count' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_styling',
			array(
				'label' => esc_html__( 'Typography', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_adv_text_block .text-content-block p,{{WRAPPER}} .pt_plus_adv_text_block .text-content-block' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .pt_plus_adv_text_block .text-content-block,{{WRAPPER}} .pt_plus_adv_text_block .text-content-block p',
			)
		);

		$this->end_controls_section();
		/*Adv tab*/
		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'theplus' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();
		/*Adv tab*/

		/*--OnScroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		/*--OnScroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		/*--Plus Extra ---*/
		$PlusExtra_Class = 'plus-adv-text-widget';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$display_count       = ! empty( $settings['display_count'] ) ? $settings['display_count'] : '';
		$display_count_input = ! empty( $settings['display_count_input'] ) ? $settings['display_count_input'] : '';

		$description = ! empty( $settings['content_description'] ) ? $settings['content_description'] : '';

		if ( ( 'yes' === $display_count ) && ! empty( $display_count_input ) ) {

			$display_count_by = ! empty( $settings['display_count_by'] ) ? $settings['display_count_by'] : 'char';
			$display_3_dots   = ! empty( $settings['display_3_dots'] ) ? $settings['display_3_dots'] : '';

			if ( ! empty( $display_count_by ) ) {

				if ( 'char' === $display_count_by ) {
					$content_description = substr( $description, 0, $display_count_input );
				} elseif ( 'word' === $display_count_by ) {
					$content_description = $this->limit_words( $description, $display_count_input );
				}
			}

			if ( 'char' === $display_count_by ) {

				if ( strlen( $description ) > $display_count_input ) {
					if ( 'yes' === $display_3_dots ) {
						$content_description .= '...';
					}
				}
			} elseif ( 'word' === $display_count_by ) {

				if ( str_word_count( $description ) > $display_count_input ) {
					if ( 'yes' === $display_3_dots ) {
						$content_description .= '...';
					}
				}
			}
		} else {
			$content_description = $description;
		}

		$text_block = '<div class="pt-plus-text-block-wrapper" >';

			$text_block .= '<div class="text_block_parallax">';

				$text_block .= '<div class="pt_plus_adv_text_block ' . $animated_class . '" ' . $animation_attr . '>';

					$text_block .= '<div class="text-content-block">';

						$text_block .= wp_kses_post( $content_description );

					$text_block .= '</div>';

				$text_block .= '</div>';

			$text_block .= '</div>';

		$text_block .= '</div>';

		echo $before_content . $text_block . $after_content;
	}

	/**
	 * Limit_words.
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 *
	 * @param string $string_data     The input string.
	 * @param int    $word_limit The maximum number of words to allow.
	 * @return string            The truncated string.
	 */
	protected function limit_words( $string_data, $word_limit ) {
		$words = explode( ' ', $string_data );

		return implode( ' ', array_splice( $words, 0, $word_limit ) );
	}

	/**
	 * Content_template
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	protected function content_template() { }
}

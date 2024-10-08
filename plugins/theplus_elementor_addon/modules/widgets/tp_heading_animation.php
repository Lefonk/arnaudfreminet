<?php
/**
 * Widget Name: Heading Animattion
 * Description: Text Animation of style.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Heading_Animation.
 */
class ThePlus_Heading_Animation extends Widget_Base {

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
		return 'tp-heading-animation';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Heading Animation', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-i-cursor theplus_backend_icon';
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
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Animated Text', 'Text Animation', 'Animated Typography', 'Animated Heading', 'Animated Title', 'Animated Words' );
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
				'label' => esc_html__( 'Text Animation', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'anim_styles',
			array(
				'label'   => esc_html__( 'Animation Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'prefix',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Prefix Text', 'theplus' ),
				'label_block' => true,
				'description' => esc_html__( 'Enter Text, Which will be visible before the Animated Text.', 'theplus' ),
				'separator'   => 'before',
				'default'     => esc_html__( 'This is ', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'ani_title',
			array(
				'label'       => esc_html__( 'Animated Text', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'You need to add Multiple line by ctrl + Enter Or Shift + Enter for animated text.', 'theplus' ),
				'rows'        => 5,
				'default'     => esc_html__( 'Heading', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'ani_title_tag',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Animated Text Tag', 'theplus' ),
				'default' => 'h1',
				'options' => theplus_get_tags_options(),
			)
		);
		$this->add_control(
			'postfix',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Postfix Text', 'theplus' ),
				'label_block' => true,
				'description' => esc_html__( 'Enter Text, Which will be visible After the Animated Text.', 'theplus' ),
				'separator'   => 'before',
				'default'     => esc_html__( 'Animation', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_responsive_control(
			'heading_text_align',
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_prefix_postfix_styling',
			array(
				'label' => esc_html__( 'Prefix and Postfix', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'heading_anim_color',
			array(
				'label'     => esc_html__( 'Font Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'prefix_postfix_typography',
				'selector' => '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_heading_animation_styling',
			array(
				'label' => esc_html__( 'Animated Text', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ani_color',
			array(
				'label'     => esc_html__( 'Font Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline b' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ani_typography',
				'selector' => '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline b',
			)
		);
		$this->add_control(
			'ani_bg_color',
			array(
				'label'     => esc_html__( 'Animation Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d3d3d3',
				'condition' => array(
					'anim_styles!' => array( 'style-6' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation:not(.head-anim-style-6) .pt-plus-cd-headline b' => 'background: {{VALUE}};',
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
	 * Render
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$anim_styles = ! empty( $settings['anim_styles'] ) ? $settings['anim_styles'] : 'style-1';

		$prefix    = ! empty( $settings['prefix'] ) ? $settings['prefix'] : '';
		$postfix   = ! empty( $settings['postfix'] ) ? $settings['postfix'] : '';
		$ani_title = ! empty( $settings['ani_title'] ) ? $settings['ani_title'] : '';

		$ani_title_tag = ! empty( $settings['ani_title_tag'] ) ? $settings['ani_title_tag'] : 'h1';

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$heading_animation_back = 'style="';

		$ani_bgcolor = ! empty( $settings['ani_bg_color'] ) ? $settings['ani_bg_color'] : '#d3d3d3';
		if ( ! empty( $ani_bgcolor ) ) {
			$heading_animation_back .= 'background: ' . esc_attr( $ani_bgcolor ) . ';';
		}

		$heading_animation_back .= '"';

		$order   = array( "\r\n", "\n", "\r", '<br/>', '<br>' );
		$replace = '|';

		$str = str_replace( $order, $replace, $ani_title );

		$lines = explode( '|', $str );

		$count_lines = count( $lines );

		$background_css = '';

		$ani_focolor = ! empty( $settings['ani_color'] ) ? $settings['ani_color'] : '';

		if ( ! empty( $ani_focolor ) ) {
			$background_css .= 'background-color: ' . esc_attr( $ani_focolor ) . ';';
		}

		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$uid = uniqid( 'heading-animation' );

		$heading_animation = '<div class="pt-plus-heading-animation heading-animation head-anim-' . esc_attr( $anim_styles ) . ' ' . esc_attr( $animated_class ) . ' ' . esc_attr( $uid ) . '"  ' . $animation_attr . '>';

		if ( 'style-1' === $anim_styles ) {
			$heading_animation .= '<' . theplus_validate_html_tag( $ani_title_tag ) . ' class="pt-plus-cd-headline letters type" >';

			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span>' . wp_kses_post( $prefix ) . ' </span>';
			}

			$heading_animation .= '<span class="cd-words-wrapper waiting" ' . wp_kses( $heading_animation_back, array( 'style' => array() ) ) . '>';

			$i = 0;
			foreach ( $lines as $line ) {
				if ( 0 == $i ) {
					$heading_animation .= '<b  class="is-visible"> ' . strip_tags( $line ) . '</b>';
				} else {
					$heading_animation .= '<b> ' . strip_tags( $line ) . '</b>';
				}
				++$i;
			}

			$strings = '[';

			foreach ( $lines as $key => $line ) {
				$strings .= trim( htmlspecialchars_decode( strip_tags( $line ) ) );
				if ( $key != ( $count_lines - 1 ) ) {
					$strings .= ',';
				}
			}

			$strings .= ']';

			$heading_animation .= '</span>';
			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span> ' . wp_kses_post( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . theplus_validate_html_tag( $ani_title_tag ) . '>';
		}

		if ( 'style-2' === $anim_styles ) {
			$heading_animation .= '<' . theplus_validate_html_tag( $ani_title_tag ) . ' class="pt-plus-cd-headline rotate-1" >';

			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . wp_kses_post( $prefix ) . ' </span>';
			}

			$heading_animation .= '<span class="cd-words-wrapper">';

			$i = 0;
			foreach ( $lines as $line ) {
				if ( $i == 0 ) {
					$heading_animation .= '<b  class="is-visible"> ' . strip_tags( $line ) . '</b>';
				} else {
					$heading_animation .= '<b> ' . strip_tags( $line ) . '</b>';
				}

				++$i;
			}

			$strings = '[';
			foreach ( $lines as $key => $line ) {
				$strings .= trim( htmlspecialchars_decode( strip_tags( $line ) ) );
				if ( $key != ( $count_lines - 1 ) ) {
					$strings .= ',';
				}
			}

			$strings .= ']';

			$heading_animation .= '</span>';
			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . wp_kses_post( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . theplus_validate_html_tag( $ani_title_tag ) . '>';
		}

		if ( 'style-3' === $anim_styles ) {
			$heading_animation .= '<' . theplus_validate_html_tag( $ani_title_tag ) . ' class="pt-plus-cd-headline zoom" >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . wp_kses_post( $prefix ) . ' </span>';
			}

			$heading_animation .= '<span class="cd-words-wrapper">';

			$i = 0;

			foreach ( $lines as $line ) {
				if ( $i == 0 ) {
					$heading_animation .= ' <b  class="is-visible ">' . strip_tags( $line ) . '</b>';
				} else {
					$heading_animation .= ' <b>' . strip_tags( $line ) . '</b>';
				}
					++$i;
			}

			$strings = '[';
			foreach ( $lines as $key => $line ) {
				$strings .= trim( htmlspecialchars_decode( strip_tags( $line ) ) );
				if ( $key != ( $count_lines - 1 ) ) {
					$strings .= ',';
				}
			}
			$strings           .= ']';
			$heading_animation .= '</span>';
			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . wp_kses_post( $postfix ) . ' </span>';
			}
			$heading_animation .= '</' . theplus_validate_html_tag( $ani_title_tag ) . '>';
		}

		if ( 'style-4' === $anim_styles ) {
			$heading_animation .= '<' . theplus_validate_html_tag( $ani_title_tag ) . ' class="pt-plus-cd-headline loading-bar " >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . wp_kses_post( $prefix ) . ' </span>';
			}
			$heading_animation .= '<span class="cd-words-wrapper">';
			$i                  = 0;
			foreach ( $lines as $line ) {
				if ( $i == 0 ) {
					$heading_animation .= ' <b class="is-visible ">' . strip_tags( $line ) . '</b>';
				} else {
					$heading_animation .= ' <b>' . strip_tags( $line ) . '</b>';
				}
				++$i;
			}

			$strings = '[';
			foreach ( $lines as $key => $line ) {
				$strings .= trim( htmlspecialchars_decode( strip_tags( $line ) ) );
				if ( $key != ( $count_lines - 1 ) ) {
					$strings .= ',';
				}
			}
			$strings           .= ']';
			$heading_animation .= '</span>';
			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . wp_kses_post( $postfix ) . '</span>';
			}
			$heading_animation .= '</' . theplus_validate_html_tag( $ani_title_tag ) . '>';
		}

		if ( 'style-5' === $anim_styles ) {
			$heading_animation .= '<' . theplus_validate_html_tag( $ani_title_tag ) . ' class="pt-plus-cd-headline push" >';

			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . wp_kses_post( $prefix ) . ' </span>';
			}

			$heading_animation .= '<span class="cd-words-wrapper">';

			$i = 0;
			foreach ( $lines as $line ) {
				if ( $i == 0 ) {
					$heading_animation .= '<b  class="is-visible "> ' . strip_tags( $line ) . '</b>';
				} else {
					$heading_animation .= '<b> ' . strip_tags( $line ) . '</b>';
				}
				++$i;
			}

			$strings = '[';

			foreach ( $lines as $key => $line ) {
				$strings .= trim( htmlspecialchars_decode( strip_tags( $line ) ) );
				if ( $key != ( $count_lines - 1 ) ) {
					$strings .= ',';
				}
			}

			$strings .= ']';

			$heading_animation .= '</span>';

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . wp_kses_post( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . theplus_validate_html_tag( $ani_title_tag ) . '>';
		}

		if ( 'style-6' === $anim_styles ) {
			$heading_animation .= '<' . theplus_validate_html_tag( $ani_title_tag ) . ' class="pt-plus-cd-headline letters scale" >';

			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . wp_kses_post( $prefix ) . ' </span>';
			}

			$heading_animation .= '<span class="cd-words-wrapper style-6"   >';

			$i = 0;

			foreach ( $lines as $line ) {
				if ( $i == 0 ) {
					$heading_animation .= '<b  class="is-visible ">' . strip_tags( $line ) . '</b>';
				} else {
					$heading_animation .= '<b>' . strip_tags( $line ) . '</b>';
				}
					++$i;
			}

			$strings = '[';

			foreach ( $lines as $key => $line ) {
				$strings .= trim( htmlspecialchars_decode( strip_tags( $line ) ) );
				if ( $key != ( $count_lines - 1 ) ) {
					$strings .= ',';
				}
			}

			$strings .= ']';

			$heading_animation .= '</span>';
			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . wp_kses_post( $postfix ) . ' </span>';
			}
			$heading_animation .= '</' . theplus_validate_html_tag( $ani_title_tag ) . '>';
		}

		$heading_animation .= '</div>';

		$css_rule  = '';
		$css_rule .= '<style>';
		$css_rule .= '.' . esc_attr( $uid ) . ' .pt-plus-cd-headline.loading-bar .cd-words-wrapper::after{' . esc_attr( $background_css ) . '}';
		$css_rule .= '</style>';

		echo $css_rule . $before_content . $heading_animation . $after_content;
	}
}

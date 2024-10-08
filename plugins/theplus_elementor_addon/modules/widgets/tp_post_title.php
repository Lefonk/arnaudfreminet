<?php
/**
 * Widget Name: Post Title
 * Description: Post Title
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Post_Title.
 */
class ThePlus_Post_Title extends Widget_Base {

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
		return 'tp-post-title';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Post Title', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-underline theplus_backend_icon';
	}

	/**
	 * Get Custom url.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-builder' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Post Title', 'Title', 'Blog Title', 'Article Title', 'Page Title', 'Post Name', 'Article Name', 'Page Name' );
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
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Post Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'posttype',
			array(
				'label'   => esc_html__( 'Post Types', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'singlepage',
				'options' => array(
					'singlepage'  => esc_html__( 'Single Page', 'theplus' ),
					'archivepage' => esc_html__( 'Archive Page', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'titleprefix',
			array(
				'label'   => esc_html__( 'Prefix Text', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'titlepostfix',
			array(
				'label'   => esc_html__( 'Postfix Text', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'titleTag',
			array(
				'label'   => esc_html__( 'Tag', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => array(
					'h1'   => esc_html__( 'H1', 'theplus' ),
					'h2'   => esc_html__( 'H2', 'theplus' ),
					'h3'   => esc_html__( 'H3', 'theplus' ),
					'h4'   => esc_html__( 'H4', 'theplus' ),
					'h5'   => esc_html__( 'H5', 'theplus' ),
					'h6'   => esc_html__( 'H6', 'theplus' ),
					'div'  => esc_html__( 'Div', 'theplus' ),
					'span' => esc_html__( 'Span', 'theplus' ),
					'p'    => esc_html__( 'P', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Box Alignment', 'theplus' ),
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
					'{{WRAPPER}} .tp-post-title' => 'justify-content: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'textAlignment',
			array(
				'label'     => esc_html__( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .tp-post-title' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_opt_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'titleLink',
			array(
				'label'     => esc_html__( 'Link', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
			)
		);
		$this->add_control(
			'limitCountType',
			array(
				'label'   => esc_html__( 'Length Limit', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'       => esc_html__( 'No Limit', 'theplus' ),
					'limitByLetter' => esc_html__( 'Based on Letters', 'theplus' ),
					'limitByWord'   => esc_html__( 'Based on Words', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'titleLimit',
			array(
				'label'     => esc_html__( 'Limit of Words/Character', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 5000,
				'step'      => 1,
				'default'   => 10,
				'condition' => array(
					'limitCountType!' => 'default',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'NormalColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'HoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_prepost_style',
			array(
				'label'      => esc_html__( 'Prefix/Postfix', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'titleprefix',
							'operator' => '!=',
							'value'    => '',
						),
						array(
							'name'     => 'titlepostfix',
							'operator' => '!=',
							'value'    => '',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'prepostpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'prepostmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'preoffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Prefix Offset', 'theplus' ),
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
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost.tp-prefix' => 'margin-right: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'postoffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Postfix Offset', 'theplus' ),
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
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost.tp-postfix' => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'preposttypography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'prepostColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'prepostboxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'prepostboxBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
			)
		);
		$this->add_responsive_control(
			'prepostboxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'prepostboxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		$posttype   = ! empty( $settings['posttype'] ) ? $settings['posttype'] : 'singlepage';
		$titletag   = ! empty( $settings['titleTag'] ) ? $settings['titleTag'] : 'h3';
		$title_link = ! empty( $settings['titleLink'] ) ? $settings['titleLink'] : 'no';
		$text_limit = ! empty( $settings['titleLimit'] ) ? $settings['titleLimit'] : 10;

		$titleprefix  = ! empty( $settings['titleprefix'] ) ? $settings['titleprefix'] : '';
		$titlepostfix = ! empty( $settings['titlepostfix'] ) ? $settings['titlepostfix'] : '';

		$limit_count_type = ! empty( $settings['limitCountType'] ) ? $settings['limitCountType'] : '';

		if ( 'archivepage' === $posttype ) {
			add_filter(
				'get_the_archive_title',
				function ( $title ) {
					if ( is_category() ) {
						$title = single_cat_title( '', false );
					} elseif ( is_tag() ) {
						$title = single_tag_title( '', false );
					} elseif ( is_author() ) {
						$title = '<span class="vcard">' . get_the_author() . '</span>';
					} elseif ( is_tax() ) {
						$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
					} elseif ( is_post_type_archive() ) {
						$title = post_type_archive_title( '', false );
					} elseif ( is_search() ) {
						$title = get_search_query();
					}
					return $title;
				}
			);
		}

		if ( ! empty( $posttype ) ) {
			if ( 'limitByWord' === $limit_count_type ) {
				if ( 'singlepage' === $posttype ) {
					$title = wp_trim_words( get_the_title( $post_id ), $text_limit );
				} elseif ( 'archivepage' === $posttype ) {
					$title = wp_trim_words( get_the_archive_title(), $text_limit );
				}
			} elseif ( 'limitByLetter' === $limit_count_type ) {
				if ( 'singlepage' === $posttype ) {
					$title = substr( wp_trim_words( get_the_title( $post_id ) ), 0, $text_limit ) . '...';
				} elseif ( 'archivepage' === $posttype ) {
					$title = substr( wp_trim_words( get_the_archive_title() ), 0, $text_limit ) . '...';
				}
			} elseif ( 'singlepage' === $posttype ) {
				$title = get_the_title( $post_id );
			} elseif ( 'archivepage' === $posttype ) {
				$title = get_the_archive_title();
			}
		}

		$output = '<div class="tp-post-title">';

			$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['boxBg_image'], $settings['boxBgHover_image'] ) : '';

		if ( ! empty( $title_link ) && 'yes' === $title_link ) {
			$output .= '<a class="' . esc_attr( $lz1 ) . '" href="' . get_the_permalink() . '" >';
		}

			$output .= '<' . theplus_validate_html_tag( $titletag ) . ' class="tp-entry-title ' . esc_attr( $lz1 ) . '">';

			$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['prepostboxBg_image'] ) : '';

		if ( ! empty( $titleprefix ) ) {
			$output .= '<span class="tp-post-title-prepost tp-prefix ' . esc_attr( $lz2 ) . '">' . wp_kses_post( $titleprefix ) . '</span>';
		}

			$output .= $title;

		if ( ! empty( $titlepostfix ) ) {
			$output .= '<span class="tp-post-title-prepost tp-postfix ' . esc_attr( $lz2 ) . '">' . wp_kses_post( $titlepostfix ) . '</span>';
		}

			$output .= '</' . theplus_validate_html_tag( $titletag ) . '>';

		if ( ! empty( $title_link ) && 'yes' === $title_link ) {
			$output .= '</a>';
		}

		$output .= '</div>';

		echo $output;
	}

	/**
	 * Render content_template.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}

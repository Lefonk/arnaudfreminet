<?php
/**
 * Widget Name: Site Logo
 * Description: Site Logo.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Site_Logo
 */
class ThePlus_Site_Logo extends Widget_Base {

	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-site-logo';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Site Logo', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-fire theplus_backend_icon';
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-header' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'site logo', 'logo widget', 'logo', 'elementor site logo', 'logo for elementor', 'elementor logo addon' );
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
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start */
		$this->start_controls_section(
			'normal_logo_sections',
			array(
				'label' => esc_html__( 'Site Logo', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'logo_animate',
			array(
				'label'   => esc_html__( 'Logo Normal/Double', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => array(
					'normal' => esc_html__( 'Normal', 'theplus' ),
					'double' => esc_html__( 'Double', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'logo_type',
			array(
				'label'   => wp_kses_post( "Logo Type <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "change-site-logo-on-hover-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => array(
					'image' => esc_html__( 'Image', 'theplus' ),
					'svg'   => esc_html__( 'SVG', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'image_logo',
			array(
				'label'      => esc_html__( 'Image Logo', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'image',
				'default'    => array(
					'url' => '',
				),
				'condition'  => array(
					'logo_animate' => array( 'normal', 'double' ),
					'logo_type'    => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_logo_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'logo_animate' => array( 'normal', 'double' ),
					'logo_type'    => 'image',
				),
			)
		);
		$this->add_control(
			'svg_logo',
			array(
				'label'       => esc_html__( 'Only Svg Logo', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select Only .svg File from media library.', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'media_type'  => 'image',
				'condition'   => array(
					'logo_animate' => array( 'normal', 'double' ),
					'logo_type'    => 'svg',
				),
			)
		);
		$this->add_responsive_control(
			'logo_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Logo Max Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-site-logo .site-normal-logo img.image-logo-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'logo_animate' => array( 'normal', 'double' ),
				),
			)
		);
		$this->add_control(
			'hover_image_logo',
			array(
				'label'      => esc_html__( 'Hover Logo Image', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'image',
				'default'    => array(
					'url' => '',
				),
				'condition'  => array(
					'logo_animate' => 'double',
					'logo_type'    => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'hover_image_logo_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'logo_animate' => 'double',
					'logo_type'    => 'image',
				),
			)
		);
		$this->add_control(
			'hover_svg_logo',
			array(
				'label'       => esc_html__( 'Hover Svg Logo', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select Only .svg File from media library.', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'media_type'  => 'image',
				'condition'   => array(
					'logo_animate' => 'double',
					'logo_type'    => 'svg',
				),
			)
		);
		$this->add_responsive_control(
			'hover_logo_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Hover Logo Max Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-site-logo .site-normal-logo.hover-logo img.image-logo-wrap' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'logo_animate' => 'double',
				),
			)
		);
		$this->end_controls_section();

		/** Extra Option Section Start */
		$this->start_controls_section(
			'section_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'logo_url_type',
			array(
				'label'     => esc_html__( 'Logo Url Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'home_url',
				'options'   => array(
					'home_url'   => esc_html__( 'Home URL', 'theplus' ),
					'custom_url' => esc_html__( 'Custom Link', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'logo_url',
			array(
				'label'         => esc_html__( 'Logo Url', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'     => array(
					'logo_url_type' => 'custom_url',
				),
			)
		);
		$this->add_responsive_control(
			'logo_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .plus-site-logo' => 'text-align:{{VALUE}};',
				),
				'separator'   => 'before',
				'default'     => 'text-center',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_control(
			'sticky_logo',
			array(
				'label'     => wp_kses_post( "Sticky Logo <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "change-logo-in-sticky-header-on-scroll-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => '',
				'separator' => 'before',
				'condition' => array(
					'logo_animate' => 'normal',
				),
			)
		);
		$this->add_control(
			'sticky_image_logo',
			array(
				'label'      => esc_html__( 'Image Logo', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'image',
				'default'    => array(
					'url' => '',
				),
				'condition'  => array(
					'logo_animate' => 'normal',
					'logo_type'    => 'image',
					'sticky_logo'  => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'sticky_image_logo_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'logo_animate' => 'normal',
					'logo_type'    => 'image',
					'sticky_logo'  => 'yes',
				),
			)
		);
		$this->add_control(
			'sticky_svg_logo',
			array(
				'label'       => esc_html__( 'Only Svg Logo', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select Only .svg File from media library.', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'media_type'  => 'image',
				'condition'   => array(
					'logo_animate' => 'normal',
					'logo_type'    => 'svg',
					'sticky_logo'  => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sticky_logo_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Logo Max Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'separator'   => 'after',
				'selectors'   => array(
					'{{WRAPPER}} .plus-site-logo .site-normal-logo img.image-logo-wrap.sticky-image' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'logo_animate' => 'normal',
					'sticky_logo'  => 'yes',
				),
			)
		);

		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Site Logo
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$logo_url_type = ! empty( $settings['logo_url_type'] ) ? $settings['logo_url_type'] : 'home_url';
		$sticky_logo   = ! empty( $settings['sticky_logo'] ) ? $settings['sticky_logo'] : '';
		$logo_animate  = ! empty( $settings['logo_animate'] ) ? $settings['logo_animate'] : 'normal';
		$logo_type     = ! empty( $settings['logo_type'] ) ? $settings['logo_type'] : 'image';

		$logo_alignment = '';

		// Logo URL.
		$logo_url = '';
		$target   = '';
		$nofollow = '';

		if ( 'home_url' === $logo_url_type ) {
			$logo_url = get_home_url();
		} elseif ( 'custom_url' === $logo_url_type ) {
			$target   = $settings['logo_url']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['logo_url']['nofollow'] ? ' rel="nofollow"' : '';
			$logo_url = $settings['logo_url']['url'];
		}

		$stcky_cls = '';
		if ( 'yes' === $sticky_logo ) {
			$stcky_cls = 'tp-sticky-logo-cls';
		}

		/** Normal Logo*/
		$normal_logo  = '';
		$normal_hover = '';

		$normal_logo_hover = '';
		if ( 'image' === $logo_type ) {

			/** Image Logo*/
			if ( ! empty( $settings['image_logo']['url'] ) ) {
				$image_logo = $settings['image_logo']['id'];

				$img = wp_get_attachment_image_src( $image_logo, $settings['image_logo_thumbnail_size'] );

				$logo_image = ! empty( $img ) ? $img[0] : '';

				$normal_logo = '<a href="' . esc_url( $logo_url ) . '" ' . $target . $nofollow . ' title="' . esc_attr( get_bloginfo() ) . '" class="site-normal-logo image-logo" >';

					$normal_logo .= '<img src="' . esc_url( $logo_image ) . '" class="image-logo-wrap normal-image ' . esc_attr( $stcky_cls ) . '" alt="' . esc_attr( get_bloginfo() ) . '">';

				if ( 'yes' === $sticky_logo ) {
					if ( ! empty( $settings['sticky_image_logo']['url'] ) ) {
						$sticky_image_logo = $settings['sticky_image_logo']['id'];
						$sticky_img        = wp_get_attachment_image_src( $sticky_image_logo, $settings['sticky_image_logo_thumbnail_size'] );

						$sticky_logo_image = $sticky_img[0];
						$normal_logo      .= '<img src="' . esc_url( $sticky_logo_image ) . '" class="image-logo-wrap sticky-image" alt="' . esc_attr( get_bloginfo() ) . '">';
					}
				}

				$normal_logo .= '</a>';
			}

			if ( 'double' === $logo_animate ) {
				if ( ! empty( $settings['hover_image_logo']['url'] ) ) {
					$hover_image_logo = $settings['hover_image_logo']['id'];
					$img              = wp_get_attachment_image_src( $hover_image_logo, $settings['hover_image_logo_thumbnail_size'] );
					$hover_logo_image = $img[0];

					$normal_logo_hover      = '<a href="' . esc_url( $logo_url ) . '" ' . $target . $nofollow . ' title="' . esc_attr( get_bloginfo() ) . '" class="site-normal-logo image-logo hover-logo" >';
						$normal_logo_hover .= '<img src="' . esc_url( $hover_logo_image ) . '" class="image-logo-wrap" alt="' . esc_attr( get_bloginfo() ) . '">';
					$normal_logo_hover     .= '</a>';
					$normal_hover           = ' logo-hover-normal';
				}
			}
		} elseif ( 'svg' === $logo_type ) {

			/** SVG Logo*/
			if ( ! empty( $settings['svg_logo']['url'] ) ) {
				$logo_svg         = $settings['svg_logo']['url'];
				$normal_logo      = '<a href="' . esc_url( $logo_url ) . '" ' . $target . $nofollow . ' title="' . esc_attr( get_bloginfo() ) . '" class="site-normal-logo svg-logo">';
					$normal_logo .= '<img class="image-logo-wrap normal-image  ' . esc_attr( $stcky_cls ) . '" src="' . esc_url( $logo_svg ) . '" alt="' . esc_attr( get_bloginfo() ) . '" />';

				if ( 'yes' === $sticky_logo ) {
					if ( ! empty( $settings['sticky_svg_logo']['url'] ) ) {
						$sticky_svg_logo = $settings['sticky_svg_logo']['url'];
						$normal_logo    .= '<img class="image-logo-wrap sticky-image" src="' . esc_url( $sticky_svg_logo ) . '" alt="' . esc_attr( get_bloginfo() ) . '" />';
					}
				}
				$normal_logo .= '</a>';
			}

			if ( 'double' === $logo_animate ) {
				if ( ! empty( $settings['hover_svg_logo']['url'] ) ) {
					$hover_logo_svg = $settings['hover_svg_logo']['url'];

					$normal_logo_hover      = '<a href="' . esc_url( $logo_url ) . '" ' . $target . $nofollow . ' title="' . esc_attr( get_bloginfo() ) . '" class="site-normal-logo svg-logo hover-logo">';
						$normal_logo_hover .= '<img class="image-logo-wrap" src="' . esc_url( $hover_logo_svg ) . '" alt="' . esc_attr( get_bloginfo() ) . '" />';
					$normal_logo_hover     .= '</a>';
					$normal_hover           = ' logo-hover-normal';
				}
			}
		}

		$site_logo          = '<div class="plus-site-logo ' . esc_attr( $logo_alignment ) . ' ">';
			$site_logo     .= '<div class="site-logo-wrap ' . esc_attr( $normal_hover ) . '">';
				$site_logo .= $normal_logo;
				$site_logo .= $normal_logo_hover;
			$site_logo     .= '</div>';
		$site_logo         .= '</div>';

		echo $site_logo;
	}

	/**
	 * Render content_template
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}

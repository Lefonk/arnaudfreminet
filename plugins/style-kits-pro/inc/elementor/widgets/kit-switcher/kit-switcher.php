<?php
/**
 * Class for kit switcher widget.
 *
 * @package AnalogPRO
 */

namespace AnalogPro\Elementor\Widget;

use Analog\Plugin;
use Analog\Utils;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Core\Base\Document;
use Elementor\Core\Files\CSS\Post as Post_CSS;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Exception;

/**
 * Analog Kit Switcher widget.
 *
 * @since 1.0.2
 */
class Kit_Switcher extends Widget_Base {

	/**
	 * Holds current elementor document.
	 *
	 * @var Document|false
	 */
	private $document;

	/**
	 * Widget path
	 *
	 * @var  string
	 */
	private $widget_path;

	/**
	 * Widget base constructor.
	 *
	 * Initializing the widget base class.
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @throws Exception If arguments are missing when initializing a full widget
	 *                   instance.
	 *
	 * @param array      $data Widget data. Default is an empty array.
	 * @param array|null $args Optional. Widget default arguments. Default is null.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		$this->widget_path = ANG_PRO_URL . 'inc/elementor/widgets/kit-switcher/';

		wp_register_script( 'ang-widget-kit-switcher', $this->widget_path . 'module.js', array( 'elementor-frontend' ), filemtime( ANG_PRO_PATH . 'inc/elementor/widgets/kit-switcher/module.js' ), true );
		wp_register_style( 'ang-widget-kit-switcher', $this->widget_path . 'module.css', array(), filemtime( ANG_PRO_PATH . 'inc/elementor/widgets/kit-switcher/module.css' ) );

		$this->document = Plugin::elementor()->documents->get_doc_for_frontend( get_the_ID() );

		add_action( 'elementor/preview/enqueue_styles', array( $this, 'editor_enqueue_style' ), 999 );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'editor_enqueue_script' ), 999 );
	}

	/**
	 * Enqueue frontend styles.
	 *
	 * @since 1.1.3
	 * @return void
	 */
	public function frontend_before_enqueue_styles() {
		$settings = $this->get_settings_for_display();

		if ( 'toggle' === $settings['switcher_style'] ) {
			$kit = $settings['toggle_b_kit'];

			if ( ! wp_style_is( 'elementor-post-' . $kit, 'enqueued' ) && ! Plugin::elementor()->preview->is_preview() ) {
				wp_enqueue_style( 'elementor-post' . $kit );

				$css = Post_CSS::create( $kit );
				$css->enqueue();
			}
		}

		if ( 'dropdown' === $settings['switcher_style'] ) {
			$kits = $settings['kits'];

			foreach ( $kits as $kit ) {
				if ( ! wp_style_is( 'elementor-post-' . $kit, 'enqueued' ) && ! Plugin::elementor()->preview->is_preview() ) {
					wp_enqueue_style( 'elementor-post' . $kit );

					$css = Post_CSS::create( $kit );
					$css->enqueue();
				}
			}
		}
	}

	/**
	 * Enqueue styles inside preview iframe.
	 *
	 * @since 1.1.3
	 * @return void
	 */
	public function editor_enqueue_style() {
		$kits = array_keys( $this->get_kits() );

		foreach ( $kits as $kit ) {
			if ( ! wp_style_is( 'elementor-post-' . $kit, 'enqueued' ) &&
				Plugin::elementor()->preview->is_preview() ) {

				wp_enqueue_style( 'elementor-post' . $kit );

				$css = Post_CSS::create( $kit );
				$css->enqueue();
			}
		}
	}

	/**
	 * Enqueue scripts for editor screen.
	 *
	 * @since 1.1.3
	 * @return void
	 */
	public function editor_enqueue_script() {
		wp_enqueue_script( 'ang-widget-kit-switcher-editor', $this->widget_path . 'editor.js', array( 'jquery', 'elementor-editor', 'lodash' ), ANG_VERSION, true );
	}

	/**
	 * Get script dependencies.
	 *
	 * Retrieve the list of script dependencies the element requires.
	 *
	 * @since 1.1.3
	 *
	 * @return array Element script dependencies.
	 */
	public function get_script_depends() {
		return array( 'ang-widget-kit-switcher' );
	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 *
	 * @since 1.1.3
	 *
	 * @return array Element styles dependencies.
	 */
	public function get_style_depends() {
		return array( 'ang-widget-kit-switcher' );
	}

	/**
	 * Get widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'kit-switcher';
	}

	/**
	 * Get widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SK - Style Switcher', 'ang-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-user-preferences';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'kit', 'switcher', 'page style', 'sk', 'style kits', 'style' );
	}

	/**
	 * Register Kit Switcher widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'switcher',
			array(
				'label' => __( 'Switcher', 'ang-pro' ),
			)
		);

		$this->add_control(
			'switcher_style',
			array(
				'label'       => __( 'Switcher Style', 'ang-pro' ),
				'type'        => Controls_Manager::SELECT,
				'description' => __( 'The Toggle switcher would allow you to switch between two Style Kits. Useful for Dark / Night mode.', 'ang-pro' ) . sprintf( ' <a href="%1$s" target="_blank">%2$s</a>', 'https://analogwp.com/docs/the-style-kit-switcher/', __( 'Learn more.', 'ang-pro' ) ),
				'default'     => 'toggle',
				'options'     => array(
					'toggle'   => __( 'Toggle', 'ang-pro' ),
					'dropdown' => __( 'Dropdown', 'ang-pro' ),
				),
			)
		);

		$this->add_control(
			'dropdown_icon',
			array(
				'label'     => __( 'Icon', 'ang-pro' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-chevron-down',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'switcher_style' => 'dropdown',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle_a',
			array(
				'label'     => __( 'Toggle A - Default', 'ang-pro' ),
				'condition' => array(
					'switcher_style' => 'toggle',
				),
			)
		);

		$this->add_control(
			'toggle_a_icon',
			array(
				'label'            => __( 'Icon', 'ang-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value'   => 'fas fa-adjust',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'toggle_a_instructions',
			array(
				'raw'             => '<strong>' . __( 'Please note!', 'ang-pro' ) . '</strong> ' . __( 'Toggle A uses active Style Kit by default. You may choose a different Kit in Toggle B.', 'ang-pro' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle_b',
			array(
				'label'     => __( 'Toggle B', 'ang-pro' ),
				'condition' => array(
					'switcher_style' => 'toggle',
				),
			)
		);

		$this->add_control(
			'toggle_b_icon',
			array(
				'label'            => __( 'Icon', 'ang-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value'   => 'fas fa-adjust',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'toggle_b_kit',
			array(
				'label'   => __( 'Style Kit', 'ang-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_kits(),
				'default' => array_keys( $this->get_kits() )[0],
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'kit_dropdown',
			array(
				'label'     => __( 'Style Kits Dropdown', 'ang-pro' ),
				'condition' => array(
					'switcher_style' => 'dropdown',
				),
			)
		);

		$this->add_control(
			'kits',
			array(
				'label'       => __( 'Select Style Kits to display in dropdown', 'ang-pro' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->get_kits(),
				'default'     => array(
					$this->get_default_style_kit_id(),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle_container_style',
			array(
				'label'     => __( 'Toggle Container', 'ang-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'toggle',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_padding',
			array(
				'label'      => __( 'Padding', 'ang-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem', 'vw', 'custom' ),
				'default'    => array(
					'top'    => '10',
					'bottom' => '10',
					'left'   => '10',
					'right'  => '10',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ang-widget--kit-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_font_size',
			array(
				'label'      => __( 'Icon Size', 'ang-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'range'      => array(
					'em'  => array(
						'min'  => 0,
						'max'  => 5,
						'step' => 0.1,
					),
					'rem' => array(
						'min'  => 0,
						'max'  => 5,
						'step' => 0.1,
					),
					'px'  => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'%'   => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ang-widget--kit-toggle i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'ang-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'ang-pro' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ang-pro' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ang-pro' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-switcher' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'toggle_border',
				'exclude'  => array( 'color' ),
				'selector' => '{{WRAPPER}} .ang-widget--kit-toggle',
			)
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ang-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem', 'custom' ),
				'default'    => array(
					'top'    => '3',
					'bottom' => '3',
					'left'   => '3',
					'right'  => '3',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ang-widget--kit-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle_a_style',
			array(
				'label'     => __( 'Toggle A', 'ang-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'toggle',
				),
			)
		);

		$this->add_control(
			'toggle_a_background_color',
			array(
				'label'     => __( 'Background Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1F2022',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-toggle.kit_a, {{WRAPPER}} .ang-widget--kit-toggle.kit_b:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_a_icon_color',
			array(
				'label'     => __( 'Icon Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-toggle .toggle_a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_a_border_color',
			array(
				'label'     => __( 'Border Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-toggle.kit_a' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle_b_style',
			array(
				'label'     => __( 'Toggle B', 'ang-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'toggle',
				),
			)
		);

		$this->add_control(
			'toggle_b_background_hover_color',
			array(
				'label'     => __( 'Background Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-toggle:hover, {{WRAPPER}} .ang-widget--kit-toggle.kit_b' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_b_icon_hover_color',
			array(
				'label'     => __( 'Icon Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1F2022',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-toggle .toggle_b' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'toggle_b_border_hover_color',
			array(
				'label'     => __( 'Border Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-toggle:hover, {{WRAPPER}} .ang-widget--kit-toggle.kit_b' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_style',
			array(
				'label'     => __( 'Dropdown Style', 'ang-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'dropdown',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => __( 'Typography', 'ang-pro' ),
				'name'     => 'dropdown_typography',
				'selector' => '{{WRAPPER}} .ang-widget--kit-dropdown .dropdown',
			)
		);

		$this->add_responsive_control(
			'dropdown_width',
			array(
				'label'                => __( 'Width', 'ang-pro' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'auto',
				'options'              => array(
					'inherit' => __( 'Full Width', 'ang-pro' ) . ' (100%)',
					'auto'    => __( 'Inline', 'ang-pro' ) . ' (auto)',
					'initial' => __( 'Custom', 'ang-pro' ),
				),
				'selectors_dictionary' => array(
					'inherit' => '100%',
				),
				'selectors'            => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .dropdown' => 'width: {{VALUE}}; max-width: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_custom_width',
			array(
				'label'       => __( 'Custom Width', 'ang-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition'   => array(
					'dropdown_width' => 'initial',
				),
				'device_args' => array(
					Controls_Stack::RESPONSIVE_TABLET => array(
						'condition' => array(
							'dropdown_width_tablet' => array( 'initial' ),
						),
					),
					Controls_Stack::RESPONSIVE_MOBILE => array(
						'condition' => array(
							'dropdown_width_mobile' => array( 'initial' ),
						),
					),
				),
				'size_units'  => array( 'px', '%', 'vw' ),
				'selectors'   => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .dropdown' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'dropdown_text_color',
			array(
				'label'     => __( 'Text Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .dropdown' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'dropdown_background_color',
			array(
				'label'     => __( 'Background Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EBEBEB',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .dropdown' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_padding',
			array(
				'label'      => __( 'Padding', 'ang-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem', 'vw', 'custom' ),
				'default'    => array(
					'top'    => '10',
					'bottom' => '10',
					'left'   => '10',
					'right'  => '10',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'dropdown_border',
				'selector'       => '{{WRAPPER}} .ang-widget--kit-dropdown .dropdown',
				'separator'      => 'before',
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'    => 1,
							'bottom' => 1,
							'left'   => 1,
							'right'  => 1,
							'unit'   => 'px',
						),
					),
					'color'  => array(
						'default' => '#CBCBCB',
					),
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ang-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem', 'custom' ),
				'default'    => array(
					'top'    => '3',
					'bottom' => '3',
					'left'   => '3',
					'right'  => '3',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_icon_style',
			array(
				'label'     => __( 'Dropdown Icon', 'ang-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'dropdown',
				),
			)
		);

		$this->add_control(
			'dropdown_icon_color',
			array(
				'label'     => __( 'Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ang-widget--kit-dropdown svg' => 'fill: {{VALUE}};',
				),
				'global' => array(
					'default' => Global_Colors::COLOR_PRIMARY,
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_icon_size',
			array(
				'label'     => __( 'Size', 'ang-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_icon_align',
			array(
				'label'                => __( 'Alignment', 'ang-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'ang-pro' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'ang-pro' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'ang-pro' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'              => 'middle',
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'selectors'            => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .current' => 'display: flex; align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_icon_rotate',
			array(
				'label'          => __( 'Rotate', 'ang-pro' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'deg' ),
				'default'        => array(
					'size' => 0,
					'unit' => 'deg',
				),
				'tablet_default' => array(
					'unit' => 'deg',
				),
				'mobile_default' => array(
					'unit' => 'deg',
				),
				'selectors'      => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown i, {{WRAPPER}} .ang-widget--kit-dropdown svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_list_style',
			array(
				'label'     => __( 'Dropdown List', 'ang-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'dropdown',
				),
			)
		);

		$this->add_control(
			'dropdown_list_color',
			array(
				'label'     => __( 'Text Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .list' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'dropdown_list_background_color',
			array(
				'label'     => __( 'Background Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EBEBEB',
				'selectors' => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .list' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_list_padding',
			array(
				'label'      => __( 'Padding', 'ang-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem', 'vw', 'custom' ),
				'default'    => array(
					'top'    => '10',
					'bottom' => '10',
					'left'   => '10',
					'right'  => '10',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ang-widget--kit-dropdown .list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_list_position',
			array(
				'label'        => __( 'Position', 'ang-pro' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'ang-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ang-pro' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ang-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'elementor%s-align-',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render "Kit Switcher" widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.3
	 *
	 * @access protected
	 */
	protected function render() {
		$settings         = $this->get_settings_for_display();
		$active_kit       = $this->get_default_style_kit_id();
		$all_kits         = $this->get_kits();
		$flipped_settings = array();

		if ( ! empty( $settings['kits'] ) ) {
			$flipped_settings = array_flip( $settings['kits'] );
		}

		$common_settings = array_intersect_key( $all_kits, $flipped_settings );
		$sk_to_display   = array_reverse( $common_settings, true );

		$current_option = reset( $sk_to_display );

		$this->frontend_before_enqueue_styles();


		?>
		<div class="ang-widget ang-widget--kit-switcher">
			<?php if ( 'toggle' === $settings['switcher_style'] ) : ?>
			<div class="ang-widget--kit-toggle kit_a" data-current_kit="kit_a" style="display:inline-block">
				<i class="toggle_a <?php echo esc_attr( $settings['toggle_a_icon']['value'] ); ?>" data-kit="<?php echo esc_attr( $active_kit ); ?>"></i>
				<i class="toggle_b <?php echo esc_attr( $settings['toggle_b_icon']['value'] ); ?>" data-kit="<?php echo esc_attr( $settings['toggle_b_kit'] ); ?>"></i>
			</div>
			<?php endif; ?>

			<?php
			if ( 'dropdown' === $settings['switcher_style'] ) :

				if ( ! empty( $settings['dropdown_icon'] ) ) {
					$this->add_render_attribute( 'dropdown_icon', 'class', $settings['dropdown_icon'] );
					$this->add_render_attribute( 'dropdown_icon', 'aria-hidden', 'true' );
				}
				?>

			<div class="ang-widget--kit-dropdown">
				<select name="ang-kit-switcher" id="ang-kit-switcher">
					<?php foreach ( $sk_to_display as $kit_id => $title ) : ?>
						<?php

						if ( (string) $active_kit === (string) $kit_id ) {

							$current_option = $title;
						}

						?>
						<option value="<?php echo esc_attr( $kit_id ); ?>" <?php if ( (string) $active_kit === (string) $kit_id ) echo 'selected'; ?>><?php echo esc_html( $title ); ?></option>
					<?php endforeach; ?>
				</select>
				<div class="dropdown">
					<span class="current">
						<?php echo esc_html( $current_option ); ?>
						<i <?php echo $this->get_render_attribute_string( 'dropdown_icon' ); ?>></i>
					</span>
					<div class="list">
						<ul>
							<?php
							foreach ( $sk_to_display as $kit_id => $title ) :
								?>
								<li class="option <?php if ( (string) $active_kit === (string) $kit_id ) echo 'selected'; ?>" data-value="<?php echo esc_attr( $kit_id ); ?>"><?php echo esc_html( $title ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render JS content template.
	 *
	 * @since 1.1.3
	 * @return void
	 */
	protected function content_template() {
		$kits       = $this->get_kits(); // List of imported kits.
		$active_kit = $this->get_default_style_kit_id(); // Default kit either global kit or document's style kit.
		?>
		<div class="ang-widget ang-widget--kit-switcher">
			<# if ( settings.switcher_style === 'toggle' ) { #>
			<div class="ang-widget--kit-toggle kit_a" data-current_kit="kit_a" style="display:inline-block">
				<i class="toggle_a {{ settings.toggle_a_icon.value }}" data-kit="<?php echo esc_attr( $active_kit ); ?>"></i>
				<i class="toggle_b {{ settings.toggle_b_icon.value }}" data-kit="{{ settings.toggle_b_kit }}"></i>
			</div>
			<# } #>
			<# if ( settings.switcher_style === 'dropdown' ) { #>
				<# 	let activeKit = <?php echo esc_js( $active_kit ); ?> #>
				<# 	let allKits = <?php echo wp_json_encode( $kits ); ?> #>
				<#
					let iconClass  = settings.dropdown_icon.value + ' ' + settings.dropdown_icon.library;
					let kitsToShow = _.pick( allKits, settings.kits ); //There is no guarantee in sorting of object keys in JS therefore converted to array and sorted.

					let kitsToShowsortedArray = [];

					for( let kitID in kitsToShow) {
						kitsToShowsortedArray.push({ 'pk' : kitID, 'v': kitsToShow[kitID]});
					}

					kitsToShowsortedArray = kitsToShowsortedArray.sort( (a, b) => {
						return (a.v).localeCompare(b.v)
					});

					let currentOptionID = settings.kits.includes(String(activeKit)) ? activeKit : parseInt( kitsToShowsortedArray[0]['pk'] );
					let currentOption	= allKits[currentOptionID];
				#>
			<div class="ang-widget--kit-dropdown">
				<select name="ang-kit-switcher" id="ang-kit-switcher">
					<# _.each( kitsToShowsortedArray, function( kit ) {
					#>
						<option value="{{ kit.pk }}">{{ kit.v }}</option>
					<# }); #>
				</select>
				<div class="dropdown">
					<span class="current">{{ currentOption }}
						<i class="{{ iconClass }}" aria-hidden="true"></i>
					</span>
					<div class="list">
						<ul>
							<#
								_.each( kitsToShowsortedArray, function( kit ) {
									let liClass = "option";

									if( parseInt( currentOptionID ) === parseInt( kit.pk ) ) {
										liClass += " selected";
									}
							#>
							<li class="{{ liClass }}" data-value="{{ kit.pk }}">{{ kit.v }}</li>
							<# }); #>
						</ul>
					</div>
				</div>
			</div>
			<# } #>
		<?php
	}

	/**
	 * Get a list of all available Kits.
	 *
	 * @since 1.1.3
	 *
	 * @param bool $prefix Whether to prefix Kit with "Global:" text.
	 * @return array
	 */
	private function get_kits( $prefix = false ) {
		return Utils::get_kits( $prefix );
	}

	/**
	 * Get default style kit.
	 *
	 * @since 1.1.3
	 * @return integer style kit's primary key.
	 */
	private function get_default_style_kit_id() {

		if ( false !== $this->document ) {
			$default_kit = $this->document->get_settings_for_display( 'ang_action_tokens' );

			if ( empty( $default_kit ) ) {
				$default_kit = get_option( 'elementor_active_kit' );
			}

			return $default_kit;
		}
	}
}

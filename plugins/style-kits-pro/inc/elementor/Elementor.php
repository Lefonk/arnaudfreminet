<?php
/**
 * Class AnalogPRO\Elementor\Elementor
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor;

use Analog\Elementor\Colors;
use Analog\Elementor\Sections\BackgroundColorClasses;
use Analog\Elementor\Typography;
use Analog\Options;
use Analog\Utils;
use Elementor\Plugin;
use AnalogPRO\Elementor\Tags\Kit_Colors_Tag;

/**
 * Class Elementor.
 *
 * @package AnalogPRO\Elementor
 */
final class Elementor {
	/**
	 * Elementor constructor.
	 */
	public function __construct() {
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_scripts' ) );

		add_action( 'elementor/dynamic_tags/register', array( $this, 'register_tags' ) );

		$this->remove_panel_actions();
	}

	/**
	 * Register Elementor Dynamic Tags.
	 *
	 * @since 1.0.3
	 *
	 * @return void
	 */
	public function register_tags() {
		if ( ! class_exists( '\ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag' ) ) {
			return;
		}

		require_once ANG_PRO_PATH . 'inc/elementor/tags/Kit_Colors_Tag.php';

		$module = Plugin::$instance->dynamic_tags;

		$module->register_group(
			'stylekits',
			array(
				'title' => __( 'Style Kits', 'ang-pro' ),
			)
		);

		$module->register( new Kit_Colors_Tag() );
	}

	/**
	 * Enqueue Elementor scripts for the editor.
	 */
	public function editor_scripts() {
		wp_enqueue_script(
			'ang-editor',
			ANG_PRO_URL . 'assets/js/editor.js',
			array( 'jquery', 'elementor-editor', 'lodash' ),
			filemtime( ANG_PRO_PATH . '/assets/js/editor.js' ),
			true
		);

		wp_localize_script(
			'ang-editor',
			'analogPro',
			array(
				'translate' => array(
					'resetAllStylesDesc'  => __( 'This action will reset inline styles on all elements, including widgets, sections, and columns.', 'ang-pro' ),
					'resetTypoColorDesc'  => __( 'This action will reset colors and typography customizations on all elements.', 'ang-pro' ),
					'resetTypoColorTitle' => __( 'Reset Colors and Typography', 'ang-pro' ),
				),
			)
		);
	}

	/**
	 * Remove selective Kit panels based on options.
	 *
	 * @since 1.0.3
	 *
	 * @return void
	 */
	private function remove_panel_actions() {
		$remove_panels = Options::get_instance()->get( 'manage_sk_panels' );

		if ( ! $remove_panels || ! is_array( $remove_panels ) ) {
			return;
		}

		$classes_map = array(
			'global_colors'         => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Colors::class,
				'method'   => 'register_global_colors',
				'priority' => 10,
			),
			'global_fonts'          => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_global_fonts',
				'priority' => 10,
			),
			'bg_color_classes'      => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => BackgroundColorClasses::class,
				'method'   => 'register_section',
				'priority' => 10,
			),
			'heading_sizes'         => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_typography_sizes',
				'priority' => 30,
			),
			'button_sizes'          => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_buttons',
				'priority' => 40,
			),
			'tools'                 => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_tools',
				'priority' => 999,
			),
			'forms'                 => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Global_Form::class,
				'method'   => 'register_form_controls',
				'priority' => 45,
			),
			'shadows'               => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Colors::class,
				'method'   => 'register_shadows',
				'priority' => 47,
			),
			'container_spacing'     => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_container_spacing',
				'priority' => 50,
			),
			'outer_section_padding' => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_outer_section_padding',
				'priority' => 280,
			),
			'column_gaps'           => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Typography::class,
				'method'   => 'register_columns_gap',
				'priority' => 290,
			),
			'accent_colors'         => array(
				'action'   => 'elementor/element/kit/section_buttons/after_section_end',
				'class'    => Colors::class,
				'method'   => 'register_color_settings',
				'priority' => 300,
			),
		);

		foreach ( $remove_panels as $panel => $value ) {
			$filter = $classes_map[ $panel ];

			Utils::remove_filters_for_anonymous_class( $filter['action'], $filter['class'], $filter['method'], $filter['priority'] );
		}
	}
}

new Elementor();

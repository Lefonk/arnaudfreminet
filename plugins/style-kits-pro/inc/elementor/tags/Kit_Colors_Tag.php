<?php
/**
 * Class AnalogPRO\Elementor\Tags\Kit_Colors_Tag.
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor\Tags;

use Elementor\Controls_Manager;
use ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag;
use ElementorPro\Modules\DynamicTags\ACF\Module;

/**
 * Class Kit_Colors_Tag.
 *
 * @since 1.0.3
 * @package AnalogPRO\Elementor\Tags
 */
final class Kit_Colors_Tag extends Data_Tag {

	/**
	 * Returns Tag categories.
	 *
	 * @since 1.0.3
	 *
	 * @inheritDoc
	 */
	public function get_categories() {
		return array( Module::COLOR_CATEGORY );
	}

	/**
	 * Returns Tag group.
	 *
	 * @since 1.0.3
	 *
	 * @inheritDoc
	 */
	public function get_group() {
		return 'stylekits';
	}

	/**
	 * Returns Tag Title.
	 *
	 * @since 1.0.3
	 *
	 * @inheritDoc
	 */
	public function get_title() {
		return __( 'Style Kit Colors', 'ang-pro' );
	}

	/**
	 * Returns Tag's display name.
	 *
	 * @since 1.0.3
	 *
	 * @inheritDoc
	 */
	public function get_name() {
		return 'style-kit-colors';
	}

	/**
	 * Returns template panel setting key.
	 *
	 * @since 1.0.3
	 *
	 * @return string
	 */
	public function get_panel_template_setting_key() {
		return 'key';
	}

	/**
	 * Tag controls.
	 *
	 * @since 1.0.3
	 *
	 * @return void
	 */
	protected function register_controls() {
		$colors_keys = array(
			'accent_colors'            => array(
				'label'   => __( 'Accent Colors', 'ang-pro' ),
				'options' => array(
					'var(--ang_color_accent_primary)'   => __( 'Primary', 'ang-pro' ),
					'var(--ang_color_accent_secondary)' => __( 'Secondary', 'ang-pro' ),
				),
			),
			'background_color_classes' => array(
				'label'   => __( 'Background Colors', 'ang-pro' ),
				'options' => array(
					'var(--ang_background_light_background)'  => __( 'Light', 'ang-pro' ),
					'var(--ang_background_dark_background)'  => __( 'Dark', 'ang-pro' ),
					'var(--ang_background_accent_background)'  => __( 'Accent', 'ang-pro' ),
				),
			),
		);

		$this->add_control(
			'key',
			array(
				'label'  => __( 'Color', 'ang-pro' ),
				'type'   => Controls_Manager::SELECT,
				'groups' => $colors_keys,
			)
		);
	}

	/**
	 * Returns tag value.
	 *
	 * @since 1.0.3
	 *
	 * @param array $options Options array.
	 * @inheritDoc
	 */
	protected function get_value( array $options = array() ) {
		return $this->get_settings( 'key' );
	}
}

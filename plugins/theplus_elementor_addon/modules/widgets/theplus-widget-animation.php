<?php
/**
 * The file that defines the widget plugin.
 *
 * @link       https://posimyth.com/
 * @since      1.0.0
 *
 * @package    ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$this->start_controls_section(
	'section_animation_styling',
	array(
		'label' => esc_html__( 'On Scroll View Animation', 'theplus' ),
		'tab'   => Controls_Manager::TAB_STYLE,
	)
);
$this->add_control(
	'animation_effects',
	array(
		'label'   => esc_html__( 'In Animation Effect', 'theplus' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'no-animation',
		'options' => theplus_get_animation_options(),
	)
);
$this->add_control(
	'animation_delay',
	array(
		'type'      => Controls_Manager::SLIDER,
		'label'     => esc_html__( 'Animation Delay', 'theplus' ),
		'default'   => array(
			'unit' => '',
			'size' => 50,
		),
		'range'     => array(
			'' => array(
				'min'  => 0,
				'max'  => 4000,
				'step' => 15,
			),
		),
		'condition' => array(
			'animation_effects!' => 'no-animation',
		),
	)
);

if ( ! empty( $Plus_Listing_block ) && 'Plus_Listing_block' === $Plus_Listing_block ) {
	$this->add_control(
		'animated_column_list',
		array(
			'label'     => esc_html__( 'List Load Animation', 'theplus' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '',
			'options'   => array(
				''        => esc_html__( 'Content Animation Block', 'theplus' ),
				'stagger' => esc_html__( 'Stagger Based Animation', 'theplus' ),
				'columns' => esc_html__( 'Columns Based Animation', 'theplus' ),
			),
			'condition' => array(
				'animation_effects!' => array( 'no-animation' ),
			),
		)
	);
	$this->add_control(
		'animation_stagger',
		array(
			'type'      => Controls_Manager::SLIDER,
			'label'     => esc_html__( 'Animation Stagger', 'theplus' ),
			'default'   => array(
				'unit' => '',
				'size' => 150,
			),
			'range'     => array(
				'' => array(
					'min'  => 0,
					'max'  => 6000,
					'step' => 10,
				),
			),
			'condition' => array(
				'animation_effects!'   => array( 'no-animation' ),
				'animated_column_list' => 'stagger',
			),
		)
	);
}

$this->add_control(
	'animation_duration_default',
	array(
		'label'     => esc_html__( 'Animation Duration', 'theplus' ),
		'type'      => Controls_Manager::SWITCHER,
		'default'   => 'no',
		'condition' => array(
			'animation_effects!' => 'no-animation',
		),
	)
);
$this->add_control(
	'animate_duration',
	array(
		'type'      => Controls_Manager::SLIDER,
		'label'     => esc_html__( 'Duration Speed', 'theplus' ),
		'default'   => array(
			'unit' => 'px',
			'size' => 50,
		),
		'range'     => array(
			'px' => array(
				'min'  => 100,
				'max'  => 10000,
				'step' => 100,
			),
		),
		'condition' => array(
			'animation_effects!'         => 'no-animation',
			'animation_duration_default' => 'yes',
		),
	)
);
$this->add_control(
	'animation_out_effects',
	array(
		'label'     => esc_html__( 'Out Animation Effect', 'theplus' ),
		'type'      => Controls_Manager::SELECT,
		'default'   => 'no-animation',
		'options'   => theplus_get_out_animation_options(),
		'separator' => 'before',
		'condition' => array(
			'animation_effects!' => 'no-animation',
		),
	)
);
$this->add_control(
	'animation_out_delay',
	array(
		'type'      => Controls_Manager::SLIDER,
		'label'     => esc_html__( 'Out Animation Delay', 'theplus' ),
		'default'   => array(
			'unit' => '',
			'size' => 50,
		),
		'range'     => array(
			'' => array(
				'min'  => 0,
				'max'  => 4000,
				'step' => 15,
			),
		),
		'condition' => array(
			'animation_effects!'     => 'no-animation',
			'animation_out_effects!' => 'no-animation',
		),
	)
);
$this->add_control(
	'animation_out_duration_default',
	array(
		'label'     => esc_html__( 'Out Animation Duration', 'theplus' ),
		'type'      => Controls_Manager::SWITCHER,
		'default'   => 'no',
		'condition' => array(
			'animation_effects!'     => 'no-animation',
			'animation_out_effects!' => 'no-animation',
		),
	)
);
$this->add_control(
	'animation_out_duration',
	array(
		'type'      => Controls_Manager::SLIDER,
		'label'     => esc_html__( 'Duration Speed', 'theplus' ),
		'default'   => array(
			'unit' => 'px',
			'size' => 50,
		),
		'range'     => array(
			'px' => array(
				'min'  => 100,
				'max'  => 10000,
				'step' => 100,
			),
		),
		'condition' => array(
			'animation_effects!'             => 'no-animation',
			'animation_out_effects!'         => 'no-animation',
			'animation_out_duration_default' => 'yes',
		),
	)
);
$this->end_controls_section();

<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      1.0.0
 *
 * @package    ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$this->start_controls_section(
	'theplus_section_needhelp',
	array(
		'label' => esc_html__( 'Need Help ?', 'theplus' ),
		'tab'   => Controls_Manager::TAB_CONTENT,
	)
);

$this->add_control(
	'theplus_help_raise_a_ticket',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( " <a class='tp-docs-link' href='https://store.posimyth.com/helpdesk/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank'  rel='noopener noreferrer'> Raise a Ticket </a>" ),
	)
);

$this->add_control(
	'theplus_help_read_documentation',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( " <a class='tp-docs-link' href='https://theplusaddons.com/docs?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Read Documentation </a>" ),
	)
);

$this->add_control(
	'theplus_help_watch_video_tutorials',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( " <a class='tp-docs-link' href='https://www.youtube.com/@posimyth?sub_confirmation=1' target='_blank'  rel='noopener noreferrer'> Watch Video Tutorials </a>" ),
	)
);

$this->add_control(
	'theplus_help_suggest_feature',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( " <a class='tp-docs-link' href='https://roadmap.theplusaddons.com/boards/feature-request' target='_blank' rel='noopener noreferrer'> Suggest Feature </a>" ),
	)
);

$this->add_control(
	'theplus_help_plugin_roadmap',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( " <a class='tp-docs-link' href='https://roadmap.theplusaddons.com/roadmap' target='_blank' rel='noopener noreferrer'> Plugin Roadmap </a>" ),
	)
);

$this->add_control(
	'theplus_help_join_facebook_community',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( " <a class='tp-docs-link' href='https://www.facebook.com/groups/theplus4elementor' target='_blank' rel='noopener noreferrer'> Join Facebook Community </a>" ),
	)
);

$this->add_control(
	'theplus_help_didnt_work_bug_reports',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( "<a class='tp-docs-link' href='https://roadmap.theplusaddons.com/boards/bug-reports' target='_blank' rel='noopener noreferrer'> Didn't work like you wanted? Report Issue </a>" ),
	)
);

$this->end_controls_section();
